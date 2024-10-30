<?php ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Title</title>
    <?php
    if (WP_DEBUG) {
        $root = "http://localhost:5173";
        $css_ext = "scss";
        $js_ext = "ts";
        echo '<script type="module" src="http://localhost:5173/@vite/client"></script>';
    } else {
        $root = get_template_directory_uri();
        $css_ext = "css";
        $js_ext = "js";
    }
    ?>
    <link rel="stylesheet" href="<?php echo $root; ?>/assets/style/style.<?php echo $css_ext ?>">
    <script src="<?php echo $root; ?>/assets/js/script.<?php echo $js_ext ?>" type="module"></script>
</head>

<body>

    <header class="l-header">
        <h1>header</h1>
        <ul>
            <li>
                <a href="#nav01">Nav01</a>
            </li>
            <li>
                <a href="#nav02">Nav02</a>
            </li>
            <li>
                <a href="#nav03">Nav03</a>
            </li>
        </ul>
    </header>

    <?php get_template_part('component/nav'); ?>

    <main class="l-main">
