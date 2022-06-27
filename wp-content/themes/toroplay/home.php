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

    <?php
        
    if ( have_posts() ) :

        if ( function_exists( 'tr_alphabet' ) ) :
            tr_alphabet();
        endif;

    ?>

    <?php get_template_part( 'template-parts/slider/fixed' ); ?>

    <!--<TpRwCont>-->
    <div<?php tr_content_class($type=1); ?>>
        <!--<Main>-->
        <main>
            
            <?php tr_banners('ads_list_top'); ?>
                                    
            <?php
            
                $templates = tr_homecontrol($type=2);
                
                foreach ($templates as &$value) { get_template_part( 'template-parts/'.$value ); }

            ?>
            
            <?php tr_banners('ads_list_bottom'); ?>
                        
        </main>
        <!--</Main>-->

        <?php get_sidebar(); ?>

    </div>
    <!--</TpRwCont>-->

    <?php
    else :

        get_template_part( 'template-parts/content/none' );

    endif;
    ?>

<?php get_footer(); ?>