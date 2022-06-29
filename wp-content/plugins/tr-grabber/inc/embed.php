<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$type = intval($_GET['trtype']);

$link = $type == 1 ? unserialize ( get_post_meta( intval(get_query_var('trid')), 'trglinks_'.intval(get_query_var('trembed')), true ) ) : unserialize ( get_term_meta( intval(get_query_var('trid')), 'trglinks_'.intval(get_query_var('trembed')), true ) );

$link = base64_decode( $link['link'] );

$iframe = '';

$a = array( '&amp;amp;lt;', '&amp;amp;quot;', '&amp;amp;gt;', '&amp;lt;', '&amp;quot;', '&amp;gt;', '&lt;', '&quot;', '&gt;' );
$b = array( '<', '"', '>', '<', '"', '>', '<', '"', '>' );
$link = str_replace( $a, $b, $link );

preg_match('#<iframe(.*?)></iframe>#is', html_entity_decode($link), $matches);

preg_match('/\[(.*?)\]/', html_entity_decode($link), $matshortcode);

if( isset($matshortcode[0]) ) {
    $link = do_shortcode( $matshortcode[0] );
}elseif( isset($matches[0]) ) {
    $link = html_entity_decode($link);
    preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $link, $matches);
    if( in_array( tr_grabber_get_domain_from_url($matches[1]), tr_grabber_frame_servers() ) ) {
        $link = str_replace($matches[1], esc_url( home_url( '/' ) ).'/?trhide=1&tid='.strrev(bin2hex($matches[1])).'&', $link);
    }
}else{
    if( in_array( tr_grabber_get_domain_from_url($link), tr_grabber_frame_servers() ) ) {
        $link = str_replace($link, esc_url( home_url( '/' ) ).'?trhide=1&tid='.strrev(bin2hex($link)).'&', $link);
    }
    $iframe = '<iframe width="560" height="315" src="'.$link.'" frameborder="0" allowfullscreen></iframe>';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php _e('Embed', 'tr-grabber'); ?></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex,nofollow">
    <style>body,html,.Video,iframe{width: 100%;height: 100%;margin: 0;font-size: 0;}</style>
    <style>.ads_logo{position: absolute;top: 20px;left: 15px;z-index: 999;} .ads_logo img{max-width: 80px;}</style>
    <script type="text/javascript" src="<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/jwplayer.js' ?>"></script>
    <script type="text/javascript" src="<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/jquery.min.js' ?>"></script>
    <script type="text/javascript">jwplayer.key = "vSKJmhF1qg3zjWCGEJ5DGbxaC31v99AbL0hP6HqpZ5E="</script>
</head>
<body oncontextmenu="return false;">

    <div id="playerjw7" class="Video"></div>
    <div class="ads_logo">
	    <a href="//i9bet.net" title="" target="_blank"><img src="https://csi.20icipp.com/img/static/desktop/brand/i999/logo.png" alt="brevis-ng"></a>
    </div>
    
    <script type="text/javascript">
        var arrPreroll = "<?php echo TR_GRABBER_PLUGIN_URL . 'player/preload/i9bet.php' ?>";
        var sources = [{
            file: '<?= $link ?>',
            type: 'embed',
            label: '1080p',
            default: false
        },];
        var tracks = [];
        var currentVolume;
        var skipDelay = 15,
            displaySkip = false,
            skipTimeOut = false,
            reloadTimes = 0,
            timeToSeek = 0,
            manualSeek = false,
            seekTimeOut, playTimeout, playAds = 0,
            maxAds = 1;
        if (typeof arrPreroll == "undefined") {
            var arrPreroll = [];
            maxAds = 0;
        }
        var advertising = {
            client: "<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/vast.js' ?>",
            admessage: 'Quảng cáo còn XX giây.',
            skipoffset: 6,
            skiptext: 'Bỏ qua quảng cáo',
            skipmessage: 'Bỏ qua sau xxs',
            width: '100%',
            height: '100%',
            autostart: true,
            schedule: {
                preroll: {
                    offset: 'pre',
                    tag: arrPreroll,
                },
            }
        };

        var playerInstance = jwplayer('playerjw7');

        function setupVideo() {
            var firstSource = [{
                file: '<?php echo TR_GRABBER_PLUGIN_URL . 'player/1s_blank.mp4' ?>',
                type: 'mp4',
                label: '360p',
                default: true
            }];

            if (playAds < maxAds) {
                console.log(maxAds);
                playAds++;
                playerInstance.setup({
                    sources: firstSource,
                    tracks: tracks,
                    captions: {
                        color: '#FFCC00',
                        fontSize: 17,
                        backgroundOpacity: 0,
                        fontfamily: "Tahoma",
                        edgeStyle: "raised"
                    },

                    width: '100%',
                    height: '100%',
                    primary: "html5",
                    controls: true,
                    autostart: true,
                    advertising: advertising,
                });
                setUpVideoEvent();
            } else {
                playAds++;
                if (self.sources[0].type == "embed") {

                    $("#playerjw7").html('<?php echo $iframe ?>');

                } else {
                    playerInstance.setup({
                        sources: sources,
                        tracks: tracks,
                        captions: {
                            color: '#FFCC00',
                            fontSize: 17,
                            backgroundOpacity: 0,
                            fontfamily: "Tahoma",
                            edgeStyle: "raised"
                        },
                        width: '100%',
                        height: '100%',
                        primary: "html5",
                        controls: true,
                        autostart: true,
                    });
                    setUpVideoEvent();
                }
            }
        }

        this.setUpVideoEvent = function() {
            playerInstance.on('complete', function() {
                nextEpiV2();

            }).on('ready', function() {
                if (seekTimeOut != null) {
                    clearTimeout(seekTimeOut);
                }

                if (timeToSeek > 8) seekTimeOut = setTimeout(function() {
                    playerInstance.seek(timeToSeek);
                    manualSeek = false;
                }, 500);

                if (playTimeout != null) {
                    clearTimeout(playTimeout);
                    playTimeout = null;
                }
                playTimeout = setTimeout(function() {
                    playerInstance.play(true);
                    manualSeek = false;
                }, 1000);
            }).on('error', function(message) {
                var time = playerInstance.getPosition();
                if (time > 8 && (manualSeek == false)) timeToSeek = time;
                if (reloadTimes < 5) {
                    reloadTimes++;
                    if (message['message'] == 'Error loading media: File could not be played') {
                        setTimeout(function() {
                            jQuery("#playerjw7").find(".jw-title-primary").text("Có chút vấn đề khi load phim. Đang thử lại...").show();
                        }, 100);
                    }
                    setTimeout(function() {
                        playerInstance.remove();
                        setupVideo();
                    }, 2000);
                } else {
                    if (message['message'] == 'Error loading media: File could not be played') {
                        setTimeout(function() {
                            jQuery("#playerjw7").find(".jw-title-primary").text("Có chút vấn đề khi load phim").show();
                            jQuery("#playerjw7").find(".jw-title-secondary").text("Chạy lại trang (ấn F5) hoặc mở link khác bên dưới").show();
                        }, 100);
                    }
                }
            }).on('beforePlay', function() {
                var volume = readCookie('volume');
                if (volume == undefined || volume < 1) {
                    createCookie('volume', 75, 7);
                }
                playerInstance.setVolume(volume);
            }).on('volume', function(event) {
                createCookie('volume', event.volume, 7);
            }).on('adPlay', function() {
                currentVolume = playerInstance.getVolume();
                playerInstance.setVolume(50);
                skipTimeOut = setTimeout(function() {
                    if (displaySkip == false) {
                        $("#skipad-inner").show();
                        $("#skipad-inner").click(function() {
                            $("#skipad-inner").hide();
                            playerInstance.remove();
                            setupVideo();
                        });
                        displaySkip = true;
                    }
                }, 1000 + skipDelay * 1000);
            }).on('play', function() {
                playerInstance.setCurrentCaptions(1);
                $("#skipad-inner").hide();
                clearTimeout(skipTimeOut);
                if (playAds <= maxAds) {
                    playerInstance.remove();
                    setupVideo();
                } else {
                    if (currentVolume > 0) {
                        playerInstance.setVolume(currentVolume);
                        currentVolume = 0
                    }
                }
            }).on('seek', function(event) {
                manualSeek = true;
                timeToSeek = event.offset;
            }).on('seeked', function(event) {
                manualSeek = false;
            }).on('adTime', function(event) {
                if (event.position > skipDelay && (displaySkip == false)) {
                    $("#skipad-inner").show();
                    setTimeout(function() {
                        $("#skipad-inner").hide();
                    }, 10000);
                    $("#skipad-inner").click(function() {
                        $("#skipad-inner").hide();
                        playerInstance.remove();
                        setupVideo();
                    });
                    displaySkip = true;
                }
            }).on('adSkipped', function(event) {
                $("#skipad-inner").hide();
                displaySkip = true;
            }).on('adComplete', function(event) {
                $("#skipad-inner").hide();
                displaySkip = true;
            });
        }
        setupVideo();
    </script>
</body>
</html>