(function(){
  function toArr(nl){ return Array.prototype.slice.call(nl || []); }
  function $all(root, sel){ return toArr(root.querySelectorAll(sel)); }

  function decodeIcon64(str){
    try{ return atob(str || ''); }catch(e){ return ''; }
  }

  function renderList(ul, items){
    ul.innerHTML = '';
    items.forEach(it => {
      const li = document.createElement('li');

      const badge = document.createElement('span');
      badge.className = 'msq-badge ' + (it.badge || '');
      if(it.iconHTML){
        badge.innerHTML = it.iconHTML;
      }else{
        badge.textContent = it.fallback || '•';
      }

      const text = document.createElement('span');
      text.className = 'msq-item-text';
      text.innerHTML = it.text;

      li.appendChild(badge);
      li.appendChild(text);
      ul.appendChild(li);
    });
  }

  /* gera array com feedback linha a linha */
  function buildFeedback(options, selectedIdxs, icons){
    return options.map((op, idx) => {
      const txtEl = op.querySelector('.msq-text');
      const selected = selectedIdxs.includes(String(idx));
      const correct  = op.dataset.correct === '1';

      let badgeClass = '', iconHTML = '', fallback = '';
      if (selected && correct){
        badgeClass = 'msq-badge--ok'; iconHTML = icons.ok;
        fallback = '✓';
      } else if (selected && !correct){
        badgeClass = 'msq-badge--error'; iconHTML = icons.err;
        fallback = '✗';
      } else if (!selected && correct){
        badgeClass = 'msq-badge--missed'; iconHTML = icons.missed;
        fallback = '!';
      } else {
        // não selecionou e não era correta – sem erro, mas podemos mostrar um ponto neutro
        badgeClass = ''; iconHTML = ''; fallback = '•';
      }

      const text = `<strong>${txtEl ? txtEl.innerHTML : ''}</strong>` +
                   (op.dataset.feedback ? ` — ${op.dataset.feedback}` : '');

      return { text, badge: badgeClass, iconHTML, fallback };
    });
  }

  function openModal(card, title){
    const modal = card.querySelector('.msq-modal');
    modal.querySelector('.msq-modal__title').textContent = title || '';
    modal.setAttribute('aria-hidden','false');
    document.documentElement.style.overflow='hidden';
  }
  function closeModal(modal){
    modal.setAttribute('aria-hidden','true');
    document.documentElement.style.overflow='';
  }

  function resetCard(card){
    $all(card, '.msq-check').forEach(ch => ch.checked = false);
    const resetBtn = card.querySelector('.msq-btn--reset');
    if (resetBtn) resetBtn.style.display = 'none';
  }

  function initCard(card){
    const checkBtn = card.querySelector('.msq-btn--check');
    if(!checkBtn) return;

    const modal = card.querySelector('.msq-modal');

    // Fechar modal (X, overlay, botão secundário)
    $all(modal, '.msq-modal__close, .msq-modal__overlay').forEach(el => {
      el.addEventListener('click', () => closeModal(modal));
    });

    // Conferir
    checkBtn.addEventListener('click', () => {
  const options = $all(card, '.msq-option');
  const checked = $all(card, '.msq-check:checked').map(i => i.value); // array de strings

  // Gabarito (todas corretas)
  const correctItems = options
    .map((op, idx) => ({ idx, text: op.querySelector('.msq-text').innerHTML, correct: op.dataset.correct === '1' }))
    .filter(o => o.correct);

  // Tudo que o usuário marcou (correto ou não)
  const youSelected = checked.map(strIdx => {
    const idx = Number(strIdx);
    const op  = options[idx];
    return {
      idx,
      text: op.querySelector('.msq-text').innerHTML,
      correct: op.dataset.correct === '1'
    };
  });

  // Para o título (tudo certo = marcou exatamente as corretas e nada além delas)
  const numRightSelected = youSelected.filter(o => o.correct).length;
  const allCorrect = (numRightSelected === correctItems.length) && (youSelected.length === correctItems.length);
  const title = allCorrect ? checkBtn.dataset.success : checkBtn.dataset.fail;

  // Ícones personalizados vindos do Elementor (Base64 -> HTML)
  const icons = {
    key    : decodeIcon64(checkBtn.dataset.iconKey),
    you    : decodeIcon64(checkBtn.dataset.iconYou),
    ok     : decodeIcon64(checkBtn.dataset.icoOk),
    err    : decodeIcon64(checkBtn.dataset.icoErr),
    missed : decodeIcon64(checkBtn.dataset.icoMissed),
  };

  // Coluna “gabarito”
  const listKey = modal.querySelector('.msq-list--key');
  renderList(listKey, correctItems.map(o => ({
    text: o.text, badge: 'msq-badge--key', iconHTML: icons.key, fallback:'✓'
  })));

  // Coluna “O que você marcou” — mostra tudo que o usuário marcou
  const listYou = modal.querySelector('.msq-list--you');
  renderList(listYou, youSelected.map(o => ({
    text: o.text,
    badge: o.correct ? 'msq-badge--you' : 'msq-badge--error',
    iconHTML: o.correct ? icons.you : icons.err,
    fallback: o.correct ? '✓' : '✗'
  })));

  // Feedback por opção (condicional)
  const showFeedback = checkBtn.dataset.showFeedback === '1';
  const wrapFeedback = modal.querySelector('.msq-feedback');
  if (showFeedback) {
    wrapFeedback.style.display = '';
    const listFeed = modal.querySelector('.msq-list--feedback');
    const perOption = buildFeedback(options, checked, {ok:icons.ok, err:icons.err, missed:icons.missed});
    renderList(listFeed, perOption);
  } else {
    wrapFeedback.style.display = 'none';
  }

  // Mostrar modal e o botão reset
  openModal(card, title);
  const resetBtn = card.querySelector('.msq-btn--reset');
  if (resetBtn) resetBtn.style.display = 'inline-flex';
});


    // Reiniciar
    const resetBtn = card.querySelector('.msq-btn--reset');
    if (resetBtn){
      resetBtn.addEventListener('click', () => resetCard(card));
    }
  }

  /* DOM ready + Elementor editor */
  function boot(){
    document.querySelectorAll('.msq-card').forEach(initCard);
  }
  document.addEventListener('DOMContentLoaded', boot);

  window.addEventListener('elementor/frontend/init', function(){
    try{
      elementorFrontend.hooks.addAction('frontend/element_ready/multiple-selection-question.default', function($scope){
        const node = $scope[0];
        if(node) initCard(node);
      });
    }catch(e){}
  });
})();
