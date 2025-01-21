<?php

function freelancer_rating($post_id){
    $fr_feedback = get_post_meta($post_id, 'feedback_fr', true);
      $sum_ratings = 0;
      $total_feedback =0;
    if (is_array($fr_feedback) && !empty($fr_feedback)) {
        $total_feedback = count($fr_feedback);
        foreach ($fr_feedback as $feedback_entry) {
            // Assuming "rating" is the key for the rating value
            $sum_ratings += intval($feedback_entry['rating']);
        }
    }
      
    
    
    
        $average_rating = $total_feedback > 0 ? $sum_ratings / $total_feedback : 0;
        $average_rating_formatted = number_format($average_rating, 1);
        $max_rating = 5;
        $percentage_rating = ($average_rating / $max_rating) * 100;
        
     
        if($total_feedback > 1){
            $feedback_html = $total_feedback.esc_html__(' Reviews','freeagent');
        }else{
          $feedback_html = $total_feedback.esc_html__(' Review','freeagent');  
        } 
        echo '<div class="count_review">'.freelancer_get_rating_html($average_rating_formatted).$average_rating_formatted.'<span class="total_review">('.$feedback_html.')</span></div>'; 
}
function jws_menu_dashboard_shortcode() {
    ob_start();     
    $current_user_id = get_current_user_id();
$active_profile = get_user_meta($current_user_id,'_active_profile', true);    
    if ( is_user_logged_in() || isset($_GET['p']) ) {
        $user_info  = get_userdata( get_current_user_id() );
    	$user_roles = $user_info->roles;
        
        if($active_profile == '1') {
            
            $user_p_id  = Jws_Custom_User::get_employer_id( $current_user_id );
            
        }
        
        if($active_profile == '2') {
            
            $user_p_id  = Jws_Custom_User::get_freelaner_id( $current_user_id );
            
        }
        echo ' <div class="account-menu-dahsboard">';
        if($active_profile == '1' || $active_profile == '2') {
                    
            $menu_class  = new Jws_user_dashboard_menu( $active_profile );
            $menu_class->the_menu(array('name'=>'all')); 
            

            
        } else {
            
          	$out = '<ul>';

    		foreach ( wc_get_account_menu_items() as $endpoint => $label ) {
    			$out .= '<li class="' . wc_get_account_menu_item_classes( $endpoint ) . '"><a href="' . esc_url( wc_get_account_endpoint_url( $endpoint ) ) . '"><span>' . esc_html( $label ) . '</span></a></li>';
    		}
    
    		echo ''.$out . '</ul>';  
            
        }
        echo '</div>';
    }

    return ob_get_clean();
}

if(function_exists('insert_shortcode')) insert_shortcode('jws_menu_dashboard', 'jws_menu_dashboard_shortcode');
//Active category
function average_rating_formatted($id){
    $fr_feedback = get_post_meta($id, 'feedback_fr', true);
     
  $sum_ratings = 0;
  $total_feedback =0;
if (is_array($fr_feedback) && !empty($fr_feedback)) {
    $total_feedback = count($fr_feedback);
    foreach ($fr_feedback as $feedback_entry) {
        // Assuming "rating" is the key for the rating value
        $sum_ratings += intval($feedback_entry['rating']);
    }
}

    $average_rating = $total_feedback > 0 ? $sum_ratings / $total_feedback : 0;
    $average_rating_formatted = number_format($average_rating, 1);

    return $average_rating_formatted;   
}


function average_rating_fr($id){
   $fr_feedback = get_post_meta($id, 'feedback_fr', true);
     
  $sum_ratings = 0;
  $total_feedback =0;
if (is_array($fr_feedback) && !empty($fr_feedback)) {
    $total_feedback = count($fr_feedback);
}
$feedback_html = $total_feedback;

    return $feedback_html;
}
//Active category
function active_categories($taxonomies) {
     $hasFilter = false;
     
    foreach ($taxonomies as $taxonomy) {
        if (isset($_GET[$taxonomy])) {
             $hasFilter = true;
            $argss = explode(',', $_GET[$taxonomy]);

            foreach ($argss as $value) {
                $term = get_term_by('slug', $value, $taxonomy);
                if ($term) {
                    echo '<a href="javascript:void(0);" data-name="' . $taxonomy . '" data-value="' . $value . '" class="filter_active">' . esc_html($term->name) . '<span class="jws-icon-cross"></span></a>';
                }
            }
        }
    }
    if ($hasFilter) {
      echo '<a href="javascript:void(0);" class="clear_filter">' . esc_html__('Clear Filter', 'freeagent') . '</a>';
    }
}


function active_categories_check($exclude) {
    
    if(!isset($_GET)) return false;
    
    $filter_array = array_diff_key($_GET, array_flip($exclude));
    
    $count = array();
      
    foreach ($filter_array as $slug => $filter) {
            
            $argss = explode(',', $filter); 
      
            foreach ($argss as $value) {
                
                if(empty($value)) continue;
                
                $term = get_term_by('slug', $value, $slug);
            
                if($slug == 'max_price') {
                    $name = esc_html__('Max price:','freeagent').jws_format_price($filter);
                }elseif($slug == 'min_price') {
                    $name = esc_html__('Min price:','freeagent').jws_format_price($filter);
                }elseif($slug == 'job_type') {
                    $name = $value == '1' ? esc_html__('Hourly','freeagent') : esc_html__('Fixed','freeagent');
                }else {
                    $name = $filter;
                }
                
                if ($term) {
                    echo '<a href="javascript:void(0);" data-name="' . $slug . '"  data-value="' . $value . '" class="filter_active">' . esc_html($term->name) . '<span class="jws-icon-cross"></span></a>';
                }else {
                    echo '<a href="javascript:void(0);" data-name="' . $slug . '"   data-value="' . $value . '" class="filter_active">' . $name . '<span class="jws-icon-cross"></span></a>';
                }
                $count[] = $value;
            }
            
        
    }
   
    if (!empty($count)) {
         global $wp;  
         $current_url = home_url($wp->request);
      
         $intersect = array_intersect_key($_GET, array_flip($exclude));
  
         $current_url = !empty($intersect) ? add_query_arg($intersect , $current_url) : $current_url;
         echo '<a  href="'.$current_url.'" class="clear_filter">' . esc_html__('Clear Filter', 'freeagent') . '</a>';
    }
   

}

//News
function new_jobs($post_date) {
    // Set the default timezone (change 'UTC' to the desired timezone if needed)
	$timezone_name = get_option('timezone_string');

	// Ensure the timezone_name is set, otherwise use a default
	if (!$timezone_name) {
		$timezone_name = 'UTC'; // Use UTC as the default if no timezone is set
	}
    $timezone = new DateTimeZone($timezone_name);
    // Convert the post date to a DateTime object with the specified timezone
    try {
        $post_date_time = new DateTime($post_date, $timezone);
    } catch (Exception $e) {
        // Handle the exception if the date format is incorrect or timezone is not found
        error_log($e->getMessage());
        return;
    }
    
    // Get the current date and time with the same timezone
    $current_date_time = new DateTime('now', $timezone);
    
    // Calculate the difference in days between the post date and the current date
    $days_difference = $current_date_time->diff($post_date_time)->days;
    
    // Define the threshold for considering a post as "new" (e.g., 7 days)
    $new_post_threshold = 7;
    
    // Check if the post is considered "new"
    if ($days_difference <= $new_post_threshold) {
        echo '<span class="new">' . esc_html__('New', 'freeagent') . '</span>';
    }
}



// Post Per Page Services
function jws_services_archive_posts_per_page($query) {
    // Check if it's the main query and if it's the employers archive page
    global $jws_option;
    $post_per_page = (isset($_GET['number'])) ? $_GET['number'] : (isset($jws_option['services_per_page']) && $jws_option['services_per_page'] ? $jws_option['services_per_page'] :9);
    if (is_admin() || !$query->is_main_query() || !is_post_type_archive('services')) {
        return;
    }

    // Set the number of employers you want to display per page
    $query->set('posts_per_page', $post_per_page); // Replace 10 with your desired number
    
    
    
    $min_price = isset($_GET['min_price']) ? intval($_GET['min_price']) : 0;
    $max_price = isset($_GET['max_price']) ? intval($_GET['max_price']) : 10000000000000000;

    if ($max_price > 0) {
        $meta_query = array('relation' => 'AND');

        if ($max_price > 0) {
            $meta_query[] = array(
	           	'key' => 'services_price',
	           	'value' => array( sanitize_text_field($min_price), sanitize_text_field($max_price) ),
	           	'compare'   => 'BETWEEN',
				'type'      => 'NUMERIC',
	       	);
        }
        


        $query->set('meta_query', $meta_query);
    }
}
add_action('pre_get_posts', 'jws_services_archive_posts_per_page');



// Post Per Page Jobs
function jws_jobs_archive_posts_per_page($query) {
    // Check if it's the main query and if it's the employers archive page
    global $jws_option;
    $post_per_page = (isset($_GET['number'])) ? $_GET['number'] : (isset($jws_option['jobs_per_page']) && $jws_option['jobs_per_page'] ? $jws_option['jobs_per_page'] :9);
   if (is_admin() || !$query->is_main_query() || !is_post_type_archive('jobs')) {
        return;
    }
    
    $query->set('post_status', array('publish')); 

    
      
		$params = $_GET;
	
		
		// Filter params
		$params = apply_filters( 'wp_freeagent_job_filter_params', $params ) ;
     
        $min_price = isset($_GET['min_price']) ? intval($_GET['min_price']) : 0;
        $max_price = isset($_GET['max_price']) ? intval($_GET['max_price']) : 0;
        
        $query_vars = $query->query_vars;
      
        $query_vars = get_query_var_filter($query, $params);
   
		$query = $query_vars;
   

        if ($min_price > 0 || $max_price > 0) {
            $meta_query = array('relation' => 'AND');

            if ($min_price > 0) {
                $meta_query[] = array(
                    'key'     => 'min_price',
                    'value'   => $min_price,
                    'type'    => 'NUMERIC',
                    'compare' => '>='
                );
            }

            if ($max_price > 0) {
                $meta_query[] = array(
                    'key'     => 'max_price',
                    'value'   => $max_price,
                    'type'    => 'NUMERIC',
                    'compare' => '<='
                );
            }

            $query->set('meta_query', $meta_query);
        }
        
        if(isset($_GET['location'])) {
            $location = wp_strip_all_tags( $_GET['location'] );
            $location = preg_replace("/[^A-Za-z0-9 ]/", '', $location);
         
            $meta_query[] = array(
                'key'     => 'map_location',
                'value'   => $_GET['location'],
                'compare' => 'LIKE'
            );
            
            $query->set('meta_query', $meta_query); 
            
        }
        
        
        $job_type = isset($_GET['job_type']) ? intval($_GET['job_type']) :'';
        
        if(!empty($job_type)){
            $job_type =  explode( ',',  $_GET['job_type']);
            $meta_query[] = array(
                array(
                    'key' => 'job_type',
                    'value' => $job_type,
                    'compare' => 'IN',
                ),
            );
            $query->set('meta_query', $meta_query);
        }
        
    // Set the number of employers you want to display per page
    $query->set('posts_per_page', $post_per_page); // Replace 10 with your desired number
}
add_action('pre_get_posts', 'jws_jobs_archive_posts_per_page');


function get_query_var_filter($query_vars, $params) { 
     //$query_vars = self::orderby($query_vars, $params);
    if ( ! empty( $params['search-title'] ) ) {
			global $wp_freeagent_job_keyword;
			$wp_freeagent_job_keyword = sanitize_text_field( wp_unslash($params['search-title']) );
			//$query_vars['s'] = sanitize_text_field( wp_unslash($params['filter-title']) );
          $query_vars->set('s', $wp_freeagent_job_keyword);
			add_filter( 'posts_search',  'get_jobs_keyword_search' );
		}
      
        return $query_vars;
}

function get_jobs_keyword_search( $search ) {
	global $wpdb, $wp_freeagent_job_keyword;

		if (empty($search)) {
	        return $search; // skip processing - no search term in query
	    }
	    
	    $search = '';
	   	if ( $wp_freeagent_job_keyword ) {
	        $search = "($wpdb->posts.post_title LIKE '%{$wp_freeagent_job_keyword}%')";
	    }

	    if (!empty($search)) {
	        $search = " AND ({$search}) ";
	        if (!is_user_logged_in()) {
	            $search .= " AND ($wpdb->posts.post_password = '') ";
	        }
	    }

		// Searchable Meta Keys: set to empty to search all meta keys.
		$searchable_meta_keys = array(
			'job_type',
		);

		$searchable_meta_keys = apply_filters( 'wp_freeagent_searchable_meta_keys', $searchable_meta_keys );

		// Set Search DB Conditions.
		$conditions = array();

		// Search Post Meta.
		if ( apply_filters( 'wp_freeagent_search_post_meta', true ) ) {

			// Only selected meta keys.
			if ( $searchable_meta_keys ) {
				$conditions[] = "{$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key IN ( '" . implode( "','", array_map( 'esc_sql', $searchable_meta_keys ) ) . "' ) AND meta_value LIKE '%" . esc_sql( $wp_freeagent_job_keyword ) . "%' )";
			} else {
				// No meta keys defined, search all post meta value.
				$conditions[] = "{$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_value LIKE '%" . esc_sql( $wp_freeagent_job_keyword ) . "%' )";
			}
		}

		// Search taxonomy.
		$conditions[] = "{$wpdb->posts}.ID IN ( SELECT object_id FROM {$wpdb->term_relationships} AS tr LEFT JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id LEFT JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id WHERE t.name LIKE '%" . esc_sql( $wp_freeagent_job_keyword ) . "%' )";
		
		$conditions = apply_filters( 'wp_freeagent_search_conditions', $conditions, $wp_freeagent_job_keyword );
		if ( empty( $conditions ) ) {
			return $search;
		}

		$conditions_str = implode( ' OR ', $conditions );

		if ( ! empty( $search ) ) {
			$search = preg_replace( '/^ AND /', '', $search );
			$search = " AND ( {$search} OR ( {$conditions_str} ) )";
		} else {
			$search = " AND ( {$conditions_str} )";
		}
		remove_filter( 'posts_search', 'get_jobs_keyword_search' );
    
		return $search;
	}


// Post Per Page Freelance
function jws_freelancers_archive_posts_per_page($query) {
    // Check if it's the main query and if it's the employers archive page
    global $jws_option;
    $post_per_page = (isset($_GET['number'])) ? $_GET['number'] : (isset($jws_option['free_post_per_page']) && $jws_option['free_post_per_page'] ? $jws_option['free_post_per_page'] :9);
    if (is_admin() || !$query->is_main_query() || !is_post_type_archive('freelancers')) {
        return;
    }

    // Set the number of employers you want to display per page
    $query->set('posts_per_page', $post_per_page); // Replace 10 with your desired number
}
add_action('pre_get_posts', 'jws_freelancers_archive_posts_per_page');

// Post Per Page Employer
function custom_employers_archive_posts_per_page($query) {
    // Check if it's the main query and if it's the employers archive page
    global $jws_option;
    $post_per_page = (isset($_GET['number'])) ? $_GET['number'] : (isset($jws_option['post_per_page']) && $jws_option['post_per_page'] ? $jws_option['post_per_page'] :12);
    if (is_admin() || !$query->is_main_query() || !is_post_type_archive('employers')) {
        return;
    }

    // Set the number of employers you want to display per page
    $query->set('posts_per_page', $post_per_page); // Replace 10 with your desired number
}
add_action('pre_get_posts', 'custom_employers_archive_posts_per_page');

function jws_freelance_number_of_post(){
    global $wp_query, $wp;

    // Check if there are multiple pages
    
        $option_perpage = jws_theme_get_option('change_per_page');
      
        $default_posts_per_page = 8;
        
        if ( '' === get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}
            $current_posts_per_page = $wp_query->post_count;
             $selected_option   = isset($_GET['number']) ? sanitize_text_field($_GET['number']) : $current_posts_per_page;


        $archive_title = post_type_archive_title('', false);
      
        $html = '<form class="form_posts_per_page" method="get" action="' . esc_url($form_action) . '">';
        $html .= jws_query_string_form_fields( null, array( 'number' ), '', true );
        $html .= '<label for="posts_per_page">' . $archive_title . esc_html__(' Per Page:', 'freeagent') . '</label>';
        $html .= '<select name="number" id="posts_per_page">';
        
         foreach($option_perpage as $option) {
            
         $html .= '<option value="' . esc_attr($option) . '"' .selected($option, $selected_option, false) . '>' . esc_html($option) . '</option>';
        
        }
    
        $html .= '</select>';
        $html .= '</form>';
        echo ''.$html;
    
}


//Result Post Per Page
function jws_freelance_found() {
     global $jws_option;
      $current_posts_per_page = get_query_var('posts_per_page');
    global $wp_query;
    // Define each variable again (before using it)
    $paged    = max( 1, $wp_query->get( 'paged' ) );
    $per_page = $current_posts_per_page;
    $total    = $wp_query->found_posts;
    $first    = ( $per_page * $paged ) - $per_page + 1;
    $last     = min( $total, $current_posts_per_page * $paged );
    $current = (get_query_var('paged')) ? get_query_var('paged') : 1; 

	// phpcs:disable WordPress.Security
	if ( 1 === intval( $total ) ) {
		_e( 'Single result', 'freeagent' );
	} elseif ( $total <= $per_page || -1 === $per_page ) {
		/* translators: %d: total results */
		printf( _n( '%d item', '%d items', $total, 'freeagent' ), $total );
	} else {
		$first = ( $per_page * $current ) - $per_page + 1;
		$last  = min( $total, $per_page * $current );
		/* translators: 1: first result 2: last result 3: total results */
		printf( _nx( 'Showing <span class="found-min">%1$d&ndash;</span>%2$d of %3$d result', 'Showing <span class="found-min">%1$d&ndash;</span class="found-total">%2$d <span class="result-total">of %3$d</span> results', $total, 'with first and last result', 'freeagent' ), $first, $last, $total );
	}
}


//Ordering
function generate_ordering_form_html() {
    global $wp;
    $orderby_options = array(
        'default' => esc_html__( 'Sort by (Default)', 'freeagent' ),
        'DESC' => esc_html__( 'Newest', 'freeagent' ),
        'ASC' => esc_html__( 'Oldest', 'freeagent' ),
        'random' => esc_html__( 'Random', 'freeagent' ),
    );

    // Initialize $orderby variable, assuming a default value
    $order   = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'default';

    // Assuming $form_action is defined somewhere in your code
    $form_action = ''; // Replace this with your actual form action URL
    if ( '' === get_option( 'permalink_structure' ) ) {
    	$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
    } else {
    	$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
    }
    // Start building the HTML
    $html = '<div class="acf-ordering">';
    $html .= '<form class="cpt-ordering" method="get" action="' . esc_url($form_action) . '">';
     $html .= jws_query_string_form_fields( null, array( 'order', 'paged', 'orderby' ), '', true );
    $html .= '<select name="order" class="orderby" aria-label="' . esc_attr__('Freeagent order', 'freeagent') . '">';

    // Loop through ordering options
    foreach ($orderby_options as $id => $name) {
        $html .= '<option value="' . esc_attr($id) . '" ' . selected($order, $id, false) . '>' . esc_html($name) . '</option>';
    }

    $html .= '</select>';
    // Add hidden input for 'order' parameter
    $html .= '<input type="hidden" name="orderby" value="date" />';
    $html .= '</form>';
    $html .= '</div>';

    return $html;
}

//General Theme Option
function jws_check_layout_employers() {
    global $jws_option;
    $value = array();
       // position //
    if(isset($_GET['layout']) && $_GET['layout']) { 
      $position = $_GET['layout']; 
    }else{
      $position = (isset($jws_option['employer_position_sidebar']) && $jws_option['employer_position_sidebar']) ? $jws_option['employer_position_sidebar'] : 'left'; 
      
    }  
    if($position == 'no_sidebar' ) {
       $value['content_col'] = 'post_content col-12'; 
      
    }else{
       $value['content_col']  = 'post_content col-xl-9 col-lg-12 col-12';
    }

    $value['position']  = $position;
    
    $columns = (isset($jws_option['employers_columns']) && !empty($jws_option['employers_columns']) ) ? $jws_option['employers_columns'] : '3';
    $getlayout   = isset($_GET['lay_style']) ? $_GET['lay_style'] : $columns; 
    $value['employers_columns'] = $getlayout;
    $value['employers_columns_tablet'] = (isset($jws_option['employers_columns_tablet']) && !empty($jws_option['employers_columns_tablet']) ) ? $jws_option['employers_columns_tablet'] : '6';
    $value['employers_columns_mobile'] = (isset($jws_option['employers_columns_mobile']) && !empty($jws_option['employers_columns_mobile']) ) ? $jws_option['employers_columns_mobile'] : '12';
    
    
    return $value;
}
function freelancer_get_rating_html( $rating ) { 
     if ( $rating > 0 ) { 
        $rating_html = '<div class="star-rating" title="' . sprintf( esc_attr__( 'Rated %s out of 5','freeagent' ), $rating ) . '">'; 
        $rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . esc_html__( 'out of 5','freeagent' ) . '</span>'; 
        $rating_html .= '</div>'; 
    } else { 
        $rating_html = ''; 
    }  
    return $rating_html;  
}

function jws_jobs_location_search_shortcode() {
  
    ob_start(); // Start output buffering
    global $wp_query;  
       $locations = get_terms(array(
        'taxonomy' => 'jobs_locations',
        'hide_empty' => false, // Set to false to include terms with no posts
    ));
    $id=0;
     $location   = isset($_GET['location']) ? sanitize_text_field($_GET['location']) : '';
       
    echo '<div class="jws_jobs_search location">
        <form action="' . get_post_type_archive_link('jobs') . '" method="get">
            <div class="row field_filter">
                <div class="col-xl-6 col-lg-6 col-12">
                    <i class="jws-icon-search-outline"></i>
                    <input class="search_filed" name="search-title" type="text" value="" placeholder="' . esc_attr_x('Job title, keywords...', 'placeholder', 'freeagent') . '" />
                </div>
                <div class="col-xl-6 col-lg-6 col-12">
                    <input id="search_place_address"  type="text" value="" placeholder="' . esc_attr_x('City, State or Zip', 'placeholder', 'freeagent') . '" />
                    <input name="location" type="hidden" value=""/>
                </div>
            </div>
            <button type="submit" class="elementor-button">
            
                <span class="btn_search">' . esc_html__('Search', 'freeagent') . '</span>
            </button>
            ' . jws_query_string_form_fields(null, array('search-title', 'location'), '', true) . '
        </form>
    </div>';

    $output = ob_get_clean(); // Get the buffered content

    return $output;
}

if(function_exists('insert_shortcode')) insert_shortcode('jws_jobs_location_search', 'jws_jobs_location_search_shortcode');

?>