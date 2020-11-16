<?php

/**
 * Banner Section
 * 
 *  @package Rara_Academic
 */

$banner_post_one = get_theme_mod('rara_academic_banner_post_one');
$banner_post_two = get_theme_mod('rara_academic_banner_post_two');
$banner_post_three = get_theme_mod('rara_academic_banner_post_three');
$read_more   = get_theme_mod('rara_academic_banner_read_more', __('Learn More', 'rara-academic'));

$banner_posts = array($banner_post_one, $banner_post_two, $banner_post_three,);
$banner_posts = array_diff(array_unique($banner_posts), array(''));

$Slides = new WP_Query(array(
    'post_type' => 'slider',
    'post_per_page' => 3,
    'post_status'   => 'publish',
    'orderby' => 'date',
    'order'   => 'DESC',
    'suppress_filters' => true,

));
?>
<section class="banner">
    <?php
    if ($Slides->have_posts()) { ?>
        <div class="banner-slider owl-carousel">
            <?php while ($Slides->have_posts()) {
                $Slides->the_post();
                if (has_post_thumbnail()) { ?>
                    <div>

                        <?php the_post_thumbnail('rara-academic-banner', array('itemprop' => 'image')) ?>
                        <div class="banner-text">
                            <div class="container">
                                <div class="text-holder">
                                    <h2 class="title"><?php the_title(); ?></h2>
                                    <?php the_excerpt();
                                    if ($read_more) { ?>
                                        <a href="<?php the_permalink(); ?>" class="learn-more owl-slide-animated owl-slide-cta"><?php echo esc_html($read_more); ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    <?php
    } ?>
</section>