(function($){
  'use strict';

  /* ===== Utils ===== */
  function readData($wrap){
    var $data = $wrap.find('script.ead-animated-tabs-data').first();
    if(!$data.length) return [];
    try{
      var raw = $data.text() || '[]';
      var json = JSON.parse(raw);
      return Array.isArray(json) ? json : [];
    }catch(e){
      console.error('[Animated Tabs] JSON inválido', e);
      return [];
    }
  }

  // Lê a largura global da imagem (controle responsivo via CSS var)
  function getGlobalImgPercent($wrap){
    var val = getComputedStyle($wrap[0]).getPropertyValue('--img-col-w') || '40%';
    var n = parseFloat(val);
    if (isNaN(n)) n = 40;
    return Math.max(10, Math.min(100, n));
  }

  function applyGlobalWidth($wrap){
    var imgPerc = getGlobalImgPercent($wrap);
    $wrap.find('.ead-animated-tabcard.with-image').each(function(){
      var $card = $(this);
      var $imgCol = $card.find('> .imgcol');
      var $contentCol = $card.find('> .contentcol');
      $imgCol.css({ flex:'0 0 '+imgPerc+'%', maxWidth: imgPerc+'%' });
      $contentCol.css({ flex:'1 1 '+(100-imgPerc)+'%', maxWidth: (100-imgPerc)+'%' });
    });
  }

  /* ===== DOM ===== */
  function buildTabs($wrap, items){
    var $nav = $wrap.find('.ead-animated-tabs-nav');
    $nav.empty();
    items.forEach(function(it, i){
      var $b = $('<button>',{
        class: 'ead-animated-tab' + (i===0?' is-active':''),
        type: 'button',
        role: 'tab',
        'aria-selected': i===0 ? 'true' : 'false',
        'aria-controls': 'tabcard-'+i,
        id: 'tabbtn-'+i,
        text: it.title || ('Item '+(i+1))
      });
      $nav.append($b);
    });
  }

  function buildCards($wrap, items){
    var $list = $wrap.find('.ead-animated-tabs-cards');
    $list.empty();

    items.forEach(function(card, i){
      var $li = $('<li>', {
        class: 'ead-animated-tabcard' + (i===0?' is-current':''),
        id: 'tabcard-'+i,
        role: 'tabpanel',
        'aria-labelledby': 'tabbtn-'+i,
        'aria-hidden': i===0 ? 'false' : 'true'
      });

      var withImage = (card && card.use_image === 'yes' && card.image && card.image.url);
      var pos = (card && card.image_position) || 'left';

      // radius
      var r = card.image_radius || {};
      var unit = r.unit || 'px';
      var radiusCss = [(r.top??16)+unit,(r.right??16)+unit,(r.bottom??16)+unit,(r.left??16)+unit].join(' ');

      if(withImage){
        $li.addClass('with-image');

        var $imgCol = $('<div class="imgcol">').css({
          borderRadius: radiusCss, overflow: 'hidden'
        });
        var $img = $('<img>', { src: card.image.url }).css({ borderRadius: radiusCss });

        var $contentCol = $('<div class="contentcol">');

        if(card.title) $contentCol.append($('<h3>',{ class:'ead-animated-tabcard-title', html: card.title }));
        if(card.show_divider === 'yes') $contentCol.append($('<hr>',{ class:'ead-animated-tabcard-divider' }));
        $contentCol.append($('<div>',{ class:'ead-animated-tabcard-content', html: card.content || '' }));

        if(pos === 'right'){
          $li.append($contentCol, $imgCol.append($img));
        }else{
          $li.append($imgCol.append($img), $contentCol);
        }
      } else {
        var $contentCol = $('<div class="contentcol">');
        if (card.title) $contentCol.append($('<h3>', { class:'ead-animated-tabcard-title', html: card.title }));
        if (card.show_divider === 'yes') $contentCol.append($('<hr>', { class:'ead-animated-tabcard-divider' }));
        $contentCol.append($('<div>', { class:'ead-animated-tabcard-content', html: card.content || '' }));
        $li.append($contentCol);
      }

      $list.append($li);
    });
  }

  /* ===== Wire ===== */
  function wire($wrap){
    var $nav = $wrap.find('.ead-animated-tabs-nav');
    var $cards = $wrap.find('.ead-animated-tabs-cards .ead-animated-tabcard');

    // remove classe de saída ao terminar animação
    $wrap.on('animationend', '.ead-animated-tabcard.is-leaving', function(){
      $(this).removeClass('is-leaving').attr('aria-hidden','true');
    });

    $nav.on('click', '.ead-animated-tab', function(){
      var $btn = $(this);
      var idx = $btn.index();

      // botões
      $nav.find('.ead-animated-tab').removeClass('is-active').attr('aria-selected','false');
      $btn.addClass('is-active').attr('aria-selected','true');

      // cards
      var $current = $cards.filter('.is-current').first();
      var $next = $cards.eq(idx);
      if(!$next.length || $next[0] === $current[0]) return;

      $current.removeClass('is-current').addClass('is-leaving');
      $next.addClass('is-current').attr('aria-hidden','false');
    });
  }

  /* ===== Init ===== */
  function init($scope){
    var $wrap = $scope.find('.ead-animated-tabs').first();
    if(!$wrap.length || $wrap.data('ready')) return;
    $wrap.data('ready', true);

    var items = readData($wrap);
    if(!items.length) return;

    buildTabs($wrap, items);
    buildCards($wrap, items);
    wire($wrap);

    applyGlobalWidth($wrap);
    $(window).on('resize.animatedTabs', function(){ applyGlobalWidth($wrap); });

    $wrap.find('img').each(function(){
      if(this.complete) return;
      $(this).one('load', function(){ applyGlobalWidth($wrap); });
    });
  }

  // Elementor
  $(window).on('elementor/frontend/init', function(){
    elementorFrontend.hooks.addAction('frontend/element_ready/animated_cards_tabs_widget.default', init);
  });
  // Fallback
  $(function(){ $('.elementor-widget-animated_cards_tabs_widget').each(function(){ init($(this)); }); });

})(jQuery);
