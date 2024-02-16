<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$args = [
	'hamburg'       => $hamburger,
	'search'        => $search,
	'login'         => $login,
	'button'        => $button,
	'has_separator' => $has_separator
];

if ( $button_label ) {
	$args['button_label'] = $button_label;
}

newsfit_menu_icons_group( $args );