<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} 
/**
 * Elementor class
 *
 * @package OceanWP WordPress theme
 */

if ( ! class_exists( 'Jws_Elementor' ) ) :

	class Jws_Elementor {

		/**
		 * Setup class.
		 *
		 * @since 1.4.0
		 */
		public function __construct() {
		  
		// Add filter Entrance Animate
        add_filter( 'elementor/controls/animations/additional_animations', array($this,'jws_scale_entrance_animations') );
		
        }
        
        
        public function jws_scale_entrance_animations() {
        	return array(
        	    'Scale Vertical Animations' => [
                    'scalein' => 'Scale In ',				
        		],
        	);
        }

		/**
		 * Get the header ID.
		 *
		 * @since 1.4.0
		 */   
		public static function get_header_id() {

			// Template
		    global $jws_option; 
            if(class_exists('Woocommerce')) {
                $is_shop = (is_shop() || is_product() || is_product_category() || is_product_tag());
            }
            $id = '';
            $page_header = (is_page()) ? get_post_meta(get_the_ID(), 'page_select_header', true) : '';
            $project_single_header = (is_single()) ? get_post_meta(get_the_ID(), 'project_select_header', true) : '';

                    if( is_404() && (isset($jws_option['select-header-404']) && !empty($jws_option['select-header-404'])) ){
                        $id =  $jws_option['select-header-404']; 
                     
                    }if(('projects' == get_post_type() && is_single()) && (isset($jws_option['select-header-project-single']) && !empty($jws_option['select-header-project-single']))) {
                       $id = $jws_option['select-header-project-single']; 
                    }elseif(((is_single()) && (get_post_type() == 'product')) && (isset($jws_option['select-single-shop-header']) && !empty($jws_option['select-single-shop-header']))){
                                       $id = $jws_option['select-single-shop-header'];  
                    }elseif((isset($is_shop) && !empty($is_shop)) && (isset($jws_option['select-header-shop']) && !empty($jws_option['select-header-shop']))){
                                       $id = $jws_option['select-header-shop'];  
                    }elseif(isset($project_single_header) && !empty($project_single_header)) {
                          $id = $project_single_header; 
                    }elseif(isset($page_header) && !empty($page_header)){
                                $id = $page_header; 
                    } 
					elseif(isset($jws_option['select-header']) || isset($jws_option['header_fixed'])) {
						if($jws_option['custom_header']&&isset($jws_option['select-header'])){
						 $id =  $jws_option['select-header'];   
						}else{
							$id =  $jws_option['header_fixed'];     
						}
						
				}    

			// If template is selected
			if ( ! empty( $id ) ) {
		
				return $id;
			}

			// Return
			return false;
			
		}
        
        /**
		 * Get the footer ID.
		 *
		 * @since 1.4.0
		 */
		public static function get_footer_id() {

			// Template
		    global $jws_option; 
            $is_shop = $id = '';
            if(class_exists('Woocommerce')) {
                $is_shop = (is_shop() || is_product() || is_product_category() || is_product_tag());
            }
            $page_footer = (is_page()) ? get_post_meta(get_the_ID(), 'page_select_footer', true) : '';
            if(isset($page_footer) && !empty($page_footer)){ 
                $id = $page_footer; 
            }elseif((isset($is_shop) && !empty($is_shop)) && (isset($jws_option['select-footer-shop']) && !empty($jws_option['select-footer-shop']))){
                    $id = $jws_option['select-footer-shop'];  
            }elseif (isset($jws_option['select-footer']) && !empty($jws_option['select-footer']) || isset($jws_option['footer_fixed']) && !empty($jws_option['footer_fixed'])) {
												
												if($jws_option['custom_footer']&&isset($jws_option['select-footer'])){
												$id =  $jws_option['select-footer'];   
												}else{
													$id =  $jws_option['footer_fixed'];     
												}
						}


			// If template is selected
			if ( ! empty( $id ) ) {
				return $id;
			}

			// Return
			return false;
			
		}
        
        /**
		 * Get the 404 ID.
		 *
		 * @since 1.4.0
		 */
		public static function get_404_id() {
			// Template
		    global $jws_option; 
            $id = '';
            if (isset($jws_option['select-content-404']) && !empty($jws_option['select-content-404'])) {
               $id = $jws_option['select-content-404'];
            }
			// If template is selected
			if ( ! empty( $id ) ) {
				return $id;
			}

			// Return
			return false;
			
		}

        
        /**
		 * Get the Title Bar ID.
		 *
		 * @since 1.4.0
		 */
	public static function get_titlebar_id() {

			// Template
		    global $jws_option; 
            $id = '';
            $page_titlebar = (is_page()) ? get_post_meta(get_the_ID(), 'page_select_titlebar', true) : '';
            $is_shop = '';
            $is_shop_single = '';
            if(class_exists('Woocommerce')) {
                $is_shop = (is_shop() || is_product_category() || is_product_tag());
                $is_shop_single = (is_product());
            }
            if((is_archive() && 'jobs' == get_post_type()) || (is_tax(array('jobs_cat', 'jobs_tag', 'jobs_duration', 'jobs_english_level', 'jobs_language', 'jobs_skill', 'jobs_locations', 'job_level'))) && (isset($jws_option['select-titlebar-jobs']) && !empty($jws_option['select-titlebar-jobs'])) ){
    
               $id = $jws_option['select-titlebar-jobs'];  
              
            }elseif((is_single() && 'jobs' == get_post_type()) && (isset($jws_option['select-single-titlebar-jobs']) && !empty($jws_option['select-single-titlebar-jobs'])) ){
    
               $id = $jws_option['select-single-titlebar-jobs'];  
              
            }elseif(((is_archive()) && 'employers' == get_post_type()) || (is_tax(array('employers_cat', 'employers_location', 'employers_size'))) && (isset($jws_option['select-titlebar-employers-archive']) && !empty($jws_option['select-titlebar-employers-archive'])) ){
    
               $id = $jws_option['select-titlebar-employers-archive']; 
              
            }elseif(((is_single()) && 'employers' == get_post_type()) && (isset($jws_option['select-titlebar-employers-single']) && !empty($jws_option['select-titlebar-employers-single'])) ){
    
               $id = $jws_option['select-titlebar-employers-single']; 
              
            }elseif(((is_archive()) && 'freelancers' == get_post_type()) || (is_tax(array('freelancers_cat', 'freelancers_skill', 'freelancers_english_level','freelancers_language','freelancers_type','freelancers_response_time','freelancers_location'))) && (isset($jws_option['select-titlebar-freelancers-archive']) && !empty($jws_option['select-titlebar-freelancers-archive'])) ){
    
               $id = $jws_option['select-titlebar-freelancers-archive']; 
              
            }elseif(((is_single()) && 'freelancers' == get_post_type()) && (isset($jws_option['select-titlebar-freelancers-single']) && !empty($jws_option['select-titlebar-freelancers-single'])) ){
    
               $id = $jws_option['select-titlebar-freelancers-single']; 
              
            }elseif((is_single() && 'services' == get_post_type())  && (isset($jws_option['select-titlebar-services-single']) && !empty($jws_option['select-titlebar-services-single'])) ){
    
               $id = $jws_option['select-titlebar-services-single'];  
              
            }elseif((is_archive() && 'services' == get_post_type()) || (is_tax(array('services_cat', 'services_tag', 'services_duration', 'services_english_level', 'services_language', 'services_skill', 'services_locations', 'job_level', 'employers_cat', 'employers_location', 'employers_size', 'services_response_time', 'services_delivery_time'))) && (isset($jws_option['select-titlebar-services-archive']) && !empty($jws_option['select-titlebar-services-archive'])) ){
    
               $id = $jws_option['select-titlebar-services-archive']; 
              
              
            }elseif((is_single() && 'post' == get_post_type()) && (isset($jws_option['select-titlebar-blog']) && !empty($jws_option['select-titlebar-blog'])) ){
    
               $id = $jws_option['select-titlebar-blog'];  
              
            }elseif(((is_archive() || is_home()) && 'post' == get_post_type()) && (isset($jws_option['select-titlebar-blog-archive']) && !empty($jws_option['select-titlebar-blog-archive'])) ){
    
               $id = $jws_option['select-titlebar-blog-archive']; 
              
            }elseif($is_shop && (isset($jws_option['select-titlebar-shop']) && !empty($jws_option['select-titlebar-shop'])) ){

                 $id = $jws_option['select-titlebar-shop']; 
            }elseif($is_shop_single && (isset($jws_option['select-titlebar-shop-single']) && !empty($jws_option['select-titlebar-shop-single'])) ){
    
               $id = $jws_option['select-titlebar-shop-single']; 
              
            }elseif(isset($page_titlebar) && !empty($page_titlebar)){
                
               $id = $page_titlebar; 
                
            } elseif(isset($jws_option['select-titlebar'])) {
                            $id = $jws_option['select-titlebar'];
             }
             
             
            $page_css = get_post_meta( intval( $id ), 'page_css', true );
            wp_add_inline_style( 'jws-style-theme',  $page_css  ); 

			// If template is selected
			if ( ! empty( $id ) ) {
				return $id;
			}
			// Return
			return false;
			
		}
        
       /**
		 * Get the footer ID.
		 *
		 * @since 1.4.0
		 */
		public static function get_blog_sidebar_single_id() {

			// Template
		    global $jws_option; 
            $id = '';

            if (isset($jws_option['select-sidebar-post-single']) && !empty($jws_option['select-sidebar-post-single'])) { 
                $id = $jws_option['select-sidebar-post-single']; 
            }


			// If template is selected
			if ( ! empty( $id ) ) {
				return $id;
			}

			// Return
			return false;
			
		}

		public static function get_sidebar_post_id() {
			// Template
		    global $jws_option; 
            $id = '';
            if (isset($jws_option['select-sidebar-post']) && !empty($jws_option['select-sidebar-post'])) {
               $id = $jws_option['select-sidebar-post'];
            }
			// If template is selected
			if ( ! empty( $id ) ) {
				return $id;
			}

			// Return
			return false;
			
		}
        
		/**
		 * Enqueue styles
		 *
		 * @since 1.4.0
		 */
		public static function enqueue_styles() {

			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {

				$header_id 					= self::get_header_id();
                $footer_id 					= self::get_footer_id();
                $titlebar_id 					= self::get_titlebar_id();
                $page404_id 					= self::get_404_id();
                $blog_sidebar_single_id = self::get_blog_sidebar_single_id();
                $blog_sidebar_id = self::get_sidebar_post_id();
                
				// Enqueue header css file
				if ( false != $header_id ) {
					$error_css = new \Elementor\Core\Files\CSS\Post( $header_id );
					$error_css->enqueue();
                    $page_css = get_post_meta( intval( $header_id ), '_elementor_page_settings', true );
                    if(isset($page_css['page_css'])) {
                       wp_add_inline_style( 'jws-style-theme',  $page_css['page_css']  );  
                    }
                    
				}
                // Enqueue footer css file
				if ( false != $footer_id ) {
					$error_css = new \Elementor\Core\Files\CSS\Post( $footer_id );
					$error_css->enqueue();
				}
                // Enqueue title bar css file
				if ( false != $titlebar_id ) {
					$error_css = new \Elementor\Core\Files\CSS\Post( $titlebar_id );
					$error_css->enqueue();
				}
                // Enqueue blog sidebar css file
				if ( false != $blog_sidebar_single_id ) {
					$error_css = new \Elementor\Core\Files\CSS\Post( $blog_sidebar_single_id );
					$error_css->enqueue();
				}
				if ( false != $blog_sidebar_id ) {
					$error_css = new \Elementor\Core\Files\CSS\Post( $blog_sidebar_id );
					$error_css->enqueue();
				}
                // Enqueue 404 css file
				if ( false != $page404_id ) {
					$error_css = new \Elementor\Core\Files\CSS\Post( $page404_id );
					$error_css->enqueue();
				}
                
                

			}

		}

		/**
		 * Prints header content.
		 *
		 * @since 1.4.0
		 */
		public static function display_header() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_header_id(),true );
		}
        /**
		 * Prints footer content.
		 *
		 * @since 1.4.0
		 */
		public static function display_footer() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_footer_id(),true );
		}
        /**
		 * Prints title bar content.
		 *
		 * @since 1.4.0
		 */
		public static function display_titlebar() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_titlebar_id(),true );
		}
        
        /**
		 * Prints 404 content.
		 *
		 * @since 1.4.0
		 */
		public static function display_404() {
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( self::get_404_id(),true );
		}

	}

endif;

 new Jws_Elementor();

 ?>