<?php

class Elementor_Question_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'question_widget';
    }

    public function get_title() {
        return 'Pergunta com popup';
    }

    public function get_icon() {
        return 'eicon-kit-parts';
    }

    public function get_categories() {
        return ['ead'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Configurações da Pergunta',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'debug_mode',
            [
                'label' => esc_html__('Console Logs', 'elementor-popup-question'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'elementor-popup-question'),
                'label_off' => esc_html__('Off', 'elementor-popup-question'),
                'return_value' => 'true', // Retorna 'true' se ativado, vazio se desativado
                'default' => '', // Por padrão, desativado
            ]
        );

        $this->add_control(
            'question_text',
            [
                'label' => 'Pergunta',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Qual é a resposta correta?',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'option_text',
            [
                'label' => 'Texto da Opção',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Opção',
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

        $repeater->add_control(
            'option_popup',
            [
                'label' => 'Popup para Opção',
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'Número do popup',
            ]
        );

        $this->add_control(
            'options',
            [
                'label' => 'Opções de Resposta',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['option_text' => 'Opção 1'],
                    ['option_text' => 'Opção 2'],
                    ['option_text' => 'Opção 3'],
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
                'default' => 'Reiniciar Resposta',
            ]
        );


        $this->add_control(
            'correct_icon',
            [
                'label' => 'Ícone para Resposta Correta',
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-check-circle',
                    'library' => 'fa-regular',
                ],
            ]
        );

        $this->add_control(
            'wrong_icon',
            [
                'label' => 'Ícone para Resposta Incorreta',
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-times-circle',
                    'library' => 'fa-regular',
                ],
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
        'question_box_style',
        [
            'label' => 'Container',
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    // Controle para a Cor de Fundo
    $this->add_control(
        'question_box_background_color',
        [
            'label' => 'Cor de Fundo',
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#ffffff', // Cor padrão
            'selectors' => [
                '{{WRAPPER}} .question-box' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    // Controle para a Margem
    $this->add_responsive_control(
        'question_box_margin',
        [
            'label' => 'Margem',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .question-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
        ]
    );

    // Controle para o Padding
    $this->add_responsive_control(
        'question_box_padding',
        [
            'label' => 'Padding',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .question-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
        ]
    );

    // Controle de borda da pergunta
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'question_box_border',
            'label' => 'Borda',
            'selector' => '{{WRAPPER}} .question-box',
        ]
    );

    // Controle de raio da borda
    $this->add_responsive_control(
        'question_box_radius',
        [
            'label' => 'Raio da Borda',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .question-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();
        
        $this->start_controls_section(
        'question_style',
        [
            'label' => 'Estilo da Pergunta',
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    // Controle de cor do texto da pergunta
    $this->add_control(
        'question_text_color',
        [
            'label' => 'Cor do Texto',
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .question-text' => 'color: {{VALUE}};',
            ],
        ]
    );

    // Controle de tipografia para a pergunta
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'question_typography',
            'label' => 'Tipografia',
            'selector' => '{{WRAPPER}} .question-text',
        ]
    );

            $this->add_responsive_control(
            'question_margin',
            [
                'label' => 'Margem',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .question-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );


    // Controle de padding para a pergunta
    $this->add_responsive_control(
        'question_padding',
        [
            'label' => 'Espaçamento Interno (Padding)',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .question-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    // Controle de cor de fundo da pergunta
    $this->add_control(
        'question_background_color',
        [
            'label' => 'Cor de Fundo',
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .question-text' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    // Controle de borda da pergunta
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'question_border',
            'label' => 'Borda',
            'selector' => '{{WRAPPER}} .question-text',
        ]
    );

    // Controle de raio da borda
    $this->add_responsive_control(
        'question_border_radius',
        [
            'label' => 'Raio da Borda',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .question-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();
    
    $this->start_controls_section(
        'options_style',
        [
            'label' => 'Estilo das Opções',
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    // Controle para a Tipografia
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'options_typography',
            'label' => 'Tipografia das Opções',
            'selector' => '{{WRAPPER}} .optionsCustom',
        ]
    );

    // Controle para a Cor do Texto
    $this->add_control(
        'options_text_color',
        [
            'label' => 'Cor do Texto',
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#000000', // Cor padrão
            'selectors' => [
                '{{WRAPPER}} .optionsCustomSpan' => 'color: {{VALUE}}!important;',
            ],
        ]
    );

    // Controle para a Cor de Fundo
    $this->add_control(
        'options_background_color',
        [
            'label' => 'Cor de Fundo',
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#f0f0f0', // Cor padrão
            'selectors' => [
                '{{WRAPPER}} .optionsCustom' => 'background-color: {{VALUE}}!important;',
            ],
        ]
    );

    // Controle para a Margem
    $this->add_responsive_control(
        'options_margin',
        [
            'label' => 'Margem',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .optionsCustom' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
        ]
    );

    // Controle para o Espaçamento (Padding)
    $this->add_responsive_control(
        'options_padding',
        [
            'label' => 'Padding',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .optionsCustom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
        ]
    );

    // Controle de borda da pergunta
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'options_border',
            'label' => 'Borda',
            'selector' => '{{WRAPPER}} .optionsCustom',
            'fields_options' => [
                'border' => [
                    'default' => 'solid',
                ],
                'width' => [
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                    ],
                ],
                'color' => [
                    'default' => '#ccc',
                ],
            ],
        ]
    );
        
    $this->add_control(
        'options_border_radius',
        [
            'label' => 'Raio da Borda',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'size' => 8,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .optionsCustom' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]
    );


    $this->end_controls_section();
    
    $this->start_controls_section(
            'initial_icon_style_section',
            [
                'label' => __( 'Estilo do Ícone Inicial', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'initial_icon_margin',
            [
                'label' => __( 'Margem', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .icon-initial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'initial_icon_padding',
            [
                'label' => __( 'Padding', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .icon-initial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'initial_icon_size',
            [
                'label' => __( 'Tamanho', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-initial' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'initial_icon_color',
            [
                'label' => __( 'Cor', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ccc',
                'selectors' => [
                    '{{WRAPPER}} .icon-initial' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Repita para o ícone correto e incorreto
        $this->start_controls_section(
            'correct_icon_style_section',
            [
                'label' => __( 'Estilo do Ícone Correto', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Adicione os controles de margem, padding, tamanho e cor para o ícone correto
        // Exemplo:
        $this->add_control(
            'correct_icon_margin',
            [
                'label' => __( 'Margem', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .icon-correct' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'correct_icon_padding',
            [
                'label' => __( 'Padding', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .icon-correct' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'correct_icon_size',
            [
                'label' => __( 'Tamanho', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-correct' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'correct_icon_color',
            [
                'label' => __( 'Cor', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon-correct' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Repita para o ícone correto e incorreto
        $this->start_controls_section(
            'icon-wrong_style_section',
            [
                'label' => __( 'Estilo do Ícone Incorreto', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Adicione os controles de margem, padding, tamanho e cor para o ícone correto
        // Exemplo:
        $this->add_control(
            'icon-wrong_margin',
            [
                'label' => __( 'Margem', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .icon-wrong' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon-wrong_padding',
            [
                'label' => __( 'Padding', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .icon-wrong' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon-wrong_size',
            [
                'label' => __( 'Tamanho', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-wrong' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon-wrong_color',
            [
                'label' => __( 'Cor', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon-wrong' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'reset_button_style_section',
            [
                'label' => __( 'Estilo do Botão Reiniciar', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Cor do texto do botão
        $this->add_control(
            'reset_button_text_color',
            [
                'label' => __( 'Cor do Texto', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .reset-button' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'reset_button_hover_text_color',
            [
                'label' => __( 'Cor do Texto (Hover)', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .reset-button:hover' => 'color: {{VALUE}}!important;',
                ],
            ]
        );


        // Background do botão
        $this->add_control(
            'reset_button_background_color',
            [
                'label' => __( 'Cor do Background', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .reset-button' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );
        
        $this->add_control(
            'reset_button_hover_background_color',
            [
                'label' => __( 'Cor do Background (Hover)', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .reset-button:hover' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        // Tipografia do botão (fonte, tamanho, estilo)
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'reset_button_typography',
                'label' => __( 'Tipografia', 'text-domain' ),
                'selector' => '{{WRAPPER}} .reset-button',
            ]
        );

        // Padding do botão
        $this->add_control(
            'reset_button_padding',
            [
                'label' => __( 'Padding', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .reset-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin do botão
        $this->add_control(
            'reset_button_margin',
            [
                'label' => __( 'Margem', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .reset-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Borda do botão
       $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'reset_button_border',
                'label' => __( 'Borda', 'text-domain' ),
                'selector' => '{{WRAPPER}} .reset-button', // Este é o local correto para o seletor
                'default' => [
                    'border' => 'solid', // Ou 'none' se você não quiser nenhuma borda por padrão
                    'width' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                    ],
                    'color' => '', // Opcional: defina uma cor padrão se a borda for visível
                ],
            ]
        );

 

        // Borda arredondada
        $this->add_control(
            'reset_button_border_radius',
            [
                'label' => __( 'Radius da Borda', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 8,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .reset-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    
    }

protected function render() {
    $settings = $this->get_settings_for_display();
    $widget_id = $this->get_id();

    $is_editor = \Elementor\Plugin::$instance->editor->is_edit_mode();    

    $style_inline = $is_editor 
    ? 'style="display: flex; align-items: center; gap: 10px; padding: 12px; margin-bottom: 10px; background: #f0f0f0; transition: background 0.3s, border-color 0.3s; cursor: pointer;"' 
    : '';

    
    wp_localize_script(
        'popup-question-script', // Handle do seu script JS
        'popupQuestionConfig', // Nome do objeto JS global
        [
            'isDebugMode' => ($settings['debug_mode'] === 'true'), // Converte para booleano
        ]
    );
    $correct_option = $settings['correct_option'];

    echo '<div class="question-box" id="question-box-' . esc_attr($widget_id) . '">';
    echo '<p class="question-text" style="font-size: 18px; font-weight: 600; margin-bottom: 15px;"> ' . esc_html($settings['question_text']) . '</p>';

    foreach ($settings['options'] as $index => $option) {
        $option_number = $index + 1;
        $icon_html = '<i aria-hidden="true" class="far fa-circle icon-initial ' . esc_attr('custom_' . $option_number . '_custom_' . $widget_id) . '"></i>';

        echo '<div class="optionsCustom optionsCustom-' . esc_attr($widget_id) . '" ' . $style_inline . '
            data-option-number="' . esc_attr($option_number) . '" 
            data-correct-option="' . esc_attr($correct_option) . '" 
            data-popup-url="' . esc_attr($option['option_popup']) . '"
            data-correct-icon="' . esc_attr($settings['correct_icon']['value']) . '" 
            data-wrong-icon="' . esc_attr($settings['wrong_icon']['value']) . '">' . 
            $icon_html .  
            '<span class="optionsCustomSpan">' . esc_html($option['option_text']) . '</span>
        </div>';

    }

    echo '<button class="reset-button button-reset-custom hidden reset-button-' . esc_attr($widget_id) . '">' . esc_html($settings['reset_button_text']) . '</button>';

    echo '</div>';
    
    // Passa o ID do widget para o JavaScript e chama a função de inicialização para este ID específico
    echo '<script>
    jQuery(document).ready(function($) {
        if (typeof initializeWidget === "function") {
            initializeWidget("' . esc_js($widget_id) . '");
        } else {
            console.error("initializeWidget is not defined");
        }
    });
    </script>';
}




}
