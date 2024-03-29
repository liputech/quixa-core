<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\QuixaCore\Api\Widgets;

use \WP_Widget;
use \RT_Widget_Fields;

//---------------------------------------------------------------------------
// Flickr widget
//---------------------------------------------------------------------------

class Contact_Widget extends WP_Widget {

	public function __construct() {
		$id    = QUIXA_CORE_PREFIX . '_contact';
		$title = __( 'Quixa: Contact', 'quixa-core' );
		$args  = [
			'description' => esc_html__( 'Displays Contact Info', 'quixa-core' )
		];
		parent::__construct( $id, $title, $args );
	}


	public function form( $instance ) {
		$defaults = [
			'title'   => __( 'Contact', 'quixa-core' ),
			'address' => quixa_option( 'rt_contact_address' ),
			'mail'    => quixa_option( 'rt_email' ),
			'phone'   => quixa_option( 'rt_phone' ),
			'website' => quixa_option( 'rt_website' ),
		];

		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'   => [
				'label' => esc_html__( 'Title', 'quixa-core' ),
				'type'  => 'text',
			],
			'address' => [
				'label' => esc_html__( 'Address', 'quixa-core' ),
				'type'  => 'textarea',
			],
			'mail'    => [
				'label' => esc_html__( 'Mail', 'quixa-core' ),
				'type'  => 'text',
			],
			'phone'   => [
				'label' => esc_html__( 'Phone', 'quixa-core' ),
				'type'  => 'text',
			],
			'website' => [
				'label' => esc_html__( 'Website', 'quixa-core' ),
				'type'  => 'text',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']   = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
		$instance['mail']    = ( ! empty( $new_instance['mail'] ) ) ? strip_tags( $new_instance['mail'] ) : '';
		$instance['phone']   = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
		$instance['website'] = ( ! empty( $new_instance['website'] ) ) ? strip_tags( $new_instance['website'] ) : '';

		return $instance;
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo quixa_contact_render( $instance );

		//do_shortcode( "[rt_contact address='{$_address}' mail='{$_mail}' phone='{$_phone}' website='{$_website}']" );
		echo $args['after_widget'];
	}
}