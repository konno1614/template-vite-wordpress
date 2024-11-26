<?php get_header(); ?>

<p style="text-align: center; color: red;">tag.php</p>

<div class="p-news">
    <div class="l-inner">
        <h2 class="c-title">「<?php single_tag_title(); ?>」のタグが付いた投稿</h2>
        <?php get_template_part('component/news/contents'); ?>
        <?php get_template_part('component/news/back'); ?>
    </div>
</div>

<?php get_footer(); ?>
