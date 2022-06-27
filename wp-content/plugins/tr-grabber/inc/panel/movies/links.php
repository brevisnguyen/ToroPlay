<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function show_links_meta_box() {
    global $post;
    
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
    
    $links_total = get_post_meta( $post->ID, 'trgrabber_tlinks', true ) == '' ? 0 : get_post_meta( $post->ID, 'trgrabber_tlinks', true )-1;
    
    for ($i = 0; $i <= $links_total; $i++) {
        
        $link = unserialize ( get_post_meta( $post->ID, 'trglinks_'.$i, true ) );
        
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