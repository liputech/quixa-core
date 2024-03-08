<?php
/**
 * ProductsGrid class.
 *
 * @package RadiusTheme\SB
 */

namespace RT\QuixaCore\Elementor\Widgets;

use RadiusTheme\SB\Helpers\Fns;
use RadiusTheme\SB\Elementor\Render\WCRender;
use RadiusTheme\SB\Elementor\Widgets\Controls;
use RadiusTheme\SBPRO\Helpers\FnsPro;

use RT\QuixaCore\Abstracts\ElementorWidgetBase;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * ProductsGrid class.
 */
class ProductsGrid extends ElementorWidgetBase {
	/**
	 * Control Fields
	 *
	 * @var array
	 */
	private $control_fields = [];

	/**
	 * Construct function
	 *
	 * @param array $data default array.
	 * @param mixed $args default arg.
	 */
	public function __construct( $data = [], $args = null ) {
		$this->quixa_name = esc_html__( 'Products - Grid Layouts', 'shopbuilder' );
		$this->quixa_base = 'quixa-products-grid';

		parent::__construct( $data, $args );

		$this->pro_tab       = 'layout';
		$this->quixa_category = 'quixa-shopbuilder-general';
	}

	/**
	 * Script dependencies.
	 *
	 * @return array
	 */
	public function get_script_depends(): array {
		if ( ! $this->is_edit_mode() ) {
			return [];
		}

		return [];
	}

	/**
	 * Style dependencies.
	 *
	 * @return array
	 */
	public function get_style_depends(): array {
		if ( ! $this->is_edit_mode() ) {
			return [];
		}

		return [
			'elementor-icons-shared-0',
			'elementor-icons-fa-solid',
		];
	}

	/**
	 * Controls for layout tab
	 *
	 * @return $this
	 */
	protected function layout_tab() {
		$sections = apply_filters(
			'quixa/elements/elementor/grid_layout_tab',
			array_merge(
				Controls\LayoutFields::grid_layout( $this ),
				Controls\LayoutFields::query( $this ),
				Controls\LayoutFields::filter( $this ),
				Controls\LayoutFields::pagination( $this ),
			),
			$this
		);

		$this->control_fields = array_merge( $this->control_fields, $sections );

		return $this;
	}

	/**
	 * Controls for settings tab
	 *
	 * @return $this
	 */
	protected function settings_tab() {
		$sections = apply_filters(
			'quixa/elements/elementor/grid_settings_tab',
			array_merge(
				Controls\SettingsFields::content_visibility( $this ),
				Controls\SettingsFields::content_ordering( $this ),
				Controls\SettingsFields::image( $this ),
				Controls\SettingsFields::action_buttons( $this ),
				Controls\SettingsFields::product_title( $this ),
				Controls\SettingsFields::product_excerpt( $this ),
				Controls\SettingsFields::badges( $this ),
				$this->variation_swatch_conditionaly(),
				Controls\SettingsFields::links( $this )
			),
			$this
		);

		$this->control_fields = array_merge( $this->control_fields, $sections );

		return $this;
	}

	/**
	 * Conditional variation swatches.
	 *
	 * @return array
	 */
	public function variation_swatch_conditionaly() {
		if ( ! function_exists( 'rtwpvsp' ) ) {
			return [];
		}
		$swatches_controls                                 = Controls\SettingsFields::variation_swatch( $this );
		$swatches_controls['swatch_position']['condition'] = [
			'layout' => [ 'grid-layout1' ],
		];
		return $swatches_controls;
	}

	/**
	 * Controls for style tab
	 *
	 * @return $this
	 */
	protected function style_tab() {
		$sections = apply_filters(
			'quixa/elementor/grid_style_tab',
			array_merge(
				Controls\StyleFields::color_scheme( $this ),
				Controls\StyleFields::layout_design( $this ),
				Controls\StyleFields::product_image( $this ),
				Controls\StyleFields::product_title( $this ),
				Controls\StyleFields::short_description( $this ),
				Controls\StyleFields::product_price( $this ),
				Controls\StyleFields::product_categories( $this ),
				Controls\StyleFields::product_rating( $this ),
				Controls\StyleFields::product_add_to_cart( $this ),
				Controls\StyleFields::product_wishlist( $this ),
				Controls\StyleFields::product_quick_view( $this ),
				Controls\StyleFields::product_compare( $this ),
				Controls\StyleFields::product_badges( $this ),
				Controls\StyleFields::pagination( $this ),
				Controls\StyleFields::hover_icon_button( $this ),
				Controls\StyleFields::not_found_notice( $this ),
			),
			$this
		);

		$this->control_fields = array_merge( $this->control_fields, $sections );

		return $this;
	}

	/**
	 * Widget Field
	 *
	 * @return array
	 */
	public function widget_fields() {
		$this->layout_tab()->settings_tab()->style_tab();

		if ( empty( $this->control_fields ) ) {
			return [];
		}

		return $this->control_fields;
	}

	/**
	 * Render Function
	 *
	 * @return void
	 */
	protected function render() {


		$settings = $this->get_settings_for_display();
		$template = 'elementor/general/grid/';

		// Render initialization.
		$this->render_start();

		// Call the template rendering method.
		Fns::print_html( WCRender::instance()->product_view( $template, $settings ), true );

		// Ending the render.
		$this->render_end();
	}
}
