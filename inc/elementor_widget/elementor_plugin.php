<?php
// direct load is not allowed
if ( ! defined( 'ABSPATH' ) ) {
	die();
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0
 */
class Plugin {
    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;
    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function enqueue_editor_scripts() {
        wp_register_script('jws-query-control', JWS_URI_PATH . '/inc/elementor_widget/control/js/query.js', array(), '', true);
    }
    public function enqueue_frontend_scripts() {
    	
    }
    public function get_scripts($name_js_ccs) {
        wp_enqueue_script($name_js_ccs);
    }
    /**
     * Include Control files
     *
     * Load controls files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_control_files() {
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/control/query.php');

    }
    public function register_controls($controls_manager) {
        // Its is now safe to include Control files
        $this->include_control_files();

        $controls_manager->register( new JwsElementor\Control\Query());
      
    }
    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets() {
        
        // Its is now safe to include Widgets files
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/marquee-advanced/marquee-advanced.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/login_button/login_button.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/woocommerce/category_tabs/category_tabs.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/chart/chart.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/aven_chart/aven_chart.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/table/table.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/account/account.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/menu_nav/menu_nav.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/video_popup/video_popup.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/info_box/info_box.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/testimonial_slider/testimonial_slider.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/blog/blog.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/team/team.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/breadcrumbs/breadcrumbs.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/tab2/tab.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/pricing_table/pricing_table.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/contact_form7/contact_form7.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/map/map.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/search/search.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/gallery_list/gallery_list.php');
               require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/tongle_switch/tongle_switch.php');

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/services/services.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/dropdown_text/dropdown_text.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/off_canvas/off_canvas.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/login_form/login_form.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/list_box/list_box.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/iframe/iframe.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/logo/logo.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/jws_gallery/jws_gallery.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/menu_list/menu_list.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/demo_filter/demo_filter.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/instagram/instagram.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/slider/slider.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/countdown/countdown.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/image_carousel/image_carousel.php');
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/heading-advanced/heading-advanced.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/button-advanced/button-advanced.php');
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/nested-slider/nested-slider.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Alpus_Nested_Slider());
        
          /**
         * Register Widgets Freelancer
         */     
          require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/search_form_cpt/search_cpt.php'); 
         require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/search_form_role/search_form_role.php');
         require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/search_form_loca/jobs_loca_search_form.php');
          require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/jobs/jobs.php');
          require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/freelancers/freelancers.php');
          require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/employers/employers.php');
          require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/dashboard-packages/dashboard-packages.php');
          \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Dashboard_Packages());
        
        
        
        /**
         * Register Widgets Woocommerce
         */
        if (class_exists('Woocommerce')) {  
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/woocommerce/wishlist/wishlist.php');
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/product_group/product_group.php');
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/product_tabs/product_tab.php');
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/woocommerce/mini-cart/mini-cart.php');
        }

        /**
         * Register Widgets Wordpress
         */
        		
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/wordpress/category/category.php');  
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/wordpress/tag/tag.php');

        
        // Register Widgets
        if (class_exists('Woocommerce')) {  
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\JwsProductAdvanced()); 
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Menu_Cart());
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\JwsCategoryList());
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Product_Group());
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Wishlist());
        }
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Marquee_Advanced());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Tongle_Switch());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Login_Button());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Services());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Gallery_List());
        \Elementor\Plugin::instance()->widgets_manager->register(new Category());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Tag());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\PieCharts());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\jws_Aven_Charts());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Table());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Account());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Nav_Menu());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Video_popup());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Info_Box());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_team());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Testimonial_Slider());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Blog());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Team());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Breadcrumbs());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_tab_Advanced());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Price_Table());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_cf7());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\GoogleMap());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Search());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Dropdown_Text());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Offcanvas());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Login_form());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Banner());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Iframe());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Logo());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Gallery());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Menu_list());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Demo());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Instagram());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Slider());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Countdown_Elementor_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Image_Carousel());
        
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Fancy_Heading());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Button_Advanced());

        /**
         * Register Widgets Freelancer
         */ 
         \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Search_Categories()); 
         \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Search_Role()); 
       \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Jobs_location_Search()); 
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jobs()); 
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Freelancers()); 
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Employers()); 
        
    }
    public function register_categoris() {
        \Elementor\Plugin::$instance->elements_manager->add_category('jws-elements', ['title' => esc_html__('JWS Themes Widget', 'freeagent'), 'icon' => 'fa fa-plug', ], 1);
        \Elementor\Plugin::$instance->elements_manager->add_category('jws-solar', ['title' => esc_html__('Solar Calculator', 'freeagent'), 'icon' => 'fa fa-plug', ], 1);
    }
    
    public function register_element() {
        include_once ('row-cutom.php');
		\Elementor\Plugin::$instance->elements_manager->unregister_element_type( 'section' );
		\Elementor\Plugin::$instance->elements_manager->register_element_type( new Jws_Section() );

	}
    
    public function load_styles() {
        wp_enqueue_style('jws-admin-styles', JWS_URI_PATH.'/assets/css/admin.css');
	}
    
    
    public function register_document_controls( $document ) { 
        
        $document->start_controls_section(
			'jws_custom_css_settings',
			array(
				'label' => esc_html__( 'Jws Custom CSS', 'freeagent' ),
				'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
			)
		);

		$document->add_control(
				'page_css',
				array(
					'type' => Elementor\Controls_Manager::TEXTAREA,
					'rows' => 40,
				)
		);

		$document->end_controls_section();
        
    }
    
    
    public function save_page_custom_css_js( $self, $data ) { 
        
        if ( empty( $data['settings'] ) || empty( $_REQUEST['editor_post_id'] ) ) {
			return;
		}
		$post_id = absint( $_REQUEST['editor_post_id'] );

		// save Riode elementor page CSS
		if ( ! empty( $data['settings']['page_css'] ) ) {
			update_post_meta( $post_id, 'page_css', wp_slash( $data['settings']['page_css'] ) );
		} else {
			delete_post_meta( $post_id, 'page_css' );
		}
        
    }
    
    public function save_elementor_page_css_js( $self, $data ) { 
       
       if ( current_user_can( 'unfiltered_html' ) || empty( $data['settings'] ) || empty( $_REQUEST['editor_post_id'] ) ) {
			return;
		}
		$post_id = absint( $_REQUEST['editor_post_id'] );
		if ( ! empty( $data['settings']['page_css'] ) ) {
			$elementor_settings = get_post_meta( $post_id, '_elementor_page_settings', true );
			if ( is_array( $elementor_settings ) ) {
				$elementor_settings['page_css'] =  get_post_meta( $post_id, 'page_css', true  );
				update_post_meta( $post_id, '_elementor_page_settings', $elementor_settings );
			}
		} 
        
    }
    
    
    public function jws_regenicon_icon_library() { 
     
        if(isset($_GET['jws_icon'])) {
                
                WP_Filesystem();
                global $wp_filesystem;
                // Append new icons
                $upload_dir = wp_upload_dir(); 
                $file_dirname = $upload_dir['basedir'] . '/jws_icons.json';
                if(!file_exists($file_dirname)) wp_mkdir_p($file_dirname);
    
                $string =  $wp_filesystem->get_contents(JWS_URI_PATH. '/assets/font/jws_icon/config.json');
                $json_a = json_decode($string,true);
                $icon_aray = array();
                foreach ($json_a['glyphs'] as $key => $value){
                    $icon_aray[] = $value['css'];
                } 
                
                $icon_arays['icons'] = $icon_aray;
                
                $icon_end = json_encode($icon_arays);
     
                $file = JWS_ABS_PATH. '/assets/font/jws_icon/icon.json';
    
                $wp_filesystem->put_contents($file, $icon_end);
         
                
        }
        
    }
    
    
    public function jws_add_icon_library( $icons ) {

			$icons['jws-icons'] = array(
				'name'          => 'jws',
				'label'         => esc_html__( 'Jws Icons', 'freeagent' ),
				'prefix'        => 'jws-icon-',
				'displayPrefix' => ' ',
				'labelIcon'     => 'jws-icon',
			    'url'           => JWS_URI_PATH . '/assets/font/jws_icon/jwsicon.css',
				'native'        => false,
                'fetchJson'     =>  JWS_URI_PATH. '/assets/font/jws_icon/icon.json',
		        'ver'           => '1.1.0',
			);
	
		return $icons;
	}
    
    
      public static function before_section_render( $element ) { 
        $container_selector = version_compare( ELEMENTOR_VERSION, '3.8', '>=' ) ? 'e-con' : 'e-container';
        $container_inner_selector = version_compare( ELEMENTOR_VERSION, '3.8', '>=' ) && $element->get_settings('content_width') === 'boxed' ? '.e-con-inner' : '';
         
        // Parallax
        if ( $element->get_settings( 'jws_parallax' ) ) {

            $perspective = $element->get_settings( 'jws_parallax_settings_perspective' );

            $from_x = $element->get_settings( 'jws_parallax_from_x' );
            $from_y = $element->get_settings( 'jws_parallax_from_y' );
            $from_z = $element->get_settings( 'jws_parallax_from_z' );

            $from_scaleX = $element->get_settings( 'jws_parallax_from_scaleX' );
            $from_scaleY = $element->get_settings( 'jws_parallax_from_scaleY' );
            
            $from_rotationX = $element->get_settings( 'jws_parallax_from_rotationX' );
            $from_rotationY = $element->get_settings( 'jws_parallax_from_rotationY' );
            $from_rotationZ = $element->get_settings( 'jws_parallax_from_rotationZ' );

            $from_opacity = $element->get_settings( 'jws_parallax_from_opacity' );

            $from_transformOriginX = $element->get_settings( 'jws_parallax_from_transformOriginX' );
            $from_transformOriginY = $element->get_settings( 'jws_parallax_from_transformOriginY' );
            $from_transformOriginZ = $element->get_settings( 'jws_parallax_from_transformOriginZ' );

            $to_x = $element->get_settings( 'jws_parallax_to_x' );
            $to_y = $element->get_settings( 'jws_parallax_to_y' );
            $to_z = $element->get_settings( 'jws_parallax_to_z' );
                     
            $to_scaleX = $element->get_settings( 'jws_parallax_to_scaleX' );
            $to_scaleY = $element->get_settings( 'jws_parallax_to_scaleY' );

            $to_rotationX = $element->get_settings( 'jws_parallax_to_rotationX' );
            $to_rotationY = $element->get_settings( 'jws_parallax_to_rotationY' );
            $to_rotationZ = $element->get_settings( 'jws_parallax_to_rotationZ' );
           
            $to_opacity = $element->get_settings( 'jws_parallax_to_opacity' );

            $to_transformOriginX = $element->get_settings( 'jws_parallax_to_transformOriginX' );
            $to_transformOriginY = $element->get_settings( 'jws_parallax_to_transformOriginY' );
            $to_transformOriginZ = $element->get_settings( 'jws_parallax_to_transformOriginZ' );
            
            $parallax_ease = $element->get_settings( 'jws_parallax_settings_ease' );
            $parallax_duration = $element->get_settings( 'jws_parallax_settings_duration' );
            $parallax_trigger = $element->get_settings( 'jws_parallax_settings_trigger' );
            $parallax_trigger_start = $element->get_settings( 'jws_parallax_settings_trigger_start' );
            $parallax_trigger_end = $element->get_settings( 'jws_parallax_settings_trigger_end' );

            $wrapper_attributes = $parallax_data = $parallax_data_from = $parallax_data_to = $parallax_opts = array();
        
            if ( !empty( $perspective ) && !empty( $perspective['size'] ) ) { $parallax_data_from['transformPerspective'] = $perspective['size'].$perspective['unit']; }

            if ( !empty( $from_x ) && !empty( $to_x ) && $from_x != $to_x ) {
                $parallax_data_from['x'] = $from_x['size'].$from_x['unit'];
                $parallax_data_to['x'] = $to_x['size'].$to_x['unit'];
            }
            if ( !empty( $from_y ) && !empty( $to_y ) && $from_y != $to_y ) {
                $parallax_data_from['y'] = $from_y['size'].$from_y['unit'];
                $parallax_data_to['y'] = $to_y['size'].$to_y['unit'];
            }
            if ( !empty( $from_z ) && !empty( $to_z ) && $from_z != $to_z ) {
                $parallax_data_from['z'] = $from_z['size'].$from_z['unit'];
                $parallax_data_to['z'] = $to_z['size'].$to_z['unit'];
            }
            
            if ( !empty( $from_scaleX ) && !empty( $to_scaleX ) && $from_scaleX != $to_scaleX ) {
                $parallax_data_from['scaleX'] = (float) $from_scaleX['size'];
                $parallax_data_to['scaleX'] = (float) $to_scaleX['size'];
            }
            if ( !empty( $from_scaleY ) && !empty( $to_scaleY ) && $from_scaleY != $to_scaleY ) {
                $parallax_data_from['scaleY'] = (float) $from_scaleY['size'];
                $parallax_data_to['scaleY'] = (float) $to_scaleY['size'];
            }

            if ( !empty( $from_rotationX ) && !empty( $to_rotationX ) && $from_rotationX != $to_rotationX ) {
                $parallax_data_from['rotationX'] = (int) $from_rotationX['size'];
                $parallax_data_to['rotationX'] = (int) $to_rotationX['size'];
            }
            if ( !empty( $from_rotationY ) && !empty( $to_rotationY ) && $from_rotationY != $to_rotationY ) {
                $parallax_data_from['rotationY'] = (int) $from_rotationY['size'];
                $parallax_data_to['rotationY'] = (int) $to_rotationY['size'];
            }
            if ( !empty( $from_rotationZ ) && !empty( $to_rotationZ ) && $from_rotationZ != $to_rotationZ ) {
                $parallax_data_from['rotationZ'] = (int) $from_rotationZ['size'];
                $parallax_data_to['rotationZ'] = (int) $to_rotationZ['size'];
            }

            if ( !empty( $from_opacity ) && !empty( $to_opacity ) && $from_opacity != $to_opacity ) {
                $parallax_data_from['opacity'] = (float) $from_opacity['size'];
                $parallax_data_to['opacity'] = (float) $to_opacity['size'];
            }
        
            $from_toriginX = isset( $from_transformOriginX ) && ! empty( $from_transformOriginX ) ? $from_transformOriginX['size'].$from_transformOriginX['unit'] : '';
            $from_toriginY = isset( $from_transformOriginY ) && ! empty( $from_transformOriginY ) ? $from_transformOriginY['size'].$from_transformOriginY['unit'] : '';
            $from_toriginZ = isset( $from_transformOriginZ ) && ! empty( $from_transformOriginZ ) ? $from_transformOriginZ['size'].$from_transformOriginZ['unit'] : '';
        
            $to_toriginX = isset( $to_transformOriginX ) && ! empty( $to_transformOriginX ) ? $to_transformOriginX['size'].$to_transformOriginX['unit'] : '';
            $to_toriginY = isset( $to_transformOriginY ) && ! empty( $to_transformOriginY ) ? $to_transformOriginY['size'].$to_transformOriginY['unit'] : '';
            $to_toriginZ = isset( $to_transformOriginZ ) && ! empty( $to_transformOriginZ ) ? $to_transformOriginZ['size'].$to_transformOriginZ['unit'] : '';

            if (
                ! empty( $from_toriginX ) && ! empty( $from_toriginY ) && ! empty( $from_toriginZ ) &&
                ! empty( $to_toriginX ) && ! empty( $to_toriginY ) && ! empty( $to_toriginZ )
            ) {
                $parallax_data_from['transformOrigin'] = $from_toriginX . ' ' . $from_toriginY . ' ' . $from_toriginZ;
                $parallax_data_to['transformOrigin'] = $to_toriginX . ' ' . $to_toriginY . ' ' . $to_toriginZ;
            }

            if ( $parallax_data_from['transformOrigin'] == $parallax_data_to['transformOrigin'] ) {
                unset($parallax_data_from['transformOrigin']);
                unset($parallax_data_to['transformOrigin']);
            }
        
            //Parallax general options
            $parallax_data['from'] = $parallax_data_from;
            $parallax_data['to'] = $parallax_data_to;
        
            if( is_array( $parallax_data['from'] ) && ! empty( $parallax_data['from'] ) ) {
                $wrapper_attributes[] = 'data-parallax-from=\'' . wp_json_encode( $parallax_data['from'] ) . '\'';
            }
            if( is_array( $parallax_data['to'] ) && ! empty( $parallax_data['to'] ) ) {
                $wrapper_attributes[] = 'data-parallax-to=\'' . wp_json_encode( $parallax_data['to'] ) . '\'';
            }

            if ( isset( $parallax_ease ) ) { $parallax_opts['ease'] = $parallax_ease; }
            if( 'custom' !== $parallax_trigger ){
                $parallax_opts['start'] = esc_attr( $parallax_trigger );
                if ( isset($parallax_duration) && ! empty($parallax_duration) ) {
                    $dur = $parallax_duration['size'] >= 0 ? '+='.abs($parallax_duration['size']).$parallax_duration['unit'].'' : '-='.abs($parallax_duration['size']).$parallax_duration['unit'].'';
                    $parallax_opts['end'] = esc_attr( 'bottom'  . $dur . ' top' );
                }
            } else {
                if ( ! empty( $parallax_trigger_start ) ) {
                    $parallax_opts['start'] = esc_attr( $parallax_trigger_start );
                }
                if ( ! empty( $parallax_trigger_end ) ) {
                    $parallax_opts['end'] = esc_attr( $parallax_trigger_end );
                }
            }
            if( ! empty( $parallax_opts ) ) {
                $wrapper_attributes[] = 'data-parallax-options=\'' . wp_json_encode( $parallax_opts ) .'\'';
            }

            $element->add_render_attribute( '_wrapper', [
                'jws-data-parallax' => 'true',
                'data-parallax-options' => wp_json_encode( $parallax_opts ),
                'data-parallax-from' => wp_json_encode( $parallax_data['from'] ),
                'data-parallax-to' => wp_json_encode( $parallax_data['to'] ),
            ] );

        }
         
         // Animation
         if ( $element->get_settings( 'jws_custom_animation' ) ) {
           
            $ca_preset_values = array();
            $ca_opts = $ca_from_values = $ca_to_values = array();
            $animation_targets = array();

            $animation_preset = $element->get_settings( 'jws_ca_preset' );
            $ca_ease = $element->get_settings( 'jws_ca_settings_ease' );
            $ca_direction = $element->get_settings( 'jws_ca_settings_direction' );
            $ca_duration = $element->get_settings( 'jws_ca_settings_duration' )['size'];
            $ca_stagger = $element->get_settings( 'jws_ca_settings_stagger' )['size'];
            $ca_start_delay = $element->get_settings( 'jws_ca_settings_start_delay' )['size'];

            $ca_opts['addChildTimelines'] = false;
            // $ca_opts['addPerspective'] = false;

            switch ( $element->get_name() ){
                case 'container': 
                    if ( $element->get_settings('jws_ca_targets') === 'contents' ) {
                        array_push($animation_targets, ':scope ' . $container_inner_selector . ' > .elementor-element:not(.jws-exclude-parent-ca) > .elementor-widget-container');
                        array_push($animation_targets, ':scope ' . $container_inner_selector . ' > .elementor-widget-hub_fancy_heading .jws-split-lines .jws-lines .split-inner');
                        array_push($animation_targets, ':scope ' . $container_inner_selector . ' > .elementor-widget-hub_fancy_heading .jws-split-words .jws-words .split-inner');
                        array_push($animation_targets, ':scope ' . $container_inner_selector . ' > .elementor-widget-hub_fancy_heading .jws-split-chars .jws-chars .split-inner');
                        array_push($animation_targets, ':scope ' . $container_inner_selector . ' > .elementor-widget-hub_fancy_heading .jws-adv-txt-fig');
                        array_push($animation_targets, ':scope ' . $container_inner_selector . ' > .elementor-widget-ld_custom_menu .jws-fancy-menu > ul > li');
                        if ( $element->get_settings('jws_ca_include_inner_content') === 'yes' ) {
                            array_push($animation_targets, ':scope .' . $container_selector . ':not([data-parallax]) ' . $container_inner_selector . ' > .elementor-element > .elementor-widget-container');
                            array_push($animation_targets, ':scope .' . $container_selector . ':not([data-parallax]) ' . $container_inner_selector . ' > .elementor-widget-hub_fancy_heading .jws-split-lines .jws-lines .split-inner');
                            array_push($animation_targets, ':scope .' . $container_selector . ':not([data-parallax]) ' . $container_inner_selector . ' > .elementor-widget-hub_fancy_heading .jws-split-words .jws-words .split-inner');
                            array_push($animation_targets, ':scope .' . $container_selector . ':not([data-parallax]) ' . $container_inner_selector . ' > .elementor-widget-hub_fancy_heading .jws-split-chars .jws-chars .split-inner');
                            array_push($animation_targets, ':scope .' . $container_selector . ':not([data-parallax]) ' . $container_inner_selector . ' > .elementor-widget-ld_custom_menu .jws-fancy-menu > ul > li');
                        }
                    } else {
                        array_push($animation_targets, ':scope ' . $container_inner_selector . ' > .' . $container_selector . '');
                    }
                break;
                case 'section': 
                    array_push($animation_targets, ':scope > .elementor-container > .elementor-column');
                break;
                case 'column':
                    // $ca_opts['addChildTimelines'] = true;
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-element > .elementor-widget-container');
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-section > .elementor-container > .elementor-column > .elementor-widget-wrap > .elementor-element:not(.jws-el-has-inner-anim) > .elementor-widget-container');
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-widget-hub_fancy_heading .jws-split-lines .jws-lines .split-inner');
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-widget-hub_fancy_heading .jws-split-words .jws-words .split-inner');
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-widget-hub_fancy_heading .jws-split-chars .jws-chars .split-inner');
                    array_push($animation_targets, ':scope > .elementor-widget-wrap > .elementor-widget-ld_custom_menu .jws-fancy-menu > ul > li');
                break;
                case 'ld_carousel':
                case 'ld_testimonial_carousel':
                    array_push($animation_targets, '[data-jws-flickity] > .flickity-viewport > .flickity-slider > .carousel-item > .carousel-item-inner');
                break;
                case 'ld_interactive_text_image':
                    array_push($animation_targets, '.jws-iti-link-item');
                break;
                case 'ld_woo_products_list':
                    array_push($animation_targets, '.jws-prod-item');
                break;
                case 'ld_portfolio':
                    array_push($animation_targets, '.jws-pf-item');
                break;
                default:
                    if( $element->get_name() === 'jws_advanced_heading' && $element->get_settings( 'enable_split' ) ){
                        
                        $split_type = $element->get_settings( 'split_type' );

                        if ( $split_type === 'lines' ){
                            array_push($animation_targets, '.jws-split-lines .jws-lines .split-inner');
                        } else if ( $split_type === 'words' ){
                            array_push($animation_targets, '.jws-split-words .jws-words .split-inner');
                        } else if ( $split_type === 'chars, words' ){
                            array_push($animation_targets, '.jws-split-chars .jws-chars .split-inner');
                        }
                        array_push($animation_targets, '.jws-adv-txt-fig');
                    } else if ( $element->get_name() === 'ld_custom_menu' ) {
                        array_push($animation_targets, ':scope .jws-fancy-menu > ul > li');
                    } else {
                        array_push($animation_targets, ':scope > .elementor-widget-container');
                    }

                break;
            }

            $ca_opts['animationTarget'] = implode(', ', $animation_targets);
            
            if ( !empty( $ca_duration ) && $ca_duration !== 1.6 ) {
                $ca_opts['duration'] = (float) ($ca_duration * 1000);
            }
            if( !empty( $ca_start_delay ) && $ca_start_delay !== 0 ) {
                $ca_opts['startDelay'] = (float) ($ca_start_delay * 1000);
            }
            if ( !empty( $ca_stagger ) && $ca_stagger !== 0.16 ) {
                $ca_opts['delay'] = (float) ($ca_stagger * 1000);
            }
            if ( $ca_ease !== 'power4.out' ) {
                $ca_opts['ease'] = $ca_ease;
            }
            if ( $ca_direction !== 'forward' ) {
                $ca_opts['direction'] = $ca_direction;
            }
            
            if( 'custom' !== $animation_preset ) {

                $defined_animations = array(

                    'Fade In' => array(
                        'from' => array( 'opacity' => 0 ),
                        'to'   => array( 'opacity' => 1 ),
                    ),
                    'Fade In Down' => array(
                        'from' => array( 'opacity' => 0, 'y' => -150 ),
                        'to'   => array( 'opacity' => 1, 'y' => 0 ),
                    ),
                    'Fade In Up' => array(
                        'from' => array( 'opacity' => 0, 'y' => 150 ),
                        'to'   => array( 'opacity' => 1, 'y' => 0 ),
                    ),
                    'Fade In Left' => array(
                        'from' => array( 'opacity' => 0, 'x' => -150 ),
                        'to'   => array( 'opacity' => 1, 'x' => 0 ),
                    ),
                    'Fade In Right' => array(
                        'from' => array( 'opacity' => 0, 'x' => 150 ),
                        'to'   => array( 'opacity' => 1, 'x' => 0 ),
                    ),
                    'Flip In Y' => array(
                        'from' => array( 'opacity' => 0, 'x' => 150, 'rotationY' => 30 ),
                        'to'   => array( 'opacity' => 1, 'x' => 0, 'rotationY' => 0 ),
                    ),
                    'Flip In X' => array(
                        'from' => array( 'opacity' => 0, 'y' => 150, 'rotationX' => -30 ),
                        'to'   => array( 'opacity' => 1, 'y' => 0, 'rotationX' => 0 ),
                    ),
                    'Scale Up' => array(
                        'from' => array( 'opacity' => 0, 'scale' => 0.75 ),
                        'to'   => array( 'opacity' => 1, 'scale' => 1 ),
                    ),
                    'Scale Down' => array(
                        'from' => array( 'opacity' => 0, 'scale' => 1.25 ),
                        'to'   => array( 'opacity' => 1, 'scale' => 1 ),
                    ),
            
                );
                
                $ca_preset_values = $defined_animations[ $animation_preset ];
                $ca_from_values = $ca_preset_values['from'];
                $ca_to_values = $ca_preset_values['to'];
            }
            else {

                // From values
                $ca_from_x = $element->get_settings( 'jws_ca_from_x' );
                $ca_from_y = $element->get_settings( 'jws_ca_from_y' );
                $ca_from_z = $element->get_settings( 'jws_ca_from_z' );

                $ca_from_scaleX = $element->get_settings( 'jws_ca_from_scaleX' );
                $ca_from_scaleY = $element->get_settings( 'jws_ca_from_scaleY' );

                $ca_from_rotationX = $element->get_settings( 'jws_ca_from_rotationX' );
                $ca_from_rotationY = $element->get_settings( 'jws_ca_from_rotationY' );
                $ca_from_rotationZ = $element->get_settings( 'jws_ca_from_rotationZ' );

                $ca_from_transformOriginX = $element->get_settings( 'jws_ca_from_transformOriginX' );
                $ca_from_transformOriginY = $element->get_settings( 'jws_ca_from_transformOriginY' );
                $ca_from_transformOriginZ = $element->get_settings( 'jws_ca_from_transformOriginZ' );
                
                $ca_from_opacity = $element->get_settings( 'jws_ca_from_opacity' );
            
                // To values
                $ca_to_x = $element->get_settings( 'jws_ca_to_x' );
                $ca_to_y = $element->get_settings( 'jws_ca_to_y' );
                $ca_to_z = $element->get_settings( 'jws_ca_to_z' );

                $ca_to_scaleX = $element->get_settings( 'jws_ca_to_scaleX' );
                $ca_to_scaleY = $element->get_settings( 'jws_ca_to_scaleY' );

                $ca_to_rotationX = $element->get_settings( 'jws_ca_to_rotationX' );
                $ca_to_rotationY = $element->get_settings( 'jws_ca_to_rotationY' );
                $ca_to_rotationZ = $element->get_settings( 'jws_ca_to_rotationZ' );

                $ca_to_transformOriginX = $element->get_settings( 'jws_ca_to_transformOriginX' );
                $ca_to_transformOriginY = $element->get_settings( 'jws_ca_to_transformOriginY' );
                $ca_to_transformOriginZ = $element->get_settings( 'jws_ca_to_transformOriginZ' );
                
                $ca_to_opacity = $element->get_settings( 'jws_ca_to_opacity' );

                if ( !empty( $ca_from_x ) && !empty( $ca_to_x ) && $ca_from_x != $ca_to_x ) {
                    $ca_from_values['x'] = $ca_from_x['size'].$ca_from_x['unit'];
                    $ca_to_values['x'] = $ca_to_x['size'].$ca_to_x['unit'];
                }
                if ( !empty( $ca_from_y ) && !empty( $ca_to_y ) && $ca_from_y != $ca_to_y ) {
                    $ca_from_values['y'] = $ca_from_y['size'].$ca_from_y['unit'];
                    $ca_to_values['y'] = $ca_to_y['size'].$ca_to_y['unit'];
                }
                if ( !empty( $ca_from_z ) && !empty( $ca_to_z ) && $ca_from_z != $ca_to_z ) {
                    $ca_from_values['z'] = $ca_from_z['size'].$ca_from_z['unit'];
                    $ca_to_values['z'] = $ca_to_z['size'].$ca_to_z['unit'];
                }
                
                if ( !empty( $ca_from_scaleX ) && !empty( $ca_to_scaleX ) && $ca_from_scaleX != $ca_to_scaleX ) {
                    $ca_from_values['scaleX'] = (float) $ca_from_scaleX['size'];
                    $ca_to_values['scaleX'] = (float) $ca_to_scaleX['size'];
                }
                if ( !empty( $ca_from_scaleY ) && !empty( $ca_to_scaleY ) && $ca_from_scaleY != $ca_to_scaleY ) {
                    $ca_from_values['scaleY'] = (float) $ca_from_scaleY['size'];
                    $ca_to_values['scaleY'] = (float) $ca_to_scaleY['size'];
                }
    
                if ( !empty( $ca_from_rotationX ) && !empty( $ca_to_rotationX ) && $ca_from_rotationX != $ca_to_rotationX ) {
                    $ca_from_values['rotationX'] = (int) $ca_from_rotationX['size'];
                    $ca_to_values['rotationX'] = (int) $ca_to_rotationX['size'];
                }
                if ( !empty( $ca_from_rotationY ) && !empty( $ca_to_rotationY ) && $ca_from_rotationY != $ca_to_rotationY ) {
                    $ca_from_values['rotationY'] = (int) $ca_from_rotationY['size'];
                    $ca_to_values['rotationY'] = (int) $ca_to_rotationY['size'];
                }
                if ( !empty( $ca_from_rotationZ ) && !empty( $ca_to_rotationZ ) && $ca_from_rotationZ != $ca_to_rotationZ ) {
                    $ca_from_values['rotationZ'] = (int) $ca_from_rotationZ['size'];
                    $ca_to_values['rotationZ'] = (int) $ca_to_rotationZ['size'];
                }
    
                if ( !empty( $ca_from_opacity ) && !empty( $ca_to_opacity ) && $ca_from_opacity != $ca_to_opacity ) {
                    $ca_from_values['opacity'] = (float) $ca_from_opacity['size'];
                    $ca_to_values['opacity'] = (float) $ca_to_opacity['size'];
                }
            
                $ca_from_toriginX = isset( $ca_from_transformOriginX ) && ! empty( $ca_from_transformOriginX ) ? $ca_from_transformOriginX['size'].$ca_from_transformOriginX['unit'] : '';
                $ca_from_toriginY = isset( $ca_from_transformOriginY ) && ! empty( $ca_from_transformOriginY ) ? $ca_from_transformOriginY['size'].$ca_from_transformOriginY['unit'] : '';
                $ca_from_toriginZ = isset( $ca_from_transformOriginZ ) && ! empty( $ca_from_transformOriginZ ) ? $ca_from_transformOriginZ['size'].$ca_from_transformOriginZ['unit'] : '';
            
                $ca_to_toriginX = isset( $ca_to_transformOriginX ) && ! empty( $ca_to_transformOriginX ) ? $ca_to_transformOriginX['size'].$ca_to_transformOriginX['unit'] : '';
                $ca_to_toriginY = isset( $ca_to_transformOriginY ) && ! empty( $ca_to_transformOriginY ) ? $ca_to_transformOriginY['size'].$ca_to_transformOriginY['unit'] : '';
                $ca_to_toriginZ = isset( $ca_to_transformOriginZ ) && ! empty( $ca_to_transformOriginZ ) ? $ca_to_transformOriginZ['size'].$ca_to_transformOriginZ['unit'] : '';

                if (
                    ! empty( $ca_from_toriginX ) && ! empty( $ca_from_toriginY ) && ! empty( $ca_from_toriginZ ) &&
                    ! empty( $ca_to_toriginX ) && ! empty( $ca_to_toriginY ) && ! empty( $ca_to_toriginZ )
                ) {

                    $ca_from_values['transformOrigin'] = $ca_from_toriginX . ' ' . $ca_from_toriginY . ' ' . $ca_from_toriginZ;
                    $ca_to_values['transformOrigin'] = $ca_to_toriginX . ' ' . $ca_to_toriginY . ' ' . $ca_to_toriginZ;

                    if ( $ca_from_values['transformOrigin'] == $ca_to_values['transformOrigin'] ) {
                        unset($ca_from_values['transformOrigin']);
                        unset($ca_to_values['transformOrigin']);
                    }

                }
            
            }

            $ca_opts['initValues'] = !empty( $ca_from_values ) ? $ca_from_values : array();
            $ca_opts['animations'] = !empty( $ca_to_values ) ? $ca_to_values : array();

            $element->add_render_attribute( '_wrapper', [
                'data-custom-animations' => 'true',
                'data-ca-options' => stripslashes( wp_json_encode( $ca_opts ) ),
            ] );

        }
       
    }
    
    
    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct() {
        include_once ('shade_animation.php');
        include_once ('particles.php');
        include_once ('row-sticky.php');
        include_once ('font-custom.php');
        include_once ('css_js_custom.php');
        include_once ('tabs-name-custom.php');
        
        add_action('init', array($this, 'register_categoris'));
        // Register widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        // Register controls
        add_action('elementor/controls/register', [$this, 'register_controls']);
        // Editor Scripts
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);
        // Frontend Scripts
        add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ]);
        
        add_action( 'elementor/elements/elements_registered', array( $this, 'register_element' ) );
        
        add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'load_styles' ) );
        
        add_action( 'elementor/documents/register_controls', array( $this, 'register_document_controls' ) );
        
        
         add_filter( 'elementor/widget/render_content', function( $widget_content, $widget ) {

            if ( 'jws_advanced_heading' === $widget->get_name() ) { // check the widget

                $settings = $widget->get_settings();
                $type = $settings['highlight_type'];

                // define all classnames for highlight_type
                $types = [
                    'jws-highlight-custom-underline' => 'jws-highlight-brush-svg jws-highlight-brush-svg-1',
                    'jws-highlight-custom-underline jws-highlight-custom-underline-alt' => [ 'jws-highlight-pen', 'jws-highlight-brush-svg jws-highlight-brush-svg-2' ],
                    'jws-highlight-custom jws-highlight-custom-3' => 'jws-highlight-brush-svg jws-highlight-brush-svg-3',
                    'jws-highlight-custom jws-highlight-custom-4' => 'jws-highlight-brush-svg jws-highlight-brush-svg-4',
                    'jws-highlight-custom jws-highlight-custom-5' => 'jws-highlight-brush-svg jws-highlight-brush-svg-5'
                ];

                if ( !empty( $type ) ){ // check underline style

                    unset($types[$type]); // remove current style in array
                    foreach ( $types as $key => $value ){
                        if ( is_array( $value ) ){
                            foreach( $value as $v ){
                                $widget_content = preg_replace( '#<svg class="'. $v .'"(.*?)</svg>#', '', $widget_content );
                            }
                        } else {
                            $widget_content = preg_replace( '#<svg class="'. $value .'"(.*?)</svg>#', '', $widget_content );
                        }
                    }

                }
                
            }

            return $widget_content;
        
        }, 10, 2 );
     
         add_action( 'elementor/element/after_section_end', function( $element, $section_id ) {

            if (
                ( $element->get_name() === 'container' && 'section_layout' === $section_id) ||
                'section_advanced' === $section_id ||
                '_section_style' === $section_id
            ) {

                $element->start_controls_section(
                    'jws_custom_animations',
                    [
                        'label' => __( 'Animations & Parallax', 'freeagent' ),
                        'tab' => Controls_Manager::TAB_ADVANCED,
                    ]
                );
        
                ld_el_parallax( $element ); // call parallax options
                ld_el_content_animation( $element ); // call content animation options

                $element->end_controls_section();
            }
        }, 10, 2 );
        
        add_action( 'elementor/frontend/before_render', array( $this, 'before_section_render' ) );
        
        
        if ( wp_doing_ajax() ) {
			add_action( 'elementor/document/before_save', array( $this, 'save_page_custom_css_js' ), 10, 2 );
			add_action( 'elementor/document/after_save', array( $this, 'save_elementor_page_css_js' ), 10, 2 );
		}
           add_action(
			'elementor/editor/after_enqueue_scripts',
			function() {
                wp_enqueue_script( 'jws-elementor-admin-js', JWS_URI_PATH. '/assets/js/widget-js/elementor-admin.js', array( 'elementor-editor' ) , '', true );
                wp_enqueue_script( 'jws-nested-admin-js', JWS_URI_PATH. '/assets/js/widget-js/nested-admin.js', array( 'nested-elements' ) , '', true );
			}
		);
   
        
        if(is_admin()) {
          add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'jws_add_icon_library' ) );  
        }  
    }
}
// Instantiate Plugin Class
Plugin::instance();

/**
* Custom Widget Default
*/

add_action( 'elementor/element/icon-box/section_icon/before_section_end', function( $element, $args ) {

     $element->add_control(
			'hover_select',
			[
				'label' =>  esc_html__( 'Hover Change All Content', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' =>  esc_html__( 'none', 'freeagent' ),
                    'all' =>  esc_html__( 'All Content', 'freeagent' ),
				],
				'default' => 'none',
                'prefix_class' => 'elementor_icon_hover_',
			]
	);
    
    $element->add_control(
			'hover_all',
			[
				'label' =>  esc_html__( 'Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor_icon_hover_all:hover  .elementor-icon-box-content .elementor-icon-box-description , {{WRAPPER}}.elementor_icon_hover_all:hover  .elementor-icon-box-content .elementor-icon-box-title , {{WRAPPER}}.elementor_icon_hover_all:hover .elementor-icon' => 'color: {{VALUE}}',
				],
                'condition' => [
						  'hover_select' => 'all',
				],
			]
	);
  
	
}, 10, 2 );

add_action( 'elementor/element/icon-box/section_style_icon/before_section_end', function( $element, $args ) {

        $element->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' =>  esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .elementor-icon',
			]
		);
        $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon-box-border',
				'label' =>  esc_html__( 'Border', 'freeagent' ),
				'selector' => '{{WRAPPER}} .elementor-icon',
			]
		);
        $element->add_responsive_control(
			'icon_margin',
			[
				'label' =>  esc_html__( 'Margin', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon .elementor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
  
	
}, 10, 2 ); 
/*Post*/
add_action( 'elementor/element/posts/classic_section_design_content/after_section_start', function( $element, $args ) {
      $element->add_control(
			'title_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post__title a:hover' => 'color: {{VALUE}};'
				],
			]
	);   
}, 10, 2 );  
/*Image Box*/
add_action( 'elementor/element/image-box/section_style_content/before_section_end', function( $element, $args ) {
    $element->add_responsive_control(
			'padding_content',
			[
				'label' =>  esc_html__( 'Padding', 'freeagent' ),
	               'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],

				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	);
    }, 10, 2 ); 
/*Counter*/
add_action( 'elementor/element/counter/section_number/before_section_end', function( $element, $args ) {
    $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'counter_number_border',
				'label' =>  esc_html__( 'Border', 'freeagent' ),
				'selector' => '{{WRAPPER}} .elementor-counter-number-wrapper',
			]
		);
    $element->add_responsive_control(
			'counter_space',
			[
				'label' =>  esc_html__( 'Padding', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-counter-number-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
    $element->add_responsive_control(
			'title_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-counter-number-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					
				],
			]
		);
        $element->add_control(
			'jws_suffix',
			[
				'label' =>  esc_html__( 'Suffix Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-counter .elementor-counter-number-suffix' => 'color: {{VALUE}}',
				],
			]
	   );
  }, 10, 2 ); 

add_action( 'elementor/element/counter/section_counter/before_section_end', function( $element, $args ) {
    $element->add_responsive_control(
			'counter_align',
			[
				'label' 		=> esc_html__( ' Align', 'freeagent' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    		=> [
						'title' 	=> esc_html__( 'Left', 'freeagent' ),
						'icon' 		=> 'eicon-h-align-left',
					],
                    'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon'  => 'eicon-h-align-center',
				    ],
					'right' 		=> [
						'title' 	=> esc_html__( 'Right', 'freeagent' ),
						'icon' 		=> 'eicon-h-align-right',
					],
				],
                'selectors' => [
               	'{{WRAPPER}} .elementor-counter-title' => 'text-align: {{VALUE}};',
                	'{{WRAPPER}} .elementor-counter-number-wrapper' => 'justify-content: {{VALUE}};',
             ],
			]
	);
}, 10, 2 ); 
/*Accordion*/
add_action( 'elementor/element/accordion/section_toggle_style_icon/after_section_start', function( $element, $args ) {
      $element->add_control(
			'icon_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title:hover .elementor-accordion-icon i:before' => 'color: {{VALUE}};'
				],
			]
	);   
}, 10, 2 );    
add_action( 'elementor/element/accordion/section_toggle_style_content/after_section_start', function( $element, $args ) {
    $element->add_control(
			'content_active_bg',
			[
				'label'     => esc_html__( 'Background Active Color', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-content.elementor-active' => 'background: {{VALUE}};'
				],
			]
	);
}, 10, 2 );   
add_action( 'elementor/element/accordion/section_toggle_style_title/after_section_start', function( $element, $args ) {
    $element->add_control(
			'title_active_hover',
			[
				'label'     => esc_html__( 'Color Active Hover', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title.elementor-active:hover .elementor-accordion-title' => 'color: {{VALUE}};'
				],
			]
	);  
        $element->add_control(
			'title_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title:hover .elementor-accordion-title' => 'color: {{VALUE}};'
				],
			]
	); 
            $element->add_control(
			'bg_item_hover',
			[
				'label'     => esc_html__( 'Background Hover', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title:hover ' => 'background-color: {{VALUE}};'
				],
			]
	);   
}, 10, 2 );
add_action( 'elementor/element/accordion/section_title_style/before_section_end', function( $element, $args ) {
    $element->add_control(
			'bg_item',
			[
				'label'     => esc_html__( ' Background Color', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'background-color: {{VALUE}};'
				],
			]
	);

    

    $element->add_control(
			'spacing',
			[
				'label' =>  esc_html__( 'Spacing', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
	);
         $element->add_responsive_control(
			'padding_accordion',
			[
				'label' =>  esc_html__( 'Paddig', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
    $element->add_responsive_control(
			'margin_accordion',
			[
				'label' =>  esc_html__( 'Margin', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
     $element->add_control(
			'radius',
			[
				'label' =>  esc_html__( 'Border Radius', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
    $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jws_ac_border',
				'label' =>  esc_html__( 'Border', 'freeagent' ),
				'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item',
			]
		);

}, 10, 2 );



//Form
add_action( 'elementor/element/form/section_field_style/after_section_start', function( $element, $args ) {
 
		$element->add_control(
			'text_placeholder',
			[
				'label' => esc_html__( 'Color Placehoder', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-field-group .elementor-field::placeholder' => 'color: {{VALUE}};',
				],
			]
		);   
}, 10, 2 );
add_action( 'elementor/element/form/section_button_style/after_section_start', function( $element, $args ) {
 
		$element->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Icon Size', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);   
}, 10, 2 );
add_action( 'elementor/element/form/section_button_style/before_section_end', function( $element, $args ) {
 
		$element->add_responsive_control(
			'btn_spcing',
			[
				'label'     => esc_html__( 'Margin', 'freeagent' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-field-type-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
			]
		);   
}, 10, 2 );
add_action( 'elementor/element/form/section_form_style/before_section_end', function( $element, $args ) {
			$element->add_control(
				'textarea_style',
				[
					'label'     => esc_html__( 'Textarea', 'freeagent' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
                    $element->add_responsive_control(
					'textarea_style_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-field-group:not(.elementor-field-type-upload) textarea.elementor-field:not(.elementor-select-wrapper)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					
					]
		);
 }, 10, 2 );   
 add_action( 'elementor/element/form/section_form_style/before_section_end', function( $element, $args ) {
			$element->add_control(
				'select_style',
				[
					'label'     => esc_html__( 'Field Padding', 'freeagent' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
                    $element->add_responsive_control(
					'select_style_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-field-textual' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					
					]
		);
 }, 10, 2 ); 
 //Hotspot
add_action( 'elementor/element/hotspot/section_style_hotspot/before_section_end', function( $element, $args ) {
    $element->add_control(
			'icon color',
			[
				'label' =>  esc_html__( 'Icon Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .e-hotspot__button .e-hotspot__icon i' => 'color: {{VALUE}}',
				],
			]
	   );
 }, 10, 2 );
  //Nav menu
  
 add_action( 'elementor/element/nav-menu/section_style_main-menu/before_section_end', function( $element, $args ) {
 	
    $element->add_group_control(
    	Group_Control_Border::get_type(),
    	[
    		'name' => 'menu_border',
    		'label' => esc_html__( 'Border', 'freeagent' ),
    		'selector' => '{{WRAPPER}} .elementor-nav-menu--main .elementor-item',
    	]
    );
        $element->add_responsive_control(
			'menu_border_radius',
			[
				'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-nav-menu--main .elementor-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
  $element->add_group_control(
		\Elementor\Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'box_shadow',
			'label' =>  esc_html__( 'Box Shadow', 'freeagent' ),
			'selector' => '{{WRAPPER}} .elementor-nav-menu--main .elementor-item',
		]
	);

 }, 10, 2 );
 //Icon Social
 add_action( 'elementor/element/social-icons/section_social_style/before_section_end', function( $element, $args ) {
        $element->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'label' =>  esc_html__( 'Icon Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .elementor-social-icon',
			]
		);
  $element->add_control(
			'social_icon_opacity',
			[
				'label' =>  esc_html__( 'Opacity', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .elementor-social-icon' => 'opacity:{{SIZE}};',
				],
			]
	);
 }, 10, 2 );  
 add_action( 'elementor/element/social-icons/section_social_hover/after_section_start', function( $element, $args ) {
  $element->add_control(
			'social_icon_opacity_hover',
			[
				'label' =>  esc_html__( 'Opacity', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .elementor-social-icon:hover' => 'opacity:{{SIZE}};',
				],
			]
	);
 }, 10, 2 );  
//Icon List
add_action( 'elementor/element/icon-list/section_icon_style/after_section_start', function( $element, $args ) {
    $element->add_control(
			'svg_color_stroke',
			[
				'label' =>  esc_html__( 'Colo SVG', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon svg path' => 'stroke: {{VALUE}}',
				],
			]
	   );
 }, 10, 2 );  
 add_action( 'elementor/element/icon-list/section_text_style/before_section_end', function( $element, $args ) {
        $element->add_responsive_control(
			'text_radius',
			[
				'label' =>  esc_html__( 'Border Radius', 'freeagent' ),
	               'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],

				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	);
    $element->add_responsive_control(
			'text_padding',
			[
				'label' =>  esc_html__( 'Padding', 'freeagent' ),
	               'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],

				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	);
        $element->add_responsive_control(
			'text_margin',
			[
				'label' =>  esc_html__( 'Margin', 'freeagent' ),
	               'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],

				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	);

 }, 10, 2 ); 
  

//Toggle

add_action( 'elementor/element/toggle/section_toggle_style_title/after_section_start', function( $element, $args ) {
    $element->add_control(
		'title_bg_active',
		[
			'label' =>  esc_html__( 'Background Active', 'freeagent' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}}',
			],
		]
   );
 }, 10, 2 );   
add_action( 'elementor/element/toggle/section_toggle_style_title/before_section_end', function( $element, $args ) {

        $element->add_responsive_control(
			'title_border_radius',
			[
				'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
		$element->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
            'label' 		=> esc_html__( 'Box Shadow', 'freeagent' ),
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .elementor-tab-title.elementor-active',
			]
		);
  
	
}, 10, 2 );
//Accordion
add_action( 'elementor/element/accordion/section_title_style/before_section_end', function( $element, $args ) {
    $element->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'item_box_shadow',
			'label' => esc_html__( 'Box Shadow', 'freeagent' ),
			'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item',
		]
    );

 }, 10, 2 ); 
add_action( 'elementor/element/accordion/section_toggle_style_icon/before_section_end', function( $element, $args ) {

        $element->add_control(
			'icon_size',
			[
				'label' =>  esc_html__( 'Icon Size', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
         $element->add_control(
			'icon_padding',
			[
				'label' =>  esc_html__( 'Padding', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
  
	
}, 10, 2 );

add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', function( $element, $args ) {

         $element->add_control(
			'toggle_radius',
			[
				'label' =>  esc_html__( 'Boder Radius', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
        $element->add_control(
			'toggle_background_active',
			[
				'label' =>  esc_html__( 'Background Active', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}}',
				],
			]
	   );
       $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'toggle_border',
				'label' =>  esc_html__( 'Border', 'freeagent' ),
				'selector' => 'body {{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title',
			]
		);

        
        $element->add_control(
			'toggle_border_active',
			[
				'label' =>  esc_html__( 'Border Color Active', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body {{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}}',
				],
			]
	   );
        
        
        $element->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'toggle_box_shadow',
				'label' =>  esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => 'body {{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title',
			]
		);
	
}, 10, 2 );
/* Image Carousel*/
add_action( 'elementor/element/image-carousel/section_style_navigation/before_section_end', function( $element, $args ) {
     $element->add_control(
		'arrow_hover_color',
		[
			'label'     => esc_html__( 'Hover Color', 'freeagent' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button:hover' => 'color: {{VALUE}};',
			],
		]
	);
    $element->add_control(
		'bg_arrow_color',
		[
			'label'     => esc_html__( 'Background Color', 'freeagent' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button' => 'background: {{VALUE}};',
			],
		]
	);
    $element->add_control(
		'bg_hover_arrow_color',
		[
			'label'     => esc_html__( 'Background Hover Color', 'freeagent' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button:hover' => 'background: {{VALUE}};',
			],
		]
	);
    $element->add_control(
		'size_arrow_box',
		[
			'label'     => esc_html__( 'Width', 'freeagent' ),
			'type' 			=> Controls_Manager::SLIDER,
			'range' 		=> [
				'px' 		=> [
					'min' => 1,
					'max' => 100,
					'step' => 1,
				],
			],
			'selectors' 	=> [
				'{{WRAPPER}} .elementor-swiper-button' => 'width:{{SIZE}}px;height:{{SIZE}}px;line-height:{{SIZE}}px;',
			],
		]
	);
      $element->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' =>  esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .elementor-swiper-button',
			]
		);
        $element->add_responsive_control(
			'radius_arrow_box',
			[
				'label'      => esc_html__( 'Border Radius', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
}, 10, 2 );
/* Count Down */
add_action( 'elementor/element/countdown/section_box_style/after_section_start', function( $element, $args ) {

    $element->add_responsive_control(
			'align_block',
				[
					'label' 		=> esc_html__( 'Align', 'freeagent' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'left'    		=> [
							'title' 	=> esc_html__( 'Left', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'right' 		=> [
							'title' 	=> esc_html__( 'Right', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .elementor-countdown-wrapper' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
	);
    }, 10, 2 );
add_action( 'elementor/element/countdown/section_box_style/before_section_end', function( $element, $args ) {

    $element->add_responsive_control(
			'countdown_width',
			[
				'label' =>  esc_html__( 'Width', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .elementor-countdown-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
	);
    
    $element->add_responsive_control(
			'countdown_height',
			[
				'label' =>  esc_html__( 'Height', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .elementor-countdown-item' => 'height:{{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}};',
				],
			]
	);

}, 10, 2 );

add_action( 'elementor/element/button/section_style/before_section_end', function( $element, $args ) {

        $element->add_control(
			'icon_size',
			[
				'label' =>  esc_html__( 'Icon Size', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
         $element->add_control(
			'icon_btn_margin',
			[
				'label' =>  esc_html__( 'Icon Margin', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-button-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
  
	
}, 10, 2 );
add_action( 'elementor/element/nested-tabs/section_tabs_style/after_section_start', function( $element, $args ) {
   $element->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'out_border',
				'label' 	=> esc_html__( 'Border', 'freeagent' ),
				'selector' 	=> '{{WRAPPER}} .e-n-tabs-heading',
                
			]
		);
     $element->add_responsive_control(
		'tab_padding',
		[
			'label' =>  esc_html__( 'Out Padding', 'freeagent' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .e-n-tabs-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;',
			],
		]
   );     
   $element->add_responsive_control(
		'tabn_radius',
		[
			'label' =>  esc_html__( 'Border Radius', 'freeagent' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .e-n-tabs-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
   );  
}, 10, 2 );
add_action( 'elementor/element/tabs/section_tabs_style/before_section_end', function( $element, $args ) {
        $element->add_responsive_control(
			'tabnav_padding',
			[
				'label' =>  esc_html__( 'Navigation Padding', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );    
        $element->add_responsive_control(
			'tab_padding',
			[
				'label' =>  esc_html__( 'Title Padding', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );
         $element->add_responsive_control(
			'tab_margin',
			[
				'label' =>  esc_html__( 'Title Margin', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );
  
	
}, 10, 2 );

add_action( 'elementor/element/icon-list/section_icon_style/before_section_end', function( $element, $args ) {
         $element->add_responsive_control(
			'list-icon_margin',
			[
				'label' =>  esc_html__( 'Margin', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );
	
}, 10, 2 );
add_action( 'elementor/element/icon-list/section_text_style/before_section_end', function( $element, $args ) {
        $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list-icon_border',
				'label' =>  esc_html__( 'Border', 'freeagent' ),
				'selector' => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text',
			]
		);
        $element->add_control(
			'list-icon_border_hover',
			[
				'label' =>  esc_html__( 'Border Hover Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-element .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text' => 'border-color: {{VALUE}}',
				],
			]
	   );
	
}, 10, 2 );
add_action( 'elementor/element/progress/section_progress_style/before_section_end', function( $element, $args ) {

        $element->add_control(
			'progress_bg',
			[
				'label'     => esc_html__( ' Background Color', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-wrapper .elementor-progress-percentage' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-progress-wrapper .elementor-progress-percentage::before' => 'border-top-color: {{VALUE}};'
				],
			]
	   );

         $element->add_control(
			'progress_bg_radius_render',
			[
				'label' =>  esc_html__( 'Border Radius', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-percentage' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
                $element->add_control(
			'padding_wrapper',
			[
				'label' =>  esc_html__( 'Padding ', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-percentage' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
    $element->add_responsive_control(
			'percent_position',
			[
				'label' =>  esc_html__( 'Percent Position', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
                    'min'=>-100,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-percentage' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
	);
}, 10, 2 );
add_action( 'elementor/element/tabs/section_tabs_style/before_section_end', function( $element, $args ) {
        $element->add_responsive_control(
			'icon_size',
			[
				'label' =>  esc_html__( 'Content Width', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tabs-content-wrapper' => 'width: {{SIZE}}%;',
				],
			]
	);
}, 10, 2 );
add_action( 'elementor/element/animated-headline/section_style_text/before_section_end', function( $element, $args ) {

        $element->add_responsive_control(
			'spacing_title',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-headline-dynamic-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
  
	
}, 10, 2 );    
add_action( 'elementor/element/post-info/section_text_style/before_section_end', function( $element, $args ) {

       $element->add_control(
			'post-info-color-hover',
			[
				'label' =>  esc_html__( 'Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text , {{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item a:hover' => 'color: {{VALUE}}',
				],
			]
	   );
        $element->add_control(
			'post-info-before-color',
			[
				'label' =>  esc_html__( 'Before Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text .elementor-post-info__item-prefix' => 'color: {{VALUE}}',
				],
			]
	   );

  
	
}, 10, 2 );   


add_action( 'elementor/element/accordion/section_toggle_style_content/before_section_end', function( $element, $args ) {
      $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' =>  esc_html__( 'Border', 'freeagent' ),
				'selector' => '{{WRAPPER}} .elementor-tab-content',
			]
		);  
      $element->add_control(
			'toggle_margin',
			[
				'label' =>  esc_html__( 'Margin', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );

  
	
}, 10, 2 ); 

add_action( 'elementor/element/heading/section_title_style/before_section_end', function( $element, $args ) {

        $element->add_control(
			'heading_hover',
			[
				'label' =>  esc_html__( 'Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-heading .elementor-heading-title:hover' => 'color: {{VALUE}}',
				],
			]
	   );

  
	
}, 10, 2 ); 