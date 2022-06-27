<?php
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) { return; }

if( is_tax('episodes') or is_tax('seasons') ) {
    
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

    $tr_post_id = get_term_meta($term->term_id, 'tr_id_post', true);

    $args = array(
       'post_id' => $tr_post_id
    );

    $comments_query = new WP_Comment_Query;
    $comments = $comments_query->query( $args );

    $pages = get_comment_pages_count( $comments );
    
}else{
    global $post;
    
    $tr_post_id = $post->ID;

    $pages = '';
    
}
?>
<?php if ( comments_open() ) : ?>
<!--<Comments>-->
<div class="Wdgt" id="comments">
    <div class="Title"><?php printf( __('Comments %s%s%s', 'toroplay'), '<span>', number_format_i18n(get_comments_number($tr_post_id)), '</span>' ); ?></div>

    <?php comment_form( array( 'comment_notes_before' => '', 'comment_notes_after' => '', 'title_reply' => '', 'title_reply_before' => '', 'title_reply_after' => '' ) ); ?>
    <?php if ( have_comments() ) : ?>
    <ul class="CommentsList">
        <?php 
            $comments = get_comments(array(
                'post_id' => $tr_post_id,
                'status' => 'approve'
            ));
            wp_list_comments( array( 'callback' => 'tr_theme_comment' ) );
        ?>
    </ul>
    <?php endif; // end have_comments() ?>
    <?php if ( get_comment_pages_count($pages) > 1 && get_option( 'page_comments' ) ) : ?>
        <?php echo tr_pagination(2); ?>
    <?php endif; ?>

</div>
<!--</Comments>-->
<?php endif; ?>