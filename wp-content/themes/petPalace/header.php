<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- detta är för att Css ska visas på sidan -->
    <?php wp_head(); ?>
</head>
<body>
    <?php wp_body_open(); ?>


    <div class="message-over-header <?php echo (get_option('display_header_text')) ? '' : 'no-message'; ?>">
    <?php
    $display_header_message = get_option('display_header_text');

    if ($display_header_message) {
        $header_message = get_option('header_message');
        if (!empty($header_message)) {
            echo '<div class="header-message">' . esc_html($header_message) . '</div>';
        }
    } else {
        echo '<style>.delivery-truck { display: none; }</style>';
    }
    ?>
    <img class="delivery-truck" src="<?php echo get_template_directory_uri(); ?>/resources/images/delivery.png" alt="truck">
</div>





    <header>
        <div class="header-container"> 
            <button class="hamburger" aria-label="Toggle menu">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                    </span>
            </button>
        <div class="site-branding">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/resources/images/Loggan.png" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
            <div class="primary-header-menu">
                <nav class="nav-menu">
                    <?php
                    $menu = array(
                        'theme_location' => 'mainmenu',
                        'menu_id' => 'primary-menu',
                        'container' => 'div',
                        'container_class' => 'menu'
                    );

                    wp_nav_menu($menu);
                    ?> 
                </nav>
            </div> 
        
            <div class="secondary-header-menu">
                <div class="header-icons">

                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'your-theme-slug'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/resources/images/Ikon-gubbe.png" alt="My Account">
                    </a>

                    <a href="https://petpalace.test/wishlist/" title="<?php _e('Wishlist', 'your-theme-slug'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/resources/images/ikon-heart.png" alt="Wishlist">               
                    </a>

                    <a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'your-theme-slug'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/resources/images/ikon-shoppingbag.png" alt="Shopping Cart">
                        <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); 
                        ?></span>
                    </a>
                </div>
            </div>
        </div> 
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var hamburger = document.querySelector('.hamburger');
            var navMenu = document.querySelector('.nav-menu');

            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('is-active');
                navMenu.classList.toggle('is-active');
            });
        });
    </script>
