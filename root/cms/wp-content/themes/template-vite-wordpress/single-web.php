<?php get_header(); ?>

<p>single-web.php</p>



<div class="p-web-single">
    <div class="l-inner">
        <!-- カテゴリー -->
        <?php
        $post_id = get_the_ID();
        $cat_all = get_the_terms($post_id, "web-cat");
        foreach ($cat_all as $value):
        ?>
            <section class="p-webSingle__category">
                <p><?php echo term_description($value, 'web-cat'); ?></p>
            </section>
        <?php endforeach; ?>

        <!-- 投稿内容 -->
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post();
                $ttlEn = get_field('web-ttlEn');
                $ttlJp = get_field('web-ttlJp');
            ?>
                <section class="p-webSingle__detail">
                    <h2 class="c-title">▼管理画面の入力項目の出力確認</h2>
                    <p>▶︎サムネイル：<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail('full'); ?><?php else : ?><img src="<?php echo get_template_directory_uri(); ?>/img/dummy.jpg" width="" height="" alt="" loading="lazy" decoding="async" /><?php endif; ?></p>
                    <p>▶︎WEB制作名-En：<?php echo $ttlEn; ?></p>
                    <p>▶︎WEB制作名-Jp：<?php echo $ttlJp; ?></p>
                </section>
            <?php endwhile; ?>
        <?php else : ?>

        <?php endif; ?>

        <!-- 前後ボタン -->
        <?php get_template_part('component/prevnext'); ?>

        <!-- 関連する投稿 -->
        <?php
        $post_id = get_the_ID();
        $terms = get_the_terms($post_id, 'web-cat');
        $term_slugs = array();
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $term_slugs[] = $term->slug;
            }
        }
        $exclude_post_ids = array($post_id);
        $my_query = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'web',
            'post__not_in' => $exclude_post_ids,
            'tax_query' => array(
                array(
                    'taxonomy' => 'web-cat',
                    'terms'    => $term_slugs,
                    'field'    => 'slug',
                    'operator'    => 'IN',
                ),
            ),
            'orderby' => 'menu_order',
            'order' => 'DESC'
        ));
        if ($my_query->have_posts()) :
        ?>
            <section class="p-webSingle__related">
                <ul class="c-grid">
                    <?php while ($my_query->have_posts()) : $my_query->the_post();
                        $ttlEn = get_field('web-ttlEn');
                        $ttlJp = get_field('web-ttlJp');
                        $desc = get_field('web-desc');
                    ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <p>▶︎サムネイル：<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail('full'); ?><?php else : ?><img src="<?php echo get_template_directory_uri(); ?>/img/dummy.jpg" width="640" height="480" alt="" loading="lazy" decoding="async" /><?php endif; ?></p>
                                <p>▶︎WEB制作名-En：<?php echo $ttlEn; ?></p>
                                <p>▶︎WEB制作名-Jp：<?php echo $ttlJp; ?></p>
                                <p>▶︎WEB制作概要：<?php echo $desc; ?></p>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        <?php endif; ?>
    </div>
</div>


<?php get_footer(); ?>
