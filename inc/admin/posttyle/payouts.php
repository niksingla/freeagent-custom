<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_payouts() {
  
		$labels = array(
			'name'                => _x( 'Payouts', 'Post Type General Name', 'freeagent' ),
			'singular_name'       => _x( 'Payouts', 'Post Type Singular Name', 'freeagent' ),
			'menu_name'           => esc_html__( 'Payouts', 'freeagent' ),
			'parent_item_colon'   => esc_html__( 'Parent Item:', 'freeagent' ),
			'all_items'           => esc_html__( 'Payouts', 'freeagent' ),
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
				'supports'          => array( 'title','author'),
				'public'            => true,
		        'has_archive'       => false,
		        'publicly_queryable' => false,
				'show_in_rest'		=> true,
                'menu_icon'           => 'dashicons-bank',
				'capabilities' => array(
				    'create_posts' => false,
				),
				'map_meta_cap' => true,
			);


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'jws_payouts', $args );
        }


	};
add_action( 'init', 'jws_register_payouts', 1 );

add_filter('manage_edit-payouts_columns', 'payouts_columns_id');
add_action('manage_payouts_posts_custom_column', 'payouts_custom_columns', 5, 2);

function payouts_columns_id() {
    
    
}

function payouts_custom_columns() {
    
    
}


if(function_exists('jws_meta_boxs'))  jws_meta_boxs('payouts_add_post_meta_boxes');

add_action( 'save_post', 'payouts_save_post_meta_boxes' , 10, 2 );

function payouts_save_post_meta_boxes($post_id, $post) {
      if ( !isset( $_POST['payouts_detail_nonce'] ) || !wp_verify_nonce( $_POST['payouts_detail_nonce'], basename( __FILE__ ) ) )
	  return $post_id;
        
       $post_type = get_post_type_object( $post->post_type );
        
       if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) return $post_id;
	  
      $author_id = get_post_field( 'post_author', $post_id );
      
      if(isset($_POST['payout_status']))
    	{
    	  update_post_meta($post_id,'payout_status','completed');
    	}
    	else
    	{
    		update_post_meta($post_id,'payout_status','pending');	
    	}
}

function payouts_add_post_meta_boxes() {
  
  if(function_exists('jws_a_meta_boxs')) jws_a_meta_boxs(
   
   	'payout-detail',   
	esc_html__( 'Payouts Detail', 'freeagent' ),
	'payouts_detail_meta_box',
	'jws_payouts',
	'normal', 
	'default' 
  
  );
  
  if(function_exists('jws_a_meta_boxs')) jws_a_meta_boxs(
   
   	'payout_payment',
    esc_html__( 'User Payout Methods', 'freeagent' ),
    'payouts_payment_methods_meta_box',
    'jws_payouts',
    'side',
    'default'
  
  );

}

function payouts_payment_methods_meta_box($post) {
    
     wp_nonce_field( basename( __FILE__ ), 'payouts_payment_methods' ); 
     $post_id =  $post->ID;
	 $author_id = get_post_field( 'post_author', $post_id );
     
    $payment_default = get_post_meta($post_id,'payout_method',true);
    $payment_default = !empty($payment_default) ? $payment_default : 'paypal';
    $paypal = get_user_meta($author_id,'paypal_info', true);
    $payoneer = get_user_meta($author_id,'payoneer_info', true);
    $bank = get_user_meta($author_id,'bank_info', true);
   
    
    ?>
    <div class="payment-nav">
      <a href="#paypal-tab" class="<?php if($payment_default == 'paypal') echo ' active';?>"><?php echo esc_html__('Paypal','freeagent'); ?></a>
      <a href="#payoneer-tab" class="<?php if($payment_default == 'payoneer') echo ' active';?>"><?php echo esc_html__('Payoneer','freeagent'); ?></a>
      <a href="#bank-tab" class="<?php if($payment_default == 'bank') echo ' active';?>"><?php echo esc_html__('Bank','freeagent'); ?></a>
    </div>
    <div class="payment-tab">
    <div id="paypal-tab" class="tab<?php if($payment_default == 'paypal') echo ' active';?>"> 
       
       <ul>
            <li>
                <label><?php echo esc_html__('Paypal email','freeagent'); ?></label>
                <input type="text" value="<?php echo isset($paypal['paypal_email']) ? $paypal['paypal_email'] : ''; ?>" disabled="disabled" />
            </li> 
       </ul>
    
    </div>
    
    <div id="payoneer-tab" class="tab<?php if($payment_default == 'payoneer') echo ' active';?>"> 
       
       <ul>
            <li>
                <label><?php echo esc_html__('Payoneer email','freeagent'); ?></label>
                <input type="text" value="<?php echo isset($payoneer['payoneer_email']) ? $payoneer['payoneer_email'] : ''; ?>" disabled="disabled" />
            </li> 
       </ul>
    
    </div>
    
    <div id="bank-tab" class="tab<?php if($payment_default == 'bank') echo ' active';?>"> 
    
         <ul>
            <li>
                <label><?php echo esc_html__('Bank account name','freeagent'); ?></label>
                <input type="text" value="<?php echo isset($bank['bank_ac_name']) ? $bank['bank_ac_name'] : ''; ?>" disabled="disabled" />
            </li> 
            <li>
                <label><?php echo esc_html__('Bank account number','freeagent'); ?></label>
                <input type="text" value="<?php echo isset($bank['bank_ac_number']) ? $bank['bank_ac_number'] : ''; ?>" disabled="disabled" />
            </li> 
            <li>
                <label><?php echo esc_html__('Bank name','freeagent'); ?></label>
                <input type="text" value="<?php echo isset($bank['bank_name']) ? $bank['bank_name'] : ''; ?>" disabled="disabled" />
            </li>
            <li>
                <label><?php echo esc_html__('Bank routing number','freeagent'); ?></label>
                <input type="text" value="<?php echo isset($bank['bank_routing_number']) ? $bank['bank_routing_number'] : ''; ?>" disabled="disabled" />
            </li>
            <li>
                <label><?php echo esc_html__('Bank IBAN','freeagent'); ?></label>
                <input type="text" value="<?php echo isset($bank['bank_iban']) ? $bank['bank_iban'] : ''; ?>" disabled="disabled" />
            </li>
            <li>
                <label><?php echo esc_html__('Bank BIC/SWIFT','freeagent'); ?></label>
                <input type="text" value="<?php echo isset($bank['bank_sw']) ? $bank['bank_sw'] : ''; ?>" disabled="disabled" />
            </li>
        </ul>
    </div>    
    </div>
    <?php
     
    
}


function payouts_detail_meta_box( $post ) { ?>
		
	  <?php wp_nonce_field( basename( __FILE__ ), 'payouts_detail_nonce' ); 
		//print_r($post);
		$post_id =  $post->ID;
		$author_id = get_post_field( 'post_author', $post_id );
		?>
        <div class="custom-row">
            <label><?php echo __( "Payout Amount", 'freeagent' ); ?></label>
            <?php 
				echo jws_format_price(get_post_meta($post_id,'payout_amount',true));
			?>
        </div> 
        
        
        <div class="custom-row">
            <label><?php echo __( "Payout Status", 'freeagent' ); ?></label>
            <?php
				echo get_post_meta($post_id,'payout_status',true); 
			?>
        </div>
        <div class="custom-row">
            <label><?php echo __( "Payout Method", 'freeagent' ); ?></label>
            <?php
				echo get_post_meta($post_id,'payout_method',true); 
			?>
        </div>
        <div class="custom-row">
            <label><?php echo __( "Mark Payout as processed", 'freeagent' ); ?></label>
            	<?php 
					$payout_status ='';
					$checked ='';
					$payout_status = get_post_meta($post_id, 'payout_status', true);
					
					if(isset($payout_status) && $payout_status == 'completed')
					{
						$checked =" checked='checked' disabled='disabled'";	
					}
				?>
            	<input type="checkbox" name="payout_status" <?php echo esc_attr($checked); ?> >
                <p><?php echo __( "Check this to mark it processed", "freeagent" ); ?></p>
        </div>
        
    <?php }
    
function add_featured_image_column_jws_payouts($defaults) {

    $defaults['price'] = 'Price';
  
    return $defaults;
}
add_filter('manage_jws_payouts_posts_columns', 'add_featured_image_column_jws_payouts');
 
function show_featured_image_column_jws_payouts($column_name, $post_id) {
    if ($column_name == 'price') {
      echo jws_format_price(get_post_meta($post_id,'payout_amount',true));
    }
   
}
add_action('manage_jws_payouts_posts_custom_column', 'show_featured_image_column_jws_payouts', 10, 2);     