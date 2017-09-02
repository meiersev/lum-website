<nav class="theme-color">
    <?php
    $top_level_pages = new WP_Query(array(
        'post_type' => 'page',
        'post_parent' => 0,
        'order' => 'ASC',
        'orderby' => 'menu_order'
    ));
    if ($top_level_pages->have_posts()) {
        ?><ol>
            <li>
                <a class="theme-color"
                   href="<?php echo home_url($path = '/') ?>">Home</a>
            </li>
        <?php
        while($top_level_pages->have_posts()): $top_level_pages->the_post();?>
            <li>
                <a class="theme-color"
                   href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
            </li>
        <?php endwhile?>
        </ol>
    <?php } ?>
</nav>
