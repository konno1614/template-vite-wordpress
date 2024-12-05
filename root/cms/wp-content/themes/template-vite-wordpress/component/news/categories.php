<div class="p-news__categories">
    <ul>
        <li class="<?php echo is_category() ? '' : 'all'; ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>news/">すべて</a>
        </li>
        <?php if (have_posts()) : ?>
            <?php wp_list_categories('title_li=&order=ASC'); ?>
        <?php endif; ?>
    </ul>
</div>
