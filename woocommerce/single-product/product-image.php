<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;


        // Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
        if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
        	return;
        }

        global $post, $product , $jws_option;
        $placeholder_size = 'woocommerce_thumbnail';
         $gallery_image_ids = $product->get_gallery_image_ids();
        
        $thumb_image_size = 'woocommerce_single';
        $columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
        $thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
        $post_thumbnail_id = $product->get_image_id();
        $full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
        $wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
        	'woocommerce-product-gallery',
            'image-action-popup', /* themeoption */
        	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
        	'woocommerce-product-gallery--columns-' . absint( $columns ),
        	'images',
            'image_slider',
        ) );
        ?>
        <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
        	<div class="jws_main_image <?php if (empty($gallery_image_ids) ) echo 'no_gallery_image';?>">
            <?php jws_product_label(); ?>
          	<figure class="woocommerce-product-gallery__wrapper">
			<?php
				$attributes = array(
					'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
					'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
					'class'                   => 'wp-post-image',
				);

				if ( $product->get_image_id() ) {
					$html  = '<div class="product-image-wrap"><figure data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'woocommerce_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
					$html .= get_the_post_thumbnail( $post->ID, $thumb_image_size, $attributes );
					$html .= '</a></figure></div>';
				} else {
					$html  = '<div class="product-image-wrap"><figure data-thumb="' . esc_url( wc_placeholder_img_src( $placeholder_size ) ) . '" class="woocommerce-product-gallery__image--placeholder"><a href="' . esc_url( wc_placeholder_img_src( $placeholder_size ) ) . '">';

					$html .= sprintf( '<img src="%s" alt="%s" data-src="%s" data-large_image="%s" data-large_image_width="700" data-large_image_height="800" class="attachment-woocommerce_single size-woocommerce_single wp-post-image" />', esc_url( wc_placeholder_img_src( $placeholder_size ) ), esc_html__( 'Awaiting product image', 'freeagent' ), esc_url( wc_placeholder_img_src( $placeholder_size ) ), esc_url( wc_placeholder_img_src( $placeholder_size ) ) );
					
					$html .= '</a></figure></div>';
				}

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );


			    do_action( 'woocommerce_product_thumbnails' );

			?>
		</figure>
        <?php wp_enqueue_script( 'jws-photoswipe' ); wp_enqueue_style( 'photoswipe' ); 	wp_enqueue_style( 'photoswipe-default-skin' ); add_action( 'wp_footer', 'jws_photoswipe_template');  ?>
       
        </div>
        <?php
        
        // Check if product gallery image ids is not empty
        if ( ! empty($gallery_image_ids) ) :
            if (wp_is_mobile()){
        ?>
        <div class="jws_thumbnail_image">
		     <div class="thumbnails swiper">
                 
                 <?php
                     foreach ($gallery_image_ids as $attachment_id) {
                            echo '<div class="swiper-slide product-image-thumbnail">';
                            echo wp_get_attachment_image($attachment_id, 'thumbnail');
                            echo '</div>';
                        }
                 ?>
                 
                
             </div>
            
	    </div>
        <?php }else{?>
        <div class="jws_thumbnail_image">
		     <div class="thumbnails swiper">
                 
                 <?php
                     foreach ($gallery_image_ids as $attachment_id) {
                            echo '<div class="swiper-slide product-image-thumbnail">';
                            echo wp_get_attachment_image($attachment_id, 'thumbnail');
                            echo '</div>';
                        }
                 ?>
                 
               
             </div>
            
	    </div>
        <?php }; endif;?>
       </div>