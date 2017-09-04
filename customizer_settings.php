<?php
include_once('php-utils/color-utils.php');
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
}
add_action('customize_register', 'lum_general_customize_register');

function lum_header_image_css() {
    ?>
    <style type="text/css">
        header {
            background-image: url(<?php echo get_theme_mod('header_image') ?>);
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
            background-color: <?php echo $theme_color ?>;
            color: <?php echo $wb_complement; ?>;
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
