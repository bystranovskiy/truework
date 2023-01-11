import "../../scss/sections/section-popular-rubrics.scss";

"use strict";

(function ($) {

    $(document).ready(function () {
        rubricsSliderInit()
    })

    window.matchMedia("(max-width: 719px)").addEventListener("change", event => {
        if (event.matches) {
            rubricsSliderInit()
        }
    })


    function rubricsSliderInit() {
        $(".popular-rubrics-list").slick({
            arrows: true,
            dots: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            mobileFirst: true,
            responsive: [
                {
                    breakpoint: 720,
                    settings: "unslick"
                }
            ]
        });
    }

})(jQuery);