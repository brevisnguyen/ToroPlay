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
    $link = '<iframe width="560" height="315" src="'.$link.'" frameborder="0" allowfullscreen></iframe>';
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
</head>
<body oncontextmenu="return false;">
    
    <div class="Video"><?php echo $link; ?></div>
    
</body>
</html>