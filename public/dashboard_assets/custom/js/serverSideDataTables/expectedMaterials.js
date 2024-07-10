var approvedMaterialServerSideDataTable = $('#approved_material_activity_table_data').DataTable({
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
        url: `${HOST_URL}/${LANG}/dashboard/approvedMaterialActivity-table`,
        type: "GET",
        data: function (d) {

        }
    },
    columns: [
        {data: 'id',render: function (data) {
                return data;
            }
        },
        {data: 'startDate', render: function (data, data2, row) {
                const date = new Date(row.created_at);
                const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                return formattedDate;
            }
        },
        {data: 'type',render: function (data) {
                return langs[LANG][data]
            }
        },
        {data: 'sender',class:'table-info-td',render: function (data,data2,row) {
              let content = '';
                    if(row.type == 'between_sites'){
                        content +=`  <b className="text-muted">${langs[LANG].site}</b>
                        : ${row.sender_site?row.sender_site.name :' ---'}<br>
                        <b className="text-muted">${langs[LANG].employee}</b>
                        : ${row.sender_host?row.sender_host.full_name :' ---'}`
                    }else if(row.type == 'personal_request'){
                        content +=` <b>${langs[LANG][row.type]}</b>`
                    }else{
                        content += ` <b className="text-muted">${langs[LANG].company}</b>
                        : ${row.company??'---'}<br>
                        <b className="text-muted">${langs[LANG].name}</b>
                        : ${row.contact_person??'--'}`
                    }

               return content;
            }
        },
        {data: 'location',render: function (data,data2,row) {
                return ` <td class="table-info-td">
                    <b class="text-muted">${langs[LANG].site}</b>: ${row.site.name ??'---'}<br>
                    <b class="text-muted">${langs[LANG].name}</b>: ${row.sender_host ? row.sender_host.full_name :' ---'}
                </td>`
            }
        },
        {data: 'status',render: function (data) {
               let content =`<td>`
                    if(data == 'approved'){
                        content +=`<span class="badge badge-success">
                        ${langs[LANG][data]}
                    </span>`
                    }else if(data == 'rejected' || data == 'canceled'){
                        content += ` <span class="badge badge-danger">
                        ${langs[LANG][data]}
                    </span>`
                    }else{
                        data = data ? data :'in_progress'
                      content += ` <span class ="badge badge-primary">
                        ${langs[LANG][data]}
                    </span>`
                    }
               content += `</td>`
              return content;
            }
        },
        {data: 'id',render: function (data,data2,row){
                let qrUrl = `${HOST_URL}/${LANG}/dashboard/request/material/:id/qrcode/:secret`;
                qrUrl = qrUrl.replace(':id', data);
                qrUrl = qrUrl.replace(':secret', row.secret_code);
            content = `<td class="flex">`
                if(action_material){
                    content +=`<a type="button" id="activitiesModalActive" data-id="${data}"
                       class="btn col-6 mr-2 btn-outline-success">${langs[LANG].action}</a>`
                }
                content += `<a class="pointer mr-2 col-4 status-button btn btn-outline-success"
                       data-id="${data}"
                       href="${qrUrl}" target="_blank">
                        <i class="fa fa-qrcode"></i>
                        </a>
                        </td>`
                return content;
            }
        },
    ]
});

var receivedMaterialServerSideDataTable = $('#received_material_activity_table_data').DataTable({
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
        url: `${HOST_URL}/${LANG}/dashboard/receivedMaterialActivity-table`,
        type: "GET",
        data: function (d) {

        }
    },
    columns: [
        {data: 'id',render: function (data) {
                return data;
            }
        },
        {data: 'startDate', render: function (data, data2, row) {
                const date = new Date(row.created_at);
                const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                return formattedDate;
            }
        },
        {data: 'type',render: function (data) {
                return langs[LANG][data]
            }
        },
        {data: 'sender',render: function (data,data2,row) {
                let content = `<td className="table-info-td">`
                if(row.type == 'between_sites'){
                    content +=`  <b className="text-muted">${langs[LANG].site}</b>
                        : ${row.sender_site?row.sender_site.name :' ---'}<br>
                        <b className="text-muted">${langs[LANG].employee}</b>
                        : ${row.sender_host?row.sender_host.full_name :' ---'}`
                }else if(row.type == 'personal_request'){
                    content +=` <b>${langs[LANG][row.type]}</b>`
                }else{
                    content += ` <b className="text-muted">${langs[LANG].company}</b>
                        : ${row.company??'---'}<br>
                        <b className="text-muted">${langs[LANG].name}</b>
                        : ${row.contact_person??'--'}`
                }
                content +=` </td>`
                return content;
            }
        },
        {data: 'location',render: function (data,data2,row) {
                return ` <td class="table-info-td">
                    <b class="text-muted">${langs[LANG].site}</b>: ${row.site.name ??'---'}<br>
                    <b class="text-muted">${langs[LANG].name}</b>: ${row.sender_host ? row.sender_host.full_name :' ---'}
                </td>`
            }
        },
        {data: 'status',render: function (data) {
                let content =`<td>`
                if(data == 'approved'){
                    content +=`<span class="badge badge-success">
                        ${langs[LANG][data]}
                    </span>`
                }else if(data == 'rejected' || data == 'canceled'){
                    content += ` <span class="badge badge-danger">
                        ${langs[LANG][data]}
                    </span>`
                }else{
                    data = data ? data :'in_progress'
                    content += ` <span class ="badge badge-primary">
                        ${langs[LANG][data]}
                    </span>`
                }
                content += `</td>`
                return content;
            }
        },
    ]
});


