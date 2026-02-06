<?php
/**
 * Video Player Widget with Plyr
 * 
 * @package Ecomolimpo_Widgets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ecomolimpo_Video_Player_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'ecomolimpo_video_player';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return __('Video Player Avanzado', 'ecomolimpo-widgets');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-youtube';
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
        return ['video', 'player', 'plyr', 'youtube', 'vimeo', 'mp4'];
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
            'video_type',
            [
                'label' => __('Tipo de Video', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'youtube',
                'options' => [
                    'youtube' => __('YouTube', 'ecomolimpo-widgets'),
                    'vimeo' => __('Vimeo', 'ecomolimpo-widgets'),
                    'hosted' => __('Video Alojado (MP4)', 'ecomolimpo-widgets'),
                ],
            ]
        );

        $this->add_control(
            'youtube_url',
            [
                'label' => __('URL de YouTube', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'https://www.youtube.com/watch?v=bTqVqk7FSmY',
                'default' => 'https://www.youtube.com/watch?v=bTqVqk7FSmY',
                'condition' => [
                    'video_type' => 'youtube',
                ],
            ]
        );

        $this->add_control(
            'vimeo_url',
            [
                'label' => __('URL de Vimeo', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'https://vimeo.com/76979871',
                'condition' => [
                    'video_type' => 'vimeo',
                ],
            ]
        );

        $this->add_control(
            'hosted_url',
            [
                'label' => __('Video MP4', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_type' => 'video',
                'condition' => [
                    'video_type' => 'hosted',
                ],
            ]
        );

        $this->add_control(
            'poster',
            [
                'label' => __('Imagen de Portada', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // ========== OPCIONES DEL REPRODUCTOR ==========
        $this->start_controls_section(
            'player_options_section',
            [
                'label' => __('Opciones del Reproductor', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Reproducción Automática', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sí', 'ecomolimpo-widgets'),
                'label_off' => __('No', 'ecomolimpo-widgets'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'muted',
            [
                'label' => __('Silenciado por Defecto', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sí', 'ecomolimpo-widgets'),
                'label_off' => __('No', 'ecomolimpo-widgets'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Repetir Video', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sí', 'ecomolimpo-widgets'),
                'label_off' => __('No', 'ecomolimpo-widgets'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'controls',
            [
                'label' => __('Mostrar Controles', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sí', 'ecomolimpo-widgets'),
                'label_off' => __('No', 'ecomolimpo-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'click_to_play',
            [
                'label' => __('Click para Reproducir', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sí', 'ecomolimpo-widgets'),
                'label_off' => __('No', 'ecomolimpo-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // ========== ESTILOS ==========
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Estilos', 'ecomolimpo-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'aspect_ratio',
            [
                'label' => __('Relación de Aspecto', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '16/9',
                'options' => [
                    '16/9' => '16:9',
                    '4/3' => '4:3',
                    '21/9' => '21:9',
                    '1/1' => '1:1',
                    'none' => __('Personalizado', 'ecomolimpo-widgets'),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'video_border',
                'selector' => '{{WRAPPER}} .ecomolimpo-video-player',
            ]
        );

        $this->add_responsive_control(
            'video_border_radius',
            [
                'label' => __('Radio del Borde', 'ecomolimpo-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ecomolimpo-video-player' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ecomolimpo-video-player video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'video_box_shadow',
                'selector' => '{{WRAPPER}} .ecomolimpo-video-player',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $video_type = $settings['video_type'];
        $video_id = 'ecomolimpo-video-' . $this->get_id();

        // Enqueue Plyr
        wp_enqueue_style('plyr', 'https://cdn.plyr.io/3.7.8/plyr.css', [], '3.7.8');
        wp_enqueue_script('plyr', 'https://cdn.plyr.io/3.7.8/plyr.js', [], '3.7.8', true);

        // Player options
        $player_options = [
            'autoplay' => $settings['autoplay'] === 'yes',
            'muted' => $settings['muted'] === 'yes',
            'loop' => ['active' => $settings['loop'] === 'yes'],
            'controls' => $settings['controls'] === 'yes' ? ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'settings', 'fullscreen'] : [],
            'clickToPlay' => $settings['click_to_play'] === 'yes',
        ];

        $aspect_ratio = $settings['aspect_ratio'];
        $aspect_style = $aspect_ratio !== 'none' ? 'aspect-ratio: ' . $aspect_ratio . ';' : '';
        ?>
        <div class="ecomolimpo-video-player" style="<?php echo esc_attr($aspect_style); ?>">
            <?php if ($video_type === 'youtube') : 
                $youtube_id = $this->get_youtube_id($settings['youtube_url']);
                ?>
                <div id="<?php echo esc_attr($video_id); ?>" data-plyr-provider="youtube" data-plyr-embed-id="<?php echo esc_attr($youtube_id); ?>"></div>
                
            <?php elseif ($video_type === 'vimeo') : 
                $vimeo_id = $this->get_vimeo_id($settings['vimeo_url']);
                ?>
                <div id="<?php echo esc_attr($video_id); ?>" data-plyr-provider="vimeo" data-plyr-embed-id="<?php echo esc_attr($vimeo_id); ?>"></div>
                
            <?php elseif ($video_type === 'hosted' && !empty($settings['hosted_url']['url'])) : ?>
                <video id="<?php echo esc_attr($video_id); ?>" playsinline <?php echo !empty($settings['poster']['url']) ? 'poster="' . esc_url($settings['poster']['url']) . '"' : ''; ?>>
                    <source src="<?php echo esc_url($settings['hosted_url']['url']); ?>" type="video/mp4">
                </video>
            <?php endif; ?>
        </div>

        <script>
        (function() {
            document.addEventListener('DOMContentLoaded', function() {
                const player = new Plyr('#<?php echo esc_js($video_id); ?>', <?php echo json_encode($player_options); ?>);
            });
        })();
        </script>
        <?php
    }

    /**
     * Extract YouTube video ID from URL
     */
    private function get_youtube_id($url) {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        return isset($matches[1]) ? $matches[1] : '';
    }

    /**
     * Extract Vimeo video ID from URL
     */
    private function get_vimeo_id($url) {
        preg_match('/vimeo\.com\/(\d+)/', $url, $matches);
        return isset($matches[1]) ? $matches[1] : '';
    }

    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <# 
        var videoType = settings.video_type;
        var videoId = 'ecomolimpo-video-' + view.getID();
        var aspectRatio = settings.aspect_ratio;
        var aspectStyle = aspectRatio !== 'none' ? 'aspect-ratio: ' + aspectRatio + ';' : '';
        #>
        <div class="ecomolimpo-video-player" style="{{ aspectStyle }}">
            <# if (videoType === 'youtube') { #>
                <div style="background: #000; color: #fff; padding: 50px; text-align: center;">
                    <i class="eicon-youtube" style="font-size: 50px;"></i>
                    <p>YouTube Video Preview</p>
                    <small>{{ settings.youtube_url }}</small>
                </div>
            <# } else if (videoType === 'vimeo') { #>
                <div style="background: #000; color: #fff; padding: 50px; text-align: center;">
                    <i class="eicon-vimeo" style="font-size: 50px;"></i>
                    <p>Vimeo Video Preview</p>
                    <small>{{ settings.vimeo_url }}</small>
                </div>
            <# } else if (videoType === 'hosted' && settings.hosted_url.url) { #>
                <div style="background: #000; color: #fff; padding: 50px; text-align: center;">
                    <i class="eicon-video-camera" style="font-size: 50px;"></i>
                    <p>Video Alojado Preview</p>
                    <# if (settings.poster.url) { #>
                        <img src="{{ settings.poster.url }}" style="max-width: 100%; margin-top: 20px;">
                    <# } #>
                </div>
            <# } #>
        </div>
        <?php
    }
}
