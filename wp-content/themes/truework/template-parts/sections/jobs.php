<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'jobs',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'DESC',
);

$the_query = new WP_Query($args);
?>

<section class="section-jobs">
    <div class="container py-5">
        <div class="jobs-list-nav row flex-md-nowrap mx-n1 mx-lg-n2 mt-5 mb-5">
            <div class="col-12 col-md px-1 px-lg-2 py-1">
                <div class="btn btn-primary-outline jobs-nav-item active" data-meta="new-jobs">
                    <?php echo esc_html__("Нові вакансії", "truework"); ?>
                </div>
            </div>
            <div class="col-12 col-md px-1 px-lg-2 py-1">
                <div class="btn btn-primary-outline jobs-nav-item" data-meta="popular-jobs">
                    <?php echo esc_html__("Популярні вакансії", "truework"); ?>
                </div>
            </div>
            <div class="col-12 col-md px-1 px-lg-2 py-1">
                <div class="btn btn-primary-outline jobs-nav-item" data-meta="hot-jobs">
                    <?php echo esc_html__("Гарячі вакансії", "truework"); ?>
                </div>
            </div>
        </div>

        <?php if ($the_query->have_posts()) { ?>
            <div class="row jobs-list">
                <?php get_template_part('/template-parts/general/jobs-list', null, array('the_query' => $the_query)); ?>
            </div>
        <?php } else {
            echo esc_html__("Записів не знайдено", "truework");
        } ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>