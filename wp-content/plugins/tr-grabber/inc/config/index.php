<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( isset($_POST['submit']) ) {
    
    if( isset( $_POST['config'] ) ) {
        foreach( $_POST['config'] as $key => $value ) {
            
            $array[$key] = isset( $value ) ? $value : '';

        }
    }
    
    if( isset($array) ) update_option( 'tr_grabber', serialize( $array ) );
    
    $config['texthome'] = isset($array['texthome']) ? $array['texthome'] : '';
    
}

$config_grabber = get_option('tr_grabber') == '' ? '' : unserialize ( get_option('tr_grabber') );

$config = $config_grabber;

$config['texthome'] = isset( $config['texthome'] ) ? $config['texthome'] : '';
$config['api_key'] = isset( $config['api_key'] ) ? $config['api_key'] : '';
$config['upload_images'] = isset( $config['upload_images'] ) ? $config['upload_images'] : 0;
$config['lang_api'] = isset( $config['lang_api'] ) ? $config['lang_api'] : 'en-EN';
$config['special_season'] = isset( $config['special_season'] ) ? $config['special_season'] : 0;
$config['post_status'] = isset( $config['post_status'] ) ? $config['post_status'] : 'publish';
$config['time_limit'] = isset( $config['time_limit'] ) ? $config['time_limit'] : '';
$config['memory_limit'] = isset( $config['memory_limit'] ) ? $config['memory_limit'] : '';
$config['msj_update'] = isset( $config['msj_update'] ) ? $config['msj_update'] : 0;
$config['msj_update31'] = isset( $config['msj_update31'] ) ? $config['msj_update31'] : '';
$config['prefix_posts'] = isset( $config['prefix_posts'] ) ? $config['prefix_posts'] : 0;
$config['slug_movies'] = isset( $config['slug_movies'] ) ? $config['slug_movies'] : __('movie', 'tr-grabber');
$config['slug_series'] = isset( $config['slug_series'] ) ? $config['slug_series'] : __('serie', 'tr-grabber');
$config['slug_season'] = isset( $config['slug_season'] ) ? $config['slug_season'] : '{name}-{season}';
$config['slug_episode'] = isset( $config['slug_episode'] ) ? $config['slug_episode'] : '{name}-{season}x{episode}';
$config['slug_letters'] = isset( $config['slug_letters'] ) ? $config['slug_letters'] : __('letter', 'tr-grabber');
$config['title_seasons'] = isset( $config['title_seasons'] ) ? $config['title_seasons'] : __('{name} - Season {season}', 'tr-grabber');
$config['title_episodes'] = isset( $config['title_episodes'] ) ? $config['title_episodes'] : '{name} {season}x{episode}';
$config['subtitle_seasons'] = isset( $config['subtitle_seasons'] ) ? $config['subtitle_seasons'] : __('Season {season}', 'tr-grabber');
$config['subtitle_episodes'] = isset( $config['subtitle_episodes'] ) ? $config['subtitle_episodes'] : '{name}';
$config['prefix_season'] = isset( $config['prefix_season'] ) ? $config['prefix_season'] : __('season', 'tr-grabber');
$config['prefix_episode'] = isset( $config['prefix_episode'] ) ? $config['prefix_episode'] : __('episode', 'tr-grabber');
$config['prefix_cast'] = isset( $config['prefix_cast'] ) ? $config['prefix_cast'] : __('cast', 'tr-grabber');
$config['prefix_casttv'] = isset( $config['prefix_casttv'] ) ? $config['prefix_casttv'] : __('cast_tv', 'tr-grabber');
$config['prefix_director'] = isset( $config['prefix_director'] ) ? $config['prefix_director'] : __('director', 'tr-grabber');
$config['prefix_directortv'] = isset( $config['prefix_directortv'] ) ? $config['prefix_directortv'] : __('director_tv', 'tr-grabber');
$config['serial'] = isset( $config['serial'] ) ? $config['serial'] : '';

$config['hideframes'] = isset( $config['hideframes'] ) ? $config['hideframes'] : 0;
$config['hidetitle'] = isset( $config['hidetitle'] ) ? $config['hidetitle'] : __('TOROTHEMES PLAYER', 'tr-grabber');
$config['hidemsg'] = isset( $config['hidemsg'] ) ? $config['hidemsg'] : __('Checking that you are not a bot', 'tr-grabber');
$config['hideimg'] = isset( $config['hideimg'] ) ? $config['hideimg'] : 'https://image.tmdb.org/t/p/w780/mhdeE1yShHTaDbJVdWyTlzFvNkr.jpg';
$config['hideopenload'] = isset( $config['hideopenload'] ) ? $config['hideopenload'] : 0;
$config['hidestreamango'] = isset( $config['hidestreamango'] ) ? $config['hidestreamango'] : 0;
$config['hidevidoza'] = isset( $config['hidevidoza'] ) ? $config['hidevidoza'] : 0;
$config['hidestreamplay'] = isset( $config['hidestreamplay'] ) ? $config['hidestreamplay'] : 0;
$config['hideflashx'] = isset( $config['hideflashx'] ) ? $config['hideflashx'] : 0;
$config['hidestreamcherry'] = isset( $config['hidestreamcherry'] ) ? $config['hidestreamcherry'] : 0;
$config['hidethevideo'] = isset( $config['hidethevideo'] ) ? $config['hidethevideo'] : 0;
$config['hidecolor'] = isset( $config['hidecolor'] ) ? $config['hidecolor'] : '#9c27b0';
$config['abc'] = isset( $config_grabber['abc'] ) ? $config_grabber['abc'] : 1;

?>
<div class="trgrabber_config">
    <section class="wrap tr-grabber">
        <div class="Top">
            <h1>TR Grabber <span><?php echo TR_GRABBER_VERSION; ?></span></h1>
        </div>

        <ul class="tr-config-tab-ul Blkcn TbsBxCn">
            <li class="Current"><button data-tab="1" type="button"><?php _e('Basic', 'tr-grabber'); ?></button></li>
            <li><button data-tab="2" type="button"><?php _e('Advanced', 'tr-grabber'); ?></button></li>
            <li><button data-tab="3" type="button"><?php _e('SEO', 'tr-grabber'); ?></button></li>
            <?php if( function_exists('tr_homecontrol') ) { ?>
            <li><button data-tab="4" type="button"><?php _e('Home Control', 'tr-grabber'); ?></button></li>
            <?php } ?>
            <li><button data-tab="5" type="button"><?php _e('Protect Iframes', 'tr-grabber'); ?></button></li>
        </ul>

        <form action="admin.php?page=tr-grabber" method="post" class="Blkcn">
            
            <?php require_once(TR_GRABBER_PLUGIN_DIR.'inc/config/basic.php'); ?>
            <?php require_once(TR_GRABBER_PLUGIN_DIR.'inc/config/advanced.php'); ?>
            <?php require_once(TR_GRABBER_PLUGIN_DIR.'inc/config/seo.php'); ?>
            <?php require_once(TR_GRABBER_PLUGIN_DIR.'inc/config/homecontrol.php'); ?>
            <?php require_once(TR_GRABBER_PLUGIN_DIR.'inc/config/hideframe.php'); ?>
            
            <input type="hidden" name="config[abc]" value="<?php echo $config['abc']; ?>">
            <input type="hidden" name="config[serial]" value="<?php echo $config['serial']; ?>">
            <input type="hidden" name="config[slug_movies]" value="<?php echo $config['slug_movies']; ?>">
            <input type="hidden" name="config[slug_series]" value="<?php echo $config['slug_series']; ?>">
            <input type="hidden" name="config[prefix_season]" value="<?php echo $config['prefix_season']; ?>">
            <input type="hidden" name="config[prefix_episode]" value="<?php echo $config['prefix_episode']; ?>">
            <input type="hidden" name="config[prefix_cast]" value="<?php echo $config['prefix_cast']; ?>">
            <input type="hidden" name="config[prefix_casttv]" value="<?php echo $config['prefix_casttv']; ?>">
            <input type="hidden" name="config[prefix_director]" value="<?php echo $config['prefix_director']; ?>">
            <input type="hidden" name="config[prefix_directortv]" value="<?php echo $config['prefix_directortv']; ?>">
            <input type="hidden" name="config[slug_letters]" value="<?php echo $config['slug_letters']; ?>">
            <button class="BtnSnd Alt" name="submit" type="submit"><?php _e('Save Changes', 'tr-grabber'); ?></button>
            
        </form>
    </section>
</div>