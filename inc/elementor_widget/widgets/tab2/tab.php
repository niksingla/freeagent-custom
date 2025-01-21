<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\NestedElements\Base\Widget_Nested_Base;
use Elementor\Modules\NestedElements\Controls\Control_Nested_Repeater;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Jws_tab_Advanced extends Widget_Nested_Base {

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
		return 'jws_tab';
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
		return esc_html__( 'Jws Tab', 'freeagent' );
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
		return 'eicon-tabs';
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
    
    protected function tab_content_container( int $index ) {
		return [
			'elType' => 'container',
			'settings' => [
				'_title' => sprintf( __( 'Tab #%s', 'freeagent' ), $index ),
				'content_width' => 'full',
			],
		];
	}

     protected function get_default_children_placeholder_selector() {
		return '.tab-content';
	}
    protected function get_default_children_elements() {
		return [
			$this->tab_content_container( 1 ),
			$this->tab_content_container( 2 ),
			$this->tab_content_container( 3 ),
		];
	}

	protected function get_default_repeater_title_setting_key() {
		return 'list_title';
	} 
                    
	protected function register_controls() {
	    $this->start_controls_section(
			'setting_section',
			[
				'label' => esc_html__( 'Setting', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		); 
        
        $this->add_control(
			'nav_skin',
			[
				'label' => esc_html__( 'Nav Skin', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'classic',
				'options' => [
					'classic'  => esc_html__( 'Classic', 'freeagent' ),
                    'line'  => esc_html__( 'Line', 'freeagent' ),
				],
			]
		);  
        
        $this->add_control(
			'nav_tab_display',
			[
				'label' => esc_html__( 'Display', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top'  => esc_html__( 'Top', 'freeagent' ),
                    'left'  => esc_html__( 'Left', 'freeagent' ),
                    'right'  => esc_html__( 'Right', 'freeagent' ),
				],
			]
		);
        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'freeagent' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
    				'value' => 'fas fa-star',
    				'library' => 'solid',
    			],
            ]
        );
        
        $this->add_control(
            'active_icon',
            [
                'label' => esc_html__( 'Active Icon', 'freeagent' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
    				'value' => 'fas fa-star',
    				'library' => 'solid',
    			],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Tab Item', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();
 
 
		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Name', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Name' , 'freeagent' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_content', [
				'label' => esc_html__( 'Description', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'List Description' , 'freeagent' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
				'btn_text',
				[
					'label'     => esc_html__( 'Text Button', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'Discover more',
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
	   
       
        $this->add_control( 'list', [
			'label' => esc_html__( 'Tabs Items', 'freeagent' ),
			'type' => Control_Nested_Repeater::CONTROL_TYPE,
			'fields' => $repeater->get_controls(),
			'default' => [
				[
					'list_title' => esc_html__( 'Tab #1', 'freeagent' ),
				],
				[
					'list_title' => esc_html__( 'Tab #2', 'freeagent' ),
				],
				[
					'list_title' => esc_html__( 'Tab #3', 'freeagent' ),
				],
			],
			'title_field' => '{{{ list_title }}}',
			'button_text' => 'Add Tab',
		] );

                              


		$this->end_controls_section();
        $this->start_controls_section(
			'nav_style',
			[
				'label' => esc_html__( 'Nav', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'nav_position',
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
                    'justify' => [
						'title' => __( 'Justify', 'freeagent' ),
						'icon' => 'eicon-text-align-justify',
					],
                   
				],
                'prefix_class' => 'nav-align-',
				'default' => 'justify',
			]
		);
        $this->add_responsive_control(
			'nav_width',
			[
				'label' => esc_html__( 'Width', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' , '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
                    '%' => [
						'min' => 1,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .tab-nav ul' => 'max-width: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .tab-nav ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);

        $this->add_control(
			'nav_item_style',
			[
				'label' => esc_html__( 'Item', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_responsive_control(
			'nav_item_width',
			[
				'label' => esc_html__( 'Width', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' , '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
                    '%' => [
						'min' => 1,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .tab-nav li' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
					'nav_item_margin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .tab-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
					'nav_item_padding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding Inside', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .tab-nav li a.pos-rel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
			'nav_item_paddingout',
			[
				'type' 			=> Controls_Manager::DIMENSIONS,
				'label' 		=> esc_html__( 'Padding Out Side', 'freeagent' ),
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .tab-nav li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'nav_item_radius',
			[
				'type' 			=> Controls_Manager::DIMENSIONS,
				'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .tab-nav li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
         $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'nav_item_border',
					'label' 	=> esc_html__( 'Border', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} .jws-tab-advanced .tab-nav li a',
				]
		);
        $this->add_control(
			'nav_item_border_color_active',
			[
				'label' => esc_html__( 'Border Color Active', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-tab-advanced .tab-nav li.current a' => 'border-color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'nav_item_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-tab-advanced .tab-nav li a, 
                    {{WRAPPER}} .jws-tab-advanced .tab-nav li .jws_content' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'nav_item_color_active',
			[
				'label' => esc_html__( 'Color Active', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-tab-advanced .tab-nav li.current a,
                    {{WRAPPER}} .jws-tab-advanced .tab-nav li.current .jws_content' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'nav_item_bgcolor',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-tab-advanced .tab-nav li' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'nav_item_bgcolor_active2',
			[
				'label' => esc_html__( 'Background Color Active', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-tab-advanced .tab-nav li.current' => 'background: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'label' => esc_html__( 'Typography', 'freeagent'),
				'selector' => '{{WRAPPER}} .jws-tab-advanced .tab-nav li a.pos-rel',
			]
		);


		$this->end_controls_section();
        $this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
					'content_padding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-tab-advanced .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
			'content_position',
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .jws-tab-advanced .tab-content' => 'text-align: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'freeagent' ),
					'right' => esc_html__( 'After', 'freeagent' ),
				],
			]
		);
        
        $this->add_responsive_control(
					'icon_margin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-tab-advanced .tab-nav li a .item-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
          $this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-tab-advanced .tab-nav li a .item-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-tab-advanced .tab-nav li a .item-icon' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'icon_color_active',
			[
				'label' => esc_html__( 'Color Active', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-tab-advanced .tab-nav li.current a .item-icon' => 'color: {{VALUE}};',
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
	public function get_saved_data() {

		$saved_widgets = $this->get_post_template();
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
		$posts = get_posts( array(
			'post_type' => 'elementor_library',
			'posts_per_page' => -1,
			'meta_query'  => array(
				array(
					'key' => '_elementor_template_type',
					'value' => 'kit',
					'compare' => '!=',
				),
			),
		) );

		$templates = array();

		foreach ( $posts as $post ) {

			$templates[] = array(
				'id'   => $post->ID,
				'name' => $post->post_title,
			);
		}

		return $templates;
	}
   protected function add_attributes_to_container( $container, $item_id ) {
		$container->add_render_attribute( '_wrapper', [
			'role' => 'region',
			'aria-labelledby' => $item_id,
		] );
	}
    
    public function print_child( $index, $item_id = null ) {
		$children = $this->get_children();

		if ( ! empty( $children[ $index ] ) ) {
			// Add data-tab-index attribute to the content area.
			$add_attribute_to_container = function ( $should_render, $container ) use ( $item_id ) {
					$this->add_attributes_to_container( $container, $item_id );

				return $should_render;
			};

			add_filter( 'elementor/frontend/container/should_render', $add_attribute_to_container, 10, 3 );
			$children[ $index ]->print_element();
			if(function_exists('jws_removes_filter')) jws_removes_filter( 'elementor/frontend/container/should_render', $add_attribute_to_container , '' );
		}
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
        $widget_number = substr( $this->get_id_int(), 0, 3 );
        $this->add_render_attribute( [
			'icon-align' => [
				'class' => [
                    'item-icon',
					'elementor-align-icon-' . $settings['icon_align'],
				],
			],
		] );
        
        $this->add_render_attribute( [
			'nav' => [
				'class' => [
                    'tab-nav d-flex',
					'skin-' . $settings['nav_skin'],
				],
			],
		] );
      if($settings['nav_tab_display']=='left' || $settings['nav_tab_display']=='right'){
        $display = 'block';
      }else{
        $display = 'flex';
      }
		if ( $settings['list'] ) {
		   
		     ?>
		      	<div class="jws-tab-advanced display_<?php echo ''.$settings['nav_tab_display'];?>">

                  <div <?php echo ''.$this->get_render_attribute_string( 'nav' ); ?>>  
                          <ul class="reset_ul_ol d-<?php echo ''.$display;?>">
                                <?php $nav = 1; foreach (  $settings['list'] as $index => $item ) {   $tab_count = $index + 1;  
                                        $link_key = 'link' ;   
                                       if($item['link_url']['nofollow']) $this->add_render_attribute( $link_key, 'rel',  'nofollow' );
                                       if($item['link_url']['is_external']) $this->add_render_attribute( $link_key, 'target',  '_blank' );  
                                       $this->add_render_attribute( $link_key, 'href',  $item['link_url']['url'] );  
                                ?>
                    				<li class="jws_nav_item <?php if($nav == 1) echo " current"; ?>">
                                        <a class="pos-rel" href="#" data-tab="<?php echo 'e-n-tab-content-' . $widget_number . $tab_count; ?>">
                                        <?php if ( ! empty( $settings['icon'] ) ) : ?>
                                            <span class="icon" <?php echo ''.$this->get_render_attribute_string( 'icon-align' ); ?>>
                                				<i class="<?php echo esc_attr($settings['icon']['value']); ?>" aria-hidden="true"></i>
                                			</span>
											<?php endif; ?>
												<?php if ( ! empty( $settings['active_icon'] ) ) : ?>
											<span class="active_icon" <?php echo ''.$this->get_render_attribute_string( 'icon-align' ); ?>>
                                			<i class="<?php echo esc_attr($settings['active_icon']['value']); ?>" aria-hidden="true"></i>
                                			</span>
                                            <?php endif; ?>
                                            <span><?php echo esc_html($item['list_title']); ?></span> 
                                        </a>  
                                        <?php                                           
                                            echo '<div class="jws_content"><p class="description">'.esc_html($item['list_content']).'</p><a class="btn_view" '.$this->get_render_attribute_string($link_key).'><i class="jws-icon-circle-right"></i> '.esc_html($item['btn_text']).'</a></div>';
                                            ?>
                                    </li>
                    		  <?php $nav++; } ?>
                          </ul>  
                  </div>
                  <div class="tab-content">  
            		  <?php 	
                      
                         $content = 1; foreach (  $settings['list'] as $index => $item ) { 
                            
                             $tab_count = $index + 1;

                    		 $item_id = 'e-n-tab-content-' . $widget_number . $tab_count;
                             
                             $current = ($tab_count == 1) ? " current" : '';
            		       
                             // Slide Content.
                    			ob_start();
                                
                                echo '<div id="'.$item_id.'" class="tab-item'.$current.'">';
                                
                    			$this->print_child( $index , $item_id );
                                
                                echo '</div>';
                             
                    			$slide_html = ob_get_clean();
                                
                    			echo ''.$slide_html;
                            
              
                         ?>
            	
            		  <?php $content++; } ?>
                 
                                                                                        
                  </div>
                </div>
		    <?php }  
		
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
	protected function content_template() {
	
      	?>
	    <# 
       
          const tab_Attrs = {
			'class': [ 'jws-tab-advanced', 'elementor-inline-editing'],
		  };
          
          const nav_Attrs = {
			'class': [ 'tab-nav d-flex', 'skin-'+settings.nav_skin ],
		  };
          
          view.addRenderAttribute( 'nav_Attributes', nav_Attrs);
          
          if ( settings.absolute == 'yes' ) { 
            tab_Attrs.class.push('tab_absolute');
          }
          
          view.addRenderAttribute( 'tab_Attributes', tab_Attrs);
          
          const icon_align = {
			'class': [ 'item-icon', 'elementor-align-icon-'+settings.icon_align],
		  };
          
          const elementUid = view.getIDInt().toString().substr( 0, 3 );
          
          view.addRenderAttribute( 'icon_align', icon_align);
          
         var iconHTML = elementor.helpers.renderIcon( view, settings.new_icon_id, { 'aria-hidden': true }, 'i' , 'object' );   
        
        #> 
  
		
        <div {{{ view.getRenderAttributeString('tab_Attributes') }}}> 
                  <div {{{ view.getRenderAttributeString('nav_Attributes') }}}>  
                      <ul class="reset_ul_ol d-flex">
                            <# _.each( settings.list, function( item, i ) {
                          
                                        const nav_active = i + 1 == 1 ? ' current' : '',
                                        tabCount = i + 1,
					                    tabUid = elementUid + tabCount;
                                        
         
                            #>
                        
                				<li class="{{{ nav_active }}}">
                                    <a class="pos-rel" href="#" data-tab="e-n-tab-content-{{{ tabUid }}}">
                                        <# if ( item.icon !== '' ) {  #>
                                        <span class="icon">
                            			{{{ iconHTML.value }}}
                            			</span>
                                        <span class="active_icon">
                            				{{{ iconHTML.value }}}
                            			</span>
                              
                                         <#  }   #>
                                        <span>{{{item.list_title}}}</span>
                                    </a>  
                                </li>
                                
                		    <# }); #>
                      </ul>  
                  </div>
           
			<div class="tab-content">
			   
                <# _.each( settings.list, function( item, i ) {
                    
                    const content_active = i + 1 == 1 ? ' current' : '',
                    tabCount = i + 1,
                    tabUid = elementUid + tabCount;
                    
                 #>
            
                 <div id="e-n-tab-content-{{{ tabUid }}}" class="tab-item {{{ content_active }}}">
                 
                 
                 </div>      

    		    <# }); #>
			
			</div>
		</div>
		<?php
	
	}
}