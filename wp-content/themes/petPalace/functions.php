<?php

// Om konstanten "ABSPATH" inte är definierad, avbryt allt.
if (!defined('ABSPATH')) {
    exit;
}

// Inkludera nödvändiga filer
require_once("vite.php");
require_once("init.php");
require_once("shortcodes.php");
require_once("settings.php");
require_once("listing.php");
require_once("product-page.php");
require_once("cart.php");
require_once("checkout.php");
require_once("ajax.php");

// Registrera menyer
function register_my_menus() {
    register_nav_menus(
        array(
            'mainmenu' => __('Main Menu'),
            'secondarymenu' => __('Secondary Menu'),
        )
    );
}
add_action('init', 'register_my_menus');

// Lägg till stöd för WooCommerce
function petPalace_add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'petPalace_add_woocommerce_support');

// Initialize theme
require_once(get_template_directory() . "/init.php");



//Lägger till slick carousel för att karusellen ska funka.
function enqueue_slick_carousel() {
    wp_enqueue_style( 'slick-carousel-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
    wp_enqueue_style( 'slick-carousel-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css' );
    wp_enqueue_script( 'slick-carousel-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'custom-carousel-js', get_template_directory_uri() . '/js/custom-carousel.js', array('slick-carousel-js'), '', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_slick_carousel' );

// Ändrar texten för kommentarstiteln i blogginläggen
function change_comment_form_text( $fields ) {
    $fields['title_reply'] = __('Leave a Comment'); 
    return $fields;
}
add_filter( 'comment_form_defaults', 'change_comment_form_text' );
