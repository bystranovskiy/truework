<?php get_header();

// HOT JOBS
$args = array(
    'posts_per_page' => 4,
    'post_type' => 'jobs',
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'urgently',
            'value' => true,
            'compare' => '=',
        ),
    ),
);
$hot_jobs = new WP_Query($args);
wp_reset_query();
?>

    <main>
        <section class="section-posts-category">
            <div class="container py-5">
                <div class="row">
                    <div class="<?php echo $hot_jobs->have_posts() ? 'col-xl-8' : 'col-12'; ?>">

                        <?php
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type' => 'post',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'paged' => $paged,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'id',
                                    'terms' => array(15),
                                )
                            ),
                        );$the_query = new WP_Query($args);
                        if ($the_query->have_posts()) { ?>
                            <section class="section-news">
                                <h1 class="h2 mt-0 mb-4 text-center"><?php $category = get_the_category(); echo $category[0]->cat_name;?></h1>
                                <div class="row mx-n2 news-list">
                                    <?php get_template_part('/template-parts/general/posts-list', null, array('the_query' => $the_query)); ?>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <div class="row align-items-center flex-md-nowrap">
                                            <div class="<?php echo $hot_jobs->have_posts() ? 'col' : 'col-lg-4'; ?> text-center pb-3 pb-md-0 text-md-left">
                                                <?php echo esc_html__("Відображається", "truework") . " <b>" . count($the_query->posts) . "</b> " . esc_html__("із", "truework") . " <b>" . $the_query->found_posts . "</b>"; ?>
                                            </div>
                                            <div class="<?php echo $hot_jobs->have_posts() ? 'col-md-auto' : 'col-md-auto col-lg-4'; ?>">
                                                <?php pagination($paged, $the_query->max_num_pages); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php } else {
                            echo esc_html__("Записів не знайдено", "truework");
                        } ?>
                        <?php wp_reset_postdata(); ?>
                    </div>

                    <?php if ($hot_jobs->have_posts()): ?>
                        <div class="col-xl-4 mt-5 mt-xl-0">
                            <h2 class="mt-0 mb-4 text-center"><?php echo esc_html__("Гарячі вакансії", "truework"); ?></h2>
                            <div class="row mx-n2 jobs-short-list jobs-sidebar">
                                <?php get_template_part('/template-parts/general/jobs-short-list', null, array('the_query' => $hot_jobs)); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    </main>

<?php
get_footer();