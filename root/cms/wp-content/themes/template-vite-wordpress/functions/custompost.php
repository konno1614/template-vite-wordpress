<?php
function create_custom_post_type_and_taxonomies()
{
    // カスタム投稿タイプの登録
    register_post_type('custom-post-sample', array(
        'labels' => array(
            'name' => __('カスタム投稿サンプル一覧'),
            'singular_name' => __('カスタム投稿サンプル'),
            'add_new' => __('新規カスタム投稿サンプル', 'book'),
            'add_new_item' => __('新規カスタム投稿サンプルを追加'),
            'edit_item' => __('カスタム投稿サンプルを編集する'),
            'new_item' => __('新しいカスタム投稿サンプル'),
            'view_item' => __('カスタム投稿サンプルを表示する'),
            'search_items' => __('カスタム投稿サンプルを検索'),
            'not_found' => __('カスタム投稿サンプルはありません'),
            'not_found_in_trash' => __('ゴミ箱にカスタム投稿サンプルはありません'),
            'parent_item_colon' => ''
        ),
        'public' => true,
        'hierarchical' => true,
        'has_archive' => true, // アーカイブページを持つ
        'rewrite' => array('slug' => 'custom-post-sample'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-tag',
        'taxonomies' => array('custom-post-sample-category', 'custom-post-sample-tag') // カスタムタクソノミーを指定
    ));

    // カスタムタクソノミーの登録（カテゴリー）
    register_taxonomy('custom-post-sample-category', 'custom-post-sample', array(
        'hierarchical' => true, // trueだと親子関係が使用可能。falseで使用不可
        'update_count_callback' => '_update_post_term_count',
        'labels' => array(
            'name' => 'カスタム投稿サンプル-カテゴリー',
            'singular_name' => 'カスタム投稿サンプル-カテゴリー',
            'search_items' => __('カテゴリーを検索'),
            'all_items' => __('すべてのカテゴリー'),
            'parent_item' => __('親カテゴリー'),
            'parent_item_colon' => __('親カテゴリー:'),
            'edit_item' => __('カテゴリーを編集'),
            'update_item' => __('カテゴリーを更新'),
            'add_new_item' => __('新規カテゴリーを追加'),
            'new_item_name' => __('新しいカテゴリー名'),
            'menu_name' => __('カテゴリー')
        ),
        'rewrite' => array('slug' => 'custom-post-sample-category'),
        'show_admin_column' => true,
        'show_in_rest' => true,
    ));

    // カスタムタクソノミーの登録（タグ）
    register_taxonomy('custom-post-sample-tag', 'custom-post-sample', array(
        'hierarchical' => false, // タグは階層構造を持たない
        'update_count_callback' => '_update_post_term_count',
        'labels' => array(
            'name' => 'カスタム投稿サンプル-タグ',
            'singular_name' => 'カスタム投稿サンプル-タグ',
            'search_items' => __('タグを検索'),
            'all_items' => __('すべてのタグ'),
            'edit_item' => __('タグを編集'),
            'update_item' => __('タグを更新'),
            'add_new_item' => __('新規タグを追加'),
            'new_item_name' => __('新しいタグ名'),
            'menu_name' => __('タグ')
        ),
        'rewrite' => array('slug' => 'custom-post-sample-tag'),
        'show_admin_column' => true,
        'show_in_rest' => true,
    ));
}
add_action('init', 'create_custom_post_type_and_taxonomies');


// 一覧ページに表示する投稿数
function modify_custom_posts_per_page($query)
{
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('custom-post-sample')) {
        $query->set('posts_per_page', -1);
    }
}
add_action('pre_get_posts', 'modify_custom_posts_per_page');


// 投稿&カスタム投稿ごとの管理画面のアイキャッチに説明文を追加
add_filter('admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction($content)
{
    $screen = get_current_screen();
    if ($screen->post_type == '_post') { // 通常投稿
        $content .= '<p>推奨サイズ：横900px x 縦600px</p>';
    } elseif ($screen->post_type == 'custom-post-sample') { // カスタム投稿
        $content .= '<p>推奨サイズ：横900px x 縦900px</p>';
    }
    return $content;
}
