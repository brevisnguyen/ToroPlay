<?php
/**
 * TR Ads widget.
 */
class WP_Widget_Tr_Ads extends WP_Widget {

	/**
	 * Sets up a new Tr Ads widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'tr_ads',
			'description' => __( 'Add advertising on your sidebar.', 'toroplay' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'tr-ads', __( 'Tr Ads', 'toroplay' ), $widget_ops );
		$this->alt_option_name = 'widget_ads';
	}

	/**
	 * Outputs the content for the current Tr Abc widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        
		$widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';

		$text = apply_filters( 'widget_text', $widget_text, $instance, $this );

		$widget_text2 = ! empty( $instance['text2'] ) ? $instance['text2'] : '';
        
		$text2 = apply_filters( 'widget_text', $widget_text2, $instance, $this );
    ?>
        <div class="Dvr-300">
            <?php if(wp_is_mobile()){ echo stripslashes($text2); }else{ echo stripslashes($text); } ?>
        </div>
    <?php       
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
        $instance['text'] = $new_instance['text'];
        $instance['text2'] = $new_instance['text2'];
		return $instance;
	}

	/**
	 * Outputs the settings form for the Tr Posts widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $text = isset($instance['text']) ? $instance['text'] : '<img src="'.get_template_directory_uri().'/img/cnt/toroplay-300.png" alt="">';
        $text2 = isset($instance['text2']) ? $instance['text2'] : '<img src="'.get_template_directory_uri().'/img/cnt/toroplay-300.png" alt="">';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'toroplay' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Content:', 'toroplay' ); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( stripslashes( $text ) ); ?></textarea>
		</p>	
		
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Content Mobile:', 'toroplay' ); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text2' ); ?>" name="<?php echo $this->get_field_name( 'text2' ); ?>"><?php echo esc_textarea( stripslashes( $text2 ) ); ?></textarea>
		</p>
<?php
	}
}