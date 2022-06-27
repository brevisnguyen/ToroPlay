<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function show_additional_information_meta_box() {
    global $post;
    
    $original_title = get_post_meta( $post->ID, TR_GRABBER_ORIGINAL_TITLE, true ) == '' ? '' : esc_textarea( get_post_meta( $post->ID, TR_GRABBER_ORIGINAL_TITLE, true ) );

    $duration = get_post_meta( $post->ID, TR_GRABBER_FIELD_RUNTIME, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_FIELD_RUNTIME, true );

    $release_date = get_post_meta( $post->ID, TR_GRABBER_FIELD_DATE, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_FIELD_DATE, true );

    $trailer = get_post_meta( $post->ID, TR_GRABBER_FIELD_TRAILER, true ) == '' ? '' : html_entity_decode( get_post_meta( $post->ID, TR_GRABBER_FIELD_TRAILER, true ) );

    $poster_hotlink = get_post_meta( $post->ID, TR_GRABBER_POSTER_HOTLINK, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_POSTER_HOTLINK, true );

    $backdrop_hotlink = get_post_meta( $post->ID, TR_GRABBER_FIELD_BACKDROP_HOTLINK, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_FIELD_BACKDROP_HOTLINK, true );

    $backdrop_id = get_post_meta( $post->ID, TR_GRABBER_FIELD_BACKDROP, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_FIELD_BACKDROP, true );

    echo '<table class="tr_grabber_content form-table">
            <tbody>
                <tr>
                    <th>
                        <label><span class="dashicons dashicons-format-aside"></span>'.__('Original name', 'tr-grabber').'</label>
                    </th>
                    <td>
                        <input type="text" name="original_title" value="'.$original_title.'" placeholder="'.__('Original name', 'tr-grabber').'">
                    </td>
                </tr>

                <tr>
                    <th>
                        <label><span class="dashicons dashicons-admin-links"></span>'.__('Poster Hotlink', 'tr-grabber').'</label>
                    </th>
                    <td>
                        <input type="text" name="poster_hotlink" value="'.$poster_hotlink.'" placeholder="'.__('Poster Hotlink', 'tr-grabber').'">
                    </td>
                </tr>

                <tr>
                    <th>
                        <label><span class="dashicons dashicons-admin-links"></span>'.__('Backdrop Hotlink', 'tr-grabber').'</label>
                    </th>
                    <td>
                        <input type="text" name="backrop_hotlink" value="'.$backdrop_hotlink.'" placeholder="'.__('Backdrop Hotlink', 'tr-grabber').'">
                        <input type="hidden" name="backdrop_id" id="trgrabber_backdrop_id" value="'.$backdrop_id.'">
                    </td>
                </tr>

                <tr>
                    <th>
                        <label><span class="dashicons dashicons-clock"></span>'.__('Duration', 'tr-grabber').'</label>
                    </th>
                    <td>
                        <input type="text" name="duration" value="'.$duration.'" placeholder="'.__('Duration', 'tr-grabber').'">
                    </td>
                </tr>

                <tr>
                    <th>
                        <label><span class="dashicons dashicons-calendar-alt"></span>'.__('Release date', 'tr-grabber').'</label>
                    </th>
                    <td>
                        <input type="date" name="release_date" value="'.$release_date.'" placeholder="'.__('Release date', 'tr-grabber').'">
                    </td>
                </tr>

                <tr class="cldtrlr">
                    <th colspan="2">
                        <label><span class="dashicons dashicons-format-video"></span>'.__('Trailer', 'tr-grabber').'</label>
                    </th>
                </tr>
                <tr class="cldtrlr">
                    <td colspan="2">
                        <textarea name="trailer" placeholder="'.__('Insert code iframe here', 'tr-grabber').'">'.$trailer.'</textarea>
                    </td>
                </tr>

                <input type="hidden" name="tr_post_type" value="1">
            </tbody>
        </table>';
}