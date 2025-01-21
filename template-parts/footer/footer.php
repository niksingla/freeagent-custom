<?php
/**
 * Displays the post footer
 *
 * @package WordPress
 * @subpackage freeagent
 * @since 1.0.0
 */
global $jws_option;
$page_footer = get_post_meta(get_the_ID(), 'page_select_footer', true);
?>
<div class="jws_footer">
   <?php  if(class_exists('Jws_Elementor')) { Jws_Elementor::display_footer(); } ?>   	
</div>
<?php 


