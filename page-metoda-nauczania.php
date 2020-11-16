<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rara_Academic
 */

$sidebar_layout = rara_academic_sidebar_layout();

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div><?php the_content(); ?></div>
        <?php
        while (have_posts()) : the_post();

            get_template_part('sections/service', 'page');


        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
if ($sidebar_layout == 'right-sidebar') {
    get_sidebar();
}
get_footer();
