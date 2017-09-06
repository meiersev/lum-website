
/* Prevent #img links to enter the browser history
 */
jQuery(window).on('hashchange', function() {
    var hash = window.location.hash;
    if (hash.match(/#img[0-9]+/)) {
        history.replaceState({}, '', '#');
    }
});
