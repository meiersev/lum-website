<?php
/**
 * Template part for displaying posts
 */

?>

<article id="post-<?php the_ID(); ?>" class="post-short" <?php post_class(); ?>>

    <a href="<?php echo get_permalink()?>" class="post-title"><?php the_title(); ?></a>

    <p class="post-short-content">
        <?php the_post_thumbnail('thumbnail', ['class' => 'lum-thumbnail']); ?>
        <?php echo get_the_content(); ?>
        <p class="post-short-date clear-float">
            <?php
            $date_format = 'j. F Y';
            $date_stamp = get_the_date('U');
            echo date_i18n($date_format, $date_stamp);
            ?>
        </p>
    </p>

</article><!-- #post-## -->
