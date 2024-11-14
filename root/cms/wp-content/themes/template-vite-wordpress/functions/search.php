<?php

// 以下sugimura追記
// カスタム投稿要の検索結果ページ
add_filter('template_include','custom_search_template');
function custom_search_template($template){
  if ( is_search() ){
    $post_types = get_query_var('post_type');
    foreach ( (array) $post_types as $post_type )
    $templates[] = "search-{$post_type}.php";
    $templates[] = 'search.php';
    $template = get_query_template('search',$templates);
  }
    return $template;
}

// カスタムフィールドの内容を検索にヒットさせる
function cf_search_join( $join ) {
  global $wpdb;
  if ( is_search() ) {
    $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
  }
  return $join;
}
add_filter( 'posts_join', 'cf_search_join' );

function cf_search_where( $where ) {
  global $wpdb;
  if ( is_search() ) {
    $where = preg_replace(
      "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
      "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where );
    $where .= " AND (" .$wpdb->postmeta. ".meta_key NOT LIKE 'b_office_zip')";
  }
  return $where;
}
add_filter( 'posts_where', 'cf_search_where' );




function cf_search_distinct( $where ) {
  global $wpdb;
  if ( is_search() ) {
    return "DISTINCT";
  }
  return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

// 検索対象を『タイトルのみ』にする
function __search_by_title_only( $search, & $wp_query ) {
  global $wpdb;
  if ( empty( $search ) )
    return $search; // skip processing - no search term in query
  $q = $wp_query->query_vars;
  $n = !empty( $q[ 'exact' ] ) ? '' : '%';
  $search =
    $searchand = '';
  foreach ( ( array )$q[ 'search_terms' ] as $term ) {
    $term = esc_sql( like_escape( $term ) );
    $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
    $searchand = ' AND ';
  }
  if ( !empty( $search ) ) {
    $search = " AND ({$search}) ";
    if ( !is_user_logged_in() )
      $search .= " AND ($wpdb->posts.post_password = '') ";
  }
  return $search;
}

// 値をセレクトボックスに
function kaiza_form_select_filter($tag) {
  $formName = 'contact_type'; //プルダウン名
  if ( ! is_array( $tag ) )
    return $tag;
  if( isset($_GET[$formName]) ) {
    $name = $tag['name'];
    if( $name === $formName ) {
      if( is_array( $tag['values'] ) ) {
        $index = $_GET[$formName];
        if( $index !== false ) {
          $tag['options'][$key] = 'default:' . $index; //デフォルト値設定
        }
      }
    }
  }
  return $tag;
}
add_filter( 'wpcf7_form_tag', 'kaiza_form_select_filter', 11, 2);


// 送信メールアドレス書換
function my_wpcf7_before_send_mail($cf7) {

  // 条件分岐が効いていない？
  // if(!is_singular('branch')) return;

  // メール送信に関する情報を取得
  $mail = $cf7->prop('mail');

  if ( $submission = WPCF7_Submission::get_instance() ) {

    // 送信データを取得
    $posted_data = $submission->get_posted_data();

    // 問い合わせ種別を格納
    $contact_type_array = $posted_data['contact_type'];

    $contact_type = '';

    foreach ($contact_type_array as $key => $value) {
      $contact_type = $value;
    }

    $post_id = $posted_data['p_id'];

    // 条件分岐
    if($contact_type == 'お引越し（開栓/閉栓）など -再開栓・一時休止・名義変更含む-') {
      $eneos_furiwake_mail = get_field('b_mail_jigyosyo', $post_id);
    }elseif($contact_type == 'お支払い方法変更依頼 -クレジット・口座振替-') {
      $eneos_furiwake_mail = get_field('b_mail_jigyosyo', $post_id);
    }elseif($contact_type == 'ガス設備の法定保安点検 -ご依頼/日程変更-') {
      $eneos_furiwake_mail = get_field('b_mail_jigyosyo', $post_id);
    }elseif($contact_type == 'ガス・石油機器について -購入/工事/修理-') {
      $eneos_furiwake_mail = get_field('b_mail_jigyosyo', $post_id);
    }elseif($contact_type == 'ご意見・ご要望') {
      $eneos_furiwake_mail = get_field('b_mail_jigyosyo', $post_id);
      $eneos_furiwake_bcc = get_field('add_bcc_mail', 'option');
    }else{
      $eneos_furiwake_mail = $mail['recipient'];
    }

  }

  // メールアドレスの上書き
  $mail['recipient'] = $eneos_furiwake_mail;
  if($eneos_furiwake_bcc) {
    $mail['additional_headers'] .= "\n".$eneos_furiwake_bcc;
  }

  // 情報を再セット
  $cf7->set_properties( array( 'mail' => $mail ));
  return $cf7;
}
add_action('wpcf7_before_send_mail', 'my_wpcf7_before_send_mail', 1, 10);


// branchを404 要フラッシュ
add_filter( 'branch_rewrite_rules', '__return_empty_array' );



// 表示用郵便番号フォーマット
function my_format_zip($zip) {
  return substr_replace($zip, '-', 3, 0);
}


// リンク用電話番号フォーマット
function my_link_format_tel($tel) {
  return str_replace('-', '', $tel);
}