<?php

$listings_link = get_post_type_archive_link('jobs') . '?jobs_cat';
$term_link = esc_url($listings_link.'='.$term->slug);
?>
<div class="jws_job_wap">
    <div class="jws_job_image">
      <a href="<?php echo ''.$term_link; ?>">
        <?php 
         
         $thumbnail_id  = get_term_meta($term->term_id, 'port_icon_images', true); // Replace with your method of obtaining this value
      $image_url = wp_get_attachment_image_url($thumbnail_id, '32x32'); 
          if(isset($thumbnail_id)){
            $icon = $image_url;
            $tmp = explode('.', $icon);
            $file_ext = end($tmp);
           if( $file_ext == 'svg' ) {
            if(function_exists('output_ech')) {
                $svg =jws_get_inline_svg($thumbnail_id);
                echo ''.$svg;  
            }
           }else{
            if (function_exists('jws_getImageBySize')) {
             $attach_id = get_post_thumbnail_id();
             $img = jws_getImageBySize(array('attach_id' => $thumbnail_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
             echo ''.(!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
    
             }else{
               
               echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($term->name) . '" />';
             }
           }
          }     

        ?> 
      </a>   
    </div>
 <div class="jws_job_content">
     <h6 class="entry-title"><a href="<?php echo ''.$term_link; ?>"><?php echo esc_attr($term->name);?></a></h6>  
     <p class="totals"><?php echo ''.$count.esc_html__(' position','freeagent');?></p>

 </div>
</div>