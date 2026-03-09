<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

class Books_Library_Post_Types {

	public static function init(): void {
		add_action('init', [self::class, 'register']);
	}

	public static function register(): void {
		self::register_book_post_type();
		self::register_genre_taxonomy();
	}

	private static function register_book_post_type(): void {
		$labels = [
			'name'          => __('Books', 'books-library'),
			'singular_name' => __('Book', 'books-library'),
			'menu_name'     => __('Books', 'books-library'),
			'add_new'       => __('Add New', 'books-library'),
			'add_new_item'  => __('Add New Book', 'books-library'),
			'edit_item'     => __('Edit Book', 'books-library'),
			'new_item'      => __('New Book', 'books-library'),
			'view_item'     => __('View Book', 'books-library'),
			'all_items'     => __('All Books', 'books-library'),
			'search_items'  => __('Search Books', 'books-library'),
			'not_found'     => __('No books found.', 'books-library'),
		];

		$args = [
			'labels'       => $labels,
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => [
				'slug'       => 'library',
				'with_front' => false,
			],
			'menu_icon'    => 'dashicons-book',
			'show_in_rest' => true,
			'supports'     => ['title', 'editor', 'thumbnail', 'excerpt'],
		];

		register_post_type('book', $args);
	}

	private static function register_genre_taxonomy(): void {
		$labels = [
			'name'          => __('Genres', 'books-library'),
			'singular_name' => __('Genre', 'books-library'),
			'search_items'  => __('Search Genres', 'books-library'),
			'all_items'     => __('All Genres', 'books-library'),
			'edit_item'     => __('Edit Genre', 'books-library'),
			'update_item'   => __('Update Genre', 'books-library'),
			'add_new_item'  => __('Add New Genre', 'books-library'),
			'new_item_name' => __('New Genre Name', 'books-library'),
			'menu_name'     => __('Genres', 'books-library'),
		];

		$args = [
			'labels'            => $labels,
			'public'            => true,
			'hierarchical'      => false,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => [
				'slug'       => 'book-genre',
				'with_front' => false,
			],
		];

		register_taxonomy('genre', ['book'], $args);
	}
}