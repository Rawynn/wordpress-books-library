<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

final class Books_Library_Assets {

	public static function init(): void {
		add_action('wp_enqueue_scripts', [self::class, 'enqueue_frontend_assets']);
		add_action('enqueue_block_editor_assets', [self::class, 'enqueue_editor_assets']);
		add_action('wp_footer', [self::class, 'render_home_widget']);
	}

	public static function enqueue_frontend_assets(): void {
		$style_path      = BOOKS_LIBRARY_PATH . 'assets/css/main.css';
		$script_path     = BOOKS_LIBRARY_PATH . 'assets/js/scripts.js';
		$faq_script_path = BOOKS_LIBRARY_PATH . 'assets/js/faq-accordion.js';

		wp_enqueue_style(
			'books-library-style',
			BOOKS_LIBRARY_URL . 'assets/css/main.css',
			[],
			file_exists($style_path) ? (string) filemtime($style_path) : BOOKS_LIBRARY_VERSION
		);

		wp_enqueue_script(
			'books-library-scripts',
			BOOKS_LIBRARY_URL . 'assets/js/scripts.js',
			[],
			file_exists($script_path) ? (string) filemtime($script_path) : BOOKS_LIBRARY_VERSION,
			true
		);

		wp_localize_script(
			'books-library-scripts',
			'booksLibraryData',
			[
				'restUrl' => esc_url_raw(rest_url('books-library/v1/related-books')),
			]
		);

		if (self::should_load_faq_assets()) {
			wp_enqueue_script(
				'books-library-faq-accordion',
				BOOKS_LIBRARY_URL . 'assets/js/faq-accordion.js',
				[],
				file_exists($faq_script_path) ? (string) filemtime($faq_script_path) : BOOKS_LIBRARY_VERSION,
				true
			);
		}
	}

	public static function enqueue_editor_assets(): void {
		$style_path = BOOKS_LIBRARY_PATH . 'assets/css/main.css';

		wp_enqueue_style(
			'books-library-editor-style',
			BOOKS_LIBRARY_URL . 'assets/css/main.css',
			[],
			file_exists($style_path) ? (string) filemtime($style_path) : BOOKS_LIBRARY_VERSION
		);
	}

	public static function render_home_widget(): void {
	if (is_admin() || is_front_page() || is_home()) {
		return;
	}

	$home_url = home_url('/');
	$faq_url  = home_url('/faq/');
	?>
<div class="books-floating-widgets">
    <a class="books-home-widget books-home-widget--home" href="<?php echo esc_url($home_url); ?>"
        aria-label="<?php esc_attr_e('Back to home', 'books-library'); ?>">
        <span class="books-home-widget__icon" aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M3 10L12 3L21 10V21H3V10Z" stroke-width="2" stroke-linejoin="round" />
            </svg>
        </span>

        <span class="books-home-widget__label">
            <?php esc_html_e('Back to home', 'books-library'); ?>
        </span>
    </a>

    <a class="books-home-widget books-home-widget--faq" href="<?php echo esc_url($faq_url); ?>"
        aria-label="<?php esc_attr_e('Go to FAQ', 'books-library'); ?>">
        <span class="books-home-widget__icon" aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M9.09 9A3 3 0 0 1 15 9.75C15 12 12 12.5 12 14" stroke-width="2" stroke-linecap="round" />
                <circle cx="12" cy="17" r="1" fill="currentColor" stroke="none" />
            </svg>
        </span>

        <span class="books-home-widget__label">
            <?php esc_html_e('Go to FAQ', 'books-library'); ?>
        </span>
    </a>
</div>
<?php
}

	private static function should_load_faq_assets(): bool {
		if (is_admin()) {
			return false;
		}

		if (!is_singular()) {
			return false;
		}

		$post = get_post();

		if (!$post instanceof WP_Post) {
			return false;
		}

		return has_block('books-library/faq-accordion', $post);
	}
}