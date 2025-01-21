<?php
global $post;
$attachment = get_post( $item['image']['id'] );
  $images = array(
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
    
    
?>
<div class="jws_gallery_inner">
    <?php
         if(!empty($item['link_url'])){
            echo '<a '.$this->get_render_attribute_string($link_key).'>';
         }
    ?>
    <div class="jws_gallery_image">
      <?php
        if(!empty($item['image']['id'])) echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );
      ?>
    </div>
    
    <div class="jws_gallery_content">
        <div class="jws_hover_content">
            <h6 class="title"><?php echo esc_html($images['title']);?></h6>
            <p class="description"><?php echo esc_html($images['description']);?></p>
        </div>
            
    </div>
    <?php   
      if(!empty($item['link_url'])){
        echo '</a> ';
      }
    ?>
</div>

