<div class="jws-banner-inner">
    <div class="header_infor">
        <?php if(!empty($item['link_url']['url'])) echo ' <a '.$this->get_render_attribute_string($link_key).'>';?>
            <h3 class="text-1">
                <?php echo ''.$item['text1']; ?>
            </h3>
        <?php if(!empty($item['link_url']['url'])) echo '</a>';?>
        <div class="jws-banner-image">
            <?php 
          
            if($settings['show_number']=='yes'){
              echo ''.$number;  
            }elseif(!empty($item['image']['id'])){
  			   echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );
            } ?>
                
               
            </div>

        </div>
        <div class="jws-banner-content">
        <div class="text-2"><?php echo ''.$item['text2']; ?></div>
        <?php
        if(!empty($item['link_url']['url'])){
            echo ' <a '.$this->get_render_attribute_string($link_key).' class="btn_view"><span class="jws-icon-circle-right"></span>'.$item['text3'].'</a>';
        }
        ?>
       
        </div>
        
    
</div>