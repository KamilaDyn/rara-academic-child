<?php

if (!function_exists('fte_banner_header')) :

    /**
     * Page Header
     */
    function fte_banner_header()
    {
        $header_image_url = fte_banner_image($image_url = '');
        global $current_user;
        wp_get_current_user();
?>
        <div class="banner-group" style="background: linear-gradient(to top, rgba(85, 84, 88, 0.7), rgba(85, 84, 88, 0.9)), url('<?php echo esc_url($header_image_url); ?>') no-repeat fixed center;">
            <h1>G: <?php echo fte_banner_title($banner_title); ?></h1>
            <?php if (is_user_logged_in()) :
                echo '<h2 class="member-name"> Hello ' . $current_user->user_login . '!!! </h2>';
            endif; ?>
        </div>
<?php
    }


endif;

add_action('fte_banner_header', 'fte_banner_header', 10);

if (!function_exists('fte_banner_title')) :
    function fte_banner_title($banner_title)
    {
        if (is_post_type_archive('pl_beginner') || is_singular('pl_beginner') || is_post_type_archive('en_beginner')) {
            $banner_title = 'Beginner';
        } elseif (is_post_type_archive('pl_intermediate') || is_post_type_archive('en_intermediate')) {
            $banner_title = 'Intermediate';
        } elseif (is_post_type_archive('pl_advanced') || is_post_type_archive('en_advanced')) {
            $banner_title = 'Advanced';
        } elseif (is_post_type_archive('pl_pro') || is_post_type_archive('en_pro')) {
            $banner_title = 'Pro';
        }
        return $banner_title;
    }
endif;

if (!function_exists('fte_banner_image')) :
    /**
     * Banner Header Image
     */
    function fte_banner_image($image_url)
    {
        global $post;

        $archive_header_beginner = get_theme_mod('rara_academic_banner_beginner_image');
        $archive_header_intermediate = get_theme_mod('rara_academic_banner_intermediate_image');
        $archive_header_pro = get_theme_mod('rara_academic_banner_pro_image');
        $archive_header_advanced = get_theme_mod('rara_academic_banner_advanced_image');

        if (is_post_type_archive('pl_beginner') || is_singular('pl_beginner') || is_post_type_archive('en_beginner')) {
            $image_url = (!empty($archive_header_beginner)) ?     $archive_header_beginner : get_stylesheet_directory_uri() . '/images/default-header.jpg';
        } elseif (is_post_type_archive('pl_intermediate') || is_post_type_archive('en_intermediate')) {
            $image_url = (!empty($$archive_header_intermediate)) ?  $archive_header_intermediate : get_stylesheet_directory_uri() . '/images/default-header.jpg';
        } elseif (is_post_type_archive('pl_advanced') || is_post_type_archive('en_advanced')) {
            $image_url = (!empty($archive_header_advanced)) ?  $archive_header_advanced : get_stylesheet_directory_uri() . '/images/default-header.jpg';
        } elseif (is_post_type_archive('pl_pro') || is_post_type_archive('en_pro')) {
            $image_url = (!empty($archive_header_pro)) ?  $archive_header_pro : get_stylesheet_directory_uri() . '/images/default-header.jpg';
        }
        return $image_url;
    }
endif;
