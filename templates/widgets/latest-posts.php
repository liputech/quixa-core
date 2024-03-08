<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use RT\Quixa\Helpers\Fns;
$post_classes = 'rt-blog-post';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
    <div class="article-inner-wrapper">
		<?php quixa_post_thumbnail('quixa-size4'); ?>
        <div class="entry-wrapper">
				<?php
				if ( ! empty( $meta_list ) ) {
					echo quixa_post_meta( [
						'with_list'     => true,
						'include'       => $meta_list,
					] );
				}
				the_title( sprintf( '<h4 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' );
				?>

			<?php
            if( $content ):
				echo "<div class='entry-content'>";
				echo wp_trim_words( get_the_excerpt(), 15 );
				echo "</div>";
                endif;
			?>
        </div>
    </div>
</article>