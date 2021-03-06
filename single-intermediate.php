<?php

/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Rara_Academic
 */

get_header(); ?>
<?php fte_banner_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="intermediate" role="main">
        <?php if (current_user_can('read_group_intermediate')) : ?>
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
                <h2>Dostęp dla zalogowanych uczestników grupy.</h2>
                <p>Jesteś Wylogowany(a): <a href="<?php echo  wp_login_url() ?>" class="login">Zaloguj się</a></p>
            </div>


        <?php endif; ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
