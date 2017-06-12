<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

?>

<?php 
if ( !is_front_page() ) {
	get_template_part( "inc/content","footer" );
}
?>					

<div id="back-top"></div>
<?php wp_footer(); ?>
</body><!-- close the body -->
</html>