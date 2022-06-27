<?php
/**
 * Toroplay widgets
 * @package Toroplay
 */
if ( class_exists('WP_Widget') ) {  
    
    require get_template_directory().'/inc/widgets/widget-trposts.php';
    require get_template_directory().'/inc/widgets/widget-trfilter.php';
    require get_template_directory().'/inc/widgets/widget-ads.php';
    require get_template_directory().'/inc/widgets/widget-abc.php';
    
    if ( !function_exists('toroplay_theme_register_widgets') ) {
        function toroplay_theme_register_widgets() {
            register_widget('WP_Widget_Trposts');
            register_widget('WP_Widget_Tr_Search');
            register_widget('WP_Widget_Tr_Ads');
            register_widget('WP_Widget_Tr_Abc');
        }
    }

    add_action('widgets_init', 'toroplay_theme_register_widgets'); 

}
?>