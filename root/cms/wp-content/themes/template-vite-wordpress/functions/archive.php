<?php
// 通常投稿タイプの登録
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


// 一覧ページに表示する投稿数
function modify_posts_per_page($query)
{
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('post')) {
        $query->set('posts_per_page', -1);
        $query->set('orderby', 'post_date');
        $query->set('order', 'DESC');
    }
}
add_action('pre_get_posts', 'modify_posts_per_page');
