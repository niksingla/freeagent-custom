<div class="jws-image_carousel-image <?php if($settings['enable_fullsize_image']=='yes') echo 'full_width'; ?>">
    <a <?php echo ''.$this->get_render_attribute_string($link_key); ?>>
        <?php
         $image_size = $settings['image_size'];
         $attach_id = $item['image']['id'];
         $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
         echo ''.$img['thumbnail'];
      ?>
    </a>
</div>