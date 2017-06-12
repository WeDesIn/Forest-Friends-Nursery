<?php
/**
 * The main template file
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 


query_posts(array( "post_type" => "reference", "posts_per_page"=> -1 ));
// check if the repeater field has rows of data
if( have_posts() ):

	echo '<div class="reference-slider">';

 	// loop through the rows of data
    while ( have_posts() ) : the_post();

        // display a sub field value
        $title = get_the_title();
        $content = get_the_content();

        echo '<div><p>'.$content .'</p><p class="who">'.$title.'</p></div>';

    endwhile;

    echo '</div>';

endif;

?>