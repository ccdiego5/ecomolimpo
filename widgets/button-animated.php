<?php
/**
 * Animated Button Widget
 * 
 * @package Ecomolimpo_Widgets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ecomolimpo_Button_Animated_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'ecomolimpo_button_animated';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return __('Botón Animado', 'ecomolimpo-widgets');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-button';
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
        return ['button', 'botón', 'animated', 'animado', 'cta', 'link'];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        
        // ========== CONTENIDO ==========
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Contenido', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Texto del Botón', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('CLAIM YOUR FREE SPOT', 'ecomolimpo-widgets'),
                'placeholder' => __('Escribe el texto del botón', 'ecomolimpo-widgets'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'subtitle_text',
            [
                'label' => __('Subtítulo', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Sunday December 28th @6PM CET', 'ecomolimpo-widgets'),
                'placeholder' => __('Texto secundario (opcional)', 'ecomolimpo-widgets'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Enlace', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://tu-enlace.com', 'ecomolimpo-widgets'),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => __('Alineación', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Izquierda', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Centro', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Derecha', 'ecomolimpo-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-animated-button-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS DEL BOTÓN ==========
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => __('Estilos del Botón', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'label' => __('Fondo', 'ecomolimpo-widgets'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ecomolimpo-animated-button',
                'fields_options' => [
                    'background' => [
                        'default' => 'gradient',
                    ],
                    'color' => [
                        'default' => '#00D9FF',
                    ],
                    'gradient_type' => [
                        'default' => 'linear',
                    ],
                    'gradient_angle' => [
                        'default' => [
                            'unit' => 'deg',
                            'size' => 180,
                        ],
                    ],
                    'color_b' => [
                        'default' => '#00A3CC',
                    ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Tipografía del Texto', 'ecomolimpo-widgets'),
                'selector' => '{{WRAPPER}} .ecomolimpo-button-text',
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Color del Texto', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 20,
                    'right' => 40,
                    'bottom' => 20,
                    'left' => 40,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-animated-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __('Radio del Borde', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-animated-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS DEL SUBTÍTULO ==========
        $this->start_controls_section(
            'subtitle_style_section',
            [
                'label' => __('Estilos del Subtítulo', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => __('Tipografía del Subtítulo', 'ecomolimpo-widgets'),
                'selector' => '{{WRAPPER}} .ecomolimpo-button-subtitle',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Color del Subtítulo', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-button-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => __('Margen Superior', 'ecomolimpo-widgets'),
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
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-button-subtitle' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ANIMACIÓN DEL BORDE ==========
        $this->start_controls_section(
            'border_animation_section',
            [
                'label' => __('Animación del Borde', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => __('Grosor del Borde', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-animated-button' => 'outline-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_offset',
            [
                'label' => __('Separación del Borde', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-animated-button' => 'outline-offset: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __('Color del Borde', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-animated-button' => '--border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __('Velocidad de Animación (ms)', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 2000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'size' => 500,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-animated-button' => 'animation-duration: {{SIZE}}ms;',
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
        
        $this->add_render_attribute('wrapper', 'class', 'ecomolimpo-animated-button-wrapper');
        
        $this->add_render_attribute('button', 'class', 'ecomolimpo-animated-button');
        
        if (!empty($settings['link']['url'])) {
            $this->add_link_attributes('button', $settings['link']);
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <a <?php echo $this->get_render_attribute_string('button'); ?>>
                <span class="ecomolimpo-button-text"><?php echo esc_html($settings['button_text']); ?></span>
                <?php if (!empty($settings['subtitle_text'])) : ?>
                    <span class="ecomolimpo-button-subtitle"><?php echo esc_html($settings['subtitle_text']); ?></span>
                <?php endif; ?>
            </a>
        </div>
        <?php
    }

    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <#
        view.addRenderAttribute('wrapper', 'class', 'ecomolimpo-animated-button-wrapper');
        view.addRenderAttribute('button', 'class', 'ecomolimpo-animated-button');
        
        if (settings.link.url) {
            view.addRenderAttribute('button', 'href', settings.link.url);
        }
        #>
        <div {{{ view.getRenderAttributeString('wrapper') }}}>
            <a {{{ view.getRenderAttributeString('button') }}}>
                <span class="ecomolimpo-button-text">{{{ settings.button_text }}}</span>
                <# if (settings.subtitle_text) { #>
                    <span class="ecomolimpo-button-subtitle">{{{ settings.subtitle_text }}}</span>
                <# } #>
            </a>
        </div>
        <?php
    }
}
