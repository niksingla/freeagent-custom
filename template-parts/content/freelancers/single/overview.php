<div class="overview active" id="overview">
    <div class="introduction">
    <?php
    
    $get_freelacer_type = '';
    $freelancer_types = get_the_terms( get_the_id(),'freelancers_type'); 

    if ($freelancer_types && !is_wp_error($freelancer_types)) {
        // Iterate through each term and echo its name
        foreach ($freelancer_types as $freelancer_type) {
            $get_freelacer_type= $freelancer_type->slug ;
        }
    } 
    
    if(isset($get_freelacer_type) && $get_freelacer_type=='freelancers'){
        $title = esc_html__('About Me','freeagent');
        $skill = esc_html__('My Skills','freeagent');
    }else{
        $title = esc_html__('About Us','freeagent');
         $skill = esc_html__('Our Skills','freeagent');
    }

    ?>
        <div class="title_intro"><?php echo ''.$title;?></div>
        <div class="content_intro"><?php echo get_the_content();?></div>
    </div>
    
    <div class="posted_projects introduction">
    <div class="title_intro"><?php echo ''.$skill;?></div>
    <div class="program_languages">
        <?php 
        if ($freelancers_skill && !is_wp_error($freelancers_skill)) {
            $visible_terms = array_slice($freelancers_skill, 0, 7); // Display the first 3 terms
            $hidden_terms = array_slice($freelancers_skill, 7); // Remaining terms to be hidden initially
            $listings_link = get_post_type_archive_link('freelancers') . '?freelancers_skill';
            foreach ($visible_terms as $term) {
                echo '<a href="' . esc_url($listings_link.'='.$term->slug) . '" rel="tag">' . esc_html($term->name) . '</a>';
            }

            foreach ($hidden_terms as $term) {
                echo '<a href="' . esc_url($listings_link.'='.$term->slug) . '" rel="tag" class="hidden-term">' . esc_html($term->name) . '</a>';
            }
            if(count($hidden_terms)>0){
                echo '<a href="javascript:void(0);" class="show_more">+'.count($hidden_terms).'</a>';
            }
        }
        ?>
    </div>
    </div>
    <div class="introduction posted_projects">
    <div class="title_intro"><?php echo esc_html__('Work History and Feedback','freeagent');?></div>
    	
        <?php
            get_template_part( 'template-parts/content/freelancers/single/reviews' );
        ?>
    </div>
</div>