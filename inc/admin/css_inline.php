<?php
/**
 * Render custom styles.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jws_custom_css' ) ) {
	function jws_custom_css( $css = array() ) {
    $page_id     = get_queried_object_id();

    $main_color_custom = get_post_meta($page_id, 'main-color', true);
    $bg_btn_color_custom = get_post_meta($page_id, 'button-bgcolor', true);
    $bg_btn_color2_custom = get_post_meta($page_id, 'button-bgcolor2', true);
    global $jws_option;
        /* Main Width */
        
        
        $main_color = (isset($jws_option['main-color']) && $jws_option['main-color']) ? $jws_option['main-color'] : '#07242B';        
        $secondary_color = (isset($jws_option['secondary-color']) && $jws_option['secondary-color']) ? $jws_option['secondary-color'] : '#D4FE00';
        $accent_color = (isset($jws_option['accent-color']) && $jws_option['accent-color']) ? $jws_option['accent-color'] : '#FFC119';


        $body_color = (isset($jws_option['color_body']) && $jws_option['color_body']) ? $jws_option['color_body'] : '#07242B';
        $light_color = (isset($jws_option['color_light']) && $jws_option['color_light']) ? $jws_option['color_light'] : '#ffffff99';
        $bg_color = (isset($jws_option['bg_color']) && $jws_option['bg_color']) ? $jws_option['bg_color'] : '#07242B';
        $bg_btn_color = (isset($jws_option['button-bgcolor']) && $jws_option['button-bgcolor']) ? $jws_option['button-bgcolor'] : '#07242B';
        $bg_btn_color2 = (isset($jws_option['button-bgcolor2']) && $jws_option['button-bgcolor2']) ? $jws_option['button-bgcolor2'] : '#FFC119';
        $btn_color = (isset($jws_option['button-color']) && $jws_option['button-color']) ? $jws_option['button-color'] : '#FFFFFF';
         $heading_color = (isset($jws_option['color_heading']) && $jws_option['color_heading']) ? $jws_option['color_heading'] : '#07242B';




          $css[] = ':root{
            --e-global-color-primary:' . esc_attr( $main_color ) . '; 
            --main: ' . esc_attr( $main_color ).';
            --secondary:'.esc_attr($secondary_color).';
            --accent:'.esc_attr($accent_color).';
            --e-global-color-secondary:'.esc_attr($heading_color).';
            --e-global-color-accent:'.esc_attr($accent_color).';
            --body:' . esc_attr( $body_color ) . ';
            --text:'. esc_attr( $body_color ) . ';
            --light:' . esc_attr( $light_color ) . ';
            --btn-color:' . esc_attr( $btn_color ) . ';
            --btn-bgcolor:' . esc_attr( $bg_btn_color ) . ';
            --btn-bgcolor2:' . esc_attr( $bg_btn_color2 ) . ';
            --bg-color:'.esc_attr( $bg_color ).';
            --heading:'.esc_attr($heading_color).';
          }';
        
        
        
        /* Custom Page Color */
        
        if(!empty($main_color_custom)) {
          $css[] = 'body {--e-global-color-primary:' . esc_attr( $main_color_custom ) . ' !important; --main: ' . esc_attr( $main_color_custom ) . '}';   
        }
        if(!empty($bg_btn_color_custom)) {
          $css[] = 'body {--btn-bgcolor: ' . esc_attr( $bg_btn_color_custom ) . '}';   
        }
        if(!empty($bg_btn_color2_custom)) {
          $css[] = 'body {--btn-bgcolor2: ' . esc_attr( $bg_btn_color2_custom ) . '}';   
        }
        
         /* Custom Font Family */
         /* Custom Font Family */
         $font2 = (isset($jws_option['opt-typography-font2']['font-family']) && $jws_option['opt-typography-font2']['font-family']) ? $jws_option['opt-typography-font2']['font-family'] : 'Inter';
         $body_font = (isset($jws_option['opt-typography-body']['font-family']) && $jws_option['opt-typography-body']['font-family']) ? $jws_option['opt-typography-body']['font-family'] : 'Space Grotesk';

         $css[] = 'body {--font2: ' . esc_attr( $font2 ) . ';--font-body:'.esc_attr($body_font).';}'; 

        $header_absolute = (isset($jws_option['choose-header-absolute']) && $jws_option['choose-header-absolute']) ? $jws_option['choose-header-absolute'] : '';
         if(!empty($header_absolute)) {
            foreach($header_absolute as $value) {
               $css[] ='.jws_header > .elementor-'.$value.'{position:absolute;width:100%;left:0;top:0;}' ;  
            }
         }

		return preg_replace( '/\n|\t/i', '', implode( '', $css ) );
	}
}