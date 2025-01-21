<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage freeagent
 * @since 1.0.0
 */

get_header();
wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
global $jws_option; 
wp_enqueue_script('swiper');
$sidebar = (isset($_GET['sidebar']) && $_GET['sidebar'] == 'full' ) ? $_GET['sidebar'] : (isset($jws_option['position_sidebar_blog_single']) && $jws_option['position_sidebar_blog_single'] ? $jws_option['position_sidebar_blog_single'] : 'right');

$layout = 'layout1';    
 if(isset($_GET['layout']) && $_GET['layout']) { 
  $layout = $_GET['layout'];  
}
 $image_size = (isset($jws_option['single_blog_imagesize']) && !empty($jws_option['single_blog_imagesize'])) ? $jws_option['single_blog_imagesize'] : 'full';
if($sidebar == 'full'|| ((did_action( 'elementor/loaded' )) && \Elementor\Plugin::$instance->editor->is_edit_mode()) || empty($jws_option)) {
   $content_col = 'col-xl-12 col-12'; 
   $sidebar_col = 'postt_sidebar sidebar-has_sidebar main-sidebar';
   $class = ' no_sidebar';
}else {
   $content_col = 'post_content col-xl-9 col-lg-12 col-12';
   $sidebar_col = 'post_sidebar sidebar-has_sidebar main-sidebar col-xl-3 col-lg-12 col-12'; 
   $class = ' has_sidebar'; 
}
$position_sidebar = (isset($jws_option['position_sidebar_blog_single'])) ? $jws_option['position_sidebar_blog_single'] : 'right';
$class .= ' sidebar_'.$position_sidebar;


$class .= ' layout_'.$layout;

$related_post = '';

if(isset($_GET['related_post'])) {
    $related_post = 'default_related';
}else{
    $related_post = isset($jws_option['select-sidebar-post-single']) ? $jws_option['select-sidebar-post-single'] : '';    
}

if(isset($_GET['selected_layout'])) {
  $selected_layout = $_GET['selected_layout'];
}else{
  $selected_layout = isset($jws_option['select-related-blog']) ? $jws_option['select-related-blog'] : '';    
}


$format = get_post_format();

?>
	<div id="primary" class="content-area single_blog ">
		<main id="main" class="site-main">
            <div class=" e-con single-blog<?php echo esc_attr($class); ?> single_<?php echo esc_attr($format);?>">

            <div class="container">
                <div class="row">
                    <?php if($sidebar == 'left') : ?>
                        <div class="<?php echo esc_attr($sidebar_col); ?>">
                            <?php
                                if (isset($jws_option['select-sidebar-post-single']) && !empty($jws_option['select-sidebar-post-single'])) { 
                                             echo do_shortcode('[hf_template id="' . $jws_option['select-sidebar-post-single'] . '"]'); 
                                }else {
                                   if ( is_active_sidebar( 'sidebar-single-blog' ) ) {
                        			     dynamic_sidebar( 'sidebar-single-blog' );
                        		   } 
                                }	
    		                 ?>
                        </div>
                    <?php endif; ?>    
                    <div class="<?php echo esc_attr($content_col); ?>">
                        <?php
                			/* Start the Loop */
                			while ( have_posts() ) :
                				the_post();
                               

                                   get_template_part( 'template-parts/content/blog/single/layout/'.$layout.'' );
 
                             
                                 
                			endwhile; // End of the loop.
                            ?>
                        <footer>
                            <?php
                           
                                get_template_part( 'template-parts/content/blog/single/template/author_box/author_box1' );
                                  
                                get_template_part( 'template-parts/content/blog/single/template/nav/nav2' ); 
                            ?>

                           </footer>
            		
                    </div>
                    <?php if($sidebar == 'right') : ?>
                        <div class="<?php echo esc_attr($sidebar_col); ?>">
                              <div class="main-sidebar jws_sticky_move">
                            	<?php
                                     if (isset($jws_option['select-sidebar-post-single']) && !empty($jws_option['select-sidebar-post-single'])) { 
                                             echo do_shortcode('[hf_template id="' . $jws_option['select-sidebar-post-single'] . '"]'); 
                                    }else {
                                       if ( is_active_sidebar( 'sidebar-single-blog' ) ) {
                            			     dynamic_sidebar( 'sidebar-single-blog' );
                            		   } 
                                    }	
        		                 ?>
                            </div>
                        </div>
                    <?php endif; ?> 

                </div> 
                    <?php 
                      if (did_action( 'elementor/loaded' ) ) { 
                         if((isset($selected_layout) && !empty($selected_layout))&& $related_post!='default_related') {
                        
                         ?>
                         <div class="post-related jws-blog-element">
                                <?php echo do_shortcode('[hf_template id="' . $selected_layout . '"]'); ?>

                        </div>
                        <?php
                         }else {
                            
                            if($sidebar=='full'){
                                $number_post = 3;
                            }else{
                              $number_post = 3;  
                            }
                            
                            ?>
                            <div class="post-related jws-blog-element">
                             <h4 class="related_post_heading"><?php esc_html_e('You may also like','freeagent'); ?></h4>
                             <div class="swiper post_related_slider jws_blog_layout2" data-swiper='{"slidesPerView":1,"spaceBetween": 30, "loop":false, "breakpoints": {"768": {"slidesPerView": 2}, "992": {"slidesPerView": 3}}}'>
                             

                                <div class="swiper-wrapper">
                                <?php  get_template_part( 'template-parts/content/blog/single/template/related' ); ?>
                                </div>
                             
                             </div>
                             
                            </div>
                           <?php 
                        }  
                      }
                      ?>
                                     
                <?php
                    // If comments are open or we have at least one comment, load up the comment template.
    				if ( comments_open() || get_comments_number() ) {
    					comments_template();
    				}
                ?>
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