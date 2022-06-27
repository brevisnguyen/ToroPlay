<?php
/**
 * TR Abc widget.
 */
class WP_Widget_Tr_Abc extends WP_Widget {

	/**
	 * Sets up a new Tr Abc widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_a-z',
			'description' => __( 'Search for posts by initial letter.', 'toroplay' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'tr-abc', __( 'Tr Abc', 'toroplay' ), $widget_ops );
		$this->alt_option_name = 'widget_a-z';
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'A-Z', 'toroplay' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];
		
        if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} 
        if ( function_exists( 'tr_alphabet' ) ) :
            tr_alphabet();
        endif;
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
		return $instance;
	}

	/**
	 * Outputs the settings form for the Tr Posts widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'toroplay' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>	
<?php
	}
}