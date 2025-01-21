<?php 


$args = wp_parse_args( $args  );
  
extract( $args ); 
 $project_link = get_post_meta($id, 'project_link', true);
 $project_vid_link = get_post_meta($id, 'project_vid_link', true);
?>

<div class="portfolio-detail-page popup-global">

<?php 
 $image_size = '500x380';
 $gallery = get_post_meta($id, 'portfolio_attachments', true);

if (function_exists('jws_getImageBySize')) {
    
     $attach_id = get_post_thumbnail_id($id);
     $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
     echo (!empty($img['thumbnail'])) ? $img['thumbnail']: '';


}
  if(!empty($gallery)){
      foreach ( $gallery as $attachment_id ) {
            $image_url = wp_get_attachment_url($attachment_id);

       
         $img = jws_getImageBySize(array('attach_id' => $attachment_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
         echo (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';

      }
 
  }
 ?>
<!-- <h5 class="title"><?php echo get_the_title($id);?></h5> -->
<div class="link_portfolio">
<?php
if($project_link){
    echo '<div class="link"><label class="fw-500">'.esc_html__('Link','freeagent').': </label><a href="'.esc_url($project_link).'"> '.esc_url($project_link).'</a></div>';
}
if($project_vid_link){
    echo '<div class="link"><label class="fw-500">'.esc_html__('Link Video','freeagent').': </label><a href="'.esc_url($project_vid_link).'"> '.esc_url($project_vid_link).'</a></div>';
}
?>
</div>
<div class="description" style="text-align: ;"><?php echo get_the_content($id);?></div>

</div>