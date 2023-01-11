<?php
$image = get_sub_field("image");
$bg_image = get_sub_field("bg-image");
$bg_image_src = wp_get_attachment_image_src($bg_image, "large");
?>

<section class="section-intro">
    <div class="intro-bg d-none d-sm-block col-sm-4 col-lg-5"
         style="background-image: url(<?php echo $bg_image_src[0]; ?>)"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-7 col-lg-5 col-xl-4">
                <h1 class="mb-5 mt-0 mt-lg-5 text-uppercase"><?php bloginfo('description'); ?></h1>
                <p class="mb-5"><?php the_field('slogan', 'option'); ?></p>
            </div>
            <div class="col-lg-7 col-xl-7">
                <div class="image-wrap">
                    <?php echo wp_get_attachment_image($image, "large", "", array("class" => "w-100 img-responsive")); ?>
                </div>
            </div>
            <div class="col-12">
                <form class="search-form p-4 box-shadow" action="<?php echo get_post_type_archive_link('jobs'); ?>"
                      method="get"
                      id="searchform">
                    <div class="row">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <input
                                    name="s"
                                    type="text"
                                    placeholder="<?php echo esc_html__("Введіть ключові слова", "truework"); ?>">
                        </div>
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <select name="country">
                                <option value=""
                                        selected><?php echo esc_html__("Всі країни", "truework"); ?></option>
                                <?php
                                $countries = get_terms(array(
                                    'taxonomy' => 'country',
                                ));
                                foreach ($countries as $country) { ?>
                                    <option value="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <input type="submit" class="btn btn-primary"
                                   value="<?php echo esc_html__("Пошук", "truework"); ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>