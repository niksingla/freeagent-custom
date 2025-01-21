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
jws_gt_set_post_view();
global $post;
$post_id = get_the_ID();  
$current_user_id = get_current_user_id();   
$cover_image = get_post_meta($post_id,'cover_image', true);
$banner_bg = (isset($cover_image) && !empty($cover_image)) ?  wp_get_attachment_url($cover_image) : get_template_directory_uri() . '/assets/image/banner.svg';
$author_id = $post->post_author;
$employer_id = Jws_Custom_User::get_employer_id( $author_id );

$args = compact('post_id','current_user_id','author_id');

?>
<div class="cover_image" style="background: url('<?php echo ''.$banner_bg;?>');height:400px;width:100%;background-size: cover;background-repeat: no-repeat; background-position: center;">

</div>
<div class="e-con site-main jws-employers-single single_freelance">
    <div class="container">
        <div class="row">
            <div class="author_infor col-xl-4 col-lg-12 col-12">
                <?php get_template_part( 'template-parts/content/employers/single/sidebar' , '' , $args );?>
            </div>
            <div class="post_content col-xl-8 col-lg-12 col-12">
                <div class="introduction">
                    <div class="title_intro"><?php echo esc_html__('About Us','freeagent');?></div>
                    <div class="content_intro"><?php echo get_the_content();?></div>
                </div>
                
                <div class="posted_projects">
                <div class="title_intro"><?php echo esc_html__('Listed projects','freeagent');?></div>
                <?php
                
                 
                    $author_name = get_the_title();
                    $author_thumbnail = get_the_post_thumbnail($post_id, [60, 60]); // Adjust the size as needed
                    // Job Query
                    $args = array(
                        'post_type' => 'jobs',
                        'author' => $author_id, // Change to your actual custom post type for jobs
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                    );
                
                    $jobs_query = new WP_Query($args);
                
                    // Display jobs
                    if ($jobs_query->have_posts()) :
                        while ($jobs_query->have_posts()) :
                            $jobs_query->the_post();
                             $post_id = get_the_ID();  
                             set_query_var('post_id', $post_id);   
                            set_query_var('author_name', $author_name);
                             set_query_var('author_thumbnail', $author_thumbnail);
                            echo '<div class="jws_job_layout5">
                            <div class="jws_job_item ">';
                             get_template_part( 'template-parts/content/jobs/content-list' );
                            echo '</div>
                            </div>';
                
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo esc_html__('No jobs found for this employer.','freeagent');
                    endif;
                
                ?>

                </div>

            </div>
        </div>
    </div>
</div>

<?php
get_footer();