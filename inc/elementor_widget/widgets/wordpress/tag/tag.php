<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Tag extends Widget_Base {

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
		return 'jws_tag';
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
		return esc_html__( 'Jws Tag', 'freeagent' );
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
		return 'eicon-tags';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one tag.
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
			'section_tag_setting',
			[
				'label' => esc_html__( 'Setting', 'freeagent' ),
			]
		);
        $this->add_control(
				'skins',
				[
					'label'     => esc_html__( 'Skins', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'default',
					'options'   => [
                        'default'   => esc_html__( 'Default', 'freeagent' ),
						'with_icon'   => esc_html__( 'With Icon', 'freeagent' ),
					],
				]
		);

		$this->end_controls_section();
        $this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
					'spacing',
					[
						'label' 		=> esc_html__( 'Spacing', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .tagcloud-list a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'separator' => 'before',
					]
		);
        $this->add_responsive_control(
					'padding',
					[
						'label' 		=> esc_html__( 'Padding ', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .tagcloud-list a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'separator' => 'before',
					]
		);
        $this->add_responsive_control(
					'radius',
					[
						'label' 		=> esc_html__( 'Border Radius ', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .tagcloud-list a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'separator' => 'before',
					]
		);
                $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jws_tag_border',
				'label' =>  esc_html__( 'Border', 'freeagent' ),
				'selector' => '{{WRAPPER}}  .tagcloud-list a',
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .tagcloud-list a',
			]
		);
        $this->add_control(
					'color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tagcloud-list a' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'bgcolor',
					[
						'label' 	=> esc_html__( 'Background', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tagcloud-list a' => 'background: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => esc_html__( 'Typography', 'freeagent'),
		
				'selector' => '{{WRAPPER}} .tagcloud-list a',
			]
		);
        $this->add_control(
					'color_hover',
					[
						'label' 	=> esc_html__( 'Color Hover', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tagcloud-list a:hover' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'bgcolor_hover',
					[
						'label' 	=> esc_html__( 'Background Hover', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .tagcloud-list a:hover' => 'background: {{VALUE}};',
						],
					]
		);

		$this->end_controls_section();
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
        ?>
        <div class="tagcloud-list">
            <?php 
                $args = array(
                    'taxonomy' => array( 'post_tag' ), 
                ); 
             
                wp_tag_cloud( $args );
            ?>
        </div>
	<?php }

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