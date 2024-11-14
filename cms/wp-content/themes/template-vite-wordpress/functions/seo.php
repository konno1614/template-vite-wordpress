<?php

// ページタイトル
add_theme_support( 'title-tag' );

// canonical
function get_url() {
  return (is_ssl() ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}