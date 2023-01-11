<?php

/**
 * Definition of global variables
 */

defined("THEME_URI") || define("THEME_URI", get_template_directory_uri());
defined("THEME_DIR") || define("THEME_DIR", get_template_directory());


if (!defined("_S_VERSION")) {
    define("_S_VERSION", "1.0.0");
}


/**
 * Init ACF theme option page
 */

function init_acf_option()
{
    if (function_exists("acf_add_options_page")) {

        acf_add_options_page(array(
            "page_title" => esc_html__("Загальні опції теми", "truework"),
            "menu_title" => esc_html__("Опції теми", "truework"),
            "menu_slug" => "theme-general-settings",
            "capability" => "edit_posts",
            "redirect" => false,
        ));

    }
}

add_action("acf/init", "init_acf_option");


function truework_setup()
{
    add_theme_support("menus");
    add_theme_support("post-thumbnails");

    register_nav_menus(
        array(
            "top-menu" => esc_html__("Топ меню", "truework"),
            "social" => esc_html__("Сосмережі", "truework"),
            "footer-1" => esc_html__("Футер 1", "truework"),
            "footer-2" => esc_html__("Футер 2", "truework"),
        )
    );

    add_theme_support(
        "html5",
        array(
            "search-form",
            "comment-form",
            "comment-list",
            "gallery",
            "caption",
            "style",
            "script",
        )
    );

    add_theme_support(
        "custom-logo",
        array(
            "height" => 37,
            "width" => 195,
            "flex-width" => true,
            "flex-height" => true,
        )
    );

    add_image_size("xl", 1512, 9999);
    add_image_size("xxl", 2560, 9999);

}

add_action("after_setup_theme", "truework_setup");


/**
 * Enqueue theme global css and js
 */

function truework_scripts()
{
    wp_enqueue_style("font-truework-icons", THEME_URI . "/src/fonts/truework/css/truework.css", array(), _S_VERSION);
    wp_enqueue_style("font-mariupol", THEME_URI . "/src/fonts/mariupol/style.css", array(), _S_VERSION);

    wp_enqueue_style("main-styles", THEME_URI . "/build/main.min.css", array(), _S_VERSION);

    wp_enqueue_script("main-scripts", THEME_URI . "/build/main.min.js", array("jquery"), _S_VERSION);

    wp_enqueue_style("jquery-ui", THEME_URI . "/src/vendors/jquery-ui/jquery-ui.min.css", array(), _S_VERSION);
    wp_enqueue_style("jquery-ui-theme", THEME_URI . "/src/vendors/jquery-ui/jquery-ui.theme.min.css", array(), _S_VERSION);
    wp_enqueue_script("jquery-ui", THEME_URI . "/src/vendors/jquery-ui/jquery-ui.min.js", array("jquery"), _S_VERSION);


    if (is_front_page()) {
        wp_localize_script('main-scripts', 'ajaxMeta', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }

    if (is_post_type_archive('jobs') || is_tag() || is_tax()) {
        wp_enqueue_style('jobs-list', THEME_URI . '/build/jobs-list.min.css', array());
        wp_enqueue_style('jobs-filter-form', THEME_URI . '/build/jobs-filter-form.min.css', array());
        wp_enqueue_script("jobs-filter-form", THEME_URI . "/build/jobs-filter-form.min.js", array("jquery"), _S_VERSION);
    }

    if (is_single() || is_category() || is_page()) {
        wp_enqueue_style('slick', THEME_URI . '/src/vendors/slick/slick.css', array());
        wp_enqueue_script('slick', THEME_URI . '/src/vendors/slick/slick.min.js', array('jquery'));

        wp_enqueue_style('jobs-list', THEME_URI . '/build/jobs-list.min.css', array());
    }

    if (is_singular('jobs') || is_page()) {
        wp_enqueue_script("single-jobs", THEME_URI . "/build/single-jobs.min.js", array("jquery"), _S_VERSION);
    }

    if (is_singular('jobs')) {
        wp_enqueue_style('single-jobs', THEME_URI . '/build/single-jobs.min.css', array());
    }

    if (is_singular('post')) {
        wp_enqueue_style('section-news', THEME_URI . '/build/section-news.min.css', array());
    }

    if (is_single() || is_page()) {
        wp_enqueue_style('single-post', THEME_URI . '/build/single-post.min.css', array());
        wp_enqueue_script("single-post", THEME_URI . "/build/single-post.min.js", array("jquery"), _S_VERSION);
    }

    if (is_category()) {
        wp_enqueue_style('section-news', THEME_URI . '/build/section-news.min.css', array());
        wp_enqueue_style('category', THEME_URI . '/build/category.min.css', array());
        wp_enqueue_script("category", THEME_URI . "/build/category.min.js", array("jquery"), _S_VERSION);
    }

    remove_action("wp_head", "wp_print_scripts");
    remove_action("wp_head", "wp_print_head_scripts", 9);
    remove_action("wp_head", "wp_enqueue_scripts", 1);
    remove_action("wp_head", "wp_print_styles", 99);
    remove_action("wp_head", "wp_enqueue_style", 99);

    add_action("wp_footer", "wp_print_scripts", 5);
    add_action("wp_footer", "wp_enqueue_scripts", 5);
    add_action("wp_footer", "wp_print_head_scripts", 5);
    add_action("wp_head", "wp_print_styles", 30);
    add_action("wp_head", "wp_enqueue_style", 30);
}

add_action("wp_enqueue_scripts", "truework_scripts");

/**
 * Enqueue sections css and js
 */

function enqueue_sections_build($layouts)
{
    foreach ($layouts as $layout) {
        $css_file_path = '/build/section-' . $layout . '.min.css';
        $css_file_path_url = THEME_URI . $css_file_path;
        $css_file_path_dir = THEME_DIR . $css_file_path;
        if (file_exists($css_file_path_dir) && file_get_contents($css_file_path_dir)) {
            wp_enqueue_style('section-' . $layout, $css_file_path_url, array());
        }

        $js_file_path = '/build/section-' . $layout . '.min.js';
        $js_file_path_url = THEME_URI . $js_file_path;
        $js_file_path_dir = THEME_DIR . $js_file_path;
        if (file_exists($js_file_path_dir) && file_get_contents($js_file_path_dir)) {
            wp_enqueue_script('section-' . $layout, $js_file_path_url, array('jquery'));
        }
    }
}

function in_array_any($needles, $haystack): bool
{
    return (bool)array_intersect($needles, $haystack);
}


if (!function_exists('pagination')) :

    function pagination($paged = '', $max_page = '')
    {
        $big = 999999999; // need an unlikely integer
        if (!$paged) {
            $paged = get_query_var('paged');
        }

        if (!$max_page) {
            global $wp_query;
            $max_page = $wp_query->max_num_pages ?? 1;
        }
        echo '<div class="nav-links">' . paginate_links(array(
                //'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                //'format' => '?paged=%#%',
                'current' => max(1, $paged),
                'total' => $max_page,
                'mid_size' => 1,
                'prev_text' => '«',
                'next_text' => '»',
                //'type' => 'list'
            )) . '</div>';
    }
endif;

function num_word($value, $words, $show = true)
{
    $num = $value % 100;
    if ($num > 19) {
        $num = $num % 10;
    }

    $out = ($show) ? $value . ' ' : '';
    switch ($num) {
        case 1:
            $out .= $words[0];
            break;
        case 2:
        case 3:
        case 4:
            $out .= $words[1];
            break;
        default:
            $out .= $words[2];
            break;
    }

    return $out;
}

require_once(__DIR__ . '/ajax-jobs-pagination.php');