
var serverSideDataTable = $('#material_request_table_data').DataTable({
    language: {
        url: locale,
        search: langs[LANG].search,
        searchPlaceholder: langs[LANG].search_by_request_id_or_requester,
    },
    "searching": true,
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    "ordering": false,
    ajax: {
        url: `${HOST_URL}/${LANG}/dashboard/material-request-table`,
        type: "GET",
    },
    rowId: 'id',
    columns: [

        {data: 'id',render: function (data) {
                return data;
            }
        },
        {data: 'requester',render: function (data) {
                return data.full_name;
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
                        : ${row.sender_site ? row.sender_site.name : ' ---'}<br>
                        <b className="text-muted">${langs[LANG].employee}</b>
                        : ${row.sender_host ?row.sender_host.full_name : ' ---'}`
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
                    <b class="text-muted">${langs[LANG].host}</b>: ${row.host ? row.host.full_name :' ---'}
                </td>`
            }
        },
        {data: 'status',render: function (data,data2,row) {
                types =['outward_non-returnable','between_sites','outward_returnable'];
                let content =`<td>`
                if(data == 'rejected' || data == 'canceled'){
                    content += ` <span class="badge badge-danger">
                        ${langs[LANG][data]}
                    </span>`
                }else {
                    if(types.includes(row.type)){
                        if( date > row.dispatch_date ){
                            content +=`<span class="badge badge-warning"
                              style="color: white">${langs[LANG].expired}
                          </span>`
                        } else{
                            content +=` <span class="badge badge-primary">
                                ${data ? langs[LANG][data] : langs[LANG].in_progress}
                            </span>`
                        }
                    }else{
                        if( date > row.delivery_date ){
                            content +=`<span class="badge badge-warning"
                              style="color: white">${langs[LANG].expired}
                          </span>`
                        } else{
                            content +=` <span class="badge badge-primary">
                                ${data ? langs[LANG][data] : langs[LANG].in_progress}
                            </span>`
                        }
                    }
                }
                content += `</td>`
                return content;
            }
        },
        {data: 'id',render: function (data,data2,row) {
                let content = '';
                let url = `${HOST_URL}/${LANG}/dashboard/material-requests/${data}/material-status`;
                let delete_url = `${HOST_URL}/${LANG}/dashboard/materials/${data}/delete`;
                let date = new Date();
                let formattedDate = date.toISOString().split('T')[0];
                let types =['outward_non-returnable','between_sites','outward_returnable'];
                let end_date = types.includes(row.type) ? row.dispatch_date : row.delivery_date;

                content = `<td>
                    <div class="text-center d-flex">`

                if(read_material_request){
                    content +=` <a type="button" id="showMaterial" data-id="${data}"
                        title="${langs[LANG].show}"
                       class="btn btn-outline-success btn-sm ml-2">
                       <i class="far fa-eye p-0"></i>
                    </a>`
                }

                if(row.status == 'in_progress' && formattedDate <= end_date){
                    content +=`<div id="close_button${data}" style="line-height: 33px">
                            <a class="pointer status-button status-modal btn btn-sm btn-outline-danger ml-2"
                           data-url="${url}"
                            title="${langs[LANG].cancel}"
                           data-status="canceled" data-material_id="${data}">
                            <i class="flaticon-cancel p-0"></i>

                        </a></div>`
                }


                if (parseInt(root)) {
                    content += ` <a type="button" id="deleteMaterial"
                            data-target="#delete_modal"
                            data-url="${delete_url}"
                            title="${langs[LANG].delete}"
                            data-item-id="${data}"
                            data-toggle="modal"
                            class="delete-button btn btn-outline-danger btn-sm ml-2 ">
                             <i class="flaticon-delete p-0"></i>
                        </a>`
                }
                content += `</div></td>`
                return content;
            }
        },
    ],
    rowCallback: function (row, data) {
        $(row).attr('id', `row-${data.id}`);
    },
});
