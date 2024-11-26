<?php get_header(); ?>

<p style="text-align: center; color: red;">single.php</p>

<div class="p-news p-news-single">
    <div class="l-inner">
        <article class="p-news-single__contents">
            <h2 class="p-news-single__title">投稿</h2>
            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>
                    <div class="p-news-single__head">
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
        <section class="p-news-single__related">
            <h2 class="p-news-single__title">関連する投稿</h2>
            <?php
            $categories = wp_get_post_categories(get_the_ID());
            $tags = wp_get_post_tags(get_the_ID(), array('fields' => 'ids'));

            $related_args = array(
                'post_type' => 'post',
                'posts_per_page' => -1, // 表示する投稿数
                'post__not_in' => array(get_the_ID()), // 現在の投稿を除外
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $categories,
                    ),
                    array(
                        'taxonomy' => 'post_tag',
                        'field' => 'term_id',
                        'terms' => $tags,
                    ),
                ),
            );

            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()): ?>
                <ul class="p-news__list p-news__list--min">
                    <?php while ($related_query->have_posts()): $related_query->the_post(); ?>
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
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p class="p-news__not-yet">関連する投稿はありません。</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </section>
    </div>
</div>

<?php get_footer(); ?>
