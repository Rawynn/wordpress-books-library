<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

class Books_Library_Blocks {

	public static function init(): void {
		add_action('init', [self::class, 'register_blocks']);
	}

	public static function register_blocks(): void {
        wp_register_script(
			'books-library-faq-block-editor',
			BOOKS_LIBRARY_URL . 'blocks/faq-accordion/index.js',
			[
				'wp-blocks',
				'wp-block-editor',
				'wp-element',
				'wp-components',
				'wp-i18n',
			],
			BOOKS_LIBRARY_VERSION,
			true
		);
        
		register_block_type(BOOKS_LIBRARY_PATH . 'blocks/faq-accordion/block.json');
		register_block_type(BOOKS_LIBRARY_PATH . 'blocks/faq-accordion/item-block.json');
	}
}