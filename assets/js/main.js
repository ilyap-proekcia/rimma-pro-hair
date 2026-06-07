/* ============================================================
   FAN CONFIG — живе редагування через debug-панель (Ctrl+Shift+D)
   ============================================================ */
const fanConfig = {
  rotationStep: 15,    // градусів між картками
  scrollPerStep: 300,  // px скролу на один крок
  originY: 450,        // % transform-origin Y (точка обертання нижче картки)
  cardTopVw: 15,       // vw — відстань карток від верху fan-зони
  initial: 0,          // стартова активна картка (0 = перша)
};

document.addEventListener('DOMContentLoaded', () => {
  initHeroBlinds();
  initScrollAnimations();
  initFanCarousel();
  initStepsParallax();
  initFooterParallax();
  initDebugPanel();
  initMapDebugPanel();
});

/* ============================================================
   HERO — venetian blind page-load animation
   ============================================================ */
function initHeroBlinds() {
  const container = document.querySelector('.hero__blinds');
  if (!container) return;

  const COUNT = 12, DURATION = 800, STAGGER = 60, DELAY = 200;

  for (let i = 0; i < COUNT; i++) {
    const blind = document.createElement('span');
    blind.className = 'hero__blind';
    blind.style.animation =
      `blindReveal ${DURATION}ms cubic-bezier(0.25,0.74,0.22,0.99) ${DELAY + i * STAGGER}ms forwards`;
    container.appendChild(blind);
  }

  setTimeout(() => container.remove(), DELAY + (COUNT - 1) * STAGGER + DURATION);
}

/* ============================================================
   SCROLL ANIMATIONS — IntersectionObserver
   ============================================================ */
function initScrollAnimations() {
  const targets = document.querySelectorAll(
    '.animation--fade-in, .animation--slide-up, .animation--slide-right, .animation--image-in, .animation--image-clip-in, .step-card'
  );
  if (!targets.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-inview');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.06, rootMargin: '0px 0px -60px 0px' });

  targets.forEach(el => observer.observe(el));
}

/* ============================================================
   SERVICES FAN CAROUSEL
   Логіка:
   - Всі картки в одному місці, rotate() навколо точки нижче
     (--fan-origin-y у CSS) — ефект «руки карт».
   - Скрол через .services-scroll-wrapper обертає фан.
   - На мобайлі нативний тач-скрол → все працює само.
   ============================================================ */
function initFanCarousel() {
  const wrapper = document.querySelector('.js-services-wrapper');
  const section = document.querySelector('.js-services');
  const fan     = document.querySelector('.js-fan');
  if (!wrapper || !section || !fan) return;

  const cards = Array.from(fan.querySelectorAll('.service-card'));
  if (!cards.length) return;

  const STEPS = cards.length - 1 - fanConfig.initial;

  /* Обчислює позицію кнопки: card_top + 1.45 * card_height + gap
     1.45 ≈ секант(30°) — нижній край карток при повороті ±30° навколо transform-origin 430% */
  function updateButtonTop() {
    const vw         = window.innerWidth / 100;
    const cardTop    = Math.min(fanConfig.cardTopVw * vw, 134);
    const cardHeight = Math.min(550, Math.max(335, 28.65 * vw));
    const gap        = Math.min(40, Math.max(16, 2 * vw));
    document.documentElement.style.setProperty(
      '--services-btn-top', `${Math.round(cardTop + 1.45 * cardHeight + gap)}px`
    );
  }

  /* Застосовує CSS-змінні для параметрів, керованих debug-панеллю */
  function applyConfig() {
    document.documentElement.style.setProperty('--fan-origin-y',     `${fanConfig.originY}%`);
    document.documentElement.style.setProperty('--fan-card-top-vw',  `${fanConfig.cardTopVw}vw`);
    updateButtonTop();
  }
  applyConfig();

  /* Висота обгортки = заголовок + sticky-секція + scroll-space */
  function getTitleHeight() {
    const t = wrapper.querySelector('.services__title');
    return t ? t.offsetHeight : 0;
  }

  function setWrapperHeight() {
    wrapper.style.height = `${getTitleHeight() + section.offsetHeight + STEPS * fanConfig.scrollPerStep}px`;
  }
  setWrapperHeight();
  window.addEventListener('resize', () => { setWrapperHeight(); updateButtonTop(); scheduleUpdate(); });

  /* Поточна активна картка (дробове число для плавного переходу) */
  function getActiveFraction() {
    const rect     = wrapper.getBoundingClientRect();
    /* Фан стартує тільки ПІСЛЯ того як заголовок пішов за екран */
    const scrolled = Math.max(0, -rect.top - getTitleHeight());
    const maxScroll = STEPS * fanConfig.scrollPerStep;
    if (maxScroll <= 0) return fanConfig.initial;
    const progress = Math.min(1, scrolled / maxScroll);
    return fanConfig.initial + progress * STEPS;
  }

  /* Lerp-інтерполяція: currentActive плавно наздоганяє target.
     LERP = 0.12 — досить м'яко щоб не дергатись, але не надто лаговано. */
  const LERP = 0.12;
  let currentActive = getActiveFraction(); // згладжене значення
  let loopId = null;

  function applyCards(active) {
    cards.forEach((card, i) => {
      const offset  = i - active;
      const abs     = Math.abs(offset);
      const rot     = offset * fanConfig.rotationStep;
      const opacity = abs > 2.6 ? 0 : abs > 1.8 ? 0.65 : 1;
      card.style.transform = `rotate(${rot.toFixed(3)}deg)`;
      card.style.opacity   = opacity.toFixed(3);
      card.style.zIndex    = Math.round(20 - abs * 4);
    });
  }

  function loop() {
    const target = getActiveFraction();
    const diff   = target - currentActive;

    // Lerp: наближаємось на LERP частку відстані кожен кадр
    currentActive += diff * LERP;

    applyCards(currentActive);

    // Продовжуємо цикл поки є помітна різниця
    if (Math.abs(diff) > 0.001) {
      loopId = requestAnimationFrame(loop);
    } else {
      // Знімаємось з RAF — не витрачаємо ресурси в спокої
      applyCards(target);
      currentActive = target;
      loopId = null;
    }
  }

  function scheduleUpdate() {
    if (!loopId) loopId = requestAnimationFrame(loop);
  }

  window.addEventListener('scroll', scheduleUpdate, { passive: true });
  loop(); // початковий стан

  /* Відкриваємо API для debug-панелі */
  window._fanCarousel = { applyConfig, setWrapperHeight, update: scheduleUpdate, updateButtonTop, loop };
}

/* ============================================================
   STEPS — фон секції «5 кроків»
   Фон тепер керується через CSS background-attachment:fixed —
   зображення завжди зафіксовано відносно viewport (не рухається при скролі).
   JS-анімація масштабу більше не потрібна.
   ============================================================ */
function initStepsParallax() {
  /* no-op: background-attachment:fixed handles the fixed effect via CSS */
}

/* ============================================================
   FOOTER PARALLAX — контент футера виїжджає знизу вгору при reveal
   Футер sticky: bottom 0 — він прибитий до низу.
   transform: translateY(+px) зміщує його нижче viewport.
   При скролі (contact-шторка іде вгору) прогрес 0→1, translateY 60→0px.
   ============================================================ */
function initFooterParallax() {
  const footer  = document.querySelector('.footer');
  const contact = document.querySelector('.contact');
  if (!footer || !contact) return;

  const TRAVEL = 60; // px — відстань від якої виїжджає футер

  let rafPending = false;

  function update() {
    rafPending = false;
    const contactBottom = contact.getBoundingClientRect().bottom;
    const vh       = window.innerHeight;
    const footerH  = footer.offsetHeight;

    // скільки px футера вже відкрито (contact пішов вище низу viewport)
    const revealed = Math.max(0, vh - contactBottom);
    const progress = Math.min(1, revealed / footerH);

    // ease-out: плавніше на кінці
    const eased = 1 - Math.pow(1 - progress, 2);
    footer.style.transform = `translateY(${(TRAVEL * (1 - eased)).toFixed(1)}px)`;
  }

  window.addEventListener('scroll', () => {
    if (!rafPending) { rafPending = true; requestAnimationFrame(update); }
  }, { passive: true });

  update();
}

/* ============================================================
   MAP DEBUG PANEL — Ctrl+Shift+M  або  ?mapDebug в URL
   Керує CSS-змінними карти (тільки в @media ≤767px — ПК не зачіпає).
   Показує значення для копіювання у фінальний CSS.
   ============================================================ */
function initMapDebugPanel() {
  /* Дефолтні значення */
  const DEF = { w: 350, h: 240, x: -125, y: -20 };

  /* Застосовуємо CSS-змінні */
  function applyVar(key, val) {
    document.documentElement.style.setProperty(key, `${val}vw`);
  }
  applyVar('--map-mob-w', DEF.w);
  applyVar('--map-mob-h', DEF.h);
  applyVar('--map-mob-x', DEF.x);
  applyVar('--map-mob-y', DEF.y);

  const isDebug = new URLSearchParams(location.search).has('mapDebug');

  const panel = document.createElement('div');
  panel.id = 'map-debug';

  /* Безпечний діапазон X: left ≤ 0, left + width ≥ 100vw
     Тобто: x_min = -(w - 100), x_max = 0                    */
  function safeXMin(w) { return -(w - 100); }

  function makeSlider(id, label, min, max, val, step) {
    return `<label style="display:block;margin-bottom:12px;line-height:1.4">
      ${label}: <span id="dbgm-v-${id}" style="color:#ffd6a5;font-weight:600">${val}vw</span>
      <input type="range" id="dbgm-${id}" min="${min}" max="${max}"
        value="${val}" step="${step}"
        style="display:block;width:100%;margin-top:4px;accent-color:#ffd6a5;cursor:pointer">
    </label>`;
  }

  panel.innerHTML =
    `<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
       <p style="font-weight:700;font-size:13px;margin:0;color:#ffd6a5">🗺 Карта (моб)</p>
       <button id="map-debug-close" style="background:none;border:none;color:#888;font-size:18px;cursor:pointer;line-height:1;padding:0">×</button>
     </div>` +
    makeSlider('mw', 'Ширина',  100,  600,  DEF.w, 5) +
    makeSlider('mh', 'Висота',  100,  500,  DEF.h, 5) +
    makeSlider('mx', 'Зсув X',  safeXMin(DEF.w), 0, DEF.x, 2) +
    makeSlider('my', 'Зсув Y',  -200, 100,  DEF.y, 2) +
    `<div style="margin-top:10px;padding:8px;background:rgba(255,255,255,0.08);border-radius:6px">
       <p style="margin:0 0 4px;font-size:10px;color:#888">Скопіюй у фінальний CSS:</p>
       <pre id="map-debug-out" style="margin:0;font-size:10px;color:#ffd6a5;white-space:pre-wrap;word-break:break-all"></pre>
     </div>
     <p style="margin:8px 0 0;font-size:10px;color:#555">Ctrl+Shift+M — закрити</p>`;

  Object.assign(panel.style, {
    position: 'fixed', bottom: '20px', left: '20px', zIndex: '99999',
    background: 'rgba(10,10,10,0.93)', color: '#ccc',
    padding: '18px 20px', borderRadius: '14px',
    fontFamily: 'monospace', fontSize: '12px', width: '260px',
    display: isDebug ? 'block' : 'none',
    backdropFilter: 'blur(16px)', boxShadow: '0 6px 32px rgba(0,0,0,0.55)',
    lineHeight: '1.5', userSelect: 'none', touchAction: 'none',
  });

  document.body.appendChild(panel);

  document.getElementById('map-debug-close').addEventListener('click', () => {
    panel.style.display = 'none';
  });

  document.addEventListener('keydown', e => {
    if (e.ctrlKey && e.shiftKey && e.key === 'M') {
      panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
    }
  });

  function updateOutput() {
    const w = document.getElementById('dbgm-mw').value;
    const h = document.getElementById('dbgm-mh').value;
    const x = document.getElementById('dbgm-mx').value;
    const y = document.getElementById('dbgm-my').value;
    document.getElementById('map-debug-out').textContent =
      `--map-mob-w: ${w}vw;\n--map-mob-h: ${h}vw;\n--map-mob-x: ${x}vw;\n--map-mob-y: ${y}vw;`;
  }

  const wInput = document.getElementById('dbgm-mw');
  const xInput = document.getElementById('dbgm-mx');

  /* При зміні ширини — оновлюємо безпечний мін X та підрізаємо значення */
  wInput.addEventListener('input', () => {
    const w = parseFloat(wInput.value);
    document.getElementById('dbgm-v-mw').textContent = `${w}vw`;
    applyVar('--map-mob-w', w);
    const newMin = safeXMin(w);
    xInput.min = newMin;
    if (parseFloat(xInput.value) < newMin) {
      xInput.value = newMin;
      document.getElementById('dbgm-v-mx').textContent = `${newMin}vw`;
      applyVar('--map-mob-x', newMin);
    }
    updateOutput();
  });

  /* Зсув X: max завжди 0 (щоб ліво секції не оголювалось) */
  xInput.addEventListener('input', () => {
    const v = parseFloat(xInput.value);
    document.getElementById('dbgm-v-mx').textContent = `${v}vw`;
    applyVar('--map-mob-x', v);
    updateOutput();
  });

  /* Висота і Y — стандартні слайдери */
  ['mh', 'my'].forEach(id => {
    const input = document.getElementById(`dbgm-${id}`);
    const key = id === 'mh' ? '--map-mob-h' : '--map-mob-y';
    input.addEventListener('input', () => {
      const v = parseFloat(input.value);
      document.getElementById(`dbgm-v-${id}`).textContent = `${v}vw`;
      applyVar(key, v);
      updateOutput();
    });
  });

  updateOutput();
}

/* ============================================================
   DEBUG PANEL — Ctrl+Shift+D  або  ?debug в URL
   Дає можливість підбирати параметри фану в реальному часі.
   ============================================================ */
function initDebugPanel() {
  const sliders = [
    { id: 'rot',    label: 'Кут між картками',  unit: '°',  key: 'rotationStep', min: 5,   max: 40,  step: 1,   val: fanConfig.rotationStep  },
    { id: 'orig',   label: 'Origin Y',           unit: '%',  key: 'originY',      min: 100, max: 600, step: 10,  val: fanConfig.originY       },
    { id: 'scroll', label: 'Скрол / крок',       unit: 'px', key: 'scrollPerStep',min: 100, max: 800, step: 20,  val: fanConfig.scrollPerStep },
    { id: 'top',    label: 'Картки від верху',   unit: 'vw', key: 'cardTopVw',    min: 0,   max: 20,  step: 0.5, val: fanConfig.cardTopVw     },
  ];

  const panel = document.createElement('div');
  panel.id = 'fan-debug';
  panel.innerHTML =
    `<p style="font-weight:700;font-size:13px;margin:0 0 14px;color:#aefff7">⚙ Fan debug</p>` +
    sliders.map(s =>
      `<label style="display:block;margin-bottom:12px;line-height:1.4">
        ${s.label}: <span id="dbg-v-${s.id}" style="color:#aefff7;font-weight:600">${s.val}${s.unit}</span>
        <input type="range" id="dbg-${s.id}" min="${s.min}" max="${s.max}"
          value="${s.val}" step="${s.step}"
          style="display:block;width:100%;margin-top:4px;accent-color:#aefff7;cursor:pointer">
      </label>`
    ).join('') +
    `<p style="margin:10px 0 0;font-size:10px;color:#555">Ctrl+Shift+D — приховати</p>`;

  const isDebug = new URLSearchParams(location.search).has('debug');
  Object.assign(panel.style, {
    position: 'fixed', top: '20px', right: '20px', zIndex: '99999',
    background: 'rgba(10,10,10,0.93)', color: '#ccc',
    padding: '18px 20px', borderRadius: '14px',
    fontFamily: 'monospace', fontSize: '12px', width: '270px',
    display: isDebug ? 'block' : 'none',
    backdropFilter: 'blur(16px)', boxShadow: '0 6px 32px rgba(0,0,0,0.55)',
    lineHeight: '1.5', userSelect: 'none',
  });

  document.body.appendChild(panel);

  /* Toggle shortcut */
  document.addEventListener('keydown', e => {
    if (e.ctrlKey && e.shiftKey && e.key === 'D') {
      panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
    }
  });

  /* Wire sliders */
  sliders.forEach(({ id, unit, key }) => {
    const input = document.getElementById(`dbg-${id}`);
    const span  = document.getElementById(`dbg-v-${id}`);
    input.addEventListener('input', () => {
      const v = parseFloat(input.value);
      span.textContent = `${v}${unit}`;
      fanConfig[key] = v;
      if (window._fanCarousel) {
        window._fanCarousel.applyConfig();
        window._fanCarousel.setWrapperHeight();
        window._fanCarousel.update();
      }
    });
  });
}
