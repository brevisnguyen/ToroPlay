<?php
/**
 * Plugin Name: SwiftThemes Dynamic Thumbnails
 * Plugin URI: http://swiftthemes.com/swiftdynamicthumbs-plugin-to-generate-thumbnails-dynamically-when-needed/
 * Description: Prevents WordPress from generating thumbnails of sizes registered by themes and plugins and generates them dynamically only when needed.
 * Version: 0.1
 * Author: Satish Gandham
 * Author URI: http://SatishGandham.Com
 *
 * @author Satish Gandham <hello@satishgandham.com>
 * License: GPLv2 or later
 *
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/**
 *
 * Stop WordPress from generating the thumbnails for sizes registered by themes and plugins
 *
 * @param array $sizes
 */
if ( ! function_exists( 'sdt_stop_thumbs' ) ) {

	function sdt_stop_thumbs( $sizes ) {
		global $_wp_additional_image_sizes;
		if ( isset( $_wp_additional_image_sizes ) ) {
			$intermediate_image_names = array_keys( $_wp_additional_image_sizes );
			foreach ( $intermediate_image_names as $name ) {
				unset( $sizes[ $name ] );
			}
		}

		return $sizes;
	}

}
add_filter( 'intermediate_image_sizes_advanced', 'sdt_stop_thumbs' );

// We dont need this on the backend, let wordpress do its job
if ( ! is_admin() ) {
	add_filter( 'image_downsize', 'sdt_image_downsize', 10, 3 );
}

/**
 *
 * Modifying the orignial image_downsize function located in wp-includes/media.php
 *
 * Checks if the file with the specified dimesnions exists, before image_get_intermediate_size()
 * and if the file doesnt exist, it creates the file and updates the image metadata. So
 * image_get_intermediate_size()vwill always find the exact image user wants.
 */
function sdt_image_downsize( $content, $id, $size ) {

	global $_wp_additional_image_sizes;


	if ( ! wp_attachment_is_image( $id ) ) {
		return false;
	}

	$img_url          = wp_get_attachment_url( $id );
	$meta             = wp_get_attachment_metadata( $id );
	$width            = $height = 0;
	$is_intermediate  = false;
	$img_url_basename = wp_basename( $img_url );

	if ( isset( $_wp_additional_image_sizes ) ) {
		$intermediate_image_names = array_keys( $_wp_additional_image_sizes );
	} else {
		$intermediate_image_names = array( '' );
	}

	if ( is_array( $size ) ) {
		$width  = $size[0];
		$height = $size[1];
	} elseif ( in_array( $size, $intermediate_image_names ) ) {
		$width  = $_wp_additional_image_sizes[ $size ]['width'];
		$height = $_wp_additional_image_sizes[ $size ]['height'];
	} else {
		return;
	}

	if ( is_array( $size ) || in_array( $size, $intermediate_image_names ) ) {

		$uploads = wp_upload_dir();
		if ( ! isset( $meta['file'] ) ) {
			return;
		}
		$file_path = $uploads['basedir'] . '/' . $meta['file'];

		if ( file_exists( $file_path ) ) {
			$orig_size = @getimagesize( $file_path );
			/*
			 * $path_parts = pathinfo('/www/htdocs/inc/lib.inc.php');
			 * echo $path_parts['dirname'], "\n";
			 * echo $path_parts['basename'], "\n";
			 * echo $path_parts['extension'], "\n";
			 * echo $path_parts['filename'], "\n"; // since PHP 5.2.0
			 * The above example will output:
			 *
			 * /www/htdocs/inc
			 * lib.inc.php
			 * php
			 * lib.inc
			 *
			 */
			$file_info = pathinfo( $file_path );
			$extension = '.' . $file_info['extension'];
			if ( $extension == '.jpeg' ) {
				$extension = '.jpg';
			}


			// the image path without the extension
			$no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];


			// If height is set to zero, we will crop the image proportinally
			if ( $height == 0 ) {
				$size[1] = $height = (int) ( ( $width / $orig_size[0] ) * $orig_size[1] );
			}

			//Generate the cropped image path, and use it check if the image exists
			$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;
			$cropped_img_name = $file_info['filename'] . '-' . $width . 'x' . $height . $extension;
//			$cropped_img_path_2x = $no_ext_path . '-' . $width . 'x' . $height . '@2x' . $extension;
//			$cropped_img_name_2x = $file_info['filename'] . '-' . $width . 'x' . $height . '@2x' . $extension;


			if ( ( $orig_size[0] > $width && $orig_size[1] > $height ) ) {
				// If the file doesn't exist, we generate it
				if ( ! file_exists( $cropped_img_path ) ) {

					$intermediate = image_make_intermediate_size( $file_path, $width, $height, true );

					if ( ! is_array( $size ) && $intermediate ) {
						$meta['sizes'][ $size ] = $intermediate;
						wp_update_attachment_metadata( $id, $meta );
					}

				}
				$img_url = preg_replace( '/' . $file_info['basename'] . '/', $cropped_img_name, $img_url );
			}

//			if ($sdt_design_options['enable_retina_support'] && ($orig_size[0] > 2 * $width && 2 * $orig_size[1] > $height)) {
//				if (!file_exists($cropped_img_path_2x)) {
//					if ($width || $height) {
//						$editor = wp_get_image_editor($file_path);
//						if (!is_wp_error($editor) && !is_wp_error($editor->resize(2 * $width, 2 * $height, true))) {
//							$editor->save($cropped_img_path_2x);
//						}
//
//					}
//				}
//			}

		}

	}
	if ( $size == 'thumbnail' ) {
		// fall back to the old thumbnail
		if ( ( $thumb_file = wp_get_attachment_thumb_file( $id ) ) && $info = @getimagesize( $thumb_file ) ) {
			$img_url         = str_replace( $img_url_basename, wp_basename( $thumb_file ), $img_url );
			$width           = $info[0];
			$height          = $info[1];
			$is_intermediate = true;
		}
	}

	if ( ! $width && ! $height && isset( $meta['width'], $meta['height'] ) ) {
		// any other type: use the real image
		$width  = $meta['width'];
		$height = $meta['height'];

	}

	if ( $img_url ) {
		// we have the actual image size, but might need to further constrain it if content_width is narrower
		list( $width, $height ) = image_constrain_size_for_editor( $width, $height, $size );

		return array( $img_url, $width, $height, $is_intermediate );
	}

	return false;
}