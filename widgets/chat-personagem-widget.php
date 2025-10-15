<?php

class Elementor_Chat_Personagem_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'chat_personagem';
    }

    public function get_title() {
        return 'Chat Personagem';
    }

    public function get_icon() {
        return 'eicon-comments';
    }

    public function get_categories() {
        return ['ead'];
    }

    public function get_style_depends() {
        return ['chat-personagem-style'];
    }

    public function get_script_depends() {
        return ['chat-personagem-script'];
    }

    protected function _register_controls() {
        // Seção de Configurações do Chat
        $this->start_controls_section(
            'content_section_chat',
            [
                'label' => 'Configurações do Chat',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'debug_mode',
            [
                'label' => esc_html__('Console Logs', 'debug-mode-chat'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'debug-mode-chat'),
                'label_off' => esc_html__('Off', 'debug-mode-chat'),
                'return_value' => 'true', 
                'default' => '', 
            ]
        );

        $this->add_control(
            'chat_baloes',
            [
                'label' => __('Balões de Chat', 'text-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'chat_text',
                        'label' => __('Texto do Chat', 'text-domain'),
                        'type' => \Elementor\Controls_Manager::WYSIWYG,
                        'default' => __('Digite sua mensagem...', 'text-domain'),
                    ],
                    [
                        'name' => 'caret_direction',
                        'label' => __('Direção do Caret', 'text-domain'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            'top' => __('Cima', 'text-domain'),
                            'bottom' => __('Baixo', 'text-domain'),
                            'left' => __('Esquerda', 'text-domain'),
                            'right' => __('Direita', 'text-domain'),
                        ],
                        'default' => 'top',
                    ],
                    [
                        'name' => 'caret_position',
                        'label' => __('Posição do Caret (%)', 'text-domain'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['%'],
                        'range' => [
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'size' => 50,
                            'unit' => '%',
                        ],
                    ],
                    [
                        'name' => 'bubble_margin',
                        'label' => __('Margem do Balão', 'text-domain'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%', 'em'],
                        'default' => [
                            'top' => '0',
                            'right' => '0',
                            'bottom' => '0',
                            'left' => '0',
                            'unit' => 'px',
                        ],
                    ],
                    
                ],
                'default' => [
                    ['chat_text' => __('Digite sua mensagem...', 'text-domain')],
                ],
            ]
        );
        
        $this->add_control(
            'start_icon_type',
            [
                'label' => __('Tipo de Start Icon', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'icon' => __('Ícone', 'text-domain'),
                    'image' => __('Imagem', 'text-domain'),
                ],
                'default' => 'icon',
            ]
        );
        
        $this->add_control(
            'start_icon',
            [
                'label' => __('Ícone Start', 'text-domain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right', // Exemplo de ícone
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'start_icon_type' => 'icon',
                ],
            ]
        );
        
        $this->add_control(
            'start_image',
            [
                'label' => __('Imagem Start', 'text-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '', // URL da imagem padrão
                ],
                'condition' => [
                    'start_icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'next_icon_type',
            [
                'label' => __('Tipo de Next Icon', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'icon' => __('Ícone', 'text-domain'),
                    'image' => __('Imagem', 'text-domain'),
                ],
                'default' => 'icon',
            ]
        );

        $this->add_control(
            'next_icon',
            [
                'label' => __('Ícone Próximo', 'text-domain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right', // Exemplo de ícone
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'next_icon_type' => 'icon',
                ],
            ]
        );
        
        $this->add_control(
            'next_image',
            [
                'label' => __('Imagem Next', 'text-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '', // URL da imagem padrão
                ],
                'condition' => [
                    'next_icon_type' => 'image',
                ],
            ]
        );
        


    $this->add_control(
        'prev_icon_type',
        [
            'label' => __('Tipo de Prev Icon', 'text-domain'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'icon' => __('Ícone', 'text-domain'),
                'image' => __('Imagem', 'text-domain'),
            ],
            'default' => 'icon',
        ]
    );

    $this->add_control(
        'prev_icon',
        [
            'label' => __('Ícone Anterior', 'text-domain'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-arrow-left', // Exemplo de ícone
                'library' => 'fa-solid',
            ],
            'condition' => [
                'prev_icon_type' => 'icon',
            ],
        ]
    );
    
    $this->add_control(
        'prev_image',
        [
            'label' => __('Imagem Prev', 'text-domain'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => '', // URL da imagem padrão
            ],
            'condition' => [
                'prev_icon_type' => 'image',
            ],
        ]
    );

        $this->end_controls_section();

        // Seção de Estilo do Balão
        $this->start_controls_section(
            'style_section_balloon',
            [
                'label' => __('Estilo do Balão', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'balloon_typography',
                'label' => 'Tipografia',
                'selector' => '{{WRAPPER}} .speech-bubble',
            ]
        );
        
        $this->add_control(
            'ballon_text_color',
            [
                'label' => __('Cor do Texto', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .speech-bubble' => 'color: {{VALUE}};',
                ],
            ]
        );
    
    
    
        // Controle de padding para a pergunta
        $this->add_responsive_control(
    'balloon_padding',
    [
        'label' => 'Espaçamento Interno (Padding)',
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors' => [
            '{{WRAPPER}} .speech-bubble' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'default' => [ // Adicione esta seção para definir o valor padrão
            'top' => '20',
            'right' => '20',
            'bottom' => '20',
            'left' => '20',
            'unit' => 'px',
        ],
    ]
);

        $this->add_control(
            'balloon_background_color',
            [
                'label' => __('Cor de Fundo do Balão', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ECECEC',
                'selectors' => [
                    '{{WRAPPER}} .speech-bubble' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ballon_border',
                'label' => 'Borda',
                'selector' => '{{WRAPPER}} .speech-bubble',
            ]
        );
    
        // Controle de raio da borda
        $this->add_responsive_control(
            'ballon_border_radius',
            [
                'label' => 'Raio da Borda',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .speech-bubble' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

    

        $this->end_controls_section();

        // Seção de Estilo dos Botões de Navegação
        $this->start_controls_section(
            'style_section_navigation_buttons',
            [
                'label' => __('Estilo dos Botões de Navegação', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_start_width',
            [
                'label' => __('Largura imagem Start', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 5,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 65,
                ],
                'selectors' => [
                    '{{WRAPPER}} .start-bubble' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'start_icon_type' => 'image'
                ],
            ]
        );

        $this->add_control(
            'button_width',
            [
                'label' => __('Largura imagem Prev Next', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 5,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .next-bubble, {{WRAPPER}} .prev-bubble' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'next_icon_type' => 'image',
                    'prev_icon_type' => 'image',
                ],
            ]
        );

        
        $this->add_control(
            'button_start_color',
            [
                'label' => __('Cor Texto Start', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .start-bubble' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'start_icon_type' => 'icon', // <--- esta é a correta
                ],
            ]
        );
        

        $this->add_control(
            'button_start_hover_color',
            [
                'label' => __('Cor em Hover Text Start', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .start-bubble:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'start_icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'button_next_color',
            [
                'label' => __('Cor Texto Next', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .next-bubble' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'next_icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'button_next_hover_color',
            [
                'label' => __('Cor em Hover Texto Next', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .next-bubble:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'next_icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'button_prev_color',
            [
                'label' => __('Cor Texto Prev', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .prev-bubble' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'prev_icon_type' => 'icon',
                ],
            ]
        );
        

        $this->add_control(
            'button_prev_hover_color',
            [
                'label' => __('Cor em Hover Text Prev', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .prev-bubble:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'prev_icon_type' => 'icon',
                ],
            ]
        );
        
        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background do botão', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ECECEC',
                'selectors' => [
                    '{{WRAPPER}} .next-bubble, {{WRAPPER}} .prev-bubble, {{WRAPPER}} .start-bubble' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __('Background do Hover do Botão', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#CECECE',
                'selectors' => [
                    '{{WRAPPER}} .next-bubble:hover, {{WRAPPER}} .prev-bubble:hover, {{WRAPPER}} .start-bubble:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_size',
            [
                'label' => __('Tamanho do Ícone do Botão (px)', 'text-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 24,
                'selectors' => [
                    '{{WRAPPER}} .next-bubble, {{WRAPPER}} .prev-bubble' => 'font-size: {{VALUE}}px;',
                ],
                'condition' => [
                    'prev_icon_type' => 'icon',
                    'next_icon_type' => 'icon',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => 'Borda',
                'selector' => '{{WRAPPER}} .next-bubble, {{WRAPPER}} .prev-bubble, {{WRAPPER}} .start-bubble',
                'default' => [ // <-- sem borda por padrão
                    'border' => '',
                ],
            ]
        );
        // Controle de raio da borda
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => 'Raio da Borda',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .next-bubble, {{WRAPPER}} .prev-bubble, {{WRAPPER}} .start-bubble' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => 'Espaçamento Interno (Padding)',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .next-bubble, {{WRAPPER}} .prev-bubble, {{WRAPPER}} .start-bubble' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_start_margin',
            [
                'label' => 'Margin Start',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .start-bubble' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => 'Margin Next e Prev',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .next-bubble, {{WRAPPER}} .prev-bubble' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        

        $this->end_controls_section();
    }
protected function render() {    
    $settings = $this->get_settings_for_display();
    $widget_id = $this->get_id();
    wp_localize_script(
        'chat-personagem-script',
        'chatPersonagemConfig',
        [
            'isDebugMode' => ($settings['debug_mode'] === 'true'),
            'widgetId' => $widget_id 
        ]
    );
    $baloes = $settings['chat_baloes'];
    
    $prev_icon = $settings['prev_icon']['value'] ?? '';
    $next_icon = $settings['next_icon']['value'] ?? '';
    $start_icon = $settings['start_icon']['value'] ?? '';

    $main_border_color = isset($settings['ballon_border_color']) ? $settings['ballon_border_color'] : '#ECECEC';
    $border_width_value = isset($settings['ballon_border_width']['size']) ? $settings['ballon_border_width']['size'] . $settings['ballon_border_width']['unit'] : '0px';

    $caret_fill_color = isset($settings['balloon_background_color']) ? $settings['balloon_background_color'] : '#ECECEC';
    $caret_border_color = isset($settings['ballon_border_color']) ? $settings['ballon_border_color'] : '#ECECEC';

    $output = '<div id="chat-container-' . $widget_id . '" class="chat-container">';
    $output .= '<div class="speech-bubbles">';

    foreach ($baloes as $index => $balão) {
        $chat_text = $balão['chat_text'];
        $caret_direction = $balão['caret_direction'];
        $caret_position = isset($balão['caret_position']['size']) ? $balão['caret_position']['size'] : 50;
        $bubble_margin = isset($balão['bubble_margin']) ? $balão['bubble_margin'] : ['top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'unit' => 'px'];

        $margin_style = 'margin-top: ' . esc_attr($bubble_margin['top']) . (isset($bubble_margin['unit']) ? esc_attr($bubble_margin['unit']) : 'px') . '; ';
        $margin_style .= 'margin-right: ' . esc_attr($bubble_margin['right']) . (isset($bubble_margin['unit']) ? esc_attr($bubble_margin['unit']) : 'px') . '; ';
        $margin_style .= 'margin-bottom: ' . esc_attr($bubble_margin['bottom']) . (isset($bubble_margin['unit']) ? esc_attr($bubble_margin['unit']) : 'px') . '; ';
        $margin_style .= 'margin-left: ' . esc_attr($bubble_margin['left']) . (isset($bubble_margin['unit']) ? esc_attr($bubble_margin['unit']) : 'px') . '; ';

        $balloon_border_style = '';
        if (isset($settings['ballon_border_border']) && !empty($settings['ballon_border_border'])) {
             $balloon_border_style .= 'border-style: ' . esc_attr($settings['ballon_border_border']) . ';';
        } else {
             $balloon_border_style .= 'border-style: solid;';
        }
        if (isset($settings['ballon_border_width']['size']) && !empty($settings['ballon_border_width']['size'])) {
            $balloon_border_style .= 'border-width: ' . esc_attr($settings['ballon_border_width']['size']) . esc_attr($settings['ballon_border_width']['unit']) . ';';
        } else {
            $balloon_border_style .= 'border-width: 0px;';
        }
        if (isset($settings['ballon_border_color']) && !empty($settings['ballon_border_color'])) {
            $balloon_border_style .= 'border-color: ' . esc_attr($settings['ballon_border_color']) . ';';
        } else {
            $balloon_border_style .= 'border-color: #ECECEC;';
        }

        $output .= '<div class="speech-bubble speech-bubble-' . $widget_id . '" style="' . $balloon_border_style . ' ' . $margin_style . ' display: ' . ($index === 0 ? 'block' : 'none') . ';">';
        $output .= '<div class="chat-text">' . wp_kses_post($chat_text) . '</div>';

        $caret_style = '';
        switch ($caret_direction) {
            case 'top':
                $caret_style = 'left: ' . esc_attr($caret_position) . '%; border-width: 0 15px 30px 15px; border-color: transparent transparent ' . esc_attr($caret_fill_color) . ' transparent; transform: translateX(-50%);';
                if ($border_width_value !== '0px') {
                    $caret_style .= 'outline: 1px solid ' . esc_attr($caret_border_color) . '; outline-offset: -' . $border_width_value . ';';
                }
                $output .= '<div class="caret top" style="' . $caret_style . '"></div>';
                break;
            case 'bottom':
                $caret_style = 'left: ' . esc_attr($caret_position) . '%; border-width: 30px 15px 0 15px; border-color: ' . esc_attr($caret_fill_color) . ' transparent transparent transparent; transform: translateX(-50%);';
                if ($border_width_value !== '0px') {
                    $caret_style .= 'outline: 1px solid ' . esc_attr($caret_border_color) . '; outline-offset: -' . $border_width_value . ';';
                }
                $output .= '<div class="caret bottom" style="' . $caret_style . '"></div>';
                break;
            case 'left':
                $caret_style = 'top: ' . esc_attr($caret_position) . '%; border-width: 15px 30px 15px 0; border-color: transparent ' . esc_attr($caret_fill_color) . ' transparent transparent; transform: translateY(-50%);';
                if ($border_width_value !== '0px') {
                    $caret_style .= 'outline: 1px solid ' . esc_attr($caret_border_color) . '; outline-offset: -' . $border_width_value . ';';
                }
                $output .= '<div class="caret left" style="' . $caret_style . '"></div>';
                break;
            case 'right':
                $caret_style = 'top: ' . esc_attr($caret_position) . '%; border-width: 15px 0 15px 30px; border-color: transparent transparent transparent ' . esc_attr($caret_fill_color) . '; transform: translateY(-50%);';
                if ($border_width_value !== '0px') {
                    $caret_style .= 'outline: 1px solid ' . esc_attr($caret_border_color) . '; outline-offset: -' . $border_width_value . ';';
                }
                $output .= '<div class="caret right" style="' . $caret_style . '"></div>';
                break;
        }
        $output .= '</div>';
    }

    $output .= '</div>';

    // Só renderiza os botões se houver mais de 1 balão
    if (count($baloes) > 1) {
        $output .= '<div class="button-container navigation-buttons" style="text-align: center; margin-top: 10px;">';

        // Botão Prev (sempre renderizado mas controlado via JS)
        $output .= '<div class="arrow-buttons-left" style="display: none; margin-right: 10px;">';
        if ($settings['prev_icon_type'] === 'icon') {
            $output .= '<button class="elementor-button elementor-button-link prev-bubble prev-bubble-' . $widget_id . '"><i class="' . esc_attr($prev_icon) . '"></i></button>';
        } elseif ($settings['prev_icon_type'] === 'image') {
            $output .= '<img src="' . esc_url($settings['prev_image']['url']) . '" alt="' . esc_attr__('Prev', 'text-domain') . '" class="prev-bubble prev-bubble-' . $widget_id . '" />';
        }
        $output .= '</div>';

        // Botão Start (só visível no primeiro balão)
        $output .= '<div class="start-button-wrapper" style="display: inline-block;">';
        if ($settings['start_icon_type'] === 'icon') {
            $output .= '<button class="elementor-button elementor-button-link start-bubble start-bubble-' . $widget_id . '" style="border: none;"><i class="' . esc_attr($start_icon) . '"></i></button>';
        } elseif ($settings['start_icon_type'] === 'image') {
            $output .= '<img src="' . esc_url($settings['start_image']['url']) . '" alt="' . esc_attr__('Start', 'text-domain') . '" class="start-bubble start-bubble-' . $widget_id . '" />';
        }
        $output .= '</div>';

        // Botão Next (sempre renderizado mas controlado via JS)
        $output .= '<div class="arrow-buttons-right" style="display: none; margin-left: 10px;">';
        if ($settings['next_icon_type'] === 'icon') {
            $output .= '<button class="elementor-button elementor-button-link next-bubble next-bubble-' . $widget_id . '"><i class="' . esc_attr($next_icon) . '"></i></button>';
        } elseif ($settings['next_icon_type'] === 'image') {
            $output .= '<img src="' . esc_url($settings['next_image']['url']) . '" alt="' . esc_attr__('Next', 'text-domain') . '" class="next-bubble next-bubble-' . $widget_id . '" />';
        }
        $output .= '</div>';

        $output .= '</div>';
    }

    $output .= '</div>';
    
    echo $output;
}
    


}
