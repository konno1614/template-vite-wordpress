<?php

// DNS プリフェッチ
// WordPress4.6から挿入されるようになりました。
// 外部ドメインの名前解決を事前に行い、表示速度を上げる。
// 外部リンクやSNSボタンなどを設置している場合に有効。
// ただし、httpsに対しては効果がない。
function remove_dns_prefetch($hints, $relation_type)
{
    if ('dns-prefetch' === $relation_type) {
        return array_diff(wp_dependencies_unique_hosts(), $hints);
    }
    return $hints;
}
add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);



// emoji
function disable_emoji()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'disable_emoji');



// 一部機能・プラグインを除外しrest apiを無効
function deny_restapi_except_plugins($result, $wp_rest_server, $request)
{
    $namespaces = $request->get_route();

    //oembedの除外
    if (strpos($namespaces, 'oembed/') === 1) {
        return $result;
    }
    //Jetpackの除外
    if (strpos($namespaces, 'jetpack/') === 1) {
        return $result;
    }
    //Contact Form7の除外
    if (strpos($namespaces, 'contact-form-7/') === 1) {
        return $result;
    }

    return new WP_Error('rest_disabled', __('The REST API on this site has been disabled.'), array('status' => rest_authorization_required_code()));
}
add_filter('rest_pre_dispatch', 'deny_restapi_except_plugins', 10, 3);



// ローカルアプリのブログ投稿ツールを利用しない場合はどちらも非表示でOK
// EditURIを非表示にする
remove_action('wp_head', 'rsd_link');
// wlwmanifestを非表示にする
remove_action('wp_head', 'wlwmanifest_link');



// WordPressのバージョン表示
remove_action('wp_head', 'wp_generator');



// canonical
remove_action('wp_head', 'rel_canonical');



// shortlink
remove_action('wp_head', 'wp_shortlink_wp_head');



// oEmbed
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
