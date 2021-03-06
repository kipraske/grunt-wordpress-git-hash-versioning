<?php
/**
 * Plugin Name: Diversity Functionality Plugin
 * Description: All server-side behaviors for The Diversity theme will be defined here.
 * Version:     1.0.0
 * Author:      WashU Public Affairs Digital Team
 * Author URI:  https://wustl.edu
 * License:     GPLv2 or later
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ){
	die();
}

if ( ! class_exists( 'Diversity_Functionality_Plugin' ) ) {
	class Diversity_Functionality_Plugin {

		/**
		 * Instance of the class
		 *
		 * @since 1.0.0
		 * @var Instance of Diversity_Functionality_Plugin class
		 */
		private static $instance;

		/* Holds the directory paths for plugin folders.
		 *
		 * @since 1.0.0
		 * @var array of directories
		 */
		public static $directories = array();

		/**
		 * Instantiate a singleton of the plugin
		 *
		 * @since 1.0.0
		 * @static
		 * @staticvar array $instance
		 * @return Instance
		 */
		public static function get_instance() {
			if ( !isset( self::$instance ) && ! ( self::$instance instanceof Diversity_Functionality_Plugin ) ) {
				self::$instance = new Diversity_Functionality_Plugin();
				self::$instance->define_directories();
				self::$instance->load_plugin_files();
				plugin_dir_path(__FILE__);
			}

			return self::$instance;
		}

		/**
		 * Create modifications on activate
		 *
		 * @since 1.0.0
		 */
		public static function activate() {
			// TODO - add activation stuff or remove
		}

		/**
		 * Remove modifications on deactivate
		 *
		 * @since 1.0.0
		 */
		public static function deactivate() {
			// TODO - add activation stuff or remove
		}

		/**
		 * Define the paths of each directory in the plugin
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function define_directories() {
			$plugin_dir = plugin_dir_path(__FILE__);

			self::$directories = array(
				'plugin_root'                  => $plugin_dir,
				'custom_fields'                => $plugin_dir . 'custom-fields/',
				'post_types'                   => $plugin_dir . 'post-types/',
				'taxonomies'                   => $plugin_dir . 'taxonomies/',
				'widgets'                      => $plugin_dir . 'widgets/',
			);
		}

		/**
		 * Load the required files in the plugin
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function load_plugin_files() {
			require_once( self::$directories['custom_fields'] . 'acf-frontpage.php' );
			require_once( self::$directories['custom_fields'] . 'acf-get-involved-page.php' );
			require_once( self::$directories['custom_fields'] . 'acf-initiative-page.php' );
			require_once( self::$directories['custom_fields'] . 'acf-academics-page.php' );
			require_once( self::$directories['custom_fields'] . 'acf-framework-page.php' );
			require_once( self::$directories['custom_fields'] . 'acf-training-page.php' );
			require_once( self::$directories['custom_fields'] . 'acf-groups.php' );
			require_once( self::$directories['custom_fields'] . 'acf-promos.php' );
			require_once( self::$directories['custom_fields'] . 'acf-query-by-page-slug.php' );

			require_once( self::$directories['post_types'] . 'promos.php' );
			require_once( self::$directories['post_types'] . 'profiles.php' );
			require_once( self::$directories['post_types'] . 'groups.php' );

			require_once( self::$directories['taxonomies'] . 'promo-category.php' );
			require_once( self::$directories['taxonomies'] . 'group-category.php' );

			require_once( self::$directories['plugin_root'] . 'extras.php' );
		}

	}
}

function functionality_activate() {
	return Diversity_Functionality_Plugin::activate();
}
register_activation_hook( __FILE__, 'functionality_activate' );


function functionality_deactivate() {
	return Diversity_Functionality_Plugin::deactivate();
}
register_deactivation_hook( __FILE__, 'functionality_deactivate' );

// Finally, load the plugin.
Diversity_Functionality_Plugin::get_instance();
