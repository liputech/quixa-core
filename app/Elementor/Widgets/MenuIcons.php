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

class MenuIcons extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Menu Icons', 'newsfit-core' );
		$this->rt_base = 'rt-menu-icons';
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
			'hamburger',
			[
				'label'     => esc_html__( 'Hamburg menu', 'newsfit-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'newsfit-core' ),
				'label_off' => esc_html__( 'Off', 'newsfit-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'search',
			[
				'label'     => esc_html__( 'Search bar', 'newsfit-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'newsfit-core' ),
				'label_off' => esc_html__( 'Off', 'newsfit-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'login',
			[
				'label'     => esc_html__( 'Login icon', 'newsfit-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'newsfit-core' ),
				'label_off' => esc_html__( 'Off', 'newsfit-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'button',
			[
				'label'     => esc_html__( 'Button', 'newsfit-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'newsfit-core' ),
				'label_off' => esc_html__( 'Off', 'newsfit-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'button_label',
			[
				'label'     => esc_html__( 'Button Label', 'newsfit-core' ),
				'type'      => Controls_Manager::TEXT,
				'separator' => 'before',
				'condition' => [
					'button' => 'yes'
				]
			]
		);

		$this->add_control(
			'has_separator',
			[
				'label'       => esc_html__( 'Icon Separator', 'newsfit-core' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'On', 'newsfit-core' ),
				'label_off'   => esc_html__( 'Off', 'newsfit-core' ),
				'default'     => 'yes',
				'render_type' => 'template',
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'newsfit-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [
						'title' => __( 'Right', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper' => 'justify-content: {{VALUE}};justify-content: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box',
			[
				'label' => __( 'Logo Style', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Normal', 'newsfit-core' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper svg'               => 'fill: {{VALUE}}',
					'{{WRAPPER}} .menu-icon-wrapper .ham_burger .line' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Button Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Button Background', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .btn' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover', 'newsfit-core' ),
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color:hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper a:hover svg'               => 'fill: {{VALUE}}',
					'{{WRAPPER}} .menu-icon-wrapper a:hover .ham_burger .line' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Button Color:hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .btn:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Button Background:hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .btn:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'separator_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Separator Color', 'newsfit-core' ),
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .has-separator li:not(:last-child):after' => 'background: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		Fns::get_template( "elementor/menu-icons/$template", $data );
	}

}