<div class="jws-banner-inner">
    <div class="left">
        <div class="jws-banner-image">
            <?php 
             if($settings['show_number']=='yes'){
              echo ''.$number;  
            }elseif(!empty($item['image']['id'])){
                $icon = $item['image']['url'];
                $tmp = explode('.', $icon);
                $file_ext = end($tmp);
    			if( $file_ext == 'svg' ) {
                    if(function_exists('output_ech')) {
                        $svg =jws_get_inline_svg($item['image']['id']);
                        echo ''.$svg; 
                    }
    			} else { 
    			    echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );
               
               } 
            } ?>
            
           
        </div>
        <div class="jws-banner-content">
            <?php if(!empty($item['link_url']['url'])) echo ' <a '.$this->get_render_attribute_string($link_key).'>';?>
            <h5 class="text-1">
                <?php echo ''.$item['text1']; ?>
               
            </h5>
            <?php if(!empty($item['link_url']['url'])) echo '</a>';?>
            <div class="text-2"><?php echo ''.$item['text2']; ?>        
            </div>
        </div>
    </div>   
    <div class="right">
        <?php
            if(!empty($item['link_url']['url'])){
                echo ' <a '.$this->get_render_attribute_string($link_key).'><span class="jws-icon-arrowcircleright"></span></a>';
            }
        ?>
    </div>
</div>