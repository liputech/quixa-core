<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\QuixaCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\QuixaCore\Helper\Fns;
use RT\QuixaCore\Abstracts\ElementorBase;

if (!defined('ABSPATH')) {
	exit;
}

class PricingTable extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('Pricing Table', 'quixa-core');
		$this->rt_base = 'rt-pricing-table';
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_pricing_table',
			[
				'label' => esc_html__('Pricing Table Settings', 'quixa-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Plan Name', 'quixa-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Standard',
				'label_block' => false,
			]
		);

		$this->add_control(
			'is_featured',
			[
				'label' => __('Is Featured ?', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'quixa-core'),
				'label_off' => __('No', 'quixa-core'),
				'return_value' => 'is-featured',
				'default' => false,
			]
		);

		$this->add_control(
			'featured_text',
			[
				'label' => esc_html__('Featured Text', 'quixa-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Featured',
				'label_block' => false,
				'condition' => [
					'is_featured' => 'is-featured',
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__('Subtitle', 'quixa-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Shen an unknown printer took a galley of type and scrambled',
				'rows' => 3,
			]
		);

		$this->add_control(
			'price',
			[
				'label' => esc_html__('Price', 'quixa-core'),
				'type' => Controls_Manager::TEXT,
				'default' => '$29',
				'label_block' => false,
			]
		);

		$this->add_control(
			'period',
			[
				'label' => esc_html__('Period', 'quixa-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'month',
				'label_block' => false,
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'quixa-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Get Started',
				'label_block' => false,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __('Link', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'quixa-core'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'faature_title', [
				'label' => __('Feature Title', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('List Title', 'quixa-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_icon',
			[
				'label' => __('Icon', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-check-circle',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'list_icon_color',
			[
				'label' => __('Icon Color', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#53e092',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper {{CURRENT_ITEM}} svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'list_title_color',
			[
				'label' => __('Title Color', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#646464',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper {{CURRENT_ITEM}} .list-item' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'list',
			[
				'label' => __('Feature List', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'faature_title' => __('All Listing Access', 'quixa-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#53e092',
						'list_title_color' => '#646464',
					],
					[
						'faature_title' => __('Location Wise Map', 'quixa-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#53e092',
						'list_title_color' => '#646464',
					],
					[
						'faature_title' => __('Free / Pro Ads', 'quixa-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#53e092',
						'list_title_color' => '#646464',
					],
					[
						'faature_title' => __('Custom Map Setup', 'quixa-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#53e092',
						'list_title_color' => '#646464',
					],
					[
						'faature_title' => __('Apps Integrated', 'quixa-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#53e092',
						'list_title_color' => '#646464',
					],
					[
						'faature_title' => __('Advanced Custom Field', 'quixa-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#acb7c3',
						'list_title_color' => '#788593',
					],
					[
						'faature_title' => __('Pro Features', 'quixa-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#acb7c3',
						'list_title_color' => '#788593',
					],
				],
				'title_field' => '{{{ faature_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'additional_settings',
			[
				'label' => esc_html__('Additional Settings', 'quixa-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon Type', 'quixa-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => __('Icon', 'quixa-core'),
					'image' => __('Image', 'quixa-core'),
					'none' => __('None', 'quixa-core'),
				],
			]
		);

		$this->add_control(
			'bgicon',
			[
				'label' => __('Choose Icon', 'quixa-core'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-paper-plane',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => ['image'],
				],
			]
		);

		$this->end_controls_section();

		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__('Title Settings', 'quixa-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .plan-name',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __('Title Spacing', 'quixa-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'allowed_dimensions' => 'vertical',
				'selectors' => [
					'{{WRAPPER}} .plan-name-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => __('Normal', 'quixa-core'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .plan-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => __('Hover', 'quixa-core'),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Hover Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .plan-name' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Sub Title
		//==============================================================
		$this->start_controls_section(
			'price_settings',
			[
				'label' => esc_html__('Price Settings', 'quixa-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricing_heading',
			[
				'label' => __('Pricing Options', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				// 'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => esc_html__('Typography', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .price',
			]
		);

		$this->start_controls_tabs(
			'price_style_tabs'
		);

		$this->start_controls_tab(
			'price_style_normal_tab',
			[
				'label' => __('Normal', 'quixa-core'),
			]
		);

		$this->add_control(
			'price_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Price Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .price' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'price_style_hover_tab',
			[
				'label' => __('Hover', 'quixa-core'),
			]
		);

		$this->add_control(
			'price_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Price Color Hover', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .price-wrap .price' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'period_heading',
			[
				'label' => __('Period Options', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'period_typography',
				'label' => esc_html__('Typography', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .period',
			]
		);

		$this->start_controls_tabs(
			'period_style_tabs'
		);

		$this->start_controls_tab(
			'period_style_normal_tab',
			[
				'label' => __('Normal', 'quixa-core'),
			]
		);

		$this->add_control(
			'period_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Period Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .period' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'period_style_hover_tab',
			[
				'label' => __('Hover', 'quixa-core'),
			]
		);

		$this->add_control(
			'period_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Period Color Hover', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .price-wrap .period' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pricing_separator',
			[
				'label' => __('Pricing Separator Options', 'quixa-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs(
			'separator_style_tabs'
		);

		$this->start_controls_tab(
			'separator_style_normal_tab',
			[
				'label' => __('Normal', 'quixa-core'),
			]
		);

		$this->add_control(
			'separator_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Separator Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .seperator' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'separator_style_hover_tab',
			[
				'label' => __('Hover', 'quixa-core'),
			]
		);

		$this->add_control(
			'separator_color_hover',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Separator Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .price-wrap .seperator' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'separator_size',
			[
				'label' => __('Separator Size', 'quixa-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .seperator' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Sub Title
		//==============================================================
		$this->start_controls_section(
			'sub_title_settings',
			[
				'label' => esc_html__('Sub Title Settings', 'quixa-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__('Typography', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .subtitle',
			]
		);

		$this->add_responsive_control(
			'subtitle_list_spacing',
			[
				'label' => __('Spacing', 'quixa-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'allowed_dimensions' => 'vertical',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'subtitle_style_tabs'
		);

		$this->start_controls_tab(
			'subtitle_style_normal_tab',
			[
				'label' => __('Normal', 'quixa-core'),
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Sub Title Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .subtitle' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'subtitle_style_hover_tab',
			[
				'label' => __('Hover', 'quixa-core'),
			]
		);

		$this->add_control(
			'subtitle_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Sub Title Color Hover', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .subtitle' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Is Featured Settings
		//==============================================================
		$this->start_controls_section(
			'is_featured_settings',
			[
				'label' => esc_html__('Feature Badge Settings', 'quixa-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_featured' => 'is-featured',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'is_featured_typography',
				'label' => esc_html__('Typography', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .is-featured',
			]
		);

		$this->start_controls_tabs(
			'is_featured_style_tabs'
		);

		$this->start_controls_tab(
			'is_featured_style_normal_tab',
			[
				'label' => __('Normal', 'quixa-core'),
			]
		);

		$this->add_control(
			'is_featured_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .is-featured' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'is_featured_bg_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Backgruond Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .is-featured' => 'background-color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'is_featured_style_hover_tab',
			[
				'label' => __('Hover', 'quixa-core'),
			]
		);

		$this->add_control(
			'is_featured_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .is-featured' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'is_featured_bg_color_hover',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Backgruond Color Hover', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .is-featured' => 'background-color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Feature List Style
		//==============================================================
		$this->start_controls_section(
			'feature_list_settings',
			[
				'label' => esc_html__('Feature List Settings', 'quixa-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_list_typography',
				'label' => esc_html__('Typography', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists',
			]
		);

		$this->add_responsive_control(
			'feature_list_spacing',
			[
				'label' => __('Spacing', 'quixa-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'allowed_dimensions' => 'vertical',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'feature_list_style_tabs'
		);

		$this->start_controls_tab(
			'feature_list_style_normal_tab',
			[
				'label' => __('Normal', 'quixa-core'),
			]
		);

		$this->add_control(
			'feature_list_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists li .list-item' => 'color: {{VALUE}}',
				],
				'description' => esc_html__('This color will work if you don\'t set color from the list', 'quixa-core'),
			]
		);

		$this->add_control(
			'feature_icon_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('List Icon Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists svg path' => 'fill: {{VALUE}}',
				],
				'description' => esc_html__('This color will work if you don\'t set color from the list', 'quixa-core'),
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'feature_list_style_hover_tab',
			[
				'label' => __('Hover', 'quixa-core'),
			]
		);

		$this->add_control(
			'feature_list_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .feature-lists li .list-item' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'feature_icon_color_hover',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('List Icon Color Hover', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .feature-lists i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .feature-lists svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Icon / Image Settings
		//==============================================================
		$this->start_controls_section(
			'image_icon_settings',
			[
				'label' => esc_html__('Image / Icon Settings', 'quixa-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Image/Icon Size', 'quixa-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 400,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],

			]
		);

		$this->add_responsive_control(
			'icon_x_position',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('X Position', 'quixa-core'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder' => 'left: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_responsive_control(
			'icon_y_position',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Y Position', 'quixa-core'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 700,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder' => 'top: {{SIZE}}{{UNIT}};',
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
				'label' => __('Normal', 'quixa-core'),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_responsive_control(
			'icon_opacity',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Image/Icon Opacity', 'quixa-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder' => 'Opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => __('Hover', 'quixa-core'),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .icon-holder i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_responsive_control(
			'icon_opacity_hover',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Image/Icon Opacity Hover', 'quixa-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .icon-holder' => 'Opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Icon Style Tab

		$this->end_controls_section();

		// Button More Settings
		//==============================================================
		$this->start_controls_section(
			'button_settings',
			[
				'label' => esc_html__('Button Settings', 'quixa-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Border Radius', 'quixa-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Button Typography', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .button-el',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Button Padding', 'quixa-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		//Start button Style Tab
		$this->start_controls_tabs(
			'button_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __('Normal', 'quixa-core'),
			]
		);

		$this->add_control(
			'button_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'label' => __('Box Shadow', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .button-el',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __('Border', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .button-el',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __('Hover', 'quixa-core'),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_hover',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background on Hover', 'quixa-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el::after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'label' => __('Box Shadow Hover', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .button-el:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __('Border', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .button-el:hover',
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
				'label' => esc_html__('Box Settings', 'quixa-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_min_height',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Box Min Height', 'quixa-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __('Border Radius', 'quixa-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Box Padding', 'quixa-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label' => __('Box Margin', 'quixa-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '30',
					'left' => '',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'box_style_tabs'
		);

		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => __('Normal', 'quixa-core'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __('Box Shadow', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __('Background', 'quixa-core'),
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'quixa-core' ),
					],
				],
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper::before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __('Border', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper',
			]
		);

		$this->add_control(
			'box_up',
			[
				'label' => __('Translate Y', 'quixa-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __('Hover', 'quixa-core'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => __('Box Shadow Hover', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_hover',
				'label' => __('Background Hover', 'quixa-core'),
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background - Hover', 'quixa-core' ),
					],
				],
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper::after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border_hover',
				'label' => __('Border Hover', 'quixa-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper:hover',
			]
		);

		$this->add_control(
			'box_up_hover',
			[
				'label' => __('Translate Y on Hover', 'quixa-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'view-1';

		Fns::get_template( "elementor/pricing-table/$template", $data );
	}
}