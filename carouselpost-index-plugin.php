
<?php
/**
 * @package CarouselOfPosts
 */
/*
Plugin Name: Carousel of Posts
Plugin URI: https://carouselofposts.com/
Description: Used by tens of thousands, Carousel of Posts is a fun and visual way to keep your visitors engaged with <strong>WordPress's Gutenberg Editor</strong>. You'll be ablt to view a total of 9 posts, 3 visible at a time with next and back buttons to scroll through.
Version: 1.0
Author: Kal Molinet
Author URI: https://carouselofposts.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: carouselofposts
*/


// Custom Fields for featured image, title, and date

function display_carousel_posts() {

    // Parameters to retrieve category, create order, and limit carousel by 9 posts
    $args = array(
        'category_name' => 'carousel',
        'show_updated' => 1,
	    'orderby' => 'link_id',
	    'order' => 'DESC',
        'limit' => 9
    );

    // Pass parameters to WordPress function
    $links = get_bookmarks($args);
    $n = count($links);

    // Test if carousel is empty
    if (!empty($links)) {

    // Display carousel only if there are posts to display
    wp_enqueue_script();

    // Code to display the carousel
    	?>
	<div id="carousel">
        <ul>
        	<?php
	        foreach ($links as $i => $link) {
                // Background image
                if (!empty($link->link_image))
                	$background = 'url(' . $link->link_image . ')';
                else
                    $background = 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';

                // Target attribute
                if (!empty($link->link_target))
                	$target = ' target="' . $link->link_target . '"';
                else
                    $target = '';

                // Rel attribute
                if (!empty($link->link_rel))
	                $rel = ' rel="' . $link->link_rel . '"';
                else
                    $rel = '';
                ?>

                // Display main link
                <li style="background: <?php echo $background; ?>;">

                    <a
	                    class="carousel-link"
	                    href="<?php echo $link->link_url; ?>"
                        title="<?php echo $link->link_name; ?>"

                        // Displays only if there are values for them
	                    <?php echo $target . $rel; ?>
	                    >
                    </a>

                    // Display name of the link and description
                    <a href="<?php echo $link->link_url; ?>">
	                    <strong><?php echo $link->link_name; ?></strong>
                        <?php

                        // Test if description is empty
	                    if (!empty($link->link_description)) {
		                    ?>
		                    <em><?php echo $link->link_description; ?></em>
		                    <?php
	                    }
	                    ?>
                    </a>

                    // Determine if current link is the first to display the back carrot
                    <?php
	                if ($i > 0) {
                        ?>

                        // This creates a carrot symbol to go back
		                <a href="#prev" class="carousel-prev">&lt;</a>
		                <?php
	                }
                    ?>

                    // Determine if current link is the last to display the next carrot
                    <?php
                    // Next link
                    if ($i < $n - 1) {
	                    ?>
	                    <a href="#next" class="carousel-next">&gt;</a>
	                    <?php
                    }
                    ?>

	            </li>
	            <?php
	        }
	        ?>
		</ul>
	</div>
    <?php
    }
}

/**
 * Load Style and Script Files
 */

// Load Style
function enqueue_plugin_carousel_style() {
    wp_register_style( 'carouselStyle',  plugin_dir_url() . 'assets/foo-styles.css' );
    wp_enqueue_style( 'carouselStyle' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_plugin_carousel_style' );

// Load Script
function enqueue_plugin_carousel_script() {
    wp_register_script('carouselScript', plugin_dir_url() . 'assets/carouselposts.js', array('jquery'), '1.0', true);
    wp_enqueue_script( 'carouselScript');
}
add_action(' wp_enqueue_script', 'enqueue_plugin_carousel_script');
