<?php
namespace CurrencyConverter\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Currency_Converter extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jl-widget';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Currency Tool', 'elementor-jl-widget' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-before-after';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'elementor-jl-widget' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'jl-widget' ),
			]
		);

		$this->add_control(
			'fxFee',
			[
				'label' => __( 'Fee', 'jl-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter fee here', 'jl-widget' ),
			]
		);
		$this->add_control(
			'currency',
			[
				'label' => __( 'Target Currency', 'jl-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'ex. KRW, USD', 'jl-widget' ),
			]
		);
		$this->add_control(
			'api',
			[
				'label' => __( 'API Key', 'jl-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'From API Layer', 'jl-widget' ),
			]
		);
		$this->add_control(
			'sendPlaceholder',
			[
				'label' => __( 'Send placeholder', 'jl-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Send $500', 'jl-widget' ),
			]
		);
		$this->add_control(
			'currentPlaceholder',
			[
				'label' => __( 'Current Rate Placeholder', 'jl-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Current Rate', 'jl-widget' ),
			]
		);
		$this->add_control(
			'convertedAmountPlaceholder',
			[
				'label' => __( 'Converted Amount Placeholder', 'jl-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Converted Amount', 'jl-widget' ),
			]
		);
		$this->add_control(
			'ctaText',
			[
				'label' => __( 'CTA Text', 'jl-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Get Started', 'jl-widget' ),
			]
		);
		$this->add_control(
			'ctaUrl',
			[
				'label' => __( 'CTA Link', 'jl-widget' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'jl-widget' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);


		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>



		<div class="conversion_app">
		  <div class="conversion_app_1">
		    <input class="field usd" placeholder="<?php echo $settings['sendPlaceholder']; ?> $500">
		  </div>
		  <div class="conversion_app_2">
		    <div class="conversion_app_2a">
					<span style="display: none;" class="targetCurrency"><?php echo $settings['currency']; ?></span>
					<span style="display: none;" class="apiKey"><?php echo $settings['api']; ?></span>
					<span style="display: none;" class="fxFee"><?php echo $settings['fxFee']; ?></span>
					<?php if($settings['fxFee']) { ?>
		      	<p class="rate"><span class="rateFinal"></span> <span><?php echo $settings['currentPlaceholder']; ?></span></p>
					<?php }; ?>
		    </div>
		    <div class="resultBox">
		      <p class="recipientGets"><?php echo $settings['convertedAmountPlaceholder']; ?></p>
		      <p class="result"></p>
		    </div>
		  </div>
			<?php if($settings['ctaText']) { ?>
			<a href="<?php echo $settings['ctaUrl']['url']; ?>">
				<div class="rate_button"><?php echo $settings['ctaText']; ?></div>
			</a>
			<?php }; ?>
		</div>



		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		?>




		<?php
	}
}
