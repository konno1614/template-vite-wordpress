<?php
/*--------------------------------------------------------------*/
/* カスタム投稿タイプ */
/*--------------------------------------------------------------*/
add_action('init', 'create_post_type');
function create_post_type()
{
    register_post_type(
        'product', //カスタム投稿タイプ名を指定
        array(
            'labels' => array(
                'name' => __('商品一覧'),
                'singular_name' => __('商品'),
                'add_new' => __('新規商品', 'book'),
                'add_new_item' => __('新規商品を追加'),
                'edit_item' => __('商品を編集する'),
                'new_item' => __('新しい商品'),
                'view_item' => __('商品を表示する'),
                'search_items' => __('商品を検索'),
                'not_found' =>  __('商品はありません'),
                'not_found_in_trash' => __('ゴミ箱に商品はありません'),
                'parent_item_colon' => ''
            ),
            'public' => true,
            'hierarchical' => true,
            'has_archive' => true, /* アーカイブページを持つ */
            'menu_icon' => 'dashicons-tag',
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
    register_taxonomy(
        'product-cat', /* タクソノミーの名前 */
        'product', /* 使用するカスタム投稿タイプ名 */
        array(
            'hierarchical' => true, /* trueだと親子関係が使用可能。falseで使用不可 */
            'update_count_callback' => '_update_post_term_count',
            'label' => '商品-カテゴリー',
            'singular_label' => '商品-カテゴリー',
            'has_archive' => true, /* アーカイブページを持つ */
            'public' => true,
            'show_ui' => true
        )
    );
}



// ターム説明文からpとbr排除
remove_filter('term_description', 'wpautop');



// 商品の新規追加カテゴリー削除
function my_admin_style()
{
    echo '<style>
    ul#product-cat-tabs,
    div#product-cat-adder
    {
    display:none;
    }
    </style>' . PHP_EOL;
}
add_action('admin_print_styles', 'my_admin_style');



// 投稿 カテゴリーのチェックボックスをラジオボタンに
add_action('admin_print_footer_scripts', 'select_one_category');
function select_one_category()
{
?>
    <script type="text/javascript">
        jQuery(function($) {

            // 投稿画面
            $('#taxonomy-category input[type=checkbox]').each(function() {
                $(this).replaceWith($(this).clone().attr('type', 'radio'));
            });
            // 一覧画面
            var category_type_checklist = $('#category-all .categorychecklist input[type=checkbox]');
            category_type_checklist.click(function() {
                $(this).parents('#category-all .categorychecklist').find(' input[type=checkbox]').attr('checked', false);
                $(this).attr('checked', true);
            });
        });
    </script>
<?php
}



// カスタム投稿タクソノミー カテゴリーのチェックボックスをラジオボタンに
add_action('admin_print_footer_scripts', 'select_to_radio_product');
function select_to_radio_product()
{
?>
    <script type="text/javascript">
        jQuery(function($) {
            // 投稿画面
            $('#taxonomy-product-cat input[type=checkbox]').each(function() {
                $(this).replaceWith($(this).clone().attr('type', 'radio'));
            });
            // 一覧画面
            var productcat_checklist = $('.product-cat-checklist input[type=checkbox]');
            productcat_checklist.click(function() {
                $(this).parents('.product-cat-checklist').find(' input[type=checkbox]').attr('checked', false);
                $(this).attr('checked', true);
            });
        });
    </script>
<?php
}



// 投稿_カスタム投稿ごとの管理画面のアイキャッチに説明文を追加
add_filter('admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction($content)
{
    $screen = get_current_screen();
    if ($screen->post_type == '_post') { //投稿
        $content .= '<p>推奨サイズ：横900px x 縦600px</p>';
    } elseif ($screen->post_type == 'product') { //カスタム投稿
        $content .= '<p>推奨サイズ：横900px x 縦900px</p>';
    }
    return $content;
}
