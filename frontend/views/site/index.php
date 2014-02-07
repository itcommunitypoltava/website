<?php
/**
 * Landing page view file
 *
 * @var FrontendSiteController $this
 */
$this->pageTitle=Yii::app()->name;?>

<h1>Hello <?php echo Yii::app()->user->name;?>!</h1>

<p>
    This is the public side ("frontend") of your application.
    Everything related to it is contained inside <code>/frontend</code> subdirectory.
    You can treat this directory as a <code>/protected</code> subdirectory equivalent.
    Frontend is a Twitter bootstrap 3 template.
    It's expected that you are going to write your own 100% custom design anyway.
</p>

<div class="row">
    <div id="MainPageSkills" class="col-lg-6 text-center" title="Bubbles of skills"></div>
    <div class="col-lg-6">
        <p>Points of interest:</p>

        <ul>
            <li>
                <p>
                    <code>/frontend/components/FrontendController.php</code> is the base for all frontend controllers.
                    It registers all required styles and scripts for common frontend UI.
                </p>
            </li>
            <li>
                <p>Layout is <code>/frontend/views/layouts/main.php</code>.</p>
            </li>
            <li>
                <p>
                    Note that in this layout there is the Google Analytics code already inserted as a widget.
                    Just provide your GA ID in the <code>['params']['google.analytics.id']</code> section of a config,
                    by specifying it in the <code>/frontend/config/environments/prod.php</code>, for example.
                </p>
            </li>
        </ul>
    </div>
</div>


<script type="text/javascript">
    // show bubbles
    $(document).ready(function() {
        // TODO load tags from JSON file
        $.getJSON("/js/tags.json", function(tags) {
            //var tags = {"PHP": 3, "HTML": 5, "Java": 2,"OOP": 4, "Joomla": 1, "Git": 2,"Agile": 2, "Windows": 7, "WordPress": 3, "Yii": 1, "Linux": 2, "Photoshop": 3};
            showBubbleChart({
                "place": "div#MainPageSkills",
                "jsonFile": "/js/tag_cloud.json",
                "diameter": 500,
                "tags": tags
            });
        });
    });
</script>