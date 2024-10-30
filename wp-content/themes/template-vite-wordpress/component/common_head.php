<?php
global $post;
$slug = $post->post_name; // 現在のページのスラッグを取得

// 現在のページが固定ページの場合
if (is_page()) {
    // 特定の事業紹介ページの場合
    if (is_page(array('lp_gas', 'city_gas', 'autogasstand', 'reform', 'denki', 'water'))) {
?>
        <section class="l-commonHead">
            <div class="l-commonHead__inner">
                <figure>
                    <picture>
                        <source srcset="<?php echo get_template_directory_uri(); ?>/common/img/common-head_sp.png" width="710" height="480" alt="Our Services" media="(max-width: 767px)" fetchpriority="high" loading="lazy" decoding="async" />
                        <img src="<?php echo get_template_directory_uri(); ?>/common/img/common-head.png" width="1320" height="480" alt="Our Services" fetchpriority="high" loading="lazy" decoding="async" />
                    </picture>
                    <figcaption class="l-commonHead__title">
                        <h2>Our Services</h2>
                        <span>事業紹介</span>
                    </figcaption>
                </figure>
            </div>
        </section>
    <?php
        // recruitページの場合
    } elseif (is_page('recruit')) {
    ?>
        <section class="l-commonHead">
            <div class="l-commonHead__inner">
                <figure>
                    <picture>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/recruit-head.png" width="720" height="760" alt="<?php echo esc_attr($slug); ?>" fetchpriority="high" loading="lazy" decoding="async" />
                    </picture>
                </figure>
            </div>
        </section>
    <?php
        // emergencyページの場合
    } elseif (is_page('emergency')) {
    ?>
        <section class="l-commonHead">
            <div class="l-commonHead__inner">
                <picture>
                    <source srcset="<?php echo get_template_directory_uri(); ?>/img/emergency/emergency-head_sp.png" width="710" height="480" alt="<?php echo esc_attr($slug); ?>" media="(max-width: 767px)" fetchpriority="high" fetchpriority="high" loading="lazy" decoding="async" />
                    <img src="<?php echo get_template_directory_uri(); ?>/img/emergency/emergency-head.png" width="1320" height="480" alt="<?php echo esc_attr($slug); ?>" fetchpriority="high" loading="lazy" decoding="async" />
                </picture>
                <figcaption class="l-commonHead__title">
                    <h2><?php echo ucfirst(esc_html($slug)); ?></h2>
                    <span><?php the_title(); ?></span>
                </figcaption>
            </div>
        </section>
    <?php
        // その他の固定ページ
    } else {
    ?>
        <section class="l-commonHead">
            <div class="l-commonHead__inner">
                <figure>
                    <picture>
                        <source srcset="<?php echo get_template_directory_uri(); ?>/common/img/common-head_sp.png" width="710" height="480" alt="<?php echo esc_attr($slug); ?>" media="(max-width: 767px)" fetchpriority="high" loading="lazy" decoding="async" />
                        <img src="<?php echo get_template_directory_uri(); ?>/common/img/common-head.png" width="1320" height="480" alt="<?php echo esc_attr($slug); ?>" fetchpriority="high" loading="lazy" decoding="async" />
                    </picture>
                    <figcaption class="l-commonHead__title">
                        <h2><?php echo ucfirst(esc_html($slug)); ?></h2>
                        <span><?php the_title(); ?></span>
                    </figcaption>
                </figure>
            </div>
        </section>
    <?php
    }
} elseif (is_archive() || is_single()) {
    // アーカイブまたは投稿ページ
    ?>
    <section class="l-commonHead">
        <div class="l-commonHead__inner">
            <figure>
                <picture>
                    <source srcset="<?php echo get_template_directory_uri(); ?>/common/img/common-head_sp.png" width="710" height="480" alt="News" media="(max-width: 767px)" loading="lazy" decoding="async" />
                    <img src="<?php echo get_template_directory_uri(); ?>/common/img/common-head.png" width="1320" height="480" alt="News" loading="lazy" decoding="async" />
                </picture>
                <figcaption class="l-commonHead__title">
                    <h2>News</h2>
                    <span>最新情報</span>
                </figcaption>
            </figure>
        </div>
    </section>
<?php
}
?>

<?php get_template_part('component/breadcrumbs'); ?>
