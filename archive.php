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

global $wp_query;

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } 
else if ( get_query_var('page') ) {$paged = get_query_var('page'); } 
else {$paged = 1; } 

?>

<?php get_template_part("/inc/page", "banner"); ?>

<div class="box">

	<div class="row">

		<div class="columns" data-equalizer>
				
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part("/repeat/content", "post"); ?>

			<?php endwhile; ?>

			<?php if ( $wp_query->max_num_pages > 1 ) { ?>
			<div id="posts">

			</div>
			<div class="column text-center section" id="button-wrap">
				<a href="#" class="button arrow-down" id="load-more" data-page="<?php echo $paged; ?>" 
					data-max="<?php echo $wp_query->max_num_pages; ?>">More posts</a>
			</div>
			<?php } ?>

		</div>

	</div>

</div>
	
<?php get_footer(); ?>