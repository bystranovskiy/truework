<section class="section-popular-specialties">
    <div class="container py-5">
        <h2 class="h1 text-center"><?php the_sub_field('title'); ?></h2>
        <div class="row mx-n2 justify-content-center popular-specialties-list">
            <?php $specialties = get_sub_field('specialties');
            foreach ($specialties as $specialty) {
                $args = array(
                    'numberposts' => -1,
                    'post_type' => 'jobs',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'specialty',
                            'field' => 'slug',
                            'terms' => array($specialty->slug)
                        )
                    ));
                $specialty_items = get_posts($args);
                ?>
                <div class="col-auto px-2 popular-specialty-item">
                    <a href="<?php echo get_term_link($specialty->slug, $specialty->taxonomy); ?>"
                       class="d-block mx-auto popular-specialty-item-inner">
                        <?php
                        $image = get_field('image', 'post_tag_' . $specialty->term_id);
                        echo wp_get_attachment_image($image, 'medium', "", array("class" => "img-responsive"));
                        ?>
                        <h3 class="h5 my-0 rubric-title">
                            <small class="d-block mb-1">(<?php echo count($specialty_items); ?>)</small>
                            <?php echo $specialty->name; ?></h3>
                    </a>
                </div>
                <?php wp_reset_postdata();
            } ?>
        </div>
        <div class="text-center my-3">
            <a href="<?php echo get_post_type_archive_link('jobs'); ?>"
               class="btn btn-secondary d-block mx-auto show-all-specialties"><?php echo esc_html__("Переглянути всі", "truework"); ?></a>
        </div>
    </div>
</section>