<?php

function petPalace_enqueue(){
    // Här länkar vi till CSS och JS.
    $theme_directory = get_template_directory_uri();
    wp_enqueue_style("petPalace", $theme_directory . "/app.scss");
    wp_enqueue_script("app", $theme_directory . "/app.js");
    wp_enqueue_script("listing", $theme_directory . "/listing.js");

}

add_action('wp_enqueue_scripts', 'petPalace_enqueue');

function petPalace_init(){
    $menu = array(
        'mainmenu' => 'mainmenu',
        'footer_info' => 'footer_info',
        'footer_contact' => 'footer_contact',
        'footer_socialamedier' => 'footer_socialamedier'
    );
    register_nav_menus($menu);
}

add_action('after_setup_theme', 'petPalace_init');
