<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage freeagent
 * @since 1.0.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<?php  
    global $jws_option; 
?>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
      
<div id="page" class="site">
    <?php if(function_exists('jws_header')) jws_header(); ?>
	<div id="content" class="site-content">
    <?php 
  if(function_exists('jws_title_bar')) {
      
        if(is_page()) {
           if((get_post_meta( get_the_ID(), 'title_bar_checkbox', 1 ) == null || !get_post_meta( get_the_ID(), 'title_bar_checkbox', 1 ))) {
                jws_title_bar();
           }  
        }elseif(('product' == get_post_type() && is_single())){
            if((isset($jws_option['product-single-title-bar-switch']) && $jws_option['product-single-title-bar-switch']) || !isset($jws_option['product-single-title-bar-switch'])) {
              jws_title_bar();  
            } 
        }elseif((is_single() && 'post' == get_post_type()) ){
           
                $blog_titlebar = isset($jws_option['blog-single-title-bar-switch']) ? $jws_option['blog-single-title-bar-switch'] : '';
        
            if($blog_titlebar  || !isset($jws_option['blog-single-title-bar-switch'])) {
              jws_title_bar();  
            } 
        }elseif ((is_archive()&& 'jobs' == get_post_type()) || (is_tax(array('jobs_cat', 'jobs_tag', 'jobs_duration', 'jobs_english_level', 'jobs_language', 'jobs_skill', 'jobs_locations', 'job_level')))){
             
           $show_titlebar = (isset($_GET['titlebar']) && $_GET['titlebar']) ? $_GET['titlebar'] : ((isset($jws_option['jobs-title-bar-switch']) && $jws_option['jobs-title-bar-switch']) ? $jws_option['jobs-title-bar-switch'] : '');
      
            if($show_titlebar && $show_titlebar!='no') {
          
              jws_title_bar();
            } 
        }elseif((is_single() && 'jobs' == get_post_type())){
            if((isset($jws_option['jobs-single-title-bar-switch']) && $jws_option['jobs-single-title-bar-switch']) || !isset($jws_option['jobs-single-title-bar-switch'])) {
              jws_title_bar();
            } 
        }elseif((is_archive() && 'employers' == get_post_type())|| (is_tax(array('employers_cat', 'employers_location', 'employers_size')))){
            if((isset($jws_option['select-titlebar-employers-archive']) && $jws_option['select-titlebar-employers-archive']) || !isset($jws_option['select-titlebar-employers-archive'])) {
              jws_title_bar();  
            } 
        }elseif((is_single() && 'employers' == get_post_type())){
            if((isset($jws_option['employers-single-title-bar-switch']) && $jws_option['employers-single-title-bar-switch']) || !isset($jws_option['employers-single-title-bar-switch'])) {
              jws_title_bar();
            } 
        }elseif((is_archive() && 'services' == get_post_type())|| (is_tax(array('services_cat', 'services_tag', 'services_duration', 'services_english_level', 'services_language', 'services_skill', 'services_locations', 'job_level', 'employers_cat', 'employers_location', 'employers_size', 'services_response_time', 'services_delivery_time')))){
            if((isset($jws_option['select-titlebar-services-archive']) && $jws_option['select-titlebar-services-archive']) || !isset($jws_option['select-titlebar-services-archive'])) {
              jws_title_bar();  
            } 
        }elseif((is_single() && 'services' == get_post_type())){
            if((isset($jws_option['services-single-title-bar-switch']) && $jws_option['services-single-title-bar-switch']) || !isset($jws_option['services-single-title-bar-switch'])) {
              jws_title_bar();
            } 
        }elseif((is_archive() && 'freelancers' == get_post_type()) || (is_tax(array('freelancers_cat', 'freelancers_skill', 'freelancers_english_level','freelancers_language','freelancers_type','freelancers_response_time','freelancers_location')))){
            if((isset($jws_option['select-titlebar-freelancers-archive']) && $jws_option['select-titlebar-freelancers-archive']) || !isset($jws_option['select-titlebar-freelancers-archive'])) {
              jws_title_bar();  
            } 
        }elseif((is_single() && 'freelancers' == get_post_type())){
            if((isset($jws_option['freelancers-single-title-bar-switch']) && $jws_option['freelancers-single-title-bar-switch']) || !isset($jws_option['freelancers-single-title-bar-switch'])) {
              jws_title_bar();
            } 
        }else {
           jws_title_bar(); 
        }  
    } 
?>