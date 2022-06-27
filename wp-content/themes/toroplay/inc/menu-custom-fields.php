<?php
/**
 * Proof of concept for how to add new fields to nav_menu_item posts in the WordPress menu editor.
 * @author Weston Ruter (@westonruter), X-Team
 */
add_action( 'init', array( 'tr_Nav_Menu_Item_Custom_Fields', 'setup' ) );
class tr_Nav_Menu_Item_Custom_Fields {
	static $options = array(
		'item_tpl' => '
			<p class="additional-menu-field-{name} tr-menu-opts">
				<label for="edit-menu-item-{name}-{id}">
					<span>{label}</span>
					<input {input_checked}
						type="{input_type}"
						id="edit-menu-item-{name}-{id}"
						class="widefat code edit-menu-item-{name}"
						name="menu-item-{name}[{id}]"
						value="{value}">
				</label>
			</p>
		',
	);
	static function setup() {
		if ( !is_admin() )
			return;
		$new_fields = apply_filters( 'tr_nav_menu_item_additional_fields', array() );
		if ( empty($new_fields) )
			return;
		self::$options['fields'] = self::get_fields_schema( $new_fields );
		add_filter( 'wp_edit_nav_menu_walker', function () {
			return 'tr_Walker_Nav_Menu_Edit';
		});
		//add_filter( 'tr_nav_menu_item_additional_fields', array( __CLASS__, '_add_fields' ), 10, 5 );
		add_action( 'save_post', array( __CLASS__, '_save_post' ), 10, 2 );
	}
	static function get_fields_schema( $new_fields ) {
		$schema = array();
		foreach( $new_fields as $name => $field) {
			if (empty($field['name'])) {
				$field['name'] = $name;
			}
			$schema[] = $field;
		}
		return $schema;
	}
	static function get_menu_item_postmeta_key($name) {
		return '_menu_item_' . $name;
	}
	/**
	 * Inject the 
	 * @hook {action} save_post
	 */
	static function get_field( $item, $depth, $args ) {
		$new_fields = '';
		foreach( self::$options['fields'] as $field ) {
            if($field['name']=='trsubmenu'){
                $field['value'] = 1;
            }else{
                $field['value'] = get_post_meta($item->ID, self::get_menu_item_postmeta_key($field['name']), true);
            }
            
			$field['id'] = $item->ID;
			$new_fields .= str_replace('{input_checked}', checked( get_post_meta($item->ID, self::get_menu_item_postmeta_key($field['name']), true), 1, false ), str_replace(
				array_map(function($key){ return '{' . $key . '}'; }, array_keys($field)),
				array_values(array_map('esc_attr', $field)),
				self::$options['item_tpl']
			));
		}
		return $new_fields;
	}
	/**
	 * Save the newly submitted fields
	 * @hook {action} save_post
	 */
	static function _save_post($post_id, $post) {
		if ( $post->post_type !== 'nav_menu_item' ) {
			return $post_id; // prevent weird things from happening
		}
		foreach( self::$options['fields'] as $field_schema ) {
			$form_field_name = 'menu-item-' . $field_schema['name'];
			// @todo FALSE should always be used as the default $value, otherwise we wouldn't be able to clear checkboxes
            $_POST['menu-item-trsubmenu'][$post_id] = !isset($_POST['menu-item-trsubmenu'][$post_id]) ? 2 : $_POST['menu-item-trsubmenu'][$post_id];
			if (isset($_POST[$form_field_name][$post_id])) {
				$key = self::get_menu_item_postmeta_key($field_schema['name']);
				$value = stripslashes($_POST[$form_field_name][$post_id]);
				update_post_meta($post_id, $key, $value);
			}
		}
	}
}
// @todo This class needs to be in it's own file so we can include id J.I.T.
// requiring the nav-menu.php file on every page load is not so wise
require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
class tr_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_output = '';
		parent::start_el($item_output, $item, $depth, $args);
		// Inject $new_fields before: <div class="menu-item-actions description-wide submitbox">
		if ( $new_fields = tr_Nav_Menu_Item_Custom_Fields::get_field( $item, $depth, $args ) ) {
			$item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
		}
		$output .= $item_output;
	}
}
// Somewhere in config...
add_filter( 'tr_nav_menu_item_additional_fields', 'tr_menu_item_additional_fields' );
function tr_menu_item_additional_fields( $fields ) {
	$fields['tricon'] = array(
		'name' => 'tricon',
		'label' => __('Icon', 'toroplay'),
		'container_class' => 'tr-icon',
		'input_type' => 'text',
	);
    
	$fields['trsubmenu'] = array(
		'name' => 'trsubmenu',
		'label' => __('Submenu on columns: ', 'toroplay'),
		'container_class' => 'tr-submenu',
		'input_type' => 'checkbox',
        'value' => 1
	);
	
	return $fields;
}

add_filter( 'nav_menu_css_class', 'tr_nav_class', 10, 3 );
function tr_nav_class( $classes, $item, $args ) {

    if(get_post_meta($item->ID, '_menu_item_tricon', true)!=''){
        $classes[] = get_post_meta($item->ID, '_menu_item_tricon', true);
    }
    
    if(get_post_meta($item->ID, '_menu_item_trsubmenu', true)==1){
        $classes[] = 'menu-category';
    }else{
        $classes[] = 'menu-category-list';
    }

    return $classes;
}