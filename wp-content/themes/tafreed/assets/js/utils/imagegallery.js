
$(document).ready(function ($) {
    var popup = {
        init: function () {
            popup.popupVideo();
        },
        popupVideo: function () {
            $('.videolightbox').magnificPopup({
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: true,
                fixedContentPos: true,
                gallery: {
                    enabled: true
                }
            });
            /* Image Popup*/
            $('.imagesGrid.image').magnificPopup({
                delegate: '.imagelightbox',
                type: 'image',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: true,
                fixedContentPos: true,
                gallery: {
                    enabled: true
                }
            });
        }
    };
    popup.init($);
});
