<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFitCore\Api\Widgets;

use RT\NewsFitCore\Helper\Fns;
use RT\NewsFit\Helpers\Fns as ThemeFns;
use \WP_Widget;
use \RT_Widget_Fields;


class Post_Widget extends WP_Widget {

	public function __construct() {
		$id    = NEWSFIT_CORE_PREFIX . '_blog_post';
		$title = __( 'NewsFit: Blog Post', 'newsfit-core' );
		$args  = [
			'description' => esc_html__( 'Displays Blog Post', 'newsfit-core' )
		];
		parent::__construct( $id, $title, $args );
	}


	public function form( $instance ) {
		$defaults = [
			'title'          => __( 'Latest Posts', 'newsfit-core' ),
			'posts_type'     => 'post',
			'posts_per_page' => 5,
			'orderby'        => 'date',
			'order'          => 'DESC',
		];

		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'          => [
				'label' => esc_html__( 'Title', 'newsfit-core' ),
				'type'  => 'text',
			],
			'layout'         => [
				'label'   => esc_html__( 'Layout Style', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'blog-list-style'      => __( 'List', 'newsfit-core' ),
					'blog-grid-style'      => __( 'Grid', 'newsfit-core' ),
					'blog-big-first-style' => __( '1st Big Other\'s list - 1', 'newsfit-core' ),
					'blog-big-first-style style2' => __( '1st Big Other\'s list - 2', 'newsfit-core' ),
				]
			],
			'query_title'    => [
				'label' => esc_html__( 'QUERY', 'newsfit-core' ),
				'type'  => 'heading',
			],
			'posts_type'     => [
				'label'   => esc_html__( 'Post Type', 'newsfit-core' ),
				'type'    => 'select',
				'options' => ThemeFns::get_post_types()
			],
			'posts_per_page' => [
				'label' => esc_html__( 'Posts Per Page', 'newsfit-core' ),
				'type'  => 'number',
			],
			'orderby'        => [
				'label'   => esc_html__( 'Order by', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'date'          => __( 'Date', 'newsfit-core' ),
					'author'        => __( 'Author', 'newsfit-core' ),
					'title'         => __( 'Title', 'newsfit-core' ),
					'modified'      => __( 'Last modified date', 'newsfit-core' ),
					'parent'        => __( 'Post parent ID', 'newsfit-core' ),
					'comment_count' => __( 'Number of comments', 'newsfit-core' ),
					'menu_order'    => __( 'Menu order', 'newsfit-core' ),
					'rand'          => __( 'Random order', 'newsfit-core' ),
					'popular'       => __( 'Popular Post', 'newsfit-core' ),
				]
			],
			'order'          => [
				'label'   => esc_html__( 'Order', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'ASC'  => __( 'ASC', 'newsfit-core' ),
					'DESC' => __( 'DESC', 'newsfit-core' ),
				]
			],
			'post_id'        => [
				'label' => esc_html__( 'Post by ID', 'newsfit-core' ),
				'type'  => 'text',
				'desc'  => esc_html__( 'Enter post id by comma (,) separator.', 'newsfit-core' ),
			],

			'meta_title'         => [
				'label' => esc_html__( 'Choose Meta', 'newsfit-core' ),
				'type'  => 'heading',
			],
			'category'           => [
				'label' => esc_html__( 'Category', 'newsfit-core' ),
				'type'  => 'checkbox',
			],
			'tag'                => [
				'label' => esc_html__( 'Tags', 'newsfit-core' ),
				'type'  => 'checkbox',
			],
			'author'             => [
				'label' => esc_html__( 'Author', 'newsfit-core' ),
				'type'  => 'checkbox',
			],
			'date'               => [
				'label' => esc_html__( 'Date', 'newsfit-core' ),
				'type'  => 'checkbox',
			],
			'content_visibility' => [
				'label'   => esc_html__( 'Content Visibility', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [
					'first' => __( 'Only First Post', 'newsfit-core' ),
					'all'   => __( 'All Posts', 'newsfit-core' ),
					'hide'  => __( 'Hide for all', 'newsfit-core' ),
				]
			],
			'meta_style'         => [
				'label'   => esc_html__( 'Meta Style', 'newsfit-core' ),
				'type'    => 'select',
				'options' => [ 'default' => __( __( "Default from Theme" ), "newsfit-core" ) ] + ThemeFns::meta_style()
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']              = $new_instance['title'] ?? __( 'Latest Post', 'newsfit-core' );
		$instance['layout']             = $new_instance['layout'] ?? 'blog-list-style';
		$instance['posts_type']         = $new_instance['posts_type'] ?? 'post';
		$instance['posts_per_page']     = $new_instance['posts_per_page'] ?? 5;
		$instance['orderby']            = $new_instance['orderby'] ?? 'date';
		$instance['order']              = $new_instance['order'] ?? 'DESC';
		$instance['post_id']            = $new_instance['post_id'] ?? '';
		$instance['content_visibility'] = $new_instance['content_visibility'] ?? 'first';
		$instance['category']           = $new_instance['category'] ?? 'category';
		$instance['tag']                = $new_instance['tag'] ?? '';
		$instance['author']             = $new_instance['author'] ?? '';
		$instance['date']               = $new_instance['date'] ?? '';
		$instance['meta_style']         = $new_instance['meta_style'] ?? 'default';

		return $instance;
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$postArgs = [
			'post_type'           => $instance['posts_type'] ?? 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $instance['posts_per_page'] ?? 5,
			'post_status'         => 'publish',
		];

		if ( ! empty( $instance['orderby'] ) ) {
			$postArgs['orderby'] = $instance['orderby'];
		}

		if ( ! empty( $instance['order'] ) ) {
			$postArgs['order'] = $instance['order'];
		}

		if ( ! empty( $instance['post_id'] ) ) :
			$post_ids             = explode( ',', $instance['post_id'] );
			$postArgs['post__in'] = $post_ids;
		endif;

		$query = new \WP_Query( $postArgs );

		$meta_list  = [];
		$_meta_list = newsfit_option( 'rt_blog_meta', false, true );
		foreach ( $_meta_list as $meta ) {
			if ( ! empty( $instance[ $meta ] ) ) {
				$meta_list[] = $meta;
			}
		}

		$data       = [
			'content_visibility' => $instance['content_visibility'] ?? 'first',
			'meta_list'          => $meta_list,
			'meta_style'         => $instance['meta_style'] !== 'default' ? $instance['meta_style'] : '',
		];
		$layout     = $instance['layout'] ?? 'blog-list-style';
		$post_count = 1;
		if ( $query->have_posts() ) :
			echo "<div class='newsfit-widdget-post " . esc_attr( $layout ) . "'>";
			while ( $query->have_posts() ) : $query->the_post();
				set_query_var( 'post_count', $post_count );
				Fns::get_template( "widgets/latest-posts", $data );
				$post_count ++;
			endwhile;
			echo "</div>";
			wp_reset_postdata();
		endif;

		echo $args['after_widget'];
	}
}