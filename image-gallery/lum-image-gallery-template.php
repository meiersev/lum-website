<?php
$attachment_ids = lum_image_gallery_get_image_ids();

// If there is no gallery here, return.
if (empty($attachment_ids)) {
    return;
}

?><section class="gallery-thumb-list"><?php
foreach ($attachment_ids as $index => $attachment_id) {
    // Thumbnail ?>
    <a href="<?php echo '#img'.$attachment_id ?>"
        id="<?php echo 'img'.$attachment_id.'thumb' ?>"
        class="gallery-thumb">
        <?php echo wp_get_attachment_image($attachment_id, 'thumbnail'); ?>
    </a><?php
    // Lightbox
    ?><div class="lightbox-frame"
        id="<?php echo 'img'.$attachment_id ?>">
        <a href="#"
        class="lightbox">
        <?php

            echo wp_get_attachment_image($attachment_id, 'large');
            $description = wp_get_attachment_caption($attachment_id);
            if ($description) {?>
            <p class="lightbox-description">
                <?php echo wp_get_attachment_caption($attachment_id); ?>
            </p>
        </a>
        <?php }
        // Button to go to previous image
        if ($index > 0) {
            ?><a href="<?php echo '#img'.$attachment_ids[$index - 1] ?>"
                 class="gallery-prev-arrow">prev
            </a><?php
        }
        // Button to go to next image
        if ($index < sizeof($attachment_ids) - 1) {
            ?><a href="<?php echo '#img'.$attachment_ids[$index + 1] ?>"
                 class="gallery-next-arrow">next
            </a><?php
        }
        ?>
    </div>
<?php
}
?></section><?php
?>
