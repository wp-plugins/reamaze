<?php
/**
 * Reamaze Admin Dashboard Widgets.
 *
 * @author      Reamaze
 * @category    Admin
 * @package     Reamaze/Admin
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if ( ! class_exists( 'Reamaze_Admin_Dashboard_Widgets' ) ) :

/**
 * Reamaze_Admin_Dashboard_Widgets
 */
class Reamaze_Admin_Dashboard_Widgets {

  public function __construct() {
    add_action( 'wp_dashboard_setup', array( $this, 'init' ) );
  }

  public function init() {
    wp_add_dashboard_widget( 'reamaze_dashboard_overview_widget', __( 'Reamaze Overview', 'reamaze' ), array( $this, 'overview_widget' ) );
  }

  public function overview_widget() {
    $reamazeAccountId = get_option('reamaze_account_id');
    $reamazeApiKey = wp_get_current_user()->reamaze_api_key;

    if ( ! empty( $reamazeAccountId ) && ! empty( $reamazeApiKey ) ) {
      $openConversationsResult = Reamaze\API\Conversation::all( array( "filter" => 'open' ) );
      $unassignedConversationsResult = Reamaze\API\Conversation::all( array( "filter" => 'unassigned' ) );
      $accountBaseUrl = "https://" . $reamazeAccountId . ".reamaze.com";
      ?>
      <?php if ( $openConversationsResult['total_count'] == 0 && $unassignedConversationsResult['total_count'] == 0 ) { ?>
        <p class="support-queue-empty"><i class="fa fa-thumbs-o-up"></i>Great job! Your support queue is empty.</p>
      <?php } else { ?>
        <ul class="clearfix">
          <li class="open_count"><i class="fa fa-fire"></i> <a data-reamaze-path="/admin?filter=open" href="<?php echo $accountBaseUrl ?>/admin?filter=open" target="_blank"><?php printf( __( '<strong>%s</strong> unresolved', 'reamaze' ), $openConversationsResult['total_count'] ); ?></a></li>
          <li class="unassigned_count"><i class="fa fa-bell-o"></i> <a data-reamaze-path="/admin?filter=unassigned" href="<?php echo $accountBaseUrl ?>/admin?filter=unassigned" target="_blank"><?php printf( __( '<strong>%s</strong> unassigned', 'reamaze' ), $unassignedConversationsResult['total_count'] ); ?></a></li>
        </ul>
      <?php } ?>
      <p style="text-align: center;">
        <a data-reamaze-path="/admin?filter=all" href="<?php echo $accountBaseUrl ?>/admin?filter=all">View all conversations</a>
      </p>
      <?php
    } else {
      $reamazeSettingsURL = admin_url('/admin.php?page=reamaze-settings');
      if ( ! $reamazeAccountId ) {
        $link = sprintf( wp_kses( __( 'Please provide your Reamaze Account ID and SSO Key <a href="%s">here</a>.', 'reamaze' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( $reamazeSettingsURL . '&tab=account' ) );
        ?>
        <div style="text-align: center; padding: 20px;">
          <h2><?php echo __( "Reamaze Setup Incomplete", 'reamaze'); ?><h2>
          <p><?php echo $link ?></p>
        </div>
        <?php
      } elseif ( ! $reamazeApiKey ) {
        $link = sprintf( wp_kses( __( 'Please provide your Reamaze API Key <a href="%s">here</a>.', 'reamaze' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( $reamazeSettingsURL . '&tab=personal' ) );
        ?>
        <div style="text-align: center; padding: 20px;">
          <h2><?php echo __( "API Key Not Found", 'reamaze'); ?><h2>
          <p><?php echo $link ?></p>
        </div>
        <?php
      }
    }
  }
}

endif;

return new Reamaze_Admin_Dashboard_Widgets();
