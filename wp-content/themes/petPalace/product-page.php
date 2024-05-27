<?php
// Wrapping (för att göra en egen div för min sida)
function wrap_single_product_page_start() {
    if ( is_product() ) {
        echo '<div class="pp"><div class="pp-content">';
    }
}

function wrap_single_product_page_end() {
    if ( is_product() ) {
        echo '</div></div>';
    }
}

// Lägg till actions för att starta och avsluta wrapping
add_action('woocommerce_before_main_content', 'wrap_single_product_page_start', 5);
add_action('woocommerce_after_main_content', 'wrap_single_product_page_end', 50);

//Tar bort kategorier, tags etc från single product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


// Ta bort WooCommerce produktbetyg
function remove_woocommerce_product_rating() {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
}

add_action('wp', 'remove_woocommerce_product_rating');

// Lägg till egen betyg och design på recensioner på hemsidan
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

// Lägg till den nya betygsdesignen till WooCommerce single product summary
add_action('woocommerce_single_product_summary', 'petPalace_add_star_rating_single_product', 15);

// Enqueue Swiper.js biblioteket
function enqueue_swiper_assets() {
    if ( is_product() ) {
        wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);
    }
}

// Lägg till Swiper.js CSS och JS om det är en produktsida
add_action('wp_enqueue_scripts', 'enqueue_swiper_assets');

// Ta bort standard relaterade produkter sektion
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// Lägg till relaterade produkter karusell efter en enskild produkt
function add_related_products_carousel() {
    if ( is_product() ) {
        ?>
        <div class="container-related-listing">
            <div class="related-products">
                <div class="related-products-title">Du kanske också gillar</div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        // Hämta relaterade produkter
                        $related_products = wc_get_related_products(get_the_ID());
                        if ( !empty($related_products) ) {
                            foreach ( $related_products as $related_product_id ) {
                                $post_object = get_post( $related_product_id );
                                setup_postdata( $GLOBALS['post'] =& $post_object );
                                ?>
                                <div class="swiper-slide">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if ( has_post_thumbnail() ) { ?>
                                            <?php the_post_thumbnail('woocommerce_thumbnail'); ?>
                                        <?php } ?>
                                        <h2><?php the_title(); ?></h2>
                                    </a>
                                    <?php woocommerce_template_loop_price(); ?>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-cue"></div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView:2,
                    spaceBetween: 10,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 40,
                        },
                    },
                });
            });
        </script>
        <?php
    }
}

// Lägg till karusellen efter en enskild produkt med hjälp av WooCommerce hook
add_action('woocommerce_after_single_product', 'add_related_products_carousel', 20);

//Lägger till lagerstatus med ikoner
add_filter( 'woocommerce_get_availability', 'custom_override_get_availability', 10, 2 );
function custom_override_get_availability( $availability, $_product ) {
    if ( $_product->is_in_stock() ) {
        $availability['availability'] = '<i class="fa-solid fa-circle" style="color:#00A544;"></i> ' . __('I lager', 'woocommerce');
    } elseif ( $_product->is_on_backorder() ) {
        $availability['availability'] = '<i class="fa-solid fa-exclamation-circle" style="color:orange;"></i> ' . __('Restnoterad', 'woocommerce');
    } else {
        $availability['availability'] = '<i class="fa-solid fa-times-circle" style="color:red;"></i> ' . __('Slut i lager', 'woocommerce');
    }
    return $availability;
}



//Priset ändras beroende på val av attribut
add_action( 'woocommerce_variable_add_to_cart', 'update_price_with_variation_price' );
  
function update_price_with_variation_price() {
   global $product;
   $price = $product->get_price_html();
   wc_enqueue_js( "     
      $(document).on('found_variation', 'form.cart', function( event, variation ) {   
         if(variation.price_html) $('.summary > p.price').html(variation.price_html);
         $('.woocommerce-variation-price').hide();
      });
      $(document).on('hide_variation', 'form.cart', function( event, variation ) {   
         $('.summary > p.price').html('" . $price . "');
      });
   " );
}


add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_add_to_cart_button_text_single' ); 
function woocommerce_add_to_cart_button_text_single() {
    return __( 'Lägg i varukorg', 'woocommerce' ); 
}


