<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


$box_shadow         = '';
$shadow_color       = str_replace( ',', '', newsfit_hex2rgb( $animation_border1_color ) );
$animation_opacity1 = $animation_opacity ?? 30;
$animation_opacity2 = $animation_opacity1 - 10;
$animation_opacity3 = $animation_opacity1 - 20;
if ( 'icon-style1' == $layout ) {
	$box_shadow = "box-shadow: 0 0 0 10px rgb({$shadow_color} / {$animation_opacity1}%), 0 0 0 20px rgb({$shadow_color} / {$animation_opacity2}%), 0 0 0 30px rgb({$shadow_color} / {$animation_opacity3}%);";
}
$img_url = wp_get_attachment_image_src( $image['id'], 'full' );
$img_bg  = '';
if ( $img_url ) {
	$img_bg = "background-image:url(" . esc_attr( $img_url[0] ) . ")";
}
?>
<div class="rt-video-icon-wrapper <?php echo esc_attr( $layout ) ?>" style="<?php echo esc_attr( $img_bg ) ?>">
	<div class="video-icon-inner">
		<div class="icon-left">
			<div class="icon-box">
				<a class="popup-youtube video-popup-icon" href="<?php echo esc_url( $video_url ) ?>">
					<span class="triangle"></span>
					<span class="rt-ripple-effect" style="<?php echo esc_attr( $box_shadow ) ?>"></span>
				</a>
			</div>
		</div>
		<?php if ( $button_text ) : ?>
			<div class="icon-right">
				<a class="popup-youtube button-text" href="<?php echo esc_url( $video_url ) ?>">
					<?php echo esc_html( $button_text ) ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>

