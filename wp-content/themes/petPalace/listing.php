<?php

// Tar bort "Shop-titeln på sidan.
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );


// Testar lägga till något sålänge med hook, efter breadcrumbs
function display_sale_banner(){
    echo '<div class= "baner-div-listing"><p class= "banner-text-listing"> 20% REA på alla leksaker för din djurvän. </p> <img src= "'. get_template_directory_uri() . '/resources/images/sale-banner-listing.png" class= "sale-banner-listing-img">  </div>';
}

add_action( 'woocommerce_before_shop_loop', 'display_sale_banner');

function display_icons_filter(){
    echo '<div class= "icons-filter-div">
    <div> <img src="'. get_template_directory_uri() . '/resources/images/dog-icon.png"> </div>

    <div> <img src="'. get_template_directory_uri() . '/resources/images/cat-icon.png"> </div>

    <div> <img src="'. get_template_directory_uri() . '/resources/images/rabbit-icon.png"> </div>
    
    <div> <img src="'. get_template_directory_uri() . '/resources/images/bird-icon.png"> </div>
    </div>';
}

add_action( 'woocommerce_before_shop_loop', 'display_icons_filter');


?>