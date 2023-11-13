// Delete item.
var delete_route;
var item_id;
var request_table;
var reload = false;
var serverSideDataTable;

$(document).on("click", ".delete-button", function () {
    delete_route = $(this).data("url");
    item_id = $(this).data("item-id");
    request_table = $(this).data("request-table");
    reload = $(this).data("reload");
});

$(document).on("click", "#delete-button", function () {

    var that = $(this);
    that.prop('disabled', true)
        .addClass('spinner spinner-white spinner-right')
        .text(langs[LANG].please_wait);

    $.ajax({
        url: delete_route,
        type: "POST",
        data: {
            _method: "delete",
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            $("#delete_modal").modal("toggle");
            $(`#row-${item_id}`).remove();

            that.removeClass('spinner spinner-white spinner-right')
                .prop('disabled', false)
                .text(langs[LANG].delete);

            toastr.success(response.message);

            if(serverSideDataTable != undefined && serverSideDataTable != ''){
                serverSideDataTable.ajax.reload();
            }


            if(reload == true){
                window.location.reload();
            }
        },
        error(data) {
            $("#delete_modal").modal("toggle");
            toastr.error(data.responseJSON.message);

            that.removeClass('spinner spinner-white spinner-right')
                .prop('disabled', false)
                .text(langs[LANG].delete);
        },
    });
});
