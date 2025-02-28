<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
/**
 * freeagent functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage freeagent
 * @since 1.0.0
 */

/** Define THEME */ 
if (!defined('JWS_ABS_PATH')) define('JWS_ABS_PATH', get_template_directory());
if (!defined('JWS_ABS_PATH_ELEMENT')) define('JWS_ABS_PATH_ELEMENT', get_template_directory().'/inc/elementor_widget/widgets');
if (!defined('JWS_ABS_PATH_WC')) define('JWS_ABS_PATH_WC', get_template_directory().'/woocommerce');
if (!defined('JWS_URI_PATH')) define('JWS_URI_PATH', get_template_directory_uri());
if ( ! function_exists( 'jws_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function jws_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on freeagent, use a find and replace
		 * to change 'freeagent' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'freeagent', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
        
        add_theme_support( 'post-formats', array('audio','video','link','quote','gallery'));
		
        set_post_thumbnail_size( 1568, 9999 );
   

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
        // This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'main_navigation'   => esc_html__( 'Main Menu','freeagent' ),
		) );

	}
endif;

add_action( 'after_setup_theme', 'jws_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jws_widgets_init() {

    register_sidebar( 
      array(
			'name'          =>  esc_html__( 'Main Sidebar', 'freeagent' ),
			'id'            => 'sidebar-main',
			'description'   =>  esc_html__( 'Add widgets here to appear in your blog.', 'freeagent' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
	  )
    );
    register_sidebar( 
      array(
			'name'          =>  esc_html__( 'Single Blog Sidebar', 'freeagent' ),
			'id'            => 'sidebar-single-blog',
			'description'   =>  esc_html__( 'Add widgets here to appear in your blog.', 'freeagent' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
	  )
    );
    
    register_sidebar( 
      array(
			'name'          =>  esc_html__( 'Shop Page (Left And Right)', 'freeagent' ),
			'id'            => 'sidebar-shop',
			'description'   =>  esc_html__( 'Add widgets here to appear in shop page.', 'freeagent' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
	  )
    );
    register_sidebar( 
      array(
			'name'          =>  esc_html__( 'Single Shop Sidebar', 'freeagent' ),
			'id'            => 'sidebar-shop-single',
			'description'   =>  esc_html__( 'Add widgets here to appear in shop single.', 'freeagent' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
	  )
    );
    register_sidebar( 
      array(
			'name'          =>  esc_html__( 'Employers Page', 'freeagent' ),
			'id'            => 'sidebar-employer',
			'description'   =>  esc_html__( 'Add widgets here to appear in employers page filter modal.', 'freeagent' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<strong class="widget-title">',
			'after_title'   => '</strong>',
	  )
    );
    
    register_sidebar( 
      array(
			'name'          =>  esc_html__( 'Freelancers Page', 'freeagent' ),
			'id'            => 'sidebar-freelancers',
			'description'   =>  esc_html__( 'Add widgets here to appear in freelancers page filter modal.', 'freeagent' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
	  )
    );
    
    register_sidebar( 
      array(
			'name'          =>  esc_html__( 'Jobs Page', 'freeagent' ),
			'id'            => 'sidebar-job',
			'description'   =>  esc_html__( 'Add widgets here to appear in Jobs page.', 'freeagent' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
	  )
    );

    register_sidebar( 
      array(
			'name'          =>  esc_html__( 'Services Page', 'freeagent' ),
			'id'            => 'sidebar-service',
			'description'   =>  esc_html__( 'Add widgets here to appear in Services page.', 'freeagent' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
	  )
    );

}
add_action( 'widgets_init', 'jws_widgets_init' );

/**
 * Add Theme Option
 */

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function jws_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jws_content_width', 640 );
}

add_action( 'after_setup_theme', 'jws_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
if(!function_exists('jws_scripts')) {
  function jws_scripts() {
    
     global $jws_option;  
     $vertion = wp_get_theme()->get( 'Version' );
     $version = wp_get_theme()->get( 'Version' );
     wp_enqueue_style( 'jws-jwsicon', JWS_URI_PATH . '/assets/font/jws_icon/jwsicon.css', array(), $vertion, 'all' ); 
     wp_enqueue_style( 'jws-default', JWS_URI_PATH . '/assets/css/default.css', array(), $vertion , 'all' );
     wp_enqueue_style( 'select2-min', JWS_URI_PATH . '/assets/css/select2.min.css', array(), $vertion , 'all' ); 
     wp_enqueue_style( 'magnificPopup', JWS_URI_PATH.'/assets/css/magnificPopup.css', array(), $vertion, 'all' );   
     wp_enqueue_style( 'slick', JWS_URI_PATH . '/assets/css/slick.css' );     
     wp_enqueue_style( 'awesome', JWS_URI_PATH . '/assets/font/awesome/awesome.css' );   
     wp_register_style( 'timeTo', get_template_directory_uri() . '/assets/css/timeTo.css' );
    wp_register_style( 'mediaelementplayer', JWS_URI_PATH.'/assets/css/mediaelementplayer.css', array(), wp_get_theme()->get( 'Version' ), 'all' );

     /** Load our main stylesheet. It is generated with less in upload folder **/ 
     $upload_dir = wp_upload_dir();
     $style_dir = $upload_dir['baseurl'];
     $siteid = get_current_blog_id();
     $filename = 'jws-style.css';
     if (file_exists($upload_dir['basedir'] . '/'.$filename.'')) {
        wp_enqueue_style(
            'jws-style',
            set_url_scheme($style_dir). '/'.$filename.'',
            ['elementor-frontend','e-animations'],
            filemtime($upload_dir['basedir'] . '/'.$filename.'')
        );
     } else {
        wp_enqueue_style( 'jws-style', JWS_URI_PATH . '/assets/css/style.css', array(), $vertion, 'all'  );
        wp_enqueue_style( 'jws-style-reset', JWS_URI_PATH . '/assets/css/style-reset.css', array(), $vertion, 'all'  );
        wp_enqueue_style( 'jws-google-fonts', '//fonts.googleapis.com/css?family=Space%20Grotesk:800,700,600,500,400,300', false ); 
				
     } 
  
     
  
     
     
    wp_register_style( 'lightgallery', JWS_URI_PATH . '/assets/css/lightgallery.css' );
     /** Start Woocommerce **/
     wp_register_style( 'owl-carousel', JWS_URI_PATH.'/assets/css/owl.carousel.css', array(), $vertion, 'all' );
     wp_register_script( 'owl-carousel', JWS_URI_PATH. '/assets/js/lib/owl.carousel.js', [], '', true ); 
     wp_register_script( 'jws-woocommerce', JWS_URI_PATH. '/assets/js/woocommerce/woocommerce.js', [], '', true );
     wp_register_script( 'jws-mini-cart', JWS_URI_PATH. '/assets/js/widget-js/mini-cart.js', [], '', true );   

     if (class_exists('Woocommerce')) {
            
        if(is_product() || is_shop() || is_tax() || is_cart() || is_checkout()){
         wp_enqueue_script( 'jws-woocommerce');
             wp_enqueue_style('owl-carousel');
            wp_enqueue_script('owl-carousel');    
            wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
             wp_enqueue_script( 'jws-mini-cart');
            wp_register_script( 'jws-photoswipe', JWS_URI_PATH. '/assets/js/woocommerce/jws-photoswipe-bundle.min.js',  '', true );
            
	       
        }
      
     }else {
        wp_enqueue_script( 'js-cookie-min', JWS_URI_PATH. '/assets/js/lib/js.cookie.min.js', [], $vertion, true );
     }
     

     
     

	if ( wp_script_is( 'wc-add-to-cart-variation', 'registered' ) && ! wp_script_is( 'wc-add-to-cart-variation', 'enqueued' ) ) {
		wp_enqueue_script( 'wc-add-to-cart-variation' );
	}
    wp_enqueue_script( 'appear', JWS_URI_PATH. '/assets/js/lib/appear.min.js', array('js-cookie'), '', true );
   
     /**
     *  New Js
     */    
     
     if(is_archive()|| is_single()){
       wp_enqueue_script('freelance_js');
       
     }
     if(is_archive()){
      
       wp_enqueue_script('jws-google-maps-api');
     }
    wp_enqueue_script( 'fastdom', JWS_URI_PATH. '/assets/js/lib/fastdom.min.js', [], '', true ); 
     wp_enqueue_script( 'fontfaceobserver', JWS_URI_PATH. '/assets/js/lib/fontfaceobserver.js', [], '', true ); 
     wp_enqueue_script( 'splittext', JWS_URI_PATH. '/assets/js/lib/gsap/splittext.min.js', [], '', true ); 
     wp_enqueue_script( 'scrolltrigger', JWS_URI_PATH. '/assets/js/lib/gsap/ScrollTrigger.min.js', [], '', true ); 
     wp_enqueue_script( 'gsap', JWS_URI_PATH. '/assets/js/lib/gsap/gsap.min.js', [], '', true );
     wp_register_script( 'freelance_js', JWS_URI_PATH. '/assets/js/freelance_js.js', [], '', true );
     
     wp_register_script( 'jws-slider-crow', JWS_URI_PATH. '/assets/js/lib/jws_slider_crow.js', [] , $vertion, true );
     wp_register_script( 'isotope', JWS_URI_PATH. '/assets/js/lib/isotope.js', [], $vertion, true );
     wp_register_script( 'instafeed', JWS_URI_PATH. '/assets/js/lib/instafeed.js', [], $vertion, true );
     wp_register_script( 'lightgallery-all', JWS_URI_PATH. '/assets/js/lib/lightgallery-all.js', [],$vertion, true );
     wp_enqueue_script( 'magnificPopup', JWS_URI_PATH. '/assets/js/lib/magnificPopup.js', [] , $vertion, true );
     wp_register_script( 'jquery.countdown', JWS_URI_PATH. '/assets/js/lib/jquery.countdown.min.js', [] , $vertion, true );
     wp_register_script( 'jws-canvas', JWS_URI_PATH. '/assets/js/widget-js/jws-canvas.js', [] , $vertion, true );
     wp_register_script( 'jws-mini-cart', JWS_URI_PATH. '/assets/js/widget-js/mini-cart.js', [] , $vertion, true );
     wp_register_script( 'imageload', JWS_URI_PATH. '/assets/js/lib/image_load.js', [], $vertion, true );
     wp_enqueue_script( 'select2-min', JWS_URI_PATH. '/assets/js/lib/select2.min.js', [] , $vertion, true );
     wp_register_script( 'anime', JWS_URI_PATH. '/assets/js/lib/anime.js', [] , $vertion, true );      
     wp_register_script( 'easypiechart', JWS_URI_PATH. '/assets/js/lib/easypiechart.min.js', array('jquery'), null, true );
     wp_register_script( 'chart', JWS_URI_PATH. '/assets/js/lib/chart.js', array('jquery'), null , true ); 
     wp_register_script( 'jquery-scroll', JWS_URI_PATH. '/assets/js/lib/SmoothScroll.js', array('jquery'), null , true );
     wp_register_script( 'jquery-time-to', JWS_URI_PATH. '/assets/js/lib/jquery.time-to.min.js', array('jquery'), null , true ); 
     wp_register_script( 'media-element', JWS_URI_PATH. '/assets/js/lib/mediaelement-and-player.js', array('js-cookie'), '', true );  
     wp_register_script( 'swiper', JWS_URI_PATH. '/assets/js/lib/swiper.js', [] , $vertion, true );
      
     /**
     *  Use for widget
     */
     wp_enqueue_script( 'jws-elementor-widget', JWS_URI_PATH. '/assets/js/widget-js/elementor_widget.js', [], $vertion, true );
     wp_enqueue_script( 'jws-function', JWS_URI_PATH. '/assets/js/function.js' , [], $version, true );  
     wp_enqueue_script( 'jws-e-widget', JWS_URI_PATH. '/assets/js/widget-js/e_widget.js', [], $version, true );
       

     /**
     *  Use for all theme
     */
     wp_enqueue_script( 'slick-min', JWS_URI_PATH. '/assets/js/lib/slick.min.js', [], $vertion, true );  
     wp_enqueue_script( 'jws-main', JWS_URI_PATH. '/assets/js/main.js' , [], $vertion, true );


     /**
     *  Add google services
     */

	$api_url     = 'https://maps.googleapis.com';
	
	if ( isset( $jws_option['google_api'] ) && '' !== $jws_option['google_api'] ) {
		$url      = $api_url . '/maps/api/js?key=' . $jws_option['google_api'].'&libraries=places&language=en';
		} else {
        $url = $api_url . '/maps/api/js';
	}
    wp_register_script( 'jws-google-maps-api', $url, [ 'jquery' ],'', true );   

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    	wp_enqueue_script( 'comment-reply' );
    }
    /**
     *  Add validate js
     */
    
    // Convert the PHP date format into jQuery UI's format.
	$datepicker_date_format = str_replace(
		array(
			'd',
			'j',
			'l',
			'z', // Day.
			'F',
			'M',
			'n',
			'm', // Month.
			'Y',
			'y', // Year.
		),
		array(
			'dd',
			'd',
			'DD',
			'o',
			'MM',
			'M',
			'm',
			'mm',
			'yy',
			'y',
		),
		get_option( 'date_format' )
	); 
  
    wp_localize_script(
			'jws-main',
			'jws_script',
			array(
                'is_multisite' => is_multisite(),
		        'current_blog_id' => get_current_blog_id(),
				'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'jws_particles_url'  => JWS_URI_PATH . '/assets/js/lib/particles.min.js',
                'theme_path' => JWS_URI_PATH,
                'instaram_tk'  => (isset($jws_option['instagram_token']) && !empty($jws_option['instagram_token'])) ? $jws_option['instagram_token'] : '',
                'nrel_api'  => (isset($jws_option['nrel_api']) && !empty($jws_option['nrel_api'])) ? $jws_option['nrel_api'] : '',
                'add_to_cart_text'  =>  esc_html__('Add to cart','freeagent'),
                'location_place'  =>  esc_html__('City, State or Zip','freeagent'),
                'metera'  =>  esc_html__('Very weak','freeagent'),
                'meterb'  =>  esc_html__('Weak','freeagent'),
                'meterc'  =>  esc_html__('Medium','freeagent'),
                'meterd'  =>  esc_html__('Strong','freeagent'),
                'view_more'  =>  esc_html__('View more','freeagent'),
                'view_less'  =>  esc_html__('View Less','freeagent'),
                 'show_more'  =>  esc_html__('Show more','freeagent'),
                'show_less'  =>  esc_html__('Show Less','freeagent'),
                'nextNonce' => wp_create_nonce('myajax-next-nonce'),
                'data_format' => $datepicker_date_format,
                'cart_url' => class_exists('Woocommerce') ? wc_get_cart_url() : '',
                

			)
	);
     wp_enqueue_style( 'jws-style-theme', get_stylesheet_uri());  
    if(function_exists('jws_custom_css')) {
       wp_add_inline_style('jws-style-theme', jws_custom_css()); 
    } 	
    
	$page_css = get_post_meta( intval( get_the_ID() ), 'page_css', true );
    wp_add_inline_style( 'jws-style-theme',  $page_css  ); 
        
}
add_action( 'wp_enqueue_scripts', 'jws_scripts' );  
} 

add_action('redux/page/jws_option/enqueue', 'jws_theme_redux_custom_css');

function jws_theme_redux_custom_css() {
     wp_enqueue_style('jws-admin-redux-styles', JWS_URI_PATH.'/assets/css/admin_redux.css'); 
}

// Update CSS within in Admin
function jws_admin_style() {
  wp_enqueue_style('jws-admin-styles', JWS_URI_PATH.'/assets/css/admin.css');   
  wp_enqueue_style( 'jws-icon', JWS_URI_PATH . '/assets/font/jws_icon/jwsicon.css', array(), wp_get_theme()->get( 'Version' ), 'all' );   
  wp_enqueue_style( 'awesome', JWS_URI_PATH . '/assets/font/awesome/awesome.css', array(), wp_get_theme()->get( 'Version' ), 'all' ); 
  wp_enqueue_script( 'jws-admin', JWS_URI_PATH. '/assets/js/admin.js', [], '', true ); 
  //wp_enqueue_style( 'select2-min', JWS_URI_PATH . '/assets/css/select2.min.css', array(), wp_get_theme()->get( 'Version' )  , 'all' ); 
 // wp_enqueue_script( 'select2-min', JWS_URI_PATH. '/assets/js/lib/select2.min.js', [], wp_get_theme()->get( 'Version' ) , false );  
  wp_register_script( 'instascan', JWS_URI_PATH. '/assets/js/lib/instascan.min.js', [] , wp_get_theme()->get( 'Version' ) , true );
  	//Geocoding google
    global $jws_option; 
    $api_url     = 'https://maps.googleapis.com';
	
     if ( isset( $jws_option['google_api'] ) && '' !== $jws_option['google_api'] ) {
   
		$url      = $api_url . '/maps/api/js?key=' . $jws_option['google_api'].'&libraries=places&language=en';
        
	} else {

		$url = $api_url . '/maps/api/js';
     }

  wp_enqueue_script( 'jws_googleapis_js_places', $url, array( 'jquery' ), false, true ); 
  
  wp_localize_script(
	'jws-admin',
	'jws_script',
	array(
        'current_blog_id' => get_current_blog_id(),
		'ajax_url'        => admin_url( 'admin-ajax.php' ),
	)
  ); 
   	
}
add_action('admin_enqueue_scripts', 'jws_admin_style' , 3);


/**
 * Enhance the theme by hooking into WordPress.
*/
require JWS_ABS_PATH . '/inc/inc.php';

/* Disable the Widgets Block Editor*/
function widget_theme_support() {
remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'widget_theme_support' );

/**
 * Add Woocommerce To Theme
*/
if (class_exists('Woocommerce')) {   
    require_once JWS_ABS_PATH . '/inc/woocommerce-function.php';
    require_once JWS_ABS_PATH . '/woocommerce/variation-gallery.php'; 
	require_once JWS_ABS_PATH . '/woocommerce/wc-template-function.php'; 
    require_once JWS_ABS_PATH . '/woocommerce/wishlist/wishlist.php';
} 
if( ! function_exists( 'jws_photoswipe_template' ) && class_exists('Woocommerce')) {
	function jws_photoswipe_template() {
		get_template_part('woocommerce/single-product/photo-swipe-template');
	}     
}

/**
 * active Classic editor
 **/


global $jws_option;  
if(((isset($jws_option['active-class-editor']) && $jws_option['active-class-editor']) ) || !isset($jws_option['active-class-editor']) ){
 add_filter('use_block_editor_for_post', '__return_false', 10);
}
/*Page Title*/
function myshortcode_title( ){
    if(is_404()){
       return esc_html__( 'Page not Found.', 'freeagent' );
    }elseif(is_search()){
      return esc_html__('Search results for: ', 'freeagent') . get_search_query();
    }else{
        return get_the_title();
   }
}

if(function_exists('insert_shortcode')) insert_shortcode('page_title', 'myshortcode_title');


/*Featured Jobs*/
function toggle_featured_status() {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $is_featured = isset($_POST['is_featured']) ? intval($_POST['is_featured']) : 0;

    // Toggle the featured status
    update_post_meta($post_id, '_featured', $is_featured ? 0 : 1);

}
add_action('wp_ajax_toggle_featured_status', 'toggle_featured_status');
add_action('wp_ajax_nopriv_toggle_featured_status', 'toggle_featured_status');

/*Current year*/
function current_year( ){
    return date('Y');
}

if(function_exists('insert_shortcode')) insert_shortcode('year', 'current_year');

function display_user_uploaded_image() {
    // Get the current user ID
    $user_id = get_current_user_id();

    // Retrieve the uploaded image URL saved in user meta
    $image_url = get_user_meta($user_id, 'group_67592a576e38d', true);

    if ($image_url) {
        echo '<div class="user-image">';
        echo '<img src="' . esc_url($image_url) . '" alt="User Uploaded Image" style="max-width: 100%; height: auto; border-radius: 0%;">';
        echo '</div>';
    } else {
        echo '<p>No image uploaded yet.</p>';
    }
}
add_shortcode('show_user_uploaded_image', 'display_user_uploaded_image');

add_action('fluentform_submission_inserted', function ($entryId, $formId) {
    // Replace with your specific form ID
    $signup_form_id = 5; 

    if ($formId == $signup_form_id) {
        $entry = wpFluent()->table('fluentform_submissions')->find($entryId);
        $uploaded_image_url = $entry->response['group_67592a576e38d']; // Replace with your upload field key

        $user_id = get_current_user_id(); // Get user ID
        update_user_meta($user_id, 'group_67592a576e38d', $uploaded_image_url); // Save image URL to user meta
    }
}, 10, 2);
function custom_edit_account_shortcode() {
    if (is_user_logged_in()) {
        ob_start();
        wc_get_template('myaccount/form-edit-account.php');
        return ob_get_clean();
    } else {
        return 'You must be logged in to edit your account.';
    }
}
add_shortcode('edit_account_form', 'custom_edit_account_shortcode');


/** Custom Coding by Nikhil */

// add_action('user_register', 'custom_user_register_action', 999);
/**
 * Function to handle actions after a user is registered
 *
 * @param int $user_id The ID of the newly registered user.
 */
function custom_user_register_action($user_id) {
    // Get user data
    
    $user = get_userdata($user_id);
    $user_data = (array) $user->data;
    $user_meta = get_user_meta($user_id);
    $merged_data = array_merge($user_data, $user_meta);

    update_option('test_user', $merged_data);
}

add_action('wp_footer','custom_footer_code');
function custom_footer_code(){
  $html = site_url();
  ?>
  <script>
    console.log(<?php echo json_encode($html)?>);    
  </script>
  <?php  
}
function custom_mail($to_email, $subject, $formdata,$client_name){
  global $jws_option,$newJobID;
  $full_url = esc_url(get_permalink($newJobID));
  $looking_for = $formdata[$jws_option['client_title']];
  $country = $formdata[$jws_option['client_country_field']];
  $city = $formdata[$jws_option['client_city_field']];
  $venue = $formdata[$jws_option['client_venue_field']];
  $service_type = $formdata[$jws_option['client_service_type_field']];
  $gender = $formdata[$jws_option['client_gender_field']];
  $date_event = $formdata[$jws_option['client_date_event_field']];
  $hours_req = $formdata[$jws_option['client_hours_field']];
  $budget = $formdata[$jws_option['client_budget_field']];
  $spec_req = $formdata[$jws_option['client_spec_req_field']];

  $html = '
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Client Request Notification</title>
    </head>
    <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
        <table width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; background: #fff; border: 1px solid #ddd; padding: 20px;">
            <tr>
                <td align="center">
                    <img src="'.site_url().'/wp-content/uploads/2023/11/Group-59-1-e1725786518693.png" alt="Paidlancers" style="max-width: 150px;">
                </td>
            </tr>
            <tr>
                <td>
                    <p>Dear Professional,</p>
                    <p>We are excited to inform you that a client has submitted a request for your service.</p>
                    <p>Read the details below before responding to the client by clicking the link <a href="'.$full_url.'" style="color: #0073e6; text-decoration: none;">here.</a></p>
                    <p>Client has submitted the following details:</p>                    
                    <p><strong>Client Name:</strong> ' . $client_name . '</p>
                    <p><strong>I want to hire a:</strong> ' . $looking_for . '</p>
                    <p><strong>Country:</strong> ' . $country . '</p>
                    <p><strong>City:</strong> ' . $city . '</p>
                    <p><strong>Venue:</strong> ' . $venue . '</p>
                    <p><strong>Services Required:</strong> ' . implode(' / ',$service_type) . '</p>
                    <p><strong>Preference:</strong> ' . $gender . '</p>
                    <p><strong>Date of event / service:</strong> ' . $date_event . '</p>
                    <p><strong>No. of hours service required for:</strong> ' . $hours_req . '</p>
                    <p><strong>Budget:</strong> £' . $budget . '</p>
                    <p><strong>Any specific requirements:</strong> ' . $spec_req . '</p>

                    <p>If you are happy to proceed, then you can contact the client by clicking the link <a href="'.$full_url.'" style="color: #0073e6; text-decoration: none;">here.</a> <a style="color: #0073e6; text-decoration: none;" href="'.$full_url.'">'.$full_url.'</a></p>

                    <p>Best of luck.</p>
                    <p>Kind regards,</p>
                    <p>The Paidlancers Team.</p>
                    <p><a href="https://www.paidlancers.com" style="color: #0073e6; text-decoration: none;">www.paidlancers.com</a></p>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; background: #f4f4f4; font-size: 12px; text-align: center;">
                    <p>This email is a system-generated notification as you have created an account on Paidlancers. If you do not recognize this activity, then please do not click the verification link. If you wish to be removed from our records, then please contact us by writing an email. Any questions, please email <a href="mailto:team@paidlancers.com" style="color: #0073e6; text-decoration: none;">team@paidlancers.com</a></p>
                </td>
            </tr>
        </table>
    </body>
    </html>
  ';
  $headers = array(
    'Content-Type: text/html; charset=UTF-8',
  );  
  update_option('test2',$html);
  wp_mail( $to_email, $subject, $html, $headers );  
}
/**
 * Retrieve the label of a specific field from a Fluent Form (Custom by Nikhil).
 *
 * This function takes a form ID and a field ID as input and returns the label
 * of the corresponding field. It uses Fluent Forms API to fetch form details
 * and fields.
 *
 * @param int $form_id The ID of the Fluent Form.
 * @param string $field_id The ID of the field within the form.
 * @return string|false The label of the field if found, false otherwise.
 */
function get_label_from_fieldId_ff($form_id, $field_id) {
  $formApi = fluentFormApi('forms')->form($form_id);

  if (!$formApi || !$formApi->renderable()) {
      return false;
  }

  $fields = $formApi->fields();
  $fields = $fields['fields'];
  foreach ($fields as $field) {
      if (isset($field['attributes']) && $field['attributes']['name'] === $field_id) {
          return $field['settings']['label'] ?? false;
      }
  }

  return false; // Return false if field ID not found
}


add_action('fluentform/user_registration_completed', function ($userId, $feed, $entry, $form)
{  
  global $jws_option;
  if(isset($jws_option['professional_form_id']) && !empty($jws_option['professional_form_id']) && isset($jws_option['client_form_id']) && !empty($jws_option['client_form_id'])){
    $user = get_userdata($userId);  
    $freelancer_name = get_user_meta($userId,'nickname',true);
    if($user && $form['id'] == $jws_option['professional_form_id']){
      $my_post = array(
        'post_title' => $freelancer_name,
        'post_status' => 'publish',
        'post_author' => $userId,
        'post_type' => 'freelancers'
      );
      $freelancer_id = wp_insert_post($my_post);
      $professtional_title_field = $jws_option['professional_title']; 
      $professtional_also_titles_field= $jws_option['professional_form_fields']; 
      $professional_brief_description_field = $jws_option['professional_brief_description_field']; 
      $professional_ft_image_field = $jws_option['professional_ft_image_field']; 
  
      if ($freelancer_id && !is_wp_error($freelancer_id) && isset($professtional_title_field)) {
        $form_data = json_decode($entry->response);      
        
        foreach ($form_data as $key => $value) {
          if($key == $professional_ft_image_field){
            $image_url = $value[0];
            $attachment_id = upload_image_from_url($image_url, $freelancer_id);
            if ($attachment_id) {
              set_post_thumbnail($freelancer_id, $attachment_id);
            }
          } else if($key==$professtional_title_field){
            update_field('freelancers_position', $value, $freelancer_id);
          } else if(in_array($key, $professtional_also_titles_field)){
            update_post_meta($freelancer_id, 'professional_skills', $value);
          } else if($key == $professional_brief_description_field){
            $content = !empty($value) ? $value : '';
            wp_update_post([
              'ID' => $freelancer_id,
              'post_content' => $content
            ], true);
          } else {
            update_post_meta($freelancer_id, $key, $value);
          }
        }
      }    
    } else if($user && $form['id'] == $jws_option['client_form_id']){
      $client_name = get_user_meta($userId,'nickname',true);
      $my_post = array(
        'post_title' => $client_name,
        'post_status' => 'publish',
        'post_author' => $userId,
        'post_type' => 'employers'
      );
      $client_id = wp_insert_post($my_post);
      if($client_id && !is_wp_error($client_id)):
        $client_title_field = $jws_option['client_title'];
        if(isset($client_title_field)):          
          $form_data = json_decode($entry->response, true);
          if(isset($form_data[$client_title_field]) && !empty($form_data[$client_title_field])):
            $my_post = array(
              'post_title' => $form_data[$client_title_field],
              'post_status' => 'publish',
              'post_author' => $userId,
              'post_type' => 'jobs'
            );
            $job_id = wp_insert_post($my_post);  
            global $newJobID;
            $newJobID = $job_id;
            if($job_id && !is_wp_error($job_id)):
              foreach ($form_data as $key => $value) {
                update_post_meta($job_id, $key, $value);
              }
              update_post_meta($job_id, 'job_type', 2);
              sendmail_to_professionals($user,$form_data,$client_name);
            endif;          
          endif;
        endif;
      endif;
    }
  }
}, 999, 4);

/** Function to send emails to the professionals when a client account is approved */
function sendmail_to_professionals($user,$formdata,$client_name){
  global $jws_option;
  $client_title_field = $jws_option['client_title'];  
  $client_country_field = $jws_option['client_country_field'];  
  $professtional_country_field = $jws_option['professional_country_field'];  
  $client_title = $formdata[$client_title_field];
  
  $to_emails = [];
  $professionals = [
    'post_type' =>'freelancers',
		'posts_per_page' => -1,  
		'post_status' => 'publish',
    'meta_query'     => array(
      'relation' => 'AND',
        array(
          'key'     => $professtional_country_field,
          'value'   => $formdata[$client_country_field],
          'compare' => '=',
        ), 
        array(
          'key'     => 'freelancers_position',
          'value'   => $client_title,
          'compare' => '=',
      ),
    ),
  ];
  $professionals = new WP_Query($professionals);
  if(!$professionals->have_posts()){
    $professionals = [
      'post_type' =>'freelancers',
      'posts_per_page' => -1,  
      'post_status' => 'publish',
      'meta_query'     => array(
          'relation' => 'AND',
          array(
            'key'     => $professtional_country_field,
            'value'   => $formdata[$client_country_field],
            'compare' => '=',
          ),          
          array(
            'key'     => 'professional_skills',
            'value'   => serialize($client_title), 
            'compare' => 'LIKE',
          ),
      ),
    ];
    $professionals = new WP_Query($professionals);    
  }
  if($professionals->have_posts()){
    while ($professionals->have_posts()) {
      $professionals->the_post();
      $email = get_post_meta(get_the_ID(), 'email', true);
      if($email){
        $to_emails[] = $email;
      }
    }
    wp_reset_postdata();
  }
    
  foreach ($to_emails as $to_email) {
    custom_mail($to_email, 'A new job is posted on PaidLancers', $formdata,$client_name);
    // wp_mail( $to_email, 'A new job is posted on PaidLancers', 'A client is looking for a '.$client_title.' in '.$formdata[$client_country_field]);
  }
}

/** Upload image by URL custom NS */
function upload_image_from_url($image_url, $post_id) {
  $image_data = file_get_contents($image_url);
  if (!$image_data) {
      return false; // Return false if failed to get image data
  }

  $random_name = uniqid(rand(1000000000, 9999999999) . '_', true) . '.' . pathinfo($image_url, PATHINFO_EXTENSION);

  $upload_dir = wp_upload_dir();
  $file_path = $upload_dir['path'] . '/' . $random_name;

  file_put_contents($file_path, $image_data);

  $attachment = array(
      'post_mime_type' => mime_content_type($file_path),
      'post_title'     => preg_replace('/\.[^.]+$/', '', $random_name),
      'post_content'   => '',
      'post_status'    => 'inherit'
  );

  $attachment_id = wp_insert_attachment($attachment, $file_path, $post_id);

  require_once(ABSPATH . 'wp-admin/includes/image.php');
  $attachment_metadata = wp_generate_attachment_metadata($attachment_id, $file_path);
  wp_update_attachment_metadata($attachment_id, $attachment_metadata);

  return $attachment_id;
}

function job_top_meta_subtitle($atts){
  global $post;        
  $subtitle = '<p class="job_top_meta_subtitle">Job posted by: '.get_the_author_firstname().'</p>';
  return !empty($subtitle) ? $subtitle : '';
}
add_shortcode( 'job_top_meta_subtitle', 'job_top_meta_subtitle' );

function professional_dashboard($atts){
  ob_start();
  require 'professional-dashboard-content.php';
  $html = ob_get_clean();
  return $html;
}
add_shortcode( 'professional_dashboard', 'professional_dashboard' );

function client_dashboard($atts){
  ob_start();
  require 'client-dashboard-content.php';
  $html = ob_get_clean();
  return $html;
}
add_shortcode( 'client_dashboard', 'client_dashboard' );

add_filter( 'auto_update_plugin', '__return_false' );

