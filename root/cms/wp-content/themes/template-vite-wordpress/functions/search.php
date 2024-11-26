<?php
// newsとcustom-post-sampleのみ検索結果に表示させる
function search_filter($query)
{
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', array('post', 'custom-post-sample'));
    }
    return $query;
}
add_filter('pre_get_posts', 'search_filter');
