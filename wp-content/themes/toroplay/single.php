<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Toroplay
 */

get_header(); ?>

    <?php
        while ( have_posts() ) : the_post();
        $type = tr_check_type($post->ID) == 1 ? 'movies' : 'series';
    ?>

    <?php get_template_part( 'template-parts/single/single-'.$type ); ?>

    <?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>