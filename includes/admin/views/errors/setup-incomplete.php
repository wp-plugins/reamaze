<?php
/**
 * Setup Incomplete partial
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$link = sprintf( wp_kses( __( 'Please provide your Reamaze Account ID and SSO Key <a href="%s">here</a>.', 'reamaze' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( $reamazeSettingsURL . '&tab=account' ) );
?>
<div style="text-align: center; padding: 20px;">
  <h2><?php echo __( "Reamaze Setup Incomplete", 'reamaze'); ?><h2>
  <p><?php echo $link ?></p>
</div>
<?php
