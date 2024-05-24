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
                <div class="related-products-title">Relaterade Produkter</div>
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
                <div class="swiper-cue">Svep för att se fler produkter</div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 1,
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

// Custom add to cart template
function custom_woocommerce_template_single_add_to_cart() {
    global $product;
    ?>
    <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

        <div class="quantity">
            <button type="button" class="minus">-</button>
            <input type="number" id="quantity" class="input-text qty text" step="1" min="1" max="<?php echo esc_attr( $product->get_max_purchase_quantity() ); ?>" name="quantity" value="1" title="<?php esc_attr_e( 'Qty', 'woocommerce' ); ?>" size="4" inputmode="numeric" />
            <button type="button" class="plus">+</button>
        </div>

        <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.quantity .minus').addEventListener('click', function() {
                var qty = document.querySelector('.quantity input[type="number"]');
                if (qty.value > 1) qty.value--;
            });

            document.querySelector('.quantity .plus').addEventListener('click', function() {
                var qty = document.querySelector('.quantity input[type="number"]');
                qty.value++;
            });
        });
    </script>
    <?php
}

// Lägg till custom add to cart template med hjälp av WooCommerce hook
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'custom_woocommerce_template_single_add_to_cart', 30 );
?>
