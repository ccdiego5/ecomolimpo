<?php
/**
 * Ticket Card Widget
 * 
 * @package Ecomolimpo_Widgets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ecomolimpo_Ticket_Card_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'ecomolimpo_ticket_card';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return __('Tarjeta Ticket', 'ecomolimpo-widgets');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-image-box';
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
        return ['ticket', 'card', 'tarjeta', 'boleto', 'image'];
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
            'card_number',
            [
                'label' => __('Número', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '#1',
                'placeholder' => __('#1', 'ecomolimpo-widgets'),
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => __('Imagen de Fondo', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Título', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Learn The Truth', 'ecomolimpo-widgets'),
                'placeholder' => __('Escribe el título', 'ecomolimpo-widgets'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Descripción', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Exposing the truth behind how beginner entrepreneurs struggling rich with AI built Ecom brands in record breaking time.', 'ecomolimpo-widgets'),
                'placeholder' => __('Escribe la descripción', 'ecomolimpo-widgets'),
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
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS DE LA TARJETA ==========
        $this->start_controls_section(
            'card_style_section',
            [
                'label' => __('Estilos de la Tarjeta', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'card_height',
            [
                'label' => __('Altura de la Tarjeta', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 800,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 500,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-ticket-card' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => __('Color de Overlay', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.4)',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-ticket-overlay' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __('Color del Borde', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-ticket-card' => '--border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS DEL NÚMERO ==========
        $this->start_controls_section(
            'number_style_section',
            [
                'label' => __('Estilos del Número', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .ticket-number',
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => __('Color', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .ticket-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS DEL TÍTULO ==========
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => __('Estilos del Título', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .ticket-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .ticket-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS DE LA DESCRIPCIÓN ==========
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => __('Estilos de la Descripción', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .ticket-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .ticket-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ANIMACIÓN ==========
        $this->start_controls_section(
            'animation_section',
            [
                'label' => __('Animación', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'enable_animation',
            [
                'label' => __('Activar Animación', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sí', 'ecomolimpo-widgets'),
                'label_off' => __('No', 'ecomolimpo-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $animation_class = $settings['enable_animation'] === 'yes' ? 'ticket-animated' : '';
        
        $this->add_render_attribute('wrapper', 'class', 'ecomolimpo-ticket-wrapper');
        
        $this->add_render_attribute('card', 'class', ['ecomolimpo-ticket-card', $animation_class]);
        
        if (!empty($settings['background_image']['url'])) {
            $this->add_render_attribute('card', 'style', 'background-image: url(' . esc_url($settings['background_image']['url']) . ');');
        }
        
        $link_tag = 'div';
        $link_attrs = [];
        
        if (!empty($settings['link']['url'])) {
            $link_tag = 'a';
            $this->add_link_attributes('link', $settings['link']);
            $link_attrs = $this->get_render_attribute_string('link');
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <<?php echo $link_tag; ?> <?php echo $link_attrs; ?>>
                <div <?php echo $this->get_render_attribute_string('card'); ?>>
                    <div class="ecomolimpo-ticket-overlay"></div>
                    <div class="ticket-content">
                        <div class="ticket-header">
                            <?php if (!empty($settings['card_number'])) : ?>
                                <span class="ticket-number"><?php echo esc_html($settings['card_number']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="ticket-body">
                            <?php if (!empty($settings['title'])) : ?>
                                <h3 class="ticket-title"><?php echo esc_html($settings['title']); ?></h3>
                            <?php endif; ?>
                        </div>
                        <div class="ticket-footer">
                            <?php if (!empty($settings['description'])) : ?>
                                <p class="ticket-description"><?php echo esc_html($settings['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ticket-stars">
                        <span class="star star-1">+</span>
                        <span class="star star-2">+</span>
                    </div>
                </div>
            </<?php echo $link_tag; ?>>
        </div>
        <?php
    }

    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <#
        var animationClass = settings.enable_animation === 'yes' ? 'ticket-animated' : '';
        var linkTag = settings.link.url ? 'a' : 'div';
        var bgImage = settings.background_image.url ? 'background-image: url(' + settings.background_image.url + ');' : '';
        #>
        <div class="ecomolimpo-ticket-wrapper">
            <{{{ linkTag }}} href="{{ settings.link.url }}">
                <div class="ecomolimpo-ticket-card {{ animationClass }}" style="{{ bgImage }}">
                    <div class="ecomolimpo-ticket-overlay"></div>
                    <div class="ticket-content">
                        <div class="ticket-header">
                            <# if (settings.card_number) { #>
                                <span class="ticket-number">{{{ settings.card_number }}}</span>
                            <# } #>
                        </div>
                        <div class="ticket-body">
                            <# if (settings.title) { #>
                                <h3 class="ticket-title">{{{ settings.title }}}</h3>
                            <# } #>
                        </div>
                        <div class="ticket-footer">
                            <# if (settings.description) { #>
                                <p class="ticket-description">{{{ settings.description }}}</p>
                            <# } #>
                        </div>
                    </div>
                    <div class="ticket-stars">
                        <span class="star star-1">+</span>
                        <span class="star star-2">+</span>
                    </div>
                </div>
            </{{{ linkTag }}}>
        </div>
        <?php
    }
}
