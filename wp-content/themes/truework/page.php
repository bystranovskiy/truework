<?php
get_header();

$ID = get_the_ID();
$title = get_the_title();
$content = get_the_content();


// HOT JOBS
$args = array(
    'posts_per_page' => 4,
    'post_type' => 'jobs',
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' => array($ID),
    'meta_query' => array(
        array(
            'key' => 'urgently',
            'value' => true,
            'compare' => '=',
        ),
    ),
);
$the_query = new WP_Query($args);
wp_reset_query();
?>

<main>
    <section class="section-single-post">
        <div class="container py-5">

            <div class="row">
                <div class="<?php echo $the_query->have_posts() ? 'col-xl-8' : 'col-12'; ?>">

                    <a href="<?php echo get_home_url(); ?>"
                       class="mb-4 turn-back"><i
                                class="icon-angle-left h5"></i><?php echo esc_html__("На головну", "truework"); ?>
                    </a>

                    <div class="single-post pb-5">
                        <h1 class="mt-0 post-title"><?php echo $title;?></h1>
                        <div class="post-content">
                            <?php echo $content; ?>
                        </div>
                    </div>

                </div>
                <?php if ($the_query->have_posts()): ?>
                    <div class="col-xl-4 mt-5 mt-xl-0">
                        <h2 class="mt-0 text-center"><?php echo esc_html__("Гарячі вакансії", "truework"); ?></h2>
                        <div class="row mx-n2 jobs-short-list jobs-sidebar">
                            <?php get_template_part('/template-parts/general/jobs-short-list', null, array('the_query' => $the_query)); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </section>
    <?php
    $args = array(
        'posts_per_page' => 8,
        'post_type' => 'jobs',
        'orderby' => 'date',
        'order' => 'DESC',
        'post__not_in' => array($ID),
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'partners',
                'field' => 'slug',
                'terms' => $employer->slug,
            ),
        ),
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()):?>
        <section class="section-jobs-slider">
            <div class="container pb-5">
                <h2 class="mt-0 text-center"><?php echo esc_html__("Інші вакансії компанії", "truework"); ?></h2>
                <div class="jobs-short-list jobs-slider">
                    <?php get_template_part('/template-parts/general/jobs-short-list', null, array('the_query' => $the_query)); ?>
                </div>
            </div>
        </section>
    <?php endif;
    wp_reset_query();
    ?>

</main>

<?php
get_footer(); ?>
