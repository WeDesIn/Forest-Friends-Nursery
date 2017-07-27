<?php
/**
 * The template for displaying single post main content
 *
 * @package WordPress
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="large-4 medium-6 small-12 columns blog-post" data-equalizer-watch itemscope itemtype="http://schema.org/BlogPosting">
	<article class="hentry">

		<?php if ( has_post_thumbnail() ){ ?>
			<a href="<?php echo the_permalink() ?>"> 
				<?php the_post_thumbnail("related-post", array( "class" => "alignnone" )); ?>
			</a>
		<?php } ?>

		<div class="entry-meta">
			<time><?php echo the_time("dS F"); ?></time>
		</div>

		<header class="entry-header">
			<a href="<?php the_permalink(); ?>"><h2 class="entry-title"><?php the_title() ?></h2></a>
		</header>

		<div class="entry-content">
			<?php the_excerpt() ?>
		</div>
		
		<a class="button" href="<?php the_permalink(); ?>">Read more</a>

	</article>
</div>	