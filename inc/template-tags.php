<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} 
// **********************************************************************// 
// ! Add favicon 
// **********************************************************************// 
if (!function_exists('jws_favicon')) {
    function jws_favicon()
    {

        if (function_exists('has_site_icon') && has_site_icon()) return '';

        // Get the favicon.
        $favicon = '';


        global $jws_option;
        
        if(isset($jws_option['favicon']) && !empty($jws_option['favicon'])) {
            $favicon = $jws_option['favicon']['url'];
        }

        ?>
        <link rel="shortcut icon" href="<?php echo esc_attr($favicon); ?>">
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_attr($favicon); ?>">
        <?php
    }

    add_action('wp_head', 'jws_favicon');
}

if (!function_exists('jws_logo_url')) {
    function jws_logo_url()
    {

        $logo = '';
        global $jws_option;
        
        if(isset($jws_option['logo']) && !empty($jws_option['logo'])) {
            if(!empty($jws_option['logo'])) {
                $logo = $jws_option['logo']['url'];
            }
        }
        
        return $logo;

      
    }
}

//Lets add Open Graph Meta Info
 
function jws_insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="'.get_bloginfo( 'name' ).'"/>';
    if(has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        echo '<meta property="og:image" content="' . esc_attr( !empty($thumbnail_src[0]) ? $thumbnail_src[0] : '' ) . '"/>';
        echo '<meta property="og:image:secure_url" content="' . esc_attr( !empty($thumbnail_src[0]) ? $thumbnail_src[0] : ''  ) . '">';
        echo '<meta property="og:image:width" content="500">';
        echo '<meta property="og:image:height" content="400">';
        echo '<meta property="og:description" content="'.get_the_excerpt().'">';
    }

    echo "
";
}
add_action( 'wp_head', 'jws_insert_fb_in_head', 5 );


/**
 * Add extra initialisation for Contact 7 Form in Elementor popups.
 **/
add_action( 'wp_footer', 'jws_back_top_top'); 
function jws_back_top_top() {
    global $jws_option;
    $layout = (isset($jws_option['to-top-layout'])) ? $jws_option['to-top-layout'] : 'with-shadow';
    $class = 'backToTop fas fa-arrow-up ';
    $class .= $layout;
    if(isset($jws_option['box-change-style']) && $jws_option['box-change-style']) {
        require_once JWS_ABS_PATH.'/inc/box-style.php';
    }
    ?>
        <a href="#" class="<?php echo esc_attr($class); ?>"></a>
    <?php
}


/**
 * Add toolbar for mobile.
 **/
add_action( 'wp_footer', 'jws_form_login_popup'); 
function jws_form_login_popup() {
    global $jws_option,$post;
    $login_page = $jws_option['login_form_page'];
    $current_page_id = $post->ID;
    if($login_page == $current_page_id) return;
    ?>    
        <div class="jws-form-login-popup">
            <div class="jws-form-overlay"></div>
            <div class="jws-form-content">
                <div class="jws-close"><i aria-hidden="true" class="jws-icon-cross"></i></div>
                <?php jws_get_content_form_login(true,true,'login',''); ?>
            </div>
        </div>
    <?php
}



/**
 * Add newseleter popup.
 **/
add_action( 'wp_footer', 'jws_form_newsletter_popup'); 
function jws_form_newsletter_popup() {
    global $jws_option;
    if(jws_theme_get_option('newsletter_enble') && !is_page( 'Landing Page' )) :
    ?>
        <div class="jws-newsletter-popup mfp-hide">
            <div class="jws-form-content">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-12 newsletter-bg hidden_mobile">
                    
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="newsletter-content">
                        <?php 
                            if(isset($jws_option['newsletter_content'])){
                                 echo do_shortcode($jws_option['newsletter_content']);
                            }
                            if(isset($jws_option['newsletter_no_thank'])){
                                echo '<a href="javascript:void(0)" class="sub-new-nothank">'.$jws_option['newsletter_no_thank'].'</a>';
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>    
    <?php
}


/**
 * Add extra initialisation for Contact 7 Form in Elementor popups.
 **/
function jws_ct_body_classes( $classes ) {
    global $jws_option;
    $layout = 'default';
    $classes[] = 'button-'.$layout;
    if ( !is_user_logged_in() ) {
            $classes[] = 'user-not-logged-in';
    }

    
       $classes[] = 'single-product-default'; 
    
    
    if(!did_action( 'elementor/loaded' )) {
       $classes[] = 'not-elementor';  
    }
    /** Footer **/
    if(isset($jws_option['footer-switch-parallax']) && $jws_option['footer-switch-parallax']) {
    $classes[] = 'footer-parallax';
    }
    /** rtl **/
    $classes[] = (isset($jws_option['rtl']) && $jws_option['rtl']) ? 'rtl' : '';
    /** toolbar **/
   
    
    
      
    return $classes;
}
add_filter( 'body_class','jws_ct_body_classes' );

function jws_mini_cart_content2() { ?>
        <div class="jws-mini-cart-wrapper">
            <div class="jws-cart-sidebar">
                <div class="jws_cart_content">
                </div>
            </div>
            <div class="jws-cart-overlay"></div>
        </div>   
<?php }
if (class_exists('Woocommerce')) { 
   add_action( 'wp_footer', 'jws_mini_cart_content2' ); 
}


function jws_filter_backups_demos($demos)
	{
		$demos_array = array(
			'freeagent' => array(
				'title' => esc_html__('freeagent', 'freeagent'),
				'screenshot' => 'https://jwsuperthemes.com/import_demo/freeagent/screenshot.jpg',
				'preview_link' => 'https://freeagent.gavencreative.com/',
			),
		);
        $download_url = 'https://jwsuperthemes.com/import_demo/freeagent/download-script/';
		foreach ($demos_array as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);
			$demos[$demo->get_id()] = $demo;
			unset($demo);
		}
		return $demos;
}
add_filter('fw:ext:backups-demo:demos', 'jws_filter_backups_demos');
if (!function_exists('jws_deactivate_plugins')){
	function jws_deactivate_plugins() {
		deactivate_plugins(array(
			'brizy/brizy.php'
		));    
		
	}
}
add_action( 'admin_init', 'jws_deactivate_plugins' );


if(class_exists('jws_theme_jwsLove') && !function_exists('post_favorite') ) {
    function post_favorite($return = '',$unit = '',$show_icon = true) {
    	global $post_favorite , $post;
        $love_count = get_post_meta(get_the_ID(), '_jws_love', true);
        if($love_count == '1') {
           $unit = esc_html__(' like','freeagent'); 
        }else{
           $unit = esc_html__(' likes','freeagent');  
        }
    	if($return == 'return') {
    		return $post_favorite->add_love($unit,$show_icon);
    	} else {
    		echo ''.$post_favorite->add_love($unit,$show_icon);
    	}
    }    
}

function jws_store_location_search($atts) {
     $a = shortcode_atts( array(
		'url' => '',
	), $atts );
    ob_start();
    ?>
        <form class="jws-wpsl-search" action="<?php  echo ''.$a['url']; ?>" method="get">
            <input name="search-location" type="text" autocomplete="off" placeholder="<?php echo esc_attr__('Enter Starting Address...','freeagent'); ?>" />
            <button type="submit"><?php echo esc_html__('Find Us','freeagent'); ?></button>
        </form>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return ent2ncr($output);
}   

if(function_exists('insert_shortcode')) {
    insert_shortcode('wpsl_search','jws_store_location_search');
}


if(class_exists('jws_theme_jwsLove') && !function_exists('post_favorite') ) {
    function post_favorite($return = '',$unit = '',$show_icon = true) {
    	global $post_favorite , $post;
        $love_count = get_post_meta(get_the_ID(), '_jws_love', true);
        if($love_count == '1') {
           $unit = esc_html__(' like','freeagent'); 
        }else{
           $unit = esc_html__(' likes','freeagent');  
        }
    	if($return == 'return') {
    		return $post_favorite->add_love($unit,$show_icon);
    	} else {
    		echo ''.$post_favorite->add_love($unit,$show_icon);
    	}
    }    
}


if (defined('freeagentcore')) {

add_action( 'admin_menu', 'jws_add_menu_page' );


}

if(!function_exists('jws_add_menu_page')) {
  function jws_add_menu_page() {
    add_menu_page( 'Jws Settings', 'Jws Settings', 'manage_options', 'jws_settings.php', 'jws_settings', '', 3 );
  }  
}
function jws_settings() {return esc_html__('Jws Themes','freeagent');}

// Hide all posts from users who are not logged-in or are not administrators or members
function jws_exclude_posts($query) {
  global $jws_option;
  if(isset($jws_option['exclude-blog']) && !empty($jws_option['exclude-blog'])) {
     $result = array_map('intval', array_filter($jws_option['exclude-blog'], 'is_numeric'));
     if(!is_admin() && $query->is_main_query() && !is_single()){
        set_query_var('post__not_in', $result);
    }  
  }

}
add_action('pre_get_posts', 'jws_exclude_posts');


