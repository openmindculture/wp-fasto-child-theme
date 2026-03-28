<?php
/**
 * Template for previous & next posts
 *
 * @package Fasto
 * @author fribba
 *
 */
?>
<div class="other-posts fasto-row">
	<div class="col-desktop-12"><h2><?php echo esc_html__( 'Older and newer blog posts','fasto' ); ?></h2></div>

	<div class="col-desktop-6">
		<?php
		$size = fasto_get_thumb_size();
		//previous post
		$fasto_prev_post = get_adjacent_post( false, '', false );
		if( !empty( $fasto_prev_post ) ) {
			$fasto_image = get_the_post_thumbnail_url( $fasto_prev_post->ID , $size );
			$fasto_alt_title = get_post( get_post_thumbnail_id( $fasto_prev_post->ID ) )->post_excerpt ? get_post( get_post_thumbnail_id( $fasto_prev_post->ID ) )->post_excerpt : get_post( get_post_thumbnail_id( $fasto_prev_post->ID ) )->post_title;
			if ( empty( $fasto_alt_title ) ) {
				$fasto_alt_title = esc_html__( 'post image','fasto' );
			}
			if ( $fasto_image ){
				echo '<a href="' . esc_url( get_permalink( $fasto_prev_post->ID ) ) . '" title="' . esc_attr( $fasto_prev_post->post_title ) . '"><img class="other-posts-thumbnail" src="'.esc_url( $fasto_image ).'" alt="'.esc_attr( $fasto_alt_title ).'" /></a>';
			}
			echo '<h3><a href="' . esc_url( get_permalink( $fasto_prev_post->ID ) ) . '" title="' . esc_attr( $fasto_prev_post->post_title ) . '">';
			echo '<span class="p-name post-title">';
			echo get_the_title( $fasto_prev_post->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			//we need this to allow html tags in post title
			echo '</span></a></h3>';
		}
		?>
	</div>

	<div class="col-desktop-6">
		<?php
		//next post
		$fasto_next_post = get_adjacent_post( false, '', true );
		if( !empty( $fasto_next_post ) ) {
			$fasto_image = get_the_post_thumbnail_url( $fasto_next_post->ID , $size );
			$fasto_alt_title = get_post( get_post_thumbnail_id( $fasto_next_post->ID ) )->post_excerpt ? get_post( get_post_thumbnail_id( $fasto_next_post->ID ) )->post_excerpt : get_post( get_post_thumbnail_id( $fasto_next_post->ID ) )->post_title;
			if ( $fasto_image ){
				echo '<a href="' . esc_url( get_permalink( $fasto_next_post->ID ) ) . '" title="' . esc_attr( $fasto_next_post->post_title ) . '"><img class="other-posts-thumbnail" src="'.esc_url( $fasto_image ).'" alt="'.esc_attr( $fasto_alt_title ).'" /></a>';
			}
			echo '<h3><a href="' . esc_url( get_permalink( $fasto_next_post->ID ) ) . '" title="' . esc_attr( $fasto_next_post->post_title ) . '">';
			echo '<span class="p-name post-title">';
			echo get_the_title( $fasto_next_post->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			//we need this to allow html tags in post title
			echo '</span></a></h3>';
		}
		?>
	</div>

</div>
