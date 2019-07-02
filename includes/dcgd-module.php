<?php if ( ! defined( 'ABSPATH' ) ) exit;
/*  ################################################################
	Gravity Divi - Gravity Forms Customizer Module
	
	Module Name: Gravity Divi
	Version: 1.0.5
	www.GravityDivi.com
	CODECRATER
	https://divicake.com/author/CODECRATER/
	################################################################
*/
	
	
	class dcgd_Gravity_Divi_Custom_Module extends ET_Builder_Module {
		function init() {
			$this->name       = 'Gravity Divi';
			$this->slug       = 'et_pb_dcgd_gravity_divi_module';
			$this->fb_support = false;


			$this->whitelisted_fields = array(
			
				'gf_form',
				'show_title',
				'show_description',
				'enable_ajax',
				'tab_index',
				'background_layout',
				'admin_label',
				'module_id',
				'module_class',
			);

			$this->fields_defaults = array(
				'background_layout' => array( 'light' ),
			);

			$this->main_css_element = '%%order_class%%.dcgd_gravity_divi_wrapper';
			
			$this->options_toggles = array(
				'general'  => array(
					'toggles' => array(
						'form_settings' => esc_html__( 'Form Settings', 'et_builder' ),
					),
				),
				'custom_css' => array(
					'toggles' => array(
						'advancedformoptions'  => esc_html__( 'Advanced Form Options', 'et_builder' ),
						'dcgd_typurchase' => array(
							'title'    => 'Thank You for Purchasing GravityDivi! <3',
							'priority' => 95,
						),
					),
				),
			);
		
			$this->advanced_options = array(
				'background' => array(
					'settings' => array(
						'color' => 'alpha',
					),
				),
				'fonts' => array(
					'fontstitle' => array(
						'label'    => esc_html__( 'Form Title', 'et_builder' ),
						'css'      => array(
							'main' => "{$this->main_css_element} h3.gform_title",
						),
					),
					'fontsformdesc'   => array(
						'label'    => esc_html__( 'Form Description', 'et_builder' ),
						'css'      => array(
							'main' => "{$this->main_css_element} span.gform_description",
						),
					),
					'fontsformbody'   => array(
						'label'    => esc_html__( 'Form Body', 'et_builder' ),
						'css'      => array(
							'main' => "{$this->main_css_element} .gform_body label",
						),
					),
					'fontsformelements'   => array(
						'label'    => esc_html__( 'Form Elements', 'et_builder' ),
						'css'      => array(
							'main' => "{$this->main_css_element} input, {$this->main_css_element} textarea, {$this->main_css_element} select, {$this->main_css_element} .ginput_container_radio label, {$this->main_css_element} .ginput_container_checkbox label",
							'important' => 'all',
						),
					),
				),
				'button' => array(
					'button' => array(
						'label' => esc_html__( 'Button', 'et_builder' ),
						'css' => array(
							'main' => "{$this->main_css_element} .dcgd_submit_button",
						),
					),
				),
				'custom_margin_padding' => array(
					'css' => array(
						'important' => 'all',
					),
				),
			);
			
			$this->custom_css_options = array(
				'formcss_title' => array(
					'label'    => esc_html__( 'Form Title', 'et_builder' ),
					'selector' => 'h3.gform_title',
				),
				'formcss_description' => array(
					'label'    => esc_html__( 'Form Description', 'et_builder' ),
					'selector' => 'span.gform_description',
				),
				'formcss_labels' => array(
					'label'    => esc_html__( 'Field Labels', 'et_builder' ),
					'selector' => 'label.gfield_label',
				),
				'formcss_input' => array(
					'label'    => esc_html__( '<input> Elements', 'et_builder' ),
					'selector' => 'input',
				),
				'formcss_textarea' => array(
					'label'    => esc_html__( '<textarea> Elements', 'et_builder' ),
					'selector' => 'textarea',
				),
				'formcss_submitbutton' => array(
					'label'    => esc_html__( 'Submit Button', 'et_builder' ),
					'selector' => 'button.dcgd_submit_button',
				),
				'formcss_submitbuttonhover' => array(
					'label'    => esc_html__( 'Submit Button Hover', 'et_builder' ),
					'selector' => 'button.dcgd_submit_button:hover',
				),
			);
		}

		function get_fields() {
		
		
		
	
			$fields = array(
				'divi_cake' => array(
					'label'       => 'Discover more great Divi products on <a href="https://divicake.com/products/" target=="_blank">DiviCake.com</a>',
					'type'        => 'text',
					'description' => '<a href="https://divicake.com/products/" target=="_blank"><img src="https://divicake.com/wp-content/uploads/dcnet/divi-cake-size-heading.jpg" alt="Divi Cake is a community driven marketplace for Divi Child Themes, Builder Layouts, and Plugins - Shop Now!" style="width:100%" /></a>',
					'toggle_slug' => 'dcgd_typurchase',
					'tab_slug'    => 'custom_css',
				),
				'gf_form' => array(
					'label'           => esc_html__( 'Choose Gravity Form', 'et_builder' ),
					'type'            => 'select',
					'option_category' => 'basic_option',
					'options'         => $this->get_gform_choices(),
					'toggle_slug'     => 'form_settings',
					'description'     => 'Select a form that you would like to display. You can create new forms <a href="/wp-admin/admin.php?page=gf_new_form" target=="_blank">by clicking here</a>.',
				),
				'show_title' => array(
					'label'             => esc_html__( 'Show Form Title', 'et_builder' ),
					'type'              => 'yes_no_button',
					'option_category'   => 'layout',
					'options'           => array(
						'off' => esc_html__( "No", 'et_builder' ),
						'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
					'toggle_slug'         => 'form_settings',
					'description'       => esc_html__( 'Choose whether or not to display the Form Title.', 'et_builder' ),
				),
				'show_description' => array(
					'label'             => esc_html__( 'Show Form Description', 'et_builder' ),
					'type'              => 'yes_no_button',
					'option_category'   => 'basic_option',
					'options'           => array(
						'off' => esc_html__( "No", 'et_builder' ),
						'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
					'toggle_slug'       => 'form_settings',
					'description'       => esc_html__( 'Choose whether or not to display the Form Description.', 'et_builder' ),
				),
				'enable_ajax' => array(
					'label'             => esc_html__( 'Enable AJAX?', 'et_builder' ),
					'type'              => 'yes_no_button',
					'option_category'   => 'basic_option',
					'options'           => array(
						'off' => esc_html__( "No", 'et_builder' ),
						'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
					'toggle_slug'       => 'form_settings',
					'description'       => esc_html__( 'Specify whether or not to use AJAX to submit the form.', 'et_builder' ),
				),
				'background_layout' => array(
					'label'           => esc_html__( 'Text Color', 'et_builder' ),
					'type'            => 'select',
					'option_category' => 'color_option',
					'options'         => array(
						'light' => esc_html__( 'Dark', 'et_builder' ),
						'dark'  => esc_html__( 'Light', 'et_builder' ),
					),
					'toggle_slug'       => 'form_settings',
					'description' => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
				),
				'tab_index' => array(
					'label'           => esc_html__( 'Tabindex', 'et_builder' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'description'     => esc_html__( 'Specify the starting tab index for the fields of this form. (integer)' ,'et_builder' ),
					'tab_slug'        => 'custom_css',
					'toggle_slug'     => 'advancedformoptions',
				),
				'disabled_on' => array(
					'label'           => esc_html__( 'Disable on', 'et_builder' ),
					'type'            => 'multiple_checkboxes',
					'options'         => array(
						'phone'   => esc_html__( 'Phone', 'et_builder' ),
						'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
						'desktop' => esc_html__( 'Desktop', 'et_builder' ),
					),
					'additional_att'  => 'disable_on',
					'option_category' => 'configuration',
					'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
					'tab_slug'        => 'custom_css',
					'toggle_slug'     => 'visibility',
				),
				'admin_label' => array(
					'label'       => esc_html__( 'Admin Label', 'et_builder' ),
					'type'        => 'text',
					'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
					'toggle_slug' => 'admin_label',
				),
				'module_id' => array(
					'label'           => esc_html__( 'CSS ID', 'et_builder' ),
					'type'            => 'text',
					'option_category' => 'configuration',
					'tab_slug'        => 'custom_css',
					'toggle_slug'     => 'classes',
					'option_class'    => 'et_pb_custom_css_regular',
				),
				'module_class' => array(
					'label'           => esc_html__( 'CSS Class', 'et_builder' ),
					'type'            => 'text',
					'option_category' => 'configuration',
					'tab_slug'        => 'custom_css',
					'toggle_slug'     => 'classes',
					'option_class'    => 'et_pb_custom_css_regular',
				),
			);
			return $fields;
		}
		
		public static function get_gform_choices() {
			
			$dcgd_form_list = array();
			$forms = RGFormsModel::get_forms( null, 'title' );
			foreach ( $forms as $form ) {
				$dcgd_form_list[$form->id] = $form->title;
			}
			asort($dcgd_form_list);
			if ( empty($dcgd_form_list) ) {
				$dcgd_form_list[0] = 'No Forms Found';
			}
			return $dcgd_form_list;
		}

		function shortcode_callback( $atts, $content = null, $function_name ) {
			
			
			$module_id         = $this->shortcode_atts['module_id'];
			$module_class      = $this->shortcode_atts['module_class'];
			$gf_form           = $this->shortcode_atts['gf_form'];
			$show_title    		= $this->shortcode_atts['show_title'];
			$show_description   = $this->shortcode_atts['show_description'];
			$enable_ajax    	= $this->shortcode_atts['enable_ajax'];
			$tab_index    	= $this->shortcode_atts['tab_index'];
			$background_layout = $this->shortcode_atts['background_layout'];
			
			
			
			
			
			if ( $show_title == 'on' ) {
				$show_title = 'true';
			} else {
				$show_title = 'false';
			}
			
			
			if ( $show_description == 'on' ) {
				$show_description = 'true';
			} else {
				$show_description = 'false';
			}
			
			
			if ( $enable_ajax == 'on' ) {
				$enable_ajax = 'true';
			} else {
				$enable_ajax = 'false';
			}
			
			
			$tab_index = trim ( $tab_index );
			if ( is_numeric( $tab_index ) ) {
				$tab_index = intval( $tab_index );
				$tab_index = 'tabindex="' . $tab_index . '"';
			} else {
				$tab_index = '';
			}
			
			
			
			$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

			$class = " et_pb_module et_pb_bg_layout_{$background_layout}";
			
			$dcgd_Output_GformShortcode = sprintf(
				'[gravityform id="%1$s" title="%2$s" description="%3$s" ajax="%4$s" %5$s]',
				$gf_form,
				$show_title,
				$show_description,
				$enable_ajax,
				$tab_index
			);
			$dcgd_Output_GformShortcode = do_shortcode( $dcgd_Output_GformShortcode );
			
			$dcgd_Output = sprintf(
				'<div%3$s class="dcgd_gravity_divi_wrapper clearfix%2$s%4$s">%1$s</div><!-- .dcgd_gravity_divi_wrapper -->',
				$dcgd_Output_GformShortcode,
				esc_attr( $class ),
				( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
				( '' !== $module_class ? sprintf( ' %1$s', esc_attr( ltrim( $module_class ) ) ) : '' )
			);
			
			return $dcgd_Output;

		}
	}
	new dcgd_Gravity_Divi_Custom_Module;
?>