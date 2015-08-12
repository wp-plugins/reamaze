<?php
/**
 * Admin View: Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$reamazeAccountId = get_option( 'reamaze_account_id' );
$reamazeSSOKey = get_option('reamaze_account_sso_key');
$path = isset($_GET['path']) && !empty($_GET['path']) ? $_GET['path'] : '/admin';
if ( ! strpos( $path, '?' ) ) {
  $path .= '?1=1';
}

if ( ! $reamazeAccountId || ! $reamazeSSOKey ) {
  include_once('admin-welcome.php');
} else {
?>
<div class="wrap">
  <div id="reamaze-launch-external"><a target="_blank" href="https://<?php echo $reamazeAccountId; ?>.reamaze.com/admin"><?php echo __("Launch Reamaze in New Window", 'reamaze'); ?></a></div>
  <div id="reamaze-dashboard"></div>
</div>


<script type="text/javascript">
  (function($) {
    var _baseUrl = "https://<?php echo $reamazeAccountId; ?>.reamaze.com";
    var _user = {
      "id": "<?php echo 'wp-admin-' . wp_get_current_user()->ID; ?>",
      "email": "<?php echo wp_get_current_user()->user_email; ?>",
      "authkey": "<?php echo Reamaze_Admin::get_auth_key('wp-admin-' . wp_get_current_user()->ID, wp_get_current_user()->user_email); ?>",
      "parent_url": window.location.href
    };
    var url = _baseUrl + '<?php echo $path ?>&' + $.param({sso: _user, framed: 1, app: 'wordpress'});
    var embedEle = $('<iframe/>').attr({style: "min-height: 400px;", width: "100%", src: url, scrolling: "no", frameborder: "0", allowtransparency: "true", name: "_embed"});
    $("#reamaze-dashboard").append(embedEle);

    $.receiveMessage(function(e) {
      var msgAr = $.deparam(e.data);
      var frame = $('iframe[name="' + msgAr._name + '"]');
      if (frame.length) {
        frame.height(msgAr._height);
      }
    }, _baseUrl);
  })(jQuery);
</script>
<?php
}
