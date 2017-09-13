<?php
// Get the html code for the loaded full image.
function get_full_attachment_image() {
    $attachment_id = $_GET['attachment_id'];
    echo wp_get_attachment_image($attachment_id, 'large', false, array('class' => 'hidden'));
    $description = wp_get_attachment_caption($attachment_id);
    if ($description) {?>
        <p class="lightbox-description hidden">
            <?php echo wp_get_attachment_caption($attachment_id); ?>
        </p><?php
    }

    wp_die();
}
add_action('wp_ajax_nopriv_get_full_attachment_image',
           'get_full_attachment_image');
add_action('wp_ajax_get_full_attachment_image',
          'get_full_attachment_image');
?>
