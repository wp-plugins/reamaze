<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Reamaze Helper Functions
 *
 * @author      Reamaze
 * @package     Reamaze
 * @version     1.0
 */

if ( ! function_exists( 'is_ajax' ) ) {
  function is_ajax() {
    return defined( 'DOING_AJAX' );
  }
}
