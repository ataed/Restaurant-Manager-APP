$(function () {
    $("#date-start").datetimepicker({
        format: "L",
    });
    $("#date-end").datetimepicker({
        format: "L",
        useCurrent: false,
    });
    $("#date-start").on("change.datetimepicker", function (e) {
        $("#date-end").datetimepicker("minDate", e.date);
    });
    $("#date-end").on("change.datetimepicker", function (e) {
        $("#date-start").datetimepicker("maxDate", e.date);
    });
});
