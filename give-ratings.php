<?php
add_action('wp_ajax_give_rating', 'give_rating');
function give_rating() { 
    jws_demo_mode();
    $args = wp_parse_args( $_POST , array(
        'job_id' => '',
        'freelancer_id' => '',
        'message' => '',
        'feedback_rating' => '',
        'action_type' => '',
    ) );

    extract( $args ); 
    
    $secure = check_ajax_referer( 'feedback_freelancer_nonce_value', 'security', false );

    $errors = new WP_Error(); 

    if ( ! $secure ) {
        $errors->add(
               'secure_miss',
               $secure
        );
        wp_send_json_error( $errors );
    }
    
    if( !empty($job_id) && !_is_owner( $job_id )){
   
      $errors->add(
               'permission',
               esc_html__( 'You do not have permission, please contact admin', 'freeagent' )
      );
      wp_send_json_error( $errors );  
    }
    

    if(empty($message)){
   
      $errors->add(
               'feedback',
               esc_html__( 'Please add your feedback', 'freeagent' )
      );
      wp_send_json_error( $errors );  
    }
    
    if(empty($feedback_rating) && $action_type == 'completed'){
   
      $errors->add(
               'review',
               esc_html__( 'Please add your review', 'freeagent' )
      );
      
      wp_send_json_error( $errors );
        
    }
    
    $post_status = get_post_status($job_id);
        
    
    
    $current_user_id = get_current_user_id();
    $fr_usr_id = get_post_field('post_author', $freelancer_id);
    
    
    $args = array(
        'post_type' => 'job_proposal',
        'fields'          => 'ids',
        'posts_per_page'  => 1,
        'author'        => $fr_usr_id,
        'meta_query' => array(
            array(
                'key'     => 'job_id',
                'value'   => intval( $job_id ),
                'compare' => '=',
            ),
        ),
    ); 
    
    $proposals = get_posts($args);
 
    if($action_type == 'completed') {

        if(isset($proposals[0])) {
            
        update_post_meta($proposals[0], 'status','completed');
        
        } else {
    
            $errors->add(
                    'review',
                    esc_html__( 'proposals error', 'freeagent' )
            );
            
            wp_send_json_error( $errors );
        
        }
        
        $my_post = array(
            'ID' => $job_id,
            'post_type' => 'jobs',
            'post_status'   => 'completed',
        );

        $result = wp_update_post($my_post, true);
        
        if (is_wp_error($result))
        {

            $errors->add(
                    'job_error',
                    esc_html__( 'Can not update job status, please contact admin', 'freeagent' )
            );
            
            wp_send_json_error( $errors );
        }        
        
        $fr_feedback = get_post_meta($freelancer_id, 'feedback_fr', true);
        
        if(empty($fr_feedback)) {
            
            $fr_feedback = [];
            
        }

        $fr_feedback[] = array(
            'job'  => $job_id,
            'user'  => $current_user_id,
            'message' => $message,
            'rating' => $feedback_rating,
            'date' => date("Y-m-d h:i:s")
        ); 
        

        update_post_meta( $freelancer_id , 'feedback_fr', $fr_feedback );

        $message = esc_html__('Successful freelancer reviews', 'freeagent');
                        

    } 
        
    wp_send_json_success(compact('message'));
    
    
}