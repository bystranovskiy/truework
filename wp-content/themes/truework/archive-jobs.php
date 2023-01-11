<?php
get_header();

$paged = 1;
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
    $paged = get_query_var('page');
}

$args = array(
    'post_type' => 'jobs',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
    'tax_query' => array(
        'relation' => 'AND',
    ),
    'meta_query' => array(
        'relation' => 'AND',
    ),
);

if ($_GET["s"]) {
    $args['s'] = $_GET["s"];
}


if ($_GET["country"] || is_tax('country')) {
    $args['tax_query'][] = array(
        'taxonomy' => 'country',
        'field' => 'slug',
        'terms' => array(is_tax('country') ? get_queried_object()->slug : $_GET["country"]),
    );
}

if ($_GET["city"] || is_tax('city')) {
    $args['tax_query'][] = array(
        'taxonomy' => 'city',
        'field' => 'slug',
        'terms' => array(is_tax('city') ? get_queried_object()->slug : $_GET["city"]),
    );
}

if ($_GET["post_tag"] || is_tag()) {
    $args['tax_query'][] = array(
        'taxonomy' => 'post_tag',
        'field' => 'slug',
        'terms' => array(is_tag() ? get_queried_object()->slug : $_GET["post_tag"]),
    );
}

if ($_GET["specialty"] || is_tax('specialty')) {
    $args['tax_query'][] = array(
        'taxonomy' => 'specialty',
        'field' => 'slug',
        'terms' => array(is_tax('specialty') ? get_queried_object()->slug : $_GET["specialty"]),
    );
}

if ($_GET["partners"] || is_tax('partners')) {
    $args['tax_query'][] = array(
        'taxonomy' => 'partners',
        'field' => 'slug',
        'terms' => array(is_tax('partners') ? get_queried_object()->slug : $_GET["partners"]),
    );
}

if ($_GET["salary_to"]) {
    $args['meta_query'][] = array(
        'key' => 'salary_from',
        'value' => intval($_GET["salary_from"] ?: 0),
        'compare' => '>=',
        'type' => 'NUMERIC'
    );
    $args['meta_query'][] = array(
        'key' => 'salary_to',
        'value' => intval($_GET["salary_to"]),
        'compare' => '<=',
        'type' => 'NUMERIC'
    );
}

if ($_GET["experience_is_required"]) {
    $args['meta_query'][] = array(
        'key' => 'experience_is_required',
        'value' => true,
        'compare' => '=',
    );
}

if ($_GET["accommodation_is_provided"]) {
    $args['meta_query'][] = array(
        'key' => 'accommodation_is_provided',
        'value' => true,
        'compare' => '=',
    );
}

if ($_GET["language_proficiency_required"]) {
    $args['meta_query'][] = array(
        'key' => 'language_proficiency_required',
        'value' => true,
        'compare' => '=',
    );
}

if ($_GET["employment_type"]) {
    $args['meta_query'][] = array(
        'key' => 'employment_type',
        'value' => $_GET["employment_type"],
        'compare' => '=',
    );
}

$the_query = new WP_Query($args);
?>

    <main>
        <div class="container py-5">
            <p><?php echo esc_html__(num_word($the_query->found_posts, array('Знайдена', 'Знайдено', 'Знайдено'), false)); ?>
                <b><?php echo $the_query->found_posts; ?></b> <?php echo esc_html__(num_word($the_query->found_posts, array('вакансія', 'вакансії', 'вакансій'), false)); ?>
            </p>
            <div class="row my-4">
                <div class="col-lg-5 col-xl-4">
                    <?php get_template_part('/template-parts/general/jobs-filter-form', null, array('the_query' => $the_query)); ?>
                </div>
                <div class="col-lg-7 col-xl-8">

                    <?php if ($the_query->have_posts()) { ?>
                        <div class="row jobs-list">
                            <?php get_template_part('/template-parts/general/jobs-list', null, array('the_query' => $the_query, 'has_filter' => true)); ?>
                        </div>
                    <?php } else {
                        echo esc_html__("Записів не знайдено", "truework");
                    } ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>

        <?php if (is_tax()) {
            $queried_object = get_queried_object(); ?>
            <section class="section-tax-info post-content pb-5">
                <div class="container pb-5">
                    <h1 class="mt-0 text-center"><?php echo $queried_object->name; ?></h1>
                    <?php echo $queried_object->description; ?>
                </div>
            </section>
        <?php } ?>
    </main>

<?php
get_footer();