<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.codexwp.com/about/
 * @since      1.0.0
 *
 * @package    Cwpcll
 * @subpackage Cwpcll/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cwpcll
 * @subpackage Cwpcll/admin
 * @author     Saif <info@codexwp.com>
 */
class Cwpcll_Admin {

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
		$this->hooks();

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
		 * defined in Cwpcll_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cwpcll_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cwpcll-admin.css', array(), $this->version, 'all' );

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
		 * defined in Cwpcll_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cwpcll_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cwpcll-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function hooks()
    {
        add_action( 'admin_menu', array( $this, 'create_cll_menu_page' ), 60 );
    }

    public function create_cll_menu_page() {
        add_menu_page( "Custom Login Logs", "Login Logs", "manage_options", "cwpcll", array($this,'custom_login_logs'), "", 50 );
        add_submenu_page( 'cwpcll', 'Custom Login Settings', 'Settings', 'manage_options', 'cwpcll-settings', array($this,'custom_login_settings'), "", 50);
    }

    public function custom_login_logs(){

        global $wpdb;
        $table_name = $wpdb->prefix . "cwpcll_logs";
        $sql = "SELECT * FROM $table_name ORDER BY id DESC";
        $logs = $wpdb->get_results($sql);
        $dir_url = plugin_dir_url( __FILE__);
        include_once(plugin_dir_path(__FILE__) . '/partials/cwpcll-admin-login-logs.php');

    }

    public function custom_login_settings(){
        global $wpdb;
        $table_name = $wpdb->prefix . "cwpcll_logs";

        if(isset($_POST['selector_check']) && $_POST['selector_check']=="true")
        {
            $s = $_POST['selector'];
            $p = $_POST['cwpcll_user_pass'];
            update_option("cwpcll_blur_selector", $s);
            update_option("cwpcll_user_pass", $p);
        }

        if(isset($_POST['clear_check']) && $_POST['clear_check']=="true")
        {
            $sql = "DELETE FROM $table_name";
            $wpdb->get_results($sql);
        }

        include_once(plugin_dir_path(__FILE__) . '/partials/cwpcll-admin-login-settings.php');
    }

}
