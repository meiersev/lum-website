<?php
/**
 * The template for the 'über mich' page.
 */
get_header();

// Navigation part
get_template_part('/template-parts/nav/navigation');

?><section id="page-content" class="content-width"><?php
    $subpages = new WP_Query(array(
        'post_type'   => 'page',
        'post_parent' => 35,
        'orderby'     => 'title'
    ));
    while ($subpages->have_posts()) {
        $subpages->the_post();
        ?><h1 class="gallery-title"><?php the_title();?></h1>
        <?php
        get_template_part('/image-gallery/lum-image-gallery-template');
    } ?>
</section>

<?php get_footer(); ?>
