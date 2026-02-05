<?php
/**
 * Admin Panel Class
 * 
 * @package Ecomolimpo_Widgets
 * @author Diego Cárdenas
 * @copyright 2025 Ecomolimpo
 */

if (!defined('ABSPATH')) {
    exit;
}

class Ecomolimpo_Widgets_Admin {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('wp_ajax_ecomolimpo_toggle_widget', [$this, 'ajax_toggle_widget']);
        add_action('wp_ajax_ecomolimpo_clear_cache', [$this, 'ajax_clear_cache']);
    }

    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            'Ecomolimpo Widgets',
            'Ecomolimpo',
            'manage_options',
            'ecomolimpo-widgets',
            [$this, 'render_admin_page'],
            'dashicons-admin-plugins',
            59
        );
    }

    /**
     * Enqueue admin assets
     */
    public function enqueue_admin_assets($hook) {
        if ($hook !== 'toplevel_page_ecomolimpo-widgets') {
            return;
        }

        wp_enqueue_style(
            'ecomolimpo-admin',
            plugins_url('admin/assets/css/admin.css', dirname(__FILE__)),
            [],
            '1.0.3'
        );

        wp_enqueue_script(
            'ecomolimpo-admin',
            plugins_url('admin/assets/js/admin.js', dirname(__FILE__)),
            ['jquery'],
            '1.0.0',
            true
        );

        wp_localize_script('ecomolimpo-admin', 'ecomolimpoAdmin', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ecomolimpo_admin_nonce'),
        ]);
    }

    /**
     * Register settings
     */
    public function register_settings() {
        register_setting('ecomolimpo_widgets_settings', 'ecomolimpo_active_widgets');
        register_setting('ecomolimpo_widgets_settings', 'ecomolimpo_enable_widgets');
        register_setting('ecomolimpo_widgets_settings', 'ecomolimpo_enable_animations');
    }

    /**
     * Render admin page
     */
    public function render_admin_page() {
        $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'dashboard';
        ?>
        <div class="wrap">
            <div class="ecomolimpo-admin-header">
                <h1>
                    <span class="ecomolimpo-logo">E</span>
                    Ecomolimpo Widgets
                </h1>
                <p class="ecomolimpo-subtitle">Kit de herramientas todo-en-uno para WordPress y Elementor</p>
            </div>

            <h2 class="nav-tab-wrapper">
                <a href="?page=ecomolimpo-widgets&tab=dashboard" 
                   class="nav-tab <?php echo $active_tab === 'dashboard' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-dashboard"></span> Dashboard
                </a>
                <a href="?page=ecomolimpo-widgets&tab=widgets" 
                   class="nav-tab <?php echo $active_tab === 'widgets' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-editor-table"></span> Widgets
                </a>
                <a href="?page=ecomolimpo-widgets&tab=configuracion" 
                   class="nav-tab <?php echo $active_tab === 'configuracion' ? 'nav-tab-active' : ''; ?>">
                    <span class="dashicons dashicons-admin-settings"></span> Configuración
                </a>
            </h2>

            <div class="ecomolimpo-admin-content">
                <?php
                switch ($active_tab) {
                    case 'widgets':
                        $this->render_widgets_tab();
                        break;
                    case 'configuracion':
                        $this->render_config_tab();
                        break;
                    default:
                        $this->render_dashboard_tab();
                        break;
                }
                ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render dashboard tab
     */
    private function render_dashboard_tab() {
        $active_widgets = $this->get_active_widgets();
        $total_widgets = count($this->get_available_widgets());
        $active_count = count(array_filter($active_widgets));
        ?>
        <div class="ecomolimpo-dashboard">
            <div class="ecomolimpo-welcome-panel">
                <h2>¡Bienvenido a Ecomolimpo Widgets!</h2>
                <p>Gestiona todos tus widgets personalizados para Elementor desde un solo lugar.</p>
            </div>

            <div class="ecomolimpo-stats-grid">
                <div class="ecomolimpo-stat-card">
                    <div class="stat-icon">
                        <span class="dashicons dashicons-editor-table"></span>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $total_widgets; ?></h3>
                        <p>Widgets Disponibles</p>
                    </div>
                </div>

                <div class="ecomolimpo-stat-card">
                    <div class="stat-icon active">
                        <span class="dashicons dashicons-yes-alt"></span>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $active_count; ?></h3>
                        <p>Widgets Activos</p>
                    </div>
                </div>

                <div class="ecomolimpo-stat-card">
                    <div class="stat-icon version">
                        <span class="dashicons dashicons-admin-plugins"></span>
                    </div>
                    <div class="stat-info">
                        <h3>v1.0.0</h3>
                        <p>Versión Actual</p>
                    </div>
                </div>
            </div>

            <div class="ecomolimpo-info-grid">
                <div class="ecomolimpo-info-card">
                    <h3><span class="dashicons dashicons-info"></span> Información del Sistema</h3>
                    <table class="ecomolimpo-info-table">
                        <tr>
                            <td>WordPress:</td>
                            <td><strong><?php echo get_bloginfo('version'); ?></strong></td>
                        </tr>
                        <tr>
                            <td>Elementor:</td>
                            <td><strong><?php echo defined('ELEMENTOR_VERSION') ? ELEMENTOR_VERSION : 'No instalado'; ?></strong></td>
                        </tr>
                        <tr>
                            <td>PHP:</td>
                            <td><strong><?php echo PHP_VERSION; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Tema Activo:</td>
                            <td><strong><?php echo wp_get_theme()->get('Name'); ?></strong></td>
                        </tr>
                    </table>
                </div>

                <div class="ecomolimpo-info-card">
                    <h3><span class="dashicons dashicons-admin-users"></span> Desarrollador</h3>
                    <div class="developer-info">
                        <p><strong>Diego Cárdenas</strong></p>
                        <p>Email: <a href="mailto:ccdiego.ve@gmail.com">ccdiego.ve@gmail.com</a></p>
                        <p>Web: <a href="https://ecomolimpo.com" target="_blank">ecomolimpo.com</a></p>
                        <p class="copyright">© 2025 Ecomolimpo - Todos los derechos reservados</p>
                    </div>
                </div>
            </div>

            <div class="ecomolimpo-quick-actions">
                <h3>Acciones Rápidas</h3>
                <div class="action-buttons">
                    <a href="?page=ecomolimpo-widgets&tab=widgets" class="button button-primary">
                        <span class="dashicons dashicons-editor-table"></span> Gestionar Widgets
                    </a>
                    <a href="?page=ecomolimpo-widgets&tab=configuracion" class="button button-secondary">
                        <span class="dashicons dashicons-admin-settings"></span> Configuración
                    </a>
                    <a href="<?php echo admin_url('plugins.php?page=ecomolimpo-widgets'); ?>" class="button button-secondary">
                        <span class="dashicons dashicons-book"></span> Documentación
                    </a>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Render widgets tab
     */
    private function render_widgets_tab() {
        $widgets = $this->get_available_widgets();
        $active_widgets = $this->get_active_widgets();
        ?>
        <div class="ecomolimpo-widgets-section">
            <h2>Widgets de Elementor</h2>
            <p class="description">Activa o desactiva widgets según tus necesidades</p>

            <div class="ecomolimpo-widgets-grid">
                <?php foreach ($widgets as $widget_id => $widget) : 
                    $is_active = isset($active_widgets[$widget_id]) && $active_widgets[$widget_id];
                ?>
                <div class="ecomolimpo-widget-card <?php echo $is_active ? 'active' : ''; ?>">
                    <div class="widget-header">
                        <div class="widget-icon">
                            <span class="dashicons <?php echo esc_attr($widget['icon']); ?>"></span>
                        </div>
                        <div class="widget-toggle">
                            <label class="switch">
                                <input type="checkbox" 
                                       class="widget-toggle-checkbox" 
                                       data-widget="<?php echo esc_attr($widget_id); ?>"
                                       <?php checked($is_active); ?>>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="widget-body">
                        <h3><?php echo esc_html($widget['title']); ?></h3>
                        <p><?php echo esc_html($widget['description']); ?></p>
                        <div class="widget-features">
                            <?php foreach ($widget['features'] as $feature) : ?>
                                <span class="feature-tag">
                                    <span class="dashicons dashicons-yes-alt"></span>
                                    <?php echo esc_html($feature); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="widget-footer">
                        <span class="widget-status">
                            <?php echo $is_active ? '<span class="status-badge active">Activo</span>' : '<span class="status-badge inactive">Inactivo</span>'; ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render config tab
     */
    private function render_config_tab() {
        $enable_widgets = get_option('ecomolimpo_enable_widgets', true);
        ?>
        <div class="ecomolimpo-config-section">
            <h2>Configuración General</h2>
            
            <form method="post" action="options.php">
                <?php settings_fields('ecomolimpo_widgets_settings'); ?>
                
                <div class="ecomolimpo-config-card">
                    <h3>Módulo de Widgets</h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label class="switch">
                                    <input type="checkbox" name="ecomolimpo_enable_widgets" value="1" <?php checked($enable_widgets); ?>>
                                    <span class="slider"></span>
                                </label>
                            </th>
                            <td>
                                <p class="description">Activa widgets personalizados para Elementor</p>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button('Guardar Cambios', 'primary', 'submit', false); ?>
                </div>
            </form>

            <div class="ecomolimpo-config-card cache-card">
                <h3><span class="dashicons dashicons-database-view"></span> Optimización y Caché</h3>
                <p>Elimina toda la caché de archivos CSS de Elementor, archivos generales, PHP OPcache, plugins de caché y más</p>
                
                <div class="cache-options">
                    <label>
                        <input type="checkbox" checked disabled>
                        <span class="dashicons dashicons-yes-alt"></span>
                        Caché CSS de Elementor
                    </label>
                    <label>
                        <input type="checkbox" checked disabled>
                        <span class="dashicons dashicons-yes-alt"></span>
                        Archivos generados de Elementor
                    </label>
                    <label>
                        <input type="checkbox" checked disabled>
                        <span class="dashicons dashicons-yes-alt"></span>
                        PHP OPcache
                    </label>
                    <label>
                        <input type="checkbox" checked disabled>
                        <span class="dashicons dashicons-yes-alt"></span>
                        WordPress Transients
                    </label>
                    <label>
                        <input type="checkbox" checked disabled>
                        <span class="dashicons dashicons-yes-alt"></span>
                        Object Cache
                    </label>
                    <label>
                        <input type="checkbox" checked disabled>
                        <span class="dashicons dashicons-yes-alt"></span>
                        Páginas de caché (WP Rocket, W3TC, etc.)
                    </label>
                </div>

                <button type="button" id="clear-cache-btn" class="button button-primary button-large">
                    <span class="dashicons dashicons-update"></span>
                    Limpiar Toda la Caché Ahora
                </button>
            </div>
        </div>
        <?php
    }

    /**
     * Get available widgets
     */
    private function get_available_widgets() {
        return [
            'countdown_timer' => [
                'title' => 'Contador Regresivo',
                'description' => 'Widget de cuenta regresiva con tiempo aleatorio y localStorage',
                'icon' => 'dashicons-clock',
                'features' => [
                    'Dos estilos (Inline/Cajas)',
                    'Formatos HH:MM:SS y MM:SS',
                    'Persistencia localStorage',
                    'Totalmente personalizable',
                    'Responsive'
                ]
            ]
        ];
    }

    /**
     * Get active widgets
     */
    private function get_active_widgets() {
        $active = get_option('ecomolimpo_active_widgets', []);
        
        // Si está vacío, activar todos por defecto
        if (empty($active)) {
            $widgets = $this->get_available_widgets();
            $active = [];
            foreach ($widgets as $widget_id => $widget) {
                $active[$widget_id] = true;
            }
            update_option('ecomolimpo_active_widgets', $active);
        }
        
        return $active;
    }

    /**
     * AJAX: Toggle widget
     */
    public function ajax_toggle_widget() {
        check_ajax_referer('ecomolimpo_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error('No tienes permisos');
        }

        $widget_id = isset($_POST['widget_id']) ? sanitize_text_field($_POST['widget_id']) : '';
        $status = isset($_POST['status']) ? (bool)$_POST['status'] : false;

        $active_widgets = $this->get_active_widgets();
        $active_widgets[$widget_id] = $status;
        
        update_option('ecomolimpo_active_widgets', $active_widgets);

        wp_send_json_success([
            'message' => $status ? 'Widget activado' : 'Widget desactivado'
        ]);
    }

    /**
     * AJAX: Clear cache
     */
    public function ajax_clear_cache() {
        check_ajax_referer('ecomolimpo_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error('No tienes permisos');
        }

        // Clear Elementor cache
        if (class_exists('\Elementor\Plugin')) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }

        // Clear WordPress transients
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%'");

        wp_send_json_success([
            'message' => 'Caché limpiada correctamente'
        ]);
    }
}

new Ecomolimpo_Widgets_Admin();
