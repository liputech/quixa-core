<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\QuixaCore\Hooks;

use RT\QuixaCore\Traits\SingletonTraits;

class FilterHooks {
	use SingletonTraits;


	public function __construct() {
		//Add user contact info
		add_filter( 'user_contactmethods', [ __CLASS__, 'rt_user_extra_contact_info' ] );
		add_filter( 'the_password_form', [ __CLASS__, 'rt_post_password_form' ] );
		add_filter( 'get_search_form', [ $this, 'search_form' ] );


	}

	/**
	 * Search form modify
	 * @return string
	 */
	public function search_form() {
		$output = '
		<form method="get" class="quixa-search-form" action="' . esc_url( home_url( '/' ) ) . '">
            <div class="search-box">
				<input type="text" class="form-control" placeholder="' . esc_attr__( 'Search here...', 'quixa' ) . '" value="' . get_search_query() . '" name="s" />
				<button class="item-btn" type="submit">
					' . quixa_get_svg( 'search' ) . '
					<span class="btn-label">' . esc_html__( "Search", "quixa" ) . '</span>
				</button>
            </div>
		</form>
		';

		return $output;
	}


	/* User Contact Info */
	public static function rt_user_extra_contact_info( $contactmethods ) {
		// unset($contactmethods['aim']);
		// unset($contactmethods['yim']);
		// unset($contactmethods['jabber']);
		$contactmethods['rt_phone']     = __( 'Phone Number', 'quixa-core' );
		$contactmethods['rt_facebook']  = __( 'Facebook', 'quixa-core' );
		$contactmethods['rt_twitter']   = __( 'Twitter', 'quixa-core' );
		$contactmethods['rt_linkedin']  = __( 'LinkedIn', 'quixa-core' );
		$contactmethods['rt_vimeo']     = __( 'Vimeo', 'quixa-core' );
		$contactmethods['rt_youtube']   = __( 'Youtube', 'quixa-core' );
		$contactmethods['rt_instagram'] = __( 'Instagram', 'quixa-core' );
		$contactmethods['rt_pinterest'] = __( 'Pinterest', 'quixa-core' );
		$contactmethods['rt_reddit']    = __( 'Reddit', 'quixa-core' );

		return $contactmethods;
	}

	/*
	 * change post password from
	 */
	public static function rt_post_password_form() {
		global $post;
		$label  = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$output = '<form action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
		<p>' . __( 'This content is password protected. To view it please enter your password below:' ) . '</p>
		<p><label for="' . $label . '"><span class="pass-label">' . __( 'Password:' ) . ' </span><input name="post_password" id="' . $label
		          . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form' ) . '" /></label></p></form>
		';

		return $output;
	}

}