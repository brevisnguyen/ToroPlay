<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'edit_form_after_title', 'tr_grabber_movies_edit_form_after_title' );

function tr_grabber_movies_edit_form_after_title() {
    global $post, $pagenow;
        
    $post_type = filter_input(INPUT_GET, 'post_type');
    
    if ( tr_grabber_type() == 1 or tr_grabber_type() == 2 ) {
        
        if( !in_array( $pagenow, array( 'post.php' ) ) ) {
        
            if( tr_grabber_type( $post->ID ) == 2 ) {
                $url_example = 'https://www.themoviedb.org/tv/<strong>1418</strong>-the-big-bang-theory';
            }else{ 
                $url_example = 'https://www.themoviedb.org/movie/<strong>284052</strong>-doctor-strange';
            }

            echo '
            <div id="tmdb_grabber" class="tridfrm">
                <label for="trgrabber_id">
                    <span>TMDB <span>#ID</span></span>
                    <input name="trgrabber_id" id="trgrabber_id" type="text" value="">
                    <button type="button" name="trgrabber_api" class="tr_grabber_go"><i class="dashicons dashicons-yes"></i>'.__('Go', 'tr-grabber').'</button>
                </label>
                <span class="ttp" style="display:inline">
                    <span><span>'.__('EXAMPLE', 'tr-grabber').'</span>'.$url_example.'</span>
                    <i class="dashicons dashicons-warning"></i>
                </span>
            </div>
            ';
            
        }
        if( tr_grabber_type() == 2 ) {
                        
            $nseasons = tr_grabber_count_seasons($post->ID, false);
            $nepisodes = tr_grabber_count_episodes($post->ID, NULL, false);
            $list_seasons = tr_grabber_list_seasons( $post->ID );
            
            echo '<ul class="mbsroptns">';
                        
            if( get_post_meta( $post->ID, TR_GRABBER_FIELD_ID, true ) != '' or get_post_meta( $post->ID, 'field_imdbid', true ) ) {
                                
                $field_id = get_post_meta( $post->ID, TR_GRABBER_FIELD_ID, true ) == '' ? get_post_meta( $post->ID, 'field_imdbid', true ) : get_post_meta( $post->ID, TR_GRABBER_FIELD_ID, true );
                
                $txtseason = $nseasons == 0 ? __('Add seasons (API)', 'tr-grabber') : __('Update seasons (API)', 'tr-grabber');
                $txtepisode = $nepisodes == 0 ? __('Add episodes (API)', 'tr-grabber') : __('Update episodes (API)', 'tr-grabber');
                
                echo'
                    <li class="btnadss">
                        <a class="button btnldngep" id="updtseason" href="#" data-href="'.wp_nonce_url(admin_url('admin-ajax.php?action=grabberseasons&timdb='.$field_id.'&id='.$post->ID ), 'trstring', 'security').'"><i class="dashicons dashicons-plus"></i>'.$txtseason.'</a>
                    </li>';
                
                if( $nseasons > 0 ) {
                    echo'
                    <li class="btnadep sbmn">
                        <span class="button"><i class="dashicons dashicons-plus"></i>'.$txtepisode.' <span class="dashicons dashicons-arrow-down-alt2"></span></span>
                        <ul>';
                    
                        foreach(tr_grabber_list_seasons( $post->ID ) as $season_single) {
                            
                            $current = get_term_meta( $season_single->term_id, 'season_number', true ) == 0 ? ' current' : '';
                            $name_s_ep = get_term_meta( $season_single->term_id, 'season_number', true ) == 0 ? __('Special', 'tr-grabber') : sprintf( __('S%s', 'tr-grabber'), get_term_meta( $season_single->term_id, 'season_number', true ));
                            
                           echo '<li><a class="updtepsd'.$current.'" href="#" data-href="'.wp_nonce_url(admin_url('admin-ajax.php?action=grabberepisodes&timdb='.$field_id.'&id='.$post->ID.'&season='.get_term_meta( $season_single->term_id, 'season_number', true ) ), 'trstring', 'security').'">'.$name_s_ep.'</a></li>'; 

                        }
                    
                    echo'
                        </ul>
                    </li>';
                }
                
            }
                
            if( $nseasons > 0 and $nepisodes > 0 ) {
                echo'
                    <li class="btnqklk">
                        <button class="button" id="trgrabber_quiclinks" type="button"><i class="dashicons dashicons-admin-links"></i> '.__('Quick Links', 'tr-grabber').'</button>
                    </li>';
            }
            
            if( $nseasons > 0 ) {

            echo'
                <li class="btnvwss sbmn">
                    <a target="_blank" class="button" href="'.admin_url( 'edit-tags.php?taxonomy=seasons&tr_post_type=2&post_type=series&tr_id_post='.$post->ID ).'"><i class="dashicons dashicons-video-alt2"></i>'.__('View Seasons', 'tr-grabber').' <span class="dashicons dashicons-arrow-down-alt2"></span></a>
                    <ul>';

                        foreach($list_seasons as $season_single) {
                            
                            $current = get_term_meta( $season_single->term_id, 'season_number', true ) == 0 ? ' current' : '';
                            $name_s_ep = get_term_meta( $season_single->term_id, 'season_number', true ) == 0 ? __('Special', 'tr-grabber') : sprintf( __('S%s', 'tr-grabber'), get_term_meta( $season_single->term_id, 'season_number', true ));
                            
                           echo '<li><a target="_blank" href="'.admin_url( 'edit-tags.php?taxonomy=seasons&tr_post_type=2&post_type=series&tr_id_post='.$post->ID ).'&tr_season='.get_term_meta( $season_single->term_id, 'season_number', true ).'">'.$name_s_ep.'</a></li>'; 

                        }
            
            echo'
                    </ul>
                </li>';
            
            }
            
            if( $nseasons > 0 and $nepisodes > 0 ) {
            
            echo'
                <li class="btnvwep sbmn">
                    <a target="_blank" class="button" href="'.admin_url( 'edit-tags.php?taxonomy=episodes&tr_post_type=2&post_type=series&tr_id_post='.$post->ID ).'"><i class="dashicons dashicons-video-alt3"></i>'.__('View Episodes', 'tr-grabber').' <span class="dashicons dashicons-arrow-down-alt2"></span></a>
                    <ul>';

                        foreach($list_seasons as $season_single) {
                            
                            $current = get_term_meta( $season_single->term_id, 'season_number', true ) == 0 ? ' current' : '';
                            $name_s_ep = get_term_meta( $season_single->term_id, 'season_number', true ) == 0 ? __('Special', 'tr-grabber') : sprintf( __('S%s', 'tr-grabber'), get_term_meta( $season_single->term_id, 'season_number', true ));
                            
                           echo '<li><a target="_blank" href="'.admin_url( 'edit-tags.php?taxonomy=episodes&tr_post_type=2&post_type=series&tr_id_post='.$post->ID ).'&tr_season='.get_term_meta( $season_single->term_id, 'season_number', true ).'">'.$name_s_ep.'</a></li>'; 

                        }
            
            echo'
                    </ul>
                </li>';
                
            }
            
            echo'</ul>';
            
        }
    }
}

if( tr_grabber_type() == 1 ) {
    require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/movies/movies.php'); // movies
    require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/movies/links.php'); // links movies
}else{
    require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/series/series.php'); // series
}
require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/quick-links.php'); // quick links
require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/series/seasons.php'); // seasons
require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/series/episodes.php'); // episodes
require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/series/links-taxonomy.php'); // links series
require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/series/seasons-fields.php'); // custom fields seasons
require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/series/episodes-fields.php'); // custom fields episodes
require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/taxonomies/cast.php'); // custom fields cast
require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/taxonomies/server.php'); // custom fields server
require_once(TR_GRABBER_PLUGIN_DIR.'inc/panel/taxonomies/language.php'); // custom fields language