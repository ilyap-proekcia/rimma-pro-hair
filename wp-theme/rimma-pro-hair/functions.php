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
   ASSETS (фронт)
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
   ASSETS (адмін — медіапікер)
   ============================================================ */

add_action( 'admin_enqueue_scripts', function ( $hook ) {
    if ( $hook !== 'post.php' && $hook !== 'post-new.php' ) return;
    wp_enqueue_media();
    wp_enqueue_script( 'rimma-admin', get_template_directory_uri() . '/assets/js/rimma-admin.js', [ 'jquery' ], null, true );
} );

/* ============================================================
   ДЕФОЛТИ — усі тексти за замовчуванням
   ============================================================ */

function rimma_defaults() {
    return [
        'hero_title'     => "Передбачуваний результат фарбування, у якому ви впевнені на&nbsp;100%",
        'hero_desc'      => "Фарбування будь-якої складності: AirTouch, блонд, вихід з чорного, камуфляж сивини та точні стрижки з гарантією дбайливого ставлення до вашого волосся",
        'hero_btn1'      => 'Записатися на процедуру',
        'hero_btn2'      => 'Безкоштовна консультація',
        'header_cta'     => 'Записатися',
        'header_tagline' => "Колорист, перукар",

        'services_title'  => "Послуги, які трансформують ваш образ",
        'services_btn'    => 'Записатися на процедуру',
        'service_1_title' => "AirTouch, Balayage, Shatush, Мелірування",
        'service_1_desc'  => "М'які переливи кольору з ефектом «сонячних бликів». Малюнок непомітно відростає, звільняючи вас від частих візитів до майстра — результат тримається 3–4 місяці.",
        'service_2_title' => "Фарбування в один тон / Камуфляж сивини",
        'service_2_desc'  => "Глибокий, насичений і стійкий колір, який на 100% перекриває сивину, повертаючи волосяним цибулинам силу, а пасмам — глянцевий блиск.",
        'service_3_title' => "Чистий блонд",
        'service_3_desc'  => "Рівний, дорогий відтінок без небажаної жовтизни. Максимальне збереження м'якості, щільності та природного блиску волосся навіть при тотальному висвітленні.",
        'service_4_title' => "Вихід з чорного / Виправлення кольору",
        'service_4_desc'  => "Дбайливе видалення накопиченого темного пігменту або ліквідація «плям» після інших салонів. Повернення волоссю чистого відтінку без втрати довжини.",
        'service_5_title' => "Контуринг",
        'service_5_desc'  => "Сяючі акценти навколо обличчя, які освіжають образ та додають зачісці об'єму. Ідеальний компроміс між змінами та збереженням натурального кольору.",
        'service_6_title' => "Жіноча стрижка",
        'service_6_desc'  => "Персональна архітектура форми під вашу текстуру волосся та овал обличчя. Стрижка укладається вдома швидко і без зусиль.",

        'fears_title'  => 'Позбавляємо від страхів перед візитом до колориста',
        'fear_1_title' => "«Раптом мені зроблять не той відтінок?»",
        'fear_1_desc'  => "Ми наочно розбираємо та узгоджуємо майбутній колір за палітрою. Ви побачите й зрозумієте реальний результат ще до того, як майстер візьме до рук пензлик.",
        'fear_2_title' => "«Фарбування спалить і зіпсує моє волосся»",
        'fear_2_desc'  => "Робота на м'яких преміум-системах (Wella, Inebrya, Helen Seward, Viart, Tempting). На кожному етапі структура волосся захищена, плюс ви отримуєте глибокий відновлювальний догляд у подарунок.",
        'fear_3_title' => "«Сума в чеку наприкінці процедури стане сюрпризом»",
        'fear_3_desc'  => "Повна фінансова прозорість. Точний алгоритм дій та фінальна вартість фіксуються під час консультації й не змінюються в процесі.",

        'steps_title'  => "5 кроків до ідеального кольору",
        'step_1_title' => "Оцінка якості",     'step_1_desc' => "Детально дивимося на поточний стан та пористість волосся",
        'step_2_title' => "Перевірка ресурсу", 'step_2_desc' => "Визначаємо, яке навантаження волосся витримає без втрати здоров'я.",
        'step_3_title' => "Тест-прядка",       'step_3_desc' => "Якщо ситуація складна, робимо приховану пробу, щоб на 100% спрогнозувати поведінку пігменту",
        'step_4_title' => "Підбір варіантів",  'step_4_desc' => "Пропонуємо техніки та відтінки, які підійдуть саме вам.",
        'step_5_title' => "Розрахунок вартості",'step_5_desc' => "Фіксуємо ціну та точний час процедури до початку роботи.",

        'about_title'      => "Мій фокус — тільки професійна колористика, збереження здоров'я волосся та стрижки",
        'about_name'       => 'Римма Велькоброда',
        'about_role'       => 'Колорист, парикмахер',
        'about_years'      => '25',
        'about_badge_text' => "років досвіду і вдосконалювання",
        'about_cta_title'  => 'Отримайте безкоштовну консультацію для вашого волосся',
        'about_cta_btn'    => 'Отримати консультацію',

        'contact_phone_display' => '+38 050 957 58 78',
        'contact_phone_tel'     => '+380509575878',
        'contact_address'       => "м.Київ, Осокорки/Позняки, вул. Срібнокільська 1",
        'contact_address_popup' => "м. Київ, Позняки/Осокорки, вул. Срібнокільська 1",
        'contact_maps_url'      => 'https://maps.google.com/?q=вул.+Срібнокільська+1,+Київ',
        'contact_telegram_url'  => 'https://t.me/+380509575878',
        'contact_viber_url'     => 'viber://chat?number=%2B380509575878',

        'footer_copy'      => 'Rimma — Всі права захищені © 2026',
        'footer_link1'     => 'Політика конфіденційності',
        'footer_link1_url' => '#',
        'footer_link2'     => 'Політика куки',
        'footer_link2_url' => '#',
    ];
}

/* ============================================================
   ХЕЛПЕРИ ДЛЯ ЧИТАННЯ МЕТА З ДЕФОЛТОМ
   ============================================================ */

function rimma_page_id() {
    return intval( get_option( 'page_on_front' ) );
}

/* Повертає текстове значення мета або дефолт */
function rimma_get( $key ) {
    $pid = rimma_page_id();
    if ( $pid ) {
        $val = get_post_meta( $pid, 'rimma_' . $key, true );
        if ( $val !== '' && $val !== false ) return $val;
    }
    $d = rimma_defaults();
    return isset( $d[ $key ] ) ? $d[ $key ] : '';
}

/* Повертає URL зображення з медіабібліотеки або шлях до теми як fallback */
function rimma_img_url( $key, $fallback_file = '' ) {
    $pid = rimma_page_id();
    if ( $pid ) {
        $img_id = get_post_meta( $pid, 'rimma_img_' . $key, true );
        if ( $img_id ) return wp_get_attachment_url( $img_id );
    }
    if ( $fallback_file ) return get_template_directory_uri() . '/assets/images/' . $fallback_file;
    return '';
}

/* ============================================================
   META BOXES
   ============================================================ */

add_action( 'add_meta_boxes', function () {
    $post_type = 'page';
    add_meta_box( 'rimma_hero',     '🖼 Hero — головний екран',   'rimma_box_hero',     $post_type, 'normal', 'high' );
    add_meta_box( 'rimma_services', '💇 Послуги (6 карток)',       'rimma_box_services', $post_type, 'normal', 'default' );
    add_meta_box( 'rimma_fears',    '😨 Страхи (3 картки)',        'rimma_box_fears',    $post_type, 'normal', 'default' );
    add_meta_box( 'rimma_steps',    '✅ 5 кроків',                 'rimma_box_steps',    $post_type, 'normal', 'default' );
    add_meta_box( 'rimma_about',    '👩 Про майстра',              'rimma_box_about',    $post_type, 'normal', 'default' );
    add_meta_box( 'rimma_contacts', '📞 Контакти',                 'rimma_box_contacts', $post_type, 'normal', 'default' );
    add_meta_box( 'rimma_footer_b', '🔻 Footer',                   'rimma_box_footer',   $post_type, 'normal', 'default' );
} );

/* ---- Render-хелпери ---- */

function rimma_f_text( $post, $key, $label ) {
    $val = get_post_meta( $post->ID, 'rimma_' . $key, true );
    $d   = rimma_defaults();
    $ph  = isset( $d[ $key ] ) ? $d[ $key ] : '';
    echo '<p style="margin-bottom:12px"><label style="display:block;font-weight:600;margin-bottom:4px">' . esc_html( $label ) . '</label>';
    echo '<input type="text" name="rimma_' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" placeholder="' . esc_attr( $ph ) . '" style="width:100%"></p>';
}

function rimma_f_textarea( $post, $key, $label, $rows = 3 ) {
    $val = get_post_meta( $post->ID, 'rimma_' . $key, true );
    $d   = rimma_defaults();
    $ph  = isset( $d[ $key ] ) ? $d[ $key ] : '';
    echo '<p style="margin-bottom:12px"><label style="display:block;font-weight:600;margin-bottom:4px">' . esc_html( $label ) . '</label>';
    echo '<textarea name="rimma_' . esc_attr( $key ) . '" rows="' . $rows . '" placeholder="' . esc_attr( $ph ) . '" style="width:100%">' . esc_textarea( $val ) . '</textarea></p>';
}

function rimma_f_image( $post, $key, $label ) {
    $img_id  = get_post_meta( $post->ID, 'rimma_img_' . $key, true );
    $img_url = $img_id ? wp_get_attachment_url( $img_id ) : '';
    echo '<p style="margin-bottom:16px"><strong>' . esc_html( $label ) . '</strong><br>';
    echo '<div class="rimma-img-wrap" style="margin-top:6px">';
    echo '<input type="hidden" name="rimma_img_' . esc_attr( $key ) . '" class="rimma-img-id" value="' . esc_attr( $img_id ) . '">';
    $display = $img_url ? 'display:block' : 'display:none';
    echo '<img src="' . esc_url( $img_url ) . '" class="rimma-img-preview" style="max-height:120px;max-width:240px;' . $display . ';margin-bottom:6px;border-radius:4px;object-fit:cover">';
    echo '<br><button type="button" class="button rimma-img-btn">Вибрати фото</button> ';
    echo '<button type="button" class="button rimma-img-remove" style="' . ( $img_id ? '' : 'display:none' ) . '">✕ Видалити</button>';
    echo '</div></p>';
}

function rimma_divider( $label ) {
    echo '<hr style="margin:16px 0 12px"><h4 style="margin:0 0 10px;color:#555">' . esc_html( $label ) . '</h4>';
}

/* ---- Box: Hero ---- */
function rimma_box_hero( $post ) {
    wp_nonce_field( 'rimma_save', 'rimma_nonce' );
    echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">';
    echo '<div>';
    rimma_f_textarea( $post, 'hero_title', 'Заголовок H1', 3 );
    rimma_f_textarea( $post, 'hero_desc',  'Опис', 4 );
    rimma_f_text( $post, 'hero_btn1', 'Кнопка 1 (біла)' );
    rimma_f_text( $post, 'hero_btn2', 'Кнопка 2 (контур)' );
    rimma_f_text( $post, 'header_cta', 'Кнопка в хедері' );
    rimma_f_text( $post, 'header_tagline', 'Підпис логотипу' );
    echo '</div><div>';
    rimma_f_image( $post, 'hero_bg', 'Фонове фото (hero-bg.webp)' );
    rimma_f_image( $post, 'logo', 'Логотип (logo.svg)' );
    echo '</div></div>';
}

/* ---- Box: Services ---- */
function rimma_box_services( $post ) {
    rimma_f_textarea( $post, 'services_title', 'Заголовок секції', 2 );
    rimma_f_text( $post, 'services_btn', 'Кнопка' );
    for ( $n = 1; $n <= 6; $n++ ) {
        rimma_divider( "Послуга $n" );
        echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">';
        echo '<div>';
        rimma_f_text( $post, "service_{$n}_title", 'Назва' );
        rimma_f_textarea( $post, "service_{$n}_desc", 'Опис', 3 );
        echo '</div><div>';
        rimma_f_image( $post, "service_{$n}_img", "Фото (service-{$n}.webp)" );
        echo '</div></div>';
    }
}

/* ---- Box: Fears ---- */
function rimma_box_fears( $post ) {
    rimma_f_textarea( $post, 'fears_title', 'Заголовок секції', 2 );
    rimma_f_image( $post, 'fears_bg', 'Фонове фото (fears-bg.webp)' );
    for ( $n = 1; $n <= 3; $n++ ) {
        rimma_divider( "Страх $n" );
        echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">';
        echo '<div>';
        rimma_f_text( $post, "fear_{$n}_title", 'Заголовок' );
        rimma_f_textarea( $post, "fear_{$n}_desc", 'Опис', 3 );
        echo '</div><div>';
        rimma_f_image( $post, "fear_{$n}_icon", "Іконка (ic_card_{$n}.svg)" );
        echo '</div></div>';
    }
}

/* ---- Box: Steps ---- */
function rimma_box_steps( $post ) {
    rimma_f_textarea( $post, 'steps_title', 'Заголовок секції', 2 );
    for ( $n = 1; $n <= 5; $n++ ) {
        rimma_divider( "Крок $n" );
        rimma_f_text( $post, "step_{$n}_title", 'Назва' );
        rimma_f_textarea( $post, "step_{$n}_desc", 'Опис', 2 );
    }
}

/* ---- Box: About ---- */
function rimma_box_about( $post ) {
    echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">';
    echo '<div>';
    rimma_f_textarea( $post, 'about_title', 'Заголовок', 4 );
    rimma_f_text( $post, 'about_name', "Ім'я майстра" );
    rimma_f_text( $post, 'about_role', 'Посада' );
    rimma_f_text( $post, 'about_years', 'Роки досвіду (число)' );
    rimma_f_text( $post, 'about_badge_text', 'Підпис бейджу' );
    rimma_f_textarea( $post, 'about_cta_title', 'CTA — заголовок', 2 );
    rimma_f_text( $post, 'about_cta_btn', 'CTA — кнопка' );
    echo '</div><div>';
    rimma_f_image( $post, 'about_photo', 'Фото майстра (about-photo.webp)' );
    echo '</div></div>';
}

/* ---- Box: Contacts ---- */
function rimma_box_contacts( $post ) {
    echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px"><div>';
    rimma_f_text( $post, 'contact_phone_display', 'Телефон (відображення)' );
    rimma_f_text( $post, 'contact_phone_tel',     'Телефон для href (без пробілів)' );
    rimma_f_textarea( $post, 'contact_address',       'Адреса (хедер)', 2 );
    rimma_f_textarea( $post, 'contact_address_popup', 'Адреса (балун на карті)', 2 );
    rimma_f_text( $post, 'contact_maps_url',     'Google Maps URL' );
    rimma_f_text( $post, 'contact_telegram_url', 'Telegram URL' );
    rimma_f_text( $post, 'contact_viber_url',    'Viber URL' );
    echo '</div><div>';
    rimma_f_image( $post, 'contact_map', 'Знімок карти (contact-map.webp)' );
    echo '</div></div>';
}

/* ---- Box: Footer ---- */
function rimma_box_footer( $post ) {
    rimma_f_text( $post, 'footer_copy',      'Копірайт' );
    rimma_f_text( $post, 'footer_link1',     'Посилання 1 — текст' );
    rimma_f_text( $post, 'footer_link1_url', 'Посилання 1 — URL' );
    rimma_f_text( $post, 'footer_link2',     'Посилання 2 — текст' );
    rimma_f_text( $post, 'footer_link2_url', 'Посилання 2 — URL' );
}

/* ============================================================
   ЗБЕРЕЖЕННЯ МЕТА
   ============================================================ */

add_action( 'save_post_page', function ( $post_id ) {
    if ( ! isset( $_POST['rimma_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['rimma_nonce'], 'rimma_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_page', $post_id ) ) return;

    /* Текстові ключі */
    $text_keys = [
        'hero_title', 'hero_desc', 'hero_btn1', 'hero_btn2', 'header_cta', 'header_tagline',
        'services_title', 'services_btn',
        'service_1_title', 'service_1_desc', 'service_2_title', 'service_2_desc',
        'service_3_title', 'service_3_desc', 'service_4_title', 'service_4_desc',
        'service_5_title', 'service_5_desc', 'service_6_title', 'service_6_desc',
        'fears_title',
        'fear_1_title', 'fear_1_desc', 'fear_2_title', 'fear_2_desc', 'fear_3_title', 'fear_3_desc',
        'steps_title',
        'step_1_title', 'step_1_desc', 'step_2_title', 'step_2_desc', 'step_3_title', 'step_3_desc',
        'step_4_title', 'step_4_desc', 'step_5_title', 'step_5_desc',
        'about_title', 'about_name', 'about_role', 'about_years', 'about_badge_text',
        'about_cta_title', 'about_cta_btn',
        'contact_phone_display', 'contact_phone_tel', 'contact_address', 'contact_address_popup',
        'contact_maps_url', 'contact_telegram_url', 'contact_viber_url',
        'footer_copy', 'footer_link1', 'footer_link1_url', 'footer_link2', 'footer_link2_url',
    ];

    foreach ( $text_keys as $key ) {
        if ( isset( $_POST[ 'rimma_' . $key ] ) ) {
            update_post_meta( $post_id, 'rimma_' . $key, wp_kses_post( wp_unslash( $_POST[ 'rimma_' . $key ] ) ) );
        }
    }

    /* Ключі зображень */
    $img_keys = [
        'hero_bg', 'logo',
        'service_1_img', 'service_2_img', 'service_3_img',
        'service_4_img', 'service_5_img', 'service_6_img',
        'fears_bg', 'fear_1_icon', 'fear_2_icon', 'fear_3_icon',
        'about_photo', 'contact_map',
    ];

    foreach ( $img_keys as $key ) {
        if ( isset( $_POST[ 'rimma_img_' . $key ] ) ) {
            update_post_meta( $post_id, 'rimma_img_' . $key, intval( $_POST[ 'rimma_img_' . $key ] ) );
        }
    }
} );

/* ============================================================
   SANITIZE (для сумісності — не використовується в Customizer)
   ============================================================ */

function rimma_sanitize_html( $value ) {
    return wp_kses( $value, [ 'br' => [], 'strong' => [], 'em' => [] ] );
}
