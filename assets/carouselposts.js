// Avoid conflict with other variables using the $ symbol
jQuery(function($) {
    function carousel_show_another_link(direction) {

        // Retrieve the ul block
        var ul = $('#carousel ul');

        // Convert percentage to a positive number
        var current = -parseInt(ul[0].style.marginLeft) / 100;

        // Calculate index of the post
        var new_link = current + direction;

        var links_number = ul.children('li').length;
    }

    // Functions called when arrows are clicked
    function carousel_previous_link() {
        carousel_show_another_link(-1);
        return false;
    }

});

// Attach events
$(document).ready(function () {
    $('#carousel ul li a.carousel-prev').click(carousel_previous_link);
    $('#carousel ul li a.carousel-next').click(carousel_next_link);
});
