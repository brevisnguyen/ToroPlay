<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="tr-config-tab" id="tr-config-tab-2" style="display:none">

   <div class="tbl-cn tr-config-tab-ul">
        <table class="tr_grabber_content form-table">
            <tbody>

                <tr>
                    <th>
                        <label><?php _e('Set Time Limit', 'tr-grabber'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="config[time_limit]" value="<?php echo $config['time_limit']; ?>" class="sm">
                    </td>
                </tr>
                
                <tr>
                    <th>
                        <label><?php _e('Set Memory Limit', 'tr-grabber'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="config[memory_limit]" value="<?php echo $config['memory_limit']; ?>" class="sm">
                    </td>
                </tr>
                
                <tr>
                    <th><?php _e('Message update database', 'tr-grabber'); ?></th>
                    <td>
                        <input type="hidden" name="msj_update31" value="<?php echo $config['msj_update31']; ?>">
                        <label><input <?php checked( 1, $config['msj_update'] ); ?> type="checkbox" name="config[msj_update]" value="1"><?php _e('Enable', 'tr-grabber'); ?></label>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    
</div>