<?php
global $jws_option;
$post_id = get_the_id();
$freelancer_id = get_post_field('post_author', $post_id);
$current_user_id = get_current_user_id();
$active_profile = get_user_meta($current_user_id, '_active_profile', true);


$ongoing_jobs = array(
    'post_type' => 'jobs',
    'posts_per_page' => -1,
    'post_status' => 'ongoing',
    'meta_query' => array(
        array(
            'key' => 'freelaner_hired',
            'value' => intval($freelancer_id),
            'compare' => '=',
        ),
    ),
);

$ongoing_jobs = new WP_Query($ongoing_jobs);

$total_ongoing_jobs = $ongoing_jobs->found_posts;


$completed_jobs = array(
    'post_type' => 'jobs',
    'posts_per_page' => -1,
    'post_status' => 'completed',
    'meta_query' => array(
        array(
            'key' => 'freelaner_hired',
            'value' => intval($freelancer_id),
            'compare' => '=',
        ),
    ),
);

$completed_jobs = new WP_Query($completed_jobs);

$total_completed_jobs = $completed_jobs->found_posts;


$percentage_completed = $total_ongoing_jobs > 0 ? $total_completed_jobs / $total_ongoing_jobs * 100 : 100;

$author_id = $post->post_author;
$freelance_id = Jws_Custom_User::get_freelaner_id($author_id);
$verified = get_post_meta($freelance_id, 'verified', true);
$verified_lable = '';
if ($verified == true) {
    $verified_lable = '<span class="verified"><i class="jws-icon-check-circle-fill"></i></span>';
}
/** Get Position */
$freelancers_position = get_post_meta($post_id,'freelancers_position',true);

/** Get location info */
$city = get_post_meta($post_id, $jws_option['professional_city_field'], true);
$country = get_post_meta($post_id, $jws_option['professional_country_field'], true);

/** Get Professional Form Meta Data */
$form_id = $jws_option['professional_form_id'];

/** Get fee info */
$fee_from_label = get_label_from_fieldId_ff($form_id, $jws_option['professional_fee_field']);
$fee_from = get_post_meta($post_id, $jws_option['professional_fee_field'], true);
$currency = get_woocommerce_currency_symbol();

/** Skills */
$also_skills_fields = $jws_option['professional_form_fields'];
$also_skills = [];
$symbol = function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '£';

foreach ($also_skills_fields as $field_key) {
    if (!empty(get_post_meta($post_id, $field_key, true))) {
        $also_skills = get_post_meta($post_id, $field_key, true);
    }
}
if(empty($also_skills)){
    $also_skills = get_post_meta($post_id, 'professional_skills', true);
}

?>
<div class="box_left">
    <div class="author_wap">
        <div class="post_thumbnail">
            <div class="author_avatar"><?php jws_image_advanced($post_id, '120x120'); ?></div>
            <?php echo '' . $verified_lable; ?>
        </div>
        <script>
            // console.log(<?php echo json_encode([]); ?>);

        </script>
        <p class="position"><?= ($freelancers_position) ? "$freelancers_position" : ''; ?></p>
        <h1 class="title"><?php echo get_the_title(); ?></h1>
        <p class="location-cus"><?= ($city && $country) ? "$city, $country" : ''; ?></p>
        <div class="location">
            <?php
            if (!empty($location)) {
                foreach ($location as $term) {
                    echo '<span><i class="jws-icon-map"></i>' . $term->name . '</span>';
                }
            }
            ?>
        </div>
        <?php freelancer_rating($post_id); ?>
        <div class="fee_from">
            <p><?= $fee_from ? "$fee_from_label $symbol$fee_from":"";?></p>
        </div>
        <?php 
        // Hide this
        if(false){ ?>
            <div class="jws_post_excerpt">
                <div class="short_description"><?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?></div>
                <?php
                $excerpt = get_the_excerpt();
                if (!empty($excerpt)) {
                    echo '<div class="short_description_more">' . get_the_excerpt() . '</div>';
                    echo '<a class="show_more_excerpt" href="javascript:void(0);"><span class="text">' . esc_html__('Show more', 'freeagent') . '</span> <i class="jws-icon-caret-down"></i></a>';
                }
                ?>
            </div>
        <?php }
        ?>
        <div class="program_languages p-0">
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
        <?php
        $hourly_rate_setting = Jws_Dashboard_Settings::get_uer_setting('hourly_rate', $freelancer_id);
        if (!empty($hourly_rate) && $hourly_rate_setting != 'on') {
            echo ' <div class="price_info"><h3 class="price">' . $price_html . '</h3><span class="time">/' . esc_html__('hr', 'freeagent') . '</span></div>';
        }
        ?>
        <?php if(false){ ?>
            <a type="button" data-freelancer_id="<?php echo '' . $post_id; ?>" data-modal-jws="#submit-hiring"
                href="javascript:void(0);"
                class="elementor-button btn_contact"><?php echo esc_html__('Contact Me', 'freeagent'); ?></a>
            <div class="d-flex fl-center al-center">
                <?php jws_button_freelancer_save($post_id); ?>
                <a href="javascript:void(0);" class="btn_message" data-modal-jws="#create-chat"><i
                        class="jws-icon-chat"></i> </a>
            </div>
        <?php }
        ?>
        <?php Jws_Dashboard_Chat::form_chat_popup(compact('author_id')); ?>
        <?php if(false && $current_user_id == $freelancer_id){ ?>
            <div class="more_detail project">
                <?php
                $income_total = 0;
                $transactions_complete = 0;
                $table = JWS_STATEMENTS_TB;
                global $wpdb;
                if ($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table) {
                    $query_income = "SELECT * FROM " . $table . " WHERE user_type = 'fr' AND status = 'complete' AND  user_id = '" . $freelancer_id . "' ORDER BY  `timestamp` DESC";
                    $results_income = $wpdb->get_results($query_income);
    
                    if (!empty($results_income)) {
    
                        foreach ($results_income as $income) {
                            $income_total += $income->price;
                            $transactions_complete++;
                        }
    
                    }
    
                }
    
                $pstatus = array('hired', 'pending');
                $proposal_hours_args = array(
                    'post_type' => 'job_proposal',
                    'post_status' => array('publish'),
                    'author' => $freelancer_id,
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'status',
                            'value' => 'completed',
                            'compare' => '='
                        )
                    )
                );
    
                $proposal_hours_query = new WP_Query($proposal_hours_args);
    
                $total_hours = 0;
    
                if ($proposal_hours_query->have_posts()) {
                    while ($proposal_hours_query->have_posts()) {
                        $proposal_hours_query->the_post();
                        $proposal_hours = get_post_meta(get_the_ID(), 'proposal_hour', true);
    
                        $total_hours += (float) $proposal_hours;
                    }
                }
    
                // Reset post data
                wp_reset_postdata();
    
                ?>
                <ul>
                    <li>
                        <label class="label"><?php echo esc_html__('Total Earning Amount:', 'freeagent') ?></label>
                        <p class="result"><?php echo jws_format_price($income_total); ?></p>
                    </li>
                    <li>
                        <label class="label"><?php echo esc_html__('Total Jobs:', 'freeagent') ?></label>
                        <p class="result"><?php echo '' . $total_completed_jobs + $total_ongoing_jobs; ?></p>
                    </li>
                    <li>
                        <label class="label"><?php echo esc_html__('Total Hours:', 'freeagent') ?></label>
                        <p class="result"><?php echo '' . $total_hours; ?></p>
                    </li>
                    <li>
                        <label class="label"><?php echo esc_html__('Ongoing Project:', 'freeagent') ?></label>
                        <p class="result"><?php echo '' . $total_ongoing_jobs; ?></p>
                    </li>
                    <li>
                        <label class="label"><?php echo esc_html__('Completed Project:', 'freeagent') ?></label>
                        <p class="result"><?php echo '' . $total_completed_jobs; ?></p>
                    </li>
                    <?php
                    $response_times = get_the_terms($post_id, 'freelancers_response_time');
                    if ($jws_option['freelancers-response'] && $response_times && !is_wp_error($response_times)) {
                        ?>
                        <li>
                            <label class="label"><?php echo esc_html__('Avg. Response Time:', 'freeagent') ?></label>
                            <p class="result"><?php
    
                            // Check if there are terms
                        
                            // Extract the term names into an array
                            $response_time_names = wp_list_pluck($response_times, 'name');
    
                            // Output the comma-separated list of term names
                            echo implode(', ', $response_time_names);
    
                            ?>
                            </p>
                        </li>
                    <?php } ?>
                    <li>
                        <label class="label"><?php echo esc_html__('Transactions Completed:', 'freeagent') ?></label>
                        <p class="result"><?php echo '' . $transactions_complete; ?></p>
                    </li>
                </ul>
            </div>
        <?php }?>
        <?php if(false){ ?>
            <div class="btn_bottom">
                <div class="share">
                    <?php jws_freelance_share(); ?>
                    <a href="javascript:void(0);" class="btn_share"><i class="jws-icon-share"></i>
                        <?php echo esc_html__('Share', 'freeagent'); ?></a>
                </div>
                <?php
                // Hide this
                if(false){ ?>
                    <a href="javascript:void(0);" class="btn_report" data-modal-jws="#submit-report"> <i class="jws-icon-warning-light"></i><?php echo esc_html__('Report', 'freeagent'); ?> </a>
                <?php }
                ?>
            </div>
        <?php }?>

    </div>
</div>

<div id="submit-hiring" class="mfp-hide rad_10 overflow-hidden popup-global submit-hiring">

    <div class="form-heading">
        <h5><?php echo esc_html__('Contact ', 'freeagent') . get_the_title(); ?></h5>
    </div>
    <div class="form-content">

        <?php if ($active_profile == '1') { ?>
            <form>
                <div class="form-freelancers-detail">
                    <div class="form-group">
                        <label
                            class="fw-700 d-block"><?php echo esc_html__('What\'s the Message about?', 'freeagent') ?></label>
                        <select name="hiring_type">
                            <option value="1"><?php echo esc_html__('New Project', 'freeagent'); ?></option>
                            <option value="2"><?php echo esc_html__('Hiring Freelancer', 'freeagent'); ?></option>
                        </select>
                    </div>
                    <div id="hiring-2" class="form-group hidden hiring-type-field">
                        <label class="fw-700 d-block"><?php echo esc_html__('Select Project', 'freeagent'); ?></label>
                        <?php

                        $args = array(
                            'author__in' => array($current_user_id),
                            'post_type' => 'jobs',
                            'paged' => $paged,
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'posts_per_page' => -1,
                            'fields' => 'ids',
                        );

                        $jobs = get_posts($args);


                        ?>
                        <select name="job_old">

                            <?php

                            if (!empty($jobs)) {
                                echo '<option value="">' . esc_html__('Select Project', 'freeagent') . '</option>';
                                foreach ($jobs as $id) {

                                    echo '<option value="' . $id . '">' . get_the_title($id) . '</option>';

                                }

                            }

                            ?>
                        </select>

                    </div>
                    <div id="hiring-1" class="form-group hiring-type-field">
                        <label class="fw-700 d-block"><?php echo esc_html__('Project Name', 'freeagent') ?></label>
                        <input name="job_new"
                            placeholder="<?php echo esc_html__('What you need to get done', 'freeagent'); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="message"
                            class="fw-700 d-block"><?php echo esc_html__('Send a private message', 'freeagent') ?></label>
                        <textarea id="message" name="message" rows="4"
                            placeholder="<?php echo esc_html__('Describe what you need in more detail...', 'freeagent'); ?>"
                            required=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="fw-700 d-block"><?php echo esc_html__('Job type', 'freeagent') ?></label>
                        <label class="d-block">
                            <input type="radio" name="job_type" value="fixed" checked />
                            <?php echo esc_html__('Fixed', 'freeagent') ?>
                        </label>

                        <label class="d-block">
                            <input type="radio" name="job_type" value="hourly" />
                            <?php echo esc_html__('Hourly', 'freeagent') ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="fw-700 d-block"><?php echo esc_html__('Budget', 'freeagent') ?></label>
                        <input type="number" min="0" name="cost" placeholder="<?php echo esc_html__('0', 'freeagent'); ?>" />
                    </div>
                    <div class="note">
                        <?php echo esc_html__('By clicking Send Invitation, you have read and agreed to our Terms & Conditions and Privacy Policy', 'freeagent') ?>
                    </div>
                    <div class="form-button al-center">
                        <button class="form-submit-cancel elementor-button btn btn-underlined border-thin"
                            type="button"><?php echo esc_html__('Cancel', 'freeagent'); ?></button>
                        <button class="form-submit-btn hiring-submit elementor-button"
                            type="button"><?php echo esc_html__('Send Invitation', 'freeagent'); ?></button>
                    </div>
                </div>
                <input type="hidden" name="user_post" value="<?php echo esc_attr($freelancer_id); ?>" />
            </form>
        <?php } else {

            echo esc_html__('You are not a employer', 'freeagent');

        } ?>

    </div>
</div>


<div id="submit-report" class="mfp-hide rad_10 overflow-hidden popup-global">

    <div class="form-heading">
        <h5><?php echo esc_html__('Report ', 'freeagent') . get_the_title(); ?></h5>
    </div>
    <div class="form-content">
        <form>
            <div class="form-field">
                <select name="reason">
                    <option value=""><?php echo esc_html__('Select reason', 'freeagent'); ?></option>
                    <option value="fake"><?php echo esc_html__('This is the fake', 'freeagent'); ?></option>
                    <option value="other"><?php echo esc_html__('Other', 'freeagent'); ?></option>
                </select>
            </div>
            <div class="form-field">

                <textarea name="description"
                    placeholder="<?php echo esc_attr__('Report Description', 'freeagent'); ?>"></textarea>

            </div>
            <input type="hidden" name="reason_type" value="freelancer" />
            <input type="hidden" name="user_report" value="<?php echo esc_attr($freelancer_id); ?>" />
        </form>
    </div>
    <div class="form-button al-center">
        <button class="form-submit-cancel elementor-button btn btn-underlined border-thin"
            type="button"><?php echo esc_html__('Cancel', 'freeagent'); ?></button>
        <button class="form-submit-btn hiring-submit elementor-button"
            type="button"><?php echo esc_html__('Send', 'freeagent'); ?></button>
    </div>
</div>