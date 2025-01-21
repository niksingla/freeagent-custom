<?php
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * jws Heading Countdown Render
 *
 */
  

  
  
$html = '';


    $date = $atts['date'];


if ( $date ) {


	$class = 'jws-countdown-animation';

	$html .= '<div class="countdown-container">';

	$html .= '<div class="' . esc_attr( $class ) . '"  data-time-now="' . esc_attr( $date ) . '" ></div>';

	$html .= '</div>';
}

echo ''.$html;
