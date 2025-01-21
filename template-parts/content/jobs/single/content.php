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

?>

<div class="container">

    <div class="row">
    
    
        <div class="col-xl-8">
           
           <div class="job-content">
             
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
             
             
             <div class="job-content">
              
                   <div class="job-sestion-heading fw-500 fs-md">
                           <?php echo esc_html__('Description','freeagent'); ?> 
                   </div>
             
               <?php the_content(); ?>
             
             
             </div>
             
             <div class="job-skill">
                  
               <?php 
                   
                   $term_list = get_the_terms($post_id, 'jobs_skill');
                   if(!empty($term_list)) :
                    $listings_link = get_post_type_archive_link('jobs') . '?jobs_skill';
                ?>
              
               <div class="job-sestion-heading fw-500 fs-md">
                       <?php echo esc_html__('Skills & Expertises','freeagent'); ?> 
               </div>
               
               <?php 
               
                  echo '<div>';
                   foreach ($term_list as $term) {
                        echo '<a href="' . esc_url($listings_link.'='.$term->slug) . '" rel="tag">' . esc_html($term->name) . '</a>';
                    }
                  echo '</div>';
                  endif;
 
                ?>
              
             
             </div>
             
             <?php 
             
             $attachments = get_field('jobs_attachments',$post_id);
             
             if(!empty($attachments)) :
             
             ?>
             
             <div class="job-attachments">
            
               <div class="job-sestion-heading fw-500 fs-md">
                       <?php echo esc_html__('Attachments','freeagent'); ?> 
               </div>
               
               <?php 
             
                
                 if ( $attachments && is_array( $attachments ) ) {
                        echo '<ul class="rs_ul_ol">';
                		foreach ( $attachments as $attachment_id ) {
                		    
                		    $url_file = wp_get_attachment_url($attachment_id);
                            $file_info = pathinfo($url_file);
                       
                			?>
                            <li class="file-item d-inline-block">
                              <a href="<?php echo esc_attr($url_file); ?>" class="d-flex" download>
                                <div class="file-icon">
                                  <i class="jws-icon-paperclip"></i>
                                </div>
                                <div class="file-info">
                                   <div class="fs-small"><?php echo esc_html($file_info['basename']); ?></div>
                                   <span class="file-type"><?php echo esc_html($file_info['extension']); ?></span>
                                   <span class="file-size"><?php echo size_format(filesize(get_attached_file( $attachment_id ))); ?></span>
                                </div>
                              </a>  
                            </li>
                            <?php
                    
                		}
                        echo '</ul>';
                 }
                  
                  
                ?>
              
             
             </div>
             
             <?php endif; 
             
              $ques_ans = get_field('jobs_ques_ans',$post_id);
             
              if($ques_ans) : ?>
             
             <div class="job-qa">
                
               <div class="job-sestion-heading fw-500 fs-md">
                       <?php echo esc_html__(' Job Q&A','freeagent'); ?> 
               </div>
               
               <?php 
 
                     echo '<div class="qa-wap"><div class="qa-list">';

                       
                     foreach ($ques_ans as $key => $item) {
                           
                            $active = ($key == '0') ?  ' active' : '';
                    
                            ?>
                            <div class="ac-item<?php echo ''.$active; ?>">
                                <div class="ac-top">
                                  <span class="ac-icon"><i class="jws-icon-plus"></i></span>
                                  <?php echo esc_attr($item['questions']); ?>
                                </div>
                                <div class="ac-content">
                                    <div><?php echo esc_textarea($item['answer']); ?></div>
                                </div> 
                            </div>
                            <?php
                      }
                      echo '</div></div>';
                   
               ?>
             </div>
             
             <?php endif; ?>
             
              <!--Proposal-->
              <?php
              
               if($post_status == 'publish') : ?>
             <div class="job_proposal">
             <div class="job-sestion-heading fw-500 fs-md"><?php echo esc_html__('Project Proposals ','freeagent') .'('.$proposal_count.')';?></div>
                <div class="project_proposals">
                    <ul class="proposal_list">
                    <?php
                      if ($proposals->have_posts()) :
                        while ($proposals->have_posts()) :
                            $proposals->the_post();
                            
                            $proposal_id = get_the_ID();
                            $time = human_time_diff(get_the_time('U'), current_time('timestamp')) .esc_html__(' ago','freeagent');

                            $proposal_amount = get_post_meta( $proposal_id,'proposal_amount', true);
                            $proposal_hour = get_post_meta( $proposal_id,'proposal_hour', true);
                           
                            $author_id = get_post_field('post_author', $proposal_id);
                            $author_data = get_userdata($author_id);
                            $name = $author_data->display_name;
                             
                            $freelancer_id = get_user_meta($author_id, 'freelancer_id', true);
                            $freelancer_permalink = get_permalink($freelancer_id);
                            $freelancer_name = get_the_title($freelancer_id);
                            $free_location = get_the_terms( $freelancer_id,'freelancers_location');

                            $thumbnail = get_the_post_thumbnail($freelancer_id, 'thumbnail');
                            $avatar_url = get_avatar_url($author_data->user_email);
                            
                            $proposal_private = get_post_meta( $proposal_id , 'proposal_private' , true);
                            
                            if($proposal_private == 'on') continue;
                             
                     
                            $avatar = (!empty($thumbnail)) ? $thumbnail : '<img src="'.$avatar_url.'" alt="Placeholder Image">';
                            $author_name = (!empty($freelancer_name)) ? $freelancer_name :$name;
                          
                    ?>
                        <li class="proposal_item">
                            <div class="pro_thumbnail"><?php echo ''.$avatar;?></div>
                            <div class="pro_content">
                                <div class="content_header">
                                    <div class="infor_left">
                                        <h6 class="freelancer_name"><a href="<?php echo ''.$freelancer_permalink;?>"> 
                                        <?php echo ''.$author_name;
                                        if($free_location){
                                            foreach ( $free_location as $term  ) {
                                             $logo_loca_value = get_field('logo_loca', $term);
                                                echo '<img src="' . esc_url($logo_loca_value['url']) . '" alt="' . esc_attr($logo_loca_value['alt']) . '" />';
                                            }
                                        }
                                        ?>
                                        
                                        </a></h6>
                                        
                                        
                                        <div class="freelanece_rating">
                                            <?php 
                                            $total_feedback= 0;
                                            $fr_feedback = get_post_meta($freelancer_id, 'feedback_fr', true);
                                           if (is_array($fr_feedback) && !empty($fr_feedback)) {
                                            $total_feedback = count($fr_feedback);
                                            }
                                            if($total_feedback > 0){
                                            freelancer_rating($freelancer_id);
                                            }
                                            ?>
                                            <div class="pro_time"><i class="jws-icon-clock"></i> <span class="time"><?php echo ''.$time;?></span></div>
                                        </div>
                                        </div>
                                     <div class="infor_right">
                                        <h6 class="jws_price"><?php echo jws_format_price($proposal_amount);?></h6>
                                        <p class="response_time"><?php echo esc_html__('in ','freeagent').$proposal_hour.esc_html__(' hours','freeagent');?></p>
                                     
                                     </div>
                                    </div>
                                <div class="cover_letter">
                                       <?php echo get_the_content();?>
                                </div>
                            </div>
                        </li>
                        <?php 
                          endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                </div>
             </div>
             
             <?php endif; 
             $related = get_posts( array( 
                     'numberposts' => 100,
                     'post_type' => 'jobs', 
                     'post__not_in' => array($post->ID),
                     'tax_query' => array(
                        array(
                            'taxonomy' => 'jobs_cat',
                            'field'    => 'term_id',
                            'terms'    =>wp_get_object_terms( $post->ID, 'jobs_cat', array('fields' => 'ids') ),
                        ),
                     ),
                )
                );
             if( isset($related[0]) ) : ?>
             <!--Related-->
           <div class="related_jobs jws_job_layout5">
               <div class="job-sestion-heading fw-500 fs-md"><?php echo esc_html__('Similar Projects','freeagent');?></div>
                <?php
                 foreach( $related as $post ) {
                setup_postdata($post);
                ?>
                <div class="jws_job_item">
                   <?php  get_template_part( 'template-parts/content/jobs/content-list' );?> 
                </div>
                <?php
                }
                    wp_reset_postdata();
                ?>
           </div>
           <?php endif; ?>
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