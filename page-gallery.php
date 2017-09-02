<?php
/**
 * The template for the 'über mich' page.
 */
get_header();

// Navigation part
get_template_part('/template-parts/nav/navigation');

?><section id="page-content"><?php
    $subpages = new WP_Query(array(
        'post_type'   => 'page',
        'post_parent' => 35,
        'orderby'     => 'title'
    ));
    while ($subpages->have_posts()) {
        $subpages->the_post();
        ?><h1><?php the_title();?></h1>
        <p><?php
        get_template_part('/image-gallery/lum-image-gallery-template');
        ?></p><?php
    } ?>
</section>

<?php get_footer(); ?>
