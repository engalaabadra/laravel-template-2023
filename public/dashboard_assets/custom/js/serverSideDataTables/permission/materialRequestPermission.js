
var serverSideDataTable = $('#material_request_permission_table_data').DataTable({
    language: {
        url: locale,
        search: langs[LANG].search,
        searchPlaceholder: langs[LANG].search_by_request_id_or_host,
    },
    "searching": true,
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    "ordering": false,
    ajax: {
        url: `${HOST_URL}/${LANG}/dashboard/material-request-permission-table`,
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
                        console.log(row)
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

    ]
});
