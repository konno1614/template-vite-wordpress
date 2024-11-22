<ul class="c-prevnext">
    <li class="prev">
        <?php
        $prev_post = get_previous_post();
        $next_link = '';
        if (!empty($prev_post)) {
            $next_link = get_permalink($prev_post->ID);
        }
        ?>
        <?php if (!empty($next_link)): ?>
            <a href="<?php echo esc_url($next_link); ?>">前の記事</a>
        <?php else: ?>
        <?php endif; ?>
    </li>
    <li class="index"><a href="<?php echo esc_url(home_url('/')); ?>news/"></a></li>
    <li class="next">
        <?php
        $next_post = get_next_post();
        $prev_link = '';
        if (!empty($next_post)) {
            $prev_link = get_permalink($next_post->ID);
        }
        ?>
        <?php if (!empty($prev_link)): ?>
            <a href="<?php echo esc_url($prev_link); ?>">次の記事</a>
        <?php else: ?>
        <?php endif; ?>
    </li>
</ul>
