<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage freeagent
 * @since 1.0.0
 */

$page_turn_off_footer = isset($_GET['footer']) && $_GET['footer']? $_GET['footer'] : get_post_meta(get_the_ID(), 'turn_off_footer', true); 

if ( get_query_var( 'paged' ) )
{
  $paged = get_query_var( 'paged' );
}
else if ( get_query_var( 'page' ) )
{
  $paged = get_query_var( 'page' );
}
else
{
  $paged = 1;
}



 
?>  
	</div><!-- #content -->
	<footer id="colophon" class="site-footer">
        <?php 
     
            if((isset($page_turn_off_footer) && !$page_turn_off_footer) || is_search()) {
               if(function_exists('jws_footer')) jws_footer();   
            }
        ?>

	</footer><!-- #colophon -->

</div><!-- #page -->
  <?php wp_footer(); ?> 

</body>
</html>
