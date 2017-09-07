<?php
$attachment_ids = lum_image_gallery_get_image_ids();
global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request));

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
        <a href="#" class="lightbox-close-bg"></a>
        <a href="<?php echo $current_url; ?>">
            <img src="<?php echo get_template_directory_uri().
                '/image-gallery/icons/ic_close_white_36px.svg'?>" />
        </a>
        <div class="lightbox spinner">
            <?php
            // Button to go to previous image
            if ($index > 0) {
                $prev_attachment_id = $attachment_ids[$index - 1];
                ?><a href="<?php echo '#img'.$prev_attachment_id ?>"
                     class="gallery-prev-arrow gallery-arrow"
                     onclick="<?php echo 'galleryThumbClick('.$prev_attachment_id.')' ?>">
                     <img src="<?php
                        echo get_template_directory_uri().
                        '/image-gallery/icons/ic_navigate_before_white_48px.svg'?>"
                        />
                </a><?php
            }
            ?>
                <!-- Content added dynamically using ajax -->
            <?php
            // Button to go to next image
            if ($index < sizeof($attachment_ids) - 1) {
                $next_attachment_id = $attachment_ids[$index + 1];
                ?><a href="<?php echo '#img'.$next_attachment_id ?>"
                     class="gallery-next-arrow gallery-arrow"
                     onclick="<?php echo 'galleryThumbClick('.$next_attachment_id.')' ?>">
                     <img src="<?php
                        echo get_template_directory_uri().
                        '/image-gallery/icons/ic_navigate_next_white_48px.svg'?>"
                        />
                </a><?php
            }?>
        </div>
    </div>
<?php
}
?></section><?php
?>
