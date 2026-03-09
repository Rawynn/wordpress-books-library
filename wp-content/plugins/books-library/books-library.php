<?php
/**
 * Plugin Name: Books Library
 * Description: Recruitment task solution for Books CPT, Genre taxonomy, templates, AJAX and FAQ block.
 * Version: 1.0.0
 * Author: JB
 * Text Domain: books-library
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

define('BOOKS_LIBRARY_VERSION', '1.0.0');
define('BOOKS_LIBRARY_PATH', plugin_dir_path(__FILE__));
define('BOOKS_LIBRARY_URL', plugin_dir_url(__FILE__));

require_once BOOKS_LIBRARY_PATH . 'includes/class-assets.php';
require_once BOOKS_LIBRARY_PATH . 'includes/class-post-types.php';
require_once BOOKS_LIBRARY_PATH . 'includes/class-templates.php';
require_once BOOKS_LIBRARY_PATH . 'includes/class-rest-api.php';

add_action('plugins_loaded', static function (): void {
	Books_Library_Assets::init();
    Books_Library_Post_Types::init();
    Books_Library_Templates::init();
    Books_Library_REST_API::init();
});