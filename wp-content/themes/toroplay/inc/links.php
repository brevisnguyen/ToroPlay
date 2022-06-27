<?php

function tr_links_movies($post_id) {
    
    $links_total = get_post_meta( $post_id, 'trgrabber_tlinks', true ) == '' ? 0 : get_post_meta( $post_id, 'trgrabber_tlinks', true )-1;
    
    $links = array();
    
    if( isset( $links_total ) ){
        for ($i = 0; $i <= $links_total; $i++) {
            $link = unserialize ( get_post_meta( $post_id, 'trglinks_'.$i, true ) );
            
            $type = $link['type'] == '' ? 1 : $link['type'];
                        
            $lang = $link['lang'] == '' ? 0 : $link['lang'];

            $quality = $link['quality'] == '' ? 0 : $link['quality'];

            $server = $link['server'] == '' ? 0 : $link['server'];

            $linkk = $link['link'] == '' ? '' : trgrabber_base64de( $link['link'] );

            $date = $link['date'] == '' ? '' : $link['date'];
            
            if( $type == 1 and $linkk!='' ) {

                $links['online'][] = array(
                    
                    'i' => $i,
                    'lang' => $lang,
                    'quality' => $quality,
                    'server' => $server,
                    'link' => $linkk,
                    'date' => $date

                );

            }elseif( $linkk!='' ){

                $links['downloads'][] = array(

                    'i' => $i,
                    'lang' => $lang,
                    'quality' => $quality,
                    'server' => $server,
                    'link' => $linkk,
                    'date' => $date

                );

            }            
            
        }
        
        return $links;
    }
    
}

function tr_player_movies($links = NULL, $post_id=NULL) {
    
    if( isset($links) and is_array($links) ) {
        
        $i = 1;
        $content = ''; $tab = ''; $iframe = 'iframe';
        foreach ($links as &$value) {
                        
            $server_term = get_term( $value['server'], 'server' );
            $lang_term = get_term( $value['lang'], 'language' );
            $quality_term = get_term( $value['quality'], 'quality' );
            
            $server = $value['server'] == '' ? sprintf( __( 'Option %s', 'toroplay' ), '<strong>'.$i.'</strong>' ) : $server_term->name;
            $class = $i == 1 ? ' Current' : '';
            
            $quality_term->name = isset($quality_term->name) ? $quality_term->name : '';
            $lang_term->name = isset($lang_term->name) ? $lang_term->name : '';
            
            $details = $quality_term->name == '' ? '<span>'.$lang_term->name.'</span>' : '<span>'.$lang_term->name.' - '.$quality_term->name.'</span>';
            
            $tab_shortcode = tr_grabber_check_shortcode($value['link']) == '' ? ' data-shortcode="2"' : ' data-shortcode="1"';
            
            $tab .= '<li'.$tab_shortcode.' class="Button STPb'.$class.'" data-tplayernv="Opt'.$i.'"><span>'.$server.'</span>'.$details.'</li>';
            
            if( tr_grabber_check_shortcode($value['link']) ) {
                $div = $i == 1 ? do_shortcode(htmlspecialchars_decode($value['link'])) : do_shortcode(htmlspecialchars_decode($value['link']));
            }else{
                $div = $i == 1 ? '<'.$iframe.' width="560" height="315" src="'.esc_url( home_url( '/?trembed='.$value['i'].'&trid='.$post_id ) ).'&trtype=1" frameborder="0" allowfullscreen></'.$iframe.'>' : htmlentities ('<'.$iframe.' width="560" height="315" src="'.esc_url( home_url( '/?trembed='.$value['i'].'&trid='.$post_id ) ).'&trtype=1" frameborder="0" allowfullscreen></'.$iframe.'>');
            }
            
            $content .='<div class="TPlayerTb'.$class.'" id="Opt'.$i.'">'.$div.'</div>';
            
            $i++;
        }

        $cl = tr_banners('ads_player_inside', false, 2) == '' ? '' : ' on';
        
        echo '
        <!--<TPlayerNv>-->
        <ul class="TPlayerNv">'.$tab.'</ul>
        <!--</TPlayerNv>-->
        '.tr_banners('ads_player_top', false).'
        <!--<TPlayerCn>-->
        <div class="TPlayerCn BgA">
            <div class="EcBgA">
                <div class="TPlayer'.$cl.'">
                    '.tr_banners('ads_player_inside', false, 2).'
                    '.$content.'
                    <span class="btnsplyr">
                        <span class="AAIco-lightbulb_outline lgtbx-lnk lghtsof"></span>';
                        toroplay_post_info($post_id, '', '', $show='trailer');
        echo'
                    </span>
                    
                </div>
            </div>
        </div>
        <span class="lgtbx"></span>
        '.toroplay_msj_tab( 'msj_movies' ).'
        <!--</TPlayerCn>-->
        '.tr_banners('ads_player_bottom', false);
        
    }
    
}

function tr_links_episodes($term_id) {
    
    $links_total = get_term_meta( $term_id, 'trgrabber_tlinks', true ) == '' ? 0 : get_term_meta( $term_id, 'trgrabber_tlinks', true )-1;
    
    $links = array();
    
    if( isset( $links_total ) ){
        for ($i = 0; $i <= $links_total; $i++) {
            $link = unserialize ( get_term_meta( $term_id, 'trglinks_'.$i, true ) );
            
            $type = $link['type'] == '' ? 1 : $link['type'];
                        
            $lang = $link['lang'] == '' ? 0 : $link['lang'];

            $quality = $link['quality'] == '' ? 0 : $link['quality'];

            $server = $link['server'] == '' ? 0 : $link['server'];

            $linkk = $link['link'] == '' ? '' : trgrabber_base64de( $link['link'] );

            $date = $link['date'] == '' ? '' : $link['date'];
            
            if( $type == 1 and $linkk!='' ) {

                $links['online'][] = array(
                    
                    'i' => $i,
                    'lang' => $lang,
                    'quality' => $quality,
                    'server' => $server,
                    'link' => $linkk,
                    'date' => $date

                );

            }elseif( $linkk!='' ){

                $links['downloads'][] = array(

                    'i' => $i,
                    'lang' => $lang,
                    'quality' => $quality,
                    'server' => $server,
                    'link' => $linkk,
                    'date' => $date

                );

            }            
            
        }
        
        return $links;
    }
    
}

function tr_player_episodes($links = NULL, $term_id=NULL) {
    
    if( isset($links) and is_array($links) ) {
        
        $i = 1;
        $content = ''; $tab = ''; $iframe = 'iframe';
        foreach ($links as &$value) {
                        
            $server_term = get_term( $value['server'], 'server' );
            $lang_term = get_term( $value['lang'], 'language' );
            $quality_term = get_term( $value['quality'], 'quality' );
            
            $server = $value['server'] == '' ? sprintf( __( 'Option %s', 'toroplay' ), '<strong>'.$i.'</strong>' ) : $server_term->name;
            $class = $i == 1 ? ' Current' : '';
            
            $details = $quality_term->name == '' ? '<span>'.$lang_term->name.'</span>' : '<span>'.$lang_term->name.' - '.$quality_term->name.'</span>';
            
            $tab_shortcode = tr_grabber_check_shortcode($value['link']) == '' ? ' data-shortcode="2"' : ' data-shortcode="1"';
            
            $tab .= '<li'.$tab_shortcode.' class="Button STPb'.$class.'" data-tplayernv="Opt'.$i.'"><span>'.$server.'</span>'.$details.'</li>';

            if( tr_grabber_check_shortcode($value['link']) ) {
                $div = $i == 1 ? do_shortcode(htmlspecialchars_decode($value['link'])) : do_shortcode(htmlspecialchars_decode($value['link']));
            }else{
                $div = $i == 1 ? '<'.$iframe.' width="560" height="315" src="'.esc_url( home_url( '/?trembed='.$value['i'].'&trid='.$term_id ) ).'&trtype=2" frameborder="0" allowfullscreen></'.$iframe.'>' : htmlentities ('<'.$iframe.' width="560" height="315" src="'.esc_url( home_url( '/?trembed='.$value['i'].'&trid='.$term_id ) ).'&trtype=2" frameborder="0" allowfullscreen></'.$iframe.'>');
            }
            
            $content .='<div class="TPlayerTb'.$class.'" id="Opt'.$i.'">'.$div.'</div>';
            
            $i++;
        }
        
        $cl = tr_banners('ads_player_inside', false, 2) == '' ? '' : ' on';

        echo '
        <!--<TPlayerNv>-->
        <ul class="TPlayerNv">'.$tab.'</ul>
        <!--</TPlayerNv>-->
        '.tr_banners('ads_player_top', false).'
        <!--<TPlayerCn>-->
        <div class="TPlayerCn BgA">
            <div class="EcBgA">
                <div class="TPlayer'.$cl.'">
                    '.tr_banners('ads_player_inside', false, 2).'
                    '.$content.'
                    <span class="btnsplyr">
                        <span class="AAIco-lightbulb_outline lgtbx-lnk lghtsof"></span>';
                        toroplay_episode_info($term_id, '', '', $show='trailer');
        echo'
                    </span>
                </div>
            </div>
        </div>
        <span class="lgtbx"></span>
        '.toroplay_msj_tab().'
        <!--</TPlayerCn>-->
        '.tr_banners('ads_player_bottom', false);
        
    }
    
}

function tr_downloads_movies($links = NULL, $post_id=NULL) {
    
    if( isset($links) and is_array($links) ) {
        
        $i = 1;
        $content = '';
        foreach ($links as &$value) {
            
            // server
            $server_term = get_term( $value['server'], 'server' );
            $server_image = '';
            
            if( get_term_meta( $server_term->term_id, 'image', true ) != '' ) {
                
                $server_image = wp_get_attachment_url(get_term_meta( $server_term->term_id, 'image', true ));
                                
            }elseif( get_term_meta( $server_term->term_id, 'image_hotlink', true ) != '' and get_term_meta( $server_term->term_id, 'image', true ) == '' ) {
                
                $server_image = get_term_meta( $server_term->term_id, 'image_hotlink', true );
                
            }elseif( $value['link'] != '' ){
                
                $domain = parse_url( str_replace('http://', '//', $value['link'] ) );                
                $server_image = 'https://www.google.com/s2/favicons?domain='.$domain['host'];

            }
                        
            $server = $value['server'] == '' ? __('Unknown', 'toroplay') : '<img src="'.$server_image.'" alt="'.sprintf( __( 'Download %s', 'toroplay' ), $server_term->name ).'"> '.$server_term->name.'';
            
            // lang
            $lang_term = get_term( $value['lang'], 'language' );
            $lang_image = '';
            
            if( get_term_meta( $lang_term->term_id, 'image', true ) != '' ) {

                $lang_image = wp_get_attachment_url(get_term_meta( $lang_term->term_id, 'image', true ));
                
            }elseif( get_term_meta( $lang_term->term_id, 'image_hotlink', true ) != '' and get_term_meta( $lang_term->term_id, 'image', true ) == '' ) {
                
                $lang_image = get_term_meta( $lang_term->term_id, 'image_hotlink', true );
                
            }
            
            $lang_image = $lang_image == '' ? '' : '<img src="'.$lang_image.'" alt="'.sprintf( __( 'Image %s', 'toroplay' ), $lang_term->name ).'">';
            
            $lang = $lang_term->name == '' ? __('Unknown', 'toroplay') : $lang_image.$lang_term->name;
            
            // quality
            $quality_term = get_term( $value['quality'], 'quality' );
            $quality = $quality_term->name == '' ? __('Unknown', 'toroplay') : $quality_term->name;
                        
            $content.= '
            <tr>
                <td><span class="Num">'.$i.'</span></td>
                <td><a rel="nofollow" target="_blank" href="'.esc_url( home_url( '/?trdownload='.$value['i'].'&trid='.$post_id ) ).'" class="Button STPb">'.__('Download', 'toroplay').'</a></td>
                <td><span>'.$server.'</span></td>
                <td><span>'.$lang.'</span></td>
                <td><span>'.$quality.'</span></td>
            </tr>
            ';
            $i++;
        }
            
        echo '
        <!--<Links>-->
        <div class="Wdgt">
            '.tr_title('tp_links', 'Title', false).'
            <div class="TPTblCn">
                <table>
                    <thead>
                        <tr>
                            <th>'.__('#', 'toroplay').'</th>
                            <th>'.__('TYPE', 'toroplay').'</th>
                            <th>'.__('SERVER', 'toroplay').'</th>
                            <th>'.__('LANGUAGE', 'toroplay').'</th>
                            <th>'.__('QUALITY', 'toroplay').'</th>
                        </tr>
                    </thead>
                    <tbody>'.$content.'</tbody>
                </table>
            </div>
        </div>
        <!--</Links>-->';
            
    }
    
}

function tr_downloads_episodes($links = NULL, $term_id=NULL) {
    
    if( isset($links) and is_array($links) ) {
        
        $i = 1;
        $content = '';
        foreach ($links as &$value) {
            
            // server
            $server_term = get_term( $value['server'], 'server' );
            $server_image = '';
            
            if( get_term_meta( $server_term->term_id, 'image', true ) != '' ) {
                
                $server_image = wp_get_attachment_url(get_term_meta( $server_term->term_id, 'image', true ));
                                
            }elseif( get_term_meta( $server_term->term_id, 'image_hotlink', true ) != '' and get_term_meta( $server_term->term_id, 'image', true ) == '' ) {
                
                $server_image = get_term_meta( $server_term->term_id, 'image_hotlink', true );
                
            }elseif( $value['link'] != '' ){
                
                $domain = parse_url( str_replace('http://', '//', $value['link'] ) );                
                $server_image = 'https://www.google.com/s2/favicons?domain='.$domain['host'];

            }
                        
            $server = $value['server'] == '' ? __('Unknown', 'toroplay') : '<img src="'.$server_image.'" alt="'.sprintf( __( 'Download %s', 'toroplay' ), $server_term->name ).'"> '.$server_term->name.'';
            
            // lang
            $lang_term = get_term( $value['lang'], 'language' );
            $lang_image = '';
            
            if( get_term_meta( $lang_term->term_id, 'image', true ) != '' ) {

                $lang_image = wp_get_attachment_url(get_term_meta( $lang_term->term_id, 'image', true ));
                
            }elseif( get_term_meta( $lang_term->term_id, 'image_hotlink', true ) != '' and get_term_meta( $lang_term->term_id, 'image', true ) == '' ) {
                
                $lang_image = get_term_meta( $lang_term->term_id, 'image_hotlink', true );
                
            }
            
            $lang_image = $lang_image == '' ? '' : '<img src="'.$lang_image.'" alt="'.sprintf( __( 'Image %s', 'toroplay' ), $lang_term->name ).'">';
            
            $lang = $lang_term->name == '' ? __('Unknown', 'toroplay') : $lang_image.$lang_term->name;
            
            // quality
            $quality_term = get_term( $value['quality'], 'quality' );
            $quality = $quality_term->name == '' ? __('Unknown', 'toroplay') : $quality_term->name;
                        
            $content.= '
            <tr>
                <td><span class="Num">'.$i.'</span></td>
                <td><a rel="nofollow" target="_blank" href="'.esc_url( home_url( '/?trdownload='.$value['i'].'&trid='.$term_id ) ).'" class="Button STPb">'.__('Download', 'toroplay').'</a></td>
                <td><span>'.$server.'</span></td>
                <td><span>'.$lang.'</span></td>
                <td><span>'.$quality.'</span></td>
            </tr>
            ';
            $i++;
        }
            
        echo '
        <!--<Links>-->
        <div class="Wdgt">
            '.tr_title('tp_links', 'Title', false, $term_id).'
            <div class="TPTblCn">
                <table>
                    <thead>
                        <tr>
                            <th>'.__('#', 'toroplay').'</th>
                            <th>'.__('TYPE', 'toroplay').'</th>
                            <th>'.__('SERVER', 'toroplay').'</th>
                            <th>'.__('LANGUAGE', 'toroplay').'</th>
                            <th>'.__('QUALITY', 'toroplay').'</th>
                        </tr>
                    </thead>
                    <tbody>'.$content.'</tbody>
                </table>
            </div>
        </div>
        <!--</Links>-->';
            
    }
    
}

?>