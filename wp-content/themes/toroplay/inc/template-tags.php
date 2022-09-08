<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ToroPlay
 */

if ( ! function_exists( 'toroplay_entry_header' ) ) :
	/**
	 * Prints HTML with meta information for ratings, year, quality, duration and views.
	 */
	function toroplay_entry_header($show_rating=true, $show_year=true, $show_quality=true, $show_runtime=true, $show_views=true, $show_type = false, $single = false, $show_status = false, $display = TRUE ) {
        global $post;
        
        $return = '';
        
        if( $show_type == true ){ $return.=tr_icon_tv($post->ID, false); }
        
        if(function_exists('the_ratings') and $show_rating==true) {
            $return.= '<span class="Vote AAIco-star">'.tr_rating_format_number($post->ID).'</span>';   
        }
         
        if($show_runtime==true){
            $runtime_field = get_post_meta($post->ID, TR_GRABBER_FIELD_RUNTIME, true);
			$runtime_field = is_array($runtime_field) ? array_filter($runtime_field) : $runtime_field;
            
            if(tr_check_type($post->ID)==2 and is_array($runtime_field) and !empty( $runtime_field ) ) {
                $runtime_field = implode('m, ', $runtime_field);
            }elseif(tr_check_type($post->ID)==2 and !is_array($runtime_field) and !empty( $runtime_field ) ){
                $runtime_field = implode('m, ', explode(',', $runtime_field));
            }else{
                $runtime_field = $runtime_field;
            }

            if($runtime_field!='' and !is_array($runtime_field)){
                $return.= '<span class="Time AAIco-access_time">'.$runtime_field.'</span>';
            }  
        }
        
        if( $show_year==true ){
            $date_field = get_post_meta($post->ID, TR_GRABBER_FIELD_DATE, true);
            $date_field_year = $date_field;
            if($date_field!=''){
                $date_field = explode('-', $date_field);
                $date_field_year = $date_field['0'] == '' ? '' : $date_field['0'];
                $return.= $single == true ? '<span class="Year">'.$date_field_year.'</span>' : '<span class="Date AAIco-date_range">'.$date_field_year.'</span>';
            }
        }
        
        if(function_exists('the_views') and $show_views==true) {
            $return.= '<span class="Views AAIco-remove_red_eye">'.the_views(false).'</span>';
        }
        
        if( $show_quality==true ) {
            $total_links = get_post_meta( $post->ID, 'trgrabber_tlinks', true );
            if( get_theme_mod('quality', 1) == 1 and is_numeric( $total_links ) ) { $quality_total = $total_links-1; }else{ $quality_total = 0; }
            $links = unserialize(get_post_meta($post->ID, 'trglinks_'.$quality_total, true));
            if(isset($links['quality'])){
                $quality = get_term_by( 'id', $links['quality'], 'quality' );

                $return.= '<span class="Qlty">'.$quality->name.'</span>';

            }
        }
        
        if($show_status==true){

            $return.= get_post_meta($post->ID, TR_GRABBER_FIELD_STATUS, true) != '' ? '<span class="Qlty">'.get_post_meta($post->ID, TR_GRABBER_FIELD_STATUS, true).'</span>' : '';
        }
        
        if( $display == TRUE ){ echo $return; }else{ return $return; }

	}
endif;

if ( ! function_exists( 'toroplay_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags, cast and directors.
	 */
	function toroplay_entry_footer($show_tags=true, $limit=0, $show_cat=true, $show_directors=true, $show_cast=true, $display = TRUE ) {
        global $post;
        
        $return = '';
        
        if($show_cat==true) {
        
        $array_cat = array(); $more = '';
            
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category($post->ID);
        if ( $categories_list ) {
            $i_cat = 1;
            foreach($categories_list as $cat_single) {
                $array_cat[]='<a href="'.get_term_link($cat_single->term_id, 'category').'">'.$cat_single->name.'</a>';
                if($i_cat==$limit and $limit>0){ $more = ' ...'; break; }
                $i_cat++;
            }
            /* translators: 1: list of categories. */
            $return.= sprintf( '<p class="Genre AAIco-movie_creation">' . esc_html__( '%1$sGenre:%2$s %3$s', 'toroplay' ) . '</p>', '<span>', '</span>', implode(', ', array_filter($array_cat)).$more ); // WPCS: XSS OK.
        }
        
        }
        
        if($show_directors==true){
            
        /* translators: used between list items, there is a space after the comma */

        $array_directors = array(''); $more = '';
        
        if(tr_check_type($post->ID)==2){ $taxonomy_directors = 'directors_tv'; }else{ $taxonomy_directors = 'directors'; }
        
        $term_list_directors = wp_get_post_terms($post->ID, $taxonomy_directors, array("fields" => "all"));
        
        if(!is_wp_error($term_list_directors) and !empty($term_list_directors)) {
            $i_director = 1;
            foreach($term_list_directors as $director_single) {
                $array_directors[]='<a href="'.get_term_link($director_single->term_id, $taxonomy_directors).'">'.$director_single->name.'</a>';
                if($i_director==$limit and $limit>0){ $more = ' ...'; break; }
                $i_director++;
            }
            /* translators: 1: list of categories. */            
            $return.= sprintf( '<p class="Director AAIco-videocam">' . esc_html__( '%1$sDirector:%2$s %3$s', 'toroplay' ) . '</p>', '<span>', '</span>', implode(', ', array_filter($array_directors)).$more ); // WPCS: XSS OK.
            
        }
            
        }
        
        if($show_tags==true){
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'toroplay' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            $return.= sprintf( '<p class="Genre AAIco-movie_creation">' . esc_html__( '%1$sTags:%2$s %3$s', 'toroplay' ) . '</p>', '<span>', '</span>', $tags_list ); // WPCS: XSS OK.
        }
        }
        
        if($show_cast==true){
        
        /* translators: used between list items, there is a space after the comma */
        
        $array_cast = array(''); $more = '';
        
        if(tr_check_type($post->ID)==2){ $taxonomy_cast = 'cast_tv'; }else{ $taxonomy_cast = 'cast'; }
                
        $term_list_cast = wp_get_post_terms($post->ID, $taxonomy_cast, array("fields" => "all"));
                
        if(!is_wp_error($term_list_cast) and !empty($term_list_cast)) {
            $i_cast = 1;
            foreach($term_list_cast as $cast_single) {
                $array_cast[]='<a href="'.get_term_link($cast_single->term_id, $taxonomy_cast).'">'.$cast_single->name.'</a>';
                if($i_cast==$limit and $limit>0){ $more = ' ...'; break; }
                $i_cast++;
            }
            /* translators: 1: list of categories. */
            if(is_single()){
                $return.= sprintf(  esc_html__( '%1$sCast:%2$s %3$s', 'toroplay' ), '<section class="CastCn"><div class="Top AAIco-group"><div class="Title">', '</div><span class="Button Sm AATggl CastLink" data-tggl="CastUl"><span>'.__('View More', 'toroplay').'</span><span>'.__('View Less', 'toroplay').'</span></span></div>', '<ul id="CastUl" class="CastList Rows AX A06 B04 C03 D04 E03"><li>'.implode('</li><li>', array_filter($array_cast)).'</li></ul></section>' );
            }else{
                $return.= sprintf( '<p class="Actors AAIco-person">' . esc_html__( '%1$sCast:%2$s %3$s', 'toroplay' ) . '</p>', '<span>', '</span>', implode(', ', array_filter($array_cast)).$more ); // WPCS: XSS OK.
            }
            
        }
            
        }

        if( $display == TRUE ){ echo $return; }else{ return $return; }
        
	}
endif;

if ( ! function_exists( 'toroplay_letters_header' ) ) :
	/**
	 * Prints HTML with meta information for letters.
	 */
	function toroplay_letters_header($show_quality=false, $show_runtime=false, $show_year=false) {
        global $post;
        
        if( $show_quality == true ) {
            $total_links = get_post_meta( $post->ID, 'trgrabber_tlinks', true );
            if( get_theme_mod('quality', 1) == 1 and is_numeric( $total_links ) ) { $quality_total = $total_links-1; }else{ $quality_total = 0; }
            $links = unserialize(get_post_meta($post->ID, 'trglinks_'.$quality_total, true));
            if(isset($links['quality'])){
                $quality = get_term_by( 'id', $links['quality'], 'quality' );

                echo '<span class="Qlty">'.$quality->name.'</span>';

            }else{
                
                echo '<span class="Qlty">'.__('Unknown', 'toroplay').'</span>';
                
            }
        }
        
        if($show_runtime==true) {
            $runtime_field = get_post_meta($post->ID, TR_GRABBER_FIELD_RUNTIME, true);
			$runtime_field = is_array($runtime_field) ? array_filter($runtime_field) : $runtime_field;
            if(tr_check_type($post->ID)==2 and is_array($runtime_field) and !empty( $runtime_field )){
                $runtime_field = implode('m, ', $runtime_field).'m ';
            }elseif(tr_check_type($post->ID)==2 and !is_array($runtime_field) and !empty( $runtime_field )){
                $runtime_field = implode('m, ', explode(',', $runtime_field)).'m';
            }else{
                $runtime_field = $runtime_field;
            }

            if($runtime_field!=''){
                echo $runtime_field;
            }else{
                echo __('Unknown', 'toroplay');
            }
        }
        
        if( $show_year == true ) {
           
            $date_field = get_post_meta($post->ID, TR_GRABBER_FIELD_DATE, true);
            $date_field_year = $date_field;
            if($date_field!=''){
                $date_field = explode('-', $date_field);
                $date_field_year = $date_field['0'] == '' ? '' : $date_field['0'];
                echo $date_field_year;
            }else{
                echo __('Unknown', 'toroplay');
            }
            
        }

	}
endif;

if ( ! function_exists( 'toroplay_season_info' ) ) :
	/**
	 * Prints HTML with meta information for season.
	 */
	function toroplay_season_info($term_id = NULL, $tag='', $class='', $show=false) {
        $tagend = $tag == '' ? '' : '</'.$tag.'>';
        $class = $class == '' ? '' : ' class="'.$class.'"';
        $tag = $tag == '' ? '' : '<'.$tag.$class.'>';
        
        if( $show == 'overview' and get_term_meta($term_id, 'overview', true) != '' ) {
            echo $tag.get_term_meta($term_id, 'overview', true).$tagend;             
        }
        
        if( $show == 'status' ) {
            
            $post_id = get_term_meta($term_id, 'tr_id_post', true);
            $status = get_post_meta($post_id, TR_GRABBER_FIELD_STATUS, true);
            if( $status == '' ) return;
            echo $tag.$status.$tagend;
            
        }
        
        if( $show == 'number_of_episodes' and get_term_meta($term_id, 'number_of_episodes', true) != '' ) {
            printf( __('%s Episodes', 'toroplay'), $tag.get_term_meta($term_id, 'number_of_episodes', true).$tagend);
        }
        
        if( $show == 'runtime' ) {
            
            $post_id = get_term_meta($term_id, 'tr_id_post', true);
                        
            $runtime_field = get_post_meta($post_id, TR_GRABBER_FIELD_RUNTIME, true);
			$runtime_field = is_array($runtime_field) ? array_filter($runtime_field) : $runtime_field;
            
            if(tr_check_type($post_id)==2 and is_array($runtime_field) and !empty( $runtime_field )){
                $runtime_field = implode('m, ', $runtime_field).'m ';
            }elseif(tr_check_type($post_id)==2 and !is_array($runtime_field) and !empty( $runtime_field )){
                $runtime_field = implode('m, ', explode(',', $runtime_field)).'m';
            }else{
                $runtime_field = $runtime_field;
            }

            if($runtime_field!=''){
                $run = $runtime_field;
            }else{
                $run = __('Unknown', 'toroplay');
            }
            
            echo $tag.$run.$tagend;
            
        }
        
        if( $show == 'date' ) {
                        
            $date_field = get_term_meta($term_id, 'air_date', true);
            $date_field_year = $date_field;
            if($date_field!='') {
                $date_field = explode('-', $date_field);
                $date_field_year = $date_field['0'] == '' ? '' : $date_field['0'];
                echo $tag.$date_field_year.$tagend;
            }
            
        }
        
        if( $show == 'views' and function_exists('the_views') ) {
            $post_id = get_term_meta($term_id, 'tr_id_post', true);

            echo $tag.do_shortcode( '[views id="'.$post_id.'"]' ).$tagend;
            
        }
    }
endif;

if ( ! function_exists( 'toroplay_episode_info' ) ) :
	/**
	 * Prints HTML with meta information for episode.
	 */
	function toroplay_episode_info($term_id = NULL, $tag='', $class='', $show=false, $display = TRUE) {

        $return = '';
        $tagend = $tag == '' ? '' : '</'.$tag.'>';
        $class = $class == '' ? '' : ' class="'.$class.'"';
        $tag = $tag == '' ? '' : '<'.$tag.$class.'>';
        
        if( $show == 'number' ) {
            $return = $tag.get_term_meta( $term_id, 'season_number', true ).'x'.get_term_meta( $term_id, 'episode_number', true ).$tagend;
        }
        
        if( $show == 'season_number' ) {
            $return = $tag.get_term_meta( $term_id, 'season_number', true ).$tagend;
        }
        
        if( $show == 'episode_number' ) {
            $return = $tag.get_term_meta( $term_id, 'episode_number', true ).$tagend;
        }
        
        if( $show == 'name' and get_term_meta($term_id, 'name', true) != '' ) {      
            $return = $tag.get_term_meta($term_id, 'name', true).$tagend;             
        }
        
        if( $show == 'overview' and get_term_meta($term_id, 'overview', true) != '' ) {      
            $return = $tag.get_term_meta($term_id, 'overview', true).$tagend;             
        }
        
        if( $show == 'trailer' and get_post_meta( get_term_meta($term_id, 'tr_id_post', true), TR_GRABBER_FIELD_TRAILER, true ) ) {
            
            $post_id = get_term_meta($term_id, 'tr_id_post', true);
            
            $string_trailer = get_post_meta( $post_id, TR_GRABBER_FIELD_TRAILER, true );
            
            $a = array( '&amp;amp;lt;', '&amp;amp;quot;', '&amp;amp;gt;', '&amp;lt;', '&amp;quot;', '&amp;gt;', '&lt;', '&quot;', '&gt;' );
            $b = array( '<', '"', '>', '<', '"', '>', '<', '"', '>' );
            $string_trailer = str_replace( $a, $b, $string_trailer );
                      
            if( empty($string_trailer ) ) return;
            
            $return = '<span data-iframe="'.htmlentities($string_trailer).'" class="AAIco-movie_filter lgtbx-lnk wchtrlr"></span>';
            
        }
        
        if( $show == 'runtime' ) {
            
            $post_id = get_term_meta($term_id, 'tr_id_post', true);
            
            $runtime_field = get_post_meta($post_id, TR_GRABBER_FIELD_RUNTIME, true);
			$runtime_field = is_array($runtime_field) ? array_filter($runtime_field) : $runtime_field;
            
            if(tr_check_type($post_id)==2 and is_array($runtime_field) and count( array_filter( $runtime_field ) ) > 0 and isset( $runtime_field )){
                $runtime_field = implode('m, ', $runtime_field);
            }elseif(tr_check_type($post_id)==2 and !is_array($runtime_field) and !empty( $runtime_field )){
                $runtime_field = implode('m, ', explode(',', $runtime_field));
            }elseif( !empty($runtime_field) ){
                $runtime_field = $runtime_field;
            }

            if(!empty($runtime_field)){
                $run = $runtime_field;
            }else{
                $run = __('Unknown', 'toroplay');
            }
            
            $return = $tag.$run.$tagend;
            
        }
        
        if( $show == 'date' ) {
                        
            $date_field = get_term_meta($term_id, 'air_date', true);
            $date_field_year = $date_field;
            if($date_field!='') {
                $date_field = explode('-', $date_field);
                $date_field_year = $date_field['0'] == '' ? '' : $date_field['0'];
                $return = $tag.$date_field_year.$tagend;
            }
            
        }
        
        if( $show == 'views' and function_exists('the_views') ) {
            $post_id = get_term_meta($term_id, 'tr_id_post', true);

            $return = $tag.do_shortcode( '[views id="'.$post_id.'"]' ).$tagend;
            
        }
        
        if( $display == TRUE ) { echo $return; }else{ return $return; }
        
    }
endif;

if ( ! function_exists( 'toroplay_post_info' ) ) :
	/**
	 * Prints HTML with meta information for post.
	 */
	function toroplay_post_info($post_id = NULL, $tag='', $class='', $show=false, $display = TRUE, $text = NULL) {

        $return = '';
        $tagend = $tag == '' ? '' : '</'.$tag.'>';
        $class = $class == '' ? '' : ' class="'.$class.'"';
        $tag = $tag == '' ? '' : '<'.$tag.$class.'>';
                
        if( $show == 'overview' ){

            $return = $tag.apply_filters('the_content', get_the_content()).$tagend;
            
        }elseif($show == TR_GRABBER_FIELD_RUNTIME) {
                        
            $runtime_field = get_post_meta($post_id, TR_GRABBER_FIELD_RUNTIME, true);
			$runtime_field = is_array($runtime_field) ? array_filter($runtime_field) : $runtime_field;
            
            if(tr_check_type($post_id)==2 and is_array($runtime_field) and !empty( $runtime_field )){
                $runtime_field = implode('m, ', $runtime_field);
            }elseif(tr_check_type($post_id)==2 and !is_array($runtime_field) and !empty( $runtime_field )){
                $runtime_field = implode('m, ', explode(',', $runtime_field));
            }elseif( !empty($runtime_field) ){
                $runtime_field = $runtime_field;
            }else{
                $runtime_field = __('Unknown', 'toroplay');
            }
            
            $return = $tag.$runtime_field.$tagend;
            
        }elseif($show == TR_GRABBER_FIELD_DATE){
            
            $date_field = get_post_meta($post_id, TR_GRABBER_FIELD_DATE, true);
            $date_field_year = $date_field;
            if($date_field!='') {
                $date_field = explode('-', $date_field);
                $date_field_year = $date_field['0'] == '' ? '' : $date_field['0'];
                $return = $tag.$date_field_year.$tagend;
            }
            
        }elseif($show == 'date'){
            
            $date_field = get_post_meta($post_id, TR_GRABBER_FIELD_DATE, true);
            if($date_field!='') {
                $date_field = explode('-', $date_field);
                $date_field = $date_field['0'] == '' ? '' : $date_field['2'].'-'.$date_field['1'].'-'.$date_field['0'];
                $return = $tag.$text.$date_field.$tagend;
            }
            
        }elseif($show == TR_GRABBER_FIELD_DATE_LAST){
            
            $date_field = get_post_meta($post_id, TR_GRABBER_FIELD_DATE_LAST, true);
            if($date_field!='') {
                $date_field = explode('-', $date_field);
                $date_field = $date_field['0'] == '' ? '' : $date_field['2'].'-'.$date_field['1'].'-'.$date_field['0'];
                $return = $tag.$text.$date_field.$tagend;
            }
            
        }elseif($show == 'rating'){
            
            if( function_exists('the_ratings') ) {
                
                $num = is_numeric( get_post_meta($post_id, 'ratings_average', true) ) ? number_format(get_post_meta($post_id, 'ratings_average', true), 1) : 0;
                
                $rating = sprintf( __('%s votes%s', 'toroplay'), '<span class="AAIco-star">'.$num.'</span> <small>'.get_post_meta($post_id, 'ratings_users', true), '</small>' );

                $return = $tag.$text.$rating.$tagend;

            }
            
        }elseif($show == TR_GRABBER_FIELD_INPRODUCTION){
        
            $in_production = get_post_meta($post_id, TR_GRABBER_FIELD_INPRODUCTION, true);
            
            $in_production = $in_production == 1 ? __('Yes', 'toroplay') : __('No', 'toroplay');
            
            $return = $tag.$text.$in_production.$tagend;            
            
        }elseif($show == 'genre'){
            
            $return = $tag.$text.get_the_category_list(', ').$tagend;            
            
        }elseif($show == 'tags'){
            
            $tags_list = get_the_tag_list( '', ', ', '', $post_id);

            if ( isset($tags_list) and !empty($tags_list) ) { $return = $tag.$text.$tags_list.$tagend; }
            
        }elseif($show == 'directors'){
            
            $array_directors = array('');

            if(tr_check_type($post_id)==2){ $taxonomy_directors = 'directors_tv'; }else{ $taxonomy_directors = 'directors'; }

            $term_list_directors = wp_get_post_terms($post_id, $taxonomy_directors, array("fields" => "all"));

            if(!is_wp_error($term_list_directors) and !empty($term_list_directors)) {

                foreach($term_list_directors as $director_single) {
                    $array_directors[]='<a href="'.get_term_link($director_single->term_id, $taxonomy_directors).'">'.$director_single->name.'</a>';
                }

                $return = $tag.$text.implode(', ', array_filter($array_directors)).$tagend;
                
            }
            
        }elseif($show == 'views'){
            
            if( function_exists('the_views') and do_shortcode( '[views id="'.$post_id.'"]' )!='' ) {
                $return = $tag.do_shortcode( '[views id="'.$post_id.'"]' ).$tagend;
            }else{
                $return = '';
            }
            
        }elseif($show == 'trailer'){
            
            $string_trailer = get_post_meta( $post_id, TR_GRABBER_FIELD_TRAILER, true );
            
            $a = array( '&amp;amp;lt;', '&amp;amp;quot;', '&amp;amp;gt;', '&amp;lt;', '&amp;quot;', '&amp;gt;', '&lt;', '&quot;', '&gt;' );
            $b = array( '<', '"', '>', '<', '"', '>', '<', '"', '>' );
            $string_trailer = str_replace( $a, $b, $string_trailer );
            
            if( empty($string_trailer ) ) return;
            
            $return = '<span data-iframe="'.htmlentities($string_trailer).'" class="AAIco-movie_filter lgtbx-lnk wchtrlr"></span>';
                        
        }elseif($show == 'cast_single'){
            
            $array_cast = array('');

            if(tr_check_type($post_id)==2){ $taxonomy_cast = 'cast_tv'; }else{ $taxonomy_cast = 'cast'; }

            $term_list_cast = wp_get_post_terms($post_id, $taxonomy_cast, array("fields" => "all"));

            if(!is_wp_error($term_list_cast) and !empty($term_list_cast)) {
                foreach($term_list_cast as $cast_single) {
                    $array_cast[]='
                    <li>
                        <a href="'.get_term_link($cast_single->term_id, $taxonomy_cast).'">
                            <figure>
                                <span class="Objf"><img src="'.trcast_image($cast_single->term_id, 'image').'" alt="'.sprintf( __('Image %s', 'toroplay'), $cast_single->name ).'"></span>
                                <figcaption>'.$cast_single->name.'</figcaption>
                            </figure>
                        </a>
                    </li>';
                }

                $return = '
                <!--<Cast>-->
                <div class="MvTbCn anmt" id="MvTb-Cast">
                    <ul class="ListCast Rows AX A06 B03 C02 D20 E02">'.implode('', array_filter($array_cast)).'</ul>
                </div>
                <!--</Cast>-->';
                
            }
            
        }elseif( $show == TR_GRABBER_FIELD_NSEASONS ) {

            $t_seasons = get_post_meta( $post_id, TR_GRABBER_FIELD_NSEASONS, true );
            
            $t_seasons = $t_seasons == '' ? 0 : $t_seasons;
            
            $return = $tag.$text.$t_seasons.$tagend;
            
        }elseif( $show == TR_GRABBER_FIELD_NEPISODES ) {

            $t_episodes = get_post_meta( $post_id, TR_GRABBER_FIELD_NEPISODES, true );
            
            $t_episodes = $t_episodes == '' ? 0 : $t_episodes;
            
            $return = $tag.$text.$t_episodes.$tagend;
            
        }else{
        
            $return = $tag.$text.get_post_meta( $post_id, $show, true ).$tagend;
            
        }
        
        if( $display == TRUE ) { echo $return; }else{ return $return; }
        
    }   
endif;

if ( ! function_exists( 'toroplay_shared_button' ) ) :
	/**
	 * Prints HTML with shared buttons.
	 */
	function toroplay_shared_button($id=NULL) {
        
        $title = ''; $permalink = '';
        
        if( is_single() ) { $title = get_the_title($id); $permalink = get_permalink($id); }
        
        if( is_tax() ) { $title = get_queried_object()->name; $permalink = get_term_link( get_queried_object()->term_id ); }
        
        echo '
            <ul class="ListPOpt">
                <li><a rel="nofollow" onclick="window.open (\'http://www.facebook.com/share.php?u='.$permalink.'?title='.$title.'\', \'Facebook\', \'toolbar=0, status=0, width=650, height=450\');" href="javascript: void(0);" class="Fcb fa-facebook"></a></li>
                <li><a rel="nofollow" onclick="window.open (\'http://twitter.com/intent/tweet?status='.$title.'+'.$permalink.'\', \'Twitter\', \'toolbar=0, status=0, width=650, height=450\');" href="javascript: void(0);" class="Twt fa-twitter"></a></li>
                <li><a rel="nofollow" onclick="window.open (\'https://plus.google.com/share?url='.$permalink.'\', \'Google Plus\', \'toolbar=0, status=0, width=650, height=450\');" href="javascript: void(0);" class="Ggl fa-google-plus"></a></li>
            </ul>
        ';
        
    }   
endif;

if ( ! function_exists( 'toroplay_list_seasons' ) ) :
	/**
	 * Prints HTML with list seasons.
	 */
	function toroplay_list_seasons($term_id, $id_post=NULL, $type = 1, $season = NULL) {

        $list = ''; $list2 = ''; $season_number = ''; $total_episodes = '';
        
        foreach(tr_grabber_list_seasons( $id_post ) as $season_single) {
            
            $list.='<li class="ClB"><a href="'.get_term_link($season_single->term_id).'">'.__('Season', 'toroplay').' <span class="ClB">'.get_term_meta($season_single->term_id, 'season_number', true).'</span> <small>'.get_term_meta($season_single->term_id, 'number_of_episodes', true).' '.__('Episodes', 'toroplay').'</small></a></li>';
            
            $total_episodes = get_term_meta($season_single->term_id, 'number_of_episodes', true) == '' ? 0 : get_term_meta($season_single->term_id, 'number_of_episodes', true);
            $season_number = get_term_meta($season_single->term_id, 'season_number', true);
            $current = $season == $season_number ? ' Current' : '';
            
            $list2.='<a href="'.get_term_link($season_single->term_id).'" class="Button STPb'.$current.'">'.sprintf( __('Season %s %sEp.%s', 'toroplay'), '<span>'.$season_number.'</span>', '<small>'.$total_episodes.' ', '</small>' ).'</a>';
            
        }
        
        $season_number_b = get_term_meta($term_id, 'season_number', true) == 0 ? __('Special', 'toroplay') : get_term_meta($term_id, 'season_number', true);
        
        if(isset($list) and $type == 1) {
            echo '
            <div class="Select-Season">
                <div class="ClB"><span>'.__('Season', 'toroplay').' <span class="ClB">'.$season_number_b.'</span></span><i class="fa-chevron-down"></i></div>
                <nav class="BgB">
                    <ul>'.$list.'</ul>
                </nav>
            </div>
            ';
        }
        
        if(isset($list2) and $type == 2) {
            echo '<div class="snslst">'.$list2.'</div>';
        }
        
    }   
endif;

if ( ! function_exists( 'toroplay_list_episodes' ) ) :
	/**
	 * Prints HTML with list episodes.
	 */
	function toroplay_list_episodes($term_id, $id_post=NULL, $type = 1, $nepisodes_season = NULL) {

        $list = '';
        
        $season_number = get_term_meta($term_id, 'season_number', true);
        $season_number_b = $season_number == 0 ? 'special' : $season_number;
        $nepisodes_season = $nepisodes_season == '' ? 0 : $nepisodes_season;
                
        $i = 1;
        foreach(tr_grabber_list_episodes( $id_post, $season_number_b ) as $episode_single) {
            
            $name = get_term_meta($episode_single->term_id, 'name', true) == '' ? __('Unknown', 'toroplay') : get_term_meta($episode_single->term_id, 'name', true);
            
            if( $type == 1 ) {

                $img = tr_theme_img($episode_single->term_id, 'episodes', $episode_single->name, 'episodes');
                
            }else{
                            
                if( $season_number_b == 'special' or $season_number_b == 1 ){
                    
                    $img = tr_theme_img($episode_single->term_id, 'episode', $episode_single->name, 'episodes');

                }else{
                    
                    $img = '<span class="cnv cnv'.$season_number.'">'.htmlentities( tr_theme_img($episode_single->term_id, 'episodes', $episode_single->name, 'episodes') ).'</span>';
                    
                }
                
            }
            
            $list.='
            <tr>
                <td><span class="Num">'.$i.'</span></td>
                <td class="MvTbImg B"><a href="'.get_term_link($episode_single->term_id).'" class="MvTbImg">'.$img.'</a></td>
                <td class="MvTbTtl"><a href="'.get_term_link($episode_single->term_id).'">'.$name.'</a>'.toroplay_episode_info($episode_single->term_id, 'span', '', 'date', false).'</td>
                <td class="MvTbPly"><a href="'.get_term_link($episode_single->term_id).'" class="AAIco-play_circle_outline ClA"></a></td>
            </tr>';
            
            $i++;
        }
        
        if(isset($list) and $type == 1) {
            
            echo '
            <!--<Season>-->
            <div class="Wdgt">
                <div class="Title">'.sprintf( __('%s - Season %s - %s Episodes', 'toroplay'), get_the_title($id_post), '<span>'.$season_number.'</span>', '<span>'.$nepisodes_season.'</span>' ).'</div>
                <div class="TPTblCn">
                    <table>
                        <tbody>'.$list.'</tbody>
                    </table>
                </div>
            </div>
            <!--</Season>-->';
            
        }elseif(isset($list) and $type == 2){
            return $list;
        }
        
    }   
endif;

if ( ! function_exists( 'toroplay_list_seasons_episodes' ) ) :
	/**
	 * Prints HTML with list seansons and episodes.
	 */
	function toroplay_list_seasons_episodes($id_post=NULL) {
        
        $i = 1;
        
        $list_episodes = '';
        
        foreach(tr_grabber_list_seasons( $id_post ) as $season_single) {
        
            $current = $i == 1 ? ' On' : '';
            $t = get_term_meta($season_single->term_id, 'number_of_episodes', true);
            
            $list_episodes = toroplay_list_episodes($season_single->term_id, $id_post, 2, get_term_meta($season_single->term_id, 'number_of_episodes', true));
            
            if( empty( $list_episodes ) ){ $list_episodes = '<tr><td>'.__('No episodes available', 'toroplay').'</td></tr>'; }
            
            echo '
            <!--<Season>-->
            <div class="Wdgt AABox">
                <div class="Title AA-Season'.$current.'" data-tab="'.get_term_meta($season_single->term_id, 'season_number', true).'">'.sprintf( __('Season %s', 'toroplay'), '<span>'.get_term_meta($season_single->term_id, 'season_number', true).'</span> <i class="Vmrls ClA fa-chevron-down"></i>' ).'</div>
                <div class="TPTblCn AA-cont">
                    <table>
                        <tbody>'.$list_episodes.'</tbody>
                    </table>
                </div>
            </div>
            <!--</Season>-->';
            
            $i++;
            
        }
        
    }   
endif;

if ( ! function_exists( 'toroplay_msj_tab' ) ) :
	/**
	 * Prints HTML with message tab.
	 */
	function toroplay_msj_tab( $class = NULL ) {
        $msj = wp_specialchars_decode(stripslashes(get_theme_mod( 'tp_msjplayer', '' )));
        $class = $class == '' ? '' : ' '.$class;
        if( $msj == '' ) return;
        return '
        <div class="tr-noteinfo EcBgA'.$class.'">
            <p><i class="ClB AAIco-warning"></i>'.$msj.'</p>
        </div>';
    }
endif;