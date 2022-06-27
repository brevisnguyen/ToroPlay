<?php
/**
 * TR Search widget.
 */
class WP_Widget_Tr_Search extends WP_Widget {

	/**
	 * Sets up a new Tr Search widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'tr_search',
			'description' => __( 'Advanced search widget.', 'toroplay' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'tr-search', __( 'Tr Search', 'toroplay' ), $widget_ops );
		$this->alt_option_name = 'tr_search';
	}

	/**
	 * Outputs the content for the current Tr Search widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Search', 'toroplay' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        
		$show_geners = isset( $instance['show_geners'] ) ? $instance['show_geners'] : false;
		$show_cast = isset( $instance['show_cast'] ) ? $instance['show_cast'] : false;
		$show_countries = isset( $instance['show_countries'] ) ? $instance['show_countries'] : false;
		$show_directors = isset( $instance['show_directors'] ) ? $instance['show_directors'] : false;
		$show_years = isset( $instance['show_years'] ) ? $instance['show_years'] : false;
		$show_quality = isset( $instance['show_quality'] ) ? $instance['show_quality'] : false;
		$show_lang = isset( $instance['show_lang'] ) ? $instance['show_lang'] : false;
		$show_server = isset( $instance['show_server'] ) ? $instance['show_server'] : false;
        
		echo $args['before_widget'];
		
        if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} 
        ?>
        <div class="SearchMovies">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" id="trfilter" autocomplete="off">
                <input type="hidden" name="s" value="trfilter">
                <input type="hidden" name="trfilter" value="1">
                <?php if($show_years){ ?>
                <!--<select>-->
                <div class="Frm-Slct AACont" id="trfilter_1">
                    <label class="AAIco-date_range"><?php _e('Years', 'toroplay'); ?></label>
                    <div class="Form-Group">
                        <ul class="trselect_results trsrclst"></ul>
                        <label class="Form-Icon Right">
                            <input class="trselect_text_inp" type="text" value="" placeholder="<?php _e('Write the year', 'toroplay') ?>" data-type="1">
                            <i class="AAIco-search"></i>
                        </label>
                        <div class="trsrcbx trselectcnt" style="display:none">
                            <ul class="trselect trselect_text trselectyears" data-name="years" data-type="1">
                                <?php
                                    for ($iyear = 1888; $iyear <= date('Y'); $iyear++) {
                                        echo '<li data-val="'.$iyear.'" data-value="'.$iyear.'"><label><button type="button">'.$iyear.'</button></label></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_directors){ ?>
                <!--<select>-->
                <div class="Frm-Slct" id="trfilter_2">
                    <label class="AAIco-videocam"><?php _e('Directors', 'toroplay'); ?></label>
                    <div class="Form-Group">
                        <ul class="trselect_results trsrclst"></ul>
                        <label class="Form-Icon Right">
                            <input class="trselect_search_inp" type="text" value="" placeholder="<?php _e('Write the name', 'toroplay') ?>" data-type="2">
                            <i class="AAIco-search"></i>
                        </label>
                        <div class="trsrcbx trselectcnt" style="display:none" data-type="2"></div>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_cast){ ?>
                <!--<select>-->
                <div class="Frm-Slct" id="trfilter_3">
                    <label class="AAIco-person"><?php _e('Cast', 'toroplay'); ?></label>
                    <div class="Form-Group">
                        <ul class="trselect_results trsrclst"></ul>
                        <label class="Form-Icon Right">
                            <input class="trselect_search_inp" type="text" value="" placeholder="<?php _e('Write the name', 'toroplay') ?>" data-type="3">
                            <i class="AAIco-search"></i>
                        </label>
                        <div class="trsrcbx trselectcnt" style="display:none" data-type="3"></div>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_countries){ ?>
                <!--<select>-->
                <div class="Frm-Slct" id="trfilter_4">
                    <label class="AAIco-videocam"><?php _e('Countries', 'toroplay'); ?></label>
                    <div class="Form-Group">
                        <ul class="trselect_results trsrclst"></ul>
                        <label class="Form-Icon Right">
                            <input class="trselect_search_inp" type="text" value="" placeholder="<?php _e('Write the name', 'toroplay') ?>" data-type="4">
                            <i class="AAIco-search"></i>
                        </label>
                        <div class="trsrcbx trselectcnt" style="display:none" data-type="4"></div>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_geners){ ?>
                <!--<select>-->
                <div class="Frm-Slct" id="trfilter_5">
                    <label class="AAIco-movie_creation"><?php _e('Genres', 'toroplay'); ?></label>
                    <div class="Form-Group">
                        <ul class="trselect_results trsrclst"></ul>
                        <label class="Form-Icon Right">
                            <input class="trselect_text_inp" type="text" value="" placeholder="<?php _e('Write the category', 'toroplay') ?>" data-type="5">
                            <i class="AAIco-search"></i>
                        </label>
                        <div class="trsrcbx trselectcnt" style="display:none">
                            <ul class="trselect trselect_text" data-name="geners" data-type="5">
                                <?php
                                    $categories = get_categories( array(
                                        'orderby' => 'name',
                                    ) );
                                    foreach ( $categories as $category ) {
                                        echo '<li data-val="'.$category->name.'" data-value="'.$category->term_id.'"><label><button type="button">'.$category->name.'</button></label></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_quality){ ?>
                <!--<select>-->
                <div class="Frm-Slct" id="trfilter_6">
                    <label class="AAIco-equalizer"><?php _e('Quality', 'toroplay'); ?></label>
                    <div class="Form-Group">
                        <ul class="trselect_results trsrclst"></ul>
                        <label class="Form-Icon Right">
                            <input class="trselect_text_inp" type="text" value="" placeholder="<?php _e('Write the quality', 'toroplay') ?>" data-type="6">
                            <i class="AAIco-search"></i>
                        </label>
                        <div class="trsrcbx trselectcnt" style="display:none">
                            <ul class="trselect trselect_text" data-name="qualitys" data-type="6">
                                <?php
                                    $qualitys = get_categories( array(
                                        'orderby' => 'name',
                                        'taxonomy' => 'quality',
                                        'hide_empty' => 0,
                                    ) );
                                    foreach ( $qualitys as $quality ) {
                                        echo '<li data-val="'.$quality->name.'" data-value="'.$quality->term_id.'"><label><button type="button">'.$quality->name.'</button></label></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_lang){ ?>
                <!--<select>-->
                <div class="Frm-Slct">
                    <label class="AAIco-language"><?php _e('Languages', 'toroplay'); ?></label>
                    <div class="Form-Group" id="trfilter_7">
                        <ul class="trselect_results trsrclst"></ul>
                        <label class="Form-Icon Right">
                            <input class="trselect_text_inp" type="text" value="" placeholder="<?php _e('Write the language', 'toroplay') ?>" data-type="7">
                            <i class="AAIco-search"></i>
                        </label>
                        <div class="trsrcbx trselectcnt" style="display:none">
                            <ul class="trselect trselect_text" data-name="langs" data-type="7">
                                <?php
                                    $languages = get_categories( array(
                                        'orderby' => 'name',
                                        'taxonomy' => 'language',
                                        'hide_empty' => 0,
                                    ) );
                                    foreach ( $languages as $lang ) {
                                        echo '<li data-val="'.$lang->name.'" data-value="'.$lang->term_id.'"><label><button type="button">'.$lang->name.'</button></label></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_server){ ?>
                <!--<select>-->
                <div class="Frm-Slct" id="trfilter_8">
                    <label class="AAIco-storage"><?php _e('Servers', 'toroplay'); ?></label>
                    <div class="Form-Group">
                        <ul class="trselect_results trsrclst"></ul>
                        <label class="Form-Icon Right">
                            <input class="trselect_text_inp" type="text" value="" placeholder="<?php _e('Write the server', 'toroplay') ?>" data-type="8">
                            <i class="AAIco-search"></i>
                        </label>
                        <div class="trsrcbx trselectcnt" style="display:none">
                            <ul class="trselect trselect_text" data-name="servers" data-type="8">
                                <?php
                                    $servers = get_categories( array(
                                        'orderby' => 'name',
                                        'taxonomy' => 'server',
                                        'hide_empty' => 0,
                                    ) );
                                    foreach ( $servers as $server ) {
                                        echo '<li data-val="'.$server->name.'" data-value="'.$server->term_id.'"><label><button type="button">'.$server->name.'</button></label></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                <button class="Button" type="submit"><?php _e('SEARCH', 'toroplay'); ?></button>
            </form>
        </div>
        <?php
        echo $args['after_widget'];        
	}

	/**
	 * Handles updating the settings for the current Tr Posts widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['show_geners'] = isset( $new_instance['show_geners'] ) ? (bool) $new_instance['show_geners'] : false;
		$instance['show_cast'] = isset( $new_instance['show_cast'] ) ? (bool) $new_instance['show_cast'] : false;
		$instance['show_countries'] = isset( $new_instance['show_countries'] ) ? (bool) $new_instance['show_countries'] : false;
		$instance['show_directors'] = isset( $new_instance['show_directors'] ) ? (bool) $new_instance['show_directors'] : false;
		$instance['show_years'] = isset( $new_instance['show_years'] ) ? (bool) $new_instance['show_years'] : false;
		$instance['show_quality'] = isset( $new_instance['show_quality'] ) ? (bool) $new_instance['show_quality'] : false;
		$instance['show_lang'] = isset( $new_instance['show_lang'] ) ? (bool) $new_instance['show_lang'] : false;
		$instance['show_server'] = isset( $new_instance['show_server'] ) ? (bool) $new_instance['show_server'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Tr Posts widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$show_geners = isset( $instance['show_geners'] ) ? (bool) $instance['show_geners'] : true;
		$show_cast = isset( $instance['show_cast'] ) ? (bool) $instance['show_cast'] : true;
		$show_countries = isset( $instance['show_countries'] ) ? (bool) $instance['show_countries'] : true;
		$show_directors = isset( $instance['show_directors'] ) ? (bool) $instance['show_directors'] : true;
		$show_years = isset( $instance['show_years'] ) ? (bool) $instance['show_years'] : true;
		$show_quality = isset( $instance['show_quality'] ) ? (bool) $instance['show_quality'] : true;
		$show_lang = isset( $instance['show_lang'] ) ? (bool) $instance['show_lang'] : true;
		$show_server = isset( $instance['show_server'] ) ? (bool) $instance['show_server'] : true;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'toroplay' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_geners ); ?> id="<?php echo $this->get_field_id( 'show_geners' ); ?>" name="<?php echo $this->get_field_name( 'show_geners' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_geners' ); ?>"><?php _e( 'Display filter gener?', 'toroplay' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_cast ); ?> id="<?php echo $this->get_field_id( 'show_cast' ); ?>" name="<?php echo $this->get_field_name( 'show_cast' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_cast' ); ?>"><?php _e( 'Display filter cast?', 'toroplay' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_countries ); ?> id="<?php echo $this->get_field_id( 'show_countries' ); ?>" name="<?php echo $this->get_field_name( 'show_countries' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_countries' ); ?>"><?php _e( 'Display filter countries?', 'toroplay' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_directors ); ?> id="<?php echo $this->get_field_id( 'show_directors' ); ?>" name="<?php echo $this->get_field_name( 'show_directors' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_directors' ); ?>"><?php _e( 'Display filter directors?', 'toroplay' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_years ); ?> id="<?php echo $this->get_field_id( 'show_years' ); ?>" name="<?php echo $this->get_field_name( 'show_years' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_years' ); ?>"><?php _e( 'Display filter year?', 'toroplay' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_quality ); ?> id="<?php echo $this->get_field_id( 'show_quality' ); ?>" name="<?php echo $this->get_field_name( 'show_quality' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_quality' ); ?>"><?php _e( 'Display filter quality?', 'toroplay' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_lang ); ?> id="<?php echo $this->get_field_id( 'show_lang' ); ?>" name="<?php echo $this->get_field_name( 'show_lang' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_lang' ); ?>"><?php _e( 'Display filter language?', 'toroplay' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_server ); ?> id="<?php echo $this->get_field_id( 'show_server' ); ?>" name="<?php echo $this->get_field_name( 'show_server' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_server' ); ?>"><?php _e( 'Display filter server?', 'toroplay' ); ?></label></p>
<?php
	}
}