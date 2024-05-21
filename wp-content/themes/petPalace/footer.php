<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <img src="<?php echo get_template_directory_uri(); ?>/resources/images/Loggan.png" alt="<?php bloginfo('name'); ?>">
            </a>
        </div>
        <div class="footer-section">
            <span>Kontakta oss</span>
            <?php
            $menu = array(
                'theme_location' => 'footer_contact',
                'menu_id' => 'footer_contact',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
        </div>
        <div class="footer-section">
            <span>Sociala Medier</span>
            <?php
            $menu = array(
                'theme_location' => 'footer_socialamedier',
                'menu_id' => 'footer_socialamedier',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
        </div>
        <div class="footer-section">
            <span>Information</span>
            <?php
            $menu = array(
                'theme_location' => 'footer_info',
                'menu_id' => 'footer_info',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
        </div>
    </div>
    <?php wp_footer(); ?>
</footer>
</body>
</html>
