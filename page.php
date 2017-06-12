<?php
/**
 * The template for displaying pages
 *
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<?php get_template_part("/inc/page", "banner"); ?>

<div class="box large">	
	<div class="row">	
		<div class="large-8 medium-8 columns">		
			
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part("repeat/content", "page"); ?>

			<?php endwhile; ?>
			
		</div>			
		<?php get_sidebar(); ?>	
	</div>
</div>

<?php get_footer(); ?>