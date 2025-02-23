<?php
global $jws_option;
$post_id = get_the_id();
$freelancer_id = get_post_field('post_author', $post_id);
$current_user_id = get_current_user_id();

/** Get Professional Form Meta Data */
$form_id = $jws_option['professional_form_id'];
$also_skills_fields = $jws_option['professional_form_fields'];
$also_skills = [];
foreach ($also_skills_fields as $field_key) {
    if (!empty(get_post_meta($post_id, $field_key, true))) {
        $also_skills = get_post_meta($post_id, $field_key, true);
    }
}
if(empty($also_skills)){
    $also_skills = get_post_meta($post_id, 'professional_skills', true);
}
?>

<script>
    // console.log(<?php echo json_encode([]); ?>);    
</script>
<?php
$freelancer_images = get_post_meta($post_id, $jws_option['professional_portfolio_field'], true);
$links = get_post_meta($post_id, $jws_option['professional_links_field'], true);
$reviews = [];
?>

<div class="overview active" id="overview">
    <div class="introduction">
        <?php

        $get_freelacer_type = '';
        $freelancer_types = get_the_terms(get_the_id(), 'freelancers_type');

        if ($freelancer_types && !is_wp_error($freelancer_types)) {
            // Iterate through each term and echo its name
            foreach ($freelancer_types as $freelancer_type) {
                $get_freelacer_type = $freelancer_type->slug;
            }
        }

        if (isset($get_freelacer_type) && $get_freelacer_type == 'freelancers') {
            $title = esc_html__('About', 'freeagent');
            $skill = esc_html__('My Skills', 'freeagent');
        } else {
            $title = esc_html__('About', 'freeagent');
            $skill = esc_html__('Our Skills', 'freeagent');
        }

        ?>
        <div class="title_intro"><?php echo '' . $title; ?></div>
        <div class="content_intro"><?php echo get_the_content(); ?></div>
    </div>

    <div class="posted_projects introduction">
        <div class="title_intro">Services</div>
        <div class="program_languages">
            <?php
            if (!empty($also_skills)) {

                foreach ($also_skills as $skil) {
                    echo '<a href="#searchthis" rel="tag">' . $skil . '</a>';
                }
            }
            // Hide this
            else if ($freelancers_skill && !is_wp_error($freelancers_skill)) {
                $visible_terms = array_slice($freelancers_skill, 0, 7); // Display the first 3 terms
                $hidden_terms = array_slice($freelancers_skill, 7); // Remaining terms to be hidden initially
                $listings_link = get_post_type_archive_link('freelancers') . '?freelancers_skill';
                foreach ($visible_terms as $term) {
                    echo '<a href="' . esc_url($listings_link . '=' . $term->slug) . '" rel="tag">' . esc_html($term->name) . '</a>';
                }

                foreach ($hidden_terms as $term) {
                    echo '<a href="' . esc_url($listings_link . '=' . $term->slug) . '" rel="tag" class="hidden-term">' . esc_html($term->name) . '</a>';
                }
                if (count($hidden_terms) > 0) {
                    echo '<a href="javascript:void(0);" class="show_more">+' . count($hidden_terms) . '</a>';
                }
            }
            ?>
        </div>
        <div class="title_intro">Portfolio</div>
        <div class="portfolio-overview row">
            <?php
            if (!empty($freelancer_images)) {
                $count = 0;
                foreach ($freelancer_images as $img_url) {
                    if ($count == 4)
                        break;
                    echo '<div class="portfolio-overview-inner col col-sm-12">
                    <div class="jws-portfolio-images">
                        <a href="javascript:void(0);">
                            <img src="' . esc_url($img_url) . '" alt="" class="attachment-large wp-post-image" />
                        </a>
                    </div>                        
                </div>';
                    $count++;
                }
                ?>
                <div class="right_arrow">
                    <a href="javascript:void(0);" class="" onclick="portfolioClick();">
                        <span class="dashicons dashicons-arrow-right-alt"></span>
                    </a>
                </div>
                <script>
                    function portfolioClick() {
                        document.querySelector('[data-filter=".portfolio"]').click()
                    }
                </script>
                <?php
            }
            ?>
        </div>
        <div class="title_intro">Reviews</div>
        <div class="portfolio-overview">
            <?php
            if (!empty($reviews)) {
                $count = 0;
                foreach ($freelancer_images as $img_url) {
                    if ($count == 4)
                        break;
                    echo '<div class="portfolio-overview-inner">
                        <div class="jws-portfolio-images">
                            <a href="javascript:void(0);">
                                <img src="' . esc_url($img_url) . '" alt="" class="attachment-large wp-post-image" />
                            </a>
                        </div>                        
                    </div>';
                    $count++;
                }
                ?>
                <?php
            } else {
                ?>
                <p>No Reviews yet</p>
                <?php
            }
            ?>
        </div>
        <div class="title_intro">Links</div>
        <div class="links-overview">
            <?php
            if (!empty($links)) {
                $count = 0;
                foreach ($links as $link) {
                    if ($count == 4)
                        break;
                    echo '<div class="links-overview-inner">                        
                        <a href="' . $link[0] . '">
                            ' . $link[0] . '
                        </a>                        
                    </div>';
                    $count++;
                }
                ?>
                <?php
            } else {
                ?>
                <p>No Links Provided</p>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
    // Hide this
    if(false){ ?>
        <div class="introduction posted_projects">
            <div class="title_intro"><?php echo esc_html__('Work History and Feedback', 'freeagent'); ?></div>

            <?php
            get_template_part('template-parts/content/freelancers/single/reviews');
            ?>
        </div>
    <?php }
    ?>
</div>