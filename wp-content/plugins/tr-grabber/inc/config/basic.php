<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="tr-config-tab" id="tr-config-tab-1">

    <div class="tbl-cn tr-config-tab-ul">
        <table class="tr_grabber_content form-table">
            <tbody>

                <tr>
                    <th>
                        <label><?php _e('API Key', 'tr-grabber'); ?></label>
                    </th>
                    <td class="desc-rt">
                        <input type="text" name="config[api_key]" value="<?php echo $config['api_key']; ?>" class="sm">
                        <p class="desc"><a class="BtnSnd getapi" target="_blank" href="https://www.themoviedb.org/account/"><?php _e('GET API KEY', 'tr-grabber'); ?></a></p>
                    </td>
                </tr>

                <tr>
                    <th><?php _e('Language API', 'tr-grabber'); ?></th>
                    <td>
                        <label>
                            <select name="config[lang_api]" class="sm">
                                <option <?php selected( $config['lang_api'], 'ar-AR' ); ?> value="ar-AR">Arabic</option>
                                <option <?php selected( $config['lang_api'], 'bs-BS' ); ?> value="bs-BS">Bosnian</option>
                                <option <?php selected( $config['lang_api'], 'bg-BG' ); ?> value="bg-BG">Bulgarian</option>
                                <option <?php selected( $config['lang_api'], 'hr-HR' ); ?> value="hr-HR">Croatian</option>
                                <option <?php selected( $config['lang_api'], 'cs-CZ' ); ?> value="cs-CZ">Czech</option>
                                <option <?php selected( $config['lang_api'], 'da-DK' ); ?> value="da-DK">Danish</option>
                                <option <?php selected( $config['lang_api'], 'nl-NL' ); ?> value="nl-NL">Dutch</option>
                                <option <?php selected( $config['lang_api'], 'en-EN' ); ?> value="en-EN">English</option>
                                <option <?php selected( $config['lang_api'], 'en-US' ); ?> value="en-US">English (EEUU)</option>
                                <option <?php selected( $config['lang_api'], 'fi-FI' ); ?> value="fi-FI">Finnish</option>
                                <option <?php selected( $config['lang_api'], 'fr-FR' ); ?> value="fr-FR">French</option>
                                <option <?php selected( $config['lang_api'], 'de-DE' ); ?> value="de-DE">German</option>
                                <option <?php selected( $config['lang_api'], 'el-GR' ); ?> value="el-GR">Greek</option>
                                <option <?php selected( $config['lang_api'], 'he-IL' ); ?> value="he-IL">Hebrew</option>
                                <option <?php selected( $config['lang_api'], 'hu-HU' ); ?> value="hu-HU">Hungarian</option>
                                <option <?php selected( $config['lang_api'], 'is-IS' ); ?> value="is-IS">Icelandic</option>
                                <option <?php selected( $config['lang_api'], 'id-ID' ); ?> value="id-ID">Indonesian</option>
                                <option <?php selected( $config['lang_api'], 'it-IT' ); ?> value="it-IT">Italian</option>
                                <option <?php selected( $config['lang_api'], 'ko-KR' ); ?> value="ko-KR">Korean</option>
                                <option <?php selected( $config['lang_api'], 'lb-LB' ); ?> value="lb-LB">Letzeburgesch</option>
                                <option <?php selected( $config['lang_api'], 'lt-LT' ); ?> value="lt-LT">Lithuanian</option>
                                <option <?php selected( $config['lang_api'], 'zh-CN' ); ?> value="zh-CN">Mandarin</option>
                                <option <?php selected( $config['lang_api'], 'fa-IR' ); ?> value="fa-IR">Persian</option>
                                <option <?php selected( $config['lang_api'], 'pl-PL' ); ?> value="pl-PL">Polish</option>
                                <option <?php selected( $config['lang_api'], 'pt-PT' ); ?> value="pt-PT">Portuguese</option>
                                <option <?php selected( $config['lang_api'], 'pt-BR' ); ?> value="pt-BR">Portuguese</option>
                                <option <?php selected( $config['lang_api'], 'ro-RO' ); ?> value="ro-RO">Romanian</option>
                                <option <?php selected( $config['lang_api'], 'ru-RU' ); ?> value="ru-RU">Russian</option>
                                <option <?php selected( $config['lang_api'], 'sk-SK' ); ?> value="sk-SK">Slovak</option>
                                <option <?php selected( $config['lang_api'], 'es-ES' ); ?> value="es-ES">Spanish</option>
                                <option <?php selected( $config['lang_api'], 'es-MX' ); ?> value="es-MX">Spanish LA</option>
                                <option <?php selected( $config['lang_api'], 'sv-SE' ); ?> value="sv-SE">Swedish</option>
                                <option <?php selected( $config['lang_api'], 'th-TH' ); ?> value="th-TH">Thai</option>
                                <option <?php selected( $config['lang_api'], 'tr-TR' ); ?> value="tr-TR">Turkish</option>
                                <option <?php selected( $config['lang_api'], 'tw-TW' ); ?> value="tw-TW">Twi</option>
                                <option <?php selected( $config['lang_api'], 'uk-UA' ); ?> value="uk-UA">Ukrainian</option>
                                <option <?php selected( $config['lang_api'], 'vi-VN' ); ?> value="vi-VN">Vietnamese</option>
                            </select>
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th><?php _e('Post Status', 'tr-grabber'); ?></th>
                    <td>
                        <label>
                            <select name="config[post_status]" class="sm">
                                <option <?php selected( $config['post_status'], 'publish' ); ?> value="publish"><?php _e('Publish'); ?></option>
                                <option <?php selected( $config['post_status'], 'draft' ); ?> value="draft"><?php _e('Draft'); ?></option>
                            </select>
                        </label>
                    </td>
                </tr>

                <tr>
                    <th><?php _e('Upload Images', 'tr-grabber'); ?></th>
                    <td>
                        <label><input <?php checked( 1, $config['upload_images'] ); ?> type="checkbox" name="config[upload_images]" value="1"><?php _e('Enable', 'tr-grabber'); ?></label>
                    </td>
                </tr>
                
                <tr>
                    <th><?php _e('Add special seasons? (Series)', 'tr-grabber'); ?></th>
                    <td>
                        <label><input <?php checked( 1, $config['special_season'] ); ?> type="checkbox" name="config[special_season]" value="1"><?php _e('Enable', 'tr-grabber'); ?></label>
                    </td>
                </tr>
                
                <?php /*
                <tr>
                    <th><?php _e('Size of Backdrop', 'tr-grabber'); ?></th>
                    <td>
                        <label>
                            <?php _e('Width', 'tr-grabber'); ?>
                            <input type="text" name="config[backdrop_width]" value="<?php echo $config['backdrop_width']; ?>" class="xs">
                            <?php _e('Height', 'tr-grabber'); ?>
                            <input type="text" name="config[backdrop_height]" value="<?php echo $config['backdrop_height']; ?>" class="xs">
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th><?php _e('Season image size', 'tr-grabber'); ?></th>
                    <td>
                        <label>
                            <?php _e('Width', 'tr-grabber'); ?>
                            <input type="text" name="config[season_width]" value="<?php echo $config['season_width']; ?>" class="xs">
                            <?php _e('Height', 'tr-grabber'); ?>
                            <input type="text" name="config[season_height]" value="<?php echo $config['season_height']; ?>" class="xs">
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th><?php _e('Episode image size', 'tr-grabber'); ?></th>
                    <td>
                        <label>
                            <?php _e('Width', 'tr-grabber'); ?>
                            <input type="text" name="config[episode_width]" value="<?php echo $config['episode_width']; ?>" class="xs">
                            <?php _e('Height', 'tr-grabber'); ?>
                            <input type="text" name="config[episode_height]" value="<?php echo $config['episode_height']; ?>" class="xs">
                        </label>
                    </td>
                </tr>*/?>

            </tbody>
        </table>
    </div>
    
</div>