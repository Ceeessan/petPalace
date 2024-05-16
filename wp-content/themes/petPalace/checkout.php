<?php
//Tar bort rabattkodsformuläret som finns i checkout
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 ); 

add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false');

add_filter( 'woocommerce_order_button_text', 'wc_custom_order_button_text' ); 

function wc_custom_order_button_text() {
    return __( 'Betala köp', 'woocommerce' ); 
}

add_filter( 'woocommerce_checkout_fields' , 'remove_company_name' );

function remove_company_name( $fields ) {
     unset($fields['billing']['billing_company']);
     return $fields;
}

//Lagt till så att produktbilder syns i checkout
add_filter( 'woocommerce_cart_item_name', 'product_image_checkout', 9999, 3 );
function product_image_checkout( $name, $cart_item, $cart_item_key ) {
    if ( ! is_checkout() ) 
        {return $name;}
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    $thumbnail = $_product->get_image();
    $image = '<div class="product_image_checkout">'
                . $thumbnail .
            '</div>'; 
    return $image . $name;
}