<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Jws_Tongle_Switch extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jws_tongle_switch';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Jws tongle_switch', 'freeagent' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-site-search';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'jws-elements' ];
	}
	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

	

        $this->start_controls_section(
			'content_section_primary',
			[
				'label' => esc_html__( 'Primary', 'freeagent' ),
				'tongle_switch' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
				'select_template_primary',
				[
					'label'     => esc_html__( 'Select Template', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_saved_data( 'section' ),
				]
		);
 		$this->add_control(
			'save', [
				'label' => esc_html__( 'Save', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);      
		$this->add_control(
			'title_primary', [
				'label' => esc_html__( 'Name', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Name' , 'freeagent' ),
				'label_block' => true,
			]
		);
        

		$this->end_controls_section();
        $this->start_controls_section(
			'content_section_secondary',
			[
				'label' => esc_html__( 'Secondary', 'freeagent' ),
				'tongle_switch' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
        'active',
            [
                'label'         => esc_html__( 'Active', 'freeagent' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'freeagent' ),
                'label_off'     => esc_html__( 'No', 'freeagent' ),
                'default'   => 'no',
            ]
        );
		$this->add_control(
				'select_template_secondary',
				[
					'label'     => esc_html__( 'Select Template', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_saved_data( 'section' ),
				]
		);
       
		$this->add_control(
			'title_secondary', [
				'label' => esc_html__( 'Name', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Name' , 'freeagent' ),
				'label_block' => true,
			]
		);
        

		$this->end_controls_section();
        $this->start_controls_section(
			'nav_style',
			[
				'label' => esc_html__( 'Style', 'freeagent' ),
				'tongle_switch' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'nav__position',
			[
				'label' => esc_html__( 'Position', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .toggle-btn' => 'text-align: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
					'nav_padding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .tongle_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
				'nav_margin',
				[
					'type' 			=> Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Margin', 'freeagent' ),
					'size_units' 	=> [ 'px', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .tongle_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
		);
        $this->add_control(
			'color_text',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .toggle-btn .toggle-secondary,{{WRAPPER}} .toggle-btn.active .toggle-primary ' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'active_color',
			[
				'label' => esc_html__( 'Active Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .toggle-btn .toggle-primary, {{WRAPPER}} .toggle-btn.active .toggle-secondary' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'bar_color',
			[
				'label' => esc_html__( 'Bar Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slider' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'bar_circle_color',
			[
				'label' => esc_html__( 'Bar Circle Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slider:before' => 'background-color: {{VALUE}};',
				],
			]
		);
         $this->add_control(
			'sale_color',
			[
				'label' => esc_html__( 'Sale Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .toggle-btn .save' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}
	/**
	 *  Get Saved Widgets
	 *
	 *  @param string $type Type.
	 *  @since 0.0.1
	 *  @return string
	 */
	public function get_saved_data( $type = 'page' ) {

		$saved_widgets = $this->get_post_template( $type );
		$options[-1]   = esc_html__( 'Select', 'freeagent' );
		if ( count( $saved_widgets ) ) {
			foreach ( $saved_widgets as $saved_row ) {
				$options[ $saved_row['id'] ] = $saved_row['name'];
			}
		} else {
			$options['no_template'] = esc_html__( 'It seems that, you have not saved any template yet.', 'freeagent' );
		}
		return $options;
	}

	/**
	 *  Get Templates based on category
	 *
	 *  @param string $type Type.
	 *  @since 0.0.1
	 *  @return string
	 */
	public function get_post_template( $type = 'page' ) {
		$posts = get_posts(
			array(
				'post_type'      => 'elementor_library',
				'orderby'        => 'title',
				'order'          => 'ASC',
				'posts_per_page' => '-1',
				'tax_query'      => array(
					array(
						'taxonomy' => 'elementor_library_type',
						'field'    => 'slug',
						'terms'    => $type,
					),
				),
			)
		);

		$templates = array();

		foreach ( $posts as $post ) {

			$templates[] = array(
				'id'   => $post->ID,
				'name' => $post->post_title,
			);
		}

		return $templates;
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();
            $active = '';


            if($settings['active']) {
                $active = 'active';
            }
	
		     ?>
             
             <div class="jws_tongle_switch">
		      	<div class="jws_tongle_wrap">
                  
                  <div class="toggle-btn <?php echo esc_attr($active)?>">
                    <span class="toggle-primary"><?php echo esc_html($settings['title_primary']); ?></span>
                    <label class="switch">
                      <input type="checkbox" class="tongle-check" />
                      <span class="slider round"></span>
                    </label>
                    <span class="toggle-secondary"><?php echo esc_html($settings['title_secondary']); ?><?php if(!empty($settings['save'])) echo '<span class="save"><i class="jws-icon-save-arrow"></i><span>'.esc_html__('Save ','freeagent').$settings['save'].'</span></span>'?></span>
                  </div>
                
                  <div class="tongle_content">  
            		  
            				<div  class="tongle_item jws_tongle_primary <?php echo esc_attr($active)?>">
                                    <?php echo do_shortcode('[elementor-template id="'.$settings['select_template_primary'].'"]') ?>   
                                   
                            </div>
                            <div  class="tongle_item jws_tongle_secondary ">
                                    <?php echo do_shortcode('[elementor-template id="'.$settings['select_template_secondary'].'"]') ?>   
                            </div>
            		  
                  </div>
                </div>
         </div>
	<?php	   
		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {}
}