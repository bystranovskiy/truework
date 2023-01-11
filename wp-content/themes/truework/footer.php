<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hoverworld
 */

?>

<footer class="pt-5 pb-4">
    <div class="container">
        <div class="row justify-content-between flex-wrap-nowrap">
            <div class="col-auto py-2 col-logo">
                <?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', "", array( "class" => "img-responsive" )); ?>
                <div class="slogan mt-3"><?php the_field('slogan', 'option'); ?></div>
            </div>
            <div class="col-auto py-2 col-menu">
                <?php wp_nav_menu(array('theme_location' => 'footer-1')); ?>
            </div>
            <div class="col-auto py-2 col-menu">
                <?php wp_nav_menu(array('theme_location' => 'footer-2')); ?>
            </div>
            <div class="col-auto py-2 col-contacts">
                <?php echo esc_html__("З усіх питань звертайтеся", "truework"); ?><br/>
                <a class="mt-2 d-inline-block"
                   href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a><br/>
                <a class="icon-phone mt-4 d-inline-block"
                   href="tel:+<?php echo preg_replace('/\D/', '', get_field('phone', 'option')); ?>"><?php the_field('phone', 'option'); ?></a>
            </div>
            <div class="col-auto py-2 col-social">
                <?php wp_nav_menu(array('theme_location' => 'social', 'menu_class' => 'menu menu-social')); ?>
            </div>
        </div>
    </div>
    <div class="footer-copyright text-center pt-2 mt-5">
        <div class="container">
            <small>© <?php echo date("Y");?> <?php bloginfo('name'); ?>. <?php bloginfo('description'); ?>.</small>
        </div>
    </div>
</footer>


</div>

<?php wp_footer(); ?>
</body>
</html>
