<?php
// contactform7をcontact以外削除
function exclude_contact_form7_scripts() {
  if ( ! is_page( 'contact' ) ) {// 除外したいページのスラッグを指定します
    wp_dequeue_script( 'contact-form-7' ); // Contact Form 7のJavaScriptを除外
    wp_dequeue_style( 'contact-form-7' ); // Contact Form 7のCSSを除外
  }
}
add_action( 'wp_enqueue_scripts', 'exclude_contact_form7_scripts', 100 );



// Contact Form 7で自動挿入されるPタグ、brタグを削除
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false() {
  return false;
}



// 確認用メールアドレスのチェック
// function wpcf7_main_validation_filter($result, $tag)
// {
//     $type = $tag['type'];
//     $name = $tag['name'];
//     $_POST[$name] = trim(strtr((string) $_POST[$name], "\n", " "));
//     if ('email' == $type || 'email*' == $type) {
//         if (preg_match('/(.*)_confirm$/', $name, $matches)) {
//             $target_name = $matches[1];
//             if ($_POST[$name] != $_POST[$target_name]) {
//                 if (method_exists($result, 'invalidate')) {
//                     $result->invalidate($tag, "確認用のメールアドレスが一致していません");
//                 } else {
//                     $result['valid'] = false;
//                     $result['reason'][$name] = '確認用のメールアドレスが一致していません';
//                 }
//             }
//         }
//     }
//     return $result;
// }
// add_filter('wpcf7_validate_email', 'wpcf7_main_validation_filter', 11, 2);
// add_filter('wpcf7_validate_email*', 'wpcf7_main_validation_filter', 11, 2);

// お問い合わせページを除き、「reCAPTCHA」を読み込ませない
// function load_recaptcha_js() {
//   if ( ! is_page( 'contact' ) ) {
//    wp_deregister_script( 'google-recaptcha' );
//   }
//  }
//  add_action( 'wp_enqueue_scripts', 'load_recaptcha_js',100 );