<?php
$icon =$settings['image']['url'];

?>
<a href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>>
    <div class="box-icon">
     <?php

         if(!empty($icon)) :
         
         
        
          ?>
         	<?php 
              $tmp = explode('.', $icon);
                    $file_ext = end($tmp);
			if( $file_ext == 'svg' ) {
			  
                ?> 
                    <?php
                    if(function_exists('output_ech')) {
                         echo jws_get_inline_svg($settings['image']['id']);
                        
                    }
                 ?><?php
			} else { ?>
    
			     <img src="<?php echo esc_url($icon); ?>" />
   
            <?php } endif; ?>
        
        
    </div>
    <p class="info_serial"><?php echo ''.$settings['info_serial'];?></p>
    <h6 class="box-title">
       <?php echo esc_html($settings['info_title']); ?>
    </h6>
    <div class="box-content">
   
        <?php echo ''.$settings['info_content']; ?>
    </div>
  
    <div class="box-more">
       <?php echo '<span class="text">+</span>'; ?>
    </div>

</a>