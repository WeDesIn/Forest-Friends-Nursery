<?php
/**
 * The template for displaying pages
 *
 * Template Name: Full Page Sections
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>
	
<?php 
	// check if the repeater field has rows of data
if( have_rows('sections_list') ):

	echo '<div id="fullpage">';

		$ct = 1;
	 	// loop through the rows of data
	    while ( have_rows('sections_list') ) : the_row();

	    //get values
			$background_colour = get_sub_field('background_colour');
	        $field_content = get_sub_field('field_content');

			echo '<section class="section" id="section'.$ct.'" '.(($background_colour!='')?'style="background: '.$background_colour.'"':"").'>';

	        echo '<div class="row"><div class="column">' . do_shortcode( wpautop( $field_content ) ). '</div></div>';

	        echo '</section>';

	    $ct++;    
	    endwhile;

	echo '</div>';

endif;	

?>	
	
<?php get_footer(); ?>