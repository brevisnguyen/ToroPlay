<!--<TpRwCont>-->
<div<?php tr_content_class($type=1); ?>>
    <!--<Main>-->
    <main>
        
        <?php tr_banners('ads_singlem_top'); ?>

        <!--<Single>-->
        <article class="TPost Single">
            <header>
                <?php tr_title( 'tp_single', 'Title' ); ?>
                <?php toroplay_shared_button($post->ID); ?>
                <?php toroplay_post_info($post->ID, 'div', 'SubTitle', TR_GRABBER_ORIGINAL_TITLE); ?>
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
        
        <?php tr_banners('ads_singlem_bottom'); ?>
        
        <?php
            $links = tr_links_movies($post->ID);
            $links['online'] = !empty($links['online']) ? $links['online'] : '';
            $links['downloads'] = !empty($links['downloads']) ? $links['downloads'] : '';
            tr_player_movies($links['online'], $post->ID);
        ?>
        
        <?php tr_downloads_movies($links['downloads'], $post->ID); ?>

        <!--<MovieInfo>-->
        <div class="MovieInfo TPost Single">
            <div class="MovieTabNav">
                <div class="Lnk on AAIco-description" data-Mvtab="MvTb-Info"><?php _e('Info', 'toroplay'); ?></div>
                <div class="Lnk AAIco-movie_filter" data-Mvtab="MvTb-Cast"><?php _e('Cast', 'toroplay'); ?></div>
                <div class="Lnk AAIco-comment" data-Mvtab="MvTb-Comment"><?php printf( __('Comments %s%s%s', 'toroplay'), '<span>phim ', get_the_title($post->ID), '</span>' ); ?></div>
            </div>
            <!--<Info>-->
            <div class="MvTbCn on anmt" id="MvTb-Info">
                <ul class="InfoList">
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', TR_GRABBER_ORIGINAL_TITLE, TRUE, '<strong>'.__('Original title: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', 'date', TRUE, '<strong>'.__('Release date: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', 'genre', TRUE, '<strong>'.__('Genre: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', 'tags', TRUE, '<strong>'.__('Tags: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', 'directors', TRUE, '<strong>'.__('Directors: ', 'toroplay').'</strong>'); ?>
                    <?php toroplay_post_info($post->ID, 'li', 'AAIco-adjust', 'rating', TRUE, '<strong>'.__('Rating: ', 'toroplay').'</strong>'); ?>
                </ul>                     
            </div>
            <!--</Info>-->
             <?php toroplay_post_info($post->ID, '', '', 'cast_single', TRUE); ?>
            <!-- FB Comments -->
            <div class="MvTbCn anmt" id="MvTb-Comment">
                <div class="fb-comments" style="background-color: rgba(255,255,255,.9);" data-href="<?php global $wp; echo add_query_arg( $wp->query_vars, home_url( $wp->request ) ); ?>" data-width="100%" data-order-by="time"></div>
            </div>
            <!-- FB Comments -->
            <div class="TPostBg Objf"><?php tr_backdrop('w780', $post->ID); ?></div>
        </div>
        <!--</MovieInfo>-->
        <!--<RelatedMovieList>-->
        <?php
        $cat = get_the_category($post->ID);
        foreach ($cat as &$value) $list[]= $value->term_id;
        $list = isset($list) ? implode(',', $list) : '';

        global $query_movies, $wp_query;

        $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : get_query_var('paged');

        $query_movies = new WP_Query( array(
            'post_type' => 'movies',
            'paged' => $paged,
            'cat' => $list,
        ) );

        if ( $query_movies->have_posts() ) {
        ?>
        <section>
            <div class="Top">
                <?php echo '<'.get_theme_mod( 'tp_homepagetag', 'h1' ).' class="Title"' .'>'.get_theme_mod('tp_related', __('Related', 'toroplay')).'</'.get_theme_mod( 'tp_homepagetag', 'h1' ).'>' ?>
                <?php tr_viewmore('movies'); ?>
            </div>
            <ul<?php tr_content_class(2, "MovieList NoLmtxt Rows AX A06 B04 C03"); ?>>
                <?php
                    // Start the loop.
                    while ( $query_movies->have_posts() ) {
                        $query_movies->the_post();
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