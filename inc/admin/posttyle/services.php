<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_services() {
        global $jws_option;
        $services_slug = jws_theme_get_option('services_slug');
		$labels = array(
			'name'                => _x( 'Services', 'Post Type General Name', 'freeagent' ),
			'singular_name'       => _x( 'Services', 'Post Type Singular Name', 'freeagent' ),
			'menu_name'           => esc_html__( 'Services', 'freeagent' ),
			'parent_item_colon'   => esc_html__( 'Parent Item:', 'freeagent' ),
			'all_items'           => esc_html__( 'All Items', 'freeagent' ),
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
			'label'               => esc_html__( 'services', 'freeagent' ),
		    'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail','page-attributes', ),
            'taxonomies'          => array( 'services_cat' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-networking',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'service',
            'map_meta_cap' => true, 
            'rewrite' 								=> array( 
				'slug'			=>	!empty($services_slug) ? $services_slug : 'services', 
				'with_front'	=>	true 
			),  
		);


        if(function_exists('custom_reg_post_type') ){
        	custom_reg_post_type( 'services', $args );
        }

		/**
		 * Create a taxonomy category for services
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
			'name'					=> _x( 'Services Categories', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Services Category', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Categories', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular services Categories', 'freeagent' ),
			'all_items'				=> esc_html__( 'All services Categories', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'services_cat' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'services_cat', array( 'services' ), $args  );
        }
        
        $labels = array(
            'name' => esc_html__( 'Services Tags', 'freeagent' ),
            'singular_name' => esc_html__( 'Tag',  'freeagent'  ),
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
            'rewrite' => array( 'slug' => 'services_tag' ),
        );
        
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'services_tag', array( 'services' ), $args  );
        }
        
     /* English level */
        $labels = array(
			'name'					=> _x( 'Services English level', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'English level', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search English level', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular English level', 'freeagent' ),
			'all_items'				=> esc_html__( 'All English level', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent English level', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent English level', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit English level', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update English level', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New English level', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New English level', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove English level', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'English level', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'meta_box_cb' => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'services_english_level' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'services_english_level', array( 'services' ), $args  );
        }
        
        
        
        /* Language */
        $labels = array(
			'name'					=> _x( 'Services Language', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Language', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Language', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular Language', 'freeagent' ),
			'all_items'				=> esc_html__( 'All Language', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Language', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Language', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Language', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Language', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Language', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Language', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Language', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Language', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'meta_box_cb' => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'services_language' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'services_language', array( 'services' ), $args  );
        }
        
        
      /* Locations */
        $labels = array(
			'name'					=> _x( 'Services Locations', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Locations', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Locations', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular Locations', 'freeagent' ),
			'all_items'				=> esc_html__( 'All Locations', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Locations', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Locations', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Locations', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Locations', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Locations', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Locations', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Locations', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Locations', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'meta_box_cb' => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'services_locations' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'services_locations', array( 'services' ), $args  );
        }
        
        $labels = array(
			'name'					=> _x( 'Services Response Time', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Response Time', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Response Time', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular Response Time', 'freeagent' ),
			'all_items'				=> esc_html__( 'All Response Time', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Response Time', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Response Time', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Response Time', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Response Time', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Response Time', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Response Time', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Response Time', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Response Time', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'meta_box_cb' => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'services_response_time' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'services_response_time', array( 'services' ), $args  );
        }
        /* Delivery Time */
        
        
        $labels = array(
			'name'					=> _x( 'Services Delivery Time', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Delivery Time', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Delivery Time', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular Delivery Time', 'freeagent' ),
			'all_items'				=> esc_html__( 'All Delivery Time', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Delivery Time', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Delivery Time', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Delivery Time', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Delivery Time', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Delivery Time', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Delivery Time', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Delivery Time', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Delivery Time', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'meta_box_cb' => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'services_delivery_time' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'services_delivery_time', array( 'services' ), $args  );
        }
	};
add_action( 'init', 'jws_register_services', 1 );
add_post_type_support( 'services', array(
    'author',
) );
function add_featured_image_column_services($defaults) {
    
    unset($defaults['taxonomy-services_english_level']);
    unset($defaults['taxonomy-services_language']);
    unset($defaults['taxonomy-services_locations']);
    unset($defaults['taxonomy-services_response_time']);
    unset($defaults['taxonomy-services_delivery_time']);

    
    $defaults['featured_image'] = 'Featured Image';
    return $defaults;
}
add_filter('manage_services_posts_columns', 'add_featured_image_column_services');
 
function show_featured_image_column_services($column_name, $post_id) { 

    if ($column_name == 'featured_image') {
        echo get_the_post_thumbnail($post_id, 'thumbnail'); 
    }
}
add_action('manage_services_posts_custom_column', 'show_featured_image_column_services', 10, 2); 
