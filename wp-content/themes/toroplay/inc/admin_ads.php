<?php
/* Manament Ads */

function tr_ads_theme_menu() {
  add_theme_page( __('Ads Manager', 'toroplay'), __('Ads Manager', 'toroplay'), 'manage_options', 'tr_ads', 'tr_ads_page');  
}
add_action('admin_menu', 'tr_ads_theme_menu');

function tr_ads_page() {
    
    $ok = ''; $ads = array(''); $ar_ads = array('');
    
    $_POST['ads'] = empty($_POST['ads']) ? '' : $_POST['ads'];
    
    if(isset($_POST['submit'])) {
        
        foreach((array)$_POST['ads'] as $item) {
            
            $ads_a = isset($_POST[$item.'_d']) ? $_POST[$item.'_d'] : '';
            $ads_b = isset($_POST[$item.'_m']) ? $_POST[$item.'_m'] : '';                
                
            $ar_ads[$item]=array( 'desktop' => $ads_a, 'mobile' => $ads_b );
            
        }
        
        update_option('tr_ads_toroplay', serialize( array_filter($ar_ads) ) );
        
        $ok.= '<p class="trmsjok">'.__('Changes have been saved successfully.', 'toroplay').'</p>';
        
    }
    
    $args_series = array(
        'post_type' => 'post',
        'orderby' => 'rand',
        'numberposts' => 1,
        'meta_query' => array(
            array(
                  'key' => 'tr_post_type', 
                  'compare' => '=',
                  'value' => 2
            ),
        )
    );
    
    $link_series = '';
    
    $posts_series = get_posts( $args_series );
    foreach($posts_series as $post_series) {
        $link_series = get_permalink($post_series);
    }
    
    $args_movies = array(
        'post_type' => 'post',
        'orderby' => 'rand',
        'numberposts' => 1,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'tr_post_type',
                'value' => false,
                'type' => 'BOOLEAN'
            ),
            array(
                'key' => 'tr_post_type',
                'compare' => 'NOT EXISTS'
            )
        ),
    );
    
    $link_movies = '';
    
    $posts_movies = get_posts( $args_movies );
    foreach( $posts_movies as $post_movies ) {
        $link_movies = get_permalink($post_movies);
    }
    
    $term_link_episode = get_terms('episodes', 'orderby=name&number=1');
    
    $link_episode = isset($term_link_episode[0]->term_id) ? get_term_link( $term_link_episode[0]->term_id ) : '';
    
    $term_link_season = get_terms('seasons', 'orderby=name&number=1');
    
    $link_season = isset($term_link_season[0]->term_id) ? get_term_link( $term_link_season[0]->term_id ) : '';
    
    $ads = unserialize(get_option('tr_ads_toroplay'));
        
    $array = array(
    
        'ads_hd_bt' => array ( 'title' => __('Header Bottom', 'toroplay'), 'value' => isset($ads['ads_hd_bt']) ? $ads['ads_hd_bt']['desktop'] : '', 'value_m' => isset($ads['ads_hd_bt']['mobile']) ? $ads['ads_hd_bt']['mobile'] : '', 'preview' => esc_url( home_url( '/?preview_bnr=1#ads_hd_bt' ) ) ),
        
        'ads_list_top' => array ( 'title' => __('Top List', 'toroplay'), 'value' => isset($ads['ads_list_top']) ? $ads['ads_list_top']['desktop'] : '', 'value_m' => isset($ads['ads_list_top']['mobile']) ? $ads['ads_list_top']['mobile'] : '', 'preview' => esc_url( home_url( '/?preview_bnr=1#ads_list_top' ) ) ),

        'ads_list_bottom' => array ( 'title' => __('Bottom List', 'toroplay'), 'value' => isset($ads['ads_list_bottom']) ? $ads['ads_list_bottom']['desktop'] : '', 'value_m' => isset($ads['ads_list_bottom']['mobile']) ? $ads['ads_list_bottom']['mobile'] : '', 'preview' => esc_url( home_url( '/?preview_bnr=1#ads_list_bottom' ) ) ),
        
        'ads_singlem_top' => array ( 'title' => __('Single Movies Top', 'toroplay'), 'value' => isset($ads['ads_singlem_top']) ? $ads['ads_singlem_top']['desktop'] : '', 'value_m' => isset($ads['ads_singlem_top']['mobile']) ? $ads['ads_singlem_top']['mobile'] : '', 'preview' => esc_url(  $link_movies.'?preview_bnr=1#ads_singlem_top' ) ),
        
        'ads_singlem_bottom' => array ( 'title' => __('Single Movies Bottom', 'toroplay'), 'value' => isset($ads['ads_singlem_bottom']) ? $ads['ads_singlem_bottom']['desktop'] : '', 'value_m' => isset($ads['ads_singlem_bottom']['mobile']) ? $ads['ads_singlem_bottom']['mobile'] : '', 'preview' => esc_url( $link_movies.'?preview_bnr=1#ads_singlem_bottom' ) ),
        
        'ads_singlet_top' => array ( 'title' => __('Single Series Top', 'toroplay'), 'value' => isset($ads['ads_singlet_top']) ? $ads['ads_singlet_top']['desktop'] : '', 'value_m' => isset($ads['ads_singlet_top']['mobile']) ? $ads['ads_singlet_top']['mobile'] : '', 'preview' => esc_url(  $link_series.'?preview_bnr=1#ads_singlet_top' ) ),
        
        'ads_singlet_bottom' => array ( 'title' => __('Single Series Bottom', 'toroplay'), 'value' => isset($ads['ads_singlet_bottom']) ? $ads['ads_singlet_bottom']['desktop'] : '', 'value_m' => isset($ads['ads_singlet_bottom']['mobile']) ? $ads['ads_singlet_bottom']['mobile'] : '', 'preview' => esc_url( $link_series.'?preview_bnr=1#ads_singlet_bottom' ) ),
        
        'ads_singlep_top' => array ( 'title' => __('Single Episode Top', 'toroplay'), 'value' => isset($ads['ads_singlep_top']) ? $ads['ads_singlep_top']['desktop'] : '', 'value_m' => isset($ads['ads_singlep_top']['mobile']) ? $ads['ads_singlep_top']['mobile'] : '', 'preview' => esc_url(  $link_episode.'?preview_bnr=1#ads_singlep_top' ) ),
        
        'ads_singlep_bottom' => array ( 'title' => __('Single Episode Bottom', 'toroplay'), 'value' => isset($ads['ads_singlep_bottom']) ? $ads['ads_singlep_bottom']['desktop'] : '', 'value_m' => isset($ads['ads_singlep_bottom']['mobile']) ? $ads['ads_singlep_bottom']['mobile'] : '', 'preview' => esc_url( $link_episode.'?preview_bnr=1#ads_singlep_bottom' ) ),
        
        'ads_singles_top' => array ( 'title' => __('Single Season Top', 'toroplay'), 'value' => isset($ads['ads_singles_top']) ? $ads['ads_singles_top']['desktop'] : '', 'value_m' => isset($ads['ads_singles_top']['mobile']) ? $ads['ads_singles_top']['mobile'] : '', 'preview' => esc_url(  $link_season.'?preview_bnr=1#ads_singles_top' ) ),
        
        'ads_singles_bottom' => array ( 'title' => __('Single Season Bottom', 'toroplay'), 'value' => isset($ads['ads_singles_bottom']) ? $ads['ads_singles_bottom']['desktop'] : '', 'value_m' => isset($ads['ads_singles_bottom']['mobile']) ? $ads['ads_singles_bottom']['mobile'] : '', 'preview' => esc_url( $link_season.'?preview_bnr=1#ads_singles_bottom' ) ),
        
        'ads_player_top' => array ( 'title' => __('Single Player Top', 'toroplay'), 'value' => isset($ads['ads_player_top']) ? $ads['ads_player_top']['desktop'] : '', 'value_m' => isset($ads['ads_player_top']['mobile']) ? $ads['ads_player_top']['mobile'] : '', 'preview' => esc_url(  $link_movies.'?preview_bnr=1#ads_player_top' ) ),
        
        'ads_player_bottom' => array ( 'title' => __('Single Player Bottom', 'toroplay'), 'value' => isset($ads['ads_player_bottom']) ? $ads['ads_player_bottom']['desktop'] : '', 'value_m' => isset($ads['ads_player_bottom']['mobile']) ? $ads['ads_player_bottom']['mobile'] : '', 'preview' => esc_url(  $link_movies.'?preview_bnr=1#ads_player_bottom' ) ),
        
        'ads_player_inside' => array ( 'title' => __('Single Player Inside', 'toroplay'), 'value' => isset($ads['ads_player_inside']) ? $ads['ads_player_inside']['desktop'] : '', 'value_m' => isset($ads['ads_player_inside']['mobile']) ? $ads['ads_player_inside']['mobile'] : '', 'preview' => esc_url(  $link_movies.'?preview_bnr=1#ads_player_inside' ) ),
        
    );

    echo '
    <div id="tr-dvrmngr" class="wrap">
    <h1>'.__('Ads Manager', 'toroplay').'</h1>
    
    '.$ok.'
    
    <p>'.__('Manage ads on your site easily. Remember that if you add desktop ads they will not be seen on mobile unless you also add it on mobile. Keep in mind that if you exceed 300px wide and your banner is not responsive it will not fit well to all screens.', 'toroplay').'</p>
        
    <div class="tr_ads_admin">
    
        <form action="themes.php?page=tr_ads" method="post">
        
        <ul class="dvrmngr-list">';
    
        foreach ($array as $key => $value) {
            
            echo'
                <li>
                    <p>'.$value['title'].' <span><a target="_blank" href="'.esc_url($value['preview']).'">'.__('Preview', 'toroplay').'</a></span></p>
                    <span class="trads_type"><button data-id="'.$key.'" class="trads_type_a button current" type="button">'.__('Desktop', 'toroplay').'</button> <button data-id="'.$key.'" class="trads_type_b button" type="button">'.__('Mobile', 'toroplay').'</button></span>
                    <textarea placeholder="'.__('Insert code here', 'toroplay').'" class="'.$key.'_d" name="'.$key.'_d">'.esc_textarea(stripslashes($value['value'])).'</textarea>
                    <textarea placeholder="'.__('Insert code here', 'toroplay').'" class="'.$key.'_m" style="display:none" name="'.$key.'_m">'.esc_textarea(stripslashes($value['value_m'])).'</textarea>
                    <input type="hidden" name="ads[]" value="'.$key.'">
                </li>';
            
        }
                
    echo'
        </ul>
        
        <button name="submit" type="submit" class="button button-primary">'.__('Save changes', 'toroplay').'</button>
        
        </form>
        
    </div>
    </div>
    ';
    
}

?>