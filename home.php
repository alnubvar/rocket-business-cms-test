<?php get_header(); ?>

<main class="container">

    <section class="articles">
        <h2>Статьи</h2>

        <div class="articles-grid">
            <?php
            $articles_query = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 3
            ]);

            if ($articles_query->have_posts()) :
                while ($articles_query->have_posts()) : $articles_query->the_post();
            ?>
                <article class="article-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="article-card__image">
                            <?php the_post_thumbnail('medium_large'); ?>
                        </a>
                    <?php endif; ?>

                    <div class="article-card__content">
                        <h3>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>

                        <p><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>

                        <span class="article-card__date"><?php echo get_the_date('d.m.Y'); ?></span>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Пока статей нет.</p>';
            endif;
            ?>
        </div>
    </section>

    <section class="services">
        <h2>Услуги</h2>

        <div class="services-grid">
            <?php
            $promo_query = new WP_Query([
                'post_type' => 'promo',
                'posts_per_page' => 10
            ]);

            if ($promo_query->have_posts()) :
                while ($promo_query->have_posts()) : $promo_query->the_post();

                    $price = get_post_meta(get_the_ID(), 'price', true);

                    $badges_raw = get_post_meta(get_the_ID(), 'badges', true);
                    if (!$badges_raw) {
                        $badges_raw = get_post_meta(get_the_ID(), 'badge', true);
                    }

                    $badges = array_filter(array_map('trim', explode(',', $badges_raw)));
            ?>
                <article class="service-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="service-card__image">
                            <?php if (!empty($badges)) : ?>
                                <div class="service-card__badges">
                                    <?php foreach ($badges as $badge) : ?>
                                        <span class="service-card__badge"><?php echo esc_html($badge); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php the_post_thumbnail('medium_large'); ?>
                        </a>
                    <?php endif; ?>

                    <div class="service-card__content">
                        <h3>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>

                        <p><?php echo wp_trim_words(get_the_excerpt(), 10); ?></p>

                        <?php if ($price) : ?>
                            <span class="service-card__price">от <?php echo esc_html($price); ?> ₽</span>
                        <?php endif; ?>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Пока акций нет.</p>';
            endif;
            ?>
        </div>

        <div class="services-slider-dots" aria-label="Навигация по услугам"></div>
    </section>

</main>

<?php get_footer(); ?>
