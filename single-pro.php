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
    <main id="main" class="pro" role="main">
        <?php if (current_user_can('read_group_pro')) : ?>
            <div class="banner-group">
                <h1>Grupa: Pro</h1>
                <?php if (is_user_logged_in()) :
                    echo '<h2 class="member-name"> Hello ' . $current_user->user_login . '!!!</h2>';
                endif; ?>
            </div>
            <div class="group">
                <?php
                while (have_posts()) : the_post();

                    get_template_part('template-parts-single/content-group-single', get_post_format());

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
        else : ?>
            <div class="not-logged">
                <h2>Jesteś Wylogowany / wylogowana:</h2><a href="<?php echo  wp_login_url() ?>" class="login-btn">Log In</a>
            </div>


        <?php endif; ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
