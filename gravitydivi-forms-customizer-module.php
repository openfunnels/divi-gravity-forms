<?php
/**
 * Plugin Name: 	Divi Gravity Forms
 * Plugin URI:		https://openfunnels.com
 * Description:		Quickly and easily make beautiful online forms when you combine the power of Gravity Forms and Divi with this custom module! NOTE: Gravity Divi requires the Gravity Forms plugin to be installed and active. Special thanks to DiviCake.com :)
 * Version: 		1.0.2
 * Author:			OPENFUNNELS
 * Author URI: 		https://openfunnels.com/author/OPENFUNNELS/
 *
*/

if ( ! defined( 'ABSPATH' ) ) exit;


	/**
	 * Perform requirement checks
	 * @since  1.0.0
	*/
	add_action( 'admin_init', 'child_plugin_has_parent_plugin' );
	function child_plugin_has_parent_plugin() {
		if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
			add_action( 'admin_notices', 'child_plugin_notice' );

			deactivate_plugins( plugin_basename( __FILE__ ) );

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		}
	}
	function child_plugin_notice(){
		echo '<div class="error"><p>Sorry, but Divi Gravity Forms requires the Gravity Forms plugin to be installed and active to function.</p></div>';
	}


	/**
	 * Adds a hook to the et_builder_ready action. The dcsbcm_Init_Custom_Module function then checks if the Builder Module class exists and if true, runs the new module class.
	 * @since  1.0.4
	*/
	function dcgd_Init_Custom_Module() {
		if ( ! class_exists( 'ET_Builder_Module' ) ) { return; }
		require_once( 'includes/dcgd-module.php' );
	}
	add_action('et_builder_ready', 'dcgd_Init_Custom_Module');


	/**
	 * Enqueue Front-End Scripts & Stylesheets
	 * @since  1.0.0
	*/
	function dcgd_enqueue_scripts() {
		wp_enqueue_style( 'dcgd-style', plugin_dir_url( __FILE__ ) . 'includes/dcgd-style.css');
	}
	add_action( 'wp_enqueue_scripts', 'dcgd_enqueue_scripts', 99);


	/**
	 * Enqueue Admin Styles
	 * @since  1.0.0
	*/
	add_action('admin_footer', 'dcgd_admin_scripts');
	function dcgd_admin_scripts() {
		echo '<style type="text/css">';
		echo 	'li.et_pb_dcgd_gravity_divi_module {';
		echo 		'background-color: #ff009c !important;';
		echo 		'color: #fff !important;';
		echo 	'}';
		echo 	'li.et_pb_dcgd_gravity_divi_module:hover {';
		echo 		'background-color: #ec0090 !important;';
		echo 		'color: rgba(255, 255, 255, 0.9) !important;';
		echo 	'}';
		echo 	'input#et_pb_divi_cake {display:none}';
		echo 	'li.et_pb_dcgd_gravity_divi_module:before {';
		echo 		'font-family: "ETmodules";';
		echo 		'content: "\62";';
		echo 	'}';
		echo	'.et-pb-option[data-option_name="button_use_icon"],';
		echo	'.et-pb-option[data-option_name="button_icon"],';
		echo	'.et-pb-option[data-option_name="button_icon_color"],';
		echo	'.et-pb-option[data-option_name="button_icon_placement"],';
		echo	'.et-pb-option[data-option_name="button_on_hover"] {';
		echo		'display:none !important;';
		echo	'}';
		echo '</style>';
		echo '<script>localStorage.removeItem("et_pb_templates_et_pb_dcgd_gravity_divi_module");</script>';
	}


	/**
	 * Filter the Gravity Forms button type
	 * @since  1.0.0
	*/
	add_filter( 'gform_submit_button', 'dcgd_form_submit_button', 10, 2 );
	function dcgd_form_submit_button( $buttonHTML, $form ) {
		if ( $buttonHTML != '' ) {
			$buttonHTMLDOM = new DOMDocument();
			$buttonHTMLDOM->loadHTML( $buttonHTML );

			$changeElementInput = $buttonHTMLDOM->getElementsByTagName( 'input' );
			foreach ( $changeElementInput as $item ) {
				$buttonValue = trim( $item->getAttribute( 'value' ) );
				if ( $buttonValue == '' ) { $buttonValue = 'Submit'; }
				$item->removeAttribute( 'value' );
				$item->setAttribute( 'style' , 'margin:auto' );
			}
			$buttonHTML = $buttonHTMLDOM->saveHTML();

			$buttonHTML = str_replace( '<input', '<button', $buttonHTML );
			$buttonHTML = str_replace( 'class="gform_button', 'class="dcgd_submit_button et_pb_contact_submit et_pb_button gform_button', $buttonHTML );
			$buttonHTML = $buttonHTML . '<span>' . $buttonValue . '</span></button>';
		}
		return $buttonHTML;
	}


	/**
	 * Plugin Updater
	 * @since  1.0.3
	*/
	require_once('includes/plugin_update_check.php');
	$MyUpdateChecker = new PluginUpdateChecker_2_0 (
	   'https://kernl.us/api/v1/updates/5d1a9c86475c4004cc26e1bd/',
	   __FILE__,
	   'divi-gravity-forms',
	   1
	);
