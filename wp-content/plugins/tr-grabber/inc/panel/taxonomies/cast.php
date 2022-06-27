<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('cast_add_form_fields','cast_add_form_fields');
add_action('cast_edit_form_fields','cast_edit_form_fields');
add_action('cast_tv_add_form_fields','cast_add_form_fields');
add_action('cast_tv_edit_form_fields','cast_edit_form_fields');

function cast_add_form_fields() {
    
    $id = 'photo';
    $title = __('Photo', 'tr-grabber');
    $label_set = __('Set photo', 'tr-grabber');
    $label_use = __('Use as photo', 'tr-grabber');
    $label_remove = __('Remove photo', 'tr-grabber');
    $link_title = $label_set;    
?>

<div class="form-field term-image-wrap">
    <label><?php _e('Photo', 'tr-grabber'); ?></label>
    <div id="image"></div>
	<input class="tr-grabber-media" name="image_hotlink" type="text" value="" placeholder="<?php _e('External url', 'tr-grabber'); ?>">
	<input id="tr-grabber-media-content" name="image" type="hidden" value="">
    <button data-title="<?php echo $title; ?>" data-button="<?php echo $label_use; ?>" data-id="<?php echo $id; ?>" data-postid="0" type="button" class="button button-primary tr-grabber-media-tax"><?php _e('Upload Image', 'tr-grabber'); ?></button>
    <button style="display:none" type="button" class="button button-primary trgrabber-media-tax-delete tr-rmv"><span class="dashicons dashicons-no-alt"></span></button>
</div>

<?php
}

function cast_edit_form_fields($tag) {
    
    $term_id = $tag->term_id;
    $title = __('Photo', 'tr-grabber');
    $label_use = __('Use as photo', 'tr-grabber');
    $title = __('Photo', 'tr-grabber');
    $image = get_term_meta( $term_id, 'image', true ) == '' ? '' : get_term_meta( $term_id, 'image', true );
    $image_url = get_term_meta( $term_id, 'image', true ) == '' ? '' : '<img src="'.wp_get_attachment_url(get_term_meta( $term_id, 'image', true )).'" alt="'.__('image', 'tr-grabber').'">';
    $image_hotlink = get_term_meta( $term_id, 'image_hotlink', true ) == '' ? '' : get_term_meta( $term_id, 'image_hotlink', true );
    $display = $image == '' ? ' style="display:none"' : '';
    $id = '';

?>

<tr class="form-field term-image-wrap">
    <th scope="row" valign="top">
        <label><?php _e('Photo', 'tr-grabber'); ?></label>  
    </th>
    <td>        
        <div class="term-image-wrap">
            <div id="image"><?php echo $image_url; ?></div>
            <input class="tr-grabber-media" name="image_hotlink" type="text" value="<?php echo $image_hotlink; ?>" placeholder="<?php _e('External url', 'tr-grabber'); ?>">
            <input id="tr-grabber-media-content" name="image" type="hidden" value="<?php echo $image; ?>">
            <button data-title="<?php echo $title; ?>" data-button="<?php echo $label_use; ?>" data-id="<?php echo $id; ?>" data-postid="0" type="button" class="button button-primary tr-grabber-media-tax"><?php _e('Upload Image', 'tr-grabber'); ?></button>
            <button<?php echo $display; ?> type="button" class="button button-primary trgrabber-media-tax-delete tr-rmv"><span class="dashicons dashicons-no-alt"></span></button>
        </div>
    </td>  
</tr>

<?php
}

function save_cast_custom_meta( $term_id ) {
    
	if ( isset( $_POST['image_hotlink'] ) ) {
        
        $new_hotlink_value = ( isset( $_POST['image_hotlink'] ) ? ( $_POST['image_hotlink'] ) : '' );
        $meta_hotlink = get_term_meta( $term_id, 'image_hotlink', true ) == '' ? '' : get_term_meta( $term_id, 'image_hotlink', true );
        
        if ( $new_hotlink_value && '' == $meta_hotlink ){
            add_term_meta( $term_id, 'image_hotlink', $new_hotlink_value, true );
        }
        elseif ( $new_hotlink_value && $new_hotlink_value != $meta_hotlink ){
            update_term_meta( $term_id, 'image_hotlink', $new_hotlink_value );
        }
        elseif ( '' == $new_hotlink_value && $meta_hotlink ){
            delete_term_meta( $term_id, 'image_hotlink', $meta_hotlink );
        }
        
	}
    
	if ( isset( $_POST['image'] ) ) {
        
        $new_image_value = ( isset( $_POST['image'] ) ? ( $_POST['image'] ) : '' );
        $meta_image = get_term_meta( $term_id, 'image', true ) == '' ? '' : get_term_meta( $term_id, 'image', true );
        
        if ( $new_image_value && '' == $meta_image ){
            add_term_meta( $term_id, 'image', $new_image_value, true );
        }
        elseif ( $new_image_value && $new_image_value != $meta_image ){
            update_term_meta( $term_id, 'image', $new_image_value );
        }
        elseif ( '' == $new_image_value && $meta_image ){
            delete_term_meta( $term_id, 'image', $meta_image );
        }
        
	}
    
}  

add_action( 'edited_cast', 'save_cast_custom_meta', 10, 2 );  
add_action( 'create_cast', 'save_cast_custom_meta', 10, 2 );
add_action( 'edited_cast_tv', 'save_cast_custom_meta', 10, 2 );  
add_action( 'create_cast_tv', 'save_cast_custom_meta', 10, 2 );