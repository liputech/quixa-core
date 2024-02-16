<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFitCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use RT\NewsFitCore\Helper\Fns;
use RT\NewsFitCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Testimonial extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Testimonial Carousel', 'newsfit-core' );
		$this->rt_base = 'rt-testimonial-carousel';
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
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style # 01', 'newsfit-core' ),
					'style2' => __( 'Style # 02', 'newsfit-core' ),
					'style3' => __( 'Style # 03', 'newsfit-core' ),
					'style4' => __( 'Style # 04', 'newsfit-core' ),
				],
			]
		);

		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Name', 'newsfit-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Name', 'newsfit-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'designation',
			[
				'label'       => __( 'Designation', 'newsfit-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Designation', 'newsfit-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content',
			[
				'label'   => __( 'Content', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Enter Designation', 'newsfit-core' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Testimonial List', 'newsfit-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'name'        => __( 'Maria Zokatti', 'newsfit-core' ),
						'designation' => __( 'CEO, PSDBOSS', 'newsfit-core' ),
						'content'     => __( 'Engage with our professional real estate agents sell Following buy or rent your home.Get emails directly to your area reach inbox and manage the lead with.',
							'newsfit-core' ),
					],
					[
						'name'        => __( 'John Doe', 'newsfit-core' ),
						'designation' => __( 'WordPress Developer', 'newsfit-core' ),
						'content'     => __( 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid expedita recusandae ipsam quas fugit aperiam nihil nemo delectus laudantium? Enim est quibusdam dicta a',
							'newsfit-core' ),
					],
					[
						'name'        => __( 'Kent Odeldan', 'newsfit-core' ),
						'designation' => __( 'Web Designer', 'newsfit-core' ),
						'content'     => __( 'Aliquid expedita recusandae ipsam quas fugit aperiam nihil nemo delectus laudantium? Enim est quibusdam dicta a', 'newsfit-core' ),
					],

				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->add_control(
			'rating',
			[
				'label'        => __( 'Rating', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'newsfit-core' ),
				'label_off'    => __( 'Hide', 'newsfit-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		//Carousel Settings
		//=======================================
		$this->start_controls_section(
			'carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slider_animation',
			[
				'label'   => __( 'Slider Animation', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'slide' => __( 'Slide', 'newsfit-core' ),
					'fade'  => __( 'Fade', 'newsfit-core' ),
				],
			]
		);

		$this->add_control(
			'arrows',
			[
				'label'        => __( 'Arrow', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'newsfit-core' ),
				'label_off'    => __( 'Hide', 'newsfit-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'dots',
			[
				'label'        => __( 'Dots', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'newsfit-core' ),
				'label_off'    => __( 'Hide', 'newsfit-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'        => __( 'Infinite', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'newsfit-core' ),
				'label_off'    => __( 'No', 'newsfit-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Autoplay', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'newsfit-core' ),
				'label_off'    => __( 'No', 'newsfit-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'autoplaySpeed',
			[
				'label'     => __( 'Autoplay Speed', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1000,
				'max'       => 5000,
				'step'      => 500,
				'default'   => 3000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'adaptiveHeight',
			[
				'label'        => __( 'Adaptive Height', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'newsfit-core' ),
				'label_off'    => __( 'No', 'newsfit-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 100,
				'max'     => 3000,
				'step'    => 100,
				'default' => 300,
			]
		);

		$this->add_control(
			'slidesToShow',
			[
				'label'   => __( 'Slides To Show', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 3,
				'step'    => 1,
				'default' => 1,
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'          => __( 'Image Height', 'newsfit-core' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => 'px',
					'size' => 412,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 380,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 360,
				],
				'size_units'     => [ 'px', 'vw' ],
				'range'          => [
					'px' => [
						'min' => 300,
						'max' => 1000,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-banner' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'      => [
					'layout' => 'style2',
				],
			]
		);


		$this->end_controls_section();

		//Settings
		//=======================================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Style', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumb_style_heading',
			[
				'label' => __( 'Thumb Style', 'newsfit-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
				//				'separator' => 'before',
			]
		);

		$this->add_control(
			'thumb_size',
			[
				'label'      => __( 'Thumb Size', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 500,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'name_style_heading',
			[
				'label'     => __( 'Name Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Name Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .slide-wrap .slider-item .item-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Name Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .slide-wrap .slider-item .item-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'designation_style_heading',
			[
				'label'     => __( 'Designation Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typo',
				'label'    => esc_html__( 'Designation', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .slide-wrap .slider-item .item-subtitle',
			]
		);

		$this->add_control(
			'designation_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Designation', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .slide-wrap .slider-item .item-subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'des_dots',
			[
				'label'        => __( 'Before Dots', 'newsfit-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'newsfit-core' ),
				'label_off'    => __( 'Hide', 'newsfit-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'prefix_class' => 'is-dots-',
			]
		);

		$this->add_control(
			'des_dots_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Dots Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .slide-wrap .slider-item .item-subtitle::before' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'des_dots' => 'yes',
				],
			]
		);

		$this->add_control(
			'content_style_heading',
			[
				'label'     => __( 'Content Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .slide-wrap .slider-item .rtin-content',
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .slide-wrap .slider-item .rtin-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quote_style_heading',
			[
				'label'     => __( 'Quote Icon Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quote_sign_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Quote Icon', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .slide-wrap:after' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'style1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'      => 'css_filters',
				'selector'  => '{{WRAPPER}} .rt-el-testimonial-carousel.style2 .rtin-content span::before, {{WRAPPER}} .rt-el-testimonial-carousel.style2 .rtin-content span::after',
				'condition' => [
					'layout' => 'style2',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'quote_background',
				'label'    => __( 'Quote Icon Background', 'newsfit-core' ),
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Quote Icon Background', 'newsfit-core' ),
					],
				],
				'types'    => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-el-testimonial-carousel.style3 .slide-wrap:after',
			]
		);

		$this->add_control(
			'rating_style_heading',
			[
				'label'     => __( 'Rating Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'rating' => 'yes',
				],
			]
		);

		$this->add_control(
			'rating_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .star-rating i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'rating' => 'yes',
				],
			]
		);

		$this->add_control(
			'rating_size',
			[
				'label'     => __( 'Font Size', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 10,
				'max'       => 50,
				'step'      => 1,
				'default'   => 20,
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .star-rating i' => 'font-size: {{VALUE}}px',
				],
				'condition' => [
					'rating' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		//Carousel Control Settings
		$this->start_controls_section(
			'carousel_control',
			[
				'label' => __( 'Slider Control Style', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrow_style_heading',
			[
				'label'     => __( 'Arrow Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'arrows' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_border_radius',
			[
				'label'      => __( 'Arrow Radius', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-swiper-button i' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'arrows' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_width_height',
			[
				'label'      => __( 'Arrow Width/Height', 'newsfit-core' ),
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
					'{{WRAPPER}} .elementor-swiper-button i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height:{{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'arrows' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_position',
			[
				'label'      => __( 'Arrow X Position', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-el-testimonial-carousel .elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'arrows' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'arrow_style_tabs'
		);

		$this->start_controls_tab(
			'arrow_style_normal_tab',
			[
				'label' => __( 'Normal', 'newsfit-core' ),
			]
		);

		$this->add_control(
			'arrow_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow Icon Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_arrow_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow Background', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button i' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'arrows' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'arrow_style_hover_tab',
			[
				'label' => __( 'Hover', 'newsfit-core' ),
			]
		);

		$this->add_control(
			'arrow_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow Icon Color Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button i:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'arrows' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow Background Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button i:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'arrows' => 'yes',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
			'dot_style_heading',
			[
				'label'     => __( 'Dots Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'dots_border_radius',
			[
				'label'      => __( 'Dots Radius', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .swiper-pagination span' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'dots_width_height',
			[
				'label'      => __( 'Dots Width/Height', 'newsfit-core' ),
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
					'{{WRAPPER}} .rt-el-testimonial-carousel .swiper-pagination span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'dots_position',
			[
				'label'      => __( 'Dots Y Position', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}}; position: absolute',
				],
				'condition'  => [
					'dots' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'dots_style_tabs'
		);

		$this->start_controls_tab(
			'dots_style_normal_tab',
			[
				'label' => __( 'Normal', 'newsfit-core' ),
			]
		);

		$this->add_control(
			'dots_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Dots Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .swiper-pagination span' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'dots' => 'yes',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'dots_style_hover_tab',
			[
				'label' => __( 'Hover', 'newsfit-core' ),
			]
		);

		$this->add_control(
			'dots_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover/Active Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .swiper-pagination span.swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-el-testimonial-carousel .swiper-pagination span:hover'        => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'dots' => 'yes',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_box',
			[
				'label' => __( 'Box', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_style_normal_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Background Color', 'newsfit-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .slide-wrap' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'style1',
				],
			]
		);

		$this->add_control(
			'box_style2_normal_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Background Color', 'newsfit-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel.style2 .slick-list' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'style2',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'     => __( 'Border Radius', 'newsfit-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 6,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .slide-wrap' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'layout' => 'style1',
				],
			]
		);
		$this->add_control(
			'box_border_radius2',
			[
				'label'     => __( 'Border Radius', 'newsfit-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 6,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel.style2 .slick-list' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'layout' => 'style2',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .slide-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'  => [
					'layout' => 'style1',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();


//		$data['slider_data'] = [
			//"arrows"       => false, //'yes' == $data['arrows'] ? true : false,
//			"dots"         => 'yes' == $data['dots'] ? true : false,
//			"infinite"     => 'yes' == $data['infinite'] ? true : false,
//			"speed"        => $data['speed'],
//			"slidesToShow" => $data['slidesToShow'],
			//			"adaptiveHeight" =>
			//			"autoplay"       => 'yes' == $data['autoplay'] ? true : false,
			//			"autoplaySpeed"  => $data['autoplaySpeed'],
			//			"fade"           =>  ? true : false,
//		];




		//Swiper start ===============================

		$data['slider_data'] = [
			'effect'         => 'fade' == $data['slider_animation'] ? 'fade' : 'slide',
			'loop'           => $data['infinite'] ? true : false,
			'speed'          => $data['speed'],
			'autoHeight'     => ( 'yes' == $data['adaptiveHeight'] ) ? true : false,
			'slidesPerView'  => $data['slidesToShow'],
			'pagination'     => [
				'el'        => '.swiper-pagination',
				'clickable' => true,
				'type'      => 'bullets',
			],
		];

		if ( 'yes' == $data['arrows'] ) {
			$data['slider_data']['loop'] = true;
			$data['slider_data']['navigation'] = [
				'nextEl' => '.elementor-swiper-button-prev',
				'prevEl' => '.elementor-swiper-button-next',
			];
		}


		if ( 'yes' == $data['autoplay'] ) {
			$data['slider_data']['autoplay'] = [
				'delay'                => $data['autoplaySpeed'],
				'disableOnInteraction' => true,
				'pauseOnMouseEnter'    => true,
			];
		}


		$template = 'view-1';

		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		} elseif ( 'style4' == $data['layout'] ) {
			$template = 'view-4';
		}

		Fns::get_template( "elementor/testimonial/$template", $data );
	}

}