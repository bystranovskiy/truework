<?php get_header(); ?>

    <main>
        <section class="section-404 h-100 d-flex align-items-center">
            <div class="container py-5 text-center">
                <div class="h1">404</div>
                <h1 class="h2"><?php echo esc_html__("Сторінку не знайдено", "truework"); ?></h1>
                <a href="<?php echo get_home_url();?>" class="btn btn-primary"><?php echo esc_html__("На головну", "truework"); ?></a>
            </div>
        </section>
    </main>

<?php
get_footer();