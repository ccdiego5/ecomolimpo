<?php
/**
 * Social Proof Widget
 * 
 * @package Ecomolimpo_Widgets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ecomolimpo_Social_Proof_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ecomolimpo_social_proof';
    }

    public function get_title() {
        return __('Social Proof', 'ecomolimpo-widgets');
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
    }

    public function get_categories() {
        return ['ecomolimpo'];
    }

    protected function register_controls() {

        // ========== CONTENIDO ==========
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Contenido', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'avatar_image',
            [
                'label' => __('Imagen', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'avatars',
            [
                'label' => __('Avatares', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'avatar_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'avatar_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'avatar_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                ],
                'title_field' => 'Avatar {{{ 1 + 1 }}}',
            ]
        );

        $this->add_control(
            'pre_text',
            [
                'label' => __('Texto Previo', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Join Over', 'ecomolimpo-widgets'),
                'placeholder' => __('Join Over', 'ecomolimpo-widgets'),
            ]
        );

        $this->add_control(
            'highlight_text',
            [
                'label' => __('Texto Destacado (Número)', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('2,428+', 'ecomolimpo-widgets'),
                'placeholder' => __('2,428+', 'ecomolimpo-widgets'),
            ]
        );

        $this->add_control(
            'post_text',
            [
                'label' => __('Texto Posterior', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('People Worldwide', 'ecomolimpo-widgets'),
                'placeholder' => __('People Worldwide', 'ecomolimpo-widgets'),
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS AVATARES ==========
        $this->start_controls_section(
            'style_avatars_section',
            [
                'label' => __('Estilo Avatares', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'avatar_size',
            [
                'label' => __('Tamaño', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-social-avatar img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'avatar_overlap',
            [
                'label' => __('Superposición', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 0,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => -15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-social-avatar:not(:first-child)' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'avatar_border_color',
            [
                'label' => __('Color del Borde', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-social-avatar img' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'avatar_border_width',
            [
                'label' => __('Ancho del Borde', 'ecomolimpo-widgets'),
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
                    '{{WRAPPER}} .ecomolimpo-social-avatar img' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS TEXTO ==========
        $this->start_controls_section(
            'style_text_section',
            [
                'label' => __('Estilo Texto', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __('Tipografía General', 'ecomolimpo-widgets'),
                'selector' => '{{WRAPPER}} .ecomolimpo-social-text',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Color Texto General', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-social-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'highlight_color',
            [
                'label' => __('Color Destacado', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00D9FF',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-social-highlight' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_margin_left',
            [
                'label' => __('Separación Texto', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-social-text' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="ecomolimpo-social-proof-wrapper">
            <div class="ecomolimpo-social-avatars">
                <?php foreach ($settings['avatars'] as $item) : ?>
                    <div class="ecomolimpo-social-avatar">
                        <?php if (!empty($item['avatar_image']['url'])) : ?>
                            <img src="<?php echo esc_url($item['avatar_image']['url']); ?>" alt="Avatar">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="ecomolimpo-social-text">
                <span class="ecomolimpo-social-pre"><?php echo esc_html($settings['pre_text']); ?></span>
                <span class="ecomolimpo-social-highlight"><?php echo esc_html($settings['highlight_text']); ?></span>
                <span class="ecomolimpo-social-post"><?php echo esc_html($settings['post_text']); ?></span>
            </div>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <div class="ecomolimpo-social-proof-wrapper">
            <div class="ecomolimpo-social-avatars">
                <# _.each(settings.avatars, function(item) { #>
                    <div class="ecomolimpo-social-avatar">
                        <# if (item.avatar_image.url) { #>
                            <img src="{{ item.avatar_image.url }}" alt="Avatar">
                        <# } #>
                    </div>
                <# }); #>
            </div>
            <div class="ecomolimpo-social-text">
                <span class="ecomolimpo-social-pre">{{{ settings.pre_text }}}</span>
                <span class="ecomolimpo-social-highlight">{{{ settings.highlight_text }}}</span>
                <span class="ecomolimpo-social-post">{{{ settings.post_text }}}</span>
            </div>
        </div>
        <?php
    }
}
