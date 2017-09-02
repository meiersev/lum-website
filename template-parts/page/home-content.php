<?php
$home_posts = new WP_Query(array(
    'post_type' => 'post',
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => 5
));
wp_reset_query();
if ($home_posts->have_posts()) {
    $i = 0;
    while ($home_posts->have_posts()) {
        $home_posts->the_post();
        get_template_part('/template-parts/post/content');
        $i = $i + 1;
    }
} else { ?>
    <p>
        There are no posts to be displayed.
    </p> <?php
} ?>
