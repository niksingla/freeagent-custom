<?php

        
$verified = get_post_meta($employer_id,'verified', true);
 $verified_lable='';
 if($verified==true){
    $verified_lable= '<span class="verified"><i class="jws-icon-check-circle-fill"></i></span>';
 }
?>
<div class="jws_job_wap">
    <div class="content_header">
      <h5 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php  echo ''.(!empty($settings['title_length'])) ? wp_trim_words( get_the_title(), $settings['title_length'], $settings['title_more'] ) : get_the_title();?>
      <?php
        if($featured==1){
            echo '<span class="featured">'.esc_html__('Featured ','freeagent').'<i class="jws-icon-lightning"></i></span>';
        }else{
            new_jobs($post_date);
        }
      ?>
      </a></h5>  
      <div class="jws_save">
      <div class="price ">
        <div class="jws_price"> <?php echo ''.$price_html;?></div>
        <div class="job_type">
        <?php switch ($job_type) {
            case '1':
                echo esc_html__('Hourly','freeagent');
                break;
            case '2':
                echo esc_html__('Fixed','freeagent');
                break;
        }?>
    </div>
      </div>     
      </div>
       <?php if(function_exists('jws_button_job_save')) jws_button_job_save($post_id); ?>
    </div>

 
 <div class="jws_job_content">
     <div class="job_infor">
         <div class="post_cat">
            <i class="jws-icon-clock"></i><?php echo esc_html__('Posted ','freeagent').'<span class="time">'.$time_ago.'</span>';?>
         </div>
        
         <div class="total_proposals"><i class="jws-icon-clipboard"></i><?php echo esc_html__('Proposals ','freeagent');?><span class="number_proposals"><?php echo ''.$proposal_count;?></span></div>
        <div class="experience">
            <i class="jws-icon-atom"></i>
            <span class="level">
            <?php 
                 if ($level && !is_wp_error($level)) {
                $job_level_name = $level[0]->name; // Get the name of the first term
                echo ''.$job_level_name;
                }
            ?>
            </span>
        </div>
       
     </div>
     <div class="excerpt"><?php echo get_the_excerpt();?></div>
     <div class="program_languages">
     <?php 
        if ($jobs_skill && !is_wp_error($jobs_skill)) {
            $listings_link = get_post_type_archive_link('jobs') . '?jobs_skill';
            $visible_terms = array_slice($jobs_skill, 0, 3); // Display the first 3 terms
            $hidden_terms = array_slice($jobs_skill, 3); // Remaining terms to be hidden initially

            foreach ($visible_terms as $term) {
                echo '<a href="' . esc_url($listings_link.'='.$term->slug). '" rel="tag">' . esc_html($term->name) . '</a>';
            }

            foreach ($hidden_terms as $term) {
                echo '<a href="' .esc_url($listings_link.'='.$term->slug) . '" rel="tag" class="hidden-term">' . esc_html($term->name) . '</a>';
            }
            if(count($hidden_terms)>0){
                echo '<a href="javascript:void(0);" class="show_more">+'.count($hidden_terms).esc_html__(' More','freeagent').'</a>';
            }
        }
    ?>
     </div>
    <div class="btn_actions">
        <div class="jws_job_image">
            <div class="logo_emp"><a href="<?php echo ''.$employer_permalink;?>"><?php jws_image_advanced($employer_id,'thumbnail');?></a></div>
            <div class="content_heading">
                <div class="name_emp"><span class="name"><?php echo ''.$display_name;?></span> <?php echo ''.$verified_lable;?></div>
 
            <?php
             if ($location && !is_wp_error($location)) {
                $loca_name = $location[0]->name; // Get the name of the first term
                echo '<div class="job_location"><i class="jws-icon-map"></i> '.$loca_name.'</div>';
             }
           ?>
            </div>
        </div>
        <button type="button" class="send-proposal" data-proposal="<?php echo esc_attr(get_the_id()); ?>" data-modal-jws="#submit-proposal-list-<?php echo esc_attr(get_the_id()); ?>"><?php echo esc_html__('Send Proposal','freeagent');?></button>
       
    </div>
 </div>
</div>
<?php get_template_part( 'template-parts/content/jobs/proposal/proposal' );?>