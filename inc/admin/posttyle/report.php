<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function jws_register_report() {

	$labels = array(
		'name'                => _x( 'Report', 'Post Type General Name', 'freeagent' ),
		'singular_name'       => _x( 'Report', 'Post Type Singular Name', 'freeagent' ),
		'menu_name'           => esc_html__( 'Report', 'freeagent' ),
		'parent_item_colon'   => esc_html__( 'Parent Item:', 'freeagent' ),
		'all_items'           => esc_html__( 'Report', 'freeagent' ),
		'view_item'           => esc_html__( 'View Item', 'freeagent' ),
		'add_new_item'        => esc_html__( 'Add New Item', 'freeagent' ),
		'add_new'             => esc_html__( 'Add New', 'freeagent' ),
		'edit_item'           => esc_html__( 'Edit Item', 'freeagent' ),
		'update_item'         => esc_html__( 'Update Item', 'freeagent' ),
		'search_items'        => esc_html__( 'Search Item', 'freeagent' ),
		'not_found'           => esc_html__( 'Not found', 'freeagent' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'freeagent' ),
	);

	$args = array(
			'labels'            => $labels,
			'supports'          => array( 'title' ),
			'public'            => true,
	        'has_archive'       => false,
	        'publicly_queryable' => false,
            'menu_icon'           => 'dashicons-buddicons-pm',
			'show_in_rest'		=> true,
			'capabilities' => array(
			    'create_posts' => false,
			),
			'map_meta_cap' => true,
		);


    if(function_exists('custom_reg_post_type')){
    	custom_reg_post_type( 'jws_report', $args );
    }
	
		$labels = array(
			'name'					=> _x( 'Jobs Report Reason', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( ' Jobs Report Reason', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Categories', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular report Categories', 'freeagent' ),
			'all_items'				=> esc_html__( 'Categories', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Category', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Category', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Category', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Category', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Category', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Category', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Categories', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Jobs Report Reason', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'labels'            => $labels,
            'meta_box_cb' => false,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'report_cat' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'report_cat', array( 'jws_report' ), $args  );
        }

		$labels = array(
			'name'					=> _x( 'Services Report Reason', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( ' Services Report Reason', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Categories', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular report Categories', 'freeagent' ),
			'all_items'				=> esc_html__( 'Categories', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Category', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Category', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Category', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Category', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Category', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Category', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Categories', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Services Report Reason', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'labels'            => $labels,
            'meta_box_cb' => false,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'service_report_reason' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'service_report_reason', array( 'jws_report' ), $args  );
        }

};

add_action( 'init', 'jws_register_report', 1 );