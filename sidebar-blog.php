<?php
/**
 * The template for sidebar 
 * Allways use grid-4 for sidebar
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<aside class="large-3 medium-4 columns" id="sidebar"> 
	<div role="sidebar">
       	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog  Page')) : ?>
       		
       	<?php endif; ?> 
    </div>   	
</aside>
   	    







