<?php
/**
 * The template for displaying pages
 * Template Name: Contact page
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<?php get_template_part("/inc/page", "banner"); ?>
	
<div class="box">  
  <div class="row">	
  	<div class="medium-6 columns">		
  		
  		<?php while ( have_posts() ) : the_post(); ?>
  			
  			<?php get_template_part("repeat/content", "page"); ?>

  		<?php endwhile; ?>
  		
  	</div>	
    <div class="medium-6 columns">  		
      <?php echo do_shortcode( wpautop( get_field("right_column") ) ); ?>
    </div>
  </div>
</div>

<div id="map_canvas"></div>
<?php get_footer(); ?>
<script>
      /* <![CDATA[ */
      function initialize() {
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          center: new google.maps.LatLng(51.7928915, -2.61810928),
          zoom: 19,
          scrollwheel: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options);

        marker = new google.maps.Marker({
          map:map,
          draggable:false,
          animation: google.maps.Animation.DROP,
          position: new google.maps.LatLng(51.7928915, -2.61810928),
          icon: null 
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);

      /*]]>*/
</script>
