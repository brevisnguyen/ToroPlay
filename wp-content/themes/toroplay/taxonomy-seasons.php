<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ToroPlay
 */
get_header(); ?>

<!--<TpRwCont>-->
<div<?php tr_content_class($type=1); ?>>
    <!--<Main>-->
    <main>
        
        <?php
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $tr_post_id = get_term_meta($term->term_id, 'tr_id_post', true);
            $nepisodes_season = get_term_meta($term->term_id, 'number_of_episodes', true);
        ?>
        
        <?php tr_banners('ads_singles_top'); ?>
        
        <!--<Single>-->
        <article class="TPost Single">
            <header>
                <?php tr_title( 'tp_single_seasons', 'Title', TRUE, $term->term_id ); ?>
                <?php toroplay_shared_button($tr_post_id); ?>
                <div class="SubTitle">
                    <?php toroplay_season_info($term->term_id, 'span', 'Qlty', $show='status'); ?>
                    <?php toroplay_season_info($term->term_id, 'span', 'ClB', $show='number_of_episodes'); ?>
                </div>
                <div class="Image">
                    <figure><?php echo tr_theme_img($term->term_id, 'thumbnail', $term->name, 'seasons'); ?></figure>
                </div>
                <?php toroplay_season_info($term->term_id, 'div', 'Description', $show='overview'); ?>
            </header>
            <footer class="ClFx">
                <?php if( function_exists('the_ratings') ) { ?>
                <div class="VotesCn">
                    <div class="Prct">
                        <div id="TPVotes" data-percent="<?php echo tr_postratings_porc($tr_post_id); ?>"></div>
                    </div>
                    <?php the_ratings('div', $tr_post_id); ?>
                </div>
                <?php } ?>
                <p class="Info">
                    <?php toroplay_season_info($term->term_id, 'span', 'Time AAIco-access_time', $show='runtime'); ?>
                    <?php toroplay_season_info($term->term_id, 'span', 'Date AAIco-date_range', $show='date'); ?>
                    <?php toroplay_season_info($term->term_id, 'span', 'View AAIco-remove_red_eye', $show='views'); ?>
                </p>
            </footer>
            <div class="TPostBg Objf"><?php tr_backdrop('w780', $tr_post_id); ?></div>
        </article>
        <!--</Single>-->
        
        <?php tr_banners('ads_singles_bottom'); ?>

        <?php toroplay_list_seasons($term->term_id, $tr_post_id, 2, get_term_meta($term->term_id, 'season_number', true)); ?>
        <?php toroplay_list_episodes($term->term_id, $tr_post_id, 1, $nepisodes_season); ?>

         <?php
            global $withcomments;
            $withcomments = true;
            comments_template();
        ?>

    </main>
    <!--</Main>-->

    <?php get_sidebar(); ?>

</div>
<!--</TpRwCont>-->

<?php get_footer(); ?>