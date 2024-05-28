<?php
add_action( 'woocommerce_before_cart', 'add_cart_title', 5 );

function add_cart_title() {
    echo '<h2 class="cart-title">Varukorg</h2>';
}

//Ändrat texten i rabattkupongens placeholder
function my_coupon_strings( $translated_text, $text, $domain ) 
{ switch ( $translated_text ) { case 'Rabattkod' : $translated_text = __( 'Ange kod', 'woocommerce' );
   break; } return $translated_text; } add_filter( 'gettext', 'my_coupon_strings', 10, 3 );

//Endast fri frakt ska synas om köparen når 1000kr
add_filter( 'woocommerce_package_rates', 'unset_shipping_when_free_is_available_all_zones', 9999, 2 );
   
function unset_shipping_when_free_is_available_all_zones( $rates, $package ) {
   $all_free_rates = array();
   foreach ( $rates as $rate_id => $rate ) {
      if ( 'free_shipping' === $rate->method_id ) {
         $all_free_rates[ $rate_id ] = $rate;
         break;
      }
   }
   if ( empty( $all_free_rates )) {
      return $rates;
   } else {
      return $all_free_rates;
   } 
}

//Byter texten på "Proceed to checkout"-btn
function woocommerce_button_proceed_to_checkout() { ?>
   <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward">
   <?php esc_html_e( 'GÅ TILL KASSAN', 'woocommerce' ); ?>
   </a>
   <?php
  }

//Ändrar rabattkodstexten
function custom_woocommerce_button_text($translation, $text, $domain) {
   if ($domain == 'woocommerce' && $text == 'Apply coupon') {
       return 'Lägg till rabattkod'; 
   }
   return $translation;
}
add_filter('gettext', 'custom_woocommerce_button_text', 10, 3);


//Tar bort texten "Shipping options will be updated during checkout."
function shipping_estimate_html()
{
    return null;
}
add_filter('woocommerce_shipping_estimate_html', 'shipping_estimate_html');


//Uppdaterar varukorgen automatiskt utan att behöva klicka på "Update Cart"
function ecommercehints_enqueue_custom_scripts() {
   wp_enqueue_script(
       'ecommercehints-custom-cart', 
       get_template_directory_uri() . '/resources/scripts/app.js', 
       array('jquery'), 
       null, 
       true
   );
}
add_action('wp_enqueue_scripts', 'ecommercehints_enqueue_custom_scripts');


//flyttat på email i order received page
add_filter('woocommerce_thankyou_order_received_text', 'my_order_received_text', 10, 2);
function my_order_received_text($text, $order) {
    if (!is_a($order, 'WC_Order')) {
        return $text;
    }
    $email = $order->get_billing_email();

    return $text . '<br>
    <div class="custom-order-received"><p>' . __('Din orderbekräftelse har skickats till: ') . '<strong>' . $email . '</strong></p></div>';
}

//visar produktbilder i order received page
add_filter( 'woocommerce_order_item_name', 'order_received_item_thumbnail_image', 10, 3 );
function order_received_item_thumbnail_image( $item_name, $item, $is_visible ) {
    if( ! is_wc_endpoint_url('order-received') ) return $item_name;

    $product = $item->get_product();

    if( $product->get_image_id() > 0 ){
        $product_image = '<span style="float:left;display:block;width:56px;">' . $product->get_image(array(48, 48)) . '</span>';
        $item_name = $product_image . $item_name;
    }

    return $item_name;
}

//Tar bort texten om att varukorgen är uppdaterad
add_filter('woocommerce_add_message', '__return_false');
