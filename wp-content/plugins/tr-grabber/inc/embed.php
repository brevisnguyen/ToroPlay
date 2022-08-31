<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$type = intval($_GET['trtype']);

$poster = $type == 1 ? get_post_meta( intval(get_query_var('trid')), 'backdrop_hotlink', true ) : get_post_meta(get_term_meta( intval(get_query_var('trid')), 'tr_id_post', true ), 'backdrop_hotlink', true );

$subtitles_url = $type == 1 ? get_post_meta( intval(get_query_var('trid')), 'subtitles_url', true ) : get_term_meta( intval(get_query_var('trid')), 'subtitles_url', true );

$episode = $type == 1 ? unserialize ( get_post_meta( intval(get_query_var('trid')), 'trglinks_'.intval(get_query_var('trembed')), true ) ) : unserialize ( get_term_meta( intval(get_query_var('trid')), 'trglinks_'.intval(get_query_var('trembed')), true ) );

$ep_link = base64_decode( $episode['link'] );

$ep_link_type = intval(get_query_var('trembed')) == 0 ? 'embed' : 'm3u8';  // 0 = embed, 1 = m3u8

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php _e('Embed', 'tr-grabber'); ?></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex,nofollow">
    <!-- VideoJS -->
    <script type="text/javascript" src="<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/video.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/videojs.ads.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/videojs-preroll-v2.js' ?>"></script>
    <script type="text/javascript" src="<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/videojs.hotkeys.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/jquery.min.js' ?>"></script>
    <link rel="stylesheet" href="<?php echo TR_GRABBER_PLUGIN_URL . 'player/css/video-js.css' ?>"/>
    <link rel="stylesheet" href="<?php echo TR_GRABBER_PLUGIN_URL . 'player/css/videojs-contrib-ads.css' ?>"/>
    <link rel="stylesheet" href="<?php echo TR_GRABBER_PLUGIN_URL . 'player/css/videojs-preroll.css' ?>"/>
</head>
<body oncontextmenu="return false;">

    <video id="videojs" class="video-js vjs-big-play-centered" controls preload="auto" width="100%" height="100%">
        <p class="vjs-no-js">Không hỗ trợ phát video. Vui lòng liên hệ <a href="https://t.me/brevis_ng">Brevis</a> phản ánh, xin cảm ơn.</p>
    </video>

    <script type="text/javascript">
        var ep_link = "<?php echo $ep_link ?>";
        var video_type = 'video/mp4';
        if ( ep_link.indexOf('.m3u8') > -1 ) {
            video_type = 'application/x-mpegURL';
        } else if ( ep_link.indexOf('.mkv') > -1 ) {
            type='video/x-matroska';
        }
        var options = {
            autoplay: false,
            fluid: true,
            poster: '<?php echo $poster ?>',
            responsive: true,
            aspectRatio: '16:9',
            playbackRates: [0.5, 1, 1.5, 2],
            sources: [{
                src: ep_link,
                type: video_type
            }],
            plugins: {
                hotkeys: {
                    volumeStep: 0.1,
                    seekStep: 10,
                    enableModifiersForNumbers: false
                }
            }
        }
        var player = videojs("videojs", options);

        player.on('adend', function() {
            console.log('in loadedmetadata');
            player.addRemoteTextTrack({
                src: "<?php echo $subtitles_url ?>",
                srclang: 'vi',
                label: 'Vietnamese',
                kind: 'subtitles'
            }, true);
        });

        player.preroll({
            // Source video quảng cáo
            src: [{
                type: 'video/mp4',
                src: 'https://i9dev.live/storage/i9betads.mp4',
            }],
            // URL đích khi người dùng click vào quảng cáo
            href: 'https://github.com/brevis-ng',
            target: '_blank',
            // Thuộc tính video quảng cáo
            allowSkip: true,
            skipTime: 1, // Số giây quảng cáo tự động tắt
            adSign: true,
            // Thuộc tính hiển thị
            lang: {
                'skip': 'Bỏ qua',
                'skip in': 'Bỏ qua trong ',
                'advertisement': 'Quảng cáo',
                'video start in': 'Phim sẽ bắt đầu trong: ',
            }
        });
    </script>
</body>
</html>