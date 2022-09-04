<?php
/**
 * Template part for displaying series posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroplay
 */

    global $query_series, $wp_query;

    $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : get_query_var('paged');

    $query_series = new WP_Query( tr_args($type=10, $paged) );

    if ( $query_series->have_posts() ) {

?>
<!--<section>-->
<section>

    <!--<Series>-->
    <div class="Top">
        <?php tr_title('tp_homepage_tvshows', 'Title'); ?>
        <?php tr_viewmore('series'); ?>
    </div>
    <ul<?php tr_content_class(2, "MovieList NoLmtxt Rows AX A06 B04 C03"); ?>>
        <?php
            // Start the loop.
            while ( $query_series->have_posts() ) {
                $query_series->the_post();
        ?>
        <!--<TPostMv>-->
        <li class="TPostMv">
            <article class="TPost C">
                <a href="<?php the_permalink(); ?>">
                    <div class="Image">
                        <figure class="Objf TpMvPlay AAIco-play_arrow">
                            <?php echo tr_theme_img(get_the_ID(), 'thumbnail', get_the_title()); ?>
                            <?php
                                if( get_post_meta($post->ID, TR_GRABBER_FIELD_NSEASONS, true)!='' ) {
                                    $plural = get_post_meta($post->ID, TR_GRABBER_FIELD_NSEASONS, true) == 1 ? '' : 's';
                            ?>
                            <figcaption><?php printf( __('%s Season%s', 'toroplay'), '<span class="ClB">'.get_post_meta($post->ID, TR_GRABBER_FIELD_NSEASONS, true).'</span>', $plural); ?></figcaption>
                            <?php
                                }
                            ?>
                        </figure>
                    </div>
                    <?php tr_title( 'titlelist', 'Title', true, get_the_title() ); ?>
                    <?php toroplay_entry_header($show_rating=false, $show_year=2, $show_quality=false, $show_runtime=false, $show_views=false, $show_type=false, $single=true); ?>
                </a>
                <?php tr_hover(); ?>
            </article>
        </li>
        <!--</TPostMv>-->
        <?php
            // End the loop.
            }
            wp_reset_postdata();
        ?>
    </ul>
    <!--</Series>-->
</section>
<!--</section>-->
<?php } ?>