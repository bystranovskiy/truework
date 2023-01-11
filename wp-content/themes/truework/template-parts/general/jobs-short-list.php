<?php
$the_query = $args['the_query'];
?>

<?php while ($the_query->have_posts()) :
    $the_query->the_post();
    $ID = get_the_ID();
    $title = get_the_title();
    $permalink = get_the_permalink();
    $number_of_vacancies = get_field("number_of_vacancies") ?: 1;
    $salary_from = get_field("salary_from") ?: 0;
    $salary_to = get_field("salary_to");
    $sex = get_field("sex");
    $country = wp_get_post_terms($ID, 'country', array('fields' => 'names'))[0];
    $city = wp_get_post_terms($ID, 'city', array('fields' => 'names'))[0];
    $employer = wp_get_post_terms($ID, 'partners', array('fields' => 'all'))[0]; ?>
    <div class="col-12 px-2 mb-3 jobs-list-item-wrapper">
        <div class="d-flex flex-column jobs-list-item">
            <div class="row mx-n2 mb-2">
                <div class="col px-2">
                    <a href="<?php echo $permalink; ?>" class="h4 m-0 job-title"><?php echo $title; ?></a>
                </div>
                <?php if (is_user_logged_in()) { ?>
                    <div class="col-auto px-2 py-1"><i class="icon-eye"></i> <small><?php echo get_field('views') ?: 0; ?></small></div>
                <?php } ?>
            </div>

            <?php if ($employer) { ?>
                <div class="job-employer">
                    <a href="<?php echo get_term_link($employer->slug, $employer->taxonomy); ?>">
                        <?php
                        $image = get_field('image', 'post_tag_' . $employer->term_id);
                        echo wp_get_attachment_image($image, 'medium', "", array("class" => "img-responsive")) . "<b>" . $employer->name . "</b>";
                        ?>
                    </a>
                </div>
            <?php } ?>
            <div class="row py-2 my-2 mx-n2 mt-auto justify-content-between job-info">
                <div class="col-auto py-1 px-2 d-flex job-info-salary">
                    <i class="icon-wallet mr-2"></i>
                    <b><?php echo $salary_from;
                        echo $salary_to ? "-" . $salary_to : '';
                        echo " €"; ?></b>
                </div>
                <div class="col py-1 px-2 job-info-sex">
                    <?php if ($sex) { ?>
                        <i class="icon-<?php echo $sex['value']; ?> mr-1"></i> <span><?php echo $sex['label']; ?></span>
                    <?php } ?>
                </div>
                <div class="col-auto py-1 px-2 d-flex justify-content-end job-info-date">
                    <i class="icon-calendar mr-1"></i> <span><?php echo get_the_date("d.m.Y"); ?></span>
                </div>
            </div>
            <div class="row mx-n2 job-info">
                <div class="col py-1 px-2 d-flex job-info-location">
                    <i class="icon-location mr-1"></i> <span><?php echo $country;
                        echo $city ? ', ' . $city : ''; ?></span>
                </div>
                <div class="col-auto px-2">
                    <div class="job-mark job-mark--number-of-vacancies">
                        <?php echo "<b>" . $number_of_vacancies . "</b> " . esc_html__(num_word($number_of_vacancies, array('вакансія', 'вакансії', 'вакансій'), false), "truework"); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php endwhile; ?>