<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_reason_delete_user() {
  
		$labels = array(
			'name'                => _x( 'Reason Delete User', 'Post Type General Name', 'freeagent' ),
			'singular_name'       => _x( 'Reason Delete User', 'Post Type Singular Name', 'freeagent' ),
			'menu_name'           => esc_html__( 'Reason Delete User', 'freeagent' ),
			'parent_item_colon'   => esc_html__( 'Parent Item:', 'freeagent' ),
			'all_items'           => esc_html__( 'Reason Delete User', 'freeagent' ),
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
                'show_in_menu'		=> 'users.php',
				'map_meta_cap' => true,
			);


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'reason_delete_user', $args );
        }


	};
add_action( 'init', 'jws_register_reason_delete_user', 1 );

if(function_exists('jws_meta_boxs'))  jws_meta_boxs('reason_delete_user_add_post_meta_boxes');


function reason_delete_user_add_post_meta_boxes() {
  
  
  if(function_exists('jws_a_meta_boxs')) jws_a_meta_boxs(
   
   	'reason_delete_user-detail',   
	esc_html__( 'Detail', 'freeagent' ),
	'reason_delete_user_detail_meta_box',
	'reason_delete_user',
	'normal', 
	'default'    
  
  );	


}

function reason_delete_user_detail_meta_box( $post ) { ?>
		
  <?php wp_nonce_field( basename( __FILE__ ), 'reason_delete_user_detail_nonce' ); 
  $post_id =  $post->ID;
  
  $reason_deactivate = get_post_meta($post_id,'reason_deactivate',true);
  $reason_deactivate_des = get_post_meta($post_id,'reason_deactivate_des',true);
  
  ?>
     
     <div class="jws-meta-box">
     
     
        <div class="custom-row">
              <label><?php echo __( "Reason Deactivate", 'freeagent' ); ?></label>
              <div><?php echo esc_html($reason_deactivate); ?></div>
        </div>
        
        <div class="custom-row">
              <label><?php echo __( "Reason Deactivate Description", 'freeagent' ); ?></label>
              <div><?php echo esc_html($reason_deactivate_des); ?></div>
        </div>
        
        
     </div>   
  
  
  
  
  <?php

}  