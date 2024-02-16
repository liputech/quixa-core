<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFitCore\Api\Widgets;

use \WP_Widget;
use \RT_Widget_Fields;

class About_Widget extends WP_Widget {

	public function __construct() {
		$id    = NEWSFIT_CORE_PREFIX . '_about';
		$title = __( 'NewsFit: About', 'newsfit-core' );
		$args  = [
			'description' => __( 'Displays Contact Info', 'newsfit-core' ),
		];
		parent::__construct( $id, $title, $args );
	}

	public function widget( $args, $instance ) {

		echo wp_kses_post( $args['before_widget'] );

		?>
        <div class="about-logo">
			<?php
			if ( ! empty( $instance['logo'] ) ) {
				echo wp_get_attachment_image( $instance['logo'], 'full' );
			} else {
				echo newsfit_site_logo();
			}
			?>
        </div>

		<?php
		if ( ! empty( $instance['description'] ) ) {
			echo "<p>" . newsfit_html( $instance['description'] ) . "</p>";
		}
		newsfit_about_social( $instance );
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance                = [];
		$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['logo']        = ( ! empty( $new_instance['logo'] ) ) ? sanitize_text_field( $new_instance['logo'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? wp_kses_post( $new_instance['description'] ) : '';
		$instance['facebook']    = ( ! empty( $new_instance['facebook'] ) ) ? sanitize_text_field( $new_instance['facebook'] ) : '';
		$instance['twitter']     = ( ! empty( $new_instance['twitter'] ) ) ? sanitize_text_field( $new_instance['twitter'] ) : '';
		$instance['linkedin']    = ( ! empty( $new_instance['linkedin'] ) ) ? sanitize_text_field( $new_instance['linkedin'] ) : '';
		$instance['pinterest']   = ( ! empty( $new_instance['pinterest'] ) ) ? sanitize_text_field( $new_instance['pinterest'] ) : '';
		$instance['instagram']   = ( ! empty( $new_instance['instagram'] ) ) ? sanitize_text_field( $new_instance['instagram'] ) : '';
		$instance['youtube']     = ( ! empty( $new_instance['youtube'] ) ) ? sanitize_text_field( $new_instance['youtube'] ) : '';
		$instance['rss']         = ( ! empty( $new_instance['rss'] ) ) ? sanitize_text_field( $new_instance['rss'] ) : '';
		$instance['zalo']        = ( ! empty( $new_instance['zalo'] ) ) ? sanitize_text_field( $new_instance['zalo'] ) : '';
		$instance['telegram']    = ( ! empty( $new_instance['telegram'] ) ) ? sanitize_text_field( $new_instance['telegram'] ) : '';

		return $instance;
	}

	public function form( $instance ) {
		$defaults = [
			'title'       => '',
			'logo'        => '',
			'description' => '',
			'facebook'    => '',
			'twitter'     => '',
			'linkedin'    => '',
			'pinterest'   => '',
			'instagram'   => '',
			'youtube'     => '',
			'rss'         => '',
			'zalo'        => '',
			'telegram'    => '',
		];
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'       => [
				'label' => esc_html__( 'Title', 'newsfit-core' ),
				'type'  => 'text',
			],
			'logo'        => [
				'label' => esc_html__( 'Logo', 'newsfit-core' ),
				'type'  => 'image',
				'desc'  => esc_html__( 'Conditionally display the light or dark logo based on the chosen footer style; refrain from preselecting any logo. ', 'newsfit-core' ),
			],
			'description' => [
				'label' => esc_html__( 'Description', 'newsfit-core' ),
				'type'  => 'textarea',
			],
			'facebook'    => [
				'label' => esc_html__( 'Facebook URL', 'newsfit-core' ),
				'type'  => 'url',
			],
			'twitter'     => [
				'label' => esc_html__( 'Twitter URL', 'newsfit-core' ),
				'type'  => 'url',
			],
			'linkedin'    => [
				'label' => esc_html__( 'Linkedin URL', 'newsfit-core' ),
				'type'  => 'url',
			],
			'pinterest'   => [
				'label' => esc_html__( 'Pinterest URL', 'newsfit-core' ),
				'type'  => 'url',
			],
			'instagram'   => [
				'label' => esc_html__( 'Instagram URL', 'newsfit-core' ),
				'type'  => 'url',
			],
			'youtube'     => [
				'label' => esc_html__( 'YouTube URL', 'newsfit-core' ),
				'type'  => 'url',
			],
			'rss'         => [
				'label' => esc_html__( 'Rss Feed URL', 'newsfit-core' ),
				'type'  => 'url',
			],
			'zalo'        => [
				'label' => esc_html__( 'Zalo Feed URL', 'newsfit-core' ),
				'type'  => 'url',
			],
			'telegram'    => [
				'label' => esc_html__( 'Telegram Feed URL', 'newsfit-core' ),
				'type'  => 'url',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

}