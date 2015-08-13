<?php
/**
 * Missing API Key partial
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$link = sprintf( wp_kses( __( 'Please provide your Reamaze API Key <a href="%s">here</a>.', 'reamaze' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( $reamazeSettingsURL . '&tab=personal' ) );
?>
<div style="text-align: center; padding: 20px;">
  <h2><?php echo __( "API Key Not Found", 'reamaze'); ?><h2>
  <p><?php echo $link ?></p>
</div>
<?php
