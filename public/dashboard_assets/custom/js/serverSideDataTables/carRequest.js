var serverSideDataTable = $('#car_request_table_data').DataTable({
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
        url: `${HOST_URL}/${LANG}/dashboard/car-request-table`,
        type: "GET",
        data: function (d) {
            d.request_status = request_status;
            d.driver_type = driver_type;
        }
    },
    rowId: 'id',
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
                    return `<span class="badge" style="background-color: #007bff; color: white">
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
        {
            data: 'status', render: function (data, data2, row) {
                let content = '';
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
                return content;
            }
        },
        {
            data: 'id', render: function (data, data2, row) {
                let chars = [];
                let numbers = [];

                let arr = row.parking_number ? row.parking_number.split("") : [];

                arr.forEach(function (element, index) {
                    if (!isNaN(element)) {
                        numbers += element;
                    } else {
                        chars += element;
                    }
                });

                let content = '';
                if (row.type == 'admin') {
                    content += `<div class="flex  rowWarpper">
                             <div class="input-group mb-3 zindex-2 parking_number row">
                              <div class="col-4 p-1">
                                    <input class="digit form-control" data-info="2" name="parking_num"
                                       value="${numbers}" maxlength="3" minlength="1" type="text"
                                       placeholder="${langs[LANG].numbers}"
                                       onkeyup="javascript:this.value = this.value.replace(/[a-zA-Z*&^%$#@!+_-]/g, '');">
                                </div>
                                 <div class="col-5 p-1 digit">
                                   <select class="nice-select alphabetSelect" name="parking_char">
                                       <option value="${chars}" selected>${(chars !== '' && chars.length !== 0) ? chars.toUpperCase() : chars}</option>
                                   </select>
                                 </div>
                                 <div class="col-3 p-1" >
                                    <a id="edit_parking_number" data-id="${data}"
                                    class="btn btn-outline-success btn-sm ml-2"
                                    style="margin-top: 3px"
                                    title="Update">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                             </div>
                        </div>`
                } else {
                    content += `<input type="text" class="form-control " disabled
                           value="${langs[LANG].visitors_park}"/>`
                }
                return content;
            }
        },
        {
            data: 'id', render: function (data, data2, row)
            {
                let content = '';
                let url = `${HOST_URL}/${LANG}/dashboard/cars/${data}/status`;
                let delete_url = `${HOST_URL}/${LANG}/dashboard/cars/${data}/delete`;
                let type = 'cars';
                let status_list =['in_progress','approved'];

                let date = new Date();
                let formattedDate = date.toISOString().split('T')[0];

                content = `<td>
                    <div class="text-center d-flex">`

                if (read_car_request) {
                    content += `<a type="button" id="showCar" data-id="${data}"
                        title="${langs[LANG].show}"
                        class="btn btn-outline-success btn-sm ml-2">
                        <i class="far fa-eye p-0"></i>

                    </a>`
                }

                if (formattedDate <= row.delivery_to_date){
                    if (row.status == 'in_progress' || (parseInt(root) && status_list.includes(row.status))){
                        content +=`<div id="close_button${data}" style="line-height: 33px">
                                <a class="pointer status-button status-modal btn btn-sm btn-outline-danger ml-2"
                               data-url="${url}"
                               title="${langs[LANG].cancel}"
                               data-status="canceled" data-car_id="${data}">
                                <i class="flaticon-cancel p-0"></i>

                            </a></div>`
                    }
                }

                if (parseInt(root)) {
                    content += ` <a type="button" id="deleteRequest"
                            data-target="#delete_with_modal"
                            title="${langs[LANG].delete}"
                            data-url="${delete_url}"
                            data-type="${type}"
                            data-item-id="${data}"
                            data-toggle="modal"
                            class="delete-action btn btn-outline-danger btn-sm ml-2 ">
                             <i class="flaticon-delete p-0"></i>
                        </a>`
                }
                return content;
            }
        },
    ],
    rowCallback: function (row, data) {
        $(row).attr('id', `row-${data.id}`);
    },
});
