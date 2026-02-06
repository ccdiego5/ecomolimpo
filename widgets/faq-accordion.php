<?php
/**
 * FAQ Accordion Widget
 * 
 * @package Ecomolimpo_Widgets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ecomolimpo_FAQ_Accordion_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ecomolimpo_faq_accordion';
    }

    public function get_title() {
        return __('FAQ Accordion Pro', 'ecomolimpo-widgets');
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return ['ecomolimpo'];
    }

    public function get_script_depends() {
        return ['ecomolimpo-faq-accordion'];
    }

    public function get_style_depends() {
        return ['ecomolimpo-faq-accordion'];
    }

    protected function register_controls() {

        // ========== CONTENIDO ==========
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Preguntas Frecuentes', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question',
            [
                'label' => __('Pregunta', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('¿Pregunta frecuente?', 'ecomolimpo-widgets'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'answer',
            [
                'label' => __('Respuesta', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Respuesta detallada a la pregunta frecuente.', 'ecomolimpo-widgets'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'faq_list',
            [
                'label' => __('Lista de FAQs', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'question' => __('Will What Is Taught Be Applicable To People With No Experience?', 'ecomolimpo-widgets'),
                        'answer' => __('Absolutely. This free event is DESIGNED to help people with no experience in Ecom build a succesful brand in hours with AI.', 'ecomolimpo-widgets'),
                    ],
                    [
                        'question' => __('Will The Event Be Valuable To Me Even Though I Am Busy with School, Work and other things?', 'ecomolimpo-widgets'),
                        'answer' => __('Yes, definitely. The strategies we share are designed to save time.', 'ecomolimpo-widgets'),
                    ],
                ],
                'title_field' => '{{{ question }}}',
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS CAJA ==========
        $this->start_controls_section(
            'style_box_section',
            [
                'label' => __('Caja FAQ', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_background',
            [
                'label' => __('Color de Fondo', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#050505',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-faq-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'box_border_color',
            [
                'label' => __('Color del Borde', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-faq-item' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => __('Radio del Borde', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 16,
                    'right' => 16,
                    'bottom' => 16,
                    'left' => 16,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-faq-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_margin',
            [
                'label' => __('Espacio entre Items', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-faq-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label' => __('Relleno Interno', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 20,
                    'right' => 25,
                    'bottom' => 20,
                    'left' => 25,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-faq-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ecomolimpo-faq-content-inner' => 'padding: 0 {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS TEXTO ==========
        $this->start_controls_section(
            'style_text_section',
            [
                'label' => __('Texto', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'question_heading',
            [
                'label' => __('Pregunta', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'question_typography',
                'selector' => '{{WRAPPER}} .ecomolimpo-faq-question',
            ]
        );

        $this->add_control(
            'question_color',
            [
                'label' => __('Color Pregunta', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-faq-question' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'answer_heading',
            [
                'label' => __('Respuesta', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'answer_typography',
                'selector' => '{{WRAPPER}} .ecomolimpo-faq-content',
            ]
        );

        $this->add_control(
            'answer_color',
            [
                'label' => __('Color Respuesta', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#CCCCCC',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-faq-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS ICONO ==========
        $this->start_controls_section(
            'style_icon_section',
            [
                'label' => __('Icono', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Color', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-faq-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Tamaño', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-faq-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="ecomolimpo-faq-wrapper">
            <?php foreach ($settings['faq_list'] as $index => $item) : 
                $item_key = $this->get_render_attribute_string('faq_list.' . $index);
            ?>
                <div class="ecomolimpo-faq-item">
                    <div class="ecomolimpo-faq-header" role="button" tabindex="0">
                        <span class="ecomolimpo-faq-question"><?php echo esc_html($item['question']); ?></span>
                        <span class="ecomolimpo-faq-icon">
                            <i class="eicon-plus" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="ecomolimpo-faq-content">
                        <div class="ecomolimpo-faq-content-inner">
                            <?php echo wp_kses_post($item['answer']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <div class="ecomolimpo-faq-wrapper">
            <# _.each(settings.faq_list, function(item) { #>
                <div class="ecomolimpo-faq-item">
                    <div class="ecomolimpo-faq-header">
                        <span class="ecomolimpo-faq-question">{{{ item.question }}}</span>
                        <span class="ecomolimpo-faq-icon">
                            <i class="eicon-plus" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="ecomolimpo-faq-content">
                        <div class="ecomolimpo-faq-content-inner">
                            {{{ item.answer }}}
                        </div>
                    </div>
                </div>
            <# }); #>
        </div>
        <?php
    }
}
