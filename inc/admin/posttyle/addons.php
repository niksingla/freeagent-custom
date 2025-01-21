<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_addons() {
  
		$labels = array(
			'name'                => _x( 'Addons', 'Post Type General Name', 'freeagent' ),
			'singular_name'       => _x( 'Addons', 'Post Type Singular Name', 'freeagent' ),
			'menu_name'           => esc_html__( 'Addons', 'freeagent' ),
			'parent_item_colon'   => esc_html__( 'Parent Item:', 'freeagent' ),
			'all_items'           => esc_html__( 'Addons', 'freeagent' ),
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
				'show_in_rest'		=> true,
				'show_in_menu'		=> 'edit.php?post_type=services',
				'capabilities' => array(
				    'create_posts' => true,
				),
				'map_meta_cap' => true,
			);


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'service_addons', $args );
        }


	};
add_action( 'init', 'jws_register_addons', 1 );
