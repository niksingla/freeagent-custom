<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage freeagent
 * @since 1.0.0
 */

get_header();

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="single-jobs-container e-con">   
                <?php
        			/* Start the Loop */
        			while ( have_posts() ) :
        				the_post();
                        
                       get_template_part( 
        	                'template-parts/content/jobs/single/content'
        	           );

                ?>

            <?php	
    			endwhile; // End of the loop.
			?>
                

            </div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();