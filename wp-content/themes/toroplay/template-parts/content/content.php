<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ToroPlay
 */
?>
<section>
    <div class="Top">
        <?php tr_title('list', 'Title'); ?>
        <?php tr_type_checkbox(); ?>
    </div>
    <ul<?php tr_content_class(2, "MovieList NoLmtxt Rows AX A06 B04 C03"); ?>>
        <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
        ?>
        <!--<TPostMv>-->
        <li class="TPostMv">
            <article id="post-<?php the_ID(); ?>" class="TPost C">
                <a href="<?php the_permalink(); ?>">
                    <div class="Image">
                        <figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo tr_theme_img(get_the_ID(), 'thumbnail', get_the_title()); ?></figure>
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
            endwhile;
        ?>

    </ul>
</section>