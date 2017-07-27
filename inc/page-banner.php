<?php 
//
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_404() ) {
	$img_url[] = get_stylesheet_directory_uri(). '/img/oh-deer.png';
	$page_subtitle = 'The page you are looking for is not here.';
	$title = "Oh deer, 404 error";
} else if ( is_home() ) { 

	$title = "Our daily life";
	$page_subtitle = '';
	$img_url[] = get_stylesheet_directory_uri().'/img/nursery-custom.png';

} else {
	$img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	if ( empty($img_url) ) $img_url[] = get_stylesheet_directory_uri().'/img/nursery-custom.png';
	$page_subtitle = get_post_meta( $post->ID, "page_subtitle", true );
	$title = get_the_title();
} ?>
<section class="page-banner" style="background: url(<?php echo $img_url[0];?>) no-repeat; background-size: 100% auto; background-size: cover; background-position: center top; ">
	<div class="row">
		<div class="medium-12 column">
			<div class="page-box">
				<header class="entry-header">
					<h1 class="entry-title" itemprop="name headline"><?php echo $title; ?></h1>
				</header>
				<?php get_template_part("/inc/breadcrumbs"); ?>
				<?php if ( $page_subtitle ) : echo '<p>'. $page_subtitle . '</p>'; endif; ?>
			</div>
		</div>
	</div>
</section>