<?php

/**
 * Search template
 *
 * @package Fasto
 * @author fribba
 *
 */
get_header(); ?>

<div class="breadcrumb-navigation">
	<h1 class="page-title"><?php echo esc_html__('Search Result', 'fasto') ?></h1>
</div>

<div class="articles fasto-row"><!-- start .articles -->

	<?php

	if (current_user_can('manage_options') && isset($_GET['previewdrafts'])) {

		$args = array(
			'post_type' => 'post',
			'post_status' => array('draft'),
			'meta_key'    => '_thumbnail_id',
			'meta_value'  => '',
			'meta_compare' => '!=',
			'posts_per_page' => -1,
		);
		$ids = isset($_GET['ids']) ? $_GET['ids'] : '';
		if ($ids) {
			$args['orderby'] = 'post__in';
			$args['post__in'] = explode(',', $ids);
		} else {
			$args['orderby'] = 'ID';
			$args['order'] = 'DESC';
		}
		$lang = isset($_GET['lang']) ? $_GET['lang'] : '';
		if ($lang) {
			$args['lang'] = $lang;
		} else {
			$args['lang'] = ''; // This deactivates the Polylang language filter
		}
		$the_query = new WP_Query($args);
		$previews_shown = array();

		if ($the_query->have_posts()) {
			while ($the_query->have_posts()) {
				$the_query->the_post();
				$translations = pll_get_post_translations(get_the_ID());
				foreach ($translations as $language => $translated_post_id) {
					if (array_key_exists($translated_post_id, $previews_shown)) {
						continue 2;
					}
				}
				get_template_part('templates/search');
				$previews_shown[get_the_ID()] = 1;
			}
		}
		wp_reset_postdata();

		// force restoration of Polylang filters for the main loop
		if (function_exists('pll_current_language')) {
			global $wp_query;
			$current_lang = pll_current_language();
			$wp_query->set('lang', $current_lang);
			$wp_query->get_posts();
		}
	}
	// continue regular loop
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			get_template_part('templates/search');
		}
		$fasto_pagination_args = array('prev_text' => __('&laquo;', 'fasto'), 'next_text' => __('&raquo;', 'fasto'));
		the_posts_pagination($fasto_pagination_args);
	} //end if you have_posts
	else { ?>

		<div id="search-no-result" class="top-info col-desktop-12 col-tablet-12 col-small-tablet-12 col-mobile-12"><!-- start .top-info-->
			<h2><?php echo esc_html__('No articles matched your search for ', 'fasto') .  get_search_query(); ?></h2>
			<p><?php echo esc_html__('Try using fewer or more general keywords, or explore our latest topics.'); ?></p>

		</div><!-- end .top-info-->

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

	<?php } ?>

</div><!-- end .articles-->

<?php get_footer(); ?>