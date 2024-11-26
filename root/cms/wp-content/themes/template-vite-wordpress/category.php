<?php get_header(); ?>

<p style="text-align: center; color: red;">category.php</p>

<div class="p-news">
    <div class="l-inner">
        <h2 class="p-news__title">「<?php single_cat_title(); ?>」のカテゴリーが付いた投稿</h2>
        <?php get_template_part('component/news/contents'); ?>
        <?php get_template_part('component/news/back'); ?>
    </div>
</div>

<?php get_footer(); ?>
