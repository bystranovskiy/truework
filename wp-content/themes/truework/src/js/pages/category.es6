import "../../scss/pages/category.scss";

"use strict";

(function ($) {

    $(document).ready(function () {


        hotJobsSliderInit();

        window.matchMedia("(max-width: 1259px)").addEventListener("change", event => {
            if (event.matches) {
                hotJobsSliderInit();
            }
        })

        function hotJobsSliderInit() {
            $(".jobs-sidebar").slick({
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
                        breakpoint: 1260,
                        settings: "unslick"
                    },
                ]
            });
        }

    })

})(jQuery);