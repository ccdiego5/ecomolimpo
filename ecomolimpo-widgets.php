<?php
/**
 * Plugin Name: Ecomolimpo Widgets
 * Plugin URI: https://ecomolimpo.com
 * Description: Colección de widgets personalizados para Elementor - Ecomolimpo
 * Version: 1.2.0
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
    const VERSION = '1.2.7';

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
            $active_widgets = [
                'countdown_timer' => true,
                'live_event' => true,
                'video_player' => true,
                'button_animated' => true,
                'ticket_card' => true
            ];
        }

        // Countdown Timer Widget
        if (isset($active_widgets['countdown_timer']) && $active_widgets['countdown_timer']) {
            require_once(__DIR__ . '/widgets/countdown-timer.php');
            $widgets_manager->register(new \Ecomolimpo_Countdown_Timer_Widget());
        }

        // Live Event Widget
        if (isset($active_widgets['live_event']) && $active_widgets['live_event']) {
            require_once(__DIR__ . '/widgets/live-event.php');
            $widgets_manager->register(new \Ecomolimpo_Live_Event_Widget());
        }

        // Video Player Widget
        if (isset($active_widgets['video_player']) && $active_widgets['video_player']) {
            require_once(__DIR__ . '/widgets/video-player.php');
            $widgets_manager->register(new \Ecomolimpo_Video_Player_Widget());
        }

        // Animated Button Widget
        if (isset($active_widgets['button_animated']) && $active_widgets['button_animated']) {
            require_once(__DIR__ . '/widgets/button-animated.php');
            $widgets_manager->register(new \Ecomolimpo_Button_Animated_Widget());
        }

        // Ticket Card Widget
        if (isset($active_widgets['ticket_card']) && $active_widgets['ticket_card']) {
            require_once(__DIR__ . '/widgets/ticket-card.php');
            $widgets_manager->register(new \Ecomolimpo_Ticket_Card_Widget());
        }

        // Social Proof Widget
        if (isset($active_widgets['social_proof']) && $active_widgets['social_proof']) {
            require_once(__DIR__ . '/widgets/social-proof.php');
            $widgets_manager->register(new \Ecomolimpo_Social_Proof_Widget());
        }

        // FAQ Accordion Widget
        if (isset($active_widgets['faq_accordion']) && $active_widgets['faq_accordion']) {
            require_once(__DIR__ . '/widgets/faq-accordion.php');
            $widgets_manager->register(new \Ecomolimpo_FAQ_Accordion_Widget());
        }
    }

    /**
     * Widget Styles
     */
    public function widget_styles() {
        // Variables globales
        wp_enqueue_style(
            'ecomolimpo-variables',
            plugins_url('assets/css/widgets/variables.css', __FILE__),
            [],
            self::VERSION
        );

        // Countdown Timer
        wp_enqueue_style(
            'ecomolimpo-countdown-timer',
            plugins_url('assets/css/widgets/countdown-timer.css', __FILE__),
            [],
            self::VERSION
        );

        // Live Event
        wp_enqueue_style(
            'ecomolimpo-live-event',
            plugins_url('assets/css/widgets/live-event.css', __FILE__),
            [],
            self::VERSION
        );

        // Video Player
        wp_enqueue_style(
            'ecomolimpo-video-player',
            plugins_url('assets/css/widgets/video-player.css', __FILE__),
            [],
            self::VERSION
        );

        // Animated Button
        wp_enqueue_style(
            'ecomolimpo-button-animated',
            plugins_url('assets/css/widgets/button-animated.css', __FILE__),
            [],
            self::VERSION
        );

        // Ticket Card
        wp_enqueue_style(
            'ecomolimpo-ticket-card',
            plugins_url('assets/css/widgets/ticket-card.css', __FILE__),
            [],
            self::VERSION
        );

        // Social Proof
        wp_enqueue_style(
            'ecomolimpo-social-proof',
            plugins_url('assets/css/widgets/social-proof.css', __FILE__),
            [],
            self::VERSION
        );

        // FAQ Accordion
        wp_enqueue_style(
            'ecomolimpo-faq-accordion',
            plugins_url('assets/css/widgets/faq-accordion.css', __FILE__),
            [],
            self::VERSION
        );

        // Utilities (Glass Navbar, etc.)
        wp_enqueue_style(
            'ecomolimpo-utilities',
            plugins_url('assets/css/widgets/utilities.css', __FILE__),
            [],
            self::VERSION
        );
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

        wp_register_script(
            'ecomolimpo-faq-accordion',
            plugins_url('assets/js/faq-accordion.js', __FILE__),
            ['jquery'],
            self::VERSION,
            true
        );
    }
}

Ecomolimpo_Widgets::instance();
