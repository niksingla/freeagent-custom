<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_employers() {
        global $jws_option;
        $employers_slug = jws_theme_get_option('employers_slug');
		$labels = array(
			'name'                => _x( 'Employers', 'Post Type General Name', 'freeagent' ),
			'singular_name'       => _x( 'Employers', 'Post Type Singular Name', 'freeagent' ),
			'menu_name'           => esc_html__( 'Employers', 'freeagent' ),
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
			'label'               => esc_html__( 'Employers', 'freeagent' ),
		    'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail','page-attributes','post-formats' ),
            'taxonomies'          => array( 'employers_cat' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-groups',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'rewrite' 								=> array( 
				'slug'			=>	!empty($employers_slug) ? $employers_slug : 'employers', 
				'with_front'	=>	true 
			),
		);


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'employers', $args );
        }

		/**
		 * Create a taxonomy category for employers
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
			'name'					=> _x( ' Employers Categories', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( ' Category', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Categories', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular employers Categories', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'employers_cat' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'employers_cat', array( 'employers' ), $args  );
        }
        
        /* Location */
        $labels = array(
            'name' => esc_html__( 'Employers Location', 'freeagent' ),
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
            'meta_box_cb' => false,
			'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite' => array( 'slug' => 'employers_location' ),
        );
        
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'employers_location', array( 'employers' ), $args  );
        }
        
        /* Employer Size */
        $labels = array(
            'name' => esc_html__( 'Employer Size', 'freeagent' ),
            'singular_name' => esc_html__( 'Employer Size',  'freeagent'  ),
            'search_items' =>  esc_html__( 'Search Employer Size' , 'freeagent' ),
            'popular_items' => esc_html__( 'Popular Employer Size' , 'freeagent' ),
            'all_items' => esc_html__( 'All Employer Size' , 'freeagent' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => esc_html__( 'Edit Employer Size' , 'freeagent' ), 
            'update_item' => esc_html__( 'Update Employer Size' , 'freeagent' ),
            'add_new_item' => esc_html__( 'Add New Employer Size' , 'freeagent' ),
            'new_item_name' => esc_html__( 'New Employer Size Name' , 'freeagent' ),
            'separate_items_with_commas' => esc_html__( 'Separate size with commas' , 'freeagent' ),
            'add_or_remove_items' => esc_html__( 'Add or remove size' , 'freeagent' ),
            'choose_from_most_used' => esc_html__( 'Choose from the most used size' , 'freeagent' ),
            'menu_name' => esc_html__( 'Employer size','freeagent'),
        ); 
    
        $args = array(
            'meta_box_cb' => false,
			'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite' => array( 'slug' => 'employers_size' ),
        );
        
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'employers_size', array( 'employers' ), $args  );
        }

	};
add_action( 'init', 'jws_register_employers', 1 );
// Add featured image column to employers post type
function add_featured_image_column_employers($defaults) {
    $defaults['featured_image'] = 'Featured Image';
    $defaults['author'] =  __('Author', 'freeagent');
    return $defaults;
}
add_filter('manage_employers_posts_columns', 'add_featured_image_column_employers');

// Display featured image in employers post type column
function show_featured_image_column_employers($column_name, $post_id) {

    if ($column_name == 'featured_image') {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }
}
add_action('manage_employers_posts_custom_column', 'show_featured_image_column_employers', 10, 2);


// Add custom column header for jobs category taxonomy
function add_thumbnail_column_thumbnail($columns) {
    $columns['logo_loca_thumbnail'] = 'Thumbnail';
    return $columns;
}
add_filter('manage_edit-employers_location_columns', 'add_thumbnail_column_thumbnail');

// Populate the custom column with thumbnail images for jobs category taxonomy
function display_thumbnail_column_content_empl($content, $column_name, $term_id) {
 
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
add_action('manage_employers_location_custom_column', 'display_thumbnail_column_content_empl', 10, 3);

add_post_type_support( 'employers', array(
   'author',
) );