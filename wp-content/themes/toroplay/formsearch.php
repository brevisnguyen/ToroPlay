<?php
/**
 * Template for displaying search forms in Toroplay
 *
 * @package Toroplay
 */
?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" autocomplete="off">
    <label class="Form-Icon">
        <input autocomplete="off" type="search" value="<?php echo get_search_query(); ?>" name="s" id="tr_live_search" placeholder="<?php _e('Search...', 'toroplay'); ?>">
        <button id="searchsubmit" type="submit"><i class="fa-search"></i></button>
    </label>
    <?php if( get_theme_mod('show_suggestsearch', 1) == 1 ){ ?>
    <div class="Result anmt" id="tr_live_search_content">
        <p class="trloading"><i class="fa-spinner fa-spin"></i><?php _e('Loading', 'toroplay'); ?></p>
    </div>
    <?php } ?>
</form>