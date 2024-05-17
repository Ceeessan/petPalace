<footer>
<?php wp_footer(); ?>

<div>
            <span> Kontakta oss
                <?php
                $menu = array(
                    'theme_location' => 'footer_contact',
                    'menu_id' => 'footer_contact',
                    'container' => 'nav',
                    'container_class' => 'menu'
                );
                wp_nav_menu($menu);
                ?>
            </span>
        </div>
        <div>
            <span> 
                <?php
                $menu = array(
                    'theme_location' => 'footer_socialamedier',
                    'menu_id' => 'footer_socialamedier',
                    'container' => 'nav',
                    'container_class' => 'menu'
                );
                wp_nav_menu($menu);
                ?>
            </span>
        </div>
        <div>
            <span> 
                <?php
                $menu = array(
                    'theme_location' => 'footer_info',
                    'menu_id' => 'footer_info',
                    'container' => 'nav',
                    'container_class' => 'menu'
                );
                wp_nav_menu($menu);
                ?>
            </span>
        </div>  
    </div>

</footer>


</body>
</html>