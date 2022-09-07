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
            $trailer = get_post_meta( $post->ID, TR_GRABBER_FIELD_TRAILER, true ) == '' ? '' : html_entity_decode( get_post_meta( $post->ID, TR_GRABBER_FIELD_TRAILER, true ) );
            $links = tr_links_episodes($term->term_id);
            $links['online'] = !empty($links['online']) ? $links['online'] : '';
            $links['downloads'] = !empty($links['downloads']) ? $links['downloads'] : '';
        ?>

        <?php tr_banners('ads_singlep_top'); ?>

        <!--<Single>-->
        <article class="TPost Single Episode">
            <header>
                <div class="TpTvSw">
                    <?php tr_title( 'tp_single_episodes', 'Title', TRUE, $term->term_id ); ?>
                    <?php toroplay_shared_button($tr_post_id); ?>
                    <?php toroplay_episode_info($term->term_id, 'h2', 'SubTitle', $show='name'); ?>
                    <?php toroplay_list_seasons($term->term_id, $tr_post_id); ?>
                </div>

                <?php tr_player_episodes($links['online'], $term->term_id); ?>

                <?php tr_related_episodes($tr_post_id, $term->term_id); ?>

                <?php toroplay_episode_info($term->term_id, 'div', 'Description', $show='overview'); ?>
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
                    <?php toroplay_episode_info($term->term_id, 'span', 'Time AAIco-access_time', $show='runtime'); ?>
                    <?php toroplay_episode_info($term->term_id, 'span', 'Date AAIco-date_range', $show='date'); ?>
                    <?php toroplay_episode_info($term->term_id, 'span', 'View AAIco-remove_red_eye', $show='views'); ?>
                </p>
            </footer>
            <div class="TPostBg Objf"><?php tr_backdrop('w780', $tr_post_id); ?></div>
        </article>
        <!--</Single>-->
        
        <?php tr_banners('ads_singlep_bottom'); ?>
        
        <?php tr_downloads_episodes($links['downloads'], $term->term_id); ?>
        
        <?php
            global $withcomments;
            $withcomments = true;
            comments_template();
        ?>

        <div class="Wdgt" id="comments">
            <div class="Title"><?php printf( __('Comments %s%s%s', 'toroplay'), 'phim <span>', get_the_title($tr_post_id), '</span>' ); ?></div>
            <div class="fb-comments" style="background-color: rgba(255,255,255,.9);" data-href="<?php global $wp; echo add_query_arg( $wp->query_vars, home_url( $wp->request ) ); ?>" data-width="100%" data-order-by="time"></div>
        </div>

    </main>
    <!--</Main>-->

    <?php get_sidebar(); ?>

</div>
<!--</TpRwCont>-->
		        
<?php get_footer(); ?>