(function ($) {
    $(document).ready(function () {
        if (typeof checkboxQuestionConfig !== 'undefined') {
            const isDebugMode = checkboxQuestionConfig.isDebugMode;

            if (isDebugMode) {
                console.log('Modo Debug Ativado: Logs do console serão exibidos.');
            }

            function debugLog(...args) {
                if (isDebugMode) {
                    console.log(...args);
                }
            }

            debugLog('Documento pronto. Inicializando o widget de perguntas.');

            // Esconde os botões no início para cada widget
            $('.checkbox-question-widget').each(function () {
                const $widget = $(this);
                $widget.find('.checkbox-question-check-button').hide();
                $widget.find('.checkbox-question-solve-button').hide();
                $widget.find('.checkbox-question-reset-button').hide();
                debugLog('Botões ocultos para o widget:', $widget.attr('id'));
            });

            // Evento change para inputs
            $('.checkbox-question-widget').on('change', '.checkbox-question-input', function () {
                var $widget = $(this).closest('.checkbox-question-widget');
                var hasChecked = $widget.find('.checkbox-question-input:checked').length > 0;
                debugLog('Evento de "change" no widget:', $widget.attr('id'), 'Opções marcadas:', hasChecked);

                if (hasChecked) {
                    $widget.find('.checkbox-question-check-button').fadeIn();
                } else {
                    $widget.find('.checkbox-question-check-button').fadeOut();
                    $widget.find('.checkbox-question-solve-button').fadeOut();
                    $widget.find('.checkbox-question-reset-button').fadeOut();
                }
            });

            function $selectedOptionName($row, index) {
                const nameAttr = 'statement_' + $row.closest('.checkbox-question-widget').attr('id').split('checkbox-question-')[1] + '_' + index;
                return nameAttr;
            }

            // Botão Verificar
            $('.checkbox-question-widget').on('click', '.checkbox-question-check-button', function () {
                var $widget = $(this).closest('.checkbox-question-widget');
                var allCorrect = true;
                debugLog('Verificando respostas para o widget:', $widget.attr('id'));

                // Remove feedback anterior
                $widget.find('.checkbox-question-feedback-icon').remove();
                $widget.find('.checkbox-question-row').removeClass('correct incorrect checked');
                $widget.find('.checkbox-question-feedback').empty();

                $widget.find('.checkbox-question-row').each(function (index) {
                    var $row = $(this);
                    var $selectedOption = $widget.find('[name="' + $selectedOptionName($row, index) + '"]:checked');

                    if ($selectedOption.length === 0) {
                        allCorrect = false;
                        $row.addClass('incorrect');
                        return true;
                    }

                    var userAnswer = $selectedOption.data('correct-value');
                    var correctAnswer = $selectedOption.data('expected-answer');
                    var isCorrect = (userAnswer === correctAnswer);

                    if (!isCorrect) {
                        allCorrect = false;
                    }

                    $row.addClass('checked');
                    var icon = isCorrect ? '✓' : '✗';
                    var iconClass = isCorrect ? 'correct' : 'incorrect';

                    // Evita duplicar ícones
                    $widget.find('[name="' + $selectedOptionName($row, index) + '"]:checked')
                        .closest('.checkbox-question-option')
                        .find('.checkbox-question-feedback-icon').remove();

                    // Aplica o ícone
                    $widget.find('[name="' + $selectedOptionName($row, index) + '"]:checked')
                        .closest('.checkbox-question-option')
                        .append('<span class="checkbox-question-feedback-icon ' + iconClass + '">' + icon + '</span>');

                    $row.addClass(isCorrect ? 'correct' : 'incorrect');
                });

                $widget.find('.checkbox-question-input').prop('disabled', true);

                $widget.find('.checkbox-question-solve-button').fadeIn();
                $widget.find('.checkbox-question-reset-button').fadeIn();
                $widget.find('.checkbox-question-check-button').fadeOut();
            });

            // Botão Solucionar
            // Botão Solucionar (CORRIGIDO para desktop + mobile)
            $('.checkbox-question-widget').on('click', '.checkbox-question-solve-button', function () {
                var $widget = $(this).closest('.checkbox-question-widget');
                debugLog('Solucionando widget:', $widget.attr('id'));

                $widget.find('.checkbox-question-feedback-icon').remove();
                $widget.find('.checkbox-question-row').removeClass('correct incorrect checked');
                $widget.find('.checkbox-question-feedback').empty();

                $widget.find('.checkbox-question-row').each(function (index) {
                    var $row = $(this);
                    var name = $selectedOptionName($row, index);
                    var correctAnswerValue = $row.find('.checkbox-question-input').first().data('expected-answer');

                    // Encontra todos os inputs correspondentes (desktop e mobile) com o mesmo name e valor correto
                    var $correctInputs = $widget.find('input[name="' + name + '"][data-correct-value="' + correctAnswerValue + '"]');

                    // Marca como checked e adiciona o ícone de feedback
                    $correctInputs.each(function () {
                        var $input = $(this);
                        $input.prop('checked', true);
                        $input.closest('.checkbox-question-option').find('.checkbox-question-feedback-icon').remove();
                        $input.closest('.checkbox-question-option')
                            .append('<span class="checkbox-question-feedback-icon correct">✓</span>');
                    });

                    $row.addClass('checked correct');
                });

                $widget.find('.checkbox-question-input').prop('disabled', true);
                $widget.find('.checkbox-question-reset-button').fadeIn();
                $widget.find('.checkbox-question-solve-button').fadeOut();
                $widget.find('.checkbox-question-check-button').fadeOut();
            });


            // Botão Reiniciar
            $('.checkbox-question-widget').on('click', '.checkbox-question-reset-button', function () {
                var $widget = $(this).closest('.checkbox-question-widget');
                debugLog('Reiniciando widget:', $widget.attr('id'));

                $widget.find('.checkbox-question-input').prop('checked', false).prop('disabled', false);
                $widget.find('.checkbox-question-row').removeClass('correct incorrect checked');
                $widget.find('.checkbox-question-feedback-icon').remove();
                $widget.find('.checkbox-question-feedback').empty().removeClass('feedback-correct feedback-incorrect');

                $widget.find('.checkbox-question-check-button').hide();
                $widget.find('.checkbox-question-solve-button').hide();
                $widget.find('.checkbox-question-reset-button').hide();
            });
        }

    });
})(jQuery);