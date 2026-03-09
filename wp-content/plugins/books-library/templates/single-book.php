<?php
get_header();

while (have_posts()) :
    the_post();
?>

<main class="books-library-single">

    <article class="book">

        <h1 class="book__title">
            <?php the_title(); ?>
        </h1>

        <?php if (has_post_thumbnail()) : ?>
        <div class="book__image">
            <?php the_post_thumbnail('large'); ?>
        </div>
        <?php endif; ?>

        <div class="book__meta">

            <span class="book__date">
                <?php echo esc_html(get_the_date()); ?>
            </span>

            <?php
            $terms = get_the_terms(get_the_ID(), 'genre');

            if (!empty($terms) && !is_wp_error($terms)) :
            ?>
            <span class="book__genre">
                <?php
                    $genres = wp_list_pluck($terms, 'name');
                    echo esc_html(implode(', ', $genres));
                    ?>
            </span>
            <?php endif; ?>

        </div>

        <div class="book__content">
            <?php the_content(); ?>
        </div>

    </article>

    <section class="book-related">

        <h2><?php esc_html_e('More Books', 'books-library'); ?></h2>

        <div id="books-library-related" data-current-book="<?php echo esc_attr(get_the_ID()); ?>">
        </div>

    </section>

</main>

<?php
endwhile;

get_footer();