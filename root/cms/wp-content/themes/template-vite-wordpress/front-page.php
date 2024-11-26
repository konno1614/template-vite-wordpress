<?php get_header(); ?>

<p style="text-align: center; color: red;">front-page.php</p>

<div class="p-index">
    <div class="l-inner">
        <section class="p-index__section">
            <h2 class="c-title">Search</h2>
            <?php
            get_search_form()
            ?>
        </section>
        <section class="p-index__section">
            <h2 class="c-title">Pages</h2>
            <ul>
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>sample/">Sample</a>
                </li>
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>contact/">Contact</a>
                </li>
            </ul>
        </section>
        <section class="p-index__section">
            <h2 class="c-title">News</h2>
            <?php
            $news_args = array(
                'post_type' => 'post', // 通常の投稿タイプ
                'posts_per_page' => 3, // 最大3件
                // 'category_name' => 'notice' // 特定カテゴリーの投稿を表示する場合
            );
            $news_query = new WP_Query($news_args);
            if ($news_query->have_posts()): ?>
                <ul class="p-news__list p-news__list--min">
                    <?php while ($news_query->have_posts()): $news_query->the_post(); ?>
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
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <p class="p-custom-post-sample__not-yet">投稿はまだありません。</p>
            <?php endif; ?>
        </section>
        <section class="p-index__section">
            <h2 class="c-title">Custom Post Sample</h2>
            <?php
            $custom_post_args = array(
                'post_type' => 'custom-post-sample', // カスタム投稿タイプ（custom-post-sample）
                'posts_per_page' => 3, // 最大3件
                // 'tax_query' => array(
                //     array(
                //         'taxonomy' => 'custom-post-sample-category',
                //         'field' => 'slug',
                //         'terms' => 'category01', // 特定カテゴリーの投稿を表示する場合
                //     ),
                // ),
            );
            $custom_post_query = new WP_Query($custom_post_args);
            if ($custom_post_query->have_posts()): ?>
                <ul class="p-custom-post-sample__list p-custom-post-sample__list--min">
                    <?php while ($custom_post_query->have_posts()): $custom_post_query->the_post(); ?>
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
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <p class="p-custom-post-sample__not-yet">投稿はまだありません。</p>
            <?php endif; ?>
        </section>
    </div>
</div>

<?php get_footer(); ?>
