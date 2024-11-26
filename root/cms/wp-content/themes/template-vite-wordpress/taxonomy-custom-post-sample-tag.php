<?php get_header(); ?>

<p style="text-align: center; color: red;">taxonomy-custom-post-sample-tag.php</p>

<div class="p-custom-post-sample">
    <div class="l-inner">
        <h2 class="p-custom-post-sample__title">「<?php single_tag_title(); ?>」のタグが付いた投稿</h2>
        <?php get_template_part('component/custom-post-sample/contents'); ?>
        <?php get_template_part('component/custom-post-sample/back'); ?>
    </div>
</div>

<?php get_footer(); ?>
