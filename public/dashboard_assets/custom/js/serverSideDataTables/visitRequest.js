var DataTablesColumns = [
    {
        data: 'id', render: function (data) {
            return data
        }
    },
    {
        data: 'requester', render: function (data) {
            return data.full_name
        }
    },
    {
        data: 'created_at', render: function (data, data2, row) {
            let date = new Date(data);
            const formattedDate = date.toLocaleDateString(LANG, {year: 'numeric', month: 'long', day: 'numeric'});
            return formattedDate;
        }
    },
    {
        data: 'visitors', render: function (data) {
            let content = ``;
            data.forEach((visitor, index) => {
                content += `<span>${visitor.full_name} </span>`
                if (index != data.length - 1) {
                    content += `<strong> , </strong>`
                }
            });
            return content;
        }
    },
    {
        data: 'host', render: function (data) {
            return data.full_name;
        }
    },
    {
        data: 'from_date', render: function (data, data2, row) {
            let date = new Date(data);
            const formattedDate = date.toLocaleDateString(LANG, {year: 'numeric', month: 'long', day: 'numeric'});
            return formattedDate;
        }
    },
    {
        data: 'to_date', render: function (data, data2, row) {
            let date = new Date(data);
            const formattedDate = date.toLocaleDateString(LANG, {year: 'numeric', month: 'long', day: 'numeric'});
            return formattedDate;
        }
    },
    {
        data: 'status', render: function (data, data2, row) {
            content = ` <td id="status${row.id}">`
            if (data == 'active') {
                content += `  <span class="badge badge-success">${langs[LANG].active_visit}</span>`
            } else if (data == 'expired') {
                content += `<span class="badge badge-warning" style="color: white">${langs[LANG].expired}</span>`
            } else if (data == 'canceled') {
                content += `<span class="badge badge-danger">${langs[LANG].canceled}</span>`
            } else {
                content += `<span class="badge badge-primary">
                            ${data ? langs[LANG][data] : langs[LANG].in_progress}
                        </span>`
            }
            content += `</td>`
            return content
        }
    },
    {
        data: 'id', render: function (data, data2, row) {
            let url = `${HOST_URL}/${LANG}/dashboard/visits/${data}/status`;
            let delete_url = `${HOST_URL}/${LANG}/dashboard/visits/${data}/delete`;
            let type = 'visitors'
            const [visitor_request_first] = row.visitor_request;
            let date = new Date();
            let formattedDate = date.toISOString().split('T')[0];

            content = `<td>
                    <div class="text-center d-flex">`

            if (read_visit_request) {
                content += ` <a type="button" id="showVisit" title="${langs[LANG].show}"
                            data-id="${visitor_request_first.id}"
                            class="btn btn-outline-success btn-sm ml-2">
                            <i class="far fa-eye p-0"></i>
                        </a>`
            }

            if (row.status == 'active' && formattedDate <= row.to_date) {

                content += `<div id="close_button${data}" style="line-height: 33px">
                                <a class="pointer status-button status-modal btn btn-sm btn-outline-danger ml-2"
                               data-url="${url}"
                               title="${langs[LANG].cancel}"
                               data-status="canceled" data-visit_id="${data}">
                                <i class="flaticon-cancel p-0"></i>
                            </a></div>`
            }

            if (parseInt(root)) {
                content += ` <a type="button" id="deleteVisit"
                            data-target="#delete_with_modal"
                            data-url="${delete_url}"
                            title="${langs[LANG].delete}"
                            data-type="${type}"
                            data-item-id="${data}"
                            data-toggle="modal"
                            class="delete-action btn btn-outline-danger btn-sm ml-2 ">
                              <i class="flaticon-delete p-0"></i>
                        </a>`
            }

            content += `</div></td>`
            return content;
        }
    },
]

if (is_root) {
    DataTablesColumns.splice(7, 0, {
            data: 'visitors', render: function (data, data2, row) {

                content = ` <td id="status${row.id}">`

                if (data.length != 0) {
                    if (data[0].type == 'visitor') {
                        content += `  <span class="badge badge-success">${langs[LANG].visitRequest}</span>`
                    } else {
                        content += `<span class="badge" style="color: #ffffff ; background-color: #007bff">
                            ${langs[LANG].contractRequest}
                        </span>`
                    }
                }

                content += `</td>`
                return content
            }
        },
    );
}

var serverSideDataTable = $('#visit_request_table_data').DataTable({
    language: {
        url: locale,
        search: langs[LANG].search,
        searchPlaceholder: langs[LANG].search_by_visitor_name_id_number,
    },
    "searching": true,
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    "ordering": false,
    ajax: {
        url: `${HOST_URL}/${LANG}/dashboard/visit-request-table`,
        type: "GET",
        data: function (d) {
            d.request_status = request_status;
            d.visitType = visitType;
        }
    },
    rowId: 'id',
    columns: DataTablesColumns,
    rowCallback: function (row, data) {
        $(row).attr('id', `row-${data.id}`);
    },
});
