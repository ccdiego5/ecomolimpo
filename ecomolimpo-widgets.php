<?php
/**
 * Plugin Name: Ecomolimpo Widgets
 * Plugin URI: https://ecomolimpo.com
 * Description: Colección de widgets personalizados para Elementor - Ecomolimpo
 * Version: 1.0.0
 * Author: Diego Cárdenas
 * Author URI: https://ecomolimpo.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: ecomolimpo-widgets
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Elementor tested up to: 3.35.2
 * Elementor Pro tested up to: 3.35.2
 * 
 * Copyright (c) 2025 Diego Cárdenas - Ecomolimpo
 * All rights reserved.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Main Ecomolimpo Widgets Class
 */
final class Ecomolimpo_Widgets {

    /**
     * Plugin Version
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

    /**
     * Minimum PHP Version
     */
    const MINIMUM_PHP_VERSION = '7.4';

    /**
     * Instance
     */
    private static $_instance = null;

    /**
     * Instance
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Initialize the plugin
     */
    public function init() {
        // Load admin panel
        if (is_admin()) {
            require_once(__DIR__ . '/admin/class-admin.php');
        }

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Register Widget Category
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);

        // Register Widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Register Widget Styles
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'widget_styles']);

        // Register Widget Scripts
        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
    }

    /**
     * Admin notice for missing Elementor
     */
    public function admin_notice_missing_main_plugin() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requiere que "%2$s" esté instalado y activado.', 'ecomolimpo-widgets'),
            '<strong>' . esc_html__('Ecomolimpo Widgets', 'ecomolimpo-widgets') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'ecomolimpo-widgets') . '</strong>'
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice for minimum Elementor version
     */
    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requiere "%2$s" versión %3$s o superior.', 'ecomolimpo-widgets'),
            '<strong>' . esc_html__('Ecomolimpo Widgets', 'ecomolimpo-widgets') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'ecomolimpo-widgets') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice for minimum PHP version
     */
    public function admin_notice_minimum_php_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requiere PHP versión %2$s o superior.', 'ecomolimpo-widgets'),
            '<strong>' . esc_html__('Ecomolimpo Widgets', 'ecomolimpo-widgets') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Add custom widget category
     */
    public function add_elementor_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'ecomolimpo',
            [
                'title' => esc_html__('Ecomolimpo Widgets', 'ecomolimpo-widgets'),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Register Widgets
     */
    public function register_widgets($widgets_manager) {
        // Get active widgets
        $active_widgets = get_option('ecomolimpo_active_widgets', []);
        
        // If empty, activate all by default
        if (empty($active_widgets)) {
            $active_widgets = ['countdown_timer' => true];
        }

        // Countdown Timer Widget
        if (isset($active_widgets['countdown_timer']) && $active_widgets['countdown_timer']) {
            require_once(__DIR__ . '/widgets/countdown-timer.php');
            $widgets_manager->register(new \Ecomolimpo_Countdown_Timer_Widget());
        }
    }

    /**
     * Widget Styles
     */
    public function widget_styles() {
        wp_register_style(
            'ecomolimpo-widgets',
            plugins_url('assets/css/ecomolimpo-widgets.css', __FILE__),
            [],
            self::VERSION
        );
        wp_enqueue_style('ecomolimpo-widgets');
    }

    /**
     * Widget Scripts
     */
    public function widget_scripts() {
        wp_register_script(
            'ecomolimpo-countdown-timer',
            plugins_url('assets/js/countdown-timer.js', __FILE__),
            ['jquery'],
            self::VERSION,
            true
        );
    }
}

Ecomolimpo_Widgets::instance();
