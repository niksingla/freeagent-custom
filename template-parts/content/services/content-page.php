<?php

wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );

global $post,$jws_option;
 $layout = (isset($jws_option['services_layout']) && $jws_option['services_layout']) ? $jws_option['services_layout'] : 'classic'; 
  
  $template   = isset($_GET['layout']) ? $_GET['layout'] : $layout; 
  
  
    if(isset($_GET['sidebar']) && $_GET['sidebar']) { 
      $position = $_GET['sidebar']; 
    }else{
      $position = (isset($jws_option['services_position_sidebar']) && $jws_option['services_position_sidebar']) ? $jws_option['services_position_sidebar'] : 'left';  
    }
    
    if($position == 'no_sidebar'){
      $columns_content = 'col-12';  
    }else{
       $columns_content = 'col-xl-9 col-lg-12 col-12';       
    }
    
      if($template == 'classic'){
        $layout_style='jws-services-layout1';
      }else{
        $layout_style ='jws-services-layout3';
      }
      
     $columns =  (isset($jws_option['services_columns']) && !empty($jws_option['services_columns']) ) ? $jws_option['services_columns'] : '3';
     $columns_table = isset($_GET['lay_tablet']) ? $_GET['lay_tablet'] : (isset($jws_option['services_columns_tablet']) ? $jws_option['services_columns_tablet']:6);

   
    $getlayout   = isset($_GET['lay_style']) ? $_GET['lay_style'] : $columns; 
    
    if($getlayout == '1') {
        $columns =' col-12 col-lg-'.$columns_table.' col-'.$jws_option['services_columns_mobile'];
    }
    if($getlayout == '4') {
        $columns = ' col-xl-3 col-lg-'.$columns_table.' col-'.$jws_option['services_columns_mobile'];
    }
    if($getlayout == '2') {
        $columns = ' col-xl-6 col-lg-'.$columns_table.' col-'.$jws_option['services_columns_mobile'];
    }
    if($getlayout == '3') {
        $columns = ' col-xl-4 col-lg-'.$columns_table.' col-'.$jws_option['services_columns_mobile'];
    } 
	
 $load_attr = 'data-ajaxify-filter=\'{"archive":".jws-services-archive","wrapper":".services_content","items":"> .jws-services-item"}\''; 	
     
?>
<div id="primary" class="content-area">
    <main id="main" class="e-con site-main jws-services-archive ">
       <div class="container">
            <div class="row">
                <?php if($position == 'left') { ?>
                <div class="freelance_sidebar sidebar-has_sidebar col-xl-3 col-lg-12 col-12">
                     <div class="main-sidebar jws_sticky_move">
                         <div class="jws-filter-modal">
                            <div class="modal-overlay"></div>
                            <div class="siderbar-inner jws-scrollbar modal-content sidebar left">
                            <div class="modal-top">
                                <span class="modal-title"><?php echo esc_html__('Filter','freeagent'); ?></span>
                                <span class="modal-close"><?php echo esc_html__('Close','freeagent'); ?></span>
                            </div>
                                <?php
                                    if ( is_active_sidebar( 'sidebar-service' ) ) {
                                            dynamic_sidebar( 'sidebar-service' );
                                    } 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                <div class="post_content  <?php echo esc_attr($template.' '.$columns_content); ?>">
                <?php if($template=='map') echo do_shortcode('[jws_jobs_location_search]');?>
                <div class="active-categories">
                <?php
                    active_categories_check(array('layout','lay_style','number','sidebar','post_type','lay_tablet','order','orderby'));
                ?>
                </div>
                <div class="top_filter">
                    <div class="content_left">
                        <button class="show_filter_shop hidden_dektop <?php echo esc_attr($position);?>"><i class="jws-icon-plus"></i><?php echo esc_html__('Filter','freeagent'); ?></button> 
                    <div class="result-count"><?php jws_freelance_found();?></div>
                    </div>
                     
                    <div class="ordering"><?php echo generate_ordering_form_html();?></div>
                </div>
                    <div class="services_content freelance_content row  <?php echo esc_attr($layout_style.' '.$template); ?>" <?php echo ''.$load_attr;?>>
                   	<?php if ( have_posts() ) :
            			while ( have_posts() ) :
            				the_post();
                         $post_id = get_the_ID();
                         $image_size = '800x504';
                        
                         $job_author_id = $post->post_author;
                        $format = has_post_format() ? get_post_format() : 'no_format'; 

                        $job_author_id = $post->post_author;
                        $freelancer_id = Jws_Custom_User::get_freelaner_id( $job_author_id );
                         $freelancer_permalink = get_permalink($freelancer_id);
                         $display_name = get_the_title($freelancer_id);
                        
                        $services_price = get_post_meta($post_id, 'services_price', true); 
                        $services_type = get_post_meta($post_id, 'services_type', true);
                        
                        $args = wp_parse_args( $args, array(
                            'addon_ids'   =>  '',
                            'price_addons' => '',
                           
                        ) );
                        
                        extract( $args );
                        $price_html='';
                        if($services_type == '2') {
                            
                            $package_service = get_field('package_service',$post_id); 
                         
                            if (is_array($package_service)) {
                            foreach($package_service as $key => $package) {
                              $price_html= jws_format_price((int) $price_addons + (int) $package['package_price']); 
                                break;
                            }
                            }
                          }else{
                            $price_html = jws_format_price($services_price);
                          }
                          
                           $argsValue = compact('format','image_size','post_id','freelancer_permalink', 'display_name', 'price_html' );
            				/*
            				 * Include the Post-Format-specific template for the content.
            				 * If you want to override this in a child theme, then include a file
            				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            				 */
                             echo '<div class="jws-services-item '.$columns.'">';
            				get_template_part( 'template-parts/content/services/content', $template,$argsValue);
                            echo '</div>';
                            
            				// End the loop.
            			endwhile;
            
            
            			// If no content, include the "No posts found" template.
            		else :
            			get_template_part( 'template-parts/content/content', 'none' );
            
            		endif;
            		?>
                    </div>
                    
                    <?php 
                    if($jws_option['services_pagination']=='number'){
                          echo '<div class="pagination"><div class="post_per_page">';
                          jws_freelance_number_of_post();
                          echo '</div>';
                         
                          echo function_exists('jws_query_pagination') ? jws_query_pagination($wp_query) : '';  
                          echo '</div>'; 
                    } else{
                      $number_page = $wp_query->max_num_pages;
                       $pagi_number = jws_query_pagination($wp_query);
                       $url = get_next_posts_page_link( $GLOBALS['wp_query']->max_num_pages );
                          wp_enqueue_script( 'isotope');
                        wp_enqueue_script( 'imageload'); 
                       if (get_next_posts_link()) { 
                       $load_attr = 'data-ajaxify-options=\'{"wrapper":".services_content","items":"> .jws-services-item","trigger":"click"}\''; 

                        ?>
                       <div class="jws_pagination jws_ajax">
                            <a href="<?php echo add_query_arg( 'ajaxify', '1', $url); ?>"   data-ajaxify="true" class="btn <?php  if($jws_option['services_pagination'] == 'loadmore') : echo esc_attr('click_load_more'); else: echo esc_attr('auto_load_more'); endif; ?> jws-load-more" data-total-page="<?php echo esc_attr($GLOBALS['wp_query']->max_num_pages); ?>" <?php echo wp_kses_post($load_attr); ?>>
                               <span class="has-loading"><?php esc_html_e('Load More', 'freeagent'); ?></span>
                            </a>
                                 <?php
                                    if($jws_option['services_pagination'] == 'infinity') { ?>
                                       <div class="spinner">
                                            <?php 
                                                for ($i = 1; $i <= 8; $i++) {
                                                    echo '<div class="spinner-blade"></div>';
                                                }
                                            ?>
                                       </div> 
                                    <?php }
                                 ?>
                       </div>
                    <?php }   
                    }
                     
                    ?>

                    
                   
                    
                    
                </div>

                <?php if($position == 'no_sidebar') { ?>
                    <div class="main-sidebar jws_sticky_move">
                        <div class="jws-filter-modal">
                            <div class="modal-overlay"></div>
                            <div class="siderbar-inner modal-content sidebar jws-scrollbar modal">
                            <div class="modal-top">
                                <span class="modal-title"><?php echo esc_html__('Filter','freeagent'); ?></span>
                                <span class="modal-close"><?php echo esc_html__('Close','freeagent'); ?></span>
                            </div>
                                <?php
                                    if ( is_active_sidebar( 'sidebar-service' ) ) {
                                            dynamic_sidebar( 'sidebar-service' );
                                    } 
                                ?>
                            </div>
                          </div> 
                    </div>
                <?php } ?>
            </div>
       </div>
    </main>
</div>

