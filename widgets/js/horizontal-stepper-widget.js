jQuery(document).ready(function($) {
    function initHorizontalStepper(widget) {
        const steps = widget.find('.step');
        const prevArrow = widget.find('#prev-arrow');
        const nextArrow = widget.find('#next-arrow');
        const progressLine = widget.find('#progress-line');
        const stepsContainer = widget.find('.steps-container');
        const contents = widget.find('.content > div');

        let currentStep = 1;

        function positionLines() {
    if (steps.length === 0) return;

    const firstBullet = steps.first().find('.step-bullet');
    const lastBullet = steps.last().find('.step-bullet');

    const containerRect = stepsContainer[0].getBoundingClientRect();
    const firstRect = firstBullet[0].getBoundingClientRect();
    const lastRect = lastBullet[0].getBoundingClientRect();

    const left = firstRect.left + firstRect.width / 2 - containerRect.left;
    const right = lastRect.left + lastRect.width / 2 - containerRect.left;
    const width = right - left;
    const linePosition = stepsContainer.css('--progress-line-position') || '15px';

    // Atualize o estilo da linha de fundo
    stepsContainer.css({
        '--progress-line-position': linePosition
    });

    // Configure a linha de progresso
    progressLine.css({
        'left': `${left}px`,
        'width': '0px',
        'background-color': stepsContainer.css('--progress-line-active-color') || '#3b82f6',
        'height': stepsContainer.css('--progress-line-height') || '4px',
        'border-radius': stepsContainer.css('--progress-line-radius') || '2px',
        'top': linePosition
    });
}

        function updateStepper() {
            const totalSteps = steps.length;
            if (totalSteps === 0) return;

            const firstBullet = steps.first().find('.step-bullet');
            const lastBullet = steps.last().find('.step-bullet');
            const containerRect = stepsContainer[0].getBoundingClientRect();
            const firstRect = firstBullet[0].getBoundingClientRect();
            const lastRect = lastBullet[0].getBoundingClientRect();
            const left = firstRect.left + firstRect.width / 2 - containerRect.left;
            const currentBullet = steps.eq(currentStep - 1).find('.step-bullet');
            const currentRect = currentBullet[0].getBoundingClientRect();
            const currentCenter = currentRect.left + currentRect.width / 2 - containerRect.left;
            const progressWidth = currentCenter - left;
            const isMobile = window.matchMedia('(max-width: 600px)').matches;

            progressLine.css('width', isMobile ? '0' : (progressWidth > 0 ? `${progressWidth}px` : '0'));

            steps.each(function(index) {
                const stepNumber = index + 1;
                const step = $(this);
                if (isMobile) {
                    step.toggleClass('active', stepNumber === currentStep);
                } else {
                    step.toggleClass('active', stepNumber <= currentStep);
                }
            });

            contents.each(function(index) {
                const contentStep = index + 1;
                $(this).toggleClass('active', contentStep === currentStep);
            });

            if (prevArrow.length) {
                prevArrow.toggleClass('disabled', currentStep === 1);
            }
            if (nextArrow.length) {
                nextArrow.toggleClass('disabled', currentStep === totalSteps);
            }
        }

        if (prevArrow.length) {
            prevArrow.off('click').on('click', function() {
                if (currentStep > 1) {
                    currentStep--;
                    updateStepper();
                }
            });
        }

        if (nextArrow.length) {
            nextArrow.off('click').on('click', function() {
                if (currentStep < steps.length) {
                    currentStep++;
                    updateStepper();
                }
            });
        }

        steps.off('click').on('click', function() {
            currentStep = parseInt($(this).data('step'));
            updateStepper();
        });

        // Initialize on load
        positionLines();
        updateStepper();

        // Handle resize
        let resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                positionLines();
                updateStepper();
            }, 250);
        });
    }

    // Initialize widgets
    function initAllSteppers() {
        $('.elementor-widget-horizontal_stepper').each(function() {
            initHorizontalStepper($(this));
        });
    }

    // Run on document ready
    initAllSteppers();

    // Handle Elementor editor changes
    if (window.elementor) {
        elementor.hooks.addAction('panel/open_editor/widget/horizontal_stepper', function(panel, model, view) {
            panel.on('change', function(settings) {
                // Reinitialize when settings change
                setTimeout(initAllSteppers, 300);
            });
        });

        // Also run when elementor is rendered (for preview)
        elementor.hooks.addAction('frontend/element_ready/horizontal_stepper.default', function($scope) {
            initHorizontalStepper($scope);
        });
    }
});