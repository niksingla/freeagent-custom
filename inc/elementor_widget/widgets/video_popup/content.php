 <div class="jws_video_popup<?php echo esc_attr(' video-'.$settings['skins']); ?>">
        <div class="jws_video_popup_inner">
              <a href="<?php echo esc_url($url); ?>">
                   <span class="video_icon">
                   <span class="icon">
                   <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );  ?>
                   </span>
                        
                   </span>
                   
                 <?php echo (!empty($settings['text']))? '<span class="text">'.$settings['text'].'</span>': '';?> 
              </a>
              
        </div>            
</div>