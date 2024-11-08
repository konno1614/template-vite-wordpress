<?php get_header(); ?>

<main class="l-main p-news">
    <div class="l-inner">
        <div class="p-news__contents">
            <?php if (have_posts()): ?>
                <ul class="p-news__list">
                    <?php while (have_posts()): the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
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
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
            <?php get_template_part('component/pager'); ?>
        </div>
        <div class="p-news__back">
            <a href="<?php echo esc_url(home_url('/')); ?>news/">News一覧へ</a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
