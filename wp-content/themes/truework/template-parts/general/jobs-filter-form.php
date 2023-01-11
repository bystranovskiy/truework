<?php
$the_query = $args['the_query'];

$salary_from = [];
$array_salary_to = [];

$new_query = new WP_Query([
    'post_type' => 'jobs',
    'posts_per_page' => -1
]);
if ($new_query->have_posts()):

    while ($new_query->have_posts()) : $new_query->the_post();
        $salary_from = get_field('salary_from');
        $salary_to = get_field('salary_to');
        if (isset($salary_from) && !empty($salary_from)) {
            $array_salary_from[] = $salary_from;
        }
        if (isset($salary_to) && !empty($salary_to)) {
            $array_salary_to[] = $salary_to;
        }

    endwhile;
endif;
$salary_from = min($array_salary_from);
$salary_to = max($array_salary_to);
wp_reset_query();
?>

<form action="<?php echo get_post_type_archive_link('jobs'); ?>" method="get" class="jobs-filter-form mb-5 mb-lg-0">
    <div class="input-group mb-4">
        <input
                name="s"
                type="text"
                placeholder="<?php echo esc_html__("Введіть ключові слова", "truework"); ?>"
                value="<?php echo $the_query->query['s'] ?: '' ?>"
                class="form-control"
        >
    </div>

    <div class="row mx-n2">
        <div class="col-6 col-lg-12 col-xl-6 px-2">
            <label for="country" class="icon-location mb-2 ml-2"><?php echo esc_html__("Країна", "truework"); ?></label>
            <div class="input-group mb-4">
                <select name="country" id="country">
                    <option value=""><?php echo esc_html__("Всі країни", "truework"); ?></option>
                    <?php
                    $countries = get_terms(array(
                        'taxonomy' => 'country',
                    ));
                    foreach ($countries as $country) { ?>
                        <option
                            <?php echo $_GET["country"] === $country->slug ? 'selected' : ''; ?>
                                value="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-6 col-lg-12 col-xl-6 px-2">
            <label for="city" class="icon-location mb-2 ml-2"><?php echo esc_html__("Місто", "truework"); ?></label>
            <div class="input-group mb-4">
                <select name="city" id="city">
                    <option value=""><?php echo esc_html__("Всі міста", "truework"); ?></option>
                    <?php
                    $cities = get_terms(array(
                        'taxonomy' => 'city',
                    ));
                    foreach ($cities as $city) { ?>
                        <option
                            <?php echo $_GET["city"] === $city->slug ? 'selected' : ''; ?>
                                value="<?php echo $city->slug; ?>"><?php echo $city->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row mx-n2">
        <div class="col-12 col-md-6 col-lg-12 px-2">
            <label for="post_tag" class="icon-man mb-2 ml-2"><?php echo esc_html__("Рубрики", "truework"); ?></label>
            <div class="input-group mb-4">
                <select name="post_tag" id="post_tag">
                    <option value=""><?php echo esc_html__("Всі рубрики", "truework"); ?></option>
                    <?php
                    $tags = get_tags();
                    foreach ($tags as $tag) { ?>
                        <option
                            <?php echo $_GET["post_tag"] === $tag->slug ? 'selected' : ''; ?>
                                value="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-12 px-2">
            <label for="salary" class="icon-wallet mb-2 ml-2"><?php echo esc_html__("Зарплата", "truework"); ?>, €</label>
            <div class="input-group mb-4">

                <div class="row mb-2 mx-n2 mb-4">
                    <div class="col-6 px-2">
                        <input
                                type="number"
                                step="10"
                                name="salary_from"
                                id="salary_from"
                                value="<?php echo $_GET["salary_from"] ?: $salary_from; ?>"
                                min="<?php echo $salary_from; ?>"
                                max="<?php echo $_GET["salary_to"] ?: $salary_to; ?>">
                    </div>
                    <div class="col-6 px-2">
                        <input
                                type="number"
                                step="10"
                                name="salary_to"
                                id="salary_to"
                                value="<?php echo $_GET["salary_to"] ?: $salary_to; ?>"
                                min="<?php echo $_GET["salary_from"] ?: $salary_from; ?>"
                                max="<?php echo $salary_to; ?>">
                    </div>
                </div>
                <div id="salary" class="mx-2" name="salary" data-min="<?php echo $salary_from; ?>"
                     data-max="<?php echo $salary_to; ?>"></div>
            </div>
        </div>
    </div>

    <div class="input-group options-group pt-4 mb-3 px-xxl-4">
        <div class="row mx-n1">
            <div class="col-6 px-1">
                <label for="experience_is_required" class="mb-2"><?php echo esc_html__("Досвід", "truework"); ?></label>
                <fieldset id="experience_is_required" class="mb-3">
                    <label class="mb-2">
                        <input type="radio" <?php echo $_GET["experience_is_required"] ? 'checked' : ''; ?> value="1"
                               name="experience_is_required"><?php echo esc_html__("Потрібен досвід", "truework"); ?>
                    </label>
                    <label class="mb-2">
                        <input type="radio" <?php echo !$_GET["experience_is_required"] ? 'checked' : ''; ?> value="0"
                               name="experience_is_required"><?php echo esc_html__("Без досвіду", "truework"); ?>
                    </label>
                </fieldset>
            </div>
            <div class="col-6 px-1">
                <label for="accommodation_is_provided" class="mb-2"><?php echo esc_html__("Житло", "truework"); ?></label>
                <fieldset id="accommodation_is_provided" class="mb-3">
                    <label class="mb-2">
                        <input type="radio" <?php echo $_GET["accommodation_is_provided"] ? 'checked' : ''; ?> value="1"
                               name="accommodation_is_provided"><?php echo esc_html__("З проживанням", "truework"); ?>
                    </label>
                    <label class="mb-2">
                        <input type="radio" <?php echo !$_GET["accommodation_is_provided"] ? 'checked' : ''; ?> value="0"
                               name="accommodation_is_provided"><?php echo esc_html__("Без проживання", "truework"); ?>
                    </label>
                </fieldset>
            </div>
            <div class="col-6 px-1">
                <label for="employment_type" class="mb-2"><?php echo esc_html__("Вид зайнятості", "truework"); ?></label>
                <fieldset id="employment_type" class="mb-3">
                    <label class="mb-2">
                        <input type="checkbox" <?php echo $_GET["employment_type"] === 'fulltime' ? 'checked' : ''; ?>
                               value="fulltime" name="employment_type"><?php echo esc_html__("Постійна робота", "truework"); ?>
                    </label>
                    <label class="mb-2">
                        <input type="checkbox" <?php echo $_GET["employment_type"] === 'project' ? 'checked' : ''; ?>
                               value="project" name="employment_type"><?php echo esc_html__("Проектна робота", "truework"); ?>
                    </label>
                    <label class="mb-2">
                        <input type="checkbox" <?php echo $_GET["employment_type"] === 'seasonal' ? 'checked' : ''; ?>
                               value="seasonal" name="employment_type"><?php echo esc_html__("Сезонна робота", "truework"); ?>
                    </label>
                </fieldset>
            </div>
            <div class="col-6 px-1">
                <label for="language_proficiency_required" class="mb-2"><?php echo esc_html__("Знання мови", "truework"); ?></label>
                <fieldset id="language_proficiency_required" class="mb-3">
                    <label class="mb-2">
                        <input type="radio" <?php echo $_GET["language_proficiency_required"] ? 'checked' : ''; ?> value="1"
                               name="language_proficiency_required"><?php echo esc_html__("Знання мови", "truework"); ?>
                    </label>
                    <label class="mb-2">
                        <input type="radio" <?php echo !$_GET["language_proficiency_required"] ? 'checked' : ''; ?> value="0"
                               name="language_proficiency_required"><?php echo esc_html__("Без знання мови", "truework"); ?>
                    </label>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="input-group px-xxl-4">
        <div class="row mx-n2">
            <div class="col px-2">
                <input type="submit" class="btn btn-primary w-100" value="<?php echo esc_html__("Шукати", "truework"); ?>">
            </div>
            <div class="col px-2">
                <input type="reset" class="btn btn-primary w-100" value="<?php echo esc_html__("Скинути", "truework"); ?>">
            </div>
        </div>

    </div>

</form>



