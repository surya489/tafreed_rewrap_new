<?php
/*
 * Template Name: Templates List
 */
$operator = "OR";
$type = "";
$orderby = "publish_date";
$order = "desc";
$searchValue = "";
$postType = "templates";
$maxPerPage = 12;
$adminType = get_field('templates_list_content_type');
$typeAdminSelect = "";
$categoryTitle = "";
$customTitle = "";
$pIds = array();
$desc = get_field('templates_list_description');
$showDate = get_field('templates_list_date');
if($adminType == "topicBased"){
    while(have_rows('templates_list_topic')){
        the_row();
        if(get_sub_field('templates_list_topic_content_type') != ""){
            foreach(get_sub_field('templates_list_topic_content_type') as $ti){
                $typeAdminSelect .= $ti.",";
            }
        }
    }
    if($typeAdminSelect != ""){
        $operator = "AND";
    }
}
$paged = (get_query_var('urlpagenumber')) ? get_query_var('urlpagenumber') : ((get_query_var('paged')) ? get_query_var('paged') : 1);
if (get_query_var('taxonomytype')) {
    $type = get_query_var('taxonomyname');
    if($type){
        $typeTerm = get_term_by('slug', $type, 'templates_content_type');
        $categoryTitle = $typeTerm->name;
        $customTitle = $typeTerm->name;
        $canonicalLink = "/type/".$type;
    }
}
if($customTitle){
    $customTitle = get_the_title()." - ".$customTitle;
}else{
    $customTitle = get_the_title();
}
add_filter('wpseo_title', function ($title) use ($customTitle) {
    return $customTitle;
});
if (get_query_var('searchkey')) {
    $searchValue = urldecode(get_query_var('searchvalue'));
}
if (get_query_var('orderby')) {
    $orderby = (get_query_var('orderbyvalue')) ? get_query_var('orderbyvalue') : "desc";
}
if ($orderby == "alphabetical") {
    $orderby = "title";
    $order = "asc";
}else if($orderby == "random"){
    $orderby = "rand";
    $order = "";
} else {
    $order = $orderby;
    $orderby = "publish_date";
}
$url = home_url($wp->request);
$canonicalLink = $url;
// Remove specific parameter from query string
$filteredURL = preg_replace('/&?page[^&]*/', '', $url);
$filteredURL = preg_replace('/&?type[^&]*/', '', $filteredURL);
$filteredURL = preg_replace('/&?orderby[^&]*/', '', $filteredURL);
$filteredURL = preg_replace('/&?(\bsearch\b)[^&]*/', '', $filteredURL);
$filteredURL = preg_replace('/\/*$/', '', $filteredURL);
$filteredSearchURL = preg_replace('/\/*$/', '', $filteredURL);
$searchURL = preg_replace('/&?(\bsearch\b)[^&]*/', '', $url);
$searchURL = preg_replace('/&?page[^&]*/', '', $searchURL);
$orginalUrl = $filteredURL;
$contentTypeCat = get_terms(['taxonomy' => 'templates_content_type', 'hide_empty' => true]);
$cId = array();
foreach($contentTypeCat as $contentTypeCatData){
    $cId[] = $contentTypeCatData->term_id;
}
if($type != ""){
    $operator = "AND";
}
//All Post
$args = array(
    'post_type' => $postType,
    'post_status' => 'publish',
    'paged' => $paged,
    'posts_per_page' => $maxPerPage,
    'orderby' => $orderby,
    'order' => $order,
    'tax_query' => array('relation' => $operator),
);
if($adminType == "topicBased"){
    $contentTypeCat = array(
        'taxonomy' => 'templates_content_type',
        'field'    => 'term_id',
        'terms'    => explode(',', $typeAdminSelect),
    );
    array_push($args['tax_query'], $contentTypeCat);
}else{
    if ($type != "") {
        $contentTypeCat = array(
            'taxonomy' => 'templates_content_type',
            'field'    => 'slug',
            'terms'    => $type,
        );
        array_push($args['tax_query'], $contentTypeCat);
    }else{
        $contentTypeCat = array('relation' => 'OR');
        array_push($contentTypeCat, array(
            'taxonomy' => 'templates_content_type',
            'field'    => 'term_id',
            'terms'    => $cId,
            'operator' => 'EXISTS',
        ));
        array_push($args['tax_query'], $contentTypeCat);
    }
}
if($searchValue)
    $args['s'] = urldecode($searchValue);
$tempQuery = new WP_Query($args);
get_header();
?>
<div class="bannerBreadcrumbs bgBlue">
    <div class="c">
        <?php echo getBreadcrumbs(); ?>
    </div>
</div>
<div class="section searchBanner bgBlue bannerRoundedRight <?= (get_field('search_banner_title') == "") ? 'titleEmpty' : ''; ?> <?= (get_field('search_banner_text') == "") ? 'textEmpty' : ''; ?>" <?= (get_field('templates_list_widget_id')) ? 'id="' . get_field('templates_list_widget_id') . '"' : '' ?>>
    <div class="c">
        <div class="searchBannerWrap">
            <div class="searchBannerTextContent bannerTextContentWrap">
                <div class="searchBannerTextContentTitleWrap">
                    <?php
                        if(get_field('search_banner_title')){
                            $tag = get_field('search_banner_title_tag');
                    ?>
                        <?= "<$tag class='searchBannerTitle size80'>".get_field('search_banner_title')."</$tag>"; ?>
                    <?php
                        }
                        if($categoryTitle){
                    ?>
                    <div class="searchBannerTextContentTextWrap categoryTitleYes">
                        <h2 class="searchBannerSubTitle size32">Showing results for:  <?= str_replace("-", " ", $categoryTitle); ?></h2>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <?php
                    if(get_field('search_banner_text') && $categoryTitle == ""){
                ?>
                    <div class="searchBannerTextContentTextWrap">
                        <p class="searchBannerSubTitle size32"><?= get_field('search_banner_text') ?></p>
                    </div>
                <?php
                    }
                ?>
            </div>

            <div class="searchBannerFormContent">
                <form class="bannerSearchForm" method="POST">
                    <div class="searchBannerFormContentWrap">
                        <div class="searchBannerFormIconWrap"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M19.6 21L13.3 14.7C12.8 15.1 12.225 15.4167 11.575 15.65C10.925 15.8833 10.2333 16 9.5 16C7.68333 16 6.14583 15.3708 4.8875 14.1125C3.62917 12.8542 3 11.3167 3 9.5C3 7.68333 3.62917 6.14583 4.8875 4.8875C6.14583 3.62917 7.68333 3 9.5 3C11.3167 3 12.8542 3.62917 14.1125 4.8875C15.3708 6.14583 16 7.68333 16 9.5C16 10.2333 15.8833 10.925 15.65 11.575C15.4167 12.225 15.1 12.8 14.7 13.3L21 19.6L19.6 21ZM9.5 14C10.75 14 11.8125 13.5625 12.6875 12.6875C13.5625 11.8125 14 10.75 14 9.5C14 8.25 13.5625 7.1875 12.6875 6.3125C11.8125 5.4375 10.75 5 9.5 5C8.25 5 7.1875 5.4375 6.3125 6.3125C5.4375 7.1875 5 8.25 5 9.5C5 10.75 5.4375 11.8125 6.3125 12.6875C7.1875 13.5625 8.25 14 9.5 14Z" fill="#0E1439"></path>
                            </svg></div>
                        <div class="searchBannerFormInputWrap"> 
                            <input type="hidden" value="<?= $searchURL; ?>" class="currentUrl"> 
                            <input required="" name="search" type="text" value="<?= urldecode($searchValue); ?>" class="searchInput" placeholder="Search">
                        </div>
                        <div class="searchBannerFormButtonWrap"> 
                            <button class="formButton" type="submit">Submit</button>
                        </div>
                        <?php
                        if($searchValue){
                        ?>
                        <div class="searchBannerFormButtonWrap searchBannerFormResetButtonWrap">
                            <a class="formButton resetButton" href="<?= $searchURL; ?>">Reset</a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="formMobileView">
                        <div class="searchBannerFormButtonWrap"> 
                            <button class="formButton" type="submit">Submit</button>
                        </div>
                        <?php
                        if($searchValue){
                        ?>
                        <div class="searchBannerFormButtonWrap searchBannerFormResetButtonWrap">
                            <a class="formButton resetButton" href="<?= $orginalUrl; ?>">Reset</a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="section setWhite white templatesList templatesList<?= $wid; ?> inlineBlock" id="templatesList<?= $wid; ?>" data-wid="<?= $wid; ?>">
    <div class="c">
        <div class="templatesListWrap filterListWrap">
            <div class="templatesListFiterWrap list-filters">
                <?php
                    $dataContentType = array();
                    if(get_field('templates_list_content_type') == "topicBased"){
                        if(get_field('templates_list_topic') != ""){
                            $dataContentType = get_field('templates_list_topic');
                        }
                    }
                ?>
                <div class="templatesListFiterRow columnRow">
                    <?php
                        if(get_field('templates_list_content_type') != "topicBased"){
                            $templatesTypeCat = get_terms(['taxonomy' => 'templates_content_type', 'hide_empty'=>true]);
                            if(!empty($templatesTypeCat)){
                    ?>
                    <div class="columnFour columnItem filterRow topicFilter">
                        <div class="filter filtertemplatesType">
                            <?php
                                $typeFilterPlaceholder = "Type";
                                if($type){
                                    $typeTerm = get_term_by('slug', $type, 'templates_content_type');
                                    $typeFilterPlaceholder = str_replace("-", " ", $typeTerm->name);
                                }
                            ?>
                            <p class="filterPlaceholder filterlabel filtertemplatesTypePlaceholder" data-label="Type"><?= $typeFilterPlaceholder; ?></p>
                            <ul>
                                <?php
                                    foreach($templatesTypeCat as $templatesTypeCatData){
                                        $typeFilterUrl = "";
                                        $typeFilterUrl = (($typeFilterUrl) ? $typeFilterUrl : $orginalUrl) . "/type/" . $templatesTypeCatData->slug;

                                        if ($searchValue) {
                                            $typeFilterUrl = (($typeFilterUrl) ? $typeFilterUrl : $orginalUrl) . "/search/" . $searchValue;
                                        }
                                ?>
                                <li>
                                    <a href="<?= $typeFilterUrl; ?>/" class="filterItem" data-filter=".<?= $templatesTypeCatData->slug; ?>"><?= $templatesTypeCatData->name; ?></a>
                                </li>
                                <?php
                                    }
                                ?>
                                <li>
                                    <a href="<?= $orginalUrl."/"; ?>" class="filterItem" data-filter="all">Reset</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                    <div class="columnFour columnItem filterRow spaceFilterColumn"></div>
                    <div class="columnFour columnItem filterRow spaceFilterColumn"></div>
                    <div class="columnFour columnItem filterRow">
                        <div class="filter filtertemplatesOrderBy" data-label="Sort by latest">
                            <?php
                                $orderByFilterUrl = "";
                                if ($type) {
                                    $orderByFilterUrl = (($orderByFilterUrl) ? $orderByFilterUrl : $orginalUrl) . "/type/" . $type;
                                }
                                $orderByFilterUrl = ($orderByFilterUrl) ? $orderByFilterUrl : $orginalUrl;
                                $orderByPlaceholder = "Sort by latest";
                                if (get_query_var('orderbyvalue')) {
                                    if (get_query_var('orderbyvalue') == "asc") {
                                        $orderByPlaceholder = "Ascending";
                                    } else if (get_query_var('orderbyvalue') == "desc") {
                                        $orderByPlaceholder = "Latest";
                                    } else if (get_query_var('orderbyvalue') == "alphabetical") {
                                        $orderByPlaceholder = "Alphabetical";
                                    } else if (get_query_var('orderbyvalue') == "random") {
                                        $orderByPlaceholder = "Random";
                                    }else{
                                        $orderByPlaceholder = "Sort by latest";
                                    }
                                }
                            ?>
                            <p class="filterPlaceholder filterlabel filterfilterOrderByPlaceholder"><?= $orderByPlaceholder; ?></p>
                            <ul>
                                <li>
                                    <a href="<?= $orderByFilterUrl."/orderby/desc".(($searchValue) ? "/search/".$searchValue : ''); ?>/" class="filterOrderByItem" data-order="date">Latest</a>
                                </li>
                                <li>
                                    <a href="<?= $orderByFilterUrl."/orderby/alphabetical".(($searchValue) ? "/search/".$searchValue : ''); ?>/" class="filterOrderByItem" data-order="name">Alphabetical</a>
                                </li>
                                <li>
                                    <a href="<?= $orderByFilterUrl."/orderby/random".(($searchValue) ? "/search/".$searchValue : ''); ?>/" class="filterOrderByItem" data-order="random">Random</a>
                                </li>
                                <li>
                                    <a href="<?= $orginalUrl; ?>/" class="filterOrderByItem" data-order="original-order">Reset</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="templatesListContentWrap">
                <div class="templatesListContent columnRow cardRow initial8">
                    <?php
                        $allQuery = $tempQuery->posts;
                        if (!empty($allQuery)) {
                            $i = 1;
                            foreach ($allQuery as $aq) {
                                $postId = $aq->ID;
                                $title = get_the_title($postId);
                                $description = ($desc == "show") ? get_field('templates_description',$postId) : "";
                                $image = get_field('templates_image',$postId);
                                $contentTypeList = get_the_terms($postId, 'templates_content_type');
                                $link = get_permalink($postId);
                                $date = ($showDate != 'hide') ? get_the_date('dmY',$postId) : '';
                                $newsDate = ($showDate != 'hide') ? get_the_date('d M Y',$postId) : '';
                                $time = get_post_time($postId);
                                $cardClass = "templatesCardItem";
                                $termBaseLinkType = "templates";
                                $selected_values = get_field('categories_select_list', $postId);
                                $wid = $wid;

                                if(get_field('card_link_type',$postId) == "customLink"){
                                    $link = get_field('card_custom_link',$postId);
                                }

                                $contentTypeListSlug = "";

                                if($contentTypeList != ""){
                                    foreach($contentTypeList as $ti){
                                        $contentTypeListSlug .= $ti->slug." ";
                                    }
                                }

                                if($type){
                                    $contentTypeListFromSelected['termLink'] = $orginalUrl."/type/".$type;
                                    $typeTerm = get_term_by('slug', $type, 'templates_content_type');
                                    $contentTypeListFromSelected['termName'] = str_replace("-", " ", $typeTerm->name);
                                }

                                include(dirname(__DIR__, 1) . '/inc/widgets/blocks/card.php');
                                $i++;
                            }
                        }else{
                    ?>
                            <div class="contentHubListContentMessageWrap show"> 
                                <?php
                                    if(!empty($searchValue)) {
                                ?>
                                    <div class="errSearchMsgWrap">
                                        <p class="size24">Oops! We couldn't find what you were looking for. Try refining your search terms.</p>
                                    </div>
                                <?php
                                    } else if(empty($searchValue)) {
                                ?>
                                    <div class="errMsgWrap">
                                        <p class="size24">Sorry, we didn't find any results for your selected filters. Don't worry, our team is working on it! In the meantime, feel free to browse our Templates.</p>
                                    </div>
                                <?php
                                    }
                                ?>
                                <div class="ctaBtnWrap">
                                <a href="<?= get_site_url() ?>/resources/templates" class="btn white btnPrimary resetBtn cursorPointer ctaBtn"><span>Templates</span></a>
                                    <a href="<?= get_site_url() ?>" class="btn white btnPrimary resetBtn cursorPointer ctaBtn"><span>Home</span></a>
                                </div>
                            </div>
                    <?php
                        }

                        $nextpage = $paged + 1;
                        $prevouspage = $paged - 1;
                        $total = $tempQuery->max_num_pages;

                        $pagination_args = array(
                            'base' => get_pagenum_link(1) . '%_%',
                            'format' => 'page/%#%/',
                            'total' => $total,
                            'current' => max(1, $paged),
                            'prev_text' => __('<span class="roundArrow" data-attr="' . $prevouspage . '"><i class="arrAcon left"></i></span>'),
                            'next_text' => __('<span class="roundArrow" data-attr="' . $nextpage . '"><i class="arrAcon"></i></span>'),
                            'type' => 'list',
                        );

                        $paginate_links = paginate_links($pagination_args);

                        if ($paginate_links) {
                            echo '<div class="modernPagination">';
                            echo '<div class="communityshowcasefilterpage ajax-pageouter">' . $paginate_links . '</div>';
                            echo '</div>';
                        }
                        wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include(__DIR__ . "/../inc/widgets/common.php");
get_footer();