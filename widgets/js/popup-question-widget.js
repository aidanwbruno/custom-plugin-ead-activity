
function initializeWidget(widgetId) {
    if (typeof popupQuestionConfig !== 'undefined') {
        const isDebugMode = popupQuestionConfig.isDebugMode;

    if (isDebugMode) {
        console.log('Modo Debug Ativado: Logs do console serão exibidos.');
    }

    function debugLog(...args) {
        if (isDebugMode) {
            console.log(...args);
        }
    }
    debugLog("Widget initialized with ID:", widgetId);
    const widgetSelector = "#question-box-" + widgetId;
    const options = document.querySelectorAll(widgetSelector + " .optionsCustom");
    const resetButton = document.querySelector(widgetSelector + " .reset-button");
    let hasAnswered = false;

    const initialIcons = Array.from(options).map(option => {
        const iconElement = option.querySelector('i');
        return iconElement ? iconElement.className : "";
    });

    options.forEach(option => {
        option.addEventListener("click", function() {
            const correctOption = this.getAttribute("data-correct-option");
            const selectedOption = this.getAttribute("data-option-number");
            const popupUrl = this.getAttribute("data-popup-url");
            const correctIconHtml = this.getAttribute("data-correct-icon");
            const wrongIconHtml = this.getAttribute("data-wrong-icon");

            if (!hasAnswered) {
                resetButton.classList.remove('hidden');
                hasAnswered = true;
            }

            if (popupUrl) {
                elementorProFrontend.modules.popup.showPopup({ id: popupUrl });
            }

            options.forEach((opt, index) => {
                const iconElement = opt.querySelector('i');
                if (iconElement) {
                    iconElement.className = `icon-initial ${initialIcons[index]}`;
                }
                opt.querySelector('span').style.fontWeight = 'normal';
            });

            const selectedIcon = this.querySelector('i');
            if (selectedOption === correctOption) {
                if (selectedIcon) {
                    selectedIcon.className = `icon-correct ${correctIconHtml}`;
                }
                this.querySelector('span').style.fontWeight = 'bold';
            } else {
                if (selectedIcon) {
                    selectedIcon.className = `icon-wrong ${wrongIconHtml}`;
                }
                this.querySelector('span').style.fontWeight = 'bold';
            }
        });

        option.querySelector('i').addEventListener("click", function(e) {
            e.stopPropagation();
            option.click();
        });
    });

    resetButton.addEventListener("click", function() {
        options.forEach((option, index) => {
            const iconElement = option.querySelector('i');
            if (iconElement) {
                iconElement.className = `icon-initial ${initialIcons[index]}`;
            }
            option.querySelector('span').style.fontWeight = 'normal';
        });

        resetButton.classList.add('hidden');
        hasAnswered = false;
        debugLog("Respostas redefinidas e ícones restaurados para widget ID:", widgetId);
    });
    }
    
}

// Inicializa todos os widgets no DOMContentLoaded
document.addEventListener("DOMContentLoaded", function() {
    if (window.widgetIds && Array.isArray(window.widgetIds)) {
        window.widgetIds.forEach(widgetId => {
            initializeWidget(widgetId);
        });
    }
});
