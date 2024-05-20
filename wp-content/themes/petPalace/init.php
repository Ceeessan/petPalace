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
        'secondarymenu' => 'secondarymenu',
        'footer_contact' => 'footer_contact',
        'footer_socialamedier' => 'footer_socialamedier',
        'footer_info' => 'footer_info',
        
        
    );
    register_nav_menus($menu);
}

add_action('after_setup_theme', 'petPalace_init');



//Lägga till widget för "relevanta produkter" i listing
function custom_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Widget Area Name', 'textdomain' ),
        'id'            => 'widget-area-id',
        'description'   => __( 'Beskrivning av widget-området', 'textdomain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'custom_widgets_init' );
