<?php

/*-----------------------------------------------------------------*/
/* 各種設定ファイル
/*-----------------------------------------------------------------*/
get_template_part('functions/wpheader'); // wpheader出力制御
get_template_part('functions/enqueue'); // css,js読み込み
get_template_part('functions/image'); // 画像
get_template_part('functions/pregetpost'); // メインクエリ
// get_template_part('functions/search'); // 検索
get_template_part('functions/pankuzu'); // パンくず
// get_template_part('functions/mobile'); // pcとモバイル
// get_template_part('functions/optionpage'); // optionpage
get_template_part('functions/custompost'); // カスタム投稿
get_template_part('functions/adminmenu'); // 管理画面
get_template_part('functions/editor'); // エディター
get_template_part('functions/seo'); // seo
// get_template_part('functions/filesize'); // ファイルサイズ併記
get_template_part('functions/contactform'); // お問い合わせ
get_template_part('functions/cf7'); // cf7
// get_template_part('functions/manualpdf'); // manualpdf
get_template_part('functions/archive'); // アーカイブページ有効化


/*-----------------------------------------------------------------*/
/* 共通非表示_無効設定
/*-----------------------------------------------------------------*/
// gutenberg 無効化
add_filter('use_block_editor_for_post', '__return_false');
// gutenberg_css 無効化
add_action('wp_enqueue_scripts', 'remove_block_library_style');
function remove_block_library_style()
{
    wp_dequeue_style('wp-block-library');
}


// delete JetPack OGP tags
add_filter('jetpack_enable_open_graph', '__return_false');



// WordPressバージョン5.9から出力される[global-styles-inline-css]を削除
// WordPressバージョン6.1から出力される[classic-theme.min.css]を削除
add_action('wp_enqueue_scripts', 'remove_unuse_css');
function remove_unuse_css()
{
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}



// セキュリティ-author情報非表示
function disable_author_archive_query()
{
    if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
        wp_safe_redirect(home_url());
        exit;
    }
}
add_action('init', 'disable_author_archive_query');



/*-----------------------------------------------------------------*/
/* youtube iframe
/*-----------------------------------------------------------------*/
function custom_youtube_oembed($code)
{
    if (strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false) {
        $html = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&showinfo=0&rel=0", $code);
        $html = preg_replace('/ width="\d+"/', '', $html);
        $html = preg_replace('/ height="\d+"/', '', $html);
        $html = '<div class="youtube">' . $html . '</div>';

        return $html;
    }
    return $code;
}
add_filter('embed_handler_html', 'custom_youtube_oembed');
add_filter('embed_oembed_html', 'custom_youtube_oembed');



/*-----------------------------------------------------------------*/
/* 404 リダイレクト
/*-----------------------------------------------------------------*/
add_action('template_redirect', 'is404_redirect_home');
function is404_redirect_home()
{
    if (is_404()) {
        wp_safe_redirect(home_url('/'));
        exit();
    }
}



/*-----------------------------------------------------------------*/
/* 投稿ページのパーマリンクをカスタマイズ
/*-----------------------------------------------------------------*/
function add_article_post_permalink($permalink)
{
    $permalink = '/news' . $permalink;
    return $permalink;
}
add_filter('pre_post_link', 'add_article_post_permalink');

function add_article_post_rewrite_rules($post_rewrite)
{
    $return_rule = array();
    foreach ($post_rewrite as $regex => $rewrite) {
        $return_rule['news/' . $regex] = $rewrite;
    }
    return $return_rule;
}
add_filter('post_rewrite_rules', 'add_article_post_rewrite_rules');
