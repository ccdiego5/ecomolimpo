<?php
/**
 * Live Event Banner Widget
 * 
 * @package Ecomolimpo_Widgets
 * @author Diego Cárdenas
 * @copyright 2025 Ecomolimpo
 */

if (!defined('ABSPATH')) {
    exit;
}

class Ecomolimpo_Live_Event_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ecomolimpo_live_event';
    }

    public function get_title() {
        return esc_html__('Live Event Banner', 'ecomolimpo-widgets');
    }

    public function get_icon() {
        return 'eicon-live';
    }

    public function get_categories() {
        return ['ecomolimpo'];
    }

    public function get_keywords() {
        return ['live', 'event', 'banner', 'webinar', 'ecomolimpo'];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Contenido', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_dot',
            [
                'label' => esc_html__('Mostrar Punto Rojo', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'ecomolimpo-widgets'),
                'label_off' => esc_html__('No', 'ecomolimpo-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'live_text',
            [
                'label' => esc_html__('Texto "LIVE EVENT"', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'LIVE EVENT:',
                'placeholder' => 'LIVE EVENT:',
            ]
        );

        $this->add_control(
            'event_text',
            [
                'label' => esc_html__('Texto del Evento', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'SUNDAY DECEMBER 28TH @ 6PM CET/ 12PM EST',
                'placeholder' => 'Ingresa los detalles del evento...',
                'rows' => 2,
            ]
        );

        $this->end_controls_section();

        // Style Section - Container
        $this->start_controls_section(
            'section_style_container',
            [
                'label' => esc_html__('Contenedor', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'container_background',
            [
                'label' => esc_html__('Color de Fondo', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-live-event' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_padding',
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
                    '{{WRAPPER}} .ecomolimpo-live-event' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_align',
            [
                'label' => esc_html__('Alineación', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Izquierda', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Centro', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Derecha', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-live-event' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .ecomolimpo-live-event',
            ]
        );

        $this->add_responsive_control(
            'container_border_radius',
            [
                'label' => esc_html__('Redondeo de Bordes', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-live-event' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Dot
        $this->start_controls_section(
            'section_style_dot',
            [
                'label' => esc_html__('Punto Rojo', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_dot' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dot_color',
            [
                'label' => esc_html__('Color del Punto', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FF0000',
                'selectors' => [
                    '{{WRAPPER}} .live-dot' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_size',
            [
                'label' => esc_html__('Tamaño del Punto', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 30,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .live-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dot_animation',
            [
                'label' => esc_html__('Animación', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sí', 'ecomolimpo-widgets'),
                'label_off' => esc_html__('No', 'ecomolimpo-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Style Section - Live Text
        $this->start_controls_section(
            'section_style_live_text',
            [
                'label' => esc_html__('Texto "LIVE EVENT"', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'live_text_color',
            [
                'label' => esc_html__('Color del Texto', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .live-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'live_text_typography',
                'selector' => '{{WRAPPER}} .live-text',
            ]
        );

        $this->add_responsive_control(
            'live_text_margin',
            [
                'label' => esc_html__('Margen', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .live-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Event Text
        $this->start_controls_section(
            'section_style_event_text',
            [
                'label' => esc_html__('Texto del Evento', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'event_text_color',
            [
                'label' => esc_html__('Color del Texto', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .event-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'event_text_typography',
                'selector' => '{{WRAPPER}} .event-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $show_dot = $settings['show_dot'] === 'yes';
        $live_text = !empty($settings['live_text']) ? esc_html($settings['live_text']) : 'LIVE EVENT:';
        $event_text = !empty($settings['event_text']) ? esc_html($settings['event_text']) : '';
        $dot_animation = $settings['dot_animation'] === 'yes';
        
        $dot_class = $dot_animation ? 'live-dot animate' : 'live-dot';
        ?>
        <div class="ecomolimpo-live-event">
            <?php if ($show_dot) : ?>
                <span class="<?php echo esc_attr($dot_class); ?>"></span>
            <?php endif; ?>
            <span class="live-text"><?php echo $live_text; ?></span>
            <?php if (!empty($event_text)) : ?>
                <span class="event-text"><?php echo $event_text; ?></span>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        var showDot = settings.show_dot === 'yes';
        var liveText = settings.live_text || 'LIVE EVENT:';
        var eventText = settings.event_text || '';
        var dotAnimation = settings.dot_animation === 'yes';
        var dotClass = dotAnimation ? 'live-dot animate' : 'live-dot';
        #>
        <div class="ecomolimpo-live-event">
            <# if (showDot) { #>
                <span class="{{{ dotClass }}}"></span>
            <# } #>
            <span class="live-text">{{{ liveText }}}</span>
            <# if (eventText) { #>
                <span class="event-text">{{{ eventText }}}</span>
            <# } #>
        </div>
        <?php
    }
}
