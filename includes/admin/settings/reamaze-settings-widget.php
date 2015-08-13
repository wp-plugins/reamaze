<?php
/**
 * Reamaze Settings Widget
 *
 * @author      Reamaze
 * @category    Admin
 * @package     Reamaze/Admin
 * @version     1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Reamaze_Settings_Widget' ) ) :

/**
 * Reamaze_Settings_Widget
 */
class Reamaze_Settings_Widget extends Reamaze_Settings_Page {
	/**
	 * Constructor
	 */
	public function __construct() {
	  $this->id = 'widget';
	  $this->label = __( 'Widget', 'reamaze' );
		parent::__construct();
	}

	/**
   * Get settings array
   *
   * @return array
   */
  public function get_settings() {
    $settings = array(
      array( 'title' => __( 'Widget Settings', 'reamaze' ), 'type' => 'title', 'id' => 'widget-settings-header' ),

      array(
        'title'    => __( 'Display', 'reamaze' ),
        'id'       => 'reamaze_widget_display',
        'type'     => 'select',
        'default'  => 'all',
        'options'  => array(
          'all'    => __( 'Display Widget on all pages', 'reamaze' ),
          'auth'   => __( 'Display Widget for logged in users only', 'reamaze' ),
          'none'   => __( "Don't display the Widget at all", 'reamaze' )
        )
      ),

      array(
        'title'    => __( 'Widget Code', 'reamaze' ),
        'desc'     => __( "Paste your customized Widget code here. You can customize your widget in Reamaze Admin -> Settings -> Widget Builder", 'reamaze' ),
        'id'       => 'reamaze_widget_code',
        'type'     => 'textarea',
        'default'  => '',
        'css'      => 'max-width: 100%;',
        'raw'      => true,
        'custom_attributes' => array(
          'rows' => 10,
          'cols' => 80
        )
      ),

      array( 'type' => 'sectionend', 'id' => 'widget-settings-header' )
    );

    return $settings;
  }
}

endif;

return new Reamaze_Settings_Widget();
