<?php

/*---------------------------------------------------------*/
/* #1 全てのビジュアルエディターモードを無効化する
/*---------------------------------------------------------*/
function visual_editor_all_disable_script()
{
    add_filter('user_can_richedit', 'disable_visual_editor_filter');
}
function disable_visual_editor_filter()
{
    return false;
}
add_action('load-post.php', 'visual_editor_all_disable_script');
add_action('load-post-new.php', 'visual_editor_all_disable_script');

/*---------------------------------------------------------*/
/* #2 入力エディタ設定-ビジュアルモード
/* #1が無効の際は、当設定も無効
/*---------------------------------------------------------*/
add_filter('mce_buttons', 'remove_mce_buttons');
function remove_mce_buttons($buttons)
{
    $remove = array(
        'formatselect',  // フォーマット
        'bold',          // 太字
        'italic',          // イタリック
        'bullist',         // 番号なしリスト
        'numlist',         // 番号付きリスト
        'blockquote',    // 引用
        'alignleft',       // 左寄せ
        'aligncenter',     // 中央揃え
        'alignright',      // 右寄せ
        'link',          // リンクの挿入/編集
        'unlink',        // リンクの削除
        'wp_more',         // 「続きを読む」タグを挿入
        'wp_adv',          // ツールバー切り替え
        'dfw'              // 集中執筆モード
    );
    return array_diff($buttons, $remove);
}

/*---------------------------------------------------------*/
/* #3 カスタム投稿タイプ「product」-ビジュアルモード無効
/* #1が無効の際は、当設定も無効
/*---------------------------------------------------------*/
function disable_cf_visual_editor_mode()
{
    global $typenow;
    if ($typenow == 'product') {
        add_filter('user_can_richedit', 'disable_cf_visual_editor_mode_filter');
    }
}
function disable_cf_visual_editor_mode_filter()
{
    return false;
}
add_action('load-post.php', 'disable_cf_visual_editor_mode');
add_action('load-post-new.php', 'disable_cf_visual_editor_mode');



/*---------------------------------------------------------*/
/* 入力エディタ設定-テキストモード
/*---------------------------------------------------------*/
// function remove_html_editor_buttons($qt_init) {
//   $remove = array('bold'/*'link',*/,'blockquote','em','del','ul','ol','li','img','ins','code','more','dfw'); // ここに削除したいものを記述
//   $qt_init['buttons'] = implode(',', array_diff(explode(',', $qt_init['buttons']), $remove));
//   return $qt_init;
// }
// add_filter('quicktags_settings', 'remove_html_editor_buttons');



/*---------------------------------------------------------*/
/* 投稿,固定ページ,カスタム投稿 クイックタグ表示-テキストモード
/*---------------------------------------------------------*/
function default_quicktags($qtInit)
{
    $qtInit['buttons'] = ' '; // ここに必要なクイックタグのIDを記述 'link'
    // $qtInit['buttons'] = 'link';
    return $qtInit;
}
add_filter('quicktags_settings', 'default_quicktags', 10, 1);



/*---------------------------------------------------------*/
/* 投稿,固定ページ,カスタム投稿 指定可能クイックタグ表示
/*---------------------------------------------------------*/
add_action('admin_print_footer_scripts', function () {
    global $post;
    //   $allowed_post_types = array('post', 'page', 'product');
    $allowed_post_types = array('post');
    if (is_admin() && isset($post) && in_array($post->post_type, $allowed_post_types) && wp_script_is('quicktags')) {
        echo <<<EOF
        <script type="text/javascript">
            QTags.addButton('qt-midashi-h4', '文中のタイトル', '<h4>', '</h4>');
            QTags.addButton('qt-midashi-h5', '文中の小タイトル', '<h5>', '</h5>');
            QTags.addButton('qt-ul', 'リンク', '<a href="" target="_blank">', '</a>');
            QTags.addButton('qt-line', '水平線区切り', '<hr />');
        </script>
    EOF;
    }
}, 100);



/*---------------------------------------------------------*/
/* svg allow
/*---------------------------------------------------------*/
function allow_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_mime_types');



/*---------------------------------------------------------*/
/* 投稿 要素-非表示設定
/*---------------------------------------------------------*/
function my_remove_meta_boxes()
{
    remove_meta_box('postexcerpt', 'post', 'normal');      // 抜粋
    remove_meta_box('trackbacksdiv', 'post', 'normal');    // トラックバック
    // remove_meta_box('slugdiv','post','normal');        // スラッグ
    remove_meta_box('postcustom', 'post', 'normal');       // カスタムフィールド
    remove_meta_box('postimagediv', 'post', 'normal');    // アイキャッチ
    remove_meta_box('commentsdiv', 'post', 'normal');      // コメント
    // remove_meta_box('submitdiv','post','normal' );     // 公開
    // remove_meta_box('categorydiv','post','normal');    // カテゴリー
    remove_meta_box('tagsdiv-post_tag', 'post', 'normal'); // タグ
    remove_meta_box('commentstatusdiv', 'post', 'normal'); // ディスカッション
    remove_meta_box('authordiv', 'post', 'normal');        // 作成者
    remove_meta_box('revisionsdiv', 'post', 'normal');     // リビジョン
    remove_meta_box('formatdiv', 'post', 'normal');        // フォーマット
    // remove_meta_box('pageparentdiv', 'post', 'normal');    // 属性
}
add_action('admin_menu', 'my_remove_meta_boxes');


/*---------------------------------------------------------*/
/* imgをpタグで囲ませない
/*---------------------------------------------------------*/
function filter_ptags_on_images($content)
{
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');
