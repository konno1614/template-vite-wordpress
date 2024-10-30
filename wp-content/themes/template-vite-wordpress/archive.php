<?php get_header(); ?>

<?php get_template_part('component/common_head'); ?>

<div class="p-common p-news">
    <aside class="p-news__categories">
        <ul>
            <li class="<?php echo is_category() ? '' : 'all'; ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>news/">すべて</a>
            </li>
            <?php if (have_posts()) : ?>
                <?php wp_list_categories('title_li=&order=ASC'); ?>
            <?php endif; ?>
        </ul>
    </aside>
    <section class="p-news__contents">
        <div class="l-inner l-inner--narrow">
            <div class="p-news__sp-categories">
                <select name="select" onChange="location.href=value;">
                    <option value="/news/" <?php echo !is_category() ? 'selected' : ''; ?>>すべて</option>
                    <?php
                    $categories = get_categories();
                    $current_category = get_queried_object();
                    foreach ($categories as $category) {
                        $category_link = get_category_link($category);
                        $selected = (is_category() && $current_category->term_id === $category->term_id) ? 'selected' : '';
                        echo '<option value="' . esc_url($category_link) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
                    }
                    ?>
                </select>
            </div>
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
    </section>
</div>

<?php get_footer(); ?>
