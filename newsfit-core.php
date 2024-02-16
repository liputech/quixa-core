<?php
/*
Plugin Name: NewsFit Core
Plugin URI: https://www.radiustheme.com
Description: NewsFit Theme Core Plugin
Version: 1.0.0
Author: RadiusTheme
Author URI: https://www.radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'NEWSFIT_CORE' ) ) {
	define( 'NEWSFIT_CORE', '1.0.0' );
	define( 'NEWSFIT_CORE_PREFIX', 'newsfit' );
	define( 'NEWSFIT_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'NEWSFIT_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'RT\\NewsFitCore\\Init' ) ) :
	RT\NewsFitCore\Init::instance();
endif;