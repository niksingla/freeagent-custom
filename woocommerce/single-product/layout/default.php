<?php 
    global $jws_option, $product; 
?>
    <div class="container">
            <div class="row">
                <div class="col-xl-60 col-lg-7 col-12">
                	<?php
                    	/**
                    	 * Hook: woocommerce_before_single_product_summary.
                    	 *
                    	 * @hooked woocommerce_show_product_sale_flash - 10
                    	 * @hooked woocommerce_show_product_images - 20
                    	 */
                    	do_action( 'woocommerce_before_single_product_summary' );
                	?>
                </div>
                <div class="col-xl-40 col-lg-5 col-12">
                	<div class="summary entry-summary">
                        <?php if(jws_theme_get_option('product-single-breadcrumb')) echo '<div class="breadcrumb">'.jws_page_breadcrumb('/').'</div>'; 
                         ?>
        
                        
                        
                		<?php
                            echo '<div class="product_cat">'.get_the_term_list( $product->get_id(), 'product_cat', '', ' - ').'</div>';
                         /**
                         * woocommerce_single_product_summary hook
                         *
                         * @hooked jws_qv_product_summary_open - 1
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked jws_qv_product_summary_divider - 15
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_rating - 21
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked jws_qv_product_summary_actions - 30
                         * @hooked woocommerce_template_single_sharing - 50
                         * @hooked jws_qv_product_summary_close - 100
                         */
                        do_action('woocommerce_single_product_summary');
                		?>
                	</div>
                </div>
            </div>
            
            <div class=" product-tabs">
                    <?php woocommerce_output_product_data_tabs(); ?>
            </div>
           	<?php
        
        	/**
        	 * Hook: woocommerce_after_single_product_summary.
        	 *
        	 * @hooked woocommerce_output_product_data_tabs - 10
        	 * @hooked woocommerce_upsell_display - 15
        	 * @hooked woocommerce_output_related_products - 20
        	 */
        	do_action( 'woocommerce_after_single_product_summary' );
            ?>
    </div>

