<?php
get_header();

$ID = get_the_ID();
$title = get_the_title();
$number_of_vacancies = get_field("number_of_vacancies") ?: 1;
$urgently = get_field("urgently");
$salary_from = get_field("salary_from") ?: 0;
$salary_to = get_field("salary_to");
$sex = get_field("sex");
$country = wp_get_post_terms($ID, 'country', array('fields' => 'names'))[0];
$city = wp_get_post_terms($ID, 'city', array('fields' => 'names'))[0];
$employer = wp_get_post_terms($ID, 'partners', array('fields' => 'all'))[0];

$contact_person = get_field('contact_person');
$phone = get_field('phone');

$experience_is_required = get_field('experience_is_required');
$accommodation_is_provided = get_field('accommodation_is_provided');
$language_proficiency_required = get_field('language_proficiency_required');
$employment_type = get_field('employment_type');

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

                    <a href="<?php echo get_post_type_archive_link('jobs'); ?>"
                       class="mb-4 turn-back"><i
                                class="icon-angle-left h5"></i><?php echo esc_html__("Назад до усіх вакансій", "truework"); ?>
                    </a>

                    <div class="single-job">

                        <div class="row align-items-start flex-lg-nowrap job-header">
                            <div class="col order-2 order-lg-1">
                                <h1 class="d-block mt-lg-0 job-title"><?php echo $title; ?></h1>
                                <?php if ($employer) { ?>
                                    <div class="d-inline-block job-employer">
                                        <a href="<?php echo get_term_link($employer->slug, $employer->taxonomy); ?>">
                                            <?php
                                            $image = get_field('image', 'post_tag_' . $employer->term_id);
                                            echo wp_get_attachment_image($image, 'medium', "", array("class" => "img-responsive")) . "<b>" . $employer->name . "</b>";
                                            ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-auto order-1 order-lg-2">
                                <div class="row justify-content-end m-n1">
                                    <?php if ($urgently) { ?>
                                        <div class="col-auto p-1">
                                            <div class="job-mark job-mark--urgently"><i
                                                        class="icon-flame"></i> <?php echo esc_html__("Терміново", "truework"); ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-auto p-1">
                                        <div class="job-mark job-mark--number-of-vacancies">
                                            <?php echo "<b>" . $number_of_vacancies . "</b> " . esc_html__(num_word($number_of_vacancies, array('вакансія', 'вакансії', 'вакансій'), false), "truework"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row py-3 mt-3 justify-content-between flex-lg-nowrap job-info">
                            <div class="col-6 col-lg-auto py-1 d-flex job-info-salary">
                                <i class="icon-wallet mr-2"></i>
                                <b><?php echo $salary_from;
                                    echo $salary_to ? "-" . $salary_to : '';
                                    echo " €"; ?></b>
                            </div>
                            <div class="col-6 col-lg-auto py-1 d-flex justify-content-end job-info-sex">
                                <?php if ($sex) { ?>
                                    <i class="icon-<?php echo $sex['value']; ?> mr-1"></i>
                                    <span><?php echo $sex['label']; ?></span>
                                <?php } ?>
                            </div>
                            <div class="col py-1 d-flex job-info-location">
                                <i class="icon-location mr-1"></i> <span><?php echo $country;
                                    echo $city ? ', ' . $city : ''; ?></span>
                            </div>
                            <div class="col-auto py-1 d-flex justify-content-end job-info-date">
                                <i class="icon-calendar mr-1"></i> <span><?php echo get_the_date("d.m.Y"); ?></span>
                            </div>
                        </div>

                        <div class="row align-items-center py-3 py-lg-1 text-center job-feedback">
                            <div class="col-md-6 col-lg-4 py-2 text-md-left">
                                <?php echo esc_html__("Контактна особа", "truework"); ?>:
                                <b><?php echo $contact_person; ?></b>
                            </div>
                            <div class="col-md-6 col-lg-4 py-2 text-md-right text-lg-center">
                                <?php echo esc_html__("Телефон", "truework"); ?>: <b><?php echo $phone; ?></b>
                            </div>
                            <div class="col-lg-4 py-2 text-lg-right mt-md-3 mt-lg-0">
                                <button type="button"
                                        class="btn btn-primary ml-auto job-respond"><?php echo esc_html__("Відгукнутись", "truework"); ?></button>
                            </div>
                        </div>

                        <div class="row mx-n2 py-2 job-options">
                            <?php if ($experience_is_required) { ?>
                                <div class="col-auto p-2">
                                    <div class="option-mark">
                                        <?php echo esc_html__("Потрібен досвід", "truework"); ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($accommodation_is_provided) { ?>
                                <div class="col-auto p-2">
                                    <div class="option-mark">
                                        <?php echo esc_html__("Надається житло", "truework"); ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($language_proficiency_required) { ?>
                                <div class="col-auto p-2">
                                    <div class="option-mark">
                                        <?php echo esc_html__("Знання мови", "truework"); ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($employment_type) { ?>
                                <div class="col-auto p-2">
                                    <div class="option-mark">
                                        <?php echo $employment_type['label']; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="pt-3 pb-5 post-content">
                            <?php echo $content; ?>
                            <hr/>
                            <div class="mt-4"><i class="icon-eye"></i><?php echo " " . get_field('views') . " " . esc_html__(num_word(get_field('views'), array('Перегляд', 'Перегляди', 'Переглядів'), false), "truework"); ?></div>
                        </div>

                        <div class="text-center py-3 job-footer">
                            <button type="button"
                                    class="btn btn-primary-outline job-respond"><?php echo esc_html__("Відгукнутись", "truework"); ?></button>
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

<div class="popup-form" style="display: none;">
    <div class="close close-popup"></div>
    <div class="popup-content single-job">
        <div class="row job-header">
            <div class="col">
                <h1 class="h2 d-block mt-lg-0 job-title"><?php echo $title; ?></h1>
                <?php if ($employer) { ?>
                    <div class="d-inline-block job-employer">
                        <a href="<?php echo get_term_link($employer->slug, $employer->taxonomy); ?>">
                            <?php
                            $image = get_field('image', 'post_tag_' . $employer->term_id);
                            echo wp_get_attachment_image($image, 'medium', "", array("class" => "img-responsive")) . "<b>" . $employer->name . "</b>";
                            ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="row py-3 mt-3 job-info">
            <div class="row w-100 mx-0">
                <div class="col py-1 d-flex job-info-salary">
                    <i class="icon-wallet mr-2"></i>
                    <b><?php echo $salary_from;
                        echo $salary_to ? "-" . $salary_to : '';
                        echo " €"; ?></b>
                </div>
                <div class="col-auto py-1 job-info-sex">
                    <?php if ($sex) { ?>
                        <i class="icon-<?php echo $sex['value']; ?> mr-1"></i>
                        <span><?php echo $sex['label']; ?></span>
                    <?php } ?>
                </div>
            </div>
            <div class="row w-100 mx-0">
                <div class="col py-1 d-flex job-info-location">
                    <i class="icon-location mr-1"></i> <span><?php echo $country;
                        echo $city ? ', ' . $city : ''; ?></span>
                </div>
                <div class="col-auto py-1 d-flex justify-content-end job-info-date">
                    <i class="icon-calendar mr-1"></i> <span><?php echo get_the_date("d.m.Y"); ?></span>
                </div>
            </div>

        </div>

        <div class="row align-items-center py-3 py-lg-1 text-center job-feedback">
            <div class="col-md-6 py-2 text-md-left">
                <?php echo esc_html__("Контактна особа", "truework"); ?>:
                <b><?php echo $contact_person; ?></b>
            </div>
            <div class="col-md-6 py-2 text-md-right">
                <?php echo esc_html__("Телефон", "truework"); ?>: <b><?php echo $phone; ?></b>
            </div>
        </div>
        <div class="row py-4 job-contact-form">
            <div class="col-12">
                <?php echo do_shortcode('[contact-form-7 id="5"]'); ?>
            </div>
        </div>
    </div>
    <div class="text-center pb-5 single-job thank-you-message" style="display: none;">
        <h2 class="mb-3 mx-auto pb-3"><?php echo esc_html__("Дякуємо ", "truework"); ?></h2>
        <p class="h4 pt-0"><?php echo esc_html__("Ваша заявка успішно відправленна!", "truework"); ?></p>
        <div class="btn btn-primary px-5 close-popup">
            <?php echo esc_html__("OK", "truework"); ?>
        </div>
    </div>
</div>
