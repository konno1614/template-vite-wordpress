<?php
/*---------------------------------------------------------*/
/* 管理画面の左メニュー
/*---------------------------------------------------------*/
function remove_menus()
{
    global $menu;
    //unset($menu[2]);    // ダッシュボード
    //unset($menu[4]);    // メニューの線1
    //unset($menu[5]);    // 投稿
    //unset($menu[10]);   // メディア
    unset($menu[15]);     // リンク
    //unset($menu[20]);   // ページ
    unset($menu[25]);     // コメント
    // unset($menu[59]);  // メニューの線2
    //unset($menu[60]);   // テーマ
    //unset($menu[65]);   // プラグイン
    //unset($menu[70]);   // プロフィール
    //unset($menu[75]);   // ツール
    //unset($menu[80]);   // 設定
    //unset($menu[90]);   // メニューの線3
    global $current_user;
    get_currentuserinfo();
    if ($current_user->user_login == "test") {
        // remove_menu_page( 'index.php' );               //ダッシュボードを隠します
        remove_menu_page('edit.php');                   //投稿メニューを隠します
        remove_menu_page('upload.php');                 //メディアを隠します
        remove_menu_page('edit.php?post_type=page');    //ページ追加を隠します
        remove_menu_page('edit-comments.php');          //コメントメニューを隠します
        remove_menu_page('themes.php');                 //外観メニューを隠します
        remove_menu_page('plugins.php');                //プラグインメニューを隠します
        remove_menu_page('tools.php');                  //ツールメニューを隠します
        remove_menu_page('options-general.php');        //設定メニューを隠します
        remove_menu_page('users.php');                  //設定メニューを隠します
        remove_menu_page('edit.php?post_type=acf-field-group');    //設定メニューを隠します
        remove_menu_page('admin.php?page=gas-price');   //設定メニューを隠します
        remove_submenu_page('index.php', 'update-core.php');
    }
}
add_action('admin_menu', 'remove_menus');



/*---------------------------------------------------------*/
/* 固定ページの表示設定
/*---------------------------------------------------------*/
function my_remove_post_support()
{
    // remove_post_type_support('page','title');           // タイトル
    remove_post_type_support('page', 'editor');          // 本文
    remove_post_type_support('page', 'author');            // 作成者
    remove_post_type_support('page', 'thumbnail');         // アイキャッチ画像
    remove_post_type_support('page', 'excerpt');           // 抜粋
    remove_post_type_support('page', 'trackbacks');        // トラックバック
    remove_post_type_support('page', 'custom-fields');     // カスタムフィールド
    remove_post_type_support('page', 'comments');          // コメント
    remove_post_type_support('page', 'revisions');         // リビジョン
    // remove_post_type_support('page', 'page-attributes');    // ページ属性
    // remove_post_type_support('page','post-formats');    // 投稿フォーマット
}
add_action('init', 'my_remove_post_support');



/*---------------------------------------------------------*/
/* 管理画面固定ページにスラッグ
/*---------------------------------------------------------*/
function add_page_columns_name($columns)
{
    $columns['slug'] = "スラッグ";
    return $columns;
}
function add_page_column($column_name, $post_id)
{
    if ($column_name == 'slug') {
        $post = get_post($post_id);
        $slug = $post->post_name;
        echo attribute_escape($slug);
    }
}
add_filter('manage_pages_columns', 'add_page_columns_name');
add_action('manage_pages_custom_column', 'add_page_column', 10, 2);



/*---------------------------------------------------------*/
/* 管理画面に説明文
/*---------------------------------------------------------*/
// add_action( 'edit_form_after_editor', 'after_editor' );
// function after_editor() {
//   echo '<p>画像を半分にする:imgタグに.img-half</p>';
// }
