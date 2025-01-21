<?php 

  $args = wp_parse_args( $args, array(
        'global_url' => '#',
  ) );
    
 extract( $args );
 
 
    $employer_id = Jws_Custom_User::get_employer_id( $author_id );
    $verified = get_post_meta($employer_id,'verified', true);
    $verified_lable='';
    if($verified==true){
        $verified_lable= '<span class="verified"><i class="jws-icon-check-circle-fill"></i></span>';
    }
    
    $facebook = get_post_meta($post_id, 'facebook_url', true);
    $twitter_url = get_post_meta($post_id, 'twitter_url', true);
    $linkedin_url = get_post_meta($post_id, 'linkedin_url', true);
    
 
 
 $jobs_total = get_posts(array(
    'fields'          => 'ids', // Only get post IDs
    'posts_per_page'  => -1,
    'author__in' => array( $author_id ) ,
	'post_type' =>'jobs',
	'post_status' => 'publish',
));

$jobs_total = !empty($jobs_total) ? count($jobs_total) : 0;

$saved = get_post_meta($employer_id,'freelancer_saved', true);
$saved2 = get_post_meta($employer_id,'me_followers', true);

$following_total = !empty($saved) ? count($saved) : 0;
$followers_total = !empty($saved2) ? $saved2 : 0;

$spendings_total = 0;
$table = JWS_STATEMENTS_TB; global $wpdb;
if($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table) { 
      $query_spendings = "SELECT * FROM ".$table." WHERE user_type = 'em' AND t_status = '2'  AND  user_id = '" . $author_id . "' ORDER BY  `timestamp` DESC";
      $results_spendings = $wpdb->get_results($query_spendings);
      
      if(!empty($results_spendings)) {
            
          foreach($results_spendings as $spendings) {
            $spendings_total += $spendings->price;
            
          }
            
      }

}

$completed_jobs = get_posts(array( 
		'author__in' => array( $author_id ) ,
		'post_type' =>'jobs',
		'post_status' => 'completed',
		'orderby' => 'date',
		'order'   => 'DESC',
        'posts_per_page'  => -1,												
));

$completed_jobs = !empty($completed_jobs) ? count($completed_jobs) : 0;

?>


<div class="box_left">
    <div class="author_wap">
        <div class="author_avatar"><?php jws_image_advanced($post_id,'thumbnail');;?></div>
        <h1 class="title"><?php echo get_the_title();?><?php echo ''.$verified_lable;?></h1>
        <p class="excerpt"><?php echo get_the_excerpt();?></p>
        <div class="more_detail_user">
        <div class="total_project"><strong><?php echo esc_html($jobs_total); ?></strong><p class="label"><?php echo esc_html__('Projects','freeagent');?></p></div>
        <div class="total_follower"><strong><?php echo esc_html($followers_total); ?></strong><p class="label"><?php echo esc_html__('Followers','freeagent');?></p></div>
        <div class="total_following"><strong><?php echo esc_html($following_total); ?></strong><p class="label"><?php echo esc_html__('Following','freeagent');?></p></div>            </div>
        <div class="btn_actions">
            <?php if(function_exists('jws_button_employer_save')) jws_button_employer_save( $post_id ); ?>
            <a href="javascript:void(0);" class="btn_message" data-modal-jws="#create-chat"> <?php echo esc_html__('Message','freeagent');?><i class="jws-icon-chat"></i>  </a>
            <?php Jws_Dashboard_Chat::form_chat_popup(compact('author_id')); ?>
        </div>
		<?php if(!empty($facebook) || !empty($twitter_url) || !empty($linkedin_url)):?>
        <div class="media">
            <label><?php echo esc_html__('Social Media','freeagent');?></label>
            <div class="icon-author">
                <?php if(!empty($facebook)) echo '<a href="'.esc_url($facebook).'"><i class="fab fa-facebook-f"></i></a>';?>
                 <?php if(!empty($twitter_url)) echo '<a href="'.esc_url($twitter_url).'"><i class="fab fa-twitter"></i></a>';?>
                <?php if(!empty($twitter_url)) echo '<a href="'.esc_url($linkedin_url).'"><i class="fab fa-linkedin-in"></i></i></a>';?>
            </div>
        </div>
		<?php endif;?>
    </div>
    <div class="more_detail">
    <?php
     $em_cats= get_the_terms( $post_id, 'employers_cat'); 
      $em_loca= get_the_terms( $post_id, 'employers_location');
      $size = get_the_terms( $post_id,'employers_size'); 
    ?>
    <ul>
    <?php  if(!empty($em_cats)){?>
        <li>
            <label class="label"><?php echo esc_html__('Department','freeagent')?></label>
            <p class="result"><?php 
            
           
            
                $listings_link = get_post_type_archive_link('employers') . '?employers_cat';
             	foreach ( $em_cats as $term  ) {
             	  echo '<a href="' .esc_url($listings_link.'='.$term->slug). '" rel="tag">' . esc_html($term->name) . '</a> ';
             	}
               
            
            ?></p>
        </li>
        <?php  }
            if(!empty($em_loca)){
        ?>
        <li>
            <label class="label"><?php echo esc_html__('Location','freeagent')?></label>
            <p class="result">
            <?php 
               
             
                $listings_link = get_post_type_archive_link('employers') . '?employers_location';
             	foreach ( $em_loca as $term  ) {
             	  echo '<a href="' .esc_url($listings_link.'='.$term->slug). '" rel="tag">' . esc_html($term->name) . '</a> ';
             	}
               
            ?>
            </p>
        </li>
        <?php  }
        $spendingstotal = jws_format_price($spendings_total);
         if(!empty($$spendingstotal)){
        ?>
        <li>
            <label class="label"><?php echo esc_html__('Total Spent','freeagent')?></label>
            <p class="result"><?php echo jws_format_price($spendings_total); ?></p>
        </li>
        <?php }
        if(!empty($completed_jobs)){
        ?>
        <li>
            <label class="label"><?php echo esc_html__('Jobs paid','freeagent')?></label>
            <p class="result"><?php echo esc_html($completed_jobs); ?></p>
        </li>
        <?php }
        
        ?>
        <li>
            <label class="label"><?php echo esc_html__('Total Views','freeagent')?></label>
            <p class="result"><?php echo jws_gt_get_post_view();?></p>
        </li>
        <?php if(!empty($size)){?>
        <li>
            <label class="label"><?php echo esc_html__('Employer Size','freeagent')?></label>
            <p class="result">
            <?php
            
             	foreach ( $size as $term  ) { 
            	 echo ''.$term->name;
            	}
             
            ?>
            </p>
        </li>
        <?php }?>
        <li>
            <label class="label"><?php echo esc_html__('Member since','freeagent')?></label>
            <p class="result"><?php echo get_the_date();?></p>
        </li>
    </ul>
    </div>
    <a href="" class="elementor-button btn_contact" data-modal-jws="#employer-contact"><?php echo esc_html__('Contact Me','freeagent')?></a>
    <div class="btn_bottom">
        <div class="share">
            <?php jws_freelance_share();?>
            <a href="javascript:void(0);" class="btn_share"><i class="jws-icon-share"></i> <?php echo esc_html__('Share','freeagent');?></a>
        </div>
        
        <a href="javascript:void(0);" class="btn_report" data-modal-jws="#submit-report"> <i class="jws-icon-warning-light"></i><?php echo esc_html__('Report','freeagent');?>  </a>
            
    </div>
</div>


<div id="submit-report" class="mfp-hide rad_10 overflow-hidden popup-global">
  <div class="form-heading">
       <h5><?php echo esc_html__('Report ','freeagent').get_the_title(); ?></h5>
  </div>
  <div class="form-content">
  <form>
    <div class="form-field">
        <select name="reason">
            <option value=""><?php echo esc_html__('Select reason','freeagent'); ?></option>
            <option value="fake"><?php echo esc_html__('This is the fake','freeagent'); ?></option>
            <option value="other"><?php echo esc_html__('Other','freeagent'); ?></option>
        </select>
    </div>
    <div class="form-field">
     
     <textarea name="description" placeholder="<?php echo esc_attr__('Report Description','freeagent'); ?>"></textarea>
    
    </div>
    <input type="hidden" name="user_report" value="<?php echo esc_attr($author_id); ?>" />
    <input type="hidden" name="reason_type" value="employer" />
  </form>    
  </div>
  <div class="form-button al-center">
          <button class="form-submit-cancel elementor-button btn btn-underlined border-thin" type="button"><?php echo esc_html__('Cancel','freeagent'); ?></button>   
          <button class="form-submit-btn hiring-submit elementor-button" type="button"><?php echo esc_html__('Send','freeagent'); ?></button>  
   </div>
</div>  

<div id="employer-contact" class="mfp-hide rad_10 overflow-hidden popup-global">
  <div class="form-heading">
       <h5><?php echo esc_html__('Contact ','freeagent').get_the_title(); ?></h5>
  </div>
  <div class="form-content">
  <form>
    <div class="form-field">
    
      <input type="text" name="subject" placeholder="<?php echo esc_attr__('Subject','freeagent'); ?>" />
        
    </div>
    <div class="form-field">
    
      <input type="email" class="form-control" name="email" placeholder="<?php echo esc_attr__('E-mail','freeagent'); ?>" required="required">
        
    </div>
    <div class="form-field">
    
      <input type="text" class="form-control style2" name="phone" placeholder="<?php echo esc_attr__('Phone','freeagent'); ?>" required="required">
        
    </div>
    <div class="form-field">
     
     <textarea name="message" placeholder="<?php echo esc_attr__('Message','freeagent'); ?>"></textarea>
    
    </div>
    <input type="hidden" name="user_post" value="<?php echo esc_attr($author_id); ?>" />
  </form>    
  </div>
  <div class="form-button al-center">
          <button class="form-submit-cancel elementor-button btn btn-underlined border-thin" type="button"><?php echo esc_html__('Cancel','freeagent'); ?></button>   
          <button class="form-submit-btn hiring-submit elementor-button" type="button"><?php echo esc_html__('Send','freeagent'); ?></button>  
   </div>
</div>    