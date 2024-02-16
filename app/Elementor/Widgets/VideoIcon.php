<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFitCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use RT\NewsFitCore\Helper\Fns;
use RT\NewsFitCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VideoIcon extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Video', 'newsfit-core' );
		$this->rt_base = 'rt-video-icon';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Style', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon-style1',
				'options' => [
					'icon-style1' => __( 'Animation Style # 1', 'newsfit-core' ),
					'icon-style2' => __( 'Animation Style # 2', 'newsfit-core' ),
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'newsfit-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'video_url',
			[
				'label' => __( 'Video URL', 'newsfit-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'newsfit-core' ),
				'default' => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'newsfit-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button text', 'newsfit-core' ),
				'default' => __( 'Play Video', 'newsfit-core' ),
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'wrap_height',
			[
				'label' => __( 'Wrapper Height', 'newsfit-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'vh' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'newsfit-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'newsfit-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'newsfit-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'newsfit-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Horizontal Align', 'newsfit-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'newsfit-core' ),
					'flex-start' => __( 'Start', 'newsfit-core' ),
					'center' => __( 'Center', 'newsfit-core' ),
					'flex-end' => __( 'End', 'newsfit-core' ),
					'space-between' => __( 'Space Between', 'newsfit-core' ),
					'space-around' => __( 'Space Around', 'newsfit-core' ),
					'space-evenly' => __( 'Space Evenly', 'newsfit-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'justify-content: {{VALUE}}; display:flex',
				],
			]
		);

		$this->end_controls_section();


		//Play Button Style
		//=============================================
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Play Button Style', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __( 'Button Size', 'newsfit-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .icon-box' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_control(
			'button_spacing',
			[
				'label' => __( 'Button Spacing', 'newsfit-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .icon-box' => 'margin-right:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'animation_opacity',
			[
				'label' => __( 'Animation Opacity', 'newsfit-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 30,
				'max' => 100,
				'step' => 10,
				'default' => 30,
			]
		);

		$this->add_control(
			'rtanimation_duration',
			[
				'label' => __( 'Animation Duration', 'newsfit-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 2,
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .rt-ripple-effect' => 'animation-duration:{{VALUE}}s;',
				],
			]
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __( 'Normal', 'newsfit-core' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon .triangle' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Background Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'animation_border2_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Animate Border Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .icon-style2 .video-popup-icon .rt-ripple-effect::before, {{WRAPPER}} .icon-style2 .video-popup-icon .rt-ripple-effect::after' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'icon-style2'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __( 'Hover', 'newsfit-core' ),
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon:hover .triangle' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Background Color Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'animation_border2_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Animate Border Color Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .icon-style2 .video-popup-icon:hover .rt-ripple-effect::before, {{WRAPPER}} .icon-style2 .video-popup-icon:hover .rt-ripple-effect::after' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'icon-style2'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'animation_border1_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Animate BG Color', 'newsfit-core' ),
				'alpha' => false,
				'condition' => [
					'layout' => 'icon-style1'
				]
			]
		);

		$this->add_control(
			'text_style',
			[
				'label' => __( 'Text Style', 'newsfit-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Text Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-video-icon-wrapper .button-text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .button-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Hover Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .button-text:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/video-icon/$template", $data );
	}

}