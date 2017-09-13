<?php
// Retrieve the attachment ID from the file URL.
function get_image_id_from_url($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col(
        $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';",
            $image_url )); 
    return $attachment[0];
}
?>
