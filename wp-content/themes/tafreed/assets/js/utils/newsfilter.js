$(window).on('load',function(){
    setTimeout(function() {
    //Filter
    var newsFilter = jQuery('.newsListContent').isotope({
        layoutMode: 'fitRows',
        resizable: true,
        sortBy: 'original-order',
        itemSelector: '.newsCardItem',
        getSortData: {
            name: 'h2',
            date: '.datetime',
        },
        sortAscending: {
            name: true,
            date: false
        }
    });

    var filternewsType = '';
    var qsRegex;
    var info = newsFilter.data('isotope');

    var newsSearch = $('.newsSearchInput').keyup(function() {
        qsRegex = new RegExp(newsSearch.val(), 'gi');
        $('.newsCardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        filterType = '';
        $('.filterContentTypePlaceholder').text('Content Type');

        $('.filterfilterOrderByPlaceholder').text('Sort by latest');

        $('.newsListContent').addClass('all');
        newsFilter.isotope({
            filter: function() {
                return qsRegex ? $(this).text().match(qsRegex) : true;
            }
        });

        if (info.filteredItems.length == 0) {
            $('.newsListMessageWrap').addClass('show');
        } else {
            $('.newsListMessageWrap').removeClass('show');
        }

        $('.newsListButtonWrap').hide();
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

    $('.filternewsType li a').click(function(e){
        e.preventDefault();
        $('.newsListContent').addClass('all');
        $('.newsSearchInput').val('');
        $('.newsListMessageWrap').removeClass('show');
        filternewsType = '';
        $(this).parent().parent().parent().removeClass('open');
        $('.newsCardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        var placeHolder = $(this).parent().parent().parent().find('.filterPlaceholder').attr('data-label');

        if ($(this).parent().parent().parent().hasClass('filternewsType')) {
            $('.filterIndustryPlaceholder').text($('.filterIndustryPlaceholder').attr('data-label'));
            $('.filterChallengePlaceholder').text($('.filterChallengePlaceholder').attr('data-label'));
            if ($(this).attr('data-filter') == 'all') {
                $('.filterContentTypePlaceholder').text(placeHolder);
            }else{
                $('.filterContentTypePlaceholder').text($(this).text());
                filternewsType = $(this).attr('data-filter');
            }
        }

        newsFilter.isotope({
            filter: filternewsType
        });
        $('.newsListButtonWrap').hide();
    });

    $('.filternewsOrderBy li a').click(function(e){
        e.preventDefault();
        $('.newsSearchInput').text('');
        $('.newsListMessageWrap').removeClass('show');
        $('.newsListContent').addClass('all');
        $(this).parent().parent().parent().removeClass('open');
        $('.newsListContent .cardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        if ($(this).attr('data-order') == 'random') {
            newsFilter.isotope({
                sortBy: 'random'
            })
        } else {
            newsFilter.isotope({
                sortBy: $(this).attr('data-order')
            })
        }
        $('.filterfilterOrderByPlaceholder').text(($(this).text() == "Reset") ? "Sort by latest" : $(this).text());
        $('.newsListButtonWrap').hide();
    });

    $('body').on('click','.newsListContentWrap .viewAllBtn',function(){
        $('.newsSearchInput').val('');
        $('.newsListMessageWrap').removeClass('show');
        $('.newsListContent').addClass('all');
        $('.newsListButtonWrap').hide();
        newsFilter.isotope();
    });

    $('body').on('click','.newsListMessageWrap .resetBtn',function(){
        $('.newsSearchInput').val('');
        $('.newsListMessageWrap').removeClass('show');
        $('.newsListContent').addClass('all');
        $('.newsListButtonWrap').hide();
        filternewsType = '';
        newsFilter.isotope({
            filter: filternewsType
        });
    })
    }, 150);
});