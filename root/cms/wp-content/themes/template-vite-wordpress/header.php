<?php ?>
<!DOCTYPE html>
<html lang="ja">

<head prefix="og:http://ogp.me/ns#">
    <?php
    if (WP_DEBUG) {
        $root = "http://localhost:1024";
        $css_ext = "scss";
        $js_ext = "ts";
        echo '<script type="module" src="http://localhost:1024/@vite/client"></script>';
        echo '<script>console.log("Debug from header.php");</script>';
    } else {
        $root = get_template_directory_uri();
        $css_ext = "css";
        $js_ext = "js";
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="canonical" href="<?php echo home_url(); ?>">
    <!-- icon -->
    <link rel="icon" href="<?php echo $root; ?>/assets/images/common/favicon.ico" sizes="32x32" type="image/vnd.microsoft.icon">
    <link rel="icon" href="<?php echo $root; ?>/assets/images/common/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="<?php echo $root; ?>/assets/images/common/apple-touch-icon.png">
    <link rel="manifest" href="<?php echo $root; ?>/json/manifest.webmanifest" crossorigin="use-credentials">
    <!-- ogp -->
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
    <meta property="og:url" content="<?php echo home_url(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo wp_get_document_title(); ?>" />
    <meta property="og:description" content="<?php bloginfo('description'); ?>" />
    <meta property="og:image" content="<?php echo $root; ?>/assets/images/common/ogp.png" />
    <meta property="og:locale" content="ja_JP" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="<?php bloginfo('description'); ?>" />
    <meta name="twitter:image:src" content="<?php echo $root; ?>/assets/images/common/ogp.png" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">
    <!-- files -->
    <link rel="stylesheet" href="<?php echo $root; ?>/assets/style/style.<?php echo $css_ext ?>">
    <script src="<?php echo $root; ?>/assets/js/script.<?php echo $js_ext ?>" type="module"></script>
</head>

<body>

    <header class="l-header">
        <div class="l-inner">
            <h1>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo $root; ?>/assets/images/common/logo.png" width="511" height="164" alt="Logo" />
                </a>
            </h1>
        </div>
    </header>

    <?php get_template_part('component/hamburger'); ?>
    <?php get_template_part('component/nav'); ?>

    <main class="l-main">
