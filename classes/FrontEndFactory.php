<?php


namespace calderaLearn\VueWidget;


/**
 * Class CreateWidget
 * @package calderaLearn\VueWidget
 */
class FrontEndFactory {

	protected $widgets;

	public function __construct( array  $widgets = [] )
	{
		$this->widgets = $widgets;
	}

	/**
	 * Add a widget to be loaded
	 *
	 * @param string $id ID of widget
	 * @param string $type Type of widget
	 *
	 * @return $this
	 */
	public function add( $id, $type )
	{
		if( ! $this->valid( $type ) ){
			return $this;
		}
		if( empty( $this->widgets ) ){
			$this->addHooks();
			$this->widgets = [];
		}
		$this->widgets[ $id ] = $type;

		return $this;
	}

	/**
	 * Check if is a valid type of widget for this plugin
	 *
	 * @param string $type
	 *
	 * @return bool
	 */
	protected function valid( $type )
	{
		return in_array( $type, [
			'RecentPosts'
		]);
	}

	/**
	 * Add hooks for widgets to work
	 */
	protected function addHooks(){
		$container = calderaLearnVueJsWidgets();
		/** @var Assets $assets */
		$assets = $container->get( 'assets' );
		$assets->enqueue();
		add_action( 'wp_footer', [ $this, 'footer' ] );
	}

}