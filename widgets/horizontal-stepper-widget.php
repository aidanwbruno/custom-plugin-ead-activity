<?php
class Elementor_Horizontal_Stepper_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'horizontal_stepper';
    }

    public function get_title() {
        return __('Horizontal Stepper', 'ead');
    }

    public function get_icon() {
        return 'eicon-navigation-horizontal';
    }

    public function get_categories() {
        return ['ead'];
    }

    protected function _register_controls() {
        // Seção de Conteúdo
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Conteúdo', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // Controles para o bullet
        $repeater->add_control(
            'bullet_type',
            [
                'label' => __('Tipo de Bullet', 'ead'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'text' => __('Texto', 'ead'),
                    'icon' => __('Ícone', 'ead'),
                    'image' => __('Imagem', 'ead'),
                ],
            ]
        );

        $repeater->add_control(
            'bullet_text',
            [
                'label' => __('Texto do Bullet', 'ead'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('1', 'ead'),
                'condition' => [
                    'bullet_type' => 'text',
                ],
            ]
        );

        $repeater->add_control(
            'bullet_icon',
            [
                'label' => __('Ícone do Bullet', 'ead'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'bullet_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'bullet_image',
            [
                'label' => __('Imagem do Bullet', 'ead'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'bullet_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'step_title',
            [
                'label' => __('Título do Passo', 'ead'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Novo Passo', 'ead'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'step_content',
            [
                'label' => __('Conteúdo', 'ead'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Conteúdo do passo aqui...', 'ead'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'steps',
            [
                'label' => __('Passos', 'ead'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bullet_type' => 'text',
                        'bullet_text' => __('1', 'ead'),
                        'step_title' => __('Introdução', 'ead'),
                        'step_content' => __('<h3>Bem-vindo!</h3><p>Este é o primeiro passo do nosso guia.</p>', 'ead'),
                    ],
                    [
                        'bullet_type' => 'icon',
                        'bullet_icon' => [
                            'value' => 'fas fa-cog',
                            'library' => 'fa-solid',
                        ],
                        'step_title' => __('Configurações', 'ead'),
                        'step_content' => __('<h3>Personalize sua experiência</h3><p>Aqui você pode ajustar as configurações.</p>', 'ead'),
                    ],
                    [
                        'bullet_type' => 'image',
                        'bullet_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'step_title' => __('Conclusão', 'ead'),
                        'step_content' => __('<h3>Tudo pronto!</h3><p>Você completou todos os passos.</p>', 'ead'),
                    ],
                ],
                'title_field' => '{{{ step_title }}}',
            ]
        );

        $this->end_controls_section();

        // Seção de Configurações
        $this->start_controls_section(
            'settings_section',
            [
                'label' => __('Configurações', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => __('Mostrar Setas de Navegação', 'ead'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sim', 'ead'),
                'label_off' => __('Não', 'ead'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'prev_arrow_icon',
            [
                'label' => __('Ícone Seta Anterior', 'ead'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'next_arrow_icon',
            [
                'label' => __('Ícone Seta Próxima', 'ead'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Container
        $this->start_controls_section(
            'style_container_section',
            [
                'label' => __('Container', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'container_background',
            [
                'label' => __('Cor de Fundo', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stepper' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .stepper',
            ]
        );

        $this->add_control(
            'container_border_radius',
            [
                'label' => __('Raio da Borda', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .stepper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'selector' => '{{WRAPPER}} .stepper',
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => __('Espaçamento Interno', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .stepper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Passos
        $this->start_controls_section(
            'style_steps_section',
            [
                'label' => __('Passos', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'step_bullet_size',
            [
                'label' => __('Tamanho do Bullet', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 32,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'step_bullet_inactive_color',
            [
                'label' => __('Cor do Bullet (Inativo)', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#d1d5db',
                'selectors' => [
                    '{{WRAPPER}} .step-bullet' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'step_bullet_active_color',
            [
                'label' => __('Cor do Bullet (Ativo)', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3b82f6',
                'selectors' => [
                    '{{WRAPPER}} .step.active .step-bullet' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        // Controles específicos para texto no bullet
        $this->add_control(
            'bullet_text_color',
            [
                'label' => __('Cor do Texto do Bullet (Inativo)', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#374151',
                'selectors' => [
                    '{{WRAPPER}} .step-bullet' => 'color: {{VALUE}};',
                ],
            ]
        );
        
         $this->add_control(
            'bullet_text_active_color',
            [
                'label' => __('Cor do Texto do Bullet (Ativo)', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .step.active .step-bullet' => 'color: {{VALUE}};',
                ],
            ]
        );
        

        $this->add_control(
            'step_text_inactive_color',
            [
                'label' => __('Cor do Título do bullet (Inativo)', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#374151',
                'selectors' => [
                    '{{WRAPPER}} .step-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'step_text_active_color',
            [
                'label' => __('Cor do Título do bullet (Ativo)', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3b82f6',
                'selectors' => [
                    '{{WRAPPER}} .step.active .step-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'bullet_icon_color',
            [
                'label' => __('Cor do Ícone do Bullet (Inativo)', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#374151',
                'selectors' => [
                    '{{WRAPPER}} .step-bullet i' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'bullet_icon_active_color',
            [
                'label' => __('Cor do Ícone do Bullet (Ativo)', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .step.active .step-bullet i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .step.active .step-bullet svg' => 'fill: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Tipografia texto Bullet', 'ead'),
                'name' => 'step_bullet_typography',
                'selector' => '{{WRAPPER}} .step-bullet',
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Tipografia Título Bullet', 'ead'),
                'name' => 'step_text_typography',
                'selector' => '{{WRAPPER}} .step-text',
            ]
        );

        // Controles específicos para ícone no bullet
        
        $this->add_control(
            'bullet_icon_size',
            [
                'label' => __('Tamanho do Ícone do Bullet', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 60,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-bullet i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Controles específicos para imagem no bullet
        $this->add_control(
            'bullet_image_size',
            [
                'label' => __('Tamanho da Imagem do Bullet', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 32,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-bullet img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bullet_image_border_radius',
            [
                'label' => __('Raio da Borda da Imagem', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-bullet img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        

        

        $this->add_control(
            'step_text_spacing',
            [
                'label' => __('Espaçamento do Texto', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-text' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'steps_container_padding',
            [
                'label' => __('Espaçamento do Container', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .steps-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'right' => '10',
                    'bottom' => '0',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_responsive_control(
            'steps_gap',
            [
                'label' => __('Espaço Entre Passos', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-container' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Linha de Progresso
        $this->start_controls_section(
            'style_progress_line_section',
            [
                'label' => __('Linha de Progresso', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'progress_line_active_color',
            [
                'label' => __('Cor da Linha de Progresso', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3b82f6',
                'selectors' => [
                    '{{WRAPPER}} #progress-line' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Setas
        $this->start_controls_section(
            'style_arrows_section',
            [
                'label' => __('Setas de Navegação', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_size',
            [
                'label' => __('Tamanho', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .nav-arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nav-arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Cor', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3b82f6',
                'selectors' => [
                    '{{WRAPPER}} .nav-arrow' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Cor (Hover)', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2563eb',
                'selectors' => [
                    '{{WRAPPER}} .nav-arrow:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_disabled_color',
            [
                'label' => __('Cor (Desabilitado)', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#d1d5db',
                'selectors' => [
                    '{{WRAPPER}} .nav-arrow.disabled' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_spacing',
            [
                'label' => __('Espaçamento', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .stepper-container' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Conteúdo
        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __('Conteúdo', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_text_align',
            [
                'label' => __('Alinhamento do Texto', 'ead'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Esquerda', 'ead'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Centro', 'ead'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Direita', 'ead'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justificado', 'ead'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_background',
            [
                'label' => __('Cor de Fundo do Conteúdo', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Espaçamento Interno do Conteúdo', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '20',
                    'right' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_control(
            'content_spacing',
            [
                'label' => __('Espaçamento Superior', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .content' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'content_border_radius',
            [
                'label' => __('Raio da Borda do Fundo', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .content',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __('Cor do Texto', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#374151',
                'selectors' => [
                    '{{WRAPPER}} .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $steps = $settings['steps'];
        $show_arrows = $settings['show_arrows'] === 'yes';

        // Forçar ícones padrão se estiverem vazios
        $prev_arrow_icon = !empty($settings['prev_arrow_icon']) ? $settings['prev_arrow_icon'] : [
            'value' => 'fas fa-arrow-left',
            'library' => 'fa-solid',
        ];
    
        $next_arrow_icon = !empty($settings['next_arrow_icon']) ? $settings['next_arrow_icon'] : [
            'value' => 'fas fa-arrow-right',
            'library' => 'fa-solid',
        ];
        ?>
        
        <div class="stepper-container">
            <?php if ($show_arrows) : ?>
                <span class="nav-arrow" id="prev-arrow">
                    <?php \Elementor\Icons_Manager::render_icon($prev_arrow_icon, ['aria-hidden' => 'true']); ?>
                </span>
            <?php endif; ?>

            <div class="stepper">
                <div class="steps-container">
                    <div id="progress-line"></div>
                    <?php foreach ($steps as $index => $step) : 
                        $bullet_type = isset($step['bullet_type']) ? $step['bullet_type'] : 'text';
                        $bullet_content = '';
                        
                        switch ($bullet_type) {
                            case 'icon':
                                if (!empty($step['bullet_icon']['value'])) {
                                    ob_start();
                                    \Elementor\Icons_Manager::render_icon($step['bullet_icon'], ['aria-hidden' => 'true']);
                                    $bullet_content = ob_get_clean();
                                }
                                break;
                            case 'image':
                                if (!empty($step['bullet_image']['url'])) {
                                    $bullet_content = '<img src="' . esc_url($step['bullet_image']['url']) . '" alt="' . esc_attr($step['step_title']) . '">';
                                }
                                break;
                            case 'text':
                            default:
                                $bullet_content = isset($step['bullet_text']) ? esc_html($step['bullet_text']) : ($index + 1);
                                break;
                        }
                    ?>
                        <div class="step <?php echo $index === 0 ? 'active' : ''; ?>" data-step="<?php echo $index + 1; ?>">
                            <div class="step-bullet <?php echo $bullet_type === 'image' ? 'image-bullet' : ''; ?>" data-bullet-type="<?php echo esc_attr($bullet_type); ?>">
    <?php echo $bullet_content; ?>
</div>
                            <div class="step-text"><?php echo esc_html($step['step_title']); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="content">
                    <?php foreach ($steps as $index => $step) : ?>
                        <div id="content-<?php echo $index + 1; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>">
                            <?php echo wp_kses_post($step['step_content']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if ($show_arrows) : ?>
                <span class="nav-arrow" id="next-arrow">
                    <?php \Elementor\Icons_Manager::render_icon($next_arrow_icon, ['aria-hidden' => 'true']); ?>
                </span>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var prevIconHTML = elementor.helpers.renderIcon(
            view,
            settings.prev_arrow_icon.value ? settings.prev_arrow_icon : { value: 'fas fa-arrow-left', library: 'fa-solid' },
            { 'aria-hidden': true },
            'i',
            'object'
        );
        var nextIconHTML = elementor.helpers.renderIcon(
            view,
            settings.next_arrow_icon.value ? settings.next_arrow_icon : { value: 'fas fa-arrow-right', library: 'fa-solid' },
            { 'aria-hidden': true },
            'i',
            'object'
        );
        #>
        
        <div class="stepper-container">
            <# if (settings.show_arrows === 'yes') { #>
                <span class="nav-arrow" id="prev-arrow">
                    {{{ prevIconHTML.value }}}
                </span>
            <# } #>

            <div class="stepper">
                <div class="steps-container">
                    <div id="progress-line"></div>
                    <# _.each(settings.steps, function(step, index) { 
                        var bulletContent = '';
                        var bulletType = step.bullet_type || 'text';
                        
                        switch(bulletType) {
                            case 'icon':
                                if (step.bullet_icon && step.bullet_icon.value) {
                                    var iconHTML = elementor.helpers.renderIcon(
                                        view,
                                        step.bullet_icon,
                                        { 'aria-hidden': true },
                                        'i',
                                        'object'
                                    );
                                    bulletContent = iconHTML.value;
                                }
                                break;
                            case 'image':
                                if (step.bullet_image && step.bullet_image.url) {
                                    bulletContent = '<img src="' + step.bullet_image.url + '" alt="' + step.step_title + '">';
                                }
                                break;
                            case 'text':
                            default:
                                bulletContent = step.bullet_text ? step.bullet_text : (index + 1);
                                break;
                        }
                    #>
                        <div class="step <# if (index === 0) { #>active<# } #>" data-step="{{ index + 1 }}">
                            <div class="step-bullet">{{{ bulletContent }}}</div>
                            <div class="step-text">{{ step.step_title }}</div>
                        </div>
                    <# }); #>
                </div>

                <div class="content">
                    <# _.each(settings.steps, function(step, index) { #>
                        <div id="content-{{ index + 1 }}" class="<# if (index === 0) { #>active<# } #>">
                            {{{ step.step_content }}}
                        </div>
                    <# }); #>
                </div>
            </div>

            <# if (settings.show_arrows === 'yes') { #>
                <span class="nav-arrow" id="next-arrow">
                    {{{ nextIconHTML.value }}}
                </span>
            <# } #>
        </div>
        <?php
    }
}