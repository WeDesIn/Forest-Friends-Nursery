<?php
/**
 * The template for displaying pages
 * Template Name: Two columns
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<?php get_template_part("/inc/page", "banner"); ?>
	
<div class="box">  
  <div class="row">	
  	<div class="medium-6 columns">		
  		
  		<?php while ( have_posts() ) : the_post(); ?>
  			
  			<?php get_template_part("repeat/content", "page"); ?>

  		<?php endwhile; ?>
  		
  	</div>	
    <div class="medium-6 columns">  		
      <?php echo do_shortcode( wpautop( get_field("right_column") ) ); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>

