<?php

/**
 * 機能の拡張。
 * - タイトルタグを自動出力
 * - サムネイル機能解放
 *
 */
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails', ['post', 'page']);
  register_nav_menu('main-menu', 'Main Menu');
});

/**
 * css, js の読み込み。
 * - ress
 * - index.min.css (コンパイルされたもの)
 * - index.min.js (コンパイルされたもの)
 */
add_action('wp_enqueue_scripts', function () {
  $theme_dir = get_stylesheet_directory_uri();
  $hash = (new \DateTime())->format('YmdHis');
  $ress_slug = 'ress';
  $font_slug_base = 'm_plust_rounded_1c';
  $font_jp_slug = $font_slug_base . '_japan';
  $font_lt_slug = $font_slug_base . '_latin';
  wp_enqueue_style($ress_slug, $theme_dir . '/node_modules/ress/dist/ress.min.css', [], '5.0.2');
  wp_enqueue_style($font_jp_slug, $theme_dir . '/node_modules/@fontsource/m-plus-rounded-1c/japanese.css', [$ress_slug]);
  wp_enqueue_style($font_lt_slug, $theme_dir . '/node_modules/@fontsource/m-plus-rounded-1c/latin.css', [$ress_slug]);
  wp_enqueue_style('main_style', $theme_dir . '/assets/dist/index.min.css', [$ress_slug, $font_jp_slug, $font_lt_slug], $hash);
  wp_enqueue_script('main_script', $theme_dir . '/assets/dist/index.min.js', [], $hash, false);
});

/**
 * html タグにlang属性を付与する時(=language_attributes関数が使用される時)、prefix 属性を連結させて付与する。
 */
add_filter('language_attributes', function ($output) {
  return $output . ' prefix="og: https://ogp.me/ns#"';
});

/**
 * テーマが有効化された時点
 */
add_action('ag_theme_activate', function () {
});
