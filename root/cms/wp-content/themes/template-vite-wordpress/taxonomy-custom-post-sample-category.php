<?php require 'header.php'; ?>
<?php get_header(); ?>

<p style="text-align: center; color: red;">taxonomy-custom-post-sample-category.php</p>

<div class="p-custom-post-sample">
    <div class="l-inner">
        <h2 class="c-title">「<?php single_cat_title(); ?>」のタグが付いた投稿</h2>
        <?php get_template_part('component/custom-post-sample/contents'); ?>
        <?php get_template_part('component/custom-post-sample/back'); ?>
    </div>
</div>

<?php get_footer(); ?>
