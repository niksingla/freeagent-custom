<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Jws_Search_Role extends Widget_Base {

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
		return 'jws_search_role';
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
		return esc_html__( 'Jws Form Search Roles', 'freeagent' );
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
			'setting_section',
			[
				'label' => esc_html__( 'Setting', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        
        $this->end_controls_section();
        $this->start_controls_section(
			'form_style',
			[
				'label' => esc_html__( 'Style', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'form_bg_color',
			[
				'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_jobs_search form' => 'background-color: {{VALUE}} ;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
            'label' 		=> esc_html__( 'Box Shadow', 'freeagent' ),
				'name' => 'form_shadow',
				'selector' => '{{WRAPPER}} .jws_jobs_search form',
			]
		);
        $this->add_responsive_control(
			'form_padding',
			[
				'label'      => esc_html__( 'Padding', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws_jobs_search form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'form_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws_jobs_search form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'field_heading',
			[
				'label'     => esc_html__( 'Field', 'freeagent' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'field_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws_jobs_search input.search_filed,
                    {{WRAPPER}} .jws_jobs_search .select2-container',
			]
		);
        $this->add_control(
			'field_color',
			[
				'label' 	=> esc_html__( 'Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_jobs_search input.search_filed,
                    {{WRAPPER}} .jws_jobs_search .select2-container--default .select2-selection--single .select2-selection__rendered' => 'color:{{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_heading',
			[
				'label'     => esc_html__( 'Button', 'freeagent' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws_jobs_search button',
			]
		);
		$this->start_controls_tabs( 'tabs_btnbg_style' );
		$this->start_controls_tab(
			'tab_normal',
			[
				'label' => esc_html__( 'Normal', 'freeagent' ),
			]
		);
        $this->add_control(
			'btn_color',
			[
				'label' 	=> esc_html__( 'Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_jobs_search button' => 'color:{{VALUE}};',
				],
			]
		);
        $this->add_control(
			'btn_color_bg',
			[
				'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_jobs_search button' => 'background:{{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
			]
		);
        $this->add_control(
			'btn_color_hover',
			[
				'label' 	=> esc_html__( 'Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_jobs_search button:hover' => 'color:{{VALUE}};',
				],
			]
		);
        $this->add_control(
			'btn_color_bg_hover',
			[
				'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_jobs_search button:hover' => 'background:{{VALUE}};',
				],
			]
		);
        $this->end_controls_tab();
	   $this->end_controls_tabs();
        $this->add_responsive_control(
			'btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws_jobs_search button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws_jobs_search button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	   
		$settings = $this->get_settings_for_display();
        global $jws_option;
        
         $search_value = isset($_GET['search']) ? $_GET['search'] : '';
        
        $check_column = array();
         $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
        
         ?>
            <div class="jws_jobs_search role">
                <form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                    <div class="row field_filter">
                        <div class="col-xl-6 col-lg-6 col-12">
                            <i class="jws-icon-search-outline"></i>
                            <input class="search_filed" name="s"  type="text" value="" placeholder="<?php echo esc_attr_x( 'Job title, keyworks...', 'placeholder', 'freeagent' ); ?>"/>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-12">
                           <select name="post_type" class="roles" >
                              <option value="employers" <?php selected($post_type, 'employers'); ?>><?php echo esc_html__('Employers','freeagent')?></option>
                              <option value="freelancers" <?php selected($post_type, 'freelancers'); ?>><?php echo esc_html__('Freelancers','freeagent')?></option>
                            </select> 
                        </div>
                    </div>
                    <button type="submit" class="elementor-button">
                    <span class="btn_search"><?php echo esc_html__('Search','freeagent');?></span>
                       <?php jws_query_string_form_fields(null, array('s', 'post_type'), '', true);?> 
                    </button>
                   
                </form>
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