<?php


		if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return;
            
		}


		// Remove product link;    

        add_filter( 'freeagent_after_single_product_image', 'product_thumbnails' );
        // Add Shop Toolbar
		add_action( 'woocommerce_filter_product_ajax', 'shop_toolbar' , 20 );
        add_action( 'wp_ajax_jws_search_products', 'instance_search_result' );
		add_action( 'wp_ajax_nopriv_jws_search_products', 'instance_search_result' );
		// Add Shop Topbar
		add_action( 'woocommerce_filter_product_ajax', 'shop_topbar' , 25 );    



         /**
         * variation gallery images
         */
        add_filter('woocommerce_available_variation', 'jws_variation_gallery_images');
        function jws_variation_gallery_images($variation) {
         global $post;
           
                if (!isset($variation['jws_variation_gallery'])) {
                    $variation['jws_variation_gallery'] = array();
                    // $variation['nasa_variation_back_img'] = '';
                    $gallery = get_post_meta($post->ID, 'jws_variation_gallery_data', true);

                    if (!empty($gallery[$variation['variation_id']])) {
                        $variation['jws_variation_gallery'] = $gallery;
                        
                        $gallery_ids = explode(',', $gallery[$variation['variation_id']]);
                        
                        $image_size = apply_filters('single_product_archive_thumbnail_size', 'shop_catalog');
                        
                        if ($gallery_ids) {
                            $variation['jws_variation_gallery'] = array();
                            
                            foreach ($gallery_ids as $gallery_id) {
                                $img = wp_get_attachment_image_src($gallery_id, $image_size);
        
                                if ($img) {
                                    $variation['jws_variation_gallery'][] = array(
                                        'src' => $img[0],
                                        'w' => $img[1],
                                        'h' => $img[2]
                                    );
        
                                    if (!isset($variation['jws_variation_img'])) {
                                        $variation['jws_variation_img'] = $img[0];
                                    }
                                }
                            }
                        }
                    }
                }
          
            
            return $variation;
        }
    
   

    /**
	 * Search products
	 *
	 * @since 1.0
	 */
	function instance_search_result() {
		check_ajax_referer( 'myajax-next-nonce', 'nonce' );

		$args_sku = array(
			'post_type'      => 'product',
			'posts_per_page' => 30,
			'meta_query'     => array(
				array(
					'key'     => '_sku',
					'value'   => trim( $_POST['term'] ),
					'compare' => 'like',
				),
			),
		);

		$args_variation_sku = array(
			'post_type'      => 'product_variation',
			'posts_per_page' => 30,
			'meta_query'     => array(
				array(
					'key'     => '_sku',
					'value'   => trim( $_POST['term'] ),
					'compare' => 'like',
				),
			),
		);

		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => 30,
			's'              => trim( $_POST['term'] ),
		);

		if ( isset( $_POST['cat'] ) && $_POST['cat'] != '' ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $_POST['cat'],
				),
			);

			$args_sku['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $_POST['cat'],
				),
			);
		}

		$products_sku           = get_posts( $args_sku );
		$products_s             = get_posts( $args );
		$products_variation_sku = get_posts( $args_variation_sku );

		$response    = array();
		$products    = array_merge( $products_sku, $products_s, $products_variation_sku );
		$product_ids = array();
		foreach ( $products as $product ) {
			$id = $product->ID;
			if ( ! in_array( $id, $product_ids ) ) {
				$product_ids[] = $id;

				$productw   = new WC_Product( $id );
				$response[] = sprintf(
					'<li>' .
					'<a class="search-item" href="%s">' .
					'%s' .
					'<span class="title">%s</span>' .
                    '<span class="price">%s</span>' .
					'</a>' .
					'</li>',
					esc_url( $productw->get_permalink() ),
					$productw->get_image( 'size-270x340' ),
					$productw->get_title(),$productw->get_price( )
				);
			}
		}


		if ( empty( $response ) ) {
			$response[] = sprintf( '<li>%s</li>', esc_html__( 'Nothing found', 'freeagent' ) );
		}

		$output = sprintf( '<ul>%s</ul>', implode( ' ', $response ) );

		wp_send_json_success( $output );
		die();
	}
	/**
	 * Display product attribute
	 *
	 * @since 1.0
	 */
	function product_attribute() {
	  global $product , $jws_option; 
      if ($product->get_type() != 'variable') {
        return;
      }
      
      
      $options = isset($jws_option['choose-attr-display']) && !empty($jws_option['choose-attr-display']) ? $jws_option['choose-attr-display'] : '';
      $variations_attr = $product->get_available_variations();
      if (empty($variations_attr) && false !== $variations_attr) {
            return;
      }
      
    
      $default_attribute = array();  
       
      if (isset($options)) { 
            $default_attribute = $options;
      }

		if ( $default_attribute == '' || $default_attribute == 'none' ) {
			return;
		}
        

		$attributes   = maybe_unserialize( get_post_meta( $product->get_id(), '_product_attributes', true ) );

 

		if ( ! $attributes ) {
			return;
		}
        
	echo '<div class="jws-attr-swatches" data-variations="'.htmlspecialchars(wp_json_encode($variations_attr)).'">';

		foreach ( $attributes as $key => $attribute ) {


			if ( in_array(sanitize_title( $attribute['name'] ), $default_attribute) ) {
                $default_attributes = $product->get_default_attributes();
			
				if ( $attribute['is_taxonomy'] ) {
					$post_terms = wp_get_post_terms( $product->get_id(), $attribute['name'] );
              
					$attr_type = '';

					if ( function_exists( 'TA_WCVS' ) ) {
						$attr = TA_WCVS()->get_tax_attribute( $attribute['name'] );
						if ( $attr ) {
							$attr_type = $attr->attribute_type;
						}
					}
                 
					$found = false;
                    echo '<div class="jws-attr-content jws-attr-content-'.$attr_type.'">';
					foreach ( $post_terms as $term ) {
						$css_class = '';
						if ( is_wp_error( $term ) ) {
							continue;
						}   
                    
					//	if ( $variations && isset( $variations[$term->slug] ) ) {
						  
							//$attachment_id = $variations[$term->slug];
						//	$attachment    = wp_get_attachment_image_src( $attachment_id, 'shop_catalog' );
                          
                            if(isset($default_attributes[$term->taxonomy]) && $default_attributes[$term->taxonomy] == $term->slug) {
                                 $css_class .= ' selected';
							     $found = true;  
                            }


							//if ( $attachment ) {
								$css_class .= ' jws-swatch-variation-image';
								$img_src = '';
                                
								echo swatch_html( $term, $attr_type, $img_src, $css_class );
						//	}

					//	}
					}
                   echo '</div>';
				}
		
			
		}
		}
        echo '</div>';
	}
	/**
	 * Print HTML of a single swatch
	 *
	 * @since  1.0.0
	 * @return string
	 */
	 function swatch_html( $term, $attr_type, $img_src, $css_class ) {

		$html = '';
		$name = $term->name;
        $slug = $term->slug;
        $taxonomy = $term->taxonomy;
        
             
		switch ( $attr_type ) {
			case 'color':
				$color = get_term_meta( $term->term_id, 'color', true );
				list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );
				$html = sprintf(
					'<span class="swatch swatch-color %s" data-src="%s" title="%s"  data-value="%s" data-type="%s"><span class="sub-swatch" style="background-color:%s;color:%s;"></span> </span>',
					esc_attr( $css_class ),
					esc_url( $img_src ),
					esc_attr( $name ),
                    esc_attr($slug),
                    esc_attr($taxonomy),
					esc_attr( $color ),
					"rgba($r,$g,$b,0.5)"
				);
				break;

			case 'image':
				$image = get_term_meta( $term->term_id, 'image', true );
				if ( $image ) {
					$image = wp_get_attachment_image_src( $image );
					$image = $image ? $image[0] : WC()->plugin_url() . '/assets/images/placeholder.png';
					$html  = sprintf(
						'<span class="swatch swatch-image %s" data-src="%s" title="%s" data-value="%s" data-type="%s"><img src="%s" alt="%s"></span>',
						esc_attr( $css_class ),
						esc_url( $img_src ),
						esc_attr( $name ),
                        esc_attr($slug),
                        esc_attr($taxonomy),
						esc_url( $image ),
						esc_attr( $name )
					);
				}

				break;

			default:
				$label = get_term_meta( $term->term_id, 'label', true );
				$label = $label ? $label : $name;
          
				$html  = sprintf(
					'<span class="swatch swatch-label %s" data-src="%s" title="%s" data-value="%s" data-type="%s">%s</span>',
					esc_attr( $css_class ),
					esc_url( $img_src ),
					esc_attr( $name ),
                    esc_attr($slug),
                    esc_attr($taxonomy),
					esc_html( $label )
				);
				break;


		}

		return $html;
	}

	/**
	 * Get variations
	 *
	 * @since  1.0.0
	 * @return string
	 */
	function get_variations( $default_attribute ) {
		global $product;

		$variations = array();
		if ( $product->get_type() == 'variable' ) {
			$args = array(
				'post_parent' => $product->get_id(),
				'post_type'   => 'product_variation',
				'orderby'     => 'menu_order',
				'order'       => 'ASC',
				'fields'      => 'ids',
				'post_status' => 'publish',
				'numberposts' => - 1
			);

			if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
				$args['meta_query'][] = array(
					'key'     => '_stock_status',
					'value'   => 'instock',
					'compare' => '=',
				);
			}

			$thumbnail_id = get_post_thumbnail_id();

			$posts = get_posts( $args );

			foreach ( $posts as $post_id ) {
				$attachment_id = get_post_thumbnail_id( $post_id );
				$attribute     = get_variation_attributes( $post_id, 'attribute_' . $default_attribute );

				if ( ! $attachment_id ) {
					$attachment_id = $thumbnail_id;
				}

				if ( $attribute ) {
					$variations[$attribute[0]] = $attachment_id;
				}

			}

		}

		return $variations;
	}

	/**
	 * Get variation attribute
	 *
	 * @since  1.0.0
	 * @return string
	 */
	 function get_variation_attributes( $child_id, $attribute ) {
		global $wpdb;

		$values = array_unique(
			$wpdb->get_col(
				$wpdb->prepare(
					"SELECT meta_value FROM {$wpdb->postmeta} WHERE meta_key = %s AND post_id IN (" . $child_id . ")",
					$attribute
				)
			)
		);

		return $values;
	}
    /**
	 * Get product thumnails
	 *
	 * @since  1.0.0
	 * @return string
	 */
    
     
     
	function product_thumbnails() {
		global $post, $product, $woocommerce , $freeagent_loop;
        $style = '1' ;
        $thumb_position =  'left' ;
		$attachment_ids = $product->get_gallery_image_ids();
        $data_slick = '';
        if(($thumb_position == 'left' || $thumb_position == 'right') && ($style == 1) ) {
           $data_slick = 'data-slick=\'{"slidesToShow": 5,"slidesToScroll": 1,"asNavFor": "#product-images","arrows": false, "vertical":true ,  "focusOnSelect": true,  "responsive":[{"breakpoint": 736,"settings":{"slidesToShow": 4, "vertical":false}}]}\''; 
        }elseif (($thumb_position == 'bottom' || $thumb_position == 'outside') && ($style == 1 )) {
            $data_slick = 'data-slick=\'{"slidesToShow": 4,"slidesToScroll": 1,"asNavFor": "#product-images","arrows": false, "focusOnSelect": true,  "responsive":[{"breakpoint": 736,"settings":{"slidesToShow": 4, "vertical":false}}]}\''; 
        }elseif ( $style == 6  ) {
            $data_slick = 'data-slick=\'{"slidesToShow": 6,"slidesToScroll": 1,"asNavFor": ".woocommerce-product-gallery__wrapper","arrows": false, "focusOnSelect": true,  "responsive":[{"breakpoint": 736,"settings":{"slidesToShow": 4, "vertical":false}}]}\''; 
        }elseif ( $style == 8  ) {
            $data_slick = 'data-slick=\'{"slidesToShow": 5,"slidesToScroll": 1,"asNavFor": ".woocommerce-product-gallery__wrapper","arrows": false, "focusOnSelect": true,  "responsive":[{"breakpoint": 736,"settings":{"slidesToShow": 4, "vertical":false}}]}\''; 
        }else {
            $data_slick = 'data-slick=\'{"slidesToShow": 3,"slidesToScroll": 1,"asNavFor": "#product-images","arrows": false, "focusOnSelect": true,  "responsive":[{"breakpoint": 736,"settings":{"slidesToShow": 4, "vertical":false}}]}\''; 
        }
        if($style == 1 || $style == 6 || $style == 8 || (isset($freeagent_loop['loc']) && $freeagent_loop['loc'] == 'loc') ) {
       	if ( $attachment_ids ) {
			$loop    = 1;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
			?>
			<div class="product-thumbnails" id="product-thumbnails">
				<div class="thumbnails <?php echo 'columns-' . $columns; ?>" <?php echo wp_kses_post( $data_slick); ?> ><?php

					$image_thumb = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );

					if ( $image_thumb ) {

						printf(
							'<div class="thumb1">%s</div>',
							$image_thumb
						);

					}

					if ( $attachment_ids ) {
						foreach ( $attachment_ids as $attachment_id ) {



							$props = wc_get_product_attachment_props( $attachment_id, $post );

							if ( ! $props['url'] ) {
								continue;
							}

							echo apply_filters(
								'woocommerce_single_product_image_thumbnail_html',
								sprintf(
									'<div class="thumb1">%s</div>',
									wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ), 0, $props )
								),
								$attachment_id,
								$post->ID
							);

							$loop ++;
						}
					}



					?>
				</div>
			</div>
			<?php
		}
        }
	}
    /**
	 * Display a tool bar on top of product archive
	 *
	 * @since 1.0
	 */
	function shop_toolbar() {


		$elements = '1';
		if ( ! $elements ) {
			return;
		}

		$output = array();





		$filters = '';
			$filters = sprintf( '<a href="#" class="jws-filter filters"><span>+</span> %s</a>', esc_html__( 'Filters', 'freeagent' ) );
		$found = '';
		$shop_view = '';
        
		//$sort_by = '';
		//if ( in_array( 'sort_by', $elements ) ) {
			//ob_start();
			//woocommerce_catalog_ordering();
			//$sort_by = ob_get_clean();

		//}
		$output[] = sprintf( '<div class="col-md-6 col-sm-6 col-xs-6 text-left toolbar-right">%s %s</div>', $shop_view, $filters );
        $found = '';
			global $wp_query;
			if ( $wp_query && isset( $wp_query->found_posts ) ) {
				$found = '<span>' . $wp_query->found_posts . ' </span>' . esc_html__( 'Products Found', 'freeagent' );
			}
			if ( $found ) {
				$found = sprintf( '<span class="product-found">%s</span>', $found );
			}   
		if ( $output ) {
			?>
			<div id="jws-shop-toolbar" class="shop-toolbar">
				<div class="row">
					<?php echo implode( ' ', $output ); ?>
				</div>
			</div>
			<?php
		}
	}
    
    
    /*  Search Ajax   */
function search_item_ajax(){
        
        $args = wp_parse_args( $_POST , array(
            'search'    =>  '',
        ) );

        extract( $args );
        
        $query_args = array(
            'post_type'         =>  $post_type,
            'post_status'       =>  'publish',
            'posts_per_page'    =>  50,
            'orderby'           =>  'date',
            'order'             =>  'DESC',
            's'                 =>  $s,
            'tax_query'         =>  array(),
        );
        
        
        $posts =  get_posts( apply_filters( 'freeagent/add_to_playlist', $query_args, $args ) );
  
        if( empty( $s ) ){
            $results = sprintf(
                '<p class="not-found">%s</p>',
                esc_html__( 'Keywords were not found', 'freeagent' )
            );
             wp_send_json_success( $results );
        }

        if( $posts ){

            ob_start();
                for ( $i = 0; $i < count( $posts ) ; $i++ ) { 
       
                    global $post;
                    $post = $posts[$i];
                    setup_postdata( $post );
                    
                    if ( $post_type == 'product' ) {
            				$factory = new WC_Product_Factory();
            		}

                    $post_id = get_the_ID();
                
                    echo '<div class="search-item col-xl-3 col-lg-6 col-12">';
                    
                	  if ( $post_type == 'product') {
    					$post_pro = $factory->get_product( get_the_ID() );
                        ?>
                        <div class="search-images">
                            <?php 
                                echo ''.$post_pro->get_image();
                            ?>
                        </div>
                        <div class="search-content fs-small">
                            <h6 class="fs-small"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6>
                            <?php 
                                echo ''.$post_pro->get_price_html();
                            ?>
                        </div>
                  
                        
                        
                        <?php
    				
    				} else {
	                   $archive_year  = get_the_time('Y'); 
                    	$archive_month = get_the_time('m'); 
                    	$archive_day   = get_the_time('d');
                        $format = get_post_format();
                        $price_html = jws_cost(get_the_ID());

                        ?>
                        
                        <div class="search-images">
                            <?php 
                              if ( $post_type == 'freelancers' || $post_type == 'employers' ) {
                        			if (has_post_thumbnail()) {
                        			 echo get_the_post_thumbnail( null, array( 80, 80), '' );
                        			}else{
                        			 echo '<img width="80" height="80" src="' . get_template_directory_uri() . '/assets/image/avatar.png" alt="Placeholder Image">';
                        			}
                        		}else{
                        		  echo get_the_post_thumbnail( null, array( 265, 176), '' );
                        		}

                                
                            ?>
                        </div>
                        <div class="search-content fs-small">
                            <h6 class="fs-small"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6>
                            <div class="jws_price"> <?php echo ''.$price_html;?></div>

                        </div>
                            
                        <?php
    				
                    }
                    echo '</div>';
    
                    wp_reset_postdata(); 
                }
              

            $results = ob_get_clean();
          
        }else{
            $results = sprintf(
                '<p class="not-found">%s</p>',
                esc_html__( 'Nothing matched your search terms', 'freeagent' )
            );
        }

       wp_send_json_success( $results );
        
        
    }
add_action( 'wp_ajax_jws_ajax_search', 'search_item_ajax', 10 );
add_action( 'wp_ajax_nopriv_jws_ajax_search', 'search_item_ajax', 10 );  

