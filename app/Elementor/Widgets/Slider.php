<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\QuixaCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use RT\QuixaCore\Helper\Fns;
use RT\QuixaCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Slider extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Slider', 'quixa-core' );
		$this->rt_base = 'rt-main-slider';
		parent::__construct( $data, $args );
	}

	public function get_script_depends() {
		return [
			'swiper',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_rt_slider',
			[
				'label' => __( 'RT Slider', 'quixa-core' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Slider Style', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1 : Default slider', 'quixa-core' ),
					'style2' => __( 'Style 2 : Logo slider', 'quixa-core' ),
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'slider_image',
			[
				'label'   => __( 'Slider Image', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'slider_title', [
				'label'       => __( 'Title', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => 'BUILD <span>YOUR</span> BODY <span>STRONG</span>',
				'label_block' => true,
				'rows'        => 2,
			]
		);

		$repeater->add_control(
			'slider_subtitle', [
				'label'       => __( 'Subtitle', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( 'Trust The Grounds Guys professionals to take care of your <br> commercial or residential grounds', 'quixa-core' ),
				'label_block' => true,
				'rows'        => 4,
			]
		);

		$repeater->add_control(
			'slider_link',
			[
				'label'       => __( 'Slider Link', 'quixa-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'quixa-core' ),
				'show_label'  => false,
			]
		);

		$repeater->add_control(
			'slider_animation',
			[
				'label'     => __( 'Additional Settings', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'slider_bg_animation',
			[
				'label'   => __( 'Background Animation', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'zoom-in',
				'options' => [
					'zoom-in'  => __( 'Zoom In', 'quixa-core' ),
					'zoom-out' => __( 'Zoom Out', 'quixa-core' ),
				],
			]
		);

		// Title Animation

		$repeater->add_control(
			'slider_title_popover_toggle',
			[
				'label'        => __( 'Title Animation', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'quixa-core' ),
				'label_on'     => __( 'Custom', 'quixa-core' ),
				'return_value' => 'yes',
			]
		);
		$repeater->start_popover();

		$repeater->add_control(
			'title_x_paralax',
			[
				'label'      => __( 'Title Paralax X Axix', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'title_y_paralax',
			[
				'label'      => __( 'Title Paralax Y Axix', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 200,
				],
			]
		);

		$repeater->add_control(
			'title_paralax_scale',
			[
				'label'      => __( 'Title Paralax Scale', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
			]
		);

		$repeater->add_control(
			'title_paralax_opacity',
			[
				'label'      => __( 'Title Paralax Opcaity', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'title_paralax_duration',
			[
				'label'      => __( 'Title Paralax Duration', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 800,
				],
			]
		);

		$repeater->add_control(
			'title_paralax_delay',
			[
				'label'      => __( 'Title Paralax Delay', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 2000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 300,
				],
			]
		);

		$repeater->end_popover();


		//SubTitle Animation

		$repeater->add_control(
			'slider_subtitle_popover_toggle',
			[
				'label'        => __( 'Subtitle Animation', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'quixa-core' ),
				'label_on'     => __( 'Custom', 'quixa-core' ),
				'return_value' => 'yes',
			]
		);
		$repeater->start_popover();

		$repeater->add_control(
			'subtitle_x_paralax',
			[
				'label'      => __( 'Sub Title Paralax X Axix', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 200,
				],
			]
		);

		$repeater->add_control(
			'subtitle_y_paralax',
			[
				'label'      => __( 'Title Paralax Y Axix', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'subtitle_paralax_scale',
			[
				'label'      => __( 'Title Paralax Scale', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
			]
		);

		$repeater->add_control(
			'subtitle_paralax_opacity',
			[
				'label'      => __( 'Title Paralax Opcaity', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'subtitle_paralax_duration',
			[
				'label'      => __( 'Title Paralax Duration', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 800,
				],
			]
		);

		$repeater->add_control(
			'subtitle_paralax_delay',
			[
				'label'      => __( 'Sub Title Paralax Delay', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 500,
				],
			]
		);

		$repeater->end_popover();


		// Button Animation
		$repeater->add_control(
			'slider_button_popover_toggle',
			[
				'label'        => __( 'Button Animation', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'quixa-core' ),
				'label_on'     => __( 'Custom', 'quixa-core' ),
				'return_value' => 'yes',
			]
		);
		$repeater->start_popover();

		$repeater->add_control(
			'btn_x_paralax',
			[
				'label'      => __( 'Title Paralax X Axix', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'btn_y_paralax',
			[
				'label'      => __( 'Title Paralax Y Axix', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 200,
				],
			]
		);

		$repeater->add_control(
			'btn_paralax_scale',
			[
				'label'      => __( 'Title Paralax Scale', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
			]
		);

		$repeater->add_control(
			'btn_paralax_opacity',
			[
				'label'      => __( 'Title Paralax Opcaity', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'btn_paralax_duration',
			[
				'label'      => __( 'Title Paralax Duration', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 800,
				],
			]
		);

		$repeater->add_control(
			'btn_paralax_delay',
			[
				'label'      => __( 'Button Paralax Delay', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 700,
				],
			]
		);

		$repeater->end_popover();

		$repeater->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'text_align',
			[
				'label'     => __( 'Alignment', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'quixa-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'quixa-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'quixa-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slider-inner-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'overlay_bg',
				'label'          => __( 'Overlay', 'quixa-core' ),
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Overlay Type', 'quixa-core' ),
					],
				],
				'types'          => [ 'classic', 'gradient', 'video' ],
				'selector'       => '{{WRAPPER}} {{CURRENT_ITEM}} .slider-inner-wrapper .bg::before',
			]
		);


		$this->add_control(
			'sliders',
			[
				'label'       => __( 'Slider Items', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'slider_title'    => 'BUILD <span>YOUR</span> BODY <span>STRONG</span>',
						'slider_subtitle' => __( 'Ready to change your physique, but can\'t work out in the gym?', 'quixa-core' ),
					],
					[
						'slider_title'    => 'YOUR <span>BODY</span> YOUR <span>PRIDE</span>',
						'slider_subtitle' => __( 'Ready to change your physique, but can\'t work out in the gym?', 'quixa-core' ),
					],
				],
				'title_field' => '{{{ slider_title }}}',
				'condition'   => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'carousel_images',
			[
				'label'      => esc_html__( 'Add Images', 'quixa-core' ),
				'type'       => Controls_Manager::GALLERY,
				'default'    => [],
				'show_label' => false,
				'dynamic'    => [
					'active' => true,
				],
				'condition'  => [
					'layout' => 'style2',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'exclude'   => [
					'custom',
				],
			]
		);

		$this->add_responsive_control(
			'slider_height',
			[
				'label'      => __( 'Slider Height', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 600,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-swiper-slider .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_image_width_height',
			[
				'label'      => __( 'Image Width / Height', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-swiper-slider .swiper-slide img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
				'condition'  => [
					'layout' => 'style2'
				]
			]
		);


		$this->add_responsive_control(
			'slider_padding',
			[
				'label'      => __( 'Content Padding', 'quixa-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-inner-wrapper .container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_responsive_control(
			'slider_border_radius',
			[
				'label'      => __( 'Slider Radius', 'quixa-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-main-slider-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow:hidden;',
				],
				'condition'  => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'main_slider_box_shadow',
				'label'     => __( 'Box Shadow', 'quixa-core' ),
				'selector'  => '{{WRAPPER}} .rt-main-slider-wrapper',
				'condition' => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'enable_gallery_thumb',
			[
				'label'        => __( 'Enable Galelry Thumb', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Enable', 'quixa-core' ),
				'label_off'    => __( 'Disable', 'quixa-core' ),
				'return_value' => 'enable',
				'default'      => false,
				'condition'    => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'hide_all_content',
			[
				'label'        => __( 'Hide All Content', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'quixa-core' ),
				'label_off'    => __( 'No', 'quixa-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'condition'    => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->start_controls_tabs(
			'img_style_tabs'
		);

		$this->start_controls_tab(
			'img_style_normal_tab',
			[
				'label' => __( 'Normal', 'quixa-core' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} img',
			]
		);

		$this->add_control(
			'slider_image_opacity',
			[
				'label'      => __( 'Image Opacity', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-swiper-slider .swiper-slide img' => 'opacity: {{SIZE}}',
				],
				'condition'  => [
					'layout' => 'style2'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'img_style_hover_tab',
			[
				'label' => __( 'Hover', 'quixa-core' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} img:hover',
			]
		);

		$this->add_control(
			'slider_image_opacity_hover',
			[
				'label'      => __( 'Image Opacity Hover', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-swiper-slider .swiper-slide img:hover' => 'opacity: {{SIZE}}',
				],
				'condition'  => [
					'layout' => 'style2'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Additional Options
		//============================================================
		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'quixa-core' ),
			]
		);

		$this->add_control(
			'main_slider_heading',
			[
				'label'     => __( 'Main Slider', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'quixa-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'both'   => __( 'Arrows and Dots', 'quixa-core' ),
					'arrows' => __( 'Arrows', 'quixa-core' ),
					'dots'   => __( 'Dots', 'quixa-core' ),
					'none'   => __( 'None', 'quixa-core' ),
				],
			]
		);

		$this->add_control(
			'effect',
			[
				'label'   => __( 'Effect', 'quixa-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'quixa-core' ),
					'fade'  => __( 'Fade', 'quixa-core' ),
				],
			]
		);

		$this->add_control(
			'direction',
			[
				'label'     => __( 'Direction', 'quixa-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'horizontal',
				'options'   => [
					'horizontal' => __( 'Horizontal', 'quixa-core' ),
					'vertical'   => __( 'Vertical', 'quixa-core' ),
				],
				'condition' => [
					'effect' => 'slide',
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay', 'quixa-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'quixa-core' ),
					'no'  => __( 'No', 'quixa-core' ),
				],

			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'       => __( 'Pause on Hover', 'quixa-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'yes',
				'options'     => [
					'yes' => __( 'Yes', 'quixa-core' ),
					'no'  => __( 'No', 'quixa-core' ),
				],
				'condition'   => [
					'autoplay' => 'yes',
				],
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label'     => __( 'Pause on Interaction', 'quixa-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'yes',
				'options'   => [
					'yes' => __( 'Yes', 'quixa-core' ),
					'no'  => __( 'No', 'quixa-core' ),
				],
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'       => __( 'Autoplay Speed', 'quixa-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 5000,
				'condition'   => [
					'autoplay' => 'yes',
				],
				'render_type' => 'none',
			]
		);

		$this->add_responsive_control(
			'slidesPerView',
			[
				'label'              => __( 'Slides Per View', 'quixa-core' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1,
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => [
					'{{WRAPPER}}' => '--rt-slides-to-show: {{VALUE}}',
				],
				'condition'          => [
					'layout' => [ 'style2' ],
				],
			]
		);

		$this->add_responsive_control(
			'spaceBetween',
			[
				'label'     => __( 'Space Between', 'quixa-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'condition' => [
					'layout' => [ 'style2' ],
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'   => __( 'Infinite Loop', 'quixa-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'quixa-core' ),
					'no'  => __( 'No', 'quixa-core' ),
				],
			]
		);


		$this->add_control(
			'speed',
			[
				'label'       => __( 'Animation Speed', 'quixa-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 500,
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'animation_overflow',
			[
				'label'     => __( 'Animation Overflow', 'quixa-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hidden',
				'options'   => [
					'hidden' => __( 'Hidden', 'quixa-core' ),
					'none'   => __( 'None', 'quixa-core' ),
				],
				'condition' => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'slider_gallery_heading',
			[
				'label'     => __( 'Slider Gallery Settings', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_gallery_thumb' => 'enable',
					'layout'               => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'gallery_space_between',
			[
				'label'     => __( 'Space Between', 'quixa-core' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 50,
				'step'      => 1,
				'default'   => 10,
				'condition' => [
					'enable_gallery_thumb' => 'enable',
					'layout'               => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'gallery_per_view',
			[
				'label'     => __( 'Slider Per View', 'quixa-core' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 10,
				'step'      => 1,
				'default'   => 3,
				'condition' => [
					'enable_gallery_thumb' => 'enable',
					'layout'               => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'gallery_infinite',
			[
				'label'     => __( 'Infinite Loop', 'quixa-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'yes',
				'options'   => [
					'yes' => __( 'Yes', 'quixa-core' ),
					'no'  => __( 'No', 'quixa-core' ),
				],
				'condition' => [
					'enable_gallery_thumb' => 'enable',
					'layout'               => [ 'style1' ],
				],
			]
		);


		$this->end_controls_section();

		// Title Settings
		//============================================

		$this->start_controls_section(
			'section_style_title',
			[
				'label'     => __( 'Title Settings', 'quixa-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout'            => 'style1',
					'hide_all_content!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'quixa-core' ),
				'selector' => '{{WRAPPER}} .rt-slider-wrapper .slider-title-wrap h2',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'quixa-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-title-wrap h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_2',
			[
				'label'     => __( 'Title Color - 2', 'quixa-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-title-wrap h2 span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_margin_bottom',
			[
				'label'      => __( 'Margin Bottom', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
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
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-title-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Subtitle Settings
		//============================================
		$this->start_controls_section(
			'section_style_subtitle',
			[
				'label'     => __( 'Sub Title Settings', 'quixa-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout'            => 'style1',
					'hide_all_content!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => __( 'Typography', 'quixa-core' ),
				'selector' => '{{WRAPPER}} .rt-slider-wrapper .slider-subtitle-wrap h4',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => __( 'Sub Title Color', 'quixa-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-subtitle-wrap h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'subtitle_margin_bottom',
			[
				'label'      => __( 'Margin Bottom', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
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
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-subtitle-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Read More Settings
		//==============================================================
		$this->start_controls_section(
			'slider_button_settings',
			[
				'label'     => esc_html__( 'Button Settings', 'quixa-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout'            => 'style1',
					'hide_all_content!' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => __( 'Button Text', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'JOIN WITH US', 'quixa-core' ),
			]
		);

		//Start button Style Tab
		$this->start_controls_tabs(
			'btn_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'btn_style_normal_tab',
			[
				'label' => __( 'Normal', 'quixa-core' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'quixa-core' ),
				'selectors' => [
					'{{WRAPPER}} .slider-dark-button' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'btn_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'quixa-core' ),
				'selectors' => [
					'{{WRAPPER}} .slider-dark-button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'label'    => __( 'Border', 'quixa-core' ),
				'selector' => '{{WRAPPER}} .slider-dark-button',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'btn_style_hover_tab',
			[
				'label' => __( 'Hover', 'quixa-core' ),
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'quixa-core' ),
				'selectors' => [
					'{{WRAPPER}} .slider-dark-button:hover, {{WRAPPER}} .slider-dark-button:before' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'btn_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background on Hover', 'quixa-core' ),
				'selectors' => [
					'{{WRAPPER}} .slider-dark-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border_hover',
				'label'    => __( 'Border', 'quixa-core' ),
				'selector' => '{{WRAPPER}} .slider-dark-button:hover',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End btn Style Tab

		$this->add_control(
			'readmore_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'quixa-core' ),
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
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .slider-dark-button' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'readmore_btn_typography',
				'label'    => esc_html__( 'Typography', 'quixa-core' ),
				'selector' => '{{WRAPPER}} .slider-dark-button',
			]
		);

		$this->add_responsive_control(
			'readmore_padding_spacing',
			[
				'label'      => __( 'Read More Padding', 'quixa-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .slider-dark-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Carousel Settings
		// ========================================

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => __( 'Carousel Settings', 'quixa-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'main_slider_style_heading',
			[
				'label'     => __( 'Slider Style', 'quixa-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$this->add_control(
			'arrow_visibility',
			[
				'label'     => __( 'Arrow Visibility', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''                 => __( 'Always Visible', 'quixa-core' ),
					'visible-on-hover' => __( 'Visible on hover', 'quixa-core' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrow_x_position',
			[
				'label'          => __( 'Arrow X Position', 'quixa-core' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => [ 'px' ],
				'range'          => [
					'px' => [
						'min'  => 10,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'        => [
					'unit' => 'px',
					'size' => 100,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'      => [
					'{{WRAPPER}} .elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'      => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrow_y_position',
			[
				'label'      => __( 'Arrow Y Position', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-swiper-button-prev' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-swiper-button-next' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);


		$this->add_responsive_control(
			'arrows_size',
			[
				'label'     => __( 'Font Size', 'quixa-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 15,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_width_height',
			[
				'label'     => __( 'Width / Height', 'quixa-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 30,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_radius',
			[
				'label'     => __( 'Border Radius', 'quixa-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);


		$this->start_controls_tabs(
			'arrow_style_tabs'
		);

		$this->start_controls_tab(
			'arrow_style_normal_tab',
			[
				'label' => __( 'Normal', 'quixa-core' ),
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __( 'Color', 'quixa-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_bg_color',
			[
				'label'     => __( 'Background Color', 'quixa-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'border',
				'label'     => __( 'Arrow Border', 'quixa-core' ),
				'selector'  => '{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'arrow_style_hover_tab',
			[
				'label' => __( 'Hover', 'quixa-core' ),
			]
		);

		$this->add_control(
			'arrows_color_hover',
			[
				'label'     => __( 'Color', 'quixa-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'quixa-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'border_hover',
				'label'     => __( 'Arrow Border', 'quixa-core' ),
				'selector'  => '{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button:hover',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_style_dots',
			[
				'label'     => __( 'Dots', 'quixa-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'        => __( 'Position', 'quixa-core' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'outside',
				'options'      => [
					'outside' => __( 'Outside', 'quixa-core' ),
					'inside'  => __( 'Inside', 'quixa-core' ),
				],
				'prefix_class' => 'elementor-pagination-position-',
				'condition'    => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label'     => __( 'Size', 'quixa-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 25,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Color', 'quixa-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'gallery_slider_style',
			[
				'label'     => __( 'Gallery Slider Style', 'quixa-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'layout' => 'style1',
				],
			]
		);

		$this->add_responsive_control(
			'gallery_height',
			[
				'label'      => __( 'Gallery Items Height', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-gallery-thumbs .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => 'style1',
				],
			]
		);

		$this->add_responsive_control(
			'gallery_radius',
			[
				'label'      => __( 'Galelry Border Radius', 'quixa-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-gallery-thumbs .swiper-slide'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-gallery-thumbs .swiper-slide img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => 'style1',
				],
			]
		);

		$this->add_responsive_control(
			'gallery_padding',
			[
				'label'      => __( 'Gallery Padding', 'quixa-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-slider-gallery-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => 'style1',
				],
			]
		);

		$this->add_responsive_control(
			'gallery_y_position',
			[
				'label'      => __( 'Gallery Y Position', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-slider-gallery-wrapper' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => 'style1',
				],
			]
		);

		$this->start_controls_tabs(
			'gallery_style_tabs'
		);

		$this->start_controls_tab(
			'gallery_style_normal_tab',
			[
				'label' => __( 'Normal', 'quixa-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'gallery_border',
				'label'    => __( 'Border', 'quixa-core' ),
				'selector' => '{{WRAPPER}} .rt-gallery-thumbs .swiper-slide',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'gallery_style_hover_tab',
			[
				'label' => __( 'Hover', 'quixa-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'gallery_border_hover',
				'label'    => __( 'Border Hover', 'quixa-core' ),
				'selector' => '{{WRAPPER}} .rt-gallery-thumbs .swiper-slide:hover, {{WRAPPER}} .rt-gallery-thumbs .swiper-slide.swiper-slide-thumb-active',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		if ( ! $data['spaceBetween'] ) {
			$data['spaceBetween'] = 0;
		}

		$data['swiper_data'] = [
			'effect'              => $data['effect'], //'slide' | 'fade' | 'cube' | 'coverflow' | 'flip'
			'fadeEffect'          => [ 'crossFade' => true ],
			'direction'           => $data['direction'],
			'loop'                => $data['infinite'] == 'yes',
			'speed'               => $data['speed'],
			'slidesPerView'       => $data['slidesPerView'] ?? 4,
			'spaceBetween'        => $data['spaceBetween'],
			'slideToClickedSlide' => true,
			'allowTouchMove'      => true,
			'parallax'            => true,
			'loopedSlides'        => 50,
			'navigation'          => [
				'nextEl' => '.elementor-swiper-button-prev',
				'prevEl' => '.elementor-swiper-button-next',
			],
			'pagination'          => [
				'el'        => '.swiper-pagination',
				'clickable' => true,
				'type'      => 'bullets',
			],
		];

		if ( 'style2' == $data['layout'] && ( isset( $data['slidesPerView_tablet'] ) || isset( $data['slidesPerView_mobile'] ) ) ) {
			$data['swiper_data']['breakpoints'] = [
				300  => [
					'slidesPerView' => $data['slidesPerView_mobile'] ?? 1,
					'spaceBetween'  => $data['spaceBetween_mobile'] ?? $data['spaceBetween'],
				],
				768  => [
					'slidesPerView' => $data['slidesPerView_tablet'] ?? 3,
					'spaceBetween'  => $data['spaceBetween_tablet'] ?? $data['spaceBetween'],
				],
				1024 => [
					'slidesPerView' => $data['slidesPerView'] ?? 4,
					'spaceBetween'  => $data['spaceBetween'],
				],
			];
		}

		$data['swiper_gallery'] = [
			'spaceBetween'  => $data['gallery_space_between'],
			'slidesPerView' => $data['gallery_per_view'],
			'sliderLoop'    => $data['gallery_infinite'] == 'yes',
		];

		if ( 'yes' == $data['autoplay'] ) {
			$data['swiper_data']['autoplay'] = [
				'delay'                => $data['autoplay_speed'],
				'pauseOnMouseEnter'    => $data['pause_on_hover'] == 'yes',
				'disableOnInteraction' => $data['pause_on_interaction'] == 'yes',
			];
		}

		$template = 'view-1';
		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		}
		Fns::get_template( "elementor/slider/$template", $data );
	}

}