if(type != 'receive'){
    var guardExpectedMaterialServerSideDataTable = $('#guard_expected_material_table_data').DataTable({
        language: {
            url: locale,
            search: langs[LANG].search,
            searchPlaceholder: langs[LANG].search_by_request_id,
        },
        "searching": true,
        "processing": true,
        "serverSide": true,
        "bPaginate": true,
        "ordering": false,
        ajax: {
            url: `${HOST_URL}/${LANG}/dashboard/expectedMaterialActivity-table`,
            type: "GET",
            data: function (d) {
                d.type = type;
            }
        },
        columns: [
            {data: 'id',render: function (data) {
                    return data;
                }
            },
            {data: 'contact_person',render: function (data) {
                    return data ??'---';
                }
            },
            {data: 'transporter',render: function (data) {
                    return data.contact_person;
                }
            },
            {data: 'company',render: function (data) {
                    return data??'---';
                }
            },
            {data: 'type',render: function (data) {
                    return langs[LANG][data];
                }
            },
            {data: 'host',render: function (data) {
                    return data.full_name;
                }
            },
            {data: 'type', render: function (data, data2, row) {
                    let date;
                    arr1 =['inward_non-returnable','personal_request','inward_returnable'];
                    if(arr1.includes(data)){
                         date = new Date(row.delivery_date);
                    }else{
                         date = new Date(row.dispatch_date);
                    }
                    const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                    return formattedDate;
                }
            },
            {data: 'type', render: function (data, data2, row) {
                    let date;
                    arr1 =['inward_non-returnable','personal_request'];
                    arr2 =['inward_returnable','outward_returnable'];
                    if(arr1.includes(data)){
                        date = new Date(row.delivery_date);
                    }else if(arr2.includes(data)){
                        date = new Date(row.return_date);
                    }else {
                        date = new Date(row.dispatch_date);
                    }
                    const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                    return formattedDate;
                }
            },
            {data: 'id',render: function (data, data2, row) {
                    let qrUrl = `${HOST_URL}/${LANG}/dashboard/request/material/:id/qrcode/:secret`;
                    qrUrl = qrUrl.replace(':id', data);
                    qrUrl = qrUrl.replace(':secret', row.secret_code);
                    return `<td>
                    <a type="button" id="activitiesModalActive" data-id="${data}"
                       class="btn  btn-outline-success">${langs[LANG].action}</a>
                     <a class="pointer mr-2 col-4 status-button btn btn-outline-success"
                           data-id="${data}"
                           href="${qrUrl}" target="_blank">
                            <i class="fa fa-qrcode"></i>
                        </a>
                </td>`
                }
            },
            {data: 'id',render: function (data) {
                    return `<td>
                        <a type="button" id="materialAction" data-id="${data}"
                           class="btn btn-success materialAction">${langs[LANG].fastAction}</a>
                    </td>`
                }
            },
        ]
    });
}else {
    var guardExpectedMaterialServerSideDataTable = $('#guard_expected_material_table_data').DataTable({
        language: {
            url: locale,
            search: langs[LANG].search,
            searchPlaceholder: langs[LANG].search_by_request_id,
        },
        "searching": true,
        "processing": true,
        "serverSide": true,
        "bPaginate": true,
        "ordering": false,
        ajax: {
            url: `${HOST_URL}/${LANG}/dashboard/expectedMaterialActivity-table`,
            type: "GET",
            data: function (d) {
                d.type = type;
            }
        },
        columns: [
            {data: 'id',render: function (data) {
                    return data;
                }
            },
            {data: 'contact_person',render: function (data) {
                    return data ??'---';
                }
            },
            {data: 'transporter',render: function (data) {
                    return data.contact_person;
                }
            },
            {data: 'company',render: function (data) {
                    return data ??'---';
                }
            },
            {data: 'type',render: function (data) {
                    return langs[LANG][data];
                }
            },
            {data: 'host',render: function (data) {
                    return data.full_name;
                }
            },
            {data: 'type', render: function (data, data2, row) {
                    let date;
                    arr1 =['inward_non-returnable','personal_request','inward_returnable'];
                    if(arr1.includes(data)){
                        date = new Date(row.delivery_date);
                    }else{
                        date = new Date(row.dispatch_date);
                    }
                    const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                    return formattedDate;
                }
            },
            {data: 'type', render: function (data, data2, row) {
                    let date;
                    arr1 =['inward_non-returnable','personal_request'];
                    arr2 =['inward_returnable','outward_returnable'];
                    if(arr1.includes(data)){
                        date = new Date(row.delivery_date);
                    }else if(arr2.includes(data)){
                        date = new Date(row.return_date);
                    }else {
                        date = new Date(row.dispatch_date);
                    }
                    const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                    return formattedDate;
                }
            },
            {data: 'id',render: function (data, data2, row){
                    return `<td>
                        <a type="button" id="activitiesModalActive" data-id="${data}"
                           class="btn btn-block btn-outline-success">${langs[LANG].action}</a>
                    </td>`
                }
            },
        ]
    });
}

