<?php

add_action('pre_get_posts', 'sugiPreGetPosts');
function sugiPreGetPosts($query)
{
    global $post;
    //管理画面,メインクエリに干渉しないために必須
    if (is_admin() || ! $query->is_main_query()) {
        return;
    }
    if ($query->is_home() || $query->is_archive()) {
        $query->set('posts_per_page', -1);
        $query->set('orderby', 'post_date');
        $query->set('order', 'DESC');
        // $tax_query = array(
        // array(
        //   'taxonomy'  => 'pickups',
        //   'terms'     => 'pickup',
        //   'operator'  => 'NOT IN',
        // ),
        // );
        // $query->set('tax_query', $tax_query);
    }
}

// https://qiita.com/_shogo_/items/41b9c0abeca49bb0283c
