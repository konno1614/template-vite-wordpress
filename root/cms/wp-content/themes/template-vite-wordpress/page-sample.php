<?php get_header(); ?>

<div class="p-sample">
    <div class="l-inner">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/logo.png" width="511" height="164" alt="Logo" />
        </a>
        <ul>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>news/">News</a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>sample/">Sample</a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>product/">Product</a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>web/">Web</a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>privacy/">Privacy</a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>contact/">Contact</a>
            </li>
        </ul>
    </div>
</div>

<?php get_footer(); ?>
