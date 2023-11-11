var serverSideDataTable = $('#users_table_data').DataTable({
    language: {
        url: locale,
        search: langs[LANG].search,
        searchPlaceholder: langs[LANG].search_by_name_or_id,
    },
    "searching": true,
    "processing": true,
    "serverSide": true,
    "bPaginate": true,
    "ordering": false,
    ajax: {
        url: `${HOST_URL}/${LANG}/dashboard/users-table`,
        type: "GET",
        data: function (d) {
            d.users_status = users_status;
            d.role_id = role_id;
            d.search_email = search_email;
        }
    },
    columns: [
        {
            data: 'id', render: function (data) {
                return data
            }
        },
        {
            data: 'personal_photo_url', render: function (data) {
                return ` <td>
                    <a style="width: 200px;"  >
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 flex-shrink-0">
                                 <img class=" symbol-label img-Modal"  alt="Pic" style="margin: 15px;margin-left: 12% ;" src="${data}" />
                            </div>
                        </div>
                    </a>
                </td>`
            }
        },
        {data: 'full_name', name: 'full_name'},
        {
            data: 'position', render: function (data, data2, row) {
                return data ? data.name : '---';
            }
        },
        {data: 'email', name: 'email'},
        {
            data: 'roles', render: function (data, data2, row) {
                const [firstRole] = data;
                let content = ``;
                if (firstRole) {
                    data.forEach((role, index) => {
                        content += `<span class="badge badge-primary">
                              ${role.label}
                            </span>`
                        if (index != data.length - 1) {
                            content += `<strong> - </strong>`
                        }
                    });
                } else {
                    content += `<span class="badge badge-danger">
                            ${langs[LANG].no_role}
                        </span>`
                }
                return content;
            }
        },
        {
            data: 'id', render: function (data, data2, row) {
                let url = `${HOST_URL}/${LANG}/dashboard/user/:id/active`
                url = url.replace(':id', data);
                return ` <td>
                      <span class="switch switch-outline switch-icon switch-success">
                        <label>
                            <input type="checkbox" class="active_user"
                                   data-url="${url}"
                                   name="status" ${row.active ? 'checked' : ''}>
                            <span></span>
                        </label>
                      </span>
                </td>`
            }
        },
        {
            data: 'created_at', render: function (data, data2, row) {
                const date = new Date(row.created_at);
                const formattedDate = date.toLocaleDateString(LANG, {year: 'numeric', month: 'long', day: 'numeric'});
                return formattedDate;
            }
        },
        {
            data: 'id', class: 'dt_action_btn_cont', render: function (data, data2, row) {
                let editUrl = `${HOST_URL}/${LANG}/dashboard/users/:id/edit`
                let deleteUrl = `${HOST_URL}/${LANG}/dashboard/users/:id`
                editUrl = editUrl.replace(':id', data);
                deleteUrl = deleteUrl.replace(':id', data);
                let content = '';
                if (update) {
                    content += `<a href="${editUrl}"
                           class="btn btn-sm btn-clean btn-icon btn-icon-md ml-1"
                           title="${langs[LANG].edit}">
                            <i class="flaticon-edit-1 edit-icon"></i>
                        </a>`
                }
                if (del) {
                    content += `<a class="btn btn-sm btn-clean btn-icon btn-icon-md ml-1 delete-button"
                           title="${langs[LANG].delete}" data-toggle="modal"
                           data-target="#delete_modal"
                           data-url="${deleteUrl}"
                           data-item-id="${data}">
                            <i class="flaticon2-trash trash-icon"></i>
                        </a>`
                }
                return content;
            }
        },
    ]
});
