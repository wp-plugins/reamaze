<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Reamaze Helper Functions
 *
 * @author      Reamaze
 * @package     Reamaze
 * @version     1.0.1
 */

if ( ! function_exists( 'is_ajax' ) ) {
  function is_ajax() {
    return defined( 'DOING_AJAX' );
  }
}

if ( ! function_exists( 'get_reamaze_email' ) ) {
  function get_reamaze_email() {
    $user = wp_get_current_user();
    if ( ! empty( $user->reamaze_login_email ) ) {
      return $user->reamaze_login_email;
    } else {
      return $user->user_email;
    }
  }
}
