<?php
    $termBaseLink = "";
    if($orginalUrl){
        $termBaseLink = $orginalUrl;
    }else{
        if($termBaseLinkType == "community_showcase"){
            $termBaseLink = home_url()."examples-of-work";
        }else if($termBaseLinkType == "customer_stories"){
            $termBaseLink = home_url()."case-studies";
        }else if($termBaseLinkType == "content_hub"){
            $termBaseLink = home_url()."content-hub";
        }else if($termBaseLinkType == "templates"){
            $termBaseLink = home_url()."resources/templates";
        }
    }
?>
<div data-name="<?= ($p->post_title) ? $p->post_title : $title; ?>" data-date="<?= $date.$time; ?>" data-time="<?= $time; ?>" class="card columnItem inlineBlock bottomSpace <?= $contentTypeListSlug; ?> <?= $industryListSlug; ?> <?= $featureListSlug; ?> <?php if($i == 1 || $i == 2){ echo "columnTwo"; }else echo "columnThree"; ?> cardItem <?= $cardClass; ?> <?= ($pin) ? (($i == 1 || $i == 2) ? "pinYes" : "pinNo") : 'pinNo'; ?>">
    <div class="cardWrap cardBlue">
        <?php
            if($link){
        ?>
            <a class="cardsBlockLink" href="<?= $link; ?>"></a>
        <?php
            }
        ?>
        <div class="cardImageWrap">
            <div class="cardImage">
            <?php
                $file = wp_get_attachment_image_src( $image, 'full' )[0];
                $exts = array('gif'); 
                if(in_array(end(explode('.', $file)), $exts)){
            ?>
                    <div class="sizer"></div>
                    <div class="bsz">
                        <div class="bgimage" style="background-image: url(<?= $file; ?>)"></div>
                        <img src="<?= $file; ?>" alt="" loading="lazy" >
                    </div>
            <?php
                }else{
            ?>
                    <div class="sizer"></div>
                    <?= image_on_fly($image, array('705', 'auto'), false); ?>
            <?php
                }
            ?>
            </div>
        </div>
        <div class="cardTextContent">
            <?php
                if($date){
            ?>
                <div class="cardDateWrap">
                    <p class="cardDate"><?= ($newsDate) ? $newsDate : $date; ?></p>
                </div>
            <?php
                }
            ?>
            <div class="cardTitleWrap cardTitleEqualHeight<?= $wid; ?>">
                <h2 class="cardTitle"><?= $title; ?></h2>
                <h2 class="datetime"><?php echo ($gmt_time) ? $gmt_time : $date.$time; ?></h2>
            </div>
            <div class="termsTextContentWrap cardTermsEqualHeight<?= $wid; ?>">
                <?php
                    if((!empty($selected_values && $contentTypeListFromSelected['termName'] == '' && $industryListFromSelected['termName'] == ''))) {
                ?>
                    <div class="termsWrap <?= ($pin) ? 'selectedCatYes' : '' ?>">
                        <?php
                            if($pin){
                        ?>
                            <div class="<?= ($pin) ? 'postPin featuredPinPost' : '' ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 31 31" fill="none">
                                    <g clip-path="url(#clip0_2565_27932)">
                                        <path d="M17.3839 19.7938V23.3293L15.6161 25.0971L11.1967 20.6777L5.8934 25.981H4.12563V24.2132L9.42893 18.9099L5.00952 14.4905L6.77728 12.7227H10.3128L16.5 6.53553L15.6161 5.65165L17.3839 3.88388L26.2227 12.7227L24.455 14.4905L23.5711 13.6066L17.3839 19.7938ZM9.29635 15.2418L14.8648 20.8103L14.8648 18.7773L21.8033 11.8388L18.2678 8.3033L11.3293 15.2418L9.29635 15.2418Z" fill="white"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2565_27932">
                                        <rect width="30" height="30" fill="white" transform="translate(0.25 0.5)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>featured</span>
                            </div>
                        <?php
                            }
                        ?>
                        <?php
                            if ($selected_values) {
                                foreach ($selected_values as $term_id) {
                                    $applicable_taxonomies = array(
                                        'community_showcase_industry',
                                        'community_showcase_content_type',
                                        'community_showcase_feature',
                                        'content_hub_content_type',
                                        'content_hub_topic',
                                        'customer_stories_content_type',
                                        'customer_stories_industry',
                                        'customer_stories_challenge',
                                        'templates_content_type',
                                    );
                                    foreach ($applicable_taxonomies as $taxonomy) {
                                        $term = get_term_by('id', $term_id, $taxonomy);
                                        if ($term && !is_wp_error($term)) {
                                            $termLink = get_term_link($term);
                                            if($taxonomy == "community_showcase_content_type"){
                                                $termLink = home_url()."/examples-of-work/type/".$term->slug;
                                            }else if($taxonomy == "community_showcase_industry"){
                                                $termLink = home_url()."/examples-of-work/industry/".$term->slug;
                                            }else if($taxonomy == "community_showcase_feature"){
                                                $termLink = home_url()."/examples-of-work/feature/".$term->slug;
                                            }else if($taxonomy == "content_hub_topic"){
                                                $termLink = home_url()."/content-hub/topic/".$term->slug;
                                            }else if($taxonomy == "content_hub_content_type"){
                                                $termLink = home_url()."/content-hub/type/".$term->slug;
                                            }else if($taxonomy == "customer_stories_content_type"){
                                                $termLink = home_url()."/case-studies/type/".$term->slug;
                                            }else if($taxonomy == "customer_stories_industry"){
                                                $termLink = home_url()."/case-studies/industry/".$term->slug;
                                            }else if($taxonomy == "customer_stories_challenge"){
                                                $termLink = home_url()."/case-studies/challenge/".$term->slug;
                                            }else if($taxonomy == "templates_content_type"){
                                                $termLink = home_url()."/resources/templates/type/".$term->slug;
                                            }
                                            $term_name = $term->name;
                                            ?>
                                            <span class="termsItem"><a class="aLinkHover" href="<?= esc_url($termLink."/"); ?>"><?= $term_name; ?></a></span>
                                            <?php
                                            break;
                                        }
                                    }
                                }
                            }
                        ?>
                    </div>
                <?php
                    } else {
                    if($contentTypeList != "" || $industryList != ""){
                ?>
                    <div class="termsWrapper">
                        <?php
                            if($pin){
                        ?>
                            <div class="<?= ($pin) ? 'postPin featuredPinPost' : '' ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 31 31" fill="none">
                                    <g clip-path="url(#clip0_2565_27932)">
                                        <path d="M17.3839 19.7938V23.3293L15.6161 25.0971L11.1967 20.6777L5.8934 25.981H4.12563V24.2132L9.42893 18.9099L5.00952 14.4905L6.77728 12.7227H10.3128L16.5 6.53553L15.6161 5.65165L17.3839 3.88388L26.2227 12.7227L24.455 14.4905L23.5711 13.6066L17.3839 19.7938ZM9.29635 15.2418L14.8648 20.8103L14.8648 18.7773L21.8033 11.8388L18.2678 8.3033L11.3293 15.2418L9.29635 15.2418Z" fill="white"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2565_27932">
                                        <rect width="30" height="30" fill="white" transform="translate(0.25 0.5)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>featured</span>
                            </div>
                        <?php
                            }
                        ?>
                        <div class="termsWrap">
                            <?php
                                if(!empty($industryListFromSelected) || !empty($contentTypeListFromSelected)){
                                    if(!empty($contentTypeListFromSelected)){
                            ?>
                                    <span class="termsItem"><a class="aLinkHover" href="<?= $contentTypeListFromSelected['termLink']."/"; ?>"><?= $contentTypeListFromSelected['termName']; ?></a></span>
                            <?php
                                    }
                                }else{
                                    if($contentTypeList){
                                        foreach($contentTypeList as $cTL){
                                            $termLink = $termBaseLink."/type/".$cTL->slug;
                                    ?>
                                            <span class="termsItem"><a class="aLinkHover" href="<?= $termLink."/"; ?>"><?= $cTL->name; ?></a></span>
                                    <?php
                                        }
                                    }
                                }
                                if(!empty($industryListFromSelected) || !empty($contentTypeListFromSelected)){
                                    if(!empty($industryListFromSelected)){
                            ?>
                                    <span class="termsItem"><a class="aLinkHover" href="<?= $industryListFromSelected['termLink']."/"; ?>"><?= $industryListFromSelected['termName']; ?></a></span>
                            <?php
                                    }
                                }else{
                                    if($industryList){
                                        foreach($industryList as $iL){
                                            $termLink = $termBaseLink."/topic/".$iL->slug;
                                ?>
                                            <span class="termsItem"><a class="aLinkHover" href="<?= $termLink."/"; ?>"><?= $iL->name; ?></a></span>
                                <?php
                                        }
                                    }
                                }
                                if($challengeList){
                                    foreach($challengeList as $cL){
                                        $termLink = get_term_link( $cL->term_id, $cL->taxonomy );
                            ?>
                                        <span class="termsItem"><a class="aLinkHover" href="<?= $termLink."/"; ?>"><?= $cL->name; ?></a></span>
                            <?php
                                    }
                                }
                                if($featureList){
                                    foreach($featureList as $fL){
                                        $termLink = get_term_link( $fL->term_id, $fL->taxonomy );
                            ?>
                                    <span class="termsItem"><a class="aLinkHover" href="<?= $termLink."/"; ?>"><?= $fL->name; ?></a></span>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="communityShowcaseCardItemDescWrap cardDescEqualHeight<?= $wid; ?>">
                <?php
                    if($description){
                ?>
                    <p><?= $description; ?></p>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>