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
   
$image_size = (isset($_GET['size']) && $_GET['size'] ) ? $_GET['size'] : (isset($jws_option['single_blog_imagesize']) && $jws_option['single_blog_imagesize'] ? $jws_option['single_blog_imagesize'] : 'full');

    $terms = get_the_terms( get_the_ID(),'category');
    $author = get_the_author();
    $format = has_post_format() ? get_post_format() : 'no_format'; 
    $comment_count = get_comments_number(); // Get the number of comments

if ( $comment_count === 0 ) {
    $comment = esc_html__('No comments','freeagent');
} elseif ( $comment_count === 1 ) {
    $comment=  '1'.esc_html__(' comment','freeagent');
} else {
    $comment = $comment_count . esc_html__(' comments','freeagent');
}

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
                    
                ?>

                   <div class="header_title">
                       <div class="jws_post_meta">
                        <?php 
                        if($terms):?>
                         <span class="post_cat"> 
                         
                         <?php  
                         	foreach ( $terms as $term  ) {
                         	  $category_color = function_exists('get_field') ? get_field('color', 'category_' . $term->term_id) : '';
                        		echo '<a href="' . esc_url( get_term_link( $term ) ) . '"  style="background:'.$category_color.'"><span class="cat_title">' . $term->name . '</span></a>';
                        	}
                                             ?>
                          </span>
                         <?php endif;?>
                       </div>
                        <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1> 
                       <div class="excerpt"><?php echo get_the_excerpt();?></div>
                        <div class="meta_infor">
                            <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>
                            <span class="line"></span>
                           <a  class="jws-post-author" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta('ID') )); ?>"><?php echo esc_html('By ','freeagent').get_the_author(); ?></a> 
                       </div>
                   </div>
                <?php
                    if($format == 'gallery') {
                       get_template_part( 'template-parts/content/blog/single/format/gallery' );
                  }else{
                   echo'<div class="post_thumbnail">';
                   if (function_exists('jws_getImageBySize')) {
                         $attach_id = get_post_thumbnail_id();
                         $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                         echo ''.(!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                   } 
                                 
                   if($format == 'audio') {
                    wp_enqueue_script('media-element'); 
                    wp_enqueue_style('mediaelementplayer');
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
                                <i aria-hidden="true" class="jws-icon-play"></i>
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
        </header>

           <div class="entry_content">
                    <div class="content">
                      <?php the_content(); ?> 
                        <div class=" single_post_meta">
                             <?php echo jws_get_tags(); ?>
                            <div class="jws_share_post post_share">
                                <?php echo jws_post_share();?>
                            </div>
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
