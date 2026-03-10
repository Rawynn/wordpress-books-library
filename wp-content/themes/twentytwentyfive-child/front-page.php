<?php
declare(strict_types=1);

get_header();

$books_query = new WP_Query([
	'post_type'           => 'book',
	'post_status'         => 'publish',
	'posts_per_page'      => -1,
	'orderby'             => 'date',
	'order'               => 'DESC',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
]);
?>

<main class="books-homepage">
    <section class="books-hero">
        <div class="books-hero__inner container">
            <p class="books-hero__eyebrow"><?php esc_html_e('Books Library', 'books-library'); ?></p>
            <h1 class="books-hero__title"><?php esc_html_e('Discover our book collection', 'books-library'); ?></h1>
            <p class="books-hero__text">
                <?php esc_html_e('Browse all books available in the library and explore each title in detail.', 'books-library'); ?>
            </p>
        </div>
    </section>

    <section class="books-homepage__listing">
        <div class="books-homepage__inner container">
            <?php if ($books_query->have_posts()) : ?>
            <ul class="books-grid" aria-label="<?php esc_attr_e('Books list', 'books-library'); ?>">
                <?php
					while ($books_query->have_posts()) :
						$books_query->the_post();

						$book_id      = get_the_ID();
						$genres       = get_the_terms($book_id, 'genre');
						$button_id    = 'book-card-button-' . $book_id;
						$panel_id     = 'book-card-panel-' . $book_id;
						$cover_alt    = trim((string) get_post_meta(get_post_thumbnail_id($book_id), '_wp_attachment_image_alt', true));
						$excerpt_text = wp_strip_all_tags(get_the_excerpt());
						?>
                <li class="books-grid__item">
                    <article class="book-flip-card" data-book-card>
                        <div class="book-flip-card__inner">
                            <div class="book-flip-card__face book-flip-card__face--front">
                                <button class="book-flip-card__trigger" type="button"
                                    id="<?php echo esc_attr($button_id); ?>" aria-expanded="false"
                                    aria-controls="<?php echo esc_attr($panel_id); ?>" data-book-card-toggle>
                                    <?php if (has_post_thumbnail()) : ?>
                                    <?php
												the_post_thumbnail(
													'large',
													[
														'class'   => 'book-flip-card__image',
														'alt'     => $cover_alt ?: get_the_title(),
														'loading' => 'lazy',
													]
												);
												?>
                                    <?php else : ?>
                                    <span class="book-flip-card__placeholder">
                                        <?php the_title(); ?>
                                    </span>
                                    <?php endif; ?>

                                    <span class="screen-reader-text">
                                        <?php
												printf(
													esc_html__('Show details for %s', 'books-library'),
													get_the_title()
												);
												?>
                                    </span>
                                </button>
                            </div>

                            <div class="book-flip-card__face book-flip-card__face--back"
                                id="<?php echo esc_attr($panel_id); ?>" role="region"
                                aria-labelledby="<?php echo esc_attr($button_id); ?>">
                                <div class="book-flip-card__content">
                                    <?php if ($genres && !is_wp_error($genres)) : ?>
                                    <p class="book-flip-card__genres">
                                        <?php echo esc_html(implode(', ', wp_list_pluck($genres, 'name'))); ?>
                                    </p>
                                    <?php endif; ?>

                                    <h2 class="book-flip-card__title"><?php the_title(); ?></h2>

                                    <?php if (!empty($excerpt_text)) : ?>
                                    <p class="book-flip-card__excerpt"><?php echo esc_html($excerpt_text); ?></p>
                                    <?php endif; ?>

                                    <div class="book-flip-card__actions">
                                        <button class="book-flip-card__close" type="button" data-book-card-close>
                                            <?php esc_html_e('Back to cover', 'books-library'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="book-flip-card__footer">
                            <a class="book-flip-card__read-more" href="<?php the_permalink(); ?>">
                                <?php esc_html_e('Czytaj więcej', 'books-library'); ?>
                            </a>
                        </div>
                    </article>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php wp_reset_postdata(); ?>
            <?php else : ?>
            <p><?php esc_html_e('No books found.', 'books-library'); ?></p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();