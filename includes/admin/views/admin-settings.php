<?php
/**
 * Admin View: Settings
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

?>
<div class="wrap">
	<form method="POST" action="" enctype="multipart/form-data">
		<h2 class="nav-tab-wrapper">
			<?php
				foreach ($tabs as $name => $label) {
					echo '<a href="' . admin_url('admin.php?page=reamaze-settings&tab=' . $name) . '" class="nav-tab ' . ($current_tab == $name ? 'nav-tab-active' : '') . '">' . $label . '</a>';
				}
			?>
		</h2>

		<?php
			do_action('reamaze_settings_' . $current_tab);
		?>

		<p class="submit">
			<input name="save" class="button-primary" type="submit" value="<?php _e( 'Save Changes', 'reamaze' ); ?>" />
			<a href="javascript:;" style="margin-left: 2em;" data-reamaze-lightbox="kb">Need help?</a>
			<input type="hidden" name="subtab" id="last_tab" />
			<?php wp_nonce_field( 'reamaze-settings' ); ?>
		</p>
	</form>
</div>
