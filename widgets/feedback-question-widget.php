<?php

class Elementor_Feedback_Question_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'question_feedback_widget';
    }

    public function get_title() {
        return 'Pergunta com Feedback';
    }

    public function get_icon() {
        return 'eicon-help-o';
    }

    public function get_categories() {
        return ['ead'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Conteúdo',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'debug_mode',
            [
                'label' => esc_html__('Console Logs', 'elementor-feedback-question'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'elementor-feedback-question'),
                'label_off' => esc_html__('Off', 'elementor-feedback-question'),
                'return_value' => 'true', // Retorna 'true' se ativado, vazio se desativado
                'default' => '', // Por padrão, desativado
            ]
        );

        $this->add_control(
            'question_title',
            [
                'label' => 'Título da Pergunta',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Qual é a resposta correta?',
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'option_text',
            [
                'label' => 'Texto da Opção',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Opção',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'option_feedback',
            [
                'label' => 'Feedback para esta opção',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Explicação sobre por que esta opção está correta/incorreta',
                'label_block' => true,
            ]
        );

        

        $repeater->add_control(
            'option_icon',
            [
                'label' => 'Ícone Inicial',
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-circle',
                    'library' => 'fa-regular',
                ],
            ]
        );

        $this->add_control(
            'options',
            [
                'label' => 'Opções de Resposta',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'option_text' => 'Opção 1',
                        'option_feedback' => 'Feedback para a opção 1'
                    ],
                    [
                        'option_text' => 'Opção 2', 
                        'option_feedback' => 'Feedback para a opção 2'
                    ],
                ],
                'title_field' => '{{{ option_text }}}',
            ]
        );

        $this->add_control(
            'correct_option',
            [
                'label' => 'Número da Resposta Correta',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 1,
            ]
        );

        $this->add_control(
            'reset_button_text',
            [
                'label' => 'Texto do Botão Reiniciar',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Tentar novamente',
            ]
        );

        $this->add_control(
            'correct_icon',
            [
                'label' => 'Ícone para Resposta Correta',
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'wrong_icon',
            [
                'label' => 'Ícone para Resposta Incorreta',
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-times',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();

        // ======================
        // SEÇÕES DE ESTILO
        // ======================

        // Container Principal
        $this->start_controls_section(
            'container_style',
            [
                'label' => 'Container Principal',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'container_bg',
            [
                'label' => 'Cor de Fundo',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-feedback-container' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'container_border_radius',
            [
                'label' => 'Raio da Borda',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-feedback-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );       

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => 'Espaçamento Interno',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-feedback-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => 'Margem',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-feedback-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Estilo do Título
        $this->start_controls_section(
            'title_style',
            [
                'label' => 'Título da Pergunta',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => 'Cor do Texto',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .question-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => 'Margem',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => 'Espaçamento Interno',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Estilo das Opções
        $this->start_controls_section(
            'options_style',
            [
                'label' => 'Opções de Resposta',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'option_text_color',
            [
                'label' => 'Cor do Texto',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-option' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'option_bg_color',
            [
                'label' => 'Cor de Fundo',
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'f8f9fa2a',
                'selectors' => [
                    '{{WRAPPER}} .question-option' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'option_typography',
                'selector' => '{{WRAPPER}} .question-option-text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'option_border',
                'selector' => '{{WRAPPER}} .question-option',
                'default' => [
                    'border' => 'solid',
                    'width' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 0,
                    ],
                    'color' => '#dee2e6',
                ],
            ]
        );

        $this->add_control(
            'option_border_radius',
            [
                'label' => 'Raio da Borda',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-option' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'option_padding',
            [
                'label' => 'Espaçamento Interno',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-option' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'option_margin',
            [
                'label' => 'Margem',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-option' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'option_hover_heading',
            [
                'label' => 'Efeito Hover',
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'option_hover_text_color',
            [
                'label' => 'Cor do Texto (Hover)',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-option:hover .question-option-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'option_hover_bg_color',
            [
                'label' => 'Cor de Fundo (Hover)',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-option:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'option_active_heading',
            [
                'label' => 'Opção Selecionada',
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'option_active_text_color',
            [
                'label' => 'Cor do Texto (Selecionada)',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-option.selected .question-option-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'option_active_bg_color',
            [
                'label' => 'Cor de Fundo (Selecionada)',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-option.selected' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

        // Estilo dos Ícones
        $this->start_controls_section(
            'icons_style',
            [
                'label' => 'Ícones',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => 'Tamanho',
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .question-option-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => 'Cor (Inicial)',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-option-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_correct_color',
            [
                'label' => 'Cor (Correta)',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-option.correct .question-option-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_wrong_color',
            [
                'label' => 'Cor (Incorreta)',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-option.wrong .question-option-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => 'Espaçamento',
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .question-option-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Estilo do Feedback
        $this->start_controls_section(
            'feedback_style',
            [
                'label' => 'Feedback',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feedback_text_color',
            [
                'label' => 'Cor do Texto',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-feedback' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'feedback_bg_color',
            [
                'label' => 'Cor de Fundo',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-feedback' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'feedback_typography',
                'selector' => '{{WRAPPER}} .question-feedback',
            ]
        );
        

        $this->add_control(
            'feedback_border_radius',
            [
                'label' => 'Raio da Borda',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-feedback' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'feedback_padding',
            [
                'label' => 'Espaçamento Interno',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-feedback' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'feedback_margin',
            [
                'label' => 'Margem',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-feedback' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // ---- Feedback - Correto
$this->add_control(
    'feedback_correct_heading',
    [
        'label' => 'Feedback — Correto',
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_control(
    'feedback_correct_text_color',
    [
        'label' => 'Cor do Texto (Correta)',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .question-option.correct .question-feedback' => 'color: {{VALUE}};',
            '{{WRAPPER}} .question-feedback.correct' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'feedback_correct_bg_color',
    [
        'label' => 'Fundo (Correta)',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .question-option.correct .question-feedback' => 'background-color: {{VALUE}};',
            '{{WRAPPER}} .question-feedback.correct' => 'background-color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Border::get_type(),
    [
        'name' => 'feedback_correct_border',
        'selector' => '{{WRAPPER}} .question-option.correct .question-feedback',
    ]
);

$this->add_responsive_control(
    'feedback_correct_padding',
    [
        'label' => 'Padding (Correta)',
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
            '{{WRAPPER}} .question-option.correct .question-feedback' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .question-feedback.correct' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

// ---- Feedback - Incorreto
$this->add_control(
    'feedback_wrong_heading',
    [
        'label' => 'Feedback — Incorreto',
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_control(
    'feedback_wrong_text_color',
    [
        'label' => 'Cor do Texto (Incorreta)',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .question-option.wrong .question-feedback' => 'color: {{VALUE}};',
            '{{WRAPPER}} .question-feedback.wrong' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'feedback_wrong_bg_color',
    [
        'label' => 'Fundo (Incorreta)',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .question-option.wrong .question-feedback' => 'background-color: {{VALUE}};',
            '{{WRAPPER}} .question-feedback.wrong' => 'background-color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Border::get_type(),
    [
        'name' => 'feedback_wrong_border',
        'selector' => '{{WRAPPER}} .question-option.wrong .question-feedback',
    ]
);

$this->add_responsive_control(
    'feedback_wrong_padding',
    [
        'label' => 'Padding (Incorreta)',
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
            '{{WRAPPER}} .question-option.wrong .question-feedback' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .question-feedback.wrong' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

        $this->end_controls_section();

        // Estilo do Botão de Reset
        $this->start_controls_section(
            'reset_button_style',
            [
                'label' => 'Botão Reiniciar',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'reset_button_text_color',
            [
                'label' => 'Cor do Texto',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-reset-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'reset_button_bg_color',
            [
                'label' => 'Cor de Fundo',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-reset-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'reset_button_typography',
                'selector' => '{{WRAPPER}} .question-reset-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'reset_button_border',
                'selector' => '{{WRAPPER}} .question-reset-button',
            ]
        );

        $this->add_control(
            'reset_button_border_radius',
            [
                'label' => 'Raio da Borda',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-reset-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'reset_button_padding',
            [
                'label' => 'Espaçamento Interno',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .question-reset-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'reset_button_hover_heading',
            [
                'label' => 'Efeito Hover',
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'reset_button_hover_text_color',
            [
                'label' => 'Cor do Texto (Hover)',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-reset-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'reset_button_hover_bg_color',
            [
                'label' => 'Cor de Fundo (Hover)',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-reset-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'reset_button_hover_border_color',
            [
                'label' => 'Cor da Borda (Hover)',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .question-reset-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

       protected function render() {
            $settings = $this->get_settings_for_display();
            $widget_id = $this->get_id();
            $correct_option = $settings['correct_option'];
        
            $correct_color  = $settings['icon_correct_color'] ?? '#28a745';
            $wrong_color    = $settings['icon_wrong_color'] ?? '#dc3545';
            $correct_icon   = $settings['correct_icon']['value'] ?? 'fas fa-check';
            $wrong_icon     = $settings['wrong_icon']['value'] ?? 'fas fa-times';
        
            // Novos controles
            $border_width   = $settings['border_width'] ?? '2px';
            $border_padding = $settings['border_padding'] ?? '8px';
        
            wp_localize_script(
                'feedback-script',
                'feedbackQuestionConfig',
                [
                    'isDebugMode' => ($settings['debug_mode'] === 'true'),
                ]
            );
            ?>
            <div class="question-feedback-container" 
                id="question-feedback-<?php echo esc_attr($widget_id); ?>"
                data-correct-color="<?php echo esc_attr($correct_color); ?>"
                data-wrong-color="<?php echo esc_attr($wrong_color); ?>"
                data-correct-icon="<?php echo esc_attr($correct_icon); ?>"
                data-wrong-icon="<?php echo esc_attr($wrong_icon); ?>">
        
                <style>
                #question-feedback-<?php echo esc_attr($widget_id); ?> {
                    --correct-color: <?php echo esc_attr($correct_color); ?>;
                    --wrong-color: <?php echo esc_attr($wrong_color); ?>;
                    --border-width: <?php echo esc_attr($border_width); ?>;
                    --border-padding: <?php echo esc_attr($border_padding); ?>;
                }
                </style>
        
                <?php if (!empty($settings['question_title'])) : ?>
                    <h3 class="question-title"><?php echo esc_html($settings['question_title']); ?></h3>
                <?php endif; ?>
        
                <div class="question-options">
                    <?php foreach ($settings['options'] as $index => $option) :
                        $option_number = $index + 1;
                        $is_correct = ($option_number == $correct_option);
                        $has_feedback = !empty(trim(strip_tags($option['option_feedback'])));
                    ?>
                        <div class="question-option" 
                            data-option-number="<?php echo esc_attr($option_number); ?>"
                            data-is-correct="<?php echo esc_attr($is_correct ? 'yes' : 'no'); ?>"
                            data-has-feedback="<?php echo esc_attr($has_feedback ? 'yes' : 'no'); ?>">
        
                            <div class="question-option-content">
                                <i class="question-option-icon <?php echo esc_attr($option['option_icon']['value'] ?? 'far fa-circle'); ?>"></i>
                                <span class="question-option-text"><?php echo esc_html($option['option_text']); ?></span>
                            </div>
        
                            <?php if ($has_feedback) : ?>
                                <div class="question-feedback" style="display: none;">
                                    <?php echo wp_kses_post($option['option_feedback']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
        
                <button class="question-reset-button" style="display: none;">
                    <?php echo esc_html($settings['reset_button_text']); ?>
                </button>
            </div>
        
            <script type="text/javascript">
            if (typeof window.questionFeedbackWidgetIds === 'undefined') {
                window.questionFeedbackWidgetIds = [];
            }
            window.questionFeedbackWidgetIds.push('<?php echo esc_js($widget_id); ?>');
            </script>
            <?php
        }


}