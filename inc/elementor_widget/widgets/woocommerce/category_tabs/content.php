<?php 
$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
 $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : '';
 
 
if($settings['display'] == 'grid') {
    $settings['columns_tablet'] = isset($settings['columns_tablet']) ? $settings['columns_tablet'] : $settings['columns'];
    $settings['columns_mobile'] = isset($settings['columns_mobile']) ? $settings['columns_mobile'] : $settings['columns'];
    $class_column = 'category-tab-item col-xl-' . $settings['columns'] . ' col-lg-' . $settings['columns_tablet'] . ' col-' . $settings['columns_mobile'] .'';
    $data_slick = '';
    $class_row = ' row';  
}else {
    $class_row = ' jws_product_category_list swiper  '.$show_inbox;
    $class_column = ' category-tab-item swiper-slide'; 
  }




if(!empty($settings['image_size']['width']) && !empty($settings['image_size']['height'])) {
    $image_size = $settings['image_size']['width'].'x'.$settings['image_size']['height'];
 }else {
    $image_size = 'full';
 } 

if(!empty($settings['image_size2']['width']) && !empty($settings['image_size2']['height'])) {
    $image_size2 = $settings['image_size2']['width'].'x'.$settings['image_size2']['height'];
 }else {
    $image_size2 = 'full';
 }  




?>
<div class="jws-category-list">
<div class="category-content<?php echo esc_attr($class_row.' '.$settings['layouts']); ?>">
  <?php if($settings['display'] == 'slider') echo '<div class="swiper-wrapper">';?>
  <?php
        if($settings['filter_categories']){
            $i = 0;
            foreach ($settings['filter_categories'] as $product_cat_slug) {
                $product_cat = get_term_by('slug', $product_cat_slug, 'product_cat');
                $selected = '';
                if(isset($product_cat->slug)){
                    if (isset($settings['wc_attr']['product_cat']) && $settings['wc_attr']['product_cat'] == $product_cat->slug) {
                        $selected = 'jws-selected';
                    }
                
                        ?>
                            <div class="<?php echo esc_attr($class_column); ?>">
                                <a href="<?php echo esc_url(get_term_link($product_cat->slug, 'product_cat')); ?>">
                                    <?php 
                                        if($settings['layouts'] == 'layout1') { 
                                            echo wp_get_attachment_image( get_term_meta( $product_cat->term_id, 'image2', 1 ), 'full' ); ?>
                                            <h4><?php echo esc_html($product_cat->name); ?></h4> 
                                            <p><?php echo esc_html($product_cat->count).esc_html__(' items','freeagent'); ?></p>  
                                        <?php 
                                        }elseif($settings['layouts'] == 'layout2') {?>
                                             <div class="category-image"> <?php  
                                             if (function_exists('jws_getImageBySize')) {
                                                 $attach_id = get_term_meta( $product_cat->term_id, 'thumbnail_id', 1 );
                                                 $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                                                 echo (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                                             }  ?>
                                             </div> 
                                            <h4><?php echo esc_html($product_cat->name); ?></h4> 
                                        <?php } elseif($settings['layouts'] == 'layout3') {
                                            
                                            if($i % 2 == 0){ 
                                               $size = $image_size;  
                                            }else{
                                               $size = $image_size2;   
                                            }
                                            
                                            ?>
                                             <div class="category-image"> <?php  
                                             if (function_exists('jws_getImageBySize')) {
                                                 $attach_id = get_term_meta( $product_cat->term_id, 'thumbnail_id', 1 );
                                                 $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $size, 'class' => 'attachment-large wp-post-image'));
                                                 echo (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                                             }  ?>
                                             </div> 
                                            <h6 class="cate_title"><?php echo esc_html($product_cat->name); ?></h6> 
                                            <p><?php echo esc_html($product_cat->count).esc_html__(' items','freeagent'); ?></p> 
                                        <?php }elseif($settings['layouts']=='layout4'){
                                            ?>
                                                <span><?php echo esc_html($product_cat->name); ?></span>
                                                <span class="cat_count">(<?php echo esc_html($product_cat->count); ?>)</span>
                                            <?php
                                        }
                                    ?>
                                </a>
                            </div>
                        <?php

                }
                
            $i++; } 
        }
    ?>
    <?php if($settings['display'] == 'slider') echo '</div>';?>    
     <?php if($show_arrows && $settings['display'] == 'slider') : ?>
    <button class="elementor-swiper-button elementor-swiper-button-prev">
     <?php $this->render_swiper_button( $settings, 'prev' ); ?>
    </button>
    <button class="elementor-swiper-button elementor-swiper-button-next">
     <?php $this->render_swiper_button( $settings, 'next' ); ?>
    </button>
    <?php endif; ?>
    <?php  if($show_dots && $settings['display'] == 'slider') echo '<div class="swiper-pagination"></div>';?>

</div> 

</div>