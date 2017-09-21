<?php


namespace calderaLearn\VueWidget;


/**
 * Class Container
 * @package calderaLearn\VueWidget
 */
class Container {

	/**
	 * @var \Pimple\Container
	 */
	protected $pimple;

	public function __construct()
	{
		$this->registerServices();
	}

	/**
	 * Get item from container
	 *
	 * @param string $index
	 *
	 * @return bool|mixed
	 */
	public function get( $index )
	{
		if( $this->has( $index ) ){
			return $this->pimple[ $index ];
		}

		return false;
	}

	/**
	 * Get item from container
	 *
	 * @param $index
	 * @param $value
	 *
	 * @return $this
	 */
	public function set( $index, $value )
	{
		$this->pimple[ $index ] = $value;
		return $this;
	}

	/**
	 * @param $index
	 *
	 * @return bool
	 */
	public function has( $index )
	{
		return $this->pimple->offsetExists( $index );
	}

	/**
	 * Create pimple instance and expose for registration
	 */
	protected function registerServices()
	{
		$this->pimple = new \Pimple\Container();
		do_action( 'calderaLearnVueWidgets.container.register', $this->pimple );
	}
}