$(window).on('load',function(){
    setTimeout(function() {
    //Filter
    var integrateFilter = jQuery('.integrateListContent').isotope({
        layoutMode: 'fitRows',
        resizable: true,
        sortBy: 'original-order',
        itemSelector: '.integrateCardItem',
        getSortData: {
            name: 'h2',
            date: '.datetime',
        },
        sortAscending: {
            name: true,
            date: false
        }
    });

    var filterIntegrateType = '';
    var qsRegex;
    var info = integrateFilter.data('isotope');

    var integrateSearch = $('.integrateSearchInput').keyup(function() {
        qsRegex = new RegExp(integrateSearch.val(), 'gi');
        $('.integrateCardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        filterType = '';
        $('.filterContentTypePlaceholder').text('Content Type');

        $('.filterfilterOrderByPlaceholder').text('Sort by latest');

        $('.integrateListContent').addClass('all');
        integrateFilter.isotope({
            filter: function() {
                return qsRegex ? $(this).text().match(qsRegex) : true;
            }
        });

        if (info.filteredItems.length == 0) {
            $('.integrateListMessageWrap').addClass('show');
        } else {
            $('.integrateListMessageWrap').removeClass('show');
        }

        $('.integrateListButtonWrap').hide();
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

    $('.filterIntegrateType li a').click(function(e){
        e.preventDefault();
        $('.integrateListContent').addClass('all');
        $('.integrateSearchInput').val('');
        $('.integrateListMessageWrap').removeClass('show');
        filterIntegrateType = '';
        $(this).parent().parent().parent().removeClass('open');
        $('.integrateCardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        var placeHolder = $(this).parent().parent().parent().find('.filterPlaceholder').attr('data-label');

        if ($(this).parent().parent().parent().hasClass('filterIntegrateType')) {
            $('.filterIndustryPlaceholder').text($('.filterIndustryPlaceholder').attr('data-label'));
            $('.filterChallengePlaceholder').text($('.filterChallengePlaceholder').attr('data-label'));
            if ($(this).attr('data-filter') == 'all') {
                $('.filterContentTypePlaceholder').text(placeHolder);
            }else{
                $('.filterContentTypePlaceholder').text($(this).text());
                filterIntegrateType = $(this).attr('data-filter');
            }
        }

        integrateFilter.isotope({
            filter: filterIntegrateType
        });
        $('.integrateListButtonWrap').hide();
    });

    $('body').on('click','.integrateListMessageWrap .resetBtn',function(){
        $('.integrateSearchInput').val('');
        $('.integrateListMessageWrap').removeClass('show');
        $('.integrateListContent').addClass('all');
        $('.integrateListButtonWrap').hide();
        filterIntegrateType = '';
        integrateFilter.isotope({
            filter: filterIntegrateType
        });
    })
    }, 150);
});