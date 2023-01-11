"use strict";

(function ($) {

    $(window).on("load", function (e) {

        $("body").addClass("loaded");
        $(".preloader").fadeOut("500");

    });

    $(document).ready(function () {
        $(".main-header .menu a").each(function () {
            $(this).attr("data-text", $(this).text());
        });

        $("html").on("click", ".slideout-menu .close, .slideout-open #page", function () {
            $("body").removeClass("slideout-open");
        })
        $(".menu-toggle").on("click", function () {
            setTimeout(function () {
                $("body").addClass("slideout-open");
            }, 1);
        })
    });


})(jQuery);