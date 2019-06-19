<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.codexwp.com/about/
 * @since             1.0.0
 * @package           Cwpcll
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Login And Logs
 * Plugin URI:        https://www.codexwp.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Saif
 * Author URI:        https://www.codexwp.com/about/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cwpcll
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CWPCLL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cwpcll-activator.php
 */
function activate_cwpcll() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cwpcll-activator.php';
	Cwpcll_Activator::activate();
    cwpcll_registerTable();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cwpcll-deactivator.php
 */
function deactivate_cwpcll() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cwpcll-deactivator.php';
	Cwpcll_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cwpcll' );
register_deactivation_hook( __FILE__, 'deactivate_cwpcll' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cwpcll.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function cwpcll_registerTable(){
    global $wpdb;
    $db_name = DB_NAME;
    $table_name = $wpdb->prefix . "cwpcll_logs";

    //Table exists checking
    $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND  TABLE_NAME = '$table_name'";
    $result = $wpdb->get_results($sql);
    if(!$result){
        $sql = "CREATE TABLE $table_name ( 
                    id int(11) NOT NULL AUTO_INCREMENT, 
                    email varchar(255) NOT NULL,
                    ip varchar(25) NOT NULL, 
                    country varchar(50) NOT NULL,
                    created DATETIME NOT NULL,
                    PRIMARY KEY(id) 
                  );";
        $wpdb->get_results($sql);
    }
}

function cwpcll_register_session(){
    if(!session_id()) session_start();
}
add_action("init", "cwpcll_register_session");

function cwpcll_destroy_session() {
    session_destroy();
}
add_action('wp_logout', 'cwpcll_destroy_session');

function run_cwpcll() {

	$plugin = new Cwpcll();
	$plugin->run();

}
run_cwpcll();
