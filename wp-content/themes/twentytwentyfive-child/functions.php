<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

add_action('wp_head', 'books_library_add_viewport_meta', 1);

function books_library_add_viewport_meta(): void {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
}

add_action('wp_enqueue_scripts', 'twentytwentyfive_child_enqueue_assets');

function twentytwentyfive_child_enqueue_assets(): void {
	$style_path = get_stylesheet_directory() . '/assets/css/main.css';
    $script_path = get_stylesheet_directory() . '/assets/js/home-books.js';

	wp_enqueue_style(
		'twentytwentyfive-child-style',
		get_stylesheet_directory_uri() . '/assets/css/main.css',
		[],
		file_exists($style_path) ? (string) filemtime($style_path) : wp_get_theme()->get('Version')
	);

    if (is_front_page() || is_tax('genre')) {
		wp_enqueue_script(
			'twentytwentyfive-child-home-books',
			get_stylesheet_directory_uri() . '/assets/js/home-books.js',
			[],
			file_exists($script_path) ? (string) filemtime($script_path) : wp_get_theme()->get('Version'),
			true
		);
	}
}