<?php 


global $jws_option;

$post_id = get_the_ID();
jws_gt_set_post_view();
$image_size='856x597';
$attach_id = get_post_thumbnail_id();
?>

<div class="container">

    <div class="row">
    
    
        <div class="col-lg-8 page_left">
           
           <div class="service-content">
             
             <div class="service-infomation">
                <div class="content_top">
                  <div class="service-category">
       
                       <?php 
                         $services_cat =get_the_terms( get_the_id(),'services_cat');
                         
                         
                        if ($services_cat && !is_wp_error($services_cat)) {
                            
                        $listings_link = get_post_type_archive_link('services') . '?services_cat';
                        
                          foreach ($services_cat as $term) {
                            echo '<a href="' . esc_url($listings_link.'='.$term->slug). '" rel="tag" class="hidden-term">' . esc_html($term->name) . '</a>';
                          }
                    
                        }
                    ?>

                    
                    </div>
                    <div class="action_right">
                        <div class="share">
                            <?php jws_freelance_share();?>
                            <a href="javascript:void(0);" class="btn_share"><i class="jws-icon-share"></i> <?php echo esc_html__('Share','freeagent');?></a>

                        </div>
                         <?php  jws_button_service_save( get_the_ID() );?>
                        <a href="javascript:void(0);" data-modal-jws="#submit-report" class="btn_report"> <i class="jws-icon-warning"></i></a>
                    </div>
                </div>
                
                
                
                <h1 class="post-title"><?php echo get_the_title(); ?></h1>
                
      
                <div class="service-meta">
                
                
            
                
                <div class="meta-author">
                  
                  <?php 
                  
                    $user_id = get_post_field( 'post_author', $post_id );
                    $freelancer_id  = Jws_Custom_User::get_freelaner_id( $user_id );
                    jws_image_advanced($freelancer_id,'thumbnail'); 
 
                  ?>
                  
                  <span class="fw-700"><a href="<?php echo get_the_permalink($freelancer_id); ?>"><?php echo get_the_title($freelancer_id); ?></a></span>
                  
                </div>
                
                <div class="meta-queue">
                   
                   <?php 
                      
                      $service_order = new WP_Query( 
                        	array( 
                        			'post_type' =>'service_order',
                        			'paged' => $paged,	
                        			'post_status' => 'publish'	,
                        			'orderby' => 'date',
                        			'order'   => 'DESC',
                                    'meta_query' => array(
                                        array(
                                            'key'     => 'service_id',
                                            'value'   => $post_id,
                                            'compare' => '=',
                                        ),
                                        array(
                                            'key'     => 'status',
                                            'value'   => 'hired',
                                            'compare' => '=',
                                        ),
                                    ),												
                        	)
                        );
                        $count = $service_order->found_posts;
                
                        echo sprintf(
                        		'%s <span>%s</span>',
                                $count,
                                esc_html__('Orders in queue','freeagent')
                    	);
                   
                     
                   ?>
               
                </div>
                <div class="meta-view">
                <?php 
                   echo sprintf(
                		'%s  <span>%s</span>',
                        jws_gt_get_post_view(),
                        esc_html__('Views','freeagent')
                   );
                   
                  ?>
                </div>
                <div class="meta-sale">
                  
                  <?php 
                   
                   $sale_number = get_post_meta($post_id, 'sale_number', true);
                   $sale_number = (!empty($sale_number))? $sale_number : 0;
                   echo sprintf(
                		'%s  <span>%s</span>',
                        $sale_number,
                        esc_html__('Sales','freeagent')
                   );
                   
                  ?>
                
                </div>
    
                
                </div>
             
             </div>
             <?php
             $gallery_ids =  get_post_meta($post_id, 'service_gallery', true);
             ?>
             <div class="post_thumbnail_gallery <?php if ($gallery_ids) echo 'gallery_swiper'?>">
             <?php
             
      
             if ($gallery_ids) {
                   wp_enqueue_script('swiper');

                    echo '<div class="box-swipe">
                    <div class="swiper-container swiper">';
                    echo '<div class="swiper-wrapper">';
                     echo '<div class="swiper-slide">';
                  		 if (function_exists('jws_getImageBySize')) {
                             $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                             echo ''.$img['thumbnail'];
                         }
                      echo '</div>';
                    // Loop through each image ID
                    foreach ($gallery_ids as $image_id) {
                        // Output the swiper slide
                        echo '<div class="swiper-slide">';
                 		 if (function_exists('jws_getImageBySize')) {
                             $img = jws_getImageBySize(array('attach_id' => $image_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                             echo ''.$img['thumbnail'];
                        }
                        echo '</div>';
                    }
                
                    echo '</div>';
                    

                    echo '</div>'; // Close main swiper-container
                    echo '<div class="jws-carousel-btn elementor-swiper-button-prev"><i aria-hidden="true" class="jws-icon-arrow-left-2"></i></div>';
                    echo '<div class="jws-carousel-btn elementor-swiper-button-next"><i aria-hidden="true" class="jws-icon-arrow-right-2"></i></div>';
                    echo '</div>';
                    // Output the swiper-thumbs container HTML
                    echo '<div class="swiper-container-thumbs swiper">';
                    echo '<div class="swiper-wrapper">';
                      echo '<div class="swiper-slide">';
                  		 if (function_exists('jws_getImageBySize')) {
                             $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                             echo ''.$img['thumbnail'];
                         }
                      echo '</div>';
                    // Loop through each image ID for the thumbnail gallery
                    foreach ($gallery_ids as $image_id) {
                
                        // Output the swiper thumb
                        echo '<div class="swiper-slide">';
                        if (function_exists('jws_getImageBySize')) {
                             $img = jws_getImageBySize(array('attach_id' => $image_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                             echo ''.$img['thumbnail'];
                        }
                        echo '</div>';
                    }
                
                    echo '</div>';
                    
                    echo '</div>'; // Close swiper-thumbs-container 
                
             }else{
               
                if (function_exists('jws_getImageBySize')) {
                     $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                    if (is_array($img) && isset($img['thumbnail'])) {
                     echo ''.$img['thumbnail'];
                     }
                 
                 }
                
             }
             ?>
             </div>
             <div class="service-attributes">
             <?php
             $delivery_time = get_post_meta( $post_id,'services_delivery_time', true); 
             $delivery_time = get_term($delivery_time);

            $eng_level = get_post_meta( $post_id,'services_english_level', true); 
            $eng_level = get_term($eng_level);
            
            $location_name='';
            $response_time_name='';
            $services_response_time = get_post_meta( $post_id,'services_response_time', true); 
            if ($services_response_time){
                $response_time = get_term($services_response_time, 'services_response_time'); // Replace 'your_taxonomy' with the actual taxonomy slug
                $response_time_name = $response_time->name;
            }
            
            
          $services_response_time = get_post_meta( $post_id,'services_response_time', true); 
          
          $services_locations = get_post_meta( $post_id,'services_locations', true);
          $term = get_term($services_locations, 'services_locations');
          if(isset($term)){    
            $location_name = $term->name;
            }
                   $option_meta = jws_theme_get_option('list_meta_services_option');
                   $meta_option = $option_meta['enabled'];
                   

             ?>
             <ul>
             <?php if(isset($meta_option['services_delivery_time']) && !empty($delivery_time)){?>
                <li>
                    <span class="icon"><i class="<?php echo jws_theme_get_option('deli_icon');?>"></i></span>
                    <span class="info">
                        <span class="d-block"><?php echo jws_theme_get_option('deli_text');?></span>
                        <span class="fw-500">
                            <?php if(!is_wp_error($delivery_time)) echo esc_html($delivery_time->name);?>
                        </span>
                    </span>
                </li>
                <?php }
                $services_language =get_the_terms( get_the_id(),'services_language');
                    if(isset($meta_option['services_language']) && !empty($services_language)){
                ?> 
                 <li>
                    <span class="icon"><i class="<?php echo jws_theme_get_option('language_icon');?>"></i></span>
                    <span class="info">
                        <span class="d-block"><?php echo jws_theme_get_option('language_text');?></span>
                        <?php
                            foreach ($services_language as $term) {
                                echo ' <span class="fw-500">'.$term->name.'</span>'; // Output the name of the term
                            }
                        ?>
                       
                         
                        
                    </span>
                </li>               
                <?php }?>  
                <?php
                    if(isset($meta_option['services_english_level']) && !empty($eng_level)){
                ?>
                <li>
                    <span class="icon"><i class="<?php echo jws_theme_get_option('english_icon');?>"></i></span>
                    <span class="info">
                        <span class="d-block"><?php echo jws_theme_get_option('english_text');?></span>
                        <span class="fw-500">
                            <?php if(!is_wp_error($eng_level)) echo esc_html($eng_level->name);?>
                        </span>
                    </span>
                </li>
                <?php }
                    if(isset($meta_option['services_response_time']) && !empty($response_time_name)){
                ?>
                <li>
                    <span class="icon"><i class="<?php echo jws_theme_get_option('respon_icon');?>"></i></span>
                    <span class="info">
                        <span class="d-block"><?php echo jws_theme_get_option('respon_text');?></span>
                        <span class="fw-500"><?php  echo esc_html($response_time_name);?> </span>
                    </span>
                </li>
                <?php }
                    if(isset($meta_option['services_locations']) && !empty($location_name)){
                ?>                
                <li>
                    <span class="icon"><i class="<?php echo jws_theme_get_option('loca_icon');?>"></i></span>
                    <span class="info">
                        <span class="d-block"><?php echo jws_theme_get_option('loca_text');?></span>
                        <span class="fw-500">
                            <?php echo esc_html($location_name); ?>
                        </span>
                    </span>
                </li>
                <?php }?>              
             </ul>
             </div>
             <div class="service-content">
              
                <?php the_content(); ?>
             
             
             </div>
            <?php   $services_type = get_field('services_type',$post_id);
            if($services_type==2){
            ?>
             <div id="service-package" class="service-package">
             
               <div class="fw-500 fs-md"><?php echo esc_html__('Packages','freeagent'); ?></div>
               
               <?php 
                
                get_template_part( 
                  'template-parts/content/services/single/package_table'
                );
                
                ?>
             
             
             </div>
             
             <div class="service-addons">
              
                <div class="fw-500 fs-md"><?php echo esc_html__('Get more with Offer Add-ons','freeagent'); ?></div>
                <?php 
                
                get_template_part( 
                  'template-parts/content/services/single/addons'
                );
                
                ?>
             
             
             </div>
             <?php }?>
       
           </div>
        
        </div>
    
    
        <div class="col-lg-4">
           
           <div class="service-sidebar">
               <?php 
               
                    get_template_part( 
            	         'template-parts/content/services/single/sidebar'
            	    );
               
               ?>
           </div>
    
        </div>
    
      
    </div>
          

</div>
    <!--Related-->
    <div class="related_services  e-con">
    <div class="services_row">
        <div class="container">
           <h5 class="service-sestion-heading"><?php echo esc_html__('Related Services','freeagent');?></h5>
           <div class="swiper post_related_slider jws-services-layout1" data-swiper='{"slidesPerView":1 ,"spaceBetween": 30, "loop":false, "breakpoints": {"768": {"slidesPerView": 2}, "992": {"slidesPerView": 4}}}'>
                <div class="swiper-wrapper">
                <?php
       $current_post_terms = wp_get_post_terms( get_the_ID(), 'services_cat' );

                    $term_ids = array();
                    foreach ( $current_post_terms as $term ) {
                        $term_ids[] = $term->term_id;
                    }
                    $related = get_posts( 
                    array(
                    'tax_query' => array(
                            array(
                                'taxonomy' => 'services_cat',
                                    'field'    => 'id',
                                    'terms'    => $term_ids,
                            ),
                        ),
                     'numberposts' => 100,
                     'post_type' => 'services', 
                     'post__not_in' => array($post->ID) ) 
                     );
            
                if( $related ) foreach( $related as $post ) {
                setup_postdata($post);
                
                    $post_id = get_the_ID();
                    $image_size = '800x504';
                    $job_author_id = $post->post_author;
                    $freelancer_id = Jws_Custom_User::get_freelaner_id( $job_author_id );
                     $freelancer_permalink = get_permalink($freelancer_id);
                     $display_name = get_the_title($freelancer_id);
                                             $services_price = get_post_meta($post_id, 'services_price', true); 
                    $services_type = get_post_meta($post_id, 'services_type', true);
                    
                    $args = wp_parse_args( $args, array(
                        'addon_ids'   =>  '',
                        'price_addons' => '',
                       
                    ) );
                    
                    extract( $args );
                    $price_html='';
                    if($services_type == '2') {
                        
                        $package_service = get_field('package_service',$post_id); 
                     
                        if (is_array($package_service)) {
                        foreach($package_service as $key => $package) {
                          $price_html= jws_format_price((int) $price_addons + (int) $package['package_price']); 
                            break;
                        }
                        }
                      }else{
                        $price_html = jws_format_price($services_price);
                      }
                   
                      $argsValue = compact('post_id','image_size','freelancer_permalink', 'display_name', 'price_html' );
                ?>
                    <div class="jws_service_item swiper-slide">
                       <?php  get_template_part( 'template-parts/content/services/content', 'classic',$argsValue);?> 
                    </div>
                
                <?php
                }
                    wp_reset_postdata();
                ?>
                </div>
            </div>
           </div>
        </div>
   </div>
   
  <div id="submit-report" class="mfp-hide rad_10 overflow-hidden popup-global submit-report">
    <div class="popup-form">
           <h5><?php echo esc_html__('Report this Service','freeagent');?></h5>
           <?php
             $reports = get_terms(array(
                'taxonomy' => 'service_report_reason',
                'hide_empty' => false, // Set to true if you want to exclude empty terms
            ));
                   
          if ($reports && !is_wp_error($reports)) {
    ?>
        <form>
            <div class="form-group">
                <label class="fw-700"><?php echo esc_html__('Choose reason','freeagent');?></label>
                 <select name="reason">
                    <?php foreach ($reports as $report) {
                      echo '<option value="'.$report->term_id.'">'.$report->name.'</option>';
                      }?>
                </select> 
            </div>
            <div class="form-group">
                <label  class="fw-700"><?php echo esc_html__('Details','freeagent');?></label>
                <textarea name="description" rows="4" <?php echo esc_html__('Describe the issue...','freeagent');?> required></textarea>
            </div>
            <input type="hidden" name="service_report" value="<?php echo esc_attr($post_id); ?>" />
            <input type="hidden" name="reason_type" value="service" />
            <button class="form-submit-btn report-submit elementor-button d-block" type="button"><?php echo esc_html__('Report','freeagent'); ?></button>  
        </form>
        <?php }?>
    </div>
</div> 
   