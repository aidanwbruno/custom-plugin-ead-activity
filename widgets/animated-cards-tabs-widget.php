<?php
if (!defined('ABSPATH')) exit;

class Elementor_Animated_Cards_Tabs_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'animated_cards_tabs_widget';
    }

    public function get_title() {
        return esc_html__('Animated Cards (Tabs)', 'ead');
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return ['ead'];
    }

    protected function _register_controls() {

        /* ---------- CONTEÚDO ---------- */
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Conteúdo', 'ead'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $rep = new \Elementor\Repeater();

        $rep->add_control('title', [
            'label'       => esc_html__('Título da aba', 'ead'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__('Item', 'ead'),
            'label_block' => true,
        ]);

        $rep->add_control('content', [
            'label'   => esc_html__('Conteúdo', 'ead'),
            'type'    => \Elementor\Controls_Manager::WYSIWYG,
            'default' => esc_html__('Descrição do item', 'ead'),
        ]);

        $rep->add_control('show_divider', [
            'label'        => esc_html__('Mostrar divisor', 'ead'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Sim', 'ead'),
            'label_off'    => esc_html__('Não', 'ead'),
            'return_value' => 'yes',
            'default'      => 'no',
        ]);

        $rep->add_control('use_image', [
            'label'        => esc_html__('Usar imagem', 'ead'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Sim', 'ead'),
            'label_off'    => esc_html__('Não', 'ead'),
            'return_value' => 'yes',
            'default'      => 'no',
        ]);

        $rep->add_control('image', [
            'label'     => esc_html__('Imagem', 'ead'),
            'type'      => \Elementor\Controls_Manager::MEDIA,
            'default'   => ['url' => \Elementor\Utils::get_placeholder_image_src()],
            'condition' => ['use_image' => 'yes'],
        ]);

        $rep->add_control('image_position', [
            'label'     => esc_html__('Posição da imagem', 'ead'),
            'type'      => \Elementor\Controls_Manager::SELECT,
            'default'   => 'left',
            'options'   => [
                'left'  => esc_html__('Esquerda', 'ead'),
                'right' => esc_html__('Direita', 'ead'),
            ],
            'condition' => ['use_image' => 'yes'],
        ]);


        $rep->add_control('image_radius', [
            'label'      => esc_html__('Radius da imagem', 'ead'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px','%'],
            'default'    => ['top'=>16,'right'=>16,'bottom'=>16,'left'=>16,'unit'=>'px','isLinked'=>true],
            'condition'  => ['use_image' => 'yes'],
        ]);

        $this->add_control('items', [
            'label'       => esc_html__('Abas', 'ead'),
            'type'        => \Elementor\Controls_Manager::REPEATER,
            'fields'      => $rep->get_controls(),
            'default'     => [
                ['title' => 'CARD 1', 'content' => 'Conteúdo 1', 'show_divider'=>'yes'],
                ['title' => 'CARD 2', 'content' => 'Conteúdo 2'],
                ['title' => 'CARD 3', 'content' => 'Conteúdo 3'],
            ],
            'title_field' => '{{{ title }}}',
        ]);

        $this->end_controls_section();

        /* ---------- ESTILO: ABAS ---------- */
        $this->start_controls_section('tabs_style', [
            'label' => esc_html__('Abas', 'ead'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('tabs_align', [
            'label'   => esc_html__('Alinhamento', 'ead'),
            'type'    => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left'   => ['title'=>esc_html__('Esq.','ead'),'icon'=>'eicon-h-align-left'],
                'center' => ['title'=>esc_html__('Centro','ead'),'icon'=>'eicon-h-align-center'],
                'right'  => ['title'=>esc_html__('Dir.','ead'),'icon'=>'eicon-h-align-right'],
            ],
            'default' => 'left',
            'selectors' => [
                '{{WRAPPER}} .ead-animated-tabs-nav' => 'justify-content: {{VALUE}};',
            ],
        ]);

        $this->add_control('tab_bg', [
            'label' => esc_html__('Fundo da aba', 'ead'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'default' => '#F3F4F6',
            'selectors' => [
                '{{WRAPPER}} .ead-animated-tab' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('tab_color', [
            'label' => esc_html__('Texto da aba', 'ead'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'default' => '#111827',
            'selectors' => [
                '{{WRAPPER}} .ead-animated-tab' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('tab_active_bg', [
            'label' => esc_html__('Fundo da aba ativa', 'ead'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'default' => '#0394F7',
            'selectors' => [
                '{{WRAPPER}} .ead-animated-tab.is-active' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('tab_active_color', [
            'label' => esc_html__('Texto da aba ativa', 'ead'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .ead-animated-tab.is-active' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('tab_gap', [
            'label' => esc_html__('Espaçamento entre abas', 'ead'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'range' => ['px'=>['min'=>0,'max'=>40]],
            'default' => ['unit'=>'px','size'=>12],
            'selectors' => [
                '{{WRAPPER}} .ead-animated-tabs-nav' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('tab_radius', [
            'label' => esc_html__('Borda arredondada (abas)', 'ead'),
            'type'  => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px','%'],
            'default' => ['top'=>12,'right'=>12,'bottom'=>12,'left'=>12,'unit'=>'px','isLinked'=>true],
            'selectors' => [
                '{{WRAPPER}} .ead-animated-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        /* ---------- ESTILO: CARD ---------- */
        $this->start_controls_section('card_style', [
            'label' => esc_html__('Card', 'ead'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        
        $this->add_responsive_control(
    'card_width',
    [
        'label' => esc_html__('Largura do card', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px','%','vw'],
        'range' => [
            'px' => ['min'=>200,'max'=>1400,'step'=>5],
            '%'  => ['min'=>10,'max'=>100],
            'vw' => ['min'=>10,'max'=>100],
        ],
        'default' => ['unit'=>'%','size'=>100],
        'selectors' => [
            // mantém fluido mas limita a largura máxima e centraliza
            '{{WRAPPER}} .ead-animated-tabcard' => 'width:100%; max-width: {{SIZE}}{{UNIT}}; margin-left:auto; margin-right:auto;',
        ],
    ]
);

        $this->add_control('card_bg', [
            'label' => esc_html__('Fundo', 'ead'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'default' => '#EBEBEB',
            'selectors' => [
                '{{WRAPPER}} .ead-animated-tabcard' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('card_padding', [
            'label' => esc_html__('Padding', 'ead'),
            'type'  => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px','%','em'],
            'default' => ['top'=>24,'right'=>24,'bottom'=>24,'left'=>24,'unit'=>'px'],
            'selectors' => [
                '{{WRAPPER}} .ead-animated-tabcard' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_radius', [
            'label' => esc_html__('Borda arredondada (card)', 'ead'),
            'type'  => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px','%'],
            'default' => ['top'=>16,'right'=>16,'bottom'=>16,'left'=>16,'unit'=>'px','isLinked'=>true],
            'selectors' => [
                '{{WRAPPER}} .ead-animated-tabcard' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
            'name' => 'card_shadow',
            'selector' => '{{WRAPPER}} .ead-animated-tabcard',
        ]);

        $this->end_controls_section();
        
        // === Estilo: Imagem (controle único e responsivo para TODAS as abas) ===
$this->start_controls_section(
    'img_style',
    [
        'label' => esc_html__('Imagem', 'ead'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

$this->add_responsive_control(
    'img_col_width',
    [
        'label' => esc_html__('Largura da imagem (%)', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['%'],
        'range' => ['%' => ['min' => 10, 'max' => 100]],
        'default' => ['unit' => '%', 'size' => 40],   // Desktop
        'tablet_default' => ['unit' => '%', 'size' => 50],
        'mobile_default' => ['unit' => '%', 'size' => 100],
        'selectors' => [
            // gravamos numa CSS variable no wrapper
            '{{WRAPPER}} .ead-animated-tabs' => '--img-col-w: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();

        /* ---------- ESTILO: TÍTULO / CONTEÚDO ---------- */
        $this->start_controls_section('text_style', [
            'label' => esc_html__('Texto', 'ead'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        
        $this->add_control('title_align', [
    'label'   => esc_html__('Alinhamento do título', 'ead'),
    'type'    => \Elementor\Controls_Manager::CHOOSE,
    'options' => [
        'left'   => ['title'=>esc_html__('Esq.','ead'),'icon'=>'eicon-text-align-left'],
        'center' => ['title'=>esc_html__('Centro','ead'),'icon'=>'eicon-text-align-center'],
        'right'  => ['title'=>esc_html__('Dir.','ead'),'icon'=>'eicon-text-align-right'],
    ],
    'default'   => 'left',
    'selectors' => [
        '{{WRAPPER}} .ead-animated-tabcard-title' => 'text-align: {{VALUE}};',
    ],
]);

        $this->add_control('title_color', [
            'label' => esc_html__('Cor do título', 'ead'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'default' => '#0F172A',
            'selectors' => ['{{WRAPPER}} .ead-animated-tabcard-title' => 'color: {{VALUE}};'],
        ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'name'     => 'title_typo',
            'selector' => '{{WRAPPER}} .ead-animated-tabcard-title',
        ]);
        
        $this->add_control('content_align', [
    'label'   => esc_html__('Alinhamento do conteúdo', 'ead'),
    'type'    => \Elementor\Controls_Manager::CHOOSE,
    'options' => [
        'left'   => ['title'=>esc_html__('Esq.','ead'),'icon'=>'eicon-text-align-left'],
        'center' => ['title'=>esc_html__('Centro','ead'),'icon'=>'eicon-text-align-center'],
        'right'  => ['title'=>esc_html__('Dir.','ead'),'icon'=>'eicon-text-align-right'],
    ],
    'default'   => 'left',
    'selectors' => [
        '{{WRAPPER}} .ead-animated-tabcard-content' => 'text-align: {{VALUE}};',
    ],
]);

        $this->add_control('content_color', [
            'label' => esc_html__('Cor do conteúdo', 'ead'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'default' => '#111827',
            'selectors' => ['{{WRAPPER}} .ead-animated-tabcard-content' => 'color: {{VALUE}};'],
        ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'name'     => 'content_typo',
            'selector' => '{{WRAPPER}} .ead-animated-tabcard-content',
        ]);
        
        

        $this->end_controls_section();
        
        /* ---------- ESTILO: DIVISOR ---------- */
$this->start_controls_section(
    'divider_style',
    [
        'label' => esc_html__('Divisor', 'ead'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

// alinhamento por classe no WRAPPER (evita ternários nos selectors)
$this->add_control(
    'divider_align_ctrl',
    [
        'label'        => esc_html__('Alinhamento', 'ead'),
        'type'         => \Elementor\Controls_Manager::CHOOSE,
        'options'      => [
            'left'   => ['title'=>esc_html__('Esq.','ead'),   'icon'=>'eicon-h-align-left'],
            'center' => ['title'=>esc_html__('Centro','ead'), 'icon'=>'eicon-h-align-center'],
            'right'  => ['title'=>esc_html__('Dir.','ead'),   'icon'=>'eicon-h-align-right'],
        ],
        'default'      => 'left',
        'prefix_class' => 'ead-divalign-', // -> ead-divalign-left|center|right
    ]
);

$this->add_control(
    'divider_color',
    [
        'label' => esc_html__('Cor', 'ead'),
        'type'  => \Elementor\Controls_Manager::COLOR,
        'default' => 'rgba(0,0,0,.35)',
        'selectors' => [
            '{{WRAPPER}} .ead-animated-tabcard-divider' => 'border-top-color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
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
            '{{WRAPPER}} .ead-animated-tabcard-divider' => 'border-top-style: {{VALUE}};',
        ],
    ]
);

$this->add_responsive_control(
    'divider_width',
    [
        'label' => esc_html__('Largura', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px','%'],
        'range' => [
            'px' => ['min'=>1,'max'=>1000],
            '%'  => ['min'=>1,'max'=>100],
        ],
        'default' => ['unit'=>'%','size'=>25],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-tabcard-divider' => 'width: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'divider_thickness',
    [
        'label' => esc_html__('Espessura', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => ['px'=>['min'=>1,'max'=>10]],
        'default' => ['unit'=>'px','size'=>4],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-tabcard-divider' => 'border-top-width: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'divider_space_top',
    [
        'label' => esc_html__('Espaço acima', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px','em','rem'],
        'range' => [
            'px'  => ['min'=>0,'max'=>200],
            'em'  => ['min'=>0,'max'=>10,'step'=>0.1],
            'rem' => ['min'=>0,'max'=>10,'step'=>0.1],
        ],
        'default' => ['unit'=>'px','size'=>12],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-tabcard-divider' => 'margin-top: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'divider_space_bottom',
    [
        'label' => esc_html__('Espaço abaixo', 'ead'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px','em','rem'],
        'range' => [
            'px'  => ['min'=>0,'max'=>200],
            'em'  => ['min'=>0,'max'=>10,'step'=>0.1],
            'rem' => ['min'=>0,'max'=>10,'step'=>0.1],
        ],
        'default' => ['unit'=>'px','size'=>16],
        'selectors' => [
            '{{WRAPPER}} .ead-animated-tabcard-divider' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = 'ead-animated-tabs-' . $this->get_id();
        ?>
        <div class="ead-animated-tabs" id="<?php echo esc_attr($id); ?>">
            <div class="ead-animated-tabs-nav" role="tablist" aria-label="Animated Cards Tabs"></div>

            <ul class="ead-animated-tabs-cards"></ul>

            <script type="application/json" class="ead-animated-tabs-data">
                <?php echo wp_json_encode($settings['items']); ?>
            </script>
        </div>
        <?php
    }

    protected function content_template() { ?>
        <div class="ead-animated-tabs">
            <div class="ead-animated-tabs-nav" role="tablist"></div>
            <ul class="ead-animated-tabs-cards"></ul>
            <script type="application/json" class="ead-animated-tabs-data">
                {{{ JSON.stringify( settings.items || [] ) }}}
            </script>
        </div>
    <?php }
}
