document.addEventListener('DOMContentLoaded', function () {
    if (typeof hotspotCustomConfig !== 'undefined') {
        const isDebugMode = hotspotCustomConfig.isDebugMode;

        // Fun«®«ªo de debug com escopo local
        function debugLog(...args) {
            if (isDebugMode) {
                console.log('[Hotspot Debug]', ...args);
            }
        }

        const hotspots = document.querySelectorAll('.hotspot-item');
        const hotspotContainer = document.querySelector('.hotspot-container');

        if (!hotspotContainer) {
            debugLog('Container de hotspots n«ªo encontrado.');
            return;
        }

        const showAllHotspots = hotspotContainer.getAttribute('data-show-all') === 'yes';

        debugLog(showAllHotspots)

        hotspots.forEach(hotspot => {
            hotspot.addEventListener('click', function (event) {
                event.stopPropagation();

                const hotspotId = hotspot.getAttribute('data-id');
                const popupUrl = this.getAttribute("data-popup-url");
                debugLog('Hotspot clicado: ', hotspotId);

                if (showAllHotspots) {
                    const container = document.getElementById(hotspotId);
                    if (container) {
                        container.classList.remove('hidden');
                        debugLog(`Exibindo container para o hotspot ${hotspotId}`);
                    }
                } else {
                    hotspots.forEach(hs => {
                        const otherContainerId = hs.getAttribute('data-id');
                        debugLog('Pegando IDs: ' + otherContainerId)
                        const otherContainer = document.getElementById(otherContainerId);
                        if (otherContainer) {
                            debugLog(`Ocultando container ${otherContainer}`)
                            otherContainer.classList.add('hidden');
                        }
                    });

                    // Exibe apenas o container correspondente ao hotspot clicado
                    const containerClicked = document.getElementById(hotspotId);
                    if (containerClicked) {
                        containerClicked.classList.remove('hidden');
                        debugLog(`Exibindo apenas o container do hotspot ${hotspotId}`);
                    }
                }
                if (popupUrl) {
                    if (typeof elementorProFrontend !== 'undefined' &&
                        elementorProFrontend.modules &&
                        elementorProFrontend.modules.popup) {
                        elementorProFrontend.modules.popup.showPopup({ id: popupUrl });
                    } else {
                        debugLog('elementorProFrontend.modules.popup nao esta disponivel'); 
                    }
                    
                }
            });
        });
    }

});
