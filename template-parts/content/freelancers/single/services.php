<?php
global $jws_option;
$also_skills_fields = $jws_option['professional_form_fields'];
$also_skills = [];
foreach ($also_skills_fields as $field_key) {
    if (!empty(get_post_meta($post_id, $field_key, true))) {
        $also_skills = get_post_meta($post_id, $field_key, true);
    }
}
?>
<div class="services jws-services-archive  " id="services">
    <div class="jws-services-layout1 row">
        <div class="program_languages">
            <?php
            if (!empty($also_skills)) {

                foreach ($also_skills as $skil) {
                    echo '<a href="#searchthis" rel="tag">' . $skil . '</a>';
                }
            }
            ?>
        </div>
        <?php                
            // Hide this
            if(false):                        
                $freelancer_id = $post->post_author;

                // Job Query
                $args = array(
                    'post_type' => 'services',
                    'author' => $freelancer_id, // Change to your actual custom post type for jobs
                    'posts_per_page' => -1,
                );
            
                $services_query = new WP_Query($args);
            
                // Display jobs
                if ($services_query->have_posts()) :
                    while ($services_query->have_posts()) :
                        $services_query->the_post();
                        $post_id = get_the_ID();
                        $image_size = '800x504';
                        $price_html = jws_cost($post_id);
                        $format = has_post_format() ? get_post_format() : 'no_format'; 
                        $job_author_id = $post->post_author;
                        $freelancer_data = get_userdata($job_author_id);
                        $freelancer_id = get_user_meta($job_author_id, 'freelancer_id', true);
                        $freelancer_permalink = get_permalink($freelancer_id);
                        
                        if ($freelancer_data) {
                            $display_name = $freelancer_data->display_name;
                        }
                    
                        set_query_var('format', $format);
                        set_query_var('image_size', $image_size);
                        set_query_var('post_id', $post_id);
                        set_query_var('freelancer_permalink', $freelancer_permalink);
                        set_query_var('display_name', $display_name);
                        set_query_var('price_html', $price_html);
                        
                        echo '<div class="jws-services-item  col-xl-4 col-lg-6 col-12 ">';
                        get_template_part( 'template-parts/content/services/content-classic' );
                        echo '</div>';
            
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>'.esc_html__('No services found for this freelancer.','freeagent').'</p>';
                endif;
            endif;
        
        ?>
    </div>
</div>