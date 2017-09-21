<?php


namespace calderaLearn\VueWidget;


/**
 * Class Assets
 * @package calderaLearn\VueWidget
 */
class Assets {

	/**
	 * @var string
	 */
	protected $version;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var string
	 */
	protected $slug = 'cl-vue-widgets';

	/** @var  array */
	protected $widgets;
	/**
	 * Assets constructor.
	 *
	 * @param string $url
	 * @param string $version
	 */
	public function __construct( $url, $version )
	{
		$this->url = $url;
		$this->version = $version;
	}

	public function add( $args ){
		$this->widgets[ $args ['widgetId' ] ] = $args;
	}

	/**
	 * Register assets
	 *
	 * @uses wp_enqueue_scripts action priority 5
	 */
	public function register()
	{
		wp_register_style( $this->slug, $this->url . 'assets/style.css', NULL, $this->version, 'all' );
		wp_register_script( $this->vendorSlug(), $this->url . 'assets/vendor.js', NULL, $this->version, TRUE);
		wp_register_script( $this->slug, $this->url . 'assets/main.js', [ $this->vendorSlug() ], $this->version, TRUE);
	}

	/**
	 * Enqueue assets
	 */
	public function enqueue(){
		if( ! wp_script_is( $this->slug, 'registered' ) ){
			$this->register();
		}
		wp_enqueue_script( $this->slug );
		wp_enqueue_script( $this->vendorSlug() );
		wp_enqueue_script( $this->slug );

		add_action( 'wp_footer', [ $this, 'printConfig'], 1 );
	}

	public function printConfig(){
		//CLVJW_CONFIG
		echo \Caldera_Forms_Render_Util::create_cdata('CLVJW_CONFIG='.wp_json_encode( $this->localizeObject() ));

	}

	protected function localizeObject(){
		return [
			'widgets' => ! empty( $this->widgets ) ? $this->widgets : [],
			'strings' => [
				'preview' => esc_html__( 'Preview', 'text-domain' ),
				'exitPreview' => esc_html__( 'Exit Preview', 'text-domain' ),

			]
		];
	}

	/**
	 * Slug for vendor scripts
	 *
	 * @return string
	 */
	protected function vendorSlug()
	{
		return $this->slug . '-vendor';
	}
}