<?php


namespace calderaLearn\VueWidget\Widgets;
use calderaLearn\VueWidget\Assets;


/**
 * Class RecentPosts
 * @package calderaLearn\VueWidget\Widgets
 */
class RecentPosts extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'cl_vuejswidgets_recentposts', // Base ID
			'Caldera: Recent Posts', // Name
			array( 'description' => __( 'Show recent posts via WordPress REST API', 'vuejs-widgets' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		$container = calderaLearnVueJsWidgets();
		/** @var Assets $assets */
		$assets = $container->get( 'assets' );
		$assets->enqueue();

		$widgetArgs = [
			'widgetId' => $args[ 'widget_id' ],
			'title' => $instance[ 'title' ],
			'restURL' => $instance[ 'restURL' ]
		];

		echo '<div id="' . esc_attr(  $args [ 'widget_id' ] ) . '"></div>';
		calderaLearnVueJsWidgets()->get( 'assets' )->add( $widgetArgs );
		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance )
	{
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Recent Posts', 'vuejs-widgets' );
		}

		$restUrl = isset( $instance[ 'restURL' ] ) ? $instance[ 'restURL' ] : rest_url();
		?>
		<p>
			<label for="<?php echo $this->get_field_name( 'title' ); ?>">
				<?php _e( 'Title:' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'restURL' ); ?>">
				<?php _e( 'REST API URL:' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'restURL' ); ?>" name="<?php echo $this->get_field_name( 'restURL' ); ?>" type="url" value="<?php echo esc_attr( $restUrl ); ?>" />
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['restURL'] = ( !empty( $new_instance['restURL'] ) ) ? esc_url_raw( $new_instance['restURL'] ) : esc_url_raw( rest_url() );

		return $instance;
	}

}