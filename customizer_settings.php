<?php
include_once('php-utils/color-utils.php');
include_once('php-utils/db-utils.php');
/*
 * Register customizer object for page title, header image and base color.
 */
function lum_general_customize_register($wp_customize) {
    $wp_customize->add_section('general_section', array(
        'title'         => __('General'),
        'description'   => __('Change general site attributes here')
    ));

    $wp_customize->add_setting('header_title', array(
        'default' => 'Leder und Mehr',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control('header_title_text', array(
        'settings' => 'header_title',
        'label'    => __('Header Title'),
        'section'  => 'general_section',
        'type'     => 'text'
    ));

    $wp_customize->add_setting('header_image', array(
        'default' => get_template_directory_uri().'/assets/images/header.jpg'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'header_image',
        array(
            'settings' => 'header_image',
            'label'    => __('Upload your header image'),
            'section'  => 'general_section'
        )
    ));

    $wp_customize->add_setting('theme_color', array(
        'default'  => '#324359'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'theme_color',
        array(
            'settings' => 'theme_color',
            'label'   => __('Theme color'),
            'section' => 'general_section'
        )
    ));

    $wp_customize->add_setting('facebook_page', array(
        'default' => '',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control('facebook_page_link', array(
        'settings' => 'facebook_page',
        'label'    => __('Facebook Page'),
        'section'  => 'general_section',
        'type'     => 'url'
    ));

    $wp_customize->add_setting('meta_keywords', array(
        'default' => '',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control('meta_keywords_ctrl', array(
        'settings' => 'meta_keywords',
        'label'    => __('SEO meta keywords'),
        'section'  => 'general_section',
        'type'     => 'text'
    ));

    $wp_customize->add_setting('meta_description', array(
        'default' => '',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control('meta_description_ctrl', array(
        'settings' => 'meta_description',
        'label'    => __('SEO meta description'),
        'section'  => 'general_section',
        'type'     => 'text'
    ));
}
add_action('customize_register', 'lum_general_customize_register');

function lum_header_image_css() {
    $attachment_id = get_image_id_from_url(get_theme_mod('header_image'));
    $image_url = wp_get_attachment_image_src($attachment_id, array(2000,1200))[0];
    ?>
    <style type="text/css">
        header {
            background-image: url(<?php echo $image_url ?>);
        }
    </style>
    <?php
}
add_action('wp_head', 'lum_header_image_css');

function lum_general_theme_color_css() {
    $theme_color = get_theme_mod('theme_color');
    $wb_complement = wbComplementSelect($theme_color);
    ?>
    <style type="text/css">
        .theme-color {
            color: <?php echo $theme_color; ?>;
            outline: transparent solid 2px;
            transition: outline-color .5s linear;
        }
        a.theme-color:hover {
            outline: <?php echo $theme_color; ?> solid 2px;
        }
        .theme-color-bg {
            background-color: <?php echo $theme_color; ?>;
            color: <?php echo $wb_complement; ?>;
        }
        ::selection {
            color: <?php echo $wb_complement; ?>;
            background-color: <?php echo $theme_color ?>;
        }

        .gallery-thumb-list .gallery-thumb img:hover,
        #page-content.contact-content form button:hover
        {
            box-shadow: 0 0 2px 1px <?php echo $theme_color ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'lum_general_theme_color_css');

/*
 * Register customizer object for contact page.
 */
function lum_contact_customize_register($wp_customize) {
    $wp_customize->add_section('contact_section', array(
        'title'         => __('Contact'),
        'description'   => __('Change attributes of contact page')
    ));

    $wp_customize->add_setting('contact_email', array(
        'default' => 'something@example.com'
    ));
    $wp_customize->add_control('contact_email_addr', array(
        'settings' => 'contact_email',
        'label'    => __('Email Address'),
        'section'  => 'contact_section',
        'type'     => 'email'
    ));
}
add_action('customize_register', 'lum_contact_customize_register');
?>
