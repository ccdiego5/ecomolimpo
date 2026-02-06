<?php
/**
 * Ticket Cards Grid Widget
 * 
 * @package Ecomolimpo_Widgets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ecomolimpo_Ticket_Card_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'ecomolimpo_ticket_card'; }
    public function get_title() { return __('Tarjetas Ticket Pro', 'ecomolimpo-widgets'); }
    public function get_icon() { return 'eicon-gallery-grid'; }
    public function get_categories() { return ['ecomolimpo']; }

    protected function register_controls() {
        // ========== TARJETAS ==========
        $this->start_controls_section(
            'cards_section',
            ['label' => __('Tarjetas', 'ecomolimpo-widgets'), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_number',
            ['label' => __('Número', 'ecomolimpo-widgets'), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '#1']
        );

        $repeater->add_control(
            'background_image',
            ['label' => __('Imagen de Fondo', 'ecomolimpo-widgets'), 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]
        );

        $repeater->add_control(
            'title',
            ['label' => __('Título', 'ecomolimpo-widgets'), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => __('Learn The Truth', 'ecomolimpo-widgets')]
        );

        $repeater->add_control(
            'description',
            ['label' => __('Descripción', 'ecomolimpo-widgets'), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => __('Exposing the truth behind how beginner entrepreneurs are getting rich...', 'ecomolimpo-widgets')]
        );

        $repeater->add_control(
            'link',
            ['label' => __('Enlace', 'ecomolimpo-widgets'), 'type' => \Elementor\Controls_Manager::URL, 'placeholder' => 'https://...', 'default' => ['url' => '#']]
        );

        $this->add_control(
            'cards_list',
            [
                'label' => __('Lista de Tarjetas', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['card_number' => '#1', 'title' => 'Learn The Truth', 'description' => 'Exposing the truth behind how beginner entrepreneurs are getting rich...'],
                    ['card_number' => '#2', 'title' => 'Work Remotely', 'description' => 'Learn how to work remotely without needing a useless degree...'],
                    ['card_number' => '#3', 'title' => 'Leave That Hometown', 'description' => 'Finally create the life you deserve and live it on your own terms.'],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // ========== LAYOUT ==========
        $this->start_controls_section(
            'layout_section',
            ['label' => __('Layout', 'ecomolimpo-widgets'), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __('Columnas', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'],
                'selectors' => ['{{WRAPPER}} .ecomolimpo-tickets-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);'],
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => __('Espacio', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => ['px' => ['max' => 100]],
                'default' => ['size' => 30],
                'selectors' => ['{{WRAPPER}} .ecomolimpo-tickets-grid' => 'gap: {{SIZE}}px;'],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="ecomolimpo-tickets-wrapper">
            <div class="ecomolimpo-tickets-grid">
                <?php foreach ($settings['cards_list'] as $index => $card) : 
                    $bg_style = !empty($card['background_image']['url']) ? 'background-image: url(' . esc_url($card['background_image']['url']) . ');' : '';
                    // Eliminamos el delay para que todas giren igual
                ?>
                    <div class="ticket-card-container">
                        <div class="ticket-shape" style="<?php echo $bg_style; ?>">
                            <div class="ticket-overlay"></div>
                            
                            <!-- Borde Interno SVG (Exacto) -->
                            <svg class="ticket-border-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 703 1176" preserveAspectRatio="none">
                                <path fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="4" vector-effect="non-scaling-stroke" d="M564 12.5C564 5.596 558.404 0 551.5 0S539 5.596 539 12.5v1c0 6.904-5.596 12.5-12.5 12.5S514 20.404 514 13.5v-1C514 5.596 508.404 0 501.5 0S489 5.596 489 12.5v1c0 6.904-5.596 12.5-12.5 12.5S464 20.404 464 13.5v-1C464 5.596 458.404 0 451.5 0S439 5.596 439 12.5v1c0 6.904-5.596 12.5-12.5 12.5S414 20.404 414 13.5v-1C414 5.596 408.404 0 401.5 0S389 5.596 389 12.5v1c0 6.904-5.596 12.5-12.5 12.5S364 20.404 364 13.5v-1C364 5.596 358.404 0 351.5 0S339 5.596 339 12.5v1c0 6.904-5.596 12.5-12.5 12.5S314 20.404 314 13.5v-1C314 5.596 308.404 0 301.5 0S289 5.596 289 12.5v1c0 6.904-5.596 12.5-12.5 12.5S264 20.404 264 13.5v-1C264 5.596 258.404 0 251.5 0S239 5.596 239 12.5v1c0 6.904-5.596 12.5-12.5 12.5S214 20.404 214 13.5v-1C214 5.596 208.404 0 201.5 0S189 5.596 189 12.5v1c0 6.904-5.596 12.5-12.5 12.5S164 20.404 164 13.5v-1C164 5.596 158.404 0 151.5 0S139 5.596 139 12.5v1c0 6.904-5.596 12.5-12.5 12.5S114 20.404 114 13.5v-1.432C114 5.403 108.597 0 101.932 0c-6.614 0-11.91 5.353-12.85 11.9-5.931 41.33-39.944 73.59-82.084 76.832C3.143 89.028 0 92.134 0 96v984c0 3.87 3.143 6.97 6.998 7.27 42.14 3.24 76.153 35.5 82.084 76.83.94 6.55 6.236 11.9 12.85 11.9 6.665 0 12.068-5.4 12.068-12.07v-1.43c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1.43c0 6.67 5.403 12.07 12.068 12.07 6.614 0 11.91-5.35 12.85-11.9 5.931-41.33 39.944-73.59 82.084-76.83 3.855-.3 6.998-3.4 6.998-7.27V96c0-3.866-3.143-6.972-6.998-7.268-42.14-3.24-76.153-35.503-82.084-76.832-.94-6.547-6.236-11.9-12.85-11.9C594.403 0 589 5.403 589 12.068V13.5c0 6.904-5.596 12.5-12.5 12.5S564 20.404 564 13.5v-1ZM26 848a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm26 0a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z" />
                            </svg>
                            
                            <!-- Línea de Puntos -->
                            <div class="ticket-dotted-line"></div>

                            <!-- Contenido -->
                            <div class="ticket-content-wrapper">
                                <div class="ticket-top-section">
                                    <?php if (!empty($card['card_number'])) : ?>
                                        <div class="ticket-badge">
                                            <span><?php echo esc_html($card['card_number']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($card['title'])) : ?>
                                        <h3 class="ticket-title"><?php echo wp_kses_post($card['title']); ?></h3>
                                    <?php endif; ?>
                                </div>

                                <div class="ticket-bottom-section">
                                    <?php if (!empty($card['description'])) : ?>
                                        <p class="ticket-desc"><?php echo esc_html($card['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Decoraciones -->
                            <div class="ticket-sparkles">
                                <span class="sparkle s1">✦</span>
                                <span class="sparkle s2">✦</span>
                            </div>
                        </div>
                        
                        <?php if (!empty($card['link']['url'])) : ?>
                            <a href="<?php echo esc_url($card['link']['url']); ?>" class="ticket-full-link"></a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <div class="ecomolimpo-tickets-wrapper">
            <div class="ecomolimpo-tickets-grid">
                <# _.each(settings.cards_list, function(card, index) { 
                    var bgImage = card.background_image.url ? 'background-image: url(' + card.background_image.url + ');' : '';
                #>
                    <div class="ticket-card-container">
                        <div class="ticket-shape" style="{{ bgImage }}">
                            <div class="ticket-overlay"></div>
                            <!-- Borde Interno SVG (Exacto) -->
                            <svg class="ticket-border-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 703 1176" preserveAspectRatio="none">
                                <path fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="4" vector-effect="non-scaling-stroke" d="M564 12.5C564 5.596 558.404 0 551.5 0S539 5.596 539 12.5v1c0 6.904-5.596 12.5-12.5 12.5S514 20.404 514 13.5v-1C514 5.596 508.404 0 501.5 0S489 5.596 489 12.5v1c0 6.904-5.596 12.5-12.5 12.5S464 20.404 464 13.5v-1C464 5.596 458.404 0 451.5 0S439 5.596 439 12.5v1c0 6.904-5.596 12.5-12.5 12.5S414 20.404 414 13.5v-1C414 5.596 408.404 0 401.5 0S389 5.596 389 12.5v1c0 6.904-5.596 12.5-12.5 12.5S364 20.404 364 13.5v-1C364 5.596 358.404 0 351.5 0S339 5.596 339 12.5v1c0 6.904-5.596 12.5-12.5 12.5S314 20.404 314 13.5v-1C314 5.596 308.404 0 301.5 0S289 5.596 289 12.5v1c0 6.904-5.596 12.5-12.5 12.5S264 20.404 264 13.5v-1C264 5.596 258.404 0 251.5 0S239 5.596 239 12.5v1c0 6.904-5.596 12.5-12.5 12.5S214 20.404 214 13.5v-1C214 5.596 208.404 0 201.5 0S189 5.596 189 12.5v1c0 6.904-5.596 12.5-12.5 12.5S164 20.404 164 13.5v-1C164 5.596 158.404 0 151.5 0S139 5.596 139 12.5v1c0 6.904-5.596 12.5-12.5 12.5S114 20.404 114 13.5v-1.432C114 5.403 108.597 0 101.932 0c-6.614 0-11.91 5.353-12.85 11.9-5.931 41.33-39.944 73.59-82.084 76.832C3.143 89.028 0 92.134 0 96v984c0 3.87 3.143 6.97 6.998 7.27 42.14 3.24 76.153 35.5 82.084 76.83.94 6.55 6.236 11.9 12.85 11.9 6.665 0 12.068-5.4 12.068-12.07v-1.43c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1c0 6.9 5.596 12.5 12.5 12.5s12.5-5.6 12.5-12.5v-1c0-6.9 5.596-12.5 12.5-12.5s12.5 5.6 12.5 12.5v1.43c0 6.67 5.403 12.07 12.068 12.07 6.614 0 11.91-5.35 12.85-11.9 5.931-41.33 39.944-73.59 82.084-76.83 3.855-.3 6.998-3.4 6.998-7.27V96c0-3.866-3.143-6.972-6.998-7.268-42.14-3.24-76.153-35.503-82.084-76.832-.94-6.547-6.236-11.9-12.85-11.9C594.403 0 589 5.403 589 12.068V13.5c0 6.904-5.596 12.5-12.5 12.5S564 20.404 564 13.5v-1ZM26 848a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm26 0a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm34-8a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm18 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z" />
                            </svg>
                            <div class="ticket-dotted-line"></div>

                            <div class="ticket-content-wrapper">
                                <div class="ticket-top-section">
                                    <# if (card.card_number) { #>
                                        <div class="ticket-badge"><span>{{{ card.card_number }}}</span></div>
                                    <# } #>
                                    <# if (card.title) { #>
                                        <h3 class="ticket-title">{{{ card.title }}}</h3>
                                    <# } #>
                                </div>

                                <div class="ticket-bottom-section">
                                    <# if (card.description) { #>
                                        <p class="ticket-desc">{{{ card.description }}}</p>
                                    <# } #>
                                </div>
                            </div>
                            
                            <div class="ticket-sparkles">
                                <span class="sparkle s1">✦</span>
                                <span class="sparkle s2">✦</span>
                            </div>
                        </div>
                    </div>
                <# }); #>
            </div>
        </div>
        <?php
    }
}
