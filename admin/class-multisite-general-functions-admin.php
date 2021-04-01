<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/Orinwebsolutions
 * @since      1.0.0
 *
 * @package    multisite_general_functions
 * @subpackage multisite_general_functions/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    multisite_general_functions
 * @subpackage multisite_general_functions/admin
 * @author     Amila <amilapriyankara16@gmail.com>
 */
class multisite_general_functions_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in multisite_general_functions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The multisite_general_functions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/multisite-general-functions-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in multisite_general_functions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The multisite_general_functions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/multisite-general-functions-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function general_functions_new_menu_items()
	{
		// add_submenu_page(
		// 	'themes.php', // Parent element
		// 	'Custom generic setting', // Text in browser title bar
		// 	'Custom generic setting', // Text to be displayed in the menu.
		// 	'manage_options', // Capability
		// 	'custom-generic-settings-page', // Page slug, will be displayed in URL
		// 	array($this, 'custom_generic_settings_page') // Callback function which displays the page
		// );
	 
		add_menu_page(
			'Generic setting',
			'Generic setting',
			'manage_options',
			'custom-generic-settings-page',
			array($this, 'custom_generic_settings_page'),
			'dashicons-admin-generic', // Icon
			100 // Position of the menu item in the menu.
		);
	 
	}

	public function custom_generic_settings_page()
	{
		require_once "partials/multisite-general-functions-admin-display.php";
	}

	public function paypal_save_settings(){

		check_admin_referer( 'PP-network-validate' ); // Nonce security check
	 
		$ppOptions = [];
		
		$fields = [
			'enabled', 'title', 'description', 'email', 'testmode', 'debug', 'ipn_notification', 'receiver_email', 'identity_token',
			'invoice_prefix', 'send_shipping', 'address_override', 'paymentaction', 'page_style', 'image_url', 'api_username',
			'api_password', 'api_signature', 'sandbox_api_username', 'sandbox_api_password', 'sandbox_api_signature'];

		$checkfields = ['enabled', 'testmode', 'debug', 'ipn_notification', 'send_shipping', 'address_override'];

		foreach ($fields as $field) {
			if(isset($_POST['woocommerce_paypal_'.$field]) && in_array($field, $checkfields) ){
				$ppOptions[$field] = 'yes';
			}else if(isset($_POST['woocommerce_paypal_'.$field])){
				$ppOptions[$field] = $_POST['woocommerce_paypal_'.$field];
			}else{
				$ppOptions[$field] = 'no';
			}
		}
		// var_dump($ppOptions);
		// wp_die();
		update_site_option( 'general_woocommerce_paypal_settings', $ppOptions );
		// update_site_option( 'some_checkbox', $_POST['some_checkbox'] );

		//I have override different site option table based on the every site
		$this->updateOptionsThroughOutSites($ppOptions);
	 
		wp_redirect( add_query_arg( array(
			'page' => 'custom-generic-settings-page',
			'updated' => true ), network_admin_url('themes.php')
		));
	 
		exit;
	 
	}

	public function updateOptionsThroughOutSites($options)
	{

			//Skip first item as it might not availble
			//Need to get option id and assign to update else add the option value
			//woocommerce_swish_pay_gateway_settings

// woocommerce_paypal_settings

// general_woocommerce_paypal_settings
//option_name
//option_id

// 2_options
// {site_id}_options



		global $wpdb;
        $blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->prefix}blogs", ARRAY_A);
		foreach ($blogs as $blog) {

			$tableName = $wpdb->prefix.$blog['blog_id'].'_options';
			$post_id = $wpdb->get_results("SELECT `option_id` FROM $tableName WHERE option_name = 'woocommerce_paypal_settings'", ARRAY_A);

			if(count($post_id) == 0){
				// echo 'if';
				$wpdb->insert(
					"$tableName", 
					array( 
						'option_name' => 'woocommerce_paypal_settings', 
						'option_value' => serialize($options),
					),
					array( 
						'%s', 
						'%s', 
					)
				);
			// echo $wpdb->insert_id;
			}else{
				// echo 'else';
				// var_dump($options);
				// echo $post_id[0]['option_id'];
				$result = $wpdb->update(
						"$tableName", 
						array('option_value' => serialize($options)), 
						array('option_id' => $post_id[0]['option_id'], 'option_name'=> 'woocommerce_paypal_settings')
					);
				// echo $result;
			}
		}
		// wp_die();
	}

}
