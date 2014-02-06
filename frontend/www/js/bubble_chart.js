/**
 * Show Bubble chart in specified place of DOM.
 * Required: D3.js and jQuery
 * Params:
 * p - object with structure:
 * {
 *   "place" (required) - where to put chart, something like "body" or "div#bubbleDiv"
 *   "jsonFile" (required) - link to JSON file with all tags
 *   "diameter" (optional) - diameter of the chart in pixels
 *   "tags" (optional) - object with tags for the chart. Sample {"HTML": 3, "CSS": 1, "JavaScript": 2}
 * }
 *
 */
function showBubbleChart(p) {
	var diameter = p.diameter||500,
	    format = d3.format(",d"),
	    color = d3.scale.category20c();

	var bubble = d3.layout.pack()
	    .sort(null)
	    .size([diameter, diameter])
	    .padding(1.5);

	var svg = d3.select(p.place).append("svg")
	    .attr("width", diameter)
	    .attr("height", diameter)
	    .attr("class", "bubble");

	d3.json(p.jsonFile, function(error, root) {
	  var node = svg.selectAll(".node")
	      .data(bubble.nodes(classes(root, p.tags||{"IT": 1}))
	      .filter(function(d) { return !d.children; }))
	    .enter().append("g")
	      .attr("class", "node")
	      .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

	  node.append("title")
	      .text(function(d) { return d.className + ": " + format(d.value); });

	  node.append("circle")
	      .attr("r", function(d) { return d.r; })
	      .style("fill", function(d) { return color(d.packageName); })
	      .on("click", onClickFunc);

	  node.append("text")
	      .attr("dy", ".3em")
	      .style("text-anchor", "middle")
	      .text(function(d) { return d.className.substring(0, d.r / 3); })
	      .on("click", onClickFunc);
	});

	function onClickFunc(d) {
		alert(d.className);
	}

	// Returns a flattened hierarchy containing all leaf nodes under the root.
	function classes(root, allTags) {
		// local copy of tags
		var tags = jQuery.extend({}, allTags);
		/*for (var key in allTags) {
			tags[key] = allTags[key];
		}*/

		var classes = [];
		function recurse(name, node) {
			if (node.children) node.children.forEach(function(child) { recurse(node.name, child); });
			else {
				if ( tags.hasOwnProperty(node.name) ) {
				    classes.push({packageName: name, className: node.name, value: tags[node.name]});
				    tags[node.name] = 0;
				}
			}
		}

		recurse(null, root);

		// add unknown tags to separate group
		var otherGroupName = 'Others';
		for (var key in tags) {
			if ( tags[key] ) {
				classes.push({packageName: otherGroupName, className: key, value: tags[key]});
			}
		}

		return {children: classes};
	}

	d3.select(self.frameElement).style("height", diameter + "px");
}