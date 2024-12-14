$(function () {
    /*******************
     VIDEO
     ********************/
    //Close overlay
    $('body').on('click', '.video-overlay .close', function (e) {
        e.stopPropagation();
        video.close();
    });

    $(document).ready(function () {
        var video = $('.banner #video');
        var controlsTimeout;
    
        function removeControlsAfterDelay() {
            controlsTimeout = setTimeout(function () {
                video.prop("controls", false);
            }, 500);
        }

        function addControls() {
            video.prop("controls", true);
            clearTimeout(controlsTimeout);
        }

        function handleMouseEnter() {
            addControls();
        }

        function handleMouseLeave() {
            video.on('play playing pause', function() {
                removeControlsAfterDelay();
            });
        }

        function handleTouchStart() {
            addControls();
        }

        function handleTouchEnd() {
            video.on('play playing pause', function() {
                removeControlsAfterDelay();
            });
        }

        video.on('mouseenter', handleMouseEnter);
        video.on('mouseleave', handleMouseLeave);

        // Use touch events for mobile
        video.on('touchstart', handleTouchStart);
        video.on('touchend', handleTouchEnd);

        video.on('playing pause', function (e) {
            removeControlsAfterDelay();
        });
    });


    $('body').on('click', '.video-overlay', function (e) {
        var el = $(e.target);
        if (el.hasClass('player')) {
            //Nothing
        } else
            video.close();
    });
    
    $('body').on('click', 'a.watch-how.video_upload', function (e) {
        e.stopPropagation();
            e.preventDefault();
            if (this.href.indexOf(location.hostname) != -1 && !$(this).attr("href").match(/\.(mp4|webm|mov)$/i))
                return false;
        video.iframeEmbed(this.href);
    });
    $('body').on('click', 'a.watch-how.video_link', function (e) {
        e.stopPropagation();
        e.preventDefault();
        if (this.href.indexOf(location.hostname) != -1 && !$(this).attr("href").match(/\.(mp4|webm|mov)$/i))
            return false;
        video.embed(this.href);
    });
});


//Embed Video as overlay
var video = {
    embedUrl: function (link, autoplay, loop) {
        if (typeof autoplay == "undefined")
            autoplay = true;
        if (typeof loop == "undefined")
            loop = false;

        var pattern1 = /(?:http?s?:\/\/)?(?:www\.)?(?:vimeo\.com)\/?(.+)/g;
        var pattern2 = /(?:http?s?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(.+)/g;
        var embedUrl = "";

        if (pattern1.test(link)) {
            embedUrl = link.replace(pattern1, "https://player.vimeo.com/video/$1");
            if (autoplay) {
                //embedUrl += "?autoplay=1&background=1";
                if (loop)
                    embedUrl += "&loop=1";
            } else if (loop)
                embedUrl += "?loop=1";
        } else if (pattern2.test(link)) {
            embedUrl = link.replace(pattern2, "https://www.youtube.com/embed/$1?rel=0&amp;showinfo=0");
            if (autoplay)
                embedUrl += "&autoplay=1&mute=1";
            if (loop) {
                var id = this.getID(embedUrl);
                embedUrl += "&loop=1&playlist=" + id;
            }
        }

        return embedUrl;
    },
    getID: function (url) {
        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        var match = url.match(regExp);
        return (match && match[7].length == 11) ? match[7] : false;
    },
    embed: function (link) {
        var url = this.embedUrl(link);
        this.iframeEmbed(url);
    },
    iframeEmbed: function (link) {
        var iframe = '<iframe width="420" height="345" src="' + link + '" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>',
                html = '<div class="overlays video-overlay jsIframe">' + iframe + '<a class="close">&#215;</a></div>';

        $('body').append(html);
        this.fitObject();
        scrollbar.disable('has-overlay');
    },
    close: function () {
        scrollbar.enable('has-overlay', function () {
            $('.video-overlay').remove();
        });
    },
    fitObject: function () {
        var wid = 1280, hei = 720,
                wrapper = $('.overlay'),
                wrapperWid = wrapper.width() * .9, wrapperHei = wrapper.height() * .9, newWid = wrapperWid,
                newHei = Math.floor(newWid * hei / wid);
        if (newHei > wrapperHei) {
            newHei = wrapperHei;
            newWid = Math.floor(newHei * wid / hei);
        }

        $('.video-overlay .jsIframe , .video-overlay .jsVideo').css({
            'width': newWid + 'px', 'height': newHei + 'px'
        });
    },
    objectFit: function () {
        $('.jsVideo, .jsIframe').each(function () {
            var el = $(this);
            var wid = 1920,
                    hei = 1024,
                    wrapper = el.parent(),
                    wrapperWid = wrapper.width(),
                    wrapperHei = wrapper.height(),
                    newWid = wrapperWid,
                    newHei = Math.floor(newWid * hei / wid);

            if (newHei < wrapperHei) {
                newHei = wrapperHei;
                newWid = Math.floor(newHei * wid / hei);
            }

            el.css({
                'bottom': '50%',
                'left': '50%',
                'margin-bottom': -1 * Math.round(newHei / 2) + 'px',
                'margin-left': -1 * Math.round(newWid / 2) + 'px',
                'width': newWid + 'px',
                'height': newHei + 'px'
            });
            $(this).addClass("show");
                if (($(this).is(':in-viewport')) && ($(this).hasClass('play')))
                    this.play();
        });
    },
    check: function () {
        $('.jsVideo:not(.paused)').each(function () {
            var jThis = this, dollarThis = $(this);

            var delayTime = 0;
            delayTime = parseFloat(dollarThis.data("wow-delay"));
            if (delayTime) {
                delayTime = delayTime * 1000;
            }

            if (dollarThis.is(':in-viewport')) {
                setTimeout(function () {
                    jThis.play();
                    dollarThis.addClass('playing');
                }, delayTime);
            } else {
                jThis.currentTime = 0;
                jThis.pause();
                dollarThis.removeClass('playing');
            }
        });
    }
};