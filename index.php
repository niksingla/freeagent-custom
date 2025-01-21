<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage freeagent
 * @since 1.0.0
 */

get_header();
wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
$blog = jws_blog_page();
 wp_enqueue_script('isotope');  

?>
<div id="primary" class="content-area">
		<main id="main" class="e-con site-main jws-blog-archive <?php echo 'sidebar-'.esc_attr($blog['position_sidebar']); ?>">
        <div class="container">
        <div class="row">
             <?php if($blog['position_sidebar'] == 'left' && $blog['check-content-sidebar']) : ?>
                <div class="<?php echo esc_attr($blog['sidebar_col']); ?>">
                     <div class="main-sidebar jws_sticky_move">
                            <div class="jws-filter-modal">
                            <div class="modal-overlay"></div>
                            <div class="siderbar-inner jws-scrollbar modal-content sidebar">
                            <div class="modal-top">
                                <span class="modal-title">FILTERS</span>
                                <span class="modal-close">Close</span>
                            </div>
                        	<?php
                                if ($blog['select-sidebar-post']) { 
                                       echo do_shortcode('[hf_template id="' . $blog['select-sidebar-post'] . '"]'); 
                                }else {
                                   if ( is_active_sidebar( 'sidebar-main' ) ) {
                        			     dynamic_sidebar( 'sidebar-main' );
                        		   } 
                                }	
    		                 ?>
                             </div>
                             </div>
                    </div>
                </div>
            <?php endif; ?> 
            <div class="<?php echo esc_attr($blog['content_col']); ?>">
                <div class="jws_blog_grid jws_blog_layout5 row <?php echo esc_attr($blog['layout']); ?>">
                	<?php if ( have_posts() ) :
                    
            			while ( have_posts() ) :
            				the_post();
            
            				/*
            				 * Include the Post-Format-specific template for the content.
            				 * If you want to override this in a child theme, then include a file
            				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            				 */
            				get_template_part( 'template-parts/content/content' );
            
            				// End the loop.
            			endwhile;
            
            
            			// If no content, include the "No posts found" template.
            		else :
            			get_template_part( 'template-parts/content/content', 'none' );
            
            		endif;
            		?>
                    </div> 
                    <?php global $wp_query;  
                    if($blog['pagination']=='number'){
                      echo function_exists('jws_query_pagination') ? jws_query_pagination($wp_query) : '';  
                    } else{
                      $number_page = $wp_query->max_num_pages;
                       $pagi_number = jws_query_pagination($wp_query);
                       $url = get_next_posts_page_link( $GLOBALS['wp_query']->max_num_pages );
                      
                       if (get_next_posts_link()) {
                         wp_enqueue_script( 'isotope');
                        wp_enqueue_script( 'imageload'); 
                         $load_attr = 'data-ajaxify-options=\'{"wrapper":".jws_blog_grid","items":"> .jws_blog_item","trigger":"click"}\''; 

                        ?>
                       <div class="jws_pagination jws_ajax">
                            <a href="<?php echo add_query_arg( 'ajaxify', '1', $url); ?>"   data-ajaxify="true" class="btn click_load_more jws-load-more"  <?php echo wp_kses_post($load_attr); ?>>
                               <span class="has-loading"><?php esc_html_e('Load More', 'freeagent'); ?></span>
                            </a>
                       </div>
                    <?php }   
                    }
                     
                    ?>
                      
            </div>
            <?php if($blog['position_sidebar'] == 'right' && $blog['check-content-sidebar'] ) : ?>
                <div class="<?php echo esc_attr($blog['sidebar_col']); ?>">
                    <div class="main-sidebar jws_sticky_move">
                            <div class="jws-filter-modal">
                            <div class="modal-overlay"></div>
                            <div class="siderbar-inner jws-scrollbar modal-content sidebar">
                            <div class="modal-top">
                                <span class="modal-title">FILTERS</span>
                                <span class="modal-close">Close</span>
                            </div>
                        	<?php
                                if ($blog['select-sidebar-post']) { 
                                             echo do_shortcode('[hf_template id="' . $blog['select-sidebar-post'] . '"]'); 
                                }else {
                                   if ( is_active_sidebar( 'sidebar-main' ) ) {
                        			     dynamic_sidebar( 'sidebar-main' );
                        		   } 
                                }	
    		                 ?>
                             </div>
                             </div>
                    </div>
                </div>
            <?php endif; ?>    
        </div>
	
        </div>
        <?php
         $banner = jws_theme_get_option('select-banner-after-blog');
          echo !empty($banner) ? '<div class="blog-banner-content">'.do_shortcode('[hf_template id="'.$banner.'"]').'</div>' : '';     
        ?>
		</main><!-- #main -->
	</div><!-- #primary -->  
<?php
get_footer();