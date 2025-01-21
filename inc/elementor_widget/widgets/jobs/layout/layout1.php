
<div class="jws_job_wap">
       <?php

    if($featured==1){
        echo '<span class="featured">'.esc_html__('Featured ','freeagent').'<i class="jws-icon-lightning"></i></span>';
    }else{
        new_jobs($post_date);
    }
    ?>
    <div class="job_content_top">
        <div class="jws_job_image">
            <div class="logo_emp"><a href="<?php echo ''.$employer_permalink;?>"><?php jws_image_advanced($employer_id,'thumbnail');?></a></div>
            <div class="content_heading">
                <div class="name_emp"><span class="name"><?php echo ''.$display_name?></span><?php echo ''.$verified_lable;?></div>
                <h6 class="entry-title"><a href="<?php echo get_the_permalink(); ?>">
                 <?php echo (!empty($settings['title_length'])) ? wp_trim_words($title, $settings['title_length'], $settings['title_more']) : $title; ?>
                </a></h6>  
            </div>
        </div>
         <div class="jws_job_content">
             <div class="job_infor">
                     <?php
                     if ($location && !is_wp_error($location)) {
                        $loca_name = $location[0]->name; // Get the name of the first term
                        echo '<div class="job_location">'.$loca_name.'</div>';
                     }
                   ?>
        
                <div class="price">
                    <?php echo ''.$price_html;?>
                    <span class="job_type">
                    <?php switch ($job_type) {
                        case '1':
                            echo esc_html__('Hourly','freeagent');
                            break;
                        case '2':
                            echo esc_html__('Fixed','freeagent');
                            break;
                    }?>
                    </span>
                </div>
                <div class="experience"><?php 
                      if ($level && !is_wp_error($level)) {
                    $job_level_name = $level[0]->name; // Get the name of the first term
                    echo ''.$job_level_name;
                }
                 ?></div>
             </div>
             <div class="program_languages">
                <?php 
                if ($jobs_skill && !is_wp_error($jobs_skill)) {
                    $listings_link = get_post_type_archive_link('jobs') . '?jobs_skill';
        
                    $visible_terms = array_slice($jobs_skill, 0, 3); // Display the first 3 terms
                    $hidden_terms = array_slice($jobs_skill, 3); // Remaining terms to be hidden initially
        
                    foreach ($visible_terms as $term) {
                        echo '<a href="' .esc_url($listings_link.'='.$term->slug). '" rel="tag">' . esc_html($term->name) . '</a>';
                    }
        
                    foreach ($hidden_terms as $term) {
                        echo '<a href="' . esc_url($listings_link.'='.$term->slug). '" rel="tag" class="hidden-term">' . esc_html($term->name) . '</a>';
                    }
                    if(count($hidden_terms)>0){
                        echo '<a href="javascript:void(0);" class="show_more">+'.count($hidden_terms).'</a>';
                    }
                }
                ?>
                
             </div>
         </div>
     </div>
     <div class="btn_actions">
       <button class="send-proposal" data-proposal="<?php echo esc_attr($post_id); ?>" data-modal-jws="#submit-proposal-list<?php echo '-'.$post_id;?>"><?php echo esc_html__('Send Proposal','freeagent');?></button>
        <?php if(function_exists('jws_button_job_save')) jws_button_job_save($post_id); ?>
    </div>
</div>