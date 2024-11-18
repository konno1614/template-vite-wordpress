<?php get_header(); ?>

<p>archive-product.php</p>

<div class="p-product">
    <div class="l-inner">
        <section class="p-product__category">
            <ul class="c-grid">
                <li <?php if (is_post_type_archive("product")): ?> class="current" <?php endif; ?>>
                    <a href="<?php echo esc_url(home_url('/')); ?>product/">
                        <p>All items</p>
                        <p>すべての商品</p>
                    </a>
                </li>
                <?php
                $current_term_id = get_queried_object_id();
                $cat_all = get_terms("product-cat", "fields=all&hide_empty=true");
                foreach ($cat_all as $value):
                ?>
                    <li>
                        <a href="<?php echo get_category_link($value->term_id); ?>">
                            <p><?php echo term_description($value, 'product-cat'); ?></p>
                            <p><?php echo $value->name; ?></p>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="p-product__list">
            <?php if (have_posts()): ?>
                <ul class="c-grid">
                    <?php while (have_posts()): the_post();
                        $ttlEn = get_field('product-ttlEn');
                        $ttlJp = get_field('product-ttlJp');
                    ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <p>▶︎サムネイル：<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail('full'); ?><?php else : ?><img src="<?php echo get_template_directory_uri(); ?>/img/dummy.jpg" width="" height="" alt="" loading="lazy" decoding="async" /><?php endif; ?></p>
                                <p>▶︎商品名-En：<?php echo $ttlEn; ?></p>
                                <p>▶︎商品名-Jp：<?php echo $ttlJp; ?></p>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </section>

    </div>
</div>

<?php get_footer(); ?>
