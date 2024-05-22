<?php
// Wrapping(för att göra en egen div för min sida)
function wrap_single_product_page_start() {
    if ( is_product() ) {
        echo '<div class="pp">';
    }
}

function wrap_single_product_page_end() {
    if ( is_product() ) {
        echo '</div>';
    }
}

add_action('woocommerce_before_main_content', 'wrap_single_product_page_start', 5);
add_action('woocommerce_after_main_content', 'wrap_single_product_page_end', 50);

function remove_woocommerce_product_rating() {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
}

add_action('wp', 'remove_woocommerce_product_rating');

// Lägger till egen brtyg och design på recensioner på hemsidan
function petPalace_add_star_rating_single_product() {
    global $product;
    if ( ! $product ) {
        return;
    }
    $rating = $product->get_average_rating();
    $width = ( $rating / 5 ) * 100;

    echo "<div class='rating-with-stars'>
    <div class='fill' style='width:" . $width . "%;'></div>
    </div>";
}

add_action('woocommerce_single_product_summary', 'petPalace_add_star_rating_single_product', 15);
