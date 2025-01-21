<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_jobs() {
        global $jws_option;
        $jobs_slug = jws_theme_get_option('jobs_slug');
		$labels = array(
			'name'                => _x( 'Jobs', 'Post Type General Name', 'freeagent' ),
			'singular_name'       => _x( 'Jobs', 'Post Type Singular Name', 'freeagent' ),
			'menu_name'           => esc_html__( 'Jobs', 'freeagent' ),
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
			'label'               => esc_html__( 'Jobs', 'freeagent' ),
		    'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'page-attributes' ),
            'taxonomies'          => array( 'jobs_cat' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-portfolio',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'job',
            'map_meta_cap' => true,
            'rewrite' 								=> array( 
				'slug'			=>	!empty($jobs_slug) ? $jobs_slug : 'jobs', 
				'with_front'	=>	true 
			),                        
		);


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'jobs', $args );
        }

		/**
		 * Create a taxonomy category for jobs
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
			'name'					=> _x( 'Jobs Categories', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Jobs Category', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Categories', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular jobs Categories', 'freeagent' ),
			'all_items'				=> esc_html__( 'All jobs Categories', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'jobs_cat' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'jobs_cat', array( 'jobs' ), $args  );
        }
        
        $labels = array(
            'name' => esc_html__( 'Jobs Tags', 'freeagent' ),
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
            'rewrite' => array( 'slug' => 'jobs_tag' ),
        );
        
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'jobs_tag', array( 'jobs' ), $args  );
        }
        
        /* Duration */
        
        
        $labels = array(
			'name'					=> _x( 'Jobs Duration', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Duration', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Duration', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular Duration', 'freeagent' ),
			'all_items'				=> esc_html__( 'All Duration', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Duration', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Duration', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Duration', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Duration', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Duration', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Duration', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Duration', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Duration', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'meta_box_cb' => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'jobs_duration' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'jobs_duration', array( 'jobs' ), $args  );
        }
        
        /* English level */
        
        
        $labels = array(
			'name'					=> _x( 'Jobs English level', 'Taxonomy plural name', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'jobs_english_level' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'jobs_english_level', array( 'jobs' ), $args  );
        }
        
        
        
        /* Language */
        
        
        $labels = array(
			'name'					=> _x( 'Jobs Language', 'Taxonomy plural name', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'jobs_language' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'jobs_language', array( 'jobs' ), $args  );
        }
        
        /* Skill */
        
        
        $labels = array(
			'name'					=> _x( 'Jobs Skill', 'Taxonomy plural name', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'jobs_skill' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'jobs_skill', array( 'jobs' ), $args  );
        }
        
        
        /* Locations */
        
        
        $labels = array(
			'name'					=> _x( 'Jobs Locations', 'Taxonomy plural name', 'freeagent' ),
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
            'rewrite'           => array( 'slug' => 'jobs_locations' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'jobs_locations', array( 'jobs' ), $args  );
        }
        
        
        /* Job Level */
        
        
        $labels = array(
			'name'					=> _x( 'Job Level', 'Taxonomy plural name', 'freeagent' ),
			'singular_name'			=> _x( 'Job Level', 'Taxonomy singular name', 'freeagent' ),
			'search_items'			=> esc_html__( 'Search Job Level', 'freeagent' ),
			'popular_items'			=> esc_html__( 'Popular Job Level', 'freeagent' ),
			'all_items'				=> esc_html__( 'All Job Level', 'freeagent' ),
			'parent_item'			=> esc_html__( 'Parent Job Level', 'freeagent' ),
			'parent_item_colon'		=> esc_html__( 'Parent Job Level', 'freeagent' ),
			'edit_item'				=> esc_html__( 'Edit Job Level', 'freeagent' ),
			'update_item'			=> esc_html__( 'Update Job Level', 'freeagent' ),
			'add_new_item'			=> esc_html__( 'Add New Job Level', 'freeagent' ),
			'new_item_name'			=> esc_html__( 'New Job Level', 'freeagent' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Job Level', 'freeagent' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'freeagent' ),
			'menu_name'				=> esc_html__( 'Job Level', 'freeagent' ),
		);
	
		$args = array(
			'hierarchical'      => false,
            'meta_box_cb' => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'job_level' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'job_level', array( 'jobs' ), $args  );
        }

	};
add_action( 'init', 'jws_register_jobs', 1 );

add_post_type_support( 'jobs', array(
   'author',
) );
// Add custom column header for jobs category taxonomy
function add_thumbnail_column_header($columns) {
    $columns['port_icon_thumbnail'] = 'Thumbnail';
    return $columns;
}
add_filter('manage_edit-jobs_cat_columns', 'add_thumbnail_column_header');

// Populate the custom column with thumbnail images for jobs category taxonomy
function display_thumbnail_column_content($content, $column_name, $term_id) {
    if ($column_name === 'port_icon_thumbnail') {
        $thumbnail = get_term_meta($term_id, 'port_icon_images', true);
        if (!empty($thumbnail)) {
            $image_src = wp_get_attachment_image_src($thumbnail, 'thumbnail');
            if ($image_src) {
                $content = '<img src="' . esc_url($image_src[0]) . '" alt="" style="max-width: 50px;" />';
            }
        }
    }
    return $content;
}
add_action('manage_jobs_cat_custom_column', 'display_thumbnail_column_content', 10, 3);

/*Column Featured*/
// Add custom column to job listings table
function custom_jobs_featured_columns($columns) {
    
    unset($columns['taxonomy-jobs_duration']);
    unset($columns['taxonomy-jobs_english_level']);
    unset($columns['taxonomy-jobs_language']);
    unset($columns['taxonomy-jobs_skill']);
    unset($columns['taxonomy-jobs_locations']);
    unset($columns['taxonomy-job_level']);
              
    $columns['author'] =  __('Author', 'freeagent');
    
    return $columns;
}
add_filter('manage_jobs_posts_columns', 'custom_jobs_featured_columns');

function show_featured_image_column_jobs($column_name, $post_id) { 

 
}
add_action('manage_jobs_posts_custom_column', 'show_featured_image_column_jobs', 10, 2); 
