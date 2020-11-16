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
        <?php if (current_user_can('read_group_beginner')) : ?>

            <div class="banner-group">
                <h1>Grupa: Beginner</h1>
                <?php if (is_user_logged_in()) :
                    echo '<h2 class="member-name"> Hello ' . $current_user->user_login . '!!! </h2>';
                endif; ?>
            </div>

        <?php
            get_template_part('template-parts/content-group', get_post_format());

        else : ?>
            <div class="not-logged">
                <h1>Strefa studenta</h1>
                <h2>Grupa Beginner</h2>
                <p> Wygląda na to, że nie jesteś w tej grupie, brak dostępu.
                    Jeśli jesteś uczestnikiem kursu wybierz swoją grupę:</p>
                <ul>
                    <li><a href="<?php echo esc_url(site_url('/student/intermediate')); ?>" style="color: #01c6b8;">Intermediate</a></li>
                    <li><a href="<?php echo esc_url(site_url('/student/advanced')); ?>" style="color: #01c6b8;">Advanced</a></li>
                    <li><a href="<?php echo esc_url(site_url('/student/pro')); ?>" style="color: #01c6b8;">Pro</a></li>
                </ul>
                </p> Jesli nie jesteś uczestnikiem mojego kursu, a chcesz dobrze nauczyć się się języka angielskiego napisz do mnie.
                <a href="<?php echo esc_url(site_url('/kontakt')); ?>" class="learn-more">Kontakt</a>
                </p>

            </div>
        <?php endif; ?>
    </main>
</div>
<?php
get_footer();
