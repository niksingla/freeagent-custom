<?php 
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
  
    
    
  
    
$terms = get_the_terms( get_the_ID(),'category');


if($format == 'quote'){ ?>

     <div class="jws_post_quote">
         <i class="link_icon jws-icon-quotation-marks"></i>
         <div class="jws_quote_content">
               <h5 class="jws_quote_excerpt">
                        <?php  echo get_the_title();?>
                        
               </h5>
               <?php $quote_name = get_post_meta(get_the_ID(), 'blog_name_quote', true); if(isset($quote_name)) echo '<div class="quote_name">'.$quote_name.'</div>';  ?>
         </div>
     </div>
<?php }elseif($format == 'link'){ ?>
    <div class="jws_post_link">
         <i class="link_icon jws-icon-link"></i>
         <div class="jws_link_content">
         <h5 class="link_text"><?php the_title(); ?> </h5>
               <?php $link_name = get_post_meta(get_the_ID(), 'blog_name_link', true);
                if(isset($link_name)) echo '<p class="link_name"><a href="'.get_post_meta(get_the_ID(), 'blog_url_link', true).'">'.$link_name.'</a></p>';  ?>
         </div>
     </div>
<?php } else{?>
   <div class="jws_post_wap <?php if(!has_post_thumbnail()) {echo 'no_thumbnail';}?>">
        <div class="jws_post_image">
          <?php 
          if($settings['show_thumbnail']=='yes'){
          if($format == 'gallery'){  
                include( 'format/gallery.php' );
          }else {
            echo ' <a href="'.get_permalink().'">';
            if (function_exists('jws_getImageBySize')) {
                     $attach_id = get_post_thumbnail_id();
                     $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                     echo (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
            
                     }else {
                     echo ''.$img = get_the_post_thumbnail(get_the_ID(), $image_size);
              }
              
              echo '</a>';
              
               if($format == 'audio') {
               $link_audio = get_post_meta(get_the_ID(), 'blog_audio_url', true); 
               ?>
               
                <figure>
                    <audio class="blog-audio-player"
                        controls
                        src="<?php echo esc_url($link_audio); ?>">
                            Your browser does not support the
                            <code>audio</code> element.
                    </audio>
                </figure>
                <?php 
                }
              if($format == 'video') {
                $link_video = get_post_meta(get_the_ID(), 'blog_video', true);
                ?>
                 <div class="video_format">
                     <a class="url" href="<?php echo esc_url($link_video); ?>">
                        <span class="video_icon">
                           <i class="jws-icon-play"></i>
                        </span>
                     </a>
                 </div>
                 <?php
              }
          }
          }
         ?>
        </div>
        <div class="jws_post_content">
               <div class="jws_post_meta">

                   <?php if($settings['show_category']=='yes' && !empty($terms)):?>
                     <span class="post_cat">
                     <?php echo get_the_term_list(get_the_ID(), 'category', '', ' - '); ?>
                     </span>
                    <?php endif;?>
               </div>
               <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5> 
               <?php 
               
               if($settings['show_excerpt'] || !has_post_thumbnail()): ?>
               <div class="jws_post_excerpt">
                        <?php  echo (!empty($settings['excerpt_length'])) ? wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], $settings['excerpt_more'] ) : get_the_excerpt();?>
               </div>
               <?php endif; ?>
                <?php if($settings['show_date']=='yes'):?>
                    <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>
                <?php endif;?> 
               <?php if($settings['show_readmore']): ?>
               <a href="<?php the_permalink(); ?>" class="jws_post_readmore">
                    <span><?php echo esc_html($settings['readmore_text']); ?></span>
                    <span class="jws_icon">
                     <?php
           
                        if ( isset($settings['icon']) && !empty($settings['icon']['value']) ) {
    						\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
    					} else{ ?>
    					  
    					<?php }  
                     
                     ?> 
                 </span>
               </a>
               <?php endif; ?>
        </div>
    </div>   
<?php }


  
