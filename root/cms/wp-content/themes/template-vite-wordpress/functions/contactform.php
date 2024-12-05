<?php
add_action('wp_enqueue_scripts', function () {
    if (is_page('contact')) return;
    wp_deregister_script('google-recaptcha');
});
