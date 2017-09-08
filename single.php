<?php
/**
 * The 'Leder und Mehr' template for a single post.
 */
get_header();

// Navigation part
get_template_part('/template-parts/nav/navigation');

// Page content ?>
<section id="page-content" class="content-width">
    <?php the_post();?>
    <h2 class="post-title"><?php echo the_title(); ?></h2>

    <p>
        <?php the_content();
        get_template_part('/image-gallery/lum-image-gallery-template');
        ?>
    </p>




    <?php
    ?>
</section>

<?php get_footer() ?>
