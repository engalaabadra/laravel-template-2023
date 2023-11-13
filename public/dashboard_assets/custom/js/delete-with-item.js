// Delete item.
var delete_route;
var item_id;
var type;
var data_type;
var request_table;
var reload = false;
var serverSideDataTable;

$(document).on("click", ".delete-action", function () {
    delete_route = $(this).data("url");
    type = $(this).data("type");
    item_id = $(this).data("item-id");
    request_table = $(this).data("request-table");
    reload = $(this).data("reload");
});

$(document).on("click", ".delete-with", function () {
    data_type = type;
});

$(document).on("click", ".delete-request", function () {

    var that = $(this);
    that.prop('disabled', true)
        .addClass('spinner spinner-white spinner-right')
        .siblings().prop('disabled', true);

    $.ajax({
        url: delete_route,
        type: "POST",
        data: {
            _method: "delete",
            _token: $('meta[name="csrf-token"]').attr("content"),
            type: data_type,
        },
        success: function (response) {
            $("#delete_with_modal").modal("toggle");
            $(`#row-${item_id}`).remove();

            that.removeClass('spinner spinner-white spinner-right')
                .prop('disabled', false)
                .siblings().prop('disabled', false);

            toastr.success(response.message);

            if(serverSideDataTable != undefined && serverSideDataTable != ''){
                serverSideDataTable.ajax.reload();
            }

            if(reload == true){
                window.location.reload();
            }
        },
        error(data) {
            $("#delete_with_modal").modal("toggle");
            toastr.error(data.responseJSON.message);

            that.removeClass('spinner spinner-white spinner-right')
                .prop('disabled', false).siblings()
                .prop('disabled', false);
        },
    });
});
