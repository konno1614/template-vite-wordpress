<?php get_header(); ?>

<div class="p-contact">
    <div class="l-inner">
        <section class="p-contact__section">
            <h2 class="p-contact__title">Contact Form 7</h2>
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="p-contact__form">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
            <?php endif; ?>
        </section>
        <section class="p-contact__section">
            <h2 class="p-contact__title">Google Form</h2>
            <div class="p-contact__google-form">
                <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScqcLiiJ_0e37qoXjn504lbLgMjT29HSBynYQVMIF_gDLqFjg/viewform?embedded=true" width="640" height="416" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>
