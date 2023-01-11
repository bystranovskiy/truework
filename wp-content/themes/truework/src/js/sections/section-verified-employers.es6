import "../../scss/sections/section-verified-employers.scss";

"use strict";

(function ($) {

    $(document).ready(function () {
        $(".verified-employers-list").slick({
            arrows: true,
            dots: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            mobileFirst: true,
            responsive: [
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1260,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 1600,
                    settings: {
                        slidesToShow: 5,
                    }
                },
            ]
        });
    })

})(jQuery);