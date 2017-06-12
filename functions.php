<?php
/**
 * The functions 
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/* Change login logo and footer text
============================================================================================*/

function my_login_stylesheet() { ?>
    
<style type="text/css">
  .login h1 a {
    background: transparent url( http://www.wedesin.cz/logo/Logo-Wedesin-CZ.png ) no-repeat !important;
    background-size: 100% 100% !important;
    width: 300px !important;
    height: 80px !important;
  }
</style>

<?php } 
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

// THIS TAKES AWAY DEFAULT ADMIN FOOTER TEXT AND USES MY OWN
function remove_footer_admin () {
    echo '<p>Webové stránky vytvořil <a href="http://www.wedesin.cz/en/" target="_blank">WeDesIn</a>.
  Pokud máte jakékoliv otázky, napište na <a href="mailto:info@wedesin.cz" target="_blank">info@wedesin.cz</a';
} 
add_filter('admin_footer_text', 'remove_footer_admin');

/* End
============================================================================================*/

/* Minify HTML
============================*/
/*
function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
        );
    $replace = array(
        '>',
        '<',
        '\\1'
        );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
ob_start("sanitize_output");

add_action( 'init', 'sanitize_output' );*/


function site_setup() {
  // Enable support 
  add_theme_support('post-thumbnails');  
  add_theme_support('menus');
  add_theme_support( "title-tag" );
  add_filter('widget_text', 'do_shortcode');

  //ACF sections
  acf_add_options_sub_page( 'General' );
  acf_add_options_sub_page( 'Header' );
  acf_add_options_sub_page( 'Footer' );
  acf_add_options_sub_page( 'Testimonials' );

  /* Custom Image Sizes Here */
  /*add_image_size('logo', null, 84);
  add_image_size('mobile-logo', null, 44);*/
  add_image_size('related-post', 500, 320, true);

  //register menus
  register_nav_menu( 'primary', 'Primary Menu' );
  register_nav_menu( 'footer', 'Footer Menu' );

}
add_action('after_setup_theme', 'site_setup');

if ( ! isset( $content_width ) ) $content_width = 1000;

/*clean up wordpress setting*/
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

function disable_wp_emojicons_CWT() {
  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce_CWT' );
}
add_action( 'init', 'disable_wp_emojicons_CWT' );

function disable_emojicons_tinymce_CWT( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

//css function
function register_theme_styling_add_CWT () {
    global $wp_styles;

    //register foundation min
    wp_register_style( 'foundation', get_template_directory_uri() . '/css/foundation/foundation.min.css');
    wp_enqueue_style ( 'foundation', get_template_directory_uri() . '/css/foundation/foundation.min.css' ); 

    if ( is_page_template( 'page-templates/template-repeated-sections.php' ) || is_front_page() ) {
      //register and enqueue app
      wp_register_style( 'fullpage', get_template_directory_uri() . '/css/fullPage.css');
      wp_enqueue_style ( 'fullpage', get_template_directory_uri() . '/css/fullPage.css' ); 

    }

    //register main style
    $mtime = filemtime( get_stylesheet_directory() . '/style.css');
    wp_register_style( 'main', get_template_directory_uri() . '/style.css', array(),  $mtime , 'all');
    wp_enqueue_style ( 'main', get_template_directory_uri() . '/style.css', array(),  $mtime , 'all');      

}    
add_action ('wp_enqueue_scripts', 'register_theme_styling_add_CWT');

//register scripts
function register_js_scripts_add_CWT() {

    //foundations basic
    wp_register_script ( 'foundation', get_template_directory_uri() . '/js/foundation/foundation.min.js' );  
    wp_enqueue_script ( 'foundation', get_template_directory_uri() . '/js/foundation/foundation.min.js', array( 'jquery' ), '', true); 

    if ( is_page_template( 'page-templates/template-repeated-sections.php' ) || is_front_page() ) {

      wp_register_script ( 'ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js' );  
      wp_enqueue_script ( 'ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js', array( 'jquery' ), '', true);

      wp_register_script ( 'scroll', get_template_directory_uri() . '/js/fullpage/scrolloverflow.min.js' );  
      wp_enqueue_script ( 'scroll', get_template_directory_uri() . '/js/fullpage/scrolloverflow.min.js', array( 'jquery' ), '', true);

      wp_register_script ( 'fullpage', get_template_directory_uri() . '/js/fullpage/jquery.fullPage.min.js' );  
      wp_enqueue_script ( 'fullpage', get_template_directory_uri() . '/js/fullpage/jquery.fullPage.min.js', array( 'jquery' ), '', true);  

    }

    if ( is_front_page() ) {

      //functionalities
      $slick = filemtime( get_stylesheet_directory() . '/js/slick-slider/slick-slider.js');
      wp_register_script ( 'slick-slider', get_template_directory_uri() . '/js/slick-slider/slick-slider.js', array( 'jquery' ),$slick, true); 
      wp_enqueue_script ( 'slick-slider', get_template_directory_uri() . '/js/slick-slider/slick-slider.js', array( 'jquery' ),$slick, true); 

    }

    if ( is_page_template( 'page-templates/template-contact.php' ) ) {
      wp_register_script ( 'google-maps', 'https://maps.googleapis.com/maps/api/js' );  
      wp_enqueue_script ( 'google-maps', 'https://maps.googleapis.com/maps/api/js', array( 'jquery' ), '', true);
    }

    //functionalities
    $apptime = filemtime( get_stylesheet_directory() . '/js/foundation/app.js');
    wp_register_script ( 'app', get_template_directory_uri() . '/js/foundation/app.js', array( 'jquery' ),$apptime, true); 
    wp_enqueue_script ( 'app', get_template_directory_uri() . '/js/foundation/app.js', array( 'jquery' ),$apptime, true); 

    //add script for ie8 and less
    wp_register_script ( 'html5shiv', 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.js' );
    wp_enqueue_script( 'html5shiv', 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.js' );
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
    wp_register_script ( 'respond8', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js' );
    wp_enqueue_script( 'respond8', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js' );
    wp_script_add_data( 'respond8', 'conditional', 'lt IE 9' );
      
}    
add_action ('wp_enqueue_scripts', 'register_js_scripts_add_CWT');

//widgets
if (function_exists('register_sidebar')) {
     
     register_sidebar(array(
      'name' => 'Sidebar Widgets',
      'id'   => 'sidebar-widgets',
      'description'   => 'Widget Area',
      'before_widget' => '<div class="sidebar-widget" id="widget-%1$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
     ));

     register_sidebar(array(
      'name' => 'Blog  Page',
      'id'   => 'blog-loop-page',
      'description'   => 'Widget area for Blog / News Page',
      'before_widget' => '<div class="sidebar-widget blog-widget" id="widget-%1$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
     ));

     register_sidebar(array(
      'name' => 'Footer 1',
      'id'   => 'footer-1',
      'description'   => 'Widget area for footer',
      'before_widget' => '<div class="sidebar-widget footer-widget" id="widget-%1$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
     ));

     register_sidebar(array(
      'name' => 'Footer 2',
      'id'   => 'footer-2',
      'description'   => 'Widget area for footer',
      'before_widget' => '<div class="sidebar-widget footer-widget" id="widget-%1$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
     ));

     /*register_sidebar(array(
      'name' => 'Footer 3',
      'id'   => 'footer-3',
      'description'   => 'Widget area for footer',
      'before_widget' => '<div class="sidebar-widget footer-widget" id="widget-%1$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
     ));*/
}

/*Removes [...] from the excerpt and allows you to set the number of words in there
To change the number of wodrs, use the $excerpt_length number.. To add something behind the 
excerpt, add something to the "array_push($words, '');" section*/

function filter_excerpt_CWT($text) {
  if ($text == '')
  {
    $text = get_the_content('');
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $text = strip_tags($text);
    $text = nl2br($text);
    $excerpt_length = apply_filters('excerpt_length', 20);
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words) > $excerpt_length) {
      array_pop($words);
      array_push($words, '...');
      $text = implode(' ', $words);
    }
  }
  return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'filter_excerpt_CWT');


if ( !function_exists('get_svg_FFN') ) {

  function get_svg_FFN( $source ) {

    echo file_get_contents(  get_stylesheet_directory_uri() . '/svg/'. $source );

  }

}


/*Fix google api issue
=========================================================*/

function my_acf_google_map_api( $api ){
  
  $api['key'] = 'XXX';
  
  return $api;
  
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');



function center_header_FFN( $content ) {

  echo '<div class="row"><header class="column"><h2 class="text-center entry-header section-title">'. $content . '</h2></header></div>';
}

?>