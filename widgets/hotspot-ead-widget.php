<?php

class Elementor_Hotspot_EAD_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hotspot_ead';
    }

    public function get_title() {
        return 'Hotspot EAD';
    }

    public function get_icon() {
        return 'eicon-ehp-hero';
    }

    public function get_categories() {
        return ['ead'];
    }
    
    public function get_style_depends() {
        return ['hotspot-ead-style'];
    }

    public function get_script_depends() {
        return ['hotspot-ead-script'];
    }

    protected function _register_controls() {
        
         $this->start_controls_section(
        'hotspot_settings',
        [
            'label' => 'Hotspots',
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
            'debug_mode',
            [
                'label' => esc_html__('Console Logs', 'elementor-hotspot'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'elementor-hotspot'),
                'label_off' => esc_html__('Off', 'elementor-hotspot'),
                'return_value' => 'true', // Retorna 'true' se ativado, vazio se desativado
                'default' => '', // Por padrão, desativado
            ]
        );

    // Controle para selecionar a imagem de fundo
    $this->add_control(
        'background_image',
        [
            'label' => __('Imagem', 'hotspot-ead'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]
    );
    
    // Controle de tipo de hotspot
    $this->add_control(
        'hotspot_type',
        [
            'label' => __('Tipo icone', 'hotspot-ead'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'icon' => __('Icon', 'hotspot-ead'),
                'radar' => __('Radar', 'hotspot-ead'),
            ],
            'default' => 'icon',
        ]
    );

    $this->add_control(
        'hotspot_icon',
        [
            'label' => __('Icone', 'hotspot-ead'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-map-marker-alt',
                'library' => 'solid',
            ],
            'condition' => [
                'hotspot_type' => 'icon',
            ],
        ]
    );
    
    $this->add_control(
    'show_all_hotspots',
    [
        'label' => __('Mostrar todos?', 'hotspot-ead'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'yes' => __('Sim', 'hotspot-ead'),
            'no' => __('Não', 'hotspot-ead'),
        ],
        'default' => 'no',
    ]
);



    $this->add_control(
        'hotspot_items',
        [
            'label' => __('Hotspot Items', 'hotspot-ead'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => [
                [
                    'name' => 'hotspot_id',
                    'label' => __('Hotspot ID', 'hotspot-ead'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __('ID', 'hotspot-ead'),
                ],
                [
                    'name' => 'option_popup',
                    'label' => __('Popup ID', 'hotspot-ead'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __('Popup number', 'hotspot-ead'),
                ],
                [
                    'name' => 'position_x',
                    'label' => __('Horizontal', 'hotspot-ead'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['%'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 99,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                ],
                [
                    'name' => 'position_y',
                    'label' => __('Vertical', 'hotspot-ead'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['%'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 99,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                ],
            ],
            'default' => [
                ['hotspot_id' => __('ID...', 'hotspot-ead')],
            ],
            'title_field' => '{{{ hotspot_id }}}',
        ]
    );

    $this->end_controls_section();
    
    $this->start_controls_section(
        'image_style',
        [
            'label' => __('Image', 'hotspot-ead'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    // Controle para o alinhamento da imagem
    $this->add_control(
        'image_alignment',
        [
            'label' => __('Alignment', 'hotspot-ead'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'hotspot-ead'),
                    'icon' => 'eicon-h-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'hotspot-ead'),
                    'icon' => 'eicon-h-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'hotspot-ead'),
                    'icon' => 'eicon-h-align-right',
                ],
            ],
            'default' => 'center',
            'toggle' => true,
        ]
    );

    // Controle para o tamanho da imagem
    $this->add_control(
        'image_size',
        [
            'label' => __('Size image (%)', 'hotspot-ead'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['%'],
            'range' => [
                '%' => [
                    'min' => 10,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
        ]
    );

    $this->end_controls_section();
    
    // Se��o de Estilo para Icon e Radar
$this->start_controls_section(
    'hotspot_icon_style',
    [
        'label' => __('Hotspot Style', 'hotspot-ead'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

// Controle de tamanho do Icon (vis�vel apenas se "Icon" for selecionado)
$this->add_control(
    'hotspot_icon_size',
    [
        'label' => __('Ico Size', 'hotspot-ead'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 10,
                'max' => 100,
            ],
        ],
        'default' => [
            'size' => 24,
        ],
        'condition' => [
            'hotspot_type' => 'icon',
        ],
    ]
);

// Controle de cor do Icon
$this->add_control(
    'hotspot_icon_color',
    [
        'label' => __('Icon Color', 'hotspot-ead'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#FF0000',
        'condition' => [
            'hotspot_type' => 'icon',
        ],
    ]
);

// Controle de cor do Icon em hover
$this->add_control(
    'hotspot_icon_hover_color',
    [
        'label' => __('Icon Color (Hover)', 'hotspot-ead'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#FF4500',
        'condition' => [
            'hotspot_type' => 'icon',
        ],
    ]
);

// Controle de tamanho do radar
$this->add_control(
    'radar_size',
    [
        'label' => __('Radar Size', 'hotspot-ead'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 10,
                'max' => 100,
            ],
        ],
        'default' => [
            'size' => 20,
        ],
        'condition' => [
            'hotspot_type' => 'radar',
        ],
    ]
);

// Controle de cor do radar
$this->add_control(
    'radar_color',
    [
        'label' => __('Radar Color', 'hotspot-ead'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => 'rgba(255, 0, 0, 0.3)',
        'condition' => [
            'hotspot_type' => 'radar',
        ],
    ]
);

$this->end_controls_section();

    }

protected function render() {
    $settings = $this->get_settings_for_display();

    $background_image_url = isset($settings['background_image']['url']) ? $settings['background_image']['url'] : '';

    $image_alignment = isset($settings['image_alignment']) ? $settings['image_alignment'] : 'center';
    $image_size = isset($settings['image_size']['size']) ? $settings['image_size']['size'] : 100;

    wp_localize_script(
        'hotspot-ead-script', // Handle do seu script JS
        'hotspotCustomConfig', // Nome do objeto JS global
        [
            'isDebugMode' => ($settings['debug_mode'] === 'true'), // Converte para booleano
        ]
    ); 

    // Define os estilos de alinhamento da imagem
    $alignment_styles = '';
    if ($image_alignment == 'left') {
        $alignment_styles = 'margin-right: auto;';
    } elseif ($image_alignment == 'right') {
        $alignment_styles = 'margin-left: auto;';
    } else {
        $alignment_styles = 'margin: 0 auto;';
    }

    // Verifica se devem mostrar todos os hotspots
    $show_all_hotspots = isset($settings['show_all_hotspots']) ? $settings['show_all_hotspots'] : 'no';

    $widget_id = $this->get_id();

    // Verifica se existem itens de hotspot
    if (!empty($settings['hotspot_items'])) {
        // Adiciona data-show-all ao container
        echo '<div class="hotspot-container" id="hotspot-container-' . esc_attr($widget_id) . '" style="position: relative; display: flex; width: 100%;" data-show-all="' . esc_attr($show_all_hotspots) . '">';
        echo '<img src="' . esc_url($background_image_url) . '" alt="Background Image" style="width: ' . esc_attr($image_size) . '%; display: block; ' . $alignment_styles . '">';

        // Loop pelos itens de hotspot
        foreach ($settings['hotspot_items'] as $item) {

            $position_x = isset($item['position_x']['size']) ? $item['position_x']['size'] : 50;
            $position_y = isset($item['position_y']['size']) ? $item['position_y']['size'] : 50;
            $hotspot_id = isset($item['hotspot_id']) ? esc_attr($item['hotspot_id']) : 'id';
            $popup_id = isset($item['option_popup']) ? esc_attr($item['option_popup']) : '';

            $hotspot_type = isset($settings['hotspot_type']) ? $settings['hotspot_type'] : 'icon';
            $icon_size = isset($settings['hotspot_icon_size']['size']) ? $settings['hotspot_icon_size']['size'] : 24;
            $icon_color = isset($settings['hotspot_icon_color']) ? $settings['hotspot_icon_color'] : '#FF0000';
            $icon_hover_color = isset($settings['hotspot_icon_hover_color']) ? $settings['hotspot_icon_hover_color'] : '#FF4500';
            $radar_size = isset($settings['radar_size']['size']) ? $settings['radar_size']['size'] : 20;
            $radar_color = isset($settings['radar_color']) ? $settings['radar_color'] : 'rgba(255, 0, 0, 0.3)';


            $icon_value = isset($settings['hotspot_icon']['value']) ? $settings['hotspot_icon']['value'] : 'fas fa-map-marker-alt';

            echo '<div class="hotspot-item" id="hotspot-' . esc_attr($widget_id) . '-' . esc_attr($hotspot_id) . '" style="position: absolute; left: ' . esc_attr($position_x) . '%; top: ' . esc_attr($position_y) . '%;" data-id="' . esc_attr($hotspot_id) . '" data-popup-url="' . esc_attr($popup_id) . '">';

            if ($hotspot_type === 'icon') {

                echo '<i class="' . esc_attr($icon_value) . ' icon-hotspot" style="font-size: ' . esc_attr($icon_size) . 'px; color: ' . esc_attr($icon_color) . '; cursor: pointer;" onmouseover="this.style.color=\'' . esc_attr($icon_hover_color) . '\'" onmouseout="this.style.color=\'' . esc_attr($icon_color) . '\'"></i>';
            } else {
                // Exibe o radar se o tipo for "radar"
                echo '<div class="radar-hotspot" style="width: ' . esc_attr($radar_size) . 'px; height: ' . esc_attr($radar_size) . 'px; background-color: ' . esc_attr($radar_color) . '; border-radius: 50%;"></div>';
            }

            echo '</div>';
        }

        echo '</div>';
    }
}






}
