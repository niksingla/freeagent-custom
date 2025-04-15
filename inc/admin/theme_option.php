<?php
    /**
     * ReduxFramework Theme Config File
     * For full documentation, please visit: https://docs.reduxframework.com
     * */

    if ( ! class_exists( 'Redux_Framework_theme_config' ) ) {

    class Redux_Framework_theme_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if ( ! class_exists( 'ReduxFramework' ) ) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
 
                $this->initSettings();

	

        }

    public function initSettings() {

        // Just for demo purposes. Not needed per say.
        $this->theme = wp_get_theme();

        // Set the default arguments
        $this->setArguments();

        // Set a few help tabs so you can see how it's done
 

        // Create the sections and fields
        $this->setSections();

        if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
            return;
        }


        $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
    }

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'freeagent' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'freeagent' ),
            'icon'   => 'el-icon-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }

    public function setSections() {
    
        /**
         * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
         * */
        // Background Patterns Reader
        $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
        $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
        $sample_patterns      = array();
    
        if ( is_dir( $sample_patterns_path ) ) :
    
            if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                $sample_patterns = array();
    
                while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {
    
                    if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                        $name              = explode( '.', $sample_patterns_file );
                        $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                        $sample_patterns[] = array(
                            'alt' => $name,
                            'img' => $sample_patterns_url . $sample_patterns_file
                        );
                    }
                }
            endif;
        endif;
    
        ob_start();
    
        $ct          = wp_get_theme();
        $this->theme = $ct;
        $item_name   = $this->theme->get( 'Name' );
        $tags        = $this->theme->Tags;
        $screenshot  = $this->theme->get_screenshot();
        $class       = $screenshot ? 'has-screenshot' : '';
    
        $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'freeagent' ), $this->theme->display( 'Name' ) );
    
        ?>
        <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
            <?php if ( $screenshot ) : ?>
                <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                    <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                       title="<?php echo esc_attr( $customize_title ); ?>">
                        <img src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'freeagent' ); ?>"/>
                    </a>
                <?php endif; ?>
                <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                     alt="<?php esc_attr_e( 'Current theme preview', 'freeagent' ); ?>"/>
            <?php endif; ?>
    
            <h4><?php echo esc_attr($this->theme->display( 'Name' )); ?></h4>
    
            <div>
                <ul class="theme-info">
                    <li><?php printf( __( 'By %s', 'freeagent' ), $this->theme->display( 'Author' ) ); ?></li>
                    <li><?php printf( __( 'Version %s', 'freeagent' ), $this->theme->display( 'Version' ) ); ?></li>
                    <li><?php echo '<strong>' . __( 'Tags', 'freeagent' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                </ul>
                <p class="theme-description"><?php echo esc_attr($this->theme->display( 'Description' )); ?></p>
                <?php
                    if ( $this->theme->parent() ) {
                        printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'freeagent' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'freeagent' ), $this->theme->parent()->display( 'Name' ) );
                    }
                ?>
    
            </div>
        </div>
    
        <?php
        $item_info = ob_get_contents();
    
        ob_end_clean();
    
        $sampleHTML = '';
    
    	
    	$of_options_fontsize = array("8px" => "8px", "9px" => "9px", "10px" => "10px", "11px" => "11px", "12px" => "12px", "13px" => "13px", "14px" => "14px", "15px" => "15px", "16px" => "16px", "17px" => "17px", "18px" => "18px", "19px" => "19px", "20px" => "20px", "21px" => "21px", "22px" => "22px", "23px" => "23px", "24px" => "24px", "25px" => "25px", "26px" => "26px", "27px" => "27px", "28px" => "28px", "29px" => "29px", "30px" => "30px", "31px" => "31px", "32px" => "32px", "33px" => "33px", "34px" => "34px", "35px" => "35px", "36px" => "36px", "37px" => "37px", "38px" => "38px", "39px" => "39px", "40px" => "40px");
    	$of_options_fontweight = array("100" => "100", "200" => "200", "300" => "300", "400" => "400", "500" => "500", "600" => "600", "700" => "700");
    	$of_options_font = array("1" => "Google Font", "2" => "Standard Font", "3" => "Custom Font");
    
    	//Standard Fonts
    	$of_options_standard_fonts = array(
    		'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
    		"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
    		"'Bookman Old Style', serif" => "'Bookman Old Style', serif",
    		"'Comic Sans MS', cursive" => "'Comic Sans MS', cursive",
    		"Courier, monospace" => "Courier, monospace",
    		"Garamond, serif" => "Garamond, serif",
    		"Georgia, serif" => "Georgia, serif",
    		"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
    		"'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace",
    		"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
    		"'MS Sans Serif', Geneva, sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
    		"'MS Serif', 'New York', sans-serif" => "'MS Serif', 'New York', sans-serif",
    		"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
    		"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
    		"'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
    		"'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
    		"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif"
    	);
    	
        //lists page
        $lists_page = array();
        $args_page = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => 0,
            'parent' => -1,
            'exclude_tree' => '',
            'number' => '',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
        );
        $pages = get_pages( $args_page );
    
        foreach( $pages as $p ){
            $lists_page[ $p->ID ] = esc_attr( $p->post_title );
        }
        // -> START 
        $this->sections[] = array(
            'title' => esc_html__('General', 'freeagent'),
            'id' => 'general',
            'customizer_width' => '300px',
            'icon' => 'el el-cogs',
            'fields' => array(
                array(
                    'id'        => 'favicon',
                    'type'      => 'media',
                    'url'       => true,
                    'title'     => esc_html__('Favicon', 'freeagent' ),
                    'compiler'  => 'false',
                    'subtitle'  => esc_html__('Upload your favicon', 'freeagent' ),
                ),
                array(
                    'id'        => 'logo',
                    'type'      => 'media',
                    'url'       => true,
                    'title'     => esc_html__('Logo', 'freeagent' ),
                    'compiler'  => 'false',
                    'subtitle'  => esc_html__('Upload your logo', 'freeagent' ),
                ),
                array(         
                    'id'       => 'bg_body',
                    'type'     => 'background',
                    'title'    =>  esc_html__('Background', 'freeagent'),
                    'subtitle' =>  esc_html__('background with image, color, etc.', 'freeagent'),
                    'desc'     =>  esc_html__('Change background for body.', 'freeagent'),
                    'default'  => array(
                        'background-color' => '#ffffff',
                    ),
                    'output' => array('body'),
                ),
                array(
                    'id'       => 'active-class-editor',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Active Classic Editor', 'freeagent'),
                    'default'  => true,
                    'subtitle'      =>  esc_html__('Restores the classic WordPress editor and the Edit Post screen', 'freeagent'),
                ),
                array(
                    'id'       => 'box-change-style',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Box Style', 'freeagent'),
                    'default'  => false,
                    'desc'      =>  esc_html__('Display box change style demo.', 'freeagent'),
                ),
                array (
        				'id'       => 'rtl',
        				'type'     => 'switch',
        				'title'    => esc_html__( 'RTL', 'freeagent' ),
        				'default'  => false
        		),
        

                array(
                    'id'       => 'optimize-rev-slider',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Optimize Revolution Slider', 'freeagent'),
                    'default'  => false,
                ),
                 array(
                    'id' => 'select-page-rev',
                    'type' => 'select',
                    'data' => 'page',
                    'multi' => true,
                    'title' => esc_html__('Select page use revolution slider.', 'freeagent'),
                    'desc' => esc_html__('Select page use revolution slider. It will help your website have better performance', 'freeagent'),
                    'required' => array('optimize-rev-slider', '=', true),
                ),
                array(
                    'id'=>'change_per_page',
                    'type' => 'multi_text',
                    'title' => __('Change the number of posts displayed', 'freeagent'),
                    'desc' => __('Add option for select number.', 'freeagent')
               ),
                                
            )
        );
    
        // -> START Header Fields
        $this->sections[] = array(
            'title' => esc_html__('Header', 'freeagent'),
            'id' => 'header',
            'desc' => esc_html__('Custom Header', 'freeagent'),
            'customizer_width' => '400px',
            'icon' => 'el el-caret-up',
            'fields' => array(
                  array(
                    'id' => 'choose-header-absolute',
                    'type' => 'select',
                    'multi' => true,
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select header absolute.', 'freeagent'),
                ),
                array(
                    'id'       => 'custom_header',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Custom Header', 'freeagent'),
                    'default'  => false, 
                ),
                array(
                    'id' => 'header_fixed',
                    'type' => 'image_select',
                    'title' => esc_html__('Select Header', 'freeagent'),
                    'options' => array(
                        '88' => JWS_URI_PATH . '/assets/image/header/headermain.jpg',   
                        '17' => JWS_URI_PATH . '/assets/image/header/header1.jpg',   
                        '1202' => JWS_URI_PATH . '/assets/image/header/header2.jpg',   
                        '1812' => JWS_URI_PATH . '/assets/image/header/header3.jpg',   
                        '2314' => JWS_URI_PATH . '/assets/image/header/header4.jpg',   
                        '2841' => JWS_URI_PATH . '/assets/image/header/header5.jpg',   

                    ),
                    'default' => '88',
                    'required' => array('custom_header', '=', false),
                ),
                 array(
                    'id' => 'select-header',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for header', 'freeagent'),
                    'desc' => esc_html__('Select layout for header from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('custom_header', '=', true),
                ),
            )
        );
    
        // -> START Title Bar Fields
        $this->sections[] = array(
            'title' => esc_html__('Title Bar', 'freeagent'),
            'id' => 'title_bar',
            'desc' => esc_html__('Custom title bar', 'freeagent'),
            'customizer_width' => '400px',
            'icon' => 'el el-text-height',
            'fields' => array(
                array(
                    'id'       => 'title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => true,
                ),
                array(
                    'id' => 'select-titlebar',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
                array(         
                    'id'       => 'bg_titlebar',
                    'type'     => 'background',
                    'title'    =>  esc_html__('Background', 'freeagent'),
                    'subtitle' =>  esc_html__('background with image, color, etc.', 'freeagent'),
                    'desc'     =>  esc_html__('Change background for titler defaul (not woking with title elemetor template).', 'freeagent'),
                    'default'  => array(
                        'background-color' => '#333333',
                    ),
                    'output' => array('.jws-title-bar-wrap-inner'),
                ),
                array(
                    'id'             => 'titlebar-spacing',
                    'type'           => 'spacing',
                    'output'         => array('.jws-title-bar-wrap-inner'),
                    'mode'           => 'padding',
                    'units'          => array('em', 'px'),
                    'units_extended' => 'false',
                    'desc'           =>  esc_html__('You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'freeagent'),
                    'default'            => array(
                        'padding-top'     => '150px', 
                        'padding-right'   => '15px', 
                        'padding-bottom'  => '100px', 
                        'padding-left'    => '15px',
                        'units'          => 'px', 
                 ),
                
            ),
        ));
    
        // -> START footer Fields
        $this->sections[] = array(
            'title' => esc_html__('Footer', 'freeagent'),
            'id' => 'footer',
            'desc' => esc_html__('Custom Footer', 'freeagent'),
            'customizer_width' => '400px',
            'icon' => 'el el-caret-down',
            'fields' => array(
                array(
                    'id'       => 'custom_footer',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Custom Footer', 'freeagent'),
                    'default'  => false, 
                ),
                array(
                    'id' => 'footer_fixed',
                    'type' => 'image_select',
                    'title' => esc_html__('Select Footer', 'freeagent'),
                    'options' => array(
                        '92' => JWS_URI_PATH . '/assets/image/footer/footer1.jpg',
                        '1235' => JWS_URI_PATH . '/assets/image/footer/footer2.jpg',
                        '1817' => JWS_URI_PATH . '/assets/image/footer/footer3.jpg',
                        '2338' => JWS_URI_PATH . '/assets/image/footer/footer4.jpg',
                        '2865' => JWS_URI_PATH . '/assets/image/footer/footer5.jpg',

                    ),
                    'default' => '92',
                    'required' => array('custom_footer', '=', false),
                ),
                array(
                    'id' => 'select-footer',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for footer', 'freeagent'),
                    'desc' => esc_html__('Select layout for footer from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('custom_footer', '=', true),
                ),
            )
        );
    
        // -> START Color Fields
        $this->sections[] = array(
            'title' => esc_html__('Color Styling', 'freeagent'),
            'id' => 'global-color',
            'desc' => esc_html__('These are really color fields!', 'freeagent'),
            'customizer_width' => '400px',
            'icon' => 'el el-brush',
        );
    
        $this->sections[] = array(
            'title' => esc_html__('Color', 'freeagent'),
            'id' => 'color-styling',
            'subsection' => true,
            'fields' => array(
                array(
                    'id' => 'main-color',
                    'type' => 'color',
                    'title' => esc_html__('Main Color', 'freeagent'),
                    'default' => '#07242B',
                ),
                array(
                    'id' => 'secondary-color',
                    'type' => 'color',
                    'title' => esc_html__('Secondary Color', 'freeagent'),
                    'default' => '#D4FE00',
                ),
                array(
                    'id' => 'accent-color',
                    'type' => 'color',
                    'title' => esc_html__('Accent Color', 'freeagent'),
                    'default' => '#FFC119',
                ),
                array(
                    'id' => 'color_heading',
                    'type' => 'color',
                    'title' => esc_html__('Color Heading', 'freeagent'),
                    'default' => '#07242B',
                ),
                array(
                    'id' => 'color_light',
                    'type' => 'color',
                    'title' => esc_html__('Color Light', 'freeagent'),
                    'default' => '#ffffff99',
                ),
                array(
                    'id' => 'color_body',
                    'type' => 'color',
                    'title' => esc_html__('Color Body', 'freeagent'),
                    'default' => '#07242B',
                ),
                array(
                    'id' => 'bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Background Color', 'freeagent'),
                    'default' => '#07242B',
                ),
            ),
        );
    
        $this->sections[] = array(
            'title' => esc_html__('Back To Top', 'freeagent'),
            'id' => 'to-top-styling',
            'subsection' => true,
            'fields' => array(
                  array(
                    'id'       => 'to-top-layout',
                    'type'     => 'select',
                    'title'    =>  esc_html__('Select Back To Top Skins', 'freeagent'), 
                    'options'  => array(
                        'with-shadow' => 'With Shadow',
                        'with-mancolor' => 'With Main Color',
                    ),
                    'default'  => 'with-shadow',
                ),
                array(
                    'id' => 'to-top-color',
                    'type' => 'color',
                    'title' => esc_html__('Color', 'freeagent'),
                    'default' => '#000',
                    'output' => array('.backToTop.totop-show'),
                ),
        
            ),
        );
        
        $this->sections[] = array(
            'title' => esc_html__('Button', 'freeagent'),
            'id' => 'button-styling',
            'subsection' => true,
            'fields' => array(
                array(
                    'id' => 'button-bgcolor',
                    'type' => 'color',
                    'title' => esc_html__('Background Color', 'freeagent'),
                    'default' => '#07242B',
                ),
                array(
                    'id' => 'button-bgcolor2',
                    'type' => 'color',
                    'title' => esc_html__('Background Color 2', 'freeagent'),
                    'default' => '#FFC119',
                ),
                array(
                    'id' => 'button-color',
                    'type' => 'color',
                    'title' => esc_html__('Color', 'freeagent'),
                    'default' => '#FFFFFF',
                ),
        
                array(
                    'title' => esc_html__('Padding', 'freeagent'),
                    'id'             => 'button-padding',
                    'type'           => 'spacing',
                    'mode'           => 'padding',
                    'units'          => array('em', 'px'),
                    'units_extended' => 'false',
                    'output' => array('body.button-default  .elementor-button, body.button-default .jws-cf7-style .wpcf7-submit, body.button-default .elementor-button.rev-btn'),
                ),
        
            ),
        );
    
    
        // -> START Blogs Fields
        $this->sections[] = array(
            'title' => esc_html__('Blogs', 'freeagent'),
            'id' => 'blogs',
            'customizer_width' => '300px',
            'icon' => 'el el-blogger',
            'fields' => array(
        
                array(
                    'id' => 'select-titlebar-blog-archive',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
                array(
                    'id' => 'position_sidebar',
                    'type' => 'select',
                    'title' => esc_html__('Select Position Sidebar', 'freeagent'),
                    'options' => array(
                        'left' => 'Left',
                        'right' => 'Right',
                        'full' => 'No Sidebar',
                    ),
                    'default' => 'right',
                ),
                array(
                    'id' => 'select-sidebar-post-columns',
                    'type' => 'select',
                    'title' => esc_html__('Select Columns Default', 'freeagent'),
                    'options' => array(
                        '1' => '1 Columns',
                        '2' => '2 Columns',
                        '3' => '3 Columns',
                        '4' => '4 Columns',
                    ),
                    'default' => '1',
                ),

                array(
                    'id'       => 'blog_layout',
                    'type'     => 'select',
                    'title'    =>  esc_html__('Select Blog Skin', 'freeagent'), 
                    'options'  => array(
                        'grid' => 'Grid',
                        'list' => 'List',
                    ),
                    'default'  => 'grid',
                ),
                array(
                    'id'       => 'blog_pagination',
                    'type'     => 'select',
                    'title'    =>  esc_html__('Blog Pagination Layout', 'freeagent'), 
                    'options'  => array(
                        'number' => esc_html__('Number','freeagent'),
                        'loadmore' => esc_html__('Load More','freeagent'),
                    ),
                    'default'  => 'number',
                ),
                array(
                    'id' => 'select-sidebar-post',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for sidebar', 'freeagent'),
                    'desc' => esc_html__('Select layout from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('position_sidebar', '!=', 'no_sidebar'),
                ),
                array(
                    'id'       => 'blog_imagesize',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Post Image Size', 'freeagent'),
                    'default'  => '816x460'
                ),
                array(
                    'id' => 'exclude-blog',
                    'type' => 'select',
                    'multi' => true,
                    'data' => 'posts',
                    'args' => array('post_type' => array('post'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select blog types not show in blog archive page.', 'freeagent'),
                ),
                array(
                    'id' => 'select-banner-after-blog',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for banner before blog elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for banner before blog elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
              
            )
        );
    
        $this->sections[] = array(
            'title' => esc_html__('Blog Single', 'freeagent'),
            'id' => 'blog-single',
            'subsection' => true,
            'fields' => array(
                array(
                    'id'       => 'blog-single-title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => true,
                ),
                array(
                    'id' => 'select-titlebar-blog',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('blog-single-title-bar-switch', '=', true),
                ),
                array(
                    'id' => 'select-related-blog',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for Related Post', 'freeagent'),
                    'desc' => esc_html__('Select layout from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
                array(
                    'id' => 'position_sidebar_blog_single',
                    'type' => 'select',
                    'title' => esc_html__('Select Position Sidebar', 'freeagent'),
                    'options' => array(
                        'left' => 'Left',
                        'right' => 'Right',
                        'full' => 'No Sidebar',
                    ),
                    'default' => 'right',
                ),
                 array(
                    'id' => 'select-sidebar-post-single',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for sidebar', 'freeagent'),
                    'desc' => esc_html__('Select layout from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('position_sidebar_blog_single', '!=', 'no_sidebar'),
                ),
                array(
                    'id'       => 'single_blog_imagesize',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Single Blog Image Size', 'freeagent'),
                    'default'  => '1170x550'
                ),
        
            ),
        );
        
        // -> START Jobs Fields
        $this->sections[] = array(
            'title' => esc_html__('Jobs', 'freeagent'),
            'id' => 'jobs',
            'customizer_width' => '300px',
            'icon' => 'el el-briefcase',
            'fields' => array(
                array(
                        'id'       => 'unlimited_jobs',
                        'type'     => 'switch', 
                        'title'    =>  esc_html__('Create jobs unlimited', 'freeagent'),
                        'desc'     =>  esc_html__('Enabling the feature will allow unlimited job creation with the packages menbership.', 'freeagent'),
                        'default'  => false,
                        'on'       => __('Enabled', 'freeagent'),
			            'off'      => __('Disabled', 'freeagent'),
                ),
                 array(
                        'id'       => 'unlimited_jobs_expiry',
                        'type'     => 'switch', 
                        'title'    =>  esc_html__('Jobs expiry unlimited', 'freeagent'),
                        'desc'     =>  esc_html__('Enabling the feature will allow unlimited job expiry with the packages menbership.', 'freeagent'),
                        'default'  => false,
                        'on'       => __('Enabled', 'freeagent'),
			            'off'      => __('Disabled', 'freeagent'),
                ),
                array(
                        'id'       => 'unlimited_jobs_feature',
                        'type'     => 'switch', 
                        'title'    =>  esc_html__('Jobs feature unlimited', 'freeagent'),
                        'desc'     =>  esc_html__('Enabling the feature will allow unlimited feature job creation with the packages menbership.', 'freeagent'),
                        'default'  => false,
                        'on'       => __('Enabled', 'freeagent'),
			            'off'      => __('Disabled', 'freeagent'),
                ),
                array(
                        'id'       => 'unlimited_proposal',
                        'type'     => 'switch', 
                        'title'    =>  esc_html__('Send proposal unlimited', 'freeagent'),
                        'desc'     =>  esc_html__('Enabling the feature will allow unlimited send proposal for freelancer with the packages menbership.', 'freeagent'),
                        'default'  => false,
                        'on'       => __('Enabled', 'freeagent'),
			            'off'      => __('Disabled', 'freeagent'),
                ),
                array(
                    'id'=>'private_proposal',
                    'type' => 'text',
                    'title' =>  esc_html__('Private Proposal Fee', 'freeagent'),
                    'subtitle' => __('Please enter the number price', 'freeagent'),
                    'validate' => 'no_html',
                    'default' => '3',
                ),
                array(
                    'id'        => 'pin_map',
                    'type'      => 'media',
                    'url'       => true,
                    'title'     => esc_html__('Map Pin', 'lovedate' ),
                    'compiler'  => 'false',
                    'subtitle'  => esc_html__('Upload the map pin', 'lovedate' ),
                ),
            )
        );
        
       $this->sections[] = array(
            'title' => esc_html__('Jobs Archive', 'freeagent'),
            'id' => 'jobs-archive',
            'subsection' => true,
            'fields' => array(
                 array(
                    'id'       => 'jobs-title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => true,
                ),
                array(
                    'id' => 'select-titlebar-jobs',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('jobs-single-title-bar-switch', '=', true),
                ),
                array(         
                    'id'       => 'bg_jobs',
                    'type'     => 'background',
                    'title'    =>  esc_html__('Background', 'freeagent'),
                    'subtitle' =>  esc_html__('background with image, color, etc.', 'freeagent'),
                    'desc'     =>  esc_html__('Change background for body.', 'freeagent'),
                    'default'  => array(
                        'background-color' => '#F5F7F7',
                    ),
                    'output' => array('body.post-type-archive-jobs,.post-type-archive-jobs .jws-filter-modal.open .modal-content, .job-sidebar > div'),
                ),
                array(
                    'id' => 'jobs_layout',
                    'type' => 'select',
                    'title' => esc_html__('Select Layout', 'freeagent'),
                    'options' => array(
                        'map' => 'Layout Map',
                        'list' => 'Layout List',
                        'classic' => 'Layout Classic',
                        
                    ),
                    'default' => 'list',
                ),
                array(
                    'id'=>'jobs_per_page',
                    'type' => 'text',
                    'title' =>  esc_html__('Post Per Page', 'freeagent'),
                    'subtitle' => __('Please enter the number', 'freeagent'),
                    'validate' => 'no_html',
                    'default' => '9',
                ),

                array(
                    'id' => 'jobs_position_sidebar',
                    'type' => 'select',
                    'title' => esc_html__('Select Position Sidebar', 'freeagent'),
                    'options' => array(
                        'left' => 'Left',
                        'no_sidebar' => 'No Sidebar',
                    ),
                    'default' => 'left',
                ),
                array(
                    'id'       => 'jobs_pagination',
                    'type'     => 'select',
                    'title'    =>  esc_html__('Jobs Pagination Layout', 'freeagent'), 
                    'options'  => array(
                        'number' => esc_html__('Number','freeagent'),
                        'loadmore' => esc_html__('Load More','freeagent'),
                    ),
                    'default'  => 'number',
                ),
            )
        ); 
        
        $this->sections[] = array(
            'title' => esc_html__('Jobs Single', 'freeagent'),
            'id' => 'jobs-single',
            'subsection' => true,
            'fields' => array(
                array(
                    'id'       => 'jobs-single-title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => true,
                ),
                array(
                    'id' => 'select-single-titlebar-jobs',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('jobs-single-title-bar-switch', '=', true),
                ),
            )
        );        
    

    
      
            // -> START services Fields
        $this->sections[] = array(
            'title' => esc_html__('Services', 'freeagent'),
            'id' => 'services',
            'customizer_width' => '300px',
            'icon' => 'el el-cog-alt',
            'fields' => array(
                 array(
                        'id'       => 'unlimited_services',
                        'type'     => 'switch', 
                        'title'    =>  esc_html__('Create services unlimited', 'freeagent'),
                        'desc'     =>  esc_html__('Enabling the feature will allow unlimited service creation with the packages menbership.', 'freeagent'),
                        'default'  => false,
                        'on'       => __('Enabled', 'freeagent'),
			            'off'      => __('Disabled', 'freeagent'),
                ),
                 array(
                        'id'       => 'unlimited_service_expiry',
                        'type'     => 'switch', 
                        'title'    =>  esc_html__('Service expiry unlimited', 'freeagent'),
                        'desc'     =>  esc_html__('Enabling the feature will allow unlimited job creation with the packages menbership.', 'freeagent'),
                        'default'  => false,
                        'on'       => __('Enabled', 'freeagent'),
			            'off'      => __('Disabled', 'freeagent'),
                ),

                
                array(
                        'id'       => 'unlimited_services_feature',
                        'type'     => 'switch', 
                        'title'    =>  esc_html__('Services feature unlimited', 'freeagent'),
                        'desc'     =>  esc_html__('Enabling the feature will allow unlimited feature service creation with the packages menbership.', 'freeagent'),
                        'default'  => false,
                        'on'       => __('Enabled', 'freeagent'),
			            'off'      => __('Disabled', 'freeagent'),
                ),
              
               array(
                    'id'       => 'service_payment',
                    'type'     => 'select',
                    'title'    =>  esc_html__('Service Payment Type', 'freeagent'), 
                    'options'  => array(
                        'wallet' => 'Wallet',
                        'woocommerce' => 'Woocommerce',
                    ),
                    'default'  => 'wallet',
                ),
                
                array(
                    'id' => 'service_product',
                    'type' => 'select',
                    'multi' => false,
                    'data' => 'posts',
                    'args' => array('post_type' => array('product'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select product for service purchase', 'freeagent'),
                    'required' => array('service_payment', '=', 'woocommerce'),
                ),
            )
        );
        
        $this->sections[] = array(
            'title' => esc_html__('Services Archive', 'freeagent'),
            'id' => 'services-archive',
            'subsection' => true,
            'fields' => array(
                 array(
                    'id'       => 'services-title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => false,
                ),
                 array(
                    'id' => 'select-titlebar-services-archive',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('services-title-bar-switch', '=', true),
                ),
                                array(         
                    'id'       => 'bg_services',
                    'type'     => 'background',
                    'title'    =>  esc_html__('Background', 'freeagent'),
                    'subtitle' =>  esc_html__('background with image, color, etc.', 'freeagent'),
                    'desc'     =>  esc_html__('Change background for body.', 'freeagent'),
                    'default'  => array(
                        'background-color' => '#F5F7F7',
                    ),
                    'output' => array('body.post-type-archive-services,.post-type-archive-services .jws-filter-modal.open .modal-content, .service-sidebar > div'),
                ),
                array(
                    'id' => 'services_layout',
                    'type' => 'select',
                    'title' => esc_html__('Select Layout', 'freeagent'),
                    'options' => array(
                        'list' => 'Layout List',
                        'classic' => 'Layout Classic',
                        
                    ),
                    'default' => 'classic',
                ),
                array(
                    'id'=>'services_per_page',
                    'type' => 'text',
                    'title' =>  esc_html__('Post Per Page', 'freeagent'),
                    'subtitle' => __('Please enter the number', 'freeagent'),
                    'validate' => 'no_html',
                    'default' => '9',
                ),

                array(
                    'id' => 'services_position_sidebar',
                    'type' => 'select',
                    'title' => esc_html__('Select Position Sidebar', 'freeagent'),
                    'options' => array(
                        'left' => 'Left',
                        'no_sidebar' => 'No Sidebar',
                    ),
                    'default' => 'left',
                ),
                array(
                    'id' => 'services_columns',
                    'type' => 'select',
                    'title' => esc_html__('Select Columns Default', 'freeagent'),
                    'options' => array(
                        '1' => '1 Columns',
                        '2' => '2 Columns',
                        '3' => '3 Columns',
                        '4' => '4 Columns',
                    ),
                    'default' => '3',
                ),
                array(
                    'id' => 'services_columns_tablet',
                    'type' => 'select',
                    'title' => esc_html__('Select Tablet Columns', 'freeagent'),
                    'options' => array(
                        '12' => '1 Columns',
                        '6' => '2 Columns',
                        '4' => '3 Columns',
                        '3' => '4 Columns',
                    ),
                    'default' => '6',
                ),
                array(
                    'id' => 'services_columns_mobile',
                    'type' => 'select',
                    'title' => esc_html__('Select Mobile Columns', 'freeagent'),
                    'options' => array(
                        '12' => '1 Columns',
                        '6' => '2 Columns',
                        '4' => '3 Columns',
                        '3' => '4 Columns',
                    ),
                    'default' => '12',
                ),
                array(
                    'id'       => 'services_pagination',
                    'type'     => 'select',
                    'title'    =>  esc_html__('Services Pagination Layout', 'freeagent'), 
                    'options'  => array(
                        'number' => esc_html__('Number','freeagent'),
                        'loadmore' => esc_html__('Load More','freeagent'),
                        'infinity' => esc_html__('Infinity Loader','freeagent'),
                    ),
                    'default'  => 'number',
                ),
            ),
        );
         if(!function_exists('list_meta_services')) {
            
            function list_meta_services($type) {
                $list = array();
                    if($type == 'taxonomy') { 
                    $list = array(
                    
                       'services_delivery_time' => 'Delivery Time',
                       'services_response_time' => 'Response Time',
                       'services_locations' => 'Location',
                       'services_english_level' => 'English level',
                       'services_language' => 'Language'
                    );
                    
                }
                
                return $list;
                
            }
            
        }
        $this->sections[] = array(
            'title' => esc_html__('Services Single', 'freeagent'),
            'id' => 'services-single',
            'subsection' => true,
            'fields' => array(
                array(
                    'id'       => 'services-single-title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => false,
                ),
                 array(
                    'id' => 'select-titlebar-services-single',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('services-single-title-bar-switch', '=', true),
                ),
                array(
                    'id'      => 'list_meta_services_option',
                    'type'    => 'sorter',
                    'title'   => 'General Meta Services',
                    'subtitle' => esc_html__('This meta field will display below the main services thumbnail if it is enabled.','freeagent'),
                    'options' => array(
                        'enabled'  => list_meta_services('taxonomy'),
                        'disabled' => array(
                        )
                    ),
                ),

                array(
                    'id'       => 'deli_icon',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Delivery Time Icon', 'freeagent'),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                    'default'  => 'jws-icon-calendarcheck'
                    
                ),
                array(
                    'id'       => 'deli_text',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Delivery Time title', 'freeagent'),
                    'default'  => esc_html__('Delivery time','freeagent')
                ),
                 array(
                    'id'       => 'english_icon',
                    'type'     => 'text',
                    'title'    =>  esc_html__('English level Icon', 'freeagent'),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                    'default'  => 'jws-icon-translate'
                ),
                array(
                    'id'       => 'english_text',
                    'type'     => 'text',
                    'title'    =>  esc_html__('English level title', 'freeagent'),
                    'default'  => esc_html__('English level','freeagent')
                ), 
                array(
                    'id'       => 'respon_icon',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Response time Icon', 'freeagent'),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                    'default'  => 'jws-icon-clockclockwise'
                ),
                array(
                    'id'       => 'respon_text',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Response time title', 'freeagent'),
                    'default'  => esc_html__('Response time','freeagent')
                ),  
                array(
                    'id'       => 'loca_icon',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Location Icon', 'freeagent'),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                    'default'  => 'jws-icon-maptrifold'
                ),
                array(
                    'id'       => 'loca_text',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Location title', 'freeagent'),
                    'default'  => esc_html__('Location','freeagent')
                ),               
                array(
                    'id'       => 'language_icon',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Language Icon', 'freeagent'),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                    'default'  => 'jws-icon-translate'
                ),
                array(
                    'id'       => 'language_text',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Language title', 'freeagent'),
                    'default'  => esc_html__('Language','freeagent')
                ), 
                                
            ),
        );
    
        


      // -> START Employers Fields
        $this->sections[] = array(
            'title' => esc_html__('Employers', 'freeagent'),
            'id' => 'employers',
            'customizer_width' => '300px',
            'icon' => 'el el-group',
            'fields' => array(
                
            )
        );
        $this->sections[] = array(
            'title' => esc_html__('Employers Archive', 'freeagent'),
            'id' => 'employers-archive',
            'subsection' => true,
            'fields' => array(
                array(
                    'id'       => 'employers-title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => false,
                ),
                 array(
                    'id' => 'select-titlebar-employers-archive',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('employers-title-bar-switch', '=', true),
                ),
                array(
                    'id' => 'employer_position_sidebar',
                    'type' => 'select',
                    'title' => esc_html__('Select Position Sidebar', 'freeagent'),
                    'options' => array(
                        'left' => 'Left',
                        'no_sidebar' => 'No Sidebar',
                    ),
                    'default' => 'left',
                ),
                array(         
                    'id'       => 'bg_employer',
                    'type'     => 'background',
                    'title'    =>  esc_html__('Background', 'freeagent'),
                    'subtitle' =>  esc_html__('background with image, color, etc.', 'freeagent'),
                    'desc'     =>  esc_html__('Change background for body.', 'freeagent'),
                    'default'  => array(
                        'background-color' => '#F5F7F7',
                    ),
                    'output' => array('body.post-type-archive-employers,.post-type-archive-employers .jws-filter-modal.open .modal-content, body.single-employers'),
                ),
                array(
                    'id'=>'post_per_page',
                    'type' => 'text',
                    'title' =>  esc_html__('Post Per Page', 'freeagent'),
                    'subtitle' => __('Please enter the number', 'freeagent'),
                    'validate' => 'no_html',
                    'default' => '9',
                ),
                array(
                    'id' => 'employers_columns',
                    'type' => 'select',
                    'title' => esc_html__('Select Columns Default', 'freeagent'),
                    'options' => array(
                        '1' => '1 Columns',
                        '2' => '2 Columns',
                        '3' => '3 Columns',
                        '4' => '4 Columns',
                    ),
                    'default' => '3',
                ),
                array(
                    'id' => 'employers_columns_tablet',
                    'type' => 'select',
                    'title' => esc_html__('Select Tablet Columns', 'freeagent'),
                    'options' => array(
                        '12' => '1 Columns',
                        '6' => '2 Columns',
                        '4' => '3 Columns',
                        '3' => '4 Columns',
                    ),
                    'default' => '6',
                ),
                array(
                    'id' => 'employers_columns_mobile',
                    'type' => 'select',
                    'title' => esc_html__('Select Mobile Columns', 'freeagent'),
                    'options' => array(
                        '12' => '1 Columns',
                        '6' => '2 Columns',
                        '4' => '3 Columns',
                        '3' => '4 Columns',
                    ),
                    'default' => '12',
                ),
            ),
        );
        $this->sections[] = array(
            'title' => esc_html__('Employer Single', 'freeagent'),
            'id' => 'employers-single',
            'subsection' => true,
            'fields' => array(
                array(
                    'id'       => 'employers-single-title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => false,
                ),
                 array(
                    'id' => 'select-titlebar-employers-single',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('employers-single-title-bar-switch', '=', true),
                ),
            ),
        );
        $this->sections[] = array(
            'title' => esc_html__('Membership', 'freeagent'),
            'id' => 'jws_dashboard_membership',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
            
                array(
                    'id' => 'choose-package-employer',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select template elementor for employer membership in dashboard.', 'freeagent'),
                ),
              
            )
        );
      // -> START Freelancers Fields
        $this->sections[] = array(
            'title' => esc_html__('Freelancers', 'freeagent'),
            'id' => 'freelancers',
            'customizer_width' => '300px',
            'icon' => 'el el-user',
            'fields' => array(
                
                array(
                    'id'=>'freelancer_fees',
                    'type' => 'text',
                    'title' =>  esc_html__('Freelancer Transaction fees', 'freeagent'),
                    'desc' => esc_html__('Enter the transaction fee for freelancers here; if left blank, it will use the fees from the membership packages', 'freeagent'), 
                    'subtitle' => __('Please enter integer value for %', 'freeagent'), 
                    'validate' => 'no_html',
                    'default' => '',
                ),
            )
        );
        
        $this->sections[] = array(
            'title' => esc_html__('Freelancers Archive', 'freeagent'),
            'id' => 'freelancers-archive',
            'subsection' => true,
            'fields' => array(
                    array(
                    'id'       => 'freelancers-title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => false,
                ),
                 array(
                    'id' => 'select-titlebar-freelancers-archive',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('freelancers-title-bar-switch', '=', true),
                ),
                array(
                    'id' => 'freelancers_position_sidebar',
                    'type' => 'select',
                    'title' => esc_html__('Select Position Sidebar', 'freeagent'),
                    'options' => array(
                        'left' => 'Left',
                        'no_sidebar' => 'No Sidebar',
                    ),
                    'default' => 'left',
                ),
                array(         
                    'id'       => 'bg_freelancers',
                    'type'     => 'background',
                    'title'    =>  esc_html__('Background', 'freeagent'),
                    'subtitle' =>  esc_html__('background with image, color, etc.', 'freeagent'),
                    'desc'     =>  esc_html__('Change background for body.', 'freeagent'),
                    'default'  => array(
                        'background-color' => '#F5F7F7',
                    ),
                    'output' => array('body.post-type-archive-freelancers,.post-type-archive-freelancers .jws-filter-modal.open .modal-content, body.single-freelancers'),
                ),
                array(
                    'id'=>'free_post_per_page',
                    'type' => 'text',
                    'title' =>  esc_html__('Post Per Page', 'freeagent'),
                    'subtitle' => __('Please enter the number', 'freeagent'),
                    'validate' => 'no_html',
                    'default' => '9',
                ),
                array(
                    'id' => 'freelancers_layout',
                    'type' => 'select',
                    'title' => esc_html__('Select Columns Default', 'freeagent'),
                    'options' => array(
                        'classes' => 'Classes',
                        'list' => 'List',
                    ),
                    'default' => 'classes',
                ),
                array(
                    'id' => 'freelancers_columns',
                    'type' => 'select',
                    'title' => esc_html__('Select Columns Default', 'freeagent'),
                    'options' => array(
                        '1' => '1 Columns',
                        '2' => '2 Columns',
                        '3' => '3 Columns',
                        '4' => '4 Columns',
                    ),
                    'default' => '3',
                ),
                array(
                    'id' => 'freelancers_columns_tablet',
                    'type' => 'select',
                    'title' => esc_html__('Select Tablet Columns', 'freeagent'),
                    'options' => array(
                        '12' => '1 Columns',
                        '6' => '2 Columns',
                        '4' => '3 Columns',
                        '3' => '4 Columns',
                    ),
                    'default' => '6',
                ),
                array(
                    'id' => 'freelancers_columns_mobile',
                    'type' => 'select',
                    'title' => esc_html__('Select Mobile Columns', 'freeagent'),
                    'options' => array(
                        '12' => '1 Columns',
                        '6' => '2 Columns',
                        '4' => '3 Columns',
                        '3' => '4 Columns',
                    ),
                    'default' => '12',
                ),
            ),
        );
        
        
        $this->sections[] = array(
            'title' => esc_html__('Freelancers Single', 'freeagent'),
            'id' => 'freelancers-single',
            'subsection' => true,
            'fields' => array(
                array(
                    'id'       => 'freelancers-single-title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => false,
                ),
                 array(
                    'id' => 'select-titlebar-freelancers-single',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('freelancers-single-title-bar-switch', '=', true),
                ),
                array(
                    'id'       => 'freelancers-response',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Show Response Time', 'freeagent'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'prof_profile_website_label',
                    'type'     => 'text', 
                    'title'    =>  esc_html__('Website Label', 'freeagent'),
                    'desc'     =>  esc_html__('Displayed to the clients on professional profile sidebar', 'freeagent'),
                    'default'  => 'Website',
                ),
            ),
        );
        
        $this->sections[] = array(
            'title' => esc_html__('Membership', 'freeagent'),
            'id' => 'jws_dashboard_membership2',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
            
                array(
                    'id' => 'choose-package-freelancer',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select template elementor for freelancer membership in dashboard.', 'freeagent'),
                ),
              
            )
        );
    
        // -> START Blogs Fields
        
        if ( ! function_exists( 'jws_product_rent_available_fields' ) ) {
        	/**
        	 * All available fields for Theme Settings sorter option.
        	 *
        	 * @since 4.5
        	 */
        	function jws_product_rent_available_fields() {
        		$product_attributes = array();
                $fields = array();
        		if( function_exists( 'wc_get_attribute_taxonomies' ) ) {
        			$product_attributes = wc_get_attribute_taxonomies();
        		}
            
        		if ( count( $product_attributes ) > 0 ) {
        			foreach ( $product_attributes as $attribute ) {
        				$fields[ 'pa_'.$attribute->attribute_name ] = $attribute->attribute_label;
        			}	
        		}
        
        		return $fields;
        	}
        }
    
 
        // -> START Login Register Fields
        $this->sections[] = array(
            'title' => esc_html__('Login/Register', 'freeagent'),
            'id' => 'login_register',
            'customizer_width' => '300px',
            'icon' => 'el el-unlock',
            'fields' => array(
                array(
                        'id'        => 'user_avatar',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('User Avatar', 'freeagent' ),
                        'compiler'  => 'false',
                        'subtitle'  => esc_html__('Upload your avatar default here', 'freeagent' ),
                        'default'   => array(
                            'url' => 'https://freeagent.gavencreative.com/wp-content/themes/freeagent/assets/image/avatar.png'
                        ),
                    ),
                    array(
                        'id' => 'login_form_page',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => array('post_type' => array('page'), 'posts_per_page' => -1),
                        'title' => esc_html__('Select Login Page', 'freeagent'),
                        'desc' => esc_html__('Select Page After Login Successfully From: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=page')) . '" target="_blank">Pages</a>',
                    ),
                    array(
                        'id' => 'register_form_page',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => array('post_type' => array('page'), 'posts_per_page' => -1),
                        'title' => esc_html__('Select Register Page', 'freeagent'),
                        'desc' => esc_html__('Select Page After Login Successfully From: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=page')) . '" target="_blank">Pages</a>',
                    ),
                    array(
                        'id' => 'login_form_redirect',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => array('post_type' => array('page'), 'posts_per_page' => -1),
                        'title' => esc_html__('Select Page After Login Successfully', 'freeagent'),
                        'desc' => esc_html__('Select Page After Login Successfully From: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=page')) . '" target="_blank">Pages</a>',
                    ),
                    array(
                        'id' => 'logout_form_redirect',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => array('post_type' => array('page'), 'posts_per_page' => -1),
                        'title' => esc_html__('Select Page Form Logout Redirect', 'freeagent'),
                        'desc' => esc_html__('Select Page Form Logout Redirect From: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=page')) . '" target="_blank">Pages</a>',
                    ),
                    array(
                        'id'       => 'employer_text',
                        'type'     => 'textarea',
                         'title' => esc_html__('  Employer Introduction', 'freeagent'),
                        'default' => 'I�m a client, hiring for a project',
               
                    ),
                array(
                    'id'       => 'freelancer_text',
                    'type'     => 'textarea',
                     'title' => esc_html__('Freelancer Introduction', 'freeagent'),
                    'default' => ' I�m a freelancer, looking for work',
           
                ),
                array(
                    'id'       => 'privacy-policy-link',
                    'type'     => 'text',
                   
                    'title'    =>  esc_html__(' Terms & Conditions link', 'freeagent'),
           
                ),
                array(
                    'id'       => 'services_link',
                    'type'     => 'text',
                    'title'    =>  esc_html__('  Terms of Service', 'freeagent'),
           
                ),
                array(
                    'id'       => 'agreement_link',
                    'type'     => 'text',
                    'title'    =>  esc_html__('   User Agreement', 'freeagent'),
           
                ),
                
            )
        );
    
        if ( ! function_exists( 'jws_user_featured_list' ) ) {
        	/**
        	 * All available fields for Theme Settings sorter option.
        	 *
        	 * @since 4.5
        	 */
        	function jws_user_featured_list() {
        
                $blogusers = get_users( );
                // Array of WP_User objects.
                foreach ( $blogusers as $user ) {
                    $fields[$user->ID] = $user->display_name;
                }
        
        		return $fields;
        	}
        }
    
        // -> START 404
        $this->sections[] = array(
            'title' => esc_html__('404 Page', 'freeagent'),
            'id' => '404_page',
            'desc' => esc_html__('Select Layout For 404 Page.', 'freeagent'),
            'customizer_width' => '300px',
            'icon' => 'el el-error',
            'fields' => array(
                 array(
                    'id'       => '404-off-header',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Turn Off Header', 'freeagent'),
                    'default'  => false,
                ),  
                array(
                        'id' => 'select-header-404',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                        'title' => esc_html__('Select Header 404', 'freeagent'),
                        'desc' => esc_html__('Select Header 404 from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                  'required' => array('404-off-header', '=', false),
                 ),
                 array(
                    'id'       => '404-off-footer',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Turn Off Footer', 'freeagent'),
                    'default'  => false,
                ), 
                 array(
                    'id'       => '404-off-titlebar',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Turn Off TitleBar', 'freeagent'),
                    'default'  => false,
                ),   
                 array(
                        'id' => 'select-content-404',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                        'title' => esc_html__('Select Content 404', 'freeagent'),
                        'desc' => esc_html__('Select content 404 from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                 ),
            )
        );
        
        if ( ! function_exists( 'jws_product_available_fields' ) ) {
        	/**
        	 * All available fields for Theme Settings sorter option.
        	 *
        	 * @since 4.5
        	 */
        	function jws_product_available_fields() {
        		$product_attributes = array();
                $fields = array();
        		if( function_exists( 'wc_get_attribute_taxonomies' ) ) {
        			$product_attributes = wc_get_attribute_taxonomies();
        		}
            
        		if ( count( $product_attributes ) > 0 ) {
        			foreach ( $product_attributes as $attribute ) {
        				$fields[ 'pa_' . $attribute->attribute_name ] = $attribute->attribute_label;
        			}	
        		}
        
        		return $fields;
        	}
        }
    
        // -> START Shop
        $this->sections[] = array(
            'title' => esc_html__('Shop', 'freeagent'),
            'id' => 'shop',
            'customizer_width' => '300px',
            'icon' => 'el el-shopping-cart',
            'fields' => array( 
                array(
                    'id' => 'select-header-shop',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for header elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for header elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
                array(
                    'id' => 'select-footer-shop',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for footer elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for footer elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
                array(
                    'id' => 'exclude-product-in-shop',
                    'type' => 'select',
                    'multi' => true,
                    'data' => 'posts',
                    'args' => array('post_type' => array('product'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select product and remove in shop page', 'freeagent'),
                ), 
                array(
                    'id' => 'exclude-category-in-shop',
                    'type' => 'select',
                    'multi' => true,
                    'data' => 'terms',
                    'args' => array('taxonomy' => array('product_cat'), 'hide_empty' => false),
                    'title' => esc_html__('Select category and remove in shop page', 'freeagent'),
                ), 
            )
        );
    
        $this->sections[] = array(
            'title' => esc_html__('Shop Page', 'freeagent'),
            'id' => 'shop_page',
            'subsection' => true,
            'fields' => array(
                 array(
                    'id' => 'select-titlebar-shop',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
                array(
                    'id' => 'shop_position_sidebar',
                    'type' => 'select',
                    'title' => esc_html__('Select Position Sidebar', 'freeagent'),
                    'options' => array(
                        'left' => 'Left',
                        'right' => 'Right',
                        'modal'=> 'Modal',
                        'no_sidebar' => 'No Sidebar',
                    ),
                    'default' => 'no_sidebar',
                ),
                array(
                    'id'       => 'shop-fullwidth-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Shop Full Width', 'freeagent'),
                    'default'  => false,
                ),
        
                
                array(
                    'id' => 'select-banner-before-product',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for banner before product elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for banner before product elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
                

                array(
                    'id'=>'product_per_page',
                    'type' => 'text',
                    'title' =>  esc_html__('Product Per Page', 'freeagent'),
                    'subtitle' => __('Please enter the number', 'freeagent'),
                    'validate' => 'no_html',
                    'default' => '12',
                ),
                array(
                    'id' => 'shop_columns',
                    'type' => 'select',
                    'title' => esc_html__('Select Columns Default', 'freeagent'),
                    'options' => array(
                        '1' => '1 Columns',
                        '2' => '2 Columns',
                        '3' => '3 Columns',
                        '4' => '4 Columns',
                    ),
                    'default' => '3',
                ),
                array(
                    'id' => 'shop_columns_tablet',
                    'type' => 'select',
                    'title' => esc_html__('Select Tablet Columns', 'freeagent'),
                    'options' => array(
                        '12' => '1 Columns',
                        '6' => '2 Columns',
                        '4' => '3 Columns',
                        '3' => '4 Columns',
                    ),
                    'default' => '6',
                ),
                array(
                    'id' => 'shop_columns_mobile',
                    'type' => 'select',
                    'title' => esc_html__('Select Mobile Columns', 'freeagent'),
                    'options' => array(
                        '12' => '1 Columns',
                        '6' => '2 Columns',
                        '4' => '3 Columns',
                        '3' => '4 Columns',
                    ),
                    'default' => '12',
                ),
                array(
                    'id' => 'shop_pagination_layout',
                    'type' => 'select',
                    'title' => esc_html__('Shop Pagination Layout', 'freeagent'),
                    'options' => array(
                        'number' => 'Number',
                        'loadmore' => 'Load More',
                        'infinity' => 'Infinity Loader',
                    ),
                    'default' => 'number',
                ),
                  array(
                    'id'       => 'show_rating',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Show Rating', 'freeagent'),
                    'subtitle' => __('Switch on to show rating on shop page', 'freeagent'),
                    'default'  => false,
                ),
        
            )
        );
        
        $this->sections[] = array(
            'title' => esc_html__('Shop Single', 'freeagent'),
            'id' => 'shop_single',
            'subsection' => true,
            'fields' => array(
            array(
                    'id' => 'select-single-shop-header',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for header', 'freeagent'),
                    'desc' => esc_html__('Select layout for header from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
                 array(
                    'id'       => 'product-single-title-bar-switch',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Title Bar', 'freeagent'),
                    'default'  => true,
                 ), 
                 array(
                    'id' => 'select-titlebar-shop-single',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for title bar elementor', 'freeagent'),
                    'desc' => esc_html__('Select layout for title bar elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                    'required' => array('product-single-title-bar-switch', '!=', false),
                ),
                 array(
                    'id'       => 'product-single-breadcrumb',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Switch On Breadcrumb Content Right', 'freeagent'),
                    'default'  => true,
                 ), 
  
                array(
                    'id' => 'shop_single_thumbnail_position',
                    'type' => 'select',
                    'title' => esc_html__('Thumbnail Position', 'freeagent'),
                    'options' => array(
                        'left' => 'Left',
                        'right' => 'Right',
                        'bottom' => 'Bottom',
                        'bottom2' => 'Bottom 3 Item',
                    ),
                    'default' => 'left',
                ),
                array(
                    'id' => 'shop_related_item',
                    'type' => 'select',
                    'title' => esc_html__('Select Related Item Number', 'freeagent'),
                    'options' => array(
                        '3' => '3 Item',
                        '4' => '4 Item',
                        '5' => '5 Item',
                    ),
                    'default' => '4',
                ),
        		array(
            		'id'       => 'shop_single_info_more',
            		'type'     => 'editor',
            		'args'     => array(
            			'teeny'         => false,
            			'wpautop'       => false,
            			'quicktags'     => 1,
            			'textarea_rows' => 10,
            		),
            		'title'    => esc_html__( 'Shop Single Info More', 'freeagent' ),
            		'desc'     => esc_html(	'Display info Shipping tax ....'), 
            	),
            )
        );
    
    
        $this->sections[] = array(
            'title' => esc_html__('My Account', 'freeagent'),
            'id' => 'shop_account',
            'subsection' => true,
            'fields' => array(
                array(
                    'id' => 'select-shop-form-login',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for content my account', 'freeagent'),
                    'desc' => esc_html__('Select layout for layout elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
            )
        );
    
        $this->sections[] = array(
            'title' => esc_html__('Wishlist', 'freeagent'),
            'id' => 'wishlist',
            'subsection' => true,
            'fields' => array(
               			array (
        				'id'       => 'wishlist',
        				'type'     => 'switch',
        				'title'    => esc_html__( 'Enable wishlist', 'freeagent' ),
        				'subtitle' => esc_html__( 'Enable wishlist functionality built in with the theme. Read more information in our documentation.', 'freeagent' ),
        				'default'  => true
        			),
        			array(
        				'id'       => 'wishlist_page',
        				'type'     => 'select',
        				'multi'    => false,
        				'data'     => 'posts',
        				'args'     => array( 'post_type' =>  array( 'page' ), 'numberposts' => -1 ),
        				'title'    => esc_html__( 'Wishlist page', 'freeagent' ),
        				'subtitle' => esc_html__( 'Select a page for wishlist table. It should contain the shortcode: [jws_wishlist]', 'freeagent' ),
        			),
        			array (
        				'id'       => 'empty_wishlist_text',
        				'type'     => 'textarea',
        				'title'    => esc_html__('Empty wishlist text', 'freeagent'),
        				'subtitle' => esc_html__('Text will be displayed if user don\'t add any products to wishlist', 'freeagent'),      
        				'default'  => 'No products added in the wishlist list. You must add some products to wishlist them.<br> You will find a lot of interesting products on our "Shop" page.',
        				'class'   => 'without-border'
        			),
            )
        );

    
        if(!function_exists('jws_option_categories_for_jws')) {
        function jws_option_categories_for_jws($taxonomy, $select = 1)
            {
                $data = array();
            
                $query = new \WP_Term_Query(array(
                    'hide_empty' => true,
                    'taxonomy'   => $taxonomy,
                ));
                if ($select == 1) {
                    $data['all'] = 'All';
                }
            
                if (! empty($query->terms)) {
                    foreach ($query->terms as $cat) {
                        $data[ $cat->slug ] = $cat->name;
                    }
                }
            
                return $data;
            }  
        }
    
        // -> START Typography
        $this->sections[] = array(
            'title' => esc_html__('Typography', 'freeagent'),
            'id' => 'typography',
            'icon' => 'el el-text-width',
            'fields' => array(
                array(
                    'id' => 'opt-typography-body',
                    'type' => 'typography',
                    'title' => esc_html__('Body Font', 'freeagent'),
                    'subtitle' => esc_html__('Specify the body font properties.', 'freeagent'),
                    'google' => true,
                    'color' => false,
                    
                    'subsets' => false,
                    'default'     => array(
                        'font-weight'  => '400', 
                        'font-style' => 'normal',
                        'font-family' => 'Space Grotesk', 
                    ),
                    'output' => array('body'),
                ),
                         array(
                        'id' => 'opt-typography-font2',
                        'type'        => 'typography', 
                        'title'       => esc_html__('Heading Font', 'freeagent'),
                        'google'      => true, 
                        'font-backup' => false,
                        'units'       =>'px',
                        'subsets'     => false,
                        'font-size'   => false,
                        'line-height' => false,
                        'text-align'  => false,
                        'color' => false,
                        'subtitle'    => esc_html__('Typography option with button, h1, h2, h3, h4, h5, h6 can be called individually.', 'freeagent'),
                        'default'     => array(
                            'font-weight'  => '600', 
                            'font-style' => 'normal',
                            'font-family' => 'Inter', 
                        ),
                         'output' => array('h1','h3','h4','h5','h6'),
                    ),
                
                array(
                    'id' => 'opt-typography-h1',
                    'type' => 'typography',
                    'title' => esc_html__('H1 Font', 'freeagent'),
                    'subtitle' => esc_html__('Specify the h1 font properties.', 'freeagent'),
                    'google' => true,
                    'subsets' => false,
                    'color' => false,
                    'output' => array('h1'),
                ),
                array(
                    'id' => 'opt-typography-h2',
                    'type' => 'typography',
                    'title' => esc_html__('H2 Font', 'freeagent'),
                    'subtitle' => esc_html__('Specify the h2 font properties.', 'freeagent'),
                    'google' => true,
                    'subsets' => false,
                    'color' => false,
                    'output' => array('h2'),
                ),
                array(
                    'id' => 'opt-typography-h3',
                    'type' => 'typography',
                    'title' => esc_html__('H3 Font', 'freeagent'),
                    'subtitle' => esc_html__('Specify the h3 font properties.', 'freeagent'),
                    'google' => true,
                    'subsets' => false,
                    'color' => false,
                    'output' => array('h3'),
                ),
                array(
                    'id' => 'opt-typography-h4',
                    'type' => 'typography',
                    'title' => esc_html__('H4 Font', 'freeagent'),
                    'subtitle' => esc_html__('Specify the h4 font properties.', 'freeagent'),
                    'google' => true,
                    'color' => false,
                    'subsets' => false,
                    'output' => array('h4'),
                ),
                array(
                    'id' => 'opt-typography-h5',
                    'type' => 'typography',
                    'title' => esc_html__('H5 Font', 'freeagent'),
                    'subtitle' => esc_html__('Specify the h5 font properties.', 'freeagent'),
                    'google' => true,
                    'subsets' => false,
                    'color' => false,
                    'output' => array('h5'),
                ),
                array(
                    'id' => 'opt-typography-h6',
                    'type' => 'typography',
                    'title' => esc_html__('H6 Font', 'freeagent'),
                    'subtitle' => esc_html__('Specify the h6 font properties.', 'freeagent'),
                    'google' => true,
                    'color' => false,
                    'subsets' => false,
                    'output' => array('h6'),
                ),
                
                
          
          
            )
        );
    
        // -> START API Fields
        $this->sections[] = array(
            'title' => esc_html__('API And Other Setting', 'freeagent'),
            'id' => 'api',
            'customizer_width' => '300px',
            'icon' => 'el el-network',
            'fields' => array(
            
                array(
                    'id' => 'google_api',
                    'type' => 'text',
                    'title' => esc_html__('Google API Key', 'freeagent'),
                    'default' => '',
                ),
                array(
                    'id' => 'theme_address',
                    'type' => 'text',
                    'title' => esc_html__('Site Address', 'freeagent'),
                    'default' => '',
                ),
                array(
                        'id'       => 'chat_realtime',
                        'type'     => 'switch', 
                        'title'    =>  esc_html__('Enabled Chat Real Time', 'freeagent'),
                        'default'  => true,
                        'on'       => __('Enabled', 'freeagent'),
			            'off'      => __('Disabled', 'freeagent'),
                ),
                array(
                        'id'       => 'demo_mode',
                        'type'     => 'switch', 
                        'title'    =>  esc_html__('Enabled Demo Mode', 'freeagent'),
                        'subtitle' => esc_html__('When enabled, it will block users from using functions that interact with data, for example creating jobs', 'freeagent'),
                        'default'  => false,
                        'on'       => __('Enabled', 'freeagent'),
			            'off'      => __('Disabled', 'freeagent'),
                ),
           
            )
        );
        $this->sections[] = array(
            'title' => esc_html__('Shortcode', 'freeagent'),
            'id' => 'jws_shortcode',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
            
                array(
                    'id'   => 'jws_db_create_post',
                    'title' => '[jws_db_create_post]',
                    'type' => 'info',
                    'desc' => __('This is the shortcode that displays the job or service creation button in the header.', 'freeagent')
                ),
                array(
                    'id'   => 'jws_db_notifications',
                    'title' => '[jws_db_notifications] ',
                    'type' => 'info',
                    'desc' => __('This is the shortcode that displays the notifications in the header.', 'freeagent')
                ),    
                array(
                    'id'   => 'jws_db_wishlist',
                    'title' => '[jws_db_wishlist] ',
                    'type' => 'info',
                    'desc' => __('This is the shortcode that displays the wishlist in the header.', 'freeagent')
                ),
                array(
                    'id'   => 'jws_chat_admin',
                    'title' => '[jws_chat_admin] ',
                    'type' => 'info',
                    'desc' => __('This is a shortcode that displays the chat form according to the id of the currently logged in user. If you use parameter, it will be displayed according to that id.agent','freeagent').
                              '<br>Example: [jws_chat_admin id="1"]'                    
                ),   
                array(
                    'id'   => 'jws_page_title',
                    'title' => '[page_title] ',
                    'type' => 'info',
                    'desc' => __('This is a shortcode that displays the title of the page.','freeagent').
                              '<br>Example: [page_title id="1"]'                    
                ),
                   
                array(
                    'id'   => 'jws_menu_dashboard',
                    'title' => '[jws_menu_dashboard] ',
                    'type' => 'info',
                    'desc' => __('This is a shortcode that displays the dropdown menu list of the dashboard.','freeagent')        .
                              '<br>Example: [jws_menu_dashboard]'                    
                ), 
                array(
                    'id'   => 'jws_jobs_location_search',
                    'title' => '[jws_jobs_location_search] ',
                    'type' => 'info',
                    'desc' => __('This is a shortcode that displays the job location search form.','freeagent').
                              '<br>Example: [jws_jobs_location_search]'                    
                ),                                          
            )
        );
    
          $this->sections[] = array(
            'title' => esc_html__('Custom Slug For Url', 'freeagent'),
            'id' => 'url_slug',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
               array(
                    'id'    => 'jws_slug_info',
                    'type'  => 'info',
                    'title' => __('Note!', 'freeagent'),
                    'style' => 'warning',
                    'desc' => esc_html__('After changing the slug, save the permalink to update the data. ', 'freeagent') . '<a href="'.esc_url(admin_url('/options-permalink.php')).'" target="_blank">Permalink option</a>',
               ),
               array(
                    'id' => 'freelancers_slug',
                    'type' => 'text',
                    'title' => esc_html__('Freelancers Slug', 'freeagent'),
                    'desc'  => 'Default slug is "freelancers" ',
                    'default' => '',
               ),
               array(
                    'id' => 'employers_slug',
                    'type' => 'text',
                    'title' => esc_html__('Employers Slug', 'freeagent'),
                    'desc'  => 'Default slug is "employers" ',
                    'default' => '',
               ),
               array(
                    'id' => 'jobs_slug',
                    'type' => 'text',
                    'title' => esc_html__('Jobs Slug', 'freeagent'),
                    'desc'  => 'Default slug is "jobs" ',
                    'default' => '',
               ),
               array(
                    'id' => 'services_slug',
                    'type' => 'text',
                    'title' => esc_html__('Services Slug', 'freeagent'),
                    'desc'  => 'Default slug is "services" ',
                    'default' => '',
               ),
               
                                                       
            )
        );
        // -> START API Fields
        $this->sections[] = array(
            'title' => esc_html__('Newsletter Popup', 'freeagent'),
            'id' => 'newsletter_popup',
            'customizer_width' => '300px',
            'icon' => 'el el-envelope',
            'fields' => array(
               array(
                    'id'       => 'newsletter_enble',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Enable Newsletter', 'freeagent'),
                    'default'  => false,
                    'desc'      =>  esc_html__('Enable Newsletter Popup For Site.', 'freeagent'),
               ), 
               array(
            		'id'       => 'newsletter_content',
            		'type'     => 'editor',
            		'args'     => array(
            			'teeny'         => false,
            			'wpautop'       => false,
            			'quicktags'     => 1,
            			'textarea_rows' => 10,
            		),
            		'title'    => esc_html__( 'Content Form', 'freeagent' ),
            	),
                array(
                    'id' => 'newsletter_no_thank',
                    'type' => 'text',
                    'title' => esc_html__('No Thank Text', 'freeagent'),
               ),
               array(         
                    'id'       => 'newsletter_bg',
                    'type'     => 'background',
                    'title'    =>  esc_html__('Background', 'freeagent'),
                    'subtitle' =>  esc_html__('background with image, color, etc.', 'freeagent'),
                    'desc'     =>  esc_html__('Change background for newsletter popup.', 'freeagent'),
                    'default'  => array(
                        'background-color' => '#ebebeb',
                    ),
                    'output' => array('.newsletter-bg'),
                ),
            )
        );
        
        // -> START Payment transactions Fields
        $this->sections[] = array(
            'title' => esc_html__('Payment', 'freeagent'),
            'id' => 'jws_payment',
            'customizer_width' => '300px',
            'icon' => 'el el-credit-card',
            'fields' => array(
               array(
                    'id'       => 'auto_payment_complete',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Automatically confirm orders', 'freeagent'),
                    'desc'     =>  esc_html__('Automatically confirm successful purchase of membership package or deposit money into wallet when activating the function.', 'freeagent'),
                    'default'  => false,
               ),
            )
        );
  
        
        $this->sections[] = array(
            'title' => esc_html__('Wallet', 'freeagent'),
            'id' => 'jws_wallet',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
            
                 array(
                    'id' => 'wallet_product',
                    'type' => 'select',
                    'multi' => false,
                    'data' => 'posts',
                    'args' => array('post_type' => array('product'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select product for wallet', 'freeagent'),
                ),    
              
            )
        );
        
        $this->sections[] = array(
            'title' => esc_html__('Payouts', 'freeagent'),
            'id' => 'jws_payouts',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
            
               array(
        			'id'       => 'payout_processing_fee',
        			'type'     => 'text',
        			'title'    => __('Payouts Processing Fee', 'freeagent'),
        			'desc' 		=> __('only numeric allowed without currency symbol and decimal', 'freeagent'),
        			'default'  => __('0', 'freeagent'),
        			'validate' => 'numeric',
        		),
                array(
        			'id'       => 'payout_min_price',
        			'type'     => 'text',
        			'title'    => __('Payouts Min Price', 'freeagent'),
        			'desc' 		=> __('only numeric allowed without currency symbol and decimal', 'freeagent'),
        			'default'  => __('0', 'freeagent'),
        			'validate' => 'numeric',
        		),
                array(
                    'id'       => 'auto_payout_complete',
                    'type'     => 'switch', 
                    'title'    =>  esc_html__('Automatically confirm payout', 'freeagent'),
                    'desc'     =>  esc_html__('Automatically confirm successful payout when activating the function.', 'freeagent'),
                    'default'  => false,
                ),
              
            )
        );
        
 
          // -> START Dashboard Fields
        $this->sections[] = array(
            'title' => esc_html__('Dashboard', 'freeagent'),
            'id' => 'jws_dashboard',
            'customizer_width' => '300px',
            'icon' => 'el el-home',
            'fields' => array(
                array(
                    'id' => 'select-page-dashboard',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('page'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select page for freelancer , dashboard.', 'freeagent'),
                    'desc' => esc_html__('Select from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=page')) . '" target="_blank">Pages</a>',
                ),
                array(
                    'id'        => 'logo_dashboard',
                    'type'      => 'media',
                    'url'       => true,
                    'title'     => esc_html__('Logo Dashboard', 'freeagent' ),
                    'compiler'  => 'false',
                    'subtitle'  => esc_html__('Upload your logo', 'freeagent' ),
                ),
                array(
                    'id' => 'select-header-dashboard',
                    'type' => 'select',
                    'data' => 'posts',
                    'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select layout for header dashboard', 'freeagent'),
                    'desc' => esc_html__('Select layout for header elementor from: ', 'freeagent') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
                ),
                array(
                    'id'=>'dahsboard_post_per_page',
                    'type' => 'text',
                    'title' =>  esc_html__('Post Per Page', 'freeagent'),
                    'subtitle' => __('Please enter the number', 'freeagent'),
                    'validate' => 'no_html',
                    'default' => '5',
                ),
                array(
                    'id'       => 'save_project_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Saved Projects', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'saved_services_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Saved Services', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'followed_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Followed', 'freeagent'),
                   'desc'    =>  esc_html__('A short description followed by employers and freelancers will be shown on the dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'membership_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description membership', 'freeagent'),
                   'desc'    =>  esc_html__('A short description membership will be shown on the dashboard', 'freeagent'),
                    'default'  => 'We offer the best price packages for you to start with a great experience.'
                ),
                array(
                    'id'       => 'statements_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Statements', 'freeagent'),
                   'desc'    =>  esc_html__('A short description statements of employers and freelancers will be shown on the dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'payouts_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Payouts', 'freeagent'),
                   'desc'    =>  esc_html__('A short description Payouts of employers and freelancers will be shown on the dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                
                array(
                    'id'       => 'invoices_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Invoices', 'freeagent'),
                   'desc'    =>  esc_html__('A short description Invoices of employers and freelancers will be shown on the dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'dispute_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Dispute', 'freeagent'),
                   'desc'    =>  esc_html__('A short description Dispute of employers and freelancers will be shown on the dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'chat_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Chat', 'freeagent'),
                   'desc'    =>  esc_html__('A short description Chat of employers and freelancers will be shown on the dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
          
            )
        );
 

        if(!function_exists('redux_dashboard_menu')) {
            
            function redux_dashboard_menu($type) {
                $menu = array();
                if($type == 'general') {
                    
                    $menu = array(
                    
                       'dashboard' => 'Dashboard',
                       'membership' => 'Membership',
                       'statements' => 'Statements',
                       'payouts' => 'Payouts',
                       'invoices' => 'Invoices',
                       'dispute' => 'Dispute',
                       'chat' => 'Chat',
                       'verify' => 'Verify',
                       'services_saved' => 'Services saved',
                       'followed' => 'Followed',
                       'proposals' => 'Proposals',
                       'jobs_saved' => 'Jobs saved',
   
                       
                    );
                    
                }
                
                return $menu;
                
            }
            
        }
        
        $this->sections[] = array(
            'title' => esc_html__('Sidebar Menu', 'freeagent'),
            'id' => 'menu-dashboard',
            'subsection' => true,
            'fields' => array(
            
               array(
                    'id'      => 'dashboard_general_menu_option',
                    'type'    => 'sorter',
                    'title'   => 'General Menu',
                    'options' => array(
                        'enabled'  => redux_dashboard_menu('general'),
                        'disabled' => array(
                        )
                    ),
                ),
                array(
                    'id'        => 'das_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Dashboard Icon', 'freeagent' ),
                     'default'  => 'jws-icon-squaresfour',
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',

                ),
                array(
                    'id'        => 'proposal_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('My Proposals Icon', 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-clipboardtext',
                ),            
                 array(
                    'id'        => 'project_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Saved Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-bookmark-outline',
                ),       
                array(
                    'id'        => 'followed_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Followed Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-usercircleplus',
                ),        
                array(
                    'id'        => 'membership_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Membership Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-cube',
                ),   
                array(
                    'id'        => 'statements_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Statements Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-article',
                ),  
                array(
                    'id'        => 'payouts_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Payouts Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-currencycircledollar',
                ),   
                array(
                    'id'        => 'invoices_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Invoices Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-filetext',
                ),  
                array(
                    'id'        => 'chat_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Chat Dashboard Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-chat',
                ),   
                array(
                    'id'        => 'dispute_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Dispute Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-shieldcheck',
                ),  
                array(
                    'id'        => 'verify_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Verify Identity Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-identificationcard',
                ),    
                array(
                    'id'        => 'job_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Jobs Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-suitcasesimple-1',
                ),    
                array(
                    'id'        => 'service_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Services Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-harddrives',
                ),       
                array(
                    'id'        => 'addons_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Addons Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-archive',
                ),  
                array(
                    'id'        => 'porfolios_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Porfolios Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-presentationchart',
                ), 
                array(
                    'id'        => 'setting_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Settings Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-gear',
                ),
                 array(
                    'id'        => 'logout_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Logout Icon' , 'freeagent' ),
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',
                     'default'  => 'jws-icon-signout',
                ),  
                array(
                    'id'        => 'switch_icon',
                    'type'      => 'text',
                    'title'     => esc_html__('Switch Account Icon', 'freeagent' ),
                     'default'  => 'jws-icon-arrows-clockwise',
                    'desc' => esc_html__('Enter the class name of the Font Awesome icon. You can find the list of icons ', 'freeagent') . '<a href="https://fontawesome.com/icons" target="_blank">here</a>',

                ),                                         
            )
        );
        $this->sections[] = array(
            'title' => esc_html__('Jobs', 'freeagent'),
            'id' => 'jobs-dashboard',
            'subsection' => true,
            'fields' => array(
            
                array(
                    'id'       => 'create_job_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Create Job', 'freeagent'),
                'desc'    =>  esc_html__('A short description will be shown on the Create Job menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'posted_job_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Posted Job', 'freeagent'),
                'desc'    =>  esc_html__('A short description will be shown on the Posted Job menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'ongoing_job_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Ongoing Job', 'freeagent'),
                'desc'    =>  esc_html__('A short description will be shown on the Ongoing Job menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'completed_job_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Completed Job', 'freeagent'),
                'desc'    =>  esc_html__('A short description will be shown on the Completed Job menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'cancel_job_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Cancel Job', 'freeagent'),
                'desc'    =>  esc_html__('A short description will be shown on the Cancel Job menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'detail_job_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description History Job', 'freeagent'),
                'desc'    =>  esc_html__('A short description will be shown on the History Job menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'manage_proposal_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Manage proposals', 'freeagent'),
                'desc'    =>  esc_html__('A short description will be shown on the Manage proposals dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
            )
        );
        $this->sections[] = array(
            'title' => esc_html__('Services', 'freeagent'),
            'id' => 'services-dashboard',
            'subsection' => true,
            'fields' => array(
               
                array(
                    'id'       => 'create_service_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Create service', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Create service menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                 array(
                    'id'       => 'posted_service_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Posted service', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Posted service menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'ongoing_service_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Ongoing service', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Ongoing service menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'completed_service_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Completed service', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Completed service menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'cancel_service_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Cancel service', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Cancel service menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'detail_service_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description History service', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the history service menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
            )
        );
        $this->sections[] = array(
            'title' => esc_html__('Add-ons', 'freeagent'),
            'id' => 'addons-dashboard',
            'subsection' => true,
            'fields' => array(
            array(
                    'id'       => 'create_addon_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Create Addon service', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Create Addon service menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                 array(
                    'id'       => 'posted_addon_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Posted Addon service', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Posted Addon service menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
            )
        );
        $this->sections[] = array(
            'title' => esc_html__('Portfolios', 'freeagent'),
            'id' => 'portfolios-dashboard',
            'subsection' => true,
            'fields' => array(
            array(
                    'id'       => 'create_portfolios_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Create Portfolios', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Portfolios menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                 array(
                    'id'       => 'posted_portfolios_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Posted Portfolios', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the My Portfolios dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
            )
        );
        $this->sections[] = array(
            'title' => esc_html__('Settings', 'freeagent'),
            'id' => 'settings-dashboard',
            'subsection' => true,
            'fields' => array(
            array(
                    'id'       => 'profile_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Profile Settings', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Profile Settings menu dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                 array(
                    'id'       => 'billing_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Billing information', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Billing information dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
                array(
                    'id'       => 'accounnt_des',
                    'type'     => 'text',
                    'title'    =>  esc_html__('Short description Account Settings', 'freeagent'),
                   'desc'    =>  esc_html__('A short description will be shown on the Account Settings dashboard', 'freeagent'),
                    'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                ),
            )
        );
         $this->sections[] = array(
            'title' => esc_html__('Email Content', 'freeagent'),
            'id' => 'jws_email_content',
            'customizer_width' => '300px',
            'icon' => 'el el-envelope-alt',
            'fields' => array()
        );
        
        $this->sections[] = array(
            'title' => esc_html__('Email For Admin', 'freeagent'),
            'id' => 'jws_email_for_admin',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
                array(
        			'id'       => 'email_admin',
        			'type'     => 'text',
        			'title'    => __('Email get messenger', 'freeagent'),
        			'default'  => __('freeagentjws@gmail.com', 'freeagent'),
        		),
                array(
        			'id'       => 'email_subject_admin',
        			'type'     => 'text',
        			'title'    => __('Subject', 'freeagent'),
        			'default'  => __('You have a job offer', 'freeagent'),
        		),
               	array(
    				'id'       => 'email_body_admin',
    				'type'     => 'editor',
    				'args'     => array(
    					'teeny'         => false,
    					'wpautop'       => false,
    					'quicktags'     => 1,
    					'textarea_rows' => 25,
    				),
    				'title'    => esc_html__( 'Html Content', 'freeagent' ),
    				'desc'     => esc_html(	'Email Content : #content#'),  
    				'default'  => '',
    			), 
              
            )
        );
        
        $this->sections[] = array(
            'title' => esc_html__('Freelancer Invitation', 'freeagent'),
            'id' => 'jws_email_content_freelancer_invitation',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
            
                 array(
        			'id'       => 'email_subject_freelancer_invitation',
        			'type'     => 'text',
        			'title'    => __('Subject', 'freeagent'),
        			'default'  => __('You have a job offer', 'freeagent'),
        		),
               	array(
    				'id'       => 'email_body_freelancer_invitation',
    				'type'     => 'editor',
    				'args'     => array(
    					'teeny'         => false,
    					'wpautop'       => false,
    					'quicktags'     => 1,
    					'textarea_rows' => 25,
    				),
    				'title'    => esc_html__( 'Html Content', 'freeagent' ),
    				'desc'     => esc_html(	'Job Name : #job_name#,<br>Message : #message#<br>Job type : #job_type#<br>Budget : #budget#'),  
    				'default'  => '',
    			), 
              
            )
        );
        
        $this->sections[] = array(
            'title' => esc_html__('Employer Contact', 'freeagent'),
            'id' => 'jws_email_content_employer_contact',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
            
                 array(
        			'id'       => 'email_subject_employer_contact',
        			'type'     => 'text',
        			'title'    => __('Subject', 'freeagent'),
        			'default'  => __('You have a job offer', 'freeagent'),
        		),
               	array(
    				'id'       => 'email_body_employer_contact',
    				'type'     => 'editor',
    				'args'     => array(
    					'teeny'         => false,
    					'wpautop'       => false,
    					'quicktags'     => 1,
    					'textarea_rows' => 25,
    				),
    				'title'    => esc_html__( 'Html Content', 'freeagent' ),
    				'desc'     => esc_html(	'Email : #email#,<br>Phone : #phone#,<br>Message : #message#'),  
    				'default'  => '',
    			), 
              
            )
        );
        
            
        $this->sections[] = array(
            'title' => esc_html__('Missing Meassage', 'freeagent'),
            'id' => 'jws_email_content_miss_meassage_contact',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
            
                 array(
        			'id'       => 'email_subject_miss_message',
        			'type'     => 'text',
        			'title'    => __('Subject', 'freeagent'),
        			'default'  => __('You have a new message.', 'freeagent'),
        		),
               	array(
    				'id'       => 'email_body_miss_message',
    				'type'     => 'editor',
    				'args'     => array(
    					'teeny'         => false,
    					'wpautop'       => false,
    					'quicktags'     => 1,
    					'textarea_rows' => 25,
    				),
    				'title'    => esc_html__( 'Html Content', 'freeagent' ),
    				'desc'     => esc_html(	'From : #chat_sender#,<br>Message : #message# <br> #view_message#'),  
    				'default'  => 'From : #chat_sender# <br>Message : #message# <br> #view_message#',
    			), 
              
            )
        );
        
        $this->sections[] = array(
            'title' => esc_html__('Buy Service', 'freeagent'),
            'id' => 'jws_email_content_buy_service_contact',
            'subsection' => true,
            'customizer_width' => '300px',
            
            'fields' => array(
            
                 array(
        			'id'       => 'email_subject_buy_service',
        			'type'     => 'text',
        			'title'    => __('Subject', 'freeagent'),
        			'default'  => __('Successfully sold service.', 'freeagent'),
        		),
               	array(
    				'id'       => 'email_body_buy_service',
    				'type'     => 'editor',
    				'args'     => array(
    					'teeny'         => false,
    					'wpautop'       => false,
    					'quicktags'     => 1,
    					'textarea_rows' => 25,
    				),
    				'title'    => esc_html__( 'Html Content', 'freeagent' ),
    				'desc'     => esc_html(	'Buyer : #buyer# <br>Service : #service#'),  
    				'default'  => 'Buyer : #buyer# <br>Service : #service#',
    			), 
              
            )
        );
        /** Custom Sections */
        $this->sections[] = array(
            'title' => esc_html__('Custom Settings', 'freeagent'),
            'id' => 'jws_custom_settings',
            'customizer_width' => '300px',
            'icon' => 'el el-envelope-alt',
            'fields' => array()
        );
        $this->sections[] = array(
            'title' => esc_html__('Professional Settings', 'freeagent'),
            'id' => 'jws_custom_settings_nik_prof',
            'subsection' => true,
            'customizer_width' => '300px',            
            'fields' => array(
                array(
                    'id'       => 'professional_form_page',
                    'type'     => 'select',
                    'title'    => __('Select Professional Dashboard Page', 'freeagent'),
                    'options'  => $this->get_wp_pages(), 
                ),
                array(
                    'id'       => 'professional_form_id',
                    'type'     => 'select',
                    'title'    => __('Select Professional Form', 'freeagent'),
                    'options'  => $this->get_fluent_forms(), // Call a method to get form options
                ),
                array(
                    'id'       => 'professional_title',
                    'type'     => 'select',
                    'title'    => __('Select the professional position field', 'freeagent'),
                    'desc' => esc_html__('Select the professional position field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'select'),                    
                ),                
                array(
                    'id'       => 'professional_form_fields',
                    'type'     => 'select',
                    'multi'    =>  true,
                    'title'    => __('I am also a... (fields)', 'freeagent'),
                    'desc' => esc_html__('Select all the checkbox fields with I am also', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id','input_checkbox', true),                    
                ),
                array(
                    'id'       => 'professional_city_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional city field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional city field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'select'),                    
                ),
                array(
                    'id'       => 'professional_country_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional country field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional country field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'select'),                    
                ),
                array(
                    'id'       => 'professional_service_type_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional service type field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional service type field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_checkbox'),                    
                ),
                array(
                    'id'       => 'professional_gender_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional gender field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional gender field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_radio'),                    
                ),
                array(
                    'id'       => 'professional_fee_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional fee field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional fee field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_number'),                    
                ),
                array(
                    'id'       => 'professional_name_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional Name field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional Name field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_name'),                    
                ),
                array(
                    'id'       => 'professional_business_name_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional business name field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional business name field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_text'),                    
                ),
                array(
                    'id'       => 'professional_email_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional email field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional email field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_email'),                    
                ),
                array(
                    'id'       => 'professional_password_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional password field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional password field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_password'),                    
                ),
                array(
                    'id'       => 'professional_website_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional website field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional website field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_url'),                    
                ),
                array(
                    'id'       => 'professional_phone_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional phone number field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional phone number field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'phone'),                    
                ),
                array(
                    'id'       => 'professional_brief_description_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional brief description field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional brief description field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'textarea'),                    
                ),
                array(
                    'id'       => 'professional_links_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional links field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional links field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'repeater_field'),                    
                ),
                array(
                    'id'       => 'professional_reference_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional reference field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional reference field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_text'),                    
                ),
                array(
                    'id'       => 'professional_subscribe_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional subscribe field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional subscribe field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'terms_and_condition'),                    
                ),
                
                array(
                    'id'       => 'professional_terms_conditions_field',
                    'type'     => 'select',
                    'title'    => __('Select the professional terms and conditions field', 'freeagent'),
                    'desc'     => esc_html__('Select the professional terms and conditions field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'terms_and_condition'),                    
                ),
                array(
                    'id'       => 'professional_ft_image_field',
                    'type'     => 'select',
                    'title'    => __('Select the Featured Image', 'freeagent'),
                    'desc' => esc_html__('Select Featured Image field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_image'),                    
                ),
                array(
                    'id'       => 'professional_portfolio_field',
                    'type'     => 'select',
                    'title'    => __('Select the Portfolio Image Field', 'freeagent'),
                    'desc' => esc_html__('Select Featured Image field', 'freeagent'),
                    'required' => array('professional_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('professional_form_id', 'input_image'),                    
                ),
                
            )
        );        
        $this->sections[] = array(
            'title' => esc_html__('Client Settings', 'freeagent'),
            'id' => 'jws_custom_settings_nik_client',
            'subsection' => true,
            'customizer_width' => '300px',            
            'fields' => array(        
                array(
                    'id'       => 'client_form_page',
                    'type'     => 'select',
                    'title'    => __('Select Client Dashboard Page', 'freeagent'),
                    'options'  => $this->get_wp_pages(), 
                ),        
                array(
                    'id'       => 'client_form_id',
                    'type'     => 'select',
                    'title'    => __('Select Client Form', 'freeagent'),
                    'options'  => $this->get_fluent_forms(), // Call a method to get form options
                ),
                array(
                    'id'       => 'client_title',
                    'type'     => 'select',
                    'title'    => __('Select the client position field', 'freeagent'),
                    'desc' => esc_html__('Select the client position field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'select'),                    
                ),                
                array(
                    'id'       => 'client_city_field',
                    'type'     => 'select',
                    'title'    => __('Select the client city field', 'freeagent'),
                    'desc'     => esc_html__('Select the client city field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'select'),                    
                ),
                array(
                    'id'       => 'client_country_field',
                    'type'     => 'select',
                    'title'    => __('Select the client country field', 'freeagent'),
                    'desc'     => esc_html__('Select the client country field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'select'),                    
                ),
                array(
                    'id'       => 'client_venue_field',
                    'type'     => 'select',
                    'title'    => __('Select the client venue field', 'freeagent'),
                    'desc'     => esc_html__('Select the client venue field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'input_text'),                    
                ),
                array(
                    'id'       => 'client_service_type_field',
                    'type'     => 'select',
                    'title'    => __('Select the client service type field', 'freeagent'),
                    'desc'     => esc_html__('Select the client service type field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'input_checkbox'),                    
                ),
                array(
                    'id'       => 'client_gender_field',
                    'type'     => 'select',
                    'title'    => __('Select the client gender field', 'freeagent'),
                    'desc'     => esc_html__('Select the client gender field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'input_radio'),                    
                ),
                array(
                    'id'       => 'client_other_gender_field',
                    'type'     => 'select',
                    'title'    => __('Select the client other gender field', 'freeagent'),
                    'desc'     => esc_html__('Select the client other gender field field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'input_text'),                    
                ),                
                array(
                    'id'       => 'client_date_event_field',
                    'type'     => 'select',
                    'title'    => __('Select the client Event Date field', 'freeagent'),
                    'desc'     => esc_html__('Select the field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'input_date'),                    
                ),
                array(
                    'id'       => 'client_hours_field',
                    'type'     => 'select',
                    'title'    => __('Select the client required hours field', 'freeagent'),
                    'desc'     => esc_html__('Select the client required hours field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'select'),                    
                ),
                array(
                    'id'       => 'client_budget_field',
                    'type'     => 'select',
                    'title'    => __('Select the client fee field', 'freeagent'),
                    'desc'     => esc_html__('Select the client fee field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'input_number'),                    
                ),
                array(
                    'id'       => 'client_spec_req_field',
                    'type'     => 'select',
                    'title'    => __('Select the client specific requirement field', 'freeagent'),
                    'desc'     => esc_html__('Select the field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'textarea'),                    
                ),
                array(
                    'id'       => 'client_name_field',
                    'type'     => 'select',
                    'title'    => __('Select the client Name field', 'freeagent'),
                    'desc'     => esc_html__('Select the client Name field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'input_name'),                    
                ),
                array(
                    'id'       => 'client_email_field',
                    'type'     => 'select',
                    'title'    => __('Select the client email field', 'freeagent'),
                    'desc'     => esc_html__('Select the client email field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'input_email'),                    
                ),
                array(
                    'id'       => 'client_password_field',
                    'type'     => 'select',
                    'title'    => __('Select the client password field', 'freeagent'),
                    'desc'     => esc_html__('Select the client password field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'input_password'),                    
                ),
                array(
                    'id'       => 'client_phone_field',
                    'type'     => 'select',
                    'title'    => __('Select the client phone number field', 'freeagent'),
                    'desc'     => esc_html__('Select the client phone number field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'phone'),                    
                ),
                array(
                    'id'       => 'client_reference_field',
                    'type'     => 'select',
                    'title'    => __('Select the client reference field', 'freeagent'),
                    'desc'     => esc_html__('Select the client reference field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'input_text'),                    
                ),
                array(
                    'id'       => 'client_subscribe_field',
                    'type'     => 'select',
                    'title'    => __('Select the client subscribe field', 'freeagent'),
                    'desc'     => esc_html__('Select the client subscribe field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'terms_and_condition'),                    
                ),
            
                array(
                    'id'       => 'client_terms_conditions_field',
                    'type'     => 'select',
                    'title'    => __('Select the client terms and conditions field', 'freeagent'),
                    'desc'     => esc_html__('Select the client terms and conditions field', 'freeagent'),
                    'required' => array('client_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('client_form_id', 'terms_and_condition'),                    
                ),
            )
        );

        $this->sections[] = array(
            'title' => esc_html__('Add Job Settings', 'freeagent'),
            'id' => 'jws_custom_settings_nik_job',
            'subsection' => true,
            'customizer_width' => '300px',            
            'fields' => array(
                array(
                    'id'       => 'add_job_page',
                    'type'     => 'select',
                    'title'    => __('Select Add Job Page', 'freeagent'),
                    'options'  => $this->get_wp_pages(), 
                ),
                array(
                    'id'       => 'add_job_form_id',
                    'type'     => 'select',
                    'title'    => __('Select Client After Login Form', 'freeagent'),
                    'options'  => $this->get_fluent_forms(), // Call a method to get form options
                ),
                array(
                    'id'       => 'add_job_title',
                    'type'     => 'select',
                    'title'    => __('Select the client position field', 'freeagent'),
                    'desc' => esc_html__('Select the client position field', 'freeagent'),
                    'required' => array('add_job_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('add_job_form_id', 'select'),                    
                ),                
                array(
                    'id'       => 'add_job_city_field',
                    'type'     => 'select',
                    'title'    => __('Select the client city field', 'freeagent'),
                    'desc'     => esc_html__('Select the client city field', 'freeagent'),
                    'required' => array('add_job_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('add_job_form_id', 'select'),                    
                ),
                array(
                    'id'       => 'add_job_country_field',
                    'type'     => 'select',
                    'title'    => __('Select the client country field', 'freeagent'),
                    'desc'     => esc_html__('Select the client country field', 'freeagent'),
                    'required' => array('add_job_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('add_job_form_id', 'select'),                    
                ),
                array(
                    'id'       => 'add_job_venue_field',
                    'type'     => 'select',
                    'title'    => __('Select the client venue field', 'freeagent'),
                    'desc'     => esc_html__('Select the client venue field', 'freeagent'),
                    'required' => array('add_job_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('add_job_form_id', 'input_text'),                    
                ),
                array(
                    'id'       => 'add_job_service_type_field',
                    'type'     => 'select',
                    'title'    => __('Select the client service type field', 'freeagent'),
                    'desc'     => esc_html__('Select the client service type field', 'freeagent'),
                    'required' => array('add_job_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('add_job_form_id', 'input_checkbox'),                    
                ),
                array(
                    'id'       => 'add_job_gender_field',
                    'type'     => 'select',
                    'title'    => __('Select the client gender field', 'freeagent'),
                    'desc'     => esc_html__('Select the client gender field', 'freeagent'),
                    'required' => array('add_job_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('add_job_form_id', 'input_radio'),                    
                ),                          
                array(
                    'id'       => 'add_job_date_event_field',
                    'type'     => 'select',
                    'title'    => __('Select the client Event Date field', 'freeagent'),
                    'desc'     => esc_html__('Select the field', 'freeagent'),
                    'required' => array('add_job_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('add_job_form_id', 'input_date'),                    
                ),
                array(
                    'id'       => 'add_job_hours_field',
                    'type'     => 'select',
                    'title'    => __('Select the client required hours field', 'freeagent'),
                    'desc'     => esc_html__('Select the client required hours field', 'freeagent'),
                    'required' => array('add_job_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('add_job_form_id', 'select'),                    
                ),
                array(
                    'id'       => 'add_job_budget_field',
                    'type'     => 'select',
                    'title'    => __('Select the client fee field', 'freeagent'),
                    'desc'     => esc_html__('Select the client fee field', 'freeagent'),
                    'required' => array('add_job_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('add_job_form_id', 'input_number'),                    
                ),
                array(
                    'id'       => 'add_job_spec_req_field',
                    'type'     => 'select',
                    'title'    => __('Select the client specific requirement field', 'freeagent'),
                    'desc'     => esc_html__('Select the field', 'freeagent'),
                    'required' => array('add_job_form_id', '!=', ''), 
                    'options'  => $this->get_form_fields('add_job_form_id', 'textarea'),                    
                ),
            )
        );
        $this->sections[] = array(
            'title' => esc_html__('Proposal Settings', 'freeagent'),
            'id' => 'jws_custom_settings_nik_proposals',
            'subsection' => true,
            'customizer_width' => '300px',            
            'fields' => array(
                array(
        			'id'       => 'proposals_limit',
        			'type'     => 'text',
        			'title'    => __('Proposal Sending limit', 'freeagent'),
        			'default' => 15,
                    'validate' => 'numeric',

        		),
                array(
        			'id'       => 'proposals_limit_message',
        			'type'     => 'text',
        			'title'    => __('Proposal Sending limit reached message', 'freeagent'),
        			'default'  => __('The limit to send proposals on this job has reached.', 'freeagent'),
        		),
                array(
        			'id'       => 'email_subject_proposal_message',
        			'type'     => 'text',
        			'title'    => __('Subject', 'freeagent'),
        			'default'  => __('You have a new message.', 'freeagent'),
        		),
               	array(
    				'id'       => 'email_body_proposal_message',
    				'type'     => 'editor',
    				'args'     => array(
    					'teeny'         => false,
    					'wpautop'       => false,
    					'quicktags'     => 1,
    					'textarea_rows' => 25,
    				),
    				'title'    => esc_html__( 'Html Content', 'freeagent' ),
    				'desc'     => esc_html(	'Write Email body.'),  
    				'default'  => 'From : #chat_sender# <br>Message : #message# <br> #view_message#',
    			),
            )
        );        
        $this->sections[] = array(
            'title' => esc_html__('Job Posting Email Settings', 'freeagent'),
            'id' => 'jws_custom_settings_nik_jobs',
            'subsection' => true,
            'customizer_width' => '300px',            
            'fields' => array(
                array(
        			'id'       => 'email_subject_postedjob_message',
        			'type'     => 'text',
        			'title'    => __('Subject', 'freeagent'),
        			'default'  => __('You have a new message.', 'freeagent'),
        		),
               	array(
    				'id'       => 'email_body_postedjob_message',
    				'type'     => 'editor',
    				'args'     => array(
    					'teeny'         => false,
    					'wpautop'       => false,
    					'quicktags'     => 1,
    					'textarea_rows' => 25,
    				),
    				'title'    => esc_html__( 'Html Content', 'freeagent' ),
    				'desc'     => esc_html(	'Write Email body.'),  
    				'default'  => 'From : #chat_sender# <br>Message : #message# <br> #view_message#',
    			), 
            )
        );        
        $this->sections[] = array(
            'title' => esc_html__('Other Settings', 'freeagent'),
            'id' => 'jws_custom_settings_additional',
            'subsection' => true,
            'customizer_width' => '300px',            
            'fields' => array(
                array(
                    'id'       => 'proposal_submit_redirect_page',
                    'type'     => 'select',
                    'title'    => __('Select Proposal Sent Successfull Redirection Page', 'freeagent'),
                    'options'  => $this->get_wp_pages(), 
                ),                                
            )
        );         
        
        if (file_exists(dirname(__FILE__) . '/../README.md')) {
            $this->sections[] = array(
                'icon' => 'el el-list-alt',
                'title' => esc_html__('Documentation', 'freeagent'),
                'fields' => array(
                    array(
                        'id' => '17',
                        'type' => 'raw',
                        'markdown' => true,
                        'content_path' => dirname(__FILE__) . '/../README.md', // FULL PATH, not relative please
                        //'content' => 'Raw content here',
                    ),
                ),
            );
        
        }		
        
    }
    /**Custom by NS */
    private function get_wp_pages(){
        $pages = get_pages();
        $page_options = array();
        foreach ($pages as $page) {
            $page_options[$page->ID] = $page->post_title;
        }
        return $page_options;
    }
    private function get_fluent_forms() {
        global $wpdb;
    
        $forms = [];
        $table_name = $wpdb->prefix . 'fluentform_forms';
        $results = $wpdb->get_results("SELECT id, title FROM {$table_name}");
    
        if (!empty($results)) {
            foreach ($results as $form) {
                $forms[$form->id] = $form->title;
            }
        }        
        return $forms;
    }
    /**
     * Get Fluent Form fields by form ID
     *
     * @param int $form_id
     * @return array
     */
    private function get_form_fields($field_id = 'professional_form_id', $type = 'input_checkbox', $counter = false) {
        $jws_option = get_option('jws_option',true);
        $form_id = $jws_option[$field_id];
        if(isset($form_id)){
            $formApi = fluentFormApi('forms')->form($form_id);
            if (!$formApi || !$formApi->renderable()) {
                return [];
            }
            $fieldss = $formApi->fields();
            $inputs = $fieldss['fields'];

            $fields = [];
            
            if($counter) $count = 1; 

            foreach ($inputs as $input) {
                if($input['element'] == $type){
                    if(isset($input['element']) && isset($input['settings']['label']) && isset($input['attributes']['name'])){                        
                        $fields[$input['attributes']['name']] = $input['settings']['label'] ;
                        if($counter){
                            $fields[$input['attributes']['name']] .= " $count";
                            $count++;  
                        }                        
                    } else if(isset($input['element']) && isset($input['settings']['admin_field_label']) && isset($input['attributes']['name'])) {
                          $fields[$input['attributes']['name']] = $input['settings']['admin_field_label'];
                          if($counter){
                              $fields[$input['attributes']['name']] .= " $count";
                          }
                    }
                }
            }
            return $fields;
        }

        return [];
    }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'freeagent' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'freeagent' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'freeagent' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'freeagent' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'freeagent' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'jws_option',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'submenu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Theme Options', 'freeagent' ),
                    'page_title'           => __( 'Theme Options', 'freeagent' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => false,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => true,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'jws_settings.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => 'jws_option',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );
				
                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => '#',
                    'title' => 'Visit us on GitHub',
                    'icon'  => 'el-icon-github'
                    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
                );
                $this->args['share_icons'][] = array(
                    'url'   => '#',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el-icon-facebook'
                );
                $this->args['share_icons'][] = array(
                    'url'   => '#',
                    'title' => 'Follow us on Twitter',
                    'icon'  => 'el-icon-twitter'
                );
                $this->args['share_icons'][] = array(
                    'url'   => '#',
                    'title' => 'Find us on LinkedIn',
                    'icon'  => 'el-icon-linkedin'
                );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_theme_config();
} else {
    echo "The class named Redux_Framework_theme_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
}

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';


            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;


    if( ! function_exists('jws_theme_get_option') ){
        function jws_theme_get_option($name, $default=false){
            global $jws_option;
            return isset( $jws_option[ $name ] ) ? $jws_option[ $name ] : $default;
        }
    }

    if( ! function_exists('jws_theme_update_option') ){
        function jws_theme_update_option($name, $value){
            global $jws_option;
            $jws_option[ $name ] = $value;
        }
    }

