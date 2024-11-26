<?php get_header(); ?>

<p style="text-align: center; color: red;">search.php</p>

<div class="p-search">
    <div class="l-inner">
        <h2 class="p-search__title"><?php the_search_query() ?>の検索結果</h2>
        <div class="p-search__contents">
            <?php if (have_posts()): ?>
                <ul class="p-search__list">
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
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <div class="p-search__no-posts">
                    <p>検索キーワードに該当する記事がありませんでした。</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="p-search__back">
            <a href="<?php echo esc_url(home_url('/')); ?>">トップページへ戻る</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
