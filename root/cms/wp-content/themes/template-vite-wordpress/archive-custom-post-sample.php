<?php get_header(); ?>

<p style="text-align: center; color: red;">archive-custom-post-sample.php</p>

<div class="p-custom-post-sample">
    <div class="l-inner">
        <h2 class="p-custom-post-sample__title">カスタム投稿サンプル一覧</h2>
        <?php get_template_part('component/custom-post-sample/categories'); ?>
        <?php get_template_part('component/custom-post-sample/contents'); ?>
    </div>
</div>

<?php get_footer(); ?>
