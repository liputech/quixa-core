<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFitCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\NewsFitCore\Helper\Fns;
use RT\NewsFitCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class InfoBox extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Info Box', 'newsfit-core' );
		$this->rt_base = 'rt-info-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_info_box',
			[
				'label' => esc_html__( 'Info Box Settings', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
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
					'style3' => __( 'Style 3', 'newsfit-core' ),
					'style4' => __( 'Style 4', 'newsfit-core' ),
				],

			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'   => __( 'Icon Type', 'newsfit-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon'  => __( 'Icon', 'newsfit-core' ),
					'image' => __( 'Image', 'newsfit-core' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'newsfit-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Welcome To Greenova',
				'label_block' => true,
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label'       => esc_html__( 'Sub Title', 'newsfit-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'I am Info Text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style1', 'style2', 'style3' ],
				],
			]
		);

		$this->add_control(
			'info_icon',
			[
				'label'            => __( 'Choose Icon', 'newsfit-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-home',
					'library' => 'fa-solid',
				],
				'condition'        => [
					'icon_type' => [ 'icon' ],
				],
			]
		);

		$this->add_control(
			'show_readmore_btn',
			[
				'label'        => __( 'Read More Button', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'newsfit-core' ),
				'label_off'    => __( 'Off', 'newsfit-core' ),
				'return_value' => 'is-readmore',
			]
		);

		$this->add_control(
			'read_more_btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'newsfit-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Read More',
				'label_block' => true,
				'condition'   => [
					'show_readmore_btn' => [ 'is-readmore' ],
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'newsfit-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'newsfit-core' ),
				'show_external' => true,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

		$this->add_control(
			'image_icon',
			[
				'label'     => __( 'Choose Image', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'icon_position',
			[
				'label'     => __( 'Icon Position', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'icon-left'                                                      => [
						'title' => __( 'Left', 'newsfit-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'float: none; display: block; padding: 0;'                       => [
						'title' => __( 'Top', 'newsfit-core' ),
						'icon'  => 'eicon-v-align-top',
					],
					'float: right !important; padding-right: 0; padding-left: 30px;' => [
						'title' => __( 'Right', 'newsfit-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => '{{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1' ],
				],
				'toggle'    => true,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'     => __( 'Alignment', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .rt-info-box .content-align *' => 'text-align: {{VALUE}} !important',
					'{{WRAPPER}} .rt-info-box .icon-holder'     => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
			]
		);

		$this->add_control(
			'icon_animation',
			[
				'label'   => __( 'Icon/Image Animation', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''            => __( 'Select Animation', 'newsfit-core' ),
					'toptobottom' => __( 'Top to Bottom', 'newsfit-core' ),
					'bottomtotop' => __( 'Bottom to Top', 'newsfit-core' ),
				],
			]
		);

		$this->end_controls_section();

		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .info-title'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .info-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box:hover .info-title'   => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-info-box:hover .info-title a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .info-title',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'newsfit-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .rt-info-box .info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Sub Title
		//==============================================================
		$this->start_controls_section(
			'sub_title_settings',
			[
				'label'     => esc_html__( 'Sub Title Settings', 'newsfit-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style1', 'style2', 'style3' ],
				],
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .content-holder p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sub_title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box:hover .content-holder p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'label'    => esc_html__( 'Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .content-holder p',
			]
		);

		$this->add_responsive_control(
			'sub_title_spacing',
			[
				'label'              => __( 'Sub Title Spacing', 'newsfit-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .rt-info-box .content-holder p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Icon Settings
		//==============================================================
		$this->start_controls_section(
			'icon_settings',
			[
				'label'     => esc_html__( 'Icon Settings', 'newsfit-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => [ 'icon' ],
				],
			]
		);

		$this->add_responsive_control(
			'icon_width_height',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Width & Height', 'newsfit-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 40,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder i'                    => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-box.icon-el-style-2 .icon-holder span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_line_height',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Line Height', 'newsfit-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 40,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder i'                    => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-box.icon-el-style-2 .icon-holder span' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Font Size', 'newsfit-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 20,
						'max'  => 150,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-box .icon-holder svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				],

			]
		);


		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'      => __( 'Icon Spacing / Padding', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => __( 'Icon Margin', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '20',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'newsfit-core' ),
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder i'                    => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .rt-info-box.icon-el-style-2 .icon-holder span' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_rotation',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Border Rotation', 'newsfit-core' ),
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 360,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder i'    => 'transform: rotate(-{{SIZE}}deg)',
					'{{WRAPPER}} .rt-info-box .icon-holder span' => 'transform: rotate({{SIZE}}deg)',
				],
			]
		);

		//Start Icon Style Tab
		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'icon_style_normal_tab',
			[
				'label' => __( 'Normal', 'newsfit-core' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .icon-holder i'                                          => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .icon-holder svg path'                                   => 'fill: {{VALUE}}',
					'{{WRAPPER}} .icon-el-style-2.rt-info-box .service-box .icon-holder span i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-el-style-2.rt-info-box .service-box .icon-holder span svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'icon_bg',
				'label'    => __( 'Background', 'newsfit-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-info-box .icon-holder i, {{WRAPPER}} .rt-info-box.icon-el-style-2 .icon-holder span',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'icon-border',
				'label'    => __( 'Icon Border', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box:not(.icon-el-style-2) .icon-holder i, {{WRAPPER}} .rt-info-box.icon-el-style-2 .icon-holder span',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'newsfit-core' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box:hover .icon-holder i'                      => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-el-style-2.rt-info-box .service-box:hover span i' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'icon_bg_hover',
				'label'    => __( 'Background', 'newsfit-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-info-box:hover .icon-holder i, {{WRAPPER}} .rt-info-box.icon-el-style-2:hover .icon-holder span',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'           => 'icon-border-hover',
				'label'          => __( 'Icon Border on Hover', 'newsfit-core' ),
				'fields_options' => [
					'color' => [
						'dynamic' => [],
					],
				],
				'selector'       => '{{WRAPPER}} .rt-info-box:hover .icon-holder i, {{WRAPPER}} .rt-info-box.icon-el-style-2:hover .icon-holder span',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Icon Style Tab

		$this->end_controls_section();

		// Image Settings
		//==============================================================

		$this->start_controls_section(
			'image_settings',
			[
				'label'     => esc_html__( 'Image Settings', 'newsfit-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'image_wrap_margin_bottom',
			[
				'label'      => __( 'Image Wrapper Margin Bottom', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_icon_width',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Width', 'newsfit-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
				'condition'  => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'image_wrap_width',
			[
				'label'      => __( 'Image Wrapper Width / Height', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder .img-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label'      => __( 'Image Spacing / Margin', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label'      => __( 'Image padding', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder .img-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'newsfit-core' ),
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder .img-wrap, {{WRAPPER}} .rt-info-box .icon-holder .img-wrap .hover-bg' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'image_rotation',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Border Rotation', 'newsfit-core' ),
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 360,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .icon-holder .img-wrap img' => 'transform: rotate(-{{SIZE}}deg)',
					'{{WRAPPER}} .icon-holder .img-wrap'     => 'transform: rotate({{SIZE}}deg)',
				],
			]
		);

		$this->add_control(
			'image_invert',
			[
				'label'   => __( 'Image Invert', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''                   => __( 'Select', 'newsfit-core' ),
					'image_invert'       => __( 'Always', 'newsfit-core' ),
					'image_invert_hover' => __( 'On Hover', 'newsfit-core' ),
				],
			]
		);

		//Start Icon Style Tab
		$this->start_controls_tabs(
			'image_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'image_style_normal_tab',
			[
				'label' => __( 'Normal', 'newsfit-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'image_bg',
				'label'          => __( 'Background', 'newsfit-core' ),
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Background', 'newsfit-core' ),
					],
				],

				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-info-box .icon-holder .img-wrap',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'           => 'image-border',
				'label'          => __( 'Image Border', 'newsfit-core' ),
				'selector'       => '{{WRAPPER}} .rt-info-box .icon-holder .img-wrap',
				'fields_options' => [
					'color' => [
						'dynamic' => [],
					],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'label'    => __( 'Box Shadow', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .icon-holder .img-wrap',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'image_style_hover_tab',
			[
				'label' => __( 'Hover', 'newsfit-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'image_bg_hover',
				'label'          => __( 'Background', 'newsfit-core' ),
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Background - Hover', 'newsfit-core' ),
					],
				],
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .rt-info-box .icon-holder .img-wrap .hover-bg',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'image-border-hover',
				'label'    => __( 'Icon Border on Hover', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box:hover .icon-holder .img-wrap',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box:hover .icon-holder .img-wrap',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Icon Style Tab

		$this->add_control(
			'bg_animation',
			[
				'label'   => __( 'Background Animation', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''               => __( 'Select Animation', 'newsfit-core' ),
					'hue-animation'  => __( 'Hue Rotation', 'newsfit-core' ),
					'zoom-in'        => __( 'Zoom In', 'newsfit-core' ),
					'animation-both' => __( 'Both', 'newsfit-core' ),
					'to-top'         => __( 'To Top', 'newsfit-core' ),
					'to-bottom'      => __( 'To Bottom', 'newsfit-core' ),
				],
			]
		);

		$this->add_control(
			'bg_animation_2',
			[
				'label'     => __( 'Background Animation 2', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''               => __( 'Select Animation', 'newsfit-core' ),
					'bg-animation-2' => __( 'Enable', 'newsfit-core' ),
					''               => __( 'Disable', 'newsfit-core' ),
				],
				'condition' => [
					'layout' => 'style3',
				],
			]
		);

		$this->end_controls_section();

		// Read More Settings
		//==============================================================
		$this->start_controls_section(
			'read_more_settings',
			[
				'label'     => esc_html__( 'Read More Button Settings', 'newsfit-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_readmore_btn' => [ 'is-readmore' ],
				],
			]
		);

		$this->add_control(
			'read_more_btn_visibility',
			[
				'label'   => __( 'Button Visibility', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'always-show',
				'options' => [
					'always-show' => __( 'Always Show', 'newsfit-core' ),
					'show-hover'  => __( 'Show on Hover', 'newsfit-core' ),
				],
			]
		);

		$this->add_control(
			'readmore_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'newsfit-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .button-el .button-text' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'readmore_btn_typography',
				'label'    => esc_html__( 'Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .button-el .button-text',
			]
		);

		$this->add_responsive_control(
			'readmore_padding_spacing',
			[
				'label'      => __( 'Read More Padding', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .button-el .button-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		// Button Icon Settings
		$this->add_control(
			'button_icon_heading',
			[
				'label'     => __( 'Button Icon Settings', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_btn_icon',
			[
				'label'        => __( 'Show Button Icon', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'newsfit-core' ),
				'label_off'    => __( 'Hide', 'newsfit-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'btn_icon_position',
			[
				'label'     => __( 'Icon Positioin', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => [
					'left'  => __( 'Left', 'newsfit-core' ),
					'right' => __( 'Right', 'newsfit-core' ),
				],
				'condition' => [
					'show_btn_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'     => __( 'Button Icon', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-chevron-circle-right',
					'library' => 'solid',
				],
				'condition' => [
					'show_btn_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_icon_y_postion',
			[
				'label'      => __( 'Icon Y Position', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 20,
						'max'  => 20,
						'step' => 0,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .button-el .button-text i' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
				],
				'condition'  => [
					'show_btn_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_icon_font_size',
			[
				'label'      => __( 'Icon Size', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 50,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} .button-el .button-text i'   => 'font-size:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-el .button-text svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'show_btn_icon' => 'yes',
				],
			]
		);
		//Start read_more Style Tab
		$this->start_controls_tabs(
			'read_more_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'read_more_style_normal_tab',
			[
				'label' => __( 'Normal', 'newsfit-core' ),
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el .button-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'read_more_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el .button-text i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .button-el .button-text svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'read_more_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el .button-text' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'label'    => __( 'Box Shadow', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .button-el .button-text',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'read_more_border',
				'label'    => __( 'Border', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .button-el .button-text',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'read_more_style_hover_tab',
			[
				'label' => __( 'Hover', 'newsfit-core' ),
			]
		);

		$this->add_control(
			'read_more_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el:hover .button-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'read_more_icon_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el:hover .button-text i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .button-el:hover .button-text svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'read_more_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background on Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el:hover .button-text' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'read_more_bg_animation_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Animation on Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el:hover .button-text::before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow_hover',
				'label'    => __( 'Box Shadow Hover', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .button-el:hover .button-text',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'read_more_border_hover',
				'label'    => __( 'Border', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .button-el:hover .button-text',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Box Settings
		//==============================================================
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Box Settings', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_height',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Box Height', 'newsfit-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 200,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .service-box' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Border Radius', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .service-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Box Padding', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .service-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label'      => __( 'Box Margin', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '30',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .service-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'box_style_tabs'
		);

		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => __( 'Normal', 'newsfit-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .service-box',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'box_bg',
				'label'          => __( 'Background', 'newsfit-core' ),
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Box Background', 'newsfit-core' ),
					],
				],
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .rt-info-box .service-box',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __( 'Hover', 'newsfit-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_hover',
				'label'    => __( 'Box Shadow Hover', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .service-box:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'box_bg_hover',
				'label'          => __( 'Background Hover', 'newsfit-core' ),
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Box Background - Hover', 'newsfit-core' ),
					],
				],
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .rt-info-box .service-box::after',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';

		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		}

		Fns::get_template( "elementor/info-box/{$template}", $data );
	}

}