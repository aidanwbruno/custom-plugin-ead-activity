<?php

class Elementor_Typing_Effect_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'typing_effect';
    }

    public function get_title() {
        return 'Typing Effect';
    }

    public function get_icon() {
        return 'eicon-commenting-o';
    }

    public function get_categories() {
        return ['ead'];
    }

    public function get_style_depends() {
        return ['typing-effect-style'];
    }

    public function get_script_depends() {
        return ['typing-effect-script'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section_typing',
            [
                'label' => 'Configurações do Texto',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'debug_mode',
            [
                'label' => esc_html__('Console Logs', 'elementor-typping-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'elementor-typping-effect'),
                'label_off' => esc_html__('Off', 'elementor-typping-effect'),
                'return_value' => 'true', // Retorna 'true' se ativado, vazio se desativado
                'default' => '', // Por padrão, desativado
            ]
        );

        $this->add_control(
            'typing_text',
            [
                'label' => __('Texto para Typing', 'text-domain'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Digite aqui seu texto...', 'text-domain'),
            ]
        );

        $this->add_control(
            'typing_speed',
            [
                'label' => __('Velocidade do Typing (ms)', 'text-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 100,
                'min' => 10,
                'step' => 10,
                'description' => __('Tempo em milissegundos entre cada caractere.'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section_typing',
            [
                'label' => __('Estilo do Texto', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'typing_placeholder_color',
            [
                'label' => __('Cor do Texto (visível antes da digitação)', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .typing-placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'placeholder_typography',
                'label' => __('Tipografia do Texto (visível antes da digitação)', 'text-domain'),
                'selector' => '{{WRAPPER}} .typing-placeholder',
            ]
        );

        $this->add_control(
            'placeholder_font_size',
            [
                'label' => __('Tamanho do Texto (visível antes da digitação)', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .typing-placeholder' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'typing_effect_color',
            [
                'label' => __('Cor do Texto (efeito de digitação)', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .typing-effect' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'effect_typography',
                'label' => __('Tipografia do Texto (efeito de digitação)', 'text-domain'),
                'selector' => '{{WRAPPER}} .typing-effect',
            ]
        );

        $this->add_control(
            'effect_font_size',
            [
                'label' => __('Tamanho do Texto (efeito de digitação)', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .typing-effect' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
    $settings = $this->get_settings_for_display();
    $widget_id = $this->get_id(); // Obter o ID único do widget
    $text = $settings['typing_text']; // Texto com tags HTML
    $speed = $settings['typing_speed'];

    wp_localize_script(
        'typing-effect-script',
        'typingEffectConfig',
        [
            'isDebugMode' => ($settings['debug_mode'] === 'true'),
            'widgetId' => $widget_id 
        ]
    );

    ?>
    <div class="typing-container">
        <!-- A tag div agora está passando o conteúdo com HTML diretamente -->
        <div class="typing-placeholder"><?php echo $text; ?></div>
        <div id="typing-effect-<?php echo $widget_id; ?>" class="typing-effect" data-speed="<?php echo esc_attr($speed); ?>" data-text="<?php echo esc_attr($text); ?>"></div>
    </div>
    <?php
}

}


