<?php 
    
    if ( is_user_logged_in()) { 
        
        
        echo esc_html__('You are successfully logged in.','freeagent').esc_html__(' Go to ','freeagent').'<a class="btn-naked elementor-button" href="/dashboard">'.esc_html__(' Dashboard','freeagent').'</a>';
        
        
    } else {
      
    
        if($settings['layout'] == 'popup') {
            if(!empty($settings['icon']['value'])) {
               \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );  
            }  
        }
        ?>
            <div class="jws_login_form">
            <?php
                jws_get_content_form_login($show_login,$show_register,$active,$layouts);
            ?>
            </div>
        <?php  
        
        
    }

       
?>