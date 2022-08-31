<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('episodes_add_form_fields','episodes_add_form_fields');
add_action('episodes_edit_form_fields','episodes_edit_form_fields');

function episodes_add_form_fields() {
    
    $id = 'poster';
    $title = __('Poster', 'tr-grabber');
    $label_set = __('Set poster', 'tr-grabber');
    $label_use = __('Use as poster', 'tr-grabber');
    $label_remove = __('Remove poster', 'tr-grabber');
    $link_title = $label_set;
    
?>

<div class="form-field term-episode-wrap">
	<label><?php _e('Search serie', 'tr-grabber'); ?></label>
    <div class="tr-grabber-suggest-content">
        <input class="trselect_search_inp" type="text" value="<?php if( isset($_GET['tr_id_post']) ){ echo get_the_title( intval($_GET['tr_id_post']) ); } ?>">
        <span class="dashicons dashicons-search"></span>
    </div>
    <div class="trsrcbx trselectcnt trselectseasons" style="display:none"></div>
    
    <div class="form-required">
        <label><?php _e('ID Serie', 'tr-grabber'); ?></label>
        <input id="serie_id_grabber" aria-required="true" name="serie_id" type="number" placeholder="<?php _e('Enter the post ID or use the search engine above', 'tr-grabber'); ?>" value="<?php if( isset( $_GET['tr_id_post'] ) ) { echo intval($_GET['tr_id_post']); } ?>">
    </div>
</div>

<div class="form-field form-required term-season-wrap">
	<label><?php _e('Season number', 'tr-grabber'); ?></label>
	<select name="season_number">
        <option value=""><?php _e('Select serie', 'tr-grabber'); ?></option>
    </select>
</div>

<div class="form-field form-required term-episode-wrap">
	<label><?php _e('Episode number', 'tr-grabber'); ?></label>
	<input aria-required="true" name="episode" type="number" value="">
</div>

<div class="form-field term-subtitle-wrap">
	<label><?php _e('Subtitle', 'tr-grabber'); ?></label>
	<input name="subtitle" type="text" value="">
</div>

<div class="form-field term-overview-wrap">
	<label><?php echo _e('Synopsis', 'tr-grabber'); ?></label>
    <?php wp_editor( '', 'content', array( 'textarea_rows' => 5, 'media_buttons' => true ) ); ?>
</div>

<div class="form-field term-date-wrap">
	<label><?php _e('Air Date', 'tr-grabber'); ?></label>
	<input name="date" type="date" value="">
</div>

<div class="form-field term-gueststars-wrap">
	<label><?php _e('Guest stars', 'tr-grabber'); ?></label>
	<input name="guest_stars" type="text" value="">
</div>

<div class="form-field term-image-wrap">
    <label><?php _e('Poster', 'tr-grabber'); ?></label>
    <div id="image"></div>
	<input class="tr-grabber-media" name="image_hotlink" type="text" value="" placeholder="<?php _e('External url', 'tr-grabber'); ?>">
	<input id="tr-grabber-media-content" name="image" type="hidden" value="">
    <button data-title="<?php echo $title; ?>" data-button="<?php echo $label_use; ?>" data-id="<?php echo $id; ?>" data-postid="0" type="button" class="button button-primary tr-grabber-media-tax"><?php _e('Upload Image', 'tr-grabber'); ?></button>
    <button style="display:none" type="button" class="button button-primary trgrabber-media-tax-delete tr-rmv"><span class="dashicons dashicons-no-alt"></span></button>
</div>

<textarea style="display:none" id="overview" name="overview"></textarea>

<input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'trgrabberlive' ); ?>">
<input type="hidden" name="type" value="2" class="tr-grabber-type">
<input type="hidden" name="grabber-type" value="episode">

<p class="submit"><button type="button" class="button button-primary tr-grabber-tax-valid-form-episode"><?php _e('Save', 'tr-grabber'); ?></button></p>

<?php
}

function episodes_edit_form_fields($tag) {
    
    $term_id = $tag->term_id;
    $title = __('Poster', 'tr-grabber');
    $label_use = __('Use as poster', 'tr-grabber');
    $title = __('Poster', 'tr-grabber');
    $image = get_term_meta( $term_id, 'poster_path', true ) == '' ? '' : get_term_meta( $term_id, 'still_path', true );
    $image_url = get_term_meta( $term_id, 'still_path', true ) == '' ? '' : '<img src="'.wp_get_attachment_image_src(get_term_meta( $term_id, 'still_path', true ), 'medium')[0].'" alt="'.__('image', 'tr-grabber').'">';
    $subtitles_url = get_term_meta( $term_id, 'subtitles_url', true ) == '' ? '' : get_term_meta( $term_id, 'subtitles_url', true );
    $image_hotlink = get_term_meta( $term_id, 'still_path_hotlink', true ) == '' ? '' : get_term_meta( $term_id, 'still_path_hotlink', true );
    $display = $image == '' ? ' style="display:none"' : '';
    $name = get_term_meta($term_id, 'name', true) == '' ? '' : get_term_meta($term_id, 'name', true);
    $content = get_term_meta($term_id, 'overview', true) == '' ? '' : get_term_meta($term_id, 'overview', true);
    $date = get_term_meta($term_id, 'air_date', true) == '' ? '' : get_term_meta($term_id, 'air_date', true);
    $guest = get_term_meta($term_id, 'guest_stars', true) == '' ? '' : get_term_meta($term_id, 'guest_stars', true);
?>

<tr class="form-field term-advancedbt-wrap">
    <th scope="row"></th>
    <td>
        <a target="_blank" class="button" href="<?php echo 'post.php?post='.get_term_meta($term_id, 'tr_id_post', true).'&amp;action=edit'; ?>"><?php _e('View Post', 'tr-grabber'); ?></a>
        <button class="grabberadvanced button" type="button"><?php _e('Advanced form', 'tr-grabber'); ?></button>
    </td>
</tr>

<tr class="form-field">  
    <th scope="row" valign="top">
        <label><?php _e('Subtitle', 'tr-grabber'); ?></label>  
    </th>  
    <td>  
        <input type="text" name="subtitle" value="<?php echo $name; ?>">
    </td>  
</tr>

<tr class="form-field">  
    <th scope="row" valign="top">
        <label><?php _e('Air Date', 'tr-grabber'); ?></label>  
    </th>  
    <td>  
        <input type="date" name="date" value="<?php echo $date; ?>">
    </td>  
</tr>

<tr class="form-field">  
    <th scope="row" valign="top">
        <label><?php _e('Guest stars', 'tr-grabber'); ?></label>  
    </th>  
    <td>  
        <input type="text" name="guest_stars" value="<?php echo $guest; ?>">
    </td>  
</tr>

<tr class="form-field term-overview-wrap">
    <th scope="row" valign="top">
        <label><?php _e('Synopsis', 'tr-grabber'); ?></label>  
    </th>
    <td>
        <?php wp_editor( $content, 'overview', array( 'textarea_rows' => 5, 'media_buttons' => true ) ); ?>
    </td>
</tr>

<tr class="form-field term-image-wrap">
    <th scope="row" valign="top">
        <label><?php _e('Poster', 'tr-grabber'); ?></label>  
    </th>
    <td>        
        <div class="term-image-wrap">
            <div id="image"><?php echo $image_url; ?></div>
            <input class="tr-grabber-media" name="image_hotlink" type="text" value="<?php echo $image_hotlink; ?>" placeholder="<?php _e('External url', 'tr-grabber'); ?>">
            <input id="tr-grabber-media-content" name="image" type="hidden" value="<?php echo $image; ?>">
            <button data-title="<?php echo $title; ?>" data-button="<?php echo $label_use; ?>" data-id="<?php echo $term_id; ?>" data-postid="0" type="button" class="button button-primary tr-grabber-media-tax"><?php _e('Upload Image', 'tr-grabber'); ?></button>
            <button<?php echo $display; ?> type="button" class="button button-primary trgrabber-media-tax-delete tr-rmv"><span class="dashicons dashicons-no-alt"></span></button>
        </div>
    </td>
</tr>

<tr class="form-field term-image-wrap">
    <th scope="row" valign="top">
        <label><?php _e('Subtitles', 'tr-grabber'); ?></label>  
    </th>
    <td>        
        <div class="term-image-wrap">
            <div><?php echo $subtitles_url; ?></div>
            <input class="tr-grabber-media" name="subtitles_url" type="text" value="<?php echo $subtitles_url; ?>" placeholder="<?php _e('Subtitles url', 'tr-grabber'); ?>">
        </div>
    </td>
</tr>

<?php
}

function save_episodes_custom_meta( $term_id ) {

	if ( isset( $_POST['image_hotlink'] ) ) {
        
        $new_hotlink_value = ( isset( $_POST['image_hotlink'] ) ? ( $_POST['image_hotlink'] ) : '' );
        $meta_hotlink = get_term_meta( $term_id, 'poster_path_hotlink', true ) == '' ? '' : get_term_meta( $term_id, 'poster_path_hotlink', true );
        
        if ( $new_hotlink_value && '' == $meta_hotlink ){
            add_term_meta( $term_id, 'poster_path_hotlink', $new_hotlink_value, true );
        }
        elseif ( $new_hotlink_value && $new_hotlink_value != $meta_hotlink ){
            update_term_meta( $term_id, 'poster_path_hotlink', $new_hotlink_value );
        }
        elseif ( '' == $new_hotlink_value && $meta_hotlink ){
            delete_term_meta( $term_id, 'poster_path_hotlink', $meta_hotlink );
        }
        
	}
    
	if ( isset( $_POST['image'] ) ) {
        
        $new_image_value = ( isset( $_POST['image'] ) ? ( $_POST['image'] ) : '' );
        $meta_image = get_term_meta( $term_id, 'poster_path', true ) == '' ? '' : get_term_meta( $term_id, 'poster_path', true );
        
        if ( $new_image_value && '' == $meta_image ){
            add_term_meta( $term_id, 'poster_path', $new_image_value, true );
        }
        elseif ( $new_image_value && $new_image_value != $meta_image ){
            update_term_meta( $term_id, 'poster_path', $new_image_value );
        }
        elseif ( '' == $new_image_value && $meta_image ){
            delete_term_meta( $term_id, 'poster_path', $meta_image );
        }
        
	}
    
	if ( isset( $_POST['serie_id'] ) ) {
        
        $new_serieid_value = ( isset( $_POST['serie_id'] ) ? ( $_POST['serie_id'] ) : '' );
        $meta_serieid = get_term_meta( $term_id, 'tr_id_post', true ) == '' ? '' : get_term_meta( $term_id, 'tr_id_post', true );
        
        if ( $new_serieid_value && '' == $meta_serieid ){
            add_term_meta( $term_id, 'tr_id_post', $new_serieid_value, true );
        }
        elseif ( $new_serieid_value && $new_serieid_value != $meta_serieid ){
            update_term_meta( $term_id, 'tr_id_post', $new_serieid_value );
        }
        elseif ( '' == $new_serieid_value && $meta_serieid ){
            delete_term_meta( $term_id, 'tr_id_post', $meta_serieid );
        }
        
	}
    
	if ( isset( $_POST['season_number'] ) ) {
        
        $new_seasonn_value = ( isset( $_POST['season_number'] ) ? ( $_POST['season_number'] ) : '' );
        $meta_seasonn = get_term_meta( $term_id, 'season_number', true ) == '' ? '' : get_term_meta( $term_id, 'season_number', true );
        
        if ( $new_seasonn_value && '' == $meta_seasonn ){
            add_term_meta( $term_id, 'season_number', $new_seasonn_value, true );
        }
        elseif ( $new_seasonn_value && $new_seasonn_value != $meta_seasonn ){
            update_term_meta( $term_id, 'season_number', $new_seasonn_value );
        }
        elseif ( '' == $new_seasonn_value && $meta_seasonn ){
            delete_term_meta( $term_id, 'season_number', $meta_seasonn );
        }
        
	}
    
	if ( isset( $_POST['episode'] ) ) {
        
        $new_episodee_value = ( isset( $_POST['episode'] ) ? ( $_POST['episode'] ) : '' );
        $meta_episodee = get_term_meta( $term_id, 'episode_number', true ) == '' ? '' : get_term_meta( $term_id, 'episode_number', true );
        
        if ( $new_episodee_value && '' == $meta_episodee ){
            add_term_meta( $term_id, 'episode_number', $new_episodee_value, true );
        }
        elseif ( $new_episodee_value && $new_episodee_value != $meta_episodee ){
            update_term_meta( $term_id, 'episode_number', $new_episodee_value );
        }
        elseif ( '' == $new_episodee_value && $meta_episodee ){
            delete_term_meta( $term_id, 'episode_number', $meta_episodee );
        }
        
	}
    
	if ( isset( $_POST['date'] ) ) {
        
        $new_airdate_value = ( isset( $_POST['date'] ) ? ( $_POST['date'] ) : '' );
        $meta_airdate = get_term_meta( $term_id, 'air_date', true ) == '' ? '' : get_term_meta( $term_id, 'air_date', true );
        
        if ( $new_airdate_value && '' == $meta_airdate ){
            add_term_meta( $term_id, 'air_date', $new_airdate_value, true );
        }
        elseif ( $new_airdate_value && $new_airdate_value != $meta_airdate ){
            update_term_meta( $term_id, 'air_date', $new_airdate_value );
        }
        elseif ( '' == $new_airdate_value && $meta_airdate ){
            delete_term_meta( $term_id, 'air_date', $meta_airdate );
        }
        
	}
    
	if ( isset( $_POST['overview'] ) ) {
        
        $new_overview_value = ( isset( $_POST['overview'] ) ? ( $_POST['overview'] ) : '' );
        $meta_overview = get_term_meta( $term_id, 'overview', true ) == '' ? '' : get_term_meta( $term_id, 'overview', true );
        
        if ( $new_overview_value && '' == $meta_overview ){
            add_term_meta( $term_id, 'overview', $new_overview_value, true );
        }
        elseif ( $new_overview_value && $new_overview_value != $meta_overview ){
            update_term_meta( $term_id, 'overview', $new_overview_value );
        }
        elseif ( '' == $new_overview_value && $meta_overview ){
            delete_term_meta( $term_id, 'overview', $meta_overview );
        }
        
	}
    
	if ( isset( $_POST['guest_stars'] ) ) {
        
        $new_guest_value = ( isset( $_POST['guest_stars'] ) ? ( $_POST['guest_stars'] ) : '' );
        $meta_guest = get_term_meta( $term_id, 'guest_stars', true ) == '' ? '' : get_term_meta( $term_id, 'guest_stars', true );
        
        if ( $new_guest_value && '' == $meta_guest ){
            add_term_meta( $term_id, 'guest_stars', $new_guest_value, true );
        }
        elseif ( $new_guest_value && $new_guest_value != $meta_guest ){
            update_term_meta( $term_id, 'guest_stars', $new_guest_value );
        }
        elseif ( '' == $new_guest_value && $meta_guest ){
            delete_term_meta( $term_id, 'guest_stars', $meta_guest );
        }
        
	}
    
    $slug_episodes = TR_GRABBER_SLUG_EPISODES;
    $name_episodes = TR_GRABBER_TITLE_EPISODES;
    $subtitle_episodes = TR_GRABBER_SUBTITLE_EPISODES;
    
    $vars = array( '{name}', '{season}', '{episode}' );
    $vars_replace = array( get_the_title( get_term_meta( $term_id, 'tr_id_post', true ) ), get_term_meta( $term_id, 'season_number', true ), get_term_meta( $term_id, 'episode_number', true ) );
        
    $slug_episodes = str_replace( $vars, $vars_replace, $slug_episodes );
    $name_episodes = str_replace( $vars, $vars_replace, $name_episodes );
    $subtitle_episodes = str_replace( $vars, $vars_replace, $subtitle_episodes );
    
    wp_update_term( $term_id, 'episodes', array(
      'name' => $name_episodes,
      'slug' => $slug_episodes
    ));
    
    if( isset( $_POST['subtitle'] ) ) {
        
        $new_subtitle_value = ( isset( $_POST['subtitle'] ) ? ( $_POST['subtitle'] ) : '' );
        $meta_subtitle = get_term_meta( $term_id, 'name', true ) == '' ? '' : get_term_meta( $term_id, 'name', true );
        
        if ( $new_subtitle_value && '' == $meta_subtitle ){
            add_term_meta( $term_id, 'name', $new_subtitle_value, true );
        }
        elseif ( $new_subtitle_value && $new_subtitle_value != $meta_subtitle ){
            update_term_meta( $term_id, 'name', $new_subtitle_value );
        }
        elseif ( '' == $new_subtitle_value && $meta_subtitle ){
            delete_term_meta( $term_id, 'name', $meta_subtitle );
        }
            
    }
    
    wp_set_object_terms(get_term_meta( $term_id, 'tr_id_post', true ), $term_id, 'episodes', true);
    
    update_post_meta( get_term_meta( $term_id, 'tr_id_post', true ), TR_GRABBER_FIELD_NEPISODES, tr_grabber_count_episodes( get_term_meta( $term_id, 'tr_id_post', true ) , NULL, false) ); // add new episode count
    
    $id_post = get_term_meta( $term_id, 'tr_id_post', true );
    $season_number = get_term_meta( $term_id, 'season_number', true );
        
    $term_id_season = tr_grabber_list_seasons($id_post, $season_number);

    update_term_meta( $term_id_season[0]->term_id, 'number_of_episodes', tr_grabber_count_episodes( $id_post, $season_number, false ) );
    
}

add_action( 'create_episodes', 'save_episodes_custom_meta', 10, 2 );

function save_episodesedit_custom_meta( $term_id ) {

    if ( isset( $_POST['subtitles_url'] ) ) {

        $new_subtitles_value = ( isset( $_POST['subtitles_url'] ) ? ( $_POST['subtitles_url'] ) : '' );
        $meta_subtitles = get_term_meta( $term_id, 'subtitles_url', true ) == '' ? '' : get_term_meta( $term_id, 'subtitles_url', true );

        if ( $new_subtitles_value && '' == $meta_subtitles ){
            add_term_meta( $term_id, 'subtitles_url', $new_subtitles_value, true );
        }
        elseif ( $new_subtitles_value && $new_subtitles_value != $meta_subtitles ){
            update_term_meta( $term_id, 'subtitles_url', $new_subtitles_value );
        }
        elseif ( '' == $new_subtitles_value && $meta_subtitles ){
            delete_term_meta( $term_id, 'subtitles_url', $meta_subtitles );
        }
    }
    
	if ( isset( $_POST['image_hotlink'] ) ) {
        
        $new_hotlink_value = ( isset( $_POST['image_hotlink'] ) ? ( $_POST['image_hotlink'] ) : '' );
        $meta_hotlink = get_term_meta( $term_id, 'still_path_hotlink', true ) == '' ? '' : get_term_meta( $term_id, 'still_path_hotlink', true );
        
        if ( $new_hotlink_value && '' == $meta_hotlink ){
            add_term_meta( $term_id, 'still_path_hotlink', $new_hotlink_value, true );
        }
        elseif ( $new_hotlink_value && $new_hotlink_value != $meta_hotlink ){
            update_term_meta( $term_id, 'still_path_hotlink', $new_hotlink_value );
        }
        elseif ( '' == $new_hotlink_value && $meta_hotlink ){
            delete_term_meta( $term_id, 'still_path_hotlink', $meta_hotlink );
        }
        
	}
    
	if ( isset( $_POST['image'] ) ) {
        
        $new_image_value = ( isset( $_POST['image'] ) ? ( $_POST['image'] ) : '' );
        $meta_image = get_term_meta( $term_id, 'still_path', true ) == '' ? '' : get_term_meta( $term_id, 'still_path', true );
        
        if ( $new_image_value && '' == $meta_image ){
            add_term_meta( $term_id, 'still_path', $new_image_value, true );
        }
        elseif ( $new_image_value && $new_image_value != $meta_image ){
            update_term_meta( $term_id, 'still_path', $new_image_value );
        }
        elseif ( '' == $new_image_value && $meta_image ){
            delete_term_meta( $term_id, 'still_path', $meta_image );
        }
        
	}
    
    
	if ( isset( $_POST['date'] ) ) {
        
        $new_airdate_value = ( isset( $_POST['date'] ) ? ( $_POST['date'] ) : '' );
        $meta_airdate = get_term_meta( $term_id, 'air_date', true ) == '' ? '' : get_term_meta( $term_id, 'air_date', true );
        
        if ( $new_airdate_value && '' == $meta_airdate ){
            add_term_meta( $term_id, 'air_date', $new_airdate_value, true );
        }
        elseif ( $new_airdate_value && $new_airdate_value != $meta_airdate ){
            update_term_meta( $term_id, 'air_date', $new_airdate_value );
        }
        elseif ( '' == $new_airdate_value && $meta_airdate ){
            delete_term_meta( $term_id, 'air_date', $meta_airdate );
        }
        
	}
    
	if ( isset( $_POST['overview'] ) ) {
        
        $new_overview_value = ( isset( $_POST['overview'] ) ? ( $_POST['overview'] ) : '' );
        $meta_overview = get_term_meta( $term_id, 'overview', true ) == '' ? '' : get_term_meta( $term_id, 'overview', true );
        
        if ( $new_overview_value && '' == $meta_overview ){
            add_term_meta( $term_id, 'overview', $new_overview_value, true );
        }
        elseif ( $new_overview_value && $new_overview_value != $meta_overview ){
            update_term_meta( $term_id, 'overview', $new_overview_value );
        }
        elseif ( '' == $new_overview_value && $meta_overview ){
            delete_term_meta( $term_id, 'overview', $meta_overview );
        }
        
	}
    
	if ( isset( $_POST['subtitle'] ) ) {

        $new_subtitle_value = ( isset( $_POST['subtitle'] ) ? ( $_POST['subtitle'] ) : '' );
        $meta_subtitle = get_term_meta( $term_id, 'name', true ) == '' ? '' : get_term_meta( $term_id, 'name', true );
        
        if ( $new_subtitle_value && '' == $meta_subtitle ){
            add_term_meta( $term_id, 'name', $new_subtitle_value, true );
        }
        elseif ( $new_subtitle_value && $new_subtitle_value != $meta_subtitle ){
            update_term_meta( $term_id, 'name', $new_subtitle_value );
        }
        elseif ( '' == $new_subtitle_value && $meta_subtitle ){
            delete_term_meta( $term_id, 'name', $meta_subtitle );
        }

	}
    
	if ( isset( $_POST['guest_stars'] ) ) {
        
        $new_guest_value = ( isset( $_POST['guest_stars'] ) ? ( $_POST['guest_stars'] ) : '' );
        $meta_guest = get_term_meta( $term_id, 'guest_stars', true ) == '' ? '' : get_term_meta( $term_id, 'guest_stars', true );
        
        if ( $new_guest_value && '' == $meta_guest ){
            add_term_meta( $term_id, 'guest_stars', $new_guest_value, true );
        }
        elseif ( $new_guest_value && $new_guest_value != $meta_guest ){
            update_term_meta( $term_id, 'guest_stars', $new_guest_value );
        }
        elseif ( '' == $new_guest_value && $meta_guest ){
            delete_term_meta( $term_id, 'guest_stars', $meta_guest );
        }
        
	}

}

add_action( 'edited_episodes', 'save_episodesedit_custom_meta', 10, 2 );

function delete_episodes_grabber( $term_id, $taxonomy ) {
        
    if( $taxonomy == 'episodes' ) {
        
        update_post_meta( get_term_meta( $term_id, 'tr_id_post', true ), TR_GRABBER_FIELD_NEPISODES, tr_grabber_count_episodes( get_term_meta( $term_id, 'tr_id_post', true ) , NULL, false, true) ); // add new episode count
        
        $term_id_season = tr_grabber_list_seasons(get_term_meta( $term_id, 'tr_id_post', true ), get_term_meta( $term_id, 'season_number', true ));

        if( isset( $term_id_season[0]->term_id ) ) {
            update_term_meta( $term_id_season[0]->term_id, 'number_of_episodes', tr_grabber_count_episodes( get_term_meta( $term_id, 'tr_id_post', true ), get_term_meta( $term_id, 'season_number', true ), false, true ) );
        }
        
    }

}

add_action( 'pre_delete_term', 'delete_episodes_grabber', 10, 2 );