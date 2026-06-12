<?php

/**
 * 404 page
 *
 * @package Fasto
 * @author fribba
 *
 */
get_header(); ?>

<div id="page-404"><!-- start #404-page-->
	<h1><?php echo esc_html__('Sorry', 'fasto') ?></h1>
	<p><?php echo esc_html__('Try using fewer or more general keywords, or explore our latest topics.'); ?></p>

	<div class="articles fasto-row">


		<?php
		wp_reset_postdata();
		$the_query = new WP_Query([
			'posts_per_page' => 6,
			'orderby'        => 'date',
			'order'          => 'DESC',
		]);
		if ($the_query->have_posts()) {
			while ($the_query->have_posts()) {
				$the_query->the_post();
				get_template_part('templates/search');
			}
		}
		?>
		</div><!-- end .articles.fasto-row -->
	</div><!-- end #404-page-->

	<?php get_footer(); ?>