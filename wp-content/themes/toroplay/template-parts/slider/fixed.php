<?php
/**
 * Carrousel
 *
 * @package Toroplay
 */

    if( get_theme_mod( 'tp_sliderfixed', 1 ) != 1 ) return;

    $show_quality = get_theme_mod( 'show_quality_carrousel', false ) == 1 ? true : false;

    if ( false === ( $trsliderfixed_query_results = get_transient( 'trsliderfixed_query_results' ) ) ) {
        
        if( get_theme_mod('carrousel_orderby', 1)==1) {
        
            $args=array(

                'posts_per_page'=> get_theme_mod('posts_per_carrousel', 12),
                'orderby' => 'rand',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' )

            );
            
        }elseif( get_theme_mod('carrousel_orderby', 1) == 2 ){
            
            $args=array(

                'posts_per_page'=> get_theme_mod('posts_per_carrousel', 12),
                'orderby' => 'desc',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' )

            );
            
        }elseif( get_theme_mod('carrousel_orderby', 1) == 3 ){
            
            $args=array( 
                'meta_key' => 'ratings_average',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' ),
                'posts_per_page'=> get_theme_mod('posts_per_carrousel', 12),
            );
            
        }elseif( get_theme_mod('carrousel_orderby', 1) == 4 ){
            
            $args=array( 
                'meta_key' => 'views',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' ),
                'posts_per_page'=> get_theme_mod('posts_per_carrousel', 12),
            );
            
        }elseif( get_theme_mod('carrousel_orderby', 1) == 5 ){
            
            $sticky = get_option( 'sticky_posts' );
            
            $args=array(
                'post__in' => $sticky,
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' ),
                'posts_per_page'=> get_theme_mod('posts_per_carrousel', 12),                
            );
            
        }
        
        // The Query
        $trsliderfixed_query_results = new WP_Query( $args );
        set_transient( 'trsliderfixed_query_results', $trsliderfixed_query_results, 12 * HOUR_IN_SECONDS );
    }

    // The Loop  
    if ($trsliderfixed_query_results->have_posts() ) :

?>
<!--<MovieListTopCn>-->
<div class="MovieListTopCn">
    <div class="MovieListTop owl-carousel" data-autoplay="<?php echo get_theme_mod('carrousel_autoplay', false); ?>">
        <?php
            while( $trsliderfixed_query_results->have_posts() ) {		
                $trsliderfixed_query_results->the_post();
        ?>
        <div class="TPostMv">
            <div class="TPost B">
                <a href="<?php the_permalink(); ?>">
                    <div class="Image">
                        <figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo tr_theme_img(get_the_ID(), 'thumbnail', get_the_title()).toroplay_entry_header(false, false, $show_quality, false, false, false); ?>
                        </figure>
                        <?php toroplay_entry_header(false, false, false, false, false, true); ?>
                    </div>
                    <?php tr_title('titlecarrousel', 'Title', true, tr_theme_clip_text(get_the_title(), 80) ); ?>
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<!--</section>-->
<?php
	/* Restore original Post Data */
    wp_reset_postdata();
                
    endif;
?>