<?php
namespace CurrencyConverter\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Currency Converter
 *
 * Widget
 *
 * @since 1.0.0
 */
class Currency_Converter extends Widget_Base {

	/**
	 * Widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function get_name() {
		return 'jl-widget';
	}

	/**
	 * Title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Currency Tool', 'elementor-jl-widget' );
	}

	/**
	 * Icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-image-before-after';
	}

	/**
	 * Categories.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Scripts
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function get_script_depends() {
		return [ 'elementor-jl-widget' ];
	}

	/**
	 * Widget controls.
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
				'label' => __( 'FX Fee', 'jl-widget' ),
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
				'placeholder' => __( 'Send $1000', 'jl-widget' ),
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
			'multi_select',
			[
				'label' => __( 'Country Dropdown', 'jl-widget' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Yes', 'jl-widget' ),
					'no' => __( 'No', 'jl-widget' ),
				],
				'default' => 'default',
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
		$flagArray = array(
			"KRW" => "https://image.flaticon.com/icons/svg/197/197582.svg",
			"THB" => "https://image.flaticon.com/icons/svg/323/323281.svg",
			"VND" => "https://image.flaticon.com/icons/svg/323/323319.svg",
			"NPR" => "https://image.flaticon.com/icons/svg/197/197387.svg",
			"BDT" => "https://image.flaticon.com/icons/svg/323/323299.svg"
		);
		?>

<div class="conversion_app">
		  <div class="conversion_app_1">
			<div class="conversion_app_1a">
				<span>When You Send</span>  
				<form>
					<input name="amountSent" class="field usd" placeholder="<?php if($settings['sendPlaceholder']) { echo $settings['sendPlaceholder']; }  else { echo "$1000";  }?>">
				</form>
			</div>
			<div class="conversion_app_1b">
				<img src="https://image.flaticon.com/icons/svg/323/323310.svg">
				<span class="currencyAbreviation_2">
					USD
				</span>
			</div>  
			
		  </div>
		  <div class="conversion_app_2">
		    <div class="conversion_app_2a">
					<span style="display: none;" class="sourceCurrency"><?php echo $settings['sourceCurrency']; ?></span>
					<span style="display: none;" class="targetCurrency"><?php echo $settings['currency']; ?></span>
					<span style="display: none;" class="apiKey"><?php echo $settings['api']; ?></span>
					<span style="display: none;" class="fxFee"><?php echo $settings['fxFee']; ?></span>
					<?php if($settings['fxFee']) { ?>
		      	<p class="rate"><span class="rateFinal"></span> <span><?php echo $settings['currentPlaceholder']; ?></span></p>
					<?php }; ?>
		    </div>
		    <div class="resultBox">
				<div class="resultBox_left">
					<p class="recipientGets"><?php echo $settings['convertedAmountPlaceholder']; ?> </p>
		      		<p class="result fadeEffect"></p>					
				</div>
				<div class="resultBox_right">
					<div class="destinationSelected">
						<img src="<?php echo $flagArray[$settings['currency']]; ?>">
						<span class="currencyAbreviation">
							<?= $settings['currency']; ?>
						</span>
					</div>
					<?php if($settings['multi_select'] == 'default') {  ?>
						<div class="destinationSelector">
							<div class="destinationSelectorHeader">
								<p>Destination Currency / Country</p>
							</div>
							<div class="destinationOptions">
								<div data-destinationcurrency="KRW" data-image="https://image.flaticon.com/icons/svg/197/197582.svg">
									<img src="https://image.flaticon.com/icons/svg/197/197582.svg">
									<span class="currencyAbreviationOption">
										KRW
									</span>
									<span class="currencyCountry">
										Korean Won
									</span>
								</div>
								<div data-destinationcurrency="THB" data-image="https://image.flaticon.com/icons/svg/323/323281.svg">
									<img src="https://image.flaticon.com/icons/svg/323/323281.svg">
									<span class="currencyAbreviationOption">
										THB
									</span>
									<span class="currencyCountry">
										Thailand Bot
									</span>
								</div>
								<div data-destinationcurrency="VND" data-image="https://image.flaticon.com/icons/svg/323/323319.svg">
									<img src="https://image.flaticon.com/icons/svg/323/323319.svg">
									<span class="currencyAbreviationOption">
										VND
									</span>
									<span class="currencyCountry">
										Vietnamese dong
									</span>
								</div>	
								<div data-destinationcurrency="NPR" data-image="https://image.flaticon.com/icons/svg/197/197387.svg">
									<img src="https://image.flaticon.com/icons/svg/197/197387.svg">
									<span class="currencyAbreviationOption">
										NPR
									</span>
									<span class="currencyCountry">
										Nepalese rupee
									</span>
								</div>
								<div data-destinationcurrency="BDT" data-image="https://image.flaticon.com/icons/svg/323/323299.svg">
									<img src="https://image.flaticon.com/icons/svg/323/323299.svg">
									<span class="currencyAbreviationOption">
										BDT
									</span>
									<span class="currencyCountry">
										Bangladeshi taka
									</span>
								</div>						
							</div>
						</div>
					<?php }; ?>	
				</div>		      
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
	 * Renderer (TBD)
	 *
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
