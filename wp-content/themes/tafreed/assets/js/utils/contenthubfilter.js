$(function () {
    $(document).on("keyup", ".contentHubSearchInput", function () {
        var industryT = $('.contentHubListContent').attr('data-industry');
        var contentTypeT = $('.contentHubListContent').attr('data-content-type');
        contenthubfilter.clear_pagination();
        contenthubfilter.contentHubList(1,industryT,contentTypeT);
        $('.urlp').val('1');
    });
});

$(document).on('click', '.contenthubfilterpage a', function (e) {
    e.preventDefault();
    $('.contentHubListContentWrap .button.loader').removeClass('hide');
    $('.urlp').val('1');
    var industryT = $('.contentHubListContent').attr('data-industry');
    var contentTypeT = $('.contentHubListContent').attr('data-content-type');
    if ($(this).hasClass('prev') || $(this).hasClass('next')) {
        paginateNum = $(this).find('.roundArrow').data('attr');
        contenthubfilter.clear_pagination();
        contenthubfilter.contentHubList(paginateNum,industryT,contentTypeT);
        $('html, body').animate({
            scrollTop: $('.contentHubList').offset().top - $('.header').height()
        }, 'fast');
    } else {
        paginateNum = $(this).text();
        contenthubfilter.clear_pagination();
        contenthubfilter.contentHubList(paginateNum,industryT,contentTypeT);
        $('html, body').animate({
            scrollTop: $('.contentHubList').offset().top - $('.header').height()
        }, 'fast');
    }
});

$(window).on('load',function(){
    setTimeout(function() {
        $('.filterContentHubIndustry li a, .filterContentHubChallenge li a, .filterContentHubOrderBy li a, .filterContentHubOrderBy li a').click(function(e){
            $('.contentHubListContentWrap .button.loader').removeClass('hide');
            e.preventDefault();
            $(this).parent().parent().parent().removeClass('open');

            var industryT = "";
            var contentTypeT = "";

            if($(this).parent().parent().parent().hasClass('filterContentHubIndustry')){
                $('.filterContentHubIndustryInput').val($(this).attr('data-filter'));
                $('.filterIndustryPlaceholder').text(($(this).text() == "All") ? "Topic" : $(this).text());
                $('.filterContentHubChallengeInput').val("");
                $('.filterChallengePlaceholder').text("Format");
            }

            if($(this).parent().parent().parent().hasClass('filterContentHubChallenge')){
                $('.filterContentHubChallengeInput').val($(this).attr('data-filter'));
                $('.filterChallengePlaceholder').text(($(this).text() == "All") ? "Format" : $(this).text());
                $('.filterIndustryPlaceholder').text("Topic");
                $('.filterContentHubIndustryInput').val("");
            }

            if($(this).parent().parent().parent().hasClass('filterContentHubOrderBy')){
                $('.filterContentHubOrderByInput').val($(this).attr('data-filter'));
                $('.filterfilterOrderByPlaceholder').text(($(this).text() == "Reset") ? "Sort by latest" : $(this).text());
            }

            industryT = $('.contentHubListContent').attr('data-industry');
            contentTypeT = $('.contentHubListContent').attr('data-content-type');

			contenthubfilter.clear_pagination();
			contenthubfilter.contentHubList(1,industryT,contentTypeT);
        });

        var industryT = "";
        var contentTypeT = "";

        if($('.contentHubListContent').attr('data-type') == "topicBased"){
            industryT = $('.contentHubListContent').attr('data-industry');
            contentTypeT = $('.contentHubListContent').attr('data-content-type');
        }

        $('.contentHubSearchInput').keyup(function() {
			contenthubfilter.clear_pagination();
			contenthubfilter.contentHubList(1,industryT,contentTypeT);
        });

        $('.contentHubListContentMessageWrap .resetBtn').click(function(e){
            $('.contentHubListContentMessageWrap').removeClass('show');
            $('.filterContentHubIndustryInput').val('');
            $('.filterContentHubChallengeInput').val('');
            $('.filterContentHubOrderByInput').val('desc');
            $('.contentHubSearchInput').val('');
            contenthubfilter.clear_pagination();
			contenthubfilter.contentHubList(1,industryT,contentTypeT);
        })
    }, 150);
});

var contenthubfilter = {
    contentHubList: function (paginateNum,industryT,contentTypeT){
        $('.contentHubListContentWrap .button.loader').removeClass('hide');
        var industry = $('.filterContentHubIndustryInput').val();
        var contentType = $('.filterContentHubChallengeInput').val();
        var orderBy = $('.filterContentHubOrderByInput').val();
        var order = $('.filterContentHubOrderInput').val();
        var searchText = $('.contentHubSearchInput').val();
        var wid = $('.contentHubList').attr('data-wid');
        var adminType = $('.contentHubListContent').attr('data-type');

        if (paginateNum) {
            var paged = paginateNum;
        } else {
            var paged = '1';
        }

        var id = '';
        id = "page=" + paged;

        if (searchText){
            id += "&search_text=" + searchText;
        }
        if (industry){
            id += "&topic=" + industry;
        }
        if (contentType){
            id += "&type=" + contentType;
        }
        if (orderBy){
            id += "&orderby=" + orderBy;
        }

        id = ""; //Temp Code

        $.ajaxq.abort("contentHubList");
        $.ajaxq("contentHubList", {
            url: ajax_url,
            data: {action: 'contentHubList',adminType: adminType,industryT: industryT,contentTypeT: contentTypeT, industry: industry,contentType: contentType,searchText: searchText,orderBy : orderBy,order : order, paged: paged,wid: wid, ajax: '1'},
            type: "POST",
            success: function (data) {
                $('.contentHubListContentWrap .button.loader').addClass('hide');
                if (data == 0) {
                    $('.contentHubListContentMessageWrap').addClass('show');
                } else {
                    $(".contentHubListContent").html(data);
                    if($('.columnTwo.pinYes').length == 1){
                        $('.columnTwo.pinYes').removeClass('pinYes');
                    }
                    $('.contentHubListContentMessageWrap').removeClass('show');
                }
            },
            complete: function () {
                setTimeout(function () {
                    if(browser._windowWidth > 820) {
                        adjustHeights.setHeightByAll(".cardTitleEqualHeight"+wid);
                        adjustHeights.setHeightByAll(".cardTermsEqualHeight"+wid);
                        adjustHeights.setHeightByAll(".cardDescEqualHeight"+wid);
                        adjustHeights.setHeightByAll(".cardEqualHeight"+wid);
                    }
                }, 500);
                contenthubfilter.pushState(id);
                $('.modernPagination ul').append('<div class="sliderMover"></div>');
            }
        });
    }, clear_pagination: function () {
        $(".contentHubListContent").html("");
    }, pushState: function (id) {
        var article_blocks = $('.contentHubListContent');
        if(article_blocks.length){
            if (history.pushState) {
                link = location.protocol + "//" + window.location.hostname + window.location.pathname;
                if (id != "")
                    link += "?" + id;
                history.pushState('', '', link);
            }
        }
    }
}