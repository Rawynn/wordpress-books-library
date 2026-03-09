<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

final class Books_Library_Assets {

	public static function init(): void {
		add_action('wp_enqueue_scripts', [self::class, 'enqueue_frontend_assets']);
	}

	public static function enqueue_frontend_assets(): void {
        wp_enqueue_style(
			'books-library-style',
			BOOKS_LIBRARY_URL . 'assets/css/main.css',
			[],
			BOOKS_LIBRARY_VERSION
		);
        
		wp_enqueue_script(
			'books-library-scripts',
			BOOKS_LIBRARY_URL . 'assets/js/scripts.js',
			[],
			BOOKS_LIBRARY_VERSION,
			true
		);

        wp_localize_script(
            'books-library-scripts',
            'booksLibraryData',
            [
                'restUrl' => esc_url_raw(rest_url('books-library/v1/related-books')),
            ]
        );
	}

    public static function enqueue_editor_assets(): void {
		wp_enqueue_style(
			'books-library-style',
			BOOKS_LIBRARY_URL . 'assets/css/main.css',
			[],
			BOOKS_LIBRARY_VERSION
		);
	}
}