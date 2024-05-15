<?php
add_action( 'woocommerce_before_cart', 'add_cart_title', 5 );

function add_cart_title() {
    echo '<h2 class="cart-title">Varukorg</h2>';
}

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

//Tar bort "Cart totals"
add_filter( 'gettext', 'change_cart_totals_text', 20, 3 );
function change_cart_totals_text( $translated, $text, $domain ) {
    if( is_cart() && $translated == 'Cart totals' ){
        $translated = '';
    }
    return $translated;
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

//Ändrar texten i placeholdern till rabattkoden
function my_text_strings( $translated_text, $text, $domain ) {
   switch ( $translated_text ) {
       case 'Coupon code' :
           $translated_text = __( 'Ange kod', 'woocommerce' );
           break;
   }
   return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );

//Tar bort texten "Shipping options will be updated during checkout."
function shipping_estimate_html()
{
    return null;
}
add_filter('woocommerce_shipping_estimate_html', 'shipping_estimate_html');

//Ändrar "Shipping" till "Frakt"
add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
  return 'Frakt';
}

//Uppdaterar varukorgen automatiskt utan att behöva klicka på "Update Cart"
add_action( 'wp_head', 'ecommercehints_hide_update_cart_button' );
function ecommercehints_hide_update_cart_button() { ?>

<?php }

add_action( 'wp_footer', 'ecommercehints_update_cart_on_quantity_change');
function ecommercehints_update_cart_on_quantity_change() { ?>
	<script>
	jQuery( function( $ ) {
		let timeout;
		$('.woocommerce').on('change', 'input.qty', function(){
			if ( timeout !== undefined ) {
				clearTimeout( timeout );
			}
			timeout = setTimeout(function() {
				$("[name='update_cart']").trigger("click");
			}, 500 ); 
		});
	} );
	</script>
<?php }

