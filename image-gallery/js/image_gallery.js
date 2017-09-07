
/* Prevent #img links to enter the browser history
 */
jQuery(document).ready(function($) {

    if (window.history && window.history.pushState) {
        var nImagesClicked = 0;

        $(window).on('popstate', function() {
            var hash = window.location.hash;
            if (hash === '') {
                if (nImagesClicked) {
                    history.go(-nImagesClicked - 1);
                    nImagesClicked = 0;
                }
            } else if (hash.match(/#img[0-9]+/)) {
                ++nImagesClicked;
                history.replaceState({}, '', '#');
                // history.pushState({}, '', hash);
            }
            console.log(nImagesClicked);
        });
    }

});
