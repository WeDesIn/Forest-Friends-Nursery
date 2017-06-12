<?php 
/**
 * The template for displaying latest posts
 *
 * @package WordPress
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = array(
	'posts_per_page' => 3 );
	$wp_query = new WP_Query($args);

if($wp_query -> have_posts()) : ?>
<div class="latest-posts">

		<?php center_header_FFN( 'Our Daily life' )?>

		<div class="row">		
		<?php while ( $wp_query -> have_posts() ) : $wp_query -> the_post(); 	?>
			<div class="large-4 medium-6 small-12 column <?php if (($wp_query->current_post +1) == ($wp_query->post_count)) { echo "last-post"; } ?>">			
				<article class="hentry small-post">

					<?php if ( has_post_thumbnail() ){ ?>
						<a href="<?php the_permalink(); ?>">
							<figure><?php the_post_thumbnail("related-post"); ?></figure>
						</a>
					<?php } ?>
					<div class="wrap-content">
						<header class="entry-header">
							<a href="<?php the_permalink(); ?>"><h3 class="entry-title"><?php the_title() ?></h3></a>
						</header>

						<div class="entry-content">
							<?php the_excerpt() ?>
						</div>
						
						<a class="button" href="<?php the_permalink(); ?>">Read more</a>
					</div>
				
				</article>
			</div>

		<?php endwhile; ?>
		</div>

</div>
<?php endif; wp_reset_query(); ?>	