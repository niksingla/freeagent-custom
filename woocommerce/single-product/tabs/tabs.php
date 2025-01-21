<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
global $jws_option; 



$layout =  'default'; 
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
$tab_style = 'woocommerce-tabs wc-tabs-wrapper';

    $tab_style .= ' horizontal';
    $tabs = true;

if ( ! empty( $product_tabs ) ) : ?>

	<div class="<?php echo esc_attr($tab_style); ?>">
        <?php if($tabs) : ?>
		<ul class="tabs wc-tabs" role="tablist">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
				  <h6 class="tab_title">
                	<a href="#tab-<?php echo esc_attr( $key ); ?>">
					 	<?php echo ''. apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ; ?>
					</a></h6>
				</li>
			<?php endforeach; ?>
		</ul>
        <?php endif; ?>
        <div class="jws-group-accordion-wap">
   
		<?php $i = 1; foreach ( $product_tabs as $key => $product_tab ) : ?>
        <div class="jws-group-accordion <?php if($i == 1) echo esc_attr('accordion-active'); ?>">
            <h6 class="tab-heading"><?php echo esc_html($product_tab['title']); ?><span class="jws-icon-arrow_carrot-down"></span></h6>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                <?php
    				if ( isset( $product_tab['callback'] ) ) {
    					call_user_func( $product_tab['callback'], $key, $product_tab );
    				}
				?>
			</div>
        </div>
        
		<?php $i++; endforeach; ?>
       
  </div>  
		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>