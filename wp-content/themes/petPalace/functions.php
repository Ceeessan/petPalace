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
require_once("home.php");
require_once("listing.php");
require_once("product-page.php");
require_once("cart.php");
require_once("checkout.php");

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

?>
