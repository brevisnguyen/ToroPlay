<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('language_add_form_fields','language_add_form_fields');
add_action('language_edit_form_fields','language_edit_form_fields');

function language_add_form_fields() {
    
    $id = 'icon';
    $title = __('Icon', 'tr-grabber');
    $label_set = __('Set icon', 'tr-grabber');
    $label_use = __('Use as icon', 'tr-grabber');
    $label_remove = __('Remove icon', 'tr-grabber');
    $link_title = $label_set;    
?>

<div class="form-field term-image-wrap">
    <label><?php _e('Icon', 'tr-grabber'); ?></label>
    <div id="image"></div>
    <button style="display:none" type="button" class="button button-link trgrabber-media-tax-delete tr-rmv"><span class="dashicons dashicons-trash"></span> <?php _e('Remove', 'tr-grabber'); ?></button>
	<input class="tr-grabber-media" name="image_hotlink" type="text" value="" placeholder="<?php _e('External url', 'tr-grabber'); ?>">
	<input id="tr-grabber-media-content" name="image" type="hidden" value="">
    <button data-title="<?php echo $title; ?>" data-button="<?php echo $label_use; ?>" data-id="<?php echo $id; ?>" data-postid="0" type="button" class="button button-primary tr-grabber-media-tax"><?php _e('Upload Image', 'tr-grabber'); ?></button>
</div>

<?php
}

function language_edit_form_fields($tag) {
    
    $term_id = $tag->term_id;
    $title = __('Icon', 'tr-grabber');
    $label_use = __('Use as icon', 'tr-grabber');
    $title = __('Icon', 'tr-grabber');
    $image = get_term_meta( $term_id, 'image', true ) == '' ? '' : get_term_meta( $term_id, 'image', true );
    $image_url = get_term_meta( $term_id, 'image', true ) == '' ? '' : '<img src="'.wp_get_attachment_url(get_term_meta( $term_id, 'image', true )).'" alt="'.__('image', 'tr-grabber').'">';
    $image_hotlink = get_term_meta( $term_id, 'image_hotlink', true ) == '' ? '' : get_term_meta( $term_id, 'image_hotlink', true );
    $display = $image == '' ? ' style="display:none"' : '';
    $id = '';

?>

<tr class="form-field term-image-wrap">
    <th scope="row" valign="top">
        <label><?php _e('Icon', 'tr-grabber'); ?></label>  
    </th>
    <td>        
        <div class="term-image-wrap">
            <div id="image"><?php echo $image_url; ?></div>
            <button<?php echo $display; ?> type="button" class="button button-link trgrabber-media-tax-delete tr-rmv"><span class="dashicons dashicons-trash"></span> <?php _e('Remove', 'tr-grabber'); ?></button>
            <input class="tr-grabber-media" name="image_hotlink" type="text" value="<?php echo $image_hotlink; ?>" placeholder="<?php _e('External url', 'tr-grabber'); ?>">
            <input id="tr-grabber-media-content" name="image" type="hidden" value="<?php echo $image; ?>">
            <button data-title="<?php echo $title; ?>" data-button="<?php echo $label_use; ?>" data-id="<?php echo $id; ?>" data-postid="0" type="button" class="button button-primary tr-grabber-media-tax"><?php _e('Upload Image', 'tr-grabber'); ?></button>
        </div>
    </td>  
</tr>

<?php
}

function save_language_custom_meta( $term_id ) {
    
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

add_action( 'edited_language', 'save_language_custom_meta', 10, 2 );  
add_action( 'create_language', 'save_language_custom_meta', 10, 2 );