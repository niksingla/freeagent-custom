<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Core\Schemes;

/**
 * Elementor icon list widget.
 *
 * Elementor widget that displays a bullet list with any chosen icons and texts.
 *
 * @since 1.0.0
 */
class Jws_Gallery_List extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jws_gallery_list';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Jws Gallery List', 'freeagent' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-bullet-list';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'award list','award', 'list' ];
	}

	/**
	 * Register icon list widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( ' List', 'freeagent' ),
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
						'slider'   => esc_html__( 'Slider', 'freeagent' ),
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
			'gallery_list',
			[
				'label' => esc_html__( 'Add Images', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
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
					'{{WRAPPER}} .jws_gallery_element .jws_gallery_item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws_gallery_element .row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
					'{{WRAPPER}} .jws_gallery_element .jws_gallery_item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
                $this->start_controls_section(
			'img_style',
			[
				'label' => esc_html__( 'Gallery', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'color_logo',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-logo svg path ' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_hover_style' );
		$this->start_controls_tab(
			'tab_opa_normal',
			[
				'label' => esc_html__( 'Normal', 'freeagent' ),
			]
		);

        $this->add_control(
			'opacity_logo',
			[
				'label' => esc_html__( 'Opacity', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1,
                        'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-logo' => 'opacity:  {{SIZE}};',
				],
			]
		);
		$this->add_control(
    		'logo_color',
    		[
    			'label' 	=> esc_html__( 'Color', 'freeagent' ),
    			'type' 		=> Controls_Manager::COLOR,
    			'selectors' => [
    				'{{WRAPPER}} .jws-logo svg path' => 'fill: {{VALUE}};',
    			],
    		]
    	);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_opa_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
			]
		);
        $this->add_control(
			'opacity_logo_hover',
			[
				'label' => esc_html__( 'Opacity', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1,
                        'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-logo:hover' => 'opacity:  {{SIZE}};',
				],
			]
		);
		$this->add_control(
    		'logo_color_hover',
    		[
    			'label' 	=> esc_html__( 'Color', 'freeagent' ),
    			'type' 		=> Controls_Manager::COLOR,
    			'selectors' => [
    				'{{WRAPPER}} .jws-logo:hover svg path' => 'fill: {{VALUE}};',
    			],
    		]
    	);
		$this->end_controls_tab();
		$this->end_controls_tabs();
        
        $this->end_controls_section();
        $this->start_controls_section(
            'navigation_style_settings', [
            'label' => esc_html__('Navigation', 'freeagent'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control(
				'dot_style_settings', [
				'label' => esc_html__('Dots', 'freeagent'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
		]);
		$this->add_control(
			'dot_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'dot_bg_color',
			[
				'label' => esc_html__( 'Active Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
        jws_elementor_widget_slider_config($this,['gallery_display' => 'slider']);

	}

	/**
	 * Render icon list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
                $id       = $this->get_id();
        $custom_class = '';
        $class_row = 'jws_gallery_content gallery  '; 
        $class_column = 'jws_gallery_item';
         if($settings['gallery_display'] == 'grid'){        
          $class_row.=' row';
          $class_column .= ' col-xl-'.$settings['gallery_columns'].'';
          $class_column .= (!empty($settings['gallery_columns_tablet'])) ? ' col-lg-'.$settings['gallery_columns_tablet'].'' : ' col-lg-'.$settings['gallery_columns'].'' ;
          $class_column .= (!empty($settings['gallery_columns_mobile'])) ? ' col-'.$settings['gallery_columns_mobile'].'' :  ' col-'.$settings['gallery_columns'].''; 
         }
          
          $class_row .= ' '.$custom_class; 
           $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
    		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
            $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : '';
          if($settings['gallery_display'] == 'slider') {
                $class_row .= ' swiper jws-gallery-list-slider '.$show_inbox;
                $class_column .= ' slider-item swiper-slide'; 
           }

    ?>
    <div class="jws_gallery_element">
      <div id="lightgallery_<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_row); ?>"  data-gallery="jws-custom-<?php echo esc_attr($this->get_id()); ?>">
          <?php
            if($settings['gallery_display'] == 'slider') echo '<div class="swiper-wrapper">';
          foreach (  $settings['gallery_list'] as $index => $item ) {
		  ?>
          <div class="<?php echo esc_attr($class_column); ?>"  data-index="<?php echo esc_attr($index); ?>">
            <div class="jws_gallery_image list">
              <div class="jws-inner">
                <div class="jws-image">
                    <div class="jws-logo">
                    <?php
                    if(!empty($item['url'])) {
                        $tmp = explode('.', $item['url']);
                        $file_ext = end($tmp);
            			if($file_ext == 'svg') {
                            $svg= jws_get_inline_svg($item['id']);
                            echo ''.$svg; 
    
            			} else { 
                         
            			   echo '<img  src="'.esc_attr($item['url']).'" width="full" height="full" class="attachment-full size-full" alt="a" >';     
                         } 
                     }
                    ?>
                    
                    </div>
                </div>
              </div>
            </div>
            </div>

        	<?php }?>
         <?php if($settings['gallery_display'] == 'slider') echo '</div>';?>
         <?php if($show_arrows && $settings['gallery_display'] == 'slider') : ?>
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
	 * Render icon list widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {

	}
}
