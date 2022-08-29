<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$type = intval($_GET['trtype']);

$episode = $type == 1 ? unserialize ( get_post_meta( intval(get_query_var('trid')), 'trglinks_'.intval(get_query_var('trembed')), true ) ) : unserialize ( get_term_meta( intval(get_query_var('trid')), 'trglinks_'.intval(get_query_var('trembed')), true ) );

$ep_link = base64_decode( $episode['link'] );

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
    <link href="https://vjs.zencdn.net/7.20.2/video-js.css" rel="stylesheet" />
    <!-- Ads plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-ads/6.9.0/videojs.ads.min.js" integrity="sha512-ff4Rc39SC+LyUOUEKUvQ5VW/BMtzy+p3/zN+zB/VloiEfFpkY4JseoJC2TtwJTnn2PrSsm+dvSW6S4yV6uADUA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-ads/6.9.0/videojs-contrib-ads.css" integrity="sha512-0gIqgiX1dWTChdWUl8XGIBDFvLo7aTvmd6FAhJjzWx5bzYsCJTiPJLKqLF3q31IN4Kfrc0NbTO+EthoT6O0olQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Ads plugin -->
    <!-- VideoJS -->
    <script type="text/javascript" src="<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/jquery.min.js' ?>"></script>
</head>
<body oncontextmenu="return false;">
    <video id="videojs7x" class="video-js vjs-big-play-centered" controls preload="none" width="100%" height="100%">
        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
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
            autoplay: 'false',
            poster: '',
            fluid: true,
            aspectRatio: '16:9',
            playbackRates: [0.5, 1, 1.5, 2],
            sources: [{
                src: ep_link,
                type: video_type
            }]
        }
        var player = videojs("videojs7x", options);
    </script>
</body>
</html>