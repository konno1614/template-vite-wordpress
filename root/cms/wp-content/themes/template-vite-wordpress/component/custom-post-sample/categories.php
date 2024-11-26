<div class="p-custom-post-sample__categories">
    <ul class="c-grid">
        <li <?php if (is_post_type_archive("custom-post-sample")): ?> class="current" <?php endif; ?>>
            <a href="<?php echo esc_url(home_url('/')); ?>custom-post-sample/">
                <p>すべて</p>
            </a>
        </li>
        <?php
        $current_term_id = get_queried_object_id();
        $cat_all = get_terms("custom-post-sample-category", "fields=all&hide_empty=true");
        foreach ($cat_all as $value):
        ?>
            <li>
                <a href="<?php echo get_category_link($value->term_id); ?>">
                    <p><?php echo $value->name; ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
