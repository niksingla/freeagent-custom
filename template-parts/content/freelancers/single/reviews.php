
<div id="comments" class="reviews comments-review">
    <ol class="comment-list">
    <?php
    $fr_feedback = get_post_meta(get_the_id(), 'feedback_fr', true);

    if (!empty($fr_feedback) && is_array($fr_feedback)) { $fr_feedback = array_reverse($fr_feedback);
    foreach ($fr_feedback as $feedback_item) {
         $user_id = isset($feedback_item['user']) ? $feedback_item['user'] : '';
        $message = isset($feedback_item['message']) ? $feedback_item['message'] : '';
        $rating = isset($feedback_item['rating']) ? $feedback_item['rating'] : '';
        $date = isset($feedback_item['date']) ? $feedback_item['date'] : '';
        $formatted_date = date('m/d/Y', strtotime($date));
        $title_services = isset($feedback_item['service']) ? get_the_title($feedback_item['service']) : '';
        $title_jobs = isset($feedback_item['job']) ? get_the_title($feedback_item['job']) : '';
        $title='';

         if ($title_services){
            $title=esc_html__('Service: ','freeagent').$title_services;
         }elseif($title_jobs){
            $title=esc_html__('Job: ','freeagent').$title_jobs;   
         }
         
         $employer_id = \Jws_Custom_User::get_employer_id( $user_id );
         $display_name = get_the_title($employer_id);

    ?>
        <li class="comment_wrap">
            <div class="comment_top">
                <div class="info_avatar">
                    <div class="avatar"><?php jws_image_advanced($employer_id,'thumbnail');?></div>
                    <div class="jws_rating">
                        <?php echo freelancer_get_rating_html($rating);?>
                        <b class="name"><?php echo ''.$display_name;?></b>
                    </div>
                </div>
                <div class="date"><?php echo ''.$formatted_date;?></div>
            </div>
            <h6 class="comment_title"><?php echo ''.$title;?></h6>
            <div class="message"><?php echo ''.$message;?></div>
        </li>
        <?php } }else{
            echo '<h6>'.esc_html__('Be the first to work with this freelancer.','freeagent').'</h6>';
        }?>
    </ol>
</div>

