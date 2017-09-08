/* Open the gallery lightbox.
 */
function galleryOpen(attachment_id) {
    galleryClose();
    jQuery('#img'+attachment_id).css('display', 'flex');
    getFullImage(attachment_id);
}

/* Close the gallery lightbox.
 */
function galleryClose() {
    jQuery('.lightbox-frame').css('display', 'none');
}

/* Close the gallery lightbox when the back button is pressed.
 */
jQuery(document).ready(function ($) {
    var galleryBackHandler = function (event) {
        var hash = window.location.hash;
        if (hash === '' || hash === '#' || hash === undefined) {
            galleryClose();
        }
    }
    $(window).on('hashchange', galleryBackHandler);
});
