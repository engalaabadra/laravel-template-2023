
var carsServerSideDataTable = $('#car_activity_table_data').DataTable({
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
                return row.driver.contact_person_name;
            }
        },
        {data: 'car',render: function (data,data2,row) {
                return row.car.type??'---';
            }
        },
        {data: 'startDate',render: function (data,data2,row) {
                const date = new Date(row.delivery_from_date);
                const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                return formattedDate;
            }
        },
        {data: 'endDate', render: function (data, data2, row) {
                const date = new Date(row.delivery_to_date);
                const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                return formattedDate;
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
    ]
});

