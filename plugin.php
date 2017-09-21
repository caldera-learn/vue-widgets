<?php
/**
 Plugin Name: VueJS Widgets
 Text Domain: vuejs-widgets
 */

if( defined( 'CL_VJW_VER' ) ){
	return;
}

define( 'CL_VJW_VER', '0.0.1' );


/**
 * Get main instance of plugin container
 *
 * @return \calderaLearn\VueWidget\Container
 */
function calderaLearnVueJsWidgets(){
	static $calderaLearnVueJsWidgets;
	if( ! is_object( $calderaLearnVueJsWidgets ) ){
		$calderaLearnVueJsWidgets = new \calderaLearn\VueWidget\Container();
	}

	return $calderaLearnVueJsWidgets;
}

/**
 * Bootstrap plugin
 */
add_action( 'plugins_loaded',
	function(){
		//Include autoloader
		include_once __DIR__ . '/vendor/autoload.php';

		//Setup service registration
		add_action( 'calderaLearnVueWidgets.container.register',
			function( $pimple ){
				//register assets and add to container
				$assets = new \calderaLearn\VueWidget\Assets(
					plugin_dir_url(__FILE__),
					CL_VJW_VER
				);
				$pimple[ 'assets' ] = $assets;

				//register frontEndFactory -- used to init widget apps and add to container
				//$frontEndFactory = new \calderaLearn\VueWidget\FrontEndFactory();
				//$pimple [ 'frontEndFactory' ] = $frontEndFactory;

				//Register widgets with WordPress -- don't atatch to container
				( new \calderaLearn\VueWidget\Widgets() )->register();

			}, 9
		);

		//Call container static acesser early
		$container = calderaLearnVueJsWidgets();

	}, 1
);

