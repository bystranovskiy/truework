<?php get_header(); ?>

    <main>

        <?php
        if (have_rows('front-page_builder')):
            $layouts = [];

            while (have_rows('front-page_builder')) : the_row();
                $row = get_row_layout();
                get_template_part('/template-parts/sections/' . $row);
                if (!in_array($row, $layouts)) {
                    $layouts[] = $row;
                }
            endwhile;

            // enqueue sections css and js
            enqueue_sections_build($layouts);

        endif; ?>
    </main>

<?php
// enqueue slick if needed
if (in_array_any(['popular-rubrics', 'popular-specialties', 'verified-employers', 'news'], $layouts)) {
    wp_enqueue_style('slick', THEME_URI . '/src/vendors/slick/slick.css', array());
    wp_enqueue_script('slick', THEME_URI . '/src/vendors/slick/slick.min.js', array('jquery'));
}

if (in_array_any(['jobs'], $layouts)) {
    wp_enqueue_style('jobs-list', THEME_URI . '/build/jobs-list.min.css', array());
}


get_footer();