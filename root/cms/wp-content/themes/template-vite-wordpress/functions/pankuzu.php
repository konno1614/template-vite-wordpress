<?php
if (! function_exists('my_breadcrumbs')) {
    function my_breadcrumbs()
    {
        echo '<nav><ul>';

        if (is_front_page()) {
            // トップページの場合
            echo '<li class="bc-item"><span>トップ</span></li>';
        } else {
            // トップページ以外の場合、ホームリンクを表示
            echo '<li class="bc-item">' .
                '<a href="' . esc_url(home_url()) . '"><span>トップ</span></a>' .
                '</li>';
        }

        // ここで $wp_obj を取得
        $wp_obj = get_queried_object();

        // オブジェクトが正しく取得されない場合はエラーチェック
        if (!$wp_obj) {
            echo '</ul></nav>';
            return;
        }

        if (is_tax()) {
            $term = get_queried_object();
            if ($term) {
                $taxonomy = $term->taxonomy;
                $term_description = $term->description;

                // タクソノミーに関連するページへのリンクを生成
                $archive_link = esc_url(home_url()) . '/news';
                $archive_label = '最新情報';

                echo '<li class="bc-item"><a href="' . $archive_link . '"><span>' . esc_html($archive_label) . '</span></a></li>';
                echo '<li class="bc-item"><span>' . esc_html($term_description) . '</span></li>';
            }
        } elseif (is_attachment() && isset($wp_obj->post_title)) {
            // 添付ファイルページ
            $post_title = apply_filters('the_title', $wp_obj->post_title);
            echo '<li class="bc-item"><span>' . esc_html($post_title) . '</span></li>';
        } elseif (is_single() && isset($wp_obj->ID)) {
            // 投稿ページの場合
            $post_id = $wp_obj->ID;
            $post_type = $wp_obj->post_type;
            $post_title = apply_filters('the_title', $wp_obj->post_title);

            if ($post_type !== 'post') {
                // カスタム投稿タイプの場合
                $post_type_object = get_post_type_object($post_type);
                if ($post_type_object) {
                    $post_type_label = $post_type_object->labels->singular_name;
                    echo '<li class="bc-item">' .
                        '<a href="' . esc_url(get_post_type_archive_link($post_type)) . '">' .
                        '<span>' . esc_html($post_type_label) . '</span>' .
                        '</a>' .
                        '</li>';
                }
            } else {
                // 通常の投稿の場合、「News」を表示
                echo '<li class="bc-item"><a href="' . esc_url(get_post_type_archive_link($post_type)) . '">最新情報</a></li>';
            }

            // 投稿タイトル表示
            echo '<li class="bc-item"><span>' . esc_html(strip_tags($post_title)) . '</span></li>';
        } elseif ((is_page() || is_home()) && isset($wp_obj->ID)) {
            // 固定ページの場合
            $page_id = $wp_obj->ID;
            $page_title = get_the_title($page_id);

            // 親ページがあれば順番に表示
            if ($wp_obj->post_parent !== 0) {
                $parent_array = array_reverse(get_post_ancestors($page_id));
                foreach ($parent_array as $parent_id) {
                    $parent_link = esc_url(get_permalink($parent_id));
                    $parent_title = esc_html(get_the_title($parent_id));
                    echo '<li class="bc-item">' .
                        '<a href="' . $parent_link . '">' .
                        '<span>' . $parent_title . '</span>' .
                        '</a>' .
                        '</li>';
                }
            }
            // 現在のページタイトルを表示
            echo '<li class="bc-item"><span>' . esc_html(strip_tags($page_title)) . '</span></li>';
        } elseif (is_post_type_archive()) {
            // 投稿タイプアーカイブページ
            $post_type = get_post_type();
            $post_type_object = get_post_type_object($post_type);
            if ($post_type_object) {
                echo '<li class="bc-item"><span>' . esc_html($post_type_object->labels->singular_name) . '</span></li>';
            }
        } elseif (is_date()) {
            // 日付アーカイブ
            $year  = get_query_var('year');
            $month = get_query_var('monthnum');
            $day   = get_query_var('day');

            if ($day !== 0) {
                // 日別アーカイブ
                echo '<li class="bc-item">' .
                    '<a href="' . esc_url(get_year_link($year)) . '"><span>' . esc_html($year) . '年</span></a>' .
                    '</li>' .
                    '<li class="bc-item">' .
                    '<a href="' . esc_url(get_month_link($year, $month)) . '"><span>' . esc_html($month) . '月</span></a>' .
                    '</li>' .
                    '<li class="bc-item">' .
                    '<span>' . esc_html($day) . '日</span>' .
                    '</li>';
            } elseif ($month !== 0) {
                // 月別アーカイブ
                echo '<li class="bc-item"><a href="' . esc_url(home_url()) . '/news"><span>最新情報</span></a></li>' .
                    '<li class="bc-item">' .
                    '<a href="' . esc_url(get_year_link($year)) . '"><span>' . esc_html($year) . '年</span></a>' .
                    '</li>' .
                    '<li class="bc-item"><span>' . esc_html($month) . '月</span></li>';
            } else {
                // 年別アーカイブ
                echo '<li class="bc-item"><a href="' . esc_url(home_url()) . '/news"><span>最新情報</span></a></li>' .
                    '<li class="bc-item"><span>' . esc_html($year) . '年</span></li>';
            }
        } elseif (is_author() && isset($wp_obj->display_name)) {
            // 投稿者アーカイブ
            echo '<li class="bc-item"><span>' . esc_html($wp_obj->display_name) . ' の執筆記事</span></li>';
        } elseif (is_archive() && isset($wp_obj->term_id)) {
            // タームアーカイブ
            $term_name = $wp_obj->name;

            // 親タームがあれば順番に表示
            if ($wp_obj->parent !== 0) {
                $parent_array = array_reverse(get_ancestors($wp_obj->term_id, $wp_obj->taxonomy));
                foreach ($parent_array as $parent_id) {
                    $parent_term = get_term($parent_id, $wp_obj->taxonomy);
                    $parent_link = esc_url(get_term_link($parent_id, $wp_obj->taxonomy));
                    echo '<li class="bc-item">' .
                        '<a href="' . $parent_link . '"><span>' . esc_html($parent_term->name) . '</span></a>' .
                        '</li>';
                }
            }

            // ターム自身の表示
            echo '<li class="bc-item"><span>' . esc_html($term_name) . '</span></li>';
        } elseif (is_search()) {
            // 検索結果ページ
            echo '<li class="bc-item"><span>「' . esc_html(get_search_query()) . '」で検索した結果</span></li>';
        } elseif (is_404()) {
            // 404ページ
            echo '<li class="bc-item"><span>お探しの記事は見つかりませんでした。</span></li>';
        }

        echo '</ul></nav>';  // 冒頭に合わせた閉じタグ
    }
}
