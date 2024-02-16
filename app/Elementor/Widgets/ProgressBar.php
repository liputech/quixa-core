<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFitCore\Elementor\Widgets;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\NewsFitCore\Helper\Fns;
use RT\NewsFitCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) exit;

class ProgressBar extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Progress Bar', 'newsfit-core' );
		$this->rt_base = 'progress';
		parent::__construct( $data, $args );
	}

    protected function register_controls() {
		$this->start_controls_section(
			'section_progress',
			[
				'label' => __( 'Progress Bar', 'newsfit-core' ),
			]
		);

        $this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'newsfit-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1', 'newsfit-core' ),
					'style2' => __( 'Style 2', 'newsfit-core' ),
				],

			]
		);

        $this->add_control(
			'progress_animation',
			[
				'label'   => esc_html__( 'Progress Bar Animation', 'newsfit-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'select' => __( 'Select', 'newsfit-core' ),
					'progress-bar-striped' => __( 'Striped BG', 'newsfit-core' ),
					'progress-bar-striped progress-bar-animated' => __( 'Striped Animation', 'newsfit-core' ),
				],

			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'newsfit-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'newsfit-core' ),
				'default' => __( 'My Skill', 'newsfit-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'progress_type',
			[
				'label' => __( 'Type', 'newsfit-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'newsfit-core' ),
					'info' => __( 'Info', 'newsfit-core' ),
					'success' => __( 'Success', 'newsfit-core' ),
					'warning' => __( 'Warning', 'newsfit-core' ),
					'danger' => __( 'Danger', 'newsfit-core' ),
				],
			]
		);

		$this->add_control(
			'percent',
			[
				'label' => __( 'Percentage', 'newsfit-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
					'unit' => '%',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control( 'display_percentage', [
			'label' => __( 'Display Percentage', 'newsfit-core' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'show',
			'options' => [
				'show' => __( 'Show', 'newsfit-core' ),
				'hide' => __( 'Hide', 'newsfit-core' ),
			],
		] );

        $this->add_control(
			'percent_y_position',
			[
				'label' => __( 'Percentage Position', 'newsfit-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
						'step' => 1,
					],
				],
                'default' => [
					'size' => -26,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar.style2 .elementor-progress-percentage .wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'layout' => 'style2',
                    'display_percentage' => 'show'
                ]
			]
		);

		$this->add_control(
			'inner_text',
			[
				'label' => __( 'Inner Text', 'newsfit-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'e.g. Web Designer', 'newsfit-core' ),
				'default' => __( 'Web Designer', 'newsfit-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'newsfit-core' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_progress_style',
			[
				'label' => __( 'Progress Bar', 'newsfit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bar_color',
			[
				'label' => __( 'Bar Color', 'newsfit-core' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .elementor-progress-wrapper .elementor-progress-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bar_bg_color',
			[
				'label' => __( 'Background Color', 'newsfit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar.style1 .elementor-progress-wrapper' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'style1'
				]
			]
		);

		$this->add_control(
			'bar2_bg_color',
			[
				'label' => __( 'Background Color', 'newsfit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar.style2 .elementor-progress-wrapper::before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'style2'
				]
			]
		);

		$this->add_control(
			'striped_bg_color',
			[
				'label' => __( 'Striped Color', 'newsfit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar.style2 .progress-bar-striped' => 'background-image: linear-gradient( -45deg, {{VALUE}} 25%, transparent 25%, transparent 50%, {{VALUE}} 50%, {{VALUE}} 75%, transparent 75%, transparent);',
				],
                'condition' => [
                    'progress_animation!' => 'select'
                ]
			]
		);

		$this->add_control(
			'bar_height',
			[
				'label' => __( 'Height', 'newsfit-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar.style1 .elementor-progress-bar' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'style1'
				]
			]
		);

		$this->add_control(
			'bar2_height',
			[
				'label' => __( 'Height', 'newsfit-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar.style2 .elementor-progress-bar' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-progress-bar.style2 .elementor-progress-wrapper::before' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'style2'
				]
			]
		);

		$this->add_control(
			'bar_border_radius',
			[
				'label' => __( 'Border Radius', 'newsfit-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .elementor-progress-wrapper' => 'border-radius: {{SIZE}}{{UNIT}}; overflow: hidden;',
				],
				'condition' => [
					'layout' => 'style1'
				]
			]
		);

		$this->add_control(
			'bar2_border_radius',
			[
				'label' => __( 'Border Radius', 'newsfit-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar.style2 .elementor-progress-bar' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-progress-bar.style2 .elementor-progress-wrapper::before' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'style2'
				]
			]
		);

		$this->add_control(
			'inner_text_heading',
			[
				'label' => __( 'Inner Text', 'newsfit-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'bar_inline_color',
			[
				'label' => __( 'Color', 'newsfit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .elementor-progress-bar' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rt-progress-bar.style2 .elementor-progress-percentage .wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rt-progress-bar.style2 .elementor-progress-percentage .shape' => 'background-color: {{VALUE}};',
				],

			]
		);

		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'bar_inner_typography',
				'selector' => '{{WRAPPER}} .rt-progress-bar .elementor-progress-bar',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'bar_inner_shadow',
				'selector' => '{{WRAPPER}} .rt-progress-bar .elementor-progress-bar',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title Style', 'newsfit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'newsfit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .progress-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .rt-progress-bar .progress-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .rt-progress-bar .progress-title',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';
		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		}
        Fns::get_template( "elementor/progress-bar/$template", $data );
	}
}