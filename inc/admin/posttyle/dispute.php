<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_dispute() {
  
		$labels = array(
			'name'                => _x( 'Dispute', 'Post Type General Name', 'freeagent' ),
			'singular_name'       => _x( 'Dispute', 'Post Type Singular Name', 'freeagent' ),
			'menu_name'           => esc_html__( 'Dispute', 'freeagent' ),
			'parent_item_colon'   => esc_html__( 'Parent Item:', 'freeagent' ),
			'all_items'           => esc_html__( 'Dispute', 'freeagent' ),
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
                  'menu_icon'           => 'dashicons-format-status',
				'capabilities' => array(
				    'create_posts' => false,
				),
				'map_meta_cap' => true,
			);


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'jws_dispute', $args );
        }


	};
add_action( 'init', 'jws_register_dispute', 1 );



add_action( 'save_post', 'dispute_save_post_meta_boxes' , 10, 2 );

function dispute_save_post_meta_boxes($post_id, $post) {
      if ( !isset( $_POST['dispute_detail_nonce'] ) || !wp_verify_nonce( $_POST['dispute_detail_nonce'], basename( __FILE__ ) ) ) return $post_id;
        
       $post_type = get_post_type_object( $post->post_type );
       
       $author_id = get_post_field( 'post_author', $post_id );
       
       $dispute_person =  get_post_meta($post_id,'dispute_person',true); 
       
       $type = get_post_meta($post_id,'dispute_type',true);
        
       if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) return $post_id;
       
	   if(isset($_POST['dispute_winner'])){
	       
    	  update_post_meta($post_id,'dispute_winner',$_POST['dispute_winner']);
          
          if(!empty($_POST['dispute_winner'])) {
            
            update_post_meta($post_id,'dispute_status','completed');
            
            //$active_profile = get_user_meta($_POST['dispute_winner'],'_active_profile', true);
            $current_wallet = get_user_meta($_POST['dispute_winner'],'current_wallet_amount', true); 
            $refund_price = 0;
            if($type == 'services') {
            	$service =  get_post_meta($post_id,'dispute_service',true); 
                $refund_price = get_post_meta($service,'order_amount', true);  
            }elseif($type == 'jobs') {
                
                
                $job =  get_post_meta($post_id,'dispute_job',true); 
                $refund_price = get_post_meta($job, 'job_cost_hired', true); 
                
            }
            
            $new_wallet_amount = (int) $current_wallet + (int) $refund_price;
            update_user_meta($_POST['dispute_winner'], 'current_wallet_amount',$new_wallet_amount);
              
            
            
          }else {
            
            
            update_post_meta($post_id,'dispute_status','pending');
            
            
          }
          
      }

}

if(function_exists('jws_meta_boxs'))  jws_meta_boxs('dispute_add_post_meta_boxes');


function dispute_add_post_meta_boxes() {
  
  
  if(function_exists('jws_a_meta_boxs')) jws_a_meta_boxs(
   
   	'dispute-detail',   
	esc_html__( 'Dispute Detail', 'freeagent' ),
	'dispute_detail_meta_box',
	'jws_dispute',
	'normal', 
	'default'    
  
  );	


}


function dispute_detail_meta_box( $post ) { ?>
		
  <?php wp_nonce_field( basename( __FILE__ ), 'dispute_detail_nonce' ); 

	$post_id =  $post->ID;
	$author_id = get_post_field( 'post_author', $post_id );
    $dispute_person =  get_post_meta($post_id,'dispute_person',true); 
    
	?>
    <div class="jws-meta-box">
        <?php $dispute_status =  get_post_meta($post_id,'dispute_status',true);  ?>
       
        <div class="custom-row">
            <?php 
            
    			$winner = get_post_meta($post_id,'dispute_winner',true);
              
                if(!empty($winner)) {
                    
                    ?>
                    <label><?php echo __( "The winner", 'freeagent' ); ?></label>
                    <?php
                  
                    echo get_the_author_meta( 'display_name', $winner );
                    
                } else {
              
                    ?>
                    <label><?php echo __( "Select the winner", 'freeagent' ); ?></label>
                    <select name="dispute_winner">
                        <option value=""><?php echo esc_html__('None','freeagent') ?></option>    
                        <option value="<?php echo esc_attr($author_id); ?>" <?php selected($winner, $author_id , true); ?>><?php  echo get_the_author_meta( 'display_name', $author_id ); ?></option>
                        <option value="<?php echo esc_attr($dispute_person); ?>" <?php selected($winner, $dispute_person , true); ?>><?php echo get_the_author_meta( 'display_name', $dispute_person ); ?></option>
                    </select>
                    <?php
                    
                } ?>
    	
        </div>
       
        
        <div class="custom-row">
            <label><?php echo __( "Dispute Type", 'freeagent' ); ?></label>
            <?php 
    			$type = get_post_meta($post_id,'dispute_type',true);
                echo ''.$type;
    		?>
        </div> 
        
        <?php if($type == 'jobs') { ?>
            
            <div class="custom-row">
                <label><?php echo __( "Job", 'freeagent' ); ?></label>
                <?php
        			$job =  get_post_meta($post_id,'dispute_job',true); 
                    echo '<a href="'.esc_url(admin_url("/post.php?post={$job}&action=edit")).'" target="_blank">'.get_the_title($job).'</a>';
        		?>
            </div>
            
        <?php } else { ?>
            
            <div class="custom-row">
                <label><?php echo __( "Service", 'freeagent' ); ?></label>
                <?php
        			$service =  get_post_meta($post_id,'dispute_service',true); 
                    echo '<a href="'.esc_url(admin_url("/post.php?post={$service}&action=edit")).'" target="_blank">'.get_the_title($service).'</a>';
        		?>
            </div>     
            
        <?php } ?>
       
        <div class="custom-row">
            <label><?php echo __( "Description", 'freeagent' ); ?></label>
            <textarea>
              <?php
    			echo get_post_meta($post_id,'dispute_description',true); 
    		  ?>
            </textarea>
        </div>
        
    
        <div class="custom-row">
            <label><?php echo __( "Sender disputes", 'freeagent' ); ?></label>
            <?php
           
             echo get_the_author_meta( 'display_name', $author_id );	
    		?>
        </div>
        
        <div class="custom-row">
            <label><?php echo __( "Recipient disputes", 'freeagent' ); ?></label>
            <?php
             
             echo get_the_author_meta( 'display_name', $dispute_person );	
    		?>
        </div>
        <div class="custom-row">
            <label><?php echo __( "View chat", 'freeagent' ); ?></label>
            <?php
                $chat_all = get_posts(array(
                        'posts_per_page'  => -1,
                        'fields'          => 'ids',
            			'post_type' =>'jws_chat',	
            			'post_status' => 'publish',
            			'orderby' => 'date',
            			'order'   => 'DESC',
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                               'relation' => 'OR',
                               array(
                                    'key'     => 'sender',
                                    'value'   => intval( $author_id ),
                                    'compare' => '=',
                                ),
                                array(
                                    'key'     => 'receiver',
                                    'value'   => intval( $author_id ),
                                    'compare' => '=',
                                ),
                            
                            ),
                            array(
                               'relation' => 'OR',
                               array(
                                    'key'     => 'sender',
                                    'value'   => intval( $dispute_person ),
                                    'compare' => '=',
                                ),
                                array(
                                    'key'     => 'receiver',
                                    'value'   => intval( $dispute_person ),
                                    'compare' => '=',
                                ),
                            
                            )
                        ), 
               ));
               if(!empty($chat_all)) {
                 
                 foreach($chat_all as $id) {
                    echo '<a href="' . esc_url(admin_url("/post.php?post={$id}&action=edit")) . '" target="_blank">'.esc_html__('View chat','freeagent').'</a>';
                 }
                
               }
              
    		?>
        </div>
    </div>
    
<?php }


function jws_add_column_dispute($columns) {
    $columns['sender_disputes'] = 'Sender disputes';
    $columns['recipient_disputes'] = 'Recipient disputes';
    $columns['type'] = 'Type';
    $columns['status'] = 'Status';
    $columns['winner'] = 'The winner';
    return $columns;
}
add_filter('manage_edit-jws_dispute_columns', 'jws_add_column_dispute');

// Populate the custom column with thumbnail images for jobs category taxonomy
function jws_display_column_content_dispute( $column, $post_id ) {

    if ($column == 'sender_disputes') {
        $author_id = get_post_field( 'post_author', $post_id );
        echo get_the_author_meta( 'display_name', $author_id );	
    }
    if ($column == 'recipient_disputes') {
        $user_data =  get_post_meta($post_id,'dispute_person',true); 
        echo get_the_author_meta( 'display_name', $user_data );	
    }
    
    if ($column == 'type') {
        $type = get_post_meta($post_id,'dispute_type',true);
        echo $type;
    }
    
    
    if ($column == 'status') {
        $dispute_status =  get_post_meta($post_id,'dispute_status',true); 
        echo $dispute_status;
    }
    if ($column == 'winner') {
         $dispute_winner =  get_post_meta($post_id,'dispute_winner',true); 
        echo get_the_author_meta( 'display_name', $dispute_winner );	
    }
   
}
add_action('manage_jws_dispute_posts_custom_column', 'jws_display_column_content_dispute', 10, 2);