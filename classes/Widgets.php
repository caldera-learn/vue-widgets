<?php


namespace calderaLearn\VueWidget;


/**
 * Class Widgets
 * @package calderaLearn\VueWidget
 */
class Widgets {

	protected $widgets = [
		'RecentPosts'
	];

	public function register()
	{
		add_action( 'widgets_init',
			function() {
				foreach ( $this->widgets as $widget ){
					$class = 'calderaLearn\VueWidget\Widgets\\' . $widget;
					register_widget( $class );
				}
			}
		);
	}
}