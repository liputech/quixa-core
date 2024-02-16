<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFitCore\Hooks;

use RT\NewsFitCore\Traits\SingletonTraits;

class FilterHooks {
	use SingletonTraits;


	public function __construct() {
		//Add user contact info
		add_filter( 'user_contactmethods', [ __CLASS__, 'rt_user_extra_contact_info' ] );
		add_filter( 'the_password_form', [ __CLASS__, 'rt_post_password_form' ] );

		//remove admin bar
		add_action( 'after_setup_theme', [ __CLASS__, 'remove_admin_bar' ], 999 );

		//Menu query string pass
		add_action( 'wp_nav_menu_item_custom_fields', function ( $item_id, $item ) {
			$menu_query_string_key = get_post_meta( $item_id, 'rt_menu_query_string_key', true );
			$menu_query_string     = get_post_meta( $item_id, 'rt_menu_query_string', true );
			?>
            <div class="menu-query-string description-wide">
                <p class="description description-thin">
                    <label for="rt-menu-query-string-key-<?php echo $item_id; ?>">
						<?php _e( 'Query String Key', 'newsfit-core' ); ?><br>
                        <input type="text"
                               id="rt-menu-query-string-key-<?php echo $item_id; ?>"
                               name="rt-menu-query-string-key[<?php echo $item_id; ?>]"
                               value="<?php echo esc_html( $menu_query_string_key ); ?>"
                        />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="rt-menu-query-string-<?php echo $item_id; ?>">
						<?php _e( 'Query String Value', 'newsfit-core' ); ?><br>
                        <input type="text"
                               id="rt-menu-query-string-<?php echo $item_id; ?>"
                               name="rt-menu-query-string[<?php echo $item_id; ?>]"
                               value="<?php echo esc_html( $menu_query_string ); ?>"
                        />
                    </label>
                </p>
            </div>
			<?php

		}, 10, 2 );

		add_action( 'wp_update_nav_menu_item', function ( $menu_id, $menu_item_db_id ) {
			$query_string_key   = isset( $_POST['rt-menu-query-string-key'][ $menu_item_db_id ] ) ? $_POST['rt-menu-query-string-key'][ $menu_item_db_id ] : '';
			$query_string_value = isset( $_POST['rt-menu-query-string'][ $menu_item_db_id ] ) ? $_POST['rt-menu-query-string'][ $menu_item_db_id ] : '';
			update_post_meta( $menu_item_db_id, 'rt_menu_query_string_key', $query_string_key );
			update_post_meta( $menu_item_db_id, 'rt_menu_query_string', $query_string_value );
		}, 10, 2 );


		add_filter( 'wp_get_nav_menu_items', function ( $items, $menu, $args ) {
			foreach ( $items as $item ) {
				$menu_query_string_key = get_post_meta( $item->ID, 'rt_menu_query_string_key', true );
				$menu_query_string     = get_post_meta( $item->ID, 'rt_menu_query_string', true );
				if ( $menu_query_string ) {
					$item->url = add_query_arg( $menu_query_string_key, $menu_query_string, $item->url );
				}
			}

			return $items;
		}, 11, 3 );
	}

	/**
	 * Remove admin bar
	 * @return void
	 */
	public static function remove_admin_bar() {
		$remove_admin_bar = newsfit_option( 'rt_remove_admin_bar' );
		if ( $remove_admin_bar && ! current_user_can( 'administrator' ) && ! is_admin() ) {
			show_admin_bar( false );
		}
	}

	/* User Contact Info */
	public static function rt_user_extra_contact_info( $contactmethods ) {
		// unset($contactmethods['aim']);
		// unset($contactmethods['yim']);
		// unset($contactmethods['jabber']);
		$contactmethods['rt_phone']     = __( 'Phone Number', 'newsfit-core' );
		$contactmethods['rt_facebook']  = __( 'Facebook', 'newsfit-core' );
		$contactmethods['rt_twitter']   = __( 'Twitter', 'newsfit-core' );
		$contactmethods['rt_linkedin']  = __( 'LinkedIn', 'newsfit-core' );
		$contactmethods['rt_vimeo']     = __( 'Vimeo', 'newsfit-core' );
		$contactmethods['rt_youtube']   = __( 'Youtube', 'newsfit-core' );
		$contactmethods['rt_instagram'] = __( 'Instagram', 'newsfit-core' );
		$contactmethods['rt_pinterest'] = __( 'Pinterest', 'newsfit-core' );
		$contactmethods['rt_reddit']    = __( 'Reddit', 'newsfit-core' );

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