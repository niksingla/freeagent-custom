<?php 

$post_id = get_the_ID();

$current_user_id = get_current_user_id();
$active_profile = get_user_meta($current_user_id,'_active_profile', true);
              
$argsproposal = array(
'post_type' => 'job_proposal',
 'posts_per_page' => 1,   
 'meta_query'     => array(
        array(
            'key'   => 'job_id',  // Assuming 'job_id' is the custom field linking job proposals to jobs
            'value' => $post_id,
        ),
    ),
);

$proposals = new WP_Query($argsproposal);
$proposal_count = $proposals->found_posts;
?>
<div class="widget job-widget">
 <div class="job_top_sidebar">
      <div class="job-price">
      
        <?php 
                         
            $price_html = jws_cost($post_id);
            $jobs_type = get_post_meta($post_id, 'job_type', true);
     
            if($jobs_type == 1) {
                $type = 'Hourly';
            } elseif($jobs_type == 2) {
                $type = 'Fixed';
            }else {
                $type = '';
            }
            
            echo sprintf(
        		'<div class="jws-price">%s<span class="price-type d-block"> %s </span></div>',
        		$price_html,
                $type
    		);
          
    	 ?>
      
      </div>
      <?php if(false && function_exists('jws_button_job_save')) jws_button_job_save($post_id); ?>
   </div> 
  <div>
     
     <?php 
        if(false){
            $job_featured = get_post_meta($post_id, '_featured', true);
            $post_date = get_the_date();
            if($job_featured){ 
                echo '<span class="jws-featured">'.esc_html__('Featured','freeagent').'<i class="jws-icon-lightning"></i></span>';
            }else{
                new_jobs($post_date);
            }
            
            if(function_exists('job_expiry_calculation')) echo job_expiry_calculation($post_id);
     
            if(function_exists('job_expiry_date')) {
                
                $job_expiry = job_expiry_date($post_id);
                if($job_expiry != 'no_limit' && $job_expiry != 'closed') {
                    echo job_expiry_date($post_id);
                }
                
                
            } 
        }
      ?>
      
      <button type="button" class="send" data-proposal="<?php echo esc_attr($post_id); ?>" data-modal-jws="#submit-proposal"><?php echo esc_html__('Send Proposal','freeagent'); ?></button>
      <?php if($active_profile == '1') : ?>
      <p class="or"><?php echo esc_html__('Or','freeagent'); ?></p>
      
      <a target="_blank" href="<?php echo esc_url(Jws_Dashboard_Settings::get_global_url('create_job')); ?>&share=<?php echo esc_attr($post_id); ?>" class="post_job"><?php echo esc_html__('Post a Job Like This','freeagent'); ?><i class="jws-icon-long-arrow"></i></a>
      <?php endif; ?>
      <div class="jws-share">
          <div class="fw-700"><?php echo esc_html__('Share this job','freeagent'); ?></div>
          <?php if(function_exists('job_share_social')) echo job_share_social($post_id); ?>
      </div>
      <button type="button" class="report" data-report="<?php echo esc_attr($post_id); ?>" data-modal-jws="#submit-report"><i class="jws-icon-warning-regular"></i><?php echo esc_html__('Report this job','freeagent'); ?></button> 
  </div>

</div>
<?php if(false): ?>
    <div class="widget job-employer">
      <div class="widget-title fs-md fw-500"><?php echo esc_html__('About the Clients','freeagent'); ?></div>
                        <?php
                    
                         $job_author_id = $post->post_author;
                        $argsjob = array(
                            'fields'          => 'ids', // Only get post IDs
                            'posts_per_page'  => -1,
                            'author__in' => array( $job_author_id ) ,
                            'post_type' =>'jobs',
                            'post_status' => 'publish',
                        );
                        
                        $job_count_query = new WP_Query($argsjob);
                        $job_count = $job_count_query->post_count;
                        
                        $spendings_total = 0;
                        $table = JWS_STATEMENTS_TB; global $wpdb;
                        if($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table) { 
                              $query_spendings = "SELECT * FROM ".$table." WHERE user_type = 'em' AND t_status = '2'  AND  user_id = '" . $job_author_id . "' ORDER BY  `timestamp` DESC";
                              $results_spendings = $wpdb->get_results($query_spendings);
                              
                              if(!empty($results_spendings)) {
                                    
                                  foreach($results_spendings as $spendings) {
                                    $spendings_total += $spendings->price;
                                    
                                  }
                                    
                              }
                        
                        }
                       
    
     
                         $employer_id = Jws_Custom_User::get_employer_id( $job_author_id );
                         $verified = get_post_meta($employer_id,'verified', true);
                         $verified_lable='';
                         $date_format = get_option( 'date_format' );
                         if($verified==true){
                            $verified_lable= '<span class="verified"><i class="jws-icon-check-circle-fill"></i></span>';
                         }
                                echo '<div class="jws_client_wap">
                                    <div class="logo_emp">';
                                    echo '<a href="'.get_the_permalink($employer_id).'">';
                                        jws_image_advanced($employer_id,'thumbnail');
                                    echo '</a>';
                                    echo '</div>
                                    <div class="infor">
                                        <a href="'.get_the_permalink($employer_id).'">
                                            <h6 class="name_emp"><span class="name">'.get_the_title($employer_id).'</span> '.$verified_lable.'</h6>
                                        </a>
                                        <div class="member_since">'.esc_html__('Member since ','freeagent').get_the_date($date_format,$employer_id).'</div>
                                   
                                    </div>
                                </div>';
                                ?>
                                <div class="more_detail">
                                    <ul class="">
                                    <?php 
                                    $employers_location = get_the_terms( $employer_id, 'employers_location');
                                     if(!empty($employers_location)) {
                                    ?>
                                        <li>
                                            <label class="label"><?php echo esc_html__('Location','freeagent')?></label>
                                            <p class="result">
                                            <?php 
                                            
                                           
                                                $terms_count = count($employers_location);
                                                $counter = 0;
                                                $listings_link = get_post_type_archive_link('employers') . '?employers_location';
                                                  foreach ($employers_location as $term) {
                                                        $counter++;
                                                        echo '<a href="' . esc_url($listings_link.'='.$term->slug) . '" rel="tag">' . esc_html($term->name) . '</a>';
                                                      if ($counter < $terms_count) {
                                                            echo ', ';
                                                        }
                                                  } 
                                           
                                            
                                            ?>
                                            </p>
                                        </li>
                                        <?php  }
                                        
                                        if(!empty($job_count)){?>
                                        <li>
                                            <label class="label"><?php echo esc_html__('Job Posted','freeagent')?></label>
                                            <p class="result"><?php echo ''.$job_count; ?></p>
                                        </li>
                                        <?php }
                                        if(!empty($spendings_total)){
                                        ?>
                                        <li>
                                            <label class="label"><?php echo esc_html__('Total Spend','freeagent')?></label>
                                            <p class="result"><?php echo jws_format_price($spendings_total); ?></p>
                                        </li>
                                        <?php }?>
                                    </ul>
                                    <a class="elementor-button btn btn-underlined border-thin view_detail" href="<?php echo get_the_permalink($employer_id);?>"><?php echo esc_html__('View Profile','freeagent');?></a>
                                </div>
                                
                                <?php
                                 
                               
                    
                           
                    
                    ?>
    
        </div>
       
        <?php
          
          $args_list  = array(
                'author'         => $job_author_id,
                'post_type'      => 'jobs',  // Change this to your custom post type
                'post__not_in'   => array( get_the_ID() ),
                'post_status' => 'publish',
                'orderby' => 'date',
                'order'   => 'DESC',
            );
                        
            $jobs_query = new WP_Query($args_list);
           if ($jobs_query->have_posts()) :
        ?>
         <div class="widget job-employer">
          <div class="widget-title fs-md fw-500"><?php echo esc_html__('Other jobs by this Client','freeagent'); ?></div>
          <ul class="job_simple_layout">
          <?php
                while ($jobs_query->have_posts()) :
                    $jobs_query->the_post();
                    
                     $price_html = jws_cost(get_the_ID());
                      $jobs_type = get_post_meta($post_id, 'job_type', true);
                 
                        if($jobs_type == 1) {
                            $type = 'Hourly';
                        } elseif($jobs_type == 2) {
                            $type = 'Fixed';
                        }else {
                            $type = '';
                        }
                    ?>
                    <li class="job_list">
                        <a href="<?php echo get_the_permalink();?>">
                            <i class="jws-icon-circle-right"></i><span class="title"><?php echo get_the_title()?></span><span class="jws_price"><?php echo ''.$price_html;?></span><span class="type"><?php echo ''.$type;?></span>
                       </a>
                    </li>
                    <?php
                    
                endwhile;
                wp_reset_postdata();
           
          ?>
          </ul>
         </div>
          <?php  endif;?>
       
    </div>
<?php endif;?>

<div id="submit-proposal" class="mfp-hide rad_10 overflow-hidden popup-global submit-proposal">

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
                    		'<i class="jws-icon-clock"></i> %s <span class="result"> %s</span>',
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
        
        <?php 
        
           $current_user_id = get_current_user_id();
           $active_profile = get_user_meta($current_user_id,'_active_profile', true);
         
           if(!is_user_logged_in()) {
            
             echo esc_html__('Please log in as a freelancer','freeagent');
            
           }elseif($active_profile != '2') {
            
             echo esc_html__('You are not a freelancer','freeagent');
            
           } else {
              
              Jws_Proposal_View::jws_proposal_create($post_id); 
            
           }
       
         ?> 
     
     </div>
     <div class="form-button al-center">
          <button class="form-submit-cancel elementor-button btn btn-underlined border-thin" type="button"><?php echo esc_html__('Cancel','freeagent'); ?></button>   
          <button class="form-submit-btn proposal-submit elementor-button" type="button"><?php echo esc_html__('Send Now','freeagent'); ?></button>  
      </div>
      
</div>
<div id="submit-report" class="mfp-hide rad_10 overflow-hidden popup-global submit-report">
    <div class="popup-form">
           <h5><?php echo esc_html__('Report this Job','freeagent');?></h5>
           <?php
             $reports = get_terms(array(
                'taxonomy' => 'report_cat',
                'hide_empty' => false, // Set to true if you want to exclude empty terms
            ));
                   
          if ($reports && !is_wp_error($reports)) {
           ?>
        <form>
            <div class="form-group">
                <label class="fw-700"><?php echo esc_html__('Choose reason','freeagent');?></label>
                 <select name="reason">
                 <?php foreach ($reports as $report) {
                  echo '<option value="'.$report->term_id.'">'.$report->name.'</option>';
                    }?>
                </select> 
            </div>
            <div class="form-group">
                <label  class="fw-700"><?php echo esc_html__('Details','freeagent');?></label>
                <textarea name="description" rows="4" <?php echo esc_html__('Describe the issue...','freeagent');?> required></textarea>
            </div>
            <input type="hidden" name="job_report" value="<?php echo esc_attr($post_id); ?>" />
            <input type="hidden" name="reason_type" value="job" />
            <button class="form-submit-btn report-submit elementor-button d-block" type="button"><?php echo esc_html__('Report','freeagent'); ?></button>  
        </form>
        <?php }?>
    </div>
</div>