<?php
wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
$layout = jws_check_layout_employers();

    if(isset($_GET['layout']) && $_GET['layout']) { 
      $position = $_GET['layout']; 
    }else{
      $position = (isset($jws_option['shop_position_sidebar']) && $jws_option['shop_position_sidebar']) ? $jws_option['shop_position_sidebar'] : 'no_sidebar'; 
      
    }
    if($layout['employers_columns'] == '1') {
        $columns =' col-12 col-lg-'.$layout['employers_columns_tablet'].' col-'.$layout['employers_columns_mobile'];
    }
    if($layout['employers_columns'] == '4') {
        $columns = ' col-xl-3 col-lg-'.$layout['employers_columns_tablet'].' col-'.$layout['employers_columns_mobile'];
    }
    if($layout['employers_columns'] == '2') {
        $columns = ' col-xl-6 col-lg-'.$layout['employers_columns_tablet'].' col-'.$layout['employers_columns_mobile'];
    }
    if($layout['employers_columns'] == '3') {
        $columns = ' col-xl-4 col-lg-'.$layout['employers_columns_tablet'].' col-'.$layout['employers_columns_mobile'];
    } 
    $load_attr = 'data-ajaxify-filter=\'{"archive":".jws-employers-archive","wrapper":".employer_content","items":"> .jws_employer_item"}\'';  
?>
<div id="primary" class="content-area">
    <main id="main" class="e-con site-main jws-employers-archive ">
        <div class="container">
            <div class="row">
                <?php if($layout['position'] == 'left') { ?>
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
                                    if ( is_active_sidebar( 'sidebar-employer' ) ) {
                                            dynamic_sidebar( 'sidebar-employer' );
                                    } 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                <div class="<?php echo ''.$layout['content_col']?>">
                <div class="active-categories">
                <?php
                   active_categories_check(array('layout','lay_style','number','post_type','lay_tablet','order','orderby'));
                ?>
                </div>
                <div class="top_filter">
                    <div class="content_left">
                        <button class="show_filter_shop hidden_dektop <?php echo ''.$layout['position'];?>"><i class="jws-icon-plus"></i><?php echo esc_html__('Filter','freeagent'); ?></button> 
                    <div class="result-count"><?php jws_freelance_found();?></div>
                    </div>
                     
                    <div class="ordering"><?php echo generate_ordering_form_html();?></div>
                </div>
                    <div class="employer_content freelance_content row jws_employer_layout1" <?php echo ''.$load_attr;?>> 
                   	<?php if ( have_posts() ) :
            			while ( have_posts() ) :
            				the_post();
            
            				/*
            				 * Include the Post-Format-specific template for the content.
            				 * If you want to override this in a child theme, then include a file
            				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            				 */
                             echo '<div class="jws_employer_item '.$columns.'">';
            				get_template_part( 'template-parts/content/employers/content' );
                            echo '</div>';
            
            				// End the loop.
            			endwhile;
            
            
            			// If no content, include the "No posts found" template.
            		else :
            			get_template_part( 'template-parts/content/content', 'none' );
            
            		endif;
            		?>
                    </div>
                    <div class="pagination">
                        <div class="post_per_page"><?php jws_freelance_number_of_post();?></div>
                         <?php 
                     
                          echo function_exists('jws_query_pagination') ? jws_query_pagination($wp_query) : '';   
                        ?>
                    </div>
                   
                    
                    
                </div>
                <?php if($layout['position'] == 'no_sidebar') { ?>
                    <div class="main-sidebar jws_sticky_move">
                        <div class="jws-filter-modal">
                            <div class="modal-overlay"></div>
                            <div class="siderbar-inner modal-content sidebar jws-scrollbar modal">
                            <div class="modal-top">
                                <span class="modal-title"><?php echo esc_html__('Filter','freeagent'); ?></span>
                                <span class="modal-close"><?php echo esc_html__('Close','freeagent'); ?></span>
                            </div>
                            <?php
                                    if ( is_active_sidebar( 'sidebar-employer' ) ) {
                                            dynamic_sidebar( 'sidebar-employer' );
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
