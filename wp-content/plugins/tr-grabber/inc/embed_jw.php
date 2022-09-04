<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$type = intval($_GET['trtype']);

$link = $type == 1 ? unserialize ( get_post_meta( intval(get_query_var('trid')), 'trglinks_'.intval(get_query_var('trembed')), true ) ) : unserialize ( get_term_meta( intval(get_query_var('trid')), 'trglinks_'.intval(get_query_var('trembed')), true ) );

$link = base64_decode( $link['link'] );

$a = array( '&amp;amp;lt;', '&amp;amp;quot;', '&amp;amp;gt;', '&amp;lt;', '&amp;quot;', '&amp;gt;', '&lt;', '&quot;', '&gt;' );
$b = array( '<', '"', '>', '<', '"', '>', '<', '"', '>' );
$link = str_replace( $a, $b, $link );

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
    <style type="text/css">html,body{width:100%;height:100%; padding:0; margin:0;}#videodiv,iframe{width:100%;height:100%;}</style>
</head>
<body oncontextmenu="return false;">

    <div id="videodiv" style="width: 100%;height: 100%;margin: 0;font-size: 0;">
        <video id="videojs" class="video-js vjs-big-play-centered" controls preload="auto" width="100%" height="100%"></video>
    </div>
    
    <script type="text/javascript">
        var adsVideo = '<?php echo TR_GRABBER_PLUGIN_URL . 'player/1s_blank.mp4' ?>';
        var options = {
            autoplay: false,
            fluid: true,
            responsive: true,
            aspectRatio: '16:9',
            sources: [{
                src: adsVideo,
                type: 'video/mp4'
            }]
        }

        var player = videojs("videojs", options);

        // Phát link embed sau khi TVC kết thúc
        player.on('ended', function() {
            let playerDiv = document.getElementById('videodiv');
            playerDiv.removeChild(document.getElementById('videojs'));
            let iframe = document.createElement('iframe');
            iframe.setAttribute('src', '<?php echo $link ?>');
            iframe.setAttribute('frameBorder', '0');
            iframe.setAttribute('allowfullscreen', 'allowfullscreen');
            iframe.setAttribute('width', '560');
            iframe.setAttribute('height', '315');
            playerDiv.append(iframe);
        });

        // TVC
        player.preroll({
            src: [{
                type: 'video/mp4',
                src: 'https://i9dev.live/storage/i9betads.mp4',
            }],
            // URL đích khi người dùng click vào quảng cáo
            href: 'https://github.com/brevis-ng',
            target: '_blank',
            allowSkip: true,
            skipTime: 5, // Số giây quảng cáo tự động tắt
            adSign: true,
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