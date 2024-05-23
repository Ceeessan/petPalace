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
?>
