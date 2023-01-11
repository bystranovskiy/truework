<?php get_header(); ?>

    <main>
        <section class="section-single-post">
            <div class="container py-5">
                <div class="row">
                    <div class="col-xl-8 d-flex flex-column">

                        <?php
                        $category = get_the_category();
                        $link = get_category_link($category[0]->term_id);
                        ?>

                        <a href="<?php echo $link; ?>"
                           class="mb-4 turn-back"><i
                                    class="icon-angle-left h5"></i><?php echo esc_html__("Назад до усіх новин", "truework"); ?>
                        </a>

                        <div class="col single-post">
                            <div class="post-date">
                                <i class="icon-calendar"></i> <?php echo get_the_date("j F Y") . 'р.'; ?>
                            </div>
                            <h1><?php the_title(); ?></h1>
                            <div class="post-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 mt-5 mt-xl-0">

                        <?php
                        $args = array(
                            'posts_per_page' => 4,
                            'post_type' => 'post',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'post__not_in' => array(get_the_ID()),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'id',
                                    'terms' => array(15),
                                )
                            ),
                        );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()) { ?>
                            <section class="section-news">
                                <div class="container px-xl-0">
                                    <h2 class="mt-0 text-center"><?php echo esc_html__("Останні новини", "truework"); ?></h2>
                                    <div class="row mx-n3 mx-xl-n2 news-list">
                                        <?php get_template_part('/template-parts/general/posts-list', null, array('the_query' => $the_query)); ?>
                                    </div>
                                </div>
                            </section>
                        <?php } else {
                            echo esc_html__("Записів не знайдено", "truework");
                        } ?>
                        <?php wp_reset_postdata(); ?>


                    </div>

                </div>
            </div>
        </section>
        <?php // HOT JOBS
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
        $the_query = new WP_Query($args);
        wp_reset_query();
        if ($the_query->have_posts()):?>
            <section class="section-jobs-slider">
                <div class="container pb-5">
                    <h2 class="mt-0 text-center"><?php echo esc_html__("Гарячі вакансії", "truework"); ?></h2>
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
get_footer();