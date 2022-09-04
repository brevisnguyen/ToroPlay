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
    <style>body,html,.Video,iframe{width: 100%;height: 100%;margin: 0;font-size: 0;}</style>
    <style>.ads_logo{position: absolute;top: 20px;left: 15px;z-index: 999;} .ads_logo img{max-width: 80px;}</style>
    <script type="text/javascript" src="<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/jwplayer.js' ?>"></script>
    <script type="text/javascript" src="<?php echo TR_GRABBER_PLUGIN_URL . 'player/js/jquery.min.js' ?>"></script>
    <script type="text/javascript">jwplayer.key = "vSKJmhF1qg3zjWCGEJ5DGbxaC31v99AbL0hP6HqpZ5E="</script>
</head>
<body oncontextmenu="return false;">

    <div id="playerjw7" class="Video">
        <iframe width="560" height="315" src="<?php echo $link ?>" frameborder="0" allowfullscreen></iframe>
    </div>

</body>
</html>