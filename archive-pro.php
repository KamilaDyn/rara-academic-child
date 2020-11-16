<?php

/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rara_Academic
 */

get_header(); ?>


<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php if (current_user_can('read_group_pro')) : ?>

            <div class="banner-group">
                <h1>Grupa: Pro</h1>
                <?php if (is_user_logged_in()) :
                    echo `<h2 class="member-name"> Hello ' . $current_user->user_login . '!!! </h2>`;
                endif; ?>
            </div>
            <div class="container">
                <?php
                while (have_posts()) {
                    the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <header class="entry-header">
                            <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
                            <h3 class="entry-subtitle"></h3>
                        </header><!-- .entry-header -->

                        <?php
                        if (has_post_thumbnail()) {
                        ?>
                            <a href="<?php the_permalink(); ?>">
                                <div><?php the_post_thumbnail('rara-academic-welcome') ?></div>
                            </a> <?php
                                }
                                    ?>
                        <div class="entry-content">
                            <?php echo wp_trim_words(get_the_content(), 50, '...'); ?>

                        </div>
                        <a href="<?php the_permalink(); ?>" class="learn-more">Przejdź do lekcji</a>
                    </article>
                    <hr>
                <?php }
                echo paginate_links();
                ?>
            </div>
        <?php else : ?>
            <div>Nie mam dostępu do tego panelu. Dla nie zalogowanych opis grupy, opis ten byłby statyczny, </div>
        <?php endif; ?>
    </main>
</div>
<?php
get_footer();
