// (function ($) {
function galleryThumbClick(attachment_id) {
    var lightboxId = "#img" + attachment_id;
    // If there already is an image there, don't load anything.
    if (jQuery(lightboxId + " .lightbox img").length != 0) {
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
            lightbox.html(html);
        }
    });
}
// })(jQuery);
