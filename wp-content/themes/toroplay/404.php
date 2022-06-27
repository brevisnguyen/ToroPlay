<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ToroPlay
 */

get_header(); ?>
               
<!--<TpRwCont>-->
<div class="TpRwCont">
    <!--<Main>-->
    <main>
        <div class="Title-404 AAIco-sentiment_dissatisfied"><?php printf( __('%s404%s %sSorry, we have nothing to show%s', 'toroplay'), '<strong>', '</strong>', '<span>', '</span>') ?></div>
    </main>
    <!--</Main>-->
</div>
<!--</TpRwCont>-->

<?php get_footer(); ?>