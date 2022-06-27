<?php
/**
 * The template for displaying taxonomy letters page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroflix
 */
get_header(); ?>            
                
<section>

    <div class="Top">
        <?php tr_title('tp_letters', 'Title'); ?>
    </div>

    <?php
    if ( function_exists( 'tr_alphabet' ) ) :
        tr_alphabet();
    endif;
    ?>
    
    <?php
        if ( have_posts() ) :

        global $wp_query;
    ?>

    <div class="Wdgt">
        <div class="TPTblCn TPTblCnMvs">
            <table>
                <thead>
                    <tr>
                        <th><?php _e('#', 'toroplay'); ?></th>
                        <th colspan="2"><?php printf( __('%s Results', 'toroplay'), $wp_query->found_posts ); ?></th>
                        <th><?php _e('Year', 'toroplay'); ?></th>
                        <th><?php _e('Quality', 'toroplay'); ?></th>
                        <th><?php _e('Duration', 'toroplay'); ?></th>
                        <th><?php _e('Genres', 'toroplay'); ?></th>
                        <?php if(function_exists('the_ratings')){ ?>
                        <th><?php _e('VOTES', 'toroplay'); ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=1;
                        // Start the loop.
                        while ( have_posts() ) : the_post();
                        if($i<=9){ $zero='0'; }else{ $zero=''; }
                    ?>
                    <tr>
                        <td><span class="Num"><?php echo $zero.$i; ?></span></td>
                        <td class="MvTbImg">
                            <a href="<?php the_permalink(); ?>" class="MvTbImg">
                                <?php echo tr_theme_img(get_the_ID(), 'widget', get_the_title()); ?>
                                <?php tr_icon_tv(NULL, true); ?>
                            </a>
                        </td>
                        <td class="MvTbTtl">
                            <a href="<?php the_permalink(); ?>" class="MvTbImg">
                                <strong><?php the_title(); ?></strong>
                            </a>
                        </td>
                        <td><?php toroplay_letters_header(false, false, $show_year=true); ?></td>
                        <td>
                            <p class="Info">
                                <?php toroplay_letters_header($show_quality=true); ?>
                            </p>
                        </td>
                        <td><?php toroplay_letters_header(false, $show_runtime=true); ?></td>
                        <td>
                            <?php
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                                }
                            ?>
                        </td>
                        <?php if(function_exists('the_ratings')) { ?>
                        <td><p class="Info"><span class="Vote AAIco-star"><?php tr_rating_format_number($post->ID, true); ?></span></p></td>
                        <?php } ?>
                    </tr>
                    <?php
                        $i++;
                        // End the loop.
                        endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
        if(function_exists('tr_pagination')) :
            tr_pagination();
        endif;
    ?>
    
    <?php
        // If no content, include the "No posts found" template.
        else :
            get_template_part( 'template-parts/content/none' );

        endif;
    ?>

</section>
		        
<?php get_footer(); ?>