<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


if ( $nav_menu == '0' ) {
	return;
}
?>
<nav id="site-navigation" class="quixa-navigation" role="navigation">
	<?php
	wp_nav_menu( [
		'menu'        => $nav_menu,
		'menu_class'  => 'quixa-navbar',
		'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'fallback_cb' => 'quixa_custom_menu_cb',
		'walker'      => has_nav_menu( 'primary' ) ? new RT\Quixa\Core\WalkerNav() : '',
	] );
	?>
</nav>