<?php
/**
 * jws Table.
 *
 * @package jws
 */

namespace Elementor;


// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Table.
 */
class Jws_Table extends Widget_Base {

	/**
	 * Retrieve Table Widget name.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jws_table';
	}

	/**
	 * Retrieve Table Widget title.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Jws Table', 'freeagent' );
	}

	/**
	 * Retrieve Table Widget icon.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-table';
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
	 * Retrieve the list of scripts the image carousel widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'jquery-datatables'];
	}

	/**
	 * Register General Content controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_controls() {

		$this->register_header_content_controls();
		$this->register_body_content_controls();
		$this->register_adv_content_controls();

		$this->register_header_style_controls();
		$this->register_body_style_controls();
		$this->register_icon_image_controls();
		$this->register_search_controls();

	}

	/**
	 * Registers all controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_header_content_controls() {

		$condition = array();

		// Table header settings.
		$this->start_controls_section(
			'section_table_header',
			[
				'label' => esc_html__( 'Table Header', 'freeagent' ),
			]
		);

			$this->add_control(
				'source',
				[
					'label'   => esc_html__( 'Source', 'freeagent' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'manual',
					'options' => [
						'manual' => esc_html__( 'Manual', 'freeagent' ),
						'file'   => esc_html__( 'CSV File', 'freeagent' ),
					],
				]
			);

			$this->add_control(
				'file',
				[
					'label'     => esc_html__( 'Upload a CSV File', 'freeagent' ),
					'type'      => Controls_Manager::MEDIA,
					'dynamic'   => [
						'active' => true,
					],
					'condition' => [
						'source' => 'file',
					],
				]
			);

			// Repeater object created.
			$repeater = new Repeater();

			// Content Type Row/Col.
			$repeater->add_control(
				'header_content_type',
				[
					'label'   => esc_html__( 'Action', 'freeagent' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'cell',
					'options' => [
						'row'  => esc_html__( 'Start New Row', 'freeagent' ),
						'cell' => esc_html__( 'Add New Cell', 'freeagent' ),
					],
				]
			);

			// Table heading border Row/Cell Note.
			$repeater->add_control(
				'add_head_cell_row_description',
				[
					'label'     => '',
					'type'      => Controls_Manager::TEXT,
					'dynamic'   => [
						'active' => true,
					],
					'type'      => Controls_Manager::RAW_HTML,
					'raw'       => sprintf( '<p style="font-size: 12px;font-style: italic;line-height: 1.4;color: #a4afb7;">%s</p>', esc_html__( 'You have started a new row. Please add new cells in your row by clicking <b>Add Item</b> button below.', 'freeagent' ) ),
					'condition' => [
						'header_content_type' => 'row',
					],
				]
			);

			// Start control tab.
			$repeater->start_controls_tabs( 'items_repeater' );

				// Start control content tab.
				$repeater->start_controls_tab(
					'tab_head_content',
					[
						'label'     => esc_html__( 'CONTENT', 'freeagent' ),
						'condition' => [
							'header_content_type' => 'cell',
						],
					]
				);

						// table heading text.
						$repeater->add_control(
							'heading_text',
							[
								'label'     => esc_html__( 'Text', 'freeagent' ),
								'type'      => Controls_Manager::TEXT,
								'dynamic'   => [
									'active' => true,
								],
								'condition' => [
									'header_content_type' => 'cell',
								],
							]
						);

				$repeater->end_controls_tab();

				// Start control content tab.
				$repeater->start_controls_tab(
					'tab_head_icon',
					[
						'label'     => esc_html__( 'ICON / IMAGE', 'freeagent' ),
						'condition' => [
							'header_content_type' => 'cell',
						],
					]
				);

					// Content Type Icon/Image.
					$repeater->add_control(
						'header_content_icon_image',
						[
							'label'   => esc_html__( 'Select', 'freeagent' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'icon',
							'options' => [
								'icon'  => esc_html__( 'Icon', 'freeagent' ),
								'image' => esc_html__( 'Image', 'freeagent' ),
							],
						]
					);


			// Single select icon.
			$repeater->add_control(
				'new_heading_icon',
				[
					'label'            => esc_html__( 'Icon', 'freeagent' ),
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'heading_icon',
					'condition'        => [
						'header_content_type'       => 'cell',
						'header_content_icon_image' => 'icon',
					],
					'render_type'      => 'template',
				]
			);


					// Single Add Image.
					$repeater->add_control(
						'head_image',
						[
							'label'     => esc_html__( 'Choose Image', 'freeagent' ),
							'type'      => Controls_Manager::MEDIA,
							'dynamic'   => [
								'active' => true,
							],
							'condition' => [
								'header_content_type' => 'cell',
								'header_content_icon_image' => 'image',
							],
						]
					);

					$repeater->end_controls_tab();

					// Start control content tab.
					$repeater->start_controls_tab(
						'tab_head_advance',
						[
							'label'     => esc_html__( 'ADVANCE', 'freeagent' ),
							'condition' => [
								'header_content_type' => 'cell',
							],
						]
					);

					// Table header column span.
					$repeater->add_control(
						'heading_col_span',
						[
							'label'     => esc_html__( 'Column Span', 'freeagent' ),
							'title'     => esc_html__( 'How many columns should this column span across.', 'freeagent' ),
							'type'      => Controls_Manager::NUMBER,
							'default'   => 1,
							'min'       => 1,
							'max'       => 20,
							'step'      => 1,
							'condition' => [
								'header_content_type' => 'cell',
							],
						]
					);

					// Cell row Span.
					$repeater->add_control(
						'heading_row_span',
						[
							'label'     => esc_html__( 'Row Span', 'freeagent' ),
							'title'     => esc_html__( 'How many rows should this column span across.', 'freeagent' ),
							'type'      => Controls_Manager::NUMBER,
							'default'   => 1,
							'min'       => 1,
							'max'       => 20,
							'step'      => 1,
							'separator' => 'below',
							'condition' => [
								'header_content_type' => 'cell',
							],
						]
					);

					// Cell row Span.
					$repeater->add_control(
						'heading_row_width',
						[
							'label'      => esc_html__( 'Column Width', 'freeagent' ),
							'type'       => Controls_Manager::SLIDER,
							'range'      => [
								'px' => [
									'min' => 0,
									'max' => 500,
								],
								'%'  => [
									'min' => 0,
									'max' => 100,
								],
							],
							'size_units' => [ 'px', '%' ],
							'separator'  => 'below',
							'selectors'  => [
								'{{WRAPPER}} {{CURRENT_ITEM}}.jws-table-col' => 'width: {{SIZE}}{{UNIT}}',
							],
							'condition'  => [
								'header_content_type' => 'cell',
							],
						]
					);

					// Single Header Text Color.
					$repeater->add_control(
						'single_heading_color',
						[
							'label'     => esc_html__( 'Color', 'freeagent' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .jws-table-row {{CURRENT_ITEM}} .jws-table__text' => 'color: {{VALUE}};',
								'{{WRAPPER}} .jws-table-row {{CURRENT_ITEM}} .jws-table__text svg' => 'fill: {{VALUE}};',
							],
							'condition' => [
								'header_content_type' => 'cell',
							],
						]
					);

					// Single Header Background Color.
					$repeater->add_control(
						'single_heading_background_color',
						[
							'label'     => esc_html__( 'Background Color', 'freeagent' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} thead .jws-table-row {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
							],
							'condition' => [
								'header_content_type' => 'cell',
							],
						]
					);

				$repeater->end_controls_tab();

			$repeater->end_controls_tab();

			// Repeater set default values.
			$this->add_control(
				'table_headings',
				[
					'type'        => Controls_Manager::REPEATER,
					'show_label'  => true,
					'fields'      => array_values( $repeater->get_controls() ),
					'title_field' => '{{ header_content_type }}: {{{ heading_text }}}',
					'default'     => [
						[
							'header_content_type' => 'row',
						],
						[
							'header_content_type' => 'cell',
							'heading_text'        => esc_html__( 'Sample ID', 'freeagent' ),
						],
						[
							'header_content_type' => 'cell',
							'heading_text'        => esc_html__( 'Heading 1', 'freeagent' ),
						],
						[
							'header_content_type' => 'cell',
							'heading_text'        => esc_html__( 'Heading 2', 'freeagent' ),
						],
					],
					'condition'   => [
						'source' => 'manual',
					],
				]
			);

		$this->end_controls_section();
	}

	/**
	 * Registers all controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_body_content_controls() {

		// Table content.
		$this->start_controls_section(
			'section_table_content',
			[
				'label'     => esc_html__( 'Table Content', 'freeagent' ),
				'condition' => [
					'source' => 'manual',
				],
			]
		);

		// Repeater obj for content.
		$repeater_content = new Repeater();

		// Content Type Row/Col.
		$repeater_content->add_control(
			'content_type',
			[
				'label'   => esc_html__( 'Action', 'freeagent' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cell',
				'options' => [
					'row'  => esc_html__( 'Start New Row', 'freeagent' ),
					'cell' => esc_html__( 'Add New Cell', 'freeagent' ),
				],
			]
		);

		// Table heading border Row/Cell Note.
		$repeater_content->add_control(
			'add_body_cell_row_description',
			[
				'type'      => Controls_Manager::RAW_HTML,
				'raw'       => sprintf( '<p style="font-size: 12px;font-style: italic;line-height: 1.4;color: #a4afb7;">%s</p>', esc_html__( 'You have started a new row. Please add new cells in your row by clicking <b>Add Item</b> button below.', 'freeagent' ) ),
				'condition' => [
					'content_type' => 'row',
				],
			]
		);

		// Start control tab.
		$repeater_content->start_controls_tabs( 'items_repeater' );

			// Start control content tab.
			$repeater_content->start_controls_tab(
				'tab_content',
				[
					'label'     => esc_html__( 'Content', 'freeagent' ),
					'condition' => [
						'content_type' => 'cell',
					],
				]
			);

				// Single Cell text.
				$repeater_content->add_control(
					'cell_text',
					[
						'label'     => esc_html__( 'Text', 'freeagent' ),
						'type'      => Controls_Manager::TEXTAREA,
						'dynamic'   => [
							'active' => true,
						],
						'condition' => [
							'content_type' => 'cell',
						],
					]
				);

				$repeater_content->add_control(
					'tooltip',
					[
						'label'       => esc_html__( 'Tooltip', 'freeagent' ),
						'type'        => Controls_Manager::TEXT,
					'condition' => [
							'content_type' => 'cell',
						],
					]
				);
                
				$repeater_content->add_control(
					'btn_text2',
					[
					'label'       => esc_html__( 'Text Button', 'freeagent' ),
					'type'        => Controls_Manager::TEXT,
					'dynamic'     => [
						'active' => true,
					],
					'condition' => [
							'content_type' => 'cell',
						],
					]
				);


				// Single Cell LINK.
				$repeater_content->add_control(
					'link',
					[
						'label'       => esc_html__( 'Link', 'freeagent' ),
						'type'        => Controls_Manager::URL,
						'placeholder' => '#',
						'dynamic'     => [
							'active' => true,
						],
						'default'     => [
							'url' => '',
						],
						'condition'   => [
							'content_type' => 'cell',
						],
					]
				);

			// End Content control tab.
			$repeater_content->end_controls_tab();

			// Start Media Tab.
			$repeater_content->start_controls_tab(
				'tab_media',
				[
					'label'     => esc_html__( 'ICON / IMAGE', 'freeagent' ),
					'condition' => [
						'content_type' => 'cell',
					],
				]
			);

				// Content Type Icon/Image.
				$repeater_content->add_control(
					'cell_content_icon_image',
					[
						'label'   => esc_html__( 'Select', 'freeagent' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 'icon',
						'options' => [
							'icon'  => esc_html__( 'Icon', 'freeagent' ),
							'image' => esc_html__( 'Image', 'freeagent' ),
						],
					]
				);

			// Single Cell Icon.
			$repeater_content->add_control(
				'new_cell_icon',
				[
					'label'            => esc_html__( 'Icon', 'freeagent' ),
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'cell_icon',
					'condition'        => [
						'content_type'            => 'cell',
						'cell_content_icon_image' => 'icon',
					],
					'render_type'      => 'template',
				]
			);

				// Single Add Image.
				$repeater_content->add_control(
					'image',
					[
						'label'     => esc_html__( 'Choose Image', 'freeagent' ),
						'type'      => Controls_Manager::MEDIA,
						'dynamic'   => [
							'active' => true,
						],
						'condition' => [
							'content_type'            => 'cell',
							'cell_content_icon_image' => 'image',
						],
					]
				);

			// End Media control tab.
			$repeater_content->end_controls_tab();

			// Start Media Tab.
			$repeater_content->start_controls_tab(
				'tab_advance_cells',
				[
					'label'     => esc_html__( 'Advance', 'freeagent' ),
					'condition' => [
						'content_type' => 'cell',
					],
				]
			);

			// Cell Column Span.
			$repeater_content->add_control(
				'cell_span',
				[
					'label'     => esc_html__( 'Column Span', 'freeagent' ),
					'title'     => esc_html__( 'How many columns should this column span across.', 'freeagent' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 1,
					'min'       => 1,
					'max'       => 20,
					'step'      => 1,
					'condition' => [
						'content_type' => 'cell',
					],
				]
			);

			// Cell row Span.
			$repeater_content->add_control(
				'cell_row_span',
				[
					'label'     => esc_html__( 'Row Span', 'freeagent' ),
					'title'     => esc_html__( 'How many rows should this column span across.', 'freeagent' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 1,
					'min'       => 1,
					'max'       => 20,
					'step'      => 1,
					'separator' => 'below',
					'condition' => [
						'content_type' => 'cell',
					],
				]
			);

			// Cell Column Span.
			$repeater_content->add_control(
				'table_th_td',
				[
					'label'       => esc_html__( 'Convert this Cell into Table Heading?', 'freeagent' ),
					'type'        => Controls_Manager::SELECT,
					'options'     => [
						'td' => esc_html__( 'No', 'freeagent' ),
						'th' => esc_html__( 'Yes', 'freeagent' ),
					],
					'default'     => 'td',
					'condition'   => [
						'content_type' => 'cell',
					],
					'label_block' => true,
				]
			);

			// End Media control tab.
			$repeater_content->end_controls_tab();

		// End control tab.
		$repeater_content->end_controls_tabs();

		// Repeater set default values.
		$this->add_control(
			'table_content',
			[
				'type'        => Controls_Manager::REPEATER,
				'default'     => [
					[
						'content_type' => 'row',
					],
					[
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Sample #1', 'freeagent' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 1, Content 1', 'freeagent' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 1, Content 2', 'freeagent' ),
					],
					[
						'content_type' => 'row',
					],
					[
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Sample #2', 'freeagent' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 2, Content 1', 'freeagent' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 2, Content 2', 'freeagent' ),
					],
					[
						'content_type' => 'row',
					],
					[
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Sample #3', 'freeagent' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 3, Content 1', 'freeagent' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 3, Content 2', 'freeagent' ),
					],
				],
				'fields'      => array_values( $repeater_content->get_controls() ),
				'title_field' => '{{ content_type }}: {{{ cell_text }}}',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Registers all controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_adv_content_controls() {

		// Column style starts.
		$this->start_controls_section(
			'section_advance_settings',
			[
				'label' => esc_html__( 'Advance Settings', 'freeagent' ),
			]
		);

			// Sortable Table Switcher.
			$this->add_control(
				'sortable',
				[
					'label'        => esc_html__( 'Sortable Table', 'freeagent' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'YES', 'freeagent' ),
					'label_off'    => esc_html__( 'NO', 'freeagent' ),
					'description'  => esc_html__( 'Sort table entries on the click of table headings.', 'freeagent' ),
					'return_value' => 'yes',
					'default'      => 'no',
				]
			);

			// Searchable Table Switcher.
			$this->add_control(
				'searchable',
				[
					'label'        => esc_html__( 'Searchable Table', 'freeagent' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'freeagent' ),
					'label_off'    => esc_html__( 'No', 'freeagent' ),
					'description'  => esc_html__( 'Search/filter table entries easily.', 'freeagent' ),
					'return_value' => 'yes',
					'default'      => 'no',
				]
			);

			$this->add_control(
				'show_entries',
				[
					'label'        => esc_html__( 'Show Entries Dropdown', 'freeagent' ),
					'description'  => esc_html__( 'Controls the number of entries in a table.', 'freeagent' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'freeagent' ),
					'label_off'    => esc_html__( 'No', 'freeagent' ),
					'return_value' => 'yes',
					'default'      => 'no',
				]
			);

		$this->end_controls_section();
	}

	/**
	 * Registers all controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_header_style_controls() {

		// Header heading style.
		$this->start_controls_section(
			'section_header_style',
			[
				'label' => esc_html__( 'Table Header', 'freeagent' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Header typography.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'header_typography',
				'label'    => esc_html__( 'Typography', 'freeagent' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} th.jws-table-col',
                'frontend_available' => true,
			]
		);

		// Header padding.
		$this->add_responsive_control(
			'cell_padding_head',
			[
				'label'      => esc_html__( 'Padding', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'      => '15',
					'bottom'   => '15',
					'left'     => '15',
					'right'    => '15',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} th.jws-table-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'frontend_available' => true,
			]
		);
        // Header text first alignment.
		$this->add_responsive_control(
			'cell_first_align_head',
			[
				'label'     => esc_html__( 'Text First Alignment', 'freeagent' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} th.jws-table-col:first-child ' => 'text-align: {{VALUE}};',
				],
                'frontend_available' => true,
			]
		);

		// Header text alignment.
		$this->add_responsive_control(
			'cell_align_head',
			[
				'label'     => esc_html__( 'Text Alignment', 'freeagent' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} th.jws-table-col' => 'text-align: {{VALUE}};width: 100%;',
				],
                'frontend_available' => true,
			]
		);

		// Header tabs starts here.
		$this->start_controls_tabs( 'tabs_header_colors_row' );

			// Header Default tab starts.
			$this->start_controls_tab( 'tab_header_colors_row', [ 'label' => esc_html__( 'Default', 'freeagent' ) ] );

				// Header row color default.
				$this->add_control(
					'header_cell_color_row',
					[
						'label'     => esc_html__( 'Row Text Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'scheme'    => [
							'type'  => Color::get_type(),
							'value' => Color::COLOR_3,
						],
						'selectors' => [
							'{{WRAPPER}} thead .jws-table-row th .jws-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} thead .jws-table-row th .jws-table__text svg' => 'fill: {{VALUE}};',
							'{{WRAPPER}} th' => 'color: {{VALUE}};',
							'{{WRAPPER}} tbody .jws-table-row th' => 'color: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

				// Header row background color default.
				$this->add_control(
					'header_cell_background_row',
					[
						'label'     => esc_html__( 'Row Background Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} thead .jws-table-row th' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} tbody .jws-table-row th' => 'background-color: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

				// Advanced Setting for header Switcher.
				$this->add_control(
					'header_border_styling',
					[
						'label'        => esc_html__( 'Apply Border To', 'freeagent' ),
						'type'         => Controls_Manager::SWITCHER,
						'label_on'     => esc_html__( 'CELL', 'freeagent' ),
						'label_off'    => esc_html__( 'ROW', 'freeagent' ),
						'return_value' => 'yes',
						'default'      => 'yes',
						'prefix_class' => 'jws-border-',
                        'frontend_available' => true,
					]
				);

				// Table heading border Row/Cell Note.
				$this->add_control(
					'head_border_note',
					[
						'type' => Controls_Manager::RAW_HTML,
						'raw'  => sprintf( '<p style="font-size: 12px;font-style: italic;line-height: 1.4;color: #a4afb7;">%s</p>', esc_html__( 'Note: By default, the border will be applied to cells. You can change it to row by using the above setting.', 'freeagent' ) ),
					]
				);

				// Header row border.
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'           => 'row_border_head',
						'label'          => esc_html__( 'Row Border', 'freeagent' ),
						'fields_options' => [
							'border' => [
								'default' => 'solid',
							],
							'width'  => [
								'default' => [
									'top'      => '1',
									'right'    => '1',
									'bottom'   => '1',
									'left'     => '1',
									'isLinked' => true,
								],
							],
							'color'  => [
								'default' => '#bbb',
							],
						],
						'selector'       => '{{WRAPPER}} thead tr.jws-table-row, {{WRAPPER}} tbody .jws-table-row th',
						'condition'      => [
							'header_border_styling!' => 'yes',
						],
                        'frontend_available' => true,
					]
				);

				// Header Cell border.
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'           => 'cell_border_head',
						'label'          => esc_html__( 'Cell Border', 'freeagent' ),
						'selector'       => '{{WRAPPER}} th.jws-table-col',
						'fields_options' => [
							'border' => [
								'default' => 'solid',
							],
							'width'  => [
								'default' => [
									'top'      => '1',
									'right'    => '1',
									'bottom'   => '1',
									'left'     => '1',
									'isLinked' => true,
								],
							],
							'color'  => [
								'default' => '#bbb',
							],
						],
						'condition'      => [
							'header_border_styling' => 'yes',
						],
                        'frontend_available' => true,
					]
				);

			$this->end_controls_tab();

			// Tab header hover.
			$this->start_controls_tab( 'tab_header_hover_colors_row', [ 'label' => esc_html__( 'Hover', 'freeagent' ) ] );

				// Header text row color hover.
				$this->add_control(
					'header_cell_hover_color_row',
					[
						'label'     => esc_html__( 'Row Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} thead .jws-table-row:hover .jws-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} thead .jws-table-row:hover .jws-table__text svg' => 'fill: {{VALUE}};',
							'{{WRAPPER}} tbody .jws-table-row:hover th .jws-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} tbody .jws-table-row:hover th .jws-table__text svg' => 'fill: {{VALUE}};',
							'{{WRAPPER}} .jws-table-row:hover th' => 'color: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

				// Header row background color hover.
				$this->add_control(
					'header_cell_hover_background_row',
					[
						'label'     => esc_html__( 'Row Background Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} thead .jws-table-row:hover > th' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} .jws-table tbody .jws-table-row:hover > th' => 'background-color: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

				// Header cell hover text color.
				$this->add_control(
					'header_cell_hover_color',
					[
						'label'     => esc_html__( 'Cell Hover Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} thead th.jws-table-col:hover .jws-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} tbody .jws-table-row th.jws-table-col:hover .jws-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} tr.jws-table-row th.jws-table-col:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} thead th.jws-table-col:hover .jws-table__text svg' => 'fill: {{VALUE}};',
							'{{WRAPPER}} tbody .jws-table-row th.jws-table-col:hover .jws-table__text svg' => 'fill: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

				// Header cell hover background color.
				$this->add_control(
					'header_cell_hover_background',
					[
						'label'     => esc_html__( 'Cell Hover Background Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} thead .jws-table-row th.jws-table-col:hover' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} .jws-table tbody .jws-table-row:hover >  th.jws-table-col:hover' => 'background-color: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Registers all controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_body_style_controls() {

		// Rows style tab heading.
		$this->start_controls_section(
			'section_table_body_style',
			[
				'label' => esc_html__( 'Table Body', 'freeagent' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Cell Typograghy.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cell_typography',
				'label'    => esc_html__( 'Typography', 'freeagent' ),
				'scheme'   => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} td .jws-table__text-inner,{{WRAPPER}} td .jws-align-icon--left,{{WRAPPER}} td .jws-align-icon--right',
			'frontend_available' => true,
            ]
		);

		// Cell padding.
		$this->add_responsive_control(
			'cell_padding',
			[
				'label'      => esc_html__( 'Padding', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'      => '15',
					'bottom'   => '15',
					'left'     => '15',
					'right'    => '15',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} td.jws-table-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'frontend_available' => true,
			]
		);
        // Cell text alignment.
		$this->add_responsive_control(
			'cell_first_align',
			[
				'label'     => esc_html__( 'Text First Alignment', 'freeagent' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} td:first-child .jws-table__text' => 'text-align: {{VALUE}};',
				],
                'frontend_available' => true,
			]
		);
        		$this->add_responsive_control(
			'width_column_first',
			[
				'label'     => esc_html__( 'Width First Alignment', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-table-row .jws-table-col:first-child' => 'width: {{SIZE}}%;',
				],
			]
		);
		// Cell text alignment.
		$this->add_responsive_control(
			'cell_align',
			[
				'label'     => esc_html__( 'Text Alignment', 'freeagent' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} td .jws-table__text' => 'text-align: {{VALUE}};    width: 100%;',
				],
                'frontend_available' => true,
			]
		);

		// Cell text alignment.
		$this->add_responsive_control(
			'cell_valign',
			[
				'label'     => esc_html__( 'Vertical Alignment', 'freeagent' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'middle',
				'options'   => [
					'top'    => [
						'title' => esc_html__( 'Top', 'freeagent' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'freeagent' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'freeagent' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-table-row .jws-table-col' => 'vertical-align: {{VALUE}};',
				],
                'frontend_available' => true,
			]
		);

		// Tab control starts.
		$this->start_controls_tabs( 'tabs_cell_colors' );

			// Tab Default starts.
			$this->start_controls_tab( 'tab_cell_colors', [ 'label' => esc_html__( 'Default', 'freeagent' ) ] );

				// Cell Color Default.
				$this->add_control(
					'cell_color',
					[
						'label'     => esc_html__( 'Row Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'scheme'    => [
							'type'  => Color::get_type(),
							'value' => Color::COLOR_3,
						],
						'selectors' => [
							'{{WRAPPER}} tbody td.jws-table-col .jws-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} tbody td.jws-table-col .jws-table__text svg' => 'fill: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

				$this->add_control(
					'striped_effect_feature',
					[
						'label'        => esc_html__( 'Striped Effect', 'freeagent' ),
						'type'         => Controls_Manager::SWITCHER,
						'label_on'     => esc_html__( 'YES', 'freeagent' ),
						'label_off'    => esc_html__( 'NO', 'freeagent' ),
						'return_value' => 'yes',
						'default'      => 'yes',
                        'frontend_available' => true,
					]
				);

				// Striped effect (Odd Rows).
				$this->add_control(
					'striped_effect_odd',
					[
						'label'     => esc_html__( 'Striped Odd Rows Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#eaeaea',
						'selectors' => [
							'{{WRAPPER}} tbody tr:nth-child(odd)' => 'background: {{VALUE}};',
						],
						'condition' => [
							'striped_effect_feature' => 'yes',
						],
                        'frontend_available' => true,
					]
				);

				// Striped effect (Even Rows).
				$this->add_control(
					'striped_effect_even',
					[
						'label'     => esc_html__( 'Striped Even Rows Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#FFFFFF',
						'selectors' => [
							'{{WRAPPER}} tbody tr:nth-child(even)' => 'background: {{VALUE}};',
						],
						'condition' => [
							'striped_effect_feature' => 'yes',
						],
                        'frontend_available' => true,
					]
				);
			// Cell padding.
			$this->add_responsive_control(
				'row_boder_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'freeagent' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors'  => [
					   '{{WRAPPER}} tbody tr.jws-table-row' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
				// Cell background color default.
				$this->add_control(
					'cell_background',
					[
						'label'     => esc_html__( 'Row Background Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} tbody .jws-table-row' => 'background-color: {{VALUE}};',
						],
						'condition' => [
							'striped_effect_feature!' => 'yes',
						],
                        'frontend_available' => true,
					]
				);

				// Advanced Setting for header Switcher.
				$this->add_control(
					'body_border_styling',
					[
						'label'        => esc_html__( 'Apply Border To', 'freeagent' ),
						'type'         => Controls_Manager::SWITCHER,
						'label_on'     => esc_html__( 'CELL', 'freeagent' ),
						'label_off'    => esc_html__( 'ROW', 'freeagent' ),
						'return_value' => 'yes',
						'default'      => 'yes',
                        'frontend_available' => true,
					]
				);

				// Table body border Row/Cell Note.
				$this->add_control(
					'body_border_note',
					[
						'type' => Controls_Manager::RAW_HTML,
						'raw'  => sprintf( '<p style="font-size: 12px;font-style: italic;line-height: 1.4;color: #a4afb7;">%s</p>', esc_html__( 'Note: By default, the border will be applied to cells. You can change it to row by using the above setting.', 'freeagent' ) ),
					]
				);

				// Body Row border.
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'           => 'row_border',
						'label'          => esc_html__( 'Border', 'freeagent' ),
						'selector'       => '{{WRAPPER}} tbody .jws-table-row',
						'fields_options' => [
							'border' => [
								'default' => 'solid',
							],
							'width'  => [
								'default' => [
									'top'      => '1',
									'right'    => '1',
									'bottom'   => '1',
									'left'     => '1',
									'isLinked' => true,
								],
							],
							'color'  => [
								'default' => '#bbb',
							],
						],
						'condition'      => [
							'body_border_styling!' => 'yes',
						],
                        'frontend_available' => true,
					]
				);

				// Body Cell border.
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'           => 'cell_border_body',
						'label'          => esc_html__( 'Cell Border', 'freeagent' ),
						'selector'       => '{{WRAPPER}} td.jws-table-col',
						'fields_options' => [
							'border' => [
								'default' => 'solid',
							],
							'width'  => [
								'default' => [
									'top'      => '1',
									'right'    => '1',
									'bottom'   => '1',
									'left'     => '1',
									'isLinked' => true,
								],
							],
							'color'  => [
								'default' => '#bbb',
							],
						],
						'condition'      => [
							'body_border_styling' => 'yes',
						],
                        'frontend_available' => true,
					]
				);

			// Default tab ends here.
			$this->end_controls_tab();

			// Hover tab starts here.
			$this->start_controls_tab( 'tab_cell_hover_colors', [ 'label' => esc_html__( 'Hover', 'freeagent' ) ] );

				// Row hover text color.
				$this->add_control(
					'row_hover_color',
					[
						'label'     => esc_html__( 'Row Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} tbody .jws-table-row:hover td.jws-table-col .jws-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} tbody .jws-table-row:hover td.jws-table-col .jws-table__text svg' => 'fill: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

				// Row hover background color.
				$this->add_control(
					'row_hover_background',
					[
						'label'     => esc_html__( 'Row Background Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} tbody .jws-table-row:hover' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} tbody .jws-table-row:hover > .jws-table-col:hover' => 'background-color: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

				// Cell color hover.
				$this->add_control(
					'cell_hover_color',
					[
						'label'     => esc_html__( 'Cell Hover Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws-table tbody td.jws-table-col:hover .jws-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} .jws-table tbody td.jws-table-col:hover .jws-table__text svg' => 'fill: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

				// Cell background color hover.
				$this->add_control(
					'cell_hover_background',
					[
						'label'     => esc_html__( 'Cell Hover Background Color', 'freeagent' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws-table tbody .jws-table-row:hover > td.jws-table-col:hover' => 'background-color: {{VALUE}};',
						],
                        'frontend_available' => true,
					]
				);

		// Tab control ends.
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Registers all controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_icon_image_controls() {

		// Icon/Image Styling.
		$this->start_controls_section(
			'section_icon_image_style',
			[
				'label'     => esc_html__( 'Icon / Image', 'freeagent' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'source' => 'manual',
				],
			]
		);

		// Icon - styling heading.
		$this->add_control(
			'icon_styling_heading',
			[
				'label' => esc_html__( 'Icon', 'freeagent' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		// All icon color.
		$this->add_control(
			'all_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-align-icon--left i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jws-align-icon--right i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jws-align-icon--left svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .jws-align-icon--right svg' => 'fill: {{VALUE}};',
				],
			]
		);

		// All icon size.
		$this->add_responsive_control(
			'all_icon_size',
			[
				'label'     => esc_html__( 'Scale', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 30,
				],
				'range'     => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					// Item.
					'{{WRAPPER}} .jws-align-icon--left i' => 'font-size: {{SIZE}}px; vertical-align: middle;',
					'{{WRAPPER}} .jws-align-icon--right i' => 'font-size: {{SIZE}}px; vertical-align: middle;',
					'{{WRAPPER}} .jws-align-icon--left svg' => 'height: {{SIZE}}px; width: {{SIZE}}px; vertical-align: middle;',
					'{{WRAPPER}} .jws-align-icon--right svg' => 'height: {{SIZE}}px; width: {{SIZE}}px; vertical-align: middle;',
				],
			]
		);

		// All Icon Position.
		$this->add_control(
			'all_icon_align',
			[
				'label'   => esc_html__( 'Icon Position', 'freeagent' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__( 'Before', 'freeagent' ),
					'right' => esc_html__( 'After', 'freeagent' ),
				],
			]
		);

		// All Icon Spacing.
		$this->add_responsive_control(
			'all_icon_indent',
			[
				'label'     => esc_html__( 'Icon Spacing', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 10,
				],
				'range'     => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					// Item.
					'{{WRAPPER}} .jws-align-icon--left'  => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .jws-align-icon--right' => 'margin-left: {{SIZE}}px;',
				],
			]
		);

		// Image - Styling heading.
		$this->add_control(
			'image_styling_heading',
			[
				'label'     => esc_html__( 'Image', 'freeagent' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// All Image Size.
		$this->add_responsive_control(
			'all_image_size',
			[
				'label'      => esc_html__( 'Scale', 'freeagent' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 30,
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					],
				],
				'selectors'  => [
					// Item.
					'{{WRAPPER}} .jws-col-img--left'  => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jws-col-img--right' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// All Image Position.
		$this->add_control(
			'all_image_align',
			[
				'label'   => esc_html__( 'Image Position', 'freeagent' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__( 'Before', 'freeagent' ),
					'right' => esc_html__( 'After', 'freeagent' ),
				],
			]
		);

		// All Image Size.
		$this->add_responsive_control(
			'all_image_indent',
			[
				'label'     => esc_html__( 'Image Spacing', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 10,
				],
				'range'     => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					// Item.
					'{{WRAPPER}} .jws-col-img--left'  => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .jws-col-img--right' => 'margin-left: {{SIZE}}px;',
				],
			]
		);

		// All image border radius.
		$this->add_responsive_control(
			'all_image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-col-img--left'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .jws-col-img--right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Registers all controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_search_controls() {

		// Icon / Image Styling.
		$this->start_controls_section(
			'section_search_style',
			[
				'label' => esc_html__( 'Search / Show Entries', 'freeagent' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			// All icon color.
			$this->add_control(
				'label_color',
				[
					'label'     => esc_html__( 'Label Color', 'freeagent' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .jws-advance-heading label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'input_color',
				[
					'label'     => esc_html__( 'Input Color', 'freeagent' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .jws-advance-heading select, {{WRAPPER}} .jws-advance-heading input' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'label_bg_color',
				[
					'label'     => esc_html__( 'Input Background Color', 'freeagent' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .jws-advance-heading select, {{WRAPPER}} .jws-advance-heading input' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'           => 'input_border',
					'label'          => esc_html__( 'Input Border', 'freeagent' ),
					'fields_options' => [
						'border' => [
							'default' => 'solid',
						],
						'width'  => [
							'default' => [
								'top'      => '1',
								'right'    => '1',
								'bottom'   => '1',
								'left'     => '1',
								'isLinked' => true,
							],
						],
						'color'  => [
							'default' => '#bbb',
						],
					],
					'selector'       => '{{WRAPPER}} .jws-advance-heading select, {{WRAPPER}} .jws-advance-heading input',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'label_typography',
					'label'    => esc_html__( 'Typography', 'freeagent' ),
					'scheme'   => Typography::TYPOGRAPHY_3,
					'selector' => '{{WRAPPER}} .jws-advance-heading label, {{WRAPPER}} .jws-advance-heading select, {{WRAPPER}} .jws-advance-heading input',
				]
			);

			// Cell padding.
			$this->add_responsive_control(
				'input_padding',
				[
					'label'      => esc_html__( 'Input Padding', 'freeagent' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'default'    => [
						'top'      => '10',
						'bottom'   => '10',
						'left'     => '10',
						'right'    => '10',
						'unit'     => 'px',
						'isLinked' => false,
					],
					'selectors'  => [
						'{{WRAPPER}} .jws-advance-heading select, {{WRAPPER}} .jws-advance-heading input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			// All icon size.
			$this->add_control(
				'input_size',
				[
					'label'     => esc_html__( 'Input Size', 'freeagent' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 200,
					],
					'range'     => [
						'px' => [
							'min'  => 1,
							'max'  => 400,
							'step' => 1,
						],
					],
					'selectors' => [
						// Item.
						'{{WRAPPER}} .jws-advance-heading select, {{WRAPPER}} .jws-advance-heading input' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			// All icon size.
			$this->add_control(
				'bottom_spacing',
				[
					'label'     => esc_html__( 'Bottom Space', 'freeagent' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 15,
						'unit' => 'px',
					],
					'selectors' => [
						// Item.
						'{{WRAPPER}} .jws-advance-heading' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();
	}


	/**
	 * Function to identify if it is a first row or not.
	 *
	 * If yes returns false no returns true.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function is_invalid_first_row() {

		$settings = $this->get_settings_for_display();

		if ( 'row' === $settings['table_content'][0]['content_type'] ) {
			return false;
		}

		return true;
	}

	/**
	 * Function to get table HTML from csv file.
	 *
	 * Parse CSV to Table
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function parse_csv() {

		$settings = $this->get_settings_for_display();
     

   
		if ( 'file' !== $settings['source'] ) {
			return [
				'html' => '',
				'rows' => '',
			];
		}
		$response = wp_remote_get(
			$settings['file']['url'],
			array(
				'sslverify' => false,
			)
		);
          
		if (
			'' === $settings['file']['url'] ||
			is_wp_error( $response ) ||
			200 !== $response['response']['code'] ||
			'.csv' !== substr( $settings['file']['url'], -4 )
		) {
			return [
				'html' => esc_html__( '<p>Please provide a valid CSV file.</p>', 'freeagent' ),
				'rows' => '',
			];
		}

		$rows       = [];
		$rows_count = [];
		$upload_dir = wp_upload_dir();
		$file_url   = str_replace( $upload_dir['baseurl'], '', $settings['file']['url'] );

		$file = $upload_dir['basedir'] . $file_url;
   
		// Attempt to change permissions if not readable.
		if ( ! is_readable( $file ) ) {
			chmod( $file, 0744 );
		}

		// Check if file is writable, then open it in 'read only' mode.
		if ( is_readable( $file ) ) {
            global $wp_filesystem;
			$_file = $wp_filesystem->get_contents( $file, 'r' );

			if ( ! $_file ) {
				return [
					'html' => esc_html__( "File could not be opened. Check the file's permissions to make sure it's readable by your server.", 'freeagent' ),
					'rows' => '',
				];
			}

			// To sum this part up, all it really does is go row by row.
			// Column by column, saving all the data.
			$file_data = array();

			// Get first row in CSV, which is of course the headers.
			$header = fgetcsv( $_file );

			// @codingStandardsIgnoreStart
			while ( $row = fgetcsv( $_file ) ) {

				foreach ( $header as $i => $key ) {
					$file_data[ $key ] = $row[ $i ];
				}

				$data[] = $file_data;
			}
			// @codingStandardsIgnoreEnd

			$wp_filesystem->delete( $_file );
            WP_Filesystem();
		} else {
			return [
				'html' => esc_html__( "File could not be opened. Check the file's permissions to make sure it's readable by your server.", 'freeagent' ),
				'rows' => '',
			];
		}

		if ( is_array( $data ) ) {
			foreach ( $data as $key => $value ) {
				$rows[ $key ]       = $value;
				$rows_count[ $key ] = count( $value );
			}
		}
		$header_val = array_keys( $rows[0] );

		$return['rows'] = $rows_count;

		$heading_count = 0;
        
		ob_start();
		?>
		<table <?php echo wp_kses_post($this->get_render_attribute_string( 'jws_table_id' )); ?>>
			<thead>
				<?php
				$first_row_h    = true;
				$counter_h      = 1;
				$cell_counter_h = 0;
				$inline_count   = 0;
				$header_text    = array();
				$data_entry     = 0;

				if ( $header_val ) {
					?>
					<tr <?php echo wp_kses_post($this->get_render_attribute_string( 'jws_table_row' )); ?>>
					<?php
					foreach ( $header_val as $hkey => $head ) {

						$repeater_heading_text = $this->get_repeater_setting_key( 'heading_text', 'table_headings', $inline_count );
						$this->add_render_attribute( $repeater_heading_text, 'class', 'jws-table__text-inner' );

						// TH.
						if ( true === $first_row_h ) {
							$this->add_render_attribute( 'current_' . $hkey, 'data-sort', $cell_counter_h );
						}
						$this->add_render_attribute( 'current_' . $hkey, 'class', 'sort-this' );
						$this->add_render_attribute( 'current_' . $hkey, 'class', 'elementor-repeater-item-' . $hkey );
						$this->add_render_attribute( 'current_' . $hkey, 'class', 'jws-table-col' );
						// Sort Icon.
						if ( 'yes' === $settings['sortable'] && true === $first_row_h ) {
							$this->add_render_attribute( 'icon_sort_' . $hkey, 'class', 'jws-sort-icon' );
						}

						?>
							<th <?php echo wp_kses_post($this->get_render_attribute_string( 'current_' . $hkey )); ?> scope="col">
								<span class="sort-style">
								<span <?php echo wp_kses_post($this->get_render_attribute_string( 'jws_table__text' )); ?>>

									<span <?php echo wp_kses_post($this->get_render_attribute_string( $repeater_heading_text )); ?>><?php echo wp_kses_post($head); ?></span>
								</span>
								<?php if ( 'yes' === $settings['sortable'] && true === $first_row_h ) { ?>
									<span <?php echo wp_kses_post($this->get_render_attribute_string( 'icon_sort_' . $hkey )); ?>></span>
								<?php } ?>
								</span>
							</th>
							<?php
							$header_text[ $cell_counter_h ] = $head;
							$cell_counter_h++;

							$counter_h++;
							$inline_count++;
					}
					?>
					</tr>
					<?php
				}
				?>
			</thead>
			<tbody>
				<!-- ROWS -->
				<?php
				$counter           = 1;
				$cell_counter      = 0;
				$cell_inline_count = 0;

				foreach ( $rows as $row_key => $row ) {
					?>
				<tr data-entry="<?php echo wp_kses_post($row_key + 1); ?>" <?php echo wp_kses_post($this->get_render_attribute_string( 'jws_table_row' )); ?>>
					<?php
					foreach ( $row as $bkey => $col ) {

						// Cell text inline classes.
						$repeater_cell_text = $this->get_repeater_setting_key( 'cell_text', 'table_content', $cell_inline_count );
						$this->add_render_attribute( $repeater_cell_text, 'class', 'jws-table__text-inner' );

						$this->add_render_attribute( 'jws_table_col' . $bkey, 'class', 'jws-table-col' );
						$this->add_render_attribute( 'jws_table_col' . $bkey, 'class', 'elementor-repeater-item-' . $bkey );

						// Fetch corresponding header cell text.
						if ( isset( $header_text[ $cell_counter ] ) && $header_text[ $cell_counter ] ) {
							$this->add_render_attribute( 'jws_table_col' . $bkey, 'data-title', $header_text[ $cell_counter ] );
						}
						?>
						<td <?php echo wp_kses_post($this->get_render_attribute_string( 'jws_table_col' . $bkey )); ?>>
							<span <?php echo wp_kses_post($this->get_render_attribute_string( 'jws_table__text' )); ?>>

								<span <?php echo wp_kses_post($this->get_render_attribute_string( $repeater_cell_text )); ?>><?php echo wp_kses_post($col); ?></span>
							</span>
						</td>
						<?php
						// Increment to next cell.
						$cell_counter++;

						$counter++;
						$cell_inline_count++;
					}
					?>
				</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php
		$html           = ob_get_clean();
		$return['html'] = $html;
		return $return;
	}

	/**
	 * Display Table Row icons HTML.
	 *
	 * @since 1.16.1
	 * @access public
	 * @param object $row for row settings.
	 */
	public function render_row_icon( $row ) {

			$body_icon_migrated = isset( $row['__fa4_migrated']['new_cell_icon'] );
			$body_icon_is_new   = empty( $row['cell_icon'] );
			?>
			<?php if ( isset( $row['cell_icon'] ) || isset( $row['new_cell_icon'] ) ) { ?>
				<span <?php echo wp_kses_post($this->get_render_attribute_string( 'jws_cell_icon_align' . $row['_id'] ))?> >
				 <span class="tooltip-content tooltip"><?php echo wp_kses_post($row['tooltip']); ?></span>
                	<?php
					if ( $body_icon_migrated || $body_icon_is_new ) {
						\Elementor\Icons_Manager::render_icon( $row['new_cell_icon'] );
					} else {
						?>
						<i class="<?php echo esc_attr($row['cell_icon']); ?>"></i>
					<?php } ?>
				</span>
			<?php } 
	}

	/**
	 * Display Table heading icons HTML.
	 *
	 * @since 1.16.1
	 * @access public
	 * @param object $head for head settings.
	 */
	public function render_heading_icon( $head ) {

			$head_icon_migrated = isset( $head['__fa4_migrated']['new_heading_icon'] );
			$head_icon_is_new   = empty( $head['heading_icon'] );
			?>
			<?php if ( isset( $head['heading_icon'] ) || isset( $head['new_heading_icon'] ) ) { ?>
				<span <?php echo wp_kses_post($this->get_render_attribute_string( 'jws_heading_icon_align' . $head['_id'] )); ?>>

					<?php
					if ( $head_icon_migrated || $head_icon_is_new ) {
						\Elementor\Icons_Manager::render_icon( $head['new_heading_icon'], [ 'aria-hidden' => 'true' ] );
					} else {
						?>
						<i class="<?php echo wp_kses_post($head['heading_icon']); ?>"></i>
					<?php } ?>

				</span>
			<?php } 
	}

	/**
	 * Render Woo Product Grid output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function render() {

		$settings  = $this->get_settings_for_display();
		$node_id   = $this->get_id();
		$is_editor = \Elementor\Plugin::instance()->editor->is_edit_mode();
		ob_start();
		include 'template.php';
		$html = ob_get_clean();
        if(function_exists('output_ech')) {
            echo output_ech($html);
        }
	}

}
