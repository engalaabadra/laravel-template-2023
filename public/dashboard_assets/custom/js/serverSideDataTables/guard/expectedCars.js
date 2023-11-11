var guardCarsServerSideDataTable = $('#guard_expected_cars_table_data').DataTable({
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
        url: `${HOST_URL}/${LANG}/dashboard/carActivity-table`,
        type: "GET",
        data: function (d) {
            d.type = type;
            d.driver_type = driver_type;
        }
    },
    columns: [
        {data: 'reqId',render: function (data,data2,row) {

                return row.id;
            }
        },
        {data: 'name',render: function (data,data2,row) {
                return row.driver.id;
            }
        },
        {data: 'name',render: function (data,data2,row) {
                return row.driver.contact_person_name;
            }
        },
        {data: 'plate_ar',render: function (data,data2,row) {
                return row.car.plate_ar;
            }
        },
        {data: 'plate_en',render: function (data,data2,row) {
                return row.car.plate_en;
            }
        },
        {data: 'type',render: function (data,data2,row) {
                if(row.type == 'admin'){
                    return `<span class="badge badge-success">
                        ${langs[LANG].employee}
                    </span>`
                }else{
                    return `<span class="badge badge-danger">
                        ${langs[LANG].visitor}
                    </span>`
                }
            }
        },
        {data: 'host',render: function (data,data2,row) {
                return row.host.full_name;
            }
        },
        {data: 'id',render: function (data,data2,row) {
                let qrUrl = `${HOST_URL}/${LANG}/dashboard/request/car/:id/qrcode/:secret`;
                qrUrl = qrUrl.replace(':id', data);
                qrUrl = qrUrl.replace(':secret', row.secret_code);
                return `  <td class="text-center" id="close_button${data}">
                    <a class="pointer mr-2 status-button btn btn-outline-success tasksModalActive" data-id="${data}"
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
        {data: 'id',render: function (data) {
                return `<td class="text-center" id="FastAction${data}">
                    <a class="pointer mr-2 status-button btn btn-outline-success fastModalActive" data-id="${data}"
                       title="${langs[LANG].fastAction}">${langs[LANG].fastAction}
                    </a>
                </td>`
            }
        },
    ]
});
