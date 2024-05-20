<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header id="masthead" class="site-header">
        <div class="site-branding">
            <?php if (function_exists('the_custom_logo') && has_custom_logo()) {
                the_custom_logo();
            } else { ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                </h1>
                <p class="site-description"><?php bloginfo('description'); ?></p>
            <?php } ?>
        </div>
        
        <div class="header-menus">
            <div class="header-menu">
                <?php
                $main_menu = array(
                    'theme_location' => 'mainmenu',
                    'menu_id' => 'primary-menu',
                    'container' => 'nav',
                    'container_class' => 'main-menu'
                );
                wp_nav_menu($main_menu);
                ?>
            </div>

            <div class="header-menu">
                <?php
                $secondary_menu = array(
                    'theme_location' => 'secondarymenu',
                    'menu_id' => 'secondary-menu',
                    'container' => 'nav',
                    'container_class' => 'secondary-menu'
                );
                wp_nav_menu($secondary_menu);
                ?>
            </div>
        </div>
        
        <?php if (class_exists('WooCommerce')) : ?>
            <div class="header-cart">
                <a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'your-theme-slug'); ?>">
                    <?php echo sprintf(_n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'your-theme-slug'), WC()->cart->get_cart_contents_count()); ?>
                    - <?php echo WC()->cart->get_cart_total(); ?>
                </a>
            </div>
        <?php endif; ?>
    </header>
    
    <?php wp_footer(); ?>
</body>
</html>
