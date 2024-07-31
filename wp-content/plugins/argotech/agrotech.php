<?php
include 'agrotech_contacts.php';
include 'agrotech_custom_types.php';
include 'agrotech_meta.php';

 /**
 * Plugin Name: ОЗСМ "АгроТех" Плагін
 * Description: Власний плагін, що містить функціонал для сайту.
 */

if ( is_admin() ) {
    require_once __DIR__ . '/agrotech.php';
}

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

 /**
 * Activate the plugin.
 */

if ( ! function_exists( 'at_activate' ) ) {
	function at_activate() {
		// Trigger our function that registers the custom post type plugin.
		at_setup_custom_post_types();
		// Clear the permalinks after the post type has been registered.
		flush_rewrite_rules();
	}
 }
register_activation_hook( __FILE__, 'at_activate' );


/**
 * Deactivation hook.
 */

if ( ! function_exists( 'at_deactivate' ) ) {
	function at_deactivate() {
		// Unregister the post type, so the rules are no longer in memory.
		unregister_post_type( 'product' );
		unregister_post_type( 'spare_part' );
		// Clear the permalinks to remove our post type's rules from the database.
		flush_rewrite_rules();
	}
}
register_deactivation_hook( __FILE__, 'at_deactivate' );
