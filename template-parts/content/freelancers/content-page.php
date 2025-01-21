<?php
get_header();
wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );


global $post,$jws_option;
 $layout = (isset($jws_option['freelancers_layout']) && $jws_option['freelancers_layout']) ? $jws_option['freelancers_layout'] : 'classes'; 
  
  $template   = isset($_GET['layout']) ? $_GET['layout'] : $layout; 
  
  
    if(isset($_GET['sidebar']) && $_GET['sidebar']) { 
      $position = $_GET['sidebar']; 
    }else{
      $position = (isset($jws_option['freelancers_position_sidebar']) && $jws_option['freelancers_position_sidebar']) ? $jws_option['freelancers_position_sidebar'] : 'left';  
    }
    
    if($position == 'no_sidebar'){
      $columns_content = 'col-12';  
    }else{
       $columns_content = 'col-xl-9 col-lg-12 col-12';       
    }
    if($template=='classes'){
       $layout_style = ' jws-freelancers-layout1';
    }else{
        $layout_style = ' jws-freelancers-layout2';
    }
    $columns =  (isset($jws_option['freelancers_columns']) && !empty($jws_option['freelancers_columns']) ) ? $jws_option['freelancers_columns'] : '3';
    $getlayout   = isset($_GET['lay_style']) ? $_GET['lay_style'] : $columns; 
    
    if($getlayout == '1') {
        $columns =' col-12 col-lg-'.$jws_option['freelancers_columns_tablet'].' col-'.$jws_option['freelancers_columns_mobile'];
    }
    if($getlayout == '4') {
        $columns = ' col-xl-3 col-lg-'.$jws_option['freelancers_columns_tablet'].' col-'.$jws_option['freelancers_columns_mobile'];
    }
    if($getlayout == '2') {
        $columns = ' col-xl-6 col-lg-'.$jws_option['freelancers_columns_tablet'].' col-'.$jws_option['freelancers_columns_mobile'];
    }
    if($getlayout == '3') {
        $columns = ' col-xl-4 col-lg-'.$jws_option['freelancers_columns_tablet'].' col-'.$jws_option['freelancers_columns_mobile'];
    } 
   if($template=='list'){
    $columns=' col-12';
   } 	
    $load_attr = 'data-ajaxify-filter=\'{"archive":".jws-freelancers-archive","wrapper":".freelancers_content","items":"> .jws-services-item"}\'';  
?>
<div id="primary" class="content-area">
    <main id="main" class="e-con site-main jws-freelancers-archive ">
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
                                    if ( is_active_sidebar( 'sidebar-freelancers' ) ) {
                                            dynamic_sidebar( 'sidebar-freelancers' );
                                    } 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                <div class="post_content  <?php echo ''.$template.' '.$columns_content?>">
                
                <div class="active-categories">
                    <?php
                       active_categories_check(array('layout','lay_style','number','sidebar','post_type','lay_tablet','order','orderby'));
                    ?>
                </div>
                <div class="top_filter">
                    <div class="content_left">
                        <button class="show_filter_shop hidden_dektop <?php echo ''.$position;?>"><i class="jws-icon-plus"></i><?php echo esc_html__('Filter','freeagent'); ?></button> 
                    <div class="result-count"><?php jws_freelance_found();?></div>
                    </div>
                     
                    <div class="ordering"><?php echo generate_ordering_form_html();?></div>
                </div>   
                    <div class="freelancers_content freelance_content row  <?php echo ''.$layout_style.' '.$template;?>" <?php echo ''.$load_attr;?>>
                   	<?php if ( have_posts() ) :
            			while ( have_posts() ) :
            				the_post();
                          

            				/*
            				 * Include the Post-Format-specific template for the content.
            				 * If you want to override this in a child theme, then include a file
            				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            				 */
                             echo '<div class="jws_job_item '.$columns.'">';
            				get_template_part( 'template-parts/content/freelancers/content', $template);
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
                  
                          echo '<div class="pagination"><div class="post_per_page">';
                          jws_freelance_number_of_post();
                          echo '</div>';
                          echo function_exists('jws_query_pagination') ? jws_query_pagination($wp_query) : '';  
                          echo '</div>'; 
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
                                    if ( is_active_sidebar( 'sidebar-freelancers' ) ) {
                                            dynamic_sidebar( 'sidebar-freelancers' );
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
<?php
get_footer();
