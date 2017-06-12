<?php
/**
 * The template for displaying single post
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
			<article class="hentry" itemscope="" itemtype="http://schema.org/BlogPosting">	
							
				<div class="entry-content" itemprop="articleBody">
					<?php the_content() ?>
				</div>

				<footer class="entry-meta">
					<div class="entry-meta">
						<span class="sep">Published: </span> 
			            <time class="entry-date updated" datetime="<?php echo the_time("d/m/Y"); ?>" pubdate="" itemprop="datePublished"><?php echo the_time("d/m/Y"); ?></time> 
			            Autor: <span itemprop="author" itemtype="http://schema.org/Person"><span itemprop="name"><?php echo get_the_author( ); ?></span></span>
			                
					</div>
				</footer>

				<?php if (is_user_logged_in()) { ?>	
					<div class="edit">
						<span class="edit-link"><?php edit_post_link(__("Edit"), ''); ?></span>
					</div>
				<?php } ?>
			
			</article>
			<?php endwhile; ?>
		</div>			
		<?php get_template_part("sidebar", "blog"); ?>
	</div>
</div>
	
<?php get_footer(); ?>