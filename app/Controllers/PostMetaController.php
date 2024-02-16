<?php

namespace RT\NewsFitCore\Controllers;

use RT\NewsFit\Helpers\Fns;
use \RT_Postmeta;
use RT\NewsFitCore\Traits\SingletonTraits;
use RT\NewsFitCore\Builder\Builder;
use RT\NewsFitCore\Helper\FnsBuilder;

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
			__( 'Layout Settings', 'newsfit-core' ),
			[ 'page', 'post' ],
			'',
			'',
			'high',
			[
				'fields' => [
					"rt_layout_meta_data" => [
						'label' => __( 'Layouts', 'newsfit-core' ),
						'type'  => 'group',
						'value' => $this->get_post_page_meta_args(),
					],
				],
			]
		);

		$this->postmeta->add_meta_box(
			"rt_el_builder_settings",
			__( 'Header - Footer Builder Settings', 'newsfit-core' ),
			[ 'elementor-newsfit' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_el_builder_meta_args(),
			] );

	}

	function get_el_builder_meta_args() {

		return apply_filters( 'newsfit_layout_meta_field', [
			'template_type' => [
				'label'   => __( 'Template Type', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Choose Options', 'newsfit-core' ),
					'header'  => __( 'Header', 'newsfit-core' ),
					'footer'  => __( 'Footer', 'newsfit-core' ),
				],
				'default' => 'default',
			],

			'show_on' => [
				'label'   => __( 'Show On', 'newsfit-core' ),
				'type'    => 'multi_select2',
				'options' => FnsBuilder::get_builder_type(),
				'default' => [],
				'class'   => 'rt-header-footer-select'
			],

			'choose_post' => [
				'label'       => __( 'Choose posts or pages', 'newsfit-core' ),
				'type'        => 'ajax_select',
				'data_source' => 'post',
				'default'     => [],
			],

		] );
	}

	function get_post_page_meta_args() {
		$sidebars = [ 'default' => __( 'Default from customizer', 'newsfit-core' ) ] + Fns::sidebar_lists();

		return apply_filters( 'newsfit_layout_meta_field', [
			'layout'            => [
				'label'   => __( 'Layout', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default'       => __( 'Default from customizer', 'newsfit-core' ),
					'full-width'    => __( 'Full Width', 'newsfit-core' ),
					'left-sidebar'  => __( 'Left Sidebar', 'newsfit-core' ),
					'right-sidebar' => __( 'Right Sidebar', 'newsfit-core' ),
				],
				'default' => 'default',
			],
			'single_post_style' => [
				'label'   => __( 'Post View Style', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [ 'default' => __( 'Default from customizer', 'newsfit-core' ) ] + Fns::single_post_style(),
				'default' => 'default',
			],
			'header_style'      => [
				'label'   => __( 'Header Style', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'newsfit-core' ),
					'1'       => __( 'Layout 1', 'newsfit-core' ),
					'2'       => __( 'Layout 2', 'newsfit-core' ),
					'3'       => __( 'Layout 3', 'newsfit-core' ),
				],
				'default' => 'default',
			],
			'sidebar'           => [
				'label'   => __( 'Custom Sidebar', 'newsfit-core' ),
				'type'    => 'select',
				'options' => $sidebars,
				'default' => 'default',
			],
			'top_bar'           => [
				'label'   => __( 'Top Bar Visibility', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'newsfit-core' ),
					'on'      => __( 'ON', 'newsfit-core' ),
					'off'     => __( 'OFF', 'newsfit-core' ),
				],
				'default' => 'default',
			],
			'topbar_style'      => [
				'label'   => __( 'Topbar Style', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'newsfit-core' ),
					'1'       => __( 'Layout 1', 'newsfit-core' ),
					'2'       => __( 'Layout 2', 'newsfit-core' ),
					'3'       => __( 'Layout 3', 'newsfit-core' ),
				],
				'default' => 'default',
			],
			'header_width'      => [
				'label'   => __( 'Header Width', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default'   => __( 'Default from customizer', 'newsfit-core' ),
					'box-width' => __( 'Box Width', 'newsfit-core' ),
					'fullwidth' => __( 'Full Width', 'newsfit-core' ),
				],
				'default' => 'default',
			],
			'menu_alignment'    => [
				'label'   => __( 'Menu Alignment', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default'     => __( 'Default from customizer', 'newsfit-core' ),
					'menu-left'   => __( 'Left Alignment', 'newsfit-core' ),
					'menu-center' => __( 'Center Alignment', 'newsfit-core' ),
					'menu-right'  => __( 'Right Alignment', 'newsfit-core' ),
				],
				'default' => 'default',
			],


			'tr_header'         => [
				'label'   => __( 'Transparent Header', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'newsfit-core' ),
					'on'      => __( 'ON', 'newsfit-core' ),
					'off'     => __( 'OFF', 'newsfit-core' ),
				],
				'default' => 'default',
			],
			'banner'            => [
				'label'   => __( 'Banner Visibility', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'newsfit-core' ),
					'on'      => __( 'ON', 'newsfit-core' ),
					'off'     => __( 'OFF', 'newsfit-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb'        => [
				'label'   => __( 'Banner Content (Breadcrumb) Visibility', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'newsfit-core' ),
					'on'      => __( 'ON', 'newsfit-core' ),
					'off'     => __( 'OFF', 'newsfit-core' ),
				],
				'default' => 'default',
			],
			'banner_height'     => [
				'label'   => __( 'Banner Height (px)', 'newsfit-core' ),
				'type'    => 'number',
				'default' => 'default',
			],
			'footer_style'      => [
				'label'   => __( 'Footer Layout', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'newsfit-core' ),
					'1'       => __( 'Layout 1', 'newsfit-core' ),
					'2'       => __( 'Layout 2', 'newsfit-core' ),
				],
				'default' => 'default',
			],
			'footer_schema'     => [
				'label'   => __( 'Footer Schema', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'default'      => __( 'Default from customizer', 'newsfit-core' ),
					'footer-light' => __( 'Light Footer', 'newsfit' ),
					'footer-dark'  => __( 'Dark Footer', 'newsfit' ),
				],
				'default' => 'default',
			],
			'rt_padding_top'    => [
				'label' => __( 'Padding Top (Page Content)', 'newsfit-core' ),
				'type'  => 'number',
			],
			'rt_padding_bottom' => [
				'label' => __( 'Padding Bottom (Page Content)', 'newsfit-core' ),
				'type'  => 'number',
			],
		] );
	}
}

