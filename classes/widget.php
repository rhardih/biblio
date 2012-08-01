<?php
class BiblioWidget extends WP_Widget {

  public function __construct() {
		parent::__construct(
	 		'biblio',
			'Biblio Widget',
			array( 'description' => 'Display your current readings.' )
		);
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$max_columns = $instance['max_columns'];
		$sex = $instance['sex'];
		$show_sex = isset( $instance['show_sex'] ) ? $instance['show_sex'] : false;

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display name from widget settings if one was input. */
		if ( $max_columns )
      printf( '<p>' . __('Hello. My name is %1$s.', 'example') . '</p>', $max_columns ); ?>


    <?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Biblio', 'max_columns' => '2', 'sex' => 'male', 'show_sex' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
	<?php
	}
}

?>
