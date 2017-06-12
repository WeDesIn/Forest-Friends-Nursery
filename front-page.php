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

	<div id="fullpage">
		<div class="section" id="section0">
			<?php // check if the repeater field has rows of data
			if( have_rows('slides') ):

				$ct = 0;
				echo '<div class="front-slider">';

			 	// loop through the rows of data
			    while ( have_rows('slides') ) : the_row();

			        // display a sub field value
			        $slide_content = get_sub_field('slide_content');
			        $slide_button_text = get_sub_field('slide_button_text');
			        $button_link = get_sub_field('button_link');
			        $slide_background = get_sub_field('slide_background');
			        //print_r($slide_background);

			        print '<div class="slick-slide" id="slide'.$ct.'" style="background: url('.$slide_background['url'].') no-repeat; background-size: 
			        100% auto; background-size: cover;"><div class="slide-content">'. 

			        $slide_content

			        .'</div></div>';

			    $ct++;    
			    endwhile;

			    echo "</div>";

			endif; 
			?>
			
		</div>
		<section class="section" id="section1">

			<?php center_header_FFN( 'What we do' )?>

			<div class="row">
				<div class="large-5 column">
					<?php echo wpautop( get_post_meta( $post->ID, "left_content_about_us", true ) ); ?>
				</div>
				<div class="large-7 column">
					<?php echo wpautop( get_post_meta( $post->ID, "right_content_about_us", true ) ); ?>
				</div>
			</div>
		</section>
		<section class="section videos" id="section2">
			
			Use this: 
			https://revolution.themepunch.com/jquery-vimeo-gallery/

		</section>
		<section class="section reviews" id="section3"><div class="quote"> </div>
			
			<?php center_header_FFN( 'What parents say about us' )?>

			<?php get_template_part( 'inc/slick', "slider" ); ?>
			
		</section>
		<section class="section footer-section" id="section4">

			<?php get_template_part( 'inc/latest', "posts" ); ?>

			<?php get_template_part( 'inc/content', "footer" ); ?>

		</section>
	</div>
</main> 
<?php get_footer(); ?>