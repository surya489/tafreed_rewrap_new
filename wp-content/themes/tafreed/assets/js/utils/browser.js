// Create cross browser requestAnimationFrame method:
window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function (f) {
    setTimeout(f, 1000 / 60)
};

//Page functions
var browser = {
    _csrf: null,
    _width: 0,
    _height: 0,
    _header_height: 0,
    _filter_position: 0,
    _position: 0,
    _isotope: null,
    _coords: [],
    _windowWidth: $(window).width(),
    setup: function (init) {
        this._width = $(window).width();
        this._height = $(window).height();

        if (init === 1) {

            var header = $('.header').clone().addClass('sticky');
            header.prependTo('body');
            $('.header').addClass('visi_hidd');
            $('.header.sticky').removeClass('visi_hidd');
            browser.megaMenuHeight();
            browser.targetBlank();
            browser.comparePlanTableAddClass();
            //Code that should be executed only once goes here

            adjustHeights.setHeightByAll('.cardEqualHeight');
            adjustHeights.setHeightByAll('.cardInnerEqualHeight');
            adjustHeights.setHeightByAll('.cardTitleEqualHeight');
            adjustHeights.setHeightByAll('.cardTextEqualHeight');
            adjustHeights.setHeightByAll('.customerJourneyEqualTitle');
            adjustHeights.setHeightByAll('.customerJourneyEqualText');
            adjustHeights.setHeightByAll('.type_1_cardsHeaderEqualHeight');
            adjustHeights.setHeightByAll('.type_1_cardsEqualHeight');
            adjustHeights.setHeightByAll('.type_1_cardsTitleEqualHeight');
            adjustHeights.setHeightByAll('.type_1_cardsTextEqualHeight');
            adjustHeights.setHeightByAll('.type_2_cardsHeaderEqualHeight');
            adjustHeights.setHeightByAll('.type_2_cardsEqualHeight');
            adjustHeights.setHeightByAll('.cardsBlockItemBlock:not(.type_4_cardsEqualHeight) .cardsBlockItemBody');
            adjustHeights.setHeightByAll('.type_2_cardsTitleEqualHeight');
            adjustHeights.setHeightByAll('.type_2_cardsTextEqualHeight');
            adjustHeights.setHeightByAll('.type_3_cardsHeaderEqualHeight');
            adjustHeights.setHeightByAll('.type_3_cardsEqualHeight');
            adjustHeights.setHeightByAll('.type_3_cardsTitleEqualHeight');
            adjustHeights.setHeightByAll('.type_3_cardsTextEqualHeight');
            adjustHeights.setHeightByAll('.type_4_cardsHeaderEqualHeight');
            adjustHeights.setHeightByAll('.type_4_cardsEqualHeight');
            adjustHeights.setHeightByAll('.type_4_cardsTitleEqualHeight');
            adjustHeights.setHeightByAll('.type_4_cardsTextEqualHeight');
            adjustHeights.setHeightByAll('.cardDescEqualHeight');
            adjustHeights.setHeightByAll('.dropDownMenuItemsTitleWapEqualHeight');

            if ($('.communityShowcaseCarousel')[0]) {
                $('.communityShowcaseCarousel').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.communityShowcaseCardItemTextContentWrapWqualHeight' + wid);
                    adjustHeights.setHeightByAll('.communityShowcaseTitleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.communityShowcaseTermsEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.communityShowcaseEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.communityShowcaseTextContentEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.communityShowcaseDescEqualHeight' + wid);
                });
            }

            if ($('.customerSuccessStoriesList')[0]) {
                $('.customerSuccessStoriesList').each(function () {
                    var wid = $(this).attr('data-wid');
                    if (browser._windowWidth > 820) {
                        adjustHeights.setHeightByAll('.cardTitleEqualHeight' + wid);
                        adjustHeights.setHeightByAll('.cardTermsEqualHeight' + wid);
                        adjustHeights.setHeightByAll('.cardEqualHeight' + wid);
                        adjustHeights.setHeightByAll('.cardTextContentEqualHeight' + wid);
                        adjustHeights.setHeightByAll('.cardDescEqualHeight' + wid);
                    }
                });
            }

            if ($('.testimonials')[0]) {
                $('.testimonials').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.testimonialsHeaderEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsQuotesEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsCardFooterNameEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsCardFooterEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsCardBtnEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsCardVideoEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsCardEqualHeight' + wid);
                });
            }

            if ($('.testimonialQuotes')[0]) {
                $('.testimonialQuotes').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.testimonialsHeaderEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsQuotesEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsCardFooterNameEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsCardFooterEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsCardBtnEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsCardVideoEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.testimonialsCardEqualHeight' + wid);
                })
            }

            if ($('.pricingCards')[0]) {
                $('.pricingCards').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.pricingCardsTableTitleWrapEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.pricingCardsTableSubTitleWrapEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.pricingCardsTableTextWrapEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.pricingCardsTableListEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.pricingCardsTableButtonWrapEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.pricingCardsTablePriceEqualHeight' + wid);
                });
            }

            if ($('.communityShowcaseList')[0]) {
                $('.communityShowcaseList').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.cardTitleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTermsEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTextContentEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardDescEqualHeight' + wid);
                });
            }

            if ($('.integrateList')[0]) {
                $('.integrateList').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.cardTitleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTermsEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTextContentEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardDescEqualHeight' + wid);
                });
            }

            if ($('.authorPostList')[0]) {
                $('.authorPostList').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.cardTitleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTermsEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTextContentEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardDescEqualHeight' + wid);
                });
            }

            if ($('.columnText')[0]) {
                $('.columnText').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.cardTitleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTermsEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTextContentEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardDescEqualHeight' + wid);
                });
            }

            if ($('.teamList')[0]) {
                $('.teamList').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.teamItemEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.teamItemTitleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.teamItemRoleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.teamItemHeaderEqualHeight' + wid);
                });
            }

            if ($('.authorList')[0]) {
                $('.authorList').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.teamItemEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.teamItemTitleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.teamItemRoleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.teamItemHeaderEqualHeight' + wid);
                });
            }

            if ($('.newsList')[0]) {
                $('.newsList').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.cardTitleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTermsEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTextContentEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardDescEqualHeight' + wid);
                });
            }

            if ($('.templatesList')[0]) {
                $('.templatesList').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.cardTitleEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTermsEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardTextContentEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.cardDescEqualHeight' + wid);
                });
            }

            if ($('.tables')[0]) {
                $('.tables').each(function () {
                    var wid = $(this).attr('data-wid');
                    adjustHeights.setHeightByAll('.tablesBlockColEqualHeight' + wid);
                    adjustHeights.setHeightByAll('.tableBlockColEqualHeightRow' + wid);
                });
            }

            if ($('.customerLogosSlider').length) {
                browser.swiperSlider('.customerLogosSlider');
            }

            if ($('.communityShowcaseSlider').length) {
                $('.communityShowcaseSlider').each(function () {
                    var getClass = $(this).attr('id');
                    browser.AdvanceSlider('.' + getClass);
                });
            }

            if ($('.testimonialsSlider').length) {
                $('.testimonialsSlider').each(function () {
                    var getClass = $(this).attr('id');
                    browser.testimonialsSlider('.' + getClass);
                });
            }

            if ($('.contentHubListContent').length) {
                $pagenum = browser.getUrlParameter('paged_no') ? browser.getUrlParameter('paged_no') : '1';
                var industryT = "";
                var contentTypeT = "";

                if ($('.contentHubListContent').attr('data-type') == "topicBased") {
                    industryT = $('.contentHubListContent').attr('data-industry');
                    contentTypeT = $('.contentHubListContent').attr('data-content-type');
                }

                contenthubfilter.clear_pagination();
                contenthubfilter.contentHubList($pagenum, industryT, contentTypeT);
            }

            var activeAccordionImage = $('.activeAccordionImage');
            if (activeAccordionImage.length) {
                activeAccordionImage.each(function () {
                    let iaiHeight = $(this)[0].scrollHeight;
                    $(this).closest('.iaiDesktop').css({ height: iaiHeight + "px" })
                });
            }
            if ($('.c_editor').length) {
                $(".c_editor ol li > strong").each(function () {
                    $(this).parent('li').addClass('bold-marker');
                });
                $(".c_editor ol li h1 > strong").each(function () {
                    $(this).parent().parent().addClass('h1-bold-marker');
                });
                $(".c_editor ol li h2 > strong").each(function () {
                    $(this).parent().parent().addClass('h2-bold-marker');
                });
                $(".c_editor ol li h3 > strong").each(function () {
                    $(this).parent().parent().addClass('h3-bold-marker');
                });
                $(".c_editor ol li h4 > strong").each(function () {
                    $(this).parent().parent().addClass('h4-bold-marker');
                });
                $(".c_editor ol li h5 > strong").each(function () {
                    $(this).parent().parent().addClass('h5-bold-marker');
                });
                $(".c_editor ol li h6 strong").each(function () {
                    $(this).parent().parent().addClass('h6-bold-marker');
                });
                $(".c_editor ol li h1").each(function () {
                    $(this).parent('li').addClass('h1-marker');
                });
                $(".c_editor ol li h2").each(function () {
                    $(this).parent('li').addClass('h2-marker');
                });
                $(".c_editor ol li h3").each(function () {
                    $(this).parent('li').addClass('h3-marker');
                });
                $(".c_editor ol li h4").each(function () {
                    $(this).parent('li').addClass('h4-marker');
                });
                $(".c_editor ol li h5").each(function () {
                    $(this).parent('li').addClass('h5-marker');
                });
                $(".c_editor ol li h6").each(function () {
                    $(this).parent('li').addClass('h6-marker');
                });
            }

            browser.colorReduce();
            browser.checkIp();
            browser.calculateReadTime();
        }

        //Code that should execute on window resize goes here
        video.objectFit();
    },
    getUrlParameter: function (sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    },
    scrollEvent: function (init) {
        requestAnimationFrame(function () {
            //Add layer behind sticky menu
            var st = $(window).scrollTop();
            if (st >= 100) {
                $('html').addClass('has-scrolled');
                $('.header').addClass('scrolled-header');
            } else {
                $('html').removeClass('has-scrolled');
                $('.header').removeClass('scrolled-header');
            }
            //Pause or play Slideshows based on visibility
            browser.playVisibleEvents();
        });
    },
    pauseAllIntensiveEvents: function () {
        //All slideshow/videos that needs to be paused should be written here
        $('.cycle').each(function () {
            $(this).cycle('pause');
        });
    },
    playVisibleEvents: function () {
        //Slideshow/videos that needs to be paused when out of view should be written here
        $('.cycle').each(function () {
            var slider = $(this);
            if (slider.is(':in-viewport'))
                slider.cycle('resume');
            else
                slider.cycle('pause');
        });

        $('video').each(function () {
            var $vid = $(this),
                vid = $vid[0];
            if (($vid.is(':in-viewport')) && ($vid.hasClass('play'))) {
                vid.play();
            } else if ($vid.hasClass('play')) {
                vid.pause();
            }
        });
    },
    get: function (key, default_) {
        //Function to get the value of url parameters
        if (default_ == null)
            default_ = "";
        key = key.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regex = new RegExp("[\\?&]" + key + "=([^&#]*)");
        var qs = regex.exec(window.location.href);
        if (qs == null)
            return default_;
        else
            return qs[1];
    },
    swiperSlider: function (el) {
        new Swiper(`${el}`, {
            slidesPerView: 1.5,
            centeredSlides: false,
            spaceBetween: 24,
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            breakpoints: {
                1920: {
                    slidesPerView: 5,
                },
                1440: {
                    slidesPerView: 5,
                },
                1028: {
                    slidesPerView: 4,
                },
                840: {
                    slidesPerView: 3,
                },
                480: {
                    slidesPerView: 2.5,
                },
                375: {
                    slidesPerView: 1.8,
                },
                350: {
                    slidesPerView: 2,
                }
            }
        });
    },
    AdvanceSlider: function (el) {
        var type = $(el).attr('data-type');

        var slidesPerView = 3;
        var slidesPerView1920 = 3;
        var slidesPerView1440 = 3.5;
        var slidesPerView1028 = 3;
        var slidesPerView840 = 2;
        var slidesPerView740 = 2;
        var slidesPerView600 = 1.5;
        var slidesPerView420 = 1.2;
        var slidesPerView375 = 1.01;
        var slidesPerView300 = 1;

        var nextEl = '.' + $(el).next('.communityShowcaseCarouselActionBlocksWrap').find('.sliderRightNavbar').attr('id');
        var prevEl = '.' + $(el).next('.communityShowcaseCarouselActionBlocksWrap').find('.sliderLeftNavbar').attr('id');
        var scrollbar = '.' + $(el).next('.communityShowcaseCarouselActionBlocksWrap').find('.swiper-scrollbar').attr('id');
        if (type == "type_2") {
            slidesPerView = 4.5;
            slidesPerView1920 = 4.8;
            slidesPerView1440 = 4.5;
            slidesPerView1028 = 4;
            slidesPerView840 = 3;
            slidesPerView740 = 3;
            slidesPerView600 = 1.9;
            slidesPerView420 = 1.8;
            slidesPerView375 = 1.5;
            slidesPerView300 = 1.2;
            var AdvanceSlider = new Swiper(`${el}`, {
                slidesPerView: slidesPerView,
                spaceBetween: 32,
                loop: false,
                grabCursor: false,
                initialSlide: 0,
                speed: 200,
                autoplay: false,
                navigation: {
                    nextEl: `${nextEl}`,
                    prevEl: `${prevEl}`
                },
                scrollbar: {
                    el: scrollbar,
                    draggable: true,
                    hide: false,
                },
                breakpoints: {
                    1920: {
                        spaceBetween: 32,
                        slidesPerView: slidesPerView1920,
                    },
                    1920: {
                        spaceBetween: 32,
                        slidesPerView: slidesPerView1920,
                    },
                    1440: {
                        spaceBetween: 32,
                        slidesPerView: slidesPerView1440,
                    },
                    1028: {
                        spaceBetween: 32,
                        slidesPerView: slidesPerView1028,
                    },
                    840: {
                        spaceBetween: 16,
                        slidesPerView: slidesPerView840,
                    },
                    740: {
                        spaceBetween: 16,
                        slidesPerView: slidesPerView740,
                    },
                    600: {
                        spaceBetween: 16,
                        slidesPerView: slidesPerView600,
                    },
                    420: {
                        spaceBetween: 16,
                        slidesPerView: slidesPerView420,
                    },
                    375: {
                        spaceBetween: 8,
                        slidesPerView: slidesPerView375,
                    },
                    300: {
                        spaceBetween: 8,
                        slidesPerView: slidesPerView300,
                    },
                },
                on: {
                    init: function () {
                    }
                }
            });
        } else {
            var AdvanceSlider = new Swiper(`${el}`, {
                slidesPerView: slidesPerView,
                spaceBetween: 32,
                loop: false,
                grabCursor: false,
                initialSlide: 0,
                speed: 200,
                autoplay: false,
                navigation: {
                    nextEl: `${nextEl}`,
                    prevEl: `${prevEl}`
                },
                scrollbar: {
                    el: scrollbar,
                    draggable: true,
                    hide: false,
                },
                breakpoints: {
                    1920: {
                        spaceBetween: 32,
                        slidesPerView: slidesPerView1920,
                    },
                    1440: {
                        spaceBetween: 32,
                        slidesPerView: slidesPerView1440,
                    },
                    1028: {
                        spaceBetween: 32,
                        slidesPerView: slidesPerView1028,
                    },
                    840: {
                        spaceBetween: 16,
                        slidesPerView: slidesPerView840,
                    },
                    740: {
                        spaceBetween: 16,
                        slidesPerView: slidesPerView740,
                    },
                    600: {
                        spaceBetween: 16,
                        slidesPerView: slidesPerView600,
                    },
                    420: {
                        spaceBetween: 16,
                        slidesPerView: slidesPerView420,
                    },
                    375: {
                        spaceBetween: 8,
                        slidesPerView: slidesPerView375,
                    },
                    300: {
                        spaceBetween: 8,
                        slidesPerView: slidesPerView300,
                    },
                },
                on: {
                    init: function () {
                    }
                }
            });
        }

    },
    testimonialsSlider: function (el) {

        var nextEl = '.' + $(el).next('.testimonialsActionBlocksWrap').find('.sliderRightNavbar').attr('id');
        var prevEl = '.' + $(el).next('.testimonialsActionBlocksWrap').find('.sliderLeftNavbar').attr('id');
        var scrollbar = '.' + $(el).next('.testimonialsActionBlocksWrap').find('.swiper-scrollbar').attr('id');

        var type = $(el).attr('data-type');

        var slidesPerView = 1;
        var slidesPerView1920 = 1;
        var slidesPerView1440 = 1;
        var slidesPerView1028 = 1;
        var slidesPerView840 = 1;
        var slidesPerView740 = 1;
        var slidesPerView600 = 1;
        var slidesPerView420 = 1;
        var slidesPerView375 = 1;
        var slidesPerView300 = 1;

        if (type == "video") {
            slidesPerView = 1;
            slidesPerView1920 = 1;
            slidesPerView1440 = 1;
            slidesPerView1028 = 1;
            slidesPerView840 = 1;
            slidesPerView740 = 1;
            slidesPerView600 = 1;
            slidesPerView420 = 1;
            slidesPerView375 = 1;
            slidesPerView300 = 1;
        }

        if (type == "testimonialQuotes") {
            slidesPerView = 1;
            slidesPerView1920 = 1;
            slidesPerView1440 = 1;
            slidesPerView1028 = 1;
            slidesPerView840 = 1;
            slidesPerView740 = 1;
            slidesPerView600 = 1;
            slidesPerView420 = 1;
            slidesPerView375 = 1;
            slidesPerView300 = 1;
        }

        var testimonialsSlider = new Swiper(`${el}`, {
            slidesPerView: slidesPerView,
            spaceBetween: 32,
            loop: false,
            grabCursor: false,
            speed: 200,
            autoplay: false,
            navigation: {
                nextEl: `${nextEl}`,
                prevEl: `${prevEl}`
            },
            scrollbar: {
                el: scrollbar,
                draggable: true,
                hide: false,
            },
            breakpoints: {
                1920: {
                    spaceBetween: 32,
                    slidesPerView: slidesPerView1920,
                },
                1440: {
                    spaceBetween: 32,
                    slidesPerView: slidesPerView1440,
                },
                1028: {
                    spaceBetween: 32,
                    slidesPerView: slidesPerView1028,
                },
                840: {
                    spaceBetween: 16,
                    slidesPerView: slidesPerView840,
                },
                740: {
                    spaceBetween: 16,
                    slidesPerView: slidesPerView740,
                },
                600: {
                    spaceBetween: 16,
                    slidesPerView: slidesPerView600,
                },
                420: {
                    spaceBetween: 16,
                    slidesPerView: slidesPerView420,
                },
                375: {
                    spaceBetween: 8,
                    slidesPerView: slidesPerView375,
                },
                300: {
                    spaceBetween: 8,
                    slidesPerView: slidesPerView300,
                },
            }
        });

        testimonialsSlider.on('slideChange', function () {
            if ($('.testimonialsWrap video')[0]) {
                $('.bg-video video').each(function () {
                    this.pause();
                });

                $('.playOptions.play').removeClass('hide').addClass('show');
                $('.playOptions.pause').addClass('hide').removeClass('show');
            }
        });

    },
    numberFormat(num) {
        var num_parts = num.toString().split(".");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return num_parts.join(".");
    },
    colorReduce: function () {
        if ($('.customerJourneyCardItemTitle')[0]) {
            var color = "rgba(0,175,203,";
            var all = $('.customerJourneyCardItemTitle').length,
                total = 1 / all;
            $($(".customerJourneyCardItemTitle").get().reverse()).each(function (i) {
                var opacity = (total * (all - i)) / 1,
                    newTone = color + opacity + ")";
                $(this).css('background-color', newTone);
                $(this).prev('.customerJourneyCardItemTitleSpan').css('background-color', newTone)
            })
        }
    },
    pauseVideo: function () {
        $('.bg-video video').each(function () {
            this.pause();
        });
    },
    addVideo: function (slide) {
        var videoHtml = "",
            mp4 = slide.data('mp4'),
            webm = slide.data('webm'),
            subtitle = slide.data('subtitle');

        if (typeof mp4 != "undefined" && slide.length) {
            videoHtml += '<video';
            videoHtml += ' autoplay loop muted playsinline class="play">';
            videoHtml += '<source src="' + mp4 + '" type="video/mp4">';
            videoHtml += '<source src="' + webm + '" type="video/webm">';
            if ((subtitle) && (subtitle != ''))
                videoHtml += '<track label="English" kind="subtitles" srclang="en" src="' + subtitle + '" default>';
            videoHtml += '</video>';
            slide.removeAttr('data-mp4 data-webm').append(videoHtml);
            browser.playVisibleEvents();
            video.objectFit();
        }
    },
    megaMenuHeight: function () {
        var windowHeight = $(window).height();
        windowHeight = windowHeight - 200;
        $('.dropDownMenu').css({
            'max-height': windowHeight,
        })
    },
    checkIp: function () {
        const countrySwitcher = $('.countrySwitcher');
        if (countrySwitcher.length) {
            $.ajaxq.abort("ipinfo");
            $.ajaxq("ipinfo", {
                url: ajax_url,
                data: { action: 'ipinfo' },
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data && data.country_code === 'GB') {
                        countrySwitcher.val('gbp').trigger('change');
                    }
                },
            });
        }
    },
    targetBlank: function () {
        $("a[href^=http]").each(function () {
            var href = $(this).attr("href");
            var target = $(this).attr("target");
            if (!target) {
                if (href.indexOf('csdemo.turtl.co') != -1 || href.indexOf('trial.turtl.co') != -1 || href.indexOf('team.turtl.co') != -1) {
                    //do nothing
                } else if ((href.indexOf(location.hostname) === -1 || href.match(/\.(pdf|doc|docx|ppt|pptx|xls|slxs|epub|odp|ods|txt|rtf)$/i))) {
                    $(this).attr('target', '_blank');
                }
            }
        });
    },
    calculateReadTime: function () {
        if ($('.readTime .rt').length) {
            const text = $('.content').text();
            const wpm = 250;
            const words = text.trim().split(/\s+/).length;
            const time = Math.ceil(words / wpm);
            $('.readTime .rt').html(`${time} minutes`);
        }
    },
    comparePlanTableAddClass: function () {
        $('.comparePlansTable').each(function () {
            if ($(this).data('wid')) {
                let numberOfThs = $(this).find('.comparePlansTableWrap tr:first th').length;
                console.log(numberOfThs);
                if (numberOfThs > 5) {
                    $(this).find('.comparePlansTableWrap').addClass('tableColumnOverflow');
                }
            }
        });
        $('.tables').each(function () {
            if ($(this).data('wid')) {
                let tableWrap = $(this).find('.comparePlansTableWrap');
                if (tableWrap.length > 0 && !tableWrap.hasClass('tableAxisY')) {
                    let numberOfThs = tableWrap.find('tr:first th').length;
                    if (numberOfThs > 5) {
                        tableWrap.addClass('tableColumnOverflow');
                    }
                }
            }
        });
    }
};
