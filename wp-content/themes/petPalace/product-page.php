<?php
if ( is_product() ) :
    // Omfattande wrapper runt innehållet på produktsidan
    echo '<div class="pp">';

    // Lägg till din betygssektion
    global $product;
    if ( $product ) :
        $rating = $product->get_average_rating();
        $width = ( $rating / 5 ) * 100;
        ?>
        <div class="rating-with-stars">
            <div class="fill" style="width: <?php echo $width; ?>%;"></div>
        </div>
    <?php endif; ?>

    // Lägg till produktsektioner för beskrivning, ytterligare information och recensioner
    ?>
    <div class="product-sections">
        <!-- Produktbeskrivning sektion -->
        <div class="product-section" id="description-section">
            <h2 class="section-title">Product Description <span class="toggle-icon">+</span></h2>
            <div class="section-content"><?php the_content(); ?></div>
        </div>
        <!-- Ytterligare information sektion -->
        <div class="product-section" id="additional-info-section">
            <h2 class="section-title">Additional Information <span class="toggle-icon">+</span></h2>
            <div class="section-content"><?php do_action('woocommerce_product_additional_information'); ?></div>
        </div>
        <!-- Recensioner sektion -->
        <div class="product-section" id="reviews-section">
            <h2 class="section-title">Reviews <span class="toggle-icon">+</span></h2>
            <div class="section-content"><?php comments_template(); ?></div>
        </div>
    </div>

    <!-- Lägg till jQuery kod för att hantera expand/kollaps funktionalitet -->
    <script>
    jQuery(document).ready(function($) {
        $('.section-title').on('click', function() {
            var $sectionContent = $(this).next('.section-content');
            var $toggleIcon = $(this).find('.toggle-icon');

            $sectionContent.slideToggle();
            $toggleIcon.text($toggleIcon.text() == '+' ? '-' : '+');

            // Stäng andra sektioner
            $('.section-content').not($sectionContent).slideUp();
            $('.toggle-icon').not($toggleIcon).text('+');
        });
    });
    </script>

    <?php
    echo '</div>'; // Stäng wrapper div
endif;

// Funktion för att visa relaterade produkter som en karusell
function display_related_products_custom() {
    if ( class_exists( 'WooCommerce' ) ) {
        global $product;
        if ( $product && $product->get_id() ) {
            $related_products = wc_get_related_products( $product->get_id(), 6 ); // Hämta upp till 6 relaterade produkter
            if ( $related_products ) {
                ?>
                <div class="container-related-listing">
                    <h2 class="related-products-title">Relaterade produkter</h2>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            foreach ( $related_products as $related_product_id ) {
                                $related_product = wc_get_product( $related_product_id );
                                if ( $related_product ) {
                                    ?>
                                    <div class="swiper-slide">
                                        <a href="<?php echo esc_url( get_permalink( $related_product->get_id() ) ); ?>">
                                            <?php echo $related_product->get_image(); ?>
                                            <h3><?php echo $related_product->get_name(); ?></h3>
                                            <span class="price"><?php echo $related_product->get_price_html(); ?></span>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <!-- Lägg till pagination för att visa vilken slide användaren befinner sig på -->
                        <div class="swiper-pagination"></div>
                        <!-- Lägg till en visuell cue för att visa att man kan svepa -->
                        <div class="swiper-cue">Swipe to see more products</div>
                    </div>
                </div>
                <?php
            }
        }
    }
}

// Funktion för att starta wrapper div
function wrap_single_product_page_start() {
    if ( is_product() ) {
        echo '<div class="pp">';
    }
}

// Funktion för att stänga wrapper div
function wrap_single_product_page_end() {
    if ( is_product() ) {
        echo '</div>';
    }
}

// Hook för att starta wrapper div före huvudinnehållet
add_action('woocommerce_before_main_content', 'wrap_single_product_page_start', 5);

// Hook för att stänga wrapper div efter huvudinnehållet
add_action('woocommerce_after_main_content', 'wrap_single_product_page_end', 50);

// Hook för att ta bort standard WooCommerce relaterade produkter
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// Funktion för att ta bort standard WooCommerce betygssektion
function remove_woocommerce_product_rating() {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
}

// Hook för att ta bort standard WooCommerce betygssektion
add_action('wp', 'remove_woocommerce_product_rating');

// Funktion för att lägga till anpassad betygssektion
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

// Hook för att lägga till anpassad betygssektion efter produktsammanfattningen
add_action('woocommerce_after_single_product', 'petPalace_add_star_rating_single_product', 15);

// Hook för att lägga till relaterade produkter efter single product
add_action('woocommerce_after_single_product', 'display_related_products_custom', 20);
?>
