<?php

function rimma_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [ 'script', 'style', 'navigation-widgets' ] );
}
add_action( 'after_setup_theme', 'rimma_theme_setup' );

function rimma_enqueue_assets() {
    $ver = wp_get_theme()->get( 'Version' );
    $uri = get_template_directory_uri();

    wp_enqueue_style( 'rimma-global', $uri . '/assets/css/global.css', [], $ver );
    wp_enqueue_style( 'rimma-landing', $uri . '/assets/css/landing.css', [ 'rimma-global' ], $ver );
    wp_enqueue_script( 'rimma-main', $uri . '/assets/js/main.js', [], $ver, true );
}
add_action( 'wp_enqueue_scripts', 'rimma_enqueue_assets' );

/* Font preloads — виводяться якомога раніше в <head> */
add_action( 'wp_head', function () {
    $uri = get_template_directory_uri();
    echo '<link rel="preload" href="' . esc_url( $uri . '/assets/fonts/NeverMindSerifTitle-Regular.ttf' ) . '" as="font" type="font/truetype" crossorigin>' . "\n";
    echo '<link rel="preload" href="' . esc_url( $uri . '/assets/fonts/Roboto-Regular.ttf' ) . '" as="font" type="font/truetype" crossorigin>' . "\n";
}, 1 );

/* Прибираємо зайвий мотлох з <head> */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
