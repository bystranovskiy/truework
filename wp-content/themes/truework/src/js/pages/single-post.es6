import "../../scss/pages/single-post.scss";

"use strict";

(function ($) {

    $(document).ready(function () {


        $(".jobs-slider").slick({
            arrows: true,
            dots: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            mobileFirst: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 1600,
                    settings: {
                        slidesToShow: 3,
                    }
                },
            ]
        });

        latestNewsliderInit();

        window.matchMedia("(max-width: 1259px)").addEventListener("change", event => {
            if (event.matches) {
                latestNewsliderInit();
            }
        })

        function latestNewsliderInit() {
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
                        settings: "unslick"
                    },
                ]
            });
        }

    })

})(jQuery);