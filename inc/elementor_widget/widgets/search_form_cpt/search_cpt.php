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
class Jws_Search_Categories extends Widget_Base {

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
		return 'jws_search_categories';
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
		return esc_html__( 'Jws Form Search Categories', 'freeagent' );
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
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws_jobs_search input.search_filed,
                                {{WRAPPER}} .jws_jobs_search .select2-container--default .select2-selection--single .select2-selection__rendered',
                
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
        
         $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
        
        $check_column = array();
        
        
         ?>
            <div class="jws_jobs_search categories">
            
                        <form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                            <div class="row field_filter">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <button type="submit" class="btn_search"><i class="jws-icon-search-outline"></i></button>
                                    <input class="search_filed" type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'freeagent' ); ?>"/>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                   <select name="post_type" id="categories">
                                      <option value="freelancers" <?php selected($post_type, 'freelancers'); ?>><?php echo esc_html__('Talent','freeagent');?></option>
                                      <option value="jobs" <?php selected($post_type, 'jobs'); ?>><?php echo esc_html__('Jobs','freeagent');?></option>
                                      <option value="services" <?php selected($post_type, 'services'); ?>><?php echo esc_html__('Services','freeagent');?></option>
                                    </select> 
                                </div>
                            </div>
                           <?php jws_query_string_form_fields(null, array('s', 'post_type'), '', true);?>
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