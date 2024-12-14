$(window).on('load',function(){
    setTimeout(function() {
    //Filter
    var communityShowcaseFilter = jQuery('.communityShowcaseListContent').isotope({
        layoutMode: 'fitRows',
        resizable: true,
        sortBy: 'original-order',
        itemSelector: '.communityShowcase',
        getSortData: {
            name: 'h2',
            date: function(itemElem) {
                var date = $(itemElem).find('.datetime').text();
                var parts = date.split(' ');
                if (parts.length === 2) {
                    var dateParts = parts[0].split('/');
                    var timeParts = parts[1].split(':');
                    if (dateParts.length === 3 && timeParts.length === 3) {
                        var year = parseInt(dateParts[0]);
                        var month = parseInt(dateParts[1]) - 1;
                        var day = parseInt(dateParts[2]);
                        var hours = parseInt(timeParts[0]);
                        var minutes = parseInt(timeParts[1]);
                        var seconds = parseInt(timeParts[2]);
    
                        return new Date(year, month, day, hours, minutes, seconds).getTime();
                    }
                }
            }
        },
        sortAscending: {
            name: true,
            date: false
        }
    });

    var filterCommunityShowcaseIndustry = '';
    var filterCommunityShowcaseContentType = '';
    var filterCommunityShowcaseFeature = '';
    var qsRegex;
    var info = communityShowcaseFilter.data('isotope');

    var communityShowcaseSearch = $('.communityShowcaseSearchInput').keyup(function() {
        qsRegex = new RegExp(communityShowcaseSearch.val(), 'gi');
        $('.communityShowcaseListContent .cardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        filterCommunityShowcaseIndustry = '';
        $('.filterCommunityShowcaseIndustryPlaceholder').text('Industry');
        filterCommunityShowcaseFeature = '';
        $('.filterCommunityShowcaseFeaturePlaceholder').text('Feature');
        filterCommunityShowcaseContentType = '';
        $('.filterCommunityShowcaseContentTypePlaceholder').text('Content Type');

        $('.filterfilterOrderByPlaceholder').text('Sort by');

        $('.communityShowcaseListContent').addClass('all');
        communityShowcaseFilter.isotope({
            filter: function() {
                return qsRegex ? $(this).text().match(qsRegex) : true;
            }
        });

        if (info.filteredItems.length == 0) {
            $('.communityShowcaseListMessageWrap').addClass('show');
        } else {
            $('.communityShowcaseListMessageWrap').removeClass('show');
        }

        $('.communityShowcaseListButtonWrap').hide();
    });

    $('body').click(function() {
        $('.filter').removeClass('open');
    }).find('.filter, .filter *').click(function(e) {
        e.stopPropagation();
    });
    $('.filter p').click(function() {
        $('.filter').removeClass('open');
        $(this).parent().addClass('open');
    });

    $('.filterCommunityShowcaseIndustry li a, .filterCommunityShowcaseContentType li a, .filterCommunityShowcaseFeature li a').click(function(e){
        e.preventDefault();
        $('.communityShowcaseListContent').addClass('all');
        $('.communityShowcaseSearchInput').val('');
        $('.communityShowcaseListMessageWrap').removeClass('show');
        filterCommunityShowcaseIndustry = '';
        filterCommunityShowcaseContentType = '';
        filterCommunityShowcaseFeature = '';
        $(this).parent().parent().parent().removeClass('open');
        $('.communityShowcaseListContent .cardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        var placeHolder = $(this).parent().parent().parent().find('.filterPlaceholder').attr('data-label');

        if ($(this).parent().parent().parent().hasClass('filterCommunityShowcaseIndustry')) {
            $('.filterCommunityShowcaseIndustryPlaceholder').text($('.filterCommunityShowcaseIndustryPlaceholder').attr('data-label'));
            $('.filterCommunityShowcaseContentTypePlaceholder').text($('.filterCommunityShowcaseContentTypePlaceholder').attr('data-label'));
            $('.filterCommunityShowcaseFeaturePlaceholder').text($('.filterCommunityShowcaseFeaturePlaceholder').attr('data-label'));
            if ($(this).attr('data-filter') == 'all') {
                $('.filterCommunityShowcaseIndustryPlaceholder').text(placeHolder);
            }else{
                $('.filterCommunityShowcaseIndustryPlaceholder').text($(this).text());
                filterCommunityShowcaseIndustry = $(this).attr('data-filter');
            }
        }
        if ($(this).parent().parent().parent().hasClass('filterCommunityShowcaseContentType')) {
            $('.filterCommunityShowcaseContentTypePlaceholder').text($('.filterCommunityShowcaseContentTypePlaceholder').attr('data-label'));
            $('.filterCommunityShowcaseIndustryPlaceholder').text($('.filterCommunityShowcaseIndustryPlaceholder').attr('data-label'));
            $('.filterCommunityShowcaseFeaturePlaceholder').text($('.filterCommunityShowcaseFeaturePlaceholder').attr('data-label'));
            if ($(this).attr('data-filter') == 'all') {
                $('.filterCommunityShowcaseContentTypePlaceholder').text(placeHolder);
            }else{
                $('.filterCommunityShowcaseContentTypePlaceholder').text($(this).text());
                filterCommunityShowcaseContentType = $(this).attr('data-filter');
            }
        }
        if ($(this).parent().parent().parent().hasClass('filterCommunityShowcaseFeature')) {
            $('.filterCommunityShowcaseFeaturePlaceholder').text($('.filterCommunityShowcaseFeaturePlaceholder').attr('data-label'));
            $('.filterCommunityShowcaseContentTypePlaceholder').text($('.filterCommunityShowcaseContentTypePlaceholder').attr('data-label'));
            $('.filterCommunityShowcaseIndustryPlaceholder').text($('.filterCommunityShowcaseIndustryPlaceholder').attr('data-label'));
            if ($(this).attr('data-filter') == 'all') {
                $('.filterCommunityShowcaseFeaturePlaceholder').text(placeHolder);
            }else{
                $('.filterCommunityShowcaseFeaturePlaceholder').text($(this).text());
                filterCommunityShowcaseFeature = $(this).attr('data-filter');
            }
        }

        communityShowcaseFilter.isotope({
            filter: filterCommunityShowcaseIndustry + filterCommunityShowcaseContentType + filterCommunityShowcaseFeature
        });
        $('.communityShowcaseListButtonWrap').hide();

        var info = communityShowcaseFilter.data('isotope');
        if (info.filteredItems.length == 0) {
            $('.communityShowcaseListMessageWrap').addClass('show');
            $('.list-filters .filter ul').css('position','relative');
        } else {
            $('.communityShowcaseListMessageWrap').removeClass('show');
            $('.list-filters .filter ul').css('position','absolute');
        }
    });

    $('.filterCommunityShowcaseFeatureOrderBy li .filterOrderList').click(function(e){
        e.preventDefault();
        $('.communityShowcaseSearchInput').text('');
        $('.communityShowcaseListMessageWrap').removeClass('show');
        $(this).parent().parent().parent().removeClass('open');
        $('.communityShowcaseListContent .cardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        if ($(this).attr('data-order') == 'random') {
            communityShowcaseFilter.isotope({
                sortBy: 'random'
            })
        } else {
            communityShowcaseFilter.isotope({
                sortBy: $(this).attr('data-order')
            })
        }
        $('.filterfilterOrderByPlaceholder').text(($(this).text() == "Reset") ? "Sort by" : $(this).text());
    });

    $('body').on('click','.communityShowcaseListContentWrap .viewAllBtn',function(){
        $('.communityShowcaseSearchInput').val('');
        $('.communityShowcaseListMessageWrap').removeClass('show');
        $('.communityShowcaseListContent').addClass('all');
        $('.communityShowcaseListButtonWrap').hide();
        communityShowcaseFilter.isotope();
    });

    $('body').on('click','.communityShowcaseListContentWrap .resetBtn',function(){
        $('.communityShowcaseSearchInput').val('');
        $('.communityShowcaseListMessageWrap').removeClass('show');
        $('.communityShowcaseListContent').addClass('all');
        $('.communityShowcaseListButtonWrap').hide();
        filterCommunityShowcaseIndustry = '';
        filterCommunityShowcaseContentType = '';
        filterCommunityShowcaseFeature = '';
        communityShowcaseFilter.isotope({
            filter: filterCommunityShowcaseIndustry + filterCommunityShowcaseContentType + filterCommunityShowcaseFeature
        });
        $('.list-filters .filter ul').css('position','absolute');
        $('.filterCommunityShowcaseContentTypePlaceholder').text($('.filterCommunityShowcaseContentTypePlaceholder').attr('data-label'));
        $('.filterCommunityShowcaseIndustryPlaceholder').text($('.filterCommunityShowcaseIndustryPlaceholder').attr('data-label'));
        $('.filterCommunityShowcaseFeaturePlaceholder').text($('.filterCommunityShowcaseFeaturePlaceholder').attr('data-label'));
    })
    }, 150);
});