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

class Post extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name      = esc_html__( 'RT Post', 'quixa-core' );
		$this->rt_base      = 'rt-post';
		$this->rt_translate = [
			'cols' => [
				'3'  => __( '4 Columns', 'quixa-core' ),
				'4'  => __( '3 Columns', 'quixa-core' ),
				'6'  => __( '2 Columns', 'quixa-core' ),
				'12' => __( '1 Columns', 'quixa-core' ),
			],
		];
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_post_grid',
			[
				'label' => esc_html__( 'Post Grid', 'quixa-core' ),
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
			'gridcolumn-popover-toggle',
			[
				'label'        => __( 'Grid Column', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'quixa-core' ),
				'label_on'     => __( 'Custom', 'quixa-core' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_control(
			'gird_column_desktop',
			[
				'label'   => esc_html__( 'Grid Column for Desktop', 'quixa-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => $this->rt_translate['cols'],

			]
		);

		$this->add_control(
			'gird_column_tab',
			[
				'label'   => esc_html__( 'Grid Column for Tab', 'quixa-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '6',
				'options' => $this->rt_translate['cols'],

			]
		);

		$this->add_control(
			'gird_column_mobile',
			[
				'label'   => esc_html__( 'Grid Column for Mobile', 'quixa-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => $this->rt_translate['cols'],

			]
		);

		$this->end_popover();

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'the-post-grid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__( 'H1', 'the-post-grid' ),
					'h2' => esc_html__( 'H2', 'the-post-grid' ),
					'h3' => esc_html__( 'H3', 'the-post-grid' ),
					'h4' => esc_html__( 'H4', 'the-post-grid' ),
					'h5' => esc_html__( 'H5', 'the-post-grid' ),
					'h6' => esc_html__( 'H6', 'the-post-grid' ),
				],
			]
		);

		$this->add_control(
			'post_limit',
			[
				'label'       => __( 'Post Limit', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post Limit', 'quixa-core' ),
				'description' => __( 'Enter number of post to show.', 'quixa-core' ),
				'default'     => '12',
			]
		);

		$this->add_control(
			'post_source',
			[
				'label'       => __( 'Post Source', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent post', 'quixa-core' ),
					'by_category' => __( 'By Category', 'quixa-core' ),
					'by_tags'     => __( 'By Tags', 'quixa-core' ),
					'by_id'       => __( 'By Post ID', 'quixa-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'quixa-core' ),
			]
		);

		$this->add_control(
			'categories',
			[
				'label'       => __( 'Choose Categories', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => rt_category_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_category',
				],
				'description' => __( 'Select post category\'s.', 'quixa-core' ),
			]
		);

		$this->add_control(
			'tags',
			[
				'label'       => __( 'Choose Tags', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => rt_tag_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_tags',
				],
				'description' => __( 'Select post tag\'s.', 'quixa-core' ),
			]
		);

		$this->add_control(
			'post_id',
			[
				'label'       => __( 'Enter post IDs', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Enter the post IDs separated by comma', 'quixa-core' ),
				'label_block' => 'true',
				'condition'   => [
					'post_source' => 'by_id',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Post offset', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post offset', 'quixa-core' ),
				'description' => __( 'Number of post to displace or pass over. The offset parameter is ignored when post limit => -1 (show all posts) is used.', 'quixa-core' ),
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => __( 'Exclude posts', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => 'true',
				'description' => __( 'Enter the post IDs separated by comma for exclude', 'quixa-core' ),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'date'           => __( 'Date', 'quixa-core' ),
					'ID'             => __( 'Order by post ID', 'quixa-core' ),
					'author'         => __( 'Author', 'quixa-core' ),
					'title'          => __( 'Title', 'quixa-core' ),
					'modified'       => __( 'Last modified date', 'quixa-core' ),
					'parent'         => __( 'Post parent ID', 'quixa-core' ),
					'comment_count'  => __( 'Number of comments', 'quixa-core' ),
					'menu_order'     => __( 'Menu order', 'quixa-core' ),
					'meta_value'     => __( 'Meta value', 'quixa-core' ),
					'meta_value_num' => __( 'Meta value number', 'quixa-core' ),
					'rand'           => __( 'Random order', 'quixa-core' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC'  => __( 'ASC', 'quixa-core' ),
					'DESC' => __( 'DESC', 'quixa-core' ),
				],
			]
		);

		$this->end_controls_section();


		// Thumbnail style
		//========================================================
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => __( 'Thumbnail Style', 'quixa-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumbnail_visibility',
			[
				'label'   => __( 'Thumbnail Visibility', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'quixa-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'quixa-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'visible',
			]
		);

		$this->add_control(
			'project_thumbnail_size',
			[
				'label'     => esc_html__( 'Image Size', 'quixa-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => rt_get_all_image_sizes(),
				'condition' => [
					'thumbnail_visibility' => 'visible',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => __( 'Image Height Ratio', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 30,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-grid .blog-box .post-img .thumb-bg' => 'padding-bottom: {{SIZE}}%;',
				],
				'condition'  => [
					'thumbnail_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'thumb_overlay_visibility',
			[
				'label'        => __( 'Show Thumbnail Overlay', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'quixa-core' ),
				'label_off'    => __( 'Hide', 'quixa-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'condition'    => [
					'thumbnail_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'overlay_type',
			[
				'label'     => __( 'Overlay Type', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'always',
				'options'   => [
					'always'        => __( 'Show Always', 'quixa-core' ),
					'hide-on-hover' => __( 'Hide on hover', 'quixa-core' ),
					'show-on-hover' => __( 'Show on hover', 'quixa-core' ),
				],
				'condition' => [
					'thumbnail_visibility'     => 'visible',
					'thumb_overlay_visibility' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'background',
				'label'          => __( 'Overlay BG', 'quixa-core' ),
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Overlay Background', 'quixa-core' ),
					],
				],
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .blog-grid .blog-box .post-img .thumb-bg .overlay',
				'condition'      => [
					'thumbnail_visibility'     => 'visible',
					'thumb_overlay_visibility' => 'yes',
				],
			]
		);

		$this->add_control(
			'thumb_box_radius',
			[
				'label'      => __( 'Thumbnail Radius', 'quixa-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-post-wrapper.blog-grid .blog-box.grid-style .post-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Title Settings
		//=====================================================================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Style', 'quixa-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .blog-grid .blog-box .post-content .post-title',
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'quixa-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '14',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => __( 'Normal', 'quixa-core' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .post-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => __( 'Hover', 'quixa-core' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Hover Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .post-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Content Settings
		//=====================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Excerpt Style', 'quixa-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_visibility',
			[
				'label'   => __( 'Excerpt Visibility', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'quixa-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'quixa-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'visible',
			]
		);


		$this->add_control(
			'content_limit',
			[
				'label'     => __( 'Excerpt Limit', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => '15',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'selector'  => '{{WRAPPER}} .blog-grid .blog-box .post-excerpt',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_spacing',
			[
				'label'              => __( 'Excerpt Spacing', 'quixa-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .blog-grid .blog-box .post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'condition'          => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();

		// Meta Information Settings
		//=====================================================================

		$this->start_controls_section(
			'meta_info_style',
			[
				'label' => __( 'Meta Info Style', 'quixa-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'is_dots',
			[
				'label'   => __( 'Left Dots', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'is_dots',
				'options' => [
					'is_dots' => __( 'Enable', 'quixa-core' ),
					'no_dots' => __( 'Disable', 'quixa-core' ),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'post_meta_typography',
				'selector' => '{{WRAPPER}} .blog-grid .blog-box .post-content .post-meta a',
			]
		);

		$this->start_controls_tabs(
			'post_meta_style_tabs'
		);

		$this->start_controls_tab(
			'post_meta_normal_tab',
			[
				'label' => __( 'Normal', 'quixa-core' ),
			]
		);


		$this->add_control(
			'post_meta_color',
			[
				'label'     => __( 'Meta Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .post-meta ul > li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_meta_hover_tab',
			[
				'label' => __( 'Box Hover', 'quixa-core' ),
			]
		);

		$this->add_control(
			'post_meta_color_hover',
			[
				'label'     => __( 'Meta Color Hover', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .post-meta ul > li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'author_visibility',
			[
				'label'        => __( 'Author Visibility', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'quixa-core' ),
				'label_off'    => __( 'Hide', 'quixa-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'author_avatar',
			[
				'label'     => __( 'Author Avatar Style', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'image',
				'options'   => [
					'icon'      => __( 'Author Icon', 'quixa-core' ),
					'image'     => __( 'Author Image', 'quixa-core' ),
					'no-avatar' => __( 'No Avatar', 'quixa-core' ),
				],
				'condition' => [
					'author_visibility' => 'yes',
				],
			]
		);

		$this->add_control(
			'author_bottom_visibility',
			[
				'label'        => __( 'Author Bottom Visibility', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'quixa-core' ),
				'label_off'    => __( 'Hide', 'quixa-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'author_bottom_avatar',
			[
				'label'     => __( 'Author Avatar Style', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'image',
				'options'   => [
					'icon'      => __( 'Author Icon', 'quixa-core' ),
					'image'     => __( 'Author Image', 'quixa-core' ),
					'no-avatar' => __( 'No Avatar', 'quixa-core' ),
				],
				'condition' => [
					'author_bottom_visibility' => 'yes',
				],
			]
		);

		$this->add_control(
			'cat_visibility',
			[
				'label'        => __( 'Category Visibility', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'quixa-core' ),
				'label_off'    => __( 'Hide', 'quixa-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'date_visibility',
			[
				'label'        => __( 'Date Visibility', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'quixa-core' ),
				'label_off'    => __( 'Hide', 'quixa-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'p_date_format',
			[
				'label'     => __( 'Date Format', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'time_ago',
				'options'   => [
					'default'  => __( 'Default From Settings', 'quixa-core' ),
					'time_ago' => __( 'Time Ago Format', 'quixa-core' ),
				],
				'condition' => [
					'date_visibility' => 'yes',
					'layout!'         => 'style2',
				],
			]
		);

		$this->add_control(
			'date_bg_color',
			[
				'label'     => __( 'Date Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .thumbnail-date .popup-date' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'date_visibility' => 'yes',
					'layout'          => 'style2',
				],
			]
		);

		$this->add_control(
			'reading_suffix',
			[
				'label'       => esc_html__( 'Reading Suffix', 'quixa-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => 'If you need, you can use reading time suffix. NB: to Read',
				'condition'   => [
					'reading_time_visibility' => 'yes'
				]
			]
		);

		$this->add_control(
			'comment_visibility',
			[
				'label'        => __( 'Comment Visibility', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'quixa-core' ),
				'label_off'    => __( 'Hide', 'quixa-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);


		$this->end_controls_section();


		//Read More Style
		//=============================================================================

		$this->start_controls_section(
			'readmore_style',
			[
				'label' => __( 'Read More Style', 'quixa-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'readmore_visibility',
			[
				'label'   => __( 'Read More Visibility', 'quixa-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'quixa-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'quixa-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'hidden',
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label'       => __( 'Button Text', 'quixa-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Read More', 'quixa-core' ),
				'placeholder' => __( 'Type your title here', 'quixa-core' ),
				'condition'   => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'readmore_typography',
				'selector'  => '{{WRAPPER}} .blog-grid .blog-box .post-content .item-btn',
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'readmore_spacing',
			[
				'label'              => __( 'Button Spacing', 'quixa-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .read-more-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'          => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'readmore_padding',
			[
				'label'      => __( 'Button Padding', 'quixa-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .read-more-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Radius', 'quixa-core' ),
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
					'{{WRAPPER}} .blog-grid .blog-box .post-content .read-more-btn a' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'show_btn_icon',
			[
				'label'        => __( 'Show Button Icon', 'quixa-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'quixa-core' ),
				'label_off'    => __( 'Hide', 'quixa-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'     => __( 'Choose Icon', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-angle-right',
					'library' => 'solid',
				],
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
					'show_btn_icon'       => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label'      => __( 'Icon Size', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .read-more-btn i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .blog-grid .blog-box .post-content .read-more-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'readmore_visibility' => [ 'visible' ],
					'show_btn_icon'       => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_y_position',
			[
				'label'      => __( 'Icon Position-Y', 'quixa-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 20,
						'max'  => 20,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .read-more-btn i' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
				],
				'condition'  => [
					'readmore_visibility' => [ 'visible' ],
					'show_btn_icon'       => 'yes',
				],
			]
		);

		//Button style Tabs
		$this->start_controls_tabs(
			'readmore_style_tabs', [
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->start_controls_tab(
			'readmore_style_normal_tab',
			[
				'label' => __( 'Normal', 'quixa-core' ),
			]
		);

		$this->add_control(
			'readmore_color',
			[
				'label'     => __( 'Font Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .item-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .item-btn i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_bg',
			[
				'label'     => __( 'Background Color', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .item-btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_icon_margin',
			[
				'label'              => __( 'Icon Spacing', 'quixa-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'horizontal',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .read-more-btn i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'          => [
					'readmore_visibility' => [ 'visible' ],
					'show_btn_icon'       => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'readmore_style_hover_tab',
			[
				'label' => __( 'Hover', 'quixa-core' ),
			]
		);

		$this->add_control(
			'readmore_color_hover',
			[
				'label'     => __( 'Font Color hover', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .item-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label'     => __( 'Icon Color Hover', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .item-btn:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_bg_hover',
			[
				'label'     => __( 'Background Color hover', 'quixa-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .item-btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_icon_margin_hover',
			[
				'label'              => __( 'Icon Spacing Hover', 'quixa-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'horizontal',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .blog-grid .blog-box .post-content .read-more-btn a:hover i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'          => [
					'readmore_visibility' => [ 'visible' ],
					'show_btn_icon'       => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Post Card Styles
		 */
		$this->start_controls_section(
			'post_card_style',
			[
				'label' => __( 'Post Card Style', 'quixa-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'quixa-core' ),
				'selector' => '{{WRAPPER}} .rt-el-post-wrapper.blog-grid .blog-box.grid-style',
			]
		);

		$this->add_control(
			'main_box_radius',
			[
				'label'      => __( 'Main Box Radius', 'quixa-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-post-wrapper.blog-grid .blog-box.grid-style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

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

		$args = [
			'post_type'           => 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $data['post_limit'],
			'post_status'         => 'publish',
		];
		if ( ! empty ( $data['orderby'] ) ) {
			$args['orderby'] = $data['orderby'];
		}
		if ( ! empty( $data['order'] ) ) {
			$args['order'] = $data['order'];
		}

		if ( $data['post_source'] == 'by_category' && $data['categories'] ) :
			$args = wp_parse_args(
				[
					'cat' => $data['categories'],
				]
				, $args );
		endif;

		if ( $data['post_source'] == 'by_tags' && $data['tags'] ) :
			$args = wp_parse_args(
				[
					'tag_slug__in' => $data['tags'],
				]
				, $args );
		endif;

		if ( $data['post_source'] == 'by_id' && $data['post_id'] ) :
			$post_ids         = explode( ',', $data['post_id'] );
			$args['post__in'] = $post_ids;
		endif;

		if ( $data['exclude'] ) :
			$excluded_ids         = explode( ',', $data['exclude'] );
			$args['post__not_in'] = $excluded_ids;
		endif;


		if ( $data['offset'] ) {
			$args['offset'] = $data['offset'];
		}

		$query               = new \WP_Query( $args );
		$gird_column_desktop = $gird_column_desktop ?? '4';
		$gird_column_tab     = $gird_column_tab ?? '6';
		$gird_column_mobile  = $gird_column_mobile ?? '6';

		$col_class = "col-lg-{$gird_column_desktop} col-md-{$gird_column_tab} col-sm-{$gird_column_mobile}";
		?>
        <div class="rt-el-post-wrapper blog-grid <?php echo esc_attr( $data['layout'] ) ?>">
			<?php if ( $query->have_posts() ) : ?>
                <div class="row">
					<?php while ( $query->have_posts() ) : $query->the_post();
						echo '<article class="quixa-post-card ' . esc_attr( $col_class ) . '">';
						Fns::get_template( "elementor/post/$template", $data );
						echo '</article>';
					endwhile; ?>
                </div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
        </div>
		<?php
	}

}