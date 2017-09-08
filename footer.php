<?php
/* The footer of the page.
 */
?>
<footer class="theme-color-bg">
    <section id="footer-content" class="content-width">
        <?php
        $facebook_page = get_theme_mod('facebook_page');
        if ($facebook_page != '') {
            ?>
            <span>Besuche uns auf <a
                href="<?php echo $facebook_page ?>"
                target="_blank">Facebook</a>
            </span>
            <?php
        }
        ?>
        <img class="lum-logo" src="<?php echo get_template_directory_uri().
            '/assets/images/lum_logo_white.svg' ?>">
    </section>
</footer>
<?php wp_footer(); ?>
</body>
</html>
