<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.2
 */

namespace RT\QuixaCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use RT\QuixaCore\Helper\Fns;
use RT\QuixaCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Team extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Team', 'quixa-core' );
		$this->rt_base = 'rt-agents';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_agent_grid',
			[
				'label' => esc_html__( 'Team Grid', 'quixa-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'quixa-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1', 'quixa-core' ),
					'style2' => __( 'Style 2', 'quixa-core' ),
					'style3' => __( 'Style 3', 'quixa-core' ),
				],

			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Team Image', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail',
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

		$this->add_control(
			'agent_name',
			[
				'label'       => __( 'Team Name', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g. John Doe', 'quixa-core' ),
				'default'     => __( 'John Doe', 'quixa-core' ),
			]
		);

		$this->add_control(
			'agency_name',
			[
				'label'       => __( 'Company / Designation', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g. Eco Builders', 'quixa-core' ),
				'default'     => __( 'Eco Builders', 'quixa-core' ),
			]
		);

		$this->add_control(
			'agency_url',
			[
				'label'         => __( 'Company Link', 'quixa-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'Company link', 'quixa-core' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition'     => [
					'agency_name!' => '',
				],
			]
		);


		$this->add_control(
			'agent_phone',
			[
				'label'       => __( 'Phone', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( '+121 456 8976', 'quixa-core' ),
				'default'     => __( '+121 456 8976', 'quixa-core' ),
			]
		);

		$this->add_control(
			'listing_number',
			[
				'label'       => __( 'Over Thumb label', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'E.g. 08 Listing', 'quixa-core' ),
				'default'     => __( '08 Listing', 'quixa-core' ),
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_title', [
				'label'   => __( 'Title', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title', 'quixa-core' ),
			]
		);

		$repeater->add_control(
			'social_icon',
			[
				'label'   => __( 'Icon', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fab fa-facebook-f',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'social_link', [
				'label'       => __( 'Link ', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);


		$this->add_control(
			'social_icon_list',
			[
				'label'       => __( 'Social Icon List', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'social_title' => __( 'Facebook', 'quixa-core' ),
						'social_icon'  => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'solid',
						],
						'social_link'  => '#',
					],
					[
						'social_title' => __( 'Twitter', 'quixa-core' ),
						'social_icon'  => [
							'value'   => 'fab fa-twitter',
							'library' => 'solid',
						],
						'social_link'  => '#',
					],
					[
						'social_title' => __( 'linkedin', 'quixa-core' ),
						'social_icon'  => [
							'value'   => 'fab fa-linkedin-in',
							'library' => 'solid',
						],
						'social_link'  => '#',
					],
				],
				'title_field' => '{{{ social_title }}}',
				'condition'   => [
					'layout' => 'style1',
				],
			]
		);


		$this->end_controls_section();


		// Title Settings
		//=====================================================================
		$this->start_controls_section(
			'name_style',
			[
				'label' => __( 'Name Style', 'quixa-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .rt-agents-wrapper .agent-name',
			]
		);

		$this->add_control(
			'name_spacing',
			[
				'label'              => __( 'Name Spacing', 'quixa-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-agents-wrapper .agent-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => __( 'Name Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .agent-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Designation / Agency Settings
		//=====================================================================
		$this->start_controls_section(
			'agency_style',
			[
				'label' => __( 'Company / Designation Style', 'quixa-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_typography',
				'selector' => '{{WRAPPER}} .rt-agents-wrapper .item-subtitle',
			]
		);

		$this->add_control(
			'agency_spacing',
			[
				'label'              => __( 'Company Spacing', 'quixa-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-agents-wrapper .item-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$this->add_control(
			'agency_color',
			[
				'label'     => __( 'Company Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .item-subtitle, {{WRAPPER}} .rt-agents-wrapper .item-subtitle a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


		// Contact Style
		//=====================================================================
		$this->start_controls_section(
			'contact_style',
			[
				'label' => __( 'Contact Style', 'quixa-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'contact_typography',
				'selector' => '{{WRAPPER}} .rt-agents-wrapper .item-contact .item-phn-no',
			]
		);

		$this->add_control(
			'contact_color',
			[
				'label'     => __( 'Contact Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .item-contact .item-phn-no' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'contact_icon_color',
			[
				'label'     => __( 'Contact Icon Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .item-content .item-contact .item-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


		// Thumb Meta Style
		//=====================================================================
		$this->start_controls_section(
			'thumb_meta_style',
			[
				'label' => __( 'Thumb Meta Style', 'quixa-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'thumb_meta_typography',
				'selector' => '{{WRAPPER}} .rt-agents-wrapper .item-category',
			]
		);

		$this->add_control(
			'thumb_meta_color',
			[
				'label'     => __( 'Thumb Meta Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .item-category' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'thumb_meta_bg',
			[
				'label'     => __( 'Thumb Meta Background', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .item-category' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'thumb_meta_dot_color',
			[
				'label'     => __( 'Thumb Meta Dot color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .category-box .item-category:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Contact Style
		//=====================================================================
		$this->start_controls_section(
			'social_icon_style',
			[
				'label' => __( 'Social Icon Style', 'quixa-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'social_icon_size',
			[
				'label'      => __( 'Icon Size', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 60,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs(
			'social_icon_style_tabs'
		);

		$this->start_controls_tab(
			'social_icon_normal_tab',
			[
				'label' => __( 'Normal', 'quixa-core' ),
			]
		);

		$this->add_control(
			'social_icon_color',
			[
				'label'     => __( 'Social Icon Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_icon_bg_color',
			[
				'label'     => __( 'Social Icon Background', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'social_icon_hover_tab',
			[
				'label' => __( 'Hover', 'quixa-core' ),
			]
		);

		$this->add_control(
			'social_icon_color_hover',
			[
				'label'     => __( 'Social Icon Color Hover', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link:hover'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_icon_bg_color_hoer',
			[
				'label'     => __( 'Social Icon Background Hover', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link:hover' => 'background-color: {{VALUE}}',
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
		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		}
		Fns::get_template( "elementor/team/$template", [ 'data' => $data ] );
	}

}