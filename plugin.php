<?php
namespace CurrencyConverter;

/**
 *
 * Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_enqueue_style('elementor-currency-converter', plugins_url('/assets/css/style.css',__FILE__ ));
		wp_enqueue_script('elementor-currency-converter', plugins_url('/assets/js/main.js',__FILE__ ));
		wp_register_script( 'elementor-currency-converter', plugins_url( '/assets/js/currency-converter.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Include Widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/currency-converter.php' );
	}

	/**
	 * Register Widgets
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		$this->include_widgets_files();

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Currency_Converter() );
	}

	/**
	 *  Class constructor
	 *
	 * Register hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );




	}
}

// Instantiate
Plugin::instance();
