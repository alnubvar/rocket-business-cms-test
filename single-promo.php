<?php get_header(); ?>

<main class="container single-page">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single-promo">
            <?php if (has_post_thumbnail()) : ?>
                <div class="single-promo__image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <h1><?php the_title(); ?></h1>
            <div class="single-promo__content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
