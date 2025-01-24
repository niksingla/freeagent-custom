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
    $content = get_the_content();
    $excerpt = get_the_excerpt();  
    $post_id = get_the_ID();
    $location = get_the_terms( $post_id,'freelancers_location');
    $freelancers_skill =get_the_terms( $post_id,'freelancers_skill');
    $hourly_rate =get_post_meta( $post_id,'min_price', true);
    $min_price = get_post_meta($post_id, 'min_price', true);
    $price_html = jws_format_price($min_price);
    $freelancers_position =get_post_meta( $post_id,'freelancers_position', true);
    
    set_query_var('content', $content);
    set_query_var('excerpt', $excerpt);
    set_query_var('post_id', $post_id);
    set_query_var('location', $location);
    set_query_var('freelancers_skill', $freelancers_skill);
    set_query_var('hourly_rate', $hourly_rate);
    set_query_var('price_html', $price_html);
    set_query_var('freelancers_position', $freelancers_position);
    $cover_image = get_post_meta($post_id,'cover_image', true);
    $banner_bg = (isset($cover_image) && !empty($cover_image)) ? wp_get_attachment_url($cover_image) : get_template_directory_uri() . '/assets/image/banner.svg';


?>
<style>
    .jws-freelancers-single .tab_content :is(.links.active,.services.active,.comments-review.active){
        display: block;
        animation: jws_fadeInUp 0.3s both;
        -webkit-animation: jws_fadeInUp 0.3s both;
        border-radius: 10px;
        padding: 24px;
        background: #fff;        
        margin-top: 25px;
    }
    .jws-links-item:not(.jws-links-item:last-child) {
        margin-bottom: 24px;
    }
    .jws-freelancers-single .location-cus{
        margin-top: 0;
    }
    .fee_from {
        margin-top: 8px;
    }
    .portfolio-overview {
        padding: 0 24px 26px;        
    }
    .portfolio-overview .portfolio-overview-inner {
        padding-right: 0;
        max-width: calc(27% - 48px);
    }
    .overview .right_arrow{
        padding-left: 15px
    }
    .links-overview {
        padding: 0 24px 26px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }    
    .overview .right_arrow {
        display: flex;
        align-items: center;
    }
    .portfolio-overview .right_arrow .dashicons{
        display: block;
        width: 50px;
        height: 50px;
    }
    .portfolio-overview .right_arrow .dashicons:before{
        font-size:50px;
    }
    .jws-freelancers-single .program_languages.p-0{
        padding:0;
    }
    .author_wap .program_languages {
        margin-top: 10px;
    }
    @media (max-width: 767px){
        .portfolio-overview .portfolio-overview-inner {
            padding-right: 15px;
            padding-left: 15px;
            max-width: 100%;
        }
        .overview .right_arrow {
            padding-left: 15px;
            padding-right: 15px;
            margin-left: auto;
        }
        .portfolio-overview .right_arrow .dashicons {
            width: 30px;
            height: 30px;
        }
        .portfolio-overview .right_arrow .dashicons:before {
            font-size: 30px;
        }
    }
</style>
<div class="cover_image" style="background: url('<?php echo ''.$banner_bg;?>');height:400px;width:100%;background-size: cover;background-repeat: no-repeat;background-position: center;">

</div>
<div class="e-con site-main jws-freelancers-single single_freelance">
    <div class="container">
        <div class="row">
            <div class="author_infor col-xl-3 col-lg-12 col-12">
            <?php get_template_part( 'template-parts/content/freelancers/single/sidebar' );?>
            </div>
            <div class="post_content col-xl-9 col-lg-12 col-12">
                <div class="job_nav_container">
                    <ul id="filter-list">
                        <li><a href="javascript:void(0);" class="filter-active" data-filter=".overview"><?php echo esc_html__('Overview','freeagent');?></a></li>
                         <li><a href="javascript:void(0);" class="" data-filter=".portfolio"><?php echo esc_html__('Portfolio','freeagent');?></a></li>
                         <li><a href="javascript:void(0);" class="" data-filter=".links"><?php echo esc_html__('Links','freeagent');?></a></li>
                         <li><a href="javascript:void(0);" class="" data-filter=".services"><?php echo esc_html__('Services','freeagent');?></a></li>
                         <li><a href="javascript:void(0);" class="" data-filter=".reviews"><?php echo esc_html__('Reviews','freeagent');?></a></li>
                    </ul>
                </div>
                <div class="tab_content">
                    <?php get_template_part( 'template-parts/content/freelancers/single/overview' );?>
                      <?php get_template_part( 'template-parts/content/freelancers/single/portfolio' );?>
                      <?php get_template_part( 'template-parts/content/freelancers/single/links' );?>
                      <?php get_template_part( 'template-parts/content/freelancers/single/services' );?>
                      <?php get_template_part( 'template-parts/content/freelancers/single/reviews' );?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();