<div class="portfolio " id="portfolio">
    <div class="jws_portfolio_wrap row">
    <?php
                    
        $freelancer_id = get_the_ID(); // Default post ID for freelancer

        // Get freelancer's custom meta images
        $freelancer_images = get_post_meta($freelancer_id, 'image-upload_1', true);

        if (!empty($freelancer_images)) {
            foreach ($freelancer_images as $img_url) {
                echo '<div class="jws-portfolio-item col-xl-4 col-lg-6 col-12" data-id="' . $freelancer_id . '">
                        <div class="jws-portfolio-images">
                            <a href="javascript:void(0);" class="portfolio-detail">
                                <img src="' . esc_url($img_url) . '" alt="" class="attachment-large wp-post-image" />
                            </a>
                        </div>                        
                    </div>';
            }
        } else {
            echo '<p>' . esc_html__('No images found for this freelancer.', 'freeagent') . '</p>';
        }
    ?>
    </div>
</div>
<?php
/** Old code */
if(false): ?>
    <div class="portfolio " id="portfolio">
        <div class="jws_portfolio_wrap row">
        <?php
                        
            $freelancer_id = $post->post_author;
        
            // Job Query
            $args = array(
                'post_type' => 'portfolios',
                'author' => $freelancer_id, // Change to your actual custom post type for jobs
                'posts_per_page' => -1,
            );
        
            $portfolio_query = new WP_Query($args);
        
            // Display jobs
            if ($portfolio_query->have_posts()) :
                while ($portfolio_query->have_posts()) :
                    $portfolio_query->the_post();
                    wp_enqueue_script('lightgallery-all');
                wp_enqueue_style('lightgallery');
                    
                    $post_id = get_the_ID();
                    $gallery = get_post_meta($post_id, 'portfolio_attachments', true);
                    $image_size = '500x380';
                    echo '<div class="jws-portfolio-item  col-xl-4 col-lg-6 col-12" data-id="'.$post_id.'">
                            <div class="jws-portfolio-images">';
                        
                            if (function_exists('jws_getImageBySize')) {
                                
                                $attach_id = get_post_thumbnail_id();
                                
                                $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                                echo '<a href="javascript:void(0);" class="portfolio-detail">';
                                echo (!empty($img['thumbnail'])) ? $img['thumbnail']: '';
                                echo '</a>';
                        
                            }

                        
                            echo '</div>';
                            echo '<h6 class="entry-title">'.get_the_title().'</h6>';
                    
                    echo '</div>';
                endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>'.esc_html__('No portfolio found for this freelancer.','freeagent').'</p>';
                endif;
        ?>
        </div>
    </div>
<?php endif;