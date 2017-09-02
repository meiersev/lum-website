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
        onclick="<?php echo 'galleryThumbClick('.$attachment_id.')' ?>"
        class="gallery-thumb">
        <?php echo wp_get_attachment_image($attachment_id, 'thumbnail'); ?>
    </a><?php
    // Lightbox
    ?><div class="lightbox-frame"
        id="<?php echo 'img'.$attachment_id ?>">
        <?php
        // Button to go to previous image
        if ($index > 0) {
            $prev_attachment_id = $attachment_ids[$index - 1];
            ?><a href="<?php echo '#img'.$prev_attachment_id ?>"
                 class="gallery-prev-arrow"
                 onclick="<?php echo 'galleryThumbClick('.$prev_attachment_id.')' ?>">
                 <img src="<?php
                    echo get_template_directory_uri().
                    '/image-gallery/icons/ic_navigate_before_white_48px.svg'?>"
                    />
            </a><?php
        }
        ?>
        <a href="#"
        class="lightbox spinner">
            <!-- Content added dynamically using ajax -->
        </a>
        <?php
        // Button to go to next image
        if ($index < sizeof($attachment_ids) - 1) {
            $next_attachment_id = $attachment_ids[$index + 1];
            ?><a href="<?php echo '#img'.$next_attachment_id ?>"
                 class="gallery-next-arrow"
                 onclick="<?php echo 'galleryThumbClick('.$next_attachment_id.')' ?>">
                 <img src="<?php
                    echo get_template_directory_uri().
                    '/image-gallery/icons/ic_navigate_next_white_48px.svg'?>"
                    />
            </a><?php
        }
        ?>
    </div>
<?php
}
?></section><?php
?>
