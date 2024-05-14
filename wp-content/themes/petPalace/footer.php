<footer>
<?php wp_footer(); ?>

<div>
            <span> Kontakta oss
                <?php
                $menu = array(
                    'theme_location' => 'Footer_kontakt',
                    'menu_id' => 'Footer_kontakt',
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
                    'theme_location' => 'footer_kundservice',
                    'menu_id' => 'footer_kundservice',
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