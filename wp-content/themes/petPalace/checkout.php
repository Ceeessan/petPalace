<?php

function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}

add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

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

//Flyttar på rabattkoden
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_review_order_after_cart_contents', 'woocommerce_checkout_coupon_form_custom' );
function woocommerce_checkout_coupon_form_custom() {
    echo '<tr class="coupon-form"><td colspan="2">';
    
    wc_get_template(
        'checkout/form-coupon.php',
        array(
            'checkout' => WC()->checkout(),
        )
    );
    echo '</tr></td>';
}

add_filter( 'woocommerce_checkout_coupon_message', 'have_coupon_message');
function have_coupon_message() {
   return '<div class="coupon-message-wrapper"></i><a href="#" class="showcoupon">Har du en rabattkod?<i class="fa-solid fa-angle-down"></i></a></div>';
}


//Gör att leveransadressen automatiskt blir samma som faktureringsadressen
add_action('woocommerce_checkout_update_order_meta', 'set_shipping_as_billing');
function set_shipping_as_billing($order_id) {
    if ($_POST['ship_to_different_address'] == false || !isset($_POST['ship_to_different_address'])) {
        $order = wc_get_order($order_id);

        $order->set_shipping_first_name($order->get_billing_first_name());
        $order->set_shipping_last_name($order->get_billing_last_name());
        $order->set_shipping_company($order->get_billing_company());
        $order->set_shipping_address_1($order->get_billing_address_1());
        $order->set_shipping_address_2($order->get_billing_address_2());
        $order->set_shipping_city($order->get_billing_city());
        $order->set_shipping_state($order->get_billing_state());
        $order->set_shipping_postcode($order->get_billing_postcode());
        $order->set_shipping_country($order->get_billing_country());

        $order->save();
    }
}
