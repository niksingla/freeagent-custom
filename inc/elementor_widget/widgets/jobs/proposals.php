<?php  

?>
<div id="submit-proposal-list<?php echo '-'.$post_id;?>" class="mfp-hide rad_10 overflow-hidden popup-global submit-proposal">

    <div class="form-heading">
       <h5><?php echo esc_html__('Submit Proposal','freeagent'); ?></h5>
    </div>
    <div class="form-content">
         
        <div class="form-jobs-detail">
          
          <h5><?php echo get_the_title(); ?></h5>
          <div class="job-id">
       
                   <?php 
                
                    echo sprintf(
                    		'<span class="fw-700">%s</span> #%s',
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
                    		'<i class="jws-icon-clock"></i> %s %s',
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
                        		'<i class="jws-icon-map"></i>%s',
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
                        		'<i class="jws-icon-atom"></i>%s',
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
                        		'<i class="jws-icon-clipboard"></i>%s',
                                $text
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
                        		'<i class="jws-icon-calendarcheck"></i>%s %s',
                                esc_html__('Duration','freeagent'),
                                $duration->name
                       );
                   }
 
                  ?>
                  
                </span>
                
            </div>
        
        </div> 
        
        <?php 
        
           $current_user_id = get_current_user_id();
           $active_profile = get_user_meta($current_user_id,'_active_profile', true);
           
           if($active_profile == '2') {
            
             Jws_Proposal_View::jws_proposal_create($post_id);
            
           } else {
              
              echo esc_html__('You are not a freelancer','freeagent');
            
           }
       
         ?> 
     
     </div>
     <div class="form-button al-center">
          <button class="form-submit-cancel elementor-button btn btn-underlined border-thin" type="button"><?php echo esc_html__('Cancel','freeagent'); ?></button>   
          <button class="form-submit-btn proposal-submit elementor-button" type="button"><?php echo esc_html__('Send Now','freeagent'); ?></button>  
      </div>
      
</div>