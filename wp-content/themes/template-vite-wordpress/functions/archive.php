<?php
function post_has_archive($args, $post_type)
{
    if ('post' == $post_type) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'news';
        $args['label'] = 'お知らせ';
        $args['order'] = 'DESC';
        $args['orderby'] = 'post_date';
    }
    return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

function modify_posts_per_page($query)
{
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('post')) {
        $query->set('posts_per_page', 3);  // 一覧ページに表示する投稿数
        $query->set('orderby', 'post_date');
        $query->set('order', 'DESC');
    }
}
add_action('pre_get_posts', 'modify_posts_per_page');


/*---------------------------------------------------------*/
/* ACF設定>特定の記事で重要なお知らせが真にするならば、他の投稿は偽にする
/*---------------------------------------------------------*/
function update_true_false_field($post_id)
{
    if (get_post_type($post_id) != 'post') {
        return;
    }
    $is_true = get_field('important', $post_id);
    if ($is_true) {
        $args = array(
            'post_type'      => 'post',
            'post__not_in'   => array($post_id),
            'meta_query'     => array(
                array(
                    'key'   => 'important',
                    'value' => '1',
                )
            )
        );
        $other_posts = new WP_Query($args);
        if ($other_posts->have_posts()) {
            while ($other_posts->have_posts()) {
                $other_posts->the_post();
                update_field('important', false, get_the_ID());
            }
            wp_reset_postdata();
        }
    }
}
add_action('save_post', 'update_true_false_field');
