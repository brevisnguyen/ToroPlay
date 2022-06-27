<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tr_grabber_conver($template){

    if( isset($_GET['trupdate31']) and is_super_admin() ){
        $template = TR_GRABBER_PLUGIN_DIR.'inc/31.php';
    }

    return $template;

}

add_filter( "template_include", "tr_grabber_conver", 99 );

function grabberdbupdate_admin_notice() {
    global $config_grabber;
    if( TR_GRABBER_MSJ_UPDATE == 1 ) {
?>
    <div class="notice notice-error is-dismissible">
        <p><?php printf( __('To complete the update, you must update the database. %sMore Info%s', 'tr-grabber'), '<button class="button button-primary" id="tr-grabber-warning-upt" type="button">', '</button>'); ?></p>
        <p class="tr_grabber_continue" style="display:none">
            <?php printf( __('Before continuing, %sit is recommended%s that you make a backup of your website.', 'tr-grabber'), '<strong>', '</strong>'); ?>
            <a target="_blank" href="https://www.youtube.com/watch?v=6FcQGpMladU"><?php _e('Learn how to make a backup', 'tr-grabber'); ?></a>
            <?php _e('or', 'tr-grabber'); ?>
            <a id="update_db_trgrabber" href="#" data-href="<?php echo wp_nonce_url(admin_url('admin-ajax.php?action=grabberdbupdate'), 'trstring', 'security'); ?>"><?php _e('Continue update', 'tr-grabber'); ?></a>
        </p>
    </div>
    <?php
    }
    if( !isset($config_grabber['msj_update31']) ) {   
?>
    <div class="notice notice-error is-dismissible">
        <p><?php printf( __('To complete the update 3.1, you must update the database. %sMore Info%s', 'tr-grabber'), '<button class="button button-primary" id="tr-grabber-warning-upt" type="button">', '</button>'); ?></p>
        <p class="tr_grabber_continue" style="display:none">
            <?php printf( __('Before continuing, %sit is recommended%s that you make a backup of your website.', 'tr-grabber'), '<strong>', '</strong>'); ?>
            <a target="_blank" href="https://www.youtube.com/watch?v=6FcQGpMladU"><?php _e('Learn how to make a backup', 'tr-grabber'); ?></a>
            <?php _e('or', 'tr-grabber'); ?>
            <a target="_blank" href="<?php echo home_url('/?trupdate31=1'); ?>"><?php _e('Continue update 3.1', 'tr-grabber'); ?></a>
        </p>
    </div>
<?php
    }
}
add_action( 'admin_notices', 'grabberdbupdate_admin_notice' );

add_action( 'wp_ajax_grabberdbupdate', 'grabberdbupdate_function' );

function grabberdbupdate_function() {
        
    if (defined('TR_GRABBER_TIMELIMIT') && TR_GRABBER_TIMELIMIT) { set_time_limit( TR_GRABBER_TIMELIMIT ); }
    if (defined('TR_GRABBER_MEMOYLIMIT') && TR_GRABBER_MEMOYLIMIT) { ini_set('memory_limit', TR_GRABBER_MEMOYLIMIT); }
    
	check_ajax_referer( 'trstring', 'security' );
    
    $_GET['type'] = isset($_GET['type']) ? intval($_GET['type']) : 1;
    

        echo'<div class="ldngeps"><div class="loader loader--style1" title="0">
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
        </div>';
    
        if( isset($_GET['type']) and $_GET['type'] == 3 ){
            
            $ct = 1;
            
            $args = array(

                'posts_per_page' => 1,
                'post_type' => 'post',
                'paged' => $paged,

            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) {

                while ( $query->have_posts() ) {
                    $query->the_post();

                    $postt = get_post_meta(get_the_ID(), 'tr_post_type', true) == 2 ? 'series' : 'movies';

                    set_post_type( get_the_ID(), $postt );

                }
            }else{
                
                $ct = 0;
                
            }
            
            echo '
                <div class="trgrabber_loading">'.__('Loading', 'tr-grabber').'</div>
            ';
            
        }else{
    

            if( $_GET['type'] == 1 ) { // movies

                $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;

                $sum = $paged +1;

                $args_movies = array(

                    'posts_per_page' => 1,
                    'post_type' => 'post',
                    'paged' => $paged,

                );

                $query_movies = new WP_Query( $args_movies );

                $i = 0; $count = '';

                $number_of_pages = $query_movies->max_num_pages;

                if ( $query_movies->have_posts() ) {

                    while ( $query_movies->have_posts() ) {
                        $query_movies->the_post();

                        if( get_post_meta(get_the_ID(), TR_GRABBER_FIELD_TRAILER, true)!='' ) update_post_meta(get_the_ID(), TR_GRABBER_FIELD_TRAILER, esc_textarea( stripslashes( get_post_meta(get_the_ID(), TR_GRABBER_FIELD_TRAILER, true) ) ) );

                        $trmovieslinks = unserialize( get_post_meta( get_the_ID(), 'trmovieslink', true ) );

                        if( $trmovieslinks!='' ) {
                            foreach ($trmovieslinks as &$value) {

                                $array_links[$i] = array(

                                    'type' => isset($value['type']) ? $value['type'] : '',
                                    'server' => isset($value['server']) ? $value['server'] : '',
                                    'lang' => isset($value['lang']) ? $value['lang'] : '',
                                    'quality' => isset($value['quality']) ? $value['quality'] : '',
                                    'link' => isset($value['link']) ? base64_encode ( stripslashes( esc_textarea($value['link'] ) ) ) : '',
                                    'date' => isset($value['date']) ? $value['date'] : '',

                                );

                                if( isset($array_links[$i]['link']) and !empty($array_links[$i]['link']) ) { $count .= $i.','; update_post_meta( get_the_ID(), 'trglinks_'.$i, serialize( $array_links[$i] ) ); }

                                $i++;

                            }

                            if( isset( $count ) and !empty( $count ) ) update_post_meta( get_the_ID(), 'trgrabber_tlinks', count( $array_links ) ); delete_post_meta( get_the_ID(), 'trmovieslink' );

                        }

                        echo '<p class="ldngtx"><span id="content">'.$paged.' / '.$number_of_pages.'</span></p>';

                    }
                    wp_reset_postdata();

                }

            }else{ // series

                $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;

                $sum = $paged +1;
                $rest = $paged - 1;

                $per_page = 1;
                $number_of_series = wp_count_terms( 'episodes', array('hide_empty'=>'0') );;
                $offset = $per_page * $rest;

                $args = array(
                    'offset'       => $offset,
                    'number'       => $per_page,
                    'hide_empty' => 0
                );

                $mycategory = get_terms( 'episodes', $args );

                $number_of_pages = ceil( $number_of_series / $per_page );

                $count = ''; $i = 0;

                foreach($mycategory as $s) {

                    $trmovieslinks = unserialize( get_term_meta( $s->term_id, 'trmovieslink', true ) );
                    if( $trmovieslinks!='' ) {
                        for($ilnk = 0; $ilnk < count(unserialize($trmovieslinks['type'])); ++$ilnk) {

                            $type = unserialize($trmovieslinks['type'])[$ilnk];

                            $quality = unserialize($trmovieslinks['quality'])[$ilnk];

                            $lang = unserialize($trmovieslinks['lang'])[$ilnk];

                            $server = unserialize($trmovieslinks['server'])[$ilnk];

                            $date = unserialize($trmovieslinks['date'])[$ilnk];

                            $link = unserialize($trmovieslinks['link'])[$ilnk];

                            $array_links[$ilnk] = array(

                                'type' => isset($type) ? $type : '',
                                'server' => isset($server) ? $server : '',
                                'lang' => isset($lang) ? $lang : '',
                                'quality' => isset($quality) ? $quality : '',
                                'link' => isset($link) ? base64_encode ( stripslashes( esc_textarea( $link ) ) ) : '',
                                'date' => isset($date) ? $date : '',

                            ); 

                        }

                        if( isset( $array_links ) ) {


                            foreach ($array_links as &$value) {

                                if( isset($array_links[$i]['link']) and !empty($array_links[$i]['link']) ) { $count = $i; update_term_meta( $s->term_id, 'trglinks_'.$i, serialize( $array_links[$i] ) ); }

                                $i++;

                            }

                            $count = $count == 0 ? 0 : $count+1;

                            if( isset( $count ) and !empty( $count ) ) update_term_meta( $s->term_id, 'trgrabber_tlinks', $count+1 ); delete_term_meta( $s->term_id, 'trmovieslink' );

                        }

                    }

                    echo '<p class="ldngtx"><span id="content">'.$paged.' / '.$number_of_pages.'</span></p>';

                    $i++;
                }

            }   

            $div = round($paged / $number_of_pages*100);
            $div = empty($div) ? 0 : $div;

            echo '
                <div class="trgrabber_loading"><span class="grabberporc">'.$div.'%</span><span style="width:'.$div.'%;"></span></div></div>
            ';
        }
?>
<script type="text/javascript">
<?php if( $number_of_pages > $paged and $_GET['type'] != 3 ) { ?>
window.onload = function() {
    window.location.href = "<?php echo htmlspecialchars_decode(wp_nonce_url(admin_url('admin-ajax.php?action=grabberdbupdate&type='.intval($_GET['type']).'&paged='.$sum), 'trstring', 'security')); ?>";
}
<?php
}
    
if( $number_of_pages == $paged and $_GET['type'] == 1 ) {
?>
window.onload = function() {
    window.location.href = "<?php echo htmlspecialchars_decode(wp_nonce_url(admin_url('admin-ajax.php?action=grabberdbupdate&type=2'), 'trstring', 'security')); ?>";
}
<?php
}elseif( $number_of_pages == $paged and $_GET['type'] == 2 ) {
$config_grabber = get_option('tr_grabber') == '' ? '' : unserialize ( get_option('tr_grabber') );
$config_grabber['msj_update'] = 0;
update_option( "tr_grabber", serialize($config_grabber) );
?>
window.onload = function() {
    window.top.location.href = '<?php echo htmlspecialchars_decode(wp_nonce_url(admin_url('admin-ajax.php?action=grabberdbupdate&type=3'), 'trstring', 'security')); ?>';
}
<?php
}elseif( $_GET['type'] == 3 and $ct == 0 ) {
$config_grabber = get_option('tr_grabber') == '' ? '' : unserialize ( get_option('tr_grabber') );
$config_grabber['msj_update31'] = 1;
update_option( "tr_grabber", serialize($config_grabber) );
?>
window.onload = function() {
    window.top.location.href = '<?php echo htmlspecialchars_decode(admin_url('/')); ?>';
}
<?php
}elseif( $_GET['type'] == 3 and $ct == 1 ){
?>
window.onload = function() {
    window.top.location.href = '<?php echo htmlspecialchars_decode(wp_nonce_url(admin_url('admin-ajax.php?action=grabberdbupdate&type=3'), 'trstring', 'security')); ?>';
}
<?php
}
?>
</script>
<style>
    body{margin: 0;}
    .ldngeps{text-align: center;font-family: sans-serif;padding-top: 15px;}
    .trgrabber_loading,.trgrabber_loading span{border-radius: 15px;}
    .trgrabber_loading{position: relative;padding: 5px;background-color: #0072d6;}
    .trgrabber_loading span{display: block;min-height: 20px;line-height: 20px;font-size: 12px;font-weight: 700;box-shadow: inset 0 -10px 15px rgba(0,0,0,.2);box-shadow: inset 0 -10px 15px rgba(0,0,0,.2);background-color: rgba(0,0,0,.5);}
    .trgrabber_loading span.grabberporc{position: absolute;left: 0;right: 0;top: 5px;margin: auto;color: #fff;background: none;box-shadow: none;}
    .ldngtx #content{font-weight: 700;}
</style>
<?php
	wp_die();
}