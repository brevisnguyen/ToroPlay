<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'admin_footer', 'trgrabber_quicklinks' );

function trgrabber_quicklinks() {
    global $pagenow, $post;

if( !in_array( $pagenow, array( 'post.php', 'term.php' ) ) ) return;
    
if( in_array( $pagenow, array( 'post.php' ) ) and tr_grabber_type( $post->ID ) == 2 ) {

$array = tr_grabber_list_seasons( $post->ID );
$select_seasons = '';

if( isset( $array ) and !empty( $array ) ) {
    foreach ($array as &$value) {

        $select_seasons.= '<option value="'.get_term_meta( $value->term_id, 'season_number', true ).'">'.get_term_meta( $value->term_id, 'season_number', true ).'</option>';

    }
}else{
    $select_seasons.= '<option value="">'.__('There were no results.', 'tr-grabber').'</option>';
}

echo'
<div class="lgtbx qcklnkbx" id="tr_quick_links_content" style="display:none">
    <div class="lgtbxcn">
        <span class="lgtbclose dashicons dashicons-no-alt" id="quicklinks_close"></span>
        <div class="Title">'.__('Quick Links', 'tr-grabber').'</div>
        <div class="lgtbxbd">
        
            <ul class="lstoplnks c4">
                <li>
                    <p><span class="dashicons dashicons-format-aside"></span>'.__('Season', 'tr-grabber').'</p>
                    <select id="tr_quick_links_season" name="tr_quick_links_season"><option value="">'.__('Select season', 'tr-grabber').'</option>'.$select_seasons.'</select>
                </li>
                <li>
                    <p><span class="dashicons dashicons-admin-site"></span>'.__('Initial episode', 'tr-grabber').'</p>
                    <select id="tr_quick_links_episode" name="tr_quick_links_episode">
                        <option value="">'.__('Select a season', 'tr-grabber').'</option>
                    </select>
                </li>
                <li class="col2sp">
                    <div class="info-bx">Add links quickly. To use this function add the links one below the other. You can also continue in the next episode leaving a blank space.</div>
                </li>
            </ul>

            <ul class="lstoplnks c4">
                <li>
                    <p><span class="dashicons dashicons-format-aside"></span>'.__('Type', 'tr-grabber').'</p>
                    <select name="tr_quick_links_type">
                        <option value="1">'.__('Autodetect', 'tr-grabber').'</option>
                        <option value="1">'.__('Online', 'tr-grabber').'</option>
                        <option value="2">'.__('Download', 'tr-grabber').'</option>
                    </select>
                </li>
                <li>
                    <p><span class="dashicons dashicons-admin-site"></span>'.__('Language', 'tr-grabber').'</p>
                    <select name="tr_quick_links_lang"><option value="">'.__('Select a language', 'tr-grabber').'</option>'.tr_grabber_select_taxonomy('language', '').'</select>
                </li>
                <li>
                    <p><span class="dashicons dashicons-chart-bar"></span>'.__('Quality', 'tr-grabber').'</p>
                    <select name="tr_quick_links_quality"><option value="">'.__('Select a quality', 'tr-grabber').'</option>'.tr_grabber_select_taxonomy('quality', '').'</select>
                </li>
            </ul>

            <p>
                <textarea name="tr_quick_links_links"></textarea>
            </p>

            <button id="tr_quick_links_submit_serie" type="button" class="BtnSnd">'.__('Save Links', 'tr-grabber').'</button>
            
            <p class="tr_grabber_loading" style="display:none"><i class="dashicons dashicons-update"></i>'.__('Loading...', 'tr-grabber').'</p>

        </div>
    </div>
    <span class="lgtblyr"></span>
</div>';
    
}else{
    
echo'
<div class="lgtbx qcklnkbx" id="tr_quick_links_content" style="display:none">
    <div class="lgtbxcn">
        <span class="lgtbclose dashicons dashicons-no-alt" id="quicklinks_close"></span>
        <div class="Title">'.__('Quick Links', 'tr-grabber').' <span class="ttpcn"><i class="infoico dashicons dashicons-info"></i><span>'.__('Add links quickly. To use this function add the links one below the other.', 'tr-grabber').'</span></span></div>
        <div class="lgtbxbd">

            <ul class="lstoplnks c4">
                <li>
                    <p><span class="dashicons dashicons-format-aside"></span>'.__('Type', 'tr-grabber').'</p>
                    <select name="tr_quick_links_type">
                        <option value="1">'.__('Autodetect', 'tr-grabber').'</option>
                        <option value="1">'.__('Online', 'tr-grabber').'</option>
                        <option value="2">'.__('Download', 'tr-grabber').'</option>
                    </select>
                </li>
                <li>
                    <p><span class="dashicons dashicons-admin-site"></span>'.__('Language', 'tr-grabber').'</p>
                    <select name="tr_quick_links_lang">'.tr_grabber_select_taxonomy('language', '').'</select>
                </li>
                <li>
                    <p><span class="dashicons dashicons-chart-bar"></span>'.__('Quality', 'tr-grabber').'</p>
                    <select name="tr_quick_links_quality">'.tr_grabber_select_taxonomy('quality', '').'</select>
                </li>
            </ul>

            <p>
                <textarea name="tr_quick_links_links"></textarea>
            </p>

            <button type="button" class="BtnSnd tr_quick_links_submit_movies">'.__('Save Links', 'tr-grabber').'</button>

        </div>
    </div>
    <span class="lgtblyr"></span>
</div>';

}

}