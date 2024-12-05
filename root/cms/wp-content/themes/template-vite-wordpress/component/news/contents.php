<div class="p-news__contents">
    <?php if (have_posts()): ?>
        <ul class="p-news__list">
            <?php while (have_posts()): the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <div class="thumbnail">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/post/dummy.jpg" width="900" height="600" alt="dummy" loading="lazy" decoding="async" />
                            <?php endif; ?>
                        </div>
                        <time class="time">
                            <?php the_time('Y.m.d'); ?>
                        </time>
                        <h3 class="title">
                            <?php the_title(); ?>
                        </h3>
                    </a>
                    <div class="category">
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                $category_link = get_category_link($category->term_id);
                                echo '<a href="' . esc_url($category_link) . '">' . esc_html($category->cat_name) . '</a>';
                            }
                        }
                        ?>
                    </div>
                    <div class="tag">
                        <?php
                        $posttags = get_the_tags();
                        if ($posttags) {
                            foreach ($posttags as $tag) {
                                $tag_link = get_tag_link($tag->term_id);
                                echo '<a href="' . esc_url($tag_link) . '">' . esc_html($tag->name) . '</a>';
                            }
                        }
                        ?>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p class="p-news__not-yet">まだ投稿はありません。</p>
    <?php endif; ?>
    <div class="p-news__pager">
        <?php get_template_part('component/pager'); ?>
    </div>
</div>
