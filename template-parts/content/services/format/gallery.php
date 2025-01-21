<?php 
 $image_size = '800x504';
 $gallery = get_post_meta(get_the_ID(), 'service_gallery', true);
echo '<div class="jws-post-gallery post-image-slider swiper"><div class="swiper-wrapper">';

	// Loop through them and output an image
     if (function_exists('jws_getImageBySize')) {
         $attach_id = get_post_thumbnail_id();
         $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
         echo ''.(!empty($img['thumbnail'])) ? '<div class="jws-post-gallery-item swiper-slide"><a href="'.get_permalink().'">'.$img['thumbnail'].'</a></div>' : '';
     }
	foreach ( $gallery as $attachment_id ) {
		echo '<div class="jws-post-gallery-item swiper-slide"><a href="'.get_permalink().'">';
		 if (function_exists('jws_getImageBySize')) {

                 $img = jws_getImageBySize(array('attach_id' => $attachment_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                 echo ''.$img['thumbnail'];
        
        }
         
		echo '</a></div>';
	}
    
	echo '</div>
    
    <div class="swiper-pagination"></div>
    </div>';
 ?>