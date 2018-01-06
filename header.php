<!DOCTYPE html>
<html>
<head>
    <title>Leder und Mehr</title>
    <link rel="stylesheet" type="text/css"
        href="<?php bloginfo('stylesheet_url'); ?>"/>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300">
    <link rel="icon" href="<?php echo get_template_directory_uri().
        '/assets/images/tiny_logo.ico'?>" type="image/x-icon"/>
    <link rel='apple-touch-icon' href='<?php echo get_template_directory_uri().
        '/assets/images/tiny_logo_white_bg.png'?>' type='image/png'>
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta name="keywords" content="<?php echo get_theme_mod('meta_keywords'); ?>"/>
    <meta name="description" content="<?php echo get_theme_mod('meta_description'); ?>" />
    <?php wp_head(); ?>
</head>
<body>
<header class="parallax">
    <h1><?php echo get_theme_mod('header_title', 'Leder und Mehr'); ?></h1>
</header>
