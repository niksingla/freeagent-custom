<div class="jws-services-inner"> 
    <div class="jws-service-images">
   
    <?php
    jws_button_service_save( get_the_ID() );
    $gallery_ids =  get_post_meta(get_the_ID(), 'service_gallery', true);
    
    if($gallery_ids){
        include( 'format/gallery.php' );
    }else{
        echo ' <a href="'.get_permalink().'">';
        if (function_exists('jws_getImageBySize')) {
                 $attach_id = get_post_thumbnail_id();
                 $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                 echo (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '<img src="' . get_template_directory_uri() . '/assets/image/placeholder-image.webp" alt="Placeholder Image">';
              
                 }else {
                 echo ''.$img = get_the_post_thumbnail(get_the_ID(), $image_size);
          }
               echo '</a>';
        }
 
    ?>
    </div>
    <div class="jws-service-content">
       <h6 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php  echo ''.(!empty($settings['title_length'])) ? wp_trim_words( get_the_title(), $settings['title_length'], $settings['title_more'] ) : get_the_title();?></a></a></h6> 
        <div class="services_infor">
        <?php echo esc_html__('by','freeagent').'<a href="'.$freelancer_permalink.'"><strong> '.$display_name.'</strong></a>';
       $services_cat =get_the_terms( get_the_id(),'services_cat');
        if ($services_cat && !is_wp_error($services_cat)) {
            
        $listings_link = get_post_type_archive_link('services') . '?services_cat';
         echo esc_html__(' in ','freeagent').'<strong>';
          foreach ($services_cat as $term) {
            echo '<a href="' . esc_url($listings_link.'='.$term->slug). '" rel="tag" class="hidden-term">' . esc_html($term->name) . '</a>';
          }
        echo '</strong>';
        }
        ?>
        </div>
        
        <div class="sale_info">
            <div class="from"><?php  echo esc_html__('From ','freeagent')?> <strong class="price"><?php echo ''.$price_html;?></strong></div>
            <div class="sale"><?php                    
                echo sprintf(
                		'%s  <span>%s</span>',
                        $sale_number,
                        esc_html__('Sales','freeagent')
                   );
                   ?>
            </div>
        </div>
    </div>

</div>