<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tr_grabber_init() {

    /* Only users with the "publish_posts" capability can use this feature */
    if ( current_user_can( 'publish_posts' ) ) {

        /* Remove the filters which disallow HTML in term descriptions */
        remove_filter( 'pre_term_description', 'wp_filter_kses' );
        remove_filter( 'term_description', 'wp_kses_data' );

        /* Add filters to disallow unsafe HTML tags */
        if ( ! current_user_can( 'unfiltered_html' ) ) {
            add_filter( 'pre_term_description', 'wp_kses_post' );
            add_filter( 'term_description', 'wp_kses_post' );
        }
    }

    /* Apply `the_content` filters to term description */
    if ( isset( $GLOBALS['wp_embed'] ) ) {
        add_filter( 'term_description', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
        add_filter( 'term_description', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
    }

    add_filter( 'term_description', 'wptexturize' );
    add_filter( 'term_description', 'convert_smilies' );
    add_filter( 'term_description', 'convert_chars' );
    add_filter( 'term_description', 'wpautop' );

    if ( ! is_admin() ) {
        add_filter( 'term_description', 'shortcode_unautop' );
        add_filter( 'term_description', 'do_shortcode', 11 );
    }

    add_action( 'category_edit_form_fields', 'tr_grabber_init', 1, 2 );
    add_action( 'category_add_form_fields', 'tr_grabber_init', 1, 1 );
}
    
add_action( 'admin_init', 'tr_grabber_init' );

add_filter('edit_category_form_fields', 'trgrabber_catdescription');
function trgrabber_catdescription($tag) {
?>        
<table class="form-table">
            
<tr class="form-field">
                
    <th scope="row" valign="top">
        <label for="description">
        <?php _ex('Description', 'Taxonomy Description'); ?>
        </label>
    </th>

    <td>
        <?php
            $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );
            wp_editor(htmlspecialchars_decode($tag->description), 'cat_description', $settings);
        ?>
        <br/>
        <span class="description">
        <?php _e('The description is not prominent by default; however, some themes may show it.'); ?>
        </span>
    </td>
        
</tr>
 
</table>
    <?php
}

add_action('admin_head', 'remove_default_category_description');
function remove_default_category_description() {
    global $current_screen;
    if ( $current_screen->id == 'edit-category' ) {
    ?>  
    <script type="text/javascript">
        jQuery(function($) {
            $('textarea#description').closest('tr.form-field').remove();
        });
    </script>
    <?php
    }
}