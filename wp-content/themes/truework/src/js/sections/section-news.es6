import "../../scss/sections/section-news.scss";

"use strict";

(function ($) {

    $(document).ready(function () {
        $(".news-list").slick({
            arrows: true,
            dots: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            mobileFirst: true,
            responsive: [
                {
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 1260,
                    settings: {
                        slidesToShow: 3,
                    }
                },
            ]
        });
    })

})(jQuery);