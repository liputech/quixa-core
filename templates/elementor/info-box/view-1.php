<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


$target   = $link['is_external'] ? ' target="_blank"' : '';
$nofollow = $link['nofollow'] ? ' rel="nofollow"' : '';

?>

<div class="service3-box-right rt-info-box-wrap-1 rt-info-box icon-el-style-1">
	<div class="service-box">
		<div class="service3-icon-holder icon-holder <?php echo esc_attr( $bg_animation . ' ' . $icon_animation . ' ' . $image_invert ) ?>">
			<?php
			echo $link['url'] ? '<a href="' . $link['url'] . '"' . $target . $nofollow . '>' : null;
			if ( 'image' == $icon_type ) {
				echo "<div class='img-wrap'><div class='hover-bg'></div>";
				echo wp_get_attachment_image( $image_icon['id'], 'full' );
				echo "</div>";
			} else {
				\Elementor\Icons_Manager::render_icon( $info_icon, [ 'aria-hidden' => 'true' ] );
			}
			echo $link['url'] ? '</a>' : null;
			?>
		</div>

		<div class="service3-content-holder content-holder content-align">
			<?php if ( $title ) : ?>
				<h3 class="info-title">
					<?php
					echo $link['url'] ? '<a href="' . $link['url'] . '"' . $target . $nofollow . '>' : null;
					echo wp_kses_post( $title );
					echo $link['url'] ? '</a>' : null;
					?>
				</h3>
			<?php endif; ?>

			<?php if ( $sub_title ) : ?>
				<p><?php echo wp_kses_post( $sub_title ); ?></p>
			<?php endif; ?>

			<?php if ( $show_readmore_btn ) : ?>
				<div class="read-more-btn <?php echo esc_attr( $read_more_btn_visibility ) ?>">
					<a class="button-el" href="<?php echo esc_url( $link['url'] ) ?>" <?php echo esc_attr( $target . ' ' . $nofollow ) ?>>
						<div class="button-text">
							<?php ( $btn_icon_position == 'left' ) ? \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ) : null; ?>
							<span><?php echo esc_html( $read_more_btn_text ); ?></span>
							<?php ( $btn_icon_position == 'right' ) ? \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ) : null; ?>
						</div>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>