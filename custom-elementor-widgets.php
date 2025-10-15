<?php
/*
Plugin Name: Widgets EAD
Description: Plugin para criar widgets personalizados no Elementor para o ead.
Version: 2.4
Author: Aidan W. Bruno
*/

/*
Changelog
1.7
Adicionado quiz de perguntas com feedback
--
1.8
Adicionado Opção de Navegação Horizontal no Container
Adicionado Horizontal Stepper
--
1.9
Adicionado Widget Step Click Caroussel
--
2.0
Adicionado Widget Animated cards
--
2.1
Adicionado Widget Animated cards tabs
--
2.2
Atualização, correção código checkbox question mobile.
--
2.3
Adicionado Widget Multiple Selection Question
--
2.4
Correção Responsive Widget Animated cards
--
*/

// Evitar acesso direto
if (!defined('ABSPATH')) exit;

function register_new_elementor_category( $elements_manager ) {
    $elements_manager->add_category(
        'ead', 
        [
            'title' => esc_html__( 'Widgets EAD', 'ead' ),
            'icon' => 'eicon-apps', 
        ],
        1 
    );
}
add_action( 'elementor/elements/categories_registered', 'register_new_elementor_category' );

function ead_enqueue_chat_personagem_assets() {
    wp_enqueue_style('chat-personagem-style', plugins_url('widgets/css/chat-personagem-widget.css', __FILE__));
    wp_enqueue_script('chat-personagem-script', plugins_url('widgets/js/chat-personagem-widget.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_chat_personagem_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_chat_personagem_assets');

function ead_enqueue_typing_effect_assets() {
    wp_enqueue_style('typing-effect-style', plugins_url('widgets/css/typing-effect.css', __FILE__));
    wp_enqueue_script('typing-effect-script', plugins_url('widgets/js/typing-effect.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_typing_effect_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_typing_effect_assets');

function ead_enqueue_checkbox_question_assets() {
    wp_enqueue_style('checkbox-question-style', plugins_url('widgets/css/checkbox-question.css', __FILE__));
    wp_enqueue_script('checkbox-question-script', plugins_url('widgets/js/checkbox-question.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_checkbox_question_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_checkbox_question_assets');

function ead_enqueue_popup_question_assets() {
    wp_enqueue_style('popup-question-style', plugins_url('widgets/css/popup-question-widget.css', __FILE__));
    wp_enqueue_script('popup-question-script', plugins_url('widgets/js/popup-question-widget.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_popup_question_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_popup_question_assets');

function ead_enqueue_hotspot_ead_assets() {
    wp_enqueue_style('hotspot-ead-style', plugins_url('widgets/css/hotspot-ead-widget.css', __FILE__));
    wp_enqueue_script('hotspot-ead-script', plugins_url('widgets/js/hotspot-ead-widget.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_hotspot_ead_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_hotspot_ead_assets');

function ead_enqueue_horizontal_stepper_assets() {
    wp_enqueue_style('horizontal-stepper-style', plugins_url('widgets/css/horizontal-stepper-widget.css', __FILE__));
    wp_enqueue_script('horizontal-stepper-script', plugins_url('widgets/js/horizontal-stepper-widget.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_horizontal_stepper_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_horizontal_stepper_assets');

function ead_enqueue_feedback_question_assets() {
    wp_enqueue_style('feedback-style', plugins_url('widgets/css/feedback-question-widget.css', __FILE__));
    wp_enqueue_script('feedback-script', plugins_url('widgets/js/feedback-question-widget.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_feedback_question_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_feedback_question_assets');

function ead_enqueue_step_click_caroussel_assets() {
    wp_enqueue_style('step-click-caroussel-style', plugins_url('widgets/css/step-click-caroussel-widget.css', __FILE__));
    wp_enqueue_script('step-click-caroussel-script', plugins_url('widgets/js/step-click-caroussel-widget.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_step_click_caroussel_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_step_click_caroussel_assets');

function ead_enqueue_animated_card_assets() {
    wp_enqueue_style('animated-cards-style', plugins_url('widgets/css/animated-cards-widget.css', __FILE__));
    wp_enqueue_script('animated-cards-script', plugins_url('widgets/js/animated-cards-widget.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_animated_card_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_animated_card_assets');

function ead_enqueue_animated_card_tabs_assets() {
    wp_enqueue_style('animated-cards-tabs-style', plugins_url('widgets/css/animated-cards-tabs-widget.css', __FILE__));
    wp_enqueue_script('animated-cards-tabs-script', plugins_url('widgets/js/animated-cards-tabs-widget.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_animated_card_tabs_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_animated_card_tabs_assets');

function ead_enqueue_multiple_selection_question_assets() {
    wp_enqueue_style('multiple-selection-question-style', plugins_url('widgets/css/multiple-selection-question-widget.css', __FILE__));
    wp_enqueue_script('multiple-selection-question-script', plugins_url('widgets/js/multiple-selection-question-widget.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ead_enqueue_multiple_selection_question_assets');
add_action('elementor/editor/after_enqueue_scripts', 'ead_enqueue_multiple_selection_question_assets');


// Registrar o widget com Elementor
function register_custom_elementor_widget() {
    if (did_action('elementor/loaded')) {
        require_once('widgets/chat-personagem-widget.php');
        require_once('widgets/typing-effect.php');
        require_once('widgets/checkbox-question.php');
        require_once('widgets/popup-question-widget.php');
        require_once('widgets/hotspot-ead-widget.php');
        require_once('widgets/feedback-question-widget.php');
        require_once('widgets/horizontal-stepper-widget.php');
        require_once('widgets/step-click-caroussel-widget.php');
        require_once('widgets/animated-cards-widget.php');
        require_once('widgets/animated-cards-tabs-widget.php');
        require_once('widgets/multiple-selection-question-widget.php');
        // Registro dos widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Chat_Personagem_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_CheckBox_Question());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Typing_Effect_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Question_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Hotspot_EAD_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Feedback_Question_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Horizontal_Stepper_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Step_Click_Caroussel_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Animated_Cards_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Animated_Cards_Tabs_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Multiple_Selection_Question_Widget());
        

    } else {
        // Log de depuração: Elementor não está ativo
        error_log('O Elementor não está ativo.');
    }
}

add_action('elementor/widgets/widgets_registered', 'register_custom_elementor_widget');

add_action('elementor/element/container/section_layout/after_section_end', function( $element, $args ) {
    $element->start_controls_section(
        'nead_horizontal_section',
        [
            'label' => __( 'Navegação Horizontal', 'ead' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $element->add_control(
    'nead_horizontal_enable',
    [
        'label'        => __( 'Container com Navegação Horizontal', 'ead' ),
        'type'         => \Elementor\Controls_Manager::SWITCHER,
        'label_on'     => __( 'Sim', 'ead' ),
        'label_off'    => __( 'Não', 'ead' ),
        'return_value' => 'yes',
        'default'      => 'no',
        'description'  => __( 'Se ativado, adiciona a classe "nead-horizontal" ao container para aplicar navegação horizontal.', 'ead' ),
    ]
);


    $element->end_controls_section();
}, 10, 2);

add_action('elementor/frontend/container/before_render', function( $element ) {
    $settings = $element->get_settings_for_display();
    if ( ! empty($settings['nead_horizontal_enable']) && $settings['nead_horizontal_enable'] === 'yes' ) {
        $element->add_render_attribute('_wrapper', 'class', 'nead-horizontal');
    }
});

