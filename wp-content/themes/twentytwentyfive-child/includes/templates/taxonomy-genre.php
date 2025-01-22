<link rel="stylesheet" href="http://fooz-zadanie-rekrutacyjne.local/wp-content\themes\twentytwentyfive-child\style.css" type="text/css" media="all">
 <?php 
    
    $posts_per_page = 5;

    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    
    $term = get_queried_object();

   
    $args = array(
        'post_type' => 'books',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'genre',
                'field'    => 'term_id',
                'terms'    => $term->term_id,
            ),
        ),
    );

    $query = new WP_Query($args);


    if ($query->have_posts()) :
        echo '<div class="book-list">';
        while ($query->have_posts()) : $query->the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="container--book">
                    <div class="content--image">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="content--book">
                        <h1><?php the_title(); ?></h1>
                        <h3><?php the_taxonomies(); ?></h3>
                        <p><?php the_date(); ?></p>
                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>
            </article>
        <?php 
        endwhile;

        // Pagination
        $pagination_args = array(
            'total'   => $query->max_num_pages,
            'current' => $paged,
            'format'  => 'page/%#%/',
            'prev_text' => __('Previous'),
            'next_text' => __('Next'),
            'base'    => get_pagenum_link(1) . '%_%',
        );
        echo '<div class="pagination">';
        echo paginate_links($pagination_args);
        echo '</div>';

    else :
        echo '<p>No books found in this genre.</p>';
    endif;

    wp_reset_postdata();
    ?>