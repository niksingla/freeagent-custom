<?php 

$post_id = get_the_ID();
$current_user_id = get_current_user_id();
jws_gt_set_post_view();              
$argsproposal = array(
 'post_type' => 'job_proposal',
 'posts_per_page' => -1,   
  'meta_query'     => array(
        'relation' => 'AND',
        array(
            'key'   => 'job_id',
            'value' => $post_id,
        ),
    ),
);

$proposals = new WP_Query($argsproposal);
$proposal_count = $proposals->found_posts;

$post_status = get_post_status($post_id);

$post_meta = get_post_meta($post_id);
$symbol = function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '£';
global $jws_option;
?>

<div class="container">

    <div class="row">
    
    
        <div class="col-xl-8">
           
           <div class="job-content">
            <?php if(false): ?>
              <div class="job-infomation">               
                 <div class="job-category">
                    <?php 
                    echo '<i class="jws-icon-listdashes"></i>'.esc_html__('Category','freeagent');
                      $term_list =get_the_terms( $post_id,'jobs_cat');
                      if ($term_list && !is_wp_error($term_list)) {
                        $listings_link = get_post_type_archive_link('jobs') . '?jobs_cat';
                         foreach ($term_list as $term) {
                             echo '<a href="' . esc_url($listings_link.'='.$term->slug). '" rel="tag">' . esc_html($term->name) . '</a>';
                         }
                        }
                    ?>
                 
                 </div>
                 
                 <div class="job-id">
        
                    <?php 
                 
                     echo sprintf(
                         '<label>%s</label> #%s',
                         esc_html__('Jobs ID:','freeagent'),
                             $post_id
                   );
                    
                    ?>
                 
                 </div>
                 
                 <div class="job-meta">
                 
                 
                 <span class="meta-date">
                   
                   <?php 
                    
                    $time_ago = human_time_diff(get_the_time('U'), current_time('timestamp')) .esc_html__(' ago','freeagent'); 
                   
                    echo sprintf(
                         '<i class="jws-icon-clock"></i>%s <span class="result"> %s</span>',
                         esc_html__('Posted','freeagent'),
                             $time_ago
                    );
                   
                   ?>
                   
                 </span>
                 
                 <span class="meta-location">
                   
                   <?php 
                    
                    $location = get_post_meta($post_id, 'jobs_locations', true);
                    $location = get_term($location);
                    if (!empty($location) && !is_wp_error($location)) {
                          echo sprintf(
                             '<i class="jws-icon-map"></i><span class="result">%s</span>',
                                 $location->name
                        );
                    }
  
                   ?>
                   
                 </span>
                 
                 <span class="meta-level">
                   
                   <?php 
                    
                    $job_level = get_post_meta($post_id, 'job_level', true);
                    $job_level = get_term($job_level);
                    if (!empty($job_level) && !is_wp_error($job_level)) {
                          echo sprintf(
                             '<i class="jws-icon-atom"></i><span class="result">%s</span>',
                                 $job_level->name
                        );
                    }
  
                   ?>
                   
                 </span>
                 
                 <span class="meta-proposals">
                   
                   <?php 
                    
                    $text = 'Proposals';
                    if (!empty($text) && !is_wp_error($text)) {
                          echo sprintf(
                             '<i class="jws-icon-clipboard"></i>%s <span class="result"> %s</span>',
                                 $text, $proposal_count
                                 
                        );
                    }
                  
                   ?>
                   
                 </span>
                 
                 <span class="meta-duration">
                   
                   <?php 
                    
                    $duration = get_post_meta($post_id, 'jobs_duration', true);
                    $duration = get_term($duration);
                    if (!empty($duration) && !is_wp_error($duration)) {
                          echo sprintf(
                             '<i class="jws-icon-calendarcheck"></i>%s <span class="result"> %s</span>',
                                 esc_html__('Duration','freeagent'),
                                 $duration->name
                        );
                    }
  
                   ?>
                   
                 </span>
                 
                 </div>
              
              </div>
            <?php endif;?>
             <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                  <?php echo esc_html__('Client Name','freeagent'); ?> 
                </div>
                <div>
                  <?php the_author_firstname(); ?>
                </div>
             </div>
             <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                    <?php echo esc_html__('Wants to hire:', 'freeagent'); ?> 
                </div>
                <div>
                    <?php echo esc_html($post_meta[$jws_option['client_title']][0] ?? ''); ?>
                </div>
            </div>

            <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                    <?php echo esc_html__('Country:', 'freeagent'); ?> 
                </div>
                <div>
                    <?php echo esc_html($post_meta[$jws_option['client_country_field']][0] ?? ''); ?>
                </div>
            </div>

            <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                    <?php echo esc_html__('City:', 'freeagent'); ?> 
                </div>
                <div>
                    <?php echo esc_html($post_meta[$jws_option['client_city_field']][0] ?? ''); ?>
                </div>
            </div>

            <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                    <?php echo esc_html__('Venue:', 'freeagent'); ?> 
                </div>
                <div>
                    <?php echo esc_html($post_meta[$jws_option['client_venue_field']][0] ?? ''); ?>
                </div>
            </div>

            <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                    <?php echo esc_html__('Services Required:', 'freeagent'); ?> 
                </div>
                <div>
                    <?php
                    $service_type = is_array($post_meta[$jws_option['client_service_type_field']])? (implode(' / ',unserialize($post_meta[$jws_option['client_service_type_field']][0])) ?? '') : '';
                    echo esc_html($service_type); ?>
                </div>
            </div>

            <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                    <?php echo esc_html__('Preference:', 'freeagent'); ?> 
                </div>
                <div>
                    <?php echo esc_html($post_meta[$jws_option['client_gender_field']][0] ?? ''); ?>
                </div>
            </div>

            <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                    <?php echo esc_html__('Date of event / service:', 'freeagent'); ?> 
                </div>
                <div>
                    <?php echo esc_html($post_meta[$jws_option['client_date_event_field']][0] ?? ''); ?>
                </div>
            </div>

            <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                    <?php echo esc_html__('No. of hours service required for:', 'freeagent'); ?> 
                </div>
                <div>
                    <?php echo esc_html($post_meta[$jws_option['client_hours_field']][0] ?? ''); ?>
                </div>
            </div>

            <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                    <?php echo esc_html__('Budget:', 'freeagent'); ?> 
                </div>
                <div>
                    <?php echo $symbol.esc_html($post_meta[$jws_option['client_budget_field']][0] ?? ''); ?>
                </div>
            </div>

            <div class="job-content list-item-job">
                <div class="job-sestion-heading fw-500 fs-md">
                    <?php echo esc_html__('Any specific requirements:', 'freeagent'); ?> 
                </div>
                <div>
                    <?php echo esc_html($post_meta[$jws_option['client_spec_req_field']][0] ?? ''); ?>
                </div>
            </div>
           </div>        
        </div>
    
    
        <div class="col-xl-4">
           
           <div class="job-sidebar">
               <?php 
               
                    get_template_part( 
            	                'template-parts/content/jobs/single/sidebar'
            	    );
               
               ?>
           </div>
    
        </div>
    
    
    </div>

</div>