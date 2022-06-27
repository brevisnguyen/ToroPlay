<?php

function tr_postratings_porc($id, $type=1) {

    if($type==1){

        $post_ratings_score = get_post_meta($id, 'ratings_score', true);
        $post_ratings_users = get_post_meta($id, 'ratings_users', true);
        $ratings_max = intval(get_option('postratings_max'));
        if(empty($post_ratings_score) and empty($post_ratings_users)){
          $post_ratings_percentage = 0;
        }else{
          $post_ratings_percentage = round((($post_ratings_score/$post_ratings_users)/$ratings_max) * 100);
        }

    }else{

        $post_ratings_score = get_post_meta($id, 'ratings_score', true);
        $post_ratings_users = get_post_meta($id, 'ratings_users', true);
        $ratings_max = intval(get_option('postratings_max'));

        if(empty($post_ratings_score) and empty($post_ratings_users)){
          $post_ratings_percentage = 0;
        }else{
          $post_ratings_percentage = round((($post_ratings_score/$post_ratings_users)/$ratings_max) * 100);
        }

    }

    return $post_ratings_percentage;

}

add_action( 'wp_ajax_trpostratings', 'trpostratings_callback' );
add_action('wp_ajax_nopriv_trpostratings', 'trpostratings_callback');

function trpostratings_callback() {

    $nonce = $_POST['_nonce'];

    if ( ! wp_verify_nonce( $nonce, 'postratings_'.intval($_POST['id']).'-nonce' ) )

    wp_die ( 'Die!');

    if($_POST['action'] == 'trpostratings') {
        echo '<div id="TPVotes" data-percent="'.tr_postratings_porc(intval($_POST['id']), 2).'"></div>';
    }
    exit;
}