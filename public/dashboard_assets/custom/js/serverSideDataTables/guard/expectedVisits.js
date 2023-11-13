var GuardDataTablesColumns = [
    {
        data: 'reqId', render: function (data, data2, row) {

            return row.id;
        }
    },
    {
        data: 'name', render: function (data, data2, row) {
            return row.visitor.full_name;
        }
    },
    {
        data: 'company', render: function (data, data2, row) {
            return row.visitor.company.name;
        }
    },
    {
        data: 'startDate', render: function (data, data2, row) {
            const date = new Date(row.visit_request.from_date);
            const formattedDate = date.toLocaleDateString(LANG, {year: 'numeric', month: 'long', day: 'numeric'});
            return formattedDate;
        }
    },

    {
        data: 'endDate', render: function (data, data2, row) {
            const date = new Date(row.visit_request.to_date);
            const formattedDate = date.toLocaleDateString(LANG, {year: 'numeric', month: 'long', day: 'numeric'});
            return formattedDate;
        }
    },
    {
        data: 'type', render: function (data, data2, row) {
            return row.visit_request.visit_type.name;
        }
    },
    {
        data: 'host', render: function (data, data2, row) {
            return row.visit_request.host.full_name;
        }
    },
    {
        data: 'id', render: function (data, data2, row) {
            let qrUrl = `${HOST_URL}/${LANG}/dashboard/request/:type/:id/qrcode/:secret`;
            qrUrl = qrUrl.replace(':id', data);
            qrUrl = qrUrl.replace(':type', visitorType);
            qrUrl = qrUrl.replace(':secret', row.secret_code);

            return ` <td class="text-center" id="close_button${data}">
                    <a class="pointer mr-2 status-button btn btn-outline-success tasksModalActive"
                       data-id="${data}"
                       title="${langs[LANG].action}">${langs[LANG].action}
                    </a>
                    <a class="pointer mr-2 col-4 status-button btn btn-outline-success"
                       data-id="${data}"
                       href="${qrUrl}" target="_blank">
                        <i class="fa fa-qrcode"></i>
                    </a>
                </td>`
        }
    },
    {
        data: 'id', render: function (data) {
            return `  <td class="text-center" id="fastaction${data}">
                    <a class="pointer mr-2 status-button btn btn-outline-success visitorFastAction"
                       data-id="${data}"
                       title="${langs[LANG].fastAction}">${langs[LANG].fastAction}
                    </a>
                </td>`
        }
    },
]

if (visitorType != 'contractor') {
    GuardDataTablesColumns.splice(7, 0, {
        data: 'transportWay', render: function (data, data2, row) {
            if (row.transport_way == "myCar") {
                content = `<span class="badge badge-primary">
                            ${langs[LANG].myCar}#(${row.car_request_id})
                        </span>`
            } else {
                content = `<span class="badge badge-success">
                              ${langs[LANG].Get_off_at_the_gate_and_enter_on_foot}
                        </span>`
            }
            return content;
        }
    });
}

var guardVisitsServerSideDataTable = $('#guard_expected_visits_table_data').DataTable({
    language: {
        url: locale,
        search: langs[LANG].search,
        searchPlaceholder: langs[LANG].search_by_name_or_request_id,
    },
    "searching": true,
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    "ordering": false,
    ajax: {
        url: `${HOST_URL}/${LANG}/dashboard/visitActivity-table`,
        type: "GET",
        data: function (d) {
            d.visitorType = visitorType;
            d.type = type;
        }
    },
    columns: GuardDataTablesColumns
});
