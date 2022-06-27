<?php
/**
 * Template Name: Seasons
 */
get_header();
?>

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
                       
            <?php get_template_part( 'template-parts/index/seasons' ); ?>
            
            <?php tr_banners('ads_list_bottom'); ?>
            
            <?php
                if(function_exists('tr_pagination')) :
                    global $totalpages_tax;
                    tr_pagination(1, $totalpages_tax);
                endif;
            ?>
                        
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