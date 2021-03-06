<?php
/**
 * The 'Leder und Mehr template.
 */
get_header();

// Navigation part
get_template_part('/template-parts/nav/navigation');

// Page content ?>
<section id="page-content" class="content-width">
    <?php
    $home_posts = new WP_Query(array(
        'post_type' => 'post',
        'order' => 'DESC',
        'orderby' => 'date',
        'posts_per_page' => 5
    ));
    if ($home_posts->have_posts()) {
        while ($home_posts->have_posts()) {
            $home_posts->the_post();
            get_template_part('/template-parts/post/post-short-content');
        }
    } else { ?>
        <p>
            There are no posts to be displayed.
        </p> <?php
    } ?>
</section>

<?php get_footer() ?>
