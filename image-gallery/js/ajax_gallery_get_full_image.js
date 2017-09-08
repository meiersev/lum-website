/* Send AJAX request to retrieve the full sized image corresponding to the
 * given attachment.
 */
function getFullImage(attachment_id) {
    var lightboxId = "#img" + attachment_id;
    // If there already is an image there, don't load anything.
    if (jQuery(lightboxId + " .lightbox>img").length != 0) {
        return;
    }

    jQuery.ajax({
        url: ajaxpagination.ajaxurl,
        method: 'GET',
        data: {
            action: 'get_full_attachment_image',
            attachment_id: attachment_id
        },
        success: function(html) {
            var lightbox = jQuery(lightboxId + " .lightbox");
            lightbox.removeClass("spinner");
            lightbox.append(html);
        }
    });
}

/* Get the Id from the hash in the URI and load the image when the page is
 * loaded.
 */
function getImageOnDirectLoad(){
    var hash = window.location.hash;
    if (hash.length > 1) {
        var id = hash.replace('#img', '');
        getFullImage(id);
    }
}
// jQuery(document).ready(getImageOnDirectLoad())
