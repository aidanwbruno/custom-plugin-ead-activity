<?php
if ( ! defined('ABSPATH') ) exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

class Elementor_Multiple_Selection_Question_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'multiple-ead-question'; }
    public function get_title() { return esc_html__('Multiple Selection Question', 'ead'); }
    public function get_icon() { return 'eicon-radio'; }
    public function get_categories() { return ['ead']; }
    public function get_style_depends() { return ['multiple-ead-question-style']; }
    public function get_script_depends() { return ['multiple-ead-question-script']; }

    /* -------------------- CONTROLS -------------------- */
    protected function register_controls() {

        /* Pergunta */
        $this->start_controls_section('section_question', [
            'label' => esc_html__('Pergunta', 'ead')
        ]);

        $this->add_control('title', [
            'label' => esc_html__('Título da pergunta', 'ead'),
            'type'  => Controls_Manager::TEXTAREA,
            'rows'  => 2,
            'default' => esc_html__('Além da espirometria, quais exames são mais pertinentes na situação em análise?', 'ead'),
        ]);

        $this->add_control('instruction', [
            'label' => esc_html__('Instrução', 'ead'),
            'type'  => Controls_Manager::TEXT,
            'default' => esc_html__('Marque as opções que você considera corretas', 'ead'),
        ]);

        $this->add_control('layout_mode', [
            'label' => esc_html__('Layout das opções', 'ead'),
            'type'  => Controls_Manager::CHOOSE,
            'default' => 'cols',
            'toggle'  => false,
            'options' => [
                'row'  => [ 'title' => esc_html__('Linha'),   'icon' => 'eicon-ellipsis-h' ],
                'cols' => [ 'title' => esc_html__('Colunas'), 'icon' => 'eicon-editor-list-ul' ],
            ]
        ]);

        $this->add_control('columns', [
            'label'   => esc_html__('Nº de colunas', 'ead'),
            'type'    => Controls_Manager::SELECT,
            'default' => '3',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
            ],
            'condition' => ['layout_mode' => 'cols']
        ]);

        $this->end_controls_section();

        /* Opções (repeater) */
        $this->start_controls_section('section_options', [
            'label' => esc_html__('Opções', 'ead')
        ]);

        $rep = new Repeater();

        $rep->add_control('option_text', [
            'label' => esc_html__('Texto da opção', 'ead'),
            'type'  => Controls_Manager::TEXTAREA,
            'rows'  => 2,
            'default' => esc_html__('Hemograma', 'ead')
        ]);

        $rep->add_control('feedback', [
            'label' => esc_html__('Feedback desta opção', 'ead'),
            'type'  => Controls_Manager::TEXTAREA,
            'rows'  => 3,
            'default' => esc_html__('Exame útil para avaliação geral.', 'ead')
        ]);

        $rep->add_control('is_correct', [
            'label' => esc_html__('É correta?', 'ead'),
            'type'  => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Sim', 'ead'),
            'label_off'=> esc_html__('Não', 'ead'),
            'return_value' => 'yes',
            'default' => 'yes'
        ]);

        $this->add_control('options', [
            'label' => esc_html__('Lista de opções', 'ead'),
            'type'  => Controls_Manager::REPEATER,
            'fields'=> $rep->get_controls(),
            'title_field' => '{{{ option_text }}}',
            'default' => [
                [ 'option_text' => 'Hemograma',            'feedback' => '…', 'is_correct' => 'yes' ],
                [ 'option_text' => 'Creatinina',           'feedback' => '…', 'is_correct' => 'yes' ],
                [ 'option_text' => 'Colesterol',           'feedback' => '…', 'is_correct' => 'yes' ],
                [ 'option_text' => 'Radiografia de tórax', 'feedback' => '…', 'is_correct' => 'yes' ],
                [ 'option_text' => 'ECG',                  'feedback' => '…', 'is_correct' => 'yes' ],
                [ 'option_text' => 'Glicemia',             'feedback' => '…', 'is_correct' => 'yes' ],
            ]
        ]);
        $this->end_controls_section();

        /* Mensagens & Botões */
        $this->start_controls_section('section_messages', [
            'label' => esc_html__('Mensagens & Botões', 'ead')
        ]);

        $this->add_control('btn_label', [
            'label' => esc_html__('Rótulo do botão Conferir', 'ead'),
            'type'  => Controls_Manager::TEXT,
            'default' => esc_html__('Conferir', 'ead'),
        ]);

        $this->add_control('show_reset', [
            'label' => esc_html__('Exibir botão Reiniciar', 'ead'),
            'type'  => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('btn_reset_label', [
            'label' => esc_html__('Rótulo do botão Reiniciar', 'ead'),
            'type'  => Controls_Manager::TEXT,
            'default' => esc_html__('Reiniciar', 'ead'),
            'condition' => ['show_reset' => 'yes']
        ]);

        $this->add_control('all_correct_text', [
            'label' => esc_html__('Mensagem quando tudo correto', 'ead'),
            'type'  => Controls_Manager::TEXTAREA,
            'rows'  => 2,
            'default' => esc_html__('Muito bem! Você acertou todas', 'ead'),
        ]);

        $this->add_control('not_all_correct_text', [
            'label' => esc_html__('Mensagem quando houver erro', 'ead'),
            'type'  => Controls_Manager::TEXTAREA,
            'rows'  => 2,
            'default' => esc_html__('Você quase conseguiu! Reveja os pontos abaixo', 'ead'),
        ]);

        $this->end_controls_section();

        /* ÍCONES (customizáveis) */
        $this->start_controls_section('section_icons', [
            'label' => esc_html__('Ícones do Modal', 'ead')
        ]);

        $this->add_control('icon_key', [
            'label' => esc_html__('Ícone – “Opções corretas”', 'ead'),
            'type'  => Controls_Manager::ICONS,
            'default' => [ 'value' => 'fas fa-check', 'library' => 'fa-solid' ],
        ]);

        $this->add_control('icon_you', [
            'label' => esc_html__('Ícone – “Corretas que você marcou”', 'ead'),
            'type'  => Controls_Manager::ICONS,
            'default' => [ 'value' => 'fas fa-check-double', 'library' => 'fa-solid' ],
        ]);

        $this->add_control('icon_feedback_correct', [
            'label' => esc_html__('Ícone feedback – Correto', 'ead'),
            'type'  => Controls_Manager::ICONS,
            'default' => [ 'value' => 'fas fa-check-circle', 'library' => 'fa-solid' ],
        ]);

        $this->add_control('icon_feedback_wrong', [
            'label' => esc_html__('Ícone feedback – Incorreto', 'ead'),
            'type'  => Controls_Manager::ICONS,
            'default' => [ 'value' => 'fas fa-times-circle', 'library' => 'fa-solid' ],
        ]);

        $this->add_control('icon_feedback_missed', [
            'label' => esc_html__('Ícone feedback – Não selecionado (era correta)', 'ead'),
            'type'  => Controls_Manager::ICONS,
            'default' => [ 'value' => 'fas fa-exclamation-circle', 'library' => 'fa-solid' ],
        ]);

        $this->add_control('show_option_feedback', [
            'label' => esc_html__('Mostrar “Feedback por opção”', 'ead'),
            'type'  => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->end_controls_section();

        /* -------------------- STYLE -------------------- */

        // Card
        $this->start_controls_section('style_card', [
            'label' => esc_html__('Card', 'ead'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_control('card_radius', [
            'label' => esc_html__('Border radius', 'ead'),
            'type'  => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [ 'px' => ['min'=>0,'max'=>40] ],
            'default' => ['size' => 12],
            'selectors' => ['{{WRAPPER}} .msq-card' => 'border-radius: {{SIZE}}{{UNIT}};']
        ]);
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name' => 'card_shadow',
            'selector' => '{{WRAPPER}} .msq-card'
        ]);
        $this->add_group_control(Group_Control_Background::get_type(), [
            'name' => 'card_bg',
            'types'=> ['classic','gradient'],
            'selector' => '{{WRAPPER}} .msq-card'
        ]);
        $this->end_controls_section();

        // Header
        $this->start_controls_section('style_header', [
            'label' => esc_html__('Cabeçalho', 'ead'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'title_typo',
            'selector' => '{{WRAPPER}} .msq-card__title'
        ]);
        $this->add_control('title_color', [
            'label' => esc_html__('Cor do título', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-card__title' => 'color: {{VALUE}};']
        ]);
        $this->add_group_control(Group_Control_Background::get_type(), [
            'name' => 'header_bg',
            'selector' => '{{WRAPPER}} .msq-card__header'
        ]);
        $this->end_controls_section();

        // Instrução
        $this->start_controls_section('style_instruction', [
            'label' => esc_html__('Instrução', 'ead'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'instruction_typo',
            'selector' => '{{WRAPPER}} .msq-instruction'
        ]);
        $this->add_control('instruction_color', [
            'label' => esc_html__('Cor da instrução', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-instruction' => 'color: {{VALUE}};']
        ]);
        $this->end_controls_section();

        // Opções
        $this->start_controls_section('style_options', [
            'label' => esc_html__('Opções', 'ead'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'option_typo',
            'selector' => '{{WRAPPER}} .msq-text'
        ]);
        $this->add_control('option_text_color', [
            'label' => esc_html__('Cor do texto', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-text' => 'color: {{VALUE}};']
        ]);
        $this->add_group_control(Group_Control_Border::get_type(), [
            'name' => 'option_border',
            'selector' => '{{WRAPPER}} .msq-option'
        ]);
        $this->add_control('option_radius', [
            'label' => esc_html__('Radius da opção', 'ead'),
            'type'  => Controls_Manager::SLIDER,
            'range' => [ 'px' => ['min'=>0,'max'=>30] ],
            'default' => ['size' => 10],
            'selectors' => ['{{WRAPPER}} .msq-option' => 'border-radius: {{SIZE}}{{UNIT}};']
        ]);
        $this->add_group_control(Group_Control_Background::get_type(), [
            'name' => 'option_bg',
            'selector' => '{{WRAPPER}} .msq-option'
        ]);

        // “Radio visual”
        $this->add_control('indicator_border_color', [
            'label' => esc_html__('Cor do anel', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-indicator' => 'border-color: {{VALUE}};']
        ]);
        $this->add_control('indicator_fill_color', [
            'label' => esc_html__('Cor do ponto ativo', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-radio-like input:checked + .msq-indicator::after' => 'background: {{VALUE}};']
        ]);
        $this->end_controls_section();

        // Botões
        $this->start_controls_section('style_buttons', [
            'label' => esc_html__('Botões', 'ead'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'btn_typo',
            'selector' => '{{WRAPPER}} .msq-btn'
        ]);
        $this->add_group_control(Group_Control_Border::get_type(), [
            'name' => 'btn_border',
            'selector' => '{{WRAPPER}} .msq-btn'
        ]);
        $this->add_control('btn_radius', [
            'label' => esc_html__('Radius', 'ead'),
            'type'  => Controls_Manager::SLIDER,
            'range' => [ 'px' => ['min'=>0,'max'=>30] ],
            'default' => ['size' => 10],
            'selectors' => ['{{WRAPPER}} .msq-btn' => 'border-radius: {{SIZE}}{{UNIT}};']
        ]);
        $this->add_control('btn_bg', [
            'label' => esc_html__('Cor de fundo', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-btn' => 'background: {{VALUE}};']
        ]);
        $this->add_control('btn_color', [
            'label' => esc_html__('Cor do texto', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-btn' => 'color: {{VALUE}};']
        ]);
        $this->end_controls_section();

        // Modal
        $this->start_controls_section('style_modal', [
            'label' => esc_html__('Modal', 'ead'),
            'tab'   => Controls_Manager::TAB_STYLE
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'modal_title_typo',
            'selector' => '{{WRAPPER}} .msq-modal__title'
        ]);
        $this->add_control('modal_title_color', [
            'label' => esc_html__('Cor do título', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-modal__title' => 'color: {{VALUE}};']
        ]);
        $this->add_group_control(Group_Control_Background::get_type(), [
            'name' => 'modal_bg',
            'selector' => '{{WRAPPER}} .msq-modal__dialog'
        ]);
        $this->add_group_control(Group_Control_Border::get_type(), [
            'name' => 'modal_border',
            'selector' => '{{WRAPPER}} .msq-modal__dialog'
        ]);
        $this->add_control('modal_radius', [
            'label' => esc_html__('Radius do modal', 'ead'),
            'type'  => Controls_Manager::SLIDER,
            'range' => [ 'px' => ['min'=>0,'max'=>30] ],
            'default' => ['size' => 14],
            'selectors' => ['{{WRAPPER}} .msq-modal__dialog' => 'border-radius: {{SIZE}}{{UNIT}};']
        ]);
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name' => 'modal_shadow',
            'selector' => '{{WRAPPER}} .msq-modal__dialog'
        ]);

        $this->add_control('icon_size', [
            'label' => esc_html__('Tamanho de ícone (px)', 'ead'),
            'type'  => Controls_Manager::SLIDER,
            'range' => [ 'px' => ['min'=>10,'max'=>48] ],
            'default' => ['size' => 20],
            'selectors' => [
                '{{WRAPPER}} .msq-badge i, {{WRAPPER}} .msq-badge svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};'
            ]
        ]);
        $this->add_control('icon_color_key', [
            'label' => esc_html__('Cor do ícone – Gabarito', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-badge--key' => 'color: {{VALUE}}; background: transparent;']
        ]);
        $this->add_control('icon_color_you', [
            'label' => esc_html__('Cor do ícone – Você', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-badge--you' => 'color: {{VALUE}}; background: transparent;']
        ]);
        $this->add_control('icon_color_ok', [
            'label' => esc_html__('Cor do ícone – Correto', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-badge--ok' => 'color: {{VALUE}}; background: transparent;']
        ]);
        $this->add_control('icon_color_err', [
            'label' => esc_html__('Cor do ícone – Incorreto', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-badge--error' => 'color: {{VALUE}}; background: transparent;']
        ]);
        $this->add_control('icon_color_missed', [
            'label' => esc_html__('Cor do ícone – Não selecionado (era correta)', 'ead'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .msq-badge--missed' => 'color: {{VALUE}}; background: transparent;']
        ]);
        
        $this->add_control('close_btn_color', [
            'label' => esc_html__('Cor do botão fechar (X)', 'ead'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .msq-modal__close' => 'color: {{VALUE}};',
            ],
        ]);
        

        $this->end_controls_section();
    }

    /* -------------------- RENDER -------------------- */
    protected function render() {
        $s   = $this->get_settings_for_display();
        $wid = $this->get_id();

        $options = is_array($s['options']) ? $s['options'] : [];

        // Render dos ícones em HTML (usaremos dentro do JS via data-attributes)
        $icon_key  = $this->render_icon_to_string($s['icon_key']);
        $icon_you  = $this->render_icon_to_string($s['icon_you']);
        $ico_ok    = $this->render_icon_to_string($s['icon_feedback_correct']);
        $ico_err   = $this->render_icon_to_string($s['icon_feedback_wrong']);
        $ico_miss  = $this->render_icon_to_string($s['icon_feedback_missed']);

        $layout_class = $s['layout_mode'] === 'row' ? 'msq--row' : 'msq--cols msq--cols-'.$s['columns'];
        ?>
        <div class="msq-card <?php echo esc_attr($layout_class); ?>" data-msq-id="<?php echo esc_attr($wid); ?>">
            <div class="msq-card__header">
                <div class="msq-card__title"><?php echo wp_kses_post($s['title']); ?></div>
            </div>

            <div class="msq-card__body">
                <?php if (!empty($s['instruction'])): ?>
                    <p class="msq-instruction"><?php echo esc_html($s['instruction']); ?></p>
                <?php endif; ?>

                <ul class="msq-options" role="group" aria-label="<?php echo esc_attr( wp_strip_all_tags($s['title']) ); ?>">
                    <?php foreach ($options as $i => $op):
                        $is_correct = ($op['is_correct'] === 'yes') ? '1' : '0';
                    ?>
                        <li class="msq-option"
                            data-correct="<?php echo esc_attr($is_correct); ?>"
                            data-feedback="<?php echo esc_attr($op['feedback']); ?>">
                            <label class="msq-radio-like">
                                <input type="checkbox"
                                       class="msq-check"
                                       name="msq-<?php echo esc_attr($wid); ?>[]"
                                       value="<?php echo esc_attr($i); ?>"
                                       aria-label="<?php echo esc_attr( wp_strip_all_tags($op['option_text']) ); ?>" />
                                <span class="msq-indicator" aria-hidden="true"></span>
                                <span class="msq-text"><?php echo wp_kses_post($op['option_text']); ?></span>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="msq-actions">
                    <button class="msq-btn msq-btn--check"
                        type="button"
                        data-success="<?php echo esc_attr($s['all_correct_text']); ?>"
                        data-fail="<?php echo esc_attr($s['not_all_correct_text']); ?>"
                        data-icon-key="<?php echo esc_attr( base64_encode($icon_key) ); ?>"
                        data-icon-you="<?php echo esc_attr( base64_encode($icon_you) ); ?>"
                        data-ico-ok="<?php echo esc_attr( base64_encode($ico_ok) ); ?>"
                        data-ico-err="<?php echo esc_attr( base64_encode($ico_err) ); ?>"
                        data-ico-missed="<?php echo esc_attr( base64_encode($ico_miss) ); ?>"
                        data-show-feedback="<?php echo ($s['show_option_feedback'] === 'yes') ? '1' : '0'; ?>"
                    ><?php echo esc_html($s['btn_label']); ?></button>

                    <?php if ($s['show_reset'] === 'yes'): ?>
                        <button class="msq-btn msq-btn--reset" type="button" style="display:none;">
                            <?php echo esc_html($s['btn_reset_label']); ?>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Modal custom -->
            <div class="msq-modal" aria-hidden="true">
                <div class="msq-modal__overlay"></div>
                <div class="msq-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="msq-modal-title-<?php echo esc_attr($wid); ?>">
                    <button class="msq-modal__close" type="button" aria-label="<?php esc_attr_e('Fechar', 'ead'); ?>">
                      <span aria-hidden="true" class="msq-x">&times;</span>
                    </button>
                    <div class="msq-modal__content">
                        <h3 id="msq-modal-title-<?php echo esc_attr($wid); ?>" class="msq-modal__title"></h3>

                        <div class="msq-modal__cols">
                            <div class="msq-col">
                                <div class="msq-col__title"><?php esc_html_e('Estas são as opções corretas:', 'ead'); ?></div>
                                <ul class="msq-list msq-list--key"></ul>
                            </div>
                            <div class="msq-col">
                                <div class="msq-col__title"><?php esc_html_e('O que você marcou:', 'ead'); ?></div>
                                <ul class="msq-list msq-list--you"></ul>
                            </div>
                        </div>

                        <div class="msq-feedback" style="display:none;">
                            <div class="msq-col__title"><?php esc_html_e('Feedback:', 'ead'); ?></div>
                            <ul class="msq-list msq-list--feedback"></ul>
                        </div>

                        <div class="msq-modal__footer">
                            <button class="msq-btn msq-btn--secondary msq-modal__close">
                                <?php esc_html_e('', 'ead'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    private function render_icon_to_string($icon_control){
        if (empty($icon_control['value'])) return '';
        ob_start();
        Icons_Manager::render_icon($icon_control, ['aria-hidden' => 'true']);
        return ob_get_clean();
    }
}
