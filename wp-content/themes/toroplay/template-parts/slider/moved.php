<?php
/**
 * Slider
 *
 * @package Toroplay
 */

    if( get_theme_mod( 'tp_slidermoved', 1 ) != 1 ) return;

    if(is_front_page() and is_home() and !is_paged() and !isset($_GET['r_sortby']) and !isset($_GET['v_sortby']) and get_theme_mod('show_slider', 1)==1){
    if ( false === ( $trslidermoved_query_results = get_transient( 'trslidermoved_query_results' ) ) ) {
        
        if( get_theme_mod('slider_orderby', 1) == 1 ){
        
            $args=array(

                'posts_per_page'=> get_theme_mod('posts_per_slider', 4),
                'orderby' => 'rand',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' )

            );
            
        }elseif( get_theme_mod('slider_orderby', 1) == 2 ){
            
            $args=array(

                'posts_per_page'=> get_theme_mod('posts_per_slider', 4),
                'orderby' => 'desc',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' )

            );
            
        }elseif( get_theme_mod('slider_orderby', 1) == 3 ){
            
            $args=array( 
                'meta_key' => 'ratings_average',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' ),
                'posts_per_page'=> get_theme_mod('posts_per_slider', 4),
            );
            
        }elseif( get_theme_mod('slider_orderby', 1) == 4 ){
            
            $args=array( 
                'meta_key' => 'views',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' ),
                'posts_per_page'=> get_theme_mod('posts_per_slider', 4),
            );
            
        }elseif( get_theme_mod('slider_orderby', 1) == 5 ){
            
            $sticky = get_option( 'sticky_posts' );
            
            $args=array(
                'post__in' => $sticky,
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' ),
                'posts_per_page'=> get_theme_mod('posts_per_slider', 4),                
            );
            
        }
        
        // The Query
        $trslidermoved_query_results = new WP_Query( $args );
        set_transient( 'trslidermoved_query_results', $trslidermoved_query_results, 12 * HOUR_IN_SECONDS );
    }

    // The Loop
    if ($trslidermoved_query_results->have_posts() ) :

?>
<!--<MovieListSld>-->
<div class="MovieListSldCn">
    <div class="MovieListSld owl-carousel" data-autoplay="<?php echo get_theme_mod('slider_autoplay', false); ?>">
        <?php
            while( $trslidermoved_query_results->have_posts() ) {	
                $trslidermoved_query_results->the_post();
        ?>
        <div class="TPostMv">
            <div class="TPost D">
                <a href="<?php the_permalink(); ?>">
                    <div class="Image">
                        <figure class="Objf"><?php tr_backdrop('w780'); ?></figure>
                    </div>
                </a>
                <div class="TPMvCn">
                    <a href="<?php the_permalink(); ?>">
                        <?php tr_title('titleslider', 'Title', true, tr_theme_clip_text(get_the_title(), 20).tr_icon_tv()); ?>
                    </a>
                    <p class="Info">
                        <?php toroplay_entry_header($show_rating=get_theme_mod('show_rating_slider', true), $show_year=get_theme_mod('show_year_slider', true), $show_quality=get_theme_mod('show_quality_slider', true), $show_runtime=get_theme_mod('show_duration_slider', true), $show_views=get_theme_mod('show_views_slider', false)); ?>
                    </p>
                    <div class="Description">
                        <?php
                            if( get_theme_mod('show_description_slider', true) ) {
                                echo'<p>'.tr_theme_clip_text( strip_tags(get_the_content()), 200 ).'</p>';
                            }
                        ?>
                        <?php toroplay_entry_footer($show_tags=get_theme_mod('show_tag_slider', false), $limit=2, $show_cat=get_theme_mod('show_geners_slider', true), $show_directors=get_theme_mod('show_directors_slider', true), $show_cast=get_theme_mod('show_cast_slider', true)); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="Button TPlay AAIco-play_arrow">
                        <?php
                        if(tr_check_type($post->ID)==2){
                            printf( __('Watch %sSerie%s', 'toroplay'), '<strong>', '</strong>' );
                        }else{
                            printf( __('Watch %sMovie%s', 'toroplay'), '<strong>', '</strong>' );
                        }
                        ?>
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<!--</MovieListSld>-->
<?php
	/* Restore original Post Data */
    wp_reset_postdata();

    endif;
    }
?>