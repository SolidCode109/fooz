<?php
add_action('init', function () {
    // Register the "Books" custom post type
    $labels = [
        'name'                  => __('Books', 'twentytwentyfive-child'),
        'singular_name'         => __('Book', 'twentytwentyfive-child'),
        'menu_name'             => __('Books', 'twentytwentyfive-child'),
        'name_admin_bar'        => __('Add New', 'twentytwentyfive-child'),
        'add_new_item'          => __('Add New Book', 'twentytwentyfive-child'),
        'new_item'              => __('New Book', 'twentytwentyfive-child'),
        'edit_item'             => __('Edit Book', 'twentytwentyfive-child'),
        'view_item'             => __('View Book', 'twentytwentyfive-child'),
        'all_items'             => __('All Books', 'twentytwentyfive-child'),
        'search_items'          => __('Search Books', 'twentytwentyfive-child'),
        'parent_item_colon'     => __('Parent Books:', 'twentytwentyfive-child'),
        'not_found'             => __('No books found.', 'twentytwentyfive-child'),
        'not_found_in_trash'    => __('No books found in Trash.', 'twentytwentyfive-child'),
    ];

    $args = [

        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'library'],
        'supports'           => ['title', 'editor', 'thumbnail', 'revision'],
        'show_in_rest'       => true, // Enables support for the block editor
        'menu_position'      => 5, // Position in admin menu
        'menu_icon'          => 'dashicons-book', // Icon for admin menu
        'taxonomies'         => ['genre'], // Associate taxonomy
        'labels'             => $labels,
    ];


    register_post_type('books', $args);

    // Register the "Genre" taxonomy for the "Books" custom post type
    $taxonomy_labels = [
        'name'              => __('Genres',  'twentytwentyfive-child'),
        'singular_name'     => __('Genre', 'twentytwentyfive-child'),
        'search_items'      => __('Search Genres', 'twentytwentyfive-child'),
        'all_items'         => __('All Genres', 'twentytwentyfive-child'),
        'parent_item'       => __('Parent Genre', 'twentytwentyfive-child'),
        'parent_item_colon' => __('Parent Genre:', 'twentytwentyfive-child'),
        'edit_item'         => __('Edit Genre', 'twentytwentyfive-child'),
        'update_item'       => __('Update Genre', 'twentytwentyfive-child'),
        'add_new_item'      => __('Add New Genre', 'twentytwentyfive-child'),
        'new_item_name'     => __('New Genre Name', 'twentytwentyfive-child'),
        'menu_name'         => __('Genre', 'twentytwentyfive-child'),
    ];

    $taxonomy_args = [
        'hierarchical'      => true, // True for categories-like, false for tags-like
        'public'            => true,
        'show_in_rest'      => true, // Enables support for the block editor
        'rewrite'           => [
            'slug' => 'book-genre',  // The slug for your taxonomy
            'with_front' => false,
            'hierarchical' => true, // Ensure this is true for proper pagination
        ],
        'show_admin_column' => true,
        'labels'            => $taxonomy_labels,
    ];

    register_taxonomy('genre', 'books', $taxonomy_args);
});
