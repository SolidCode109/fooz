<?php 
/* Template Name: Books Template */ 
/* Post Type: books */ 
?>

<link rel="stylesheet" href="http://fooz-zadanie-rekrutacyjne.local/wp-content\themes\twentytwentyfive-child\style.css" type="text/css" media="all">

<?php
get_header(); 
?>

<main id="main-content">
    <h1><?php post_type_archive_title(); ?></h1>
    <div class="books-archive">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); 
        ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </article>
        <?php 
            endwhile;
        else :
        ?>
            <p><?php _e('Ups. No books found.', 'twentytwentyfive-child'); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer(); 
?>