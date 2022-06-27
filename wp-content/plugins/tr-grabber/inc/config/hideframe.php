<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="tr-config-tab" id="tr-config-tab-5" style="display:none">
    
    <div class="tbl-cn tr-config-tab-ul">
        <table class="tr_grabber_content form-table">
            <tbody>
                
                <tr>
                    <th><?php _e('Hide iframes', 'tr-grabber'); ?></th>
                    <td>
                        <label><input id="grabber-hideframes" <?php checked( 1, $config['hideframes'] ); ?> type="checkbox" name="config[hideframes]" value="1"> <?php _e('Enable', 'tr-grabber'); ?></label>
                    </td>
                </tr>
                
                <tr>
                    <th><?php _e('Servers', 'tr-grabber'); ?></th>
                    <td>
                        <ul class="tr-servers-list">    
                            <li>
                                <label><input id="grabber-hideframes" <?php checked( 1, $config['hideopenload'] ); ?> type="checkbox" name="config[hideopenload]" value="1"> <?php _e('Openload', 'tr-grabber'); ?></label>
                            </li>
                            <li>
                                <label><input id="grabber-hideframes" <?php checked( 1, $config['hidestreamango'] ); ?> type="checkbox" name="config[hidestreamango]" value="1"> <?php _e('Streamango', 'tr-grabber'); ?></label>
                            </li>
                            <li>
                                <label><input id="grabber-hideframes" <?php checked( 1, $config['hidevidoza'] ); ?> type="checkbox" name="config[hidevidoza]" value="1"> <?php _e('Vidoza', 'tr-grabber'); ?></label>
                            </li>
                            <li>
                                <label><input id="grabber-hideframes" <?php checked( 1, $config['hidestreamplay'] ); ?> type="checkbox" name="config[hidestreamplay]" value="1"> <?php _e('Streamplay', 'tr-grabber'); ?></label>
                            </li>
                            <li>
                                <label><input id="grabber-hideframes" <?php checked( 1, $config['hideflashx'] ); ?> type="checkbox" name="config[hideflashx]" value="1"> <?php _e('Flashx', 'tr-grabber'); ?></label>
                            </li>
                            <li>
                                <label><input id="grabber-hideframes" <?php checked( 1, $config['hidestreamcherry'] ); ?> type="checkbox" name="config[hidestreamcherry]" value="1"> <?php _e('Streamcherry', 'tr-grabber'); ?></label>
                            </li>
                            <li>
                                <label><input id="grabber-hideframes" <?php checked( 1, $config['hidethevideo'] ); ?> type="checkbox" name="config[hidethevideo]" value="1"> <?php _e('Thevideo.website', 'tr-grabber'); ?></label>
                            </li>
                        </ul>
                    </td>
                </tr>
                
                <tr>
                    <th><?php _e('Title', 'tr-grabber'); ?></th>
                    <td>
                        <input type="text" name="config[hidetitle]" value="<?php echo $config['hidetitle']; ?>" class="md">
                    </td>
                </tr>
                
                <tr>
                    <th><?php _e('Message', 'tr-grabber'); ?></th>
                    <td>
                        <input type="text" name="config[hidemsg]" value="<?php echo $config['hidemsg']; ?>" class="md">
                    </td>
                </tr>
                
                <tr>
                    <th><?php _e('Image', 'tr-grabber'); ?></th>
                    <td>
                        <input type="text" name="config[hideimg]" value="<?php echo $config['hideimg']; ?>" id="tr-grabber-media-content" class="md">
                        <button data-title="<?php _e('Select', 'tr-grabber'); ?>" data-button="<?php _e('Ok', 'tr-grabber'); ?>" data-id="background" data-postid="0" type="button" class="button button-primary tr-grabber-hideframe"><?php _e('Upload Image', 'tr-grabber'); ?></button>
                    </td>
                </tr>
                
                <tr>
                    <th><?php _e('Color', 'tr-grabber'); ?></th>
                    <td>
                        <input type="text" name="config[hidecolor]" value="<?php echo $config['hidecolor']; ?>" class="md trcolor">
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
    
</div>