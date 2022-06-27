<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tr_search_filter( $query ) {

    if ( !is_admin() && $query->is_search() && $query->is_main_query() && get_query_var('trfilter')!='' ) {
        $cat = ''; $cast = ''; $cast_tv = ''; $country = ''; $directors = ''; $directors_tv = ''; $quality = ''; $lang = ''; $server = ''; $years='';

        $geners_sql = isset($_GET['geners']) ? array_map('intval', $_GET['geners']) : '';
        $cast_sql = isset($_GET['casts']) ? array_map('intval', $_GET['casts']) : '';
        $countries_sql = isset($_GET['countries']) ? array_map('intval', $_GET['countries']) : '';
        $directors_sql = isset($_GET['trdirectors']) ? array_map('intval', $_GET['trdirectors']) : '';
        $quality_sql = isset($_GET['qualitys']) ? array_map('intval', $_GET['qualitys']) : '';
        $lang_sql = isset($_GET['langs']) ? array_map('intval', $_GET['langs']) : '';
        $server_sql = isset($_GET['servers']) ? array_map('intval', $_GET['servers']) : '';
        $years_sql = isset($_GET['years']) ? implode('|', array_map('intval', $_GET['years'])) : '';
                
        if($geners_sql!=''){
            $cat =  array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $geners_sql,
            );
        }

        if($quality_sql!=''){
            $quality =  array(
                'taxonomy' => 'quality',
                'field'    => 'term_id',
                'terms'    => $quality_sql,
            );
        }
        
        if($countries_sql!=''){
            $country =  array(
                'taxonomy' => 'countries',
                'field'    => 'term_id',
                'terms'    => $countries_sql,
            );
        }

        if($lang_sql!=''){
            $lang =  array(
                'taxonomy' => 'language',
                'field'    => 'term_id',
                'terms'    => $lang_sql,
            );
        }

        if($server_sql!=''){
            $server =  array(
                'taxonomy' => 'server',
                'field'    => 'term_id',
                'terms'    => $server_sql,
            );
        }

        if($cast_sql!=''){
            $cast =  array(
                'taxonomy' => 'cast',
                'field'    => 'term_id',
                'terms'    => $cast_sql,
            );
            
            $cast_tv =  array(
                'taxonomy' => 'cast_tv',
                'field'    => 'term_id',
                'terms'    => $cast_sql,
            );
        }

        if($directors_sql!=''){
            $directors =  array(
                'taxonomy' => 'directors',
                'field'    => 'term_id',
                'terms'    => $directors_sql,
            );
            
            $directors_tv =  array(
                'taxonomy' => 'directors_tv',
                'field'    => 'term_id',
                'terms'    => $directors_sql,
            );
        }
        
        if($years_sql!=''){

            $years = array(
                'key' => 'field_date',
                'value' => '^('.$years_sql.')-[0-9]{2}-[0-9]{2}',
                'compare' => 'REGEXP'
            );
            
        }

        $query->set( 's', '' );
        
        $query->set( 'posts_per_page', get_theme_mod('posts_per_search', 15) );
        
        $query->set( 'meta_query', array(
            $years
        ));

        $query->set( 'tax_query', array(
            
            'relation' => 'OR',
            $cast,
            $cast_tv,
            $directors,
            $directors_tv,
            array(
                'relation' => 'AND',
                    $cat,
                    $country,
                    $quality,
                    $lang,
                    $server
            ),
        ));

    }
}
add_action( 'pre_get_posts', 'tr_search_filter' );

add_action('wp_ajax_tr_live', 'tr_live');
add_action('wp_ajax_nopriv_tr_live', 'tr_live');

/**
 * LiveSearch filter
 */
function tr_live(){
        
    if( !wp_verify_nonce( $_POST['nonce'], 'tr-live' ) ) {
        exit();
    }
    
    if( isset($_POST['action']) and $_POST['action']=='tr_live' and isset($_POST['type']) ) {
        
        if( $_POST['type'] == 10 ) {
            
            $args = array(

                'posts_per_page' => 5,
                's' => $_POST['trsearch'],
                'post_type' => array('movies', 'series')

            );

            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) {
                echo '<ul class="MovieList">';
                while ( $the_query->have_posts() ) {
                  $the_query->the_post();
                    
                    echo'
                    <!--<Post>-->
                    <li>
                        <div class="TPost A">
                            <a href="'.get_permalink().'">
                                <div class="Image"><figure class="Objf TpMvPlay AAIco-play_arrow">'.tr_theme_img(get_the_ID(), 'widget', get_the_title()).'</figure></div>
                                <div class="Title">'.get_the_title().'</div>
                            </a>
                            <p class="Info">';
                                echo toroplay_entry_header($show_rating=true, $show_year=true, $show_quality=true, $show_runtime=true, $show_views=false, $show_type=false);
                    echo'
                            </p>
                        </div>
                    </li>
                    <!--</Post>-->';

                }
                echo '</ul>';
                if($the_query->found_posts>5){ echo '<a rel="nofollow" class="Button" href="'.esc_url( home_url( '/?s='.str_replace('-', '+', sanitize_title( $_POST['trsearch'] ) ) ) ).'">'.__('All results', 'toroplay').'</a>'; }
                wp_reset_postdata();
            }else{
                echo '
                <div class="error-404 not-found AAIco-sentiment_very_dissatisfied">
                    <p class="Top"><span class="Title">'.__('No results found.', 'toroplay').'</span></p>
                </div>
                ';
            }
            
        }else{
        
            $name = ''; $taxonomies = '';

            if( $_POST['type'] == 2 ) { $name = 'trdirectors'; $taxonomies = array('directors', 'directors_tv'); }
            if( $_POST['type'] == 3 ) { $name = 'casts'; $taxonomies = array('cast', 'cast_tv'); }
            if( $_POST['type'] == 4 ) { $name = 'countries'; $taxonomies = array('country'); }

            $type = intval( $_POST['type'] );

            $args = array(
                'taxonomy'      => $taxonomies,
                'orderby'       => 'name', 
                'order'         => 'ASC',
                'hide_empty'    => false,
                'fields'        => 'all',
                'trsearch'    => sanitize_title( $_POST['value'] )
            );

            $terms = get_terms( $args );

            $count = count($terms);

            if( $count > 0 ) {

                echo '<ul class="trselect trselect_text" data-name="'.$name.'" data-type="'.$type.'">';
                foreach ($terms as $term) {
                    echo '<li data-val="'.$term->name.'" data-value="'.$term->term_id.'"><label><button type="button">'.$term->name.'</button></label></li>';
                }
                echo '</ul>';

            }else{

                echo '<p class="tr-select-none tr-select-noneb">'.__('There were no results', 'toroplay').'</p>';

            }
            
        }
        
    }
    
    wp_die();

}

?>