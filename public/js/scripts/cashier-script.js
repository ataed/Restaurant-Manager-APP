$(document).ready(function () {
    //table detail will be hidden by default
    $("#table-detail").hide();

    //Show All tables when user click the button
    $("#btn-show-tables").click(function () {
        if ($("#table-detail").is(":hidden")) {
            $.get("/cashier/getTables", function (data) {
                $("#table-detail").html(data);
                $("#table-detail").slideDown("fast");
                $("#btn-show-tables")
                    .html("Hide Tables")
                    .removeClass("btn-primary")
                    .addClass("btn-danger");
            });
        } else {
            $("#table-detail").slideUp("fast");
            $("#btn-show-tables")
                .html("View All Tables")
                .removeClass("btn-danger")
                .addClass("btn-primary");
        }
    });

    //Load menus by category
    $(".nav-link").click(function () {
        $.get("/cashier/getMenuByCategory/" + $(this).data("id"), function (
            data
        ) {
            $("#list-menu").hide();
            $("#list-menu").html(data);
            $("#list-menu").fadeIn("fast");
        });
    });
    let SELECTED_TABLE_ID = "";
    let SELECTED_TABLE_NAME = "";
    let SALE_ID = "";
    // detect button table onclick to show table data
    $("#table-detail").on("click", ".btn-table", function () {
        SELECTED_TABLE_ID = $(this).data("id");
        SELECTED_TABLE_NAME = $(this).data("name");
        $("#selected-table").html(
            "<br><h3>Table: " + SELECTED_TABLE_NAME + "</h3><hr>"
        );
        $.get("/cashier/getSaleDetailByTable/" + SELECTED_TABLE_ID, function (
            data
        ) {
            $("#order-detail").html(data);
        });
    });

    $("#list-menu").on("click", ".btn-menu", function () {
        if (SELECTED_TABLE_ID == "") {
            alert("You need to select a table for the customer first");
        } else {
            let menu_id = $(this).data("id");
            $.ajax({
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    menu_id: menu_id,
                    table_id: SELECTED_TABLE_ID,
                    table_name: SELECTED_TABLE_NAME,
                    quantity: 1,
                },
                url: "/cashier/orderFood",
                success: function (data) {
                    $("#order-detail").html(data);
                },
            });
        }
    });

    //Confirm Order
    $("#order-detail").on("click", ".btn-confirm-order", function () {
        let saleID = $(this).data("id");
        $.ajax({
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                sale_id: saleID,
            },
            url: "/cashier/confirmOrderStatus",
            success: function (data) {
                $("#order-detail").html(data);
            },
        });
    });

    //Delete SaleDetail
    $("#order-detail").on("click", ".btn-delete-saledetail", function () {
        let saleDetailID = $(this).data("id");
        $.ajax({
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                saleDetail_id: saleDetailID,
            },
            url: "/cashier/deleteSaleDetail",
            success: function (data) {
                $("#order-detail").html(data);
            },
        });
    });
});
