<?php
$title = get_sub_field("title");
?>

<section class="section-news">
    <div class="container py-5">
        <h2 class="h1 text-center"><?php echo $title; ?></h2>
        <?php
        $args = array(
            'numberposts' => 10,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
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
            <div class="row mx-n2 news-list">
                <?php get_template_part('/template-parts/general/posts-list', null, array('the_query' => $the_query)); ?>

            </div>
        <?php } else {
            echo esc_html__("Записів не знайдено", "truework");
        } ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>