<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container site-header__inner">
        <h1 class="site-header__logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">Rocket Business</a>
        </h1>

        <nav class="site-header__nav" aria-label="Главное меню">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'site-header__menu',
                'fallback_cb' => false,
            ]);
            ?>
        </nav>
    </div>
</header>
