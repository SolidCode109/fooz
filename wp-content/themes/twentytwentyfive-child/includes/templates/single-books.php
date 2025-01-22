<?php 
/* Template Name: Books Template */ 
/* Post Type: books */ 
?>

<?php
get_header(); 
?>

<main id="main-content">
    <?php 
    while (have_posts()) : the_post(); 
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
            <h3><?php the_taxonomies()?></h3>
            <p><?php the_date(); ?></p>
            <div class="entry-content">
            <?php the_content(); ?>
            </div>
        </div>


        </div>
        </article>
    <?php 
    endwhile; 
    ?>
</main>

<?php
get_footer(); 
?>