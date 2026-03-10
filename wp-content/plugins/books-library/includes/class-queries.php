<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

class Books_Library_Queries {

	public static function init(): void {
		add_action('pre_get_posts', [self::class, 'modify_genre_archive_query']);
	}

	public static function modify_genre_archive_query(WP_Query $query): void {
		if (is_admin() || !$query->is_main_query()) {
			return;
		}

		if ($query->is_tax('genre')) {
			$query->set('post_type', 'book');
			$query->set('posts_per_page', 5);
			$query->set('orderby', 'date');
			$query->set('order', 'DESC');
		}
	}
}