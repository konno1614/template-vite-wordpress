<?php

/*-----------------------------------------------------------------------------------*/
/* メニューに[マニュアル]を追加
/*-----------------------------------------------------------------------------------*/
function artist_add_pages()
{
    add_menu_page('マニュアル', 'マニュアル', 'manage_options', 'manual', 'manual');
}
add_action('admin_menu', 'artist_add_pages');



//メニューのリンク先変更
function add_side_menu_manual()
{
    $pdf_url = get_template_directory_uri() . '/dl/manual.pdf'; ?>
    <script type="text/javascript">
        jQuery(function($) {
            $("#toplevel_page_manual a").attr("href", "<?php echo $pdf_url; ?>");
            $("#toplevel_page_manual a").attr("target", "_blank");
        });
    </script>
<?php
}
add_action('admin_footer', 'add_side_menu_manual');



//メニューのアイコン変更
function my_dashboard_print_styles()
{
?>
    <style>
        #adminmenu #toplevel_page_manual div.wp-menu-image:before {
            content: "\f190";
        }
    </style>
<?php
}
add_action('admin_print_styles', 'my_dashboard_print_styles');
