<?php
class Elementor_Step_Click_Caroussel_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'step_click_caroussel_widget';
    }

    public function get_title() {
        return esc_html__('Step Click Carrossel', 'ead');
    }

    public function get_icon() {
        return 'eicon-slider-push';
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
            'item_title',
            [
                'label' => esc_html__('Título', 'ead'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Estágio', 'ead'),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'show_title_when_closed',
            [
                'label' => esc_html__('Mostrar título no card fechado', 'ead'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sim', 'ead'),
                'label_off' => esc_html__('Não', 'ead'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'item_content',
            [
                'label' => esc_html__('Conteúdo', 'ead'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Descrição do estágio', 'ead'),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => esc_html__('Ícone', 'ead'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-hand-pointer',
                    'library' => 'fa-regular',
                ],
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Itens', 'ead'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => esc_html__('Título 1', 'ead'),
                        'item_content' => esc_html__('Conteúdo do slide 1 vai aqui.', 'ead'),
                    ],
                    [
                        'item_title' => esc_html__('Título 2', 'ead'),
                        'item_content' => esc_html__('Conteúdo do slide 2 vai aqui.', 'ead'),
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
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
            'container_height',
            [
                'label' => esc_html__('Altura', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_width',
            [
                'label' => esc_html__('Largura', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 50,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 300,
                        'max' => 2000,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => esc_html__('Margem', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .step-click-caroussel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Estilo dos Itens
        $this->start_controls_section(
            'item_style',
            [
                'label' => esc_html__('Itens', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => esc_html__('Espaçamento', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel-item' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label' => esc_html__('Borda Arredondada', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                    'unit' => 'px',
                    'isLinked' => true, // Isso faz com que todos os lados sejam alterados juntos
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .step-click-caroussel-item',
            ]
        );

        $this->start_controls_tabs('item_tabs');

        $this->start_controls_tab(
            'item_normal_tab',
            [
                'label' => esc_html__('Normal', 'ead'),
            ]
        );

        $this->add_control(
            'item_bg_color',
            [
                'label' => esc_html__('Cor de Fundo', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#003366',
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel-item:not(.active)' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_text_color',
            [
                'label' => esc_html__('Cor do Texto', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel-item:not(.active)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'item_active_tab',
            [
                'label' => esc_html__('Ativo', 'ead'),
            ]
        );

        $this->add_control(
            'item_active_bg_color',
            [
                'label' => esc_html__('Cor de Fundo', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel-item.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_active_text_color',
            [
                'label' => esc_html__('Cor do Texto', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel-item.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // Estilo do Conteúdo
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Conteúdo', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_align',
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
                    '{{WRAPPER}} .step-click-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .step-click-content',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Espaçamento Interno', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .step-click-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        
        // Estilo do Título no Card Fechado
        $this->start_controls_section(
            'closed_title_style',
            [
                'label' => esc_html__('Título (Card Fechado)', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'closed_title_color',
            [
                'label' => esc_html__('Cor do Texto', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .step-click-title-closed' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'closed_title_typography',
                'label' => esc_html__('Tipografia', 'ead'),
                'selector' => '{{WRAPPER}} .step-click-title-closed h3',
            ]
        );
        
        $this->add_responsive_control(
            'closed_title_spacing',
            [
                'label' => esc_html__('Espaçamento', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .step-click-title-closed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'closed_title_margin_bottom',
            [
                'label' => esc_html__('Margem Inferior', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-click-title-closed' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Estilo do Título no Card Ativo
        $this->start_controls_section(
            'active_title_style',
            [
                'label' => esc_html__('Título (Card Ativo)', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'active_title_color',
            [
                'label' => esc_html__('Cor do Texto', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel-item.active .step-click-content h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'active_title_typography',
                'label' => esc_html__('Tipografia', 'ead'),
                'selector' => '{{WRAPPER}} .step-click-caroussel-item.active .step-click-content h3',
            ]
        );
        
        $this->add_responsive_control(
            'active_title_spacing',
            [
                'label' => esc_html__('Espaçamento', 'ead'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .step-click-caroussel-item.active .step-click-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'active_title_align',
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
                    '{{WRAPPER}} .step-click-caroussel-item.active .step-click-content h3' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        // Estilo do Ícone
        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__('Ícone', 'ead'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Cor', 'ead'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .step-click-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Tamanho', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-click-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_bottom_spacing',
            [
                'label' => esc_html__('Distância do Fundo', 'ead'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-click-icon' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = 'step-click-caroussel-' . $this->get_id();
        ?>
        <div class="step-click-caroussel" id="<?php echo esc_attr($id); ?>">
            <?php foreach ($settings['items'] as $index => $item) : ?>
                <div class="step-click-caroussel-item<?php echo $index === 0 ? ' active' : ''; ?><?php echo 'yes' === $item['show_title_when_closed'] ? ' show-title-closed' : ''; ?>" data-index="<?php echo esc_attr($index); ?>">
                    <?php if ('yes' === $item['show_title_when_closed'] && !empty($item['item_title'])) : ?>
                        <div class="step-click-title-closed">
                            <h3><?php echo esc_html($item['item_title']); ?></h3>
                        </div>
                    <?php endif; ?>
                    <div class="step-click-content">
                        <?php if (!empty($item['item_title'])) : ?>
                            <h3><?php echo esc_html($item['item_title']); ?></h3>
                        <?php endif; ?>
                        <?php echo wp_kses_post($item['item_content']); ?>
                    </div>
                    <div class="step-click-icon">
                        <?php \Elementor\Icons_Manager::render_icon($item['item_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}