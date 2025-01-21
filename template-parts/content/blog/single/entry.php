<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage freeagent
 * @since 1.0.0
 */
global $jws_option; 

    $comments_number = get_comments_number();
     $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
    $image_size = (isset($jws_option['single_blog_imagesize']) && !empty($jws_option['single_blog_imagesize'])) ? $jws_option['single_blog_imagesize'] : 'full';

     jws_gt_set_post_time();
    $time_read = get_post_meta( get_the_ID(), 'time_read', true );
    $terms = get_the_terms( get_the_ID(),'category');
    $author = get_the_author();
    $format = has_post_format() ? get_post_format() : 'no_format'; 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header>
            <div class="jws_post_image <?php if(!has_post_thumbnail()) echo esc_attr(' post-no-thumbnail'); ?>">
               <div class="jws_post_image_inner<?php if(!empty($gallery)) echo esc_attr(' post-image-slider'); ?>">
              
                <?php 
                if($format=='link'){
                     get_template_part( 'template-parts/content/blog/single/format/link' );
                }elseif($format=='quote'){
                   get_template_part( 'template-parts/content/blog/single/format/quote' ); 
                }else{ 
                    if($format == 'gallery') {
                       get_template_part( 'template-parts/content/blog/single/format/gallery' );
                  }else{
                   echo'<div class="post_thumbnail">';
                   if (function_exists('jws_getImageBySize')) {
                         $attach_id = get_post_thumbnail_id();
                         $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                         echo ''.(!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                   } 
                                  $link_audio = get_post_meta(get_the_ID(), 'audio_url_embed', true); 
                   if($format == 'audio') {
                    if(empty($link_audio)){
                        $link_audio = get_post_meta(get_the_ID(), 'blog_media_radio', true);
                        
                    }
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
                                 <i class="jws-icon-arrow-right-outline"></i>
                            </span>
                         </a>
                     </div>
                     <?php
                  }
                  

                   echo '</div>'; 
                 }
                 }
              ?>
            </div>
        </div>
        <div class="jws_post_meta">
               <?php if(!empty($archive_year)):?>
               <span class="entry-date"><span class="jws-icon-calendar-outline"></span><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>
                <?php endif;?> 
                <?php if(!empty($archive_year) && !empty($terms)){
                    echo '<span class="line"> - </span>';
                   }?>
            <?php if(!empty($terms)):?>
             <span class="post_cat">
             <?php  
             	foreach ( $terms as $term  ) {
      		     echo '<a href="' . esc_url( get_term_link( $term ) ) . '"><span class="cat_title">' . $term->name . '</span></a>';
       	       }
             ?>
         </span>
        <?php endif;?>

        </div>
        <h2 class="entry_title"><?php the_title();?></h2>
        <div class="jws-post-author">
            <a  href="<?php echo esc_url(get_author_posts_url( get_the_author_meta('ID') )); ?>"><?php  echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?><?php echo 'By '.get_the_author(); ?></a> 
        </div> 
        </header>

           <div class="entry_content">
                    <div class="content">
                      <?php the_content(); ?> 
                        <div class="row single_post_meta">
                            <div class="post_tags col-xl-7 col-lg-6 col-12">
                                <?php echo jws_get_tags(); ?>
                            </div>
                            <div class="post_share col-xl-5 col-lg-6 col-12">
                                    <div class="post-share-inner">
                                        <div class="jws-share">
                                             <?php if(function_exists('jws_post_share')) echo jws_post_share(); ?> 
                                            <button> 
                                                <span class="share"><?php echo esc_html__('Share','freeagent'); ?></span> 
                                                <i aria-hidden="true" class="open jws-icon-share"></i>
                                                 
                                                 <i aria-hidden="true" class="close eva eva-close"></i>
                                            </button>
                                               
                                    </div>
                                </div>
                            </div>
                            <?php
                                get_template_part( 'template-parts/content/blog/single/template/author_box/author_box1' );
                                 get_template_part( 'template-parts/content/blog/single/template/nav/nav2' ); 
                                
                            ?>
                        </div>
                    </div>                
           </div>
           <div class="clear-both"></div>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'freeagent' ),
				'after'  => '</div>',
			)
		);
		?>

</article><!-- #post-<?php the_ID(); ?> -->
