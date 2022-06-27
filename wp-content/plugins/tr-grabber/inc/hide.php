<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $config_grabber;

$color = $config_grabber['hidecolor'];
$title = $config_grabber['hidetitle'];
$text = $config_grabber['hidemsg'];
$background = $config_grabber['hideimg'] == '' ? '' : '<img src="'.$config_grabber['hideimg'].'" alt="backdrop" class="tt-bg">';
$home = esc_url( home_url( '/?trhide=1' ) );
$id = get_query_var('tid') != '' ? get_query_var('tid') : '';
$url = $home.'&tid='.$id;

if( !wp_get_referer() and wp_get_referer() == $url and wp_get_referer() == $home ) {
    wp_die('die');
}else{
    if ( get_query_var('trhex') and in_array( tr_grabber_get_domain_from_url( hex2bin(get_query_var('trhex')) ), tr_grabber_frame_servers() ) ) {
        wp_redirect( esc_url_raw( hex2bin(get_query_var('trhex')) ) );
        exit();
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ToroPlay</title>
        <meta name="robots" content="noindex, nofollow">
        <style>
            *{box-sizing:border-box;margin:0;padding:0}
            /*color*/
            body,.tt-play{background-color:<?php echo $color; ?>}
            svg path,svg rect{fill:<?php echo $color; ?>}
            
            body{overflow:hidden;font-family:sans-serif;font-size:1rem}
            body,body a{color:#fff;text-decoration:none}
            .tt-bg{position:absolute;left:0;top:0;width:100%;height:100%;object-fit:cover;filter:opacity(.3) grayscale(100%) contrast(130%) blur(3px)}
            .tt-all{height:100vh;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;position:relative;z-index:2;background-color:rgba(0,0,0,.5);text-align:center;padding:1rem}
            .tt-play{width:7rem;height:5rem;cursor:pointer;display:inline-block;vertical-align:top;transition:.2s;margin-bottom:2rem;position:relative;border-radius:.5rem;box-shadow:inset 0 0 0 5px rgba(255,255,255,.7), 0 0 30px rgba(0,0,0,.5)}
            .tt-play:before{background:linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0) 1%,rgba(0,0,0,0.3) 100%);position:absolute;left:0;top:0;width:100%;height:100%;content:'';border-radius:.5rem}
            .tt-play:after{content:'';position:absolute;left:.3rem;top:0;right:0;bottom:0;margin:auto;width:0;height:0;border-top:1rem solid transparent;border-left:1.7rem solid #fff;border-bottom:1rem solid transparent}
            .tt-play:last-child{margin-bottom:0}
            .tt-play:hover{transform:scale(1.2)}
            .title{font-size:1.5rem;font-weight:700;margin-bottom:.5rem;text-transform:uppercase}
            .msg{font-size:.75rem;opacity:.5;margin-bottom:1rem}
            .tt-load{height:3rem;width:3rem;margin:auto;display:inline-block;vertical-align:top} #MainPopupIframe{display:none;position:absolute;top:0px;left:0px;right:0px;bottom:0px;width:100%;height:100%;z-index:10;border:0}
        </style>
    </head>
    <body oncontextmenu="return false;">
        
        <div class="tt-all">
            <div class="tt-bx" id="ttbx">
                <span style="display:none" onclick="tr_play();" class="tt-play" id="tt-play"></span>
                <div id="hd">
                    <h1 class="title"><?php echo $title; ?></h1>
                    <p class="msg"><?php echo $text; ?> <span id="tt-load"></span></p>
                    <div class="tt-load">
                        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" xml:space="preserve">
                            <path d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                                <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/>
                            </path>
                        </svg>
                    </div>
                </div>
                <div style="display:none" id="msg" class="tt-load">
                    <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" xml:space="preserve">
                        <path d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                            <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/>
                        </path>
                    </svg>
                </div>
            </div>
        </div>
        <?php echo $background;  ?>
        
        <script type="text/javascript">
                        
            function trde ($this){

                var str = $this.length;
                var trde = '';

                for (; str >= 0; ) { 
                    trde = trde + $this.charAt(str);
                    str--;
                }

                return trde;

            }

            setTimeout(function(){

                var ttplay = document.getElementById('tt-play');
                ttplay.style.display = "block";

                var wrap = document.getElementById('hd');
                wrap.style.display = "none";

            }, 3000);

            function tr_play(){

                var id = trde('<?php echo $id ?>');
                var play = document.getElementById('tt-play');
                play.style.display = "none";
                var wrap = document.getElementById('msg');
                wrap.style.display = "block";

                var iframe = document.createElement('iframe');
                iframe.id = 'MainPopupIframe';
                iframe.onload = function() { iframe.style.display = "block"; };
                iframe.src = '<?php echo $home; ?>&trhex='+id;
                iframe.setAttribute('allowFullScreen', '');
                document.body.appendChild(iframe);


            }
            
        </script>
    </body>
</html>
<?php } ?>