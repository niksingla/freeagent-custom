<a href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>>
    <?php
    if(!empty($settings['info_serial'])){
       echo '<div class="info_serial">'.$settings['info_serial'].'</div>'; 
    }
    ?>
    <div class="jws_box">
        <?php if(!empty($settings['image']['id'])) echo '<div class="box-icon">'.\Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings ).'</div>';?> 
        
        <div class="box-content">
    
           <h5 class="box-title">
          <?php echo esc_html($settings['info_title']); ?>
        </h5>
            <?php echo ''.$settings['info_content']; ?>
                <?php if(!empty($settings['info_readmore'])):?>
        <div class="box-more">
           <?php echo '<span class="text">'.esc_html($settings['info_readmore']).'</span>'; ?><i class="ion-ios-arrow-thin-right"></i>
        </div>
        <?php endif;?>
        </div>
    </div>
</a>