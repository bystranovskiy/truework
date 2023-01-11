<?php
$image_left = get_sub_field("image-left");
$image_right = get_sub_field("image-right");
$title = get_sub_field("title");
$content = get_sub_field("content");
?>

<section class="section-get-new-vacancies">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 pr-0 d-none d-lg-block">
                <?php echo wp_get_attachment_image($image_left, "large", "", array("class" => "img-responsive")); ?>
            </div>
            <div class="col-lg-5 d-flex justify-content-center align-items-center py-5">
                <div class="inner-wrap">
                    <h2 class="h1 m-0"><?php echo $title; ?></h2>
                    <p><?php echo $content; ?></p>
                    <?php wp_nav_menu(array('theme_location' => 'social', 'menu_class' => 'menu menu-social-buttons mt-4')); ?>
                </div>
            </div>
            <div class="col-lg-4 pl-0 d-none d-lg-flex align-items-end">
                <?php echo wp_get_attachment_image($image_right, "large", "", array("class" => "img-responsive")); ?>
            </div>
        </div>
    </div>
</section>