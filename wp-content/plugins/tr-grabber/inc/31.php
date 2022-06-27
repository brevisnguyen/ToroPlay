<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<html>
<head>
<meta charset="utf-8">
<title>ToroThemes</title>
<style>
    body{margin: 0;}
    .ldngeps{text-align: center;font-family: sans-serif;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-flex-direction: row;-ms-flex-direction: row;flex-direction: row;-webkit-justify-content: center;-ms-flex-pack: center;justify-content: center;-webkit-align-items: center;-ms-flex-align: center;align-items: center;min-height: 100vh;}
    .trgrabber_loading,.trgrabber_loading span{border-radius: 15px;}
    .trgrabber_loading{position: relative;padding: 5px;background-color: #0072d6;}
    .trgrabber_loading span{display: block;min-height: 20px;line-height: 20px;font-size: 12px;font-weight: 700;box-shadow: inset 0 -10px 15px rgba(0,0,0,.2);box-shadow: inset 0 -10px 15px rgba(0,0,0,.2);background-color: rgba(0,0,0,.5);}
    .trgrabber_loading span.grabberporc{position: absolute;left: 0;right: 0;top: 5px;margin: auto;color: #fff;background: none;box-shadow: none;}
    .ldngtx #content{font-weight: 700;}    
</style>
</head>
<body>

<div class="ldngeps">
    <div class="loader loader--style1" title="0">
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
        <path opacity="0.2" fill="#0072d6" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
        s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
        c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
        <path fill="#0072d6" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
        C22.32,8.481,24.301,9.057,26.013,10.047z">
        <animateTransform attributeType="xml"
        attributeName="transform"
        type="rotate"
        from="0 20 20"
        to="360 20 20"
        dur="0.5s"
        repeatCount="indefinite"/>
        </path>
        </svg>
        <p class="ldngtx"><span id="content">Loading, please wait.</span></p>
    </div>
</div>

<?php
    $lastposts = get_posts( array(
        'numberposts' => 30,
        'post_type' => 'post'
    ) );

    if ( $lastposts ) {
        foreach ( $lastposts as $post ) :
            setup_postdata( $post );

        $postt = get_post_meta(get_the_ID(), 'tr_post_type', true) == 2 ? 'series' : 'movies';
            
        set_post_type( get_the_ID(), $postt );

        endforeach; 
        wp_reset_postdata();
    }

if( $lastposts ) {
?>
<script type="text/javascript">
window.onload = function() {
   setTimeout(function () {
       window.location.href = '<?php echo home_url('/?trupdate31=1'); ?>'; 
    }, 10000);
}
</script>
<?php
}else{
    $config_grabber = get_option('tr_grabber') == '' ? '' : unserialize ( get_option('tr_grabber') );
    $config_grabber['msj_update31'] = 0;
    $config_grabber['hideframes'] = 0;
    $config_grabber['hidetitle'] = __('TOROTHEMES PLAYER', 'tr-grabber');
    $config_grabber['hidemsg'] = __('Checking that you are not a bot', 'tr-grabber');
    $config_grabber['hideimg'] = 'https://image.tmdb.org/t/p/w780/mhdeE1yShHTaDbJVdWyTlzFvNkr.jpg';
    $config_grabber['hideopenload'] = 1;
    $config_grabber['hidestreamango'] = 1;
    $config_grabber['hidevidoza'] = 1;
    $config_grabber['hidestreamplay'] = 1;
    $config_grabber['hideflashx'] = 1;
    $config_grabber['hidestreamcherry'] = 1;
    $config_grabber['hidethevideo'] = 1;
    $config_grabber['hidecolor'] = '#9c27b0';
    update_option( "tr_grabber", serialize($config_grabber) );
?>
<script type="text/javascript">
window.onload = function() {
    window.top.location.href = '<?php echo htmlspecialchars_decode(admin_url('/')); ?>';
}
</script>
<?php
}
?>
</body>
</html>