<?php $rubrics = get_sub_field('rubrics'); ?>

<section class="section-popular-rubrics">
    <div class="container py-5">
        <h2 class="h1 text-center"><?php the_sub_field('title'); ?></h2>
        <div class="row popular-rubrics-list">
            <?php foreach ($rubrics as $rubric) { ?>
                <div class="col-lg-6 popular-rubric-item">
                    <div class="row inner-wrapper">
                        <div class="col-md-6 d-flex flex-column justify-content-end rubric-content">
                            <h3 class="h2 my-0 rubric-title"><?php echo $rubric->name; ?></h3>
                            <p class="rubric-description mb-4"><?php echo $rubric->description; ?></p>
                            <a href="<?php echo $rubric->term_id === 118 ? get_post_type_archive_link('jobs') : get_term_link($rubric->slug, $rubric->taxonomy); ?>"
                               class="btn btn-primary-outline w-100"><?php echo esc_html__("Переглянути", "truework"); ?></a>
                        </div>
                        <div class="col-md-6 rubric-image px-0">
                            <?php
                            $image = get_field('image', 'post_tag_' . $rubric->term_id);
                            echo wp_get_attachment_image($image, 'medium', "", array("class" => "img-responsive"));
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>