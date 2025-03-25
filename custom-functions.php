<?php

function get_freelancer_credits($user_id) {
    return get_user_meta($user_id, 'freelancer_credits', true) ?: 0;
}
function deduct_freelancer_credits($user_id, $credits_needed) {
    $current_credits = get_user_meta($user_id, 'freelancer_credits', true);

    if ($current_credits >= $credits_needed) {
        update_user_meta($user_id, 'freelancer_credits', $current_credits - $credits_needed);
        return true;
    } else {
        return false; // Not enough credits
    }
}

add_action('woocommerce_order_status_processing', 'add_credits_on_purchase');
function add_credits_on_purchase($order_id) {    
    if (!$order_id) return;
    
    $order = wc_get_order($order_id);
    $user_id = $order->get_user_id();
    
    if (!$user_id) return;
    
    $total_credits = 0;
    
    foreach ($order->get_items() as $item_id => $item) {
        $product_id = $item->get_product_id();
        $credits = get_post_meta($product_id, 'credit_value', true);
        if ($credits) {
            $total_credits += $credits;
        }
    }
    $user_credits = get_user_meta($user_id, 'freelancer_credits', true) ? (int) get_user_meta($user_id, 'freelancer_credits', true) : 0;
    if ($total_credits > 0) {
        update_user_meta($user_id, 'freelancer_credits', $user_credits + $total_credits);
        $user_email = get_userdata($user_id)->user_email;
        // Send email confirmation
        wp_mail($user_email, 'Credits Added', "You have received $total_credits credits.");
    }
}

function jws_register_url($url){
    global $jws_option;
    if(isset($jws_option['register_form_page']) && !empty($jws_option['register_form_page'])){
        $url = get_permalink( $jws_option['register_form_page'] );
    }    
    return $url;
}
add_filter( 'register_url', 'jws_register_url', 10 , 1 );

function jws_login_url($url){
    global $jws_option;
    if(isset($jws_option['login_form_page']) && !empty($jws_option['login_form_page'])){
        $url = get_permalink( $jws_option['login_form_page'] );
    }    
    return $url;
}
add_filter( 'login_url', 'jws_login_url', 10 , 1 );

add_filter( 'woocommerce_get_endpoint_url', function($url, $endpoint, $value, $permalink){    
    if($endpoint == 'show-subscription'){
        global $jws_option;
        $link = get_permalink($jws_option['professional_form_page']);
        $link = $link ? $link . '#subscription' : site_url();
        return $link;
    }
    return $url;
}, 4, 10);

add_action('wp_ajax_fetch_featured_profiles', 'fetch_featured_profiles');
add_action('wp_ajax_nopriv_fetch_featured_profiles', 'fetch_featured_profiles');

function fetch_featured_profiles() {
    global $jws_option;
    $client_title_field = $jws_option['client_title'];  
    $client_country_field = $jws_option['client_country_field'];  
    $professtional_country_field = $jws_option['professional_country_field'];  
    $job_title = get_post_meta($_POST['job_id'],$client_title_field, true ); 
    $job_country = get_post_meta($_POST['job_id'],$client_country_field, true ); 
    
    $professionals = [
        'post_type' =>'freelancers',
        'posts_per_page' => -1,  
        'post_status' => 'publish',
        'meta_query'     => array(       
            'relation' => 'AND',
            array(
                'key'     => 'freelancers_position',
                'value'   => $job_title,
                'compare' => '=',
            ),
            array(
                'relation' => 'OR',
                array(
                    'key'     => $jws_option['professional_service_type_field'],
                    'value'   => 'Online',
                    'compare' => 'LIKE', 
                ),
                array(
                    'key'     => $professtional_country_field,
                    'value'   => $job_country,
                    'compare' => '=', 
                ),
            ),
        ),
    ];
    $professionals = get_posts($professionals);

    if(count($professionals)>0) $professionals_ids = wp_list_pluck($professionals, 'post_author');
    else $professionals_ids = [];
    $professionals = [
        'post_type' =>'freelancers',
        'posts_per_page' => -1,  
        'post_status' => 'publish',
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'     => 'professional_skills',
                'value'   => serialize($job_title), 
                'compare' => 'LIKE',
            ),
            array(
                'relation' => 'OR',
                array(
                    'key'     => $jws_option['professional_service_type_field'],
                    'value'   => 'Online',
                    'compare' => 'LIKE', 
                ),
                array(
                    'key'     => $professtional_country_field,
                    'value'   => $job_country,
                    'compare' => '=', 
                ),
            ),          
        ),
    ];
    // $professionals = new WP_Query($professionals);    
    $professionals = get_posts($professionals);    
    if(count($professionals)>0) $professionals_ids = array_merge($professionals_ids,wp_list_pluck($professionals, 'post_author'));
    $featured_users = [];
    foreach ($professionals_ids as $user_id) {
        $args = array(
            'numberposts' => -1,
            'post_type'   => 'wps_subscriptions',
            'post_status' => 'wc-wps_renewal',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'   => 'wps_customer_id',
                    'value' => $user_id,
                ),
                array(
                    'key' => 'wps_subscription_status',
                    'value' => 'active',
                ),                            
            ),
        );
        $owned_subscriptions = get_posts( $args );
        if($owned_subscriptions){
            $subscriptions = wp_list_pluck($owned_subscriptions, 'ID');
            foreach ($subscriptions as $subscription) {
                if(get_post_meta($subscription,'product_id',true) == 10353){
                    $featured_users[] = $user_id;
                }
            }
        }
    }
    if($featured_users){
        $args = array(
            'post_type'      => 'freelancers',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'author__in'     => $featured_users,
        );
        
        $freelancers = new WP_Query($args);
    
        if ($freelancers->have_posts()) {
            echo '<div class="row">';
            while ($freelancers->have_posts()) {
                $freelancers->the_post();
                $freelancer_id = get_the_ID();
                $profile_image = get_the_post_thumbnail_url($freelancer_id, 'thumbnail') ?: 'https://via.placeholder.com/150';
                $title = get_the_title();
                $position_title = get_post_meta($freelancer_id, 'freelancers_position', true);
                $fee = get_post_meta($freelancer_id, $jws_option['professional_fee_field'], true);
                $symbol = function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '£';
                ?>
    
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm p-3">
                        <div class="card-body">
                            <img src="<?php echo esc_url($profile_image); ?>" class="rounded-circle mb-2" width="80" height="80" alt="Profile Image">
                            <h5 class="card-title"><?php echo esc_html($title); ?></h5>
                            <p class="card-text text-muted mb-1"><?= $position_title ;?></p>
                            <p class="card-text text-muted"><?= $symbol.$fee ;?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">View Profile</a>
                        </div>
                    </div>
                </div>
    
                <?php
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p class="text-center text-muted">No freelancers found.</p>';
        }
    } else {
        echo '<p class="text-center text-muted">No freelancers found.</p>';
    }

    wp_die();
}


/** Star Home Slider */
function star_home_carousel_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'title' => 'Our Star Professionals',
            'display' => 4,
        ),
        $atts,
        'star_home'
    );
    ob_start();
    $professionals = [
        'post_type' =>'freelancers',
        'posts_per_page' => -1,  
        'post_status' => 'publish',
    ];
    $professionals = get_posts($professionals);

    if(count($professionals)>0) $professionals_ids = wp_list_pluck($professionals, 'post_author');
    else $professionals_ids = [];
    $star_home_users = [];
    foreach ($professionals_ids as $user_id) {
        $args = array(
            'numberposts' => -1,
            'post_type'   => 'wps_subscriptions',
            'post_status' => 'wc-wps_renewal',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'   => 'wps_customer_id',
                    'value' => $user_id,
                ),
                array(
                    'key' => 'wps_subscription_status',
                    'value' => 'active',
                ),                            
            ),
        );
        $owned_subscriptions = get_posts( $args );
        if($owned_subscriptions){
            $subscriptions = wp_list_pluck($owned_subscriptions, 'ID');
            foreach ($subscriptions as $subscription) {
                if(get_post_meta($subscription,'product_id',true) == 10354){
                    $star_home_users[] = $user_id;
                }
            }
        }
    }
    if($star_home_users){
        $args = array(
            'post_type'      => 'freelancers',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'author__in'     => $star_home_users,
        );
        $freelancers = new WP_Query($args);
        if ($freelancers->have_posts()) {
            echo '<h2 class="star-home-head">'.$atts['title'].'</h2>';
        }
        ?>        
        <div class="swiper-container custom-swiper">
            <div class="swiper-wrapper">
                <?php
                 if ($freelancers->have_posts()) {                  
                    while ($freelancers->have_posts()) { 
                        $freelancers->the_post(); 
                        $freelancer_id = get_the_ID();
                        $profile_image = get_the_post_thumbnail_url($freelancer_id, 'thumbnail') ?: 'https://via.placeholder.com/150';
                        $position_title = get_post_meta($freelancer_id, 'freelancers_position', true);
                        ?>
                        <div class="swiper-slide">
                            <div class="pro-profile-single">
                                <div class="pro-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?= $profile_image?>" alt="">
                                    </a>
                                </div>
                                <div class="pro-name">
                                    <a href="<?php the_permalink(); ?>">
                                        <h2><?= get_the_title(); ?></h2>
                                    </a>
                                </div>
                                <div class="pro-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <h2><?= $position_title; ?></h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }
                    wp_reset_postdata();
                 }
                ?>
            </div>
            <div class="custom-swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    <?php }
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {            
            new Swiper('.custom-swiper', {
                loop: true,
                slidesPerView: <?= $atts['display']?>,
                slidesPerGroup: 1,
                spaceBetween: 10,
                autoHeight: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: true,
                },
                speed: 500,
                direction: 'horizontal',
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                pagination: {
                    el: '.custom-swiper-pagination',
                    type: 'bullets',
                },
                breakpoints: {
                    1024: { slidesPerView: <?= $atts['display']?> },
                    768: { slidesPerView: 2 },
                    480: { slidesPerView: 1 }
                }
            });
        });
    </script>

    <style>
        h2.star-home-head {
            font-family: "Faustina", Sans-serif;
            font-size: 48px;
            text-align: center;
            padding-bottom: 70px;
        }
        .custom-swiper { width: 100%; height: auto; overflow-x:hidden;}
        .custom-swiper .swiper-slide {            
            display: flex; 
            align-items: center; 
            justify-content: center;             
        }
        .custom-swiper:hover .swiper-slide {
            animation-play-state: paused;
        }
        .swiper-button-prev, .swiper-button-next {
            width: 48px;
            height: 48px;
            background-color: #000000;
            border-radius: 50%;
        }
        .swiper-button-next {
            right: -40px;
        }
        .swiper-button-prev {
            left: -40px;
        }
        .swiper-button-prev:after, .swiper-button-next:after {
            font-size: 18px;
            color: #fff;
            font-weight: 800;
        }
        .custom-swiper-pagination.swiper-pagination-bullets {
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 10px;
            padding-top: 35px;
        }
        span.swiper-pagination-bullet.swiper-pagination-bullet-active {
            width: 30px;
            border-radius: 2px;
        }
        .pro-image img {
            width: 288px;
            height: 288px;
        }
        .pro-name h2 {
            font-family: "Faustina", sans-serif;
            font-size: 24px;
            text-align: center;
            line-height: 120%;
        }
        .pro-title h2 {
            font-size: 20px;
            font-weight: 400;
            font-family: "Faustina", sans-serif;
            text-align: center;
            line-height: 120%;
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('star_home', 'star_home_carousel_shortcode');

add_action('wp_ajax_clear_woocommerce_cart', 'clear_woocommerce_cart');
add_action('wp_ajax_nopriv_clear_woocommerce_cart', 'clear_woocommerce_cart');

function clear_woocommerce_cart() {
    WC()->cart->empty_cart();
    wp_send_json_success();
}
