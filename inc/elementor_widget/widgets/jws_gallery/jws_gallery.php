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
class Jws_Gallery extends Widget_Base {

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
		return 'jws_gallery';
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
		return esc_html__( 'Jws Gallery', 'freeagent' );
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
		return 'eicon-gallery-grid';
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
     * Load style
     */
    public function get_style_depends()
    {
        return ['lightgallery'];
    }

    /**
     * Retrieve the list of scripts the image carousel widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['lightgallery-all'];
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
    		'enable_masonry',
    		[
    			'label' =>  esc_html__( 'Enable Masonry', 'freeagent' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'freeagent' ),
                'label_off'     => esc_html__( 'No', 'freeagent' ),
                'default'   => 'no',
    		]
        );
        $this->add_control(
				'gallery_display',
				[
					'label'     => esc_html__( 'Display', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'grid',
					'options'   => [
						'grid'   => esc_html__( 'Grid', 'freeagent' ),
                        'masonry'   => esc_html__( 'Masonry', 'freeagent' ),
                        'metro'   => esc_html__( 'Metro', 'freeagent' ),
						'slider'   => esc_html__( 'Slider', 'freeagent' ),
                        
					],
                    
				]
		);
        $this->add_control(
				'link_action',
				[
					'label'     => esc_html__( 'Link Action', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'lightbox',
					'options'   => [
						'lightbox'   => esc_html__( 'Light Box', 'freeagent' ),
                        'linkurl'   => esc_html__( 'Link Href', 'freeagent' ),
					],
                   
                    
				]
	     );
        $this->add_control(
			'gallery_layout',
			[
				'label' => esc_html__( 'Layout', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout1',
				'options' => [
					'layout1'  => esc_html__( 'Layout 1', 'freeagent' ),
                    'layout2'  => esc_html__( 'Layout 2', 'freeagent' ),
				],
			]
		);
        $this->add_responsive_control(
				'gallery_columns',
				[
					'label'          => esc_html__( 'Columns', 'freeagent' ),
					'type'           => Controls_Manager::SELECT,
					'default'        => '12',
					'options'        => [
						'12' => '1',
						'6' => '2',
						'4' => '3',
						'3' => '4',
						'20' => '5',
						'2' => '6',
					],
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

        $this->add_control(
    		'show_logo',
    		[
    			'label' =>  esc_html__( 'Enable Logo animate', 'freeagent' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'freeagent' ),
                'label_off'     => esc_html__( 'No', 'freeagent' ),
                'default'   => 'no',
                'prefix_class' => 'jws_logo_hover_',
    		]
        );
    

        
        $this->end_controls_section(); 

	    $this->start_controls_section(
			'setting_section_list',
			[
				'label' => esc_html__( 'gallery List', 'freeagent' ),
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
        $repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
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

       $repeater->add_responsive_control(
			'variable_width',
			[
				'label' => __( 'variable Width', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .jws_gallery_image' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Menu List', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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
			'padding_odd',
			[
				'label'     => esc_html__( 'Padding Odd', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_gallery .jws_gallery_item:nth-child(odd)' => 'padding-top: {{SIZE}}{{UNIT}};',
					
				],
			]
		);
        $this->add_responsive_control(
			'padding_even',
			[
				'label'     => esc_html__( 'Padding Even', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_gallery .jws_gallery_item:nth-child(even)' => 'padding-top: {{SIZE}}{{UNIT}};',
					
				],
			]
		);
        $this->add_responsive_control(
			'column_gap',
			[
				'label'     => esc_html__( 'Columns Gap', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_gallery .jws_gallery_item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws_gallery.row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'     => esc_html__( 'Rows Gap', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_gallery .jws_gallery_item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

       $this->start_controls_section(
			'box_slider3d_style',
			[
				'label' => esc_html__( 'Sider 3d Style', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
       

        $this->end_controls_section();
                
       $this->start_controls_section(
			'img_style',
			[
				'label' => esc_html__( 'Image', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
			'image_border_radius',
			[
				'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws_gallery_image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
         $this->end_controls_section();
        jws_elementor_widget_slider_config($this,['gallery_display' => 'slider']);

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
         
          if($settings['gallery_display'] == 'metro' || $settings['gallery_display'] == 'masonry' ) {
            wp_enqueue_script('isotope');
          }    
          if($settings['enable_masonry']=='yes'){
            $enabled = 'isotope';
             wp_enqueue_script('isotope');
          }else{
            $enabled='';
          }
          $class_column = 'jws_gallery_item';

          $class_row = 'jws_gallery gallery '.$settings['gallery_layout'].' '.$enabled; 
          $class_row .= ' '.$settings['gallery_display']; 
          
         
          
          
          if($settings['gallery_display'] != 'slider') {
            $class_row .=" row";
              $class_column .= ' col-xl-'.$settings['gallery_columns'].'';
              $class_column .= (!empty($settings['gallery_columns_tablet'])) ? ' col-lg-'.$settings['gallery_columns_tablet'].'' : ' col-lg-'.$settings['gallery_columns'].'' ;
              $class_column .= (!empty($settings['gallery_columns_mobile'])) ? ' col-'.$settings['gallery_columns_mobile'].'' :  ' col-'.$settings['gallery_columns'].'';
          }else{
            $class_column .= '';
          }   
          
            $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
    		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
             $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : '';      
          
          if($settings['gallery_display'] == 'slider') {
                $class_row .= ' swiper jws_gallery_slider '.$show_inbox;
                $class_column .= ' slider-item swiper-slide'; 
                
           }elseif($settings['gallery_display'] == 'metro'){
                $class_row .= ' loading';
                
           }

 
         ?>
         <div class="jws_gallery_element">
            <div class="<?php echo esc_attr($class_row); ?>" data-gallery="jws-custom-<?php echo esc_attr($this->get_id()); ?>">
                <?php 
                 if($settings['gallery_display'] == 'slider') echo '<div class="swiper-wrapper">';
                if($settings['gallery_display'] == 'metro') {
                ?> 
                <div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg></div>   
                <div class="grid-sizer col-xl-3 col-lg-3 col-3"></div> 
                
                <?php } 
                  if($settings['gallery_display'] == 'masonry') {
                    ?> <div class="grid-sizer col-xl-3 col-lg-6"></div> 
                    <?php }?>
                <?php $i = 1; $n = 0; foreach (  $settings['list'] as $index => $item ) {
                 $link_key = 'link' . $index; 
                 
           
                
                 if($settings['link_action'] == 'linkurl') {
                   if($item['link_url']['is_external']) $this->add_render_attribute( $link_key, 'rel',  'nofollow' );
                   if($item['link_url']['nofollow']) $this->add_render_attribute( $link_key, 'target',  '_blank' );  
                   $this->add_render_attribute( $link_key, 'href',  $item['link_url'] ); 
                 }else {
                   $this->add_render_attribute( $link_key, 'class', 'jws-popup-global' );
                   $this->add_render_attribute( $link_key, 'href',  $item['image']['url'] );   
                 }
                     if($settings['gallery_display'] == 'masonry') {
                   
                             if($i == '1' || $i == '5' || $i == '7'||$i == '8') {
                                
                              $class_column = 'jws_gallery_item col-xl-6 col-lg-6'; 
                              
                            }else {
                                
                              $class_column = 'jws_gallery_item col-xl-3 col-lg-6'; 
                                
                            } 
                                    if ($i == 10) {
                                            $i = 1;
                                        } else {
                                            $i++;
                                        } 
                     }
                 if($settings['gallery_display'] == 'metro') {
                    $image_size = $settings['image_size'];        
                       $class_column = 'jws_gallery_item col-xl-3 col-lg-3'; 
                     
                    if ($i == 6) {
                        $i = 1;
                    } else {
                        $i++;
                    }
                                        
                  }else {
                    $image_size = (!empty($settings['images_size']['width']) || !empty($settings['images_size']['height'])) ? $settings['images_size']['width'].'x'.$settings['images_size']['height'] : 'full';
                  }
           


                  $attach_id  = $item['image']['id'];
                  $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?php echo esc_attr($class_column.$cat2); ?>" <?php if($settings['link_action'] == 'lightbox') : ?>  data-gallery-image data-gallery-item="<?php echo esc_attr($n);?>" <?php endif; ?>>
                        <?php include($settings['gallery_layout'].'.php' ); ?>
                    </div>
                <?php $n++; }?>
                <?php if($settings['gallery_display'] == 'slider') echo '</div>';?>
                 <?php if($show_arrows  && $settings['gallery_display'] == 'slider') : ?>
                    <button class="elementor-swiper-button elementor-swiper-button-prev">
                     <?php $this->render_swiper_button( $settings, 'prev' ); ?>
                    </button>
                    <button class="elementor-swiper-button elementor-swiper-button-next">
                     <?php $this->render_swiper_button( $settings, 'next' ); ?>
                    </button>
                <?php endif; ?>
                <?php  if($show_dots && $settings['gallery_display'] == 'slider') echo '<div class="swiper-pagination"></div>';?>
 
                
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