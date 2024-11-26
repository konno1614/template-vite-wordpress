<?php get_header(); ?>

<p style="text-align: center; color: red;">single-custom-post-sample.php</p>

<div class="p-custom-post-sample p-custom-post-sample-single">
    <div class="l-inner">
        <article class="p-custom-post-sample-single__contents">
            <h2 class="p-custom-post-sample-single__title">投稿</h2>
            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post();
                    // ACFのカスタムフィールドの値を取得
                    $text = get_field('custom-post-sample_text');
                ?>
                    <div class="p-custom-post-sample-single__head">
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
                        <div class="acf">
                            <p><?php echo $text; ?></p>
                        </div>
                        <div class="category">
                            <?php
                            $categories = get_the_terms(get_the_ID(), 'custom-post-sample-category');
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    $category_link = get_term_link($category->term_id, 'custom-post-sample-category');
                                    echo '<a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';
                                }
                            }
                            ?>
                        </div>
                        <div class="tag">
                            <?php
                            $posttags = get_the_terms(get_the_ID(), 'custom-post-sample-tag');
                            if ($posttags) {
                                foreach ($posttags as $tag) {
                                    $tag_link = get_term_link($tag->term_id, 'custom-post-sample-tag');
                                    echo '<a href="' . esc_url($tag_link) . '">' . esc_html($tag->name) . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="p-custom-post-sample-single__body">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <div class="p-custom-post-sample-single__foot">
                <?php get_template_part('component/prevnext'); ?>
            </div>
        </article>
        <section class="p-custom-post-sample-single__related">
            <h2 class="p-custom-post-sample-single__title">関連する投稿</h2>
            <?php
            $categories = wp_get_post_terms(get_the_ID(), 'custom-post-sample-cat', array('fields' => 'ids'));
            $tags = wp_get_post_terms(get_the_ID(), 'custom-post-sample-tag', array('fields' => 'ids'));

            $related_args = array(
                'post_type' => 'custom-post-sample',
                'posts_per_page' => -1, // 全件表示
                'post__not_in' => array(get_the_ID()), // 現在の投稿を除外
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'custom-post-sample-cat',
                        'field' => 'term_id',
                        'terms' => $categories,
                    ),
                    array(
                        'taxonomy' => 'custom-post-sample-tag',
                        'field' => 'term_id',
                        'terms' => $tags,
                    ),
                ),
            );

            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()): ?>
                <ul class="p-custom-post-sample__list p-custom-post-sample__list--min">
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
                <p class="p-custom-post-sample__not-yet">関連する投稿はありません。</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </section>
    </div>
</div>


<?php get_footer(); ?>
