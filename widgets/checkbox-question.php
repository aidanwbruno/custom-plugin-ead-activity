<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Elementor_CheckBox_Question extends Widget_Base {

    public function get_name() {
        return 'checkbox_question';
    }

    public function get_title() {
        return 'Checkbox Question';
    }

    public function get_icon() {
        return 'eicon-checkbox';
    }

    public function get_categories() {
        return ['ead'];
    }
    
    /**
     * Get widget style dependencies.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget style handles.
     */
    public function get_style_depends() {
        // Retorna o handle do seu CSS para que o Elementor o carregue
        // tanto no front-end quanto no editor.
        return ['checkbox-question-style'];
    }

    /**
     * Get widget script dependencies.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget script handles.
     */
    public function get_script_depends() {
        // Retorna o handle do seu JS para que o Elementor o carregue
        // tanto no front-end quanto no editor.
        return ['checkbox-question-script'];
    }

    protected function register_controls() {
        // Seção de Conteúdo
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Configurações do Questionário', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'debug_mode',
            [
                'label' => esc_html__('Console Logs', 'elementor-checkbox-question'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'elementor-checkbox-question'),
                'label_off' => esc_html__('Off', 'elementor-checkbox-question'),
                'return_value' => 'true', // Retorna 'true' se ativado, vazio se desativado
                'default' => '', // Por padrão, desativado
            ]
        );

        $this->add_control(
            'question_text',
            [
                'label' => esc_html__('Texto da Pergunta', 'elementor-checkbox-question'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('João mora na Bahia e tem um tênis azul', 'elementor-checkbox-question'),
                'placeholder' => esc_html__('Digite a pergunta principal aqui', 'elementor-checkbox-question'),
                'rows' => 3,
            ]
        );

        $this->add_control(
            'label_true',
            [
                'label' => esc_html__('Label True', 'elementor-checkbox-question'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Sim', 'elementor-checkbox-question'),
            ]
        );

        $this->add_control(
            'label_false',
            [
                'label' => esc_html__('Label False', 'elementor-checkbox-question'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Não', 'elementor-checkbox-question'),
            ]
        );
        
        $this->add_control(
            'label_true_mobile',
            [
                'label' => esc_html__('Label True Mobile', 'elementor-checkbox-question'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('&#10003;', 'elementor-checkbox-question'),
            ]
        );

        $this->add_control(
            'label_true_mobile_color',
            [
                'label' => esc_html__('Cor da Label True Mobile', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-option-label-true' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'label_false_mobile',
            [
                'label' => esc_html__('Label False Mobile', 'elementor-checkbox-question'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('&#10005;', 'elementor-checkbox-question'),
            ]
        );

        $this->add_control(
            'label_false_mobile_color',
            [
                'label' => esc_html__('Cor da Label False Mobile', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-option-label-false' => 'color: {{VALUE}};',
                ],
            ]
        );



        $repeater = new Repeater();

        $repeater->add_control(
            'statement_text',
            [
                'label' => esc_html__('Texto da Afirmação', 'elementor-checkbox-question'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('João mora na Bahia', 'elementor-checkbox-question'),
                'placeholder' => esc_html__('Digite a afirmação', 'elementor-checkbox-question'),
            ]
        );

        $repeater->add_control(
            'correct_answer',
            [
                'label' => esc_html__('Resposta', 'elementor-checkbox-question'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => esc_html__('Verdadeiro', 'elementor-checkbox-question'),
                    'false' => esc_html__('Falso', 'elementor-checkbox-question'),
                ],
                'default' => 'true',
            ]
        );

        $this->add_control(
            'statements',
            [
                'label' => esc_html__('Afirmações', 'elementor-checkbox-question'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ statement_text }}}',
                'default' => [
                    [
                        'statement_text' => esc_html__('João mora na Bahia', 'elementor-checkbox-question'),
                        'correct_answer' => 'true',
                    ],
                    [
                        'statement_text' => esc_html__('João tem um tênis amarelo', 'elementor-checkbox-question'),
                        'correct_answer' => 'false',
                    ],
                ],
            ]
        );

        $this->add_control(
            'check_button_text',
            [
                'label' => esc_html__('Texto do Botão de Verificação', 'elementor-checkbox-question'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Verificar Respostas', 'elementor-checkbox-question'),

            ]
        );
        
        $this->add_control(
            'solve_button_text',
            [
                'label' => esc_html__('Texto do Botão Solucionar', 'elementor-checkbox-question'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Solucionar', 'elementor-checkbox-question'),
            ]
        );

        $this->add_control(
            'reset_button_text',
            [
                'label' => esc_html__('Texto do Botão Reiniciar', 'elementor-checkbox-question'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Reiniciar', 'elementor-checkbox-question'),
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Container Principal
        $this->start_controls_section(
            'container_style_section',
            [
                'label' => esc_html__('Container Principal', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'container_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-widget' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .checkbox-question-widget',
            ]
        );

    

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'selector' => '{{WRAPPER}} .checkbox-question-widget',
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__('Espaçamento Interno', 'elementor-checkbox-question'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => esc_html__('Margem Externa', 'elementor-checkbox-question'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Título da Pergunta
        $this->start_controls_section(
            'question_style_section',
            [
                'label' => esc_html__('Pergunta Principal', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'question_typography',
                'selector' => '{{WRAPPER}} .checkbox-question-main-text',
            ]
        );

        $this->add_control(
            'question_color',
            [
                'label' => esc_html__('Cor do Texto', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-main-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'question_align',
            [
                'label' => esc_html__('Alinhamento', 'elementor-checkbox-question'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Esquerda', 'elementor-checkbox-question'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Centro', 'elementor-checkbox-question'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Direita', 'elementor-checkbox-question'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-main-text' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'question_margin',
            [
                'label' => esc_html__('Margem', 'elementor-checkbox-question'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-main-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Cabeçalho da Tabela
        $this->start_controls_section(
            'header_style_section',
            [
                'label' => esc_html__('Cabeçalho da Tabela', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'header_typography',
                'selector' => '{{WRAPPER}} .checkbox-question-header .checkbox-question-col',
            ]
        );

        $this->add_control(
            'header_text_color',
            [
                'label' => esc_html__('Cor do Texto', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-header .checkbox-question-col' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'header_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-header' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'header_border',
                'selector' => '{{WRAPPER}} .checkbox-question-header',
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label' => esc_html__('Espaçamento Interno', 'elementor-checkbox-question'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-header .checkbox-question-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Tabela
        $this->start_controls_section(
            'table_style_section',
            [
                'label' => esc_html__('Tabela', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'table_border',
                'selector' => '{{WRAPPER}} .checkbox-question-table',
            ]
        );


        $this->add_control(
            'table_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-table' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Linhas da Tabela
        $this->start_controls_section(
            'rows_style_section',
            [
                'label' => esc_html__('Linhas da Tabela', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'row_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-row' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'row_background_hover',
            [
                'label' => esc_html__('Cor de Fundo (Hover)', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-row:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_padding',
            [
                'label' => esc_html__('Espaçamento Interno', 'elementor-checkbox-question'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Colunas
        $this->start_controls_section(
            'columns_style_section',
            [
                'label' => esc_html__('Colunas', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'description_column_width',
            [
                'label' => esc_html__('Largura da Coluna Descrição', 'elementor-checkbox-question'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 20,
                        'max' => 90,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .description-col' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Checkbox
        $this->start_controls_section(
            'checkbox_style_section',
            [
                'label' => esc_html__('Estilo do Checkbox', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'checkbox_size',
            [
                'label' => esc_html__('Tamanho', 'elementor-checkbox-question'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-custom-radio' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'checkbox_border_width',
            [
                'label' => esc_html__('Espessura da Borda', 'elementor-checkbox-question'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-custom-radio' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'checkbox_border_color',
            [
                'label' => esc_html__('Cor da Borda', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ccc',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-custom-radio' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'checkbox_hover_border_color',
            [
                'label' => esc_html__('Cor da Borda (Hover)', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-option:hover .checkbox-question-custom-radio' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'checkbox_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-custom-radio' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'checkbox_checked_border_color',
            [
                'label' => esc_html__('Cor da Borda (Selecionado)', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2196F3',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-input:checked ~ .checkbox-question-custom-radio' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'checkbox_checked_color',
            [
                'label' => esc_html__('Cor do Ponto (Selecionado)', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2196F3',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-custom-radio:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'checkbox_checked_size',
            [
                'label' => esc_html__('Tamanho do Ponto (Selecionado)', 'elementor-checkbox-question'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 2,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-custom-radio:after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; top: calc(50% - {{SIZE}}{{UNIT}}/2); left: calc(50% - {{SIZE}}{{UNIT}}/2);',
                ],
            ]
        );

        

        $this->end_controls_section();

        // Seção de Estilo - Descrição
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => esc_html__('Descrição', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .description-col',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Cor do Texto', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description-col' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_hover_color',
            [
                'label' => esc_html__('Cor do Texto (Hover)', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-row:hover .description-col' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Botões de Ação
        $this->start_controls_section(
            'buttons_style_section',
            [
                'label' => esc_html__('Botões de Ação', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'buttons_typography',
                'selector' => '{{WRAPPER}} .checkbox-question-check-button, {{WRAPPER}} .checkbox-question-solve-button, {{WRAPPER}} .checkbox-question-reset-button',
            ]
        );

        // Estilo para o botão de verificação
        $this->add_control(
            'check_button_heading',
            [
                'label' => esc_html__('Botão Verificar', 'elementor-checkbox-question'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('check_button_tabs');

        $this->start_controls_tab(
            'check_button_normal',
            [
                'label' => esc_html__('Normal', 'elementor-checkbox-question'),
            ]
        );

        $this->add_control(
            'check_button_text_color',
            [
                'label' => esc_html__('Cor do Texto', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-check-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'check_button_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4CAF50',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-check-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'check_button_border',
                'selector' => '{{WRAPPER}} .checkbox-question-check-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'check_button_hover',
            [
                'label' => esc_html__('Hover', 'elementor-checkbox-question'),
            ]
        );

        $this->add_control(
            'check_button_hover_text_color',
            [
                'label' => esc_html__('Cor do Texto', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-check-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'check_button_hover_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3e8e41',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-check-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'check_button_hover_border_color',
            [
                'label' => esc_html__('Cor da Borda', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-check-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Estilo para o botão de solucionar
        $this->add_control(
            'solve_button_heading',
            [
                'label' => esc_html__('Botão Solucionar', 'elementor-checkbox-question'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('solve_button_tabs');

        $this->start_controls_tab(
            'solve_button_normal',
            [
                'label' => esc_html__('Normal', 'elementor-checkbox-question'),
            ]
        );

        $this->add_control(
            'solve_button_text_color',
            [
                'label' => esc_html__('Cor do Texto', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-solve-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'solve_button_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2196F3',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-solve-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'solve_button_border',
                'selector' => '{{WRAPPER}} .checkbox-question-solve-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'solve_button_hover',
            [
                'label' => esc_html__('Hover', 'elementor-checkbox-question'),
            ]
        );

        $this->add_control(
            'solve_button_hover_text_color',
            [
                'label' => esc_html__('Cor do Texto', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-solve-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'solve_button_hover_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#0b7dda',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-solve-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'solve_button_hover_border_color',
            [
                'label' => esc_html__('Cor da Borda', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-solve-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Estilo para o botão de reiniciar
        $this->add_control(
            'reset_button_heading',
            [
                'label' => esc_html__('Botão Reiniciar', 'elementor-checkbox-question'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('reset_button_tabs');

        $this->start_controls_tab(
            'reset_button_normal',
            [
                'label' => esc_html__('Normal', 'elementor-checkbox-question'),
            ]
        );

        $this->add_control(
            'reset_button_text_color',
            [
                'label' => esc_html__('Cor do Texto', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-reset-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'reset_button_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f44336',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-reset-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'reset_button_border',
                'selector' => '{{WRAPPER}} .checkbox-question-reset-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'reset_button_hover',
            [
                'label' => esc_html__('Hover', 'elementor-checkbox-question'),
            ]
        );

        $this->add_control(
            'reset_button_hover_text_color',
            [
                'label' => esc_html__('Cor do Texto', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-reset-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'reset_button_hover_background',
            [
                'label' => esc_html__('Cor de Fundo', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#da190b',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-reset-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'reset_button_hover_border_color',
            [
                'label' => esc_html__('Cor da Borda', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-reset-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Estilos comuns para todos os botões
        $this->add_control(
            'buttons_common_heading',
            [
                'label' => esc_html__('Estilos Comuns', 'elementor-checkbox-question'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'buttons_border_radius',
            [
                'label' => esc_html__('Raio da Borda', 'elementor-checkbox-question'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-check-button, {{WRAPPER}} .checkbox-question-solve-button, {{WRAPPER}} .checkbox-question-reset-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'buttons_padding',
            [
                'label' => esc_html__('Espaçamento Interno', 'elementor-checkbox-question'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-check-button, {{WRAPPER}} .checkbox-question-solve-button, {{WRAPPER}} .checkbox-question-reset-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'buttons_margin',
            [
                'label' => esc_html__('Margem', 'elementor-checkbox-question'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-check-button, {{WRAPPER}} .checkbox-question-solve-button, {{WRAPPER}} .checkbox-question-reset-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'buttons_box_shadow',
                'selector' => '{{WRAPPER}} .checkbox-question-check-button, {{WRAPPER}} .checkbox-question-solve-button, {{WRAPPER}} .checkbox-question-reset-button',
            ]
        );

        $this->end_controls_section();

        // Seção de Estilo - Feedback
        $this->start_controls_section(
            'feedback_style_section',
            [
                'label' => esc_html__('Feedback', 'elementor-checkbox-question'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feedback_correct_color',
            [
                'label' => esc_html__('Cor para Acerto', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4CAF50',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-feedback-icon.correct' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .checkbox-question-row.correct .checkbox-question-col' => 'background-color: rgba({{VALUE_RGB}}, 0.1);',
                ],
            ]
        );

        $this->add_control(
            'feedback_incorrect_color',
            [
                'label' => esc_html__('Cor para Erro', 'elementor-checkbox-question'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f44336',
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-feedback-icon.incorrect' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .checkbox-question-row.incorrect .checkbox-question-col' => 'background-color: rgba({{VALUE_RGB}}, 0.1);',
                ],
            ]
        );

        $this->add_control(
            'feedback_icon_size',
            [
                'label' => esc_html__('Tamanho do Ícone', 'elementor-checkbox-question'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 18,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-feedback-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'feedback_icon_spacing',
            [
                'label' => esc_html__('Espaçamento do Ícone', 'elementor-checkbox-question'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'size' => 5,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .checkbox-question-feedback-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        

        $this->end_controls_section();
        
        
    }

protected function render() {
    $settings = $this->get_settings_for_display();
    $widget_id = 'checkbox-question-' . $this->get_id(); // ID único para o widget
    
    // Adicionando data attributes para mobile
    $labels_desktop = [
        'true' => $settings['label_true'] ?? __('Verdadeiro', 'elementor-checkbox-question'),
        'false' => $settings['label_false'] ?? __('Falso', 'elementor-checkbox-question')
    ];

    $labels_mobile = [
        'true' => $settings['label_true_mobile'] ?? __('Sim', 'elementor-checkbox-question'),
        'false' => $settings['label_false_mobile'] ?? __('Não', 'elementor-checkbox-question')
    ];

    wp_localize_script(
        'checkbox-question-script',
        'checkboxQuestionConfig',
        [
            'isDebugMode' => ($settings['debug_mode'] === 'true'),
        ]
    );
    ?>
    
    <div class="checkbox-question-widget" id="<?php echo esc_attr($widget_id); ?>">
    <?php if (!empty($settings['question_text'])) : ?>
        <h3 class="checkbox-question-main-text"><?php echo wp_kses_post($settings['question_text']); ?></h3>
    <?php endif; ?>
    
    <div class="checkbox-question-table-container">
        <table class="checkbox-question-table">
            <!-- HEADER -->
            <thead class="checkbox-question-header">
                <tr>
                    <th class="checkbox-question-col description-col"><?php _e('DESCRIÇÃO', 'elementor-checkbox-question'); ?></th>
                    <th class="checkbox-question-col option-col desktop-label"><?php echo esc_html($labels_desktop['true']); ?></th>
                    <th class="checkbox-question-col option-col desktop-label"><?php echo esc_html($labels_desktop['false']); ?></th>
                </tr>
            </thead>
            
            <tbody>
            <?php if ($settings['statements']) : ?>
                <?php foreach ($settings['statements'] as $index => $statement) : ?>
                    <tr class="checkbox-question-row" data-statement-id="<?php echo esc_attr($index); ?>">
                        <td class="checkbox-question-col description-col">
                            <?php echo wp_kses_post($statement['statement_text']); ?>
                        </td>
                        
                        <!-- Opções para desktop -->
                        <td class="checkbox-question-col option-col desktop-option">
                            <label class="checkbox-question-option">
                                <input type="radio" 
                                        name="statement_<?php echo esc_attr($this->get_id() . '_' . $index); ?>" 
                                        class="checkbox-question-input true-option" 
                                        data-correct-value="true"
                                        data-expected-answer="<?php echo esc_attr($statement['correct_answer']); ?>">
                                <span class="checkbox-question-custom-radio"></span>
                            </label>
                        </td>
                        
                        <td class="checkbox-question-col option-col desktop-option">
                            <label class="checkbox-question-option">
                                <input type="radio" 
                                        name="statement_<?php echo esc_attr($this->get_id() . '_' . $index); ?>" 
                                        class="checkbox-question-input false-option" 
                                        data-correct-value="false"
                                        data-expected-answer="<?php echo esc_attr($statement['correct_answer']); ?>">
                                <span class="checkbox-question-custom-radio"></span>
                            </label>
                        </td>
                    </tr>
                    
                    <!-- Linha adicional para mobile -->
                    <tr class="mobile-options-row">
                        <td colspan="3" class="mobile-options-container">
                            <div class="mobile-option">
                                <label class="checkbox-question-option">
                                    <input type="radio"
                                            name="statement_<?php echo esc_attr($this->get_id() . '_' . $index); ?>"
                                            class="checkbox-question-input true-option"
                                            data-correct-value="true"
                                            data-expected-answer="<?php echo esc_attr($statement['correct_answer']); ?>">
                                    <span class="checkbox-question-custom-radio"></span>
                                    </label>
                                <span class="mobile-option-label-true"><?php echo esc_html($labels_mobile['true']); ?></span>
                            </div>
                            
                            <div class="mobile-option">
                                <label class="checkbox-question-option">
                                    <input type="radio"
                                            name="statement_<?php echo esc_attr($this->get_id() . '_' . $index); ?>"
                                            class="checkbox-question-input false-option"
                                            data-correct-value="false"
                                            data-expected-answer="<?php echo esc_attr($statement['correct_answer']); ?>">
                                    <span class="checkbox-question-custom-radio"></span>
                                    </label>
                                <span class="mobile-option-label-false"><?php echo esc_html($labels_mobile['false']); ?></span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="checkbox-question-actions">
        <button class="checkbox-question-check-button" style='border:none'><?php echo esc_html($settings['check_button_text']); ?></button>
        <button class="checkbox-question-solve-button" style='border:none'><?php echo esc_html($settings['solve_button_text']); ?></button>
        <button class="checkbox-question-reset-button" style='border:none'><?php echo esc_html($settings['reset_button_text']); ?></button>
    </div>
    
    <div class="checkbox-question-feedback"></div>
</div>
    <?php
}

}