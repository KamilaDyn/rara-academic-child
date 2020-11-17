<?php


// add post-formats to post_type 'page'
add_theme_support('post-formats', array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
));

add_post_type_support('beginner', 'post-formats');
add_post_type_support('intermediate', 'post-formats');

add_post_type_support('advanced', 'post-formats');
add_post_type_support('pro', 'post-formats');

/* add custom style */
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');


function enqueue_parent_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}


function child_remove_parent_functions()
{
    remove_action('customize_register', 'rara_academic_customize_register');
    remove_action('wp_enqueue_scripts', 'rara_academic_scripts');
}

add_action('init', 'child_remove_parent_functions');

require_once dirname(__FILE__) . '/inc/customizer.php';

/**
 * Enqueue scripts and styles.
 */

function rara_academic_scripts_child()
{
    $build  = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '/build' : '';
    $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.2.1');
    wp_enqueue_style('rara-academic-google-fonts', rara_academic_fonts_url());
    wp_enqueue_style('rara-academic-style', get_stylesheet_uri(), array(), RARA_ACADEMIC_THEME_VERSION);
    wp_enqueue_style('rara-academic-responsive-style', get_template_directory_uri() . '/css' . $build . '/responsive' . $suffix . '.css', array('rara-academic-style'), RARA_ACADEMIC_THEME_VERSION);

    if (rara_academic_is_woocommerce_activated())
        wp_enqueue_style('rara-academic-woocommerce-style', get_template_directory_uri() . '/css' . $build . '/woocommerce' . $suffix . '.css', RARA_ACADEMIC_THEME_VERSION);

    if (is_page_template('template-home.php'))
        wp_enqueue_script('masonry');
    wp_enqueue_script('all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array('jquery'), '5.6.3', true);
    wp_enqueue_script('v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array('jquery'), '5.6.3', true);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array('jquery'), '2.2.1', true);
    wp_enqueue_script('owlcarousel2-a11ylayer', get_template_directory_uri() . '/js' . $build . '/owlcarousel2-a11ylayer' . $suffix . '.js', array('owl-carousel'), '0.2.1', true);
    wp_register_script('rara-academic-custom', get_template_directory_uri() . '/js/build/custom.js', array('jquery'), RARA_ACADEMIC_THEME_VERSION, true);
    wp_enqueue_script('ajax', "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js",  array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'rara_academic_scripts_child');


add_action('wp_enqueue_scripts', 'wpshout_dequeue_and_then_enqueue', 100);

function wpshout_dequeue_and_then_enqueue()
{
    // Dequeue (remove) parent theme script
    wp_dequeue_script('rara-academic-custom');

    // Enqueue replacement child theme script
    wp_enqueue_script(
        'rara-academic-custom-child',
        get_stylesheet_directory_uri() . '/js/build/custom-child.js',
        array('jquery')
    );

    //slider settings
    $slider_auto      = get_theme_mod('rara_academic_slider_auto', '1');
    $slider_loop      = get_theme_mod('rara_academic_slider_loop', '1');
    $slider_control   = get_theme_mod('rara_academic_slider_control', '1');
    $slider_speed     = get_theme_mod('rara_academic_slider_speed', '7000');
    $animation_speed  = get_theme_mod('rara_academic_animation_speed', '600');

    $slider_array = array(
        'rtl' => is_rtl(),
        'auto'      => esc_attr($slider_auto),
        'loop'      => esc_attr($slider_loop),
        'control'   => esc_attr($slider_control),
        'speed'     => absint($slider_speed),
        'a_speed'   => absint($animation_speed),
    );
    wp_localize_script('rara-academic-custom-child', 'rara_academic_data', $slider_array);
    wp_enqueue_script('rara-academic-custom-child');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}


/*
redirect subscriber and groups accounts out of admin to home page
*/
function redirectSubsToFrontend()
{
    $ourCurrentUser = wp_get_current_user();

    if (count($ourCurrentUser->roles) <= 2 and $ourCurrentUser->roles[1] == 'beginner') {
        wp_redirect(esc_url(site_url('/student/beginner')));
        exit;
    }
    if (count($ourCurrentUser->roles) <= 2 and $ourCurrentUser->roles[1] == 'intermediate') {
        wp_redirect(esc_url(site_url('/student/intermediate/')));
        exit;
    }
    if (count($ourCurrentUser->roles) <= 2 and $ourCurrentUser->roles[1] == 'advanced') {
        wp_redirect(site_url('/student/advanced'));
        exit;
    }
    if (count($ourCurrentUser->roles) <= 2 and $ourCurrentUser->roles[1] == 'pro') {
        wp_redirect(esc_url(site_url('/student/pro')));
        exit;
    }
    if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
        wp_redirect(esc_url(site_url('/')));
        exit;
    }
}
add_action('admin_init', 'redirectSubsToFrontend');

function set_posts_per_page_for_beginner($query)
{
    if (!is_admin() and $query->is_main_query() and is_post_type_archive('beginner')) {
        $query->set('posts_per_page', '3');
    }
}
add_action('pre_get_posts', 'set_posts_per_page_for_beginner');


/**  chnged function for top header - added login fn */

if (!function_exists('rara_academic_header_top')) :
    /**
     * Header Top
     * 
     */
    function rara_academic_header_top()
    { ?>
        <div class="header-top">
            <div class="container">
                <?php
                $email     = get_theme_mod('rara_academic_email_address');
                $phone     = get_theme_mod('rara_academic_phone');
                $ed_social = get_theme_mod('rara_academic_ed_social');

                if ($email) echo '<a href="' . esc_url('mailto:' . sanitize_email($email)) . '" class="email"><i class="fa fa-envelope-o"></i>' . esc_html($email) . '</a>';

                if ($phone) echo '<a href="' . esc_url('tel:' . preg_replace('/[^\d+]/', '', $phone)) . '" class="tel-link"><i class="fa fa-phone"></i>' . esc_html($phone) . '</a>';

                if ($ed_social) rara_academic_get_social_links();

                if (is_user_logged_in()) : ?>
                    <a href="<?php echo wp_logout_url(); ?>" class="login-btn">Log Out</a>
                <?php else : ?>
                    <a href="<?php echo  wp_login_url() ?>" class="login-btn">Log In</a>
                <?php endif ?>
            </div>


        </div>
<?php
    }
endif;
add_action('rara_academic_header', 'rara_academic_header_top', 20);



/* customize login page */
function ourheaderurl()
{
    return esc_url(site_url('/'));
}
add_filter('login_headerurl', 'ourheaderurl');

/*change login style */
function my_login_CSS()
{
    wp_enqueue_style('rara-academic-google-fonts', rara_academic_fonts_url());
    wp_enqueue_style('custom-login',  get_stylesheet_directory_uri() . '/style.css');
}
add_action('login_enqueue_scripts', 'my_login_CSS');


/*change login headline title */

function ourLoginTitle()
{
    return get_bloginfo('name');
}
add_filter('login_headertitle', 'ourLoginTitle');

/* hide admin bar */

function noSubsAdminBar()
{
    $currentUser = wp_get_current_user();
    if (count($currentUser->roles) <= 2 and  ($currentUser->roles[0] == 'subscriber' or $currentUser->roles[1] == 'beginner' or $currentUser->roles[1] == 'intermediate' or $currentUser->roles[1] == 'advanced' or  $currentUser->roles[1] == 'pro')) {
        show_admin_bar(false);
    }
}
add_action('admin_init', 'noSubsAdminBar');

add_filter('wpcf7_validate_configuration', '__return_false');



?>