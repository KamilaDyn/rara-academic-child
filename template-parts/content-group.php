<div class="container">
    <?php
    if (have_posts()) :
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
    else :
        ?>
        <h3 class="info">Brak dostepnych materiałów.</h3>
    <?php endif;
    echo paginate_links();
    ?>
</div>