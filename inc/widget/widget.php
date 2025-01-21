<?php 	
    require_once 'post-rent.php';
if (class_exists('Woocommerce')) { 
  require_once 'woocommerce-filter-attr.php';
  require_once 'product-category-list.php';
  require_once 'product-search.php';  

  require_once 'class-wc-widget-product-tag-cloud.php';  
}
  require_once 'search.php';
  require_once 'acf-category.php';  
  require_once 'freelance_price.php';
    require_once 'job_type_filter.php';
function jws_remove_widget() {
   insert_remove_widget( 'WC_Widget_Product_Tag_Cloud' );
}

if(function_exists('insert_remove_widget')) {
   add_action( 'widgets_init', 'jws_remove_widget' );  
}
