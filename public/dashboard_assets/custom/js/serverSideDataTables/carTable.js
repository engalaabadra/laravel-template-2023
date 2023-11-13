$('#car_table_data').on('draw.dt', function (e) {

    $('.activeCar').on('click', function (e) {
        car_id = $(this).data('item-id');
        $("#blockedcar").val(car_id);
        $("#carActive").modal('show');
    });

    $('.blockCar').on('click', function (e) {
        car_id = $(this).data('item-id');
        $("#currentcar").val(car_id);
        $("#carBlacklist").modal('show');
    });

    //blocking
    $('.cancel-meeting').on('click', function (e) {
        e.preventDefault();
        var note = $('#notes').val();

        if (!note) {
            $('.require_note').css('display', 'block');
        } else {
            // $('#cancelling').submit();
            $(this).attr('disabled', true).addClass('spinner spinner-white spinner-right')
                .text(langs[LANG].please_wait);
            var formData = new FormData($('#cancelling')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: `${HOST_URL}/${LANG}/dashboard/car/change-status`,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $("#carBlacklist").modal('hide');
                    serverSideDataTable.ajax.reload();
                    toastr.success(data.message);
                    $('.cancel-meeting').attr('disabled', false).removeClass('spinner spinner-white spinner-right')
                        .text(langs[LANG].block);
                },
                error: function (reject) {
                    toastr.error(reject.message);
                    $('.cancel-meeting').attr('disabled', false).removeClass('spinner spinner-white spinner-right')
                        .text(langs[LANG].block);
                }
            });
        }
    });

    //activate
    $('.activate').on('click', function (e) {
        e.preventDefault();
        // $('#activate').submit();
        $(this).attr('disabled', true).addClass('spinner spinner-white spinner-right')
            .text(langs[LANG].please_wait);
        var formData = new FormData($('#activate')[0]);
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: `${HOST_URL}/${LANG}/dashboard/car/change-status`,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $("#carActive").modal('hide');
                serverSideDataTable.ajax.reload();
                toastr.success(data.message);
                $('.activate').attr('disabled', false).removeClass('spinner spinner-white spinner-right')
                    .text(langs[LANG].block);
            },
            error: function (reject) {
                toastr.error(reject.message);
                $('.activate').attr('disabled', false).removeClass('spinner spinner-white spinner-right')
                    .text(langs[LANG].block);
            }
        });

    });

    // handle search and pagination directions
    $('#car_table_data_length').parent().css('order', 2)
    $('#car_table_data_filter').parent().css('order', 1)

});

var serverSideDataTable = $('#car_table_data').DataTable({
    language: {
        url: locale,
        search: langs[LANG].search,
        searchPlaceholder: langs[LANG].search_by_plate_or_type,
    },
    "searching": true,
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    "ordering": false,
    ajax: {
        url: `${HOST_URL}/${LANG}/dashboard/car-table`,
        type: "GET",
        data: function (d) {
            d.status = carStatus;
        }
    },
    columns: [
        {
            data: 'id', render: function (data) {
                return data
            }
        },
        {
            data: 'plate_ar', render: function (data) {
                return data ?? '---'
            }
        },
        {
            data: 'plate_en',    class: LANG == 'ar' ? 'direction_rtl ' : '', render: function (data) {
                return data ?? '---'
            }
        },
        {
            data: 'model', render: function (data) {
                return data ?? '---'
            }
        },
        {
            data: 'type', render: function (data) {
                return data ?? '---'
            }
        },
        {
            data: 'created_at', render: function (data, data2, row) {
                const date = new Date(data);
                const formattedDate = date.toLocaleDateString(LANG, {year: 'numeric', month: 'long', day: 'numeric'});
                return formattedDate;
            }
        },
        {data: 'car_request_count', name: 'car_request_count'},
        {
            data: 'id', class: 'dt_action_btn_cont', render: function (data, data2, row) {
                let destroyUrl = `${HOST_URL}/${LANG}/dashboard/car/delete/:id`;
                let editUrl = `${HOST_URL}/${LANG}/dashboard/car/edit/:id`;
                editUrl = editUrl.replace(':id', data);
                destroyUrl = destroyUrl.replace(':id', data);
                let content = '';
                if (update_car) {
                    content += `<a href="${editUrl}"
                           class="btn btn-sm btn-success btn-icon btn-icon-md"
                           title="${langs[LANG].edit}">
                            <i class="flaticon-edit-1 edit-icon"></i>
                        </a>`
                }
                if (delete_car) {
                    content += ` <span class="dt_action_btn_cont">
                            <a class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
                               title="${langs[LANG].delete}" data-toggle="modal" data-target="#delete_modal"
                               data-url="${destroyUrl}"
                               data-item-id="${data}">
                            <i class="flaticon2-trash trash-icon" ></i>
                            </a>
                        </span>`
                }

                if (!status) {
                    if (block_car) {
                        content += ` <a
                               data-item-id="${data}"
                               class="btn btn-sm btn-danger blockCar ml-1" style="background-color: #F64E60 !important;"
                               title="${langs[LANG].block}">
                               <i class="la la-user-alt-slash"></i>
                                ${langs[LANG].block}
                            </a>`
                    }
                } else {
                    if (activate_car) {
                        content += `<a
                                data-item-id="${data}"
                                class="btn btn-sm btn-success activeCar ml-1" style="background-color: var(--color1) !important;"
                                title="${langs[LANG].active}">
                                <i class="la la-user-alt"></i>
                                ${langs[LANG].active}
                            </a>`
                    }
                }
                return content
            }
        },
    ]
});
