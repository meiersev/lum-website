<?php
/**
 * Template part for displaying posts
 */

?>

<a class="post-short-link" href="<?php echo get_permalink()?>">
    <article id="post-<?php the_ID(); ?>" class="post-short" <?php post_class(); ?>>

        <h2  class="post-title">
            <?php the_title(); ?>
        </h2>

        <section class="post-short-content">
            <?php the_post_thumbnail('thumbnail', ['class' => 'lum-thumbnail']); ?>
            <p>
                <?php echo get_the_content(); ?>
            </p>
            <p class="post-short-date clear-float">
                <?php
                $date_format = 'j. F Y';
                $date_stamp = get_the_date('U');
                echo date_i18n($date_format, $date_stamp);
                ?>
            </p>
        </section>

    </article>
</a><!-- #post-## -->
