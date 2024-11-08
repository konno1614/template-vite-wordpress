<?php get_header(); ?>

<?php get_template_part('component/common_head'); ?>

<div class="p-common p-news p-newsSingle">
    <ul class="p-news__categories">
        <li class="<?php echo is_category() ? '' : 'all'; ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>news/">すべて</a>
        </li>
        <?php if (have_posts()) : ?>
            <?php wp_list_categories('title_li=&order=ASC'); ?>
        <?php endif; ?>
    </ul>
    <article class="p-news__contents">
        <div class="l-inner l-inner--narrow">
            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>
                    <div class="p-newsSingle__head">
                        <time><?php the_time('Y.m.d'); ?></time>
                        <?php
                        $categories = get_the_category();
                        ?>
                        <?php
                        if (! empty($categories)) {
                            foreach ($categories as $category) {
                                echo '<span>' . esc_html($category->cat_name) . '</span>';
                            }
                        }
                        ?>
                        <h3><?php the_title(); ?></h3>
                    </div>
                    <div class="p-newsSingle__body">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <div class="p-newsSingle__foot">
                <?php get_template_part('component/prevnext'); ?>
            </div>
        </div>
    </article>
</div>

<?php get_footer(); ?>
