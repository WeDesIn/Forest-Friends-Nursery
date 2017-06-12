<?php
/**
 * The template for displaying single post
 *
 * @package WordPress
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (  $wp_query->max_num_pages > 1 ) { ?>

<div class="pagination">		
<?php
	global $wp_query;

	$numpages = $wp_query->max_num_pages;

	echo paginate_links( array(
		'base' => @add_query_arg('paged','%#%'),
	   	'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $numpages,
		'prev_text' => '<span class="previous"></span>',
		'next_text' => '<span class="next"></span>'
	) );
?>
</div>
<?php } ?>