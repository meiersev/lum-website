<?php
/**
 * Add meta boxes to selected post types
 */
function lum_image_gallery_add_meta_box() {

    $allowed_types = lum_allowed_gallery_post_types();

    if (!$allowed_types) {
        return;
    }

    foreach ($allowed_types as $post_type => $status ) {
        add_meta_box(
            'lum_image_gallery',
            __( 'Image Gallery'),
            'lum_image_gallery_metabox'
        );
    }

}
add_action( 'add_meta_boxes', 'lum_image_gallery_add_meta_box' );


/**
 * Render gallery metabox
 */
function lum_image_gallery_metabox() {
    global $post;

    ?>
    <p class="add_gallery_images hide-if-no-js">
        <a href="#"><?php echo __('Add gallery images'); ?></a>
    </p>

    <div id="gallery_images_container">

        <ul class="gallery_images"><?php

    $image_gallery = get_post_meta($post->ID, 'lum_image_gallery', true);
    $attachment_ids = array_filter(explode(',', $image_gallery));

    if ($attachment_ids) {
        foreach ( $attachment_ids as $attachment_id ) {
            ?><li class="image attachment details"
                  data-attachment_id="<?php echo $attachment_id ?>">
                <div class="attachment-preview">
                    <div class="thumbnail">
                        <?php echo wp_get_attachment_image($attachment_id, 'thumbnail') ?>
                    </div>
                    <a href="#" class="delete check" title="<?php __( 'Remove image') ?>">
                        <div class="media-modal-icon"></div>
                    </a>
                </div>
            </li><?php
        }
    }
        ?></ul>

        <input type="hidden"
               id="image_gallery"
               name="image_gallery"
               value="<?php echo esc_attr( $image_gallery ); ?>" />
        <?php wp_nonce_field( 'easy_image_gallery', 'easy_image_gallery' ); ?>

    </div>

    <?php

    /**
     * Props to WooCommerce for the following JS code
     */
     ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){

            // Uploading files
            var image_gallery_frame;
            var $image_gallery_ids = $('#image_gallery');
            var $gallery_images = $('#gallery_images_container ul.gallery_images');

            jQuery('.add_gallery_images').on( 'click', 'a', function( event ) {

                var $el = $(this);
                var attachment_ids = $image_gallery_ids.val();

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if (image_gallery_frame) {
                    image_gallery_frame.open();
                    return;
                }

                // Create the media frame.
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php echo __('Add Images to Gallery', 'image-gallery'); ?>',
                    button: {
                        text: '<?php echo __('Add to gallery', 'image-gallery'); ?>',
                    },
                    multiple: true
                });

                // When an image is selected, run a callback.
                image_gallery_frame.on( 'select', function() {

                    var selection = image_gallery_frame.state().get('selection');

                    selection.map(function(attachment) {

                        attachment = attachment.toJSON();

                        if (attachment.id) {
                            attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                             $gallery_images.prepend('\
                                <li class="image attachment details" data-attachment_id="' + attachment.id + '">\
                                    <div class="attachment-preview">\
                                        <div class="thumbnail">\
                                            <img src="' + attachment.url + '" />\
                                        </div>\
                                       <a href="#" class="delete check" title="<?php _e( 'Remove image', 'easy-image-gallery' ); ?>"><div class="media-modal-icon"></div></a>\
                                    </div>\
                                </li>');

                        }

                    });
                    $image_gallery_ids.val(attachment_ids);
                });

                // Finally, open the modal.
                image_gallery_frame.open();
            });

            // Image ordering
            $gallery_images.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity: 40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'eig-metabox-sortable-placeholder',
                start:function(event,ui){
                    ui.item.css('background-color','#f6f6f6');
                },
                stop:function(event,ui){
                    ui.item.removeAttr('style');
                },
                update: function(event, ui) {
                    var attachment_ids = '';

                    $('#gallery_images_container ul li.image').css('cursor','default').each(function() {
                        var attachment_id = jQuery(this).attr('data-attachment_id');
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                    $image_gallery_ids.val( attachment_ids );
                }
            });

            // Remove images
            $('#gallery_images_container').on('click', 'a.delete', function() {

                $(this).closest('li.image').remove();

                var attachment_ids = '';

                $('#gallery_images_container ul li.image').css('cursor','default').each(function() {
                    var attachment_id = jQuery(this).attr('data-attachment_id');
                    attachment_ids = attachment_ids + attachment_id + ',';
                });

                $image_gallery_ids.val( attachment_ids );

                return false;
            } );

        });
    </script>
    <?php
}


/**
 * Save function
 */
function easy_image_gallery_save_post($post_id) {

    $post_types = lum_allowed_gallery_post_types();

    // check user permissions
    if (isset($_POST['post_type']) && !array_key_exists($_POST['post_type'], $post_types)) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (isset($_POST['image_gallery']) && !empty($_POST['image_gallery'])) {

        $attachment_ids = sanitize_text_field($_POST['image_gallery']);

        // turn comma separated values into array
        $attachment_ids = explode(',', $attachment_ids);

        // clean the array
        $attachment_ids = array_filter($attachment_ids);

        // return back to comma separated list with no trailing comma. This is common when deleting the images
        $attachment_ids =  implode(',', $attachment_ids);

        update_post_meta( $post_id, 'lum_image_gallery', $attachment_ids );
    } else {
        delete_post_meta( $post_id, 'lum_image_gallery' );
    }
}
add_action( 'save_post', 'easy_image_gallery_save_post' );
