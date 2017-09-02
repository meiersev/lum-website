<?php
/**
 * The template for the 'über mich' page.
 */
get_header();

// Navigation part
get_template_part('/template-parts/nav/navigation'); ?>

<section id="page-content">
    <?php
    $about_id = get_queried_object_id();
    $about_pages = new WP_Query(array(
        'post_type' => 'page',
        'post_parent' => $about_id,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));
    if ($about_pages->have_posts()) { ?>
        <section class="about-content"> <?php
        while ($about_pages->have_posts()) {
            $about_pages->the_post(); ?>
            <article class="about-page">
                <h2><?php the_title() ?></h2>
                <?php the_content(); ?>
            </article>
            <?php
        } ?>
        </section> <?php
    } else { ?>
        <p>
            No content found.
        </p> <?php
    }
    ?>
</section>

<?php get_footer() ?>
