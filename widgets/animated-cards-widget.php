<?php
class Elementor_Animated_Cards_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'animated_cards_widget';
    }

    public function get_title() {
        return esc_html__('Animated Cards', 'ead');
    }

    public function get_icon() {
        return 'eicon-flip-box';
    }

    public function get_categories() {
        return ['ead'];
    }

    protected function _register_controls() {
        // Conteúdo
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Conteúdo', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Título', 'ead'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('OBJETIVO', 'ead'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__('Conteúdo', 'ead'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Descrição do objetivo', 'ead'),
            ]
        );

        $repeater->add_control(
            'show_divider',
            [
                'label' => esc_html__('Mostrar divisor', 'ead'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sim', 'ead'),
                'label_off' => esc_html__('Não', 'ead'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'use_image',
            [
                'label' => esc_html__('Usar imagem', 'ead'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sim', 'ead'),
                'label_off' => esc_html__('Não', 'ead'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Imagem', 'ead'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'use_image' => 'yes',
                ],
            ]
        );
        
        $repeater->add_control(
            'image_position',
            [
                'label'   => esc_html__('Posição da imagem', 'ead'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'   => esc_html__('Esquerda', 'ead'),
                    'right'  => esc_html__('Direita', 'ead'),
                ],
                'condition' => ['use_image' => 'yes'],
            ]
        );
        
        $repeater->add_control(
            'image_width',
            [
                'label' => esc_html__('Tamanho da imagem (%)', 'ead'),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => ['%' => ['min' => 10, 'max' => 100]],
                'default' => ['unit' => '%', 'size' => 100], // <-- de 30 para 100
                'condition' => ['use_image' => 'yes'],
            ]
        );
        

        $this->add_control(
            'cards',
            [
                'label' => esc_html__('Cards', 'ead'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'OBJETIVO 1',
                        'content' => '<b>ENTENDER</b> como atuar no controle de vetores e roedores no seu dia a dia de trabalho.',
                        'show_divider' => 'yes',
                    ],
                    [
                        'title' => 'OBJETIVO 2',
                        'content' => '<b>REFLETIR</b> sobre os impactos dos vetores e roedores na saúde da população.',
                        'show_divider' => 'yes',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'nav_section',
            [
                'label' => esc_html__('Navegação', 'ead'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'nav_layout',
            [
                'label'   => esc_html__('Posicionamento dos botões', 'ead'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'bottom' => esc_html__('Abaixo (padrão)', 'ead'),
                    'sides'  => esc_html__('Nas laterais (centralizado)', 'ead'),
                ],
            ]
        );
        
        $this->add_control(
            'prev_icon',
            [
                'label'   => esc_html__('Ícone Voltar', 'ead'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'eicon-chevron-left',
                    'library' => 'elementor',
                ],
            ]
        );
        
        $this->add_control(
            'next_icon',
            [
                'label'   => esc_html__('Ícone Avançar', 'ead'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'eicon-chevron-right',
                    'library' => 'elementor',
                ],
            ]
        );
        
        $this->end_controls_section();

        // Estilo do Container
        $this->start_controls_section(
            'container_style',
            [
                'label' => esc_html__('Container', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => esc_html__('Margem', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-cards-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__('Espaçamento Interno', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-cards-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Estilo dos Cards
        $this->start_controls_section(
            'card_style',
            [
                'label' => esc_html__('Cards', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
    'stack_padding_top',
    [
        'label' => esc_html__('Espaço superior da pilha', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [ 'px' => ['min' => 0, 'max' => 200] ],
        'default' => ['unit' => 'px', 'size' => 70],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-cards-list' => '--stack-offset: {{SIZE}}{{UNIT}};',
        ],
    ]
);
        


        $this->add_responsive_control(
    'card_width',
    [
        'label' => esc_html__('Largura', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%', 'vw'],
        'range' => [
            'px' => ['min' => 200, 'max' => 1000, 'step' => 5],
            '%'  => ['min' => 10,  'max' => 100],
            'vw' => ['min' => 10,  'max' => 100],
        ],
        'default' => ['unit' => '%', 'size' => 100],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-cards-list > .ead-animated-card' => 'width: {{SIZE}}{{UNIT}};',
        ],
    ]
);

       $this->add_responsive_control(
    'card_height',
    [
        'label' => esc_html__('Altura', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'vh'],
        'range' => [
            'px' => ['min' => 100, 'max' => 1000, 'step' => 10],
            'vh' => ['min' => 10,  'max' => 100],
        ],
        'default' => ['unit' => 'px', 'size' => 300],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-cards-list > .ead-animated-card' => 'height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

        $this->add_responsive_control(
            'card_border_radius',
            [
                'label' => esc_html__('Borda Arredondada', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 30,
                    'right' => 30,
                    'bottom' => 30,
                    'left' => 30,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'selector' => '{{WRAPPER}} .ead-animated-card',
            ]
        );

        $this->start_controls_tabs('card_states');

        $this->start_controls_tab(
            'card_current',
            [
                'label' => esc_html__('Ativo', 'ead'),
            ]
        );

        $this->add_responsive_control(
            'card_current_bg',
            [
                'label' => esc_html__('Cor de Fundo', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fbfefe',
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card--current' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'card_next',
            [
                'label' => esc_html__('Próximo', 'ead'),
            ]
        );

        $this->add_responsive_control(
            'card_next_bg',
            [
                'label' => esc_html__('Cor de Fundo', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#CFCFCF',
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card--next' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'card_out',
            [
                'label' => esc_html__('Inativo', 'ead'),
            ]
        );

        $this->add_responsive_control(
            'card_out_bg',
            [
                'label' => esc_html__('Cor de Fundo', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#9D9D9D',
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card--out' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // Estilo do Título
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Título', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_color',
            [
                'label' => esc_html__('Cor', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2A2A2A',
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .ead-animated-card-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margem', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Espaçamento', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_align',
            [
                'label' => esc_html__('Alinhamento', 'ead'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Esquerda', 'ead'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Centro', 'ead'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Direita', 'ead'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Estilo do Conteúdo
        $this->start_controls_section(
            'content_text_style',
            [
                'label' => esc_html__('Conteúdo', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_color',
            [
                'label' => esc_html__('Cor', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2A2A2A',
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'content_align',
            [
                'label' => esc_html__('Alinhamento do conteúdo', 'ead'),
                'type'  => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => ['title' => esc_html__('Esquerda','ead'), 'icon' => 'eicon-text-align-left'],
                    'center' => ['title' => esc_html__('Centro','ead'),   'icon' => 'eicon-text-align-center'],
                    'right'  => ['title' => esc_html__('Direita','ead'),  'icon' => 'eicon-text-align-right'],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .ead-animated-card-content',
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__('Margem', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Espaçamento', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // === Divisor ===
$this->start_controls_section(
    'divider_style',
    [
        'label' => esc_html__('Divisor', 'ead'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

// alinhamento horizontal (classe no wrapper)
$this->add_control(
    'divider_align',
    [
        'label'        => esc_html__('Alinhamento', 'ead'),
        'type'         => \Elementor\Controls_Manager::CHOOSE,
        'options'      => [
            'left'   => ['title' => esc_html__('Esquerda','ead'), 'icon' => 'eicon-h-align-left'],
            'center' => ['title' => esc_html__('Centro','ead'),   'icon' => 'eicon-h-align-center'],
            'right'  => ['title' => esc_html__('Direita','ead'),  'icon' => 'eicon-h-align-right'],
        ],
        'default'      => 'center',
        'prefix_class' => 'ead-divider-align-', // -> ead-divider-align-left|center|right
    ]
);

$this->add_responsive_control(
    'divider_color',
    [
        'label' => esc_html__('Cor', 'ead'),
        'type'  => \Elementor\Controls_Manager::COLOR,
        'default' => '#2A2A2A',
        'selectors' => [
            '{{WRAPPER}} .ead-animated-card-divider' => 'border-top-color: {{VALUE}};',
        ],
    ]
);

$this->add_responsive_control(
    'divider_width',
    [
        'label' => esc_html__('Largura', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
            'px' => ['min' => 1, 'max' => 1000],
            '%'  => ['min' => 1, 'max' => 100],
        ],
        'default' => ['unit' => '%', 'size' => 25],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-card-divider' => 'width: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'divider_thickness',
    [
        'label' => esc_html__('Espessura', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [ 'px' => ['min' => 1, 'max' => 10] ],
        'default' => ['unit' => 'px', 'size' => 4],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-card-divider' => 'border-top-width: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'divider_style_type',
    [
        'label' => esc_html__('Estilo', 'ead'),
        'type'  => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'solid'  => esc_html__('Contínuo', 'ead'),
            'dotted' => esc_html__('Pontilhado', 'ead'),
            'dashed' => esc_html__('Tracejado', 'ead'),
            'double' => esc_html__('Duplo', 'ead'),
        ],
        'default' => 'dotted',
        'selectors' => [
            '{{WRAPPER}} .ead-animated-card-divider' => 'border-top-style: {{VALUE}};',
        ],
    ]
);

// >>> só TOP e BOTTOM (não mexemos em left/right)
$this->add_responsive_control(
    'divider_spacing_top',
    [
        'label' => esc_html__('Espaço acima', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px','em','rem'],
        'range' => [
            'px'  => ['min' => 0, 'max' => 200],
            'em'  => ['min' => 0, 'max' => 10, 'step' => 0.1],
            'rem' => ['min' => 0, 'max' => 10, 'step' => 0.1],
        ],
        'default' => ['unit' => 'px', 'size' => 24],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-card-divider' => 'margin-top: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'divider_spacing_bottom',
    [
        'label' => esc_html__('Espaço abaixo', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px','em','rem'],
        'range' => [
            'px'  => ['min' => 0, 'max' => 200],
            'em'  => ['min' => 0, 'max' => 10, 'step' => 0.1],
            'rem' => ['min' => 0, 'max' => 10, 'step' => 0.1],
        ],
        'default' => ['unit' => 'px', 'size' => 24],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-card-divider' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();



        // Estilo dos Botões
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Botões', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Tamanho do ícone', 'ead'),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [ 'px' => ['min' => 8, 'max' => 120] ],
                'default' => ['unit' => 'px', 'size' => 24],
                'selectors' => [
                    // define uma CSS var consumida no CSS
                    '{{WRAPPER}} .ead-animated-cards-nav' => '--icon-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_color',
            [
                'label' => esc_html__('Cor', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2A2A2A',
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-cards-nav-button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ead-animated-cards-nav-button svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_bg_color',
            [
                'label' => esc_html__('Cor de Fundo', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fbfefe',
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-cards-nav-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding do botão', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px','%','em'],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-cards-nav-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; box-sizing: border-box;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Margem do botão', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px','%','em'],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-cards-nav-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // BOTÕES EMBAIXO: controla o espaço acima dos botões
$this->add_responsive_control(
    'nav_bottom_offset',
    [
        'label' => esc_html__('Espaço acima dos botões (embaixo)', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [ 'px' => ['min' => 0, 'max' => 200] ],
        'default' => ['unit' => 'px', 'size' => 20],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-cards-nav.ead-nav--bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [ 'nav_layout' => 'bottom' ],
    ]
);


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .ead-animated-cards-nav-button',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__('Borda Arredondada', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-cards-nav-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .ead-animated-cards-nav-button',
            ]
        );

        $this->add_responsive_control(
            'button_spacing',
            [
                'label' => esc_html__('Espaçamento', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ead-animated-cards-nav.ead-nav--bottom' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
    $settings = $this->get_settings_for_display();
    $id = 'ead-animated-cards-' . $this->get_id();

    // Layout da navegação
    $nav_layout = ! empty( $settings['nav_layout'] ) ? $settings['nav_layout'] : 'bottom';
    $nav_class  = 'ead-animated-cards-nav ead-nav--' . esc_attr( $nav_layout );

    // ===== Alinhamento dos cards (novo) =====
    $cards_align = ! empty( $settings['cards_align'] ) ? $settings['cards_align'] : 'center'; // left|center|right
    $align_class = ' ead-align-' . esc_attr( $cards_align );

    // Classe do wrapper
    $wrapper_classes = 'ead-animated-cards-wrapper' . $align_class;
    if ( $nav_layout === 'sides' ) {
        $wrapper_classes .= ' ead-has-sides-nav';
    }
    ?>
    <div class="<?php echo esc_attr( $wrapper_classes ); ?>">
        <ul class="ead-animated-cards-list" id="<?php echo esc_attr( $id ); ?>"></ul>

        <div class="<?php echo esc_attr( $nav_class ); ?>">
            <button class="ead-animated-cards-nav-button ead-animated-cards-prev hidden" aria-label="<?php esc_attr_e('Anterior','ead'); ?>">
                <?php
                if ( ! empty( $settings['prev_icon']['value'] ) ) {
                    \Elementor\Icons_Manager::render_icon( $settings['prev_icon'], [ 'aria-hidden' => 'true' ] );
                } else {
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>';
                }
                ?>
            </button>

            <button class="ead-animated-cards-nav-button ead-animated-cards-next" aria-label="<?php esc_attr_e('Próximo','ead'); ?>">
                <?php
                if ( ! empty( $settings['next_icon']['value'] ) ) {
                    \Elementor\Icons_Manager::render_icon( $settings['next_icon'], [ 'aria-hidden' => 'true' ] );
                } else {
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>';
                }
                ?>
            </button>
        </div>

        <script type="application/json" class="ead-animated-cards-data">
            <?php echo wp_json_encode( $settings['cards'] ); ?>
        </script>
    </div>
    <?php
}

    protected function content_template() {
    ?>
    <div class="ead-animated-cards-wrapper
                {{ (settings.nav_layout && settings.nav_layout === 'sides') ? 'ead-has-sides-nav' : '' }}
                {{ settings.cards_align ? ' ead-align-' + settings.cards_align : ' ead-align-center' }}">
        <ul class="ead-animated-cards-list" id="ead-animated-cards-{{ view.cid }}"></ul>

        <div class="ead-animated-cards-nav ead-nav--{{ settings.nav_layout ? settings.nav_layout : 'bottom' }}">
            <button class="ead-animated-cards-nav-button ead-animated-cards-prev hidden" aria-label="<?php esc_attr_e('Anterior','ead'); ?>">
                <#
                var prevIconStr = '';
                if ( elementor.helpers && elementor.helpers.renderIcon ) {
                    var _p = elementor.helpers.renderIcon( view, settings.prev_icon, { 'aria-hidden': true }, 'i', 'value' );
                    if ( typeof _p === 'string' ) { prevIconStr = _p; }
                    else if ( _p && typeof _p.value === 'string' ) { prevIconStr = _p.value; }
                }
                if ( ! prevIconStr && settings.prev_icon && settings.prev_icon.value ) {
                    prevIconStr = '<i class="' + settings.prev_icon.value + '" aria-hidden="true"></i>';
                }
                #>
                {{{ prevIconStr || '<i class="eicon-chevron-left" aria-hidden="true"></i>' }}}
            </button>

            <button class="ead-animated-cards-nav-button ead-animated-cards-next" aria-label="<?php esc_attr_e('Próximo','ead'); ?>">
                <#
                var nextIconStr = '';
                if ( elementor.helpers && elementor.helpers.renderIcon ) {
                    var _n = elementor.helpers.renderIcon( view, settings.next_icon, { 'aria-hidden': true }, 'i', 'value' );
                    if ( typeof _n === 'string' ) { nextIconStr = _n; }
                    else if ( _n && typeof _n.value === 'string' ) { nextIconStr = _n.value; }
                }
                if ( ! nextIconStr && settings.next_icon && settings.next_icon.value ) {
                    nextIconStr = '<i class="' + settings.next_icon.value + '" aria-hidden="true"></i>';
                }
                #>
                {{{ nextIconStr || '<i class="eicon-chevron-right" aria-hidden="true"></i>' }}}
            </button>
        </div>

        <script type="application/json" class="ead-animated-cards-data">
            {{{ JSON.stringify( settings.cards || [] ) }}}
        </script>
    </div>
    <?php
}




}