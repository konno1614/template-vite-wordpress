<ul>
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
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'order' => 'DESC',
                'orderby' => 'date',
            );
            $first_post_query = new WP_Query($args);
            if ($first_post_query->have_posts()) {
                while ($first_post_query->have_posts()) {
                    $first_post_query->the_post();
                    $first_post_title = get_the_title();
                    $first_post_link = get_permalink();
                    echo "<a href='$first_post_link'>Next</a>";
                }
                wp_reset_postdata();
            }
            ?>
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
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'order' => 'ASC',
                'orderby' => 'date',
            );
            $first_post_query = new WP_Query($args);
            if ($first_post_query->have_posts()) {
                while ($first_post_query->have_posts()) {
                    $first_post_query->the_post();
                    $first_post_title = get_the_title();
                    $first_post_link = get_permalink();
                    echo "<a href='$first_post_link'>Prev</a>";
                }
                wp_reset_postdata();
            }
            ?>
        <?php endif; ?>
    </li>
</ul>
