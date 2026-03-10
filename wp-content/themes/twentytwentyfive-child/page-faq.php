<?php
declare(strict_types=1);

get_header();

while (have_posts()) :
	the_post();
?>

<main class="faq-page">
    <div class="faq-page__overlay"></div>

    <div class="faq-page__layout container">
        <section class="faq-page__card">
            <header class="faq-page__header">
                <p class="faq-page__eyebrow"><?php esc_html_e('Help center', 'books-library'); ?></p>
                <!-- <h1 class="faq-page__title"><?php the_title(); ?></h1> -->

                <?php if (has_excerpt()) : ?>
                <p class="faq-page__intro"><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php endif; ?>
            </header>

            <div class="faq-page__content">
                <?php the_content(); ?>
            </div>
        </section>
    </div>
</main>

<?php
endwhile;

get_footer();