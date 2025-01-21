<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$shop = jws_check_layout_shop();

if($shop['shop_columns'] == '1') {
    $columns =' col-12 col-lg-'.$shop['shop_columns_tablet'].' col-'.$shop['shop_columns_mobile'];
}
if($shop['shop_columns'] == '4') {
    $columns = ' col-xl-3 col-lg-'.$shop['shop_columns_tablet'].' col-'.$shop['shop_columns_mobile'];
}
if($shop['shop_columns'] == '2') {
    $columns = ' col-xl-6 col-lg-'.$shop['shop_columns_tablet'].' col-'.$shop['shop_columns_mobile'];
}
if($shop['shop_columns'] == '3') {
    $columns = ' col-xl-4 col-lg-'.$shop['shop_columns_tablet'].' col-'.$shop['shop_columns_mobile'];
}

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

?>

<div class="product-item product <?php echo esc_attr($columns);?>">
    
    <?php 
       
        
            wc_get_template_part( 'archive-layout/content-layout1');  
 
      
    ?>
  
</div>