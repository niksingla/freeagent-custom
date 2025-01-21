<?php 

if(function_exists('acf_add_local_field')) {
    require_once ('post_type/page.php');
    require_once ('post_type/blog.php');
    require_once ('post_type/jobs.php'); 
    require_once ('post_type/employers.php'); 
    require_once ('post_type/freelancers.php');
    require_once ('post_type/portfolios.php'); 
    require_once ('post_type/services.php');
    require_once ('post_type/job_proposal.php');
    require_once ('post_type/addons.php');  
    require_once ('post_type/service_order.php');
    require_once ('post_type/dispute.php');
    require_once ('post_type/jws_verify.php');
    require_once ('post_type/report.php'); 
    require_once ('post_type/user.php'); 
    if (class_exists('Woocommerce')) {
    require_once ('woocommerce/products.php');
    }
}

