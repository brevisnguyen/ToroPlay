<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<?php if( function_exists('tr_homecontrol') ) { ?>
<div class="tr-config-tab" id="tr-config-tab-4" style="display:none">
    <p><?php _e('Re-order the homepage components', 'tr-grabber'); ?></p>

    <div class="tr-grabber-cols">
        <ul class="tr-homecontrol" id="tr-homecontrol">
            <?php
            $settings = array('wpautop' => true, 'media_buttons' => false, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'config[texthome]' );
            foreach ( tr_homecontrol() as $key => $value ) {
                $explode = explode( '|', $value );
                $class = $explode[2] == 1 ? ' checked dashicons dashicons-yes' : ' unchecked';
                $button = $explode[0] == 'Text' ? '<button type="button" class="button trhomecontrol_widgetext"><span class="dashicons dashicons-edit"></span></button>' : '';
                echo'<li class="tr-homecontrol-row" id="homecontrol-moved">'.$button.'<span class="dashicons dashicons-sort"></span><i class="trgrabberselect'.$class.'"></i><input type="hidden" name="config[homecontrol][]" value="'.$value.'">'.$explode[0].'</li>';
            }
            ?>
        </ul>

        <div style="display:none" class="tr-grabber-addtext" id="tr-grabber-addtext">
            <p class="title"><?php _e('Text for widget', 'tr-grabber'); ?></p>
            <?php wp_editor(stripslashes(htmlspecialchars_decode($config['texthome'])), 'texthome', $settings); ?>
        </div>
    </div>

</div>
<?php } ?>