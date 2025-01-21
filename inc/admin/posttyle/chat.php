<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_chat() {
  
		$labels = array(
			'name'                => _x( 'Chat Manager', 'Post Type General Name', 'freeagent' ),
			'singular_name'       => _x( 'Chat Manager', 'Post Type Singular Name', 'freeagent' ),
			'menu_name'           => esc_html__( 'Chat', 'freeagent' ),
			'parent_item_colon'   => esc_html__( 'Parent Item:', 'freeagent' ),
			'all_items'           => esc_html__( 'Chat', 'freeagent' ),
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
                'menu_icon'           => 'dashicons-format-chat',
				'capabilities' => array(
				    'create_posts' => false,
				),
				'map_meta_cap' => true,
			);


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'jws_chat', $args );
        }


	};
add_action( 'init', 'jws_register_chat', 1 );

if(function_exists('jws_meta_boxs'))  jws_meta_boxs('chat_add_post_meta_boxes');


function chat_add_post_meta_boxes() {
  
  
  if(function_exists('jws_a_meta_boxs')) jws_a_meta_boxs(
   
   	'chat-detail',   
	esc_html__( 'Chat Detail', 'freeagent' ),
	'chat_detail_meta_box',
	'jws_chat',
	'normal', 
	'default'    
  
  );	


}

function chat_detail_meta_box( $post ) {
    
    
$post_id =  $post->ID;
$jws = new Jws_Dashboard_Chat;
?><div class="chat-admin"><?php
ob_start(); 
$jws->get_chat_list($post_id);
$result = ob_get_clean(); 
echo $result;   

?></div><?php
 
}