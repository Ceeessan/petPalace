<?php

function init_ajax(){
    add_action("wp_ajax_petPalace_getbyajax", "petPalace_getbyajax");
    add_action("wp_ajax_nopriv_petPalace_getbyajax", "petPalace_getbyajax");

    add_action("wp_enqueue_scripts", "petPalace_enqueue_scripts");
}

add_action("init", "init_ajax");


// Enqueue samt filtrering för ikonerna
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



// AJAX-funktion för att ladda fler produkter


//Cart-count
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
function enqueue_custom_scripts() {
    wp_enqueue_script('jquery'); // Se till att jQuery är laddat
    wp_enqueue_script('custom-cart-update', get_template_directory_uri() . '/js/custom-cart-update.js', array('jquery'), '1.0', true);
}

add_filter('woocommerce_add_to_cart_fragments', 'custom_add_to_cart_fragment');
function custom_add_to_cart_fragment($fragments) {
    ob_start();
    ?>
    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['.cart-count'] = ob_get_clean();
    return $fragments;
}







function get_wishlist_count() {
    if (class_exists('WooCommerce')) {
        // Hämta önskelistan från sessionen
        $wishlist = WC()->session->get('wishlist');

        // Kontrollera om önskelistan finns och returnera antalet produkter
        return $wishlist ? count($wishlist) : 0;
    } else {
        return 0;
    }
}




?>
