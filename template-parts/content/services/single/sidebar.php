<?php 
$post_id = get_the_ID();
$services_type = get_post_meta($post_id, 'services_type', true); 
    $location = get_the_terms( $post_id,'freelancers_location');

$args = wp_parse_args( $args, array(
    'addon_ids'   =>  '',
    'price_addons' => '',
    'post_id' => get_the_ID()
) );

extract( $args );
$price_html='';
if($services_type == '2') {
    
    $package_service = get_field('package_service',$post_id); 
    foreach($package_service as $key => $package) {
      $price_html= jws_format_price((int) $price_addons + (int) $package['package_price']); 
        break;
    }
  }else{
    $services_price = get_post_meta($post_id, 'services_price', true);
    $price_html = jws_format_price($services_price);
  }

?>
<div class="widget price-start">
  <div class="overlay_bg"></div>
  <div class="fw-500 fs-small"><?php echo esc_html__('Starting at','freeagent'); ?></div>
 <?php
    if(!empty($price_html)){
    echo '<h3 class="price">'.$price_html.'</h3>';    
    }
 ?>
</div>


<?php 
              
    get_template_part( 
      'template-parts/content/services/single/price_buy_now'
    );


?>


<div class="widget freelancer-info">

  <div class="widget-title fs-md fw-500"><?php echo esc_html__('About Seller','freeagent'); ?></div>
    <?php
    $service_author_id = $post->post_author;
    $freelancer_id = Jws_Custom_User::get_freelaner_id( $service_author_id );

    $fr_feedback = get_post_meta($freelancer_id, 'feedback_fr', true);
      $sum_ratings = 0;
      $total_feedback =0;
    if (is_array($fr_feedback) && !empty($fr_feedback)) {
        $total_feedback = count($fr_feedback);
        foreach ($fr_feedback as $feedback_entry) {
            // Assuming "rating" is the key for the rating value
            $sum_ratings += intval($feedback_entry['rating']);
        }
    }
      
    $average_rating = $total_feedback > 0 ? $sum_ratings / $total_feedback : 0;
    $average_rating_formatted = number_format($average_rating, 1);
    $max_rating = 5;
    $percentage_rating = ($average_rating / $max_rating) * 100;
    
    $date_format = get_option( 'date_format' );
 
    if($total_feedback > 1){
        $feedback_html = $total_feedback.esc_html__(' Reviews','freeagent');
    }else{
      $feedback_html = $total_feedback.esc_html__(' Review','freeagent');  
    } 
     $verified = get_post_meta($freelancer_id,'verified', true);
     $verified_lable='';
     if($verified==true){
        $verified_lable= '<span class="verified"><i class="jws-icon-check-circle-fill"></i></span>';
     }
    
    echo '<div class="jws_seller_wap">
        <div class="logo_emp">';
            echo '<a href="'.get_the_permalink($freelancer_id).'">';
            jws_image_advanced($freelancer_id,'thumbnail');
            echo '</a>';
        echo '</div>
        <div class="infor">
            <a href="'.get_the_permalink($freelancer_id).'">
                <h6 class="name_emp"><span class="name">'.get_the_title($freelancer_id).'</span> '.$verified_lable.'</h6>
            </a>
            <div class="member_since">'.esc_html__('Member since ','freeagent').get_the_date($date_format,$freelancer_id).'</div>
            <div class="count_review"><i class="fa fa-star"></i>'.freelancer_get_rating_html($average_rating_formatted).$average_rating_formatted.'<span class="total_review">('.$feedback_html.')</span></div>
        </div>
    </div>';
    ?>
    <div class="more_detail">
        <ul class="">
        <?php if(!empty($location)):?>
            <li>
                <label class="label"><?php echo esc_html__('Location','freeagent')?></label>
                <p class="result"><?php echo get_the_term_list( $freelancer_id, 'freelancers_location', '', ', '); ?></p>
            </li>
        <?php endif;?>
        <?php 
        $cost = jws_cost($freelancer_id);

        if (!empty($cost)):?>
            <li>
                <label class="label"><?php echo esc_html__('Hourly Rate','freeagent')?></label>
                <p class="result"><?php echo jws_cost($freelancer_id); ?></p>
            </li>
        <?php endif; ?>
        </ul>
        <a class="elementor-button btn btn-underlined border-thin view_detail" href="<?php echo get_the_permalink($freelancer_id);?>"><?php echo esc_html__('Contact Seller','freeagent');?></a>
    </div>

</div>

<form id="service-purchase"> 

 <input name="service_id" value="<?php echo esc_attr($post_id); ?>" type="hidden" />
 <input name="service_addons" value="" type="hidden" />
 <input name="service_package" value="" type="hidden" />
 <input  type="hidden" name="service_buy_nonce" value="<?php echo wp_create_nonce( 'service_buy_nonce_value' ); ?>">
 
 <?php 

    $service_payment = jws_theme_get_option('service_payment');
    
 
 ?>
 <input name="service_payment_type" value="<?php echo !empty($service_payment)  ? $service_payment : 'wallet'; ?>" type="hidden" />
</form> 