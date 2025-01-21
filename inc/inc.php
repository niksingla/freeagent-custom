<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

require JWS_ABS_PATH . '/inc/freelance-functions.php';
require JWS_ABS_PATH . '/inc/template-functions.php';
require JWS_ABS_PATH . '/inc/template-tags.php';
/**
 * Add Acf Meta Box
 */
require JWS_ABS_PATH . '/inc/admin/acf_metabox/meta_inc.php';

/**
 * Install Plugin
 */
require JWS_ABS_PATH . '/inc/admin/TGM-Plugin-Activation/plugin-option.php';

/**
 * Add Postype
 */
require_once JWS_ABS_PATH . '/inc/admin/posttyle/header_footer.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/employers.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/freelancers.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/portfolios.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/jobs.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/services.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/job_proposal.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/payouts.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/addons.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/service_order.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/dispute.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/chat.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/verify.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/report.php';
require_once JWS_ABS_PATH . '/inc/admin/posttyle/reason_delete_user.php';


/**
 * Add Theme Option
 */
require_once JWS_ABS_PATH . '/inc/admin/theme_option.php';
/**
 * Add Elementor Widget
 */
if (did_action( 'elementor/loaded' ) ) { 
    require_once JWS_ABS_PATH . '/inc/elementor_widget/options/slider.php';
    require_once JWS_ABS_PATH . '/inc/elementor_widget/options/button.php'; 
    require_once JWS_ABS_PATH . '/inc/elementor_widget/options/animation.php'; 
    require_once JWS_ABS_PATH . '/inc/elementor_widget/options/parallax.php';
    require_once JWS_ABS_PATH . '/inc/elementor_widget/elementor_function.php'; 
    require_once JWS_ABS_PATH . '/inc/elementor_widget/elementor_plugin.php';
    require_once JWS_ABS_PATH . '/inc/template_elementor.php';
} 
/**
 * Add Content Ajax.
 */  
require_once JWS_ABS_PATH . '/inc/elementor_widget/content-ajax/call-ajax-content.php';
require_once JWS_ABS_PATH . '/inc/elementor_widget/content-ajax/content-ajax-minicart.php';
/**
 * Add Category Walker
 */
require_once JWS_ABS_PATH . '/inc/category_walker.php';

/**
 * Add Menu Custom.
 */
require_once (JWS_ABS_PATH.'/inc/menu.php');
require_once (JWS_ABS_PATH.'/inc/jws_walker_page.php');

require_once JWS_ABS_PATH . '/inc/widget/widget.php'; 
 
  


require_once (JWS_ABS_PATH.'/inc/admin/css_inline.php');

require_once JWS_ABS_PATH . '/inc/admin/less_to_css.php'; 