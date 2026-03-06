<?php get_header(); ?>

<main class="container single-page">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php
        $price = get_post_meta(get_the_ID(), 'price', true);

        $badges_raw = get_post_meta(get_the_ID(), 'badges', true);
        if (!$badges_raw) {
            $badges_raw = get_post_meta(get_the_ID(), 'badge', true);
        }

        $badges = array_filter(array_map('trim', explode(',', $badges_raw)));
        ?>

        <article class="single-promo">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="single-back-link">
                ← Назад к услугам
            </a>

            <header class="single-promo__header">
                <?php if (!empty($badges)) : ?>
                    <div class="single-promo__badges">
                        <?php foreach ($badges as $badge) : ?>
                            <span class="single-promo__badge"><?php echo esc_html($badge); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <h1><?php the_title(); ?></h1>

                <?php if ($price) : ?>
                    <div class="single-promo__price">от <?php echo esc_html($price); ?> ₽</div>
                <?php endif; ?>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="single-promo__image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="single-promo__content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
