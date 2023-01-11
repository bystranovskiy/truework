import "../../scss/partials/jobs-filter-form.scss";

"use strict";

(function ($) {

    $(document).ready(function () {

        const $salary_slider = $(".jobs-filter-form #salary");
        const $salary_from = $("#salary_from");
        const $salary_to = $("#salary_to");
        const values = [parseInt($salary_from.val()), parseInt($salary_to.val())]

        $salary_slider.slider({
            range: true,
            min: parseInt($salary_slider.data("min")),
            max: parseInt($salary_slider.data("max")),
            step: 10,
            values,
            slide: function (event, ui) {
                values[0] = [ui.values[0]];
                values[1] = [ui.values[1]];
                $salary_from.val(values[0]).attr("max", values[1]);
                $salary_to.val(values[1]).attr("min", values[0]);
            }
        });
        $salary_from.on("change", function () {
            values[0] = this.value;
            $salary_to.attr("min", values[0]);
            $salary_slider.slider("values", values);
        })
        $salary_to.on("change", function () {
            values[1] = this.value;
            $salary_from.attr("max", values[1]);
            $salary_slider.slider("values", values);
        })

        $("#employment_type").on("change", "input", function (e) {
            if (e.target.checked) {
                $(e.delegateTarget).find("input:checked").not(e.target).prop("checked", false);
            }
        })

        $(".jobs-filter-form").on("reset", function () {
            window.location.replace(location.protocol + "//" + location.host + location.pathname);
        })

    })

})(jQuery);