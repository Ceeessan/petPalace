<?php

// Detta ska bli ett val för företaget...
function display_sale_banner(){
    
    $display_sale_banner = get_option('display_sale_banner');
    
    // Om checkboxen är markerad, visas meddelandet
    if ($display_sale_banner) {
        $store_message = get_option('store_message');
        if (!empty($store_message)) {
            echo '<div class="baner-div-listing">';
            echo '<div class="banner-text-listing">' . $store_message . '</div>';
            echo '<div class="sale-banner-listing-img-wrapper">';
            echo '<img src="' . get_template_directory_uri() . '/resources/images/sale-banner-listing.png" class="sale-banner-listing-img">';
            echo '</div>';
            echo '</div>';
        } 
    }
}
add_action( 'woocommerce_before_shop_loop', 'display_sale_banner');



// Lägger till ikonerna, dessa ska ha filtrerings-funktion.
function display_icons_filter(){
    echo '<div class= "icons-filter-div">

    <div class= "icon-div"> <img class="icon-animals dog-icon" src="'. get_template_directory_uri() . '/resources/images/dog-icon.png"> 
    <p class="icon-text">Hund</p> 
    </div>

    <div class= "icon-div"> 
    <img class="icon-animals cat-icon" src="'. get_template_directory_uri() . '/resources/images/cat-icon.png"> 
    <p class="icon-text">Katt</p>  
    </div>

    <div class= "icon-div"> 
    <img class="icon-animals rabbit-icon" src="'. get_template_directory_uri() . '/resources/images/rabbit-icon.png"> 
    <p class="icon-text">Gnagare</p> 
    </div>
    
    <div class= "icon-div"> 
    <img class="icon-animals bird-icon" src="'. get_template_directory_uri() . '/resources/images/bird-icon.png">
    <p class="icon-text">Fåglar</p>  
    </div>

    </div>';
}

add_action( 'woocommerce_before_shop_loop', 'display_icons_filter');


remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

//Har tagit bort och lägger nu till visade resultat längre ner på sidan. 

function custom_result_count_placement() {
    echo '<div class="custom-result-count">';
    woocommerce_result_count();
    echo '</div>';
}
add_action( 'woocommerce_after_shop_loop', 'custom_result_count_placement' );


//Sök-ruta
function custom_product_search_form($form) {
    $form = '<form role="search" method="get" id="product-search-form" class="custom-search-form" action="' . esc_url( home_url( '/' ) ) . '">

        <label class="screen-reader-text" for="s">' . __( 'Sök efter produkt:', 'woocommerce' ) . '</label>
        <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Sök efter produkt', 'woocommerce' ) . '" />
        <button type="submit" value="' . esc_attr__( 'Search', 'woocommerce' ) . '">'  . '
        <svg class="search-icon-listing" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="black" d="m19.485 20.154l-6.262-6.262q-.75.639-1.725.989t-1.96.35q-2.402 0-4.066-1.663T3.808 9.503T5.47 5.436t4.064-1.667t4.068 1.664T15.268 9.5q0 1.042-.369 2.017t-.97 1.668l6.262 6.261zM9.539 14.23q1.99 0 3.36-1.37t1.37-3.361t-1.37-3.36t-3.36-1.37t-3.361 1.37t-1.37 3.36t1.37 3.36t3.36 1.37"/></svg>
        </button>
        <input type="hidden" name="post_type" value="product" />
    </form>';
    return $form;
}
add_filter( 'get_product_search_form', 'custom_product_search_form' );

function get_searchbar() {
    echo get_product_search_form();
}

add_action( 'woocommerce_before_shop_loop', 'get_searchbar' );


//filtrering som inte riktigt funkar.. fortsätter vidare med produkterna.
// function add_filter_and_catalog($sortby) {
//     if (is_array($sortby)) {
//         echo '<div class="filter-icon-container">
        
//         <div > <svg class="filter-icon-listing" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="black" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1.5" d="M21.25 12H8.895m-4.361 0H2.75m18.5 6.607h-5.748m-4.361 0H2.75m18.5-13.214h-3.105m-4.361 0H2.75m13.214 2.18a2.18 2.18 0 1 0 0-4.36a2.18 2.18 0 0 0 0 4.36Zm-9.25 6.607a2.18 2.18 0 1 0 0-4.36a2.18 2.18 0 0 0 0 4.36Zm6.607 6.608a2.18 2.18 0 1 0 0-4.361a2.18 2.18 0 0 0 0 4.36Z"/></svg> </div>';

//         '<div class= "sorting-dropdown-listing">' .
//         $sortby['menu_order'] = __( 'Standard sortering', 'woocommerce' );
//         $sortby['popularity'] = __( 'Sortera efter popularitet', 'woocommerce' );
//         $sortby['rating'] = __( 'Sortera efter genomsnittligt betyg', 'woocommerce' );
//         $sortby['date'] = __( 'Sortera efter senaste', 'woocommerce' );
//         $sortby['price'] = __( 'Sortera efter pris: högst till lägst', 'woocommerce' );


//         echo '<select name="orderby" class="orderby">';
//         foreach ($sortby as $key => $value) {
//             echo '<option value="' . esc_attr($key) . '">' . esc_html($value) . '</option>';
//         }
//         echo '</select> 
//         </div>
//         </div>';

//         return $sortby;
//     }
// }

// add_filter( 'woocommerce_catalog_orderby', 'add_filter_and_catalog' );






?>