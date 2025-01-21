<div class="slider-content row elementor-repeater-item-<?php echo esc_attr( $item['_id'] );?>"> 
    <div class="testimonials_header col-xl-6 col-lg-6 col-12">
        <div class="testimonials-avatar <?php if(empty($item['image']['id'])) echo 'no_thumbnail';?>">
        <a class="testimonial_vid" href="<?php echo ''.$url;?>">
        <div class="play jws-icon-play"></div>
         <?php if(!empty($item['image']['id'])){
            if (function_exists('jws_getImageBySize')) {
                $attach_id = $item['image']['id'];
                $img = jws_getImageBySize(array('attach_id' => $attach_id,'thumb_size' => $image_size,  'class' => 'image_size_2'));
                echo !empty($img['thumbnail']) ? $img['thumbnail'] : '';
            }
         }
         ?> 
         </a>
        </div>
    </div> 
    <div class="jws_testimonial_content col-xl-6 col-lg-6 col-12"> 
        <div class="info">
            <p class="testimonials_title"><?php echo ''.$item['list_name'].', '.$item['list_job'];; ?></p>
            <img class="logo_company" src="<?php if(!empty($item['logo']['id'])) echo ''.$item['logo']['url'];?>"/>
        </div>
        <h3 class="testimonials-description"><?php echo ''.$item['list_description']; ?></h3>
    </div>      
</div>

