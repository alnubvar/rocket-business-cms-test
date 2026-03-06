<?php get_header(); ?>

<main class="container single-page">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single-article">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="single-back-link">
                ← Назад к статьям
            </a>

            <header class="single-article__header">
                <div class="single-article__date">
                    <?php echo get_the_date('d.m.Y'); ?>
                </div>

                <h1><?php the_title(); ?></h1>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="single-article__image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="single-article__content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
