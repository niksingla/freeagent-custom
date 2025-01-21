<?php
namespace Elementor;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Jws_Blog extends Widget_Base {

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
		return 'jws_blog';
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
		return esc_html__( 'Jws Blog', 'freeagent' );
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
		return 'eicon-post';
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
		return ['magnificPopup'];
	  }
      public function get_style_depends() {
		return [ 'magnificPopup'];
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
	 * Register Woo post Grid controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_controls() {

		/* General Tab */
        $this->register_content_general_controls();
        $this->register_content_filter_controls();
		$this->register_content_grid_controls();

        $this->register_content_pagination_controls();
        $this->register_content_slider_controls();
      
 
	}

    /**
	 * Register Woo posts General Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	*/
	protected function register_content_general_controls() {

		$this->start_controls_section(
			'section_general_field',
			[
				'label' => esc_html__( 'General', 'freeagent' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
				'blog_display',
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
            $this->add_control(
    			'enable_masonry',
    			[
    				'label' => esc_html__( 'Enable Masonry', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'freeagent' ),
    				'label_off' => esc_html__( 'Off', 'freeagent' ),
    				'return_value' => 'yes',
    			]
    		);
            $this->add_control(
    			'enable_animation',
    			[
    				'label' => esc_html__( 'Enable Animation', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'freeagent' ),
    				'label_off' => esc_html__( 'Off', 'freeagent' ),
    				'return_value' => 'yes',
    			]
    		);
            $this->add_control(
    			'border_popover_toggle',
    			[
    				'label' => esc_html__( 'Border', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
    				'label_off' => esc_html__( 'Default', 'freeagent' ),
    				'label_on' => esc_html__( 'Custom', 'freeagent' ),
    				'return_value' => 'yes',
    				'default' => 'yes',
    			]
		    );
            $this->add_control(
				'blog_layouts',
				[
					'label'     => esc_html__( 'Layout', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'Layout 1', 'freeagent' ),
                        'layout2'   => esc_html__( 'Layout 2', 'freeagent' ),
                        'layout3'   => esc_html__( 'Layout List', 'freeagent' ),
                         'layout4'   => esc_html__( 'Layout Feature', 'freeagent' )
					],
                    
				]
			);
            $this->add_control(
				'excerpt_length',
				[
					'label'     => esc_html__( 'Excerpt Length', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => '',
				]
			);
             $this->add_control(
				'excerpt_more',
				[
					'label'     => esc_html__( 'Excerpt More', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => ' ... ',
				]
			);
            $this->add_control(
				'excerpt_line',
				[
					'label'     => esc_html__( 'Excerpt Line', 'freeagent' ),
					'type'      => \Elementor\Controls_Manager::NUMBER,
 				'selectors' => [
    					'{{WRAPPER}} .jws_post_wap .jws_post_excerpt' => '-webkit-line-clamp:{{VALUE}};',
    				],	
				]
			);
            $this->add_control(
				'readmore_text',
				[
					'label'     => esc_html__( 'Read More Text', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'Read More',
				]
			);
            $this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Read More Icon', 'freeagent' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fab fa-wordpress',
                		'library' => 'fa-brands',
					],
				]
		  );
          $this->add_control(
			'blog_image_size',
			[
				'label' => esc_html__( 'Image Size', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'default' => [
					'width' => '',
					'height' => '',
				],
			]
		  );
          $this->add_control(
			'post_archive',
			[
				'label' => esc_html__( 'Show Post For Archive Category', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'freeagent' ),
				'label_off' => esc_html__( 'Off', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->add_control(
			'post_related',
			[
				'label' => esc_html__( 'Show post related for single blog', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'freeagent' ),
				'label_off' => esc_html__( 'Off', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
          $this->add_control(
			'ajax_page',
			[
				'label' => esc_html__( 'ajax_page', 'freeagent' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => '',
			]
		  );
          $this->add_control(
    				'post_nav_on',
    				[
    					'label'        => esc_html__( 'Enable Filter', 'freeagent' ),
    					'type'         => Controls_Manager::SWITCHER,
    					'label_on'     => esc_html__( 'Yes', 'freeagent' ),
    					'label_off'    => esc_html__( 'No', 'freeagent' ),
    					'return_value' => 'yes',
    					'description'  => esc_html__( 'Enable filter post.', 'freeagent' ),
    				]
    	   );
           $this->add_control(
				'post_text_first',
				[
					'label'     => esc_html__( 'Filter Text All', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
                    'default' => 'ALL CATEGORIES',
                    'condition'	=> [
						'filter_by' => 'categories',
				    ],
			 ]
		  );  

		$this->end_controls_section();
       
     }   
    	/**
	 * Register Woo posts Filter Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_filter_controls() {

		$this->start_controls_section(
			'section_filter_field',
			[
				'label' => esc_html__( 'Query', 'freeagent' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
						'post_archive!' => [ 'yes' ],
                        'post_related!' => [ 'yes' ],
				],
			]
		);
        
        $this->add_control(
				'blog_per_page',
				[
					'label'     => esc_html__( 'posts Per Page', 'freeagent' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => '8',
					'condition' => [
						'query_type!'  => 'main',
					],
				]
			);
		$this->add_control(
				'query_type',
				[
					'label'   => esc_html__( 'Source', 'freeagent' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => [
						'all'    => esc_html__( 'All posts', 'freeagent' ),
						'custom' => esc_html__( 'Custom Query', 'freeagent' ),
						'manual' => esc_html__( 'Manual Selection', 'freeagent' ),
					],
				]
			);

			$this->add_control(
				'category_filter_rule',
				[
					'label'     => esc_html__( 'Category Filter Rule', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'IN',
					'options'   => [
						'IN'     => esc_html__( 'Match Categories', 'freeagent' ),
						'NOT IN' => esc_html__( 'Exclude Categories', 'freeagent' ),
					],
					'condition' => [
						'query_type' => 'custom',
					],
				]
			);
			$this->add_control(
				'category_filter',
				[
					'label'     => esc_html__( 'Select Categories', 'freeagent' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_blog_categories(),
					'condition' => [
						'query_type' => 'custom',
					],
				]
			);
            
            
			$this->add_control(
				'tag_filter_rule',
				[
					'label'     => esc_html__( 'Tag Filter Rule', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'IN',
					'options'   => [
						'IN'     => esc_html__( 'Match Tags', 'freeagent' ),
						'NOT IN' => esc_html__( 'Exclude Tags', 'freeagent' ),
					],
					'condition' => [
						'query_type' => 'custom',
					],
				]
			);
			$this->add_control(
				'tag_filter',
				[
					'label'     => esc_html__( 'Select Tags', 'freeagent' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_blog_tags(),
					'condition' => [
						'query_type' => 'custom',
					],
				]
			);
			$this->add_control(
				'offset',
				[
					'label'       => esc_html__( 'Offset', 'freeagent' ),
					'type'        => Controls_Manager::NUMBER,
					'default'     => 0,
					'description' => esc_html__( 'Number of post to displace or pass over.', 'freeagent' ),
					'condition'   => [
						'query_type' => 'custom',
					],
				]
			);

			$this->add_control(
				'query_manual_ids',
				[
					'label'     => esc_html__( 'Select posts', 'freeagent' ),
					'type'      => 'jws-query-posts',
					'post_type' => 'post',
					'multiple'  => true,
					'condition' => [
						'query_type' => 'manual',
					],
				]
			);

			/* Exclude */
			$this->add_control(
				'query_exclude',
				[
					'label'     => esc_html__( 'Exclude', 'freeagent' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'query_type!' => [ 'manual', 'main' ],
					],
				]
			);
			$this->add_control(
				'query_exclude_ids',
				[
					'label'       => esc_html__( 'Select posts', 'freeagent' ),
					'type'        => 'jws-query-posts',
					'post_type'   => 'post',
					'multiple'    => true,
					'description' => esc_html__( 'Select posts to exclude from the query.', 'freeagent' ),
					'condition'   => [
						'query_type!' => [ 'manual', 'main' ],
					],
				]
			);
			$this->add_control(
				'query_exclude_current',
				[
					'label'        => esc_html__( 'Exclude Current post', 'freeagent' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'freeagent' ),
					'label_off'    => esc_html__( 'No', 'freeagent' ),
					'return_value' => 'yes',
					'default'      => '',
					'description'  => esc_html__( 'Enable this option to remove current post from the query.', 'freeagent' ),
					'condition'    => [
						'query_type!' => [ 'manual', 'main' ],
					],
				]
			);

			/* Advanced Filter */
			$this->add_control(
				'query_advanced',
				[
					'label'     => esc_html__( 'Advanced', 'freeagent' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);
            			$this->add_control(
				'filter_by_popular',
				[
					'label'     => esc_html__( 'Filter By', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '',
					'options'   => [
						''         => esc_html__( 'None', 'freeagent' ),
						'popular' => esc_html__( 'Popular Post', 'freeagent' ),
					
					],
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);

			$this->add_control(
				'orderby',
				[
					'label'     => esc_html__( 'Order by', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'date',
					'options'   => [
						'date'       => esc_html__( 'Date', 'freeagent' ),
						'title'      => esc_html__( 'Title', 'freeagent' ),
						'rand'       => esc_html__( 'Random', 'freeagent' ),
						'post__in' => esc_html__( 'Post In', 'freeagent' ),
                        'meta_value_num'=>esc_html__( 'Meta value number', 'freeagent' ),
					],
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);
			$this->add_control(
				'order',
				[
					'label'     => esc_html__( 'Order', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'desc',
					'options'   => [
						'desc' => esc_html__( 'Descending', 'freeagent' ),
						'asc'  => esc_html__( 'Ascending', 'freeagent' ),
					],
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);

		$this->end_controls_section();
	}
    
   
	/**
	 * Register grid Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_grid_controls() {
		$this->start_controls_section(
			'section_grid_options',
			[
				'label'     => esc_html__( 'Grid Options', 'freeagent' ),
				'type'      => Controls_Manager::SECTION,
			]
		);
		$this->add_responsive_control(
				'blog_columns',
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
		$this->end_controls_section();
	}
      /**
	 * Register Pagination Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_pagination_controls() {

		$this->start_controls_section(
			'section_pagination_field',
			[
				'label'     => esc_html__( 'Pagination', 'freeagent' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
					'blog_display' => ['grid'],
				],
			]
		);
        $this->add_responsive_control(
				'nav_align',
				[
					'label' 		=> esc_html__( 'Align', 'freeagent' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'center',
					'options' 		=> [
						'flex-start'    		=> [
							'title' 	=> esc_html__( 'Left', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'flex-end' 		=> [
							'title' 	=> esc_html__( 'Right', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .jws-blog-element  .jws-pagination-number .page-numbers' => 'justify-content: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
		$this->add_control(
				'pagination_type',
				[
					'label'     => esc_html__( 'Type', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '',
					'options'   => [
						''              => esc_html__( 'None', 'freeagent' ),
                        'load_more' => esc_html__( 'Load More', 'freeagent' ),
                        'pagination-number' => esc_html__( 'Number Pagination', 'freeagent' ),
					],
				]
		);
        $this->add_control(
				'pagination_loadmore_label',
				[
					'label'     => esc_html__( 'Loadmore Label', 'freeagent' ),
					'default'   => esc_html__( 'Load more', 'freeagent' ),
					'condition' => [
						'pagination_type'      => ['load_more'],
					],
				]
		);
		$this->end_controls_section();
	}
    /**
	 * Register Slider Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_slider_controls() {

             $this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Post', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'show_thumbnail',
			[
				'label' => esc_html__( 'Show Thumbnail', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'yes',

			]
		);
        $this->add_control(
			'show_line',
			[
				'label' => esc_html__( 'Show Divider', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws_blog_item .jws_post_wap' => 'border-bottom: 1px solid rgba(66, 84, 102, 0.1);',

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
					'{{WRAPPER}} .jws_blog_item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .blog_content.row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
					'{{WRAPPER}} .jws_blog_item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
            'label' 		=> esc_html__( 'Box Shadow', 'freeagent' ),
				'name' => 'post_box_shadow',
				'selector' => '{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap',
			]
		);
        $this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap' => 'background-color: {{VALUE}}',
				],
			]
		);
    $this->add_responsive_control(
			'box_padding',
			[
				'label' 		=> esc_html__( 'Padding Out', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
            $this->add_responsive_control(
			'box_in_padding',
			[
				'label' 		=> esc_html__( 'Padding In', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap .jws_post_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
            $this->add_responsive_control(
			'box_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
        $this->add_responsive_control(
			'box_border_radius',
			[
				'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
        $this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
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
				'selectors' => [
					'{{WRAPPER}} .jws_blog_item' => 'text-align: {{VALUE}};',
				],
			]
		);
        
        $this->end_controls_section();
          $this->start_controls_section(
			'box_thumbnail_style',
			[
				'label' => esc_html__( 'Thumbnail', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .jws_post_image' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
				],
            	'condition'   => [
                    'blog_layouts'=>['layout4','layout3']
                ]
			]
		);
            $this->add_responsive_control(
			'box_thumbnail_radius',
			[
				'label' 		=> esc_html__( 'Border radius', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap .jws_post_image,
                    {{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap .jws_post_image img ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
         $this->end_controls_section();
         $this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap .jws_post_content .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Title Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap .jws_post_content .entry-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap .jws_post_content .entry-title',
			]
		);

        $this->add_responsive_control(
					'title_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap .jws_post_content .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography_hover',
				'label' => esc_html__( 'Typography Hover', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap .jws_post_content .entry-title:hover',
			]
		);
        $this->add_control(
			'title_underline_color_hover',
			[
				'label' => esc_html__( 'Underline Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element .jws_blog_item .jws_post_wap .jws_post_content .entry-title a:hover' => 'text-decoration-color: {{VALUE}}; -webkit-text-decoration-color:{{VALUE}};-moz-text-decoration-color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'excerpt_style',
			[
				'label' => esc_html__( 'Excerpt', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'show_excerpt',
			[
				'label' => esc_html__( 'Show Excerpt', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'excerpt_color',
			[
				'label' => esc_html__( 'Excerpt Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element .jws_post_wap .jws_post_excerpt' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-blog-element .jws_post_wap .jws_post_excerpt',
			]
		);
        $this->add_responsive_control(
					'excerpt_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-blog-element .jws_post_wap .jws_post_excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'author_style',
			[
				'label' => esc_html__( 'Author', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'show_author',
			[
				'label' => esc_html__( 'Show Author', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'author_color',
			[
				'label' => esc_html__( 'Name Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element .jws_post_wap .jws-post-author' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-blog-element .jws_post_wap .jws-post-author',
			]
		);
        $this->add_responsive_control(
					'author_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-blog-element .jws_post_wap .jws-post-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->end_controls_section();
        
        $this->start_controls_section(
			'metabox_style',
			[
				'label' => esc_html__( 'Metabox', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
                $this->add_group_control(
        			Group_Control_Typography::get_type(),
        			[
        				'name' => 'meta_typography',
        				'label' => esc_html__( 'Typography', 'freeagent' ),
        				'selector' => '{{WRAPPER}} .jws-blog-element .jws_post_wap .entry-date,
                                        {{WRAPPER}} .jws-blog-element .jws_post_wap .entry-read,
                                        {{WRAPPER}} .jws-blog-element .jws_post_wap .post_cat',
        			]
        		);

                $this->add_responsive_control(
					'date_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-blog-element .jws_post_wap .jws_post_meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		      );
            $this->add_control(
    			'date_title',
    			[
    				'label' => esc_html__( 'Date', 'freeagent' ),
    				'type' => Controls_Manager::HEADING,
    				'separator' => 'before',
    			]
    		);
        $this->add_control(
			'show_date',
			[
				'label' => esc_html__( 'Show Date', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'date_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element .jws_post_wap .entry-date a' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'date_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element .jws_post_wap .entry-date a:hover' => 'color: {{VALUE}}',
				],
			]
		);
            $this->add_responsive_control(
					'date_in_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-blog-element .jws_post_wap .meta_infor' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		      );
            $this->add_control(
        			'category_title',
        			[
        				'label' => esc_html__( 'Category', 'freeagent' ),
        				'type' => Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        		);
            $this->add_control(
    			'show_category',
    			[
    				'label' => esc_html__( 'Show Category', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'Show', 'freeagent' ),
    				'label_off' => esc_html__( 'Hide', 'freeagent' ),
    				'return_value' => 'yes',
    				'default' => 'yes',
    			]
    		);
            $this->add_control(
    			'cate_color',
    			[
    				'label' => esc_html__( 'Color', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-blog-element .jws_post_wap .post_cat a' => 'color: {{VALUE}}',
    				],
    			]
    		);
        $this->add_control(
    			'cate_color_hover',
    			[
    				'label' => esc_html__( 'Color Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-blog-element .jws_post_wap .post_cat a:hover' => 'color: {{VALUE}}',
    				],
    			]
    		);
                $this->add_responsive_control(
					'cate_in_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-blog-element .jws_post_wap .post_cat a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		      );
        $this->end_controls_section();
        
        
        $this->start_controls_section(
			'readmore_style',
			[
				'label' => esc_html__( 'Read More', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'show_readmore',
			[
				'label' => esc_html__( 'Show Readmore', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			're_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element .jws_post_wap .jws_post_content .jws_post_readmore' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			're_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element .jws_post_wap .jws_post_content .jws_post_readmore:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-blog-element .jws_post_wap .jws_post_content .jws_post_readmore',
			]
		);
        $this->add_responsive_control(
					'readmore_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-blog-element .jws_post_wap .jws_post_content .jws_post_readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->end_controls_section();
         $this->start_controls_section(
			'nav_style',
			[
				'label' => esc_html__( 'Pagination Load', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'nav_color',
			[
				'label' 	=> esc_html__( 'Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element  .jws-pagination-number ul li > a' => 'color: {{VALUE}} ;',
				],
			]
		);
        $this->add_control(
			'nav_color_active',
			[
				'label' 	=> esc_html__( 'Color Active', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-pagination-number ul li > a:hover, 
                    {{WRAPPER}}  .jws-pagination-number ul li > .current' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'nav_bg_color',
			[
				'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element  .jws-pagination-number ul li > a,
                    {{WRAPPER}} .jws-blog-element  .jws-pagination-number ul li > span' => 'background-color: {{VALUE}} ;',
				],
			]
		);
        $this->add_control(
			'nav_bg_color_active',
			[
				'label' 	=> esc_html__( 'Background Color Active', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-pagination-number ul li > a:hover, 
                    {{WRAPPER}}  .jws-pagination-number ul li > .current' => 'background-color: {{VALUE}};border-color:{{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
			'nav_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-blog-element  .jws-pagination-number, {{WRAPPER}} .jws-blog-element .jws-load-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
					'nav_size',
					[
						'label' 		=> esc_html__( 'Size', 'freeagent' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-blog-element  .jws-pagination-number ul li > a,
                            {{WRAPPER}} .jws-blog-element  .jws-pagination-number ul li > span' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};line-height:calc({{SIZE}}{{UNIT}} - 4px);',
						],
					]
		);
                $this->add_responsive_control(
					'nav_border_radius',
					[
						'label' 		=> esc_html__( 'Border radius', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-blog-element  .jws-pagination-number ul li > a,
                            {{WRAPPER}} .jws-blog-element  .jws-pagination-number ul li > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
  $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' =>  esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-blog-element  .jws-pagination-number ul li > a,
                            {{WRAPPER}} .jws-blog-element  .jws-pagination-number ul li > span',
			]
		);

        $this->add_control(
			'nav_line',
			[
				'label' => esc_html__( 'Line', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
			'line_color',
			[
				'label' => esc_html__( 'Line Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element  .post_nav #magic_line' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .jws-blog-element  .post_nav li a.filter-active' => 'border-color: {{VALUE}}',
				],
			]
		);
         $this->add_responsive_control(
			'line_height',
			[
				'label'     => esc_html__( 'Line Height', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-blog-element  .post_nav #magic_line' => 'height:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jws-blog-element  .post_nav li a' => 'border-width:{{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
     jws_elementor_widget_slider_config($this,['blog_display' => 'slider']);   
	}

    /**
	 * Get WooCommerce post Categories.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function get_blog_categories() {

		$blog_cat = array();

		$cat_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$blog_categories = get_terms( 'category', $cat_args );

		if ( ! empty( $blog_categories ) ) {

			foreach ( $blog_categories as $key => $category ) {
				$blog_cat[ $category->term_id ] = $category->name;
			}
		}

		return $blog_cat;
	}
    /**
	 * Get WooCommerce post Tags.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function get_blog_tags() {

		$blog_tag = array();

		$tag_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$blog_tag = get_terms( 'post_tag', $tag_args );

		if ( ! empty( $blog_tag ) ) {

			foreach ( $blog_tag as $key => $tag ) {

				$blog_tag[ $tag->term_id ] = $tag->name;
			}
		}

		return $blog_tag;
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


			global $post;
			         
            //Filter
            if($settings['filter_by_popular']=='popular'){ 
              	$query_args = [
                 'post_type'      => 'post',  
                'meta_key' => 'post_views_count', 
                'post_status'    => 'publish',
                'post__not_in'   => array(),
                'posts_per_page' => -1,
			];
            }else{
              	$query_args = [
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'paged'          => 1,
				'post__not_in'   => array(),
			];  
            }
            // Default ordering args.
			$query_args['orderby'] = $settings['orderby'];
			$query_args['order']   = $settings['order'];
		    if ( $settings['blog_per_page'] > 0 ) {
					$query_args['posts_per_page'] = $settings['blog_per_page'];
			}
			if ( '' !== $settings['pagination_type'] ) {

					if ( is_front_page() ) {
                        $paged = (get_query_var('page')) ? get_query_var('page') : 1;   
                    } else {
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                    }


					$query_args['paged'] = $paged;
                    
			}


			if ( 'custom' === $settings['query_type'] ) {

				if ( ! empty( $settings['category_filter'] ) ) {

					$cat_operator = $settings['category_filter_rule'];

					$query_args['tax_query'][] = [
						'taxonomy' => 'category',
						'field'    => 'id',
						'terms'    => $settings['category_filter'],
						'operator' => $cat_operator,
					];
				}

				if ( ! empty( $settings['tag_filter'] ) ) {

					$tag_operator = $settings['tag_filter_rule'];

					$query_args['tax_query'][] = [
						'taxonomy' => 'post_tag',
						'field'    => 'id',
						'terms'    => $settings['tag_filter'],
						'operator' => $tag_operator,
					];
				}

				if ( 0 < $settings['offset'] ) {

					/**
					 * Offset break the pagination. Using WordPress's work around
					 *
					 * @see https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
					 */
					$query_args['offset_to_fix'] = $settings['offset'];
				}
			}

			if ( 'manual' === $settings['query_type'] ) {

				$manual_ids = $settings['query_manual_ids'];

				$query_args['post__in'] = $manual_ids;
			}

			if ( 'manual' !== $settings['query_type'] && 'main' !== $settings['query_type'] ) {

				if ( '' !== $settings['query_exclude_ids'] ) {

					$exclude_ids = $settings['query_exclude_ids'];

					$query_args['post__not_in'] = $exclude_ids;
				}

				if ( 'yes' === $settings['query_exclude_current'] && isset($post->ID) ) {

					$query_args['post__not_in'][] = $post->ID;
				}
			}


			$blog = new \WP_Query( $query_args );

      $class_row = 'blog_content ';  
      $class_row .= ' jws_blog_'.$settings['blog_layouts'].'';
      $class_row .= ' blog_ajax_'.$this->get_id().'';
    
      if ( $blog->max_num_pages > 1) { $class_row.= ' jws_has_pagination'; }
      
      $class_column = 'jws_blog_item';
      
            $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
    		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
             $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : '';       
     
 
      
      if($settings['blog_display'] == 'slider') {
            $class_row .= ' swiper jws_blog_slider '.$show_inbox;
            $class_column .= ' swiper-slide';

       }else {
        $class_row .=" row";
          $class_column .= ' col-xl-'.$settings['blog_columns'].'';
          $class_column .= (!empty($settings['blog_columns_tablet'])) ? ' col-lg-'.$settings['blog_columns_tablet'].'' : ' col-lg-'.$settings['blog_columns'].'' ;
          $class_column .= (!empty($settings['blog_columns_mobile'])) ? ' col-'.$settings['blog_columns_mobile'].'' :  ' col-'.$settings['blog_columns'].'';
             
       }
       if($settings['enable_masonry'] == 'yes') {
            $class_row .= ' has-masonry';
             wp_enqueue_script('isotope');
       }
       
       if($settings['enable_animation'] == 'yes') {
            $class_row .= ' has-animation';
            $class_column .= ' jws-ani-item';
       }
       
    
      $image_size = !empty($settings['blog_image_size']['width']) && !empty($settings['blog_image_size']['height']) ?  $settings['blog_image_size']['width'].'x'.$settings['blog_image_size']['height'] : 'full';
 

      ?>
 
		
		<div class="jws-blog-element<?php if($settings['post_nav_on'] == 'yes') echo esc_attr(' has-nav'); ?> jws-carousel">
        <?php 
         if($settings['post_nav_on'] == 'yes'):
               
                $taxonomy_names = get_object_taxonomies('post');
                if((isset($settings['category_filter_rule']) && $settings['category_filter_rule'] != 'IN') && 'custom' === $settings['query_type']) {
                   $cats = get_categories(array(
                       'orderby' => 'name',
                       'exclude' => $settings['category_filter'],
                   ));  
                } elseif((isset($settings['category_filter_rule']) && $settings['category_filter_rule'] == 'IN') && 'custom' === $settings['query_type']) {
                   $cats = get_categories( array(
                       'orderby' => 'name',
                       'include' => $settings['category_filter'],
                    ));
                }else {
                    $cats  = get_categories( array(
                        'orderby' => 'name',
                        'parent'  => 0
                    ) );
                }
            ?>
            <div class="post_nav_container">
                <ul class="post_nav">
                    <li><a href="#" data-filter="*" class="filter-active"><?php echo (!empty($settings['post_text_first'])) ? $settings['post_text_first'] : esc_html__('All CATEGORIES', 'freeagent'); ?></a></li>
                    <?php
                        foreach ($cats as $cat) {
                            ?>
                                <li><a href="#" data-filter="<?php echo "." . esc_attr($cat->slug); ?>"><?php echo esc_html($cat->name); ?></a></li>
                            <?php
                        }
                    ?>
                </ul>
            </div>   
            <?php endif;?>
            <div class="<?php echo esc_attr($class_row); ?> <?php echo esc_attr($settings['blog_display']);?>">
               <?php if($settings['blog_display'] == 'slider') echo '<div class="swiper-wrapper">';?>
               
                <?php 
            
                    if($settings['post_archive'] == 'yes') {
                       if (have_posts()) {
                            while ( have_posts() ) :
                        			the_post();
                                  
                                  $format = has_post_format() ? get_post_format() : 'no_format'; 
                                      if($format == 'audio'){
                                        wp_enqueue_script('media-element'); 
                                        wp_enqueue_style('mediaelementplayer');
                                      }
                                        echo '<div class="'.$class_column.' '.$format.'">';
                         
                                               include( 'layout/'.$settings['blog_layouts'].'.php' );
                
            
                                        echo '</div>';
                            endwhile;    
                            wp_reset_postdata();      
                       }else{
                            get_template_part( 'template-parts/content/content', 'none' );
                       }
                    }elseif($settings['post_related'] == 'yes'){

                        $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 100,'post_type' => 'post', 'post__not_in' => array($post->ID) ) );
                          
                        if( isset($related[0]) ) foreach( $related as $post ) {
                        setup_postdata($post); 
                        
                          $format = has_post_format() ? get_post_format() : 'no_format'; 
                          if($format == 'audio'){
                            wp_enqueue_script('media-element'); 
                            wp_enqueue_style('mediaelementplayer');
                          }
                            echo '<div class="'.$class_column.' '.$format.'">';
                                               include( 'layout/'.$settings['blog_layouts'].'.php' );
                            echo '</div>';      
                        
                        }
                        wp_reset_postdata();     
                    }else {
                     $i = 1; if ($blog->have_posts()) :
    
                            while ( $blog->have_posts() ) :
                        			$blog->the_post();
                                    $class_slug = '';
                                    if($settings['post_nav_on'] == 'yes') {
                                        $item_cats = get_the_terms(get_the_ID(), 'category');
                                        if ($item_cats):
                                            foreach ($item_cats as $item_cat) {
                                                $class_slug .= ' '.$item_cat->slug;
                                            }
                                        endif;    
                                    }
                                        $format = has_post_format() ? get_post_format() : 'no_format'; 
                                          if($format == 'audio'){
                                            wp_enqueue_script('media-element'); 
                                            wp_enqueue_style('mediaelementplayer');
                                          }                               
                                      echo '<div class="'.$class_column.' '.$format.$class_slug.'">';
                                               include( 'layout/'.$settings['blog_layouts'].'.php' );
                                      echo '</div>';  
                                           
                             if ($i == 3) {
                                  $i = 1;
                             } else {
                                  $i++;
                             } endwhile;    
                            wp_reset_postdata();
                           
                       endif;  
                    }
                
                ?>
                <?php if($settings['blog_display'] == 'slider') echo '</div>';?>
                 <?php if($show_arrows && $settings['blog_display'] == 'slider') : ?>
                    <button class="elementor-swiper-button elementor-swiper-button-prev">
                     <?php $this->render_swiper_button( $settings, 'prev' ); ?>
                    </button>
                    <button class="elementor-swiper-button elementor-swiper-button-next">
                     <?php $this->render_swiper_button( $settings, 'next' ); ?>
                    </button>
                <?php endif; ?>
                <?php  if($show_dots && $settings['blog_display'] == 'slider') echo '<div class="swiper-pagination"></div>';?>
   
                
            </div>
            
             <?php 
   
                global $wp_query;
                if($settings['post_archive'] == 'yes') { 
                   $number_page = $wp_query->max_num_pages;
                   $pagi_number = jws_query_pagination($wp_query);
                   
                }else {
                   $number_page = $blog->max_num_pages;
                   $pagi_number = jws_query_pagination($blog);
                   
                }
 
           ?>
            <?php if ( $number_page > 1 && $settings['pagination_type'] == 'load_more' ) {
                 wp_enqueue_script( 'masonry');
                  wp_enqueue_script( 'imageload'); 
                 $load_attr = 'data-ajaxify-options=\'{"wrapper":".blog_ajax_'.$this->get_id().'","items":"> .jws_blog_item","trigger":"click"}\''; 
                  $paged = $blog->get('paged') ? $blog->get('paged') : 1;
                $url = get_pagenum_link($paged + 1);
                ?>
                <div class="jws_pagination jws_ajax">
                 <?php if(get_next_posts_page_link($number_page)): ?>
                    <a class="jws-load-more" data-ajaxify="true"  href="<?php echo add_query_arg( 'ajaxify', '1', $url); ?>" <?php echo wp_kses_post($load_attr); ?>>
                        <span class="has-loading"><?php echo esc_html($settings['pagination_loadmore_label']); ?> </span>
                       
                </a>
                <?php endif;?>
                </div>
            <?php }elseif($number_page > 1 && $settings['pagination_type'] == 'pagination-number'){
                      echo ''.$pagi_number;   
                  }  
            ?>
        </div>

	<?php }
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