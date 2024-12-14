<div class="section banner heroBanner <?= sanitize_title(get_the_title()); ?> <?= (get_sub_field('hero_banner_background_overlay')) ? 'shadowYes' : 'shadowNo'; ?>">
        <div class="menu-column three-columns image-column">
            <div class="sizer"></div>
            <?php
                $image_url = get_sub_field('hero_banner_image'); // Get image ID or URL (depending on your ACF setup)
                if ($image_url) {
                    // Get the URL for the image attachment
                    $image_url = wp_get_attachment_image_url($image_url, 'full'); // Ensure it's the full-size image URL
                    ?>
                    <div href="#" class="image" style="background-image: url('<?= esc_url($image_url); ?>');">
                    </div>
                    <?php
                }
            ?>
        </div>
    <div class="c">
        <div class="bannerWrap">
                <div class="middle-wrap-table">
                    <div class="middle">
                        <div class="bannerContentWrap">
                            <div class="bannerTextContentWrap">
                                <div class="bannerTitleWrap">
                                    <?php
                                        $tag = get_sub_field('hero_banner_title_tag');
                                        $title = get_sub_field('hero_banner_title');
                                        $highlightText = get_sub_field('hero_banner_highlight_text');
                                        $descText = get_sub_field('hero_banner_description');
                                        $highlightTextPosition = get_sub_field('banner_highlight_text_position');
                                    ?>
                                        <div class="">
                                            <?php   
                                                if($highlightTextPosition != 'default') {
                                                    ?>
                                                        <div class="<?= $highlightText ? 'highlightText' : 'deepBlueText' ?> lazy-load" data-delay='0.2s'><?= $highlightText; ?></div>
                                                    <?php
                                                }
                                            ?> 
                                            <?= "<$tag class='bannerTitle size64 lazy-load' data-delay='0.2s'>"; ?>
                                                <?= $title; ?>
                                            <?= "</$tag>"; ?>
                                            <?php   
                                                if($highlightTextPosition != 'above') {
                                                    ?>
                                                        <span class="<?= $highlightText ? 'highlightText' : 'deepBlueText' ?>"><?= $highlightText; ?></span>
                                                    <?php
                                                }
                                            ?>                                            
                                        </div>
                                </div>
                                <?php
                                if(have_rows('hero_banner_button')){
                                ?>
                                    <div class="bannerButtonWrap">
                                        <?php
                                            while(have_rows('hero_banner_button')){
                                                the_row();
                                                $buttonLink = get_sub_field('banner_button_internal_link');
                                                if(get_sub_field('hero_button_link_type') == "external"){
                                                    $buttonLink = get_sub_field('banner_button_external_link');
                                                }

                                                $target = get_sub_field('button_target_blank') ? ' target="_blank"' : '';

                                                if($buttonLink && get_sub_field('hero_banner_button_text')){
                                        ?>
                                            <a class="btn bannerButton" href="<?= $buttonLink; ?>"<?= $target ?>><span><?= get_sub_field('hero_banner_button_text'); ?></span></a>
                                        <?php
                                                }
                                            }
                                            wp_reset_postdata();
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="bannerTextWrap c_editor lazy-load" data-delay="0.2s">
                                <?php
                                    if($descText) {
                                        ?>
                                            <?= $descText; ?>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

