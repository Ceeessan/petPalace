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
    <div class="header-menu">
            <?php
            $menu= array(
                'theme_location' => 'mainmenu',
                'menu_id' => 'primary-menu',
                'container' => 'nav',
                'container_class' => 'menu'
            );

            wp_nav_menu($menu);
            ?>
        </div> <div class="header-menu">
            <?php
            $menu= array(
                'theme_location' => 'secondarymenu',
                'menu_id' => 'secondary-menu',
                'container' => 'nav',
                'container_class' => 'menu'
            );

            wp_nav_menu($menu);
            ?>
        </div>

    </header>


