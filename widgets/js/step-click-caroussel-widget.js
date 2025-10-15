jQuery(document).ready(function($) {
    function initStepClickCaroussel(widgetId) {
        const caroussel = $(`#${widgetId}`);
        if (!caroussel.length) return;

        const items = caroussel.find('.step-click-caroussel-item');
        
        items.on('click', function() {
            items.removeClass('active');
            $(this).addClass('active');
        });
    }

    // Inicialização quando o widget é carregado
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/step_click_caroussel_widget.default', function($scope) {
            const widgetId = $scope.find('.step-click-caroussel').attr('id');
            initStepClickCaroussel(widgetId);
        });
    });

    // Inicialização para widgets carregados via AJAX (como em pré-visualização)
    $('.elementor-element .step-click-caroussel').each(function() {
        const widgetId = $(this).attr('id');
        initStepClickCaroussel(widgetId);
    });
});