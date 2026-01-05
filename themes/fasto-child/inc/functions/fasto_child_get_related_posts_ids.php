<?php
if (!defined('ABSPATH')) {
	exit;
}

/*
====================================================
fasto_child_get_related_posts_ids()

return IDs of up to 3 related posts by tag names
omitting the adjacent previous and next posts,
omitting posts configured for omission in theme option, and
omitting the current global post itself
====================================================
*/

function fasto_child_get_related_posts_ids()
{
	global $post;
	$post_id = $post->ID;
	$tag_ids = wp_get_post_tags($post_id, array('fields' => 'ids'));
	$tag_list = implode(',', array_map('intval', $tag_ids));

	if (!$tag_list) {
		return array();
	}

	global $wpdb;
	$fasto_child_related_query = "
SELECT object_id
FROM {$wpdb->term_relationships}
WHERE term_taxonomy_id IN ($tag_list)
AND object_id != {$post_id}
";

	$fasto_sticky_posts = get_option('sticky_posts');
	echo "<!-- get_option sticky_posts: {$fasto_sticky_posts} -->";
	if ($fasto_sticky_posts) {
		foreach($fasto_sticky_posts as $sticky_post_id) {
			echo "<!-- omit sticky {$sticky_post_id} -->";
			$fasto_child_related_query .= "
AND object_id != {$sticky_post_id}
		";
		}
	}

	$fasto_prev_post = get_adjacent_post( false, '', false );
	$fasto_prev_post_id = $fasto_prev_post ? $fasto_prev_post->ID : 0;
	if ($fasto_prev_post_id) {
		$fasto_child_related_query .= "
AND object_id != {$fasto_prev_post_id}
		";
	}

	$fasto_next_post = get_adjacent_post( false, '', true );
	$fasto_next_post_id = $fasto_next_post ? $fasto_next_post->ID : 0;

	if ($fasto_next_post_id) {
		$fasto_child_related_query .= "
AND object_id != {$fasto_next_post_id}
		";
	}

	$fasto_child_related_query .= "
GROUP BY object_id
ORDER BY COUNT(term_taxonomy_id) DESC
LIMIT 3
";

	return $wpdb->get_col($fasto_child_related_query);
}

