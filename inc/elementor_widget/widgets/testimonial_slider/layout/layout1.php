<div class="slider-content  elementor-repeater-item-<?php echo esc_attr( $item['_id'] );?>">
<div class="footer_testimonial">
        <div class="testimonials-avatar <?php if(empty($item['image']['id'])) echo 'no_thumbnail';?>">
         <?php if(!empty($item['image']['id'])){
            if (function_exists('jws_getImageBySize')) {
                $attach_id = $item['image']['id'];
                $img = jws_getImageBySize(array('attach_id' => $attach_id,'thumb_size' => $image_size,  'class' => 'image_size_2'));
                echo !empty($img['thumbnail']) ? $img['thumbnail'] : '';
            }
         }else{
           echo '<i class="jws-icon-left-quote-1"></i>';
         } 
         ?> 
        </div>
       <div class="testimonials-info">
           <h5 class="testimonials_title"><?php echo ''.$item['list_name']; ?></h5>
           <p class="testimonials_job"><?php echo ''.$item['list_job']; ?></p>  
       </div>  
  </div>
    <div class="header_testimonial">
         <span class="average-rating">
           <span class="jws-star-rating"><span class="jws-star-rated" style="width:100%"></span></span>
        </span>  
    </div>
    <div class="testimonials-description"><?php echo ''.$item['list_description']; ?></div>
         
</div>

