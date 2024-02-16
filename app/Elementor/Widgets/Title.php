<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFitCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\NewsFitCore\Abstracts\ElementorBase;
use RT\NewsFitCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Title extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Section Title', 'newsfit-core' );
		$this->rt_base = 'rt-title';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		/*
		 * General Options
		 * ************************************
		 */

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'top_sub_title',
			[
				'label'       => esc_html__( 'Top Sub Title', 'newsfit-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Why Choose Our Properties',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Main Title', 'newsfit-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "We're going to became <br><span>partners for the long run</span>",
				'description' => esc_html__( "If you would like to use different color then separate word by <span>.", 'newsfit-core' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => esc_html__( 'Description', 'newsfit-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => 'Lorem Ipsum has been standard daand scrambled. Rimply dummy text of the printing and typesetting industry',
			]
		);

		$this->add_control(
			'bg_title',
			[
				'label'   => esc_html__( 'Background Title', 'newsfit-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Properties',
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'newsfit-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'main_title_tag',
			[
				'label'   => esc_html__( 'Main Title Tag', 'the-post-grid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__( 'H1', 'the-post-grid' ),
					'h2' => esc_html__( 'H2', 'the-post-grid' ),
					'h3' => esc_html__( 'H3', 'the-post-grid' ),
					'h4' => esc_html__( 'H4', 'the-post-grid' ),
					'h5' => esc_html__( 'H5', 'the-post-grid' ),
					'h6' => esc_html__( 'H6', 'the-post-grid' ),
				],
			]
		);

		$this->end_controls_section();

		/*
		 * Additional Options
		 * ************************************


		$this->start_controls_section(
			'additional_option',
			[
				'label' => esc_html__( 'Additional Option', 'newsfit-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);



		$this->end_controls_section();
		*/

		/*
		 * Top Sub Title
		 * ************************************
		 */

		$this->start_controls_section(
			'top_title_settings',
			[
				'label' => esc_html__( 'Top Sub Title Settings', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'top_title_icon',
			[
				'label'   => __( 'Choose Icons', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::ICON,
				'include' => [
					'fa fa-check',
					'fa fa-check-square',
					'fa fa-square',
					'fa fa-circle',
					'fa fa-angle-right',
					'fa fa-caret-right',
					'fa fa-arrow-right',
				],
				'default' => 'fa fa-circle',
			]
		);


		$this->add_control(
			'icon_position',
			[
				'label'     => __( 'Border Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Left', 'newsfit-core' ),
					'right' => __( 'Right', 'newsfit-core' ),
					'both'  => __( 'Both', 'newsfit-core' ),
				],
				'condition' => [
					'top_title_icon!' => '',
				],
			]
		);

		$this->add_control(
			'top_title_icon_size',
			[
				'label'      => __( 'Icon Size', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 40,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 7,
				],
				'selectors'  => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .section-title-wrapper .top-sub-title svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'top_title_icon!' => '',
				],
			]
		);


		$this->add_control(
			'top_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'top_title_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .section-title-wrapper .top-sub-title svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'top_title_icon!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'top_title_two_typo',
				'label'    => esc_html__( 'Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .top-sub-title',
			]
		);

		$this->add_responsive_control(
			'top_title_margin',
			[
				'label'              => __( 'Margin', 'newsfit-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .top-sub-title-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Main Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Main Title Settings', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .main-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_two',
			[
				'type'        => Controls_Manager::COLOR,
				'label'       => esc_html__( 'Color 2', 'newsfit-core' ),
				'description' => esc_html__( "If you would like to use different color then separate word by <span> from main title.", 'newsfit-core' ),
				'selectors'   => [
					'{{WRAPPER}} .section-title-wrapper .main-title span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label'              => __( 'Margin', 'newsfit-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .main-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Description Settings
		//==============================================================
		$this->start_controls_section(
			'description_settings',
			[
				'label' => esc_html__( 'Description Settings', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typo',
				'label'    => esc_html__( 'Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'              => __( 'Margin', 'newsfit-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'description_list_settings',
			[
				'label'     => __( 'List Settings (if you use list item in description)', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_li_icon',
			[
				'label'     => __( 'List Icon', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '\f00c',
				'options'   => [
					''      => __( 'No Icon', 'newsfit-core' ),
					'\f00c' => __( 'Check', 'newsfit-core' ),
					'\f14a' => __( 'Check-square', 'newsfit-core' ),
					'\f105' => __( 'Angle-right', 'newsfit-core' ),
					'\f0da' => __( 'Caret-right', 'newsfit-core' ),
					'\f061' => __( 'Arrow-right', 'newsfit-core' ),
					'\f30b' => __( 'Long-arrow-alt-right', 'newsfit-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .description ul li::before' => 'content: "{{VALUE}}"',
				],
			]
		);

		$this->add_control(
			'description_li_icon_position',
			[
				'label'      => __( 'Icon Position', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 0,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .section-title-wrapper .description ul li::before' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
				],
				'condition'  => [
					'description_li_icon!' => '',
				],
			]
		);


		$this->add_control(
			'description_list_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .description ul li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'description_list_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .description ul li::before' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description_li_icon!' => '',
				],
			]
		);

		$this->end_controls_section();

		// Background Title Settings
		//==============================================================
		$this->start_controls_section(
			'background_title_settings',
			[
				'label' => esc_html__( 'Background Title Settings', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_title_position',
			[
				'label'     => __( 'Position', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''         => __( 'Absolute Position', 'newsfit-core' ),
					'static'   => __( 'Position Static', 'newsfit-core' ),
					'relative' => __( 'Position Relative', 'newsfit-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .bg-title-wrap' => 'position: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'background_title_typo',
				'label'    => esc_html__( 'Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .background-title',
			]
		);

		$this->add_control(
			'bg_title_style',
			[
				'label'   => __( 'Title Style', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid'   => __( 'Solid', 'newsfit-core' ),
					'outline' => __( 'Outline', 'newsfit-core' ),
				],
			]
		);

		$this->add_control(
			'background_title_border_width',
			[
				'label'      => __( 'Outline Width', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors'  => [
					'{{WRAPPER}} .section-title-wrapper .background-title' => ' -webkit-text-stroke-width:{{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'bg_title_style' => 'outline'
				]
			]
		);

		$this->add_control(
			'background_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .background-title' => 'color: {{VALUE}}; -webkit-text-stroke-color:{{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_title_opacity',
			[
				'label'      => __( 'Opacity', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors'  => [
					'{{WRAPPER}} .section-title-wrapper .background-title' => 'opacity:{{SIZE}};',
				],
			]
		);

		$this->add_responsive_control(
			'background_title_position',
			[
				'label'              => __( 'Position', 'newsfit-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'default'            => [
					'top'      => '0',
					'right'    => '',
					'bottom'   => '',
					'left'     => '0',
					'isLinked' => false,
				],
				'allowed_dimensions' => [ 'top', 'left' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .bg-title-wrap' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Background Title Settings
		//==============================================================
		$this->start_controls_section(
			'Common Settings',
			[
				'label' => esc_html__( 'Common Settings', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_title_wrap_margin',
			[
				'label'              => __( 'Wrapper Margin', 'newsfit-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '30',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/title/$template", $data );
	}

}