<?php get_header(); ?>

<p style="text-align: center; color: red;">archive.php</p>

<div class="p-news">
    <div class="l-inner">
        <h2 class="p-news__title">お知らせ一覧</h2>
        <?php get_template_part('component/news/categories'); ?>
        <?php get_template_part('component/news/contents'); ?>
    </div>
</div>

<?php get_footer(); ?>
