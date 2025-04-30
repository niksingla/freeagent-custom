<?php
include 'give-ratings.php';

function custom_scripts() {
    wp_enqueue_script( 'custom', get_template_directory_uri().'/custom_js/custom.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );  

/** Function to send emails to the professionals when a client account is approved */
function sendmail_to_professionals($user,$formdata,$client_name,$job_id,$is_afterForm=false){
    global $jws_option;
    $client_title_field = $jws_option['client_title'];
    if($is_afterForm) $client_title_field = $jws_option['add_job_title'];
    $client_country_field = $jws_option['client_country_field'];  
    if($is_afterForm) $client_country_field = $jws_option['add_job_country_field'];
    $professtional_country_field = $jws_option['professional_country_field'];  
    $client_title = $formdata[$client_title_field];
    $is_online = in_array('Online', $formdata[$jws_option['client_service_type_field']]) ? true : false;
    if($is_afterForm) $is_online = in_array('Online', $formdata[$jws_option['add_job_service_type_field']]) ? true : false;

    $to_emails = [];
    $meta_query = [
        'relation' => 'AND',
        [
            'relation' => 'OR',
            [
                'key'     => 'professional_skills',
                'value'   => serialize($client_title),
                'compare' => 'LIKE',
            ],
            [
                'key'     => 'professional_skills',
                'value'   => $client_title,
                'compare' => 'LIKE',
            ],
            [
                'key'     => 'freelancers_position',
                'value'   => $client_title,
                'compare' => '=',
            ],
        ],
    ];
    if (!$is_online) {
        $meta_query[] = [
            [
                'key'     => $professtional_country_field,
                'value'   => $formdata[$client_country_field],
                'compare' => '=',
            ],
        ];
    }

    $professionals = [
        'post_type' =>'freelancers',
        'posts_per_page' => -1,  
        'post_status' => 'publish',
        'meta_query'     => $meta_query,
    ];
    $professionals = new WP_Query($professionals);    
    if($professionals->have_posts()){
      while ($professionals->have_posts()) {
        $professionals->the_post();        
        $email = get_post_meta(get_the_ID(), 'email', true);
        if($email){
          $to_emails[] = $email;
        }        
        add_job_invitations_prof($job_id, get_the_ID(), 'auto');
      }
      wp_reset_postdata();
    }
    $subject = $jws_option['email_subject_postedjob_message'];
    foreach ($to_emails as $to_email) {
      custom_mail($to_email, $subject, $formdata,$client_name,$job_id,$is_afterForm);
      // wp_mail( $to_email, 'A new job is posted on PaidLancers', 'A client is looking for a '.$client_title.' in '.$formdata[$client_country_field]);
    }
}

add_action('wp_ajax_contact_professional', 'contact_professional');
add_action('wp_ajax_nopriv_contact_professional', 'contact_professional');
function contact_professional() {
        
    $args = wp_parse_args( $_POST );


    extract( $args ); 
    $secure = check_ajax_referer( 'jws_nonce_value', 'security', false );
    
    $errors = new WP_Error(); 
    
    if ( ! $secure ) {
        $errors->add(
            'secure_miss',
            $secure
        );
        wp_send_json_error( $errors );
    }
    
    $current_user_id = get_current_user_id(); 
    
    $active_profile = get_user_meta($current_user_id,'_active_profile', true);
    
    if($hiring_type == '1') {
        
        if(empty($job_new)){
            
            $errors->add(
                'job_new',
                esc_html__( 'Please add new job', 'freeagent' )
            );
            
            wp_send_json_error( $errors );
            
        }
        
    } elseif($hiring_type == '2') {
        
        if(empty($job_old)){
            
            $errors->add(
                'job_old',
                esc_html__( 'Please select project', 'freeagent' )
            );
            
            wp_send_json_error( $errors );
            
        }
    }       
    
    if(empty($cost)){
        
        $errors->add(
            'cost',
            esc_html__( 'Please add budget', 'freeagent' )
        );
        
        wp_send_json_error( $errors );
        
    } 
    
    $cost = jws_symbol().$cost;
    
    $job_name = $hiring_type == '1' ? $job_new : '<a href="'.get_the_permalink($job_old).'">'.get_the_title($job_old).'</a>';
    
    $to_user = $user_post;
    
    $subject = jws_theme_get_option('email_subject_contact_prof');
    $job_email_template = jws_theme_get_option('email_body_contact_prof');
    if($job_email_template){
        global $wpdb,$jws_option;
        $post_author_id = (int) $wpdb->get_var( $wpdb->prepare( "SELECT post_author FROM {$wpdb->posts} WHERE ID = %d ", $job_old ) );        
        $author =  new WP_User( $post_author_id );        
        $client_name = $author->first_name;
        $looking_for = get_post_meta($job_old,$jws_option['client_title'],true );
        $country = get_post_meta($job_old,$jws_option['client_country_field'],true );
        $city = get_post_meta($job_old,$jws_option['client_city_field'],true );
        $venue = get_post_meta($job_old, $jws_option['client_venue_field'],true);
        $service_type = get_post_meta($job_old, $jws_option['client_service_type_field'],true);
        $gender = get_post_meta($job_old, $jws_option['client_gender_field'],true);
        $date_event = get_post_meta($job_old, $jws_option['client_date_event_field'],true);
        $hours_req = get_post_meta($job_old, $jws_option['client_hours_field'],true);
        $budget = get_post_meta($job_old, $jws_option['client_budget_field'],true);
        $spec_req = get_post_meta($job_old, $jws_option['client_spec_req_field'],true);
        $symbol = jws_symbol();

        $job_email_template = str_replace(
            array('#client_name#', '#looking_for#', '#country#', '#city#', '#venue#', '#service_type#', '#gender#', '#date_event#', '#hours_req#', '#symbol_budget#', '#spec_req#', '#job_url#'),
            array($client_name, $looking_for, $country, $city, $venue, implode(' / ', $service_type), $gender, $date_event, $hours_req, $symbol . $budget, $spec_req, get_the_permalink($job_old)),
            $job_email_template
        );
        $body = '
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Client Request Notification</title>
            </head>
            <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                <table width="100%" cellspacing="0" cellpadding="0" style="margin: 0 auto; background: #fff; border: 1px solid #ddd; padding: 20px;">
                    <tr>
                        <td align="center">
                            <img src="'.site_url().'/wp-content/uploads/2023/11/Group-59-1-e1725786518693.png" alt="Paidlancers" style="max-width: 150px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            '.$job_email_template.'
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; background: #f4f4f4; font-size: 12px; text-align: center;">
                            <p>This email is a system-generated notification as you have created an account on Paidlancers. If you do not recognize this activity, then please do not click the verification link. If you wish to be removed from our records, then please contact us by writing an email. Any questions, please email <a href="mailto:team@paidlancers.com" style="color: #0073e6; text-decoration: none;">team@paidlancers.com</a></p>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
        ';

    }
    $freelancer_id  = Jws_Custom_User::get_freelaner_id( $to_user );
    add_job_invitations_prof($job_old, $freelancer_id , 'manual');
    Jws_Dashboard_Email::send_email(compact('to_user','body','subject'));
    $message =  esc_html__( 'Send Successful', 'freeagent' );
    
    wp_send_json_success(compact('message'));
}

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

add_action('wp_ajax_fetch_budget', 'fetch_budget');
add_action('wp_ajax_nopriv_fetch_budget', 'fetch_budget');

function fetch_budget(){
    $args = wp_parse_args( $_POST );    
    extract( $args );
    if($job_id){
        global $jws_option;
        wp_send_json_success( ['budget'=>get_post_meta($job_id,$jws_option['client_budget_field'],true)] );
    }
    wp_die();
}


add_action('wp_ajax_fetch_featured_profiles', 'fetch_featured_profiles');
add_action('wp_ajax_nopriv_fetch_featured_profiles', 'fetch_featured_profiles');

function fetch_featured_profiles() {
    global $jws_option;
    $client_title_field = $jws_option['client_title'];  
    $client_country_field = $jws_option['client_country_field'];  
    $professtional_country_field = $jws_option['professional_country_field'];  
    $service_type_field = $jws_option['client_service_type_field'];
    $job_title = get_post_meta($_POST['job_id'],$client_title_field, true ); 
    $job_country = get_post_meta($_POST['job_id'],$client_country_field, true ); 
    $service_type = get_post_meta($_POST['job_id'],$service_type_field,true );
    $is_job_online = in_array('Online', $service_type);
    
    $meta_query = [
        'relation' => 'AND',
        [
            'relation' => 'OR',
            [
                'key'     => 'professional_skills',
                'value'   => serialize($job_title),
                'compare' => 'LIKE',
            ],
            [
                'key'     => 'professional_skills',
                'value'   => $job_title,
                'compare' => 'LIKE',
            ],
            [
                'key'     => 'freelancers_position',
                'value'   => $job_title,
                'compare' => '=',
            ],
        ],
    ];
    if(!$is_job_online){
        $meta_query[] = [
            [
                'key'     => $professtional_country_field,
                'value'   => $job_country,
                'compare' => '=',
            ],
        ];
    }

    $professionals = [
        'post_type' =>'freelancers',
        'posts_per_page' => -1,  
        'post_status' => 'publish',
        'meta_query'     => $meta_query,
    ];
    $professionals = get_posts($professionals);

    if(count($professionals)>0) $professionals_ids = wp_list_pluck($professionals, 'post_author');
    
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
            echo '<p class="text-center text-muted">Thank you for your request. A professional will be in touch with you soon.</p>';
        }
    } else {
        echo '<p class="text-center text-muted">Thank you for your request. A professional will be in touch with you soon.</p>';
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
            let slidesPerView = <?= $atts['display']?>;
            let totalSlides = <?= $freelancers->found_posts; ?>;
            let loop = true;
            if (totalSlides < 4) {
                loop = false;
                slidesPerView = totalSlides; // shows 1, 2, or 3
            }     
            console.log(slidesPerView);
            
            new Swiper('.custom-swiper', {
                loop: loop,
                slidesPerView: slidesPerView,
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

/** Add job invitation to the professional dashboard. Auto when job is created and manual when client sends manually */
function add_job_invitations_prof($job_id, $professional_id, $via='auto'){
    if ($job_id && $professional_id) {
        $jobs_onboard = get_post_meta($professional_id, 'jobs_on_board', true);
        
        // Ensure it's an array before modifying
        if (!is_array($jobs_onboard)) {
            $jobs_onboard = [];
        }
        
        // Append the new job_id if it's not already in the array
        if (!in_array($job_id, $jobs_onboard)) {
            $jobs_onboard[] = $job_id;
            update_post_meta($professional_id, 'jobs_on_board', $jobs_onboard);
        }
    }
    
}

/**Custom mobile menu */
function mobile_menu_items(){
    ob_start();
    ?>
    <style>
        .close-mobile-side {
            display: inline-block;
            padding: 10px;
            position: absolute;
            right: 0;
        }
        .inner-menu-wrapper .jws_button_login {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            max-width: 80%;
            gap: 10px;
            margin-left: 20px;
        }
        .inner-menu-wrapper .jws_button_login a {
            text-align: left;
        }
    </style>
    <div class="mobile-side-menu" style="display:none;">
        <div class="close-mobile-side">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="inner-menu-wrapper">
        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            $('.jws_button_login').clone().appendTo('div.mobile-side-menu .inner-menu-wrapper');
            $(".mobile-ham-icon").on("click", function () {
                $(".mobile-side-menu").css({
                    "display": "block",
                    "position": "fixed",
                    "top": "0",
                    "right": "-100%",
                    "width": "100%",
                    "height": "100%",
                    "background": "#fff",
                    "z-index": "9999",
                    "transition": "right 0.3s ease-in-out"
                }).animate({ right: "0" }, 200);
            });

            $(".mobile-side-menu .close-mobile-side").on("click", function () {
                $('.mobile-side-menu').animate({ right: "-100%" }, 300, function () {
                    $(this).css("display", "none");
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
    return '';
}
add_shortcode( 'mobile_menu_items', 'mobile_menu_items' );

/** Update Website Link Ajax */
add_action('wp_ajax_fetch_website_link', 'fetch_website_link');
add_action('wp_ajax_nopriv_fetch_website_link', 'fetch_website_link');
function fetch_website_link(){
    if(is_user_logged_in()){
        $employer_userID = $_POST['employer_userID'];    
        $user = get_userdata( $employer_userID );                
        $user_roles = $user->roles;
        if(in_array('customer', $user_roles)){
            $freelancer_user_id = get_post_field('post_author', $_POST['freelancer_id']);
            $proposal_args = [
                'post_type'      => 'job_proposal',
                'posts_per_page' => -1, 
                'post_status'   => 'publish',    
                'post_author'   => $freelancer_user_id,
                'fields'         => 'ids',
            ];
            $proposals = get_posts($proposal_args);
            foreach ($proposals as $proposal_id) {
                $job = get_post_meta($proposal_id, 'job_id', true);
                $job_author = get_post_field('post_author', $job);
                if($job_author == $employer_userID){
                    global $jws_option;
                    $weblink = get_post_meta($_POST['freelancer_id'], $jws_option['professional_website_field'], true);
                    wp_send_json_success(['link'=>$weblink]);
                }
            }
        }
    }
    wp_die();
}

function proposal_mail($em_user_id, $freelancer_id, $jobs_id, $proposed_id){
    global $jws_option;
    $to_user = $em_user_id;
    $email_body = $jws_option['email_body_proposal_message'];
    $profile_url = get_permalink( $freelancer_id );
    $professional_name = get_the_title( $freelancer_id );
    $professional_title = get_post_meta( $freelancer_id, 'freelancer_position', true );
    $fees = get_post_meta( $freelancer_id, $jws_option['professional_fee_field'], true );
    $applied_for = get_the_title( $jobs_id );
    $proposal_post = get_post($proposed_id); $proposal_message = $proposal_post ? $proposal_post->post_content : '';

    $email_body = str_replace(['#profile_url#', '#professional_name#', '#professional_skill#', '#fees#', '#applied_job#', '#proposal_message#'], [$profile_url, $professional_name, $professional_title, $fees, $applied_for, $proposal_message], $email_body);

    $body = '
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Client Request Notification</title>
        </head>
        <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
            <table width="100%" cellspacing="0" cellpadding="0" style="margin: 0 auto; background: #fff; border: 1px solid #ddd; padding: 20px;">
                <tr>
                    <td align="center">
                        <img src="'.site_url().'/wp-content/uploads/2023/11/Group-59-1-e1725786518693.png" alt="Paidlancers" style="max-width: 150px;">
                    </td>
                </tr>
                <tr>
                    <td>
                        '.$email_body.'
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; background: #f4f4f4; font-size: 12px; text-align: center;">
                        <p>This email is a system-generated notification as you have created an account on Paidlancers. If you do not recognize this activity, then please do not click the verification link. If you wish to be removed from our records, then please contact us by writing an email. Any questions, please email <a href="mailto:team@paidlancers.com" style="color: #0073e6; text-decoration: none;">team@paidlancers.com</a></p>
                    </td>
                </tr>
            </table>
        </body>
        </html>
    ';
    $subject = $jws_option['email_subject_proposal_message'] ? $jws_option['email_subject_proposal_message'] : 'You have a new message.';    

    Jws_Dashboard_Email::send_email(compact('to_user','body','subject'));
}

function user_profile_picture(){
    $user_id = get_current_user_id();
    if(!$user_id) return '';
    $user = get_userdata( $user_id );
    if(in_array('professional', $user->roles)){
        $freelancer_id = Jws_Custom_User::get_freelaner_id( $user_id );
        $profile_url = get_the_permalink($freelancer_id);
    } else if(in_array('customer', $user->roles)){
        global $jws_option;
        $profile_url = get_the_permalink( $jws_option['client_form_page']);
    } else {
        $profile_url = get_the_permalink( $jws_option['professional_form_page']);
    }
    ob_start();
    ?>
    <a class="nav-profile-icon" href="<?= $profile_url; ?>">
        <?php
            if(has_post_thumbnail( $freelancer_id )){
                jws_image_advanced($freelancer_id, '48x48');
            }
            else {
                ?>
                <img src="https://secure.gravatar.com/avatar/d895161d8cf29924f5157ec122d26a52?s=48&d=mm&r=g" alt="">
                <?php
            }
        ?>
    </a>
    <?php
    return ob_get_clean();
}
add_shortcode( 'user_profile_picture', 'user_profile_picture' );

add_action('template_redirect', 'redirect_shop_to_custom_page');
function redirect_shop_to_custom_page() {
    if (is_shop() || is_singular('product')) {
        if(!is_user_logged_in())
            wp_redirect(home_url('/'));
        else {
            global $jws_option;
            $user_id = get_current_user_id();
            $user = get_userdata( $user_id );
            if(in_array('professional', $user->roles))
                $redirect_url = get_the_permalink( $jws_option['professional_form_page'] ) . '#subscription';
            else if(in_array('customer', $user->roles))
                $redirect_url = get_the_permalink( $jws_option['client_form_page'] );
            else $redirect_url = home_url( '/' );
            wp_redirect($redirect_url);
        }
        exit;
    } else {
        if(is_post_type_archive('freelancers') || is_post_type_archive('employers') || is_post_type_archive('jobs') || is_singular('employers')){
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            nocache_headers();
            include(get_query_template('404'));
            exit;
        }
    }
}

/** User Account Deletion */
add_action('wp_ajax_delete_user_account', 'handle_user_account_deletion');
function handle_user_account_deletion() {
    if (!is_user_logged_in()) {
        wp_send_json_error('You must be logged in.');
    }

    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'delete_account_action')) {
        wp_send_json_error('Security check failed.');
    }

    $current_user = wp_get_current_user();
    $password = $_POST['password'] ?? '';

    if (empty($password) || !wp_check_password($password, $current_user->user_pass, $current_user->ID)) {
        wp_send_json_error('Incorrect password.');
    }
    
    $user_id = $current_user->ID;

    // Delete all posts by user
    $user_posts = get_posts([
        'author' => $user_id,
        'numberposts' => -1,
        'post_type' => 'any',
        'post_status' => 'any'
    ]);

    foreach ($user_posts as $post) {
        wp_delete_post($post->ID, true);
    }

    // Delete user
    require_once ABSPATH . 'wp-admin/includes/user.php';
    wp_delete_user($user_id);

    wp_send_json_success();
}

/**
 * Custom Meta Fields for Dashboard pages
 */
add_action('add_meta_boxes', 'add_dashboard_meta_box');
function add_dashboard_meta_box() {
    global $jws_option;
    $allowed_pages = [$jws_option['client_form_page'], $jws_option['professional_form_page']];
    global $post;

    if ($post && $post->ID == $jws_option['professional_form_page'] ) {
        add_meta_box(
            'dashboard_meta_box_id',
            'Dashboard Page Settings',
            'render_professional_dashboard_labels_metabox',
            'page',
            'normal',
            'high'
        );
    }
    if ($post && $post->ID == $jws_option['client_form_page'] ) {
        add_meta_box(
            'dashboard_meta_box_id',
            'Dashboard Page Settings',
            'render_client_labels_metabox',
            'page',
            'normal',
            'high'
        );
    }
}

function get_client_dashboard_meta_fields() {
    return [
        'label_dashboard'     => 'Dashboard',
        'label_jobs'          => 'Jobs',
        'label_proposals'     => 'Proposals',
        'label_support'       => 'Support',
        'label_chat'          => 'Live Chat',
        'label_password'      => 'Change Password',
        'label_delete'        => 'Delete Account',
        'label_logout'        => 'Logout'
    ];
}

function render_client_labels_metabox($post) {
    $fields = get_client_dashboard_meta_fields();

    foreach ($fields as $key => $default) {
        $value = get_post_meta($post->ID, $key, true) ?: $default;
        echo '<p><label for="' . esc_attr($key) . '">' . esc_html($default) . ' label:</label>';
        echo '<input type="text" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" class="widefat" /></p>';
    }

    wp_nonce_field('save_client_dashboard_labels', 'client_dashboard_nonce');
}
add_action('save_post', function($post_id) {
    if (!isset($_POST['client_dashboard_nonce']) || !wp_verify_nonce($_POST['client_dashboard_nonce'], 'save_client_dashboard_labels')) {
        return;
    }

    if (get_post_field('post_name', $post_id) !== 'client-dashboard') return;

    $fields = array_keys(get_client_dashboard_meta_fields());

    foreach ($fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
        }
    }
});


function get_professional_dashboard_meta_fields() {
    return [
        'label_dashboard'     => 'Dashboard',
        'label_profile'       => 'Profile',
        'label_requests'      => 'Requests',
        'label_support'       => 'Support',
        'label_reviews'       => 'Reviews',
        'label_subscription'  => 'Subscription',
        'label_orders'        => 'Order History',
        'label_password'      => 'Change Password',
        'label_delete'        => 'Delete Account',
        'label_logout'        => 'Logout',
        'greetings_head'      => 'Greetings Heading',
        'greetings_subheading' => 'Greetings Subheading',
    ];
}

function render_professional_dashboard_labels_metabox($post) {
    $fields = get_professional_dashboard_meta_fields();

    foreach ($fields as $key => $default) {
        $value = get_post_meta($post->ID, $key, true) ?: $default;
        echo '<p><label for="' . esc_attr($key) . '">' . esc_html($default) . ' text:</label>';
        echo '<input type="text" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" class="widefat" /></p>';
    }

    wp_nonce_field('save_professional_dashboard_labels', 'professional_dashboard_nonce');
}
add_action('save_post', function($post_id) {
    if (!isset($_POST['professional_dashboard_nonce']) || !wp_verify_nonce($_POST['professional_dashboard_nonce'], 'save_professional_dashboard_labels')) {
        return;
    }

    if (get_post_field('post_name', $post_id) !== 'professional-dashboard') return;

    $fields = array_keys(get_professional_dashboard_meta_fields());

    foreach ($fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
        }
    }
});

/**
 * Updating the personal details
 */
add_action('admin_post_nopriv_save_personal_details', 'save_personal_details_callback');
add_action('admin_post_save_personal_details', 'save_personal_details_callback');

function save_personal_details_callback() {
    if (!isset($_POST['save_personal_details_nonce']) || !wp_verify_nonce($_POST['save_personal_details_nonce'], 'save_personal_details_action')) {
        wp_die('Security check failed.');
    }

    if (!is_user_logged_in()) {
        wp_die('Unauthorized.');
    }

    $user_id = get_current_user_id();
    $user = get_userdata($user_id);

    if (in_array('professional', $user->roles)) {
        $post_id = get_user_meta($user_id, 'freelancer_id', true);
    } elseif (in_array('customer', $user->roles)) {
        $post_id = get_user_meta($user_id, 'employer_id', true);
    }

    if (!$post_id) {
        wp_die('No associated profile found.');
    }

    $first_name = sanitize_text_field($_POST['edit_first_name'] ?? '');
    $last_name  = sanitize_text_field($_POST['edit_last_name'] ?? '');

    if ($first_name || $last_name) {
        $full_name = trim($first_name . ' ' . $last_name);
        wp_update_post([
            'ID'         => $post_id,
            'post_title' => $full_name,
        ]);

        update_user_meta($user_id, 'first_name', $first_name);
        update_user_meta($user_id, 'last_name', $last_name);
    }

    if (!empty($_POST['edit_phone'])) {
        update_post_meta($post_id, 'phone', sanitize_text_field($_POST['edit_phone']));
    }

    wp_redirect(wp_get_referer());
    exit;
}

