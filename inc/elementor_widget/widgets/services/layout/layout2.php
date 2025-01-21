<?php
$listings_link = get_post_type_archive_link('services') . '?services_cat';
$term_link = esc_url($listings_link.'='.$term->slug);
?>

<div class="jws-services-inner"> 
    <div class="jws-service-images">
    <?php
    

    echo ' <a href="'.$term_link.'">';
    if (function_exists('jws_getImageBySize')) {
             $attach_id = get_term_meta($term->term_id, 'ser_icon_images', true);
             $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'service_icon attachment-large wp-post-image'));
             echo (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '<img src="' . get_template_directory_uri() . '/assets/image/placeholder-image.webp" alt="Placeholder Image">';
          
             }else {
             echo ''.$img = get_the_post_thumbnail(get_the_ID(), $image_size);
      }
      echo '</a>';
    ?>
    </div>
    <div class="jws-service-content">
        <p class="services_des"><?php echo esc_attr($term->description); ?></p>
       <h5 class="entry-title"><a href="<?php echo ''.$term_link; ?>"><?php echo esc_attr($term->name); ?></a></h5> 
    </div>
    <?php if(isset($jws_option['favicon']['url']) && !empty($jws_option['favicon']['url'])) echo '<a href="'.$term_link.'" class="btn_readmore"><img src="'.esc_url($jws_option['favicon']['url']).'" alt="'.esc_attr($term->name).'"></a>';?>

</div>