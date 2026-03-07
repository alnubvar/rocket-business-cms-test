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

            <section class="single-promo__hero">
                <div class="single-promo__hero-content">
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

                    <?php if (has_excerpt()) : ?>
                        <div class="single-promo__excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <?php if (has_post_thumbnail()) : ?>
                <div class="single-promo__image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="single-promo__content">
                <?php the_content(); ?>
            </div>

            <section class="single-promo__form-block">
                <h2>Оставить заявку</h2>
                <p>Заполните форму ниже, и мы свяжемся с вами в ближайшее время.</p>

                <?php echo do_shortcode('[contact-form-7 id="ca7b288" title="Обратная связь"]'); ?>
            </section>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
