<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'episodes_edit_form', 'show_links_episodes_custom_fields', 10, 2 );
add_action( 'edited_episodes', 'save_episodes_links', 10, 2 );

function save_episodes_links( $term_id ) {  

    $total = get_term_meta( $term_id, 'trgrabber_tlinks', true ) == '' ? 0 : get_term_meta( $term_id, 'trgrabber_tlinks', true )+1;
    if( $total > 0 and count( array_filter( $_POST['trgrabber_link'] ) ) < $total ) {
        for ($iii = 0; $iii <= $total; $iii++) { delete_term_meta( $term_id, 'trglinks_'.$iii ); }
        delete_term_meta( $term_id, 'trgrabber_tlinks' );
    }
    
    if( isset( $_POST['trgrabber_link'] ) and !empty( array_filter( $_POST['trgrabber_link'] ) ) > 0 ) {
        
        $i = 0; $count = ''; $array_links = array(); $server_id = array();
        
        foreach (  array_filter( $_POST['trgrabber_link'] ) as $key => $value ) {
                            
            preg_match( '@((https?://)?([-\\w]+\\.[-\\w\\.]+)+\\w(:\\d+)?(/([-\\w/_\\.]*(\\?\\S+)?)?)*)@', $_POST['trgrabber_link'][$i], $a );

            if(!empty($a[0])) {

                $url = wp_parse_url( str_replace( 'https://www.', 'https://' ,str_replace('http://www.', 'http://', $a[0]) ) );

                if( isset( $url['host'] ) ) {

                    $explode = explode('.', $url['host']);

                    $term_server = term_exists(ucwords( $explode[0] ), 'server');

                    if ($term_server !== 0 && $term_server !== null) {

                        $server_id[$i] = $term_server['term_id'];

                    } else {


                        $insert_server = wp_insert_term(ucwords( $explode[0] ), 'server', array());

                        $server_id[$i] = $insert_server['term_id'];

                    }

                }

            }else {

                $server_id[$i] = '';

            }
            
            if( isset( $_POST['trgrabber_lang'][$i] ) and !empty( $_POST['trgrabber_lang'][$i] ) ) {
                
                if( intval( $_POST['trgrabber_lang'][$i] ) ) {
                    $lang_id = intval( $_POST['trgrabber_lang'][$i] );
                }else {
                    
                    $term_lang = term_exists(ucwords( $_POST['trgrabber_lang'][$i] ), 'language');

                    if ($term_lang !== 0 && $term_lang !== null) {

                        $lang_id = $term_lang['term_id'];

                    } else {


                        $insert_lang = wp_insert_term(ucwords( $_POST['trgrabber_lang'][$i] ), 'language', array());

                        $lang_id = $insert_lang['term_id'];

                    }
                    
                }
                
            }
            
            if( isset( $_POST['trgrabber_quality'][$i] ) and !empty( $_POST['trgrabber_quality'][$i] ) ) {
                
                if( intval( $_POST['trgrabber_quality'][$i] ) ) {
                    $quality_id = intval( $_POST['trgrabber_quality'][$i] );
                }else {
                    
                    $term_quality = term_exists(ucwords( $_POST['trgrabber_quality'][$i] ), 'quality');

                    if ($term_quality !== 0 && $term_quality !== null) {

                        $quality_id = $term_quality['term_id'];

                    } else {


                        $insert_quality = wp_insert_term(ucwords( $_POST['trgrabber_quality'][$i] ), 'quality', array());

                        $quality_id = $insert_quality['term_id'];

                    }
                    
                }
                
            }
                                    
            $array_links[$i] = array(
                
                'type' => get_term_meta($server_id[$i], 'type', true) == '' ? $_POST['trgrabber_type'][$i] : get_term_meta($server_id[$i], 'type', true),
                'server' => empty($server_id[$i]) ? '' : $server_id[$i],
                'lang' => isset( $_POST['trgrabber_lang'][$i] ) ? $lang_id : '',
                'quality' => isset( $_POST['trgrabber_quality'][$i] ) ? $quality_id : '',
                'link' => isset( $_POST['trgrabber_link'][$i] ) ? base64_encode ( stripslashes( esc_textarea( $_POST['trgrabber_link'][$i] ) ) ) : '',
                'date' => !empty( $_POST['trgrabber_date'][$i] ) ? $_POST['trgrabber_date'][$i] : date('d').'/'.date('m').'/'.date('Y'),
                
            );
            
            if( isset($array_links[$i]['link']) and !empty($array_links[$i]['link']) ) { $count .= $i.','; update_term_meta( $term_id, 'trglinks_'.$i, serialize( $array_links[$i] ) ); }
            
            $i++;
            
        }
                
        if( isset( $count ) and !empty( $count ) ) update_term_meta( $term_id, 'trgrabber_tlinks', count( $array_links ) );
        
    }
    
}

function show_links_episodes_custom_fields($tag) {
    
    $t_id = $tag->term_id;
  
    echo '                
    <div class="links_options">
        <button id="trgrabber_addlink" type="button"><i class="dashicons dashicons-plus-alt"></i>'.__('Add link', 'tr-grabber').'</button>
        <button id="trgrabber_quiclinks" type="button"><i class="dashicons dashicons-plus-alt"></i>'.__('Quick Links', 'tr-grabber').'</button>
        <div class="lnkopcn">
            <div class="links_options_generate">
                <i class="dashicons dashicons-admin-links"></i>
                <input type="text" name="url_generate" placeholder="Enter url"><button id="trgrabber_generate" type="button" onclick="alert(\'Coming soon...\')">'.__('Generate', 'tr-grabber').'</button>
            </div>
            <div style="display:none" class="trgrabbernotsupport">'.__('URL INVALID', 'tr-grabber').'</div>
        </div>
    </div>

    <div class="TrGrabber-tblcn Blkcn">
        <table class="TrGrabber-tbl">
            <thead>
                <tr>
                    <th>'.__('Order', 'tr-grabber').'</th>
                    <th>'.__('Type', 'tr-grabber').'</th>
                    <th>'.__('Language', 'tr-grabber').'</th>
                    <th>'.__('Quality', 'tr-grabber').'</th>
                    <th>'.__('Link', 'tr-grabber').'</th>
                    <th>'.__('Options', 'tr-grabber').'</th>
                </tr>
            </thead>
            <tbody id="tr-grabber-content-links">';
    
    $links_total = get_term_meta( $t_id, 'trgrabber_tlinks', true ) == '' ? 0 : get_term_meta( $t_id, 'trgrabber_tlinks', true )-1;
    
    for ($i = 0; $i <= $links_total; $i++) {
        
        $link = unserialize ( get_term_meta( $t_id, 'trglinks_'.$i, true ) );
        
        $type = $link['type'] == '' ? 1 : $link['type'];
        
        $classa = $type == 1 ? ' current' : '';
        
        $classb = $type == 2 ? ' current' : '';
        
        $lang = $link['lang'] == '' ? 0 : $link['lang'];

        $quality = $link['quality'] == '' ? 0 : $link['quality'];

        $server = $link['server'] == '' ? 0 : $link['server'];
        
        $linkk = $link['link'] == '' ? '' : base64_decode( $link['link'] );

        $date = $link['date'] == '' ? '' : $link['date'];
        
        if( $link !='' or $links_total == 0 ) :
                    
            echo'
                    <tr class="tr-grabber-row">
                        <td class="moved"><span class="dashicons dashicons-sort"></span></td>
                        <td>
                            <ul class="StsOptns">
                                <li>
                                    <button class="trgrabberbt_a trgrabberbt_t'.$classa.'" data-id="1" type="button"><i class="dashicons dashicons-format-video"></i></button>
                                </li>
                                <li>
                                    <button class="trgrabberbt_b trgrabberbt_t'.$classb.'" data-id="2" type="button"><i class="dashicons dashicons-download"></i></button>
                                </li>
                            </ul>
                            <input type="hidden" name="trgrabber_type[]" value="'.$type.'">
                        </td>
                        <td>
                            <select name="trgrabber_lang[]">
                                <option value="">'.__('Select', 'tr-grabber').'</option>
                                '.tr_grabber_select_taxonomy('language', $lang).'
                            </select>                      
                        </td>
                        <td>
                            <select name="trgrabber_quality[]">
                                <option value="">'.__('Select', 'tr-grabber').'</option>
                                '.tr_grabber_select_taxonomy('quality', $quality).'                              
                            </select>
                        </td>
                        <td>
                            <input name="trgrabber_link[]" value="'.$linkk.'" type="text">
                        </td>
                        <td class="tdoptns">
                            <span class="edlnkbtn">
                                <button class="trgrabber_editlink button" type="button"><i class="dashicons dashicons-edit"></i></button>
                                <div>
                                    <input type="text" name="trgrabber_date[]" value="'.$date.'">
                                </div>
                            </span>
                            <button class="trgrabber_removelink button" type="button"><i class="dashicons dashicons-dismiss"></i></button>
                        </td>
                    </tr>';
        endif;
    }
    
    echo'
            </tbody>
        </table>
    </div>
    '; 
  
}