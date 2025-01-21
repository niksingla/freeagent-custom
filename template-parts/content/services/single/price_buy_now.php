<?php

$args = wp_parse_args( $args, array(
    'addon_ids'   =>  '',
    'price_addons' => '',
    'post_id' => get_the_ID()
) );

extract( $args );

$services_type = get_post_meta($post_id, 'services_type', true);


?>

<div class="widget price-buy-now">

<?php 

if($services_type == '2') {
    
    $package_service = get_field('package_service',$post_id); 
  
    ?>
    
    <div class="package-nav d-flex fl_between">
     
     <?php 
      
      foreach($package_service as $key => $package) {
        
        $class = $key == '0' ? 'active' : '';
        
        ?> 
        
        <div class="<?php echo esc_attr($class); ?>" data-id="package-<?php echo esc_attr($key); ?>">
           <?php echo esc_html($package['package_title']); ?>
        </div>
        
        <?php
      }
     
     ?>
    
    </div>
    
    <div class="package-content">
     
     <?php 
      
      foreach($package_service as $key => $package) {
        
        $class = $key == '0' ? 'active' : '';
        
        ?> 
        
        <div id="package-<?php echo esc_attr($key); ?>" class="<?php echo esc_attr($class); ?>">
              <h5> <?php echo jws_format_price((int) $price_addons + (int) $package['package_price']); ?></h5>
              <div class="package-des"> <?php echo ''.$package['package_description']; ?> </div>
              <div class="package-delivery">
                 <i class="jws-icon-clock"></i>
                 <?php 
                                                 
                     $delivery_time = get_term($package['package_delivery_time']);
      
                       if (!empty($delivery_time) && !is_wp_error($delivery_time)) {
                             echo  ''.$delivery_time->name.esc_html__(' Delivery','freeagent');
                       }
                        
                  ?>
              </div>
              <div class="package-feature">
                           
                 <div class="feature-more"><?php echo esc_html__('What\'s Included','freeagent'); ?><i class="jws-icon-caret-down"></i></div>
                                                     
                 <?php 
                 
                   if(isset($package['package_features']) && !empty($package['package_features'])) {
                    
                      $list = explode(PHP_EOL, $package['package_features']);
                      
                      if(!empty($list)) {
                        echo '<ul class="reset_ul_ol">';
                            foreach($list as $item) {
                                echo '<li><i class="jws-icon-check-circle-fill"></i>'.$item.'</li>';
                            }
                        echo '</ul>';
                      }
                    
                   }
                  ?>
                
             </div>
             <button data-package="<?php echo esc_attr($key); ?>" class="service-buy package-type"><?php echo esc_html__('Buy Now','freeagent'); ?><?php echo jws_format_price((int) $price_addons + (int) $package['package_price']); ?></button>
        </div>
        
        <?php
      }
     
     ?>
    
    </div>
    <div class="compare_package_box">
        <a href="#service-package" class="compare_package"><?php echo esc_html__('Compare packages','freeagent');?></a>
    </div>
    <?php
    
} elseif($services_type == '1') {
    
    $services_price = get_post_meta($post_id, 'services_price', true);
    
     
    ?>
    
         <button class="service-buy"><?php echo esc_html__('Buy Now','freeagent'); ?><?php echo jws_format_price((int) $price_addons + (int) $services_price); ?></button>

<?php } ?>
    
</div>
