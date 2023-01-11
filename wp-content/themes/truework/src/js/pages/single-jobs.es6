import "../../scss/pages/single-jobs.scss";

"use strict";

(function ($) {

    $(document).ready(function () {

        const $popup = $(".popup-form");
        const $wpcf7 = $popup.find(".wpcf7-form");
        const $popup_content = $popup.find(".popup-content");
        const $popup_thank = $popup.find(".thank-you-message");

        $(".job-respond").on("click", function () {
            setTimeout(function () {
                $("body").addClass("popup-open");
                $popup.fadeIn();
            }, 1);
        })

        $("html").on("click", ".popup-form .close-popup, .popup-open #page", function () {
            $("body").removeClass("popup-open");
            $popup.fadeOut();
            if ($wpcf7.hasClass("sent")) {
                $popup_thank.fadeOut();
                setTimeout(function () {
                    $popup_content.fadeIn();
                }, 500);
            }
        })

        document.addEventListener("wpcf7mailsent", function (event) {
            if (event.detail.contactFormId === 5) {
                $popup_content.hide();
                $popup_thank.fadeIn();
            }
        }, false);


        hotJobsSliderInit();

        window.matchMedia("(max-width: 1259px)").addEventListener("change", event => {
            if (event.matches) {
                hotJobsSliderInit();
            }
        })

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