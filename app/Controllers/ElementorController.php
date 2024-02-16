<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFitCore\Controllers;

use Elementor\Plugin;
use RT\NewsFitCore\Elementor\Controls\ImageSelectorControl;
use RT\NewsFitCore\Elementor\Controls\Select2AjaxControl;
use RT\NewsFitCore\Helper\Fns;
use RT\NewsFitCore\Traits\SingletonTraits;
use RT\NewsFitCore\Elementor\Core\ElementorCore;
use RT\NewsFitCore\Elementor\Widgets\ContactForm;
use RT\NewsFitCore\Elementor\Widgets\InfoBox;
use RT\NewsFitCore\Elementor\Widgets\Parallax;
use RT\NewsFitCore\Elementor\Widgets\Post;
use RT\NewsFitCore\Elementor\Widgets\PricingTable;
use RT\NewsFitCore\Elementor\Widgets\ProgressBar;
use RT\NewsFitCore\Elementor\Widgets\SiteLogo;
use RT\NewsFitCore\Elementor\Widgets\Slider;
use RT\NewsFitCore\Elementor\Widgets\Team;
use RT\NewsFitCore\Elementor\Widgets\Testimonial;
use RT\NewsFitCore\Elementor\Widgets\Title;
use RT\NewsFitCore\Elementor\Widgets\VideoIcon;
use RT\NewsFitCore\Elementor\Widgets\SiteMenu;
use RT\NewsFitCore\Elementor\Widgets\MenuIcons;
use RT\NewsFitCore\Elementor\Widgets\SocialShare;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class ElementorController {
	use SingletonTraits;

	public function __construct() {
		ElementorCore::instance();
		add_action( 'elementor/widgets/register', [ $this, 'register_widget' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_category' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_style' ] );
		add_action( 'elementor/controls/register', [ $this, 'register_new_control' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'editor_scripts' ] );
		add_action( 'wp_ajax_rt_select2_object_search', [ $this, 'select2_ajax_posts_filter_autocomplete' ] );
		add_action( 'wp_ajax_nopriv_rt_select2_object_search', [ $this, 'select2_ajax_posts_filter_autocomplete' ] );
		// Select2 ajax save data.
		add_action( 'wp_ajax_rt_select2_get_title', [ $this, 'select2_ajax_get_posts_value_titles' ] );
		add_action( 'wp_ajax_nopriv_rt_select2_get_title', [ $this, 'select2_ajax_get_posts_value_titles' ] );
		//add_action( 'elementor/icons_manager/additional_tabs', [ $this, 'flaticon_support' ] );
		//add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
		//add_action( "elementor/frontend/after_enqueue_scripts", [ $this, 'rt_load_scripts' ] );
	}


	/**
	 * Editor JS.
	 *
	 * @return void
	 */
	public function editor_scripts() {
		$version = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? time() : NEWSFIT_CORE;

		wp_enqueue_script(
			'newsfit-editor-script',
			Fns::get_assets_url('js/editor.js'),
			[
				'jquery',
				'elementor-editor',
				'jquery-elementor-select2',
			],
			$version,
			true
		);


		//wp_enqueue_style( 'rtsb-el-editor-style', rtsb()->get_assets_uri( 'css/backend/elementor-editor.css' ), [], $version );
	}

	/**
	 * Register Controls
	 * @param $controls_manager
	 *
	 * @return void
	 */
	public function register_new_control( $controls_manager ) {
		$controls_manager->register( new ImageSelectorControl() );
		$controls_manager->register( new Select2AjaxControl() );
	}

	/**
	 * Register Elementor Widget.
	 * Just put the widget class reference here
	 * @return void
	 */
	public function register_widget() {

		$widgets = [
			ContactForm::class,
			InfoBox::class,
			Parallax::class,
			Post::class,
			PricingTable::class,
			ProgressBar::class,
			Slider::class,
			Team::class,
			Testimonial::class,
			Title::class,
			VideoIcon::class,
			SocialShare::class,
			SiteLogo::class,
			SiteMenu::class,
			MenuIcons::class,
		];

		/*if ( Plugin::$instance->preview->is_preview_mode() ) {
			if ( is_singular( ElmentorBuilderController::$post_type ) ) {
				$widgets[] = SiteLogo::class;
				$widgets[] = SiteMenu::class;
				$widgets[] = MenuIcons::class;
			}
		} else {
			$widgets[] = SiteLogo::class;
			$widgets[] = SiteMenu::class;
			$widgets[] = MenuIcons::class;
		}*/

		foreach ( $widgets as $class ) {
			Plugin::instance()->widgets_manager->register( new $class );
		}
	}

	/**
	 * Elementor Editor Style
	 * @return void
	 */
	public function editor_style() {
		$icon         = Fns::get_assets_url( 'images/icon.png' );
		$editor_style = '.elementor-element .icon .rdtheme-el-custom{content: url(' . $icon . ');width: 28px;}';
		$editor_style .= '.elementor-panel .select2-container {min-width: 100px !important; min-height: 30px !important;}';
		$editor_style .= '.elementor-panel .elementor-control-type-heading .elementor-control-title {color: #93013d !important}';

		wp_add_inline_style( 'elementor-editor', $editor_style );
	}

	/**
	 * Register Elementor category
	 *
	 * @param $elements_manager
	 *
	 * @return void
	 */
	public function widget_category( $elements_manager ) {
		$id                = NEWSFIT_CORE_PREFIX . '-widgets';
		$categories[ $id ] = [
			'title' => __( 'RadiusTheme Elements', 'newsfit-core' ),
			'icon'  => 'fa fa-plug',
		];

		$get_all_categories = $elements_manager->get_categories();
		$categories         = array_merge( $categories, $get_all_categories );
		$set_categories     = function ( $categories ) {
			$this->categories = $categories;
		};

		$set_categories->call( $elements_manager, $categories );
	}

	//load frontend script
	public function rt_load_scripts() {
		//wp_enqueue_script( 'imagesloaded' );
		//wp_enqueue_script( 'isotope' );
		wp_enqueue_script( 'select2' );
		wp_enqueue_script( 'elementor-script', NEWSFIT_CORE_BASE_URL . 'elementor/assets/scripts.js', [ 'jquery' ], NEWSFIT_CORE, true );
	}


	/**
	 * Adding custom icon to icon control in Elementor
	 */
	public function flaticon_support( $tabs = [] ) {
		// Append new icons
		$flat_icons = newsfit_flaticon_icons();

		$tabs['newsfit-flaticon-icons'] = [
			'name'          => 'newsfit-flaticon-icons',
			'label'         => esc_html__( 'Flat Icons', 'newsfit-core' ),
			'labelIcon'     => 'fab fa-elementor',
			'prefix'        => '',
			'displayPrefix' => '',
			'url'           => newsfit_get_css( 'flaticon' ),
			'icons'         => $flat_icons,
			'ver'           => '1.0',
		];

		return $tabs;
	}

	/**
	 * Ajax callback for rt-select2
	 *
	 * @param $post_type
	 * @param $limit
	 * @param $search
	 * @param $paged
	 *
	 * @return array
	 */
	public function get_query_data( $post_type = 'any', $limit = 10, $search = '', $paged = 1 ) {
		global $wpdb;
		$where = '';
		$data  = [];

		if ( - 1 == $limit ) {
			$limit = '';
		} elseif ( 0 == $limit ) {
			$limit = 'limit 0,1';
		} else {
			$offset = 0;
			if ( $paged ) {
				$offset = ( $paged - 1 ) * $limit;
			}
			$limit = $wpdb->prepare( ' limit %d, %d', esc_sql( $offset ), esc_sql( $limit ) );
		}

		if ( 'any' === $post_type ) {
			$in_search_post_types = get_post_types( [ 'exclude_from_search' => false ] );
			if ( empty( $in_search_post_types ) ) {
				$where .= ' AND 1=0 ';
			} else {
				$where .= " AND {$wpdb->posts}.post_type IN ('" . join(
						"', '",
						array_map( 'esc_sql', $in_search_post_types )
					) . "')";
			}
		} elseif ( ! empty( $post_type ) ) {
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_type = %s", esc_sql( $post_type ) );
		}

		if ( ! empty( $search ) ) {
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql( $search ) . '%' );
		}

		$query   = "select post_title,ID  from $wpdb->posts where post_status = 'publish' {$where} {$limit}";
		$results = $wpdb->get_results( $query );

		if ( ! empty( $results ) ) {
			foreach ( $results as $row ) {
				$data[ $row->ID ] = $row->post_title . ' [#' . $row->ID . ']';
			}
		}

		return $data;
	}

	/**
	 * Ajax callback for rt-select2
	 *
	 * @return void
	 */
	public function select2_ajax_posts_filter_autocomplete() {

		$query_per_page = 15;
		$post_type      = 'post';
		$source_name    = 'post_type';
		$paged          = $_POST['page'] ?? 1;

		if ( ! empty( $_POST['post_type'] ) ) {
			$post_type = sanitize_text_field( $_POST['post_type'] );
		}

		if ( ! empty( $_POST['source_name'] ) ) {
			$source_name = sanitize_text_field( $_POST['source_name'] );
		}

		$search  = ! empty( $_POST['search'] ) ? sanitize_text_field( $_POST['search'] ) : '';
		$results = $post_list = [];
		switch ( $source_name ) {
			case 'taxonomy':
				$args = [
					'hide_empty' => false,
					'orderby'    => 'name',
					'order'      => 'ASC',
					'search'     => $search,
					'number'     => '5',
				];

				if ( $post_type !== 'all' ) {
					$args['taxonomy'] = $post_type;
				}

				$post_list = wp_list_pluck( get_terms( $args ), 'name', 'term_id' );
				break;
			case 'user':
				$users = [];

				foreach ( get_users( [ 'search' => "*{$search}*" ] ) as $user ) {
					$user_id           = $user->ID;
					$user_name         = $user->display_name;
					$users[ $user_id ] = $user_name;
				}

				$post_list = $users;
				break;
			default:
				$post_list = $this->get_query_data( $post_type, $query_per_page, $search, $paged );
		}

		$pagination = true;
		if ( count( $post_list ) < $query_per_page ) {
			$pagination = false;
		}
		if ( ! empty( $post_list ) ) {
			foreach ( $post_list as $key => $item ) {
				$results[] = [
					'text' => $item,
					'id'   => $key,
				];
			}
		}
		wp_send_json(
			[
				'results'    => $results,
				'pagination' => [ 'more' => $pagination ],
			]
		);
	}


	/**
	 * Ajax callback for rt-select2
	 *
	 * @return void
	 */
	public function select2_ajax_get_posts_value_titles() {

		if ( empty( $_POST['id'] ) ) {
			wp_send_json_error( [] );
		}

		if ( empty( array_filter( $_POST['id'] ) ) ) {
			wp_send_json_error( [] );
		}
		$ids         = array_map( 'intval', $_POST['id'] );
		$source_name = ! empty( $_POST['source_name'] ) ? sanitize_text_field( $_POST['source_name'] ) : '';

		switch ( $source_name ) {
			case 'taxonomy':
				$args = [
					'hide_empty' => false,
					'orderby'    => 'name',
					'order'      => 'ASC',
					'include'    => implode( ',', $ids ),
				];

				if ( $_POST['post_type'] !== 'all' ) {
					$args['taxonomy'] = sanitize_text_field( $_POST['post_type'] );
				}

				$response = wp_list_pluck( get_terms( $args ), 'name', 'term_id' );
				break;
			case 'user':
				$users = [];

				foreach ( get_users( [ 'include' => $ids ] ) as $user ) {
					$user_id           = $user->ID;
					$user_name         = $user->display_name . '-' . $user->ID;
					$users[ $user_id ] = $user_name;
				}

				$response = $users;
				break;
			default:
				$post_info = get_posts(
					[
						'post_type' => sanitize_text_field( $_POST['post_type'] ),
						'include'   => implode( ',', $ids ),
					]
				);
				$response  = wp_list_pluck( $post_info, 'post_title', 'ID' );
		}

		if ( ! empty( $response ) ) {
			wp_send_json_success( [ 'results' => $response ] );
		} else {
			wp_send_json_error( [] );
		}
	}
}