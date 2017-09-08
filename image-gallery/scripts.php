<?php

/**
 * Scripts
 */
function lum_image_gallery_scripts() {

	global $post;

	// return if post object is not set
	if (!isset($post->ID)) {
		return;
	}

	$base_url = get_template_directory_uri();

	wp_register_style('lum-image-gallery',
	                  $base_url.'/image-gallery/css/lum-gallery.css');

	// Needs to load only when there is a gallery.
	if (lum_has_image_gallery()) {
		wp_enqueue_style('lum-image-gallery');

		// Ajax gallery image loader.
		wp_enqueue_script('ajax_gallery_image_load',
			get_theme_file_uri('/image-gallery/js/ajax_gallery_get_full_image.js'),
			array('jquery'),
			NULL,
			true
		);
		// Give the ajax url to the script in object.
		wp_localize_script('ajax_gallery_image_load', 'ajaxpagination', array(
	        'ajaxurl' => admin_url('admin-ajax.php')
	    ));

		// Gallery script.
		wp_enqueue_script('image_gallery',
			get_theme_file_uri('/image-gallery/js/image_gallery.js'),
			array('jquery'),
			NULL,
			true
		);
	}

}
add_action('wp_enqueue_scripts', 'lum_image_gallery_scripts', 20);

/**
 * CSS for admin. Styles the metabox for the Image Gallery.
 */
function easy_image_gallery_admin_css() { ?>

	<style>
		.attachment.details .check div {
			background-position: -60px 0;
		}

		.attachment.details .check:hover div {
			background-position: -60px 0;
		}

		.gallery_images .details.attachment {
			box-shadow: none;
		}

		.eig-metabox-sortable-placeholder {
			background: #DFDFDF;
		}

		.gallery_images .attachment.details > div {
			width: 150px;
			height: 150px;
			box-shadow: none;
		}

		.gallery_images .attachment-preview .thumbnail {
			 cursor: move;
		}

		.attachment.details div:hover .check {
			display:block;
		}

        .gallery_images:after,
        #gallery_images_container:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }

        .gallery_images > li {
            float: left;
            cursor: move;
            margin: 0 20px 20px 0;
        }

        .gallery_images li.image img {
            width: 150px;
            height: auto;
        }

    </style>

<?php }
add_action( 'admin_head', 'easy_image_gallery_admin_css' );
