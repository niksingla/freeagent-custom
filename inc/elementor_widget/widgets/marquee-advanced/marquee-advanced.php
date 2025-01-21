<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Schemes;

/**
 * Elementor icon list widget.
 *
 * Elementor widget that displays a bullet list with any chosen icons and texts.
 *
 * @since 1.0.0
 */
class Marquee_Advanced extends Widget_Base {

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
		return 'marquee_advanced';
	}
    public function get_categories() {
		return [ 'jws-elements' ];
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
		return esc_html__( 'Marquee Advanced', 'freeagent' );
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
		return [ 'slider', 'carousel', 'marquee' ];
	}
    
    
   /**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
    public function get_script_depends() {
		return ['gsap','ScrollTrigger'];
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
				'label' => esc_html__( 'List', 'freeagent' ),
			]
		);
        $this->add_control(
				'skin',
				[
					'label'     => esc_html__( 'Skin', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'default',
					'options'   => [
						'default'   => esc_html__( 'Default', 'freeagent' ),
						'line_pd'   => esc_html__( 'Line And Padding', 'freeagent' ),
                        'line_sm'   => esc_html__( 'Line small', 'freeagent' ),
					],
                    
				]
		);
    
        $this->add_control(
			'reversed',
			[
				'label' => esc_html__( 'Reversed', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'freeagent' ),
				'label_off' => esc_html__( 'Off', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        
        $this->add_control(
			'scroll',
			[
				'label' => esc_html__( 'Scroll', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'freeagent' ),
				'label_off' => esc_html__( 'Off', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        
		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Title', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'List Item', 'freeagent' ),
				'default' => esc_html__( 'List Item', 'freeagent' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'des',
			[
				'label' => esc_html__( 'Description', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Viverra nam libero justo laoreet.', 'freeagent' ),
				'default' => esc_html__( 'Viverra nam libero justo laoreet.', 'freeagent' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
        
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
			'link',
			[
				'label' => esc_html__( 'Link', 'freeagent' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'freeagent' ),
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'Item #1', 'freeagent' ),
                        'des'=>esc_html__('Viverra nam libero justo laoreet.', 'freeagent'),
						'image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
					],
					[
						'text' => esc_html__( 'Item #2', 'freeagent' ),
                        'des'=>esc_html__('Viverra nam libero justo laoreet.', 'freeagent'),
						'image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
					],
					[
						'text' => esc_html__( 'Item #3', 'freeagent' ),
                        'des'=>esc_html__('Viverra nam libero justo laoreet.', 'freeagent'),
						'image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();
   
        
		$this->start_controls_section(
			'section_icon_list',
			[
				'label' => esc_html__( 'List', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        

		$this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__( 'Space Between', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				],
			]
		);

		$this->add_responsive_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mar-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .mar-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'icon_bgcolor',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mar-icon' => 'background: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .mar-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-item:hover .mar-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'icon_bgcolor_hover',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .mar-icon' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mar-icon' => 'font-size: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'icon_self_align',
			[
				'label' => esc_html__( 'Alignment', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mar-icon' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mar-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
					'icon_self_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-menu-list .mar-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__( 'Text', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover a , {{WRAPPER}} .elementor-icon-list-item.active a' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list-icon_border',
				'label' => esc_html__( 'Border', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-menu-list  li a',
			]
		);
        $this->add_control(
			'list-icon_border_hover',
			[
				'label' => esc_html__( 'Border Hover Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-menu-list  li:hover a' => 'border-color: {{VALUE}}',
				],
			]
	   );
		$this->add_control(
			'text_indent',
			[
				'label' => esc_html__( 'Text Indent', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} a' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-list-item',
			]
		);

		$this->end_controls_section();
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
		$fallback_defaults = [
			'fa fa-check',
			'fa fa-times',
			'fa fa-dot-circle-o',
		];
        
        
        $this->add_render_attribute( 'main_list', 'class', 'jws-marquee' );
        
        $option = array(
         
         'reversed' => $settings['reversed'] == 'yes' ? 1 : 0,
         'scroll'   => $settings['scroll'] == 'yes' ? 1 : 0,
        
        );
        
        $this->add_render_attribute( 'main_list', 'data-marquee-options', wp_json_encode($option) );
        
        
        

		$this->add_render_attribute( 'icon_list', 'class', 'marquee-list-items d-flex' );

        $this->add_render_attribute( 'icon_list', 'class', $settings['skin'] );
        
  
        
		?>
        <div <?php echo ''.$this->get_render_attribute_string( 'main_list' ); ?>>
            <?php if(!empty($settings['title_menu'])) : ?>
                <div class="menu-list-title"><?php echo esc_html($settings['title_menu']); ?></div>
            <?php endif; ?>
    		<div <?php echo ''.$this->get_render_attribute_string( 'icon_list' ); ?>>
    			<?php
                $actual_link = (function_exists('check_url')) ? check_url() : '';
    			foreach ( $settings['icon_list'] as $index => $item ) :
    				$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );
    
    				$this->add_render_attribute( $repeater_setting_key, 'class', 'mar-text' );
    
    				$this->add_inline_editing_attributes( $repeater_setting_key );
    				$migration_allowed = Icons_Manager::is_migration_allowed();
                    $item_key = 'item_' . $index;
                    if ( ! empty( $item['link']['url'] ) ) {
                        if ( $actual_link == $item['link']['url'] ) {
                          $this->add_render_attribute( $item_key, 'class', 'active' );          
                        }
                    }
                    $this->add_render_attribute($item_key, 'class', 'item' );
    				?>
    				<div <?php echo ''.$this->get_render_attribute_string( $item_key ); ?>>
    					<?php
                        $link_key = 'link_' . $index;
    					if ( ! empty( $item['link']['url'] ) ) {
    						$this->add_link_attributes( $link_key, $item['link'] );
    					}
                        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
        				if(!empty($item['image']['id'])){
    				    ?>
                        <div class="mar-icon">
                        <?php
 
                    
                			    echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );
                   
                             ?>
                             </div>
                             <?php
                        }
                        ?>
    					<div <?php echo ''.$this->get_render_attribute_string( $repeater_setting_key ); ?>>
                        <h6 class="text"><?php echo ''.$item['text'];?></h6>
                        <p class="des"><?php echo ''.$item['des'];?></p>
                        </div>
    				
    					</a>
    				
    				</div>
    				<?php
    			endforeach;
    			?>
    		</div>
        </div>
		<?php
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
