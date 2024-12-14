<?php

add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => "Theme Settings",
        'menu_title' => "Theme Settings",
        'menu_slug' => 'theme-settings',
        'parent_slug' => 'options-general.php',
    ));
}

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => "404 Page",
        'menu_title' => "404 Page",
        'menu_slug' => 'not-fount-page',
        'parent_slug' => 'options-general.php',
    ));
}

function getBreadcrumbs()
{
    // Set variables for later use
    $here_text        = __( '' );
    $home_link        = home_url('/');
    $home_text        = __( '' );
    $link_before      = '<span typeof="v:Breadcrumb">';
    $link_after       = '</span>';
    $link_attr        = ' rel="v:url" property="v:title"';
    $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter        = '<span class="delimiter"><i>/</i><span>';              // Delimiter between crumbs
    $before           = '<span class="current">'; // Tag before the current crumb
    $after            = '</span>';                // Tag after the current crumb
    $page_addon       = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links   = '';

    /** 
     * Set our own $wp_the_query variable. Do not use the global variable version due to 
     * reliability
     */
    $wp_the_query   = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();

    // Handle single post requests which includes single pages, posts and attatchments
    if ( is_singular() ) 
    {

        /** 
         * Set our own $post variable. Do not use the global variable version due to 
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post( $queried_object );

        // Set variables 
        $title          = apply_filters( 'the_title', $post_object->post_title );
        $parent         = $post_object->post_parent;
        $post_type      = $post_object->post_type;
        $post_id        = $post_object->ID;
        $post_link      = $before . $title . $after;
        $parent_string  = '';
        $post_type_link = '';

        if ( 'post' === $post_type ) 
        {
            // Get the post categories
            $categories = get_the_category( $post_id );
            if ( $categories ) {
                // Lets grab the first category
                $category  = $categories[0];

                $category_links = get_category_parents( $category, true, $delimiter );
                $category_links = str_replace( '<a',   $link_before . '<a' . $link_attr, $category_links );
                $category_links = str_replace( '</a>', '</a>' . $link_after,$category_links );
            }
        }

        if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) )
        {
            $post_type_object = get_post_type_object( $post_type );
            $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );

            if($post_type === 'content_hub') {
                $archive_link = '/content-hub/';
            }

            $post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->singular_name );
        }

        // Get post parents if $parent !== 0
        if ( 0 !== $parent ) 
        {
            $parent_links = [];
            while ( $parent ) {
                $post_parent = get_post( $parent );

                $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                $parent = $post_parent->post_parent;
            }

            $parent_links = array_reverse( $parent_links );

            $parent_string = implode( $delimiter, $parent_links );
        }

        // Lets build the breadcrumb trail
        if ( $parent_string ) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link;
        } else {
            $breadcrumb_trail = $post_link;
        }

        if ( $post_type_link )
            $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;

        if ( $category_links )
            $category_links = "<span typeof='v:Breadcrumb'><a rel='v:url' property='v:title' href='".$home_link."home/resources/news/'>News <span class='delimiter'><i>/</i><span> </a></span> ";
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
    }

    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if( is_archive() )
    {
        if (    is_category()
             || is_tag()
             || is_tax()
        ) {
            // Set the variables for this section
            $term_object        = get_term( $queried_object );
            $taxonomy           = $term_object->taxonomy;
            $term_id            = $term_object->term_id;
            $term_name          = $term_object->name;
            $term_parent        = $term_object->parent;
            $taxonomy_object    = get_taxonomy( $taxonomy );
            $current_term_link  = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
            $parent_term_string = '';

            if ( 0 !== $term_parent )
            {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ( $term_parent ) {
                    $term = get_term( $term_parent, $taxonomy );

                    $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                    $term_parent = $term->parent;
                }

                $parent_term_links  = array_reverse( $parent_term_links );
                $parent_term_string = implode( $delimiter, $parent_term_links );
            }

            if ( $parent_term_string ) {
                $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
            } else {
                $breadcrumb_trail = $current_term_link;
            }

        } elseif ( is_author() ) {

            $breadcrumb_trail = __( 'Author archive for ') .  $before . $queried_object->data->display_name . $after;

        } elseif ( is_date() ) {
            // Set default variables
            $year     = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day      = $wp_the_query->query_vars['day'];

            // Get the month name if $monthnum has a value
            if ( $monthnum ) {
                $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                $month_name = $date_time->format( 'F' );
            }

            if ( is_year() ) {

                $breadcrumb_trail = $before . $year . $after;

            } elseif( is_month() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

            } elseif( is_day() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }

        } elseif ( is_post_type_archive() ) {

            $post_type        = $wp_the_query->query_vars['post_type'];
            $post_type_object = get_post_type_object( $post_type );

            $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;

        }
    }   

    // Handle the search page
    if ( is_search() ) {
        $breadcrumb_trail = __( 'Search query for: ' ) . $before . get_search_query() . $after;
    }

    // Handle 404's
    if ( is_404() ) {
        $breadcrumb_trail = $before . __( 'Error 404' ) . $after;
    }

    // Handle paged pages
    if ( is_paged() ) {
        $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
        $page_addon   = $before . sprintf( __( ' ( Page %s )' ), number_format_i18n( $current_page ) ) . $after;
    }

    $breadcrumb_output_link  = '';
    $breadcrumb_output_link .= '<div class="breadcrumbWrap">';
    if (is_home()) {
        // Do not show breadcrumbs on page one of home and frontpage
        // if ( is_paged() ) {
        //     $breadcrumb_output_link .= $here_text . $delimiter;
        //     $breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
        //     $breadcrumb_output_link .= $page_addon;
        // }
    } else {
        $breadcrumb_output_link .= "";
        $breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    $breadcrumb_output_link .= '</div><!-- .breadcrumbs -->';

    return $breadcrumb_output_link;
}

function wordTrim($text,$count){
    return substr_replace($text, "...", $count);
}

function customerSuccessStoriesList($wid,$adminType,$dataIndustry,$dataContentType,$dataChallenge){

    if($adminType == "topicBased"){
        if(!empty($dataIndustry) || !empty($dataContentType) || !empty($dataChallenge)){
            $args = array(
                'post_type' => "customer_stories",
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'tax_query' => array('relation' => 'OR'),
                "meta_key" => 'customer_stories_pin',
                'orderby' => 'meta_value_num',
                'order' => "DESC",
            );

            if($dataIndustry != ""){
                $industryCat = array('relation' => 'OR');
                array_push($industryCat, array(
                    'taxonomy' => 'customer_stories_industry',
                    'terms' => $dataIndustry,
                    'field' => 'term_id',
                ));
                array_push($args['tax_query'], $industryCat);
            }
            if($dataContentType != ""){
                $contentTypeCat = array('relation' => 'OR');
                array_push($contentTypeCat, array(
                    'taxonomy' => 'customer_stories_content_type',
                    'terms' => $dataContentType,
                    'field' => 'term_id',
                ));
                array_push($args['tax_query'], $contentTypeCat);
            }
            if($dataChallenge != ""){
                $challengeCat = array('relation' => 'OR');
                array_push($challengeCat, array(
                    'taxonomy' => 'customer_stories_challenge',
                    'terms' => $dataChallenge,
                    'field' => 'term_id',
                ));
                array_push($args['tax_query'], $challengeCat);
            }
        }else{
            $args = array(
                'post_type' => "customer_stories",
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'tax_query' => array('relation' => 'OR'),
                "meta_key" => 'customer_stories_pin',
                'orderby' => 'meta_value_num',
                'order' => "DESC",
            );
        }
    }else{
        $args = array(
            'post_type' => "customer_stories",
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                  'taxonomy' => 'customer_stories_challenge',
                  'operator' => 'EXISTS',
                ),
                array(
                  'taxonomy' => 'customer_stories_industry',
                  'operator' => 'EXISTS',
                ),
                array(
                    'taxonomy' => 'customer_stories_content_type',
                    'operator' => 'EXISTS',
                )
            ),
            "meta_key" => 'customer_stories_pin',
            'orderby' => array(
                'meta_value_num' => 'DESC',
                'date' => 'DESC',
            ),
        );
    }

    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        $i = 1;
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $postId = get_the_ID();
            $title = get_the_title($postId);
            $image = get_field('customer_stories_image',$postId);
            $contentTypeList = get_the_terms($postId, 'customer_stories_content_type');
            $industryList = get_the_terms($postId, 'customer_stories_industry');
            $challengeList = get_the_terms($postId, 'customer_stories_challenge');
            $pin = get_field('customer_stories_pin',$postId);
            $description = get_field('customer_stories_description',$postId);
            $description = ($description) ? wordTrim($description,83) : '';
            $link = get_permalink($postId);
            $date = get_the_date('dmY',$postId);
            $time = get_post_time('Y/m/d H:i:s', false, $postId);
            $gmt_time = gmdate('Y/m/d H:i:s', strtotime($time));

            if(get_field('card_link_type',$postId) == "customLink"){
                $link = get_field('card_custom_link',$postId);
            }

            $contentTypeListSlug = "";
            if (is_array($contentTypeList) || is_object($contentTypeList)){
                foreach($contentTypeList as $cti){
                    $contentTypeListSlug .= $cti->slug." ";
                }
            }

            $industryListSlug = "";
            if (is_array($industryList) || is_object($industryList)){
                foreach($industryList as $ti){
                    $industryListSlug .= $ti->slug." ";
                }
            }

            $challengeListSlug = "";
            if (is_array($challengeList) || is_object($challengeList)){
                foreach($challengeList as $cti){
                    $challengeListSlug .= $cti->slug." ";
                }
            }
    ?>
        <div data-name="<?= $title; ?>" data-date="<?= $date.$time; ?>" data-time="<?= $time; ?>" class="card columnItem inlineBlock bottomSpace <?= $contentTypeListSlug; ?> <?= $industryListSlug; ?> <?= $challengeListSlug; ?> <?php if($i == 1 || $i == 2){ echo "columnTwo"; }else echo "columnThree"; ?> cardItem customerSuccessStoriesCardItem">
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
                                <img src="<?= $file; ?>" alt="">
                            </div>
                    <?php

                        }else{
                    ?>
                            <div class="sizer"></div>
                            <?= image_on_fly($image, array('695', 'auto'), false); ?>
                    <?php
                        }
                    ?>
                    </div>
                </div>
                <div class="cardTextContent">
                    <div class="cardTitleWrap cardTitleEqualHeight<?= $wid; ?>">
                        <h2 class="cardTitle"><?= $title; ?></h2>
                        <h2 class="datetime"><?= $gmt_time; ?></h2>
                    </div>
                    <div class="termsTextContentWrap cardTermsEqualHeight<?= $wid; ?>">
                        <?php
                            $selected_values = get_field('categories_select_list', $post_id);
                            if($selected_values) {
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
                                                'customer_stories_content_type',
                                                'customer_stories_challenge',
                                                'customer_stories_industry'
                                            );
                                            foreach ($applicable_taxonomies as $taxonomy) {
                                                $term = get_term_by('id', $term_id, $taxonomy);
                                                if ($term && !is_wp_error($term)) {
                                                    $term_link = get_term_link($term);
                                                    $term_name = $term->name;
                                                    ?>
                                                    <span class="termsItem"><a class="aLinkHover" href="<?= esc_url($term_link); ?>"><?= $term_name; ?></a></span>
                                                    <?php
                                                    break; // Break out of the loop once a valid term is found
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
                            <div class="termsWrap">
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
                                    if($contentTypeList){
                                        foreach($contentTypeList as $cTL){
                                            if($cTL->name != "Story"){
                                                $termLink = get_term_link( $cTL->term_id, $cTL->taxonomy );
                                ?>
                                    <span class="termsItem"><a class="aLinkHover" href="<?= $termLink; ?>"><?= $cTL->name; ?></a></span>
                                <?php
                                            }
                                        }
                                    }

                                    if($industryList){
                                        foreach($industryList as $iL){
                                            $termLink = get_term_link( $iL->term_id, $iL->taxonomy );
                                ?>
                                    <span class="termsItem"><a class="aLinkHover" href="<?= $termLink; ?>"><?= $iL->name; ?></a></span>
                                <?php
                                        }
                                    }

                                    if($challengeList){
                                        foreach($challengeList as $cL){
                                            $termLink = get_term_link( $cL->term_id, $cL->taxonomy );
                                ?>
                                    <span class="termsItem"><a class="aLinkHover" href="<?= $termLink; ?>"><?= $cL->name; ?></a></span>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                        <?php
                                }
                            }
                        ?>
                        <?php
                        ?>
                    </div>
                    <?php
                        if($description){
                    ?>
                        <div class="communityShowcaseCardItemDescWrap cardDescEqualHeight<?= $wid; ?>">
                        <?php
                            if($description){
                        ?>
                            <p><?= wordTrim($description,83); ?></p>
                        <?php
                            }
                        ?>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php
            $i++;
        }
    }else{

    }

    wp_reset_query();
}

add_action("wp_ajax_customerSuccessStoriesList", "customerSuccessStoriesList");
add_action("wp_ajax_nopriv_customerSuccessStoriesList", "customerSuccessStoriesList");


function contentHubList($data){
    $data = [];
    $searchText = filter_input(INPUT_POST, 'searchText');
    $paged = filter_input(INPUT_POST, 'paged');
    $ajax = filter_input(INPUT_POST, 'ajax');
    $industry = filter_input(INPUT_POST, 'industry');
    $industryId = "";
    $contentType = filter_input(INPUT_POST, 'contentType');
    $contentTypeId = "";
    $orderBy = filter_input(INPUT_POST, 'orderBy');
    $order = filter_input(INPUT_POST, 'order');
    $wid = filter_input(INPUT_POST, 'wid');
    $industryT = filter_input(INPUT_POST, 'industryT');
    $contentTypeT = filter_input(INPUT_POST, 'contentTypeT');
    $adminType = filter_input(INPUT_POST, 'adminType');
    $postType = "content_hub";

    if($industry){
        $industryId = get_term_by( 'slug', $industry, 'content_hub_topic' )->term_id;
    }

    if($contentType){
        $contentTypeId = get_term_by( 'slug', $contentType, 'content_hub_content_type' )->term_id;
    }

    $contentTypeCat = get_terms(['taxonomy' => 'content_hub_content_type', 'hide_empty'=>true]);
    $cId = array();
    foreach($contentTypeCat as $contentTypeCatData){
        $cId[] = $contentTypeCatData->term_id;
    }
    $topTypeCat = get_terms(['taxonomy' => 'content_hub_content_type', 'hide_empty'=>true]);
    $tId = array();
    foreach($topTypeCat as $topTypeCatData){
        $tId[] = $topTypeCatData->term_id;
    }

    if($paged){
        $paged = $paged;
    }else{
        $paged = $data['paged_no'];
    }

    if($industry){
        $industry = $industry;
    }else{
        $industry = $data['industry'];
    }

    $getOrderBy = $orderBy;
    $order = ($orderBy == "alphabetical") ? "title" : "publish_date";
    $orderBy = ($orderBy == "alphabetical") ? "asc" : $orderBy;

    $pin_args =  array(
        'post_type' => $postType,
        'post_status' => 'publish',
        'posts_per_page' => 2,
        'orderby' => 'publish_date',
        'order' => "desc",
        'meta_key' => 'content_hub_pin',
        'meta_value' => 1,
        'tax_query' => array('relation' => 'OR'),
    );

    if($industry != "" && $industry != 'all'){
        $industryCat = array('relation' => 'OR');
        array_push($industryCat, array(
            'taxonomy' => 'content_hub_topic',
            'terms' => $industryId,
            'field' => 'term_id',
        ));
        array_push($pin_args['tax_query'], $industryCat);
    }
    if($contentType != "" && $contentType != 'all'){
        $contentTypeCat = array('relation' => 'OR');
        array_push($contentTypeCat, array(
            'taxonomy' => 'content_hub_content_type',
            'terms' => $contentTypeId,
            'field' => 'term_id',
        ));
        array_push($pin_args['tax_query'], $contentTypeCat);
    }

    if(($industry != "" || $industry != 'all') && ($contentType != "" || $contentType != 'all')) {
        $pin_args =  array(
            'post_type' => $postType,
            'post_status' => 'publish',
            'posts_per_page' => 2,
            'orderby' => 'publish_date',
            'order' => "desc",
            'meta_key' => 'content_hub_pin',
            'meta_value' => 1,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                  'taxonomy' => 'content_hub_content_type',
                  'field'    => 'term_id',
                  'terms'    => $cId,
                  'operator' => 'EXISTS',
                ),
                array(
                  'taxonomy' => 'content_hub_topic',
                  'field'    => 'term_id',
                  'terms'    => $tId,
                  'operator' => 'EXISTS',
                )
            ),
        );
    }

    if($searchText)
        $pin_args['s'] = $searchText;

    $pin_query = new WP_Query($pin_args);

    $pIds = array();
    foreach($pin_query->posts as $pq){
        $pIds[] = $pq->ID;
    }

    if(count($pIds) == 1){
        $pIds = array();
    }

    $args = array(
        'post_type' => $postType,
        'post_status' => 'publish',
        'paged' => $paged,
        'posts_per_page' => 6,
        'post__not_in'   => ($paged == 1) ? $pIds : array(),
        'orderby' => $order,
        'order' => $orderBy,
        'tax_query' => array('relation' => 'OR'),
    );

    if(($industryT != '' && $contentTypeT != '') && ($contentType == '' && $contentType != 'all') && ($industry == '' && $industry != 'all')){
        $pin_args =  array(
            'post_type' => $postType,
            'post_status' => 'publish',
            'posts_per_page' => 2,
            'orderby' => 'publish_date',
            'order' => "desc",
            'meta_key' => 'content_hub_pin',
            'meta_value' => 1,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'content_hub_topic',
                    'terms' => explode(',', $industryT),
                    'field' => 'term_id',
                ),
                array(
                    'taxonomy' => 'content_hub_content_type',
                    'terms' => explode(',', $contentTypeT),
                    'field' => 'term_id',
                )
            ),
        );

        $pin_query = new WP_Query($pin_args);

        $pIds = array();
        foreach($pin_query->posts as $pq){
            $pIds[] = $pq->post_title.$pq->ID;
        }

        if(count($pIds) == 1){
            $pIds = array();
        }

        $args = array(
            'post_type' => $postType,
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'post__not_in'   => ($paged == 1) ? $pIds : array(),
            'paged' => $paged,
            'orderby' => $order,
            'order' => $orderBy,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'content_hub_topic',
                    'terms' => explode(',', $industryT),
                    'field' => 'term_id',
                ),
                array(
                    'taxonomy' => 'content_hub_content_type',
                    'terms' => explode(',', $contentTypeT),
                    'field' => 'term_id',
                )
            ),
        );
    }else{
        if($industryT != ''){
            if(($industryT != '' && $contentType != '') && $contentType != "all"){
                $pin_args =  array(
                    'post_type' => $postType,
                    'post_status' => 'publish',
                    'posts_per_page' => 2,
                    'orderby' => 'publish_date',
                    'order' => "desc",
                    'meta_key' => 'content_hub_pin',
                    'meta_value' => 1,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'content_hub_topic',
                            'terms' => explode(',', $industryT),
                            'field' => 'term_id',
                        ),
                        array(
                            'taxonomy' => 'content_hub_content_type',
                            'terms' => array($contentTypeId),
                            'field' => 'term_id',
                        )
                    ),
                );
                $pin_query = new WP_Query($pin_args);
                $pIds = array();
                foreach($pin_query->posts as $pq){
                    $pIds[] = $pq->ID;
                }

                if(count($pIds) == 1){
                    $pIds = array();
                }

                $args = array(
                    'post_type' => $postType,
                    'post_status' => 'publish',
                    'post__not_in'   => ($paged == 1) ? $pIds : array(),
                    'posts_per_page' => 6,
                    'paged' => $paged,
                    'orderby' => $order,
                    'order' => $orderBy,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'content_hub_topic',
                            'terms' => explode(',', $industryT),
                            'field' => 'term_id',
                        ),
                        array(
                            'taxonomy' => 'content_hub_content_type',
                            'terms' => array($contentTypeId),
                            'field' => 'term_id',
                        )
                    ),
                );
            }else{
                $pin_args =  array(
                    'post_type' => $postType,
                    'post_status' => 'publish',
                    'posts_per_page' => 2,
                    'orderby' => 'publish_date',
                    'order' => "desc",
                    'meta_key' => 'content_hub_pin',
                    'meta_value' => 1,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'content_hub_topic',
                            'terms' => explode(',', $industryT),
                            'field' => 'term_id',
                        )
                    ),
                );
                $pin_query = new WP_Query($pin_args);
                $pIds = array();
                foreach($pin_query->posts as $pq){
                    $pIds[] = $pq->ID;
                }

                if(count($pIds) == 1){
                    $pIds = array();
                }

                $args = array(
                    'post_type' => $postType,
                    'post_status' => 'publish',
                    'post__not_in'   => ($paged == 1) ? $pIds : array(),
                    'posts_per_page' => 6,
                    'paged' => $paged,
                    'orderby' => $order,
                    'order' => $orderBy,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'content_hub_topic',
                            'terms' => explode(',', $industryT),
                            'field' => 'term_id',
                        )
                    ),
                );
            }
        }

        if($contentTypeT != ''){
            if(($contentTypeT != '' && $industry != '') && $industry != "all"){
                $pin_args =  array(
                    'post_type' => $postType,
                    'post_status' => 'publish',
                    'posts_per_page' => 2,
                    'orderby' => 'publish_date',
                    'order' => "desc",
                    'meta_key' => 'content_hub_pin',
                    'meta_value' => 1,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'content_hub_content_type',
                            'terms' => explode(',', $contentTypeT),
                            'field' => 'term_id',
                        ),
                        array(
                            'taxonomy' => 'content_hub_topic',
                            'terms' => array($industryId),
                            'field' => 'term_id',
                        )
                    ),
                );
                $pin_query = new WP_Query($pin_args);
                $pIds = array();
                foreach($pin_query->posts as $pq){
                    $pIds[] = $pq->ID;
                }

                if(count($pIds) == 1){
                    $pIds = array();
                }

                $args = array(
                    'post_type' => $postType,
                    'post_status' => 'publish',
                    'posts_per_page' => 6,
                    'post__not_in'   => ($paged == 1) ? $pIds : array(),
                    'paged' => $paged,
                    'orderby' => $order,
                    'order' => $orderBy,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'content_hub_content_type',
                            'terms' => explode(',', $contentTypeT),
                            'field' => 'term_id',
                        ),
                        array(
                            'taxonomy' => 'content_hub_topic',
                            'terms' => array($industryId),
                            'field' => 'term_id',
                        )
                    ),
                );
            }else{
                $pin_args =  array(
                    'post_type' => $postType,
                    'post_status' => 'publish',
                    'posts_per_page' => 2,
                    'orderby' => 'publish_date',
                    'order' => "desc",
                    'meta_key' => 'content_hub_pin',
                    'meta_value' => 1,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'content_hub_content_type',
                            'terms' => explode(',', $contentTypeT),
                            'field' => 'term_id',
                        )
                    ),
                );
                $pin_query = new WP_Query($pin_args);
                $pIds = array();
                foreach($pin_query->posts as $pq){
                    $pIds[] = $pq->ID;
                }

                if(count($pIds) == 1){
                    $pIds = array();
                }

                $args = array(
                    'post_type' => $postType,
                    'post_status' => 'publish',
                    'posts_per_page' => 6,
                    'paged' => $paged,
                    'post__not_in'   => ($paged == 1) ? $pIds : array(),
                    'orderby' => $order,
                    'order' => $orderBy,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'content_hub_content_type',
                            'terms' => explode(',', $contentTypeT),
                            'field' => 'term_id',
                        )
                    ),
                );
            }
        }

    }

    if($adminType != "topicBased"){
        if($industry != "" && $industry != 'all'){
            $industryCat = array('relation' => 'OR');
            array_push($industryCat, array(
                'taxonomy' => 'content_hub_topic',
                'terms' => $industryId,
                'field' => 'term_id',
            ));
            array_push($args['tax_query'], $industryCat);
        }
        if($contentType != "" && $contentType != 'all'){
            $contentTypeCat = array('relation' => 'OR');
            array_push($contentTypeCat, array(
                'taxonomy' => 'content_hub_content_type',
                'terms' => $contentTypeId,
                'field' => 'term_id',
            ));
            array_push($args['tax_query'], $contentTypeCat);
        }
        if(($industry == "all" || $industry == "") && ($contentType == "all" || $contentType == "")){
            //Only get category selected post
            $args = array(
                'post_type' => $postType,
                'post_status' => 'publish',
                'paged' => $paged,
                'posts_per_page' => 6,
                'orderby' => $order,
                'order' => $orderBy,
                'post__not_in'   => $pIds,
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                      'taxonomy' => 'content_hub_content_type',
                      'field'    => 'term_id',
                      'terms'    => $cId,
                      'operator' => 'EXISTS',
                    ),
                    array(
                      'taxonomy' => 'content_hub_topic',
                      'field'    => 'term_id',
                      'terms'    => $tId,
                      'operator' => 'EXISTS',
                    )
                ),
            );
        }
    }

    if($searchText)
        $args['s'] = $searchText;

    $the_query = new WP_Query($args);
    $query = new WP_Query();

    if($getOrderBy == "asc"){
        $pin_query->posts = array_reverse($pin_query->posts);
    }else if($getOrderBy == "alphabetical"){
        function compareByName($a, $b) {
            return strcmp($a->post_title, $b->post_title);
        }
        usort($pin_query->posts, 'compareByName');
    }

    if(empty($pIds)){
        $query->posts = $the_query->posts;
    }else{
        $query->posts = ($paged == 1) ? array_merge($pin_query->posts, $the_query->posts ) : $the_query->posts;
    }

    $i = 1;
    if($query->posts){
        foreach($query->posts as $qp){
            $postId = $qp->ID;
            $title = get_the_title($postId);
            $image = get_field('content_hub_image',$postId);
            $contentTypeList = get_the_terms($postId, 'content_hub_content_type');
            $industryList = get_the_terms($postId, 'content_hub_topic');
            $pin = get_field('content_hub_pin',$postId);
            $selected_values = get_field('categories_select_list', $postId);
            $description = get_field('content_hub_description',$postId);
            $description = ($description) ? wordTrim($description,83) : '';
            $link = get_permalink($postId);
            $date = get_the_date('d M Y',$postId);
            $time = get_post_time($postId);
            $wid = $wid;

            if(get_field('card_link_type',$postId) == "customLink"){
                $link = get_field('card_custom_link',$postId);
            }

            $contentTypeListSlug = "";
            foreach($contentTypeList as $ti){
                $contentTypeListSlug .= $ti->slug." ";
            }

            $industryListSlug = "";
            foreach($industryList as $ti){
                $industryListSlug .= $ti->slug." ";
            }
            include(__DIR__ . '/../widgets/blocks/card.php');

            $i++;
        }

        $nextpage = $paged + 1;
        $prevouspage = $paged - 1;
        $total = $the_query->max_num_pages;

        $pagination_args = array(
            'base' => '%_%',
            'format' => '?paged_no=%#%',
            'total' => $total,
            'current' => $paged,
            'prev_text' => __('<span class="roundArrow" data-attr="' . $prevouspage . '"><i class="arrAcon left"></i></span>'),
            'next_text' => __('<span class="roundArrow" data-attr="' . $nextpage . '"><i class="arrAcon"></i></span>'),
            'type' => 'list'
        );

        $paginate_links = paginate_links($pagination_args);

        if ($paginate_links) {
            echo '<div class="modernPagination">';
            echo '<div class="contenthubfilterpage ajax-pageouter">' . $paginate_links . '</div>';
            echo '</div>';
        }

        if($ajax == 1){
            wp_reset_query();
            exit;
        }
    }else{
        die(0);
    }

    wp_reset_query();
}

add_action("wp_ajax_contentHubList", "contentHubList");
add_action("wp_ajax_nopriv_contentHubList", "contentHubList");


function communityShowcaseList($wid,$pin,$adminType,$dataIndustry,$dataContentType,$dataFeature){

    $allQuery = [];

    if($adminType == "topicBased"){
        if(!empty($dataIndustry) || !empty($dataContentType) || !empty($dataFeature)){
            // Only Pin Record
            $pincspargs =  array(
                'post_type' => "community_showcase",
                'post_status' => 'publish',
                'posts_per_page' => 2,
                "meta_key" => 'community_showcase_pin',
                'orderby' => array(
                    'meta_value_num' => '1',
                    'date' => 'DESC',
                ),
                'tax_query' => array('relation' => 'OR'),
            );

            if($dataIndustry != ""){
                $industryCat = array('relation' => 'OR');
                array_push($industryCat, array(
                    'taxonomy' => 'community_showcase_industry',
                    'terms' => $dataIndustry,
                    'field' => 'term_id',
                ));
                array_push($pincspargs['tax_query'], $industryCat);
            }
            if($dataContentType != ""){
                $contentTypeCat = array('relation' => 'OR');
                array_push($contentTypeCat, array(
                    'taxonomy' => 'community_showcase_content_type',
                    'terms' => $dataContentType,
                    'field' => 'term_id',
                ));
                array_push($pincspargs['tax_query'], $contentTypeCat);
            }
            if($dataFeature != ""){
                $featureCat = array('relation' => 'OR');
                array_push($featureCat, array(
                    'taxonomy' => 'community_showcase_feature',
                    'terms' => $dataFeature,
                    'field' => 'term_id',
                ));
                array_push($pincspargs['tax_query'], $featureCat);
            }

            $pin_query = new WP_Query($pincspargs);
            $pinQuery = $pin_query->posts;

            $pIds = array();
            foreach($pin_query->posts as $pq){
                if(get_post_meta($pq->ID, 'community_showcase_pin', true) == "1"){
                    $pIds[] = $pq->ID;
                }
            }
            if(count($pIds) == 1){
                $pIds = array();
                $pinQuery = array();
            }
            wp_reset_query();

            // All Record
            $cspargs = array(
                'post_type' => "community_showcase",
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post__not_in'   => $pIds,
                'tax_query' => array('relation' => 'OR'),
                'orderby' => 'publish_date',
                'order' => "desc",
            );

            if($dataIndustry != ""){
                $industryCat = array('relation' => 'OR');
                array_push($industryCat, array(
                    'taxonomy' => 'community_showcase_industry',
                    'terms' => $dataIndustry,
                    'field' => 'term_id',
                ));
                array_push($cspargs['tax_query'], $industryCat);
            }
            if($dataContentType != ""){
                $contentTypeCat = array('relation' => 'OR');
                array_push($contentTypeCat, array(
                    'taxonomy' => 'community_showcase_content_type',
                    'terms' => $dataContentType,
                    'field' => 'term_id',
                ));
                array_push($cspargs['tax_query'], $contentTypeCat);
            }
            if($dataFeature != ""){
                $featureCat = array('relation' => 'OR');
                array_push($featureCat, array(
                    'taxonomy' => 'community_showcase_feature',
                    'terms' => $dataFeature,
                    'field' => 'term_id',
                ));
                array_push($cspargs['tax_query'], $featureCat);
            }

            $cs_pin_query = new WP_Query($cspargs);
            $allQuery = $cs_pin_query->posts;
        }else{

            // Only Pin Record
            $pincspargs =  array(
                'post_type' => "community_showcase",
                'post_status' => 'publish',
                'posts_per_page' => 2,
                "meta_key" => 'community_showcase_pin',
                'orderby' => array(
                    'meta_value_num' => '1',
                    'date' => 'DESC',
                ),
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                      'taxonomy' => 'community_showcase_industry',
                      'operator' => 'EXISTS',
                    ),
                    array(
                      'taxonomy' => 'community_showcase_content_type',
                      'operator' => 'EXISTS',
                    ),
                    array(
                        'taxonomy' => 'community_showcase_feature',
                        'operator' => 'EXISTS',
                    )
                ),
            );

            $pin_query = new WP_Query($pincspargs);
            $pinQuery = $pin_query->posts;
            $pIds = array();
            foreach($pin_query->posts as $pq){
                if(get_post_meta($pq->ID, 'community_showcase_pin', true) == "1"){
                    $pIds[] = $pq->ID;
                }
            }
            if(count($pIds) == 1){
                $pIds = array();
                $pinQuery = array();
            }
            wp_reset_query();

            // All Record
            $cspargs = array(
                'post_type' => "community_showcase",
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post__not_in'   => $pIds,
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                      'taxonomy' => 'community_showcase_industry',
                      'operator' => 'EXISTS',
                    ),
                    array(
                      'taxonomy' => 'community_showcase_content_type',
                      'operator' => 'EXISTS',
                    ),
                    array(
                        'taxonomy' => 'community_showcase_feature',
                        'operator' => 'EXISTS',
                    )
                ),
                'orderby' => 'publish_date',
                'order' => "desc",
            );

            $cs_pin_query = new WP_Query($cspargs);
            $allQuery = $cs_pin_query->posts;
        }
    }else{
        $pincspargs =  array(
            'post_type' => "community_showcase",
            'post_status' => 'publish',
            'posts_per_page' => 2,
            "meta_key" => 'community_showcase_pin',
            'orderby' => array(
                'meta_value_num' => '1',
                'date' => 'DESC',
            ),
            'tax_query' => array(
                'relation' => 'OR',
                array(
                  'taxonomy' => 'community_showcase_industry',
                  'operator' => 'EXISTS',
                ),
                array(
                  'taxonomy' => 'community_showcase_content_type',
                  'operator' => 'EXISTS',
                ),
                array(
                    'taxonomy' => 'community_showcase_feature',
                    'operator' => 'EXISTS',
                )
            ),
        );

        $pin_query = new WP_Query($pincspargs);
        $pinQuery = $pin_query->posts;
        $pIds = array();
        foreach($pin_query->posts as $pq){
            if(get_post_meta($pq->ID, 'community_showcase_pin', true) == "1"){
                $pIds[] = $pq->ID;
            }
        }
        if(count($pIds) == 1){
            $pIds = array();
            $pinQuery = array();
        }
        wp_reset_query();

        // All Record
        $cspargs = array(
            'post_type' => "community_showcase",
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'post__not_in'   => $pIds,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                  'taxonomy' => 'community_showcase_industry',
                  'operator' => 'EXISTS',
                ),
                array(
                  'taxonomy' => 'community_showcase_content_type',
                  'operator' => 'EXISTS',
                ),
                array(
                    'taxonomy' => 'community_showcase_feature',
                    'operator' => 'EXISTS',
                )
            ),
            'orderby' => 'publish_date',
            'order' => "desc",
        );

        $cs_pin_query = new WP_Query($cspargs);
        $allQuery = $cs_pin_query->posts;
    }

    $query = "";

    if($pin == "no"){
        $query = $allQuery;
    }else{
        $query = $pinQuery;
    }

    if (!empty($query)) {
        $i = 1;
        foreach($query as $aq) {
            $postId = $aq->ID;
            $title = get_the_title($postId);
            $image = get_field('community_showcase_image',$postId);
            $selected_values = get_field('categories_select_list', $postId);
            $contentTypeList = get_the_terms($postId, 'community_showcase_content_type');
            $industryList = get_the_terms($postId, 'community_showcase_industry');
            $featureList = get_the_terms($postId, 'community_showcase_feature');
            $pin = get_field('community_showcase_pin',$postId);
            $description = "";
            $link = get_permalink($postId);
            $date = get_the_date('d M Y',$postId);
            $time = get_post_time('Y/m/d H:i:s', false, $postId);
            $gmt_time = gmdate('Y/m/d H:i:s', strtotime($time));
            $wid = $wid;
            $cardClass='communityShowcase';

            if(get_field('card_link_type',$postId) == "customLink"){
                $link = get_field('card_custom_link',$postId);
            }

            $contentTypeListSlug = "";

            if($contentTypeList != ""){
                foreach($contentTypeList as $ti){
                    $contentTypeListSlug .= $ti->slug." ";
                }
            }

            $industryListSlug = "";

            if($industryList != ""){
                foreach($industryList as $ti){
                    $industryListSlug .= $ti->slug." ";
                }
            }

            $featureListSlug = "";

            if($featureList != ""){
                foreach($featureList as $ti){
                    $featureListSlug .= $ti->slug." ";
                }
            }
            include(__DIR__ . '/../widgets/blocks/card.php');

            $i++;
        }
    }

    wp_reset_query();
}

add_action("wp_ajax_communityShowcaseList", "communityShowcaseList");
add_action("wp_ajax_nopriv_communityShowcaseList", "communityShowcaseList");


function integrateList($wid,$adminType,$dataContentType,$priorityPosts){

    if($priorityPosts > 0){
        $pIds = array();
        foreach($priorityPosts as $pp){
            $pIds[] = $pp['integrate_list_priority_posts_post'];
        }
    }

    if($adminType == "topicBased"){
        $args = array(
            'post_type' => "integrate",
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array('relation' => 'OR'),
            'orderby' => 'publish_date',
            'order' => "DESC",
        );

        if(!empty($dataContentType)){
            if($dataContentType != ""){
                $contentTypeCat = array('relation' => 'OR');
                array_push($contentTypeCat, array(
                    'taxonomy' => 'integrate_type',
                    'terms' => $dataContentType,
                    'field' => 'term_id',
                ));
                array_push($args['tax_query'], $contentTypeCat);
            }
        }
    }else{
        if($pIds > 0){
            $pargs = array(
                'post_type' => "integrate",
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post__in' => $pIds,
                'orderby' => 'post__in',
                'order' => "DESC",
            );
            $pquery = new WP_Query($pargs);

            $pwargs = array(
                'post_type' => "integrate",
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post__not_in'   => $pIds,
                'orderby' => 'publish_date',
                'order' => "DESC",
            );
            $pwquery = new WP_Query($pwargs);

            $query = new WP_Query();
            $query->posts = array_merge( $pquery->posts, $pwquery->posts );
            $i = 3;
            foreach($query->posts as $qp){
                $postId = $qp->ID;
                $title = get_the_title($postId);
                $description = get_field('integrate_description',$postId);
                $image = get_field('integrate_image',$postId);
                $contentTypeList = get_the_terms($postId, 'integrate_type');
                // $link = get_permalink($postId);
                $date = get_the_date('dmY',$postId);
                $time = get_post_time($postId);
                $cardClass = "integrateCardItem";
                $wid = $wid;

                $contentTypeListSlug = "";

                if($contentTypeList != ""){
                    foreach($contentTypeList as $ti){
                        $contentTypeListSlug .= $ti->slug." ";
                    }
                }

                // if(get_field('card_link_type',$postId) == "customLink"){
                //     $link = get_field('card_custom_link',$postId);
                // }

                include(__DIR__ . '/../widgets/blocks/card.php');
                $i++;
            }

            wp_reset_query();

        }else{
            $args = array(
                'post_type' => "integrate",
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'tax_query' => array('relation' => 'OR'),
                'orderby' => 'publish_date',
                'order' => "DESC",
            );
            $query = new WP_Query($args);
        }
    }

    if ($query->have_posts()) {
        $i = 3;
        while ($query->have_posts()) {
            $query->the_post();
            $postId = get_the_ID();
            $title = get_the_title($postId);
            $description = get_field('integrate_description',$postId);
            $image = get_field('integrate_image',$postId);
            $contentTypeList = get_the_terms($postId, 'integrate_type');
            // $link = get_permalink($postId);
            $date = get_the_date('dmY',$postId);
            $time = get_post_time($postId);
            $cardClass = "integrateCardItem";
            $wid = $wid;

            $contentTypeListSlug = "";

            if($contentTypeList != ""){
                foreach($contentTypeList as $ti){
                    $contentTypeListSlug .= $ti->slug." ";
                }
            }

            // if(get_field('card_link_type',$postId) == "customLink"){
            //     $link = get_field('card_custom_link',$postId);
            // }

            include(__DIR__ . '/../widgets/blocks/card.php');
            $i++;
        }
    }
    wp_reset_query();
}

add_action("wp_ajax_integrateList", "integrateList");
add_action("wp_ajax_nopriv_integrateList", "integrateList");

function templatesList($wid,$adminType,$dataContentType,$desc){
    if($adminType == "topicBased"){
        $args = array(
            'post_type' => "templates",
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array('relation' => 'OR'),
            'orderby' => 'publish_date',
            'order' => "DESC",
        );

        if(!empty($dataContentType)){
            if($dataContentType != ""){
                $contentTypeCat = array('relation' => 'OR');
                array_push($contentTypeCat, array(
                    'taxonomy' => 'templates_content_type',
                    'terms' => $dataContentType,
                    'field' => 'term_id',
                ));
                array_push($args['tax_query'], $contentTypeCat);
            }
        }
    }else{
        $args = array(
            'post_type' => "templates",
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array('relation' => 'OR'),
            'orderby' => 'publish_date',
            'order' => "DESC",
        );
    }

    $query = new WP_Query($args);
    $showDate = get_sub_field('templates_list_date');
    if ($query->have_posts()) {
        $i = 3;
        while ($query->have_posts()) {
            $query->the_post();
            $postId = get_the_ID();
            $title = get_the_title($postId);
            $description = ($desc == "show") ? get_field('templates_description',$postId) : "";
            $image = get_field('templates_image',$postId);
            $contentTypeList = get_the_terms($postId, 'templates_content_type');
            $link = get_permalink($postId);
            $date = ($showDate != 'hide') ? get_the_date('dmY',$postId) : '';
            $newsDate = ($showDate != 'hide') ? get_the_date('d M Y',$postId) : '';
            $time = get_post_time($postId);
            $cardClass = "templatesCardItem";
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

            include(__DIR__ . '/../widgets/blocks/card.php');
            $i++;
        }
    }
    wp_reset_query();
}

add_action("wp_ajax_templatesList", "templatesList");
add_action("wp_ajax_nopriv_templatesList", "templatesList");

function newsList($wid,$adminType,$dataContentType){
    if($adminType == "topicBased"){
        $args = array(
            'post_type' => "post",
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array('relation' => 'OR'),
            'orderby' => 'publish_date',
            'order' => "DESC",
        );

        if(!empty($dataContentType)){
            if($dataContentType != ""){
                $contentTypeCat = array('relation' => 'OR');
                array_push($contentTypeCat, array(
                    'taxonomy' => 'category',
                    'terms' => $dataContentType,
                    'field' => 'term_id',
                ));
                array_push($args['tax_query'], $contentTypeCat);
            }
        }
    }else{
        $args = array(
            'post_type' => "post",
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array('relation' => 'OR'),
            'orderby' => 'publish_date',
            'order' => "DESC",
        );
    }

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        $i = 3;
        while ($query->have_posts()) {
            $query->the_post();
            $postId = get_the_ID();
            $title = get_the_title($postId);
            $description = get_field('news_description',$postId);
            $image = get_field('news_image',$postId);
            $contentTypeList = get_the_terms($postId, 'category');
            $link = get_permalink($postId);
            $date = get_the_date('dmY',$postId);
            $newsDate = get_the_date('jS F Y',$postId);
            $time = get_post_time($postId);
            $cardClass = "newsCardItem";
            $wid = $wid;

            $contentTypeListSlug = "";

            if($contentTypeList != ""){
                foreach($contentTypeList as $ti){
                    $contentTypeListSlug .= $ti->slug." ";
                }
            }

            if(get_field('card_link_type',$postId) == "customLink"){
                $link = get_field('card_custom_link',$postId);
            }

            include(__DIR__ . '/../widgets/blocks/card.php');
            $i++;
        }
    }
    wp_reset_query();
}

add_action("wp_ajax_newsList", "newsList");
add_action("wp_ajax_nopriv_newsList", "newsList");

function getYoutubeEmbedUrl($url){
     $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
     $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}

add_shortcode( 'youtube', 'youtube' );
function youtube( $atts, $content = "" ) {
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';
    if (preg_match($longUrlRegex, $content, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    if (preg_match($shortUrlRegex, $content, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    $url = 'https://www.youtube.com/embed/' . $youtube_id ;
    return '<div class="iframeVideoWrap"><iframe src="'.$url.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
}


// Quote widget shortcode
add_shortcode('quote', 'quote');
function quote($atts, $content = null) {
    extract(shortcode_atts(array('post_id' => '', 'bg_color' => '', 'quotation_mark' => ''), $atts));
    // bg_color =>
    // lightBlue
    // lightGreen
    // lightPink
    // purple
    // bgBlue

    // post_id => Testimonial's Single Page Id
    // quotation_mark => To show & hide quotation mark on Quote Widget
    ob_start();
    if($post_id && $bg_color){
    ?>
    <div class="quote <?= $bg_color ?> <?= $setClass; ?>">
        <div class="quoteWrap <?= get_sub_field('quote_width') ?> <?= get_sub_field('quote_align') ?>">
            <?php
                $postId = $post_id;
                $title = get_the_title($postId);
                if($quotation_mark != 'hide') {                    
                    $showQuotes = get_field('testimonials_show_quotes',$postId);
                }
                $quotes = get_field('testimonials_quotes',$postId);
                $companyLogo = get_field('testimonials_company_logo',$postId);
                $link = get_field('testimonials_link',$postId);
                $image = get_field('testimonials_image',$postId);
                $designation = get_field('testimonials_designation',$postId);
                $companyName = get_field('testimonials_company_name',$postId);
                $companyWeb = get_field('testimonials_company_website',$postId);
                $bgColor = get_sub_field('quote_background_color');
                $textColor = get_sub_field('quote_text_color');
                $buttonLabel = get_field('testimonials_button_label',$postId);
                $buttonLink = get_field('testimonials_button_page_link',$postId);
                if(get_field('testimonials_button_type',$postId) == "external"){
                    $buttonLink = get_field('testimonials_button_external_link',$postId);
                }
                include(__DIR__ . '/../widgets/blocks/testimonialsCard.php');
            ?>
        </div>
    </div>
    <?php
    }
    return ob_get_clean();
}

// Highlight Card widget shortcode
add_shortcode('highlight_card', 'highlight_card');
function highlight_card($atts, $content = null) {
    extract(shortcode_atts(array('image_id' => '', 'bg_color' => '', 'title' => '', 'text' => ''), $atts));
    ob_start();
    // bg_color =>
    // lightBlue
    // lightGreen
    // lightPink
    // purple
    // bgBlue

    // image_id => Media uploaded Image's Id
    if($image_id && $bg_color && $title && $text){
    ?>
    <div class="highlightCard">
        <div class="highlightCardWrap">
            <div class="highlightCard <?= $bg_color ?>">
                <div class="highlightCardContents">
                    <?php
                        $file = wp_get_attachment_image_src( $image_id, 'full' );
                        if($file){
                            $imgWidth = $file[2];
                            $paddingTop = $file[2] / $file[1] * 100;
                            $paddingTop = number_format((float)$paddingTop, 2, '.', '');
                        }
                    ?>
                    <div class="highlightCardImage">
                        <div class="sizer" style="padding-top: <?= $paddingTop; ?>%;"></div>
                        <?= image_on_fly($image_id, array('100', 'auto'), false); ?>
                    </div>
                    <div class="highlightCardTextContent">
                        <h3 class="size24"><?= $title; ?></h3>
                        <p class="size16 highlightCardText"><?= $text ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    return ob_get_clean();
}