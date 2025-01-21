
    <div class="box-icon">
       <?php echo ''.$settings['info_serial'];?>
    </div>
        <div class="info_content">
        <?php if(!empty($settings['info_title'])):?>
         <a href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>>
            <h6 class="box-title">
                <?php echo ''.$settings['info_title']; ?>
            </h6>
        </a>
        <?php endif;?>
        <?php if(!empty($settings['info_content'])):?>
        <div class="box-content">
            <?php echo ''.$settings['info_content']; ?>
        </div>
        <?php endif;?>
        <?php if(!empty($settings['info_readmore'])):?>
        <div class="box-more">
            <a href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>>
               <?php echo esc_html($settings['info_readmore']); ?><i class="ion-ios-arrow-thin-right"></i>
           </a>
        </div>
         <?php endif;?>
    </div>
