<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- detta är för att Css ska visas på sidan -->
    <?php wp_head(); ?>
</head>
<body>
    <?php wp_body_open(); ?>

    <header>
        <div class="header-container"> 
            <div class="primary-header-menu">
                <button class="hamburger" aria-label="Toggle menu">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
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
            
            <div class="site-branding">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/resources/images/Loggan.png" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
        
            <div class="secondary-header-menu">
                <div class="header-icons">
                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'your-theme-slug'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/resources/images/Ikon-gubbe.png" alt="My Account">
                    </a>
                    <a href="<?php echo get_permalink(wc_get_page_id('wishlist')); ?>" title="<?php _e('Wishlist', 'your-theme-slug'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/resources/images/ikon-heart.png" alt="Wishlist">
                    </a>
                    <a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'your-theme-slug'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/resources/images/ikon-shoppingbag.png" alt="Shopping Cart">
                    </a>
                </div>
            </div>
        </div> 
    </header>

    <?php wp_footer(); ?>
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
</body>
</html>
