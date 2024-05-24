<<<<<<< HEAD

=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer at Bottom</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Huvudinnehåll som tar upp resterande utrymme -->
    <div class="content">
        <p>Your main content goes here.</p>
    </div>
>>>>>>> Merva
    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/resources/images/Loggan.png" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
            <div>
                <h2>Contact us</h2>
                <p>385 Noah Place Suite 878</p>
                <p>info@form.com</p>
                <p>877-255-7945</p>
            </div>
            <div class="footer-social">
                <a href="#"><img src="wp-content/themes/petPalace/resources/images/icons8-facebook-50 (1).png" alt="Facebook"></a>
                <a href="#"><img src="wp-content/themes/petPalace/resources/images/icons8-instagram-50 (1).png" alt="Instagram"></a>
            </div>
            <div class="footer-links">
                <p>Privacy & Cookies | Terms & Conditions | <a href="#">Blog</a></p>
            </div>
            <div class="footer-copyright">
                <p>Copyright &copy;2024 Company | All rights reserved</p>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
