<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

class Books_Library_Templates {

    public static function init(): void {
        add_filter('single_template', [self::class, 'load_single_book_template']);
        add_filter('taxonomy_template', [self::class, 'load_genre_taxonomy_template']);
    }

    public static function load_single_book_template(string $template): string {

        if (is_singular('book')) {

            $plugin_template = BOOKS_LIBRARY_PATH . 'templates/single-book.php';

            if (file_exists($plugin_template)) {
                return $plugin_template;
            }
        }

        return $template;
    }

    public static function load_genre_taxonomy_template(string $template): string {
		if (is_tax('genre')) {
			$plugin_template = BOOKS_LIBRARY_PATH . 'templates/taxonomy-genre.php';

			if (file_exists($plugin_template)) {
				return $plugin_template;
			}
		}

		return $template;
	}
}