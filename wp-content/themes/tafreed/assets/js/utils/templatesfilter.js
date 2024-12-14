$(window).on('load',function(){
    setTimeout(function() {
    //Filter
    var templatesFilter = jQuery('.templatesListContent').isotope({
        layoutMode: 'fitRows',
        resizable: true,
        sortBy: 'original-order',
        itemSelector: '.templatesCardItem',
        getSortData: {
            name: 'h2',
            date: '.datetime',
        },
        sortAscending: {
            name: true,
            date: false
        }
    });

    var filtertemplatesType = '';
    var qsRegex;
    var info = templatesFilter.data('isotope');

    var templatesSearch = $('.templatesSearchInput').keyup(function() {
        qsRegex = new RegExp(templatesSearch.val(), 'gi');
        $('.templatesCardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        filterType = '';
        $('.filterContentTypePlaceholder').text('Content Type');

        $('.filterfilterOrderByPlaceholder').text('Sort by latest');

        $('.templatesListContent').addClass('all');
        templatesFilter.isotope({
            filter: function() {
                return qsRegex ? $(this).text().match(qsRegex) : true;
            }
        });

        if (info.filteredItems.length == 0) {
            $('.templatesListMessageWrap').addClass('show');
        } else {
            $('.templatesListMessageWrap').removeClass('show');
        }

        $('.templatesListButtonWrap').hide();
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

    $('.filtertemplatesType li a').click(function(e){
        e.preventDefault();
        $('.templatesListContent').addClass('all');
        $('.templatesSearchInput').val('');
        $('.templatesListMessageWrap').removeClass('show');
        filtertemplatesType = '';
        $(this).parent().parent().parent().removeClass('open');
        $('.templatesCardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        var placeHolder = $(this).parent().parent().parent().find('.filterPlaceholder').attr('data-label');

        if ($(this).parent().parent().parent().hasClass('filtertemplatesType')) {
            $('.filterIndustryPlaceholder').text($('.filterIndustryPlaceholder').attr('data-label'));
            $('.filterChallengePlaceholder').text($('.filterChallengePlaceholder').attr('data-label'));
            if ($(this).attr('data-filter') == 'all') {
                $('.filterContentTypePlaceholder').text(placeHolder);
            }else{
                $('.filterContentTypePlaceholder').text($(this).text());
                filtertemplatesType = $(this).attr('data-filter');
            }
        }

        templatesFilter.isotope({
            filter: filtertemplatesType
        });
        $('.templatesListButtonWrap').hide();
    });

    $('.filtertemplatesOrderBy li a').click(function(e){
        e.preventDefault();
        $('.templatesSearchInput').text('');
        $('.templatesListMessageWrap').removeClass('show');
        $('.templatesListContent').addClass('all');
        $(this).parent().parent().parent().removeClass('open');
        $('.templatesListContent .cardItem').addClass('columnThree').removeClass('columnTwo');
        //$('.postPin').css('opacity','0');
        if ($(this).attr('data-order') == 'random') {
            templatesFilter.isotope({
                sortBy: 'random'
            })
        } else {
            templatesFilter.isotope({
                sortBy: $(this).attr('data-order')
            })
        }
        $('.filterfilterOrderByPlaceholder').text(($(this).text() == "Reset") ? "Sort by latest" : $(this).text());
        $('.templatesListButtonWrap').hide();
    });

    $('body').on('click','.templatesListContentWrap .viewAllBtn',function(){
        $('.templatesSearchInput').val('');
        $('.templatesListMessageWrap').removeClass('show');
        $('.templatesListContent').addClass('all');
        $('.templatesListButtonWrap').hide();
        templatesFilter.isotope();
    });

    $('body').on('click','.templatesListMessageWrap .resetBtn',function(){
        $('.templatesSearchInput').val('');
        $('.templatesListMessageWrap').removeClass('show');
        $('.templatesListContent').addClass('all');
        $('.templatesListButtonWrap').hide();
        filtertemplatesType = '';
        templatesFilter.isotope({
            filter: filtertemplatesType
        });
    })
    }, 150);
});