<?php
get_header();
?>

<div class="notFoundPage">
    <div class="section banner type_1 <?= get_field('banner_background_color', 'option') ?> <?= get_field('banner_border_border_radius', 'option') ?> imageAbove <?= (get_field('banner_bubbles', 'option')) ? 'bubblesYes' : 'bubblesNo'; ?> <?= (get_field('banner_shadow', 'option')) ? 'shadowYes' : 'shadowNo'; ?>">
        <div class="c">
            <div class="bannerWrap">
                <div class="middle-wrap-table">
                    <div class="middle">
                        <div class="bannerContentWrap">
                            <div class="bannerTextContentWrap">
                                <div class="bannerTitleWrap">
                                    <h1>404 Page Not Found</h1>
                                </div>
                                <div class="bannerTextWrap c_editor">
                                    <p>Oops! It looks like the page you were looking for doesn't exist. Please check the URL or go back to the homepage.</p>
                                </div>
                                <div class="bannerButtonWrap">
                                    <a class="btn bannerButton" href="<?= get_site_url(); ?>"><span>Go to Homepage</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        $full_width_cta_title = get_field('full_width_cta_title', 'option');
        $full_width_cta_text = get_field('full_width_cta_text', 'option');
    ?>
</div>

<?php
get_footer();
