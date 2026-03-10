<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

class Books_Library_REST_API {

	public static function init(): void {
		add_action('rest_api_init', [self::class, 'register_routes']);
	}

	public static function register_routes(): void {

		register_rest_route(
			'books-library/v1',
			'/related-books',
			[
				'methods'  => 'GET',
				'callback' => [self::class, 'get_related_books'],
				'permission_callback' => '__return_true',
			]
		);

	}

	public static function get_related_books(WP_REST_Request $request): array {

		$current_book_id = absint($request->get_param('current_book_id'));

		$query = new WP_Query([
			'post_type'           => 'book',
			'post_status'         => 'publish',
			'posts_per_page'      => 20,
			'post__not_in'        => [$current_book_id],
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		]);

		$books = [];

		foreach ($query->posts as $book) {

			$terms = get_the_terms($book->ID, 'genre');
			$genres = [];

			if ($terms && !is_wp_error($terms)) {
				$genres = wp_list_pluck($terms, 'name');
			}

            $image_id = get_post_thumbnail_id($book->ID);

			$books[] = [
				'id'      => $book->ID,
				'title'   => get_the_title($book->ID),
				'date'    => get_the_date('', $book->ID),
				'genre'   => $genres,
				'excerpt' => get_the_excerpt($book->ID),
				'link'    => get_permalink($book->ID),
                'image' => [
                    'medium' => wp_get_attachment_image_url($image_id, 'medium'),
                    'large'  => wp_get_attachment_image_url($image_id, 'large'),
                ],
			];
		}

		return $books;
	}
}