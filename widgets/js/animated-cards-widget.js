(function ($) {
  'use strict';

  /* ================= Utils ================= */

  function getWidgetId($scope) {
    var $widget = $scope.closest('.elementor-widget');
    return ($widget.data('id') || $scope.attr('id') || ('ead-' + Date.now())).toString();
  }

  function readData(wrapper) {
    var $dataEl = wrapper.find('script.ead-animated-cards-data').first();
    if (!$dataEl.length) return [];
    try {
      var raw = $dataEl.text();
      if (!raw || !raw.trim()) return [];
      var json = JSON.parse(raw);
      return Array.isArray(json) ? json : [];
    } catch (e) {
      console.error('[Animated Cards] JSON inválido:', e);
      return [];
    }
  }

  function ensureIcons($wrapper) {
    var $prev = $wrapper.find('.ead-animated-cards-prev');
    var $next = $wrapper.find('.ead-animated-cards-next');
    if ($prev.length && !$prev.children().length) {
      $prev.html('<i class="eicon-chevron-left" aria-hidden="true"></i>');
    }
    if ($next.length && !$next.children().length) {
      $next.html('<i class="eicon-chevron-right" aria-hidden="true"></i>');
    }
  }

  /* ============== DOM Builder ============== */

  function buildCardsDOM(container, cards) {
    container.empty();
    var screenWidth = window.innerWidth;

    cards.forEach(function (card, index) {
      var $li = $('<li>', {
        class: 'ead-animated-card',
        id: 'ead-card-' + index,
        'data-index': index
      });

      var withImage = (card && card.use_image === 'yes' && card.image && card.image.url);
      var pos = (card && card.image_position) || 'left'; // left|right|top|bottom

      if (withImage) {
  $li.addClass('ead-animated-card-with-image ead-imgpos-' + pos);

  var imgPercent = (card.image_width && card.image_width.size) ? Number(card.image_width.size) : 100;
  $li.attr('data-imgw', imgPercent);
  $li.attr('data-pos',  pos);

  var radius = card.image_radius || {};
  var rUnit = radius.unit || 'px';
  var radiusCss = [
    (radius.top ?? 16) + rUnit,
    (radius.right ?? 16) + rUnit,
    (radius.bottom ?? 16) + rUnit,
    (radius.left ?? 16) + rUnit
  ].join(' ');

  var $imgDiv     = $('<div class="ead-animated-card-imgcol">');
  var $contentDiv = $('<div class="ead-animated-card-contentcol">');

  var $img = $('<img>', {
    src: card.image.url,
    css: { borderRadius: radiusCss } // width/height ficam no CSS
  });

  // Larguras por orientação:
  if (pos === 'left' || pos === 'right') {
    // imgPercent controla a LARGURA DA COLUNA da imagem
    var imgW = imgPercent;
    $imgDiv.css({ flex: '0 0 ' + imgW + '%', maxWidth: imgW + '%', width: imgW + '%' });
    $contentDiv.css({ flex: '0 0 ' + (100 - imgW) + '%', maxWidth: (100 - imgW) + '%', width: (100 - imgW) + '%' });
  } else {
    // vertical: coluna ocupa 100%; a IMAGEM é que segue o percent (default 100)
    $imgDiv.css({ flex: '0 0 100%', width: '100%', textAlign: 'center' });
    $contentDiv.css({ flex: '0 0 100%', width: '100%' });
    $img.css({ width: imgPercent + '%', maxWidth: '100%', margin: '0 auto' });
  }

  // Título / divisor / conteúdo
  if (card.title) {
    $contentDiv.append($('<h3>', { class: 'ead-animated-card-title', html: card.title }));
  }
  if (card && card.show_divider === 'yes') {
    $contentDiv.append($('<hr>', { class: 'ead-animated-card-divider' }));
  }
  $contentDiv.append($('<div>', { class: 'ead-animated-card-content', html: card.content || '' }));

  $imgDiv.append($img);

  // A ordem no DOM é SEMPRE imagem -> conteúdo;
  // quem inverte é a classe ead-imgpos-* (flex-direction)
  $li.append($imgDiv, $contentDiv);

} else {
        // sem imagem
        if (card && card.title) {
          $li.append($('<h3>', { class: 'ead-animated-card-title', html: card.title }));
        }
        if (card && card.show_divider === 'yes') {
          $li.append($('<hr>', { class: 'ead-animated-card-divider' }));
        }
        $li.append($('<div>', { class: 'ead-animated-card-content', html: (card && card.content) || '' }));
      }

      container.append($li);
    });
  }

  function applyResponsiveLayout(wrapper){
  var screenWidth = window.innerWidth;

  wrapper.find('.ead-animated-card-with-image').each(function(){
    var $card       = $(this);
    var pos         = $card.attr('data-pos') || 'left';
    var imgPercent  = Number($card.attr('data-imgw') || 100);
    var $imgCol     = $card.find('.ead-animated-card-imgcol').first();
    var $contentCol = $card.find('.ead-animated-card-contentcol').first();
    var $img        = $imgCol.find('img').first();

    /* ===== MOBILE: 100% + empilhado ===== */
    if (screenWidth <= 921) {
      // as classes CSS já fazem column, aqui só garantimos os widths
      $imgCol.css({ flex: '0 0 100%', width: '100%', maxWidth: '100%' });
      $contentCol.css({ flex: '0 0 100%', width: '100%', maxWidth: '100%' });
      $img.css({ width: '100%', maxWidth: '100%', height: 'auto', margin: '0' });
      return; // pula para o próximo card
    }

    /* ===== DESKTOP: lateral, respeitando o slider sem esmagar texto ===== */
    if (pos === 'left' || pos === 'right') {
      // limite de 50% p/ imagem no desktop para não comprimir o texto
      var imgW = Math.min(imgPercent, 50);
      var contentW = 100 - imgW;

      $imgCol.css({ flex: '0 0 '+imgW+'%', maxWidth: imgW+'%', width: imgW+'%' });
      $contentCol.css({ flex: '1 1 '+contentW+'%', maxWidth: contentW+'%', width: contentW+'%' });
      $img.css({ width: '100%', maxWidth: '100%', height: 'auto' });
    }
  });
}


  /* ============== Reserva de Altura ============== */

  function reserveListHeight(wrapper) {
    var $list = wrapper.find('.ead-animated-cards-list');
    var maxH = 0;
    $list.children('.ead-animated-card').each(function () {
      var h = Math.ceil($(this).outerHeight(true));
      if (h > maxH) maxH = h;
    });
    var safety = 100; /* margem extra para rotações/translates */
    if (maxH > 0) {
      $list.css('min-height', (maxH + safety) + 'px');
    }
  }

  /* ================= Core ================= */

  function wireNavigation(wrapper, ns) {
    var container = wrapper.find('.ead-animated-cards-list');
    var prevBtn = wrapper.find('.ead-animated-cards-prev');
    var nextBtn = wrapper.find('.ead-animated-cards-next');

    var cards = container.find('.ead-animated-card');
    var total = cards.length;
    var currentIndex = 0;

    function updateState() {
      cards = container.find('.ead-animated-card');
      total = cards.length;
      if (!total) return;

      cards.removeClass(
        'ead-animated-card--current ' +
        'ead-animated-card--next ' +
        'ead-animated-card--out ' +
        'ead-animated-card--no-animation ' +
        'ead-animated-card--previous'
      );

      cards.each(function (idx) {
        var $c = $(this);
        if (idx === currentIndex) {
          $c.addClass('ead-animated-card--current');
        } else if (idx === (currentIndex + 1) % total) {
          $c.addClass('ead-animated-card--next');
        } else if (idx === (currentIndex - 1 + total) % total) {
          $c.addClass('ead-animated-card--previous');
        } else {
          $c.addClass('ead-animated-card--out');
        }
      });

      prevBtn.toggleClass('hidden', currentIndex === 0);
      nextBtn.toggleClass('hidden', currentIndex === total - 1);

      reserveListHeight(wrapper);
    }

    prevBtn.off('.' + ns);
    nextBtn.off('.' + ns);

    nextBtn.on('click.' + ns, function () {
      if (currentIndex < total - 1) {
        currentIndex++;
        updateState();
        if (window.innerWidth < 921) {
          var el = container.find('.ead-animated-card--current')[0];
          if (el) el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
      }
    });

    prevBtn.on('click.' + ns, function () {
      if (currentIndex > 0) {
        currentIndex--;
        updateState();
        if (window.innerWidth < 921) {
          var el = container.find('.ead-animated-card--current')[0];
          if (el) el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
      }
    });

    updateState();

    return {
      refresh: updateState,
      setIndex: function (i) {
        currentIndex = Math.max(0, Math.min(i, total - 1));
        updateState();
      }
    };
  }

  function initialize($scope) {
    var widgetId = getWidgetId($scope);
    var ns = 'eadAnimatedCards-' + widgetId;

    var $wrapper = $scope.find('.ead-animated-cards-wrapper').first();
    if (!$wrapper.length) return;

    if ($wrapper.data('initialized')) return;
    $wrapper.data('initialized', true);

    var $container = $wrapper.find('.ead-animated-cards-list');

    // 1) Lê dados e monta DOM
    var data = readData($wrapper);
    if (!data.length) {
      ensureIcons($wrapper);
      return;
    }

    buildCardsDOM($container, data);
    applyResponsiveLayout($wrapper);
    reserveListHeight($wrapper);
    ensureIcons($wrapper);

    // Recalcular altura quando as imagens terminarem de carregar
    $container.find('img').each(function(){
      if (this.complete) return;
      $(this).one('load', function(){ reserveListHeight($wrapper); });
    });
    // Fallback tardio
    setTimeout(function(){ reserveListHeight($wrapper); }, 300);

    // 2) Navegação
    var nav = wireNavigation($wrapper, ns);

    // 3) Observa reconstrução/edições no editor
    var mo;
    try {
      mo = new MutationObserver(function () {
        var $list = $wrapper.find('.ead-animated-cards-list');
        if ($list.length && !$list.children('.ead-animated-card').length) {
          var freshData = readData($wrapper);
          if (freshData.length) {
            buildCardsDOM($list, freshData);
            applyResponsiveLayout($wrapper);
            reserveListHeight($wrapper);
            ensureIcons($wrapper);
            nav = wireNavigation($wrapper, ns);
            // listeners de imagem novamente
            $list.find('img').each(function(){
              if (this.complete) return;
              $(this).one('load', function(){ reserveListHeight($wrapper); });
            });
            setTimeout(function(){ reserveListHeight($wrapper); }, 300);
          }
        } else {
          ensureIcons($wrapper);
        }
      });
      mo.observe($wrapper[0], { childList: true, subtree: true });
      $wrapper.on('remove.' + ns, function () { try { mo.disconnect(); } catch (e) {} });
    } catch (e) {}

    // 4) Responsivo
    $(window).off('resize.' + ns).on('resize.' + ns, function () {
      clearTimeout($wrapper.data('rszTimer'));
      var t = setTimeout(function () {
        applyResponsiveLayout($wrapper);
        reserveListHeight($wrapper);
        if (nav && nav.refresh) nav.refresh();
      }, 150);
      $wrapper.data('rszTimer', t);
    });
  }

  // Elementor hook
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/animated_cards_widget.default', function ($scope) {
      initialize($scope);
    });
  });

  // Fallback manual (AJAX/SSR)
  $(function () {
    $('.elementor-widget-animated_cards_widget').each(function () {
      initialize($(this));
    });
  });

})(jQuery);
