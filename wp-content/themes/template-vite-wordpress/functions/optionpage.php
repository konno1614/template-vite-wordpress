<?php

if(function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title' => 'CP推移設定',
    'menu_title' => 'CP推移設定',
    'menu_slug' => 'cp-chart',
    'capability' => 'edit_posts',
    'parent_slug' => '',
    'position' => 4.5,
    'icon_url' => 'dashicons-chart-line',
    'redirect' => false
  ));
  acf_add_options_page(array(
    'page_title' => 'ガス料金設定',
    'menu_title' => 'ガス料金設定',
    'menu_slug' => 'gas-price',
    'capability' => 'edit_posts',
    'parent_slug' => '',
    'position' => 4.5,
    'icon_url' => 'dashicons-chart-line',
    'redirect' => false
  ));
  acf_add_options_page(array(
    'page_title' => 'ガス料金表',
    'menu_title' => 'ガス料金表',
    'menu_slug' => 'gasprice-table',
    'capability' => 'edit_posts',
    'parent_slug' => '',
    'position' => 4.5,
    'icon_url' => 'dashicons-chart-line',
    'redirect' => false
  ));
}