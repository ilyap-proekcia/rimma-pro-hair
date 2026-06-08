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

    wp_enqueue_style( 'rimma-global', $uri . '/assets/css/global.css', [], $ver );
    wp_enqueue_style( 'rimma-landing', $uri . '/assets/css/landing.css', [ 'rimma-global' ], $ver );
    wp_enqueue_script( 'rimma-main', $uri . '/assets/js/main.js', [], $ver, true );
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
   SANITIZE HELPERS
   ============================================================ */

function rimma_sanitize_html( $value ) {
    return wp_kses( $value, [ 'br' => [], 'strong' => [], 'em' => [] ] );
}

/* ============================================================
   CUSTOMIZER
   ============================================================ */

add_action( 'customize_register', function ( $c ) {

    /* ---- CONTACTS (глобальні — хедер + контакт-секція) ---- */

    $c->add_section( 'rimma_contacts', [
        'title'    => '📞 Контакти',
        'priority' => 20,
    ] );

    rimma_add( $c, 'contact_phone_display', 'rimma_contacts', 'Телефон (відображення)', '+38 050 957 58 78', 'text' );
    rimma_add( $c, 'contact_phone_tel',     'rimma_contacts', 'Телефон для href (без пробілів)', '+380509575878', 'text' );
    rimma_add( $c, 'contact_address',       'rimma_contacts', 'Адреса (хедер)', "м.Київ, Осокорки/Позняки,\nвул. Срібнокільська 1", 'textarea' );
    rimma_add( $c, 'contact_address_popup', 'rimma_contacts', 'Адреса (балун на карті)', "м. Київ, Позняки/Осокорки,\nвул. Срібнокільська 1", 'textarea' );
    rimma_add( $c, 'contact_maps_url',      'rimma_contacts', 'Google Maps посилання', 'https://maps.google.com/?q=вул.+Срібнокільська+1,+Київ', 'url' );
    rimma_add( $c, 'contact_telegram_url',  'rimma_contacts', 'Telegram посилання', 'https://t.me/+380509575878', 'url' );
    rimma_add( $c, 'contact_viber_url',     'rimma_contacts', 'Viber посилання', 'viber://chat?number=%2B380509575878', 'text' );

    /* ---- HERO ---- */

    $c->add_section( 'rimma_hero', [
        'title'    => '🖼 Hero — головний екран',
        'priority' => 30,
    ] );

    rimma_add( $c, 'hero_title',    'rimma_hero', 'Заголовок H1', 'Передбачуваний результат фарбування, у якому ви впевнені на&nbsp;100%', 'textarea' );
    rimma_add( $c, 'hero_desc',     'rimma_hero', 'Опис', 'Фарбування будь-якої складності: AirTouch, блонд, вихід з чорного, камуфляж сивини та точні стрижки з гарантією дбайливого ставлення до вашого волосся', 'textarea' );
    rimma_add( $c, 'hero_btn1',     'rimma_hero', 'Кнопка 1 (біла)', 'Записатися на процедуру', 'text' );
    rimma_add( $c, 'hero_btn2',     'rimma_hero', 'Кнопка 2 (контур)', 'Безкоштовна консультація', 'text' );
    rimma_add( $c, 'header_cta',    'rimma_hero', 'Кнопка в хедері', 'Записатися', 'text' );
    rimma_add( $c, 'header_tagline','rimma_hero', 'Підпис логотипу (хедер)', "Колорист,\nперукар", 'text' );

    /* ---- SERVICES ---- */

    $c->add_section( 'rimma_services', [
        'title'    => '💇 Послуги',
        'priority' => 40,
    ] );

    rimma_add( $c, 'services_title', 'rimma_services', 'Заголовок секції', "Послуги, які\nтрансформують ваш образ", 'textarea' );
    rimma_add( $c, 'services_btn',   'rimma_services', 'Кнопка', 'Записатися на процедуру', 'text' );

    $services_defaults = [
        1 => [ 'AirTouch, Balayage,<br>Shatush, Мелірування',        'М'які переливи кольору з ефектом «сонячних бликів». Малюнок непомітно відростає, звільняючи вас від частих візитів до майстра — результат тримається 3–4 місяці.' ],
        2 => [ 'Фарбування в один тон /<br>Камуфляж сивини',         'Глибокий, насичений і стійкий колір, який на 100% перекриває сивину, повертаючи волосяним цибулинам силу, а пасмам — глянцевий блиск.' ],
        3 => [ 'Чистий блонд',                                        'Рівний, дорогий відтінок без небажаної жовтизни. Максимальне збереження м'якості, щільності та природного блиску волосся навіть при тотальному висвітленні.' ],
        4 => [ 'Вихід з чорного /<br>Виправлення кольору',           'Дбайливе видалення накопиченого темного пігменту або ліквідація «плям» після інших салонів. Повернення волоссю чистого відтінку без втрати довжини.' ],
        5 => [ 'Контуринг',                                           'Сяючі акценти навколо обличчя, які освіжають образ та додають зачісці об'єму. Ідеальний компроміс між змінами та збереженням натурального кольору.' ],
        6 => [ 'Жіноча стрижка',                                      'Персональна архітектура форми під вашу текстуру волосся та овал обличчя. Стрижка укладається вдома швидко і без зусиль.' ],
    ];

    foreach ( $services_defaults as $n => [ $title, $desc ] ) {
        rimma_add( $c, "service_{$n}_title", 'rimma_services', "Послуга $n — назва", $title, 'textarea' );
        rimma_add( $c, "service_{$n}_desc",  'rimma_services', "Послуга $n — опис",  $desc,  'textarea' );
    }

    /* ---- FEARS ---- */

    $c->add_section( 'rimma_fears', [
        'title'    => '😨 Страхи',
        'priority' => 50,
    ] );

    rimma_add( $c, 'fears_title', 'rimma_fears', 'Заголовок секції', 'Позбавляємо від страхів перед візитом до колориста', 'textarea' );

    $fears_defaults = [
        1 => [ '«Раптом мені зроблять не той відтінок?»',                      'Ми наочно розбираємо та узгоджуємо майбутній колір за палітрою. Ви побачите й зрозумієте реальний результат ще до того, як майстер візьме до рук пензлик.' ],
        2 => [ '«Фарбування спалить і зіпсує моє волосся»',                    'Робота на м'яких преміум-системах (Wella, Inebrya, Helen Seward, Viart, Tempting). На кожному етапі структура волосся захищена, плюс ви отримуєте глибокий відновлювальний догляд у подарунок.' ],
        3 => [ '«Сума в чеку наприкінці процедури стане сюрпризом»',           'Повна фінансова прозорість. Точний алгоритм дій та фінальна вартість фіксуються під час консультації й не змінюються в процесі.' ],
    ];

    foreach ( $fears_defaults as $n => [ $title, $desc ] ) {
        rimma_add( $c, "fear_{$n}_title", 'rimma_fears', "Страх $n — заголовок", $title, 'textarea' );
        rimma_add( $c, "fear_{$n}_desc",  'rimma_fears', "Страх $n — опис",      $desc,  'textarea' );
    }

    /* ---- STEPS ---- */

    $c->add_section( 'rimma_steps', [
        'title'    => '✅ 5 кроків',
        'priority' => 60,
    ] );

    rimma_add( $c, 'steps_title', 'rimma_steps', 'Заголовок секції', '5 кроків до ідеального кольору', 'textarea' );

    $steps_defaults = [
        1 => [ 'Оцінка якості',    'Детально дивимося на поточний стан та пористість волосся' ],
        2 => [ 'Перевірка ресурсу','Визначаємо, яке навантаження волосся витримає без втрати здоров'я.' ],
        3 => [ 'Тест-прядка',      'Якщо ситуація складна, робимо приховану пробу, щоб на 100% спрогнозувати поведінку пігменту' ],
        4 => [ 'Підбір варіантів', 'Пропонуємо техніки та відтінки, які підійдуть саме вам.' ],
        5 => [ 'Розрахунок вартості','Фіксуємо ціну та точний час процедури до початку роботи.' ],
    ];

    foreach ( $steps_defaults as $n => [ $title, $desc ] ) {
        rimma_add( $c, "step_{$n}_title", 'rimma_steps', "Крок $n — назва", $title, 'text' );
        rimma_add( $c, "step_{$n}_desc",  'rimma_steps', "Крок $n — опис",  $desc,  'textarea' );
    }

    /* ---- ABOUT ---- */

    $c->add_section( 'rimma_about', [
        'title'    => '👩 Про майстра',
        'priority' => 70,
    ] );

    rimma_add( $c, 'about_title',      'rimma_about', 'Заголовок', "Мій фокус — тільки\nпрофесійна колористика,\nзбереження здоров'я\nволосся та стрижки", 'textarea' );
    rimma_add( $c, 'about_name',       'rimma_about', 'Ім'я майстра', 'Римма Велькоброда', 'text' );
    rimma_add( $c, 'about_role',       'rimma_about', 'Посада', 'Колорист, парикмахер', 'text' );
    rimma_add( $c, 'about_years',      'rimma_about', 'Роки досвіду (число)', '25', 'text' );
    rimma_add( $c, 'about_badge_text', 'rimma_about', 'Текст бейджу', 'років досвіду і&nbsp;вдосконалювання', 'text' );
    rimma_add( $c, 'about_cta_title',  'rimma_about', 'CTA заголовок', 'Отримайте безкоштовну консультацію для вашого волосся', 'textarea' );
    rimma_add( $c, 'about_cta_btn',    'rimma_about', 'CTA кнопка', 'Отримати консультацію', 'text' );

    /* ---- FOOTER ---- */

    $c->add_section( 'rimma_footer', [
        'title'    => '🔻 Footer',
        'priority' => 80,
    ] );

    rimma_add( $c, 'footer_copy',    'rimma_footer', 'Копірайт', 'Rimma — Всі права захищені © 2026', 'text' );
    rimma_add( $c, 'footer_link1',   'rimma_footer', 'Посилання 1 — текст', 'Політика конфіденційності', 'text' );
    rimma_add( $c, 'footer_link1_url','rimma_footer', 'Посилання 1 — URL', '#', 'url' );
    rimma_add( $c, 'footer_link2',   'rimma_footer', 'Посилання 2 — текст', 'Політика куки', 'text' );
    rimma_add( $c, 'footer_link2_url','rimma_footer', 'Посилання 2 — URL', '#', 'url' );
    rimma_add( $c, 'footer_credit_url','rimma_footer', 'Кредит розробника — URL', 'https://t.me/il_pi', 'url' );

} );

/* ---- Хелпер: додає setting + control одним викликом ---- */
function rimma_add( $c, $id, $section, $label, $default, $type ) {
    $sanitize = match ( $type ) {
        'url'      => 'esc_url_raw',
        'textarea' => 'rimma_sanitize_html',
        default    => 'sanitize_text_field',
    };

    $c->add_setting( $id, [
        'default'           => $default,
        'sanitize_callback' => $sanitize,
    ] );

    $c->add_control( $id, [
        'label'   => $label,
        'section' => $section,
        'type'    => $type === 'url' ? 'url' : ( $type === 'textarea' ? 'textarea' : 'text' ),
    ] );
}
