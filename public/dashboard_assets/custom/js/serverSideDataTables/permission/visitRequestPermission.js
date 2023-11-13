
var serverSideDataTable = $('#visit_request_permission_table_data').DataTable({
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
        url: `${HOST_URL}/${LANG}/dashboard/visit-request-permission-table`,
        type: "GET",
        data: function (d) {
            d.type = type;
            d.request_status = request_status;

        }
    },
    columns: [
        {data: 'id',render: function (data) {
                return data
            }
        },
        {data: 'requester',render: function (data) {
                return data.full_name
            }
        },
        {data: 'created_at', render: function (data, data2, row) {
                const date = new Date(data);
                const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                return formattedDate;
            }
        },
        {data: 'department',render: function (data) {
                return data.name
            }
        },
        {data: 'visitors', render: function (data) {
                let content = ``;
                 data.forEach((visitor,index) => {
                     content += `<span>${visitor.full_name} </span>`
                     if(index != data.length-1){
                        content += `<strong> , </strong>`
                     }
                });
                return content;
            }
        },
        {data: 'host',render: function (data) {
                return data.full_name;
            }
        },
        {data: 'from_date', render: function (data, data2, row) {
                const date = new Date(data);
                const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                return formattedDate;
            }
        },
        {data: 'to_date', render: function (data, data2, row) {
                const date = new Date(data);
                const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                return formattedDate;
            }
        },
        {data: 'status',render: function (data,data2,row) {
            content =` <td id="status${row.id}">`
                    if(data == 'active') {
                        content +=`  <span class="badge badge-success">${langs[LANG].active_visit}</span>`
                    }else if(data == 'expired'){
                        content +=`<span class="badge badge-warning" style="color: white">${langs[LANG].expired}</span>`
                    }else if(data == 'canceled'){
                        content +=`<span class="badge badge-danger">${langs[LANG].canceled}</span>`
                    } else{
                        content +=`<span className="badge badge-primary">
                            ${data ? langs[LANG][data] : langs[LANG].in_progress}
                        </span>`
                    }
                content +=`</td>`
                return content
            }
        },

    ]
});
