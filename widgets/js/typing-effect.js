document.addEventListener("DOMContentLoaded", function () {
    if (typeof typingEffectConfig !== 'undefined') {
        const isDebugMode = typingEffectConfig.isDebugMode;
        debugLog('Modo debug ativado?', isDebugMode);

        // Função de debug com escopo local
        function debugLog(...args) {
            if (isDebugMode) {
                console.log('[Typing Debug]', ...args);
            }
        }

        const typingWidgets = document.querySelectorAll('.typing-effect');
        debugLog(`Encontrados ${typingWidgets.length} widgets de digitação`);

        // Função para iniciar o efeito de digitação
        function startTypingEffect(widget) {
            debugLog(`Iniciando efeito de digitação para widget: ${widget.id}`);
            
            const widgetId = widget.id;
            const text = widget.getAttribute('data-text');
            const speed = widget.getAttribute('data-speed');
            
            debugLog(`Configurações do widget ${widgetId}:`, { 
                textLength: text.length, 
                speed: speed 
            });

            let index = 0;
            let typedText = '';

            let typingInterval = setInterval(function () {
                const nextChar = text[index];
                debugLog(`Processando caractere ${index}: ${nextChar}`, { widgetId });

                if (nextChar === '<') {
                    let tag = '';
                    while (text[index] !== '>' && index < text.length) {
                        tag += text[index];
                        index++;
                    }
                    tag += '>';
                    typedText += tag;
                    debugLog(`Tag HTML encontrada: ${tag}`, { widgetId });
                } else {
                    typedText += nextChar;
                }

                document.getElementById(widgetId).innerHTML = typedText;
                index++;

                if (index === text.length) {
                    debugLog(`Efeito de digitação concluído para widget: ${widgetId}`);
                    clearInterval(typingInterval);
                }
            }, speed);
        }

        // Criação do IntersectionObserver
        const observer = new IntersectionObserver((entries, observer) => {
            debugLog(`Observer chamado com ${entries.length} entradas`);
            
            entries.forEach(entry => {
                debugLog(`Widget ${entry.target.id} visibilidade: ${entry.isIntersecting}`, {
                    intersectionRatio: entry.intersectionRatio
                });
                
                if (entry.isIntersecting) {
                    // Se o widget estiver visível, iniciar o efeito de digitação
                    debugLog(`Widget ${entry.target.id} tornou-se visível. Iniciando digitação...`);
                    startTypingEffect(entry.target);
                    observer.unobserve(entry.target); // Parar de observar após a execução
                    debugLog(`Observer removido para widget: ${entry.target.id}`);
                }
            });
        }, {
            threshold: 0.5 // O efeito é disparado quando 50% do widget estiver visível
        });

        // Observar todos os widgets com a classe 'typing-effect'
        typingWidgets.forEach(widget => {
            debugLog(`Registrando observer para widget: ${widget.id}`);
            observer.observe(widget);
        });
    } 
});