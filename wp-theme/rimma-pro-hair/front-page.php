<?php
get_header();
$uri = get_template_directory_uri();
?>

  <!-- ============ HERO ============ -->
  <section class="hero">

    <div class="hero__blinds" aria-hidden="true"></div>

    <div class="hero__bg">
      <img src="<?php echo $uri; ?>/assets/images/hero-bg.webp" alt="" width="2178" height="1564">
    </div>

    <header class="header">
      <div class="header__left">
        <img class="header__logo" src="<?php echo $uri; ?>/assets/images/logo.svg" alt="Rimma" width="138" height="43">
        <span class="header__tagline">Колорист,<br>перукар</span>
      </div>

      <div class="header__address">
        <svg class="header__address-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" aria-hidden="true">
          <path fill="currentColor" d="M480-480q33 0 56.5-23.5T560-560q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560q0 33 23.5 56.5T480-480Zm0 294q122-112 181-203.5T720-552q0-109-69.5-178.5T480-800q-101 0-170.5 69.5T240-552q0 71 59 162.5T480-186Zm0 106Q319-217 239.5-334.5T160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 100-79.5 217.5T480-80Zm0-480Z"/>
        </svg>
        <span>м.Київ, Осокорки/Позняки,<br>вул. Срібнокільська 1</span>
      </div>

      <a class="header__phone" href="tel:+380509575878">+38 050 957 58 78</a>
      <a class="header__cta" href="#booking">Записатися</a>
      <button class="header__burger" aria-label="Меню">
        <svg width="32" height="14" viewBox="0 0 32 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <line x1="0" y1="0.75" x2="32" y2="0.75" stroke="white" stroke-width="1.5"/>
          <line x1="0" y1="13.25" x2="32" y2="13.25" stroke="white" stroke-width="1.5"/>
        </svg>
      </button>
    </header>

    <div class="hero__content">
      <h1 class="hero__title animation--fade-in">
        Передбачуваний результат фарбування, у якому ви впевнені на&nbsp;100%
      </h1>
      <p class="hero__desc animation--fade-in stagger-2">
        Фарбування будь-якої складності: AirTouch, блонд, вихід з чорного,
        камуфляж сивини та точні стрижки з гарантією дбайливого ставлення до вашого волосся
      </p>
      <div class="hero__actions animation--fade-in stagger-3">
        <a href="#booking" class="btn btn--white">Записатися на процедуру</a>
        <a href="#consultation" class="btn btn--outline">Безкоштовна консультація</a>
      </div>
    </div>

  </section>

  <!-- ============ SERVICES (sticky fan carousel) ============ -->
  <div class="services-scroll-wrapper js-services-wrapper">

    <h2 class="services__title animation--fade-in">
      Послуги, які<br>трансформують ваш образ
    </h2>

    <section class="services js-services" id="services">

      <div class="services__ellipse" aria-hidden="true"></div>

      <div class="services__fan js-fan" role="region" aria-label="Послуги">

        <article class="service-card" data-index="0">
          <img class="service-card__photo" src="<?php echo $uri; ?>/assets/images/service-1.webp" alt="AirTouch, Balayage, Shatush, Мелірування">
          <div class="service-card__inner">
            <span class="service-card__num" aria-hidden="true">1</span>
            <div class="service-card__text">
              <h3 class="service-card__title">AirTouch, Balayage,<br>Shatush, Мелірування</h3>
              <p class="service-card__desc">М'які переливи кольору з ефектом «сонячних бликів». Малюнок непомітно відростає, звільняючи вас від частих візитів до майстра — результат тримається 3–4 місяці.</p>
            </div>
          </div>
        </article>

        <article class="service-card" data-index="1">
          <img class="service-card__photo" src="<?php echo $uri; ?>/assets/images/service-2.webp" alt="Фарбування в один тон / Камуфляж сивини">
          <div class="service-card__inner">
            <span class="service-card__num" aria-hidden="true">2</span>
            <div class="service-card__text">
              <h3 class="service-card__title">Фарбування в один тон /<br>Камуфляж сивини</h3>
              <p class="service-card__desc">Глибокий, насичений і стійкий колір, який на 100% перекриває сивину, повертаючи волосяним цибулинам силу, а пасмам — глянцевий блиск.</p>
            </div>
          </div>
        </article>

        <article class="service-card" data-index="2">
          <img class="service-card__photo" src="<?php echo $uri; ?>/assets/images/service-3.webp" alt="Чистий блонд">
          <div class="service-card__inner">
            <span class="service-card__num" aria-hidden="true">3</span>
            <div class="service-card__text">
              <h3 class="service-card__title">Чистий блонд</h3>
              <p class="service-card__desc">Рівний, дорогий відтінок без небажаної жовтизни. Максимальне збереження м'якості, щільності та природного блиску волосся навіть при тотальному висвітленні.</p>
            </div>
          </div>
        </article>

        <article class="service-card" data-index="3">
          <img class="service-card__photo" src="<?php echo $uri; ?>/assets/images/service-4.webp" alt="Вихід з чорного / Виправлення кольору">
          <div class="service-card__inner">
            <span class="service-card__num" aria-hidden="true">4</span>
            <div class="service-card__text">
              <h3 class="service-card__title">Вихід з чорного /<br>Виправлення кольору</h3>
              <p class="service-card__desc">Дбайливе видалення накопиченого темного пігменту або ліквідація «плям» після інших салонів. Повернення волоссю чистого відтінку без втрати довжини.</p>
            </div>
          </div>
        </article>

        <article class="service-card" data-index="4">
          <img class="service-card__photo" src="<?php echo $uri; ?>/assets/images/service-5.webp" alt="Контуринг">
          <div class="service-card__inner">
            <span class="service-card__num" aria-hidden="true">5</span>
            <div class="service-card__text">
              <h3 class="service-card__title">Контуринг</h3>
              <p class="service-card__desc">Сяючі акценти навколо обличчя, які освіжають образ та додають зачісці об'єму. Ідеальний компроміс між змінами та збереженням натурального кольору.</p>
            </div>
          </div>
        </article>

        <article class="service-card" data-index="5">
          <img class="service-card__photo" src="<?php echo $uri; ?>/assets/images/service-6.webp" alt="Жіноча стрижка">
          <div class="service-card__inner">
            <span class="service-card__num" aria-hidden="true">6</span>
            <div class="service-card__text">
              <h3 class="service-card__title">Жіноча стрижка</h3>
              <p class="service-card__desc">Персональна архітектура форми під вашу текстуру волосся та овал обличчя. Стрижка укладається вдома швидко і без зусиль.</p>
            </div>
          </div>
        </article>

      </div>

      <div class="services__actions animation--fade-in">
        <a href="#booking" class="btn btn--white">Записатися на процедуру</a>
      </div>

    </section>
  </div>

  <!-- ============ FEARS ============ -->
  <section class="fears" id="fears">

    <div class="fears__ellipse" aria-hidden="true"></div>

    <h2 class="fears__title animation--fade-in">
      Позбавляємо від страхів перед візитом до колориста
    </h2>

    <div class="fears__media">
      <img class="fears__photo" src="<?php echo $uri; ?>/assets/images/fears-bg.webp" alt="" width="1920" height="1260">

      <div class="fears__cards">

        <article class="fear-card animation--fade-in stagger-1">
          <div class="fear-card__icon">
            <img src="<?php echo $uri; ?>/assets/images/ic_card_1.svg" alt="" aria-hidden="true">
          </div>
          <div class="fear-card__text">
            <h3 class="fear-card__title">«Раптом мені зроблять не той відтінок?»</h3>
            <p class="fear-card__desc">Ми наочно розбираємо та узгоджуємо майбутній колір за палітрою. Ви побачите й зрозумієте реальний результат ще до того, як майстер візьме до рук пензлик.</p>
          </div>
        </article>

        <article class="fear-card animation--fade-in stagger-2">
          <div class="fear-card__icon">
            <img src="<?php echo $uri; ?>/assets/images/ic_card_2.svg" alt="" aria-hidden="true">
          </div>
          <div class="fear-card__text">
            <h3 class="fear-card__title">«Фарбування спалить і зіпсує моє волосся»</h3>
            <p class="fear-card__desc">Робота на м'яких преміум-системах (Wella, Inebrya, Helen Seward, Viart, Tempting). На кожному етапі структура волосся захищена, плюс ви отримуєте глибокий відновлювальний догляд у подарунок.</p>
          </div>
        </article>

        <article class="fear-card animation--fade-in stagger-3">
          <div class="fear-card__icon">
            <img src="<?php echo $uri; ?>/assets/images/ic_card_3.svg" alt="" aria-hidden="true">
          </div>
          <div class="fear-card__text">
            <h3 class="fear-card__title">«Сума в чеку наприкінці процедури стане сюрпризом»</h3>
            <p class="fear-card__desc">Повна фінансова прозорість. Точний алгоритм дій та фінальна вартість фіксуються під час консультації й не змінюються в процесі.</p>
          </div>
        </article>

      </div>
    </div>

  </section>

  <!-- ============ STEPS ============ -->
  <section class="steps" id="steps">

    <div class="steps__inner">

      <div class="steps__left">
        <h2 class="steps__title animation--fade-in">
          5 кроків до ідеального кольору
        </h2>

        <div class="steps__portrait">
          <video autoplay muted loop playsinline>
            <source src="<?php echo $uri; ?>/assets/video/steps-video.mp4" type="video/mp4">
          </video>
        </div>
      </div>

      <div class="steps__cards">

        <article class="step-card">
          <span class="step-card__badge">Крок 1</span>
          <div class="step-card__body">
            <h3 class="step-card__title">Оцінка якості</h3>
            <p class="step-card__desc">Детально дивимося на поточний стан та пористість волосся</p>
          </div>
        </article>

        <article class="step-card">
          <span class="step-card__badge">Крок 2</span>
          <div class="step-card__body">
            <h3 class="step-card__title">Перевірка ресурсу</h3>
            <p class="step-card__desc">Визначаємо, яке навантаження волосся витримає без втрати здоров'я.</p>
          </div>
        </article>

        <article class="step-card">
          <span class="step-card__badge">Крок 3</span>
          <div class="step-card__body">
            <h3 class="step-card__title">Тест-прядка</h3>
            <p class="step-card__desc">Якщо ситуація складна, робимо приховану пробу, щоб на 100% спрогнозувати поведінку пігменту</p>
          </div>
        </article>

        <article class="step-card">
          <span class="step-card__badge">Крок 4</span>
          <div class="step-card__body">
            <h3 class="step-card__title">Підбір варіантів</h3>
            <p class="step-card__desc">Пропонуємо техніки та відтінки, які підійдуть саме вам.</p>
          </div>
        </article>

        <article class="step-card">
          <span class="step-card__badge">Крок 5</span>
          <div class="step-card__body">
            <h3 class="step-card__title">Розрахунок вартості</h3>
            <p class="step-card__desc">Фіксуємо ціну та точний час процедури до початку роботи.</p>
          </div>
        </article>

      </div>
    </div>

    <div class="steps__bottom-space" aria-hidden="true"></div>

  </section>

  <!-- ============ ABOUT ============ -->
  <section class="about" id="about">

    <div class="about__ellipse" aria-hidden="true"></div>

    <div class="about__top">

      <div class="about__photo animation--image-in">
        <img src="<?php echo $uri; ?>/assets/images/about-photo.webp" alt="Римма Велькоброда — колорист та перукар">
      </div>

      <div class="about__badge">
        <span class="about__badge-num">25</span>
        <span class="about__badge-text">років досвіду і&nbsp;вдосконалювання</span>
      </div>

      <h2 class="about__title animation--fade-in">
        Мій фокус — тільки<br>
        професійна колористика,<br>
        збереження здоров'я<br>
        волосся та стрижки
      </h2>

      <div class="about__author animation--fade-in stagger-2">
        <span class="about__name">Римма Велькоброда</span>
        <span class="about__role">Колорист, парикмахер</span>
      </div>

    </div>

    <div class="about__cta" id="consultation">
      <h3 class="about__cta-title animation--fade-in">
        Отримайте безкоштовну консультацію для вашого волосся
      </h3>
      <a href="#booking" class="about__cta-btn animation--fade-in stagger-2">
        Отримати консультацію
      </a>
    </div>

  </section>

  <!-- ============ CURTAIN WRAPPER ============ -->
  <div class="curtain-wrapper">

  <!-- ============ CONTACT ============ -->
  <section class="contact" id="booking">

    <div class="contact__map" aria-hidden="true">
      <img class="js-map-img" src="<?php echo $uri; ?>/assets/images/contact-map.webp" alt="" draggable="false">
    </div>

    <div class="contact__popup">
      <p class="contact__address">
        м. Київ, Позняки/Осокорки,<br>вул. Срібнокільська&nbsp;1
      </p>
      <a class="contact__map-link"
         href="https://maps.google.com/?q=вул.+Срібнокільська+1,+Київ"
         target="_blank" rel="noopener noreferrer">
        Дивитися на Google мапі
      </a>
    </div>

    <a class="contact__phone" href="tel:+380509575878">
      +38 050 957 58 78
    </a>

    <div class="contact__actions">

      <a class="contact__btn"
         href="https://t.me/+380509575878"
         target="_blank" rel="noopener noreferrer"
         aria-label="Написати в Telegram">
        <svg class="contact__btn-icon" width="48" height="48" viewBox="0 0 48 48" fill="none" aria-hidden="true">
          <path d="M41.5 8.1 6.1 21.3c-2.3.9-2.3 2.2-.4 2.8l9.1 2.8 21-13.3c1-.6 1.9-.3 1.2.4L18.5 31.2l-.5 9.5c.7 0 1.1-.3 1.5-.7l3.6-3.5 7.4 5.5c1.4.8 2.4.4 2.7-1.3l4.9-23c.5-2-.7-2.9-2.1-2.3z" fill="currentColor"/>
        </svg>
        Telegram
      </a>

      <a class="contact__btn"
         href="viber://chat?number=%2B380509575878"
         target="_blank" rel="noopener noreferrer"
         aria-label="Написати у Viber">
        <svg class="contact__btn-icon" width="48" height="48" viewBox="0 0 48 48" fill="none" aria-hidden="true">
          <path d="M24 6.5c-9.67 0-17.5 7.83-17.5 17.5 0 4.87 1.96 9.28 5.14 12.5l-1.97 5.97 6.3-1.96A17.4 17.4 0 0 0 24 41.5c9.67 0 17.5-7.83 17.5-17.5S33.67 6.5 24 6.5z" stroke="currentColor" stroke-width="2.5" fill="none"/>
          <path d="M31.7 27.4c-.4-.2-2.38-1.17-2.75-1.3-.37-.14-.64-.21-.91.2-.27.41-1.04 1.3-1.27 1.57-.24.27-.47.3-.87.1-.4-.2-1.68-.62-3.2-1.96-1.18-1.06-1.98-2.36-2.21-2.76-.23-.4-.02-.61.17-.81.18-.18.4-.47.6-.7.2-.23.27-.4.4-.67.14-.27.07-.5-.03-.7-.1-.2-.91-2.19-1.25-3-.32-.78-.65-.67-.9-.68h-.77c-.27 0-.7.1-1.07.5-.37.4-1.4 1.37-1.4 3.34 0 1.96 1.44 3.86 1.64 4.13.2.27 2.83 4.32 6.85 6.04 4.02 1.73 4.02 1.15 4.74 1.08.72-.07 2.33-.95 2.66-1.87.33-.91.33-1.69.23-1.85-.1-.17-.37-.27-.77-.47z" fill="currentColor"/>
        </svg>
        Viber
      </a>

    </div>

  </section>

  <footer class="footer">

    <div class="footer__left">
      <div class="footer__logo">
        <img src="<?php echo $uri; ?>/assets/images/logo.svg" alt="Rimma" width="138" height="43">
      </div>
      <span class="footer__copy">Rimma — Всі права захищені © 2026</span>
    </div>

    <nav class="footer__nav" aria-label="Нижня навігація">
      <a href="#" class="footer__link">Політика конфіденційності</a>
      <a href="#" class="footer__link">Політика куки</a>
    </nav>

    <a class="footer__credit" href="https://t.me/il_pi" target="_blank" rel="noopener noreferrer">
      Сайт створив ILYA PIVEN
    </a>

  </footer>

  </div><!-- /.curtain-wrapper -->

<?php get_footer(); ?>
