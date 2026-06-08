<?php

/* ============================================================
   THEME SETUP
   ============================================================ */

function rimma_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [ 'script', 'style', 'navigation-widgets' ] );
}
add_action( 'after_setup_theme', 'rimma_theme_setup' );

/* ============================================================
   ASSETS
   ============================================================ */

function rimma_enqueue_assets() {
    $ver = wp_get_theme()->get( 'Version' );
    $uri = get_template_directory_uri();

    wp_enqueue_style( 'rimma-global',  $uri . '/assets/css/global.css',  [], $ver );
    wp_enqueue_style( 'rimma-landing', $uri . '/assets/css/landing.css', [ 'rimma-global' ], $ver );
    wp_enqueue_script( 'rimma-main',   $uri . '/assets/js/main.js',      [], $ver, true );
}
add_action( 'wp_enqueue_scripts', 'rimma_enqueue_assets' );

add_action( 'wp_head', function () {
    $uri = get_template_directory_uri();
    echo '<link rel="preload" href="' . esc_url( $uri . '/assets/fonts/NeverMindSerifTitle-Regular.ttf' ) . '" as="font" type="font/truetype" crossorigin>' . "\n";
    echo '<link rel="preload" href="' . esc_url( $uri . '/assets/fonts/Roboto-Regular.ttf' ) . '" as="font" type="font/truetype" crossorigin>' . "\n";
}, 1 );

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/* ============================================================
   DEFAULTS — єдине джерело правди для всіх текстів
   Використовується і в Customizer, і на фронті через rimma_mod()
   ============================================================ */

function rimma_defaults() {
    return [
        /* Contacts */
        'contact_phone_display' => '+38 050 957 58 78',
        'contact_phone_tel'     => '+380509575878',
        'contact_address'       => "м.Київ, Осокорки/Позняки,\nвул. Срібнокільська 1",
        'contact_address_popup' => "м. Київ, Позняки/Осокорки,\nвул. Срібнокільська&nbsp;1",
        'contact_maps_url'      => 'https://maps.google.com/?q=вул.+Срібнокільська+1,+Київ',
        'contact_telegram_url'  => 'https://t.me/+380509575878',
        'contact_viber_url'     => 'viber://chat?number=%2B380509575878',

        /* Hero */
        'hero_title'     => "Передбачуваний результат фарбування, у якому ви впевнені на&nbsp;100%",
        'hero_desc'      => "Фарбування будь-якої складності: AirTouch, блонд, вихід з чорного, камуфляж сивини та точні стрижки з гарантією дбайливого ставлення до вашого волосся",
        'hero_btn1'      => 'Записатися на процедуру',
        'hero_btn2'      => 'Безкоштовна консультація',
        'header_cta'     => 'Записатися',
        'header_tagline' => "Колорист,\nперукар",

        /* Services */
        'services_title'   => "Послуги, які<br>трансформують ваш образ",
        'services_btn'     => 'Записатися на процедуру',
        'service_1_title'  => "AirTouch, Balayage,<br>Shatush, Мелірування",
        'service_1_desc'   => "М'які переливи кольору з ефектом «сонячних бликів». Малюнок непомітно відростає, звільняючи вас від частих візитів до майстра — результат тримається 3–4 місяці.",
        'service_2_title'  => "Фарбування в один тон /<br>Камуфляж сивини",
        'service_2_desc'   => "Глибокий, насичений і стійкий колір, який на 100% перекриває сивину, повертаючи волосяним цибулинам силу, а пасмам — глянцевий блиск.",
        'service_3_title'  => "Чистий блонд",
        'service_3_desc'   => "Рівний, дорогий відтінок без небажаної жовтизни. Максимальне збереження м'якості, щільності та природного блиску волосся навіть при тотальному висвітленні.",
        'service_4_title'  => "Вихід з чорного /<br>Виправлення кольору",
        'service_4_desc'   => "Дбайливе видалення накопиченого темного пігменту або ліквідація «плям» після інших салонів. Повернення волоссю чистого відтінку без втрати довжини.",
        'service_5_title'  => "Контуринг",
        'service_5_desc'   => "Сяючі акценти навколо обличчя, які освіжають образ та додають зачісці об'єму. Ідеальний компроміс між змінами та збереженням натурального кольору.",
        'service_6_title'  => "Жіноча стрижка",
        'service_6_desc'   => "Персональна архітектура форми під вашу текстуру волосся та овал обличчя. Стрижка укладається вдома швидко і без зусиль.",

        /* Fears */
        'fears_title'  => 'Позбавляємо від страхів перед візитом до колориста',
        'fear_1_title' => "«Раптом мені зроблять не той відтінок?»",
        'fear_1_desc'  => "Ми наочно розбираємо та узгоджуємо майбутній колір за палітрою. Ви побачите й зрозумієте реальний результат ще до того, як майстер візьме до рук пензлик.",
        'fear_2_title' => "«Фарбування спалить і зіпсує моє волосся»",
        'fear_2_desc'  => "Робота на м'яких преміум-системах (Wella, Inebrya, Helen Seward, Viart, Tempting). На кожному етапі структура волосся захищена, плюс ви отримуєте глибокий відновлювальний догляд у подарунок.",
        'fear_3_title' => "«Сума в чеку наприкінці процедури стане сюрпризом»",
        'fear_3_desc'  => "Повна фінансова прозорість. Точний алгоритм дій та фінальна вартість фіксуються під час консультації й не змінюються в процесі.",

        /* Steps */
        'steps_title'  => "5 кроків до ідеального кольору",
        'step_1_title' => "Оцінка якості",
        'step_1_desc'  => "Детально дивимося на поточний стан та пористість волосся",
        'step_2_title' => "Перевірка ресурсу",
        'step_2_desc'  => "Визначаємо, яке навантаження волосся витримає без втрати здоров'я.",
        'step_3_title' => "Тест-прядка",
        'step_3_desc'  => "Якщо ситуація складна, робимо приховану пробу, щоб на 100% спрогнозувати поведінку пігменту",
        'step_4_title' => "Підбір варіантів",
        'step_4_desc'  => "Пропонуємо техніки та відтінки, які підійдуть саме вам.",
        'step_5_title' => "Розрахунок вартості",
        'step_5_desc'  => "Фіксуємо ціну та точний час процедури до початку роботи.",

        /* About */
        'about_title'      => "Мій фокус — тільки<br>професійна колористика,<br>збереження здоров'я<br>волосся та стрижки",
        'about_name'       => 'Римма Велькоброда',
        'about_role'       => 'Колорист, парикмахер',
        'about_years'      => '25',
        'about_badge_text' => "років досвіду і&nbsp;вдосконалювання",
        'about_cta_title'  => 'Отримайте безкоштовну консультацію для вашого волосся',
        'about_cta_btn'    => 'Отримати консультацію',

        /* Footer */
        'footer_copy'       => 'Rimma — Всі права захищені © 2026',
        'footer_link1'      => 'Політика конфіденційності',
        'footer_link1_url'  => '#',
        'footer_link2'      => 'Політика куки',
        'footer_link2_url'  => '#',
        'footer_credit_url' => 'https://t.me/il_pi',
    ];
}

/* Читає mod з дефолтом з rimma_defaults() */
function rimma_mod( $key ) {
    $defaults = rimma_defaults();
    $default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
    return get_theme_mod( $key, $default );
}

/* ============================================================
   SANITIZE HELPERS
   ============================================================ */

function rimma_sanitize_html( $value ) {
    return wp_kses( $value, [ 'br' => [], 'strong' => [], 'em' => [] ] );
}

/* ============================================================
   CUSTOMIZER
   ============================================================ */

add_action( 'customize_register', function ( $c ) {
    $d = rimma_defaults();

    /* ---- CONTACTS ---- */
    $c->add_section( 'rimma_contacts', [ 'title' => 'Контакти', 'priority' => 20 ] );
    rimma_add( $c, 'contact_phone_display', 'rimma_contacts', 'Телефон (відображення)',          $d['contact_phone_display'], 'text' );
    rimma_add( $c, 'contact_phone_tel',     'rimma_contacts', 'Телефон для href (без пробілів)', $d['contact_phone_tel'],     'text' );
    rimma_add( $c, 'contact_address',       'rimma_contacts', 'Адреса (хедер)',                  $d['contact_address'],       'textarea' );
    rimma_add( $c, 'contact_address_popup', 'rimma_contacts', 'Адреса (балун на карті)',         $d['contact_address_popup'], 'textarea' );
    rimma_add( $c, 'contact_maps_url',      'rimma_contacts', 'Google Maps посилання',           $d['contact_maps_url'],      'url' );
    rimma_add( $c, 'contact_telegram_url',  'rimma_contacts', 'Telegram посилання',              $d['contact_telegram_url'],  'url' );
    rimma_add( $c, 'contact_viber_url',     'rimma_contacts', 'Viber посилання',                 $d['contact_viber_url'],     'text' );

    /* ---- HERO ---- */
    $c->add_section( 'rimma_hero', [ 'title' => 'Hero — головний екран', 'priority' => 30 ] );
    rimma_add( $c, 'hero_title',     'rimma_hero', 'Заголовок H1',     $d['hero_title'],     'textarea' );
    rimma_add( $c, 'hero_desc',      'rimma_hero', 'Опис',             $d['hero_desc'],      'textarea' );
    rimma_add( $c, 'hero_btn1',      'rimma_hero', 'Кнопка 1 (біла)', $d['hero_btn1'],      'text' );
    rimma_add( $c, 'hero_btn2',      'rimma_hero', 'Кнопка 2',        $d['hero_btn2'],      'text' );
    rimma_add( $c, 'header_cta',     'rimma_hero', 'Кнопка в хедері', $d['header_cta'],     'text' );
    rimma_add( $c, 'header_tagline', 'rimma_hero', 'Підпис логотипу', $d['header_tagline'], 'text' );

    /* ---- SERVICES ---- */
    $c->add_section( 'rimma_services', [ 'title' => 'Послуги', 'priority' => 40 ] );
    rimma_add( $c, 'services_title', 'rimma_services', 'Заголовок секції', $d['services_title'], 'textarea' );
    rimma_add( $c, 'services_btn',   'rimma_services', 'Кнопка',           $d['services_btn'],   'text' );
    for ( $n = 1; $n <= 6; $n++ ) {
        rimma_add( $c, "service_{$n}_title", 'rimma_services', "Послуга $n — назва", $d["service_{$n}_title"], 'textarea' );
        rimma_add( $c, "service_{$n}_desc",  'rimma_services', "Послуга $n — опис",  $d["service_{$n}_desc"],  'textarea' );
    }

    /* ---- FEARS ---- */
    $c->add_section( 'rimma_fears', [ 'title' => 'Страхи', 'priority' => 50 ] );
    rimma_add( $c, 'fears_title', 'rimma_fears', 'Заголовок секції', $d['fears_title'], 'textarea' );
    for ( $n = 1; $n <= 3; $n++ ) {
        rimma_add( $c, "fear_{$n}_title", 'rimma_fears', "Страх $n — заголовок", $d["fear_{$n}_title"], 'textarea' );
        rimma_add( $c, "fear_{$n}_desc",  'rimma_fears', "Страх $n — опис",      $d["fear_{$n}_desc"],  'textarea' );
    }

    /* ---- STEPS ---- */
    $c->add_section( 'rimma_steps', [ 'title' => '5 кроків', 'priority' => 60 ] );
    rimma_add( $c, 'steps_title', 'rimma_steps', 'Заголовок секції', $d['steps_title'], 'textarea' );
    for ( $n = 1; $n <= 5; $n++ ) {
        rimma_add( $c, "step_{$n}_title", 'rimma_steps', "Крок $n — назва", $d["step_{$n}_title"], 'text' );
        rimma_add( $c, "step_{$n}_desc",  'rimma_steps', "Крок $n — опис",  $d["step_{$n}_desc"],  'textarea' );
    }

    /* ---- ABOUT ---- */
    $c->add_section( 'rimma_about', [ 'title' => 'Про майстра', 'priority' => 70 ] );
    rimma_add( $c, 'about_title',      'rimma_about', 'Заголовок',            $d['about_title'],      'textarea' );
    rimma_add( $c, 'about_name',       'rimma_about', "Ім'я майстра",         $d['about_name'],       'text' );
    rimma_add( $c, 'about_role',       'rimma_about', 'Посада',               $d['about_role'],       'text' );
    rimma_add( $c, 'about_years',      'rimma_about', 'Роки досвіду (число)', $d['about_years'],      'text' );
    rimma_add( $c, 'about_badge_text', 'rimma_about', 'Текст бейджу',         $d['about_badge_text'], 'text' );
    rimma_add( $c, 'about_cta_title',  'rimma_about', 'CTA заголовок',        $d['about_cta_title'],  'textarea' );
    rimma_add( $c, 'about_cta_btn',    'rimma_about', 'CTA кнопка',           $d['about_cta_btn'],    'text' );

    /* ---- FOOTER ---- */
    $c->add_section( 'rimma_footer', [ 'title' => 'Footer', 'priority' => 80 ] );
    rimma_add( $c, 'footer_copy',       'rimma_footer', 'Копірайт',            $d['footer_copy'],       'text' );
    rimma_add( $c, 'footer_link1',      'rimma_footer', 'Посилання 1 — текст', $d['footer_link1'],      'text' );
    rimma_add( $c, 'footer_link1_url',  'rimma_footer', 'Посилання 1 — URL',   $d['footer_link1_url'],  'url' );
    rimma_add( $c, 'footer_link2',      'rimma_footer', 'Посилання 2 — текст', $d['footer_link2'],      'text' );
    rimma_add( $c, 'footer_link2_url',  'rimma_footer', 'Посилання 2 — URL',   $d['footer_link2_url'],  'url' );
    rimma_add( $c, 'footer_credit_url', 'rimma_footer', 'Кредит розробника',   $d['footer_credit_url'], 'url' );
} );

/* ---- Хелпер: setting + control одним рядком ---- */
function rimma_add( $c, $id, $section, $label, $default, $type ) {
    if ( $type === 'url' ) {
        $sanitize = 'esc_url_raw';
        $ctrl     = 'url';
    } elseif ( $type === 'textarea' ) {
        $sanitize = 'rimma_sanitize_html';
        $ctrl     = 'textarea';
    } else {
        $sanitize = 'sanitize_text_field';
        $ctrl     = 'text';
    }

    $c->add_setting( $id, [
        'default'           => $default,
        'sanitize_callback' => $sanitize,
    ] );

    $c->add_control( $id, [
        'label'   => $label,
        'section' => $section,
        'type'    => $ctrl,
    ] );
}
