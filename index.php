<?php
/**
 * The main template file
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


get_header(); 

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } 
else if ( get_query_var('page') ) {$paged = get_query_var('page'); } 
else {$paged = 1; } 

?>

<?php get_template_part("/inc/page", "banner"); ?>

<div class="box">

	<div class="row">

		<div class="large-8 medium-8 columns">

			<?php get_template_part("/inc/pagination"); ?>
				
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part("/repeat/content", "post"); ?>

			<?php endwhile; ?>

			<?php get_template_part("/inc/pagination"); ?>

		</div>
		<?php get_template_part("sidebar", "blog"); ?>

	</div>

</div>
	
<?php get_footer(); ?>