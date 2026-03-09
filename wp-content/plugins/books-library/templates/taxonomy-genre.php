<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

get_header();

$term = get_queried_object();
?>

<main class="books-library-genre">

    <header class="books-library-genre__header">
        <h1 class="books-library-genre__title">
            <?php single_term_title(); ?>
        </h1>

        <?php $description = term_description(); ?>
        <?php if (!empty($description)) : ?>
        <div class="books-library-genre__description">
            <?php echo wp_kses_post($description); ?>
        </div>
        <?php endif; ?>
    </header>

    <?php if (have_posts()) : ?>
    <div class="books-library-genre__list">
        <?php while (have_posts()) : the_post(); ?>
        <article class="genre-book-card">
            <h2 class="genre-book-card__title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <div class="genre-book-card__meta">
                <span class="genre-book-card__date">
                    <?php echo esc_html(get_the_date()); ?>
                </span>
            </div>

            <div class="genre-book-card__excerpt">
                <?php the_excerpt(); ?>
            </div>
        </article>
        <?php endwhile; ?>
    </div>

    <nav class="books-library-genre__pagination" aria-label="<?php esc_attr_e('Genre pagination', 'books-library'); ?>">
        <div class="books-library-genre__pagination-prev">
            <?php previous_posts_link(__('Previous', 'books-library')); ?>
        </div>

        <div class="books-library-genre__pagination-next">
            <?php next_posts_link(__('Next', 'books-library')); ?>
        </div>
    </nav>

    <?php else : ?>
    <p><?php esc_html_e('No books found in this genre.', 'books-library'); ?></p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>