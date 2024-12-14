$(function () {
    /*********************
     ALL CLICKS
     *********************/
    $('body').on('click', 'a[data-scroll]', function (e) {
        e.preventDefault();
        var el = $(this),
            sel = el.data('scroll');
        $('html, body').animate({
            'scrollTop': $(sel).offset().top
        }, 1000);
    });

    //All the click events must go here

    //Mobile Navabar
    $('body').on('click', '.mobileMenuOpenBtn', function () {
        if ($('html').hasClass('open_menu')) {
            $('.viewport').removeClass('lock');
            $('html').removeClass('open_menu');
            $('html').removeClass('MobileDropDownOpen');
            $('.MobileDropDownOpenBtn').removeClass('active');
            $('.mobileMainMenuItemBody').hide();
        } else {
            $('.viewport').addClass('lock');
            $('html').addClass('open_menu');
        }
    });

    // Toggle 'navOpen' class on click
    $('body').on('click', '.menuItem.mainMenuItem.dropDownYes', function (event) {
        var menuId = $(this).data('id');

        // Toggle 'navOpen' class on the clicked menu item
        $(this).toggleClass('navOpen');

        // Reset transformations and border for all menus
        $('.menuItem.mainMenuItem.dropDownYes .menuItemLink').css('border-bottom', '');
        $('.menuItem.mainMenuItem.dropDownYes .menuItemLink .dropDown.down').removeClass('navOpened');

        // Check if the clicked menu item has the class 'navOpen'
        if ($(this).hasClass('navOpen')) {
            $(this).find('.menuItemLink .dropDown.down').addClass('navOpened');
            $(this).find('.menuItemLink').css('border-bottom', '1px solid var(--deepBlue)');
        }

        // Close other menus
        $('.menuItem.mainMenuItem.dropDownYes').not(this).removeClass('navOpen');
        $('.menuItem.mainMenuItem.dropDownYes').not('[data-id="' + menuId + '"]').removeClass('navOpen');

        // Prevent the body click handler from immediately closing the menu
        event.stopPropagation();
    });

    $('body').on('click', function () {
        // Reset transformations and border for Opened menus
        $('.menuItem.mainMenuItem.dropDownYes .menuItemLink').css('border-bottom', '');
        $('.menuItem.mainMenuItem.dropDownYes .menuItemLink .dropDown.down').removeClass('navOpened');

        // Close menus
        $('.menuItem.mainMenuItem.dropDownYes').removeClass('navOpen');
    });

    $('body').on('click', '.MobileDropDownOpenBtn', function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass("active");
            $(this).parent().next('.mobileMainMenuItemBody').slideUp();
        } else {
            $('.MobileDropDownOpenBtn').removeClass("active");
            $('.mobileMainMenuItemBody').slideUp();
            $(this).addClass("active");
            $(this).parent().next('.mobileMainMenuItemBody').slideDown();
            if ($('.MobileDropDownOpenBtn').hasClass('active')) {
                $('html').addClass('MobileDropDownOpen');
            } else {
                $('html').removeClass('MobileDropDownOpen');
            }
        }
    });

    //Image Accordions
    $('body').on('click', '.imageAccordionTextItemTitle', function () {
        var p = $(this).parent().parent().attr('id');
        var tabId = $(this).data('id');
        var divId = $(this).closest('.imageAccordion').attr("id");
        var accordionTabImage = $(`#${divId} .keyaccordionimage[data-id="${tabId}"]`);
        if (accordionTabImage.length) {
            $(`#${divId} .iaiDesktop`).css({ height: accordionTabImage[0].scrollHeight + "px" });
        }
        if ($(this).hasClass('active')) {
            $(this).next('.imageAccordionTextItemTextContent').slideUp();
            $(this).removeClass("active");
            if (accordionTabImage.length) {
                accordionTabImage.removeClass("activeAccordionImage");
            }
        } else {
            $('#' + p).find('.imageAccordionTextItemTitle').removeClass("active");
            $('#' + p).find('.imageAccordionTextItemTextContent').slideUp();
            $(this).addClass("active");
            $(this).next('.imageAccordionTextItemTextContent').slideDown();
            $('#' + p).find('.imageAccordionTextItemTitle').not(this).removeClass("active");
            $('#' + p).find('.imageAccordionTextItemTextContent').not($(this).next('.imageAccordionTextItemTextContent')).slideUp();
            $(`#${divId} .keyaccordionimage`).removeClass("activeAccordionImage");

            if (accordionTabImage.length) {
                accordionTabImage.addClass("activeAccordionImage");
            }
        }
    });

    //Card Hover
    var cardItemHeight = $('.cardItem.backSideYes').outerHeight() - 2;
    $('body').on('mouseenter', '.cardItem.backSideYes', function (event) {

        var cardItemTopBlockHeight = $('.cardItemTopBlock').height();
        var cardItemTitleBlockHeight = $(this).find(".cardItemTitleBlock").outerHeight();
        cardItemTopBlockHeight = cardItemTopBlockHeight - cardItemTitleBlockHeight;
        var totalHeight = cardItemTitleBlockHeight + parseInt($('.cardItemTopBlock').css('padding'));
        var bHeight = $(this).outerHeight() - $(this).find(".cardItemTitleBlock").height() - parseInt($('.cardItemTopBlock').css('padding'));

        $(this).children(".cardItemTopBlock").css({
            'top': '-' + cardItemTopBlockHeight + 'px',
        });

        $(this).children(".cardItemBottomBlock").css({
            'top': totalHeight,
            'height': bHeight,
        });

    }).on('mouseleave', '.cardItem.backSideYes', function () {

        $(this).children(".cardItemTopBlock").css({
            'top': '0',
        });

        $(this).children(".cardItemBottomBlock").css({
            'top': '100%',
            'height': cardItemHeight,
        });

    });

    //Team Card Hover
    function handleListMouseEvents(selector, frontClass, backClass, textClass) {
        $('body').on('mouseenter', selector, function () {
            var listItemFrontHeight = $(frontClass, this).height();
            var listTextHeight = $(textClass, this).outerHeight();
            var dataId = $(this).attr('data-id');

            listItemFrontHeight -= listTextHeight;

            var backHeight = $(backClass + dataId, this).outerHeight() + $(textClass + dataId, this).outerHeight();
            var imageHeight = $(".teamListImage" + dataId).outerHeight() + $(textClass + dataId, this).outerHeight();
            var maxHeight = Math.max(backHeight, imageHeight);

            $(this).children(frontClass).css({ 'top': '-' + listItemFrontHeight + 'px' });
            $(this).children(backClass).css({ 'top': listTextHeight });
            $(this).css({ 'height': maxHeight });
        }).on('mouseleave', selector, function () {
            var originalHeight = $(this).find('.teamListImage').height() + $(textClass, this).outerHeight();
            $(this).children(frontClass).css({ 'top': '0' });
            $(this).children(backClass).css({ 'top': '100%' });
            $(this).css({ 'height': originalHeight });
        });
    }

    handleListMouseEvents('.teamList .teamListItemWrap', '.teamListItemFront', '.teamListItemBack', '.teamListText');
    handleListMouseEvents('.authorList .teamListItemWrap', '.teamListItemFront', '.teamListItemBack', '.teamListText');


    $('body').on('click', '.playOptions.play', function (e) {
        e.preventDefault();
        var dataId = $(this).attr('data-id');
        var jsVideo = "jsVideo ";
        if ($(this).attr('data-fit') === "false") {
            jsVideo = "";
        }

        var vPlay = 'autoplay';
        if ($(this).attr('data-autoplay') == "") {
            vPlay = '';
        } else {
            vPlay = 'autoplay';
        }
        var vRepeat = 'loop';
        if ($(this).attr('data-repeat') == "") {
            vRepeat = '';
        } else {
            vRepeat = 'loop';
        }

        //Load videos
        var videoHtml = "",
            mp4 = $('.bg-video [data-mp4]').attr('data-mp4'),
            webm = $('.bg-video [data-mp4]').attr('webm');
        if (typeof mp4 != "undefined" && ($('.bg-video' + dataId + ' .videos' + dataId).length)) {
            if ($('.video' + dataId)[0]) {

            } else {
                videoHtml += '<video';
                videoHtml += ' ' + vPlay + ' ' + vRepeat + ' playsinline class="' + jsVideo + 'play video' + dataId + '">';
                if (mp4) {
                    videoHtml += '<source src="' + mp4 + '" type="video/mp4">';
                }
                if (webm) {
                    videoHtml += '<source src="' + webm + '" type="video/webm">';
                }
                videoHtml += '</video>';
                $('.bg-video' + dataId + ' .videos' + dataId).removeAttr('data-mp4 data-webm').append(videoHtml);
                browser.playVisibleEvents();
                video.objectFit();
            }

        }
        $('.bg-video' + dataId + ' video').trigger('play');
        $('.has-video video').addClass('play').removeClass('pause');
        $('.has-video').addClass('videoplay').removeClass('videopause');
        $('.playOptions' + dataId + '.play').removeClass('show').addClass('hide');
        $('.playOptions' + dataId + '.pause').addClass('show').removeClass('hide');
    });

    $('body').on('click', '.playOptions.pause', function (e) {
        e.preventDefault();
        $('.bg-video video').trigger('pause');
        $('.bg-video video').addClass('pause').removeClass('play');
        $('.playOptions.play').removeClass('hide').addClass('show');
        $('.playOptions.pause').addClass('hide').removeClass('show');
    });

    // comparePlans Table Show
    $('body').on('click', '.comparePlansBtn', function () {
        if ($(this).hasClass('active')) {
            $('.comparePlans + .comparePlansTable').slideUp(500);
            $(this).removeClass("active");
        } else {
            $(this).addClass("active");
            $('.comparePlans + .comparePlansTable').slideDown(500);
        }
    })

    // compareplan table ingfo tooltip
    // Function to close tooltips
    function closeTooltips() {
        $('.tool-tip.show').removeClass('show').remove();
    }

    // Event listener for scroll events on window
    window.addEventListener("scroll", () => {
        closeTooltips();
    });

    // Function to handle click events on table elements
    function handleTableClick(event) {
        const { infoLink = "", infoText, infoRef, infoTarget } = $(this).data();
        let { top, left } = this.getBoundingClientRect();
        let right = window.innerWidth - left;
        left = left + 30;
        let style = `top: ${top}px; ${window.innerWidth - left > 184 ? `left: ${left}px` : `right: ${right + 5}px`};`;

        // Close previously opened tooltips
        closeTooltips();

        // Create tooltip HTML
        const tooltipHtml = `<div id="${infoRef}" class="tool-tip${window.innerWidth - left > 184 ? '' : ' right'}" style="${style}">
            <div class="comparePlansToolTip ${infoLink != '' ? 'link' : 'text'}">
                ${infoLink !== '' ? `<a class='comparePlansToolTipLink' ${infoTarget ? 'target="_blank"' : ''} href="${infoLink}">${infoText}</a>` : `<span class='comparePlansToolTipText'>${infoText}</span>`}
            </div>
        </div>`;

        // Append tooltip to body and show
        $(`body`).append(tooltipHtml).find(`.tool-tip#${infoRef}`).addClass('show');

        event.stopPropagation();

        // Listen for clicks on the document to close tooltips
        const closeTooltipOnClick = (e) => {
            if (!$(e.target).closest(`.tool-tip#${infoRef}`).length) {
                closeTooltips();
                $(document).off('click', closeTooltipOnClick);
            }
        };

        // Attach click event listener to the document
        $(document).on('click', closeTooltipOnClick);
    }

    // Event listener for click events on elements with class 'comparePlansTable'
    $('body').on('click', '.comparePlansTable .tablesBlockColTextInfoIconWrap', handleTableClick);
    $('body').on('click', '.tables .tablesBlockColTextInfoIconWrap', handleTableClick);

    // Event listener for scroll events on table elements
    $('.comparePlansTableWrap').on('scroll', function () {
        closeTooltips();
    });


    //Sidebar Dropdown
    $('body').on('click', '.sideBarPlaceholder', function () {
        if ($('.sideBarLinkListWrap').hasClass('show')) {
            $('.sideBarLinkListWrap').removeClass('show');
        } else {
            $('.sideBarLinkListWrap').addClass('show');
        }
    });

    //C Editor Image Bottom Border Remove
    $('.c_editor a img').parent().css('border-bottom', 'none');

    //Country Swicher
    $('body').on('change', '.countrySwitcher', function () {
        var currency = $(this).val();
        if (currency == "usd") {
            $('.comparePlansTable').html($('.comparePlansTable').html().replaceAll('£', "$"));
        } else if (currency == "gbp") {
            $('.comparePlansTable').html($('.comparePlansTable').html().replaceAll('$', "£"));
        }
        $('.pricingCardsTablePriceAmount').each(function () {
            if (currency == "usd") {
                $(this).text($(this).attr('data-usd'));
            } else if (currency == "gbp") {
                $(this).text($(this).attr('data-gbp'));
            }
        });
    });

    $('body').on('click', 'a[href*="goto"]', function (e) {
        e.preventDefault();
        var headerHeight = $('.header').height();
        var sectionPadding = parseInt($('.hubspotForm').css('padding-top'));
        if (sectionPadding == 0) {
            sectionPadding = parseInt($('.hubspotForm').css('padding-bottom'));
        } else {
            sectionPadding = 0;
        }
        var totalHeight = headerHeight + sectionPadding;
        if ($('#wpadminbar')[0]) {
            totalHeight = totalHeight + $('#wpadminbar').height();
        }
        var data = $(this).attr('href').split("goto=");
        var goto = data['1'];
        if ($('.goto')[0]) {
            $('html,body').animate({
                scrollTop: $("#" + goto).offset().top - totalHeight
            },
                'slow');
        }
    })

    if ($('.goto')[0]) {
        var headerHeight = $('.header').height();
        var sectionPadding = parseInt($('.hubspotForm').css('padding-top'));
        if (sectionPadding == 0) {
            sectionPadding = parseInt($('.hubspotForm').css('padding-bottom'));
        } else {
            sectionPadding = 0;
        }
        var totalHeight = headerHeight + sectionPadding;
        if ($('#wpadminbar')[0]) {
            totalHeight = totalHeight + $('#wpadminbar').height();
        }
        var goto = $('.goto').val();
        if (goto) {
            if ($("#" + goto)[0]) {
                setTimeout(function () {
                    $('html,body').animate({
                        scrollTop: $("#" + goto).offset().top - totalHeight
                    },
                        'slow');
                    $('.goto').val('')
                    var url = window.location.href;
                    url = url.slice(0, url.indexOf('?goto'));
                    history.pushState('', '', url);
                }, 1000)
            }
        }
    }

    $('body').on('submit', '.bannerSearchForm', function (e) {
        e.preventDefault();
        if ($('.bannerSearchForm .currentUrl').val() != "") {
            var currentUrl = $('.bannerSearchForm .currentUrl').val();
            var searchInput = $('.bannerSearchForm .searchInput').val();
            currentUrl = currentUrl + "/search/" + searchInput;
            window.open(currentUrl, "_self");
        }
    });

    /********************
     ONE TIME INIT
     *********************/
    browser.setup(1);

    $(window).resize(function () {
        browser.setup(0);
        browser.megaMenuHeight();
        if ($('.tables')[0]) {
            $('.tables').each(function () {
                var wid = $(this).attr('data-wid');
                adjustHeights.setHeightByAll('.tablesBlockColEqualHeight' + wid);
                adjustHeights.setHeightByRow('.tableBlockColEqualHeightRow' + wid);
            });
        }
        $.fn.matchHeight._update();
    });

    $(window).scroll(browser.scrollEvent);

    // Card Count
    if ($('.cardItemCount')[0]) {
        var id = 1;
        var cardId = [];
        $('.cardItemCount').each(function () {
            var dynamicId = "cardItemCount" + id;
            $(this).attr('id', dynamicId);
            cardId.push("#" + dynamicId);
            id++;
        });

        // CONFIG
        let visibilityIds = cardId //must be an array, could have only one element
        let counterClass = '.counter';
        let defaultSpeed = 1000; //default value

        // END CONFIG

        //init if it becomes visible by scrolling
        $(window).on('scroll', function () {
            getVisibilityStatus();
        });

        //init if it's visible by page loading
        getVisibilityStatus();

        function getVisibilityStatus() {
            elValFromTop = [];
            var windowHeight = $(window).height(),
                windowScrollValFromTop = $(this).scrollTop();

            visibilityIds.forEach(function (item, index) { //Call each class
                try { //avoid error if class not exist
                    elValFromTop[index] = Math.ceil($(item).offset().top);
                } catch (err) {
                    return;
                }
                // if the sum of the window height and scroll distance from the top is greater than the target element's distance from the top, 
                //it should be in view and the event should fire, otherwise reverse any previously applied methods
                if ((windowHeight + windowScrollValFromTop) > elValFromTop[index]) {
                    counterInit(item);
                }
            });
        }

        function counterInit(groupId) {
            let num, speed, direction, index = 0;
            $(counterClass).each(function () {
                num = $(this).attr('data-TargetNum');
                speed = $(this).attr('data-Speed');
                direction = $(this).attr('data-Direction');
                easing = $(this).attr('data-Easing');
                if (speed == undefined) speed = defaultSpeed;
                $(this).addClass('c_' + index); //add a class to recognize each counter
                doCount(num, index, speed, groupId, direction, easing);
                index++;
            });
        }

        function doCount(num, index, speed, groupClass, direction, easing) {
            let className = groupClass + ' ' + counterClass + '.' + 'c_' + index;
            if (easing == undefined) easing = "swing";
            $(className).animate({
                num
            }, {
                duration: +speed,
                easing: easing,
                step: function (now) {
                    if (direction == 'reverse') {
                        $(this).text(num - Math.floor(now));
                    } else {
                        $(this).text(Math.floor(now));
                    }
                },
                complete: doCount
            });
        }
    }
});

$(window).on('load', function () {
    $.fn.matchHeight._update();
    browser.scrollEvent();
});

$(document).ready(function () {
    setTimeout(function () {
        $('body').click(function () {
            $('.filter').removeClass('open');
        }).find('.filter, .filter *').click(function (e) {
            e.stopPropagation();
        });
        $('.filter p').click(function () {
            $('.filter').removeClass('open');
            $(this).parent().addClass('open');
        });
    }, 150);

    // turtl embed section alignment
    $('.turtl-embed').each(function () {
        const align = $(this).parent().css('text-align') || "left";
        if (align === "right") {
            $(this).css('margin-left', 'auto');
        }
        else if (align === "center") {
            $(this).css('margin', 'auto');
        }
    })
});

$(document).ready(function () {
    let submenuTimeout;
    let windowWidth = window.innerWidth;
    const $menuItems = $('.header_menu_text.hasMegaMenu');
    const $subMenus = $('.mega-menu');
    if (windowWidth > 1280) {
        // Show submenu with animation and add active class
        $menuItems.on('mouseenter', function () {
            clearTimeout(submenuTimeout); // Prevent hiding when quickly moving to the submenu
            const menuId = $(this).data('menu');

            $menuItems.removeClass('active'); // Remove active class from all menu items
            $(this).addClass('active'); // Add active class to the current menu item

            $subMenus.each(function () {
                // Hide all submenus and remove active class
                $(this).stop(true, true).fadeOut(200).removeClass('active').css('display', 'none');
                // Show only the submenu related to the hovered menu item
                if ($(this).data('menu') === menuId) {
                    $(this)
                        .stop(true, true)
                        .fadeIn(200)
                        .css('display', 'flex')
                        .addClass('active'); // Add active class to the currently visible submenu
                }
            });
        });

        // Keep submenu visible and ensure active class remains when hovering over the submenu
        $subMenus.on('mouseenter', function () {
            clearTimeout(submenuTimeout); // Prevent hiding when hovering over submenu
            $(this).stop(true, true).fadeIn(200).css('display', 'flex').addClass('active'); // Keep submenu open
        });

        // Hide submenu with animation and remove active class when leaving the main menu
        $menuItems.on('mouseleave', function () {
            submenuTimeout = setTimeout(function () {
                $menuItems.removeClass('active'); // Remove active class from menu items
                $subMenus.stop(true, true).fadeOut(200).removeClass('active').css('display', 'none'); // Smooth fadeOut and reset
            }, 200); // Small delay for smoother experience
        });

        // Hide submenu with animation and remove active class when leaving the submenu
        $subMenus.on('mouseleave', function () {
            submenuTimeout = setTimeout(function () {
                $menuItems.removeClass('active'); // Remove active class from menu items
                $subMenus.stop(true, true).fadeOut(200).removeClass('active').css('display', 'none'); // Smooth fadeOut
            }, 200); // Small delay for smoother experience
        });
    }

    function animateCounters() {
        $(".counter").each(function () {
            var $this = $(this);
            var countTo = parseInt($this.attr("data-count"), 10); // Ensure countTo is an integer

            $({ countNum: parseInt($this.text().replace(/,/g, ""), 10) }).animate(
                { countNum: countTo },
                {
                    duration: 5000,
                    easing: "linear",
                    step: function () {
                        $this.text(Math.floor(this.countNum).toLocaleString());
                    },
                    complete: function () {
                        $this.text(this.countNum.toLocaleString());
                    },
                }
            );
        });
    }

    var section = $("#empoweringBusiness");
    section.waypoint(
        function (direction) {
            if (direction === "down") {
                animateCounters();
                this.destroy();
            }
        },
        {
            offset: "75%",
        }
    );
});

$(document).ready(function () {
    $(".input_field input, .input_field select, .input_field textarea").on("focus", function () {
        var $label = $(this).siblings("label");
        $(this).addClass("filled");
        $label.css({
            "top": "-14px", "font-size": "12px"
        });
    });

    $(".input_field input, .input_field select, .input_field textarea").on("blur", function () {
        var $label = $(this).siblings("label");
        if ($(this).val() === "") {
            $(this).removeClass("filled");
            $label.css({ "top": "10px", "font-size": "14px" });
        }
    });

    $(".input_field input, .input_field select, .input_field textarea").each(function () {
        if ($(this).val() !== "") {
            $(this).addClass("filled");
            $(this).siblings("label").css({ "top": "-14px", "font-size": "12px" });
        }
    });
});

/* Lazy Load Function Start */

$(document).ready(function () {
    // Function to lazy load elements with optional delay
    function lazyLoadElement($element) {
        const delay = $element.data('delay') || '0s';
        $element.css('transition-delay', delay); // Apply the delay
        $element.addClass('lazy-loaded'); // Add the class to trigger animation
    }

    // Function to lazy load images specifically
    function lazyLoadImage($image) {
        const src = $image.data('src');
        if (src) {
            $image.attr('src', src); // Set the image source
            lazyLoadElement($image); // Apply the lazy-loaded class
        }
    }

    // Intersection Observer equivalent in jQuery
    const $lazyElements = $('.lazy-load');
    $(window).on('scroll', function () {
        $lazyElements.each(function () {
            const $element = $(this);
            const offsetTop = $element.offset().top;
            const scrollTop = $(window).scrollTop();
            const windowHeight = $(window).height();

            if (scrollTop + windowHeight >= offsetTop) {
                if ($element.is('img')) {
                    lazyLoadImage($element);
                } else {
                    lazyLoadElement($element);
                }
                $lazyElements.splice($lazyElements.index($element), 1); // Remove from list once loaded
            }
        });
    });

    // Trigger scroll event on page load to catch visible elements
    $(window).trigger('scroll');
});

/* Lazy Load Function End */
