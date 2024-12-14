<?php
global $wp;
$post_id = get_the_ID();
$header_post = get_posts(array(
    'post_type' => 'header',
    'numberposts' => 1,
));
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
    <head>
        <!-- Start cookieyes banner --> 
        <script id="cookieyes" type="text/javascript" src="https://cdn-cookieyes.com/client_data/02814150a44a5ed23fbfa500/script.js"></script> 
        <!-- End cookieyes banner -->
        <script type="text/javascript">
            /*! modernizr 3.6.0 (Custom Build) | MIT *
            * https://modernizr.com/download/?-cssanimations-csstransforms-csstransforms3d-csstransitions-touchevents-setclasses-cssclassprefix:has- !*/
            !function(e,n,t){function r(e,n){return typeof e===n}function s(){var e,n,t,s,o,i,a;for(var l in S)if(S.hasOwnProperty(l)){if(e=[],n=S[l],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(s=r(n.fn,"function")?n.fn():n.fn,o=0;o<e.length;o++)i=e[o],a=i.split("."),1===a.length?Modernizr[a[0]]=s:(!Modernizr[a[0]]||Modernizr[a[0]]instanceof Boolean||(Modernizr[a[0]]=new Boolean(Modernizr[a[0]])),Modernizr[a[0]][a[1]]=s),C.push((s?"":"no-")+a.join("-"))}}function o(e){var n=_.className,t=Modernizr._config.classPrefix||"";if(x&&(n=n.baseVal),Modernizr._config.enableJSClass){var r=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(r,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),x?_.className.baseVal=n:_.className=n)}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):x?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function a(){var e=n.body;return e||(e=i(x?"svg":"body"),e.fake=!0),e}function l(e,t,r,s){var o,l,u,f,c="modernizr",d=i("div"),p=a();if(parseInt(r,10))for(;r--;)u=i("div"),u.id=s?s[r]:c+(r+1),d.appendChild(u);return o=i("style"),o.type="text/css",o.id="s"+c,(p.fake?p:d).appendChild(o),p.appendChild(d),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(n.createTextNode(e)),d.id=c,p.fake&&(p.style.background="",p.style.overflow="hidden",f=_.style.overflow,_.style.overflow="hidden",_.appendChild(p)),l=t(d,e),p.fake?(p.parentNode.removeChild(p),_.style.overflow=f,_.offsetHeight):d.parentNode.removeChild(d),!!l}function u(e,n){return!!~(""+e).indexOf(n)}function f(e){return e.replace(/([a-z])-([a-z])/g,function(e,n,t){return n+t.toUpperCase()}).replace(/^-/,"")}function c(e,n){return function(){return e.apply(n,arguments)}}function d(e,n,t){var s;for(var o in e)if(e[o]in n)return t===!1?e[o]:(s=n[e[o]],r(s,"function")?c(s,t||n):s);return!1}function p(e){return e.replace(/([A-Z])/g,function(e,n){return"-"+n.toLowerCase()}).replace(/^ms-/,"-ms-")}function m(n,t,r){var s;if("getComputedStyle"in e){s=getComputedStyle.call(e,n,t);var o=e.console;if(null!==s)r&&(s=s.getPropertyValue(r));else if(o){var i=o.error?"error":"log";o[i].call(o,"getComputedStyle returning null, its possible modernizr test results are inaccurate")}}else s=!t&&n.currentStyle&&n.currentStyle[r];return s}function v(n,r){var s=n.length;if("CSS"in e&&"supports"in e.CSS){for(;s--;)if(e.CSS.supports(p(n[s]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var o=[];s--;)o.push("("+p(n[s])+":"+r+")");return o=o.join(" or "),l("@supports ("+o+") { #modernizr { position: absolute; } }",function(e){return"absolute"==m(e,null,"position")})}return t}function h(e,n,s,o){function a(){c&&(delete k.style,delete k.modElem)}if(o=r(o,"undefined")?!1:o,!r(s,"undefined")){var l=v(e,s);if(!r(l,"undefined"))return l}for(var c,d,p,m,h,y=["modernizr","tspan","samp"];!k.style&&y.length;)c=!0,k.modElem=i(y.shift()),k.style=k.modElem.style;for(p=e.length,d=0;p>d;d++)if(m=e[d],h=k.style[m],u(m,"-")&&(m=f(m)),k.style[m]!==t){if(o||r(s,"undefined"))return a(),"pfx"==n?m:!0;try{k.style[m]=s}catch(g){}if(k.style[m]!=h)return a(),"pfx"==n?m:!0}return a(),!1}function y(e,n,t,s,o){var i=e.charAt(0).toUpperCase()+e.slice(1),a=(e+" "+N.join(i+" ")+i).split(" ");return r(n,"string")||r(n,"undefined")?h(a,n,s,o):(a=(e+" "+j.join(i+" ")+i).split(" "),d(a,n,t))}function g(e,n,r){return y(e,t,t,n,r)}var C=[],S=[],w={_version:"3.6.0",_config:{classPrefix:"has-",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){S.push({name:e,fn:n,options:t})},addAsyncTest:function(e){S.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=w,Modernizr=new Modernizr;var _=n.documentElement,x="svg"===_.nodeName.toLowerCase(),b=w._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):["",""];w._prefixes=b;var T="CSS"in e&&"supports"in e.CSS,z="supportsCSS"in e;Modernizr.addTest("supports",T||z);var P=w.testStyles=l;Modernizr.addTest("touchevents",function(){var t;if("ontouchstart"in e||e.DocumentTouch&&n instanceof DocumentTouch)t=!0;else{var r=["@media (",b.join("touch-enabled),("),"heartz",")","{#modernizr{top:9px;position:absolute}}"].join("");P(r,function(e){t=9===e.offsetTop})}return t});var E="Moz O ms Webkit",N=w._config.usePrefixes?E.split(" "):[];w._cssomPrefixes=N;var j=w._config.usePrefixes?E.toLowerCase().split(" "):[];w._domPrefixes=j;var A={elem:i("modernizr")};Modernizr._q.push(function(){delete A.elem});var k={style:A.elem.style};Modernizr._q.unshift(function(){delete k.style}),w.testAllProps=y,w.testAllProps=g,Modernizr.addTest("cssanimations",g("animationName","a",!0)),Modernizr.addTest("csstransforms",function(){return-1===navigator.userAgent.indexOf("Android 2.")&&g("transform","scale(1)",!0)}),Modernizr.addTest("csstransforms3d",function(){return!!g("perspective","1px",!0)}),Modernizr.addTest("csstransitions",g("transition","all",!0)),s(),o(C),delete w.addTest,delete w.addAsyncTest;for(var q=0;q<Modernizr._q.length;q++)Modernizr._q[q]();e.Modernizr=Modernizr}(window,document);
        </script>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="icon" href="<?php echo get_bloginfo('template_directory') ?>/assets/images/tafreed.png">
        <script type="text/javascript">
            var _app_prefix = '<?php echo get_bloginfo('template_directory'); ?>';
            var ajax_url = "<?php echo admin_url(); ?>admin-ajax.php";
        </script>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBDL44N"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div class="viewport">
            <?php
                $headerid = url_to_postid('/header/header-footer');
                $post = get_post($headerid);
                setup_postdata($post);
            ?>
            <div class="header">
                <div class="c">
                    <div class="desktopHeader">
                        <div class="headerWrap">
                            <div class="logoWrap">
                                <a href="<?= home_url(); ?>" class="logo">
                                    <img class="logoImage" src="<?= get_bloginfo('template_directory'); ?>/assets/images/tafreed.png" />
                                </a>
                            </div>
                            <div class="menuWrap">
                                <div class="mainMenuWrap">
                                    <?php
                                        if (!empty($header_post)) {
                                            $post_id = $header_post[0]->ID;
                                            if (have_rows('main_menu', $post_id)) {
                                                while (have_rows('main_menu', $post_id)) {
                                                    the_row();
                                                    $menu_text = get_sub_field('menu_text');
                                                    $menu_link = get_sub_field('menu_link');
                                                    $show_mega_menu = get_sub_field('show_mega_menu');
                                                    $menu_id = 'menu_' . get_row_index();
                                                    if ($menu_text) {
                                                        ?>
                                                            <div class="header_menu_text <?= $show_mega_menu ? 'hasMegaMenu' : ''?>" data-menu="<?= $menu_id ?>">
                                                                <a href='<?= $menu_link; ?>'><?= $menu_text; ?></a>
                                                                <?php
                                                                    if($show_mega_menu) {
                                                                        ?>
                                                                            <span class="dropDown down"></span>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </div>
                                                        <?php
                                                    }
                                                }
                                            } 
                                        }
                                    ?>
                                </div>
                                <div class="mobileMenu">
                                    <a class="mobileMenuBtn mobileMenuOpenBtn"><span class="line"></span></a>
                                </div>
                            </div>
                            <div class="subMenuWrap">
                                <?php
                                    if (!empty($header_post)) {
                                        $post_id = $header_post[0]->ID;
                                        if (have_rows('main_menu', $post_id)) {
                                            while (have_rows('main_menu', $post_id)) {
                                                the_row();
                                                $show_mega_menu = get_sub_field('show_mega_menu');
                                                $column_type = get_sub_field('mega_menu_column'); // Get column selection: single_col, two_col, three_col
                                                $show_image = get_sub_field('show_image'); // Check if the show_image option is selected

                                                if ($show_mega_menu) {
                                                    $menu_id = 'menu_' . get_row_index();
                                                    // Get the sub-menu items
                                                    $sub_menu_items = [];
                                                    if (have_rows('sub_menu')) {
                                                        while (have_rows('sub_menu')) {
                                                            the_row();
                                                            $sub_menu_text = get_sub_field('sub_menu_text');
                                                            $sub_menu_link = get_sub_field('sub_menu_link');
                                                            $sub_menu_items[] = ['text' => $sub_menu_text, 'link' => $sub_menu_link];
                                                        }
                                                    }

                                                    // Handle layout based on the column type and show_image option
                                                    echo '<div class="mega-menu" data-menu="' . esc_attr($menu_id) . '">';
                                                        if ($column_type == 'single_col') {
                                                            echo '<div class="menu-column single-column">';
                                                            foreach ($sub_menu_items as $item) {
                                                                echo '<div class="menu-item"><a href="' . esc_url($item['link']) . '">' . esc_html($item['text']) . '</a></div>';
                                                            }
                                                            echo '</div>';
                                                        } elseif ($column_type == 'two_col') {
                                                            $half = ceil(count($sub_menu_items) / 2); // Split into two halves
                                                            echo '<div class="menu-column two-columns">';
                                                            for ($i = 0; $i < $half; $i++) {
                                                                echo '<div class="menu-item"><a href="' . esc_url($sub_menu_items[$i]['link']) . '">' . esc_html($sub_menu_items[$i]['text']) . '</a></div>';
                                                            }
                                                            echo '</div>'; // Close the first column

                                                            echo '<div class="menu-column two-columns">';
                                                            for ($i = $half; $i < count($sub_menu_items); $i++) {
                                                                echo '<div class="menu-item"><a href="' . esc_url($sub_menu_items[$i]['link']) . '">' . esc_html($sub_menu_items[$i]['text']) . '</a></div>';
                                                            }
                                                            echo '</div>'; // Close the second column
                                                        } elseif ($column_type == 'three_col') {
                                                            // If show_image is checked, create three columns with the last one containing the image
                                                            if ($show_image) {
                                                                // Split the sub-menu items into two parts
                                                                $half = ceil(count($sub_menu_items) / 2);

                                                                // First column with first part of the menu links
                                                                echo '<div class="menu-column three-columns">';
                                                                for ($i = 0; $i < $half; $i++) {
                                                                    echo '<div class="menu-item"><a href="' . esc_url($sub_menu_items[$i]['link']) . '">' . esc_html($sub_menu_items[$i]['text']) . '</a></div>';
                                                                }
                                                                echo '</div>'; // Close the first column

                                                                // Second column with second part of the menu links
                                                                echo '<div class="menu-column three-columns">';
                                                                for ($i = $half; $i < count($sub_menu_items); $i++) {
                                                                    echo '<div class="menu-item"><a href="' . esc_url($sub_menu_items[$i]['link']) . '">' . esc_html($sub_menu_items[$i]['text']) . '</a></div>';
                                                                }
                                                                echo '</div>'; // Close the second column
                                                                ?>
                                                                <div class="menu-column three-columns image-column">
                                                                    <div class="sizer"></div>
                                                                        <?php
                                                                            $image_url = get_sub_field('image'); // Get image ID or URL (depending on your ACF setup)
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
                                                                    <?php
                                                            } else {
                                                                // No image: Standard 3-column layout
                                                                $third = ceil(count($sub_menu_items) / 3); // Split into three parts
                                                                $count = count($sub_menu_items);

                                                                // First column
                                                                echo '<div class="menu-column three-columns">';
                                                                for ($i = 0; $i < $third; $i++) {
                                                                    echo '<div class="menu-item"><a href="' . esc_url($sub_menu_items[$i]['link']) . '">' . esc_html($sub_menu_items[$i]['text']) . '</a></div>';
                                                                }
                                                                echo '</div>'; // Close the first column

                                                                // Second column
                                                                echo '<div class="menu-column three-columns">';
                                                                for ($i = $third; $i < 2 * $third && $i < $count; $i++) {
                                                                    echo '<div class="menu-item"><a href="' . esc_url($sub_menu_items[$i]['link']) . '">' . esc_html($sub_menu_items[$i]['text']) . '</a></div>';
                                                                }
                                                                echo '</div>'; // Close the second column

                                                                // Third column
                                                                echo '<div class="menu-column three-columns">';
                                                                for ($i = 2 * $third; $i < $count; $i++) {
                                                                    echo '<div class="menu-item"><a href="' . esc_url($sub_menu_items[$i]['link']) . '">' . esc_html($sub_menu_items[$i]['text']) . '</a></div>';
                                                                }
                                                                echo '</div>'; // Close the third column
                                                            }
                                                        }
                                                    echo '</div>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $bg = "white";
                if(is_404()){
                    $bg = get_field('page_settings_background_color', 'option');
                }else{
                    $bg = get_field('page_settings_background_color',$post_id);
                }
            ?>
            <div class="content">
                <div class="mobileMenuSection">
                    <div class="mobileMenuSectionWrap">
                        <div class="mobileMenuSectionTitleWrap">
                            <div class="c">
                                <div class="headerWrap">
                                    <div class="logoWrap">
                                        <a href="<?= home_url(); ?>" class="logo">
                                            <img class="logoImage" src="<?= get_bloginfo('template_directory'); ?>/assets/images/tafreed.png" />
                                        </a>
                                    </div>
                                    <div class="menuWrap">
                                        <div class="mobileMenu">
                                            <a class="mobileMenuBtn mobileMenuCloseBtn"><span class="line"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mobileMenuSectionBodyWrap">
                            <div class="c">
                                <div class="mobileMainMenuWrap">
                                    <div class="mobileMainMenu">
                                        <?php
                                        if(!empty($header_post)) {
                                            $post_id = $header_post[0]->ID;
                                            if (have_rows('main_menu', $post_id)) {
                                                while (have_rows('main_menu', $post_id)) {
                                                    the_row();
                                                    $menu_text = get_sub_field('menu_text');
                                                    $menu_link = get_sub_field('menu_link');
                                                    $show_mega_menu = get_sub_field('show_mega_menu');
                                                    $menu_id = 'menu_' . get_row_index();
                                                    $getSubMenu = get_sub_field('sub_menu');
                                                    if ($menu_text) {
                                                        ?>
                                                        <div class="mobileMainMenuItem">
                                                            <div class="mobileMainMenuItemHeader <?= $show_mega_menu ? 'yes' : '' ?>">
                                                                <a href='<?= $menu_link; ?>'><?= $menu_text; ?></a>
                                                                <?= ($show_mega_menu) ? '<a class="MobileDropDownOpenBtn"><span class="dropDown down"></span></a>' : '' ?>   
                                                            </div>
                                                            <?php
                                                                if($getSubMenu){
                                                                    ?>
                                                                        <div class="mobileMainMenuItemBody">
                                                                            <div class="dropDownMenu">
                                                                                <div class="dropDownMenuWrap count<?= count($getSubMenu); ?>" data-count="<?= count($getSubMenu); ?>">
                                                                                    <div class="">
                                                                                        <?php
                                                                                        while(have_rows('sub_menu')){
                                                                                            the_row();
                                                                                                $sub_menu_text = get_sub_field('sub_menu_text');
                                                                                                $sub_menu_link = get_sub_field('sub_menu_link');
                                                                                            ?>
                                                                                                <div class="dropDownMenuItems">
                                                                                                    <a href="<?= $sub_menu_link; ?>">
                                                                                                        <span class="dropDownMenuItemLabel"><?= $sub_menu_text; ?></span>
                                                                                                    </a>
                                                                                                </div>
                                                                                            <?php
                                                                                        } 
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            } 
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
                    wp_reset_postdata();
                ?>

                