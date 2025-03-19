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

add_filter( 'woocommerce_get_endpoint_url', function($url, $endpoint, $value, $permalink){    
    if($endpoint == 'show-subscription'){
        global $jws_option;
        $link = get_permalink($jws_option['professional_form_page']);
        $link = $link ? $link . '#subscription' : site_url();
        return $link;
    }
    return $url;
}, 4, 10);