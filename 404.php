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
		<div class="column">		
			<h1>It may have been moved though.</h1>
			<p>You can either search for it:</p>
			<?php get_search_form(); ?>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<p>Or go back to <a href="<?php echo site_url(); ?>">homepage</a>.</p>
		</div>			
	</div>
</div>

<?php get_footer(); ?>
