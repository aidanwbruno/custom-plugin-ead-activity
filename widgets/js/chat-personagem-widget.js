
document.addEventListener("DOMContentLoaded", function () {
    if (typeof chatPersonagemConfig !== 'undefined') {
        const isDebugMode = chatPersonagemConfig.isDebugMode;

        // Função de debug com escopo local
        function debugLog(...args) {
            if (isDebugMode) {
                console.log('[Chat Debug]', ...args);
            }
        }

        debugLog('Modo Debug Ativado', isDebugMode);
        debugLog('Configurações do Widget:', chatPersonagemConfig);

        const chatContainers = document.querySelectorAll('[id^="chat-container-"]');
        debugLog(`Encontrados ${chatContainers.length} contêineres de chat`);

        chatContainers.forEach((container) => {
            const widgetId = container.id.split("-")[2];
            debugLog(`Processando widget ID: ${widgetId}`);

            const speechBubbles = container.querySelectorAll(`.speech-bubble-${widgetId}`);
            const prevButtonContainer = container.querySelector('.arrow-buttons-left');
            const nextButtonContainer = container.querySelector('.arrow-buttons-right');
            const startButton = container.querySelector(`.start-bubble-${widgetId}`);
            const prevButton = container.querySelector(`.prev-bubble-${widgetId}`);
            const nextButton = container.querySelector(`.next-bubble-${widgetId}`);

            debugLog(`Widget ${widgetId} - Elementos encontrados:`, {
                speechBubbles: speechBubbles.length,
                prevButtonContainer: !!prevButtonContainer,
                nextButtonContainer: !!nextButtonContainer,
                startButton: !!startButton,
                prevButton: !!prevButton,
                nextButton: !!nextButton
            });

            let currentBubbleIndex = 0;
            const totalBubbles = speechBubbles.length;

            debugLog(`Widget ${widgetId} - Total de balões: ${totalBubbles}`);

            // Se não houver mais de 1 balão, não faz nada
            if (totalBubbles <= 1) {
                debugLog(`Widget ${widgetId} - Apenas 1 balão encontrado, saindo`);
                return;
            }

            function updateButtonsVisibility() {
                debugLog(`Widget ${widgetId} - Atualizando botões (índice atual: ${currentBubbleIndex})`);

                // Esconder todos os botões inicialmente
                if (prevButtonContainer) prevButtonContainer.style.display = 'none';
                if (nextButtonContainer) nextButtonContainer.style.display = 'none';
                if (startButton) startButton.style.display = 'none';

                // Primeiro balão - mostrar apenas Start
                if (currentBubbleIndex === 0) {
                    if (startButton) {
                        startButton.style.display = 'inline-block';
                        debugLog(`Widget ${widgetId} - Mostrando botão Start`);
                    }
                    return;
                }

                // Mostrar botão Prev em todos os balões exceto o primeiro
                if (prevButtonContainer) {
                    prevButtonContainer.style.display = 'inline-block';
                    debugLog(`Widget ${widgetId} - Mostrando botão Prev`);
                }

                // Mostrar botão Next se não for o último balão
                if (currentBubbleIndex < totalBubbles - 1) {
                    if (nextButtonContainer) {
                        nextButtonContainer.style.display = 'inline-block';
                        debugLog(`Widget ${widgetId} - Mostrando botão Next`);
                    }
                } else {
                    debugLog(`Widget ${widgetId} - Último balão, ocultando botão Next`);
                }
            }

            // Mostrar primeiro balão
            speechBubbles[currentBubbleIndex].style.display = 'block';
            debugLog(`Widget ${widgetId} - Mostrando balão inicial (índice ${currentBubbleIndex})`);
            updateButtonsVisibility();

            // Evento do botão Start
            if (startButton) {
                startButton.addEventListener('click', function () {
                    debugLog(`Widget ${widgetId} - Botão Start clicado`);
                    speechBubbles[currentBubbleIndex].style.display = 'none';
                    currentBubbleIndex = 1;
                    speechBubbles[currentBubbleIndex].style.display = 'block';
                    updateButtonsVisibility();
                });
            }

            // Evento do botão Next
            if (nextButton) {
                nextButton.addEventListener('click', function () {
                    debugLog(`Widget ${widgetId} - Botão Next clicado (indo para ${currentBubbleIndex + 1})`);
                    speechBubbles[currentBubbleIndex].style.display = 'none';
                    currentBubbleIndex++;
                    speechBubbles[currentBubbleIndex].style.display = 'block';
                    updateButtonsVisibility();
                });
            }

            // Evento do botão Prev
            if (prevButton) {
                prevButton.addEventListener('click', function () {
                    debugLog(`Widget ${widgetId} - Botão Prev clicado (voltando para ${currentBubbleIndex - 1})`);
                    speechBubbles[currentBubbleIndex].style.display = 'none';
                    currentBubbleIndex--;
                    speechBubbles[currentBubbleIndex].style.display = 'block';
                    updateButtonsVisibility();
                });
            }
        });
    }


});