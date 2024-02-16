<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFitCore\Elementor\Core;

use Elementor\Controls_Manager;

use RT\NewsFitCore\Traits\SingletonTraits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class ElementorCore {
	use SingletonTraits;


	public function __construct() {
		add_action( 'elementor/element/before_section_end', [ $this, 'newsfit_elementor_widget_extend' ], 10, 3 );
		add_action( 'elementor/widget/before_render_content', [ $this, 'newsfit_elementor_extend_widget_render' ] );
		//add_action( 'elementor/widget/print_template', array($this, 'newsfit_elementor_custom_content_template_print' ), 10, 2);
		//add_action( 'elementor/widget/render_content', array($this,'newsfit_elementor_custom_content_template_render'), 10, 2);
		add_action( 'elementor/element/counter/section_counter/after_section_start', [ $this, 'custom_counter_control' ], 10, 2 );
		add_action( 'elementor/element/button/section_style/after_section_start', [ $this, 'custom_button_control' ], 10, 2 );
		add_action( 'elementor/element/testimonial/section_testimonial/before_section_end', [ $this, 'custom_testimonial_control' ], 10, 2 );
		add_action( 'elementor/element/section/section_background/before_section_end', [ $this, 'add_elementor_section_background_controls' ] );
		add_action( 'elementor/frontend/section/before_render', [ $this, 'render_elementor_section_parallax_background' ] );
	}

	function add_elementor_section_background_controls( \Elementor\Element_Section $section ) {
		$section->add_control(
			'rt_section_parallax',
			[
				'label'        => __( 'Parallax', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_off'    => __( 'Off', 'newsfit-core' ),
				'label_on'     => __( 'On', 'newsfit-core' ),
				'default'      => 'no',
				'prefix_class' => 'rt-parallax-bg-',
			]
		);

		$section->add_control(
			'rt_parallax_speed',
			[
				'label'     => __( 'Speed', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0.1,
				'max'       => 5,
				'step'      => 0.1,
				'default'   => 0.5,
				'condition' => [
					'rt_section_parallax' => 'yes',
				],
			]
		);

		$section->add_control(
			'rt_parallax_transition',
			[
				'label'        => __( 'Parallax Transition off?', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_off'    => __( 'on', 'newsfit-core' ),
				'label_on'     => __( 'Off', 'newsfit-core' ),
				'default'      => 'off',
				'return_value' => 'off',
				'prefix_class' => 'rt-parallax-transition-',
				'condition'    => [
					'rt_section_parallax' => 'yes',
				],
			]
		);
	}

	// Render section background parallax
	function render_elementor_section_parallax_background( \Elementor\Element_Base $element ) {
		if ( 'section' === $element->get_name() ) {
			if ( 'yes' === $element->get_settings_for_display( 'rt_section_parallax' ) ) {
				$rt_background = $element->get_settings_for_display( 'background_image' );
				if ( ! isset( $rt_background ) ) {
					return;
				}
				$rt_background_URL = $rt_background['url'];
				$data_speed        = $element->get_settings_for_display( 'rt_parallax_speed' );

				$element->add_render_attribute( '_wrapper', [
					'data-speed'    => $data_speed,
					'data-bg-image' => $rt_background_URL,
				] );
			}
		}
	}

	function custom_testimonial_control( $button, $args ) {

		$button->add_control( 'custom_testimonial_author_position',
			[
				'label'        => __( 'Author Position', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'footer',
				'options'      => [
					'footer' => __( 'Footer', 'newsfit-core' ),
					'header' => __( 'Header', 'newsfit-core' ),
				],
				'prefix_class' => 'elementor-testimonial-author-pos-',
			]
		);
		$button->add_control( 'custom_testimonial_author_alignment',
			[
				'label'     => __( 'Author Alignment', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default' => __( 'Default', 'newsfit-core' ),
					'left'    => __( 'Left', 'newsfit-core' ),
					'center'  => __( 'Center', 'newsfit-core' ),
					'right'   => __( 'right', 'newsfit-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-meta' => 'text-align: {{VALUE}};',
				],
			]
		);

		$button->add_control( 'custom_testimonial_quote_visibility',
			[
				'label'        => __( 'Quote Icon Visibility', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'disable',
				'options'      => [
					'enable'        => __( 'Enable', 'newsfit-core' ),
					'disable'       => __( 'Disable', 'newsfit-core' ),
				],
				'prefix_class' => 'elementor-testimonial-quote-',
				'separator'    => 'before',
			]
		);

		$button->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'testimonial_quote_image',
				'label'          => __( 'Choose Quote Image', 'newsfit-core' ),
				'types'          => [ 'classic'],
				'fields_options' => [
					'background' => [
						'default' => 'classic',
						'label'   => esc_html__( 'Choose Quote Image', 'newsfit-core' ),
					],
				],
				'exclude'        => [ 'color' ],
				'condition' => [
					'custom_testimonial_quote_visibility' => 'enable',
				],
				'selector'       => '{{WRAPPER}} .elementor-testimonial-wrapper',
			]
		);

		$button->add_control( 'custom_testimonial_control',
			[
				'label'        => __( 'Start Visibility', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'disable',
				'options'      => [
					'enable'        => __( 'Enable to Header', 'newsfit-core' ),
					'enable-footer' => __( 'Enable to Footer', 'newsfit-core' ),
					'disable'       => __( 'Disable', 'newsfit-core' ),
				],
				'prefix_class' => 'elementor-testimonial-star-',
				'separator'    => 'before',
			]
		);

		$button->add_control( 'custom_testimonial_alignment',
			[
				'label'     => __( 'Start Alignment', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => [
					'left'   => __( 'Left', 'newsfit-core' ),
					'center' => __( 'Center', 'newsfit-core' ),
					'right'  => __( 'Right', 'newsfit-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-wrapper::before' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'custom_testimonial_control!' => 'disable',
				],
			]
		);

		$button->add_control(
			'custom_testimonial_color',
			[
				'label'     => __( 'Star Color', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-wrapper::before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'custom_testimonial_control!' => 'disable',
				],
			]
		);

		$button->add_control(
			'custom_testimonial_size',
			[
				'label'      => __( 'Star Size', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-testimonial-wrapper::before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-testimonial-wrapper'         => 'padding-top: calc({{SIZE}}{{UNIT}} / 4);',
				],
				'condition'  => [
					'custom_testimonial_control!' => 'disable',
				],
			]
		);

		$button->add_control(
			'testimonial_box_heading',
			[
				'label'     => __( 'Box Settings', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$button->add_responsive_control(
			'custom_testimonial_max_width',
			[
				'label'      => __( 'Box Size', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 200,
						'max'  => 1200,
						'step' => 10,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}' => 'max-width: {{SIZE}}{{UNIT}}; width:100%;',
				],
			]
		);

		$button->add_control( 'custom_testimonial_wrap_alignment',
			[
				'label'        => __( 'Box Alignment', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'center',
				'options'      => [
					'left'     => __( 'Left', 'newsfit-core' ),
					'center'   => __( 'Center', 'newsfit-core' ),
					'right'    => __( 'Right', 'newsfit-core' ),
					'absolute' => __( 'Absolute Center', 'newsfit-core' ),
				],
				'prefix_class' => 'rt-testimonial-',
			]
		);

		$button->add_control(
			'custom_testimonial_absolute_y_pos',
			[
				'label'      => __( 'Box Vertical Position', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}.rt-testimonial-absolute' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'custom_testimonial_wrap_alignment' => 'absolute',
				],
			]
		);

		$button->add_responsive_control(
			'custom_testimonial_padding',
			[
				'label'      => __( 'Content Padding', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'custom_testimonial_control!' => 'disable',
				],
			]
		);
	}

	function custom_button_control( $button, $args ) {
		$button->add_control( 'animation_btn_enable',
			[
				'label'        => __( 'Animation Button', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'enable',
				'options'      => [
					'enable'  => __( 'Enable', 'newsfit-core' ),
					'disable' => __( 'Disable', 'newsfit-core' ),
				],
				'prefix_class' => 'elementor-button-animation-',
			]
		);

		$button->add_control(
			'button_animation_color',
			[
				'label'     => __( 'Hover Animation Color', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button::after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'animation_btn_enable' => 'enable',
				],
			]
		);
	}


	function custom_counter_control( $counter, $args ) {
		$counter->add_control( 'counter_style',
			[
				'label'        => __( 'Counter Style', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'default-style',
				'options'      => [
					'default-style' => __( 'Default', 'newsfit-core' ),
					'circle-style'  => __( 'Circle BG', 'newsfit-core' ),
				],
				'prefix_class' => 'elementor-counter-',
			]
		);

		$counter->add_control(
			'bg_width',
			[
				'label'      => __( 'BG Width', 'newsfit-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 170,
						'max'  => 300,
						'step' => 5,
					],
				],
				'condition'  => [
					'counter_style' => 'circle-style',
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-counter::after'           => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .elementor-counter::before'          => 'width: calc({{SIZE}}px + 42px); height: calc({{SIZE}}px + 42px)',
					'{{WRAPPER}} .elementor-widget-container::before' => 'width: calc({{SIZE}}px + 84px); height: calc({{SIZE}}px + 84px)',
				],
			]
		);

		$counter->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'background',
				'label'     => __( 'Background', 'newsfit-core' ),
				'types'     => [ 'gradient' ],
				'selector'  => '{{WRAPPER}} .elementor-widget-container::before, {{WRAPPER}} .elementor-counter::before, {{WRAPPER}} .elementor-counter::after',
				'condition' => [
					'counter_style' => 'circle-style',
				],
			]
		);

		$counter->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'newsfit-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start;text-align:left;' => [
						'title' => __( 'Left', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center;text-align:center;'   => [
						'title' => __( 'Center', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end;text-align:right;'  => [
						'title' => __( 'Right', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-counter .elementor-counter-number-prefix, {{WRAPPER}} .elementor-counter .elementor-counter-number-suffix' => 'flex-grow: inherit;',
					'{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper'                                                                 => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'counter_style' => 'default-style',
				],
			]
		);
	}


	public function newsfit_elementor_widget_extend( $section, $section_id, $args ) {
		/**
		 * Extend Image Carousel
		 */
		/*
		if ( 'image-carousel' === $section->get_name() && $section_id == 'section_counter' ) {
			$section->add_control(
				'counter_style',
				[
					'label'   => esc_html__( 'Counter', 'newsfit-core' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 'default-style',
					'options' => [
						'default-style' => __( 'Default', 'newsfit-core' ),
						'circle-style'  => __( 'Circle BG', 'newsfit-core' ),
					],

				]
			);
		}
		*/
	}


	/**
	 * render custom control output
	 *
	 */
	public function newsfit_elementor_extend_widget_render( $widget ) {
		/**
		 * Adding a new attribute to our button
		 *
		 * @param \Elementor\Widget_Base $button
		 */
		/*
		if ( 'image-carousel' === $widget->get_name() ) {
			// Get the settings
			$settings = $widget->get_settings();
			// Adding our type as a class to the button
			if ( $settings['nav_style'] ) {
				$widget->add_render_attribute( 'carousel-wrapper',
					[
						'class' => $settings['nav_style'],
					], true );
			}
		}
		*/
	}


}