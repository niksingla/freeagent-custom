<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage freeagent
 * @since 1.0.0
 */

?>

<section class="no-results not-found col-12">
	<header class="page-header">


	<div class="page-content">

        <?php echo '<div class="not_fault_dashboard"><img src="'.get_template_directory_uri() . '/assets/image/not_found.png"/><h6>'.esc_html__('Sorry! No record was found!','freeagent').'</h6></div>';?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
