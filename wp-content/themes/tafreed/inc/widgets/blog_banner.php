<div class="">
    <?php
        $bgImage = get_sub_field('blog_banner_background_image');
        $image_url = wp_get_attachment_image_url($bgImage, 'full');
        $overlayClass = get_sub_field('blog_banner_background_overlay');
        $title = get_sub_field('blog_banner_title');
        $text = get_sub_field('blog_banner_text');
    ?>
    <div class="section blogBanner <?= $overlayClass ? 'overlayEnabled' : ''; ?>" style="background-image: url('<?= esc_url($image_url); ?>');">
        <div class="bannerOverlay"></div>
        <div class="bannerWrap">
            <div class="c">
                <div class="bannerContentWrap">
                    <!-- Banner Content -->
                    <div class="bannerTextContentWrap">
                        <h1 class="bannerTitle">
                            <?= esc_html($title ? $title : get_the_title()); ?>
                        </h1>
                        <?php if ($text): ?>
                            <p class="bannerDescription"><?= esc_html($text); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>