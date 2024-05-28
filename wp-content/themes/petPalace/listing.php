<?php

function wrap_woocommerce_listing_page_start() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        echo '<div class="custom-wrapper-listing-page">';
    }
}

function wrap_woocommerce_listing_page_end() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        echo '</div>';
    }
}

add_action('woocommerce_before_main_content', 'wrap_woocommerce_listing_page_start', 5);
add_action('woocommerce_after_main_content', 'wrap_woocommerce_listing_page_end', 50);



// Detta är ett val för företaget
function display_sale_banner(){
    
    $display_sale_banner = get_option('display_sale_banner');
    
  
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


//Har tagit bort visade resultat på sidan. 
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );



// Lägger till ikonerna, dessa har filtrerings-funktion.
function display_icons_filter() {
    echo '<div class="icons-filter-div">

    <div class="icon-div"> 
        <img class="icon-animals dog-icon" data-tag="hund" src="'. get_template_directory_uri() . '/resources/images/dog-icon.png"> 
        <p class="icon-text">Hund</p> 
    </div>

    <div class="icon-div"> 
        <img class="icon-animals cat-icon" data-tag="katt" src="'. get_template_directory_uri() . '/resources/images/cat-icon.png"> 
        <p class="icon-text">Katt</p>  
    </div>

    <div class="icon-div"> 
        <img class="icon-animals rabbit-icon" data-tag="gnagare" src="'. get_template_directory_uri() . '/resources/images/rabbit-icon.png"> 
        <p class="icon-text">Gnagare</p> 
    </div>
    
    <div class="icon-div"> 
        <img class="icon-animals bird-icon" data-tag="bird" src="'. get_template_directory_uri() . '/resources/images/bird-icon.png">
        <p class="icon-text">Fåglar</p>  
    </div>

    </div>';

  
    echo '<div id="product-list"></div>';
}

add_action('woocommerce_before_shop_loop', 'display_icons_filter');

//För att få fram Ikonernas funktionalitet
function filter_products_by_query_param($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('product')) {
        if (isset($_GET['product_tag']) && !empty($_GET['product_tag'])) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => 'product_tag',
                    'field' => 'slug',
                    'terms' => sanitize_text_field($_GET['product_tag']),
                ),
            ));
        }
    }
}
add_action('pre_get_posts', 'filter_products_by_query_param');





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



// Tar bort stjärnbetyg från produktlisting
function disable_star_ratings_from_product_listing() {
    global $wp_filter;
    if ( isset( $wp_filter['woocommerce_after_shop_loop_item_title']->callbacks ) ) {
        foreach ( $wp_filter['woocommerce_after_shop_loop_item_title']->callbacks as $priority => $hooks ) {
            foreach ( $hooks as $hook => $attributes ) {
                if ( strpos( $hook, 'woocommerce_template_loop_rating' ) !== false ) {
                    remove_action( 'woocommerce_after_shop_loop_item_title', $hook, $priority );
                }
            }
        }
    }
}
add_action( 'init', 'disable_star_ratings_from_product_listing' );


// Lägger till egen betyg och design på recensioner på hemsidan
function petPalace_add_star_rating() {
    global $product;
    $rating = $product->get_average_rating();
    $width = ( $rating / 5 ) * 100;

    echo "<div class='rating-with-stars' >
    <div class='fill' style='width:" . $width . "%;'> </div>
    </div>";
}

add_action( 'woocommerce_after_shop_loop_item', 'petPalace_add_star_rating', 5 );



// Ändra knapptexten på produktlistningssidan
add_filter('woocommerce_product_add_to_cart_text', 'custom_add_to_cart_text');    // 2.1 +
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text'); // 2.1 +
function custom_add_to_cart_text() {
    return __('Köp', 'your-theme-slug');
}

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_after_shop_loop_item', 'custom_template_loop_add_to_cart', 10);

function custom_template_loop_add_to_cart() {
    global $product;

    if ($product) {
        $link = $product->get_permalink();
        echo '<a href="' . esc_url($link) . '" class="button">' . __('Köp', 'your-theme-slug') . '</a>';
    }
}






//____________________SLUTET EFTER PRODUCTS-CONTENT PÅ LISTING_PAGE

// läggs till text för "medlem" i settings.
function display_member_banner() {

    $display_second_banner = get_option('display_second_banner');
    
 
    if ($display_second_banner) {
        $second_banner_message = get_option('second_banner_message');
        if (!empty($second_banner_message)) {
            echo '<div class="member-div-listing">';
            echo '<div class="banner-text-listing">' . $second_banner_message . '</div>';
            echo '<div class="sale-banner-listing-img-wrapper">';
            echo '<img src="' . get_template_directory_uri() . '/resources/images/member-dog-human.png" class="sale-banner-listing-img">';
            echo '</div>';
            echo '</div>';
        } 
    }
}
add_action('woocommerce_after_shop_loop', 'display_member_banner');



// Lägger in "relaterade produkter" för ytterligare funktionalitet till listing-page.
function display_related_products() {
    
    if ( class_exists( 'WooCommerce' ) ) {
       
        global $product;
        
     
        if ( $product && $product->get_id() && ! did_action( 'displayed_related_products' ) && ! did_action( 'displayed_ajax_related_products' ) ) {
            $related_products = wc_get_related_products( $product->get_id(), 4 ); 
           
            if ( $related_products ) {
                echo '<div class="container-related-listing">';
                echo '<div class="related-products">';
                echo '<h2>Relaterade produkter</h2>';
                echo '<ul class="products">';
                
                foreach ( $related_products as $related_product_id ) {
                    $related_product = wc_get_product( $related_product_id );
                    
                    if ( $related_product ) {
                        echo '<li class="product">';
                        echo '<a href="' . esc_url( get_permalink( $related_product->get_id() ) ) . '">';
                        echo $related_product->get_image();
                        echo '<h3>' . $related_product->get_name() . '</h3>';
                        echo '<span class="price">' . $related_product->get_price_html() . '</span>';
                        echo '</a>';
                        
                       
                        echo apply_filters( 'woocommerce_loop_add_to_cart_link', 

                            sprintf( '<a href="%s" data-quantity="1" class="button %s" %s>%s</a>',
                                esc_url( $related_product->add_to_cart_url() ),
                                $related_product->get_stock_status() == 'out-of-stock' ? 'disabled' : '',
                                $related_product->get_stock_status() == 'out-of-stock' ? 'disabled' : '',
                                esc_html( $related_product->add_to_cart_text() )
                            ),
                        $related_product ); 
                        
                        echo '</li>';
                    }
                }
                
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                
             
                do_action( 'displayed_related_products' );
            }
        }
    }
}
add_action( 'woocommerce_after_shop_loop', 'display_related_products', 20 );


?>