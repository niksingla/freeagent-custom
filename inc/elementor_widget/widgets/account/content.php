<?php 

$current_user_id = get_current_user_id();
$active_profile = get_user_meta($current_user_id,'_active_profile', true);

?>
<div class="jws_account">
    <?php
        if ( is_user_logged_in() || isset($_GET['p']) ) {
            $user_info  = get_userdata( get_current_user_id() );
        	$user_roles = $user_info->roles;
            
            if($active_profile == '1') {
                
                $user_p_id  = Jws_Custom_User::get_employer_id( $current_user_id );
                
            }
            
            if($active_profile == '2') {
                
                $user_p_id  = Jws_Custom_User::get_freelaner_id( $current_user_id );
                
            }
            
            ?>
             
             <a class="jws_ac_noajax has_user" href="<?php echo (!empty($url2)) ? esc_url($url2) : get_permalink( wc_get_page_id( 'myaccount' )); ?>" <?php echo esc_attr($target2.$nofollow2); ?>>
             <?php if($show_text && $settings['text_position'] == 'left'): ?>
                    <span class="jws_account_text text_position_<?php echo esc_attr($settings['text_position']);  ?>"><?php echo esc_html($text_after_login); ?></span>
             <?php endif; ?>
             <span class="jws_a_icon">
                 <?php
       
                    if ( isset($settings['icon']) && !empty($settings['icon']['value']) ) {
						\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
					} else{ ?>
					    <i class="jws-icon-account" aria-hidden="true"></i>   
					<?php }  
                 
                 ?> 
             </span>
              <?php if($show_text && $settings['text_position'] != 'left'): ?>
                    <span class="jws_account_text text_position_<?php echo esc_attr($settings['text_position']);  ?>">
                    <?php 
                     
                     if(isset($user_p_id)) {
                         
                         jws_image_advanced($user_p_id,'thumbnail');
                   
                         echo sprintf(
                          '%s %s <i class="jws-icon-caret-down"></i>',
                          esc_html__('Hi,','freeagent'),
                          get_the_title($user_p_id)
                         );
                        
                     } else {
                        
                        ?>
                          <?php echo esc_html($text_after_login); ?><i class="jws-icon-arrow_carrot-down"></i>
                        <?php
                        
                     }
                    
                     ?>
                    
                    
                    </span>
             <?php endif; ?>
             </a>
            
             
        <?php } else {
            ?>
               
                <a class="jws_ac_noajax no_user" href="<?php echo esc_url($url); ?>">
                <?php if($show_text && $settings['text_position'] == 'left'): ?>
                    <span class="jws_account_text text_position_<?php echo esc_attr($settings['text_position']);  ?>"><?php echo esc_html($text); ?></span>
                <?php endif; ?>
                <span class="jws_a_icon">
                    <?php
                         if ( isset($settings['icon']) && !empty($settings['icon']['value']) ) {
    						\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
    					} else{ ?>
    					    <i class="jws-icon-account" aria-hidden="true"></i>   
    					<?php } 
                 	?> 
                </span>
                <?php if($show_text && $settings['text_position'] != 'left'): ?>
                    <span class="jws_account_text text_position_<?php echo esc_attr($settings['text_position']);  ?>"><?php echo esc_html($text); ?><i class="jws-icon-arrow_carrot-down"></i></span>
                <?php endif; ?> 
                </a>
                 
            
       <?php }
    ?>
    <?php if(is_user_logged_in()) {

        ?>
        <div class="account-menu-dropdown">
           
               <?php 
               
                
                if($active_profile == '1' || $active_profile == '2') {
                    
                    $menu_class  = new Jws_user_dashboard_menu( $active_profile );
              
                    $menu_class->the_menu(array('name'=>'dashboard')); 

                    
                } else {
                    
                  	$out = '<ul>';
        
            		foreach ( wc_get_account_menu_items() as $endpoint => $label ) {
            			$out .= '<li class="' . wc_get_account_menu_item_classes( $endpoint ) . '"><a href="' . esc_url( wc_get_account_endpoint_url( $endpoint ) ) . '"><span>' . esc_html( $label ) . '</span></a></li>';
            		}
            
            		echo ''.$out . '</ul>';  
                    
                }

               ?>
          
        </div>
   <?php } ?> 
</div>