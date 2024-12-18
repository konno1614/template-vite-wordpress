<?php require 'header.php'; ?>
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
    </div>
</div>

<?php get_footer(); ?>
