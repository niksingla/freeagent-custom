<?php
class Jws_Job_Type_Widget extends WP_Widget {
    
       // Constructor
    public function __construct() {
        parent::__construct(
            'jws_job_type_widget', // Widget ID
            'JWS Job Type Widget', // Widget Name
            array(
                'description' => 'Widget to display job types.', // Widget Description
            )
        );
    }

    public function widget($args, $instance) {
        
    function get_job_type_post_count($job_type_id) {
            $args = array(
                'post_type' => 'jobs', // Replace with your actual post type
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key' => 'job_type',
                        'value' => $job_type_id,
                        'compare' => '=',
                    ),
                ),
            );
        
            $query = new WP_Query($args);
            return $query->found_posts;
        }
        
        global $wp;
        echo ''.$args['before_widget'];
    
        echo ''.$args['before_title'] . $instance['title'] . $args['after_title'];
            // Define available job types
        $available_job_types = array(
            '1' =>  __( 'Hourly', 'freeagent' ),
            '2' =>  __( 'Fixed', 'freeagent' ),
        );
       	$current_job_type ='';
        if (isset($_GET['job_type']) && $_GET['job_type'] != '') {
            $current_job_type = explode( ',',  $_GET['job_type']);
        }
        
        if ( '' === get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}
        $count_posts = 0;
        ?>
        <div class="form_filter_type">
        <form method="get" action="<?php echo esc_url( $form_action );?>">
            <input name="job_type" type="hidden" class="file_checkbox_value">
            <?php echo jws_query_string_form_fields( null, array( 'job_type' ), '', true ); ?>
        </form>
          <ul>
            <?php foreach ($available_job_types as $job_type_id => $job_type_label){
                $current_class = (!empty($current_job_type) && in_array($job_type_id, $current_job_type)) ? 'current' : '';

                    $count_posts = get_job_type_post_count($job_type_id);
       

                echo '<li><a data-name="job_type" data-value="'.$job_type_id.'" data-title="'.$job_type_label.'" class="'.$current_class.'">' .$job_type_label . '<span class="count">('.$count_posts.')</span></a></li>';

            } ?>
               
                
            </ul>
        </div>
        <?php
        echo ''.$args['after_widget'];
    }

    // Widget Form (Backend)
    public function form($instance) {
        global $wp;
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';

        ?>
        <p>
            <label for="<?php echo ''.$this->get_field_id('title'); ?>">	<?php echo __( 'Title', 'freeagent' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id('title'); ?>" name="<?php echo ''.$this->get_field_name('title'); ?>" type="text" value="<?php echo ''.$title; ?>" />
        </p>
        <?php

    }

        public function update($new_instance, $old_instance) {
        // Save widget settings
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}

if(function_exists('insert_widgets')) {
    insert_widgets( 'Jws_Job_Type_Widget' );
}