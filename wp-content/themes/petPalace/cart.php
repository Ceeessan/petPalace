<?php
add_action( 'woocommerce_before_cart', 'add_cart_title', 5 );

function add_cart_title() {
    echo '<h2 class="cart-title">Varukorg</h2>';
}
