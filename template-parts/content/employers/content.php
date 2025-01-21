<?php

$post_id = get_the_ID();
$location = get_the_terms( $post_id,'employers_location');
$size =get_the_terms( $post_id,'employers_size');
$hourly_rate =get_post_meta( $post_id,'min_price', true);
$image_size = '60x60';

$author_id =  $post->post_author;
$employer_id = Jws_Custom_User::get_employer_id( $author_id );
$verified = get_post_meta($employer_id,'verified', true);
 $verified_lable='';
 if($verified==true){
    $verified_lable= '<span class="verified"><i class="jws-icon-check-circle-fill"></i></span>';
 }
 
  $jobs_total = get_posts(array(
    'fields'          => 'ids', // Only get post IDs
    'posts_per_page'  => -1,
    'author__in' => array( $author_id ) ,
	'post_type' =>'jobs',
    'post_status'    => 'publish', // Add any additional statuses as needed

));

$jobs_count = count($jobs_total);


?>

<div class="jws-employers-wap"> 
    <div class="content_top">
    <div class="jws-employers-images">
    <?php
    echo ' <a href="'.get_permalink().'">';
      
            jws_image_advanced($post_id,'thumbnail');
      
      echo '</a>';
    ?>
    </div>
    <div class="jws-employers-content">
           <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php echo ''.$verified_lable;?> </h6> 
            <p class="excerpt"><?php echo get_the_excerpt();?></p>
          
           <div class="location">
           <?php  
            if(!empty($location)){
                
             	foreach ( $location as $term  ) {
             	   $logo_loca_value = get_field('logo_loca', $term);
            		echo '<img src="' . esc_url($logo_loca_value['url']) . '" alt="Logo" />' . $term->name ;
            	}
             }
            ?>
           </div>
          <div class="employer_info">
          <div class="open_job"><span><?php echo esc_html__('Open Job ','freeagent');?></span> <?php echo ''.$jobs_count;?></div>
          
          <?php  
            if(!empty($size)){
                echo '<div class="no_emp"><span>'.esc_html__('No. Employees ','freeagent').'</span> ';
             	foreach ( $size as $term  ) { 
            	  $term_name = $term->name;
                    if (preg_match('/Less than (\d+) workers/', $term_name, $matches)) {
                        $workers_count = isset($matches[1]) ? intval($matches[1]) : 0;
                        echo '&lt;' . esc_html($workers_count);
                       
                    } elseif (preg_match('/More than (\d+) workers/', $term_name, $matches)) {
                        $workers_count = isset($matches[1]) ? intval($matches[1]) : 0;
                        echo '&gt;' . esc_html($workers_count) ;
                    } else {
                        // For other numerical values or custom cases, display as is
                        echo esc_html($term_name);
                    }
            	}
                echo ' </div>';
             }
            ?>
         
          </div>
         </div>
    </div>
        <div class="btn_actions">
            <?php if(function_exists('jws_button_employer_save')) jws_button_employer_save( $post_id ); ?>
            <a href="javascript:void(0);" class="btn_message" data-modal-jws="#create-chat-<?php echo ''.$post_id; ?>"> <?php echo esc_html__('Message','freeagent');?><i class="jws-icon-chat"></i>  </a>
            <?php Jws_Dashboard_Chat::form_chat_popup(compact('post_id','author_id')); ?>
        </div>
   

</div>