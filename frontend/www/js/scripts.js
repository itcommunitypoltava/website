/**
 * Created by vbilenkyy on 2/4/14.
 */

$(function () {
    setNavigation();
    });

function setNavigation() {
    var path = window.location.pathname;
    alert(path);
    path = path.replace(/\/$/, "");
    alert(path);
    path = decodeURIComponent(path);
    alert(path);

    $(".navbar-nav a").each(function () {
    var href = $(this).attr('href');
    if (path.substring(0, href.length) === href) {
    $(this).closest('li').addClass('active');
    }
});
}
