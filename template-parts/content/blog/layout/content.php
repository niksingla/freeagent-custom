<?php 
    global $jws_option;
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
    jws_gt_set_post_time();
    $time_read = get_post_meta( get_the_ID(), 'time_read', true );
    
        $format = has_post_format() ? get_post_format() : 'no_format'; 

      $image_size = isset($jws_option['blog_imagesize']) ? $jws_option['blog_imagesize'] : 'full';

    
$terms = get_the_terms( get_the_ID(),'category');

if($format == 'quote'){ ?>

     <div class="jws_post_quote">
         <i class="link_icon jws-icon-quotation-marks"></i>
         <div class="jws_quote_content">
               <h3 class="jws_quote_excerpt">
                        <?php  echo get_the_title();?>
                        
               </h3>
               <?php $quote_name = get_post_meta(get_the_ID(), 'blog_name_quote', true); if(isset($quote_name)) echo '<div class="quote_name">'.$quote_name.'</div>';  ?>
         </div>
     </div>
<?php }elseif($format == 'link'){ ?>
    <div class="jws_post_link">
         <i class="link_icon jws-icon-link"></i>
         <div class="jws_link_content">
         <h3 class="link_text"><?php the_title(); ?> </h3>
               <?php $link_name = get_post_meta(get_the_ID(), 'blog_name_link', true);
                if(isset($link_name)) echo '<p class="link_name"><a href="'.get_post_meta(get_the_ID(), 'blog_url_link', true).'">'.$link_name.'</a></p>';  ?>
         </div>
     </div>
<?php } else{?>
   <div class="jws_post_wap <?php if(!has_post_thumbnail()) {echo 'no_thumbnail';}?>">
        <div class="jws_post_image">
          <?php 
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
                wp_enqueue_style('mediaelementplayer');
                wp_enqueue_script('media-element'); 
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
         ?>
        </div>
        <div class="jws_post_content">
               <div class="jws_post_meta">
                    <?php 
                    if($terms):?>
                     <span class="post_cat">
                     <?php  
                     	foreach ( $terms as $term  ) {
                     	   $category_color = function_exists('get_field') ? get_field('color', 'category_' . $term->term_id) : '';
                    		echo '<a href="' . esc_url( get_term_link( $term ) ) . '" style="background:'.$category_color.'"><span class="cat_title">' . $term->name . '</span></a>';
                    	}
                                         ?>
                     </span>
                     <?php endif;?>
               </div>
               <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3> 
               <div class="jws_post_excerpt">
                        <?php  echo get_the_excerpt();?>
               </div>
               <div class="meta_infor">
                    <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>
                    <span class="line"></span>
                   <a  class="jws-post-author" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta('ID') )); ?>"><?php echo esc_html('By ','freeagent').get_the_author(); ?></a> 
               </div>
              
        </div>
    </div>   
<?php }


  
