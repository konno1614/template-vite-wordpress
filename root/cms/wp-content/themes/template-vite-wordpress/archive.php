<?php get_header(); ?>

<div class="p-news">
    <div class="l-inner">
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
        <?php else: ?>
            <p class="p-news__not-yet">まだ投稿はありません。</p>
        <?php endif; ?>
        <?php get_template_part('component/pager'); ?>
    </div>
</div>

<?php get_footer(); ?>
