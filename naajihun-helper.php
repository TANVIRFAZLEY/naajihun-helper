<?php
/**
 * Plugin Name: NaaJihun Helper
 * Description: Naajihun Helper is a widget package for elementor.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Tanvir Fazley
 * Author URI:  https://elementor.com/
 * Text Domain: naajihun-helper
 */

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

/**
 * Main Elementor Class
 */
final class Naajihun_Helper {

    /**
     * Plugin Version
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

    /**
     * Minimum PHP Version
     */
    const MINIMUM_PHP_VERSION = '7.3';

    /**
     * Constructor
     */
    public function __construct() {

        // Load translation
        add_action('init', array($this, 'i18n'));

        // Init Plugin
        add_action('plugins_loaded', array($this, 'init'));
    }

    /**
     * Load Textdomain
     */
    public function i18n() {
        load_plugin_textdomain('naajihun-helper');
    }

    /**
     * Initialize the plugin
     */
    public function init() {

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', array($this, 'admin_notice_missing_main_plugin'));
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', array($this, 'admin_notice_minimum_elementor_version'));
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', array($this, 'admin_notice_minimum_php_version'));
            return;
        }

        // Once we get here, We have passed all validation checks so we can safely include our plugin
        require_once 'plugin.php';
    }

    /**
     * Admin notice
     */
    public function admin_notice_missing_main_plugin() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'naajihun-helper'),
            '<strong>' . esc_html__('Naajihun helper', 'naajihun-helper') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'naajihun-helper') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     */
    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'naajihun-helper'),
            '<strong>' . esc_html__('Naajihun helper', 'naajihun-helper') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'naajihun-helper') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     */
    public function admin_notice_minimum_php_version() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'naajihun-helper'),
            '<strong>' . esc_html__('Naajihun helper', 'naajihun-helper') . '</strong>',
            '<strong>' . esc_html__('PHP', 'naajihun-helper') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
}

// Instantiate Naajihun_Helper
new Naajihun_Helper();