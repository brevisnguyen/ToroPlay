<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="tr-config-tab" id="tr-config-tab-3" style="display:none">
    
    <p class="error grabber-warning"><?php printf( __('To make changes in slugs do not forget to %supdate the permalinks%s.', 'tr-grabber'), '<a target="_blank" href="'.admin_url( 'options-permalink.php' ).'">', '</a>'); ?></p>

    <div class="tbl-cn tr-config-tab-ul">
        <table class="tr_grabber_content form-table">
            <tbody>
                
                <tr>
                    <th><?php _e('Prefix permalinks posts', 'tr-grabber'); ?></th>
                    <td>
                        <label><input id="grabber-prefixpost" <?php checked( 1, $config['prefix_posts'] ); ?> type="checkbox" name="config[prefix_posts]" value="1"> <?php _e('Enable', 'tr-grabber'); ?></label>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label><?php _e('Slug Seasons', 'tr-grabber'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="config[slug_season]" value="<?php echo $config['slug_season']; ?>" class="md">
                        <p class="desc"><?php _e('{name} to show the name of the series and {season} to show the season number.', 'tr-grabber'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th>
                        <label><?php _e('Slug Episodes', 'tr-grabber'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="config[slug_episode]" value="<?php echo $config['slug_episode']; ?>" class="md">
                        <p class="desc"><?php _e('{name} to show the name of the series, {season} to show the season number and {episode} the episode number.', 'tr-grabber'); ?></p>
                    </td>
                </tr>
                                
                <tr>
                    <th>
                        <label><?php _e('Format Title Season', 'tr-grabber'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="config[title_seasons]" value="<?php echo $config['title_seasons']; ?>" class="md">
                        <p class="desc"><?php _e('{name} to show the name of the series and {season} to show the season number.', 'tr-grabber'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th>
                        <label><?php _e('Format Title Episode', 'tr-grabber'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="config[title_episodes]" value="<?php echo $config['title_episodes']; ?>" class="md">
                        <p class="desc"><?php _e('{name} to show the name of the series, {season} to show the season number and {episode} the episode number.', 'tr-grabber'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th>
                        <label><?php _e('Format Subtitle Season', 'tr-grabber'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="config[subtitle_seasons]" value="<?php echo $config['subtitle_seasons']; ?>" class="md">
                        <p class="desc"><?php _e('{season} to show the season number.', 'tr-grabber'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th>
                        <label><?php _e('Format Subtitle Episode', 'tr-grabber'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="config[subtitle_episodes]" value="<?php echo $config['subtitle_episodes']; ?>" class="md">
                        <p class="desc"><?php _e('{name} to show the name of the series.', 'tr-grabber'); ?></p>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    
</div>