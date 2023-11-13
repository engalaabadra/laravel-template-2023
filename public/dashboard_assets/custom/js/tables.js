var dataTable = $('#visitor_table_data').DataTable({
    language: {
        url: locale,
        search: langs[LANG].search,
        searchPlaceholder: langs[LANG].search_placeholder,
    },
    "searching": false,
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    ajax: {
        url: `${HOST_URL}/${LANG}/dashboard/car-table/${siteID}/${gateID}?redirect_id=${redirect_id}`,
        type: "GET",
        data: function (d) {
            d.start_date = start_date;
            d.end_date = end_date;
            d.plate_en = plate_en_search;
            d.camera = $('#camera-select :selected').val()
            d.status = $('#status-select :selected').val()
            d.gate_id = $('#gates-select :selected').val()
            d.type = $('#type_select :selected').val()
            d.invitation_status = $('#invitation_status :selected').val()
            d.detection_status = $('#detection_status :selected').val()
        }
    },
    columns: [
        {
            data: 'date', render: function (data, data2, row, type) {
                let locale = LANG === "ar" ? "ar-EG" : "en-GB"

                return new Date(row.created_at).toLocaleDateString(locale, {
                    day: "numeric",
                    month: "long",
                    year: "numeric"
                });
            }
        },
        {
            data: 'time', render: function (data, data2, row, type) {
                let locale = LANG === "ar" ? "ar-EG" : "en-GB"

                return new Date(row.created_at).toLocaleTimeString(locale, {
                    hour: "2-digit",
                    minute: "2-digit"
                });
            }
        },
        {
            data: 'plate_en', class: LANG == 'ar' ? 'direction_rtl' : '', render: function (data, data2, row) {
                return data;
            },

        },
        {data: 'plate_ar', name: 'plate_ar'},
        {
            data: 'type', render: function (data, data2, row) {
                return (row.type != null) ? (langs[LANG][row.type] ?? '---') : '---';
            }
        },
        {
            data: 'notice_time', class: "status-td", render: function (data, data2, row, type) {
                if (row.notice_time != null) {
                    return `<span class="badge badge-success">${langs[LANG].noticed}</span>`
                } else {
                    return `<span class="badge badge-danger">${langs[LANG].not_noticed}</span>`
                }
            }
        },
        {
            data: 'status', class: "invitation_status-td", render: function (data, data2, row, type) {
                if (row.status) {
                    if(row.car_request?.type == 'admin'){
                        return `<span class="badge badge-success">${langs[LANG].has_employee_invitation}</span>`
                    }else{
                        return `<span class="badge badge-success">${langs[LANG].has_visitor_invitation}</span>`
                    }
                } else {
                    return `<span class="badge badge-danger">${langs[LANG].no_invitation}</span>`
                }
            }
        },
        {
            data: 'detection_status', class: "detection_status-td", render: function (data, data2, type, row) {
                if (data == 'pending') {
                    return `<span class="badge badge-warning" style="color:white">${langs[LANG].pending}</span>`
                } else if (data == 'success') {
                    return `<span class="badge badge-success">${langs[LANG].success}</span>`
                } else if (data == 'error') {
                    return `<span class="badge badge-danger">${langs[LANG].error}</span>`
                }
            }
        },
        {data: 'camID', name: 'camID'},
        {
            data: 'id', render: function (data, data2, row, type) {
                if (row.notice_time != null) {
                    let result = `<button class="ml-1 mt-1 btn btn-sm btn-primary" disabled >${langs[LANG].update_detection}</button>`;
                    if (row.status) {
                        result += `<button data-carRequestId="${row.car_request_id}" class="ml-1 mt-1 btn btn-sm btn-success view_invitaion">${langs[LANG].view_invitaion}</button>`;
                    }
                    return result;
                } else {
                    let result = `<button data-id='${data}' data-status="${row.status}" href="javascript:void(0);" class="ml-1 mt-1 btn btn-sm btn-primary action_cars">${langs[LANG].update_detection}</button>`;
                    if (row.status) {
                        result += `<button data-carRequestId="${row.car_request_id}"  class="ml-1 mt-1 btn btn-sm btn-success view_invitaion">${langs[LANG].view_invitaion}</button>`;
                    }
                    return result;
                }
            }
        }
    ]
});


$('#camera-select').on("change", function (e) {
    dataTable.ajax.reload();
});
$('#status-select').on("change", function (e) {
    dataTable.ajax.reload();
});
$('#gates-select').on("change", function (e) {
    dataTable.ajax.reload();
});
$('#invitation_status').on("change", function (e) {
    dataTable.ajax.reload();
});
$('#detection_status').on("change", function (e) {
    dataTable.ajax.reload();
});

