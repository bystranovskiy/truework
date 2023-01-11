<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php $fonts_google = "https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"; ?>
    <!-- connect to domain of font files -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- optionally increase loading priority -->
    <link rel="preload" as="style" href=<?php echo $fonts_google; ?>>
    <!-- async CSS -->
    <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');"
          href="<?php echo $fonts_google; ?>">
    <!-- no-JS fallback -->
    <noscript>
        <link rel="stylesheet" href="<?php echo $fonts_google; ?>">
    </noscript>
    <style>
        .preloader {
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
        }
    </style>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="preloader"></div>
<div class="slideout-menu">
    <div class="close"></div>
    <div class="container py-5">
        <?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', "", array("class" => "custom-logo img-responsive")); ?>
        <div class="site-slogan my-2"><?php the_field('slogan', 'option'); ?></div>
        <?php wp_nav_menu(array('theme_location' => 'top-menu', 'menu_class' => 'menu menu-top my-5')); ?>
        <div class="site-contacts py-3">
            <?php echo esc_html__("З усіх питань звертайтеся", "truework"); ?><br/>
            <a class="mt-3 d-inline-block"
               href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a><br/>
            <a class="icon-phone mt-3 d-inline-block"
               href="tel:+<?php echo preg_replace('/\D/', '', get_field('phone', 'option')); ?>"><?php the_field('phone', 'option'); ?></a>
        </div>
        <?php wp_nav_menu(array('theme_location' => 'social', 'menu_class' => 'menu menu-social mt-4')); ?>
    </div>
</div>
<div id="page" class="site">
    <header class="site-header box-shadow">
        <div class="top-header d-none d-lg-block py-2">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <a class="icon-phone"
                           href="tel:+<?php echo preg_replace('/\D/', '', get_field('phone', 'option')); ?>"><?php the_field('phone', 'option'); ?></a>
                    </div>
                    <div class="col text-center d-none d-md-block">
                        <?php echo esc_html__("З усіх питань звертайтеся", "truework"); ?> <a
                                href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a>
                    </div>
                    <div class="col-auto">
                        <?php wp_nav_menu(array('theme_location' => 'social', 'menu_class' => 'menu menu-social')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-header py-2 py-md-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col">
                        <?php the_custom_logo(); ?>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <?php wp_nav_menu(array('theme_location' => 'top-menu', 'menu_class' => 'menu menu-top')); ?>
                    </div>
                    <div class="col-auto d-lg-none">
                        <div class="icon-menu menu-toggle"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
