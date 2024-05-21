<?php

function init_ajax(){
    add_action("wp_ajax_petPalace_getbyajax", "petPalace_getbyajax");
    add_action("wp_ajax_nopriv_petPalace_getbyajax", "petPalace_getbyajax");

    add_action("wp_enqueue_scripts", "petPalace_enqueue_scripts");
}

add_action("init", "init_ajax");

function petPalace_enqueue_scripts(){
    $theme_directory = get_template_directory_uri();
    wp_enqueue_script("petPalace_jquery", $theme_directory . "/resources/scripts/jquery.js", array(), false, true);
    wp_enqueue_script("petPalace_ajax", $theme_directory . "/resources/scripts/ajax.js", array("petPalace_jquery"), false, true);

    // Kombinerar variablerna som ska lokaliseras till skripten
    wp_localize_script("petPalace_ajax", "ajax_variables", array(
        "ajaxUrl" => admin_url("admin-ajax.php"), 
        "nonce" => wp_create_nonce("petPalace_ajax_nonce"),
        "siteUrl" => get_site_url(),
        "totalProducts" => $GLOBALS['wp_query']->found_posts
    ));

    wp_enqueue_script('custom-scripts', get_stylesheet_directory_uri() . '/js/functions.js', array('jquery'), null, true);
    wp_localize_script('custom-scripts', 'ajaxurl', admin_url('admin-ajax.php'));
}

add_action('wp_enqueue_scripts', 'petPalace_enqueue_scripts');


function add_custom_scripts() {
    wp_enqueue_script('custom-scripts', get_stylesheet_directory_uri() . '/js/functions.js', array('jquery'), null, true);
    wp_localize_script('custom-scripts', 'ajaxurl', admin_url('admin-ajax.php'));
}

add_action('wp_ajax_load_more_products', 'load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products');

// AJAX-funktion för att ladda fler produkter
function load_more_products() {
    check_ajax_referer('petPalace_ajax_nonce', 'nonce');

    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 10,
        'paged' => $paged
    );

    $products = new WP_Query($args);

    if ($products->have_posts()) :
        while ($products->have_posts()) : $products->the_post();
            wc_get_template_part('content', 'product');
        endwhile;
    else :
        wp_send_json(false);
    endif;

    wp_reset_postdata();
    wp_die();
}





?>
