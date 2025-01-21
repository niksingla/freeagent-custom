<div class="jws-banner-inner">
    
        <div class="jws-banner-image">
            <?php 
             if($settings['show_number']=='yes'){
              echo ''.$number;  
            }elseif(!empty($item['image']['id'])){
			    echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );
            } ?>
            
           
        </div>
        <div class="jws-banner-content">
        <?php if(!empty($item['link_url']['url'])) echo ' <a '.$this->get_render_attribute_string($link_key).'>';?>
        <h5 class="text-1">
            <?php echo ''.$item['text1']; ?>
           
        </h5>
        <?php if(!empty($item['link_url']['url'])) echo '</a>';?>
        <div class="text-2"><?php echo ''.$item['text2']; ?>        
        <?php
        if(!empty($item['link_url']['url'])){
            echo ' <a '.$this->get_render_attribute_string($link_key).'>'.$item['text3'].'<span class="ion-ios-arrow-thin-right"></span></a>';
        }
        ?></div>

       
        </div>
        
    
</div>