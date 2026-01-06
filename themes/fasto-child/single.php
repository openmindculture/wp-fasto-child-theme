<?php
/**
 * Template for single post
 *
 * @package Fasto
 * @author fribba
 *
 */
get_header();

//layout
$fasto_layout = fasto_mod( 'fasto_blog_single_layout' );

$fasto_articles_grid = '';
if ( $fasto_layout == 'sidebar' ){
	$fasto_articles_grid = ' col-desktop-8 col-tablet-12 col-small-tablet-12 col-mobile-12 padding-right-30';
}
$fasto_wordpress_default_date_format = get_option( 'date_format' ) ;
?>

<?php if ( $fasto_layout == 'sidebar'  ) {  ?> <div class="fasto-row"><!-- start .fasto-row --> <?php }  ?>

	<div class="article-single <?php echo esc_attr( $fasto_articles_grid ); ?>"><!-- start .article-single -->

		<?php
		if( have_posts() ) {
			while( have_posts() ) {
				the_post(); ?>

				<?php fasto_post_thumb( false,  true , false , false , false ); fasto_categories( $post->ID ); ?>
				<?php fasto_cat_breadcrumb(); ?>
				<h1 class="article-title"><?php the_title(); ?></h1>
				<div class="author-date">
					<span class="body-color author-url" class="color-1"><?php echo esc_html( get_the_author_meta( 'nickname' ) ); ?></span>
					<div class="vertical-separator"></div>
					<?php /* <!-- BEGIN patch: add stylable element -->  */ ?>
					<span class="author-date-date"><?php echo esc_html( get_the_date( $fasto_wordpress_default_date_format ) );?></span>
					<?php /* <!-- END patch: add stylable element -->   */ ?>
					<?php /* <!-- BEGIN patch: hide comment count --> */ ?>
					<?php /* <div class="vertical-separator"></div> */ ?>
					<?php
					// printf(
					/* translators: number of comments */
					//	esc_html( _n( '%1$s Comments ', '%1$s Comments ', get_comments_number(), 'fasto' ) ),
					//	esc_html( number_format_i18n( get_comments_number() ) )
					// );
					?>
					<?php /* <!-- END patch: hide comment count --> */ ?>
				</div>
				<div class="separator single"></div>

				<div class="post-content">
					<?php /* <!-- pen Mind Culture patch: don't social media sharing buttons --> */ ?>
					<div class="post-content-inner">
						<?php the_content(); ?>
					</div>
					<?php
					$fasto_pagination_args = array(
						'before'           => '<div class="pagination"><ul>',
						'after'            => '</ul></div>',
						'link_before'      => '<li>',
						'link_after'       => '</li>',
					);
					wp_link_pages( $fasto_pagination_args );
					?>
				</div>

				<?php /* Open Mind Culture patch: don't show and link post tags */ ?>
				<div class="separator single"></div>
				<?php get_template_part( 'templates/adjacent-posts' ); ?>
				<div class="separator single"></div>

				<?php
			}
			// end while have_posts

			//comments
			comments_template();
		}
		//end if have_posts
		?>


	</div><!-- end .article-single-->

<?php if ( $fasto_layout == 'sidebar' ) { ?>
	<div id="sidebar" class="col-desktop-4 col-tablet-12 col-small-tablet-12 col-mobile-12">
		<?php do_action('fasto_before_sidebar'); ?>
		<?php dynamic_sidebar('sidebar'); ?>
		<?php do_action('fasto_after_sidebar'); ?>
	</div>
	</div><!-- end .fasto-row -->
<?php } ?>

	<div class="separator single big"></div>

	<div class="author-box"><!-- start .author-box -->
		<div class="author">
			<?php
			echo fasto_author_avatar(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			// fasto_author_avatar() - uses get_avatar() - which is escaped in WordPress core
			?>
		</div>
		<h3 class="primary-font color-1"><?php esc_html_e('About author','fasto'); ?></h3>
		<h2><?php echo esc_html( fasto_author_info( 'nickname' ) ); ?></h2>
		<p><?php echo esc_html( fasto_author_info( 'description' ) ); ?></p>
	</div><!-- end .author-box -->

	<aside><div class="related-articles"><!-- start .related-articles -->
		<h2 class="title"><?php echo esc_html__( 'You might also like','fasto' );  ?></h2>
		<div class="fasto-row">

			<?php
			// optional retrieval by tag match (slower, more accurate)
			// omits adjacent previous, next posts already displayed before
			include ('inc/functions/fasto_child_get_related_posts_ids.php');
			$fasto_related_posts_ids = fasto_child_get_related_posts_ids();
			if ( !empty( $fasto_related_posts_ids ) ) {
				$fasto_child_related_query = new WP_Query( array(
					'post__in' => $fasto_related_posts_ids,
					'post__not_in' => get_option("sticky_posts"),
					'orderby' => 'post__in'
				));
				if( $fasto_child_related_query->have_posts() ) {
					while( $fasto_child_related_query->have_posts() ) {
						$fasto_child_related_query->the_post();
						get_template_part( 'templates/post' );
					}
					wp_reset_postdata();
				}
			}

			$fasto_count_missing_related = 3 - count( $fasto_related_posts_ids );
			echo "<!-- fasto_count_missing_related = 3 - count( fasto_related_posts_ids ) = $fasto_count_missing_related -->";

			$fasto_args__not_in = array( $post->ID );
			$fasto_prev_post = get_adjacent_post( false, '', false );
			if ( $fasto_prev_post ) {
				$fasto_args__not_in[] = $fasto_prev_post->ID;
			}
			$fasto_next_post = get_adjacent_post( false, '', true );
			if ( $fasto_next_post ) {
				$fasto_args__not_in[] = $fasto_next_post->ID;
			}

			// fallback: original quick lookup by category
			if ( $fasto_count_missing_related > 0 ) {
				echo "<!-- needs category based fallback recommendations -->";
				$fasto_cat = get_the_category( $post->ID );
				$fasto_args = array(
					'post_type' => array( 'post' ),
					'posts_per_page' => $fasto_count_missing_related,
					'post__not_in' => $fasto_args__not_in,
					'cat' => $fasto_cat[0]->term_id,
				);
				echo "<!-- query args: $fasto_args -->";
				$fasto_query = new WP_Query( $fasto_args );
				if( $fasto_query->have_posts() ) {
					while( $fasto_query->have_posts() ) {
						$fasto_query->the_post();
						get_template_part( 'templates/post' );
					}
					wp_reset_postdata();
				}
			}
			?>
		</div>
	</div><!-- end .related-articles --></aside>
<?php get_footer(); ?>
