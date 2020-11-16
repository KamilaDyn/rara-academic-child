<?php

/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rara_Academic
 */



$ed_full_content = get_theme_mod('rara_academic_ed_full_content');
?>
<div class=" container">

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">
            <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
            <h3 class="entry-subtitle"></h3>
        </header><!-- .entry-header -->

        <?php
        if (has_post_thumbnail()) {
        ?>
            <div><?php the_post_thumbnail('rara-academic-with-sidebar') ?></div>
        <?php
        }
        ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </article>
    <div class="sidebar-group">
        <?php if (get_field('vocabulary')) : ?>
            <div class="text vocabulary">
                <h3 class="title">Vocabulary</h3>
                <?php echo get_field('vocabulary') ?>
            </div>
        <?php endif; ?>
        <?php if (get_field('curriculum')) : ?>
            <div class="text curriculum">
                <h3 class="title">Curriculum książki</h3>
                <?php echo get_field('curriculum') ?>
            </div>
        <?php endif; ?>


    </div>
</div>

<hr>
<div class="entry-task">
    <?php echo get_field('explanation'); ?>
    <?php the_excerpt(); ?>
    <h4 style=" margin-top: -120px;">Wyślij an maila: <span style="color: red;"> mail@gmail.com</span></h4>
</div>