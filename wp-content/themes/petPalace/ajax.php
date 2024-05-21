<?php

function init_ajax(){
    add_action("wp_ajax_petPalace_getbyajax", "petPalace_getbyajax");
    add_action("wp_ajax_nopriv_petPalace_getbyajax", "petPalace_getbyajax");

    add_action("wp_enqueue_scripts", "petPalace_enqueue_scripts");
}

add_action("init", "init_ajax");

function petPalace_enqueue_scripts(){
    wp_enqueue_script("petPalace_jquery", get_template_directory_uri() . "/resources/scripts/jquery.js" , array(), false, array());

    wp_enqueue_script("petPalace_ajax", get_template_directory_uri() . "/resources/scripts/ajax.js", array("petPalace_jquery"), false, array());

    wp_localize_script("petPalace_ajax", "ajax_variables", array(
        "ajaxUrl" => admin_url("admin-ajax.php"),
        "nonce" => wp_create_nonce("petPalace_ajax_nonce"),
        "totalProducts" => $GLOBALS['wp_query']->found_posts
    ));
}

add_action('wp_enqueue_scripts', 'add_custom_scripts');

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

// Funktion för att visa resultaträknare och laddningsknapp
function display_result_count_and_button() {
    global $wp_query;
    if (is_shop() || is_product_category() || is_product_tag()) {
        $total_products = $wp_query->found_posts;
        $products_per_page = $wp_query->get('posts_per_page');
        $current_count = $wp_query->post_count;

        if ($total_products > $products_per_page) {
            echo '<div class="button-container">';
            echo '<button class="load-more-button" id="load-more"> + </button>';
            echo '</div>';
        }

        echo '<div class="custom-result-count">';
        echo 'Visar ' . $current_count . ' av ' . $total_products . ' produkter';
        echo '</div>';

 
    }
}
add_action('woocommerce_after_shop_loop', 'display_result_count_and_button');

// Ta bort standardresultaträknaren från sin ursprungliga plats
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
?>
