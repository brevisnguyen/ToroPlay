<?php

function tr_related_episodes($post_id = NULL, $term_id = NULL) {
    
    $current_season = get_term_meta($term_id, 'season_number', true);
    $season_number_b = $current_season == 0 ? 'special' : $current_season;
    $episodes = tr_grabber_list_episodes( $post_id, $season_number_b );
    
    if( !isset( $episodes ) and empty( $episodes ) ) return;
        
    echo '
    <!--<Season-Episodes>-->
    <div class="Season-EpisodesCn">
        <div class="Season-Episodes owl-carousel Episodes">';

        foreach($episodes as $episode) {

                $class = $episode->term_id == $term_id ? ' episodeon' : '';

                $name = get_term_meta($episode->term_id, 'name', true) == '' ? '' : get_term_meta($episode->term_id, 'name', true);

                $current = get_term_meta($episode->term_id, 'episode_number', true)-1;
            
                $nseason = get_term_meta($episode->term_id, 'season_number', true) == 0 ? 0 : get_term_meta($episode->term_id, 'season_number', true);

                echo'
                <!--<TPostMv>-->
                <div class="TPostMv'.$class.'" data-current="'.$current.'">
                    <div class="TPost C">
                        <a href="'.get_term_link($episode->term_id).'">
                            <div class="Image">
                                <figure class="Objf TpMvPlay AAIco-play_arrow">
                                    '.tr_theme_img($episode->term_id, 'episode', $episode->name, 'episodes').'
                                    <figcaption><span class="ClB">'.$name.'</span>'.'</figcaption>
                                </figure>
                            </div>
                        </a>
                    </div>
                </div>
                <!--</TPostMv>-->
                ';

        }

    echo'
        </div>
    </div>
    <!--</Season-Episodes>-->
    ';
    
}

?>