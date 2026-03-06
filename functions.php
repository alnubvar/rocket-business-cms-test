<?php

function rocket_theme_scripts() {
    wp_enqueue_style(
        'rocket-style',
        get_stylesheet_uri(),
        [],
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    wp_enqueue_script(
        'rocket-slider',
        get_template_directory_uri() . '/slider.js',
        [],
        filemtime(get_template_directory() . '/slider.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'rocket_theme_scripts');

function rocket_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary' => 'Главное меню',
    ]);
}
add_action('after_setup_theme', 'rocket_theme_setup');

function rocket_register_post_types() {
    register_post_type('promo', [
        'labels' => [
            'name' => 'Акции',
            'singular_name' => 'Акция',
            'add_new' => 'Добавить акцию',
            'add_new_item' => 'Добавить новую акцию',
            'edit_item' => 'Редактировать акцию',
            'new_item' => 'Новая акция',
            'view_item' => 'Посмотреть акцию',
            'search_items' => 'Искать акции',
            'not_found' => 'Акции не найдены',
            'not_found_in_trash' => 'В корзине акций не найдено',
            'menu_name' => 'Акции',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-megaphone',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'rewrite' => ['slug' => 'promotions'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'rocket_register_post_types');

function rocket_add_promo_meta_box() {
    add_meta_box(
        'rocket_promo_meta',
        'Параметры акции',
        'rocket_promo_meta_callback',
        'promo',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'rocket_add_promo_meta_box');

function rocket_promo_meta_callback($post) {
    $price = get_post_meta($post->ID, 'price', true);
    $badges = get_post_meta($post->ID, 'badges', true);

    wp_nonce_field('rocket_save_promo_meta', 'rocket_promo_meta_nonce');
    ?>
    <p>
        <label for="rocket_price"><strong>Цена</strong></label><br>
        <input
            type="text"
            id="rocket_price"
            name="price"
            value="<?php echo esc_attr($price); ?>"
            style="width: 100%;"
        >
    </p>

    <p>
        <label for="rocket_badges"><strong>Бейджи</strong></label><br>
        <input
            type="text"
            id="rocket_badges"
            name="badges"
            value="<?php echo esc_attr($badges); ?>"
            style="width: 100%;"
        >
    </p>

    <p>
        <small>Указывай несколько бейджей через запятую. Например: Скидка, Акция</small>
    </p>
    <?php
}

function rocket_save_promo_meta($post_id) {
    if (!isset($_POST['rocket_promo_meta_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['rocket_promo_meta_nonce'], 'rocket_save_promo_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['price'])) {
        update_post_meta($post_id, 'price', sanitize_text_field($_POST['price']));
    }

    if (isset($_POST['badges'])) {
        update_post_meta($post_id, 'badges', sanitize_text_field($_POST['badges']));
    }
}
add_action('save_post_promo', 'rocket_save_promo_meta');
