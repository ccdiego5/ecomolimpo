<?php
/**
 * Countdown Timer Widget
 * 
 * @package Ecomolimpo_Widgets
 * @author Diego Cárdenas
 * @copyright 2025 Ecomolimpo
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ecomolimpo_Countdown_Timer_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'ecomolimpo_countdown_timer';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Contador Regresivo', 'ecomolimpo-widgets');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-countdown';
    }

    /**
     * Get widget categories
     */
    public function get_categories() {
        return ['ecomolimpo'];
    }

    /**
     * Get widget keywords
     */
    public function get_keywords() {
        return ['countdown', 'timer', 'contador', 'tiempo', 'regresivo', 'ecomolimpo'];
    }

    /**
     * Get script dependencies
     */
    public function get_script_depends() {
        return ['ecomolimpo-countdown-timer'];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {

        // Content Section - Timer Settings
        $this->start_controls_section(
            'section_timer',
            [
                'label' => esc_html__('Configuración del Contador', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'timer_style',
            [
                'label' => esc_html__('Estilo del Contador', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'inline',
                'options' => [
                    'inline' => esc_html__('Inline (Una línea)', 'ecomolimpo-widgets'),
                    'boxes' => esc_html__('Cajas Separadas', 'ecomolimpo-widgets'),
                ],
                'description' => esc_html__('Elige cómo se mostrará el contador', 'ecomolimpo-widgets'),
            ]
        );

        $this->add_control(
            'time_format',
            [
                'label' => esc_html__('Formato de Tiempo', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'mm_ss',
                'options' => [
                    'hh_mm_ss' => esc_html__('HH:MM:SS (Horas:Minutos:Segundos)', 'ecomolimpo-widgets'),
                    'mm_ss' => esc_html__('MM:SS (Minutos:Segundos)', 'ecomolimpo-widgets'),
                ],
            ]
        );

        $this->add_control(
            'timer_min_minutes',
            [
                'label' => esc_html__('Minutos Mínimos', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 20,
                'min' => 1,
                'max' => 1440,
                'step' => 1,
                'description' => esc_html__('Tiempo mínimo en minutos para el contador', 'ecomolimpo-widgets'),
            ]
        );

        $this->add_control(
            'timer_max_minutes',
            [
                'label' => esc_html__('Minutos Máximos', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 30,
                'min' => 1,
                'max' => 1440,
                'step' => 1,
                'description' => esc_html__('Tiempo máximo en minutos para el contador', 'ecomolimpo-widgets'),
            ]
        );

        $this->add_control(
            'timer_prefix_text',
            [
                'label' => esc_html__('Texto Antes del Contador', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('ACCESO PÚBLICO CERRARÁ EN', 'ecomolimpo-widgets'),
                'placeholder' => esc_html__('Ingresa el texto...', 'ecomolimpo-widgets'),
            ]
        );

        $this->add_control(
            'show_labels',
            [
                'label' => esc_html__('Mostrar Etiquetas', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'ecomolimpo-widgets'),
                'label_off' => esc_html__('No', 'ecomolimpo-widgets'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'timer_style' => 'boxes',
                ],
            ]
        );

        $this->add_control(
            'label_hours',
            [
                'label' => esc_html__('Etiqueta Horas', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Horas', 'ecomolimpo-widgets'),
                'condition' => [
                    'show_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_minutes',
            [
                'label' => esc_html__('Etiqueta Minutos', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Minutos', 'ecomolimpo-widgets'),
                'condition' => [
                    'show_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_seconds',
            [
                'label' => esc_html__('Etiqueta Segundos', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Segundos', 'ecomolimpo-widgets'),
                'condition' => [
                    'show_labels' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Prefix Text
        $this->start_controls_section(
            'section_style_prefix',
            [
                'label' => esc_html__('Estilo del Texto', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'prefix_color',
            [
                'label' => esc_html__('Color del Texto', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-prefix' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ecomolimpo-countdown-prefix-inline' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'prefix_typography',
                'selector' => '{{WRAPPER}} .ecomolimpo-countdown-prefix, {{WRAPPER}} .ecomolimpo-countdown-prefix-inline',
            ]
        );

        $this->add_responsive_control(
            'prefix_margin',
            [
                'label' => esc_html__('Margen Inferior', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-prefix' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'prefix_align',
            [
                'label' => esc_html__('Alineación', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Izquierda', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Centro', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Derecha', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-prefix' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Timer Numbers
        $this->start_controls_section(
            'section_style_numbers',
            [
                'label' => esc_html__('Estilo de Números', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'numbers_color',
            [
                'label' => esc_html__('Color de Números', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00FF85',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-number' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ecomolimpo-countdown-time-inline' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ecomolimpo-countdown-separator' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'numbers_typography',
                'selector' => '{{WRAPPER}} .ecomolimpo-countdown-number, {{WRAPPER}} .ecomolimpo-countdown-time-inline, {{WRAPPER}} .ecomolimpo-countdown-separator',
            ]
        );

        $this->add_control(
            'numbers_background',
            [
                'label' => esc_html__('Color de Fondo', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 255, 133, 0.1)',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-item' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'timer_style' => 'boxes',
                ],
            ]
        );

        $this->add_responsive_control(
            'numbers_padding',
            [
                'label' => esc_html__('Espaciado Interno', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 15,
                    'right' => 20,
                    'bottom' => 15,
                    'left' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'timer_style' => 'boxes',
                ],
            ]
        );

        $this->add_responsive_control(
            'numbers_border_radius',
            [
                'label' => esc_html__('Redondeo de Bordes', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'timer_style' => 'boxes',
                ],
            ]
        );

        $this->add_responsive_control(
            'items_gap',
            [
                'label' => esc_html__('Espacio Entre Items', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-timer' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'timer_style' => 'boxes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Labels
        $this->start_controls_section(
            'section_style_labels',
            [
                'label' => esc_html__('Estilo de Etiquetas', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'labels_color',
            [
                'label' => esc_html__('Color de Etiquetas', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#B3B3B3',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'labels_typography',
                'selector' => '{{WRAPPER}} .ecomolimpo-countdown-label',
            ]
        );

        $this->add_responsive_control(
            'labels_margin',
            [
                'label' => esc_html__('Margen Superior', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-label' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Container
        $this->start_controls_section(
            'section_style_container',
            [
                'label' => esc_html__('Estilo del Contenedor', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_align',
            [
                'label' => esc_html__('Alineación', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Izquierda', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Centro', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Derecha', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'container_background',
            [
                'label' => esc_html__('Color de Fondo del Contenedor', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__('Espaciado Interno', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-countdown-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $min_minutes = !empty($settings['timer_min_minutes']) ? absint($settings['timer_min_minutes']) : 20;
        $max_minutes = !empty($settings['timer_max_minutes']) ? absint($settings['timer_max_minutes']) : 30;
        $prefix_text = !empty($settings['timer_prefix_text']) ? esc_html($settings['timer_prefix_text']) : '';
        $show_labels = $settings['show_labels'] === 'yes';
        $timer_style = !empty($settings['timer_style']) ? $settings['timer_style'] : 'inline';
        $time_format = !empty($settings['time_format']) ? $settings['time_format'] : 'mm_ss';
        
        // Ensure min is not greater than max
        if ($min_minutes > $max_minutes) {
            $temp = $min_minutes;
            $min_minutes = $max_minutes;
            $max_minutes = $temp;
        }
        
        $widget_id = 'ecomolimpo-countdown-' . $this->get_id();
        $wrapper_class = 'ecomolimpo-countdown-wrapper ecomolimpo-countdown-style-' . $timer_style;
        ?>
        <div class="<?php echo esc_attr($wrapper_class); ?>">
            <?php if ($timer_style === 'inline') : ?>
                <!-- Estilo Inline (una línea) -->
                <div class="ecomolimpo-countdown-inline" 
                     id="<?php echo esc_attr($widget_id); ?>"
                     data-min-minutes="<?php echo esc_attr($min_minutes); ?>"
                     data-max-minutes="<?php echo esc_attr($max_minutes); ?>"
                     data-time-format="<?php echo esc_attr($time_format); ?>">
                    <?php if (!empty($prefix_text)) : ?>
                        <span class="ecomolimpo-countdown-prefix-inline"><?php echo $prefix_text; ?> </span>
                    <?php endif; ?>
                    <span class="ecomolimpo-countdown-time-inline">
                        <?php if ($time_format === 'hh_mm_ss') : ?>
                            <span data-type="hours">00</span>:<span data-type="minutes">00</span>:<span data-type="seconds">00</span>
                        <?php else : ?>
                            <span data-type="minutes">00</span>:<span data-type="seconds">00</span>
                        <?php endif; ?>
                    </span>
                </div>
            <?php else : ?>
                <!-- Estilo Cajas (boxes) -->
                <?php if (!empty($prefix_text)) : ?>
                    <div class="ecomolimpo-countdown-prefix"><?php echo $prefix_text; ?></div>
                <?php endif; ?>
                
                <div class="ecomolimpo-countdown-timer" 
                     id="<?php echo esc_attr($widget_id); ?>"
                     data-min-minutes="<?php echo esc_attr($min_minutes); ?>"
                     data-max-minutes="<?php echo esc_attr($max_minutes); ?>"
                     data-time-format="<?php echo esc_attr($time_format); ?>">
                    
                    <?php if ($time_format === 'hh_mm_ss') : ?>
                        <div class="ecomolimpo-countdown-item">
                            <span class="ecomolimpo-countdown-number" data-type="hours">00</span>
                            <?php if ($show_labels) : ?>
                                <span class="ecomolimpo-countdown-label"><?php echo esc_html($settings['label_hours']); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="ecomolimpo-countdown-separator">:</div>
                    <?php endif; ?>
                    
                    <div class="ecomolimpo-countdown-item">
                        <span class="ecomolimpo-countdown-number" data-type="minutes">00</span>
                        <?php if ($show_labels) : ?>
                            <span class="ecomolimpo-countdown-label"><?php echo esc_html($settings['label_minutes']); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="ecomolimpo-countdown-separator">:</div>
                    
                    <div class="ecomolimpo-countdown-item">
                        <span class="ecomolimpo-countdown-number" data-type="seconds">00</span>
                        <?php if ($show_labels) : ?>
                            <span class="ecomolimpo-countdown-label"><?php echo esc_html($settings['label_seconds']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <#
        var minMinutes = settings.timer_min_minutes || 20;
        var maxMinutes = settings.timer_max_minutes || 30;
        var prefixText = settings.timer_prefix_text || '';
        var showLabels = settings.show_labels === 'yes';
        var timerStyle = settings.timer_style || 'inline';
        var timeFormat = settings.time_format || 'mm_ss';
        
        if (minMinutes > maxMinutes) {
            var temp = minMinutes;
            minMinutes = maxMinutes;
            maxMinutes = temp;
        }
        
        var wrapperClass = 'ecomolimpo-countdown-wrapper ecomolimpo-countdown-style-' + timerStyle;
        #>
        <div class="{{ wrapperClass }}">
            <# if (timerStyle === 'inline') { #>
                <!-- Estilo Inline (una línea) -->
                <div class="ecomolimpo-countdown-inline">
                    <# if (prefixText) { #>
                        <span class="ecomolimpo-countdown-prefix-inline">{{{ prefixText }}} </span>
                    <# } #>
                    <span class="ecomolimpo-countdown-time-inline">
                        <# if (timeFormat === 'hh_mm_ss') { #>
                            <span>00</span>:<span>00</span>:<span>00</span>
                        <# } else { #>
                            <span>00</span>:<span>00</span>
                        <# } #>
                    </span>
                </div>
            <# } else { #>
                <!-- Estilo Cajas (boxes) -->
                <# if (prefixText) { #>
                    <div class="ecomolimpo-countdown-prefix">{{{ prefixText }}}</div>
                <# } #>
                
                <div class="ecomolimpo-countdown-timer">
                    <# if (timeFormat === 'hh_mm_ss') { #>
                        <div class="ecomolimpo-countdown-item">
                            <span class="ecomolimpo-countdown-number">00</span>
                            <# if (showLabels) { #>
                                <span class="ecomolimpo-countdown-label">{{{ settings.label_hours }}}</span>
                            <# } #>
                        </div>
                        <div class="ecomolimpo-countdown-separator">:</div>
                    <# } #>
                    
                    <div class="ecomolimpo-countdown-item">
                        <span class="ecomolimpo-countdown-number">00</span>
                        <# if (showLabels) { #>
                            <span class="ecomolimpo-countdown-label">{{{ settings.label_minutes }}}</span>
                        <# } #>
                    </div>
                    
                    <div class="ecomolimpo-countdown-separator">:</div>
                    
                    <div class="ecomolimpo-countdown-item">
                        <span class="ecomolimpo-countdown-number">00</span>
                        <# if (showLabels) { #>
                            <span class="ecomolimpo-countdown-label">{{{ settings.label_seconds }}}</span>
                        <# } #>
                    </div>
                </div>
            <# } #>
        </div>
        <?php
    }
}
