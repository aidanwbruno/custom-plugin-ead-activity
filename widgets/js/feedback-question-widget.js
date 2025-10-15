// Define isDebugMode e debugLog em um escopo global para que sejam acessíveis por todas as funções.
let isDebugMode = false; // Inicialize com false, o valor real será definido em DOMContentLoaded.

function debugLog(...args) {
    if (isDebugMode) {
        console.log(...args);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Agora, definimos o valor real de isDebugMode aqui.
    if (typeof feedbackQuestionConfig !== 'undefined' && typeof feedbackQuestionConfig.isDebugMode !== 'undefined') {
        isDebugMode = feedbackQuestionConfig.isDebugMode;
    }

    if (isDebugMode) {
        console.log('Modo Debug Ativado: Logs do console serão exibidos.');
    }

    // Verifica se window.questionFeedbackWidgetIds está definido e é um array.
    if (typeof window.questionFeedbackWidgetIds !== 'undefined' && Array.isArray(window.questionFeedbackWidgetIds)) {
        // Itera sobre cada widgetId e inicializa o widget de feedback.
        window.questionFeedbackWidgetIds.forEach(function(widgetId) {
            initializeFeedbackQuestionWidget(widgetId);
        });
    }

    // Exemplo de uso de debugLog dentro do DOMContentLoaded.
    debugLog('DOMContentLoaded disparado.');
    debugLog('Valor de isDebugMode:', isDebugMode);
});

function initializeFeedbackQuestionWidget(widgetId) {
    const container = document.getElementById(`question-feedback-${widgetId}`);
    if (!container) return;

    const options = container.querySelectorAll('.question-option');
    const resetButton = container.querySelector('.question-reset-button');

    const correctColor = container.dataset.correctColor || '#28a745';
    const wrongColor = container.dataset.wrongColor || '#dc3545';
    const correctIcon = container.dataset.correctIcon || 'fas fa-check';
    const wrongIcon = container.dataset.wrongIcon || 'fas fa-times';

    let hasAnswered = false;

    options.forEach(option => {
        const icon = option.querySelector('.question-option-icon');
        if (icon) option.dataset.originalIcon = icon.className;

        option.addEventListener('click', function() {
            if (hasAnswered) return;

            const isCorrect = this.dataset.isCorrect === 'yes';
            const hasFeedback = this.dataset.hasFeedback === 'yes';
            const feedback = hasFeedback ? this.querySelector('.question-feedback') : null;
            const icon = this.querySelector('.question-option-icon');

            hasAnswered = true;
            resetButton.style.display = 'block';

            options.forEach(opt => {
                const optIcon = opt.querySelector('.question-option-icon');
                if (optIcon && opt.dataset.originalIcon) {
                    optIcon.className = opt.dataset.originalIcon;
                    optIcon.style.color = '';
                }
                opt.classList.remove('selected', 'correct', 'wrong');
                const optFeedback = opt.querySelector('.question-feedback');
                if (optFeedback) optFeedback.style.display = 'none';
            });

            this.classList.add('selected', isCorrect ? 'correct' : 'wrong');

            if (icon) {
                icon.className = 'question-option-icon ' + (isCorrect ? correctIcon : wrongIcon);
                icon.style.color = isCorrect ? correctColor : wrongColor;
            }

            if (feedback) feedback.style.display = 'block';
        });
    });

    resetButton.addEventListener('click', function() {
        options.forEach(option => {
            const icon = option.querySelector('.question-option-icon');
            const feedback = option.querySelector('.question-feedback');

            if (icon && option.dataset.originalIcon) {
                icon.className = option.dataset.originalIcon;
                icon.style.color = '';
            }

            option.classList.remove('selected', 'correct', 'wrong');
            if (feedback) feedback.style.display = 'none';
        });

        hasAnswered = false;
        this.style.display = 'none';
    });
}
