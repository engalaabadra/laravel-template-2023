
var serverSideDataTable = $('#visitor_table_data').DataTable({
    language: {
        url: locale,
        search: langs[LANG].search,
        searchPlaceholder: langs[LANG].search_by_name_email_id_number,
    },
    "searching": true,
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    "ordering": false,
    ajax: {
        url: `${HOST_URL}/${LANG}/dashboard/visitor-table`,
        type: "GET",
        data: function (d) {
            d.status = visitor_status;
            d.select_type = select_type;
        }
    },
    columns: [
        {data: 'id',render: function (data) {
                return data
            }
        },
        {
            data: 'personal_photo_url', render: function (data) {
                return ` <a style="width: 200px;" href="${data}">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-60 flex-shrink-0">
                       <img class="symbol-label img-Modal"  alt="Pic" style="margin: 15px;margin-left: 12% ;" src="${data}" />

                        </div>
                    </div>
                </a>`
            }
        },
        {data: 'full_name', name: 'full_name'},
        {data: 'id_type', name: 'id_type'},
        {data: 'id_number', name: 'id_number'},
        {data: 'email', name: 'email'},
        {data: 'mobile', name: 'mobile '},
        {
            data: 'type', render: function (data, data2, row) {
                return `<td>
                    <span class="switch switch-outline switch-icon switch-success">
                        <label>
                            <input type="checkbox" class="active_type"
                                   id="active_type_${row.id}"
                                   data-id="${row.id}"
                                   name="status" ${data == 'contractor' ? 'checked' : ''}>
                            <span></span>
                        </label>
                    </span>
                </td>`
            }
        },
        {data: 'created_at', render: function (data, data2, row) {
                const date = new Date(data);
                const formattedDate = date.toLocaleDateString(LANG , { year: 'numeric', month: 'long', day: 'numeric' });
                return formattedDate;
            }
        },
        {
            data: 'id', render: function (data, data2, row) {
                let destroyUrl = `${HOST_URL}/${LANG}/dashboard/visitors/:id`;
                let editUrl = `${HOST_URL}/${LANG}/dashboard/visitors/:id/edit`;
                editUrl = editUrl.replace(':id', data);
                destroyUrl = destroyUrl.replace(':id', data);
                let content =`<td>
                        <a href="javascript:void(0)"
                           id="visitorModalActive"
                           data-id="${row.id}"
                           class="btn btn-sm btn-primary btn-icon btn-icon-md showVisitor"
                           title="${langs[LANG].details}">
                            <i class="flaticon-eye"></i>
                        </a>`;
                if(update_visitor){
                    content += ` <a href="${editUrl}"
                       class="btn btn-sm btn-success btn-icon btn-icon-md"
                       title="${langs[LANG].edit}">
                       <i class="flaticon-edit-1 edit-icon"></i>
                    </a>`;
                }
                if(delete_user){
                    content +=`<span class="dt_action_btn_cont">
                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
                           title="${langs[LANG].delete}" data-toggle="modal"
                               data-target="#delete_modal"
                               data-url="${destroyUrl}"
                           data-item-id="${data}">
                            <i class="flaticon2-trash trash-icon"></i>
                        </a>
                    </span>`;
                }
                if (action_user){
                    if(!status){
                        content += ` <a class="btn btn-sm btn-clean btn-icon btn-icon-md btn-danger blockVisitor"
                            title="${langs[LANG].block}"
                            data-item-id="${data}">
                            <i class="la la-user-alt-slash"></i>
                        </a>`
                    }else{
                        content += `<a class="btn btn-sm btn-clean btn-icon btn-icon-md btn-success activeVisitor"
                           title="${langs[LANG].active}"
                           data-item-id="${data}">
                            <!-- {{ __('dashboard.active') }} -->
                            <i class="la la-user-alt"></i>
                        </a>`
                    }
                }
                content += `</td>`
                return content
            }
        },
    ]
});
