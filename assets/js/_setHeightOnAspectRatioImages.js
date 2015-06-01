function defer(method) {
    if (window.jQuery) {
        method();
    }
    else {
        setTimeout(function () {
            defer(method)
        }, 50);
    }
}

function debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
}

var setRespImgOffset = function () {
    $('.du-resp-img-ratio-wrapper').each(function (index, elem) {
        $wrapper = $(elem);
        if ($wrapper.hasClass('has-ratio')) {
            wrapperHeight = parseInt($wrapper.css('padding-top'), 10);
            $img = $wrapper.find('.du-resp-img').first();
            imgHeight = $img.height();

            if (imgHeight > wrapperHeight) {
                offset = (wrapperHeight - imgHeight) / 2;
            }
            else {
                offset = (imgHeight - wrapperHeight ) / 2;
            }

            $img.css({'top': offset});
        }
    });
};

initResponsiveImages = function () {
    setRespImgOffset();

    document.addEventListener('lazybeforeunveil', function (e) {
        setRespImgOffset();
    });

    window.addEventListener('resize', debounce(setRespImgOffset, 50));
};

defer(initResponsiveImages);
