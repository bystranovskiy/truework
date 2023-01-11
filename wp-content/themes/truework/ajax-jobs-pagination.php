<?php
// AJAX JOBS PAGINATION

add_action('wp_ajax_nopriv_jobs_pagination', 'wpex_metadata_jobs_pagination');
add_action('wp_ajax_jobs_pagination', 'wpex_metadata_jobs_pagination');

function wpex_metadata_jobs_pagination()
{
    $paged = $_POST['paged'];
    $meta = $_POST['meta'];

    $args = array(
        'post_type' => 'jobs',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'paged' => $paged,
        'order' => 'DESC',
    );

    if ($meta === "hot-jobs") {
        $args['meta_key'] = 'urgently';
        $args['meta_value'] = true;
    }

    if ($meta === "popular-jobs") {
        $args['meta_key'] = 'views';
        $args['orderby'] = 'meta_value_num';
    }

    $the_query = new WP_Query($args);

    get_template_part('/template-parts/general/jobs-list', null, array('the_query' => $the_query));
}
