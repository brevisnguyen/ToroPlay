<?php

function trposts_func_theme( $atts ) {
    
    $return = '';
    
    $a = shortcode_atts( array(
        'cat' => '',
        'limit' => 10,
        'type' => '',
        'href' => '',
        'hover' => 1,
    ), $atts );
    
    $return .= '
    <ul'.tr_content_class(2, "MovieList NoLmtxt Rows AX A06 B04 C03 MovieListShortcode", false).'>';
    
        if( empty( $a['type'] ) ) {
            
            $args = array(

                'posts_per_page' => $a['limit'],
                'post_type' => array('movies', 'series'),
                'post_status' => 'publish',
                'cat' => $a['cat'],

            );
            
        }elseif( $a['type'] == 1 ){
    
            $args = array(

                'posts_per_page' => $a['limit'],
                'post_type' => 'movies',
                'post_status' => 'publish',
                'cat' => $a['cat'],

            );

        }elseif( $a['type'] == 2 ){
    
            $args = array(

                'posts_per_page' => $a['limit'],
                'post_type' => 'series',
                'post_status' => 'publish',
                'cat' => $a['cat'],

            );
            
        }

        $the_query = new WP_Query( $args );

        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $return .='
            <li class="TPostMv">
                <article id="post-'.get_the_ID().'" class="TPost C">
                    <a href="'.get_permalink().'">
                        <div class="Image">
                            <figure class="Objf TpMvPlay AAIco-play_arrow">'.tr_theme_img(get_the_ID(), 'thumbnail', get_the_title()).'</figure>
                            '.toroplay_entry_header(false, false, false, false, false, true, false, false, false).'
                        </div>
                        '.tr_title( 'titlelist', 'Title', false, get_the_title() ).'
                        '.toroplay_entry_header($show_rating=false, $show_year=2, $show_quality=false, $show_runtime=false, $show_views=false, $show_type=false, $single=true, false, false).'
                    </a>
                    '.tr_hover(false).'
                </article>
            </li>';

        }

        wp_reset_postdata();
               
    $return.='</ul>';
    
    if( $a['href'] != '' ) {
    
        $return.='<p><a href="'.$a['href'].'" class="Button">'.__('View more', 'toroplay').'</a></p>';
        
    }
    
    return $return;
}