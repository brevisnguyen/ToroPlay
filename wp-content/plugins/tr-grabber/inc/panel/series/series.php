<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'admin_footer', 'trgrabber_seasons_lg' );

function trgrabber_seasons_lg() {

echo'
<div class="lgtbx qcklnkbx" style="display:none;" id="trgrabber_seasons_lg">
    <div class="lgtbxcn" style="max-width:180px">
        <div class="lgtbxbd">
            
            <div id="grabber_iframe"></div>
            
        </div>
    </div>
    <span class="lgtblyr"></span>
</div>';

}

function show_additional_information_meta_box() {
    global $post;
    
    $original_title = get_post_meta( $post->ID, TR_GRABBER_ORIGINAL_TITLE, true ) == '' ? '' : esc_textarea( get_post_meta( $post->ID, TR_GRABBER_ORIGINAL_TITLE, true ) );

    $duration = get_post_meta( $post->ID, TR_GRABBER_FIELD_RUNTIME, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_FIELD_RUNTIME, true );

    $duration = is_array($duration) ? implode(', ', $duration) : $duration;
    
    $first_date = get_post_meta( $post->ID, TR_GRABBER_FIELD_DATE, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_FIELD_DATE, true );

    $last_date = get_post_meta( $post->ID, TR_GRABBER_FIELD_DATE_LAST, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_FIELD_DATE_LAST, true );
    
    $trailer = get_post_meta( $post->ID, TR_GRABBER_FIELD_TRAILER, true ) == '' ? '' : html_entity_decode( get_post_meta( $post->ID, TR_GRABBER_FIELD_TRAILER, true ) );

    $poster_hotlink = get_post_meta( $post->ID, TR_GRABBER_POSTER_HOTLINK, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_POSTER_HOTLINK, true );

    $backdrop_hotlink = get_post_meta( $post->ID, TR_GRABBER_FIELD_BACKDROP_HOTLINK, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_FIELD_BACKDROP_HOTLINK, true );

    $backdrop_id = get_post_meta( $post->ID, TR_GRABBER_FIELD_BACKDROP, true ) == '' ? '' : get_post_meta( $post->ID, TR_GRABBER_FIELD_BACKDROP, true );
    
    $status = get_post_meta( $post->ID, TR_GRABBER_FIELD_STATUS, true ) == '' ? '' : esc_textarea( get_post_meta( $post->ID, TR_GRABBER_FIELD_STATUS, true ) );

    $in_production = get_post_meta( $post->ID, TR_GRABBER_FIELD_INPRODUCTION, true ) == '' ? '' : esc_textarea( get_post_meta( $post->ID, TR_GRABBER_FIELD_INPRODUCTION, true ) );
    
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
                        <label><span class="dashicons dashicons-video-alt"></span>'.__('In production', 'tr-grabber').'</label>
                    </th>
                    <td>
                        <ul class="StsOptns">
                            <li><input class="trgrnow" '.checked( $in_production, 1, false ).' type="radio" name="in_production" value="1"><span>'.__('Yes', 'tr-grabber').'</span></li>
                            <li><input class="trgrnow" '.checked( $in_production, 2, false ).' type="radio" name="in_production" value="2"><span>'.__('No', 'tr-grabber').'</span></li>
                        </ul>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label><span class="dashicons dashicons-desktop"></span>'.__('Status', 'tr-grabber').'</label>
                    </th>
                    <td>
                        <input type="text" name="status" value="'.$status.'" placeholder="'.__('Status', 'tr-grabber').'">
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
                        <label><span class="dashicons dashicons-calendar-alt"></span>'.__('First air date', 'tr-grabber').'</label>
                    </th>
                    <td>
                        <input type="date" name="first_air_date" value="'.$first_date.'" placeholder="'.__('First air date', 'tr-grabber').'">
                    </td>
                </tr>

                <tr>
                    <th>
                        <label><span class="dashicons dashicons-calendar-alt"></span>'.__('Last air date', 'tr-grabber').'</label>
                    </th>
                    <td>
                        <input type="date" name="last_air_date" value="'.$last_date.'" placeholder="'.__('Last air date', 'tr-grabber').'">
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

                <input type="hidden" name="tr_post_type" value="2">
            </tbody>
        </table>';
}

function tr_grabber_delete_post( $pid ) {
    global $wpdb;
    
    // delete seasons and episodes for delete post
    
    $result = $wpdb->get_results ( "
        SELECT * 
        FROM  $wpdb->termmeta
            WHERE meta_key = 'tr_id_post'
            AND
            meta_value = '".intval($pid)."'
    " );
    
    foreach( $result as $row ) {
        
        if( $wpdb->get_var( $wpdb->prepare( "SELECT taxonomy FROM $wpdb->term_taxonomy WHERE term_id = %d", $row->term_id ) ) == 'episodes' ) {
            
            wp_delete_term( $row->term_id, 'episodes' );
            
        }elseif( $wpdb->get_var( $wpdb->prepare( "SELECT taxonomy FROM $wpdb->term_taxonomy WHERE term_id = %d", $row->term_id ) ) == 'seasons' ) {

            wp_delete_term( $row->term_id, 'seasons' );
            
        }
        
    }
}

add_action( 'delete_post', 'tr_grabber_delete_post', 10 );