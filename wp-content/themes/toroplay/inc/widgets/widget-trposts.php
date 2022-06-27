<?php

class WP_Widget_Trposts extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_trposts', 'description' => __( "Widget to display posts ordered in different ways: past, voted, visited...", 'toroplay') );
		parent::__construct('tr-posts', __('TR Posts', 'toroplay'), $widget_ops);
		$this->alt_option_name = 'widget_trposts';
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'TR Posts', 'toroplay' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        
		$order = isset( $instance['order'] ) ? $instance['order'] : 1;
        $filter = $instance['filter'];
		$type = isset( $instance['type'] ) ? $instance['type'] : 0;
		$design = isset( $instance['design'] ) ? $instance['design'] : 0;
        $tag = isset( $instance['tag'] ) ? $instance['tag'] : 'div';
        $related = isset( $instance['related'] ) ? $instance['related'] : '';
        
        if($type==0){
        
            if($order==1){
                
                $args=array(

                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'order' => 'DESC',
                    'orderby' => 'date',
                    'post_type' => 'movies',

                );

            }elseif($order==2){
                
                $args=array(

                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'meta_key' => 'views',
                    'orderby' => 'meta_value_num',
                    'post_type' => 'movies',

                );

            }elseif($order==3){
                
                $args=array(

                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'meta_key' => 'ratings_average',
                    'orderby' => 'meta_value_num',
                    'post_type' => 'movies'

                );

            }else{
                
                $args=array(

                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'orderby' => 'rand',
                    'post_type' => 'movies',

                );

            }
            
        }elseif($type==1){
            
            if($order==1){

                $args=array(
                            
                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'order' => 'DESC',
                    'orderby' => 'date',
                    'post_type' => 'series',

                );

            }elseif($order==2){
                
                $args=array(

                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'meta_key' => 'views',
                    'orderby' => 'meta_value_num',
                    'post_type' => 'series',

                );

            }elseif($order==3){
                
                $args=array(

                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'meta_key' => 'ratings_average',
                    'orderby' => 'meta_value_num',
                    'post_type' => 'series',

                );

            }else{

                $args=array(

                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'orderby' => 'rand',
                    'post_type' => 'series',

                );
                
            }
            
        }else{
            
            if($order==1){
                
                $args=array(

                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'order' => 'DESC',
                    'orderby' => 'date',
                    'post_type' => array('movies', 'series'),

                );

            }elseif($order==2){

                $args=array(

                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'meta_key' => 'views',
                    'orderby' => 'meta_value_num',
                    'post_type' => array('movies', 'series'),

                );

            }elseif($order==3){

                
                $args=array(

                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'meta_key' => 'ratings_average',
                    'orderby' => 'meta_value_num',
                    'post_type' => array('movies', 'series'),

                );

            }else{

                $args=array(
                    
                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'cat' => $filter,
                    'orderby' => 'rand',
                    'post_type' => array('movies', 'series'),
                    
                );

            }
            
        }
        
        if ( false === ( $query_results = get_transient( 'trposts'.$type.$order.$number.$filter.'_query_results' ) ) ) {

            $query_results = new WP_Query( $args );
            set_transient( 'trposts'.$type.$order.'_query_results' , $query_results, 12 * HOUR_IN_SECONDS );
        }

        if ($query_results->have_posts() ) :
		?>
        <!--<TopMovies>-->
        <div class="Wdgt">
            <?php if ( $title ) { ?>
            <div class="Title"><?php echo $title; ?></div>
            <?php } ?>
            
            <?php if($design==1){ ?>
            <div class="TpSbList">
                <ul class="MovieList Rows AF A04">
		            <?php 
                        $i=1;
                        while( $query_results->have_posts() ) {		
                            $query_results->the_post();
                    ?>
                    <!--<Post>-->
                    <li>
                        <div class="TPost B">
                            <a href="<?php the_permalink(); ?>">
                                <div class="Image">
                                    <figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo tr_theme_img(get_the_ID(), 'widget', get_the_title()); ?></figure>
                                    <?php if( empty( $related ) ){ echo tr_check_type(get_the_ID()) == 2 ? '<span class="TpTv BgA">'.__('TV', 'toroplay').'</span>' : ''; } ?>
                                </div>
                                <?php echo '<'.$tag.' class="Title">'.tr_theme_clip_text(get_the_title(), 30).'</'.$tag.'>'; ?>
                            </a>
                        </div>
                    </li>
                    <!--</Post>-->
		            <?php $i++; } ?>
                </ul>
            </div>
            <?php }else{ ?>
            <ul class="MovieList">
                <?php 
                    $i=1;
                    while( $query_results->have_posts() ) {
                    $query_results->the_post();
                ?>
                    <!--<Post>-->
                    <li>
                        <div class="TPost A">
                            <a rel="bookmark" href="<?php the_permalink(); ?>">
                                <span class="Top">#<?php echo $i; ?><i></i></span>
                                <div class="Image"><figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo tr_theme_img(get_the_ID(), 'widget', get_the_title()); ?></figure></div>
                                <div class="Title">
                                    <?php the_title(); ?>
                                    <?php if( empty($related) ) { echo tr_check_type(get_the_ID()) == 2 ? '<span class="TpTv BgA">'.__('TV', 'toroplay').'</span>' : ''; } ?>
                                </div>
                            </a>
                            <p class="Info">
                                <?php toroplay_entry_header($show_rating=true, $show_year=true, $show_quality=true, $show_runtime=true, $show_views=false); ?>
                            </p>
                        </div>
                    </li>
                    <!--</Post>-->					
		            <?php $i++; } ?>
                </ul>
                <?php } ?>
            </div>
            <!--</TopMovies>-->
		<?php
		wp_reset_postdata();

		endif;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['order'] = isset( $new_instance['order'] ) ? (int) $new_instance['order'] : false;
        $instance['filter'] = strip_tags(implode(',', $new_instance['filter']));
		$instance['type'] = isset( $new_instance['type'] ) ? (int) $new_instance['type'] : 0;
		$instance['design'] = isset( $new_instance['design'] ) ? (int) $new_instance['design'] : 0;
		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$order = isset( $instance['order'] ) ? (int) $instance['order'] : false;
		$filter = isset($instance['filter']) ? $instance['filter'] :false;
		$type = isset( $instance['type'] ) ? absint($instance['type']) : 0;
		$design = isset( $instance['design'] ) ? absint($instance['design']) : 0;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'toroplay' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'toroplay' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order', 'toroplay'); ?></label>
            <select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
                <option<?php selected($order, 1 ); ?> value="1"><?php _e('Latest', 'toroplay'); ?></option>
                <option<?php selected($order, 2 ); ?> value="2"><?php _e('Views (Require WP-PostViews)', 'toroplay'); ?></option>
                <option<?php selected($order, 3 ); ?> value="3"><?php _e('Best rated (Require WP-PostRatings)', 'toroplay'); ?></option>
                <option<?php selected($order, 4 ); ?> value="4"><?php _e('Random', 'toroplay'); ?></option>
            </select>                
        </p>
        
		<p><?php _e('Filter categories', 'toroplay'); ?></p>
		<ul>
            <?php
            $lst=''; $ar='';
        
                $ar=explode(',', $filter);
                foreach ($ar as &$value) {
                    $lst[$value] = $value;
                }
                $categories = get_categories('hide_empty=0');
                foreach ($categories as $category) {
            ?>
		    <li>
		        <input <?php if(isset($lst[$category->term_id])){checked( $lst[$category->term_id], $category->term_id); } ?> type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('filter'); ?>[]" value="<?php echo $category->term_id; ?>"  />
		        <label><?php echo $category->cat_name ?></label><br />
		    </li>
		    <?php
                }
            ?>
		</ul>
		
        <p>
            <label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Type', 'toroplay' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
                <option value="0"><?php _e( '&mdash; Select &mdash;', 'toroplay' ); ?></option>
                    <option value="0" <?php selected( $type, 0 ); ?>>
                        <?php _e('Movies', 'toroplay'); ?>
                    </option>
                    <option value="1" <?php selected( $type, 1 ); ?>>
                        <?php _e('Series', 'toroplay'); ?>
                    </option>
                    <option value="2" <?php selected( $type, 2 ); ?>>
                        <?php _e('All', 'toroplay'); ?>
                    </option>
            </select>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'design' ); ?>"><?php _e( 'Design', 'toroplay' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'design' ); ?>" name="<?php echo $this->get_field_name( 'design' ); ?>">
                <option value="0"><?php _e( '&mdash; Select &mdash;', 'toroplay' ); ?></option>
                    <option value="0" <?php selected( $design, 0 ); ?>>
                        <?php _e('List', 'toroplay'); ?>
                    </option>
                    <option value="1" <?php selected( $design, 1 ); ?>>
                        <?php _e('Box', 'toroplay'); ?>
                    </option>
            </select>
        </p>
<?php
	}
}