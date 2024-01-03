<article class="container p-0 mb-0 mt-0">
  <h1><?= get_the_title(); ?></h1>
  <?php //投稿者 ?>
  <p class="text-end m-0">
    <span>執筆</span>
    <?= get_the_author_posts_link() ?>
  </p>
  <?php //DateTime 表示 ?>
  <p class="text-end m-0">
    <span>投稿</span>
    <time datetime="<?= get_the_date('Y-m-d');?>"><?= get_the_date();?></time>
<?php
  if( (new DateTime(get_the_date('Y-m-d'))) < (new DateTime(get_the_modified_date('Y-m-d'))) ) {
?>
    <span style="color: gray;">(
    <span>更新</span>
    <time datetime="<?= get_the_modified_date('Y-m-d');?>"><?= get_the_modified_date();?></time>
    )</span>
<?php
  }
?>
  </p>

  <?php //カテゴリー表示 ?>
  <p class="text-end m-0"><span class="me-1">カテゴリー:</span><?= the_category(',&nbsp;'); ?></p>

<?php
// タグが存在するなら表示
if( has_tag() ) {
?>
  <p class="text-end m-0">タグ:&nbsp;<?= the_tags(''); ?></p>
<?php
}
?>
  <?= get_the_content();//投稿内容の出力 ?>

  <div class="more-news">
    <div class="next">
      <!-- <a class="another-link" href="#">NEXT</a> -->
      <?php previous_post_link(); ?>
    </div>
    <div class="prev">
      <!-- <a class="another-link" href="#">PREV</a> -->
      <?php next_post_link(); ?>
    </div>
  </div>
</article>
