<div class="p-custom-post-sample__contents">
    <?php if (have_posts()): ?>
        <ul class="p-custom-post-sample__list">
            <?php while (have_posts()): the_post();
                // ACFのカスタムフィールドの値を取得
                $text = get_field('custom-post-sample_text');
            ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <div class="thumbnail">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php else : ?>
                                <img src="<?php echo $root; ?>assets/images/post/dummy.jpg" width="900" height="600" alt="dummy" loading="lazy" decoding="async" />
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
                    </a>
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
                                echo '<a href="' . esc_url($tag_link) . '"><span>' . esc_html($tag->name) . '</span></a>';
                            }
                        }
                        ?>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p class="p-custom-post-sample__not-yet">まだ投稿はありません。</p>
    <?php endif; ?>
    <div class="p-custom-post-sample__pager">
        <?php get_template_part('component/pager'); ?>
    </div>
</div>
