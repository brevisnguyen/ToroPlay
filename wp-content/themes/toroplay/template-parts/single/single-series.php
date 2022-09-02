<!--<TpRwCont>-->
<div<?php tr_content_class($type=1); ?>>
    <!--<Main>-->
    <main>
        
        <?php tr_banners('ads_singlet_top'); ?>
        
        <!--<Single>-->
        <article class="TPost Single">
            <header>
                <?php tr_title( 'tp_single_series', 'Title' ); ?>
                <?php toroplay_shared_button($post->ID); ?>
                <div class="SubTitle">
                    <?php toroplay_post_info($post->ID, 'span', 'Qlty', TR_GRABBER_FIELD_STATUS); ?>
                    <?php printf( __('%s Seasons - %s Episodes', 'toroplay'), '<span class="ClB">'.toroplay_post_info($post->ID, '', '', TR_GRABBER_FIELD_NSEASONS, false).'</span>', '<span class="ClB">'.toroplay_post_info($post->ID, '', '', TR_GRABBER_FIELD_NEPISODES, false).'</span>' ); ?>
                </div>
                <div class="Image">
                    <figure><?php echo tr_theme_img($post->ID, 'thumbnail', $post->post_title); ?></figure>
                </div>
                <?php toroplay_post_info($post->ID, 'div', 'Description', 'overview'); ?>
            </header>
            <footer class="ClFx">
                <?php if( function_exists('the_ratings') ) { ?>
                <div class="VotesCn">
                    <div class="Prct">
                        <div id="TPVotes" data-percent="<?php echo tr_postratings_porc($post->ID); ?>"></div>
                    </div>
                    <?php the_ratings('div', $post->ID); ?>
                </div>
                <?php } ?>
                <p class="Info">
                    <?php toroplay_post_info($post->ID, 'span', 'Time AAIco-access_time', TR_GRABBER_FIELD_RUNTIME); ?>
                    <?php toroplay_post_info($post->ID, 'span', 'Date AAIco-date_range', TR_GRABBER_FIELD_DATE); ?>
                    <?php toroplay_post_info($post->ID, 'span', 'View AAIco-remove_red_eye', 'views'); ?>
                </p>
            </footer>
            <div class="TPostBg Objf"><?php tr_backdrop('w780', $post->ID); ?></div>
        </article>
        <!--</Single>-->
        
        <?php tr_banners('ads_singlet_bottom'); ?>
        
        <?php toroplay_list_seasons_episodes($post->ID); ?>

        <!--<MovieInfo>-->
        <div class="MovieInfo TPost Single">
            <div class="MovieTabNav">
                <div class="Lnk on AAIco-description" data-Mvtab="MvTb-Info"><?php _e('Info', 'toroplay'); ?></div>
                <div class="Lnk AAIco-movie_filter" data-Mvtab="MvTb-Cast"><?php _e('Cast', 'toroplay'); ?></div>
            </div>
            <!--<Info>-->
            <div class="MvTbCn on anmt" id="MvTb-Info">
                <ul class="InfoList">
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', TR_GRABBER_ORIGINAL_TITLE, TRUE, '<strong>'.__('Original title: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', TR_GRABBER_FIELD_INPRODUCTION, TRUE, '<strong>'.__('In Production: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', 'date', TRUE, '<strong>'.__('First air date: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', TR_GRABBER_FIELD_DATE_LAST, TRUE, '<strong>'.__('Last air date: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', 'genre', TRUE, '<strong>'.__('Genre: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', 'tags', TRUE, '<strong>'.__('Tags: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', 'directors', TRUE, '<strong>'.__('Directors: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', 'rating', TRUE, '<strong>'.__('Rating: ', 'toroplay').'</strong>'); ?>
                </ul>                                    
            </div>
            <!--</Info>-->
            <?php toroplay_post_info($post->ID, '', '', 'cast_single', TRUE); ?>
            <div class="TPostBg Objf"><?php tr_backdrop('w780', $post->ID); ?></div>
        </div>
        <!--</MovieInfo>-->
        <!--<RelatedMovieList>-->
        <?php
        $cat = get_the_category($post->ID);
        foreach ($cat as &$value) $list[]= $value->term_id;
        $list = isset($list) ? implode(',', $list) : '';

        global $query_series, $wp_query;

        $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : get_query_var('paged');

        $query_series = new WP_Query( array(
            'post_type' => 'series',
            'paged' => $paged,
            'cat' => $list,
        ) );

        if ( $query_series->have_posts() ) {
        ?>
        <section>
            <div class="Top">
                <?php echo '<'.get_theme_mod( 'tp_homepagetag', 'h1' ).' class="Title"' .'>'.get_theme_mod('tp_related', __('Related', 'toroplay')).'</'.get_theme_mod( 'tp_homepagetag', 'h1' ).'>' ?>
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
                    <article id="post-<?php the_ID(); ?>" class="TPost C">
                        <a href="<?php the_permalink(); ?>">
                            <div class="Image"><figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo tr_theme_img(get_the_ID(), 'thumbnail', get_the_title()); ?></figure></div>
                            <?php tr_title( 'titlelist', 'Title', true, get_the_title() ); ?>
                            <?php toroplay_entry_header($show_rating=false, $show_year=2, $show_quality=false, $show_runtime=false, $show_views=false, $show_type=false, $single=true); ?>
                        </a>
                        <?php tr_hover(FALSE); ?>
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
        <?php } ?>
        <!--</RelatedMovieList>-->

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>
    </main>
    <!--</Main>-->

    <?php get_sidebar(); ?>

</div>
<!--</TpRwCont>-->