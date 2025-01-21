<?php

wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );

global $post,$jws_option;
 $layout = (isset($jws_option['jobs_layout']) && $jws_option['jobs_layout']) ? $jws_option['jobs_layout'] : 'list'; 
  
  $template   = isset($_GET['layout']) ? $_GET['layout'] : $layout; 
  
  
    if(isset($_GET['sidebar']) && $_GET['sidebar']) { 
      $position = $_GET['sidebar']; 
    }else{
      $position = (isset($jws_option['jobs_position_sidebar']) && $jws_option['jobs_position_sidebar']) ? $jws_option['jobs_position_sidebar'] : 'left';  
    }
    
    if($position == 'no_sidebar'){
      $columns_content = 'col-12';  
    }elseif($template=='map'){
         $locations = array(); 
        $icon_pin =  (isset($jws_option['pin_map']['url']) && !empty($jws_option['pin_map']['url']))? $jws_option['pin_map']['url'] : get_template_directory_uri() .'/assets/image/pin_location.svg';
        $lat_default = '43.656081'; 
        $lng_default = '-79.380171';
        wp_enqueue_script( 'jws-google-maps-api');
        $position ="no_sidebar";
      $columns_content = 'col-xl-6 col-lg-12 col-12';     
    }else{
       $columns_content = 'col-xl-9 col-lg-12 col-12';       
    }
    
    
    if($template == 'classes') {
        $columns =' col-xl-6 col-lg-6 col-12';
        wp_enqueue_script( 'isotope');
    }else{
        $columns = ' col-12';
    }
    
      if($template == 'list'|| $template == 'map'){
        $layout_style='jws_job_layout5';
      }else{
        $layout_style ='';
      }
    
  $pagination = (isset($_GET['pagination']) && $_GET['pagination'] ) ? $_GET['pagination'] : (isset($jws_option['jobs_pagination']) && $jws_option['jobs_pagination'] ? $jws_option['jobs_pagination'] : 'default');


 $load_attr = 'data-ajaxify-filter=\'{"archive":".jws-jobs-archive","wrapper":".jobs_content","items":"> .jws_job_item"}\''; 	
     
?>
<div id="primary" class="content-area">
    <main id="main" class="e-con site-main jws-jobs-archive <?php if($template == 'classes') echo 'has-masonry';?>">
        <?php if($template!='map') echo '<div class="container">';
         
        ?>
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
                                    if ( is_active_sidebar( 'sidebar-job' ) ) {
                                            dynamic_sidebar( 'sidebar-job' );
                                    } 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                <div class="post_content  <?php echo ''.$template.' '.$columns_content?>">
                <?php if($template=='map') echo do_shortcode('[jws_jobs_location_search]');?>
                <div class="active-categories">
                <?php
       
                    active_categories_check(array('layout','order','orderby','sidebar','number','post_type','lay_tablet','pagination','titlebar','footer'));
                ?>
                </div>
                <div class="top_filter">
                    <div class="content_left">
                        <button class="show_filter_shop hidden_dektop <?php echo ''.$position;?>"><i class="jws-icon-plus"></i><?php echo esc_html__('Filter','freeagent'); ?></button> 
                    <div class="result-count"><?php jws_freelance_found();?></div>
                    </div>
                     
                    <div class="ordering"><?php echo generate_ordering_form_html();?></div>
                </div>
                    <div class="jobs_content freelance_content row  <?php echo ''.$layout_style.' '.$template;?>" <?php echo ''.$load_attr;?>>
                   	<?php if ( have_posts() ) :
            			while ( have_posts() ) :
            				the_post();
                         $post_id = get_the_ID();
                         $featured = get_post_meta($post_id, '_featured', true);
                        $time_ago = human_time_diff(get_the_time('U'), current_time('timestamp')) .esc_html__(' ago','freeagent');
                        $location = get_the_terms( $post_id,'jobs_locations');
                        $level =get_the_terms( $post_id,'job_level'); 
                         $job_type = get_post_meta($post_id, 'job_type', true);
                        $price_html = jws_cost($post_id);
                         $jobs_skill =get_the_terms( $post_id,'jobs_skill');
                         $job_author_id = $post->post_author;

                    
                        
                        $employer_id = Jws_Custom_User::get_employer_id( $job_author_id );
                         $employer_permalink = get_permalink($employer_id);
                        $post_date = get_the_date();
                        $display_name = get_the_title($employer_id);
                        
                         $argsproposal = array(
                            'post_type' => 'job_proposal',
                             'posts_per_page' => 1,   
                             'meta_query'     => array(
                                    array(
                                        'key'   => 'job_id',  // Assuming 'job_id' is the custom field linking job proposals to jobs
                                        'value' => get_the_ID(),
                                    ),
                                ),
                            );
                            
                            $proposals = new WP_Query($argsproposal);
                            $proposal_count = $proposals->found_posts;
                            
                            set_query_var('proposal_count', $proposal_count);
                            set_query_var('post_id', $post_id);
                            set_query_var('featured', $featured);
                            set_query_var('time_ago', $time_ago);
                            set_query_var('location', $location);
                            set_query_var('level', $level);
                            set_query_var('job_type', $job_type);
                            set_query_var('price_html', $price_html);
                            set_query_var('jobs_skill', $jobs_skill);
                            set_query_var('job_author_id', $job_author_id);
                            set_query_var('employer_id', $employer_id);
                            set_query_var('employer_permalink', $employer_permalink);
                            set_query_var('post_date', $post_date);
                            set_query_var('display_name', $display_name);
                        
            				/*
            				 * Include the Post-Format-specific template for the content.
            				 * If you want to override this in a child theme, then include a file
            				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            				 */
                            echo '<div id="'.$post_id.'" class="jws_job_item '.$columns.'">';
            				  get_template_part( 'template-parts/content/jobs/content', $template );
                            echo '</div>';
                            
                             $attach_id = get_post_thumbnail_id($employer_id);
                             $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => 'thumbnail', 'class' => 'image_map_view'));
                             $img = (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                            
                            if($template=='map'){
                                 $location_map = get_post_meta( get_the_ID(), 'map_location', true );
                                 
                              
                                 
                                $locations_inner['title'] =$display_name;
                                $locations_inner['address'] = isset($location_map['address']) ? $location_map['address'] :  '';
                                $locations_inner['latitude'] = isset($location_map['lat']) ? $location_map['lat'] :  $lat_default;
                                $locations_inner['longitude'] = isset($location_map['lng']) ? $location_map['lng'] :  $lng_default;
                                $locations_inner['url'] = get_the_permalink();
                                $locations_inner['images'] = $img;
                                $locations_inner['id'] = get_the_ID();
                               
                                if(!empty($locations_inner['address']) && !empty($locations_inner['latitude']) && !empty($locations_inner['longitude']) ) {
                                    
                                    $locations[] = $locations_inner;   
                                    
                                 }
                                                             
                            }
                            
                            
                            	
            				// End the loop.
                        
            			endwhile;
            
            
            			// If no content, include the "No posts found" template.
            		else :
            		
                      	get_template_part( 'template-parts/content/content', 'none');  
            		endif;
                 
            		?>
                    </div>
                    
                    <?php 
                    if($pagination=='number' ){
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
                       $load_attr = 'data-ajaxify-options=\'{"wrapper":".jobs_content","items":"> .jws_job_item","trigger":"click"}\''; 

                        ?>
                       <div class="jws_pagination jws_ajax">
                            <a href="<?php echo add_query_arg( 'ajaxify', '1', $url); ?>"   data-ajaxify="true" class="btn click_load_more jws-load-more" data-total-page="<?php echo esc_attr($GLOBALS['wp_query']->max_num_pages); ?>" <?php echo wp_kses_post($load_attr); ?>>
                               <span class="has-loading"><?php esc_html_e('Load More', 'freeagent'); ?></span>
                            </a>
                       </div>
                    <?php }   
                    }
                     
                    ?>
                    
                </div>
                 <?php if($template == 'map') { ?>
                     <div class="jobs-map col-xl-6 col-lg-12 col-12">
                   <div class="jws_jobs_move" data-zoom="16">
                        <div data-icon="<?php echo esc_attr($icon_pin); ?>" data-location='<?php echo wp_json_encode( $locations ); ?>' id="jobs-map-view"></div>
                     </div>   
                    </div>
                 <?php }?>
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
                                    if ( is_active_sidebar( 'sidebar-job' ) ) {
                                            dynamic_sidebar( 'sidebar-job' );
                                    } 
                                ?>
                            </div>
                          </div> 
                    </div>
                <?php } ?>
            </div>
        <?php if($template!='map') echo '</div>'?>
    </main>
</div>

