<?php  
global $jws_option;
wp_enqueue_script('swiper');
$image_size = (isset($jws_option['single_blog_imagesize']) && !empty($jws_option['single_blog_imagesize'])) ? $jws_option['single_blog_imagesize'] : 'full';
 $gallery = get_post_meta(get_the_ID(), 'image_gallery_list', true);
echo '<div class="jws-post-gallery post-image-slider swiper"><div class="swiper-wrapper">';
	// Loop through them and output an image
     if (function_exists('jws_getImageBySize')) {
         $attach_id = get_post_thumbnail_id();
         $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
         echo ''.(!empty($img['thumbnail'])) ? '<div class="jws-post-gallery-item swiper-slide">'.$img['thumbnail'].'</div>' : '';
     }
	foreach ( $gallery as $attachment_id ) {
		echo '<div class="jws-post-gallery-item swiper-slide">';
		 if (function_exists('jws_getImageBySize')) {

                 $img = jws_getImageBySize(array('attach_id' => $attachment_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                 echo ''.$img['thumbnail'];
        
        }
         
		echo '</div>';
	}
	echo '</div></div>';
 ?>