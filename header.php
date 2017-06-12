<?php
/**
 * The Header template for our theme
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <link href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">	
<header id="main-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">		
	<div id="top-bar">	
		<div class="row">
			<div class="column text-right">
				<ul class="inline-list">
					<li class="time hide-for-small-only"><?php get_svg_FFN("circular-clock.svg") ?><?php the_field('opening_hours', 'options'); ?></li>
					<li class="phone"><a href="tel:<?php the_field('phone_number'); ?>"><?php get_svg_FFN("telephone.svg") ?><?php the_field('phone_number', 'options'); ?></a></li>
					<li class="email"><a href="mailto:<?php the_field('email'); ?>"><?php get_svg_FFN("interface.svg") ?><?php the_field('email', 'options'); ?></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="header-content">
		<div class="row">
			<div class="large-3 columns">	
				<figure class="header-logo">
					<a href="<?php echo site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/forest-friends-nursery-logo-cut.jpg" 
						alt="Forest Friends Nursery logo"></a>
				</figure>
			</div>
      		<div class="large-9 columns">	
				<?php 
				wp_nav_menu ( array( 'theme_location' => 'primary', 'items_wrap'=> '<ul class="forest-menu">%3$s</ul>')); 
				?>
			</div>
		</div>
	</div>
</header><!-- header -->
<main id="body" class="<?php if ( !is_front_page() && !is_page_template( 'page-templates/template-repeated-sections.php' ) ) { echo 'offset'; } ?>">