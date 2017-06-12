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

<article class="hentry blog-post">

	<?php if ( has_post_thumbnail() ){ the_post_thumbnail("thumbnail", array( "class" => "alignleft" )); } ?>

	<header class="entry-header">
		<a href="<?php the_permalink(); ?>"><h2 class="entry-title"><?php the_title() ?></h2></a>
	</header>

	<div class="entry-meta">
		<time><?php echo the_time("dS F, Y"); ?></time>
	</div>

	<div class="entry-content">
		<?php the_excerpt() ?>
	</div>
	
	<a class="button" href="<?php the_permalink(); ?>">Read more</a>

</article>