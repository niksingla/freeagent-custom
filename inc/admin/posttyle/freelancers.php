<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_freelancers() {
        global $jws_option;
        $freelancers_slug = jws_theme_get_option('freelancers_slug');
		$labels = array(
			'name'                => _x( 'Freelancers', 'Post Type General Name', 'freeagent' ),
			'singular_name'       => _x( 'Freelancers', 'Post Type Singular Name', 'freeagent' ),
			'menu_name'           => esc_html__( 'Freelancers', 'freeagent' ),
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
			'label'               => esc_html__( 'Freelancers', 'freeagent' ),
		    'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail','page-attributes' ),
            'taxonomies'          => array( 'freelancers_cat' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-admin-users',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'rewrite' 								=> array( 
				'slug'			=>	!empty($freelancers_slug) ? $freelancers_slug : 'freelancers', 
				'with_front'	=>	true 
			),
		);


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'freelancers', $args );
        }

		/**
		 * Create a taxonomy category for freelancers
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
			'name'					=> _x( ' Freelancers Categories', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( ' Category', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Categories', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular freelancers Categories', 'freeagent' ),
			'all_items'				=> esc_html__( 'Categories', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'freelancers_cat' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'freelancers_cat', array( 'freelancers' ), $args  );
        }
        
        
        
        /* Skill */
        $labels = array(
			'name'					=> _x( 'Freelancers Skill', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Skill', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Skill', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular Skill', 'freeagent' ),
			'all_items'				=> esc_html__( 'All Skill', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Skill', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Skill', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Skill', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Skill', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Skill', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Skill', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Skill', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Skill', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'meta_box_cb' => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'freelancers_skill' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'freelancers_skill', array( 'freelancers' ), $args  );
        }
        
        
        /* English level */  
        $labels = array(
			'name'					=> _x( 'Freelancers English level', 'Taxonomy plural name', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'freelancers_english_level' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'freelancers_english_level', array( 'freelancers' ), $args  );
        }
        
        
        /* Language */ 
        $labels = array(
			'name'					=> _x( 'Freelancers Language', 'Taxonomy plural name', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'freelancers_language' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'freelancers_language', array( 'freelancers' ), $args  );
        }
        
         /* Freelancer Type */ 
        $labels = array(
			'name'					=> _x( 'Freelancer Type', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Freelancer Type', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Freelancer Type', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular Freelancer Type', 'freeagent' ),
			'all_items'				=> esc_html__( 'All Freelancer Type', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Freelancer Type', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Freelancer Type', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Freelancer Type', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Freelancer Type', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Freelancer Type', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Freelancer Type', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Freelancer Type', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Freelancer Type', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'meta_box_cb' => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'freelancers_type' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'freelancers_type', array( 'freelancers' ), $args  );
        }    
        
        
        /* Response Time */    
        $labels = array(
			'name'					=> _x( 'Freelancers Response Time', 'Taxonomy plural name', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'freelancers_response_time' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'freelancers_response_time', array( 'freelancers' ), $args  );
        }        
        $labels = array(
            'name' => esc_html__( 'Freelancers Location', 'freeagent' ),
            'singular_name' => esc_html__( 'Location',  'freeagent'  ),
            'search_items' =>  esc_html__( 'Search Location' , 'freeagent' ),
            'popular_items' => esc_html__( 'Popular Location' , 'freeagent' ),
            'all_items' => esc_html__( 'All Location' , 'freeagent' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => esc_html__( 'Edit Location' , 'freeagent' ), 
            'update_item' => esc_html__( 'Update Location' , 'freeagent' ),
            'add_new_item' => esc_html__( 'Add New Location' , 'freeagent' ),
            'new_item_name' => esc_html__( 'New Location Name' , 'freeagent' ),
            'separate_items_with_commas' => esc_html__( 'Separate location with commas' , 'freeagent' ),
            'add_or_remove_items' => esc_html__( 'Add or remove location' , 'freeagent' ),
            'choose_from_most_used' => esc_html__( 'Choose from the most used location' , 'freeagent' ),
            'menu_name' => esc_html__( 'Location','freeagent'),
        ); 
    
        $args = array(
			'hierarchical'      => true,
             'meta_box_cb' => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite' => array( 'slug' => 'freelancers_location' ),
        );
        
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'freelancers_location', array( 'freelancers' ), $args  );
        }

	};
add_action( 'init', 'jws_register_freelancers', 1 );
// Add featured image column to freelancers post type
function add_featured_image_column_freelancers($defaults) {
    $defaults['featured_image'] = 'Featured Image';
    $defaults['author'] = 'Author';
    return $defaults;
}
add_filter('manage_freelancers_posts_columns', 'add_featured_image_column_freelancers');

// Display featured image in freelancers post type column
function show_featured_image_column_freelancers($column_name, $post_id) {
 
     
    if ($column_name == 'featured_image') {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }
}
add_action('manage_freelancers_posts_custom_column', 'show_featured_image_column_freelancers', 10, 2);


// Add custom column header for jobs category taxonomy
function add_thumbnail_column_freelancer($columns) {
    $columns['logo_loca_thumbnail'] = 'Thumbnail';
    return $columns;
}
add_filter('manage_edit-freelancers_location_columns', 'add_thumbnail_column_freelancer');

// Populate the custom column with thumbnail images for jobs category taxonomy
function display_thumbnail_column_content_free($content, $column_name, $term_id) {
    if ($column_name === 'logo_loca_thumbnail') {
        $thumbnail = get_term_meta($term_id, 'logo_loca', true);
        if (!empty($thumbnail)) {
            $image_src = wp_get_attachment_image_src($thumbnail, 'thumbnail');
            if ($image_src) {
                $content = '<img src="' . esc_url($image_src[0]) . '" alt="" style="max-width: 50px;" />';
            }
        }
    }
    return $content;
}
add_action('manage_freelancers_location_custom_column', 'display_thumbnail_column_content_free', 10, 3);

add_post_type_support( 'freelancers', array(
   'author',
) );