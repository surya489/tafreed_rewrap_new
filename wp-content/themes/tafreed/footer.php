</div>
                <?php
                    $page_id = get_the_ID();
                    $headerid = url_to_postid('/header/header-footer');
                    $post = get_post($headerid);
                    setup_postdata($post);
                    
                    $header_post = get_posts(array(
                        'post_type' => 'header',
                        'numberposts' => 1,
                    ));

                    if (!empty($header_post)) {
                        $post_id = $header_post[0]->ID;
                        $footer_text = get_field('footer_about_text', $post_id);
                        $footer_menu = get_field('footer_menu', $post_id);
                        $footer_mail = get_field('footer_mail', $post_id);
                        $footer_number = get_field('footer_contact_number', $post_id);
                        $footer_social_icons = get_field('footer_social_icons', $post_id);
                    }


                ?>
            <div class="footer">
                <div class="footerWrap">
                    <div class="footerBodyWrap pb_0">
                        <div class="footerBodyRow">
                            <div class="c">
                                <div class="footerBodyRowWrap">
                                    <div class="footerBodyColumn footerBodyColumn_1">
                                        <div class="footerLogoWrap lazy-load" data-delay='0.2s'>
                                            <img class="footerlogoImage" src="<?= get_bloginfo('template_directory'); ?>/assets/images/tafreed.png" />
                                        </div> 
                                        <div class="footerHeaderColumn footerHeaderColumn_3 lazy-load" data-delay='0.4s'>
                                            <p class="footerFormInfoText fontOpenSansRegular"><?= $footer_text; ?></p>
                                        </div>
                                        <div class="footerHeaderColumn_3 lazy-load" data-delay='0.6s'>
                                            <div class="footerFooterSocialMediaMenuWrap">
                                                <?php
                                                    if(have_rows('footer_social_icons', $post_id)){
                                                        while(have_rows('footer_social_icons', $post_id)){
                                                            the_row();
                                                    ?>
                                                        <div class="socialMediaItem">
                                                            <?php
                                                                if(get_sub_field('social_media_label') == "twitter"){
                                                            ?>
                                                                    <a href="<?= get_sub_field('social_media_link'); ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 26 24" fill="none"><path d="M0.0619613 0L9.87393 13.2375L0 24.0001H2.22222L10.8668 14.5772L17.8514 24.0001H25.4138L15.0497 10.018L24.2403 0H22.0181L14.0568 8.67824L7.62428 0H0.0619613ZM3.32991 1.65161H6.80405L22.1453 22.3482H18.6712L3.32991 1.65161Z" fill="#BFEBF2"/></svg>
                                                                    </a>
                                                            <?php
                                                                }else if(get_sub_field('social_media_label') == "facebook"){
                                                            ?>
                                                                    <a href="<?= get_sub_field('social_media_link'); ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40" fill="none"><path d="M22.5754 34.044V21.232H26.8754L27.5194 16.24H22.5754V13.052C22.5754 11.608 22.9754 10.62 25.0514 10.62H27.6954V6.15596C27.2394 6.09596 25.6674 5.95996 23.8434 5.95996C20.0314 5.95996 17.4234 8.28796 17.4234 12.56V16.24H13.1074V21.232H17.4194V34.044H22.5754Z" fill="#BFEBF2"/></svg>
                                                                    </a>
                                                            <?php
                                                                }else if(get_sub_field('social_media_label') == "youtube"){
                                                            ?>
                                                                    <a href="<?= get_sub_field('social_media_link'); ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="21" viewBox="0 0 29 21" fill="none"><path d="M28.0723 4.68373C28.0723 4.68373 27.8003 2.75173 26.9563 1.89973C25.8923 0.783735 24.6963 0.779735 24.1483 0.711735C20.2243 0.427735 14.3403 0.427734 14.3403 0.427734H14.3283C14.3283 0.427734 8.44431 0.427735 4.52031 0.711735C3.97231 0.775735 2.77631 0.783735 1.71231 1.89973C0.872313 2.75173 0.600312 4.68373 0.600312 4.68373C0.600312 4.68373 0.320312 6.95173 0.320312 9.21973V11.3477C0.320312 13.6157 0.600312 15.8837 0.600312 15.8837C0.600312 15.8837 0.872313 17.8157 1.71231 18.6677C2.78031 19.7837 4.18031 19.7477 4.80431 19.8677C7.04831 20.0837 14.3363 20.1477 14.3363 20.1477C14.3363 20.1477 20.2283 20.1397 24.1483 19.8557C24.6963 19.7917 25.8923 19.7837 26.9563 18.6677C27.7963 17.8157 28.0723 15.8837 28.0723 15.8837C28.0723 15.8837 28.3523 13.6157 28.3523 11.3477V9.21973C28.3523 6.95173 28.0723 4.68373 28.0723 4.68373ZM11.4443 13.9237V6.04773L19.0163 9.99973L11.4443 13.9237Z" fill="#BFEBF2"/></svg>
                                                                    </a>
                                                            <?php
                                                                }else if(get_sub_field('social_media_label') == "instagram"){
                                                            ?>
                                                                    <a href="<?= get_sub_field('social_media_link'); ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 29 29" fill="none"><path d="M14.127 2.60798C17.867 2.60798 18.307 2.62398 19.783 2.68798C21.147 2.75198 21.891 2.97998 22.383 3.17198C23.035 3.42398 23.503 3.72798 23.991 4.21998C24.479 4.70798 24.783 5.17598 25.039 5.82798C25.231 6.31998 25.459 7.06398 25.523 8.42799C25.591 9.90399 25.603 10.348 25.603 14.084C25.603 17.82 25.587 18.264 25.523 19.74C25.459 21.104 25.231 21.848 25.039 22.34C24.787 22.992 24.483 23.46 23.991 23.948C23.503 24.436 23.035 24.74 22.383 24.996C21.891 25.188 21.147 25.416 19.783 25.48C18.307 25.548 17.863 25.56 14.127 25.56C10.391 25.56 9.94705 25.544 8.47105 25.48C7.10705 25.416 6.36305 25.188 5.87105 24.996C5.21905 24.744 4.75105 24.44 4.26305 23.948C3.77505 23.46 3.47105 22.992 3.21505 22.34C3.02305 21.848 2.79505 21.104 2.73105 19.74C2.66305 18.264 2.65105 17.82 2.65105 14.084C2.65105 10.348 2.66705 9.90399 2.73105 8.42799C2.79505 7.06398 3.02305 6.31998 3.21505 5.82798C3.46705 5.17598 3.77105 4.70798 4.26305 4.21998C4.75105 3.73198 5.21905 3.42798 5.87105 3.17198C6.36305 2.97998 7.10705 2.75198 8.47105 2.68798C9.94305 2.61998 10.387 2.60798 14.127 2.60798ZM14.127 0.0839844C10.323 0.0839844 9.84705 0.0999844 8.35505 0.167984C6.86305 0.235984 5.84705 0.471984 4.95505 0.819984C4.03505 1.17598 3.25505 1.65598 2.47505 2.43598C1.69505 3.21598 1.21905 3.99598 0.859047 4.91598C0.511047 5.80798 0.275047 6.82399 0.207047 8.31599C0.139047 9.80799 0.123047 10.284 0.123047 14.088C0.123047 17.892 0.139047 18.368 0.207047 19.86C0.275047 21.352 0.511047 22.368 0.859047 23.26C1.21505 24.18 1.69505 24.96 2.47505 25.74C3.25505 26.52 4.03505 26.996 4.95505 27.356C5.84705 27.704 6.86305 27.94 8.35505 28.008C9.84705 28.076 10.323 28.092 14.127 28.092C17.931 28.092 18.407 28.076 19.899 28.008C21.391 27.94 22.407 27.704 23.299 27.356C24.219 27 24.999 26.52 25.779 25.74C26.559 24.96 27.035 24.18 27.395 23.26C27.743 22.368 27.979 21.352 28.047 19.86C28.115 18.368 28.131 17.892 28.131 14.088C28.131 10.284 28.115 9.80799 28.047 8.31599C27.979 6.82399 27.743 5.80798 27.395 4.91598C27.039 3.99598 26.559 3.21598 25.779 2.43598C24.999 1.65598 24.219 1.17998 23.299 0.819984C22.407 0.471984 21.391 0.235984 19.899 0.167984C18.403 0.0999844 17.927 0.0839844 14.127 0.0839844Z" fill="#BFEBF2"/><path d="M14.1275 6.89551C10.1555 6.89551 6.93945 10.1155 6.93945 14.0835C6.93945 18.0515 10.1595 21.2715 14.1275 21.2715C18.0955 21.2715 21.3155 18.0515 21.3155 14.0835C21.3155 10.1155 18.0955 6.89551 14.1275 6.89551ZM14.1275 18.7515C11.5515 18.7515 9.45945 16.6635 9.45945 14.0835C9.45945 11.5075 11.5475 9.41551 14.1275 9.41551C16.7035 9.41551 18.7955 11.5035 18.7955 14.0835C18.7915 16.6635 16.7035 18.7515 14.1275 18.7515Z" fill="#BFEBF2"/><path d="M21.5999 8.29164C22.5278 8.29164 23.2799 7.53948 23.2799 6.61164C23.2799 5.6838 22.5278 4.93164 21.5999 4.93164C20.6721 4.93164 19.9199 5.6838 19.9199 6.61164C19.9199 7.53948 20.6721 8.29164 21.5999 8.29164Z" fill="#BFEBF2"/></svg>
                                                                    </a>
                                                            <?php
                                                                }else if(get_sub_field('social_media_label') == "linkedin"){
                                                            ?>
                                                                    <a href="<?= get_sub_field('social_media_link'); ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40" fill="none"><path d="M29.86 29.86H25.708V23.36C25.708 21.812 25.684 19.816 23.552 19.816C21.392 19.816 21.064 21.504 21.064 23.248V29.856H16.912V16.496H20.892V18.324H20.948C21.5 17.272 22.856 16.168 24.876 16.168C29.08 16.168 29.856 18.932 29.856 22.532V29.86H29.86ZM12.228 14.672C10.896 14.672 9.82 13.592 9.82 12.264C9.82 10.936 10.896 9.856 12.228 9.856C13.556 9.856 14.636 10.936 14.636 12.264C14.636 13.592 13.556 14.672 12.228 14.672ZM14.308 29.86H10.148V16.496H14.304V29.86H14.308ZM31.928 6H8.064C6.928 6 6 6.904 6 8.02V31.98C6 33.096 6.928 34 8.064 34H31.928C33.068 34 34 33.096 34 31.98V8.02C34 6.904 33.072 6 31.928 6Z" fill="#BFEBF2"/></svg>
                                                                    </a>
                                                            <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    if ($footer_menu && have_rows('footer_menu', $post_id)) { 
                                        $i = 2;
                                        while (have_rows('footer_menu', $post_id)) {
                                            the_row();
                                            $footer_menu_title = get_sub_field('footer_menu_title');
                                            ?>
                                            <div class="footerBodyColumn footerBodyColumn_<?= $i ?>">
                                                <div class="footerBodyColumnTitleWrap lazy-load" data-delay='0.2s'>
                                                    <p class="footerBodyColumnTitle fontPoppins"><?= $footer_menu_title; ?></p>
                                                </div>
                                                <div class="footerMenuBlocks">
                                                    <?php
                                                        if (have_rows('footer_menu_blocks')) {
                                                            $blockCounter = 0;
                                                            ?>
                                                            <div class="footerMenuBlocksGroup <?= ($blockCounter <= 4) ? 'less' : 'great' ?>">
                                                                <?php
                                                                    while (have_rows('footer_menu_blocks')) {
                                                                        the_row();
                                                                        $footerMenuLink = get_sub_field('footer_menu_blocks_link');
                                                                        if (get_sub_field('footer_menu_blocks_link_type') === "external") {
                                                                            $footerMenuLink = get_sub_field('footer_menu_blocks_external_link');
                                                                        }

                                                                        // Start a new group after the third item
                                                                        if ($blockCounter === 4) {
                                                                            echo '</div><div class="footerMenuBlocksGroup">';
                                                                        }
                                                                        ?>
                                                                        <div class="footerMainMenuItem lazy-load" data-delay='0.4s'>
                                                                            <a class="footerMainMenuItemA fontOpenSansRegular" href="<?= $footerMenuLink ?>">    
                                                                                <span class='footerArrowIcon'>
                                                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-long-arrow-alt-right" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path></svg>
                                                                                </span>
                                                                                <?= get_sub_field('footer_menu_blocks_label') ?>
                                                                            </a>
                                                                        </div>
                                                                        <?php
                                                                        $blockCounter++;
                                                                    }
                                                                ?>
                                                            </div>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footerFooterWrap pt_0">
                        <div class="c">
                            <div class="footerBottom">
                                <div class="footerBottomWrap">
                                    <?php
                                        if(!empty($footer_mail) || !empty($footer_number)) {
                                            ?>
                                                <div class="footerBottomMenu">
                                                    <?php
                                                        if(!empty($footer_mail)) {
                                                            ?>   
                                                                <div class="footerBottomMenuItem lazy-load" data-delay='0.6s'>
                                                                    <a class="footerBottomMenuItemA fontOpenSansRegular" href="mailto:<?= $footer_mail; ?>"><?= $footer_mail; ?></a>
                                                                </div>
                                                            <?php
                                                        }
                                                        if(!empty($footer_number)) {
                                                            ?>   
                                                                <div class="footerBottomMenuItem lazy-load" data-delay='0.6s'>
                                                                    <a class="footerBottomMenuItemA fontOpenSansRegular" href="tel:<?= $footer_number; ?>"><?= $footer_number; ?></a>
                                                                </div>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                    <div class="footerBottomCopyright lazy-load" data-delay='0.8s'>
                                        <p class="footerBottomCopyrightText fontOpenSansRegular">© Copyright <?= date('Y'); ?> Tafreed. All rights reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php wp_footer(); ?>
</body>
</html>
