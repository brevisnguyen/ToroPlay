<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('seasons_add_form_fields','seasons_add_form_fields');
add_action('seasons_edit_form_fields','seasons_edit_form_fields');

function seasons_add_form_fields() {
    
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
    <div class="trsrcbx trselectcnt" style="display:none"></div>
    
    <div class="form-required">
        <label><?php _e('ID Serie', 'tr-grabber'); ?></label>
        <input aria-required="true" name="serie_id" type="number" placeholder="<?php _e('Enter the post ID or use the search engine above', 'tr-grabber'); ?>" value="<?php if( isset( $_GET['tr_id_post'] ) ) { echo intval($_GET['tr_id_post']); } ?>">
    </div>
</div>

<div class="form-field term-episode-wrap form-required">    
    <label><?php _e('Season number', 'tr-grabber'); ?></label>
    <input aria-required="true" name="season_number" type="number">
</div>

<div class="form-field term-episode-wrap">    
    <label><?php _e('Air Date', 'tr-grabber'); ?></label>
    <input name="date" type="date">
</div>

<div class="form-field term-subtitle-wrap">
	<label><?php _e('Subtitle', 'tr-grabber'); ?></label>
	<input name="subtitle" type="text" value="">
</div>

<div class="form-field term-episode-wrap">    
    <label><?php _e('Synopsis', 'tr-grabber'); ?></label>
    <?php wp_editor( '', 'content', array( 'textarea_rows' => 5, 'media_buttons' => true ) ); ?>
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

<p class="submit"><button type="button" class="button button-primary tr-grabber-tax-valid-form"><?php _e('Save', 'tr-grabber'); ?></button></p>

<?php
}

function seasons_edit_form_fields($tag) {
    
    $term_id = $tag->term_id;
    $title = __('Poster', 'tr-grabber');
    $label_use = __('Use as poster', 'tr-grabber');
    $title = __('Poster', 'tr-grabber');
    $image = get_term_meta( $term_id, 'poster_path', true ) == '' ? '' : get_term_meta( $term_id, 'poster_path', true );
    $image_url = get_term_meta( $term_id, 'poster_path', true ) == '' ? '' : '<img src="'.wp_get_attachment_image_src(get_term_meta( $term_id, 'poster_path', true ), 'medium')[0].'" alt="'.__('image', 'tr-grabber').'">';
    $image_hotlink = get_term_meta( $term_id, 'poster_path_hotlink', true ) == '' ? '' : get_term_meta( $term_id, 'poster_path_hotlink', true );
    $display = $image == '' ? ' style="display:none"' : '';
    $date = get_term_meta($term_id, 'air_date', true) == '' ? '' : get_term_meta($term_id, 'air_date', true);
    $content = get_term_meta($term_id, 'overview', true) == '' ? '' : get_term_meta($term_id, 'overview', true);
    $name = get_term_meta($term_id, 'name', true) == '' ? '' : get_term_meta($term_id, 'name', true);

?>

<tr class="form-field term-advancedbt-wrap">
    <th scope="row"></th>
    <td>
        <a target="_blank" class="button" href="<?php echo 'post.php?post='.get_term_meta($term_id, 'tr_id_post', true).'&amp;action=edit'; ?>"><?php _e('View Post', 'tr-grabber'); ?></a>
        <button class="grabberadvanced button" type="button"><?php _e('Advanced form', 'tr-grabber'); ?></button>
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

<tr class="form-field term-season-wrap">
    <th scope="row" valign="top">
        <label><?php _e('Air date', 'tr-grabber'); ?></label>  
    </th>
    <td>
        <input name="date" type="date" value="<?php echo $date; ?>">
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

<tr class="form-field term-overview-wrap">
    <th scope="row" valign="top">
        <label><?php _e('Synopsis', 'tr-grabber'); ?></label>  
    </th>
    <td>
        <?php wp_editor( $content, 'overview', array( 'textarea_rows' => 5, 'media_buttons' => true ) ); ?>
    </td>
</tr>

<?php
}

function save_seasons_custom_meta( $term_id ) {
        
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
    
    update_term_meta( $term_id, 'number_of_episodes', 0 );
    
    $slug_seasons = TR_GRABBER_SLUG_SEASONS;
    $name_seasons = TR_GRABBER_TITLE_SEASONS;
    $subtitle_seasons = TR_GRABBER_SUBTITLE_SEASONS;
    
    $vars = array( '{name}', '{season}' );
    $vars_replace = array( get_the_title( get_term_meta( $term_id, 'tr_id_post', true ) ), get_term_meta( $term_id, 'season_number', true ) );
    
    $slug_seasons = str_replace( $vars, $vars_replace, $slug_seasons );
    $name_seasons = str_replace( $vars, $vars_replace, $name_seasons );
    $subtitle_seasons = str_replace( $vars, $vars_replace, $subtitle_seasons );
    
    wp_update_term( $term_id, 'seasons', array(
      'name' => $name_seasons,
      'slug' => $slug_seasons
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
            
    }else{
    
        update_term_meta( $term_id, 'name',  $subtitle_seasons );
        
    }
     
    wp_set_object_terms(get_term_meta( $term_id, 'tr_id_post', true ), $term_id, 'seasons', true);
    
    update_post_meta( get_term_meta( $term_id, 'tr_id_post', true ), TR_GRABBER_FIELD_NSEASONS, tr_grabber_count_seasons( get_term_meta( $term_id, 'tr_id_post', true ) , false) ); // add new season count
    
}

add_action( 'create_seasons', 'save_seasons_custom_meta', 10, 2 );

function save_seasonsedit_custom_meta( $term_id ) {
        
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
        
        $new_name_value = ( isset( $_POST['subtitle'] ) ? ( $_POST['subtitle'] ) : '' );
        $meta_name = get_term_meta( $term_id, 'name', true ) == '' ? '' : get_term_meta( $term_id, 'name', true );
        
        if ( $new_name_value && '' == $meta_name ){
            add_term_meta( $term_id, 'name', $new_name_value, true );
        }
        elseif ( $new_name_value && $new_name_value != $meta_name ){
            update_term_meta( $term_id, 'name', $new_name_value );
        }
        elseif ( '' == $new_name_value && $meta_name ){
            delete_term_meta( $term_id, 'name', $meta_name );
        }
        
	}
    
}

add_action( 'edited_seasons', 'save_seasonsedit_custom_meta', 10, 2 );

function delete_seasons_grabber( $term_id, $taxonomy ) {
        
    if( $taxonomy == 'seasons' ) {
        update_post_meta( get_term_meta( $term_id, 'tr_id_post', true ), TR_GRABBER_FIELD_NSEASONS, tr_grabber_count_seasons( get_term_meta( $term_id, 'tr_id_post', true ) , false, true) );
    }

}

add_action( 'pre_delete_term', 'delete_seasons_grabber', 10, 2 );