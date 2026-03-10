<?php
declare(strict_types=1);

get_header();

while (have_posts()) :
	the_post();

	$terms = get_the_terms(get_the_ID(), 'genre');
	$excerpt = get_the_excerpt();
?>

<main class="books-library-single">
    <div class="books-library-single__inner container">

        <article class="book">
            <div class="book__layout">

                <div class="book__sidebar">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="book__image">
                        <?php the_post_thumbnail('large', ['class' => 'book__image-element']); ?>
                    </div>
                    <?php endif; ?>

                    <div class="book__meta">
                        <span class="book__date">
                            <?php echo esc_html(get_the_date()); ?>
                        </span>

                        <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                        <div class="book__genres" aria-label="<?php esc_attr_e('Book genres', 'books-library'); ?>">
                            <?php foreach ($terms as $term) : ?>
                            <?php
									$term_link = get_term_link($term);

									if (is_wp_error($term_link)) {
										continue;
									}
									?>
                            <a class="book__genre-link" href="<?php echo esc_url($term_link); ?>">
                                <?php echo esc_html($term->name); ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="book__body">
                    <header class="book__header">
                        <h1 class="book__title"><?php the_title(); ?></h1>

                        <?php if (!empty($excerpt)) : ?>
                        <p class="book__excerpt">
                            <?php echo esc_html($excerpt); ?>
                        </p>
                        <?php endif; ?>
                    </header>

                    <div class="book__content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </article>

        <section class="book-related">
            <h2 class="book-related__title"><?php esc_html_e('More Books', 'books-library'); ?></h2>

            <div id="books-library-related" data-current-book-id="<?php echo esc_attr((string) get_the_ID()); ?>">
                <p><?php esc_html_e('Loading books...', 'books-library'); ?></p>
            </div>
        </section>

    </div>
</main>

<?php
endwhile;

get_footer();