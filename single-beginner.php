<?php

/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Rara_Academic
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class=" beginner" role="main">
        <div class="banner-group">
            <h1>Grupa: Beginner</h1>
            <?php if (is_user_logged_in()) :
                echo '<h2 class="member-name"> Hello ' . $current_user->user_login . '!!!</h2>';
            endif; ?>
        </div>
        <div class="group">
            <?php
            while (have_posts()) : the_post();

                get_template_part('template-parts/content-group', get_post_format());

            endwhile; // End of the loop.
            ?>
        </div>

        <?php

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) : ?>
            <div>
                <h2 class="comment-topic"><?php echo get_field('topic'); ?></h2>
                <?php

                comments_template(); ?>
            </div>
        <?php
        endif;
        rara_academic_pagination();
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
