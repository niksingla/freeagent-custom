<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_portfolio() {
  
		$labels = array(
			'name'                => _x( 'Portfolios', 'Post Type General Name', 'freeagent' ),
			'singular_name'       => _x( 'Portfolios', 'Post Type Singular Name', 'freeagent' ),
			'menu_name'           => esc_html__( 'Portfolios', 'freeagent' ),
			'parent_item_colon'   => esc_html__( 'Parent Item:', 'freeagent' ),
			'all_items'           => esc_html__( 'Portfolio', 'freeagent' ),
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
				'supports'          => array( 'title','editor', 'excerpt', 'thumbnail', 'author' ),
                'taxonomies'          => array( 'portfolios_cat' ),
				'public'            => true,
		        'has_archive'       => true,
		        'publicly_queryable' => true,
				'show_in_rest'		=> true,
				'show_in_menu'		=> true,
                'menu_position'       => 6,
                'menu_icon'           => 'dashicons-format-gallery',
                'can_export'          => true,
				'map_meta_cap' => true,
			);


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'portfolios', $args );
        }
        
        
		/**
		 * Create a taxonomy category for portfolios
		 *
		 * @uses  Inserts new taxonomy object into the list
		 * @uses  Adds query vars
		 *
		 * @param string  Name of taxonomy object
		 * @param array|string  Name of the object type for the taxonomy object.
		 * @param array|string  Taxonomy arguments
		 * @return null|WP_Error WP_Error if errors, otherwise null.
		 */
		
		$labels = array(
			'name'					=> _x( 'Portfolios Categories', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Portfolios Category', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Categories', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular portfolios Categories', 'freeagent' ),
			'all_items'				=> esc_html__( 'All portfolios Categories', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Category', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Category', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Category', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Category', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Category', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Category', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Categories', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Category', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'portfolios_cat' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'portfolios_cat', array( 'portfolios' ), $args  );
        }
              $labels = array(
            'name' => esc_html__( 'Tags', 'freeagent' ),
            'singular_name' => esc_html__( 'portfolios Tag',  'freeagent'  ),
            'search_items' =>  esc_html__( 'Search Tags' , 'freeagent' ),
            'popular_items' => esc_html__( 'Popular Tags' , 'freeagent' ),
            'all_items' => esc_html__( 'All Tags' , 'freeagent' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => esc_html__( 'Edit Tag' , 'freeagent' ), 
            'update_item' => esc_html__( 'Update Tag' , 'freeagent' ),
            'add_new_item' => esc_html__( 'Add New Tag' , 'freeagent' ),
            'new_item_name' => esc_html__( 'New Tag Name' , 'freeagent' ),
            'separate_items_with_commas' => esc_html__( 'Separate tags with commas' , 'freeagent' ),
            'add_or_remove_items' => esc_html__( 'Add or remove tags' , 'freeagent' ),
            'choose_from_most_used' => esc_html__( 'Choose from the most used tags' , 'freeagent' ),
            'menu_name' => esc_html__( 'Tags','freeagent'),
        ); 
    
        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array( 'slug' => 'portfolios_tag' ),
        );
        
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'portfolios_tag', array( 'portfolios' ), $args  );
        }  

	};
add_action( 'init', 'jws_register_portfolio', 1 );
