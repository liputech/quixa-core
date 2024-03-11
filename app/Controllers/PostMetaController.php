<?php

namespace RT\QuixaCore\Controllers;

use RT\Quixa\Helpers\Fns;
use \RT_Postmeta;
use RT\QuixaCore\Traits\SingletonTraits;
use RT\QuixaCore\Builder\Builder;
use RT\QuixaCore\Helper\FnsBuilder;

class PostMetaController {
	use SingletonTraits;

	public $postmeta;

	public function __construct() {
		$this->postmeta = RT_Postmeta::getInstance();
//		$this->add_meta_box();
		add_action( 'init', [ $this, 'add_meta_box' ] );
	}

	/**
	 * Add all metabox
	 * @return void
	 */
	function add_meta_box() {

		$this->postmeta->add_meta_box(
			"rt_page_settings",
			__( 'Layout Settings', 'quixa-core' ),
			[ 'page', 'post', 'rt-team', 'rt-service' ],
			'',
			'',
			'high',
			[
				'fields' => [
					"rt_layout_meta_data" => [
						'label' => __( 'Layouts', 'quixa-core' ),
						'type'  => 'group',
						'value' => $this->get_post_page_meta_args(),
					],
				],
			]
		);

		//Team info
		$this->postmeta->add_meta_box(
			"rt_team_info",
			__( 'Team Info', 'quixa-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_info_meta(),
			]
		);
		$this->postmeta->add_meta_box(
			"rt_team_social",
			__( 'Team Social', 'quixa-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_social_meta(),
			]
		);

		$this->postmeta->add_meta_box(
			"rt_team_skill",
			__( 'Team Skill', 'quixa-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_skill_meta(),
			]
		);

		$this->postmeta->add_meta_box(
			"rt_el_builder_settings",
			__( 'Header - Footer Builder Settings', 'quixa-core' ),
			[ 'elementor-quixa' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_el_builder_meta_args(),
			]
		);

	}

	function get_el_builder_meta_args() {

		return apply_filters( 'quixa_layout_meta_field', [
			'template_type' => [
				'label'   => __( 'Template Type', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Choose Options', 'quixa-core' ),
					'header'  => __( 'Header', 'quixa-core' ),
					'footer'  => __( 'Footer', 'quixa-core' ),
				],
				'default' => 'default',
			],

			'show_on' => [
				'label'   => __( 'Show On', 'quixa-core' ),
				'type'    => 'multi_select2',
				'options' => FnsBuilder::get_builder_type(),
				'default' => [],
				'class'   => 'rt-header-footer-select'
			],

			'choose_post' => [
				'label'       => __( 'Choose posts or pages', 'quixa-core' ),
				'type'        => 'ajax_select',
				'data_source' => 'post',
				'default'     => [],
			],

		] );
	}

	function get_post_page_meta_args() {
		$sidebars = [ 'default' => __( 'Default from customizer', 'quixa-core' ) ] + Fns::sidebar_lists();

		return apply_filters( 'quixa_layout_meta_field', [
			'layout'            => [
				'label'   => __( 'Layout', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default'       => __( 'Default from customizer', 'quixa-core' ),
					'full-width'    => __( 'Full Width', 'quixa-core' ),
					'left-sidebar'  => __( 'Left Sidebar', 'quixa-core' ),
					'right-sidebar' => __( 'Right Sidebar', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'single_post_style' => [
				'label'   => __( 'Post View Style', 'quixa-core' ),
				'type'    => 'select',
				'options' => [ 'default' => __( 'Default from customizer', 'quixa-core' ) ] + Fns::single_post_style(),
				'default' => 'default',
			],
			'header_style'      => [
				'label'   => __( 'Header Style', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'quixa-core' ),
					'1'       => __( 'Layout 1', 'quixa-core' ),
					'2'       => __( 'Layout 2', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'sidebar'           => [
				'label'   => __( 'Custom Sidebar', 'quixa-core' ),
				'type'    => 'select',
				'options' => $sidebars,
				'default' => 'default',
			],
			'top_bar'           => [
				'label'   => __( 'Top Bar Visibility', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'quixa-core' ),
					'on'      => __( 'ON', 'quixa-core' ),
					'off'     => __( 'OFF', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'topbar_style'      => [
				'label'   => __( 'Top Bar Style', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'quixa-core' ),
					'1'       => __( 'Layout 1', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'header_width'      => [
				'label'   => __( 'Header Width', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'quixa-core' ),
					'box'     => __( 'Box Width', 'quixa-core' ),
					'full'    => __( 'Full Width', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'menu_alignment'    => [
				'label'   => __( 'Menu Alignment', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default'     => __( 'Default from customizer', 'quixa-core' ),
					'menu-left'   => __( 'Left Alignment', 'quixa-core' ),
					'menu-center' => __( 'Center Alignment', 'quixa-core' ),
					'menu-right'  => __( 'Right Alignment', 'quixa-core' ),
				],
				'default' => 'default',
			],


			'tr_header'        => [
				'label'   => __( 'Transparent Header', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'quixa-core' ),
					'on'      => __( 'ON', 'quixa-core' ),
					'off'     => __( 'OFF', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'banner'           => [
				'label'   => __( 'Banner Visibility', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'quixa-core' ),
					'on'      => __( 'ON', 'quixa-core' ),
					'off'     => __( 'OFF', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'banner_style'     => [
				'label'   => __( 'Banner Style', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'quixa-core' ),
					'1'       => __( 'Layout 1', 'quixa-core' ),
					'2'       => __( 'Layout 2', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb_title' => [
				'label'   => __( 'Banner Title', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'quixa-core' ),
					'on'      => __( 'ON', 'quixa-core' ),
					'off'     => __( 'OFF', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb'       => [
				'label'   => __( 'Banner Breadcrumb', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'quixa-core' ),
					'on'      => __( 'ON', 'quixa-core' ),
					'off'     => __( 'OFF', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'banner_height'    => [
				'label'   => __( 'Banner Height (px)', 'quixa-core' ),
				'type'    => 'number',
				'default' => 'default',
			],
			'footer_style'     => [
				'label'   => __( 'Footer Layout', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'quixa-core' ),
					'1'       => __( 'Layout 1', 'quixa-core' ),
					'2'       => __( 'Layout 2', 'quixa-core' ),
					'3'       => __( 'Layout 3', 'quixa-core' ),
					'4'       => __( 'Layout 4', 'quixa-core' ),
					'5'       => __( 'Layout 5', 'quixa-core' ),
				],
				'default' => 'default',
			],
			'footer_schema'    => [
				'label'   => __( 'Footer Schema', 'quixa-core' ),
				'type'    => 'select',
				'options' => [
					'default'      => __( 'Default from customizer', 'quixa-core' ),
					'footer-light' => __( 'Light Footer', 'quixa' ),
					'footer-dark'  => __( 'Dark Footer', 'quixa' ),
				],
				'default' => 'default',
			],
			'padding_top'      => [
				'label' => __( 'Padding Top (Page Content)', 'quixa-core' ),
				'type'  => 'number',
			],
			'padding_bottom'   => [
				'label' => __( 'Padding Bottom (Page Content)', 'quixa-core' ),
				'type'  => 'number',
			],
			'page_bg_image'    => [
				'type'  => 'image',
				'label' => __( 'Background Image', 'quixa-core' ),
			],

		] );
	}

	//Team meta info
	function get_team_info_meta() {
		return apply_filters( 'quixa_team_meta_field', [
			'quixa_team_designation' => [
				'label'   => __( 'Team Designation', 'quixa-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'quixa_team_phone' => [
				'label'   => __( 'Team Phone', 'quixa-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'quixa_team_website' => [
				'label'   => __( 'Team Website', 'quixa-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'quixa_team_email' => [
				'label'   => __( 'Team Email', 'quixa-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'quixa_team_address' => [
				'label'   => __( 'Team Address', 'quixa-core' ),
				'type'    => 'text',
				'default' => '',
			],

		] );
	}

	function get_team_social_meta() {
		return apply_filters( 'quixa_team_meta_social', [
			'quixa_team_socials' => array(
				'type'  => 'group',
				'value' => Fns::get_team_socials(),
			),
		] );
	}
	function get_team_skill_meta() {
		return apply_filters( 'quixa_team_meta_skill', [
			'quixa_team_skill_info' => [
				'label'   => __( 'Team Skill Info', 'quixa-core' ),
				'type'    => 'textarea',
			],

			'quixa_team_skill' => [
				'type'  => 'repeater',
				'button' => __( 'Add New Skill', 'quixa-core' ),
				'value'  => [
					'skill_name' => [
						'label' => __( 'Skill Name', 'quixa-core' ),
						'type'  => 'text',
						'desc'  => __( 'eg. Marketing', 'quixa-core' ),
					],
					'skill_value' => [
						'label' => __( 'Skill Percentage (%)', 'quixa-core' ),
						'type'  => 'text',
						'desc'  => __( 'eg. 75', 'quixa-core' ),
					],
					'skill_color' => [
						'label' => __( 'Skill Color', 'quixa-core' ),
						'type'  => 'color_picker',
						'desc'  => __( 'If not selected, primary color will be used', 'quixa-core' ),
					],
				]
			],
		] );
	}

}

