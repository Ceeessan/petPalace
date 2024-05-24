<footer>
<?php wp_footer(); ?>

<div class="footer-container">
            <div class="footer-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/resources/images/Loggan.png" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
     
        <div class="menu-text">
            <h4 class= contact-text>Kontakta oss</h4>
        <span> 
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


        <div class="menu-social">
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
       
        <div>

        <div class= "menu-terms-conditions">
            <span> 
                <?php
                $menu = array(
                    'theme_location' => 'footer_info',
                    'menu_id' => 'footer_kundservice',
                    'container' => 'nav',
                    'container_class' => 'menu'
                );
                wp_nav_menu($menu);
                ?>
            </span>
        </div>  
    </div>
          
    <div class="footer-message">
    <?php echo esc_html(get_option('footer_message')); ?>
</div>


</footer>


</body>
</html>