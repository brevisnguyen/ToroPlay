<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('wp_ajax_trgrabberlive', 'trgrabberlive');
add_action('wp_ajax_nopriv_trgrabberlive', 'trgrabberlive');

function trgrabberlive(){
        
    if( !wp_verify_nonce( $_POST['nonce'], 'trgrabberlive' ) ) {
        exit();
    }
    
    if( isset($_POST['action']) and $_POST['action']=='trgrabberlive' and empty( $_POST['type'] ) ) {
        
        $args = array(

            'posts_per_page' => '50',
            's' => $_POST['value'],
            'post_type' => array('movies', 'series')

        );

        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) {

            echo '<ul class="trselect trselect_text">';
            
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                    
                echo'<li data-val="'.get_the_title().'" data-value="'.get_the_ID().'"><label><button type="button">'.get_the_title().'</button></label></li>';
                
                wp_reset_postdata();
                
            }

            echo'</ul>';

        }else{
            echo '<p>'.__('There were no results. Try another search.', 'tr-grabber').'</p>';
        }
        
    }
    
    if( isset($_POST['action']) and $_POST['action']=='trgrabberlive' and isset( $_POST['type'] ) and $_POST['type'] == 2 ) { // valid form season
                
        if( get_post_status( intval( $_POST['serie_id'] ) ) === FALSE ) { $array['serie_id'] = __('The post does not exist.', 'tr-grabber'); }
        
        if( empty($_POST['tag-name']) ){ $array['name'] = __('You must enter a name.', 'tr-grabber'); }
        
        $seasons = tr_grabber_list_seasons( intval( $_POST['serie_id'] ) );
        
        $var = 0;
        
        foreach ($seasons as &$value) {
                        
            if( get_term_meta( $value->term_id, 'season_number', true ) == intval($_POST['season_number']) ) { $var = 1; }
            
        }
        
        if( $var == 1 ) {
            
            $array['season_number'] = __('The season already exists.', 'tr-grabber'); 
                       
        }elseif( empty($_POST['season_number']) ){

            $array['season_number'] = __('You must select a season.', 'tr-grabber'); 
            
        }
        
        // $term = term_exists( $_POST['tag-name'], 'seasons' );
        // if ( $term !== 0 && $term !== null ) {
        //     $array['tagname'] = __('There is already a season with this name.', 'tr-grabber'); 
        // }
        
        echo isset($array) ? json_encode($array) : '';
        
    }
    
    if( isset($_POST['action']) and $_POST['action']=='trgrabberlive' and isset( $_POST['type'] ) and $_POST['type'] == 3 ) { // valid form episodes

        if( get_post_status( intval( $_POST['serie_id'] ) ) === FALSE ) { $array['serie_id'] = __('The post does not exist.', 'tr-grabber'); }
        
        if( empty($_POST['tag-name']) ){ $array['name'] = __('You must enter a name.', 'tr-grabber'); }

        if( empty($_POST['season_number']) ){ $array['season_number'] = __('You must enter a season number.', 'tr-grabber'); }
                
        $episodes = tr_grabber_list_episodes( intval( $_POST['serie_id'] ) );
        
        $var = 0;
        
        foreach ($episodes as &$value) {
                        
            if( get_term_meta( $value->term_id, 'episode_number', true ) == intval($_POST['episode']) ) { $var = 1; }
            
        }
        
        if( $var == 1 ) {
            
            $array['episode'] = __('The episode already exists.', 'tr-grabber'); 
                       
        }elseif( empty($_POST['episode']) ){

            $array['episode'] = __('You must select a episode.', 'tr-grabber'); 
            
        }
        
        // $term = term_exists( $_POST['tag-name'], 'episodes' );
        // if ( $term !== 0 && $term !== null ) {
        //     $array['tagname'] = __('There is already a episode with this name.', 'tr-grabber'); 
        // }
        
        echo isset($array) ? json_encode($array) : '';
        
    }
    
    if( isset($_POST['action']) and $_POST['action']=='trgrabberlive' and isset( $_POST['type'] ) and $_POST['type'] == 4 ) { // select seasons
        
        $array = tr_grabber_list_seasons( intval( $_POST['value'] ) );

        if( isset( $array ) and !empty( $array ) ) {
            foreach ($array as &$value) {

                echo '<option value="'.get_term_meta( $value->term_id, 'season_number', true ).'">'.get_term_meta( $value->term_id, 'season_number', true ).'</option>';

            }
        }else{
            echo '<option value="">'.__('There were no results.', 'tr-grabber').'</option>';
        }
        
    }
    
    if( isset($_POST['action']) and $_POST['action']=='trgrabberlive' and isset( $_POST['type'] ) and $_POST['type'] == 5 ) { // select episodes

        $array = tr_grabber_list_episodes( intval($_POST['id']), intval( $_POST['value'] ) );

        if( isset( $array ) and !empty( $array ) ) {
            foreach ($array as &$value) {

                echo '<option value="'.get_term_meta( $value->term_id, 'episode_number', true ).'">'.get_term_meta( $value->term_id, 'episode_number', true ).'</option>';

            }
        }else{
            echo '<option value="">'.__('There were no results.', 'tr-grabber').'</option>';
        }
        
    }
    
    if( isset($_POST['action']) and $_POST['action']=='trgrabberlive' and isset( $_POST['type'] ) and $_POST['type'] == 6 ) { // submit links
        
        $explode = explode("\n", $_POST['links']);
                
        $counts = array_count_values($explode);
        $total = $counts['']+intval( $_POST['episode'] );
        
        for ($i = intval( $_POST['episode'] ); $i <= $total; $i++) {
            $list_episodes[] = $i;
        }
        
        $explode = array_replace($explode,
            array_fill_keys(
                array_keys($explode, ''),
                '---NEW---'
            )
        );
        
        $new = explode('---NEW---', json_encode($explode));
        $new = array_map(function($new) { return stripslashes(str_replace('"]', '', str_replace('","', '||', str_replace('["', '', $new)))); }, $new);
                
        $args = array(
            'relation' => 'AND',
            'episode_number' => array(
                'key' => 'episode_number',
                'compare' => 'IN',
                'value' => $list_episodes,
            ),
            'season_number' => array(
                'key' => 'season_number',
                'compare' => '=',
                'value' => intval( $_POST['season'] ),
            ),
        );

        $episodes_list = wp_get_post_terms(intval( $_POST['id'] ), 'episodes', array('orderby' => 'meta_value_num', 'order' => 'ASC', 'fields' => 'all', 'meta_query' => $args, ) );
        
        $ilinks = 0;
        
        foreach ($episodes_list as &$value) {
                        
            $total_links[$ilinks] = get_term_meta($value->term_id, 'trgrabber_tlinks', true);
                        
            foreach( array_filter(explode('||', $new[$ilinks])) as $key => $val) {
                                                                                
                $url = wp_parse_url( str_replace( 'https://www.', 'https://' ,str_replace('http://www.', 'http://', $val) ) );
                
                if( isset( $url['host'] ) ) {

                    $explode = explode('.', $url['host']);

                    $term_server = term_exists(ucwords( $explode[0] ), 'server');

                    if ($term_server !== 0 && $term_server !== null) {

                        $server_id[$ilinks] = $term_server['term_id'];
                        
                        $typ[$ilinks] = get_term_meta($server_id[$ilinks], 'type', true);
                        
                    } else {


                        $insert_server = wp_insert_term(ucwords( $explode[0] ), 'server', array());

                        $server_id[$ilinks] = $insert_server['term_id'];
                        
                        $typ[$ilinks] = intval($_POST['typel']);

                    }
                    
                }
                                
                $array_links = array(
                    
                    'type' => $typ[$ilinks],                
                    'server' => isset($server_id[$ilinks]) ? $server_id[$ilinks] : '',
                    'lang' => isset( $_POST['lang'] ) ? intval($_POST['lang']) : '',
                    'quality' => isset( $_POST['quality'] ) ? intval($_POST['quality']) : '',
                    'link' => isset( $val ) ? base64_encode ( stripslashes( esc_textarea( $val ) ) ) : '',
                    'date' => date('d').'/'.date('m').'/'.date('Y'),

                );
                                
                $sum_field = get_term_meta($value->term_id, 'trgrabber_tlinks', true) == '' ? 0 : get_term_meta($value->term_id, 'trgrabber_tlinks', true);
                $sum = $sum_field + 1;
                update_term_meta( $value->term_id, 'trglinks_'.$sum_field, serialize( $array_links ) );
                update_term_meta( $value->term_id, 'trgrabber_tlinks', $sum );
                                
            }
                                    
            $ilinks++;
        }
                
        echo json_encode(array( 'msj' => 1 ));
                
                                
    }
    
    wp_die();

}

?>