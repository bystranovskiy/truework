<?php
$title = get_sub_field("title");
$employers = get_sub_field("employers");
?>

<section class="section-verified-employers">
    <div class="container py-5">
        <h2 class="h1 text-center"><?php echo $title; ?></h2>
        <?php if ($employers) { ?>

            <div class="row mx-n2 justify-content-center verified-employers-list">
                <?php foreach ($employers as $employer) { ?>
                    <div class="col-auto px-2 verified-employer-item">
                        <a href="<?php echo get_term_link($employer->slug, $employer->taxonomy); ?>"
                           class="d-flex align-item-center verified-employer-item-inner">
                            <?php
                            $image = get_field('image', 'post_tag_' . $employer->term_id);
                            echo wp_get_attachment_image($image, 'medium', "", array("class" => "img-responsive"));
                            ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>