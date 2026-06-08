(function(){
  const menu = document.querySelector('#main-menu');
  const toggle = document.querySelector('.nav-toggle');
  if(toggle && menu){
    toggle.addEventListener('click', () => {
      const open = menu.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    menu.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
      menu.classList.remove('open');
      toggle.setAttribute('aria-expanded', 'false');
    }));
  }

  const topBtn = document.querySelector('.scroll-top');
  window.addEventListener('scroll', () => {
    if(!topBtn) return;
    topBtn.classList.toggle('show', window.scrollY > 520);
  });
  if(topBtn){
    topBtn.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));
  }

  document.querySelectorAll('[data-carousel-target]').forEach(btn => {
    btn.addEventListener('click', () => {
      const name = btn.dataset.carouselTarget;
      const dir = Number(btn.dataset.carouselDir || 1);
      const wrap = document.querySelector(`[data-carousel-viewport="${name}"]`);
      const scroller = wrap ? wrap.querySelector('.carousel-scroller') : null;
      if(!scroller) return;
      const amount = Math.max(260, scroller.clientWidth * 0.78);
      scroller.scrollBy({left: dir * amount, behavior:'smooth'});
    });
  });

  const filterButtons = document.querySelectorAll('[data-filter]');
  const productCards = document.querySelectorAll('[data-product-card]');
  const search = document.querySelector('[data-product-search]');

  function applyProductFilter(){
    const activeBtn = document.querySelector('[data-filter].active');
    const filter = activeBtn ? activeBtn.dataset.filter : 'Todos';
    const query = search ? search.value.toLowerCase().trim() : '';
    productCards.forEach(card => {
      const category = card.dataset.category || '';
      const name = (card.dataset.name || '').toLowerCase();
      const matchesFilter = filter === 'Todos' || category === filter;
      const matchesSearch = !query || name.includes(query) || category.toLowerCase().includes(query);
      card.style.display = matchesFilter && matchesSearch ? '' : 'none';
    });
  }
  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      filterButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      applyProductFilter();
    });
  });
  if(search){ search.addEventListener('input', applyProductFilter); }
  const params = new URLSearchParams(window.location.search);
  const requestedCategory = params.get('categoria');
  if(requestedCategory){
    const target = Array.from(filterButtons).find(btn => btn.dataset.filter === requestedCategory);
    if(target){
      filterButtons.forEach(b => b.classList.remove('active'));
      target.classList.add('active');
      applyProductFilter();
    }
  }

  const quoteModal = document.querySelector('#quote-modal');
  const closeModal = document.querySelector('[data-close-modal]');
  const productInput = document.querySelector('#quote-product');
  document.querySelectorAll('[data-quote-product]').forEach(btn => {
    btn.addEventListener('click', () => {
      if(productInput){ productInput.value = btn.dataset.quoteProduct || ''; }
      if(quoteModal){ quoteModal.classList.add('show'); quoteModal.setAttribute('aria-hidden', 'false'); }
    });
  });
  if(closeModal){ closeModal.addEventListener('click', () => closeQuoteModal()); }
  if(quoteModal){
    quoteModal.addEventListener('click', (e) => {
      if(e.target === quoteModal) closeQuoteModal();
    });
  }
  function closeQuoteModal(){
    if(!quoteModal) return;
    quoteModal.classList.remove('show');
    quoteModal.setAttribute('aria-hidden', 'true');
  }

  const quickQuote = document.querySelector('#quick-quote-form');
  if(quickQuote){
    quickQuote.addEventListener('input', calculateQuickQuote);
    quickQuote.addEventListener('submit', (e) => {
      e.preventDefault();
      const data = new FormData(quickQuote);
      const msg = `Hola PRAE, quiero una cotización. Producto/servicio: ${data.get('item') || 'No indicado'}. Cantidad: ${data.get('quantity') || '1'}. Tipo: ${data.get('type') || 'No indicado'}. Urgencia: ${data.get('urgency') || 'Normal'}. Comentario: ${data.get('notes') || 'Sin comentario'}.`;
      openWhatsApp(msg);
    });
    calculateQuickQuote();
  }

  function calculateQuickQuote(){
    const base = Number(document.querySelector('[name="base_price"]')?.value || 0);
    const qty = Number(document.querySelector('[name="quantity"]')?.value || 1);
    const urgency = document.querySelector('[name="urgency"]')?.value || 'Normal';
    const type = document.querySelector('[name="type"]')?.value || 'Producto';
    let multiplier = 1;
    if(urgency === 'Urgente') multiplier += .15;
    if(type === 'Servicio') multiplier += .20;
    const estimate = base > 0 ? base * qty * multiplier : 0;
    const result = document.querySelector('#quote-result');
    if(result){
      result.textContent = estimate > 0 ? `Estimación preliminar: RD$${estimate.toLocaleString('es-DO',{minimumFractionDigits:2,maximumFractionDigits:2})}. El precio final debe ser confirmado por PRAE.` : 'Coloca un precio base si deseas calcular una estimación preliminar.';
    }
  }

  const modalForm = document.querySelector('#modal-quote-form');
  if(modalForm){
    modalForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const data = new FormData(modalForm);
      const msg = `Hola PRAE, deseo cotizar: ${data.get('product') || 'Producto no indicado'}. Cantidad: ${data.get('quantity') || '1'}. Equipo/modelo: ${data.get('model') || 'No indicado'}. Detalle: ${data.get('notes') || 'Sin detalle adicional'}.`;
      openWhatsApp(msg);
    });
  }

  function openWhatsApp(message){
    const phone = document.body.dataset.whatsapp || '18093039156';
    const url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
    window.open(url, '_blank', 'noopener');
  }

  const commentForm = document.querySelector('#comment-form');
  const commentsList = document.querySelector('#comments-list');
  const commentsKey = 'prae_public_comments';
  function renderComments(){
    if(!commentsList) return;
    const comments = JSON.parse(localStorage.getItem(commentsKey) || '[]');
    const base = [
      {name:'Cliente residencial', text:'Excelente atención y orientación antes de comprar la pieza.'},
      {name:'Técnico aliado', text:'Muy útil encontrar productos organizados por categorías.'}
    ];
    const all = base.concat(comments);
    commentsList.innerHTML = all.map(c => `<article class="comment-card"><strong>${escapeHtml(c.name)}</strong><p>${escapeHtml(c.text)}</p></article>`).join('');
  }
  if(commentForm){
    commentForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const name = commentForm.querySelector('[name="name"]').value.trim() || 'Cliente';
      const text = commentForm.querySelector('[name="comment"]').value.trim();
      if(!text) return;
      const comments = JSON.parse(localStorage.getItem(commentsKey) || '[]');
      comments.push({name,text});
      localStorage.setItem(commentsKey, JSON.stringify(comments.slice(-8)));
      commentForm.reset();
      renderComments();
    });
    renderComments();
  }

  function escapeHtml(str){
    return String(str).replace(/[&<>'"]/g, tag => ({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#039;','"':'&quot;'}[tag]));
  }
})();
