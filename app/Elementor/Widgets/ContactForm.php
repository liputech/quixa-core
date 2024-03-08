<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\QuixaCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use RT\QuixaCore\Helper\Fns;
use RT\QuixaCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ContactForm extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'Contact Form', 'quixa-core' );
		$this->rt_base = 'rt-contact-form';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'quixa-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label'     => __( 'Choose Image', 'quixa-core' ),
				'type'      => Controls_Manager::MEDIA,
				'selectors' => array( '{{WRAPPER}} .rtin-right' => 'background-image: url({{URL}})' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => esc_html__( 'Title', 'quixa-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Lorem Ipsum'
			]
		);

		$this->add_control(
			'content',
			[
				'label' => esc_html__( 'Shortcode', 'quixa-core' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'quixa-core' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'type'            => Controls_Manager::SLIDER,
				'label'           => __( 'Min Height', 'quixa-core' ),
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 500,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 500,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 500,
					'unit' => 'px',
				],
				'selectors'       => array(
					'{{WRAPPER}} .rtin-left' => 'min-height: {{SIZE}}{{UNIT}};',
				)
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();
		Fns::get_template( 'elementor/contact/view-1', $data );
	}
}