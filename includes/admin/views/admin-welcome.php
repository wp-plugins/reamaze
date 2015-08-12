<?php


if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
global $reamaze;

$reamazeSettingsURL = menu_page_url( 'reamaze-settings', false );
$link = sprintf( wp_kses( __( 'Already have one? Please provide your Reamaze Account ID and SSO Key <a href="%s">here</a>.', 'reamaze' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( $reamazeSettingsURL . '&tab=account' ) );

?>
<div id="reamaze-admin-welcome">
  <iframe src="https://www.reamaze.com/tour" frameborder="0" allowtransparency="true" id="reamaze-tour-iframe"></iframe>
  <section class="hero">
    <img alt="Reamaze" src="<?php echo $reamaze->plugin_url() . '/assets/images/logo.png'; ?>" style="height: 48px; margin-bottom: 20px;" />

    <h1 style="font-size: 30px;"><?php echo __( "Customer Conversations Made Easy", 'reamaze'); ?></h1>
    <h3><?php echo __( "Get your team talking to customers, beyond just email.", 'reamaze'); ?></h3>
    <p>
      <a class="button button-primary button-hero" target="_blank" href="https://www.reamaze.com/signup?referrer=wordpress"><?php echo __( 'Create An Account', 'reamaze' ); ?></a>
      <a class="button button-secondary button-hero tour-cta" href="javascript:;"><?php echo __( 'Show Me', 'reamaze' ); ?></a>
    </p>
    <p style="margin-bottom: 0;"><?php echo $link ?></p>
  </section>
  <div class="triple-hr"></div>
  <section class="logo-wall">
    <h2><?php echo __( "Helping amazing companies build personal relationships with customers", 'reamaze'); ?></h2>

    <div class="logos">
      <img src="<?php echo $reamaze->plugin_url() . '/assets/images/tour/logo-pc.png'; ?>" alt="Logo pc">
      <img src="<?php echo $reamaze->plugin_url() . '/assets/images/tour/logo-trianglegs.png'; ?>" alt="Logo trianglegs">
      <img src="<?php echo $reamaze->plugin_url() . '/assets/images/tour/logo-moviepilot.png'; ?>" alt="Logo moviepilot">
      <img src="<?php echo $reamaze->plugin_url() . '/assets/images/tour/logo-codeity.png'; ?>" alt="Logo codeity">
      <img src="<?php echo $reamaze->plugin_url() . '/assets/images/tour/logo-twice.png'; ?>" alt="Logo twice">

      <span>
        <img src="<?php echo $reamaze->plugin_url() . '/assets/images/tour/logo-codeschool.png'; ?>" alt="Logo codeschool">
        <img src="<?php echo $reamaze->plugin_url() . '/assets/images/tour/logo-printful.png'; ?>" alt="Logo printful">
      </span>
    </div>
  </section>
</div>

<script>
var closeTour = function() {
  jQuery('#reamaze-tour-iframe').hide();
};
var $iframe = jQuery('#reamaze-tour-iframe');

$iframe.on('load', function(e) {
  // change visibility of iframe "on load" to prevent iframe white flash
  // http://css-tricks.com/prevent-white-flash-iframe/
  $iframe.css('visibility', 'visible');

  var $tourcta = jQuery('.tour-cta');
  $tourcta.addClass('ready');
  window.setTimeout(function() { $tourcta.addClass('in'); }, 1);
});

jQuery('.tour-cta').click(function(e) {
  e.preventDefault();

  jQuery('body').addClass('hide-reamaze-widget').css('overflow', 'hidden');

  $iframe.show().trigger('focus'); // given iframe focus so it can listen to [esc] key
  jQuery.postMessage({message: 'tour:start', parent_url: window.location.href}, 'https://www.reamaze.com/tour', $iframe[0].contentWindow);
  jQuery.receiveMessage(function(o) {
    if (o.data == 'tour:close') {
      closeTour();
    }
  }, 'https://www.reamaze.com')

  return false;
});
</script>