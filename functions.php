<?php
/**
 * Lum functions and definitions.
 */

require_once('customizer_settings.php');
require_once('/image-gallery/lum-image-gallery.php');

function lum_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/fancyrestaurant
	 * If you're building a theme based on Fancy Restaurant, use a find and replace
	 * to change 'fancyrestaurant' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'lum' );

    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

	add_image_size( 'lum-featured-image', 2000, 1200, true );

	add_image_size( 'lum-thumbnail-avatar', 100, 100, true );

    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
add_action('after_setup_theme', 'lum_setup');

function lum_scripts() {
	wp_enqueue_script('jquery');

	// Ajax gallery image loader.
	wp_enqueue_script('ajax_gallery_image_load',
		get_theme_file_uri('/assets/js/ajax_gallery_get_full_image.js'),
		array('jquery'),
		NULL,
		true
	);
	// Give the ajax url to the script in object.
	wp_localize_script('ajax_gallery_image_load', 'ajaxpagination', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'lum_scripts');

// Adding custom metadata fields to media uploads.
function lum_add_image_attachment_fields($form_fields, $post) {
	$form_fields['year'] = array(
		'label' => __('Year'),
		'value' => esc_attr(get_post_meta($post->ID, 'year', true)),
		'application' => 'image'
	);

	return $form_fields;
}
add_filter('attachment_fields_to_edit', 'lum_add_image_attachment_fields', 10, 2);

function lum_save_image_attachment_fields($attachment_id) {
	if (isset($_REQUEST['attachments'][$attachment_id]['year'])) {
		$year = $_REQUEST['attachments'][$attachment_id]['year'];
		update_post_meta($attachment_id, 'year', $year);
	}

	return $post;
}
add_action('edit_attachment', 'lum_save_image_attachment_fields');

function lum_image_attachment_columns($columns) {
	$columns['year'] = __("Year");
	return $columns;
}
add_filter("manage_media_columns", "lum_image_attachment_columns", null, 2);

function lum_image_attachment_show_column($name) {
	global $post;
	$field = 'year';
	switch ($name) {
		case $field:
			$value = get_post_meta($post->ID, $field, true);
			echo $value;
			break;
	}
}
add_action('manage_media_custom_column', 'lum_image_attachment_show_column', null, 2);
?>
