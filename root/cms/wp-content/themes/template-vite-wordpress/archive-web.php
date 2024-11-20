<?php get_header(); ?>

<p>archive-web.php</p>

<div class="p-web">
    <div class="l-inner">
        <section class="p-web__category">
            <ul class="c-grid">
                <li <?php if (is_post_type_archive("web")): ?> class="current" <?php endif; ?>>
                    <a href="<?php echo esc_url(home_url('/')); ?>web/">
                        <p>All items</p>
                        <p>すべてのWEB制作</p>
                    </a>
                </li>
                <?php
                $current_term_id = get_queried_object_id();
                $cat_all = get_terms("web-cat", "fields=all&hide_empty=true");
                foreach ($cat_all as $value):
                ?>
                    <li>
                        <a href="<?php echo get_category_link($value->term_id); ?>">
                            <p><?php echo term_description($value, 'web-cat'); ?></p>
                            <p><?php echo $value->name; ?></p>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="p-web__list">
            <?php if (have_posts()): ?>
                <ul class="c-grid">
                    <?php while (have_posts()): the_post();
                        $ttlEn = get_field('web-ttlEn');
                        $ttlJp = get_field('web-ttlJp');
                    ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <p>▶︎サムネイル：<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail('full'); ?><?php else : ?><img src="<?php echo get_template_directory_uri(); ?>/img/dummy.jpg" width="" height="" alt="" loading="lazy" decoding="async" /><?php endif; ?></p>
                                <p>▶︎WEB制作名-En：<?php echo $ttlEn; ?></p>
                                <p>▶︎WEB制作名-Jp：<?php echo $ttlJp; ?></p>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>まだ投稿はありません。</p>
            <?php endif; ?>
            <?php get_template_part('component/pager'); ?>
        </section>

    </div>
</div>

<?php get_footer(); ?>
