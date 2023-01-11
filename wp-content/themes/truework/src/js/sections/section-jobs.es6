import "../../scss/sections/section-jobs.scss";

"use strict";

(function ($) {

    $(document).ready(function () {

        if ($(window).width() > 1260) {
            equalJobsHeader()
        }

        $(".jobs-list .nav-links .page-numbers").removeAttr("href");

        let paged = 1;
        let meta = "new-jobs";

        $(".jobs-list").on("click", ".nav-links a.page-numbers", function (e) {
            e.preventDefault();
            if (!$(e.target).hasClass("next") && !$(e.target).hasClass("prev")) {
                paged = parseInt($(e.target).text());
            }
            if ($(e.target).hasClass("next")) {
                paged++;
            }
            if ($(e.target).hasClass("prev")) {
                paged--;
            }
            jobs_pagination(paged, meta);
        })

        $(".jobs-nav-item").on("click", function (e) {
            if (!$(this).hasClass("active")) {
                e.preventDefault();
                $(".jobs-nav-item").removeClass("active");
                $(this).addClass("active");
                meta = $(this).data("meta");
                jobs_pagination(1, meta);
            }

        })
    })

    window.matchMedia("(min-width: 1260px)").addEventListener("change", event => {
        equalJobsHeader()
    })
    window.matchMedia("(min-width: 1600px)").addEventListener("change", event => {
        equalJobsHeader()
    })

    function equalJobsHeader() {
        $(".jobs-list .jobs-list-item-wrapper:nth-child(odd)").each(function () {
            const $thisHeader = $(this).find(".job-header");
            const $neighborHeader = $(this).next(".jobs-list-item-wrapper").find(".job-header");

            $thisHeader.removeAttr("style");
            $neighborHeader.removeAttr("style");

            let jobHeaderHeight = $thisHeader.innerHeight();
            if ($neighborHeader.innerHeight() > jobHeaderHeight) {
                jobHeaderHeight = $neighborHeader.innerHeight();
            }

            if ($(window).width() >= 1260) {
                $thisHeader.height(jobHeaderHeight.toFixed(0) + "px");
                $neighborHeader.height(jobHeaderHeight.toFixed(0) + "px");
            }
        })
    }

    function jobs_pagination(paged, meta) {
        $(".jobs-list").addClass("loading");
        $("html, body").animate({scrollTop: $(".section-jobs").offset().top - $("header").height()}, 500);
        const ajaxurl = ajaxMeta.ajaxurl;
        $.ajax({
            url: ajaxurl,
            type: "post",
            data: {
                action: "jobs_pagination",
                "paged": paged,
                "meta": meta
            },
            success: function (data) {
                const $data = $(data);
                if ($data.length) {
                    $data.css("display", "none");
                    $(".jobs-list").removeClass("loading").empty().append($data.fadeIn());
                    equalJobsHeader();
                    $(".jobs-list .nav-links .page-numbers").removeAttr("href");

                } else {
                    console.log("error");
                }
            }
        });
        return false;
    }

})(jQuery);