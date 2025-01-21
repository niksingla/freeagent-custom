<div class="jws-banner-inner">
    
        <div class="jws-banner-image">
            <?php 
          
            if($settings['show_number']=='yes'){
              echo ''.$number;  
            }elseif(!empty($item['image']['id'])){
                $image_size = $settings['image_size']['width'].'x'.$settings['image_size']['height'];
                if (function_exists('jws_getImageBySize') && !empty($settings['image_size']['width'])&& !empty($settings['image_size']['height'])) {
                     $attach_id = $item['image']['id'];
                     $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                     echo (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
            
                     }else {
			         echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );
                }
            } ?>
            
           
        </div>
        <div class="jws-banner-content">
        <?php 
    
        if(!empty($item['link_url']['url'])) echo ' <a '.$this->get_render_attribute_string($link_key).'>';?>
        <h5 class="text-1">
            <?php echo ''.$item['text1']; ?>
           
        </h5>
        <?php 
       
        if(!empty($item['link_url']['url'])) echo '</a>';?>
        <div class="text-2"><?php echo ''.$item['text2']; ?></div>
        <?php
        if(!empty($item['link_url']['url'])){
            echo ' <a '.$this->get_render_attribute_string($link_key).' class="btn_view"><span class="jws-icon-circle-right"></span>'.$item['text3'].'</a>';
        }
        ?>
       
        </div>
        
    
</div>