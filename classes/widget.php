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

		$title = apply_filters('widget_title', $instance['title'] );
		$max_columns = $instance['max_columns'];
		$sex = $instance['sex'];
		$show_sex = isset( $instance['show_sex'] ) ? $instance['show_sex'] : false;
    
    $readings = Read::all(Read::Begun);

    if(count($readings) > 0) {
		  echo $before_widget;
      
		  if ( $title )
		  	echo $before_title . $title . $after_title;

      foreach ( $readings as $read ) {
        if ($read['link'] !== '') {
          echo '<a href="' .  $read['link'] . '">';
        }

        echo '<img src="' . $read['illustration'] . '" /><br />';
        echo '<b>' . $read['title'] . '</b>';

        if ($read['link'] !== '') {
          echo '</a>';
        }

        echo '<br />' . $read['author'] . '<br /><br />';

      }

		  echo $after_widget;
    }
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Current readings', 'max_columns' => '2', 'sex' => 'male', 'show_sex' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
	<?php
	}
}

?>
