<?php
// 現在のページ番号を取得
$current_page = max(1, get_query_var('paged'));

// ページネーションHTMLを取得
$paginationhtml = get_the_posts_pagination(
    array(
        'mid_size'           => 2, // 現在のページ番号の前後に表示するページ番号の数
        'screen_reader_text' => ' ', // スクリーンリーダーテキストを空にして視覚的な表示を防ぐ
        'prev_next'          => false, // 次へ・前へリンクを無効化
        'class'              => 'c-pager', // navタグに追加する任意のクラス
    )
);

// 現在のページリンクが無い場合、手動でリンクを追加する
$paginationhtml = preg_replace('/\<span aria-current="page"(.*?)\>(.*?)\<\/span\>/ui', '<a href="' . get_pagenum_link($current_page) . '" class="page-numbers current-page">$2</a>', $paginationhtml);

// screen-reader-textを削除
$paginationhtml = preg_replace('/\<h2 class=\"screen-reader-text\"\>(.*?)\<\/h2\>/ui', '', $paginationhtml);

// ページネーションHTMLを表示
echo $paginationhtml;
