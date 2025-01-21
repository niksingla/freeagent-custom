<?php
$post_id = get_the_ID();
$location = get_the_terms( $post_id,'freelancers_location');
$freelancers_skill =get_the_terms( $post_id,'freelancers_skill');
$hourly_rate =get_post_meta( $post_id,'min_price', true);
$price_html = jws_cost($post_id);
$freelancers_position =get_post_meta( $post_id,'freelancers_position', true);
$image_size ='70x70';
$fr_feedback = get_post_meta($post_id, 'feedback_fr', true);
$total_feedback = 0;
if (is_array($fr_feedback) && !empty($fr_feedback)) {
    $total_feedback = count($fr_feedback);
}

$job_author_id = $post->post_author;
$freelancer_id = Jws_Custom_User::get_freelaner_id( $job_author_id );

$verified = get_post_meta($freelancer_id,'verified', true);
 $verified_lable='';
 if($verified==true){
    $verified_lable= '<span class="verified"><i class="jws-icon-check-circle-fill"></i></span>';
 }
?>

<div class="jws-freelancers-wap"> 
    <?php jws_button_freelancer_save( $post_id );?>
    <div class="jws-freelancers-images">
    <?php
    echo ' <a href="'.get_permalink().'">';
            if (function_exists('jws_getImageBySize')) {
                 $attach_id = get_post_thumbnail_id();
                 $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                 echo (!empty($img['thumbnail'])) ? $img['thumbnail'] : '<img src="' . get_template_directory_uri() . '/assets/image/avatar.png" alt="Placeholder Image">';
            }
  
      echo '</a>';
      echo ''.$verified_lable;
    ?>
    </div>
       <div class="jws-freelancers-content">
       <p class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p> 
       <?php
        if(!empty($freelancers_position)){
         echo '<h5 class="position"><a href="'.get_the_permalink().'">'.$freelancers_position.'</a></h5>';   
        }
        ?>
        <div class="post_cat">
         <?php 
           
        if ($freelancers_skill && !is_wp_error($freelancers_skill)) {
            $listings_link = get_post_type_archive_link('freelancers') . '?freelancers_skill';
            $visible_terms = array_slice($freelancers_skill, 0, 3); // Display the first 3 terms
            $hidden_terms = array_slice($freelancers_skill,3); // Remaining terms to be hidden initially

            foreach ($visible_terms as $term) {
                echo '<a href="' .esc_url($listings_link.'='.$term->slug) . '" rel="tag">' . esc_html($term->name) . '</a>';
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
      <div class="jws_post_excerpt"><?php echo get_the_excerpt();?></div>
        <div class="bottom_infor">
           <div class="count_review"><i class="fa fa-star"></i> <?php echo average_rating_formatted($post_id);?> <span class="total_review">(<?php echo ''.$total_feedback;?>)</span></div>
           <div class="location">
           <?php  
            if(!empty($location)){
             	foreach ( $location as $term  ) {
             	   $logo_loca_value = get_field('logo_loca', $term);
            		echo '<img src="' . esc_url($logo_loca_value['url']) . '" alt="Logo" />' . $term->name;
            	}
             }
            ?>
           </div>
           <?php
            if(!empty($hourly_rate)){
            echo ' <div class="price_info"><strong class="price">'.$price_html.'</strong><span class="time">/'.esc_html__('hr','freeagent').'</span></div>';    
            }
           ?>
        </div>
    </div> 
</div>