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
        <div class="books-hero__inner">
            <p class="books-hero__eyebrow"><?php esc_html_e('Books Library', 'books-library'); ?></p>
            <h1 class="books-hero__title"><?php esc_html_e('Discover our book collection', 'books-library'); ?></h1>
            <p class="books-hero__text">
                <?php esc_html_e('Browse all books available in the library and explore each title in detail.', 'books-library'); ?>
            </p>
        </div>
    </section>

    <section class="books-homepage__listing">
        <div class="books-homepage__inner">
            <?php if ($books_query->have_posts()) : ?>
            <ul class="books-grid" aria-label="<?php esc_attr_e('Books list', 'books-library'); ?>">
                <?php while ($books_query->have_posts()) : $books_query->the_post(); ?>
                <li class="books-grid__item">
                    <article class="book-card">
                        <a class="book-card__link" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="book-card__image-wrapper">
                                <?php the_post_thumbnail('medium_large', ['class' => 'book-card__image']); ?>
                            </div>
                            <?php endif; ?>

                            <div class="book-card__content">
                                <?php
										$genres = get_the_terms(get_the_ID(), 'genre');
										?>

                                <?php if ($genres && !is_wp_error($genres)) : ?>
                                <p class="book-card__genres">
                                    <?php echo esc_html(implode(', ', wp_list_pluck($genres, 'name'))); ?>
                                </p>
                                <?php endif; ?>

                                <h2 class="book-card__title"><?php the_title(); ?></h2>

                                <div class="book-card__excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </a>
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