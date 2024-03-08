<?php
/*
Plugin Name: Quixa Core
Plugin URI: https://www.radiustheme.com
Description: Quixa Theme Core Plugin
Version: 1.0.0
Author: RadiusTheme
Author URI: https://www.radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'QUIXA_CORE' ) ) {
	define( 'QUIXA_CORE', '1.0.0' );
	define( 'QUIXA_CORE_PREFIX', 'quixa' );
	define( 'QUIXA_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'QUIXA_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'RT\\QuixaCore\\Init' ) ) :
	RT\QuixaCore\Init::instance();
endif;