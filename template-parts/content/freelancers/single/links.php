<div class="links" id="links">
    <div class="jws_links_wrap row">
    <?php
                    
        $freelancer_id = get_the_ID(); // Default post ID for freelancer

        // Get freelancer's custom meta links (repeater field)
        $freelancer_links = get_post_meta($freelancer_id, 'repeater_field', true);        
        if (!empty($freelancer_links)) {
            foreach ($freelancer_links as $link) {
                echo '<div class="jws-links-item col-12" data-id="' . $freelancer_id . '">
                        <div class="jws-links-images">
                            <a href="' . esc_url($link[0]) . '" class="links-detail" target="_blank">'
                            . esc_url($link[0]) .
                            '</a>
                        </div>
                    </div>';
            }
        } else {
            echo '<p>' . esc_html__('No links found for this freelancer.', 'freeagent') . '</p>';
        }
    ?>
    </div>
</div>
