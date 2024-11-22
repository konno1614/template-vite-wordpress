<?php get_header(); ?>

<?php get_template_part('component/common_head'); ?>

<div class="p-news p-news-single">
    <div class="l-inner">
        <ul class="p-news__categories">
            <li class="<?php echo is_category() ? '' : 'all'; ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>news/">すべて</a>
            </li>
            <?php if (have_posts()) : ?>
                <?php wp_list_categories('title_li=&order=ASC'); ?>
            <?php endif; ?>
        </ul>
        <article class="p-news-single__contents">
            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>
                    <div class="p-news-single__head">
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
                    <div class="p-news-single__body">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <div class="p-news-single__foot">
                <?php get_template_part('component/prevnext'); ?>
            </div>
        </article>
    </div>
</div>

<?php get_footer(); ?>
