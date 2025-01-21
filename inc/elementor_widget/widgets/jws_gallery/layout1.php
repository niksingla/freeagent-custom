<div class="jws_gallery_inner">
    <div class="jws_gallery_image">
      <?php
      if(!empty($item['link_url'])){
        echo '<a '.$this->get_render_attribute_string($link_key).'>';
      }
      $image_attributes = wp_get_attachment_image_src( $item['image']['id'] );
      ?>  
      <?php 
        if(!empty($item['image']['id'])) echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); 
      ?>

          
      <?php
      if(!empty($item['link_url'])){
        echo '</a> ';
        }
        ?>   

    </div>
</div>