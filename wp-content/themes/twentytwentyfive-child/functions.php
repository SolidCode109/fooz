<?php

include get_stylesheet_directory() . '/includes/custom-post-type.php';

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
    wp_enqueue_script('child-theme', get_template_directory_uri() . '-child/assets/js/scripts.js', array("jquery"), true);


    // Pass AJAX URL to the script
    wp_localize_script('child-theme', 'ajaxData', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}



add_action('wp_enqueue_scripts', function () {
    if (!wp_script_is('jquery', 'enqueued')) {
        wp_enqueue_script('jquery');
    }
});

add_action('wp_enqueue_scripts', function () {
    // Ensure jQuery is loaded
    wp_enqueue_script('jquery');

    // Enqueue your custom script
    wp_enqueue_script(
        'custom-scripts',
        get_stylesheet_directory_uri() . '/assets/js/scripts.js',
        ['jquery'],
        null,
        true // Load in footer
    );
});

add_filter('template_include', function ($template) {
    // Check for single post type template
    if (is_singular('books')) {
        $custom_template = get_stylesheet_directory() . '/includes/templates/single-books.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    // Check for archive template
    if (is_post_type_archive('books')) {
        $custom_template = get_stylesheet_directory() . '/includes/templates/archive-books.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    if (is_tax('genre')) {
        $custom_template = get_stylesheet_directory() . '/includes/templates/taxonomy-genre.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    return $template;
});



//5.1. First one should return the title of most recent book. 

add_shortcode('recent_book', 'getRecentBook');

function getRecentBook()
{


    $args = array(
        'post_type' => 'books',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :

        while ($query->have_posts()) :

            $query->the_post();

            $title = the_title();

            return $title;

        endwhile;

        wp_reset_postdata();

    endif;
}

//5.2. Second one will return a list of 5 books from given Genre (user must be able to specify genre, 
//lets assume its just term ID). 
//Returned books should be sorted alphabetically. 

add_shortcode('books_by_genre', 'getBooksByGenre');

function getBooksByGenre($atts)
{


    $output = '';
    if (isset($_POST['genre_id']) && is_numeric($_POST['genre_id'])) {
        $genre_id = intval($_POST['genre_id']);

        // Check if the genre exists
        $term = get_term($genre_id, 'genre');
        if ($term && !is_wp_error($term)) {

            $args = array(
                'post_type' => 'books',
                'posts_per_page' => 5,
                'orderby' => 'title',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'genre',
                        'field' => 'term_id',
                        'terms' => $genre_id,
                    ),
                ),
            );


            $query = new WP_Query($args);

            if ($query->have_posts()) {
                $output .= '<ul class="book-list">';
                while ($query->have_posts()) : $query->the_post();
                    $output .= '<li class="book-item">' . esc_html(get_the_title()) . '</li>';
                endwhile;
                $output .= '</ul>';
            } else {
                $output .= '<p>No books found in this genre.</p>';
            }


            wp_reset_postdata();
        } else {
            $output .= '<p>No genre found with the provided ID.</p>';
        }
    }

    // Render the input form
    $output .= '
        <div class="container--genre">
        <form method="post" action="">
            <label for="genre_id">Enter Genre ID:</label>
            <input type="number" id="genre_id" name="genre_id" required>
            <button type="submit">Show Books</button>
        </form>
        </div>
    ';

    return $output;
}

//6. Create an AJAX callback returning 20 books in JSON format. 
//JSON should only contain following  fields: name, date, genre, excerpt. 
//You can use scripts.js file created previously in Task 2 to make an AJAX call. 


add_action('wp_ajax_get_books', 'getBooksByAjax');
add_action('wp_ajax_nopriv_get_books', 'getBooksByAjax');

function getBooksByAjax()
{

    $args = array(
        'post_type'      => 'books',
        'posts_per_page' => 20,
        'orderby'        => 'title',
        'order'          => 'ASC',
    );

    $query = new WP_Query($args);
    $books = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $books[] = array(
                'name'    => get_the_title(),
                'date'    => get_the_date(),
                'genre'   => wp_get_post_terms(get_the_ID(), 'genre', array('fields' => 'names')),
                'excerpt' => get_the_excerpt(),
            );
        }
        wp_reset_postdata();
    }


    wp_send_json($books);
    exit;
}
