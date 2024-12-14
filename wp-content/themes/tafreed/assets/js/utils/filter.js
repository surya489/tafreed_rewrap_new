$(window).on('load',function(){
    setTimeout(function() {
    //Filter
    var storyFilter = jQuery('.customerSuccessStoriesListContent').isotope({
        layoutMode: 'fitRows',
        resizable: true,
        sortBy: 'original-order',
        itemSelector: '.customerSuccessStoriesCardItem',
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

    var filterIndustry = '';
    var filterType = '';
    var filterChallenge = '';
    var qsRegex;
    var info = storyFilter.data('isotope');

    var customerSuccessStoriesSearch = $('.customerSuccessStoriesSearchInput').keyup(function() {
        qsRegex = new RegExp(customerSuccessStoriesSearch.val(), 'gi');
        $('.customerSuccessStoriesCardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        filterIndustry = '';
        $('.filterIndustryPlaceholder').text('Industry');
        filterChallenge = '';
        $('.filterChallengePlaceholder').text('Challenge');
        filterType = '';
        $('.filterContentTypePlaceholder').text('Content Type');

        $('.filterfilterOrderByPlaceholder').text('Sort by');

        $('.customerSuccessStoriesListContent').addClass('all');
        storyFilter.isotope({
            filter: function() {
                return qsRegex ? $(this).text().match(qsRegex) : true;
            }
        });

        if (info.filteredItems.length == 0) {
            $('.customerSuccessStoriesListMessageWrap').addClass('show');
        } else {
            $('.customerSuccessStoriesListMessageWrap').removeClass('show');
        }

        $('.customerSuccessStoriesListButtonWrap').hide();
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

    $('.filterIndustry li a, .filterChallenge li a, .filterContentType li a').click(function(e){
        e.preventDefault();
        $('.customerSuccessStoriesListContent').addClass('all');
        $('.customerSuccessStoriesSearchInput').val('');
        $('.customerSuccessStoriesListMessageWrap').removeClass('show');
        filterIndustry = '';
        filterType = '';
        filterChallenge = '';
        $(this).parent().parent().parent().removeClass('open');
        $('.customerSuccessStoriesCardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        var placeHolder = $(this).parent().parent().parent().find('.filterPlaceholder').attr('data-label');

        if ($(this).parent().parent().parent().hasClass('filterIndustry')) {
            $('.filterChallengePlaceholder').text($('.filterChallengePlaceholder').attr('data-label'));
            $('.filterContentTypePlaceholder').text($('.filterContentTypePlaceholder').attr('data-label'));
            if ($(this).attr('data-filter') == 'all') {
                $('.filterIndustryPlaceholder').text(placeHolder);
            }else{
                $('.filterIndustryPlaceholder').text($(this).text());
                filterIndustry = $(this).attr('data-filter');
            }
        }
        if ($(this).parent().parent().parent().hasClass('filterChallenge')) {
            $('.filterIndustryPlaceholder').text($('.filterIndustryPlaceholder').attr('data-label'));
            $('.filterContentTypePlaceholder').text($('.filterContentTypePlaceholder').attr('data-label'));
            if ($(this).attr('data-filter') == 'all') {
                $('.filterChallengePlaceholder').text(placeHolder);
            }else{
                $('.filterChallengePlaceholder').text($(this).text());
                filterChallenge = $(this).attr('data-filter');
            }
        }
        if ($(this).parent().parent().parent().hasClass('filterContentType')) {
            $('.filterIndustryPlaceholder').text($('.filterIndustryPlaceholder').attr('data-label'));
            $('.filterChallengePlaceholder').text($('.filterChallengePlaceholder').attr('data-label'));
            if ($(this).attr('data-filter') == 'all') {
                $('.filterContentTypePlaceholder').text(placeHolder);
            }else{
                $('.filterContentTypePlaceholder').text($(this).text());
                filterType = $(this).attr('data-filter');
            }
        }

        storyFilter.isotope({
            filter: filterIndustry + filterType + filterChallenge
        });
        $('.customerSuccessStoriesListButtonWrap').hide();

        var info = storyFilter.data('isotope');
        if (info.filteredItems.length == 0) {
            $('.customerSuccessStoriesListMessageWrap').addClass('show');
            $('.list-filters .filter ul').css('position','relative');
        } else {
            $('.customerSuccessStoriesListMessageWrap').removeClass('show');
            $('.list-filters .filter ul').css('position','absolute');
        }
    });

    $('.filterOrderBy li .filterOrderList').click(function(e){
        e.preventDefault();
        $('.customerSuccessStoriesSearchInput').text('');
        $('.customerSuccessStoriesListMessageWrap').removeClass('show');
        $(this).parent().parent().parent().removeClass('open');
        $('.customerSuccessStoriesCardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        if ($(this).attr('data-order') == 'random') {
            storyFilter.isotope({
                sortBy: 'random'
            })
        } else {
            storyFilter.isotope({
                sortBy: $(this).attr('data-order')
            })
        }
        $('.filterfilterOrderByPlaceholder').text(($(this).text() == "Reset") ? "Sort by" : $(this).text());
    });

    $('body').on('click','.viewAllBtn',function(){
        $('.customerSuccessStoriesSearchInput').val('');
        $('.customerSuccessStoriesListMessageWrap').removeClass('show');
        $('.customerSuccessStoriesListContent').addClass('all');
        $('.customerSuccessStoriesListButtonWrap').hide();
        storyFilter.isotope();
    });

    $('body').on('click','.resetBtn',function(){
        $('.customerSuccessStoriesSearchInput').val('');
        $('.customerSuccessStoriesListMessageWrap').removeClass('show');
        $('.customerSuccessStoriesListContent').addClass('all');
        $('.customerSuccessStoriesListButtonWrap').hide();
        filterIndustry = '';
        filterType = '';
        filterChallenge = '';
        storyFilter.isotope({
            filter: filterIndustry + filterType + filterChallenge
        });
        $('.filterChallengePlaceholder').text($('.filterChallengePlaceholder').attr('data-label'));
        $('.filterIndustryPlaceholder').text($('.filterIndustryPlaceholder').attr('data-label'));
        $('.filterChallengePlaceholder').text($('.filterChallengePlaceholder').attr('data-label'));
    })
    }, 150);
});