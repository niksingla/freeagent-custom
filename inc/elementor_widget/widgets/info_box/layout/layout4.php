<a href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>>
    <div class="box-icon">
        <?php if(!empty($settings['image']['id'])) echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings );?> 
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