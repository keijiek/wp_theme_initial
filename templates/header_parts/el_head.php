<?php
global $post;
$ogp_array = [
  'og:site_name' => esc_attr(get_bloginfo('name')),
  'og:description' => esc_attr(get_bloginfo('description')),
  'og:type' => (is_home() || is_front_page()) ? 'website' : 'article',
  'og:title' => esc_attr((is_home() || is_front_page()) ? get_bloginfo('name') : wp_strip_all_tags(stripslashes(single_post_title('', false)), true)),
  'og:url' => (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"],
  'og:local' => 'ja_JP',
];
$twitter_array = [];
?>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <?php
  /** OGP */
  foreach ($ogp_array as $key => $value) {
    if (!empty($value)) {
  ?>
      <meta property="<?= $key ?>" content="<?= $value ?>" />
  <?php
    }
  }
  ?>

  <?php wp_head(); ?>
</head>

<?php

?>
