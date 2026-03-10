<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

final class Books_Library_Blocks {

	public static function init(): void {
		add_action('init', [self::class, 'register_blocks']);
	}

	public static function register_blocks(): void {
		$blocks = [
			BOOKS_LIBRARY_PATH . 'build/blocks/faq-accordion',
			BOOKS_LIBRARY_PATH . 'build/blocks/faq-item',
		];

		foreach ($blocks as $block_path) {
			if (file_exists($block_path . '/block.json')) {
				register_block_type($block_path);
			}
		}
	}
}