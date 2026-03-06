<?php get_header(); ?>

<main class="container single-page">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="single-article">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-article__image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <h1><?php the_title(); ?></h1>

                <div class="single-article__content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p>Записей пока нет.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
