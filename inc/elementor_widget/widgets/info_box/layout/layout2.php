
    <div class="box-icon">
        <?php if(!empty($settings['image']['id'])) echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings );?> 
    </div>
        <div class="info_content">
         <span class="info_serial"><?php echo ''.$settings['info_serial'];?> </span>
        <h6 class="box-title">
            <?php echo ''.$settings['info_title']; ?>
        </h6>
        <div class="box-content">
            <?php echo ''.$settings['info_content']; ?>
        </div>
        <?php if(!empty($settings['info_readmore'])):?>
        <div class="box-more">
            <a href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>>
               <?php echo esc_html($settings['info_readmore']); ?><i class="ion-ios-arrow-thin-right"></i>
           </a>
        </div>
        <?php endif;?>
    </div>
