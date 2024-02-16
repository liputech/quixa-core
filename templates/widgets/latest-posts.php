<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use RT\NewsFit\Helpers\Fns;

$post_count = get_query_var( 'post_count' );
$first_post = $post_count == 1 ? 'first-one' : 'normal-post';

if ( ! empty( $meta_style ) ) {
	$_meta_style = $meta_style;
} else {
	if ( ! is_single() ) {
		$_meta_style = newsfit_option( 'rt_blog_meta_style' );
	} else {
		$_meta_style = newsfit_option( 'rt_single_meta_style' );
	}
}

$post_classes = Fns::class_list( [ 'newsfit-post-card', $_meta_style, $first_post ] );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
    <div class="article-inner-wrapper">
		<?php newsfit_post_thumbnail(); ?>
        <div class="entry-wrapper">
            <header class="entry-header">
				<?php
				if ( ! empty( $meta_list ) && newsfit_option( 'rt_meta_visibility' ) ) {
					echo newsfit_post_meta( [
						'with_list'     => true,
						'include'       => $meta_list,
						'edit_link'     => true,
						'author_prefix' => newsfit_option( 'rt_author_prefix' ),
					] );
				}
				the_title( sprintf( '<h4 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' );
				?>
            </header>

			<?php
			if ( $content_visibility !== 'hide' && ( $content_visibility == 'all' || ( $content_visibility == 'first' && $post_count == 1 ) ) ) {
				echo "<div class='entry-content'>";
				echo wp_trim_words( get_the_excerpt(), 15 );
				echo "</div>";
			}
			?>
        </div>
    </div>
</article>