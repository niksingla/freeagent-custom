<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script('magnificPopup');
wp_enqueue_style('magnificPopup');
wp_enqueue_script('swiper');
global $jws_option; 
$layout = (isset($jws_option['shop_related_layout']) && !empty($jws_option['shop_related_layout']) ) ? $jws_option['shop_related_layout'] : 'layout1';
$item = (isset($jws_option['shop_related_item']) && !empty($jws_option['shop_related_item']) ) ? $jws_option['shop_related_item'] : '4';
$class = 'products related-slider products-tab products-wrap swiper ';
$class .= $layout;
if ( $upsells ) : ?>

	<section class="up-sells upsells products">

		<?php
      
       $heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'You may also like…', 'freeagent' ) );  
       
		

		if ( $heading ) :
			?>
			<h3 class="related_title"><?php echo esc_html( $heading ); ?></h3>
		<?php endif; ?>
		
		<div class="<?php echo esc_attr($class); ?>" data-slides-per-view="<?php echo esc_attr($item); ?>">
            <div class="swiper-wrapper">
			<?php foreach ( $upsells as $related_product ) : ?>
                   
    					<?php
        					$post_object = get_post( $related_product->get_id() );
        
        					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
                            
        					wc_get_template_part( 'content', 'product-related' );
    					?>
                    
			<?php endforeach; ?>
            </div>
		</div>

	</section>
  
	<?php
endif;

wp_reset_postdata();