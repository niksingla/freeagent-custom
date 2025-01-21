<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
$layout = 'layout1';
$item = (isset($jws_option['shop_related_item']) && !empty($jws_option['shop_related_item']) ) ? $jws_option['shop_related_item'] : '4';
$class = 'related-slider swiper';

if ( $related_products ) : ?>

	<section class="related products-wrap">

		<?php
      
       $heading = apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Related Products', 'freeagent' ) );  
       
		

		if ( $heading ) :
			?>
			<h5 class="related_title"><?php echo esc_html( $heading ); ?></h5>
		<?php endif; ?>
		  <div class="slider-layout products products-tab <?php echo esc_attr($layout);?>">
    		<div class="<?php echo esc_attr($class); ?>" data-slides-per-view="<?php echo esc_attr($item); ?>">
                <div class="swiper-wrapper">
    			<?php foreach ( $related_products as $related_product ) : ?>
                       
        					<?php
            					$post_object = get_post( $related_product->get_id() );
            
            					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
                                
            					wc_get_template_part( 'content', 'product-related' );
        					?>
                        
    			<?php endforeach; ?>
                </div>
    		</div>
        </div>
	</section>
  
	<?php
endif;

wp_reset_postdata();