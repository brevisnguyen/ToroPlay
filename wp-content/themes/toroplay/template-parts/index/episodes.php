<?php
/**
 * Template part for displaying episodes terms
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroplay
 */
    
    $type = is_page_template( 'pages/template-episodes.php' ) ? 5 : 4;
    $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : get_query_var('paged');

    $episodes = get_terms( tr_args( $type, $paged ) );
    if( !empty ( $episodes ) ) {
?>
<!--<section>-->
<section>    
    <!--<Episodes>-->
    <div class="Top">
        <?php tr_title('tp_homepage_episodes', 'Title'); ?>
        <?php tr_viewmore('episodes'); ?>
    </div>
    <ul<?php tr_content_class(3, "MovieList Rows BX B06 C04 E03 NoLmtxt Episodes"); ?>>

        <?php 
            foreach( $episodes as $episode ) {

            $term_link_episode = get_term_link( $episode->term_id );

            if ( is_wp_error( $term_link_episode ) ) {
                continue;
            }
        ?>

        <!--<TPostMv>-->
        <li class="TPostMv">
            <article class="TPost C">
                <a href="<?php echo esc_url( $term_link_episode ); ?>">
                    <div class="Image">
                        <figure class="Objf TpMvPlay AAIco-play_arrow">
                            <?php echo tr_theme_img($episode->term_id, 'episode', $episode->name, 'episodes'); ?>
                            <figcaption><?php if(get_term_meta($episode->term_id, 'season_number', true)!=''){ ?><span class="ClB"><?php echo get_term_meta($episode->term_id, 'season_number', true); ?>x<?php echo get_term_meta($episode->term_id, 'episode_number', true); ?></span> - <?php } if(get_term_meta( $episode->term_id, 'name', true )!=''){ echo get_term_meta( $episode->term_id, 'name', true ); } ?></figcaption>
                        </figure>
                    </div>
                    <?php tr_title( 'titlelist', 'Title', true, get_the_title( get_term_meta($episode->term_id, 'tr_id_post', true) ) ); ?>
                    <?php if(get_term_meta($episode->term_id, 'air_date', true)!=''){ ?>
                    <span class="Year"><?php echo date('F d, Y', strtotime(get_term_meta($episode->term_id, 'air_date', true))); ?></span>
                    <?php } ?>
                </a>
            </article>
        </li>
        <!--</TPostMv>-->

        <?php } ?>

    </ul>
    <!--</Episodes>-->
</section>
<!--</section>-->
<?php } ?>