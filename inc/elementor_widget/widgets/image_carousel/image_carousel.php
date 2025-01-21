<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Jws_Image_Carousel extends Widget_Base {

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
		return 'jws_image_carousel';
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
		return esc_html__( 'Jws image carousel', 'freeagent' );
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
		return 'eicon-posts-carousel';
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
        $this->add_control(
				'image_carousel_layout',
				[
					'label'     => esc_html__( 'Layout', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'layout1', 'freeagent' ),
					],
                    
				]
		);


        $this->add_control(
			'image_carousel_position',
			[
				'label'       => esc_html__( 'Position', 'freeagent' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'at-center',
				'options'     => [
                    'at-center'  => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon'  => 'eicon-h-align-center',
					],
                    'at-top' => [
						'title' => esc_html__( 'Top', 'freeagent' ),
						'icon'  => 'eicon-v-align-top',
					],
                    'at-bottom' => [
						'title' => esc_html__( 'Bottom', 'freeagent' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'label_block' => false,
				'toggle'      => false,
                'prefix_class' => 'jws-content-align-',

			]
		);
        
		$this->add_control(
			'enable_center_image',
			[
				'label'        => esc_html__( 'Enable Big Active Image ', 'freeagent' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'enable_fullsize_image',
			[
				'label'        => esc_html__( 'Enable image full width', 'freeagent' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'enable_hover_image',
			[
				'label'        => esc_html__( 'Enable hover logo', 'freeagent' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
    $this->add_control(
				'image_size',
				[
					'label'     => esc_html__( 'Image Size', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => '770x450',
				]
		);
        $this->end_controls_section();   
	    $this->start_controls_section(
			'setting_section_list',
			[
				'label' => esc_html__( 'Image Carousel List', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);   
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        
        $repeater->add_control(
			'link_url',
			[
				'label' => esc_html__( 'Link', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'freeagent' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
				],
			]
		);
        
        
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'image_carousel_title' => esc_html__( 'Name #1', 'freeagent' ),
					],
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        

        
         $this->add_responsive_control(
			'image_carousel_content_padding',
			[
				'label'      => esc_html__( 'Content Padding', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-image_carousel .jws-image_carousel-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
                

        $this->add_control(
			'count_color',
			[
				'label' 	=> esc_html__( 'Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slideshow' => 'color: {{VALUE}};',
				],
			]
		);

       
        $this->end_controls_section();
       
        jws_elementor_widget_slider_config($this,'');
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
       
        $image_size = (!empty($settings['image_carousel_dimension']['width']) || !empty($settings['image_carousel_dimension']['height'])) ? $settings['image_carousel_dimension']['width'].'x'.$settings['image_carousel_dimension']['height'] : 'full';
        $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
    		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

             $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : '';
          $class_column = 'jws-image_carousel-item';

          $class_row = 'swiper jws-image_carousel image_carousel '.$settings['image_carousel_layout'].' '.$show_inbox;
                $class_column .= ' slider-item  swiper-slide'; 

           

         ?>
         <div class="jws-image_carousel-element jws-carousel <?php if($settings['enable_hover_image']=='yes') echo 'hover_image';?><?php if($settings['enable_center_image']=='yes') echo 'center_image';?>">
          
            <div class="<?php echo esc_attr($class_row); ?>" >
            <div class="swiper-wrapper">
                    <?php  foreach (  $settings['list'] as $index => $item ) {
                       $link_key = 'link' . $index;   
                       if($item['link_url']['is_external']) $this->add_render_attribute( $link_key, 'rel',  'nofollow' );
                       if($item['link_url']['nofollow']) $this->add_render_attribute( $link_key, 'target',  '_blank' );  
                       $this->add_render_attribute( $link_key, 'href',  $item['link_url']['url'] ); 
    
                        ?>
                            <div class="<?php echo esc_attr($class_column); ?>">
                            <?php  include( ''.$settings['image_carousel_layout'].'.php' );  ?>
                       
                        </div>
                    <?php  } ?>   
                    </div>
                  <?php if($show_arrows):?>
                    <button class="elementor-swiper-button elementor-swiper-button-prev">
                     <?php $this->render_swiper_button( $settings, 'prev' ); ?>
                    </button>
                    <button class="elementor-swiper-button elementor-swiper-button-next">
                     <?php $this->render_swiper_button( $settings, 'next' ); ?>
                    </button>
                <?php endif; ?>
                <?php  if($show_dots) echo '<div class="swiper-pagination"></div>';?>
  
                    
                    
            </div>

         </div>   
        <?php

	}
      private function render_swiper_button( $settings, $type ) {
		$icon_key = 'arrow_icon_' . $type;

		Icons_Manager::render_icon( $settings[ $icon_key ], [ 'aria-hidden' => 'true' ] );
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