<?php
/**
 * Template part for displaying seasons terms
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroplay
 */

    $type = is_page_template( 'pages/template-seasons.php' ) ? 6 : 3;
    $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : get_query_var('paged');

    $seasons = get_terms( tr_args( $type, $paged ) );
    if( isset ( $seasons ) and !empty( $seasons ) ) {
?>
<!--<section>-->
<section>
    <!--<Seasons>-->
    <div class="Top">
        <?php tr_title('tp_homepage_seasons', 'Title'); ?>
        <?php tr_viewmore('seasons'); ?>
    </div>
    <ul<?php tr_content_class(2, "MovieList Rows AX A06 B04 C03 NoLmtxt"); ?>>
        <?php
            foreach( $seasons as $season ) {

            $term_link_season = get_term_link( $season->term_id );

            if ( is_wp_error( $term_link_season ) ) {
                continue;
            }

        ?>
        <!--<TPostMv>-->
        <li class="TPostMv">
            <article class="TPost C">
                <a href="<?php echo esc_url( $term_link_season ); ?>">
                    <div class="Image">
                        <figure class="Objf TpMvPlay AAIco-play_arrow">
                            <?php echo tr_theme_img($season->term_id, 'thumbnail', $season->name, 'seasons'); ?>
                            <?php if(get_term_meta($season->term_id, 'number_of_episodes', true)!=''){
                                $plural = get_term_meta($season->term_id, 'number_of_episodes', true) == 1 ? '' : 's';
                            ?>
                            <figcaption><?php printf( __('%s - Episode%s', 'toroplay'), '<span class="ClB">'.get_term_meta($season->term_id, 'number_of_episodes', true).'</span>', $plural); ?></figcaption>
                            <?php } ?>
                        </figure>
                    </div>
                    <?php tr_title( 'titlelist', 'Title', true, get_the_title( get_term_meta($season->term_id, 'tr_id_post', true) ) ); ?>
                    <span class="Year"><?php if(get_term_meta($season->term_id, 'name', true)!=''){ echo get_term_meta($season->term_id, 'name', true); } ?> <?php if(get_term_meta($season->term_id, 'air_date', true)!=''){ echo ' - '.date('Y', strtotime(get_term_meta($season->term_id, 'air_date', true))); } ?></span>
                </a>
            </article>
        </li>
        <!--</TPostMv>-->
        <?php } ?>
    </ul>
    <!--</Seasons>-->
</section>
<!--</section>-->
<?php } ?>