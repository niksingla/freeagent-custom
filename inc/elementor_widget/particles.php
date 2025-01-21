<?php
/**
 * JWS Particles Module.
 *
 * @package JWS
 */

namespace Elementor;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Module.
 */
class Particles {
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
    	/**
	 * Constructor.
	 */
	public function __construct() {

	


			$this->add_actions();
	

	}
	/**
	 * Add actions and set scripts dependencies required to run the widget.
	 *
	 * @since 1.12.0
	 * @access protected
	 */
	protected function add_actions() {

		// Enqueue scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts_particles' ] );

		add_action( 'elementor/element/after_section_end', [ $this, 'register_controls' ], 10, 3 );

		add_action( 'elementor/container/print_template', [ $this, '_print_template' ], 10, 2 );
		add_action( 'elementor/column/print_template', [ $this, '_print_template' ], 10, 2 );

		add_action( 'elementor/frontend/column/before_render', [ $this, '_before_render' ], 10, 1 );
		add_action( 'elementor/frontend/container/before_render', [ $this, '_before_render' ], 10, 1 );

	}

	/**
	 * Enqueue scripts.
	 *
	 * Registers all the scripts defined as extension dependencies and enqueues them.
	 *
	 * @since 1.12.0
	 * @access public
	 */
	public function enqueue_scripts_particles() {
		wp_add_inline_script(
			'jquery',
			'window.scope_array = [];
			window.backend = 0;
			jQuery.cachedScript = function( url, options ) {
				// Allow user to set any option except for dataType, cache, and url.
				options = jQuery.extend( options || {}, {
					dataType: "script",
					cache: true,
					url: url
				});
				// Return the jqXHR object so we can chain callbacks.
				return jQuery.ajax( options );
			};
		    jQuery( window ).on( "elementor/frontend/init", function() {
				elementorFrontend.hooks.addAction( "frontend/element_ready/global", function( $scope, $ ){
				  
					if ( "undefined" == typeof $scope ) {
							return;
					}
                    
					if ( $scope.hasClass( "jws-particle-yes" ) ) {
						window.scope_array.push( $scope );
						$scope.find(".jws-particle-wrapper").addClass("js-is-enabled");
					}else{
						return; 
					}
					if(elementorFrontend.isEditMode() && $scope.find(".jws-particle-wrapper").hasClass("js-is-enabled") && window.backend == 0 ){		
						var jws_url = jws_script.jws_particles_url;
						jQuery.cachedScript( jws_url );
						window.backend = 1;
					}else if(elementorFrontend.isEditMode()){
						var jws_url = jws_script.jws_particles_url;
						jQuery.cachedScript( jws_url ).done(function(){
							var flag = true;
						});
					}
				});
			});
			jQuery(document).ready(function(){
				if ( jQuery.find( ".jws-particle-yes" ).length < 1 ) {
					return;
				}
				var jws_url = jws_script.jws_particles_url;
				jQuery.cachedScript = function( url, options ) {
					// Allow user to set any option except for dataType, cache, and url.
					options = jQuery.extend( options || {}, {
						dataType: "script",
						cache: true,
						url: url
					});
					// Return the jqXHR object so we can chain callbacks.
					return jQuery.ajax( options );
				};
				jQuery.cachedScript( jws_url );
			});	'
		);
	}

	/**
	 * Register Particle Backgrounds controls.
	 *
	 * @since 1.12.0
	 * @access public
	 * @param object $element for current element.
	 * @param object $section_id for section ID.
	 * @param array  $args for section args.
	 */
	public function register_controls( $element, $section_id, $args ) {

		if ( ( 'container' === $element->get_name() && 'section_background' === $section_id ) || ( 'column' === $element->get_name() && 'section_style' === $section_id ) ) {

			$element->start_controls_section(
				'jws_particles',
				[
					'tab'   => Controls_Manager::TAB_STYLE,
					/* translators: %s admin link */
					'label' =>  esc_html__( 'Particle Backgrounds', 'freeagent' ) ,
				]
			);

			$element->add_control(
				'jws_enable_particles',
				[
					'type'         => Controls_Manager::SWITCHER,
					'label'        =>  esc_html__( 'Enable Particle Background', 'freeagent' ),
					'default'      => '',
					'label_on'     =>  esc_html__( 'Yes', 'freeagent' ),
					'label_off'    =>  esc_html__( 'No', 'freeagent' ),
					'return_value' => 'yes',
					'prefix_class' => 'jws-particle-',
					'render_type'  => 'template',
				]
			);

			$element->add_control(
				'jws_particles_styles',
				[
					'label'     =>  esc_html__( 'Style', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'nasa',
					'options'   => [
						'default' =>  esc_html__( 'Polygon', 'freeagent' ),
						'nasa'    =>  esc_html__( 'NASA', 'freeagent' ),
						'snow'    =>  esc_html__( 'Snow', 'freeagent' ),
						'custom'  =>  esc_html__( 'Custom', 'freeagent' ),
					],
					'condition' => [
						'jws_enable_particles' => 'yes',
					],
				]
			);

			$element->add_control(
				'help_doc_particles_1a',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s admin link */
					'raw'             =>  esc_html__( 'Add custom JSON for the Particle Background below. To generate a completely customized background style follow steps below - ', 'freeagent' ),
					'content_classes' => 'jws-editor-doc jws-editor-description',
					'condition'       => [
						'jws_enable_particles' => 'yes',
						'jws_particles_styles' => 'custom',
					],
				]
			);

			$element->add_control(
				'help_doc_particles_2a',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s admin link */
					'raw'             => sprintf(  esc_html__( '1. Visit a link %1$s here %2$s and choose required attributes for particle </br></br> 2. Once a custom style is created, download JSON from "Download current config (json)" link </br></br> 3. Copy JSON code from the downloaded file and paste it below', 'freeagent' ), '<a href="https://vincentgarreau.com/particles.js/" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'jws-editor-doc jws-editor-description',
					'condition'       => [
						'jws_enable_particles' => 'yes',
						'jws_particles_styles' => 'custom',
					],
				]
			);


			$element->add_control(
					'help_doc_particles_5a',
					[
						'type'            => Controls_Manager::RAW_HTML,
						/* translators: %s admin link */
						'raw'             => sprintf(  esc_html__( 'To know more about creating a custom style, refer to a document %1$s here %2$s.', 'freeagent' ), '<a href="https://jwsementor.com/docs/custom-particle-backgrounds/?utm_source=jws-pro-dashboard&utm_medium=jws-editor-screen&utm_campaign=jws-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
						'content_classes' => 'jws-editor-doc jws-editor-description',
						'condition'       => [
							'jws_enable_particles' => 'yes',
							'jws_particles_styles' => 'custom',
						],
					]
			);
		

			$element->add_control(
				'jws_particle_json',
				[
					'type'        => Controls_Manager::CODE,
					'default'     => '',
					'render_type' => 'template',
					'condition'   => [
						'jws_enable_particles' => 'yes',
						'jws_particles_styles' => 'custom',
					],
				]
			);

			$element->add_control(
				'jws_particles_color',
				[
					'label'       =>  esc_html__( 'Particle Color', 'freeagent' ),
					'type'        => Controls_Manager::COLOR,
					'alpha'       => false,
                    'default'      => '#8442E8',
					'condition'   => [
						'jws_enable_particles'  => 'yes',
						'jws_particles_styles!' => 'custom',
					],
					'render_type' => 'template',
				]
			);
            $element->add_control(
				'jws_particles_color2',
				[
					'label'       => esc_html__( 'Particle Color 2', 'freeagent' ),
					'type'        => Controls_Manager::COLOR,
					'alpha'       => false,
                    'default'      => '#4557F6',
					'condition'   => [
						'jws_enable_particles'  => 'yes',
						'jws_particles_styles!' => 'custom',
					],
					'render_type' => 'template',
				]
			);
        $element->add_control(
				'jws_particles_color3',
				[
					'label'       => esc_html__( 'Particle Color 2', 'freeagent' ),
					'type'        => Controls_Manager::COLOR,
					'alpha'       => false,
                    'default'      => '#FFCF61',
					'condition'   => [
						'jws_enable_particles'  => 'yes',
						'jws_particles_styles!' => 'custom',
					],
					'render_type' => 'template',
				]
			);

			$element->add_control(
				'jws_particles_color4',
				[
					'label'       => esc_html__( 'Particle Color 4', 'freeagent' ),
					'type'        => Controls_Manager::COLOR,
					'alpha'       => false,
                    'default'      => '#FFBFCC',
					'condition'   => [
						'jws_enable_particles'  => 'yes',
						'jws_particles_styles!' => 'custom',
					],
					'render_type' => 'template',
				]
			);

			$element->add_control(
				'jws_particles_opacity',
				[
					'label'       =>  esc_html__( 'Opacity', 'freeagent' ),
					'type'        => Controls_Manager::SLIDER,
					'range'       => [
						'px' => [
							'min'  => 0,
							'max'  => 1,
							'step' => 0.1,
						],
					],
					'condition'   => [
						'jws_enable_particles'  => 'yes',
						'jws_particles_styles!' => 'custom',
					],
					'render_type' => 'template',
				]
			);

			$element->add_control(
				'jws_particles_direction',
				[
					'label'     =>  esc_html__( 'Flow Direction', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'bottom',
					'options'   => [
						'top'          =>  esc_html__( 'Top', 'freeagent' ),
						'bottom'       =>  esc_html__( 'Bottom', 'freeagent' ),
						'left'         =>  esc_html__( 'Left', 'freeagent' ),
						'right'        =>  esc_html__( 'Right', 'freeagent' ),
						'top-left'     =>  esc_html__( 'Top Left', 'freeagent' ),
						'top-right'    =>  esc_html__( 'Top Right', 'freeagent' ),
						'bottom-left'  =>  esc_html__( 'Bottom Left', 'freeagent' ),
						'bottom-right' =>  esc_html__( 'Bottom Right', 'freeagent' ),
					],
					'condition' => [
						'jws_enable_particles' => 'yes',
						'jws_particles_styles' => 'snow',
					],
				]
			);

			$element->add_control(
				'jws_enable_advanced',
				[
					'type'         => Controls_Manager::SWITCHER,
					'label'        =>  esc_html__( 'Advanced Settings', 'freeagent' ),
					'default'      => 'no',
					'label_on'     =>  esc_html__( 'Yes', 'freeagent' ),
					'label_off'    =>  esc_html__( 'No', 'freeagent' ),
					'return_value' => 'yes',
					'prefix_class' => 'jws-particle-adv-',
					'render_type'  => 'template',
					'condition'    => [
						'jws_enable_particles'  => 'yes',
						'jws_particles_styles!' => 'custom',
					],
				]
			);

			$element->add_control(
				'jws_particles_number',
				[
					'label'       =>  esc_html__( 'Number of Particles', 'freeagent' ),
					'type'        => Controls_Manager::SLIDER,
					'range'       => [
						'px' => [
							'min' => 1,
							'max' => 500,
						],
					],
					'condition'   => [
						'jws_enable_particles'  => 'yes',
						'jws_particles_styles!' => 'custom',
						'jws_enable_advanced'   => 'yes',
					],
					'render_type' => 'template',
				]
			);

			$element->add_control(
				'jws_particles_size',
				[
					'label'       =>  esc_html__( 'Particle Size', 'freeagent' ),
					'type'        => Controls_Manager::SLIDER,
					'range'       => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
					],
					'condition'   => [
						'jws_enable_particles'  => 'yes',
						'jws_particles_styles!' => 'custom',
						'jws_enable_advanced'   => 'yes',
					],
					'render_type' => 'template',
				]
			);

			$element->add_control(
				'jws_particles_speed',
				[
					'label'       =>  esc_html__( 'Move Speed', 'freeagent' ),
					'type'        => Controls_Manager::SLIDER,
					'range'       => [
						'px' => [
							'min' => 1,
							'max' => 10,
						],
					],
					'condition'   => [
						'jws_enable_particles'  => 'yes',
						'jws_particles_styles!' => 'custom',
						'jws_enable_advanced'   => 'yes',
					],
					'render_type' => 'template',
				]
			);

			$element->add_control(
				'jws_enable_interactive',
				[
					'type'         => Controls_Manager::SWITCHER,
					'label'        =>  esc_html__( 'Enable Hover Effect', 'freeagent' ),
					'default'      => 'no',
					'label_on'     =>  esc_html__( 'Yes', 'freeagent' ),
					'label_off'    =>  esc_html__( 'No', 'freeagent' ),
					'return_value' => 'yes',
					'condition'    => [
						'jws_enable_particles'  => 'yes',
						'jws_particles_styles!' => 'custom',
						'jws_enable_advanced'   => 'yes',
					],
					'render_type'  => 'template',
				]
			);

			$element->add_control(
				'help_doc_interactivea',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s admin link */
					'raw'             =>  esc_html__( 'Particle hover effect will not work in the following scenarios - </br></br> 1. In the Elementor backend editor</br></br> 2. Content/Spacer added in the section/column occupies the entire space and leaves it inaccessible. Adding padding to the section/column can resolve this.', 'freeagent' ),
					'content_classes' => 'jws-editor-doc',
					'condition'       => [
						'jws_enable_particles'   => 'yes',
						'jws_particles_styles!'  => 'custom',
						'jws_enable_advanced'    => 'yes',
						'jws_enable_interactive' => 'yes',
					],
				]
			);


				$element->add_control(
					'help_doc_interactive_not_workinga',
					[
						'type'            => Controls_Manager::RAW_HTML,
						/* translators: %s admin link */
						'raw'             => sprintf(  esc_html__( 'Learn more about this %1$s here. %2$s', 'freeagent' ), '<a href="https://jwsementor.com/docs/particles-hover-effect-not-working/?utm_source=jws-pro-dashboard&utm_medium=jws-editor-screen&utm_campaign=jws-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
						'content_classes' => 'jws-editor-doc',
						'condition'       => [
							'jws_enable_particles'   => 'yes',
							'jws_particles_styles!'  => 'custom',
							'jws_enable_advanced'    => 'yes',
							'jws_enable_interactive' => 'yes',
						],
					]
				);
			

			$element->end_controls_section();
		}
	}

	/**
	 * Render Particles Background output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.12.0
	 * @access public
	 * @param object $element for current element.
	 */
	public function _before_render( $element ) {

		if ( $element->get_name() !== 'container' && $element->get_name() !== 'column' ) {
			return;
		}

		$settings  = $element->get_settings();
		$node_id   = $element->get_id();
		$is_editor = \Elementor\Plugin::instance()->editor->is_edit_mode();

		if ( 'yes' === $settings['jws_enable_particles'] ) {
			$element->add_render_attribute( '_wrapper', 'data-jws-partstyle', $settings['jws_particles_styles'] );
			$element->add_render_attribute( '_wrapper', 'data-jws-partcolor', '["'.$settings['jws_particles_color'].'","'.$settings['jws_particles_color2'].'","'.$settings['jws_particles_color3'].'","'.$settings['jws_particles_color4'].'"]' );
			$element->add_render_attribute( '_wrapper', 'data-jws-partopacity', $settings['jws_particles_opacity']['size'] );
			$element->add_render_attribute( '_wrapper', 'data-jws-partdirection', $settings['jws_particles_direction'] );

			if ( 'yes' === $settings['jws_enable_advanced'] ) {
				$element->add_render_attribute( '_wrapper', 'data-jws-partnum', $settings['jws_particles_number']['size'] );
				$element->add_render_attribute( '_wrapper', 'data-jws-partsize', $settings['jws_particles_size']['size'] );
				$element->add_render_attribute( '_wrapper', 'data-jws-partspeed', $settings['jws_particles_speed']['size'] );
				if ( $is_editor ) {
					$element->add_render_attribute( '_wrapper', 'data-jws-interactive', 'no' );
				} else {
					$element->add_render_attribute( '_wrapper', 'data-jws-interactive', $settings['jws_enable_interactive'] );
				}
			}

			if ( 'custom' === $settings['jws_particles_styles'] ) {
				$element->add_render_attribute( '_wrapper', 'data-jws-partdata', $settings['jws_particle_json'] );
			}
		}
	}

	/**
	 * Render Particles Background output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.12.0
	 * @access public
	 * @param object $template for current template.
	 * @param object $widget for current widget.
	 */
	public function _print_template( $template, $widget ) {
		if ( $widget->get_name() !== 'container' && $widget->get_name() !== 'column' ) {
			return $template;
		}
		$old_template = $template;
		ob_start();
		?>
		<# if( 'yes' == settings.jws_enable_particles ) {

			view.addRenderAttribute( 'particle_data', 'id', 'jws-particle-' + view.getID() );
			view.addRenderAttribute( 'particle_data', 'class', 'jws-particle-wrapper' );
			view.addRenderAttribute( 'particle_data', 'data-jws-partstyle', settings.jws_particles_styles );
			view.addRenderAttribute( 'particle_data', 'data-jws-partcolor', settings.jws_particles_color );
			view.addRenderAttribute( 'particle_data', 'data-jws-partopacity', settings.jws_particles_opacity.size );
			view.addRenderAttribute( 'particle_data', 'data-jws-partdirection', settings.jws_particles_direction );

			if( 'yes' == settings.jws_enable_advanced ) {
				view.addRenderAttribute( 'particle_data', 'data-jws-partnum', settings.jws_particles_number.size );
				view.addRenderAttribute( 'particle_data', 'data-jws-partsize', settings.jws_particles_size.size );
				view.addRenderAttribute( 'particle_data', 'data-jws-partspeed', settings.jws_particles_speed.size );
				view.addRenderAttribute( 'particle_data', 'data-jws-interactive', 'no' );

			}
			if ( 'custom' == settings.jws_particles_styles ) {
				view.addRenderAttribute( 'particle_data', 'data-jws-partdata', settings.jws_particle_json );
			}
			#>
			<div {{{ view.getRenderAttributeString( 'particle_data' ) }}}></div>
		<# } #>
		<?php
		$slider_content = ob_get_contents();
		ob_end_clean();
		$template = $slider_content . $old_template;
		return $template;
	}

}
// Instantiate Plugin Class
Particles::instance();
