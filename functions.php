<?php

function rocket_theme_scripts() {
    wp_enqueue_style('rocket-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'rocket_theme_scripts');

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

function rocket_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'rocket_theme_setup');
