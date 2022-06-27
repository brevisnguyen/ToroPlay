<?php
/**
 * Template part for displaying movies posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroplay
 */

    global $query_all, $wp_query;

    $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : get_query_var('paged');

    $type = is_page_template( 'pages/template-mostviews.php' ) ? 7 : 8;

    $query_all = new WP_Query( tr_args($type, $paged) );

    if ( $query_all->have_posts() ) {

?>
<!--<MovieList>-->
<section>
    <div class="Top">
        <?php tr_title('tp_page', 'Title'); ?>
    </div>
    <ul<?php tr_content_class(2, "MovieList NoLmtxt Rows AX A06 B04 C03"); ?>>
        <?php
            // Start the loop.
            while ( $query_all->have_posts() ) {
                $query_all->the_post();
        ?>
        <!--<TPostMv>-->
        <li class="TPostMv">
            <article id="post-<?php the_ID(); ?>" class="TPost C">
                <a href="<?php the_permalink(); ?>">
                    <div class="Image"><figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo tr_theme_img(get_the_ID(), 'thumbnail', get_the_title()); ?></figure>
                    <?php toroplay_entry_header(false, false, false, false, false, true); ?>
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
        
</section>
<!--</MovieList>-->

<?php } ?>