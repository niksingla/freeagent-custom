<div class="jws_team_image">
    <a href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>>
    
        <?php 
            if (function_exists('jws_getImageBySize')&&!empty($image_size)) {
                 $attach_id = $item['image']['id'];
                 $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                 echo (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
    
             }else {
                    echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); 
              }
        
        
        ?>
    </a>

</div>
<div class="team_info">
    <?php if(!empty($item['list_social'])): ?>
    <div class="social_media">
        <ul class="team-icon-list">
             <?php 
             foreach(  $item['list_social'] as $social ) {
             if(!empty($social['team_icon_url']['url'])){
                    $url = $social['team_icon_url']['url'];
                  $target = $social['team_icon_url']['is_external'] ? ' target="_blank"' : '';
                  $nofollow = $social['team_icon_url']['nofollow'] ? ' rel="nofollow"' : ''; 
             ?>   
             <li>
                <a href="<?php echo esc_url($social['team_icon_url']['url']); ?>" <?php if($social['team_icon_url']['is_external']) echo esc_attr('target="_blank"'); if($social['team_icon_url']['nofollow']) echo esc_attr('rel="nofollow"'); ?> >
               
                <?php
               
                if ($social['team_icon']['library'] === 'fa-brands'){
                    echo '<i class="'.esc_attr($social['team_icon']['value']).'"></i>';
                }elseif ($social['team_icon']['library'] === 'svg'){
                  \Elementor\Icons_Manager::render_icon( $social['team_icon'], [ 'aria-hidden' => 'true' ] );
                  
                }
                ?>
                </a>
             </li> 
             <?php
             }
              } ?>
        </ul>
    </div>
    <?php endif;?>
 
</div>
<div class="jws_team_content">
    <h5 class="team_title">
        <a href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>>
          <?php echo esc_html($item['team_title']); ?>
        </a>
    </h5> 
    <div class="team_job">
            <?php echo esc_html($item['team_job']); ?>
    </div> 
</div>
     
               
               