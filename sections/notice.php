<?php

/**
 * Notice Section
 * 
 * @package Rara_Academic
 */

$section_title   = get_theme_mod('rara_academic_notice_section_title');
$section_title_pll   = pll__(get_theme_mod('rara_academic_notice_section_title'));
$section_content = get_theme_mod('rara_academic_notice_section_description');
$section_content_pll = pll__(get_theme_mod('rara_academic_notice_section_description'));
$button_label    = get_theme_mod('rara_academic_notice_section_button_label');
$button_label_pll    =  pll__(get_theme_mod('rara_academic_notice_section_button_label'));
$button_link     = get_theme_mod('rara_academic_notice_section_button_link');
$button_link     = get_theme_mod('rara_academic_notice_section_button_link');

if ($section_title || $section_content || $button_label || $button_link) {
?>

    <section class="notice">
        <div class="container">
            <div class="row">

                <?php

                if ($section_title) echo '<h2>' . esc_html($section_title_pll) . '</h2>';

                if ($section_content) echo '<div class="col-one">' . wpautop(wp_kses_post($section_content_pll)) . '</div>';

                if ($button_label && $button_link) {
                    echo '<div class="col-two">';
                    echo '<a href="' . esc_url($button_link) . '" class="learn-more" target="_blank">' . esc_html($button_label_pll) . '</a>';
                    echo '</div>';
                }

                ?>

            </div>
        </div>
    </section>

<?php
}
