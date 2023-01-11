<?php
$the_query = $args['the_query'];
$has_filter = $args['has_filter'];
$paged = $the_query->query['paged'];
?>

<?php while ($the_query->have_posts()) {
    $the_query->the_post();
    $ID = get_the_ID();
    $title = get_the_title();
    $permalink = get_the_permalink();
    $excerpt = get_the_excerpt();
    $number_of_vacancies = get_field("number_of_vacancies") ?: 1;
    $urgently = get_field("urgently");
    $salary_from = get_field("salary_from") ?: 0;
    $salary_to = get_field("salary_to");
    $sex = get_field("sex");
    $country = wp_get_post_terms($ID, 'country', array('fields' => 'names'))[0];
    $city = wp_get_post_terms($ID, 'city', array('fields' => 'names'))[0];
    $employer = wp_get_post_terms($ID, 'partners', array('fields' => 'all'))[0];
    ?>
    <div class="<?php echo $has_filter ? 'col-12' : 'col-xl-6'; ?> mb-4 jobs-list-item-wrapper">
        <div class="d-flex flex-column jobs-list-item">
            <div class="row align-items-start job-header">
                <?php if (is_user_logged_in()) { ?>
                    <div class="col-12 text-right mt-n2 mb-2">
                        <i class="icon-eye"></i> <small><?php echo get_field('views') ?: 0; ?></small>
                    </div>
                <?php } ?>
                <div class="col-md-8 col-lg-7 col-xl-8 col-xxl-7 order-2 order-md-1">
                    <a href="<?php echo $permalink; ?>" class="h4 job-title"><?php echo $title; ?></a>
                </div>
                <div class="col-md-4 col-lg-5 col-xl-4 col-xxl-5 order-1 order-md-2 mb-3 mb-md-0">
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
            <div class="row py-2 my-3 justify-content-between <?php echo $has_filter ? 'flex-xl-nowrap' : 'flex-lg-nowrap flex-xl-wrap flex-xxl-nowrap'; ?> job-info">
                <div class="<?php echo $has_filter ? 'col-6 col-xl-auto' : 'col-6 col-lg-auto col-xl-6 col-xxl-auto'; ?> py-1 d-flex job-info-salary">
                    <i class="icon-wallet mr-2"></i>
                    <b><?php echo $salary_from;
                        echo $salary_to ? "-" . $salary_to : '';
                        echo " €"; ?></b>
                </div>
                <div class="<?php echo $has_filter ? 'col-6 col-xl-auto' : 'col-6 col-lg-auto col-xl-6 col-xxl-auto'; ?> py-1 d-flex justify-content-end job-info-sex">
                    <?php if ($sex) { ?>
                        <i class="icon-<?php echo $sex['value']; ?> mr-1"></i> <span><?php echo $sex['label']; ?></span>
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
            <div class="job-description mb-3">
                <?php echo $excerpt; ?>
            </div>
            <?php if ($employer) { ?>
                <div class="row align-items-center flex-lg-nowrap mt-auto job-employer">
                    <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                        <a href="<?php echo get_term_link($employer->slug, $employer->taxonomy); ?>">
                            <?php
                            $image = get_field('image', 'post_tag_' . $employer->term_id);
                            echo wp_get_attachment_image($image, 'medium', "", array("class" => "img-responsive")) . "<b>" . $employer->name . "</b>";
                            ?>
                        </a>
                    </div>
                    <?php if (get_field('verified_employer', 'post_tag_' . $employer->term_id)) { ?>
                        <div class="col-12 col-lg d-flex align-items-center justify-content-lg-end text-lg-right verified_employer">
                            <i class="icon-check"></i>
                            <span><?php echo esc_html__("Перевірений роботодавець", "truework"); ?></span>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
<div class="col-12 mt-3">
    <div class="row align-items-center flex-md-nowrap">
        <div class="<?php echo $has_filter ? 'col' : 'col-lg-4'; ?> text-center pb-3 pb-md-0 text-md-left">
            <?php echo esc_html__("Відображається", "truework") . " <b>" . count($the_query->posts) . "</b> " . esc_html__("із", "truework") . " <b>" . $the_query->found_posts . "</b>"; ?>
        </div>
        <div class="<?php echo $has_filter ? 'col-md-auto' : 'col-md-auto col-lg-4'; ?>">
            <?php pagination($paged, $the_query->max_num_pages); ?>
        </div>
    </div>
</div>
