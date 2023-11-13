var serverSideDataTable = $('#car_request_permission_table_data').DataTable({
    language: {
        url: locale,
        search: langs[LANG].search,
        searchPlaceholder: langs[LANG].search_by_driver_name_or_request_id,
    },
    "searching": true,
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    "ordering": false,
    ajax: {
        url: `${HOST_URL}/${LANG}/dashboard/car-request-permission-table`,
        type: "GET",
        data: function (d) {
            d.type = type;
            d.request_status = request_status;
            d.driver_type = driver_type;
        }
    },
    columns: [
        {
            data: 'reqId', render: function (data, data2, row) {
                return row.id;
            }
        },
        {
            data: 'name', render: function (data, data2, row) {
                return row.requester.full_name;
            }
        },
        {
            data: 'type', render: function (data, data2, row) {
                if (row.type == 'admin') {
                    return `<span class="badge badge-success">
                        ${langs[LANG].employee}
                    </span>`
                } else {
                    return `<span class="badge badge-danger">
                        ${langs[LANG].visitor}
                    </span>`
                }
            }
        },
        {
            data: 'startDate', render: function (data, data2, row) {
                const date = new Date(row.delivery_from_date);
                const formattedDate = date.toLocaleDateString(LANG, {year: 'numeric', month: 'long', day: 'numeric'});
                return formattedDate;
            }
        },
        {
            data: 'endDate', render: function (data, data2, row) {
                const date = new Date(row.delivery_to_date);
                const formattedDate = date.toLocaleDateString(LANG, {year: 'numeric', month: 'long', day: 'numeric'});
                return formattedDate;
            }
        },
        {
            data: 'name', render: function (data, data2, row) {
                return row.driver.contact_person_name;
            }
        },
        {
            data: 'cars', render: function (data, data2, row) {
                let content = `<ul class="mb-0" style="list-style: none; padding: 0">`;
                data.forEach(car => {
                    content += `<li style="direction: ltr">${car.plate_en}</li>`;
                });
                content += '</ul>';

                return content;
            }
        },
        {
            data: 'cars', render: function (data, data2, row) {
                let content = `<ul class="mb-0" style="list-style: none; padding: 0;">`;
                data.forEach(car => {
                    content += `<li>${car.plate_ar}</li>`;
                });
                content += '</ul>';

                return content;
            }
        },
        {data: 'site',render: function (data) {
                return data.name;
            }
        },
        {
            data: 'status', render: function (data, data2, row) {
                content = `<td id="status${row.id}">`
                if (row.status == 'approved') {
                    if (date > row.delivery_to_date) {
                        content += ` <span class="badge badge-warning" style="color: white">
                          ${langs[LANG].expired}
                        </span>`
                    } else {
                        content += ` <span class="badge badge-success" style="color: white">
                            ${langs[LANG][data]}
                        </span>`
                    }
                } else if (row.status == 'rejected' || row.status == 'canceled') {
                    content += ` <span class="badge badge-danger" style="color: white">
                          ${langs[LANG][data]}
                        </span>`
                } else {
                    if (date > row.delivery_to_date) {
                        content += ` <span class="badge badge-warning" style="color: white">
                          ${langs[LANG].expired}
                        </span>`
                    } else {
                        content += ` <span class="badge badge-primary">
                            ${row.status ? langs[LANG][data] : langs[LANG].in_progress}
                        </span>`
                    }
                }
                content += `</td>`
                return content;
            }
        },

    ]
});
