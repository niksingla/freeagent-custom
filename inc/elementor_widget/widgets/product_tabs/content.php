<?php
/**
 * View template for Clever Product Advanced.
 *
 * @package jws\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */

$inc_product_ids = $ex_product_ids = $default_asset = $filter_arr = $jws_json_config = '';
if($settings['ex_product_ids'] && is_array($settings['ex_product_ids'])){
    $ex_product_ids = $settings['ex_product_ids'];
}
if($settings['inc_product_ids'] && is_array($settings['inc_product_ids'])){
    $inc_product_ids = $settings['inc_product_ids'];
}


if ( is_front_page() ) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;   
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
}
$meta_query = WC()->query->get_meta_query();

$wc_attr = array(
    'post_type'         => 'product',
    'posts_per_page'    => $settings['posts_per_page'],
    'paged'             => $paged,
    'orderby'           => $settings['orderby'],
    'order'             => $settings['order'],
);

if(!empty($ex_product_ids)) {
  $wc_attr['post__not_in'] = $ex_product_ids;  
}

if(!empty($inc_product_ids)) {
  $wc_attr['post__in'] = $inc_product_ids;  
}

$wc_attr['product_cat']=array();
if($settings['tabs_filter'] != 'asset'){
    if($settings['default_category'] != '' && $settings['default_category'] != 'all'){
        $wc_attr['product_cat'] = $settings['default_category'];
    }
    else{
        if($settings['filter_categories']){
            $wc_attr['product_cat'] = implode(',', $settings['filter_categories']);
        }
    }
    $default_asset = $settings['asset_type'];
}
else{
    $default_asset = $settings['default_asset'];
    if($settings['filter_categories_for_asset'] != '' && $settings['filter_categories_for_asset'] != 'all'){
        $wc_attr['product_cat'] = implode(',', $settings['filter_categories_for_asset']);
    }
}


switch ($default_asset) {
    case 'featured':
    $meta_query[] = array(
        array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN'
        ),
    );
    $wc_attr['tax_query'] = $meta_query;
    break;
    case 'onsale':
    $product_ids_on_sale = wc_get_product_ids_on_sale();
    $wc_attr['post__in'] = $product_ids_on_sale;
     $wc_attr['meta_query'] = array(
        'relation' => 'OR',
        array(
            'key'           => '_sale_price',
            'value'         => 0,
            'compare'       => '>',
            'type'          => 'numeric'
        )
    );
    break;
    case 'best-selling':
    $wc_attr['meta_key'] = 'total_sales';
    $wc_attr['orderby']  = 'meta_value_num';
    break;
    case 'latest':
    $wc_attr['orderby'] = 'date';
    break;
    case 'toprate':
    $wc_attr['orderby'] = 'meta_value_num';
    $wc_attr['meta_key'] = '_wc_average_rating';
    $wc_attr['order'] = 'DESC';
    break;
    case 'deal':
    $product_ids_on_sale = wc_get_product_ids_on_sale();
    $wc_attr['post__in'] = $product_ids_on_sale;
    $wc_attr['meta_query'] = array(
        'relation' => 'AND',
        array(
            'key' => '_sale_price_dates_to',
            'value' => time(),
            'compare' => '>'
        )
    );
    break;
    default:

    
    break;
}
$settings['wc_attr'] = $wc_attr; 

$jws_wrap_class = "woocommerce products-wrap append-class jws-wrap";

$jws_json_config = '';
$settings['columns_tablet'] = isset($settings['columns_tablet']) ? $settings['columns_tablet'] : $settings['columns'];
$settings['columns_mobile'] = isset($settings['columns_mobile']) ? $settings['columns_mobile'] : $settings['columns'];
$grid_class = 'product-item product col-xl-' . $settings['columns'] . ' col-lg-' . $settings['columns_tablet'] . ' col-' . $settings['columns_mobile'] .'';
   
$filter_arr = array(
    'asset_type'            => $settings['asset_type'],
    'ex_product_ids'           => $ex_product_ids,
    'inc_product_ids'           => $inc_product_ids,
    'orderby'               => $settings['orderby'],
    'order'                 => $settings['order'],
    'posts_per_page'        => $settings['posts_per_page'],
    'filter_categories'     => $wc_attr['product_cat'],
    'display' => $settings['display'],
    'layout' => $settings['layout'],
    'columns' => $settings['columns'],
    'columns_tablet' => $settings['columns_tablet'],
    'columns_mobile' => $settings['columns_mobile']
);

$jws_json_config = '';
            $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
    		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
             $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : '';
             
             
if($settings['layout'] == 'carousel') {
     wp_enqueue_script('swiper');
    $jws_wrap_class        .= ' ' . $settings['nav_position'];
    $jws_wrap_class        .= ' jws-carousel';
       
  
    $jws_wrap_class .= '  jws-grid-lg-' . $settings['slides_to_show'] . '-cols jws-grid-md-' . $settings['slides_to_show_tablet'] . '-cols jws-grid-' . $settings['slides_to_show_mobile'] . '-cols';
    $grid_class .= ' swiper-slide';
    $class  = 'slider-layout swiper jws_product_tab_slider';
    
  
 
}else {
    $class = 'grid-layout row'; 

}
$class .= ' '.$settings['display'];

if(isset($settings['tabs_filter_display'])) {
   $jws_wrap_class .= ' tab-'.$settings['tabs_filter_display']; 
}

 
$jws_wrap_class .= ' '.$settings['layout'];


if($settings['layout'] == 'metro') { 
    wp_enqueue_script('isotope'); 
}

$product_query = new WP_Query($settings['wc_attr']);

?>
<div class="<?php echo esc_attr($jws_wrap_class) ?> " 
    data-args='<?php echo json_encode($filter_arr); ?>'
    data-paged="1"
    data-slider = '<?php echo esc_attr($jws_json_config); ?>'
    data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
    

    
        <?php if($settings['tabs_filter'] == 'cate') { ?>
     <div class="jws-head-filter has-tabs <?php echo esc_attr($settings['title'] ? 'has-border' : '');?>">   
            <ul class="jws-ajax-load filter-cate ct_ul_ol">
                <?php
                if($settings['default_category'] && isset(get_term_by('slug',$settings['default_category'], 'product_cat')->name)){
                    echo '<li><a href="'.get_term_link($settings['default_category'], 'product_cat').'" class="ajax-load active" data-type="product_cat" data-value="'.$settings['default_category'].'" >' . get_term_by('slug',$settings['default_category'], 'product_cat')->name . '</a></li>';
                }
                if($settings['filter_categories']){
                    foreach ($settings['filter_categories'] as $product_cat_slug) {
                        $product_cat = get_term_by('slug', $product_cat_slug, 'product_cat');
                        $selected = '';
                        if(isset($product_cat->slug)){
                            if (isset($settings['wc_attr']['product_cat']) && $settings['wc_attr']['product_cat'] == $product_cat->slug) {
                                $selected = 'jws-selected';
                            }
                     
                            $ajax_load = ' ajax-load';
                          
                            echo '<li><a href="' . esc_url(get_term_link($product_cat->slug, 'product_cat')) . '"
                            class="' . esc_attr($selected) . $ajax_load . '" 
                            data-type="product_cat" data-value="' . esc_attr($product_cat->slug) . '" 
                            title="' . esc_attr($product_cat->name) . '">' . esc_html($product_cat->name) . '</a></li>';
                        }
                        
                    } 
                }
                ?>
            </ul>
            <?php if(isset($settings['readmore']) && isset($settings['readmore_url']['url'])) {
                  $url = $settings['readmore_url']['url'];
                  $target = $settings['readmore_url']['is_external'] ? ' target="_blank"' : '';
                  $nofollow = $settings['readmore_url']['nofollow'] ? ' rel="nofollow"' : '';
                  echo '<a href="'.$url.'" '.$target.$nofollow.'>'.$settings['readmore'].'<i class="jws-icon-arrow-right-thin"></i></a>';   
            } ?>
        </div>    
        <?php } ?>
        <?php if($settings['tabs_filter'] == 'asset') { ?>
        <div class="jws-head-filter has-tabs <?php echo esc_attr($settings['title'] ? 'has-border' : '');?>">
            <ul class="jws-ajax-load filter-asset ct_ul_ol">
              <?php
              $asset_title = '';
              switch ( $settings['default_asset'] ) {
                 case 'featured':
                 $asset_title = esc_html__( 'Featured', 'freeagent' );
                 break;
                 case 'onsale':
                 $asset_title = esc_html__( 'On Sale', 'freeagent' );
                 break;
                 case 'deal':
                 $asset_title = esc_html__( 'Deal', 'freeagent' );
                 break;
                 case 'latest':
                 $asset_title = esc_html__( 'New Arrivals', 'freeagent' );
                 break;
                 case 'best-selling':
                 $asset_title = esc_html__( 'Best sellers', 'freeagent' );
                 break;
                 case 'toprate':
                 $asset_title = esc_html__( 'Top Rate', 'freeagent' );
                 break;
                 default:
                 break;
             }
             if ( $asset_title ) { ?>
                <li class="cvca-ajax-load">
                    <a href="#" class="active ajax-load" data-type="asset_type"
                    data-value="<?php echo esc_attr( $settings['default_asset'] ) ?>"
                    title="<?php echo esc_attr( $asset_title ); ?>"><?php echo esc_attr( $asset_title ); ?></a>
                </li>

                <?php
            }
            $html = '';
            if ( $settings['filter_assets'] ) {

             foreach ( $settings['filter_assets'] as $val ) {
                switch ( $val ) {
                   case 'featured':
                   $html .= $settings['default_asset'] != 'featured' ? '<li><a href="#" class=" ajax-load" data-type="asset_type" data-value="featured" title="' . esc_html__( 'Featured', 'freeagent' ) . '">' . esc_html__( 'Featured', 'freeagent' ) . '</a></li>' : '';
                   break;
                   case 'onsale':
                   $html .= $settings['default_asset'] != 'onsale' ? '<li><a href="#" class=" ajax-load" data-type="asset_type" data-value="onsale" title="' . esc_html__( 'On Sale', 'freeagent' ) . '">' . esc_html__( 'On Sale', 'freeagent' ) . '</a></li>' : '';
                   break;
                   case 'deal':
                   $html .= $settings['default_asset'] != 'deal' ? '<li><a href="#" class=" ajax-load" data-type="asset_type" data-value="deal" title="' . esc_html__( 'Deal', 'freeagent' ) . '">' . esc_html__( 'Deal', 'freeagent' ) . '</a></li>' : '';
                   break;
                   case 'latest':
                   $html .= $settings['default_asset'] != 'latest' ? '<li><a href="#" class=" ajax-load" data-type="asset_type" data-value="latest" title="' . esc_html__( 'New Arrivals', 'freeagent' ) . '">' . esc_html__( 'New Arrivals', 'freeagent' ) . '</a></li>' : '';
                   break;
                   case 'best-selling':
                   $html .= $settings['default_asset'] != 'best-selling' ? '<li><a href="#" class=" ajax-load" data-type="asset_type" data-value="best-selling" title="' . esc_html__( 'Best sellers', 'freeagent' ) . '">' . esc_html__( 'Best Seller', 'freeagent' ) . '</a></li>' : '';
                   break;
                   case 'toprate':
                   $html .= $settings['default_asset'] != 'toprate' ? '<li><a href="#" class=" ajax-load" data-type="asset_type" data-value="toprate" title="' . esc_html__( 'Top Rate', 'freeagent' ) . '">' . esc_html__( 'Top Rate', 'freeagent' ) . '</a></li>' : '';
                   break;
                   default:
                   break;
               }
           }
       }

       echo ent2ncr( $html ); ?>
   </ul>
   </div>
   <?php
}
?>

<div class="products-tab <?php echo esc_attr($class) ?>">
    <?php
        if($settings['layout'] == 'carousel') echo '<div class="swiper-wrapper" >';  
                                                                                                                                                                                                
        $i = 1;
        while ($product_query->have_posts()) : $product_query->the_post();
            
            if($settings['layout'] == 'metro') {
             
               if($i == '6' || $i == '21') {
                  $grid_class = 'product-item product col-xl-40 col-lg-40 col-6';  
                  $image_size = 'full';
               }else {
                  $grid_class = 'product-item grid-sizer product col-xl-20 col-lg-20 col-6';  
                  $image_size = '';
               }
            
            }
            if ($i == 24) {
                $i = 1;
            }else {
               $i ++;  
            }
            if($settings['layout'] == 'carousel'){
                $grid_class = 'product-item product swiper-slide'; 
            }
            ?>
             <div class="<?php echo esc_attr($grid_class); ?>">
                    <?php 
                    
                        include( JWS_ABS_PATH_WC.'/archive-layout/content-'.$settings['display'].'.php' );
                    ?>
             </div>
             <?php 
        
        endwhile;
       
       if($settings['layout'] == 'carousel') echo '</div>'; 
       if($show_arrows && $settings['layout'] == 'carousel') : ?>
        <button class="elementor-swiper-button elementor-swiper-button-prev">
         <?php $this->render_swiper_button( $settings, 'prev' ); ?>
        </button>
        <button class="elementor-swiper-button elementor-swiper-button-next">
         <?php $this->render_swiper_button( $settings, 'next' ); ?>
        </button>
    <?php endif; ?>
    <?php  if($show_dots && $settings['layout'] == 'carousel') echo '<div class="swiper-pagination"></div>';?>

</div>


<?php if ( $product_query->max_num_pages > 1 && $settings['pagination_tab'] == 'numeric') {?>
    <div class="jws_product_pagination">
        <?php echo jws_query_pagination($product_query); ?>
    </div>
<?php } ?>

<?php if ( $product_query->max_num_pages > 1 && $settings['pagination_tab'] == 'ajaxload') { ?>
    <div class="jws_product_pagination">
         <a class="jws-products-load-more" href="#">
            <span class="more_product"><?php echo esc_html__('Load More','freeagent'); ?></span>
         </a>
    </div>
<?php } ?>

<?php
wp_reset_postdata();
?>

</div>