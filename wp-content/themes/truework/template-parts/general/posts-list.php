<?php
$the_query = $args['the_query'];
$paged = $the_query->query['paged'];
?>

<?php while ($the_query->have_posts()) {
    $the_query->the_post();
    $title = get_the_title();
    $permalink = get_the_permalink();
    $excerpt = get_the_excerpt();
    ?>
    <div class="col-auto px-2 mb-3">
        <div class="d-flex flex-column mx-auto news-item">
            <a href="<?php echo $permalink; ?>" class="news-item-image">
                <?php the_post_thumbnail('large', array("class" => "img-responsive")); ?>
            </a>
            <div class="d-flex flex-column col p-4 news-item-info">
                <div class="mb-2 news-item-date"><i class="icon-calendar"></i> <?php echo get_the_date("j F Y") . 'р.'; ?></div>
                <h3 class="h4 mt-0 news-item-title"><a
                        href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h3>
                <div class="mb-3 mt-auto news-item-excerpt">
                    <?php echo $excerpt; ?>
                </div>
                <a href="<?php echo $permalink; ?>"
                   class="news-item-readmore"><?php echo esc_html__("Читати далі", "truework"); ?></a>
            </div>

        </div>

    </div>
<?php } ?>