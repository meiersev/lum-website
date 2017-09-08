<?php
/* The footer of the page.
 */

include_once('php-utils/color-utils.php');

function getFbLogoSource($size) {
    $fb_logo_folder = get_template_directory_uri().
        '/assets/images/f_logo_online/png/';
    $theme_color = get_theme_mod('theme_color');
    $wb_complement = wbComplementSelect($theme_color);
    if ($wb_complement == '#000000') {
        $fb_logo_color = 'blue';
    } else {
        $fb_logo_color = 'white';
    }
    return $fb_logo_folder.'FB-f-Logo__'.$fb_logo_color.'_'.$size.'.png';
}
?>
<footer class="theme-color-bg">
    <section id="footer-content" class="content-width">
        <?php
        $facebook_page = get_theme_mod('facebook_page');
        if ($facebook_page != '') {
            ?>
            <span>Besuche uns auf <a
                href="<?php echo $facebook_page ?>"
                target="_blank">
                <img src="<?php echo getFbLogoSource(29); ?>" />
            </a>
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
